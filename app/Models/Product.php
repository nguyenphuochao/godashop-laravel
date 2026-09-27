<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";

    protected $fillable = [
        "barcode",
        "sku",
        "name",
        "price",
        "inventory_qty",
        "discount_percentage",
        "discount_from_date",
        "discount_to_date",
        "category_id",
        "brand_id",
        "created_date",
        "featured",
        "featured_image",
        "description"
    ];

    public $timestamps = false;

    use HasFactory;
}
