@extends('layout.template')
@section('title', 'Manage Users')
@include ('style.managebookcss')

@section('content')
<h2 class="h2">Manage Users</h2>

<!-- Search Bar -->
<div class="search-bar" style="margin:10px 0;">
    <input type="text" id="search" placeholder="Search by Name , Email , Role" style="width:300px; padding:5px;">
</div>

<a href="{{ route('users.create') }}" class="addbook">╋ Add Member</a>

<div style="margin-top:10px;">
            <button type="button" class="btn btn-success" onclick="printReport()">Print Report</button>
            <button type="button" class="btn btn-warning" onclick="exportToExcel()">Export to Excel</button>
        </div>
        <br>

<!-- Users Table -->
 <div id="report-table">
<div id="users-table">
    <table border="1">
        <thead>
            <tr>
                <th>S.no</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th class="no-export">Actions</th> 
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td class="no-export">
                    @if($user->id !== Auth::id())
                    <a href="{{ route('users.edit', $user->id) }}">Edit</a>
                    <form action="{{ route('users.delete', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="button1" onclick="return confirm('Are you sure you want to delete this user?');">Remove</button>
                    </form>
                    @else
                    Can't Edit/Delete Self
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">No users found.</td>
            </tr>
            @endforelse
        </tbody>   
    </table>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#search').on('keyup', function() {
        let query = $(this).val();
        $.ajax({
            url: "{{ route('users') }}",
            type: 'GET',
            data: { search: query },
            success: function(response) {
                $('#users-table').html(response);
            }
        });
    });
});
</script>
@endsection
