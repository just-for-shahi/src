<?php

namespace Services\BankAccountTests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\CreatesApplication;
use Tests\TestCase;

class ShowBankAccountFTests extends TestCase
{
  use RefreshDatabase, CreatesApplication;
  private $uri = 'api/v1/bankaccount/{id}';
  protected function setUp(): void
  {
      parent::setUp();
  }

  /**
   *
   * @group BankAccount
   * @return void
   */
  public function testGETSuccessTest(): void
  {
    $response = $this->json('GET', $this->uri);
    $response->assertStatus(200);
  }
  /**
   *
   * @group BankAccount
   * @return void
   */
  public function testGETFaildTest(): void
  {
    $response = $this->json('GET', $this->uri);
    $response->assertStatus(400);
  }

}
