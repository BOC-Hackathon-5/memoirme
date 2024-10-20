<?php

use App\Hackathon\BOC;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BocController;
use App\Hackathon\BOC\API\GetClientAccessToken;
use App\Hackathon\BOC\API\RetrieveAccountSubscription;

Route::view( '/', 'welcome' );

Route::get( 'boc/public', [ BocController::class, 'public' ] )->name( 'boc.public' );

Route::get( '/boc', [ BocController::class, 'account' ] )->name( 'boc.subscription' );

Route::get( '/associate', [ BocController::class, 'associate' ] )->name( 'boc.subscription.associate' );

Route::get( '/boc/payment', [ BocController::class, 'payment_initiate' ] )->name( 'boc.payment.initiate' );

Route::get( '/boc/payout', [ BocController::class, 'payout' ] )->name( 'boc.payout' );

Route::view( 'dashboard', 'dashboard' )
    ->middleware( [ 'auth', 'verified' ] )
    ->name( 'dashboard' );

Route::view( 'profile', 'profile' )
    ->middleware( [ 'auth' ] )
    ->name( 'profile' );

//require __DIR__ . '/auth.php';
