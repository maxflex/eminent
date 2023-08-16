<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'comment', 'date', 'time'];

    protected $casts = [
        'date' => 'date'
    ];

    // public function setDateAttribute($value)
    // {
    //     logger("date:" . $value);
    // }
}
