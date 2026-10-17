<?php

namespace App\Services;

use App\Exports\ProductExport;
use App\Imports\ProductImport;
use App\Models\Product;
use App\Models\ViewProduct;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

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
            "brand_id" => (int)$data["brand"],
            "created_date" => date("Y-m-d H:i:s"),
            "description" => $data["description"],
            "star" => null,
            "featured" => $data["featured"] ?? null,
        ]);

        return $product;
    }

    public function edit($product)
    {
        return $product;
    }

    public function update($product, array $data)
    {
        $product->update([
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
            "brand_id" => (int)$data["brand"],
            "created_date" => date("Y-m-d H:i:s"),
            "description" => $data["description"],
            "star" => null,
            "featured" => $data["featured"] ?? null,
        ]);

        return $product;
    }

    public function destroy($product)
    {
        DB::beginTransaction();

        $data = [];

        try {
            // unlink image in storage public
            $imageItems = DB::table("image_items")->where("product_id", $product->id)->get();
            foreach ($imageItems as $item) {
                if (file_exists(public_path("images/" . $item->name))) {
                    unlink(public_path("images/" . $item->name));
                }
            }

            // delete image_items
            DB::table('image_items')->where("product_id", $product->id)->delete();

            // delete product
            $product->forceDelete();

            DB::commit();

            $data["success"] = "Đã xóa sản phẩm thành công";

            return $data;
        } catch (QueryException $e) {
            DB::rollBack();

            if ($e->getCode() == 23000) {
                $data["error"] = "Sản phẩm chứa thông tin chi tiết đơn hàng, không thể xóa";
            } else {
                $data["error"] = $e->getMessage();
            }

            return $data;
        }
    }

    public function deleteSelected($ids)
    {
        DB::beginTransaction();

        $data = [];

        try {
            // unlink image in storage public
            foreach ($ids as $id) {
                $imageItems = DB::table("image_items")->where("product_id", $id)->get();
                foreach ($imageItems as $item) {
                    if (file_exists(public_path("images/" . $item->name))) {
                        unlink(public_path("images/" . $item->name));
                    }
                }
            }

            // delete image_items
            DB::table('image_items')->whereIn("product_id", $ids)->delete();

            // delete product
            Product::whereIn('id', $ids)->forceDelete();

            DB::commit();

            $data["success"] = "Đã xóa sản phẩm thành công";

            return $data;
        } catch (QueryException $e) {
            DB::rollBack();

            if ($e->getCode() == 23000) {
                $data["error"] = "Sản phẩm chứa thông tin chi tiết đơn hàng, không thể xóa";
            } else {
                $data["error"] = $e->getMessage();
            }

            return $data;
        }
    }

    public function export($ids)
    {
        $time = time();
        return Excel::download(new ProductExport($ids), "product_list_$time.xlsx");
    }

    public function import($file)
    {
        Excel::import(new ProductImport, $file);
    }
}
