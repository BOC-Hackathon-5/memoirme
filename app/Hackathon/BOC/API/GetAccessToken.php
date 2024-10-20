<?php

namespace App\Hackathon\BOC\API;

use App\Hackathon\ApiAction;
use Illuminate\Support\Facades\Http;

class GetAccessToken extends ApiAction
{

    /**
     * curl --request POST \ --url https://sandbox-apis.bankofcyprus.com/df-boc-org-sb/sb/psd2/oauth2/token \
     * --header accept: application/json \
     * --header content-type: application/x-www-form-urlencoded \
     * --data grant_type=client_credentials&client_id={{your client id}}&client_secret={{your client secret}}&scope=TPPOAuth2Security
     * @return string
     * @throws \Illuminate\Http\Client\ConnectionException
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function get(): string
    {
        return Http::acceptJson()
            ->asForm()
            ->post( 'https://sandbox-apis.bankofcyprus.com/df-boc-org-sb/sb/psd2/oauth2/token', [
                'grant_type' => 'client_credentials',
                'client_id' => $this->config->get( 'boc.client_id' ),
                'client_secret' => $this->config->get( 'boc.client_secret' ),
                'scope' => 'TPPOAuth2Security',
            ] )->throw()->json( 'access_token' );
    }

}
