<?php

namespace Tests\Unit\Services;

use App\Models\Product;
use App\Models\ViewProduct;
use App\Services\ProductService;
use Tests\TestCase;
use Faker\Factory as Faker;

/**
 * ./vendor/bin/phpunit tests/Unit/Services/ProductTest.php
 */

class ProductTest extends TestCase
{
    protected $faker;
    protected $product;
    protected $productService;

    public function setUp() : void
    {
        parent::setUp();

        $this->faker = Faker::create();

        $this->product = [
            "barcode" => $this->faker->numberBetween(111111111111, 999999999999),
            "sku" => "SKU". $this->faker->numberBetween(100, 999),
            "name" => $this->faker->name,
            "wholesale_price" => $this->faker->numberBetween(10000, 99999),
            "discount_percentage" => 0,
            "discount_from_date" => null,
            "discount_to_date" => null,
            "featured_image" => $this->faker->word(). ".jpg",
            "inventory_number" => $this->faker->numberBetween(1, 100),
            "category" => $this->faker->numberBetween(1, 6),
            "brand" => 1,
            "created_date" => date("Y-m-d H:i:s"),
            "description" => $this->faker->sentence(),
            "star" => null,
            "featured" => 1,
        ];

        $this->productService = new ProductService();
    }

    public function tearDown() : void
    {
        parent::tearDown();
    }

    /**
     * test list
     * ./vendor/bin/phpunit tests/Unit/Services/ProductTest.php --filter testList
    */
    public function testList()
    {
        // Gọi hàm tạo
        $product = $this->productService->create($this->product);

        $productList = $this->productService->getAll();

        $this->assertNotEmpty($productList);
    }

    /**
     * test store
     * ./vendor/bin/phpunit tests/Unit/Services/ProductTest.php --filter testStore
    */

    public function testStore()
    {
        // Gọi hàm tạo
        $product = $this->productService->create($this->product);

        // Kiểm tra xem kết quả trả về có là thể hiện của lớp Product hay không
        $this->assertInstanceOf(Product::class, $product);

        // Kiểm tra data trả về
        $this->assertEquals($this->product['name'], $product->name);

        // Kiểm tra dữ liệu có tồn tại trong cơ sở dữ liệu hay không
        $this->assertDatabaseHas('products', [
            'barcode'           => $this->product["barcode"],
            'sku'               => $this->product["sku"],
            'price'             => $this->product["wholesale_price"],
            'discount_percentage'  => $this->product["discount_percentage"],
            'featured_image'    => $this->product["featured_image"],
            'inventory_qty'     => $this->product["inventory_number"],
            'category_id'       => $this->product["category"],
            'brand_id'          => $this->product["brand"],
            'created_date'      => $this->product["created_date"],
            'description'       => $this->product["description"],
            'star'              => $this->product["star"],
            'featured'          => $this->product["featured"]
        ]);
    }

    /**
     * test show
     * ./vendor/bin/phpunit tests/Unit/Services/ProductTest.php --filter testShow
    */

    public function testShow()
    {
        $product = $this->productService->create($this->product);

        $found = $this->productService->edit($product->id);

        $this->assertInstanceOf(ViewProduct::class, $found);
        $this->assertEquals($found->name, $product->name);
        $this->assertEquals($found->description, $product->description);
    }

    /**
     * test update
     * ./vendor/bin/phpunit tests/Unit/Services/ProductTest.php --filter testUpdate
    */

    public function testUpdate()
    {
        $productId = 114;

        $productUpdated = $this->productService->update($this->product, $productId);

        // Kiểm tra dữ liệu trả về
        $this->assertInstanceOf(Product::class, $productUpdated);
        $this->assertEquals($productUpdated->name, $this->product['name']);
        $this->assertEquals($productUpdated->description, $this->product['description']);

        // Kiểm tra xem cơ sở dữ liệu đã được cập nhập hay chưa
        $this->assertDatabaseHas('products', [
            'barcode'               => $this->product["barcode"],
            'sku'                   => $this->product["sku"],
            'price'                 => $this->product["wholesale_price"],
            'discount_percentage'   => $this->product["discount_percentage"],
            'featured_image'        => $this->product["featured_image"],
            'inventory_qty'         => $this->product["inventory_number"],
            'category_id'           => $this->product["category"],
            'brand_id'              => $this->product["brand"],
            'created_date'          => $this->product["created_date"],
            'description'           => $this->product["description"],
            'star'                  => $this->product["star"],
            'featured'              => $this->product["featured"]
        ]);
    }

    /**
     * test destroy
     * ./vendor/bin/phpunit tests/Unit/Services/ProductTest.php --filter testDestroy
     */

    public function testDestroy()
    {
        $product = $this->productService->create($this->product);

        $deleteProduct = $this->productService->destroy($product->id);

        // Kiểm tra dữ liệu có trả về true hay không
        $this->assertTrue($deleteProduct);

        // kiểm tra xem dữ liệu đã được xóa trong cơ sở dữ liệu hay chưa
        $this->assertDatabaseMissing('products', $product->toArray());
    }
}
