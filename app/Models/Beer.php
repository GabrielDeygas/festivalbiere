<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'abv', 'type', 'category', 'flavor', 'img', 'country_id'];

    public function country() 
    {
        return $this->belongsTo(Country::class);
    }

    public function reviews() 
    {
        return $this->hasMany(Review::class);
    }

}
