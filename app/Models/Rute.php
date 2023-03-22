<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rute extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'rutes';
    protected $fillable = [
        'kode', 'tujuan', 'asal', 'waktu_tempuh', 'checkpoints'
    ];
}
