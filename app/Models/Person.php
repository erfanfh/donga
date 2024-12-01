<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    /**
     * Each person might belong to many expenses
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function expenses() : BelongsToMany
    {
        return $this->belongsToMany(Expense::class);
    }

    /**
     * @return string
     */
    public function getStatusAttribute(): string
    {
        if ($this->balance > 0)
            return 'creditor';

        if ($this->balance < 0)
            return 'debtor';

        return 'settled';
    }
}
