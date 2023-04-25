<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Car extends Model
{
    use HasFactory;

    protected $table = 'cars';

    protected $fillable = [
        'owner_id',
        'operation_type',
        'transmission_type',
        'brand',
        'secondary_brand',
        'location',
        'locationInDamascus',
        'color',
        'description',
        'price',
        'year',
        'kilometers'
    ];

    public function images(): HasMany
    {
        return $this->hasMany(Image::class) ;
    }
    public function owner()
    {
        return $this->belongsTo(User::class) ;
    }
}
