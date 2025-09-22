<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RentalRate extends Model
{
    protected $fillable = [
        'motor_id',
        'harian',
        'mingguan',
        'bulanan',
    ];
}
