<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Category;


class CategoryTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_has_category()
    {
        // $categories = new Category(["test1", "test2"]);
        // $this->assertTrue($categories->has('test1'));

        $category = new Category(['name' => 'test1']);
        $this->assertSame('test1', $category->name);
    }

    public function test_equal()
    {
        $expected = "Hello";
        $actual = "Hello";

        $this->assertEquals(
            $expected,
            $actual,
            "actual value is not equals to expected"
        );
    }

    public function test_contain_category()
    {
        $categories = ["category1", "category2", "category3"];

        $this->assertCount(3, $categories);
        $this->assertContains('category1', $categories);
        $this->assertEmpty(!$categories);
    }
}
