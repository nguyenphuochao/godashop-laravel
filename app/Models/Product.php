<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "products";

    protected $fillable = [
        "barcode",
        "sku",
        "name",
        "price",
        "discount_percentage",
        "discount_from_date",
        "discount_to_date",
        "featured_image",
        "inventory_qty",
        "category_id",
        "brand_id",
        "created_date",
        "description",
        "star",
        "featured",
    ];
}
