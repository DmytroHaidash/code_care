<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Hash extends Model
{
    protected $fillable = [
        'hash', 'algorithm', 'user_id', 'vocabulary_id'
    ];

    /**
     * @return BelongsTo
     */
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function vocabulary():BelongsTo
    {
        return $this->belongsTo(Vocabulary::class);
    }

}
