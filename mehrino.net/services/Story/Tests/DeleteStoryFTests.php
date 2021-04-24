<?php

namespace Services\StoryTests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\CreatesApplication;
use Tests\TestCase;

class DeleteStoryFTests extends TestCase
{
  use RefreshDatabase, CreatesApplication;
  private $uri = 'api/v1/story/{id}';
  protected function setUp(): void
  {
      parent::setUp();
  }

  /**
   *
   * @group Story
   * @return void
   */
  public function testDELETESuccessTest(): void
  {
    $response = $this->json('DELETE', $this->uri);
    $response->assertStatus(200);
  }
  /**
   *
   * @group Story
   * @return void
   */
  public function testDELETEFaildTest(): void
  {
    $response = $this->json('DELETE', $this->uri);
    $response->assertStatus(400);
  }

}
