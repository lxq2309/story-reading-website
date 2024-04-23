<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Author\StoreAuthorRequest;
use App\Http\Requests\Admin\Author\UpdateAuthorRequest;
use App\Models\Author;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $authors = Author::query()->orderByDesc("id");
        if ($request->has('search')) {
            $searchText = $request->input('search');
            $authors->where('name', 'like', '%'.$searchText.'%');
        }

        $authors = $authors->paginate();
        return view('admin.authors.index', ['authors' => $authors]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $author = new Author();
        return view('admin.authors.create', ['author' => $author]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAuthorRequest $request): RedirectResponse
    {
        $request->validated();
        $author = Author::create($request->all());
        return redirect()->route('admin.authors.index')
            ->with('success', 'Tạo tác giả thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Author $author)
    {
        return view('admin.authors.edit', ['author' => $author]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAuthorRequest $request, Author $author)
    {
        $request->validated();
        $author->update($request->all());
        return redirect()->route('admin.authors.index')
            ->with('success', 'Cập nhật thông tin tác giả thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        $author->delete();
        return redirect()->route('admin.authors.index')
            ->with('success', 'Xoá tác giả thành công!');
    }
}
