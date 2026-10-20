<?php

namespace App\Models;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'product_id');
    }
}
