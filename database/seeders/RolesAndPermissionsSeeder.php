<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Roles
        $roles = [
            ['name' => 'Admin'],
            ['name' => 'Super Admin'],
            ['name' => 'User'],
            // tambahkan role lain sesuai kebutuhan
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }

        // Permissions
        $permissions = [
            // Users
            ['name' => 'view_users'],
            ['name' => 'create_users'],
            ['name' => 'edit_users'],
            ['name' => 'delete_users'],

            // Menus
            ['name' => 'view_menus'],
            ['name' => 'create_menus'],
            ['name' => 'edit_menus'],
            ['name' => 'delete_menus'],

            // Roles
            ['name' => 'view_roles'],
            ['name' => 'create_roles'],
            ['name' => 'edit_roles'],
            ['name' => 'delete_roles'],

            // Permissions
            ['name' => 'view_permissions'],
            ['name' => 'create_permissions'],
            ['name' => 'edit_permissions'],
            ['name' => 'delete_permissions'],

            // Subdomain
            ['name' => 'view_subdomain'],
            ['name' => 'create_subdomain'],
            ['name' => 'edit_subdomain'],
            ['name' => 'delete_subdomain'],

            // Postingan
            ['name' => 'view_post'],
            ['name' => 'create_post'],
            ['name' => 'edit_post'],
            ['name' => 'delete_post'],

            // Slider
            ['name' => 'view_slider'],
            ['name' => 'create_slider'],
            ['name' => 'edit_slider'],
            ['name' => 'delete_slider'],

            // Galeri
            ['name' => 'view_galeri'],
            ['name' => 'create_galeri'],
            ['name' => 'edit_galeri'],
            ['name' => 'delete_galeri'],

            // Video
            ['name' => 'view_video'],
            ['name' => 'create_video'],
            ['name' => 'edit_video'],
            ['name' => 'delete_video'],

            // Publikasi
            ['name' => 'view_publikasi'],
            ['name' => 'create_publikasi'],
            ['name' => 'edit_publikasi'],
            ['name' => 'delete_publikasi'],

            // PPID
            ['name' => 'view_ppid'],
            ['name' => 'create_ppid'],
            ['name' => 'edit_ppid'],
            ['name' => 'delete_ppid'],

            // Kritik & Saran
            ['name' => 'view_kritik_saran'],
            ['name' => 'create_kritik_saran'],
            ['name' => 'edit_kritik_saran'],
            ['name' => 'delete_kritik_saran'],

            // Profile
            ['name' => 'view_profile'],
            ['name' => 'create_profile'],
            ['name' => 'edit_profile'],
            ['name' => 'delete_profile'],

            // Tema
            ['name' => 'view_tema'],
            ['name' => 'create_tema'],
            ['name' => 'edit_tema'],
            ['name' => 'delete_tema'],

            // Layanan SKPD
            ['name' => 'view_layanan_skpd'],
            ['name' => 'create_layanan_skpd'],
            ['name' => 'edit_layanan_skpd'],
            ['name' => 'delete_layanan_skpd'],
        ];




        foreach ($permissions as $permission) {
            Permission::create($permission);
        }

        // Assign permissions to roles
        $role = Role::findByName('Admin');
        $role->givePermissionTo([
            // Roles
            'view_roles',
            'create_roles',
            'edit_roles',
            'delete_roles',

            // Permissions
            'view_permissions',
            'create_permissions',
            'edit_permissions',
            'delete_permissions',

            // Users
            'view_users',
            'create_users',
            'edit_users',
            'delete_users',

            // Menus
            'view_menus',
            'create_menus',
            'edit_menus',
            'delete_menus',

            // Subdomain
            'view_subdomain',
            'create_subdomain',
            'edit_subdomain',
            'delete_subdomain',

            // Post
            'view_post',
            'create_post',
            'edit_post',
            'delete_post',

            // Slider
            'view_slider',
            'create_slider',
            'edit_slider',
            'delete_slider',

            // Galeri
            'view_galeri',
            'create_galeri',
            'edit_galeri',
            'delete_galeri',

            // Video
            'view_video',
            'create_video',
            'edit_video',
            'delete_video',

            // Publikasi
            'view_publikasi',
            'create_publikasi',
            'edit_publikasi',
            'delete_publikasi',

            // PPID
            'view_ppid',
            'create_ppid',
            'edit_ppid',
            'delete_ppid',

            // Kritik & Saran
            'view_kritik_saran',
            'create_kritik_saran',
            'edit_kritik_saran',
            'delete_kritik_saran',

            // Profile
            'view_profile',
            'create_profile',
            'edit_profile',
            'delete_profile',

            // Tema
            'view_tema',
            'create_tema',
            'edit_tema',
            'delete_tema',

            // Layanan SKPD
            'view_layanan_skpd',
            'create_layanan_skpd',
            'edit_layanan_skpd',
            'delete_layanan_skpd',
        ]);


        // contoh: $role = Role::findByName('User');
        // $role->givePermissionTo(['view_users', 'edit_users']);

        // Assign role to user if needed
        // contoh: $user->assignRole('Admin');
    }
}
