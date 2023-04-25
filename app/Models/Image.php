<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $table = 'images' ;

    protected $fillable = [
        'property_type' ,
        'car_id' ,
        'estate_id' ,
        'image'
    ] ;
}
