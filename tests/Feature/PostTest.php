<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase; // lets us recreate the database structure by running all the migrations on each single test run

    public function testNoBlogPostsWhenNothingInDatabase()
    {
        $response = $this->get('/posts');

        $response->assertSeeText('No blog posts yet!');
    }

    public function testSee1BlogPostWhereIs1WithNoComments()
    {
        // Arrange
        $post = $this->createDummyBlogPost();

        // Act (action part)
        $response = $this->get('/posts');

        // Assert (result part)
        $response->assertSeeText('New title');
        $response->assertSeeText('No comments yet!');

        $this->assertDatabaseHas('blog_posts', [
            'title' => 'New title'
        ]);
    }

    public function testSee1BlogPostWithComments()
    {
        // arrange
        $post = $this->createDummyBlogPost();
        Comment::factory()->count(4)->create(['blog_post_id' => $post->id]);

        $response = $this->get('/posts');

        $response->assertSeeText('4 comments');
    }

    public function testStoreValid()
    {
        $params = [
            'title' => 'Valid title',
            'content' => 'At least 10 characters'
        ];

        $this->actingAs($this->user())
            ->post('/posts', $params)
            ->assertStatus(302) // 302 is success for redirect
            ->assertSessionHas('status');

        $this->assertEquals(session('status'), 'Blog post was created!');
    }

    public function testStoreFail()
    {
        $params = [
            'title' => 'x',
            'content' => 'x'
        ];

        $this->actingAs($this->user())
            ->post('/posts', $params)
            ->assertStatus(302) // 302 is success for redirect
            ->assertSessionHas('errors');

        $messages = session('errors')->getMessages();

        $this->assertEquals($messages['title'][0], 'The title must be at least 5 characters.');
        $this->assertEquals($messages['content'][0], 'The content must be at least 10 characters.');
    }

    public function testUpdateValid()
    {
        $user = $this->user();
        $post = $this->createDummyBlogPost($user->id);

        $this->assertDatabaseHas('blog_posts', [
            "id" => $post->id,
            "user_id" => $user->id
        ]);


        $params = [
            'title' => 'A new named title',
            'content' => 'Content was changed',
        ];

        $this->actingAs($user)
            ->put("/posts/{$post->id}", $params)
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals(session('status'), 'Blog post was updated!');
        $this->assertDatabaseMissing('blog_posts', $post->toArray());
        $this->assertDatabaseHas('blog_posts', [
            'title' => 'A new named title',
        ]);
    }

    public function testDelete()
    {
        $user = $this->user();
        $post = $this->createDummyBlogPost($user->id);


        // $this->assertDatabaseHas('blog_posts', $post->toArray());

        $this->assertModelExists($post);

        $this->actingAs($user)
            ->delete("/posts/{$post->id}")
            ->assertStatus(302) // 302 is success for redirect
            ->assertSessionHas('status');

        $this->assertEquals(session('status'), 'Blog Post was deleted!');
        // $this->assertDatabaseMissing('blog_posts', $post->toArray());
        $this->assertSoftDeleted($post);
    }

    private function createDummyBlogPost($userId = null): BlogPost
    {
        // $post = new BlogPost();
        // $post->title = 'New title';
        // $post->content = 'Content of the blog post';
        // $post->save();

        return BlogPost::factory()->newTitle()->create([
            'user_id' => $userId ?? $this->user()->id,
        ]);

        // return $post;
    }
}
