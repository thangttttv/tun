<?php

use App\Models\AdminUserRole;
use Illuminate\Database\Seeder;
use App\Repositories\CategoryRepositoryInterface;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        /** @var \App\Repositories\CategoryRepositoryInterface $adminUserRepository */
        $categoryReposity = \App::make('App\Repositories\CategoryRepositoryInterface');

        $category = $categoryReposity->create([
            'name'     => 'IT',
        ]);

        $category = $categoryReposity->create([
            'name'     => 'Travel',
        ]);

        $category = $categoryReposity->create([
            'name'     => 'Sport',
        ]);

        $category = $categoryReposity->create([
            'name'     => 'Farm',
        ]);

        $category = $categoryReposity->create([
            'name'     => 'Music',
        ]);

        $category = $categoryReposity->create([
            'name'     => 'Boy',
        ]);

        $category = $categoryReposity->create([
            'name'     => 'Girl',
        ]);

        $category = $categoryReposity->create([
            'name'     => 'Gym',
        ]);
    }
}