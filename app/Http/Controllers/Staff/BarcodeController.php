<?php

namespace App\Http\Controllers\Staff;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use App\Models\Book_issue;
use Picqer\Barcode\BarcodeGeneratorHTML;

class BarcodeController extends Controller
{
    public function index(Request $request)
    {
        $books = Book::all();
        $categories = Category::all();
        $users = User::all();
        $bookModel = Book::find($request->input('book_id'));

        $book_issues_only = Book_issue::with(['book.category', 'user'])
            ->where('status', 'issued')
            ->get();

        $issued_id = auth()->id();
        $book_issues_count = $book_issues_only->count();

        $generator = new BarcodeGeneratorHTML();
        $barcodes = [];

        foreach ($book_issues_only as $book_issue) {

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

        return view('staff.barcode', compact('barcodes', 'books', 'categories', 'users', 'bookModel', 'book_issues_count'));
    }

    public function getBookInfo($barcode)
    {
        $book_issue = Book_issue::with(['book.category', 'user'])->where('id', $barcode)->first();

        if (!$book_issue) {
            return response()->json(['success' => false, 'message' => 'Book not found']);
        }

        $generator = new BarcodeGeneratorHTML();
        $barcodeHtml = $generator->getBarcode($book_issue->id, $generator::TYPE_CODE_128);

        $issuedUser = User::find($book_issue->issued_id);

        return response()->json([
            'success' => true,
            'book' => [
                'title' => $book_issue->book->title ?? 'UNKNOWN',
                'isbn' => $book_issue->book->isbn ?? 'UNKNOWN',
                'author' => $book_issue->book->author ?? 'UNKNOWN',
                'category' => $book_issue->book->category->name ?? 'UNKNOWN',
                'publish_year' => $book_issue->book->publish_year ?? 'UNKNOWN',
                'issued_id' => $book_issue->issued_id ?? 'UNKNOWN',
                'user_name' => $book_issue->user->name ?? 'UNKNOWN',
                'issue_date' => $book_issue->issue_date ?? 'UNKNOWN',
                'status' => $book_issue->status ?? 'UNKNOWN',
                'barcode' => $barcodeHtml,
            ],
        ]);
    }
}
