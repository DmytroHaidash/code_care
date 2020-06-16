<?php

namespace App;

use App\Models\Hash;
use App\Models\UserDetails;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @return HasMany
     */
    public function userDetails(): HasMany
    {
        return $this->hasMany(UserDetails::class);
    }

    /**
     * @return HasMany
     */
    public function hash(): HasMany
    {
        return$this->hasMany( Hash::class);
    }
}
