<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Estate extends Model
{
    use HasFactory;

    protected $table = 'estates';

    protected $fillable = [
        'owner_id',
        'estate_type',
        'operation_type',
        'location',
        'locationInDamascus',
        'description',
        'price',
        'space',

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
