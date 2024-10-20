<?php

// config for Threeel/BOC
return [

    'base_url' => env('BOC_BASE_URL','https://sandbox-apis.bankofcyprus.com/df-boc-org-sb/sb/psd2/oauth2/token'),
    'client_id' => env('BOC_CLIENT_ID','4557953eb7450f3642568fcada242904'),
    'client_secret' => env('BOC_CLIENT_SECRET','388a6155051986b3b657a1f3b2ff7add'),

];

// https://sandbox-apis.bankofcyprus.com/df-boc-org-sb/sb/psd2/oauth2/authorize?response_type=code&redirect_uri=https://memoirme.test/associate&scope=UserOAuth2Security&client_id=4557953eb7450f3642568fcada242904&subscriptionid=Subid000001-1729349050335
// https://sandbox-apis.bankofcyprus.com/df-boc-org-sb/sb/psd2/oauth2/authorize?response_type=code&redirect_uri=https://memoirme.test/associate&scope=UserOAuth2Security&client_id=4557953eb7450f3642568fcada242904&paymentid=390cfe79-51d7-4815-9f26-b9a3ee35fd4d
//"selectedAccounts" => array:1 [▼
//      0 => array:1 [▼
//        "accountId" => "351012345673"
//      ]
