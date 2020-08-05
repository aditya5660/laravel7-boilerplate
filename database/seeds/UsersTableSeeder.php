<?php

use App\Models\Navigation;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Role
        $role = Role::create(['name' => 'super-admin']);
        // Create Permissions
        $permission = Permission::create(['name'=>'read-dashboard']);
        $permission->syncRoles($role);
        $permission = Permission::create(['name'=>'read-user']);
        $permission->syncRoles($role);
        $permission = Permission::create(['name'=>'read-role']);
        $permission->syncRoles($role);
        $permission = Permission::create(['name'=>'read-navigation']);
        $permission->syncRoles($role);
        $permission = Permission::create(['name'=>'read-permission']);
        $permission->syncRoles($role);
        // Create Navigation
        Navigation::create([
            'parent_id' => '0',
            'url' => 'admin/dashboard',
            'icon' => 'las la-home',
            'name' => 'Dashboard',
            'order' => '1',
            'permission_name' => 'read-dashboard',
        ]);
        Navigation::create([
            'parent_id' => '0',
            'url' => 'admin/users',
            'icon' => 'las la-users',
            'name' => 'User',
            'order' => '1',
            'permission_name' => 'read-user',
        ]);
        Navigation::create([
            'parent_id' => '0',
            'url' => 'admin/roles',
            'icon' => 'las la-user-cog',
            'name' => 'Role',
            'order' => '2',
            'permission_name' => 'read-role',
        ]);
        Navigation::create([
            'parent_id' => '0',
            'url' => 'admin/users/role-permission',
            'icon' => 'las la-user-lock',
            'name' => 'Permission',
            'order' => '3',
            'permission_name' => 'read-permission',
        ]);
        Navigation::create([
            'parent_id' => '0',
            'url' => 'admin/navigations',
            'icon' => 'las la-list',
            'name' => 'Navigation',
            'order' => '4',
            'permission_name' => 'read-navigation',
        ]);
        // Create Users
        $user = User::create([
            'name' => 'Aditya Putra',
            'email' => 'aditya5660@gmail.com',
            'password' => Hash::make('semuabisa'),
        ]);
        $user->assignRole('super-admin');
    }
}
