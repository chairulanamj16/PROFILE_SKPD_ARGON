<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Sesuaikan dengan namespace model User Anda
use App\Models\V1\Office;
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
        $user = User::create([
            'name' => 'Dinas Komunikasi dan Informatika',
            'username' => 'diskominfo',
            'email' => 'admin@mail.com',
            'password' => Hash::make('password'), // Ganti dengan password yang diinginkan
            'rule' => 'Super Admin'
        ]);

        $office = Office::create([
            'user_id' => $user->id,
            'name' => 'Dinas Komunikasi dan Informatika',
            'subdomain' => 'diskominfo',
            'theme_gallery_id' => 1,
        ]);

        // Assign role admin to user
        $adminRole = Role::findByName('Admin');
        $user->assignRole($adminRole);
    }
}
