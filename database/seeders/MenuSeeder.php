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

        // ── Components ─────────────────────────────────────────────
        Menu::create(['label' => 'Components', 'type' => 'header', 'sort_order' => 30]);

        $layouts = Menu::create([
            'label' => 'Layouts', 'type' => 'toggle',
            'icon' => 'bx bx-layout', 'sort_order' => 31,
        ]);
        foreach (['Without menu', 'Container', 'Fluid', 'Blank'] as $i => $name) {
            Menu::create([
                'label' => $name, 'type' => 'link',
                'url' => 'javascript:void(0);',
                'parent_id' => $layouts->id, 'sort_order' => $i + 1,
            ]);
        }

        Menu::create([
            'label' => 'Cards', 'type' => 'link',
            'icon' => 'bx bx-collection', 'url' => 'javascript:void(0);', 'sort_order' => 32,
        ]);
        Menu::create([
            'label' => 'Tables', 'type' => 'link',
            'icon' => 'bx bx-table', 'url' => 'javascript:void(0);', 'sort_order' => 33,
        ]);

        // ── Misc ───────────────────────────────────────────────────
        Menu::create(['label' => 'Misc', 'type' => 'header', 'sort_order' => 40]);

        Menu::create([
            'label' => 'Support', 'type' => 'link',
            'icon' => 'bx bx-support',
            'url' => 'https://github.com/themeselection/sneat-html-admin-template-free/issues',
            'target_blank' => true, 'sort_order' => 41,
        ]);
        Menu::create([
            'label' => 'Documentation', 'type' => 'link',
            'icon' => 'bx bx-file',
            'url' => 'https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/',
            'target_blank' => true, 'sort_order' => 42,
        ]);
    }
}
