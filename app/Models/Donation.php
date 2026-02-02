<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{

    protected $casts = [
        'expiry_date' => 'datetime',
    ];

    protected $fillable = [
        'user_id',
        'food_name',
        'description',
        'quantity',
        'expiry_date',
        'pickup_location',
        'place',
        'image_path',
        'status',
        'volunteer_id'
    ];

    // Get the Donor who posted the food
    public function donor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Get the Volunteer assigned to this donation
    public function volunteer()
    {
        return $this->belongsTo(User::class, 'volunteer_id');
    }

    // app/Models/Donation.php
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
}
