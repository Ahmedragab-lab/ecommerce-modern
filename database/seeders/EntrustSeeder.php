<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EntrustSeeder extends Seeder
{

    public function run()
    {
        $faker = Factory::create();
        $adminRole = Role::create([
            'name'         => 'admin',
            'display_name' => 'adminstration',
            'description'  => 'adminstrator',
            'allowed_route' => 'admin',
        ]);
        $supervisorRole = Role::create([
            'name'         => 'supervisor',
            'display_name' => 'Supervisor',
            'description'  => 'Supervisor',
            'allowed_route' => 'admin',
        ]);
        $customerRole = Role::create([
            'name'         => 'customer',
            'display_name' => 'Customer',
            'description'  => 'Customer',
            'allowed_route' => null,
        ]);
        $admin = User::create([
            'firstname'         => 'ahmed',
            'lastname'          => 'ragab',
            'phone'             => '01021493036',
            'email'             => 'admin@app.com',
            'password'          => bcrypt('123123'),
            'image'             => 'avatar.svg',
            'status'            => 1,
            'remember_token'     => Str::random(10),
        ]);
        $admin->attachRole($adminRole);

        $supervisor = User::create([
            'firstname'         => 'super',
            'lastname'          => 'ecommerce',
            'phone'             => '01000000000',
            'email'             => 'super@app.com',
            'password'          => bcrypt('123123'),
            'image'             => 'avatar.svg',
            'status'            => 1,
            'remember_token'     => Str::random(10),
        ]);
        $supervisor->attachRole($supervisorRole);
        $user = User::create([
            'firstname'         => 'user',
            'lastname'          => 'ecommerce',
            'phone'             => '01199999999',
            'email'             => 'user@app.com',
            'password'          => bcrypt('123123'),
            'image'             => 'avatar.svg',
            'status'            => 1,
            'remember_token'     => Str::random(10),
        ]);
        $user->attachRole($customerRole);

        for ($i = 1; $i <= 20; $i++) {
            $random_user = User::create([
                'firstname'         => $faker->firstname,
                'lastname'          => $faker->lastname,
                'phone'             => '010' . $faker->numberBetween(10000000, 99999999),
                'email'             => $faker->unique()->safeEmail,
                'password'          => bcrypt('123123'),
                'image'             => 'avatar.svg',
                'status'            => 1,
                'remember_token'     => Str::random(10),
            ]);
            $random_user->attachRole($customerRole);
        }

        $manageMain = Permission::create([
            'name'            => 'main',
            'display_name'    => 'Main',
            'description'     => '',
            'route'           => 'dashboard',
            'module'          => 'dashboard',
            'as'              => 'dashboard',
            'icon'            => 'la la-home',
            'parent'          => '0',
            'parent_original' => '0',
            'sidebar_link'    => '1',
            'appear'          => '1',
            'ordering'        => '1',
        ]);
        $manageMain->parent_show = $manageMain->id;
        $manageMain->save();

        //Products Categories
        $manageProductCategories = Permission::create([
            'name'            => 'manage_product_categories',
            'display_name'    => 'Categories',
            'route'           => 'product_categories',
            'module'          => 'product_categories',
            'as'              => 'product_categories.index',
            'icon'            => 'fas fa-file-archive',
            'parent'          => '0',
            'parent_original' => '0',
            'sidebar_link'    => '1',
            'appear'          => '1',
            'ordering'        => '5',
        ]);
        $manageProductCategories->parent_show = $manageProductCategories->id;
        $manageProductCategories->save();
        $showProductCategories = Permission::create([
            'name'            => 'show_product_categories',
            'display_name'    => 'Categories',
            'route'           => 'product_categories',
            'module'          => 'product_categories',
            'as'              => 'product_categories.index',
            'icon'            => 'fas fa-file-archive',
            'parent'          => $manageProductCategories->id,
            'parent_original' => $manageProductCategories->id,
            'parent_show'     => $manageProductCategories->id,
            'sidebar_link'    => '1',
            'appear'          => '1'
        ]);
        $createProductCategories  = Permission::create(['name' => 'create_product_categories', 'display_name' => 'Create Category', 'route' => 'product_categories', 'module' => 'product_categories', 'as' => 'product_categories.create', 'icon' => null, 'parent' => $manageProductCategories->id, 'parent_original' => $manageProductCategories->id, 'parent_show' => $manageProductCategories->id, 'sidebar_link' => '1', 'appear' => '0']);
        $displayProductCategories = Permission::create(['name' => 'display_product_categories', 'display_name' => 'Show Category', 'route' => 'product_categories', 'module' => 'product_categories', 'as' => 'product_categories.show', 'icon' => null, 'parent' => $manageProductCategories->id, 'parent_original' => $manageProductCategories->id, 'parent_show' => $manageProductCategories->id, 'sidebar_link' => '1', 'appear' => '0']);
        $updateProductCategories  = Permission::create(['name' => 'update_product_categories', 'display_name' => 'Update Category', 'route' => 'product_categories', 'module' => 'product_categories', 'as' => 'product_categories.edit', 'icon' => null, 'parent' => $manageProductCategories->id, 'parent_original' => $manageProductCategories->id, 'parent_show' => $manageProductCategories->id, 'sidebar_link' => '1', 'appear' => '0']);
        $deleteProductCategories  = Permission::create(['name' => 'delete_product_categories', 'display_name' => 'Delete Category', 'route' => 'product_categories', 'module' => 'product_categories', 'as' => 'product_categories.destroy', 'icon' => null, 'parent' => $manageProductCategories->id, 'parent_original' => $manageProductCategories->id, 'parent_show' => $manageProductCategories->id, 'sidebar_link' => '1', 'appear' => '0']);
    }
}
