<?php

namespace App\Hackathon\BOC\API;

use Illuminate\Support\Str;
use App\Hackathon\ApiAction;
use Illuminate\Support\Facades\Http;

class RetrieveAccountSubscription extends ApiAction
{


    private ?string $token = null;

    public function withAccessToken( string $token )
    {
        $this->token = $token;
        return $this;
    }


    private ?string $subscription = null;

    public function withSubscription( string $subscription )
    {
        $this->subscription = $subscription;
        return $this;
    }


    /**
     * curl --location 'https://sandbox-apis.bankofcyprus.com/df-boc-org-sb/sb/psd2/v1/subscriptions/Subid000001-1729275657700' \
     * --header 'Authorization: Bearer AAIkMTMyZjQzMjItMGUwMi00ZDcxLWFmZTItNDQ5OThmYWZmOTM40Ks6qNClq-v580VUQA4C6sjZFHABzpvMstkvFKp-Yng0OWB3RGq-KBYF0ty17gS8nq4vFW8L9ocVQrb5dUDwNfcqq4nBTbAwIxfX28uDMg4DjnokbSxmQj4cDL-Qi0NLWPT1EuFZEIyRiNNWx54UPw' \
     * --header 'Content-Type: application/json' \
     * --header 'timestamp: 1729332385' \
     * --header 'journeyId: 38a7af84-e79e-47b9-a10b-bc9b14a35cb3'
     * @return void
     */
    public function get(): array
    {

        return Http::asJson()
            ->withHeaders( [
                'timestamp' => now()->timestamp,
                'journeyId' => Str::uuid()->toString(),
            ] )
            ->withToken( $this->token )
            ->get( 'https://sandbox-apis.bankofcyprus.com/df-boc-org-sb/sb/psd2/v1/subscriptions/' . $this->subscription )
            ->json(0);
    }
}
