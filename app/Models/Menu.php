<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'label', 'type', 'icon', 'route', 'url', 'route_pattern',
        'permission', 'parent_id', 'sort_order', 'is_active', 'target_blank',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'target_blank' => 'boolean',
    ];

    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id')->orderBy('sort_order');
    }

    public function activeChildren()
    {
        return $this->hasMany(Menu::class, 'parent_id')->where('is_active', true)->orderBy('sort_order');
    }

    public function href(): string
    {
        if ($this->route) {
            try {
                return route($this->route);
            } catch (\Exception $e) {
                return $this->url ?? '#';
            }
        }
        return $this->url ?? 'javascript:void(0);';
    }

    public function isActive(): bool
    {
        $pattern = $this->route_pattern ?: $this->route;
        return $pattern ? request()->routeIs($pattern) : false;
    }
}
