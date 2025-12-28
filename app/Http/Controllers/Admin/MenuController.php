<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        return view('admin.menus.index', [
            'menus' => Menu::latest()->get()
        ]);
    }

    public function create()
    {
        return view('admin.menus.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'     => 'required|string|max:255',
            'url'       => 'required|string',
            'order'     => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        Menu::create($data);

        return redirect()
            ->route('admin.menus.index')
            ->with('success', 'Menu berhasil dibuat');
    }

    public function edit(Menu $menu)
    {
        return view('admin.menus.edit', compact('menu'));
    }

    public function update(Request $request, Menu $menu)
    {
        $data = $request->validate([
            'title'     => 'required|string|max:255',
            'url'       => 'required|string',
            'order'     => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $menu->update($data);

        return redirect()
            ->route('admin.menus.index')
            ->with('success', 'Menu berhasil diperbarui');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();

        return back()->with('success', 'Menu berhasil dihapus');
    }
}
