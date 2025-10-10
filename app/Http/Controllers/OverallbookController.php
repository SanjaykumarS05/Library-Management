<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use App\Models\Book_issue;
use Picqer\Barcode\BarcodeGeneratorHTML;

class OverallbookController extends Controller
{
    public function index(Request $request)
    {
        $books = Book::all();
        $categories = Category::all();
        $issuedbook = Book_issue::where('status', 'issued')->count();
        $users = User::all();
        $bookModel = Book::find($request->input('book_id'));
        $totalBooks = Book_issue::all()->count();
        $book_issues_only = Book_issue::with(['book.category', 'user'])
            ->where('status', 'issued')
            ->get();
        $book_issues = Book_issue::with(['book.category', 'user'])
            ->get();
        $book_issues_count = $book_issues_only->count();

        $generator = new BarcodeGeneratorHTML();
        $barcodes = [];

        foreach ($book_issues as $book_issue) {

            $barcodeText = (string) ($book_issue->id ?? $book_issue->book_id ?? 'UNKNOWN');

            $barcodeHtml = $generator->getBarcode($barcodeText, $generator::TYPE_CODE_128);
            
            $barcodes[] = [
                'barcode'        => $barcodeHtml,
                'barcodeText'    => $barcodeText,
                'book_title'     => $book_issue->book->title ?? 'UNKNOWN',
                'user_name'      => $book_issue->user->name ?? 'UNKNOWN',
                'book_isbn'      => $book_issue->book->isbn ?? 'UNKNOWN',
                'book_author'    => $book_issue->book->author ?? 'UNKNOWN',
                'book_category'  => $book_issue->book->category->name ?? 'UNKNOWN',
                'book_publisher' => $book_issue->book->publish_year ?? 'UNKNOWN',
                'issued_id'      => $book_issue->issued_id ?? 'UNKNOWN',
                'issued_name'    => $book_issue->user->name ?? 'UNKNOWN',
                'issue_role'     => $book_issue->user->role ?? 'UNKNOWN',
                'book_id'        => $book_issue->book_id,
                'user_id'        => $book_issue->user_id,
                'issue_date'     => $book_issue->issue_date ?? 'UNKNOWN',
                'status'         => $book_issue->status,
            ];
        }
        return view('admin.overallbook', compact('barcodes', 'books', 'categories', 'users', 'bookModel','book_issues_count', 'totalBooks','issuedbook'));
    }

}
