<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    /**
     * Model ini hanya untuk menangani custom audit trail
    */
    use HasFactory;

    protected $fillable = [
        'user_type',
        'user_id',
        'event',
        'auditable_id',
        'auditable_type',
        'url',
        'ip_address',
        'user_agent'
    ];
}
