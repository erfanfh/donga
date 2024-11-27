<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = ['name', 'price', 'description'];

    public function persons()
    {
        return $this->belongsToMany(Person::class);
    }

    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }
}
