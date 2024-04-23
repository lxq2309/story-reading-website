<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Menu\StoreMenuRequest;
use App\Http\Requests\Admin\Menu\UpdateMenuRequest;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $menus = Menu::query()->orderByDesc("id");
        if ($request->has('search')) {
            $searchText = $request->input('search');
            $menus->where('name', 'like', '%'.$searchText.'%');
        }

        $menus = $menus->paginate();
        return view('admin.menus.index', ['menus' => $menus]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $menu = new Menu();
        return view('admin.menus.create', ['menu' => $menu]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMenuRequest $request)
    {
        $request->validated();
        Menu::create($request->all());
        return redirect()->route('admin.menus.index')->with('success', 'Tạo link mới thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        return view('admin.menus.edit', ['menu' => $menu]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMenuRequest $request, Menu $menu)
    {
        $request->validated();
        $menu->update($request->all());
        return redirect()->route('admin.menus.index')->with('success', 'Sửa link thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('admin.menus.index')->with('success', 'Xoá link thành công!');
    }
}
