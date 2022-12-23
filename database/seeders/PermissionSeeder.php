<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name'=>'list_all']);
        Permission::create(['name'=>'detailed_list']);
        Permission::create(['name'=>'new_movies']);
        Permission::create(['name'=>'edit_info']);
        Permission::create(['name'=>'delete_movie']);

        $roleAdmin=Role::create(['name' => 'admin']);
        $roleCustomer=Role::create(['name' => 'customer']);

        $roleAdmin->givePermissionto([
            'list_all',
            'detailed_list',
            'new_movies',
            'edit_info',
            'delete_movie'
        ]);

        $roleCustomer->givePermissionto([
            'list_all',
            'detailed_list'
        ]);
    }
}
