<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use App\Models\Book_issue;
use App\Models\Library;
use App\Models\BookRequest;
use Illuminate\Support\Facades\Auth;
use App\Notifications\BookNotification;
use Picqer\Barcode\BarcodeGeneratorPNG;
use Illuminate\Support\Facades\Storage;


class BookIssueController extends Controller
{
   
    public function showIssueReturnForm()
    {
        $users = User::select('id', 'name', 'role')->get();
        $books = Book::select('id', 'title', 'stock')->where('stock', '>', 0)->get();
        $book_issues = Book_issue::where('user_id', Auth::id())->get();
        $book_issues1 = Book_issue::whereIn('status', ['Issued', 'Overdue'])->get();
        return view('admin.issue_return', compact('books', 'book_issues', 'users', 'book_issues1'));
    }
    public function issueBook(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'user_id' => 'required|exists:users,id',
            'issue_date' => 'required|date',
        ]);

        $book = Book::findOrFail($request->book_id);

        
        $alreadyIssued = Book_issue::where('user_id', $request->user_id)
            ->where('book_id', $book->id)
            ->whereIn('status', ['Issued', 'Overdue'])
            ->exists();

        if ($alreadyIssued) {
            return back()->with('error', 'User already has this book issued. Return it first.');
        }

        if ($book->stock <= 0) {
            return back()->with('error', 'Book is out of stock!');
        }

        $bookIssue = Book_issue::create([
            'book_id' => $book->id,
            'user_id' => $request->user_id,
            'issued_id' => Auth::id(),
            'issue_date' => $request->issue_date,
            'status' => 'Issued',
        ]);

        $generator = new BarcodeGeneratorPNG();
        $barcodeText = (string) $bookIssue->id;
        $barcodeImage = $generator->getBarcode($barcodeText, $generator::TYPE_CODE_128);
        $barcodePath = 'barcodes/barcode_' . $barcodeText . '.png';
        Storage::disk('public')->put($barcodePath, $barcodeImage);
        $bookIssue->barcode_path = $barcodePath;
        $bookIssue->save();
        $barcodeImageData = base64_encode($barcodeImage);

        $book->stock -= 1;
        $book->availability = $book->stock > 0 ? 'Yes' : 'No';
        $book->save();
       
        $bookRequest = BookRequest::where('book_id', $book->id)
            ->where('user_id', $request->user_id)
            ->where('status', 'pending')
            ->first();
        if ($bookRequest) {
            $bookRequest->status = 'approved';
            $bookRequest->save();
        }
        
        $user = User::findOrFail($request->user_id);
        $library = Library::first();
        $data = [
            'recipient_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'subject' => 'Book Issued Notification from ' . ($library->library_name ?? 'Library'),
            'message' => "The book '{$book->title}' has been issued to you on {$request->issue_date}. Please return it on time to avoid late fees.",
            'type' => 'Book Issued Notification',
            'due_date' => now()->addDays(14)->toDateString(),
            'barcode_path' => $bookIssue->barcode_path,
            'id' => $bookIssue->id,
            'library_name' => $library->library_name ?? 'Library',
        ];
        $user->notify(new BookNotification($data));
        return redirect()->route('barcode.index')->with('success', 'Book issued successfully!');
    }


    public function returnBook(Request $request)
    {
        $request->validate([
            'issue_id' => 'required|exists:book_issues,id',
            'user_id_return' => 'required|exists:users,id',
            'return_date' => 'required|date',
        ]);

        $bookIssue = Book_issue::where('id', $request->issue_id)
            ->where('user_id', $request->user_id_return)
            ->first();

        if (!$bookIssue) {
            return back()->with('error', 'Selected user did not issue this book.');
        }

        if ($bookIssue->status === 'Returned') {
            return back()->with('error', 'This book has already been returned.');
        }

        $overdue= Book_issue::where('id', $request->issue_id)
            ->where('user_id', $request->user_id_return)
            ->where('status', 'Overdue')
            ->get();
        if ($overdue->count() > 0) {
            return view('admin.overdue', compact('overdue'));
        }

  
        $bookIssue->status = 'Returned';
        $bookIssue->return_date = $request->return_date;
        $bookIssue->save();

    
        $book = Book::findOrFail($bookIssue->book_id);
        $book->stock += 1;
        $book->availability = $book->stock > 0 ? 'Yes' : 'No';
        $book->save();


        $bookRequest = BookRequest::where('book_id', $book->id)
            ->where('user_id', $request->user_id_return)
            ->where('status', 'approved')
            ->first();

        if ($bookRequest) {
            $bookRequest->status = 'returned';
            $bookRequest->save();
        }


        $user = User::findOrFail($request->user_id_return);
        $library = Library::first();
        $data = [
            'recipient_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'subject' => 'Book Return Notification from ' . ($library->library_name ?? 'Library'),
            'message' => "The book '{$book->title}' has been returned on {$request->return_date}.",
            'type' => 'Book Returned Notification',
            'barcode_path' => $bookIssue->barcode_path,
            'id' => $bookIssue->id,
            'library_name' => $library->library_name ?? 'Library',
        ];
        $user->notify(new BookNotification($data));

        return redirect()->route('barcode.index')->with('success', 'Book returned successfully!');
    }

 
    public function issueReturn($bookId = null, $userId = null)
    {
        $users = User::all();
        $books = Book::all();
        $book_issues1 = Book_issue::whereIn('status', ['Issued', 'Overdue'])->get();
        $selectedBook = $bookId ? Book::find($bookId) : null;
        $selectedUser = $userId ? User::find($userId) : null;

        return view('admin.issue_return', compact('users', 'books', 'book_issues1', 'selectedBook', 'selectedUser'));
    }

   public function returnBookPayment(Request $request)
{
  
    $request->validate([
        'issue_id' => 'required',
        'user_id_return' => 'required',
        'fine_amount' => 'required|numeric',
        'payment_method' => 'required'
    ]);

   
    $bookIssue = Book_issue::where('id', $request->issue_id)
        ->where('user_id', $request->user_id_return)
        ->where('status', 'Overdue')
        ->firstOrFail();

   
    $bookIssue->status = 'Returned';
    $bookIssue->return_date = now();
    $bookIssue->save();

    $bookIssue->fine_amount = (int)$request->fine_amount;
    $bookIssue->save();
   
    $book = Book::findOrFail($bookIssue->book_id);
    $book->stock += 1;
    $book->availability = $book->stock > 0 ? 'Yes' : 'No';
    $book->save();
    $user = User::findOrFail($request->user_id_return);
    $user->fine += (int)$request->fine_amount;
    $user->save();

    return redirect()->route('barcode.index')->with('success', 'Payment processed successfully!');
}

}
