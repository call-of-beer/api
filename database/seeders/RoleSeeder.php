<?php

namespace Database\Seeders;
use App\Models\Role;

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_drinker = Role::create(['guard_name'=> 'api', 'name' => 'drinker']);
        $role_admin = Role::create(['guard_name'=> 'api', 'name' => 'admin']);
 
    }
}
