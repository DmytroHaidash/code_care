<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserDetails extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'ip', 'user_id', 'browser', 'country', 'cookies', 'last_login'
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
