<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

       public $timestamps = false; 

       protected $fillable = [
        'uniform_num',
        'position',
        'name',
        'country_id',
        'club',
        'birth',
        'height',
        'weight'
    ];

    public function country()
    {
    return $this->belongsTo(Country::class);
    }

    public function goals()
    {
    return $this->hasMany(Goal::class);
    }
}
