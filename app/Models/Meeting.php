<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Meeting extends Model
{
    protected $fillable = ['title', 'budget', 'start_time', 'end_time'];

    /**
     * Each meeting should belong to one user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Each meeting might have many users
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function people() : HasMany
    {
        return $this->hasMany(People::class);
    }
}
