<?php

namespace App\Hackathon\BOC\API;

use App\Hackathon\ApiAction;
use Illuminate\Support\Facades\Http;

class GetClientAccessToken extends ApiAction
{

    private ?string $code = null;

    public function withCode( $code )
    {
        $this->code = $code;
        return $this;
    }

    public function get()
    {
        return Http::asForm()
            ->post( 'https://sandbox-apis.bankofcyprus.com/df-boc-org-sb/sb/psd2/oauth2/token', [
                'grant_type' => 'authorization_code',
                'client_id' => $this->config->get( 'boc.client_id' ),
                'client_secret' => $this->config->get( 'boc.client_secret' ),
                'scope' => 'UserOAuth2Security',
                'code' => $this->code,
            ] )->json('access_token');

    }
}
