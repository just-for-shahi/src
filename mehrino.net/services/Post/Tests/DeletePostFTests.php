<?php

namespace Services\PostTests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\CreatesApplication;
use Tests\TestCase;

class DeletePostFTests extends TestCase
{
  use RefreshDatabase, CreatesApplication;
  private $uri = 'api/v1/post/{id}';
  protected function setUp(): void
  {
      parent::setUp();
  }

  /**
   *
   * @group Post
   * @return void
   */
  public function testDELETESuccessTest(): void
  {
    $response = $this->json('DELETE', $this->uri);
    $response->assertStatus(200);
  }
  /**
   *
   * @group Post
   * @return void
   */
  public function testDELETEFaildTest(): void
  {
    $response = $this->json('DELETE', $this->uri);
    $response->assertStatus(400);
  }

}
