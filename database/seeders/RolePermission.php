<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // Permission

        Permission::create(['name'=>'add sim']);
        Permission::create(['name'=>'delete sim']);
        Permission::create(['name'=>'edit sim']);
        Permission::create(['name'=>'publish sim']);
        Permission::create(['name'=>'unpublish sim']);
        Permission::create(['name'=>'request sim']);

        $adminRole = Role::create(['name'=>'admin']);
        $adminRole->givePermissionTo('add sim');
        $adminRole->givePermissionTo('delete sim');
        $adminRole->givePermissionTo('edit sim');
        $adminRole->givePermissionTo('publish sim');
        $adminRole->givePermissionTo('unpublish sim');

        $ctv = Role::create(['name'=>'collab']);
        $ctv->givePermissionTo('request sim');

        $daily = Role::create(['name'=>'dealer']);
        $daily->givePermissionTo('request sim');
        $user = User::where('email','tanltps04690@gmail.com')->first();
        $user->assignRole($adminRole);
    }
}
