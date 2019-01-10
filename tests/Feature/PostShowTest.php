<?php

namespace Tests\Feature;

use App\Post;
use App\Sensor;
use function factory;
use function route;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostShowTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSeeFullName()
    {
        $this->withoutExceptionHandling();

        $post = factory(Post::class)->create([]);

        $response = $this->get($post->url);

        $response->assertStatus(200);

        $response->assertSee($post->full_name);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSeePostSensorsName()
    {
        $this->withoutExceptionHandling();

        $post = factory(Post::class)->create();
        factory(Sensor::class, 3)->create([
            'post_id' => $post->id
        ]);

        $response = $this->get($post->url);

        $response->assertStatus(200);

        foreach ($post->sensors as $sensor) {
            $response->assertSee($sensor->type->name);
        }
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSeeSensorValue()
    {
        $this->withoutExceptionHandling();

        $post = factory(Post::class)->create([]);

        $response = $this->get($post->url);

        $response->assertStatus(200);

        foreach ($post->sensors as $sensor) {
            $response->assertSee($sensor->value);
        }
    }

}
