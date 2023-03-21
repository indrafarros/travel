<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bus extends Model
{
    use HasFactory, SoftDeletes;

    protected $filable = 'buses';

    protected $fillable = [
        'plat_number',
        'bus_number',
        'distributor',
        'size'
    ];
}
