<?php

namespace App\Hackathon;

use Illuminate\Container\Container;
use App\Hackathon\BOC\API\GetAccessToken;
use App\Hackathon\BOC\API\CreateSubscription;
use App\Hackathon\BOC\API\GetClientAccessToken;
use App\Hackathon\BOC\API\RetrieveAccountSubscription;
use App\Hackathon\BOC\API\SelectAccountForSubscription;

class BOC
{

    public ?string $subscriptionId = null;

    public function getSubcriptionId(  )
    {
        if (\Cache::has('subscriptionId')) {
            return \Cache::get('subscriptionId');
        }

        return $this->subscriptionId;
    }



    public function __construct( private Container $container )
    {
    }

    /**
     * @throws \Illuminate\Http\Client\ConnectionException
     * @throws \Illuminate\Http\Client\RequestException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \Throwable
     */
    public function requestApproval(): array
    {
        /** @var GetAccessToken $getAccessToken */
        $getAccessToken = $this->container->make( GetAccessToken::class );
        $token = $getAccessToken->get();

        /** @var CreateSubscription $createSubscription */
        $createSubscription = $this->container->make( CreateSubscription::class );

        $subscriptionId = $createSubscription->withAccessToken( $token )->get();

        $this->saveSubscriptionId($subscriptionId);

        /** @var \App\Hackathon\BOC\API\SelectAccountForSubscription $selectAccountsForSubscription */
        $selectAccountsForSubscription = $this->container->make( SelectAccountForSubscription::class );

        $url = $selectAccountsForSubscription
            ->withSubscriptionId( $this->subscriptionId )
            ->get();

        return [ $token, $url ];

    }

    private function saveSubscriptionId( $subscriptionId ): void
    {
        $this->subscriptionId = $subscriptionId;
        \Cache::put( 'subscriptionId', $this->subscriptionId );

    }

    public function acceptApprovalCode( $code )
    {
        $subscriptionId = $this->getSubcriptionId();

        // Access Token Retrieval.
        $getAccessToken = app()->make( GetClientAccessToken::class );

        $accessToken = $getAccessToken->withCode( $code )->get();

        // Get Activated Subscription for User
        $getSubscriptionAction = app()->make( RetrieveAccountSubscription::class );
        return $getSubscriptionAction
            ->withAccessToken( $accessToken )
            ->withSubscription( $subscriptionId )
            ->get();
    }

    public function makePayment()
    {

    }
}
