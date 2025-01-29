<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'phone_number',
        'address',
    ];

    public function equipments()
    {
        return $this->hasMany(Equipment::class);
    }

    public function fertilizers()
    {
        return $this->hasMany(Fertilizer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function hireDetails()
    {
        return $this->hasMany(HireDetails::class);
    }
}
