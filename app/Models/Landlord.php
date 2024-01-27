<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Landlord extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function houses()
    {
        return $this->belongsToMany(House::class);
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
}
