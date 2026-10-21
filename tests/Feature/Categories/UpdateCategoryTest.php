<?php

namespace Tests\Feature\Categories;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class UpdateCategoryTest extends TestCase
{
    /**
     * @test
     *
     */
    public function user_can_update_category_if_category_exists()
    {
        $category = Category::factory()->create();

        $dataUpdate = [
            'name' => $this->faker->name
        ];

        $response = $this->json('PUT', route('api.category.update', $category->id), $dataUpdate);

        $response->assertStatus(Response::HTTP_OK);

        $response->assertJson(fn(AssertableJson $json) =>
            $json->has('message')
                 ->has('data', fn(AssertableJson $json) =>
                    $json->where('name', $dataUpdate['name'])->etc()
                )
        );

        // check trong db có data hay không?
        $this->assertDatabaseHas('categories', [
            'name' => $dataUpdate['name']
        ]);
    }

    /**
     * @test
     */
    public function user_can_not_update_category_if_category_not_exists()
    {
        $categoryId = -99;

        $dataUpdate = [
            'name' => $this->faker->name
        ];

        $response = $this->json('PUT', route('api.category.update', $categoryId), $dataUpdate);

        $response->assertStatus(Response::HTTP_NOT_FOUND);

        $response->assertJson(fn(AssertableJson $json) =>
            $json->has('message')
        );
    }
}
