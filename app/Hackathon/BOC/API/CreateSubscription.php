<?php

namespace App\Hackathon\BOC\API;

use App\Hackathon\ApiAction;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\Http;

/**
 * @method getAccessToken()
 */
class CreateSubscription extends ApiAction
{
    private string $token;

    public function __construct( Container $container, protected readonly GetAccessToken $accessTokenAction )
    {
        parent::__construct( $container );

    }

    public function withAccessToken( string $token )
    {
        $this->token = $token;
        return $this;
    }

    public function hasToken(): bool
    {
        return isset( $this->token );
    }

    public function getToken()
    {
        return $this->token;
    }


    /**
     * curl --request POST \ --url https://sandbox-apis.bankofcyprus.com/df-boc-org-sb/sb/psd2/v1/subscriptions
     * \--header Authorization: Bearer {{oauth_token}}\
     * --header Content-Type: application/json \
     * --header originUserId: {{userId}} \
     * --header timeStamp: {{$timestamp}} \
     * --header journeyId: {{$guid}} \
     * --header app_name: {{app-name}} \
     * --header Content-Type: application/json \
     * --data {
     * "accounts": {
     * "transactionHistory": true,
     * "balance": true,
     * "details": true,
     * "checkFundsAvailability": true
     * },
     * "payments": {
     * "limit": 99999999,
     * "currency": "EUR",
     * "amount": 999999999
     * }
     * @param string $user
     * @return string
     * @throws \Illuminate\Http\Client\ConnectionException
     * @throws \Illuminate\Http\Client\RequestException|\Throwable
     */
    public function get( string $user = 'anything_in_sandbox' ): string
    {
        throw_unless( $this->hasToken(), new \InvalidArgumentException( "No access token provided." ) );

        $subscriptionId = Http::withToken( $this->token )->asJson()
            ->withHeaders( [
                'originUserId' => $user,
                'timeStamp' => now()->timestamp,
                'journeyId' => '{{$guid}}',
                'app_name' => 'package',
            ] )
            ->post( 'https://sandbox-apis.bankofcyprus.com/df-boc-org-sb/sb/psd2/v1/subscriptions', [
                "accounts" => [
                    "transactionHistory" => true,
                    "balance" => true,
                    "details" => true,
                    "checkFundsAvailability" => true,
                ],
                "payments" => [
                    "limit" => 99999999,
                    "currency" => "EUR",
                    "amount" => 999999999,
                ],
            ] )->throw()->json( 'subscriptionId' );

        return $subscriptionId;
    }

}
