<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Locations;



class Order extends Model
{
    use HasFactory;
    protected $fillable = ['status', 'user_id', 'location_id', 'total_price', 'date_of_delevery'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function location()
    {
        return $this->belongsTo(Locations::class);
    }
    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }
}
