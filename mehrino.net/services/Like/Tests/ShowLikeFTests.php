<?php

namespace Services\LikeTests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\CreatesApplication;
use Tests\TestCase;

class ShowLikeFTests extends TestCase
{
  use RefreshDatabase, CreatesApplication;
  private $uri = 'api/v1/like/{id}';
  protected function setUp(): void
  {
      parent::setUp();
  }

  /**
   *
   * @group Like
   * @return void
   */
  public function testGETSuccessTest(): void
  {
    $response = $this->json('GET', $this->uri);
    $response->assertStatus(200);
  }
  /**
   *
   * @group Like
   * @return void
   */
  public function testGETFaildTest(): void
  {
    $response = $this->json('GET', $this->uri);
    $response->assertStatus(400);
  }

}
