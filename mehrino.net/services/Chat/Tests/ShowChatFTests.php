<?php

namespace Services\ChatTests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\CreatesApplication;
use Tests\TestCase;

class ShowChatFTests extends TestCase
{
  use RefreshDatabase, CreatesApplication;
  private $uri = 'api/v1/chat/{id}';
  protected function setUp(): void
  {
      parent::setUp();
  }

  /**
   *
   * @group Chat
   * @return void
   */
  public function testGETSuccessTest(): void
  {
    $response = $this->json('GET', $this->uri);
    $response->assertStatus(200);
  }
  /**
   *
   * @group Chat
   * @return void
   */
  public function testGETFaildTest(): void
  {
    $response = $this->json('GET', $this->uri);
    $response->assertStatus(400);
  }

}
