<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Book;

class BackfillSpecialBookId extends Command
{
    protected $signature = 'books:backfill-special-book-id';

<<<<<<< Updated upstream
    protected $description = 'Backfill special_book_id for books with null values';

    public function handle()
    {
        $books = Book::whereNull('special_book_id')->get();

        $this->info('Found ' . $books->count() . ' books with null special_book_id.');

        foreach ($books as $book) {
            // Remove genre check, generate special_book_id regardless
            $book->special_book_id = Book::generateSpecialBookId();
            $book->save();
            $this->info("Updated book ID {$book->id} with special_book_id {$book->special_book_id}");
        }

        $this->info('Backfill complete.');

=======
    protected $description = 'Backfill special_book_id for existing books without it';

    public function handle()
    {
        $books = Book::whereNull('special_book_id')->orderBy('id')->get();
        $this->info('Backfilling special_book_id for ' . $books->count() . ' books.');

        $nextId = 1;
        $lastBook = Book::whereNotNull('special_book_id')->orderBy('id', 'desc')->first();
        if ($lastBook && $lastBook->special_book_id) {
            $lastNumber = intval(substr($lastBook->special_book_id, 4));
            $nextId = $lastNumber + 1;
        }

        foreach ($books as $book) {
            $book->special_book_id = 'GAB-' . str_pad($nextId, 5, '0', STR_PAD_LEFT);
            $book->save();
            $this->info("Backfilled book ID {$book->id} with special_book_id {$book->special_book_id}");
            $nextId++;
        }

        $this->info('Backfilling completed.');
>>>>>>> Stashed changes
        return 0;
    }
}
