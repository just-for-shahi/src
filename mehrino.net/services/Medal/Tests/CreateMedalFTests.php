<?php

namespace Services\MedalTests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\CreatesApplication;
use Tests\TestCase;

class CreateMedalFTests extends TestCase
{
  use RefreshDatabase, CreatesApplication;
  private $uri = 'api/v1/medal';
  protected function setUp(): void
  {
      parent::setUp();
  }

  /**
   *
   * @group Medal
   * @return void
   */
  public function testPOSTSuccessTest(): void
  {
    $response = $this->json('POST', $this->uri);
    $response->assertStatus(200);
  }
  /**
   *
   * @group Medal
   * @return void
   */
  public function testPOSTFaildTest(): void
  {
    $response = $this->json('POST', $this->uri);
    $response->assertStatus(400);
  }

}
