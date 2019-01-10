<?php

namespace Tests\Feature;

use App\Post;
use function factory;
use function route;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostIndexTest extends TestCase
{
    use RefreshDatabase;

    /**
 * A basic test example.
 *
 * @return void
 */
    public function testSeePostRoutesOnIndexPage()
    {
        $this->withoutExceptionHandling();
        $posts = factory(Post::class, 5)->create();

        $response = $this->get('/');

        $response->assertStatus(200);

        foreach ($posts as $post) {
            $response->assertSee(route('posts.show', $post));
        }
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSeeName()
    {

        $posts = factory(Post::class, 5)->create();

        $response = $this->get('/');

        foreach ($posts as $post) {
            $response->assertSee("Пост контроля №". $post->id);
        }
    }

}
