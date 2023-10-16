<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    use HasFactory;

    protected $appends = [
        "workforce_per_hour",
        "workforce_per_week",
        "workforce_per_day",
    ];

    protected function workforcePerHour(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->level * 1
        );
    }

    protected function workforcePerDay(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->workforce_per_week / 5
        );
    }

    protected function workforcePerWeek(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->weekly_working_hours * $this->workforce_per_hour
        );
    }

}
