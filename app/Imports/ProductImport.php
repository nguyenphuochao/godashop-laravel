<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Override;

class ProductImport implements ToCollection
{

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            if (!is_numeric($row[0])) {
                continue;
            }

            $id = $row[0];
            $barcode = $row[1];
            $sku = $row[2];
            $name = $row[3];
            $price = $row[4];
            $discount_percentage = $row[5] ?? 0;
            $discount_from_date = $row[6];
            $discount_to_date = $row[7];
            $featured_image = $row[8];
            $inventory_qty = $row[9];
            $category_id = $row[10];
            $brand_id = $row[11];
            $created_date = $row[12];
            $description = $row[13];
            $star = $row[14] ?? null;
            $featured = $row[15] ?? null;

            $product = Product::find($id);
            if(empty($product)) {
                $product = new Product();
                $product->id = $id;
            }

            $product->barcode = $barcode;
            $product->sku = $sku;
            $product->name = $name;
            $product->price = $price;
            $product->discount_percentage = $discount_percentage;
            $product->discount_from_date = $discount_from_date;
            $product->discount_to_date = $discount_to_date;
            $product->featured_image = $featured_image;
            $product->inventory_qty = $inventory_qty;
            $product->category_id = $category_id;
            $product->brand_id = $brand_id;
            $product->created_date = $created_date;
            $product->description = $description;
            $product->star = $star;
            $product->featured = $featured;

            $product->save();
        }
    }
}
