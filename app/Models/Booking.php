<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'renter_id',
        'motor_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'duration_type',
        'total_biaya',
        'status'
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'total_biaya' => 'decimal:2'
    ];

    public function motor()
    {
        return $this->belongsTo(Motor::class, 'motor_id');
    }

    public function renter()
    {
        return $this->belongsTo(User::class, 'renter_id');
    }

    public function revenueSharing()
    {
        return $this->hasOne(RevenueSharing::class, 'booking_id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'booking_id');
    }
}
