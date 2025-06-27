<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'gender',
        'category_id',
        'image',
        'stock',
        'rating'
    ];
    public const GENDERS = ['unisex', 'men', 'woman'];

    // Relasi ke OrderItem
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function averageRating()
    {
        return $this->comments()->avg('rating');
    }

}

