<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use App\Models\Book_issue;
use Picqer\Barcode\BarcodeGeneratorHTML;

class BarcodeController extends Controller
{
    // Barcode scanner page
    public function index()
    {
        $book_issues = Book_issue::with(['book.category', 'user'])
            ->where('status', 'issued')
            ->orderBy('issue_date', 'desc')
            ->get();

        $book_issues_count = $book_issues->count();

        $generator = new BarcodeGeneratorHTML();
        $barcodes = [];

        foreach ($book_issues as $book_issue) {
            $barcodeText = (string) $book_issue->id;
            $barcodeHtml = $generator->getBarcode($barcodeText, $generator::TYPE_CODE_128);

            $issuedUser = User::find($book_issue->issued_id);

            $barcodes[] = [
                'barcode'        => $barcodeHtml,
                'barcodeText'    => $barcodeText,
                'book_title'     => $book_issue->book->title ?? 'UNKNOWN',
                'book_isbn'      => $book_issue->book->isbn ?? 'UNKNOWN',
                'book_author'    => $book_issue->book->author ?? 'UNKNOWN',
                'book_category'  => $book_issue->book->category->name ?? 'UNKNOWN',
                'book_publisher' => $book_issue->book->publish_year ?? 'UNKNOWN',
                'issued_id'      => $book_issue->issued_id ?? 'UNKNOWN',
                'issued_name'    => $issuedUser->name ?? 'UNKNOWN',
                'issue_role'     => $issuedUser->role ?? 'UNKNOWN',
                'user_name'      => $book_issue->user->name ?? 'UNKNOWN',
                'issue_date'     => $book_issue->issue_date ?? 'UNKNOWN',
                'status'         => $book_issue->status,
                'book_id'        => $book_issue->book_id,
            ];
        }

        return view('admin.barcode', compact('barcodes', 'book_issues_count'));
    }

    // Book info page
    public function getBookInfo($barcode)
    {
        $book_issue = Book_issue::with(['book.category', 'user'])
            ->where('id', $barcode)
            ->first();

        if (!$book_issue) {
            return redirect()->route('barcode.index')->with('error', 'Book not found for the provided barcode.');
        }

        $generator = new BarcodeGeneratorHTML();
        $barcodeHtml = $generator->getBarcode($book_issue->id, $generator::TYPE_CODE_128);
        $users = User::all();
        $issuedUser = User::find($book_issue->issued_id);

        $bookData = [
            'id' => $book_issue->id,
            'title' => $book_issue->book->title ?? 'UNKNOWN',
            'isbn' => $book_issue->book->isbn ?? 'UNKNOWN',
            'author' => $book_issue->book->author ?? 'UNKNOWN',
            'category' => $book_issue->book->category->name ?? 'UNKNOWN',
            'publish_year' => $book_issue->book->publish_year ?? 'UNKNOWN',
            'issued_id' => $book_issue->issued_id ?? 'UNKNOWN',
            'issued_name' => $issuedUser->name ?? 'UNKNOWN',
            'issue_role' => $issuedUser->role ?? 'UNKNOWN',
            'user_name' => $book_issue->user->name ?? 'UNKNOWN',
            'issue_date' => $book_issue->issue_date ?? 'UNKNOWN',
            'status' => $book_issue->status ?? 'UNKNOWN',
            'book_id' => $book_issue->book_id,
            'barcode' => $barcodeHtml,
        ];

        return view('admin.barcode_info', compact('book_issue', 'bookData', 'users'));
    }
}
