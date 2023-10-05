<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'comment', 'date', 'time', 'is_finished',
        'penalty'
    ];

    protected $casts = [
        'is_finished' => 'boolean'
    ];

    public function getTimeAttribute($value)
    {
        if (!$value) {
            return null;
        }
        return substr($value, 0, 5);
    }
}
