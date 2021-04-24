<?php

namespace Services\CommentTests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\CreatesApplication;
use Tests\TestCase;

class UpdateCommentFTests extends TestCase
{
  use RefreshDatabase, CreatesApplication;
  private $uri = 'api/v1/comment/{id}';
  protected function setUp(): void
  {
      parent::setUp();
  }

  /**
   *
   * @group Comment
   * @return void
   */
  public function testPUTSuccessTest(): void
  {
    $response = $this->json('PUT', $this->uri);
    $response->assertStatus(200);
  }
  /**
   *
   * @group Comment
   * @return void
   */
  public function testPUTFaildTest(): void
  {
    $response = $this->json('PUT', $this->uri);
    $response->assertStatus(400);
  }

}
