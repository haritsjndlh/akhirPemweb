<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    use HasFactory;
    
    protected $table = 'badges';

    protected $guarded = [];
    
    public function FastPayment()
    {
        return $this->hasOne('\App\Models\FastPayment');
    }
}
