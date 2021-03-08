<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
class UserTableSeeder extends Seeder
{
    public function run()
    {
        $role_user = Role::where('rol', 'user')->first();
        $role_admin = Role::where('rol', 'admin')->first();

        $user = new User();
        $user->username = 'User';
        $user->email = 'user@example.com';
        $user->password = bcrypt('secret');
        $user->rol = 2;
        $user->save();
        $user->roles()->attach($role_user);
        $user = new User();
        $user->username = 'Admin';
        $user->email = 'admin@example.com';
        $user->password = bcrypt('secret');
        $user->rol = 1;
        $user->save();
        $user->roles()->attach($role_admin);

     }
}
