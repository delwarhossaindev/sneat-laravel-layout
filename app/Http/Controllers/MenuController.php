<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:menu.view')->only(['index']);
        $this->middleware('permission:menu.create')->only(['create', 'store']);
        $this->middleware('permission:menu.edit')->only(['edit', 'update']);
        $this->middleware('permission:menu.delete')->only(['destroy']);
    }

    public function index()
    {
        $menus = Menu::with('parent')
            ->orderBy('sort_order')
            ->orderBy('id')
            ->paginate(20);

        return view('pages.menus.index', compact('menus'));
    }

    public function create()
    {
        $parents = Menu::where('type', 'toggle')->where('is_active', true)->orderBy('sort_order')->get();
        $permissions = Permission::orderBy('name')->pluck('name', 'name');

        return view('pages.menus.create', compact('parents', 'permissions'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'label'         => ['required', 'string', 'max:100'],
            'type'          => ['required', 'in:header,link,toggle'],
            'icon'          => ['nullable', 'string', 'max:100'],
            'route'         => ['nullable', 'string', 'max:100'],
            'url'           => ['nullable', 'string', 'max:500'],
            'route_pattern' => ['nullable', 'string', 'max:100'],
            'permission'    => ['nullable', 'string', 'max:100'],
            'parent_id'     => ['nullable', 'exists:menus,id'],
            'sort_order'    => ['nullable', 'integer', 'min:0', 'max:9999'],
            'is_active'     => ['boolean'],
            'target_blank'  => ['boolean'],
        ]);

        $data['is_active']    = $request->boolean('is_active');
        $data['target_blank'] = $request->boolean('target_blank');
        $data['sort_order']   = $data['sort_order'] ?? 0;

        if ($data['type'] === 'header' || $data['type'] === 'toggle') {
            $data['parent_id'] = null;
        }

        Menu::create($data);

        return redirect()->route('menus.index')->with('status', 'Menu item created.');
    }

    public function edit(Menu $menu)
    {
        $parents = Menu::where('type', 'toggle')
            ->where('is_active', true)
            ->where('id', '!=', $menu->id)
            ->orderBy('sort_order')
            ->get();

        $permissions = Permission::orderBy('name')->pluck('name', 'name');

        return view('pages.menus.edit', compact('menu', 'parents', 'permissions'));
    }

    public function update(Request $request, Menu $menu)
    {
        $data = $request->validate([
            'label'         => ['required', 'string', 'max:100'],
            'type'          => ['required', 'in:header,link,toggle'],
            'icon'          => ['nullable', 'string', 'max:100'],
            'route'         => ['nullable', 'string', 'max:100'],
            'url'           => ['nullable', 'string', 'max:500'],
            'route_pattern' => ['nullable', 'string', 'max:100'],
            'permission'    => ['nullable', 'string', 'max:100'],
            'parent_id'     => ['nullable', 'exists:menus,id'],
            'sort_order'    => ['nullable', 'integer', 'min:0', 'max:9999'],
            'is_active'     => ['boolean'],
            'target_blank'  => ['boolean'],
        ]);

        $data['is_active']    = $request->boolean('is_active');
        $data['target_blank'] = $request->boolean('target_blank');
        $data['sort_order']   = $data['sort_order'] ?? 0;

        if ($data['type'] === 'header' || $data['type'] === 'toggle') {
            $data['parent_id'] = null;
        }

        $menu->update($data);

        return redirect()->route('menus.index')->with('status', 'Menu item updated.');
    }

    public function destroy(Menu $menu)
    {
        $menu->children()->update(['parent_id' => null]);
        $menu->delete();

        return redirect()->route('menus.index')->with('status', 'Menu item deleted.');
    }
}
