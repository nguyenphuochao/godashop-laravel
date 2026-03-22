<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ViewProduct extends Model
{
    use HasFactory;
    protected $table = 'view_products';
    /**
     * Get the user that owns the ViewProduct
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    /**
     * Get all of the comments for the ViewProduct
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function image_items(): HasMany
    {
        return $this->hasMany(ImageItem::class, 'product_id', 'id');
    }
    /**
     * Get the user that owns the ViewProduct
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }
    /**
     * Get the user that owns the ViewProduct
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'product_id', 'id');
    }
}
