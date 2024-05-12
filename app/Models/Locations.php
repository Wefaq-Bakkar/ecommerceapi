<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locations extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','street','building','area'];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
