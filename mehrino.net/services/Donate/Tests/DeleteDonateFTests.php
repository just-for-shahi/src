<?php

namespace Services\DonateTests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\CreatesApplication;
use Tests\TestCase;

class DeleteDonateFTests extends TestCase
{
  use RefreshDatabase, CreatesApplication;
  private $uri = 'api/v1/donate/{id}';
  protected function setUp(): void
  {
      parent::setUp();
  }

  /**
   *
   * @group Donate
   * @return void
   */
  public function testDELETESuccessTest(): void
  {
    $response = $this->json('DELETE', $this->uri);
    $response->assertStatus(200);
  }
  /**
   *
   * @group Donate
   * @return void
   */
  public function testDELETEFaildTest(): void
  {
    $response = $this->json('DELETE', $this->uri);
    $response->assertStatus(400);
  }

}
