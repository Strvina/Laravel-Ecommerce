<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = ['user_id', 'kuce_id', 'quantity'];

    // Relationship to dog
    public function kuce()
    {
        return $this->belongsTo(Kuce::class);
    }
}
