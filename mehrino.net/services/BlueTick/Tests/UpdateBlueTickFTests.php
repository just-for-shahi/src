<?php

namespace Services\BlueTickTests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\CreatesApplication;
use Tests\TestCase;

class UpdateBlueTickFTests extends TestCase
{
  use RefreshDatabase, CreatesApplication;
  private $uri = 'api/v1/bluetick/{id}';
  protected function setUp(): void
  {
      parent::setUp();
  }

  /**
   *
   * @group BlueTick
   * @return void
   */
  public function testPUTSuccessTest(): void
  {
    $response = $this->json('PUT', $this->uri);
    $response->assertStatus(200);
  }
  /**
   *
   * @group BlueTick
   * @return void
   */
  public function testPUTFaildTest(): void
  {
    $response = $this->json('PUT', $this->uri);
    $response->assertStatus(400);
  }

}
