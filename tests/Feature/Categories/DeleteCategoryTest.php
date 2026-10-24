<?php

namespace Tests\Feature\Categories;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class DeleteCategoryTest extends TestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function user_can_delete_category_if_category_exists()
    {
        $category = Category::factory()->create();

        $categoryCountBeforeDelete = Category::count();

        $response = $this->json('DELETE', route('api.categories.destroy', $category->id));

        $categoryCountAfterDelete = Category::count();

        $response->assertStatus(Response::HTTP_NO_CONTENT);

        $this->assertEquals($categoryCountBeforeDelete - 1, $categoryCountAfterDelete);
    }
}
