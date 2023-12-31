<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Landlord extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone_number',
        'email',
    ];

    public function houses()
    {
        return $this->belongsToMany(House::class);
    }
}
