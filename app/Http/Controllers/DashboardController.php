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
        $bookSum = Book::sum('quantity');
        
        return view('dashboard', compact('books', 'categories', 'users', 'bookSum'), ['booksbyCategoryChart' => $booksbyCategoryChart->build(), 'createdBooksChart' => $createdBooksChart->build()]);
    }
}
