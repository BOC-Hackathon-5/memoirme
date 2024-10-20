<?php

namespace App\Hackathon\JINIUS\API;

use App\Hackathon\ApiAction;
use Illuminate\Support\Facades\Http;
use Illuminate\Contracts\Container\Container;

class SubmitRemittance extends ApiAction
{

    private $accountId;
    private $iban;
    private $amount;

    public function __construct( Container $container, private GetAccessToken $accessToken )
    {
        parent::__construct( $container );
    }

    public function fromAccount( $accountId )
    {
        $this->accountId = $accountId;
        return $this;
    }

    public function toNGO( $amount, $iban )
    {
        $this->iban = $iban;
        $this->amount = $amount;
        return $this;
    }

    private function createPayload(): string
    {
        return json_encode( [
            "groupHeader" => [
                "remittanceAdviceId" => "LBR21233796796",
                "creationDateTime" => "2024-10-19",
                "executionDate" => "2024-10-19",
                "numberOfPayments" => 1,
                "totalAmount" => $this->amount,
            ],
            "payments" => [
                [
                    "paymentDetails" => [
                        "debtorDetails" => [
                            "accountNumber" => "351012345671",
                        ],
                        "creditorDetails" => [
                            "iban" => $this->iban ?? "CY60002023420000003423423433",
                            "creditorName" => "Anti-Cancer Cyprus",
                        ],
                        "amount" => $this->amount,
                        "paymentReference" => "36835834",
                    ],
                    "supplier" => [
                        "taxIdentificationNumber" => "56124545A",
                        "vatNumber" => "56124545A",
                        "companyRegistrationNumber" => "α25612454",
                        "companyName" => "AA",
                        "email" => "kleanthis.symeonides+remittance@platform.cy",
                    ],
                    "invoices" => [
                    ],
                ],
            ],
        ] );
    }

    public function get()
    {
        return Http::asMultipart()
            ->withToken( $this->accessToken->get() )
            ->attach( 'file', $this->createPayload(), 'memoirme.json', [ 'Content-Type' => 'application/json' ] )
            ->post( 'https://api.integration.platform.cy/v3/remittances', [
                'RemittanceExecutionMethod' => 'mass',
            ] )->json();
    }
}
