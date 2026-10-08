<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ViewProduct;
use Illuminate\Support\Facades\DB;

class ProductService
{

    public function getAll()
    {
        return ViewProduct::all();
    }

    public function create(array $data)
    {
        $product = Product::create([
            "barcode" => $data["barcode"],
            "sku" => $data["sku"],
            "name" => $data["name"],
            "price" => $data["wholesale_price"],
            "discount_percentage" => 0,
            "discount_from_date" => null,
            "discount_to_date" => null,
            "featured_image" => $data["featured_image"],
            "inventory_qty" => $data["inventory_number"],
            "category_id" => (int)$data["category"],
            "brand_id" => (int)$data["branch"],
            "created_date" => date("Y-m-d H:i:s"),
            "description" => $data["description"],
            "star" => null,
            "featured" => $data["featured"] ?? null,
        ]);

        return $product;
    }

    public function edit($id)
    {
        return ViewProduct::findOrFail($id);
    }

    public function update(array $data)
    {
        return Product::update([

        ]);
    }

    public function destroy($id)
    {
        Product::destroy($id);
    }
}
