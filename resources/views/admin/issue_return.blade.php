@extends('layout.template')
@section('title', 'Issue / Return Books')
@include('style.issuecss')
@section('content')

<div class="container issue-return">
    <h2 class="h2">📖 Issue / Return Books</h2>

    <div class="issue-book">
        <h3 class="h3">Issue a Book</h3>
        <form action="{{ route('book.issue') }}" method="POST">
            @csrf

            <div>
                <label for="user_id">Select User:</label>
                <select name="user_id" id="user_id" required>
                    <option value="" disabled selected>Select user</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ ucfirst($user->name) }} ({{ $user->role }})</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="book_id">Select Book:</label>
                <select name="book_id" id="book_id" required>
                    <option value="" {{ isset($selectedBook) ? '' : 'selected' }}>Select book</option>
                    @foreach($books as $book)
                        @if($book->stock > 0)
                            <option value="{{ $book->id }}" 
                                {{ (isset($selectedBook) && $selectedBook->id == $book->id) ? 'selected' : '' }}>
                                {{ $book->title }} by {{ $book->author }} ({{ $book->stock }} available)
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>


            <div>
                <input type="date" name="issue_date" id="issue_date" value="{{ date('Y-m-d') }}" required hidden>
            </div>
            <button type="submit">Issue Book</button>
        </form>
    </div>

    <hr>

    <div class="return-book">
        <h3 class="h3">Return a Book</h3>
        <form action="{{ route('book.return') }}" method="POST">
            @csrf

            <div>
                <label for="issue_id">Select Issued Book:</label>
                <select name="issue_id" id="issue_id" required>
                    <option value="" disabled selected>Select issued book</option>
                    @foreach($book_issues as $issue)
                        <option value="{{ $issue->id }}">
                            {{ $issue->book->isbn ?? 'Unknown' }} - {{ $issue->book->title ?? 'Unknown Title' }} 
                            issued to {{ $issue->user->name ?? 'Unknown User' }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <input type="hidden" name="return_date" id="return_date" value="{{ date('Y-m-d') }}" required>
            </div>
            <button type="submit">Return Book</button>
        </form>
    </div>
</div>
@endsection
