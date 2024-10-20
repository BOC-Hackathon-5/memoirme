<?php

namespace App\Hackathon\JINIUS\API;

use App\Hackathon\ApiAction;
use Illuminate\Support\Facades\Http;

class GetAccessToken extends ApiAction
{


    /**
     * @throws \Illuminate\Http\Client\RequestException
     * @throws \Illuminate\Http\Client\ConnectionException
     */
    public function get()
    {
        return Http::asForm()
            ->post( 'https://api.integration.platform.cy/oauth/token', [
                'grant_type' => 'client_credentials',
                'client_id' => $this->config->get( 'jinius.client_id' ),
                'client_secret' => $this->config->get( 'jinius.client_secret' ),
            ] )->throw()->json('access_token');
    }
}
