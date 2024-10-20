<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memory extends Model
{
    /** @use HasFactory<\Database\Factories\MemoryFactory> */
    use HasFactory;


    protected static function boot()
    {
        parent::boot();

        static::creating( function ( $model ) {
            $model->ref = Str::ulid()->toBase58();
        } );
    }

    public function casts()
    {
        return [
            'content' => 'json',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo( User::class );
    }


    public function payments()
    {
        return $this->hasMany( ExternalPayment::class );
    }

}
