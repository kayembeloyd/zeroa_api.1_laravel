<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    use HasFactory;

    protected $fillable = [
        'location_id',
        'rent_fee',
        'rent_fee_inclusion',
        'installment_period',
        'available_on',
        'number_of_rooms',
        'number_of_views',
        'description',
    ];

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class);
    }

    public function landlords()
    {
        return $this->belongsToMany(Landlord::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
