<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    protected $fillable = ['title', 'description', 'category', 'section', 'status'];

    /**
     * each ticket belongs to a user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getCategoryAttribute($categry): string
    {
        return match ($categry) {
            1 => "پیشنهاد و انتقاد",
            2 => "گزارش باگ",
            3 => "ارتباط با مدیریت",
            default => "نامشخص",
        };
    }

    public function getSectionAttribute($section): string
    {
        return match ($section) {
            1 => "بخش فنی",
            2 => "بخش مالی",
            3 => "بخش مدیریت",
            default => "نامشخص",
        };
    }

    public function getStatusAttribute($status): string
    {
        return match ($status) {
            0 => 'بسته',
            1 => 'باز',
            2 => 'پاسخ داده شده',
            default => 'نامشخص',
        };
    }
}
