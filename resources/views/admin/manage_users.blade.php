@extends('layout.template')
@section('title', 'Manage Users')
@include ('style.managebookcss')
@section('content')
<h2 class="h2">Manage Users</h2>
<h3 class="h3"> User List</h3>
<a href="{{ route('users.create') }}" class="addbook"> ╋ Add Member</a>
<table border="1">
    <thead>
        <tr>
            <th>S.no</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Actions</th> 
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role }}</td>
            <td>
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
        @endforeach
    </tbody>   
</table>

@endsection
