@extends('layout.template')
@section('title', 'Manage Users')
@section('header')
    <h1>Manage Users</h1>
@endsection
@section('content')
<p> User List</p>
<a href="{{ route('users.create') }}">Add Member</a>
<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role }}</td>
            <td>
                <a href="{{ route('users.edit', $user->id) }}">Edit</a>
                @if($user->id !== Auth::id())
                <form action="{{ route('users.delete', $user->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this user?');">Remove</button>
                </form>
                @else
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>   
</table>

@endsection
