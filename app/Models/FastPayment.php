<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FastPayment extends Model
{
    use HasFactory;

    protected $table = 'fast_payments';

    protected $guarded = [];

    public function badge()
    {
        return $this->belongsTo('\App\Models\Badge', 'badge_id', 'id');
    }

    public function user(){
        return $this->belongsTo('\App\Models\User', 'user_id', 'id');
    }
}