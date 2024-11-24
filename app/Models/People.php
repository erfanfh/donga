<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class People extends Model
{

    protected $fillable = ['name'];

    /**
     * Each user can participate in many meetings
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function meeting() : BelongsTo
    {
        return $this->belongsTo(Meeting::class);
    }
}
