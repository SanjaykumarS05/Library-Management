<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use App\Models\Book_issue;

class OverallbookController extends Controller
{
    public function index(Request $request)
    {
        $books = Book::latest()->get();
        $categories = Category::latest()->get();
        $users = User::latest()->get();

        $issuedbook = Book_issue::whereIn('status', ['issued', 'overdue'])->count();
        $totalBooks = Book_issue::count();

        $book_issues = Book_issue::with(['book.category', 'user'])->latest()->paginate(50);
        $book_issues_count = $book_issues->count();

        $barcodes = $this->prepareBarcodeData($book_issues);

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
        $title = $request->input('title');
        $isbn = $request->input('isbn');
        $author = $request->input('author');
        $year = $request->input('year');
        $categoryId = $request->input('category_id');
        $status = $request->input('status');

        $book_issues = Book_issue::with(['book.category', 'user'])
            ->when($title, function ($q) use ($title) {
                $q->whereHas('book', function ($b) use ($title) {
                    $b->where('title', 'like', "%$title%");
                });
                $q->orWhere('book_issues.id', 'like', "%$title%");
            })
            ->when($isbn, function ($q) use ($isbn) {
                $q->whereHas('book', function ($b) use ($isbn) {
                    $b->where('isbn', 'like', "%$isbn%");
                });
            })
            ->when($author, function ($q) use ($author) {
                $q->whereHas('book', function ($b) use ($author) {
                    $b->where('author', 'like', "%$author%");
                });
            })
            ->when($year, function ($q) use ($year) {
                $q->whereHas('book', function ($b) use ($year) {
                    $b->where('publish_year', 'like', "%$year%");
                });
            })
            ->when($categoryId, function ($q) use ($categoryId) {
                $q->whereHas('book.category', function ($cat) use ($categoryId) {
                    $cat->where('id', $categoryId);
                });
            })
            ->when($status, function ($q) use ($status) {
                $q->where('status', $status);
            })
            ->latest()
            ->paginate(50);

        $barcodes = $this->prepareBarcodeData($book_issues);
        $countOnPage = $book_issues->count();
        return view('admin.overallbooks_table', compact('barcodes', 'countOnPage'))->render();
    }
    private function prepareBarcodeData($book_issues)
{
    $barcodes = [];

    foreach ($book_issues as $book_issue) {
        $issuedUser = User::find($book_issue->issued_id);
        $barcodePath = $book_issue->barcode_path ?? null;
        $barcodeImage = $barcodePath ? asset('storage/' . $barcodePath) : asset('storage/barcodes/default-barcode.png');
        $barcodes[] = [
            'barcodeImage'   => $barcodeImage,
            'barcodeText'    => $book_issue->id,
            'book_title'     => $book_issue->book->title ?? 'UNKNOWN',
            'user_name'      => $book_issue->user->name ?? 'UNKNOWN',
            'book_isbn'      => $book_issue->book->isbn ?? 'UNKNOWN',
            'book_author'    => $book_issue->book->author ?? 'UNKNOWN',
            'book_category'  => $book_issue->book->category->name ?? 'UNKNOWN',
            'book_publisher' => $book_issue->book->publish_year ?? 'UNKNOWN',
            'issued_name'    => $issuedUser->name ?? 'UNKNOWN',
            'issue_role'     => $issuedUser->role ?? 'UNKNOWN',
            'issue_date'     => $book_issue->issue_date ?? 'UNKNOWN',
            'return_date'    => $book_issue->return_date ?? '-',
            'status'         => ucfirst($book_issue->status ?? 'Issued'),
        ];
    }

    return $barcodes;
}
}