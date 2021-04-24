<?php

namespace Services\TagTests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\CreatesApplication;
use Tests\TestCase;

class DeleteTagFTests extends TestCase
{
  use RefreshDatabase, CreatesApplication;
  private $uri = 'api/v1/tag/{id}';
  protected function setUp(): void
  {
      parent::setUp();
  }

  /**
   *
   * @group Tag
   * @return void
   */
  public function testDELETESuccessTest(): void
  {
    $response = $this->json('DELETE', $this->uri);
    $response->assertStatus(200);
  }
  /**
   *
   * @group Tag
   * @return void
   */
  public function testDELETEFaildTest(): void
  {
    $response = $this->json('DELETE', $this->uri);
    $response->assertStatus(400);
  }

}
