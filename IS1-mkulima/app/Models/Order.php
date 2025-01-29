<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'fertilizer_id',
        'quantity',
        'total_price',
        'order_number',
        'status'
    ];

    public function fertilizer()
    {
        return $this->belongsTo(Fertilizer::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}