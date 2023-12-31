<?php

use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/auth/redirect', [SocialController::class, 'redirect'])->name('google.redirect');
Route::get('/google/redirect', [SocialController::class, 'googleCallback'])->name('google.callback');

Route::middleware('auth', 'verified')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('books', BookController::class);
    Route::get('/download', [BookController::class, 'view_pdf'])->name('books.download');
    Route::get('/books/{book}/pdf', [BookController::class, 'viewPDF'])->name('books.PDF');
    Route::get('books/pdf/download', [BookController::class, 'generatePDF'])->name('books.generatePDF');
    Route::get('/books/excel/download', [BookController::class, 'generateExcel'])->name('books.generateExcel');

    Route::middleware('checkAdmin')->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
        Route::resource('categories', CategoryController::class);
    });
});


require __DIR__ . '/auth.php';
