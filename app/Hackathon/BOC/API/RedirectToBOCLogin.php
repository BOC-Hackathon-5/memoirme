<?php

namespace App\Hackathon\BOC\API;

class RedirectToBOCLogin
{
    /**
     * https://sandbox-apis.bankofcyprus.com/df-boc-org-sb/sb/psd2/oauth2/authorize?response_type=code&redirect_uri={{yourAppRedirectionURL}}&scope=UserOAuth2Security&client_id={{yourClientId}}&subscriptionid={{subscriptionId}}
     *
     * @return void
     */
    public function get()
    {
    }
}
