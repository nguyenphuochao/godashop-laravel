<?php

namespace Tests\Feature\Categories;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class GetCategoryTest extends TestCase
{
    /**
     * @test
    */
    public function user_can_get_category_if_category_exists()
    {
        $category = Category::factory()->create();

        $response = $this->getJson(route('api.category.show', $category->id));

        $response->assertStatus(Response::HTTP_OK);

        // kiểm tra có chứa key hay không?
        $response->assertJson(fn(AssertableJson $json) =>
            $json->has('id')
                 ->has('name')
        );
    }

    /**
     * @test
    */
    public function user_can_not_get_category_if_category_not_exists()
    {
        $categoryId = -1;

        $response = $this->getJson(route('api.category.show', $categoryId));

        $response->assertStatus(Response::HTTP_NOT_FOUND);

        // kiểm tra có chứa key hay không?
        $response->assertJson(fn(AssertableJson $json) =>
            $json->has('message')
        );
    }
}
