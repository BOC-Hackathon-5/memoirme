<?php

namespace App\Hackathon\BOC\API;

use App\Hackathon\ApiAction;
use InvalidArgumentException;

class SelectAccountForSubscription extends ApiAction
{

    private ?string $token = null;
    private ?string $subscriptionId = null;

    public function withToken( $token )
    {

        $this->token = $token;

        return $this;
    }

    public function hasToken()
    {
        return $this->token !== null;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function withSubscriptionId( string $subscriptionId )
    {
        $this->subscriptionId = $subscriptionId;
        return $this;
    }

    public function hasSubscriptionId(): bool
    {
        return $this->subscriptionId !== null;
    }


    public function getSubscriptionId()
    {
        return $this->subscriptionId;
    }

    /**
     * https://sandbox-apis.bankofcyprus.com/df-boc-org-sb/sb/psd2/oauth2/authorize?response_type=code&redirect_uri={{yourAppRedirectionURL}}&scope=UserOAuth2Security&client_id={{yourClientId}}&subscriptionid={{subscriptionId}}
     *
     * @throws \Illuminate\Http\Client\RequestException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \Illuminate\Http\Client\ConnectionException
     * @throws \Throwable
     */
    public function get()
    {

        throw_unless( $this->hasSubscriptionId(), new InvalidArgumentException( "No Token or SubscriptionId provided." ) );

        $redirectUrl = $this->config->get( 'boc.redirect_uri', 'https://memoirme.test/associate' );
        $clientId = $this->config->get( 'boc.client_id' );
        $subscriptionId = $this->getSubscriptionId();

        return "https://sandbox-apis.bankofcyprus.com/df-boc-org-sb/sb/psd2/oauth2/authorize?response_type=code&redirect_uri={$redirectUrl}&scope=UserOAuth2Security&client_id=$clientId&subscriptionid=$subscriptionId";

    }
}
