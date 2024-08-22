<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'valid_from',
        'valid_to',
        'value',
    ];

    protected $casts = [
        'valid_from' => 'datetime',
        'valid_to' => 'datetime',
    ];
}
