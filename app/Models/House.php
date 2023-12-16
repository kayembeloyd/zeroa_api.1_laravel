<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    use HasFactory;

    protected $fillable = [
        'rent_fee',
        'rent_fee_inclusion',
        'installment_period',
        'available_on',
        'number_of_rooms',
        'number_of_views',
        'description',
    ];
}
