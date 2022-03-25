<?php

namespace Database\Seeders;

use Spatie\Permission\Exceptions\RoleDoesNotExist;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // Create permissions
       Permission::firstOrCreate(['name'=>'write-a-post']);
       Permission::firstOrCreate(['name'=>'edit-a-post']);
       Permission::firstOrCreate(['name'=>'delete-a-post']);
       Permission::firstOrCreate(['name'=>'view-a-post']);
       // Create roles
       $superAdmin = Role::firstOrCreate(['name'=>'SuperAdmin']);
       $admin = Role::firstOrCreate(['name'=>'Admin']);
       $user = Role::firstOrCreate(['name'=>'User']);
       // Give permission to certain role
       $superAdmin->givePermissionTo(['write-a-post', 'edit-a-post', 'delete-a-post','view-a-post']);
       $admin->givePermissionTo(['write-a-post', 'edit-a-post', 'delete-a-post','view-a-post']);
       $user->givePermissionTo(['view-a-post']);
       // Assign role to user
       User::find(1)->assignRole(['SuperAdmin']);
       User::find(2)->assignRole(['Admin']);
       User::find(3)->assignRole(['User']);
    }
}
