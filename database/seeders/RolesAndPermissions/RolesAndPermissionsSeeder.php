<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'list utilities']);
        Permission::create(['name' => 'edit utilities']);
        Permission::create(['name' => 'delete utilities']);
        Permission::create(['name' => 'pay utilities']);
        Permission::create(['name' => 'list utility payments']);
        Permission::create(['name' => 'mod list utilities']);
        Permission::create(['name' => 'mod edit utilities']);
        Permission::create(['name' => 'mod delete utilities']);

        $role = Role::create(['name' => 'user'])
            ->givePermissionTo(
                                [
                                    'list utilities',
                                    'edit utilities',
                                    'pay utilities',
                                    'delete utilities',
                                    'list utility payments'
                                ]
                            );

        $role = Role::create(['name' => 'moderator'])
            ->givePermissionTo(
                                [
                                    'mod list utilities', 
                                    'mod edit utilities',
                                    'mod delete utilities'
                                ]
                            );

        $role = Role::create(['name' => 'super-admin']);
        $role->givePermissionTo(Permission::all());


    }
}
