<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CategoryTest extends TestCase
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

    public function testCategoryCreate()
    {
    	$this->createTTModels();

    	$user = Bolt\User::find(1);
    	$page = $this->actingAs($user)
    			->visit('/dashboard')
    			->see('Add Category')
    			->click('#add-category')
    			->seePageIs('categories/add')
    			// ->type('PHP', 'name')
    			// ->type('HyperText PreProcessor', 'brief')
    			// ->press('Add')
    			// ->seePageIs('/dashboard')
    			// ->see('PHP')
    			// ->see('Created')
    			;
        // dd($page);
    	// $category = Bolt\Category::find(2);
    	// $brief = $category->brief;
    	// $this->assertEquals('HyperText PreProcessor', $brief);
    }
    
	public function testCategoryCreateFailsNoAuth()
	{
		$this->visit('/dashboard')
			->seePageIs('login')
			;
	}
    
	public function testCategoryCreateValidationFails()
	{
		$this->createTTModels();

    	$user = Bolt\User::find(1);
    	$this->actingAs($user)
    			->visit('/dashboard')
    			->see('Add Category')
    			->click('add-category')
    			// ->seePageIs('categories/add')
    			// ->type('', 'name')
    			// ->type('', 'brief')
    			// ->press('Add')
    			// ->seePageIs('categories/add')
    			// ->see('The brief field is required.')
    			// ->see('The name field is required.')
    			;
	}
    
	public function testCategoryEdit()
	{
		$this->createTTModels();

    	$user = Bolt\User::find(1);
    	$category = Bolt\Category::find(1);
    	$this->actingAs($user)
    			->visit('/categories/1/edit')
    			->see('Edit Category')
    			->see('MsDotNet')
    			->type('MsDotNetV2', 'name')
    			->type('MicroSoft Network Version 2.', 'brief')
    			->press('Update')
    			->seePageIs('/dashboard')
    			->see('MsDotNetV2')
    			->see('Updated')
    			;

    	$category = Bolt\Category::find(1);
    	$brief = $category->brief;
    	$this->assertEquals('MicroSoft Network Version 2.', $brief);
	}
    
	public function testCategoryEditFailsNoAuth()
	{
		$this->visit('/categories/1/edit')
			->seePageIs('login')
			;
	}
    
	public function testCategoryEditWrongOwner()
	{
		$this->createTTModels();
		factory(Bolt\Category::class)->create([
			'name' => 'PHP',
			'user_id' => 2
		]);

		$user = Bolt\User::find(1);
    	
    	$this->actingAs($user)
    			->visit('/categories/2/edit')
    			->seePageIs('dashboard')
    			->see('MsDotNet')
    			;
	}
    
	public function notestCategoryEditValidationFails()
	{
		// This tests is for update failure. The same problem with including the validation for the update category function.method.
		$this->createTTModels();

    	$user = Bolt\User::find(1);
    	$this->actingAs($user)
    			->visit('categories/1/edit')
    			->see('Edit Category')
    			->see('MsDotNet')
    			->see('This section deals with lessons on MsDotNet.')
    			->type('', 'name')
    			->type('', 'brief')
    			->press('Add')
    			->seePageIs('categories/1/edit')
    			->see('The brief field is required.')
    			->see('The name field is required.')
    			;
	}
    
	public function testCategoryShow()
	{
		$this->createTTModels();

		$this->visit('categories/1')
			->see('MsDotNet')
			->see('A Introduction to MsDotNet')
			;
	}
    
	// public function testCategoryCreate();
    
	// public function testCategoryCreate();
    
	// public function testCategoryCreate();
    
	// public function testCategoryCreate();
    
	// public function testCategoryCreate();
    
	// public function testCategoryCreate();
    

}
