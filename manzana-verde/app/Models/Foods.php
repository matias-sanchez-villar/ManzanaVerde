<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foods extends Model
{
    use HasFactory;

    protected $visible = ['id', 'name', 'photo', 'description'];

    protected $fillable = ['name', 'photo', 'description'];

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'food_item_order')
                    ->withPivot('quantity');
    }

    public function getPhotoUrlAttribute()
    {
        return asset('storage/' . $this->photo);
    }
}
