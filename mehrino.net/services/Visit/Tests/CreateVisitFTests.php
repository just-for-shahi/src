<?php

namespace Services\VisitTests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\CreatesApplication;
use Tests\TestCase;

class CreateVisitFTests extends TestCase
{
  use RefreshDatabase, CreatesApplication;
  private $uri = 'api/v1/visit';
  protected function setUp(): void
  {
      parent::setUp();
  }

  /**
   *
   * @group Visit
   * @return void
   */
  public function testPOSTSuccessTest(): void
  {
    $response = $this->json('POST', $this->uri);
    $response->assertStatus(200);
  }
  /**
   *
   * @group Visit
   * @return void
   */
  public function testPOSTFaildTest(): void
  {
    $response = $this->json('POST', $this->uri);
    $response->assertStatus(400);
  }

}
