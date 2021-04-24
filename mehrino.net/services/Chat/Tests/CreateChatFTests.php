<?php

namespace Services\ChatTests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\CreatesApplication;
use Tests\TestCase;

class CreateChatFTests extends TestCase
{
  use RefreshDatabase, CreatesApplication;
  private $uri = 'api/v1/chat';
  protected function setUp(): void
  {
      parent::setUp();
  }

  /**
   *
   * @group Chat
   * @return void
   */
  public function testPOSTSuccessTest(): void
  {
    $response = $this->json('POST', $this->uri);
    $response->assertStatus(200);
  }
  /**
   *
   * @group Chat
   * @return void
   */
  public function testPOSTFaildTest(): void
  {
    $response = $this->json('POST', $this->uri);
    $response->assertStatus(400);
  }

}
