<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'tax',
        'email',
    ];

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class, 'customer_id', 'id');
    }
}
