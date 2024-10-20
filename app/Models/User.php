<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function hasRole(): bool
    {
        return !is_null( $this->role() );
    }

    public function role(): ?string
    {
        return match ( true ) {
            Str::endsWith( $this->getAttribute( 'email' ), '@customer.com' ) => 'customer',
            Str::endsWith( $this->getAttribute( 'email' ), '@partner.com' ) => 'partner',
            Str::endsWith( $this->getAttribute( 'email' ), '@ngo.com' ) => 'ngo',
            Str::endsWith( $this->getAttribute( 'email' ), '@admin.com' ) => 'admin',
            default => null
        };
    }

    public function memories()
    {
        return $this->hasMany( Memory::class );
    }
}
