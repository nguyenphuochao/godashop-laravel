<?php

namespace Tests\Feature\Categories;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class CreateCategoryTest extends TestCase
{
    /**
     * @test
     *
     */
    public function user_can_create_categiry_if_data_is_valid()
    {
        $dataCreate = [
            'name' => $this->faker->name
        ];

        $response = $this->json('POST', route('api.category.store', $dataCreate));

        $response->assertStatus(Response::HTTP_CREATED);

        $response->assertJson(fn(AssertableJson $json) =>
            $json->where('name', $dataCreate['name'])
        );

        // check trong db có data hay không?
        $this->assertDatabaseHas('categories', [
            'name' => $dataCreate['name']
        ]);
    }

    /**
     * @test
     *
     */
    public function user_can_not_create_category_if_name_is_null()
    {
        $dataCreate = [
            'name' => ''
        ];

        $response = $this->json('POST', route('api.category.store', $dataCreate));

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $response->assertJson(fn(AssertableJson $json) =>
            $json->has('message')
                 ->has('errors', fn(AssertableJson $json) =>
                    $json->has('name')->etc()
                )
        );
    }
}
