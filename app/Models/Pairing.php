<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pairing extends Model
{
    use HasFactory;
    
    public function enemyCountry()
    {
    return $this->belongsTo(Country::class, 'enemy_country_id');
    }
}
