<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Expense extends Model
{
    protected $fillable = ['name', 'price', 'description'];

    /**
     * Each expense might belong to many persons
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function persons(): BelongsToMany
    {
        return $this->belongsToMany(Person::class);
    }

    /**
     * Each expense should belong to only one meeting
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function meeting(): BelongsTo
    {
        return $this->belongsTo(Meeting::class);
    }
}
