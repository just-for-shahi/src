<?php

namespace Services\EventTests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\CreatesApplication;
use Tests\TestCase;

class CreateEventFTests extends TestCase
{
  use RefreshDatabase, CreatesApplication;
  private $uri = 'api/v1/event';
  protected function setUp(): void
  {
      parent::setUp();
  }

  /**
   *
   * @group Event
   * @return void
   */
  public function testPOSTSuccessTest(): void
  {
    $response = $this->json('POST', $this->uri);
    $response->assertStatus(200);
  }
  /**
   *
   * @group Event
   * @return void
   */
  public function testPOSTFaildTest(): void
  {
    $response = $this->json('POST', $this->uri);
    $response->assertStatus(400);
  }

}
