<?php


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

    public function testUserRegistration()
    {
        $this->visit('/register')
            ->type('Roy', 'name')
            ->type('royally@example.com', 'email')
            ->type('teacher', 'password')
            ->type('teacher', 'password_confirmation')
            ->press('Register')
            ->seePageIs('dashboard');
    }

    public function testUserLogin()
    {
        $this->createUser();

        $this->visit('/login')
            ->type('royally@example.com', 'email')
            ->type('teacher', 'password')
            ->press('Login')
            ->seePageIs('dashboard')
            ->see('royally@example.com');
    }

    public function testUserLogout()
    {
        $user = $this->createUser();

        $this->actingAs($user)->visit('/logout')->see('/')->see('Login')->seePageIs('/');
    }

    public function testUserDashboard()
    {
        $user = $this->createUser();

        $this->actingAs($user)
            ->visit('/dashboard')
            ->seePageIs('dashboard');
    }
    
    public function testUserLoginFailsWhenThereIsNoUserWithTheCredentials()
    {
        $this->visit('/login')
            ->type('royally@example.com', 'email')
            ->type('teacher', 'password')
            ->press('Login')
            ->seePageIs('login')
            ->see('These credentials do not match our records.');
    }

    public function notestUserSocialLogin()
    {
        $response = $this->call('GET', 'auth/facebook');
        $target = $response->headers->get('location');
        $expectedTarget = 'https://www.facebook.com';
        $this->assertEquals($expectedTarget, substr($target, 0, 24));
        $this->assertResponseStatus(302);
    }

    public function notestUserChangeAvatar()
    {
        $file = __DIR__.'/def_profile.png';
        $uploadedFile = new Illuminate\Http\UploadedFile($file, 'test.png', 'image/png', 200, null, true);
        $user = $this->createUser();
        $this->actingAs($user)
            ->visit('/dashboard')
            ->attach($uploadedFile, 'file')
            ->press('change-avatar')
            ->seePageIs('dashboard');

        $this->assertResponseStatus(200);
    }

    public function testUserChangeAvatarFails()
    {
        $file = __DIR__.'/pix.jpg';
        $uploadedFile = new Illuminate\Http\UploadedFile($file, 'test.jpg', 'image/jpeg', 200, null, true);
        $user = $this->createUser();
        $this->actingAs($user)
            ->visit('/dashboard')
            ->see('Change Avatar')
            ->attach($uploadedFile, 'file')
            ->press('change-avatar')
            ->seePageIs('dashboard');
        
        $this->assertResponseStatus(200);
    }

    public function testUserEditWithAjax()
    {
        $this->createTTModels();

        $user = Bolt\User::find(1);

        $this->actingAs($user)
            ->visit('/dashboard')
            ->see('Edit Profile')
            ->see('Update')
            ->type('Royale', 'name')
            ->type('royally@example.com', 'email')
            ->press('Update')
            ->seePageIs('dashboard')
            ->see('Royale')
            ->see('royally@example.com');
    }

    public function testUserEdit()
    {
        $this->createTTModels();

        $user = Bolt\User::find(1);

        $this->actingAs($user)
            ->visit('/profile/edit')
            ->see('Edit Profile')
            ->see('Update')
            ->type('Royale', 'name')
            ->type('royally@example.com', 'email')
            ->press('Update')
            ->seePageIs('dashboard')
            ->see('Royale')
            ->see('royally@example.com');
    }

    public function testUserEditValidationFailsForEmptyFields()
    {
        $this->createTTModels();

        $user = Bolt\User::find(1);

        $this->actingAs($user)
            ->visit('/profile/edit')
            ->see('Edit Profile')
            ->see('Update')
            ->type('', 'name')
            ->type('', 'email')
            ->press('Update')
            ->seePageIs('profile/edit')
            ->see('The name field is required.')
            ->see('The email field is required.');
    }

    public function testUserEditFailsForNoAuthenticatedUser()
    {
        $this->visit('/dashboard')
            ->seePageIs('login')
            ->see('Login');
    }
}
