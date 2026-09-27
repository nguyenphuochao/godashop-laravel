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
            "sku" => "SKU2",
            "name" => $data["name"],
            "price" => $data["wholesale_price"],
            "discount_percentage" => 0,
            "discount_from_date" => null,
            "discount_to_date" => null,
            "inventory_qty" => $data["inventory_number"],
            "category_id" => (int)1,
            "brand_id" => (int)1,
            "featured" => (int)$data["featured"],
            "created_date" => date("Y-m-d H:i:s"),
            "featured_image" => $data["featured_image"],
            "description" => $data["description"],
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
