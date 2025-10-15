<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        $books = Book::latest()->get();
        $categories = Category::latest()->get();
        $users = User::latest()->get();

        $issuedbook = Book_issue::where('status', 'issued')->count();
        $totalBooks = Book_issue::count();

        $book_issues_only = Book_issue::with(['book.category', 'user'])
            ->where('status', 'issued')
            ->get();

        $book_issues_count = $book_issues_only->count();
        $book_issues = Book_issue::latest()->with(['book.category', 'user'])->get();

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
                'user_name'      => $book_issue->user->name ?? 'UNKNOWN',
                'book_isbn'      => $book_issue->book->isbn ?? 'UNKNOWN',
                'book_author'    => $book_issue->book->author ?? 'UNKNOWN',
                'book_category'  => $book_issue->book->category->name ?? 'UNKNOWN',
                'book_publisher' => $book_issue->book->publish_year ?? 'UNKNOWN',
                'issued_id'      => $book_issue->issued_id ?? 'UNKNOWN',
                'issued_name'    => $issuedUser->name ?? 'UNKNOWN',
                'issue_role'     => $issuedUser->role ?? 'UNKNOWN',
                'book_id'        => $book_issue->book_id,
                'user_id'        => $book_issue->user_id,
                'issue_date'     => $book_issue->issue_date ?? 'UNKNOWN',
                'status'         => $book_issue->status,
            ];
        }

        return view('admin.overallbook', compact(
            'barcodes',
            'books',
            'categories',
            'users',
            'book_issues_count',
            'totalBooks',
            'issuedbook'
        ));
    }

    public function search(Request $request)
{
    $query = $request->search;
    $categoryId = $request->category_id;

    $book_issues = Book_issue::with(['book.category', 'user'])
        ->when($query, function ($q) use ($query) {
            $q->where(function ($inner) use ($query) {
                // 🔍 Match fields from book_issues table
                $inner->where('status', 'like', "%{$query}%")
                      ->orWhere('issued_id', 'like', "%{$query}%");

                // 🔍 Match book table fields
                $inner->orWhereHas('book', function ($q2) use ($query) {
                    $q2->where('title', 'like', "%{$query}%")
                        ->orWhere('isbn', 'like', "%{$query}%")
                        ->orWhere('author', 'like', "%{$query}%")
                        ->orWhere('publish_year', 'like', "%{$query}%");
                });

                // 🔍 Match user table fields
                $inner->orWhereHas('user', function ($q3) use ($query) {
                    $q3->where('name', 'like', "%{$query}%");
                });

                // 🔍 Match issued_by user (if available)
                $inner->orWhereHas('issuedBy', function ($q4) use ($query) {
                    $q4->where('name', 'like', "%{$query}%");
                });
            });
        })
        ->when($categoryId, function ($q) use ($categoryId) {
            $q->whereHas('book', function ($q2) use ($categoryId) {
                $q2->where('category_id', $categoryId);
            });
        })
        ->latest()
        ->get();

    // ✅ Barcode generation
    $generator = new \Picqer\Barcode\BarcodeGeneratorHTML();
    $barcodes = [];

    foreach ($book_issues as $book_issue) {
        $barcodeText = (string) $book_issue->id;
        $barcodeHtml = $generator->getBarcode($barcodeText, $generator::TYPE_CODE_128);
        $issuedUser = \App\Models\User::find($book_issue->issued_id);

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
            'issued_name'    => $issuedUser->name ?? 'UNKNOWN',
            'issue_role'     => $issuedUser->role ?? 'UNKNOWN',
            'issue_date'     => $book_issue->issue_date ?? 'UNKNOWN',
            'status'         => $book_issue->status,
        ];
    }

    if ($book_issues->isEmpty()) {
        return "<p style='text-align:center;'>No results found.</p>";
    }

    return view('admin.overallbooks_table', compact('barcodes'))->render();
}
}