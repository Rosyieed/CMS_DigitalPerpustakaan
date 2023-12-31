<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\Category;
use Barryvdh\DomPDF\PDF;
use App\Exports\ExportBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Maatwebsite\Excel\Facades\Excel;

class BookController extends Controller
{
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            $books = Book::all();
        } else {
            $books = Book::where('user_id', Auth::user()->id)->get();
        }
        $title = 'Hapus Buku!';
        $text = "Apakah kamu yakin ingin menghapus?";
        confirmDelete($title, $text);
        return view('book.index', compact('books'));
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
            'description' => 'required|min:30',
            'category_id' => 'required|exists:categories,id',
            'quantity' => 'required|integer',
            'file_path' => 'required|mimes:pdf|max:10240',
            'cover_path' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ], [
            'title.required' => 'Judul tidak boleh kosong',
            'author.required' => 'Penulis tidak boleh kosong',
            'description.required' => 'Deskripsi tidak boleh kosong',
            'description.min' => 'Deskripsi minimal 30 karakter',
            'category_id.required' => 'Kategori tidak boleh kosong',
            'category_id.exists' => 'Kategori tidak ditemukan',
            'quantity.required' => 'Jumlah Buku tidak boleh kosong',
            'quantity.integer' => 'Jumlah Buku harus berupa angka',
            'file_path.required' => 'File PDF tidak boleh kosong',
            'file_path.mimes' => 'File Buku harus berupa PDF',
            'file_path.max' => 'File Buku maksimal 10MB',
            'cover_path.required' => 'File Sampul tidak boleh kosong',
            'cover_path.image' => 'File Sampul harus berupa gambar',
            'cover_path.mimes' => 'File Sampul harus berupa JPG, JPEG, atau PNG',
            'cover_path.max' => 'File Sampul maksimal 2MB',
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

        toast('Buku Berhasil Ditambahkan', 'success');
        return redirect()->route('books.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $books = Book::findOrFail($id);
        return view('book.show', compact('books'));
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
            'author' => 'required',
            'description' => 'required|min:30',
            'category_id' => 'required|exists:categories,id',
            'quantity' => 'required|integer',
            'file_path' => 'nullable|mimes:pdf|max:10240',
            'cover_path' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ], [
            'title.required' => 'Judul tidak boleh kosong',
            'title.author' => 'Penulis tidak boleh kosong',
            'description.required' => 'Deskripsi tidak boleh kosong',
            'description.min' => 'Deskripsi minimal 30 karakter',
            'category_id.required' => 'Kategori tidak boleh kosong',
            'category_id.exists' => 'Kategori tidak ditemukan',
            'quantity.required' => 'Jumlah Buku tidak boleh kosong',
            'quantity.integer' => 'Jumlah Buku harus berupa angka',
            'file_path.mimes' => 'File PDF harus berupa PDF',
            'file_path.max' => 'File PDF maksimal 10MB',
            'cover_path.image' => 'File sampul harus berupa gambar',
            'cover_path.mimes' => 'File sampul harus berupa JPG, JPEG, atau PNG',
            'cover_path.max' => 'File sampul maksimal 2MB',
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

        toast('Buku Berhasil Diubah', 'success');
        return redirect()->route('books.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);

        Storage::disk('public')->delete($book->file_path);
        Storage::disk('public')->delete($book->cover_path);

        $book->delete();
        toast('Buku Berhasil Dihapus', 'success');
        return redirect("/books");
    }

    public function viewPDF(string $id)
    {
        $book = Book::findOrFail($id);
        $pdfPath = Storage::path('public/' . $book->file_path);

        if (!Storage::exists('public/' . $book->file_path) || !$book->file_path) {
            return redirect()->back()->with('error', 'File Buku PDF tidak ditemukan');
        }

        return response()->file($pdfPath, ['Content-Type' => 'application/pdf']);
    }

    public function generatePDF()
    {
        if (Auth::user()->role === 'admin') {
            $books = Book::all();
        } else {
            $books = Book::where('user_id', Auth::user()->id)->get();
        }
        $pdf = FacadePdf::loadView('book.pdf', compact('books'));
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('Laporan Buku ' . now()->translatedFormat('j F Y') . '.pdf');
    }

    public function generateExcel()
    {
        return Excel::download(new ExportBook, 'Laporan Buku ' . now()->translatedFormat('j F Y') . '.xlsx');
    }
}
