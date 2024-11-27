<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Person extends Model
{
    protected $fillable = ['name', 'balance'];

    protected $table = 'persons';

    /**
     * Each user can participate in many meetings
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function meeting(): BelongsTo
    {
        return $this->belongsTo(Meeting::class);
    }

    public function expenses()
    {
        return $this->belongsToMany(Expense::class);
    }
}
