<?php


class ExtraTest extends TestCase
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

    public function testModelAvailabilityMiddleWare()
    {
        $this->createTTModels();

        $user = Bolt\User::find(1);

        $this->actingAs($user)
                ->visit('videos/1200')
                ->see(404);
    }
}
