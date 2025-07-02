<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    use HasFactory;

        public function pairing()
    {
        return $this->belongsTo(Pairing::class);
    }

    public function player()
    {
        return $this->belongsTo(Player::class);
    }
}
