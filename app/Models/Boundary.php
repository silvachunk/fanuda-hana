<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Boundary extends Model
{
    use HasFactory;

    protected $fillable = [
        'fan_id',
        'violation',
        'message',
        'escalated'
    ];
}

