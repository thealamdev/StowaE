<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        // Create User:
        $user =User::create([
            'name' => "Shah alam",
            'email' =>"admin@gmail.com",
            'username' => "thealamdev",
            'email_verified_at' => now(),
            'password' => Hash::make('2125702006'), // password
            'remember_token' => Str::random(10),
        ]);

        $role = Role::create([
            "name" => "super-admin",
        ]);
        $user->assignRole($role);
       
    }
}
