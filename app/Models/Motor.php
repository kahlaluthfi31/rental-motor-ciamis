<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Motor extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_id',
        'brand',
        'type_cc',
        'plate_number',
        'status',
        'photo',
        'photo_url',
        'dokumen_kepemilikan',
    ];

    // Relasi ke rental rates
    public function rentalRates()
    {
        return $this->hasOne(RentalRate::class, 'motor_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'motor_id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    // Ini adalah metode relasi yang benar, menggunakan nama singular
    // karena relasinya adalah hasOne (satu motor memiliki satu set harga).
    // public function rentalRate()
    // {
    //     return $this->hasOne(RentalRate::class, 'motor_id');
    // }

    public function rentals()
    {
        return $this->hasMany(RentalRate::class);
    }

    public function getCompletedBookingsCount()
    {
        return $this->bookings()
            ->where('status', 'selesai') // Sesuai dengan enum di tabel bookings
            ->count();
    }

    public function getPhotoUrlAttribute($value)
    {
        // Langsung return asset URL
        return asset($value);
    }
}
