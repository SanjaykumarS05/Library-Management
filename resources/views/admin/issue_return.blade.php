@extends('layout.template')
@section('title', 'Issue / Return Books')
@include('style.issuecss')

@section('content')

<div class="container issue-return">
   <h2 class="h2">📖 Issue / Return Books</h2>

   {{-- ================= ISSUE BOOK ================= --}}
    <div class="issue-book">
        <h3 class="h3">Issue a Book</h3>
        <form action="{{ route('book.issue') }}" method="POST" class="book-form">
            @csrf

            {{-- Select User --}}
            <div>
                <label for="user_id_issue">Select User:</label>
                <select name="user_id" id="user_id_issue" required>
                    <option value="" disabled selected>Select user</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}"      
                        {{ (isset($selectedUser) && $selectedUser->id == $user->id) ? 'selected' : '' }}>
                            {{ ucfirst($user->name) }} ({{ $user->role }})
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Select Book --}}
            <div>
                <label for="book_id">Select Book:</label>
                <select name="book_id" id="book_id" required>
                    <option value="" {{ isset($selectedBook) ? '' : 'selected' }}>Select book</option>
                    @foreach($books as $book)
                        @if($book->stock > 0)
                            <option value="{{ $book->id }}" 
                                {{ (isset($selectedBook) && $selectedBook->id == $book->id) ? 'selected' : '' }}>
                                {{ $book->title }} ({{ $book->stock }} available) 
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

    {{-- ================= RETURN BOOK ================= --}}
    <div class="return-book">
        <h3 class="h3">Return a Book</h3>
        <form action="{{ route('book.return') }}" method="POST" class="book-form">
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

<!-- ✅ Loading Overlay (hidden initially) -->
<div id="loading-overlay" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%;
     background:rgba(0,0,0,0.6); z-index:9999; justify-content:center; align-items:center;">
    <div style="background:#fff; padding:30px 40px; border-radius:10px; text-align:center;
                box-shadow:0 0 15px rgba(0,0,0,0.3); font-size:18px; color:#007bff;">
        <div style="border:4px solid #f3f3f3; border-top:4px solid #007bff; border-radius:50%;
                    width:40px; height:40px; animation:spin 1s linear infinite; margin:auto;"></div>
        <p style="margin-top:15px; font-weight:500;">Processing Request...</p>
    </div>
</div>

{{-- ========================= SCRIPT ========================= --}}
<script>
document.addEventListener('DOMContentLoaded', function() {

    // Filter issued books by user
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

    // ✅ Show overlay on form submit
    const forms = document.querySelectorAll('.book-form');
    const overlay = document.getElementById('loading-overlay');

    forms.forEach(form => {
        form.addEventListener('submit', function() {
            overlay.style.display = 'flex';
        });
    });
});

// Spinner animation
const style = document.createElement('style');
style.innerHTML = `
@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}`;
document.head.appendChild(style);
</script>

@endsection
