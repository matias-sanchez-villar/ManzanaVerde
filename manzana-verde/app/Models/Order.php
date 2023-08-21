<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Foods; 
use App\Models\User;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'food_item_id', 'quantity'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function foods()
    {
        return $this->belongsToMany(Foods::class, 'food_item_order')
                    ->withPivot('quantity');
    }

}