<?php

namespace Tests\Feature\Categories;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class GetListCategoryTest extends TestCase
{
    /**
     * @test
     * phpunit --filter user_can_get_list_category
     * php artisan test --filter user_can_get_list_category
     */
    public function user_can_get_list_category()
    {
        $categoryCount = Category::count();
        $response = $this->getJson(route('api.category.index'));

        // kiểm tra trạng thái status là 200
        $response->assertStatus(Response::HTTP_OK);

        // kiểm tra có chứa key hay không?
        $response->assertJson(fn(AssertableJson $json) =>
            $json->has('data')
                 ->has('links')
                 ->has('current_page')
                 ->has('per_page')
                 ->where('total', $categoryCount)->etc()
        );
    }
}
