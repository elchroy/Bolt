<?php


class CategoryTest extends TestCase
{
    public function testCategoryCreate()
    {
        $this->createTTModels();

        $user = Bolt\User::find(1);
        $this->actingAs($user)
                ->visit('/dashboard')
                ->see('Add Category')
                ->click('#add-category')
                ->seePageIs('categories/add')
                ->type('PHP', 'name')
                ->type('HyperText PreProcessor', 'brief')
                ->press('Add')
                ->seePageIs('/dashboard')
                ->see('PHP')
                ->see('Created');

        $category = Bolt\Category::find(2);
        $brief = $category->brief;
        $this->assertEquals('HyperText PreProcessor', $brief);
    }

    public function testCategoryCreateFailsNoAuth()
    {
        $this->visit('/dashboard')
            ->seePageIs('login');
    }

    public function testCategoryCreateValidationFails()
    {
        $this->createTTModels();

        $user = Bolt\User::find(1);
        $this->actingAs($user)
            ->visit('/dashboard')
            ->see('Add Category')
            ->click('add-category')
            ->seePageIs('categories/add')
            ->type('', 'name')
            ->type('', 'brief')
            ->press('Add')
            ->seePageIs('categories/add')
            ->see('The brief field is required.')
            ->see('The name field is required.');
    }

    public function testCategoryEdit()
    {
        $this->createTTModels();

        $user = Bolt\User::find(1);

        $this->actingAs($user)
            ->visit('/categories/1/edit')
            ->see('Edit Category')
            ->see('MsDotNet')
            ->type('MsDotNetV2', 'name')
            ->type('MicroSoft Network Version 2.', 'brief')
            ->press('Update')
            ->seePageIs('/dashboard')
            ->see('MsDotNetV2')
            ->see('Updated');

        $category = Bolt\Category::find(1);
        $brief = $category->brief;
        $this->assertEquals('MicroSoft Network Version 2.', $brief);
    }

    public function testCategoryEditFailsNoAuth()
    {
        $this->visit('/categories/1/edit')
            ->seePageIs('login');
    }

    public function testCategoryEditWrongOwner()
    {
        $this->createTTModels();

        factory(Bolt\Category::class)->create([
            'name'    => 'PHP',
            'user_id' => 2,
        ]);

        $user = Bolt\User::find(1);

        $this->actingAs($user)
                ->visit('/categories/2/edit')
                ->seePageIs('dashboard')
                ->see('MsDotNet');
    }

    public function testCategoryEditValidationFails()
    {
        $this->createTTModels();

        $user = Bolt\User::find(1);
        
        $this->actingAs($user)
            ->visit('categories/1/edit')
            ->see('Edit Category')
            ->see('MsDotNet')
            ->see('This section deals with lessons on MsDotNet.')
            ->type('', 'name')
            ->type('', 'brief')
            ->press('Update')
            ->seePageIs('categories/1/edit')
            ->see('The brief field is required.')
            ->see('The name field is required.');
    }

    public function testCategoryEditValidationFailsDuplicate()
    {
        $this->createTTModels();

        factory(Bolt\Category::class)->create([
            'name'    => 'PHP',
            'user_id' => 2,
        ]);

        $user = Bolt\User::find(1);
        $this->actingAs($user)
            ->visit('categories/1/edit')
            ->see('Edit Category')
            ->see('MsDotNet')
            ->see('This section deals with lessons on MsDotNet.')
            ->type('PHP', 'name')
            ->type('', 'brief')
            ->press('Update')
            ->seePageIs('categories/1/edit')
            ->see('The brief field is required.')
            ->see('The name has already been taken.');
    }

    public function testCategoryShow()
    {
        $this->createTTModels();

        $this->visit('categories/1')
            ->see('MsDotNet')
            ->see('A Introduction to MsDotNet');
    }

    public function testCategoryIndex()
    {
        $this->createTTModels();

        factory(Bolt\Category::class)->create([
            'name'    => 'PHP',
            'user_id' => 2,
        ]);

        $user = Bolt\User::find(1);

        $this->actingAs($user)->visit('/categories')
            ->see('PHP')
            ->see('MsDotNet');
    }

    public function testCategoryCreateDetails()
    {
        $this->createTTModels();

        $category = Bolt\Category::find(1);
        $user = Bolt\User::find(1);

        $catUser = $category->user;
        $this->assertEquals($user, $catUser);
        $this->assertEquals(1, $category->numberOfVideos());
    }
}
