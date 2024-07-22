<?php

namespace App\Models;

use App\Catalogize\Traits\HasB2b;
use App\Catalogize\Traits\Imageable;
use App\Models\Resources\B2b;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use function Illuminate\Events\queueable;


class User extends Authenticatable
{
    use HasApiTokens,
        Billable,
        HasFactory,
        Notifiable,
        Imageable,
        HasB2b,
        HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'b2b_id',
        'img',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function userB2b(){
        return $this->hasMany(UserB2b::class, "user_id", "id");
    }

    protected static function booted()
    {
        static::updated(queueable(function ($customer) {
            if ($customer->hasStripeId()) {
                $customer->syncStripeCustomerDetails();
            }
        }));
    }
}
