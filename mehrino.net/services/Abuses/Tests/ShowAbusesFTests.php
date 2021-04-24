<?php

namespace Services\AbusesTests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\CreatesApplication;
use Tests\TestCase;

class ShowAbusesFTests extends TestCase
{
  use RefreshDatabase, CreatesApplication;
  private $uri = 'api/v1/abuses/{id}';
  protected function setUp(): void
  {
      parent::setUp();
  }

  /**
   *
   * @group Abuses
   * @return void
   */
  public function testGETSuccessTest(): void
  {
    $response = $this->json('GET', $this->uri);
    $response->assertStatus(200);
  }
  /**
   *
   * @group Abuses
   * @return void
   */
  public function testGETFaildTest(): void
  {
    $response = $this->json('GET', $this->uri);
    $response->assertStatus(400);
  }

}
