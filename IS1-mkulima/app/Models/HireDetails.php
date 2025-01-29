<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HireDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'equipment_id',
        'supplier_id',
        'status',
        'quantity',
        'total_price',
        'from',
        'to',
    ];

    public function equipment()
    {
        return $this->belongsTo(Equipment::class); // equipment_id, id
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class); // supplier_id, id
    }
}