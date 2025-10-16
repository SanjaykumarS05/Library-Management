@extends('layout.template')
@section('title', 'Issue / Return Books')
@include('style.issuecss')

@section('content')

<div class="container issue-return">
   <h2 class="h2">📖 Issue / Return Books</h2>

    <div class="issue-book">
        <h3 class="h3">Issue a Book</h3>
        <form action="{{ route('staff.book.issue') }}" method="POST">
            @csrf

            {{-- Select User --}}
            <div>
                <label for="user_id_issue">Select User:</label>
                <select name="user_id" id="user_id_issue" required>
                    <option value="" disabled selected>Select user</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">
                            {{ ucfirst($user->name) }} ({{ $user->role }})
                        </option>
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
                                {{ $book->title }} by {{ $book->author }}-{{$book->isbn}} ({{ $book->stock }} available) 
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>

            <input type="hidden" name="issue_date" id="issue_date" value="{{ date('Y-m-d') }}" required>

            <button type="submit" class="button1">Issue Book</button>
        </form>
    </div>

    <hr>

    <div class="return-book">
        <h3 class="h3">Return a Book</h3>
        <form action="{{ route('staff.book.return') }}" method="POST">
            @csrf

            {{-- Select User --}}
            <div>
                <label for="user_id_return">Select User:</label>
                <select name="user_id_return" id="user_id_return" required>
                    <option value="" disabled selected>Select user</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">
                            {{ ucfirst($user->name) }} ({{ $user->role }})
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Select Issued Book --}}
            <div>
                <label for="issue_id">Select Issued Book:</label>
                <select name="issue_id" id="issue_id" required>
                    <option value="" disabled selected>Select issued book</option>
                    @foreach($book_issues1 as $issue)
                        <option value="{{ $issue->id }}" data-user="{{ $issue->user_id }}">
                            {{ $issue->book->title ?? 'Unknown Title' }}
                        </option>
                    @endforeach
                </select>
            </div>

            <input type="hidden" name="return_date" id="return_date" value="{{ date('Y-m-d') }}" required>

            <button type="submit" class="button1">Return Book</button>
        </form>
    </div>
</div>

{{-- ========================= SCRIPT ========================= --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const userSelect = document.getElementById('user_id_return');
    const issueSelect = document.getElementById('issue_id');
    const allOptions = Array.from(issueSelect.options);

    userSelect.addEventListener('change', function() {
        const selectedUser = this.value;
        issueSelect.innerHTML = '<option value="" disabled selected>Select issued book</option>';
        allOptions.forEach(option => {
            if (option.dataset.user === selectedUser) {
                issueSelect.appendChild(option);
            }
        });
    });
});
</script>

@endsection
