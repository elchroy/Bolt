<?php


class PasswordTest extends TestCase
{
    public function testForgotPassword()
    {
        $this->visit('password/reset')
            ->see('Reset Password')
            ->see('E-Mail Address')
            ->type('royaldaddy@example.com', 'email')
            ->press('Send Password Reset Link');
    }

    public function testPasswordEmailReset()
    {
        $this->call('POST', 'password/email');
    }

    public function testRedirectAuthUser()
    {
        $this->createTTModels();

        $user = Bolt\User::find(1);
        $response = $this->actingAs($user)->visit('password/reset')->seePageIs('/');

        $this->assertResponseStatus(200);
        $this->assertResponseOk();
    }
}
