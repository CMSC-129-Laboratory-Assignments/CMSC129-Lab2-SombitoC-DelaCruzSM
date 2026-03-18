<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuItem extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable (i.e. can be filled via create/update methods).
     */
    protected $fillable = [
        'name',
        'description',
        'full_price',
        'half_price',
        'image',
        'is_available',
    ];

    /**
     * The attributes that should be cast (i.e. typecast/convert to specific data types).
     */
    protected $casts = [
        'full_price' => 'decimal:2',
        'half_price' => 'decimal:2',
        'is_available' => 'boolean',
    ];
}