<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

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
    public function persons() : HasMany
    {
        return $this->hasMany(Person::class);
    }

    /**
     * Each meeting might have many expenses
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class);
    }

    /**
     * Each meeting might have many payments
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function payments(): HasManyThrough
    {
        return $this->hasManyThrough(Payment::class, Person::class);
    }

    public function getCreditorsAttribute(Meeting $meeting)
    {
        return $meeting->persons->where('balance', '>', '0');
    }
}
