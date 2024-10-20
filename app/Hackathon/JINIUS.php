<?php

namespace App\Hackathon;

use Illuminate\Container\Container;
use App\Hackathon\JINIUS\API\GetAccessToken;
use App\Hackathon\JINIUS\API\SubmitRemittance;

class JINIUS
{
    public function __construct( private Container $container )
    {
    }

    public function makePayment(  )
    {
       $remittance =  $this->container->make(SubmitRemittance::class);

       $remittance->get();
    }
}
