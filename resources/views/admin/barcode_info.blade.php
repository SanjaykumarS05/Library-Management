@extends('layout.template')

@section('title', 'Book Info')
@section('header')
    <h1>Book Details & Issue/Return</h1>
@endsection

@section('content')
<div class="container">
    <center>
        <h3>Book Information</h3>

        <div class="barcode-card" style="max-width:500px; margin-top:20px;">
            <h4>{{ $bookData['title'] }}</h4>
        </div>
        <div>
        <label for="isbn"><strong>ISBN:</strong></label>
        <input type="text" id="isbn" value="{{ $bookData['isbn'] }}" readonly >
        </div>  
        <div>
        <label for="author"><strong>Author:</strong></label>
        <input type="text" id="author" value="{{ $bookData['author'] }}" readonly >
        </div>
        <div>
        <label for="category"><strong>Category:</strong></label>
        <input type="text" id="category" value="{{ $bookData['category'] }}" readonly >
        </div>
        <div>
        <label for="publish_year"><strong>Publisher:</strong></label>
        <input type="text" id="publisher" value="{{ $bookData['publish_year'] }}" readonly >
        </div>
        @if($bookData['status'] == 'Issued')
        <div>
        <label for="issued_name"><strong>Issued By:</strong></label>
        <input type="text" id="issued_name" value="{{ $bookData['issued_name'] }} ({{ $bookData['issue_role'] }})" readonly >
        </div>
        <div>
        <label for="user_name"><strong>Issued To:</strong></label>
        <input type="text" id="user_name" value="{{ $bookData['user_name'] }}" readonly >
        </div>
        <div>
        <label for="issue_date"><strong>Issue Date:</strong></label>
        <input type="text" id="issue_date" value="{{ $bookData['issue_date'] }}" readonly >
        </div>
        @endif
        <div>
        <label for="status"><strong>Status:</strong></label>
        <input type="text" id="status" value="{{ $bookData['status'] }}" readonly >
        <div>
         <center><span class="barcode1">{!! $bookData['barcode'] !!}</span></center>
        </div>
</div>

        @if($bookData['status'] == 'Issued')
            <form action="{{ route('book.return') }}" method="POST" style="margin-top:15px;">
                @csrf
                <input type="hidden" name="issue_id" value="{{ $book_issue->id }}">
                <input type="hidden" name="user_id_return" value="{{ $book_issue->user_id }}">
                <label for="return_date"><strong>Return Date:</strong></label>
                <input type="date" name="return_date" value="{{ date('Y-m-d') }}" required>
                <button type="submit" class="buttons" style="background-color:#f44336; margin-left:10px;">Return Book</button>
            </form>
        @else
            <form action="{{ route('book.issue') }}" method="POST" style="margin-top:15px;">
                @csrf
                <input type="hidden" name="book_id" value="{{ $bookData['book_id'] }}">

                <label for="user_id"><strong>Issue To:</strong></label>
                <select name="user_id" id="user_id" required>
                    <option value="">Select User</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->role }})</option>
                    @endforeach
                </select>

                <label for="issue_date"><strong>Issue Date:</strong></label>
                <input type="date" name="issue_date" value="{{ date('Y-m-d') }}" required>

                <button type="submit" class="buttons" style="background-color:#4CAF50; margin-left:10px;">Issue Book</button>
            </form>
        @endif
        <br>
        <a href="{{ route('barcode.index') }}" class="buttons" style="background-color:#2196F3;">Back to Scanner</a>
    </center>
</div>
@endsection
