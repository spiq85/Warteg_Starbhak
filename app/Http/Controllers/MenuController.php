<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Category;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the menus.
     */
    public function index()
    {
        $menus = Menu::with('category')->get();
        return view('menus.index', compact('menus'));
    }

    /**
     * Show the form for creating new menus.
     */
    public function create()
    {
        $categories = Category::all();
        return view('menus.create', compact('categories'));
    }

    /**
     * Store newly created menus in the database.
     */
    public function store(Request $request)
    {
        // Validate the menus array
        $request->validate([
            'menus.*.name' => 'required|string|max:255',
            'menus.*.price' => 'required|numeric',
            'menus.*.category_id' => 'required|exists:categories,id',
        ]);

        // Loop through each menu and store it
        foreach ($request->menus as $menuData) {
            Menu::create([
                'name' => $menuData['name'],
                'price' => $menuData['price'],
                'description' => $menuData['description'] ?? null,
                'category_id' => $menuData['category_id'],
            ]);
        }

        return redirect()->route('menus.index')->with('success', 'Menus created successfully.');
    }

    /**
     * Show the form for editing the specified menu.
     */
    public function edit(Menu $menu)
    {
        $categories = Category::all();
        return view('menus.edit', compact('menu', 'categories'));
    }

    /**
     * Update the specified menu in the database.
     */
    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $menu->update($request->all());

        return redirect()->route('menus.index')->with('success', 'Menu updated successfully.');
    }

    /**
     * Remove the specified menu from the database.
     */
    public function destroy(Menu $menu)
    {
        $menu->delete();

        return redirect()->route('menus.index')->with('success', 'Menu deleted successfully.');
    }
}
