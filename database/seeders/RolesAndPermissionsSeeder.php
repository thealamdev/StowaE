<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
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
        // Create Super Admin:
        $user =User::create([
            'name' => "Shah alam",
            'email' =>"admin@gmail.com",
            'username' => "thealamdev",
            'email_verified_at' => now(),
            'password' => Hash::make('2125702006'), // password
            'remember_token' => Str::random(10),
        ]);
        // Role for super admin:
        $role = Role::create([
            "name" => "super-admin",
        ]);

       // super admin role assign:
        $user->assignRole($role);

        $arrayOfPermissionNames = ['writer', 'editor'];
        $permissions = collect($arrayOfPermissionNames)->map(function ($permission) {
            return ['name' => $permission, 'guard_name' => 'web'];
        });
    
        Permission::insert($permissions->toArray());



        // Normal user Roles define:
        Role::create([
            'name' => 'user',
        ]);
    }
}
