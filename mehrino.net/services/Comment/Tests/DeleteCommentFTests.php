<?php

namespace Services\CommentTests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\CreatesApplication;
use Tests\TestCase;

class DeleteCommentFTests extends TestCase
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
  public function testDELETESuccessTest(): void
  {
    $response = $this->json('DELETE', $this->uri);
    $response->assertStatus(200);
  }
  /**
   *
   * @group Comment
   * @return void
   */
  public function testDELETEFaildTest(): void
  {
    $response = $this->json('DELETE', $this->uri);
    $response->assertStatus(400);
  }

}
