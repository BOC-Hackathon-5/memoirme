<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExternalPayment extends Model
{
    /** @use HasFactory<\Database\Factories\ExternalPaymentFactory> */
    use HasFactory;

    public function memory(  )
    {
        return $this->belongsTo(Memory::class);
    }
}
