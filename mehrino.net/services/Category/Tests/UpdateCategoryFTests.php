<?php

namespace Services\CategoryTests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\CreatesApplication;
use Tests\TestCase;

class UpdateCategoryFTests extends TestCase
{
  use RefreshDatabase, CreatesApplication;
  private $uri = 'api/v1/category/{id}';
  protected function setUp(): void
  {
      parent::setUp();
  }

  /**
   *
   * @group Category
   * @return void
   */
  public function testPUTSuccessTest(): void
  {
    $response = $this->json('PUT', $this->uri);
    $response->assertStatus(200);
  }
  /**
   *
   * @group Category
   * @return void
   */
  public function testPUTFaildTest(): void
  {
    $response = $this->json('PUT', $this->uri);
    $response->assertStatus(400);
  }

}
