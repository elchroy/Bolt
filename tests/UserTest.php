<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
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

    public function testUserRegisteration()
    {	
    	$page = $this->visit('/register')
    					->type('Roy', 'name')
    					->type('royally@example.com', 'email')
    					->type('teacher', 'password')
    					->type('teacher', 'password_confirmation')
    					->press('Register')
    					->seePageIs('dashboard')
    					// ->see('Your Favored Videos')
    					;
    }

    public function testUserLogin()
    {
    	$user = $this->createUser();
    	$page = $this->visit('/login')
    					->type('royally@example.com', 'email')
    					->type('teacher', 'password')
    					->press('Login')
    					->seePageIs('dashboard')
    					// ->see('royally@example.com')
    					;
    }

    public function testUserLogout()
    {
	    $page = $this->visit('/logout')
	    				->see('Login')
	    				;
    }

    public function testUserDashboard()
    {
        $user = $this->createUser();
        $this->actingAs($user)
            ->visit('/dashboard')
            ->seePageIs('dashboard')
            ;
    }

    public function testUserLoginFails()
    {
    	$page = $this->visit('/login')
    					->type('royally@example.com', 'email')
    					->type('teacher', 'password')
    					->press('Login')
    					->seePageIs('login')
    					// ->see('These credentials do not match our records.')
    					;
    }

    public function testUserSocialLogin()
    {
        $response = $this->call('GET', 'auth/facebook');
        $target = $response->headers->get('location');
        $expectedTarget = 'https://www.facebook.com/v2.5/dialog/oauth?client_id=';
        $this->assertEquals($expectedTarget, substr($target, 0, 53));
        $this->assertResponseStatus(302);
    }
}
