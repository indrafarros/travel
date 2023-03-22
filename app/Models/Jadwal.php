<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwals';
    protected $fillable = [
        'bus_id', 'driver_id', 'rute_id', 'berangkat', 'tiba', 'status'
    ];

    public const NGY = "NGY";
    public const OTW = "OTW";
    public const AAD = "AAD";
    public const CANCEL  = "CANCEL";
}
