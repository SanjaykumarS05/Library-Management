<table border="1">
    <thead>
        <tr>
            <th>S.no</th>
            <th>Categories</th>
            <th>Description</th>
            <th class="no-export">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($categories as $index => $category)
        <tr class="fw-bold">
            <td>{{ $categories->firstItem() + $index }}</td>
            <td>{{ $category->name }}</td>
            <td>{{ $category->description }}</td>
            <td class="no-export">
                <a href="{{ route('categories.edit', $category->id) }}">Edit</a>
                <form action="{{ route('categories.delete', $category->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="button1" onclick="return confirm('Are you sure you want to delete this category?');">Remove</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="text-center">No categories found.</td>
        </tr>
        @endforelse
    </tbody>
</table>
<div class="no-export">
<div class="pagination-wrapper" >
            {{ $categories->links('pagination::bootstrap-5') }}
</div>
</div>