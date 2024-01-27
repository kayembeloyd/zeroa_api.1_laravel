<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'landlord_id',
        'value',
        'type',
    ];


    public function landlord()
    {
        return $this->belongsTo(Landlord::class);
    }
}
