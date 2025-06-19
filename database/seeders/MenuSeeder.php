<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu; // Sesuaikan dengan namespace model Menu Anda

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Menus
        $menus = [
            // Role & Permissions
            [
                'name' => 'Role and Permissions',
                'subdomain' => null,
                'icon' => 'fa-database',
                'order' => 0,
                'permission_view' => null,
                'parent_id' => null,
            ],
            [
                'name' => 'Role',
                'subdomain' => 'roles',
                'icon' => 'fa-user-tag',
                'order' => 0,
                'permission_view' => 'view_roles',
                'parent_id' => 1,
            ],
            [
                'name' => 'Permission',
                'subdomain' => 'permissions',
                'icon' => 'fa-paint-roller',
                'order' => 0,
                'permission_view' => 'view_permissions',
                'parent_id' => 1,
            ],

            // Settings
            [
                'name' => 'Settings',
                'subdomain' => null,
                'icon' => 'fa-cogs',
                'order' => 0,
                'parent_id' => null,
            ],
            [
                'name' => 'Users',
                'subdomain' => 'users',
                'icon' => 'fa-users',
                'order' => 0,
                'permission_view' => 'view_users',
                'parent_id' => 4,
            ],
            [
                'name' => 'Menus',
                'subdomain' => 'menus',
                'icon' => 'fa-list',
                'order' => 0,
                'permission_view' => 'view_menus',
                'parent_id' => 4,
            ],

            // Super Admin
            [
                'name' => 'Super Admin',
                'subdomain' => null,
                'icon' => 'fa-user-secret',
                'order' => 0,
                'permission_view' => null,
                'parent_id' => null,
            ],
            [
                'name' => 'Subdomain',
                'subdomain' => 'subdomain',
                'icon' => 'fa-globe',
                'order' => 0,
                'permission_view' => 'view_subdomain',
                'parent_id' => 7,
            ],

            // Admin (baru ditambahkan)
            [
                'name' => 'Admin',
                'subdomain' => null,
                'icon' => 'fa-user-cog',
                'order' => 0,
                'permission_view' => null,
                'parent_id' => null,
            ],
            [
                'name' => 'Layanan SKPD',
                'subdomain' => 'layanan-skpd',
                'icon' => 'fa-headset',
                'order' => 0,
                'permission_view' => 'view_layanan_skpd',
                'parent_id' => 9,
            ],
            [
                'name' => 'Postingan',
                'subdomain' => 'post',
                'icon' => 'fa-pen-square',
                'order' => 0,
                'permission_view' => 'view_post',
                'parent_id' => 9,
            ],
            [
                'name' => 'Slider',
                'subdomain' => 'slider',
                'icon' => 'fa-image',
                'order' => 0,
                'permission_view' => 'view_slider',
                'parent_id' => 9,
            ],
            [
                'name' => 'Galeri',
                'subdomain' => 'galeri',
                'icon' => 'fa-image',
                'order' => 0,
                'permission_view' => 'view_galeri',
                'parent_id' => 9,
            ],
            [
                'name' => 'Video',
                'subdomain' => 'video',
                'icon' => 'fa-play-circle',
                'order' => 0,
                'permission_view' => 'view_video',
                'parent_id' => 9,
            ],
            [
                'name' => 'Publikasi',
                'subdomain' => 'publikasi',
                'icon' => 'fa-file-alt',
                'order' => 0,
                'permission_view' => 'view_publikasi',
                'parent_id' => 9,
            ],
            [
                'name' => 'PPID',
                'subdomain' => 'ppid',
                'icon' => 'fa-folder-open',
                'order' => 0,
                'permission_view' => 'view_ppid',
                'parent_id' => 9,
            ],
            [
                'name' => 'Kritik & Saran',
                'subdomain' => 'kritik-saran',
                'icon' => 'fa-comments',
                'order' => 0,
                'permission_view' => 'view_kritik_saran',
                'parent_id' => 9,
            ],
            [
                'name' => 'Profile',
                'subdomain' => 'profile',
                'icon' => 'fa-id-card',
                'order' => 0,
                'permission_view' => 'view_profile',
                'parent_id' => 9,
            ],
            [
                'name' => 'Tema',
                'subdomain' => 'tema',
                'icon' => 'fa-paint-brush',
                'order' => 0,
                'permission_view' => 'view_tema',
                'parent_id' => 9,
            ],
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}
