<?php

class ExtraTest extends TestCase
{
    /**
     * Test the home page of the application.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->visit('/')
            ->see('Bolt');
    }

    public function testModelAvailabilityMiddleWareWhenModelIDIsNotAvailable()
    {
        $this->createTTModels();

        $user = Bolt\User::find(1);

        $this->actingAs($user)
            ->visit('videos/1200')
            ->see(404);
    }
}
