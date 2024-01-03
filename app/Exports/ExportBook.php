<?php

namespace App\Exports;

use App\Models\Book;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;

class ExportBook implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        if (Auth::user()->role === 'admin') {
            $books = Book::all();
        } else {
            $books = Book::where('user_id', Auth::user()->id)->get();
        }
        return view ('book.excel', compact('books'));
    }
}
