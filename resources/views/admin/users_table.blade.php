<table border="1">
    <thead>
        <tr>
            <th>S.no</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Fine</th>
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
            <td>₹{{ $user->fine ?? '0' }}</td>
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
<div class="no-export">
<div class="pagination-wrapper" >
            {{ $users->links('pagination::bootstrap-5') }}
</div>

</div>