<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable=[
        "name",
        "slug",
        "price",
        "description",
        "sale_price",
        "image_name",
        "created_at",
        "updated_at"
    ];
}
