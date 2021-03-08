<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
class RoleTableSeeder extends Seeder
{
    public function run()
    {
        $role = new Role();
        $role->rol = 'admin';
        $role->desc = 'Administrator';
        $role->save();
        $role = new Role();
        $role->rol = 'user';
        $role->desc = 'User';
        $role->save();
    }
}
