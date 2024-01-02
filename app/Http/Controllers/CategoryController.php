<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        $title = 'Hapus Kategori!';
        $text = "Apakah kamu yakin ingin menghapus?";
        confirmDelete($title, $text);
        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:categories|max:255|regex:/^[a-zA-Z\s]*$/',
        ], [
            'name.required' => 'Nama kategori harus diisi',
            'name.unique' => 'Nama kategori sudah ada',
            'name.max' => 'Nama kategori terlalu panjang',
            'name.regex' => 'Nama kategori hanya boleh berisi huruf',
        ]);

        Category::create($validatedData);

        toast('Kategori Berhasil Ditambahkan', 'success');
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::findOrFail($id);
        return view('category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|unique:categories|max:255|regex:/^[a-zA-Z\s]*$/',
        ], [
            'name.required' => 'Nama kategori harus diisi',
            'name.unique' => 'Nama kategori sudah ada',
            'name.max' => 'Nama kategori terlalu panjang',
            'name.regex' => 'Nama kategori hanya boleh berisi huruf',
        ]);

        $category->update($validatedData);

        toast('Kategori Berhasil Diubah', 'success');
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        Book::where('category_id', $category->id)->update(['category_id' => null]);
        $category->delete();

        toast('Kategori Berhasil Dihapus', 'success');
        return redirect()->route('categories.index');
    }
}
