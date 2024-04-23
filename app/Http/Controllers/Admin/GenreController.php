<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Genre\StoreGenreRequest;
use App\Http\Requests\Admin\Genre\UpdateGenreRequest;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $genres = Genre::query()->orderByDesc("id");
        if ($request->has('search')) {
            $searchText = $request->input('search');
            $genres->where('name', 'like', '%' . $searchText . '%');
        }

        $genres = $genres->paginate();
        return view('admin.genres.index', ['genres' => $genres]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genre  = new Genre();
        return view('admin.genres.create', ['genre' => $genre]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGenreRequest $request)
    {
        $request->validated();
        Genre::create($request->all());
        return redirect()->route('admin.genres.index')->with('success', 'Tạo mới thể loại thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Genre $genre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Genre $genre)
    {
        return view('admin.genres.edit', ['genre' => $genre]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGenreRequest $request, Genre $genre)
    {
        $request->validated();
        $genre->update($request->all());
        return redirect()->route('admin.genres.index')->with('success', 'Cập nhật thông tin thể loại thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Genre $genre)
    {
        $genre->delete();
        return redirect()->route('admin.genres.index')->with('success', 'Xoá thể loại thành công!');
    }
}
