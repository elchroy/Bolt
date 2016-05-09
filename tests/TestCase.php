<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    /**
     * Default preparation for each test
     */
    public function setUp()
    {
        parent::setUp();
     
        $this->prepareForTests();
    }

    /**
     * Migrates the database and set the mailer to 'pretend'.
     * This will cause the tests to run quickly.
     */
    private function prepareForTests()
    {
        Artisan::call('migrate');
    }

    protected function createUser()
    {
        $user = factory(Bolt\User::class)->create([
            'name'      => 'roy',
            'email'     => 'royally@example.com',
            'password'  => bcrypt('teacher'),
        ]);
        return $user;
    }

    protected function createCategory()
    {
        $category = factory(Bolt\Category::class)->create([
            'name'      => 'MsDotNet',
            'user_id'   => 1,
            'brief'     => 'This section deals with lessons on MsDotNet.'
        ]);
        return $category;
    }

    protected function createVideo()
    {
        $this->createCategory();
        $video = $this->createUser()->videos()->create([
            'title'         => 'A Introduction to MsDotNet',
            'url'           => 'https://www.youtube.com/watch?v=wCA6jCUbaFQ',
            'description'   => 'This is an introduction to the Microsoft DotNet Framework. It is very powerful.',
            'category_id'   => 1,
        ]);
        return $video;
    }

    // public function createComment()
    // {
    //     $comment = factory(TeachTech\Comment::class)->create([
    //         'comment'   => 'Very nice introduction to the MS-Dot-Net Framework.',
    //         'video_id'  => 1,
    //         'user_id'   => 1,
    //     ]);
    //     return $comment;
    // }

    public function createTTModels()
    {
        $this->createVideo();
        // $this->createComment();
    }

    // public function createFavoriteFor($model)
    // {
    //     $favorite = factory(TeachTech\Favorite::class)->create([
    //         'user_id' => 1,
    //         'favoritable_id'    => 1,
    //         'favoritable_type'  => get_class($model),
    //         'status'            => 1,
    //     ]);

    //     return $favorite;
    // }
}
