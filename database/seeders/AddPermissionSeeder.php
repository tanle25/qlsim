<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class AddPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        Permission::create([
            'name'=> 'user manager',
            'guard_name'=>'web'
        ]);

        Permission::create([
            'name'=> 'add package',
            'guard_name'=>'web'
        ]);
    }
}
