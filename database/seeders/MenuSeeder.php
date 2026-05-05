<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        Menu::truncate();

        // ── Dashboard ──────────────────────────────────────────────
        Menu::create([
            'label' => 'Dashboard', 'type' => 'link',
            'icon' => 'bx bx-home-circle', 'route' => 'dashboard',
            'route_pattern' => 'dashboard', 'permission' => 'dashboard.view',
            'sort_order' => 1,
        ]);

        // ── Administration ─────────────────────────────────────────
        Menu::create(['label' => 'Administration', 'type' => 'header', 'sort_order' => 10]);

        $acl = Menu::create([
            'label' => 'Access Control', 'type' => 'toggle',
            'icon' => 'bx bx-shield-quarter', 'sort_order' => 11,
        ]);

        Menu::create([
            'label' => 'Users', 'type' => 'link',
            'route' => 'users.index', 'route_pattern' => 'users.*',
            'permission' => 'user.view', 'parent_id' => $acl->id, 'sort_order' => 1,
        ]);
        Menu::create([
            'label' => 'Roles', 'type' => 'link',
            'route' => 'roles.index', 'route_pattern' => 'roles.*',
            'permission' => 'role.view', 'parent_id' => $acl->id, 'sort_order' => 2,
        ]);
        Menu::create([
            'label' => 'Permissions', 'type' => 'link',
            'route' => 'permissions.index', 'route_pattern' => 'permissions.*',
            'permission' => 'permission.view', 'parent_id' => $acl->id, 'sort_order' => 3,
        ]);
        Menu::create([
            'label' => 'Assign Permissions', 'type' => 'link',
            'route' => 'assign-permissions.index', 'route_pattern' => 'assign-permissions.*',
            'permission' => 'permission.assign', 'parent_id' => $acl->id, 'sort_order' => 4,
        ]);

        // ── Settings ───────────────────────────────────────────────
        Menu::create(['label' => 'Settings', 'type' => 'header', 'sort_order' => 20]);

        $settings = Menu::create([
            'label' => 'Settings', 'type' => 'toggle',
            'icon' => 'bx bx-cog', 'sort_order' => 21,
        ]);

        Menu::create([
            'label' => 'Menu Manager', 'type' => 'link',
            'icon' => 'bx bx-menu', 'route' => 'menus.index',
            'route_pattern' => 'menus.*', 'permission' => 'menu.view',
            'parent_id' => $settings->id, 'sort_order' => 1,
        ]);

    }
}
