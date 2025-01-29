<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_id',
        'name',
        'hire_price',
        'description',
        'image_file_path',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class); // supplier_id, id
    }

    public function hireDetails()
    {
        return $this->hasMany(HireDetails::class); // id, equipment_id
    }
}