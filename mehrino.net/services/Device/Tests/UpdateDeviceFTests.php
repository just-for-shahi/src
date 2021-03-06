<?php

namespace Services\DeviceTests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\CreatesApplication;
use Tests\TestCase;

class UpdateDeviceFTests extends TestCase
{
  use RefreshDatabase, CreatesApplication;
  private $uri = 'api/v1/device/{id}';
  protected function setUp(): void
  {
      parent::setUp();
  }

  /**
   *
   * @group Device
   * @return void
   */
  public function testPUTSuccessTest(): void
  {
    $response = $this->json('PUT', $this->uri);
    $response->assertStatus(200);
  }
  /**
   *
   * @group Device
   * @return void
   */
  public function testPUTFaildTest(): void
  {
    $response = $this->json('PUT', $this->uri);
    $response->assertStatus(400);
  }

}
