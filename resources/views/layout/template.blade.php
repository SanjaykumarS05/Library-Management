<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</head>
<body>
    @include('Style.templatecss')
    <header>
        <div class="box" style="display: flex; justify-content: center; align-items: center;">
            <h1>Library Management System</h1>
            @if(auth()->user()->role === 'admin')
            <div class="search-container">
                <input type="text" placeholder="Search">
                <button title="Search"><span class="material-icons">search</span></button>
                <a href="{{ route('barcode.index') }}"><span class="material-icons">qr_code_scanner</span></a>
                </div>
            @endif  

            @if(auth()->user()->role === 'staff')
            <div class="search-container">
                <input type="text" placeholder="Search">
                <button title="Search"><span class="material-icons">search</span></button>
                <a href="{{ route('staff.barcode.index') }}"><span class="material-icons">qr_code_scanner</span></a>
                </div>
            @endif
            <form method="POST" style="margin-left: auto;">
                @csrf
                <button type="submit" formaction="{{ route('logout') }}" style="margin-left: 20px; padding: 8px 16px; background-color: #e74c3c; color: white; border: none; border-radius: 4px; cursor: pointer;">Logout</button>
            </form>
</div>
    </header>

    <aside>
        <h2>Library System</h2>
        <p>{{ ucfirst(auth()->user()->role) }} Panel</p>
        <hr>
        <h3>{{ ucfirst(auth()->user()->name) }}</h3>
        <p>{{ auth()->user()->email }}</p>
        <hr>
        <nav>
            @if(auth()->user()->role === 'admin')
            <ul>
                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li><a href="{{ route('search') }}">Search Books</a></li>
                <li><a href="{{ route('books') }}">Manage Books</a></li>
                <li><a href="{{ route('users') }}">Manage Users</a></li>
                <li><a href="{{ route('categories.index') }}">Manage Categories</a></li>
                <li><a href="{{ route('overallbook.index') }}">Overall Issued Books</a></li>
                <li><a href="{{ route('books.issue_return') }}">Issue / Return Books</a></li>
                <li><a href="{{ route('barcode.index') }}">Barcode</a></li>
                <li><a href="{{ route('reports.index') }}">Reports</a></li>
                <li><a href="{{ route('settings') }}">Settings</a></li>
                
            </ul>
            @endif

            @if(auth()->user()->role === 'staff')
            <ul>
                <li><a href="{{ route('staff.dashboard') }}">Dashboard</a></li>
                <li><a href="{{ route('staff.search') }}">Search Books</a></li>
                <li><a href="{{ route('staff.books') }}">Manage Books</a></li>
                <li><a href="{{ route('staff.categories.index') }}">Manage Categories</a></li>
                <li><a href="{{ route('staff.overallbook.index') }}">Overall Issued Books</a></li>
                <li><a href="{{ route('staff.books.issue_return') }}">Issue / Return Books</a></li>
                <li><a href="{{ route('staff.barcode.index') }}">Barcode</a></li>
                <li><a href="{{ route('staff.reports.index') }}">Reports</a></li>
                <li><a href="">Settings</a></li>
            </ul>
            @endif
    </aside>

    <main>
        <div class="content">
        @yield('content')
        </div>
        @yield('scripts')
    </main>

    <script>
        @if(session('success'))
            toastr.success("{{ session('success') }}");
        @endif

        @if(session('error'))
            toastr.error("{{ session('error') }}");
        @endif
        @foreach ($errors->all() as $error)
            toastr.error("{{ $error }}");
        @endforeach
    </script> 
</body>
</html>
