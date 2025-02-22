<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'fertilizer_id',
        'quantity',
    ];

    public function fertilizer()
    {
        return $this->hasMany(Fertilizer::class, 'id', 'fertilizer_id');
    }
}
