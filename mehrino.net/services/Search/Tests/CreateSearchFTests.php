<?php

namespace Services\SearchTests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\CreatesApplication;
use Tests\TestCase;

class CreateSearchFTests extends TestCase
{
  use RefreshDatabase, CreatesApplication;
  private $uri = 'api/v1/search';
  protected function setUp(): void
  {
      parent::setUp();
  }

  /**
   *
   * @group Search
   * @return void
   */
  public function testPOSTSuccessTest(): void
  {
    $response = $this->json('POST', $this->uri);
    $response->assertStatus(200);
  }
  /**
   *
   * @group Search
   * @return void
   */
  public function testPOSTFaildTest(): void
  {
    $response = $this->json('POST', $this->uri);
    $response->assertStatus(400);
  }

}
