<?php

namespace App\Http\Controllers;

use App\Charts\BooksbyCategoryChart;
use App\Charts\CreatedBooksChart;
use App\Models\Book;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(BooksbyCategoryChart $booksbyCategoryChart, CreatedBooksChart $createdBooksChart)
    {
        $books = Book::all();
        $categories = Category::all();
        $users = User::all();
        $topAuthors = Book::select('author', DB::raw('COUNT(*) as book_count'))
            ->groupBy('author')
            ->orderByDesc('book_count')
            ->take(1)
            ->get();
        $bookSum = Book::sum('quantity');
        return view('dashboard', compact('books', 'categories', 'users', 'topAuthors', 'bookSum'), ['booksbyCategoryChart' => $booksbyCategoryChart->build(), 'createdBooksChart' => $createdBooksChart->build()]);
    }
}
