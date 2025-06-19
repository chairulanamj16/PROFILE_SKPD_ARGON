<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Sesuaikan dengan namespace model User Anda
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User admin
        $admin = User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('password'), // Ganti dengan password yang diinginkan
            'rule' => 'Super Admin'
        ]);

        // Assign role admin to user
        $adminRole = Role::findByName('Admin');
        $admin->assignRole($adminRole);
    }
}
