<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        $userBooks = Book::where('user_id', Auth::id())->get();
        return view('book.index', compact('books', 'userBooks'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('book.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'description' => 'nullable',
            'category_id' => 'required|exists:categories,id',
            'quantity' => 'required|integer',
            'file_path' => 'nullable|mimes:pdf|max:10240',
            'cover_path' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        // Upload PDF
        if ($request->hasFile('file_path')) {
            $file_path = $request->file('file_path')->store('pdfs', 'public');
        } else {
            $file_path = null;
        }

        // Upload Cover Image
        if ($request->hasFile('cover_path')) {
            $cover_path = $request->file('cover_path')->store('covers', 'public');
        } else {
            $cover_path = null;
        }

        // Create Book
        Book::create([
            'title' => $request->input('title'),
            'author' => $request->input('author'),
            'description' => $request->input('description'),
            'category_id' => $request->input('category_id'),
            'quantity' => $request->input('quantity'),
            'file_path' => $file_path,
            'cover_path' => $cover_path,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('books.index')->with("success", "Buku Berhasil Ditambahkan.");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('book.edit', [
            'book' => Book::findOrFail($id),
            'categories' => Category::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'category_id' => 'required|exists:categories,id',
            'quantity' => 'required|integer',
            'file_path' => 'required|nullable|mimes:pdf|max:10240', // Max size 10MB
            'cover_path' => 'required|nullable|image|mimes:jpeg,jpg,png|max:2048', // Max size 2MB
        ]);

        // Update process
        $book = Book::findOrFail($id);

        // Handle PDF
        if ($request->hasFile('file_path')) {
            Storage::disk('public')->delete($book->file_path);
            $file_path = $request->file('file_path')->store('pdfs', 'public');
        } else {
            $file_path = $book->file_path;
        }

        // Handle Cover
        if ($request->hasFile('cover_path')) {
            Storage::disk('public')->delete($book->cover_path);
            $cover_path = $request->file('cover_path')->store('covers', 'public');
        } else {
            $cover_path = $book->cover_path;
        }

        // Update new data
        $book->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'category_id' => $request->input('category_id'),
            'quantity' => $request->input('quantity'),
            'file_path' => $file_path,
            'cover_path' => $cover_path,
        ]);

        return redirect()->route('books.index')->with('success', 'Buku Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);

        // Hapus file PDF dan gambar sampul dari storage
        Storage::disk('public')->delete($book->file_path);
        Storage::disk('public')->delete($book->cover_path);

        // Hapus data buku dari database
        $book->delete();
        return redirect("/books")->with("success", "Buku Berhasil Dihapus.");
    }
}
