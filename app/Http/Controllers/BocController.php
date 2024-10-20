<?php

namespace App\Http\Controllers;

use App\Hackathon\BOC;
use App\Hackathon\JINIUS;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use App\Hackathon\BOC\API\GetClientAccessToken;
use App\Hackathon\BOC\API\RetrieveAccountSubscription;

class BocController extends Controller
{
    public function __construct( private BOC $boc, private JINIUS $jinius )
    {
    }


    public function public( Request $request )
    {
        return view( 'boc.public' );
    }


    public function account( Request $request )
    {
        [ $token, $url ] = $this->boc->requestApproval();

        return redirect( $url );
    }

    public function associate()
    {
        $code = request()->get( 'code' );
        $isPayment = Cache::has( 'boc-payment-code' );

        if ( $isPayment ) {

            $paymentId = Cache::get( 'boc-payment-code' );

            Http::asJson()->withToken( $code )->withHeaders( [
                'timeStamp' => now()->timestamp,
                'journeyId' => Str::uuid()->toString(),
            ] )->post( "https://sandbox-apis.bankofcyprus.com/df-boc-org-sb/sb/psd2/v1/payments/{$paymentId}/execute" );

            return redirect( )->route( 'dashboard' );

        }

        $accountId = Arr::get( $this->boc->acceptApprovalCode( $code ), 'selectedAccounts.0.accountId' );

        return response()->json( $accountId );

    }

    public function payment_initiate( Request $request )
    {
        $signed = Http::withHeaders( [
            'tppId' => 'singpaymentdata',
        ] )->post( 'https://sandbox-apis.bankofcyprus.com/df-boc-org-sb/sb/jwssignverifyapi/sign', [
            "debtor" => [
                "bankId" => "",
                "accountId" => "351012345671", // Memoir Me Account
            ],
            "creditor" => [
                "bankId" => "BCYPCY2N",
                "accountId" => "351012345676", // Customer
            ],
            "transactionAmount" => [
                "amount" => 30, // Amount to be send
                "currency" => "EUR",
            ],
            "paymentDetails" => "Memoir Kotsios",

        ] )->json();
        $accessToken = app()->make( BOC\API\GetAccessToken::class );

        // initiate Payment
        $paymentId = Http::asJson()
            ->withToken( $accessToken->get() )
            ->withHeaders( [
                'journeyId' => Str::uuid()->toString(),
                'timeStamp' => now()->timestamp,
                'lang' => 'en',
                'loginTimeStamp' => now()->timestamp,
                'customerDevice' => Str::uuid()->toString(),
                'customerIp' => '1.1.1.1',
                'customerSessionId' => Str::uuid()->toString(),
            ] )
            ->post( 'https://sandbox-apis.bankofcyprus.com/df-boc-org-sb/sb/psd2/v1/payments/initiate', $signed )
            ->json( 'payment.paymentId' );

        // Redirect to getCode
        $url = "https://sandbox-apis.bankofcyprus.com/df-boc-org-sb/sb/psd2/oauth2/authorize?response_type=code&redirect_uri=https://memoirme.test/associate&scope=UserOAuth2Security&client_id=4557953eb7450f3642568fcada242904&paymentid={$paymentId}";
        Cache::put( 'boc-payment-code', $paymentId );
        return redirect( $url );
    }

    public function payout( Request $request )
    {

        $this->jinius->makePayment();
    }

}
