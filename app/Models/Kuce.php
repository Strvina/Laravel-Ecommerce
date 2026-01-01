<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kuce extends Model
{
    // Fields that can be filled via mass assignment
    protected $fillable = [
        'name',
        'breed',
        'price',
        'description',
        'image',
    ];

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
