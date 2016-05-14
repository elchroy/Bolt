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

    public function testUserChangeAvatar()
    {
        $file = __DIR__ . '/def_profile.png';
        $uploadedFile = new Illuminate\Http\UploadedFile($file, 'test.png', 'image/png', 200, null, true);
        $user = $this->createUser();
        $page = $this->actingAs($user)
                ->visit('/dashboard')
                // ->click('Change Avatar')
                ->attach($uploadedFile, 'file')
                ->press('submit-new-avatar')
                ->seePageIs('dashboard')
                ;
        $this->assertResponseStatus(200);
    }

    public function testUserChangeAvatarFails()
    {
        $file = __DIR__ . '/pix.jpg';
        $uploadedFile = new Illuminate\Http\UploadedFile($file, 'test.jpg', 'image/jpeg', 200, null, true);
        $user = $this->createUser();
        $page = $this->actingAs($user)
                ->visit('/dashboard')
                ->see('Change Avatar')
                // ->click('Change Avatar')
                ->attach($uploadedFile, 'file')
                ->press('submit-new-avatar')
                ->seePageIs('dashboard')
                ;
        $page = $this->assertResponseStatus(200);
    }

    public function testUserEdit()
    {
        $this->createTTModels();
        $user = Bolt\User::find(1);
        
        $page = $this->actingAs($user)
            ->visit('/dashboard')
            ->see('Edit Profile')
            ->see('Update')
            ->type('Royale', 'name')
            ->type('royally@example.com', 'email')
            ->press('Update')
            ->seePageIs('dashboard')
            ->see('Royale')
            ->see('royally@example.com')
            ;
    }

    public function testUserEditNoAuth()
    {   
        $page = $this->visit('/dashboard')
            ->seePageIs('login')
            
            ->see('Login')
            ;
    }
}
