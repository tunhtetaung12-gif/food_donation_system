<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
        'user_id',
        'food_name',
        'description',
        'quantity',
        'expiry_date',
        'pickup_location',
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
}
