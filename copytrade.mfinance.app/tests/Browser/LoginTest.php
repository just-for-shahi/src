<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{

    public function testLogin()
    {
        $this->browse(function ($browser) {
            $browser->visit('/auth/login')
                    ->type('username', 'r2d2')
                    ->type('password', 'asd30lKj')
                    ->press('Login')
                    ->assertPathIs('/');
        });

    }
}