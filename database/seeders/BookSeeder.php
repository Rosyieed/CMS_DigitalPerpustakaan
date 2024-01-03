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
        $book->file_path = "pdfs\gatsby.pdf";
        $book->cover_path = "covers\gatsby.jpg";
        $book->user_id = 1;
        $book->save();

        $book = new Book();
        $book->title = "Ubur-ubur Lembur";
        $book->author = "Raditya Dika";
        $book->description = "Ubur-ubur Lembur adalah buku komedi Raditya Dika. Bercerita tentang pengalamannya belajar hidup dari apa yang dia cintai, sambil menemukan hal remeh untuk ditertawakan di sepanjang perjalanan.";
        $book->category_id = 2;
        $book->quantity = 100;
        $book->file_path = "pdfs\ubur.pdf";
        $book->cover_path = "covers\ubur.jpg";
        $book->user_id = 1;
        $book->save();

        $book = new Book();
        $book->title = "Koala Kumal";
        $book->author = "Raditya Dika";
        $book->description = "Koala Kumal adalah  buku komedi yang menceritakan pengalaman Raditya Dika dari mulai jurit malam SMP yang berakhir dengan kekacauan sampai bertemu perempuan yang mahir bermain tombak. Seluruh cerita di dalamnya berasal dari kisah nyata.";
        $book->category_id = 2;
        $book->quantity = 100;
        $book->file_path = "pdfs\koala.pdf";
        $book->cover_path = "covers\koala.jpg";
        $book->user_id = 1;
        $book->save();

        $book = new Book();
        $book->title = "Laskar Pelangi";
        $book->author = "Andrea Hirata";
        $book->description = "Laskar Pelangi adalah novel pertama karya Andrea Hirata yang diterbitkan oleh Bentang Pustaka pada April 2005. Novel ini mengisahkan tentang perjuangan sekelompok anak muda di Belitung dalam menggapai impian. Novel ini juga mengisahkan tentang kebersamaan, persahabatan, dan cita-cita.";
        $book->category_id = 1;
        $book->quantity = 100;
        $book->file_path = "pdfs\laskar.pdf";
        $book->cover_path = "covers\laskar.jpg";
        $book->user_id = 2;
        $book->save();

        $book = new Book();
        $book->title = "Sang Pemimpi";
        $book->author = "Andrea Hirata";
        $book->description = "Sang Pemimpi adalah novel kedua karya Andrea Hirata yang diterbitkan oleh Bentang Pustaka pada 2006. Novel ini merupakan kelanjutan dari novel Laskar Pelangi. Novel ini mengisahkan tentang perjuangan Ikal dan sahabatnya, Arai, dalam menggapai impian mereka.";
        $book->category_id = 1;
        $book->quantity = 100;
        $book->file_path = "pdfs\sang.pdf";
        $book->cover_path = "covers\sang.jpg";
        $book->user_id = 2;
        $book->save();
    }
}
