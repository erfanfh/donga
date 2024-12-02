<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $fillable = ['amount', 'creditor_id'];

    /** Each payment has done by only one person
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }

    /**
     * Each payment has only one destination
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creditor(): BelongsTo
    {
        return $this->belongsTo(Person::class, 'creditor_id');
    }
}
