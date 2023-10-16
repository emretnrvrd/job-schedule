<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $appends = [  "required_effort",];

    protected function requiredEffort(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->level * $this->duration
        );
    }

}
