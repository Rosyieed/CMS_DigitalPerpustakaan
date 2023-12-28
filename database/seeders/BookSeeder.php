<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $book = new Book();
        $book->title = "The Great Gatsby";
        $book->author = "F. Scott Fitzgerald";
        $book->description = "The Great Gatsby is a 1925 novel by American writer F. Scott Fitzgerald. Set in the Jazz Age on Long Island, the novel depicts narrator Nick Carraway's interactions with mysterious millionaire Jay Gatsby and Gatsby's obsession to reunite with his former lover, Daisy Buchanan.";
        $book->category_id = 1;
        $book->quantity = 100;
        $book->file_path = base_path("public/storage/books/The Great Gatsby.pdf");
        $book->cover_path = base_path("public/storage/books/The Great Gatsby.jpg");
        $book->user_id = 1;
        $book->save();
    }
}
