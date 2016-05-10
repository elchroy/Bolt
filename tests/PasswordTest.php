<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PasswordTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testForgotPassword()
    {
    	$page = $this->visit('password/reset')
                    ->see('Reset Password')
                    ->see('E-Mail Address')
                    ->type('royaldaddy@example.com', 'email')
                    ->press('Send Password Reset Link')
                    ;
    }

    public function testPasswordEmailReset()
    {
        $this->call('POST', 'password/email');
    }

    public function testRedirectAuthUser()
    {
        $this->createTTModels();
        $user = Bolt\User::find(1);
        $response = $this->actingAs($user)->visit('password/reset')
                        ->seePageIs('/')
                        ;
        $this->assertResponseStatus(200);
        $this->assertResponseOk();
    }

    public function testArtisanInspire()
    {
        $response = Artisan::call('inspire');
        $this->assertEquals(0, $response);
    }

    public function testBasicExample()
    {
        $this->createTTModels();
        $user = Bolt\User::find(1);
        $return = $this->visit('dashboard', ['title' =>'A new title'])
             // ->seeJson([
                 // 'created' => true,
             // ])
            ;
    }
}
