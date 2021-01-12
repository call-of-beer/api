<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{



public function run()
{
    $role_admin = \App\Models\Role::where('name', 'admin')->first();
    $role_drinker  = \App\Models\Role::where('name', 'drinker')->first();

    
   // $user = new User();
   // $user->firstname = 'User';
   // $user->surname = 'User';
   // $user->email = 'user@test.com';
   // $user->password = bcrypt('secret');
  //  $user->save();
   // $user->roles()->attach($role_drinker);

    $admin = new \App\Models\User();
    $admin->firstname = 'Admin';
    $admin->surname = 'Admin';
    $admin->email = 'admin@admin.net';
    $admin->password = bcrypt('admin');
    $admin->save();
    $admin->roles()->attach($role_admin);

}
}
