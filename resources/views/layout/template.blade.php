<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Icons & Toastr -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @include('Style.templatecss')
</head>

<body class="{{ Auth::user()->profile->theme ?? 'light' }}">
    {{-- ================= Header ================= --}}
    <header>
        <div class="box" style="display: flex; justify-content: center; align-items: center;">
            {{-- Admin Search Bar --}}
            <h1>{{ $library->library_name ?? 'Library Management System' }}</h1>
            @if(auth()->user()->role === 'admin')
            <div class="search-container">
                <input type="text" id="searchBox" placeholder="Search" autocomplete="off" spellcheck="false">
                <button type="button" title="Search"><span class="material-icons">search</span></button>
                <a href="{{ route('barcode.index') }}"><span class="material-icons">qr_code_scanner</span></a>
                <button type="button" title="Notifications"><a href="{{ route('notifications') }}"><span class="material-icons">notifications</span></a></button>
                <button id="themeToggle" type="button" title="Toggle Theme" style="margin-left:10px;">
                    <span class="material-icons">
                        {{ (Auth::user()->profile->theme ?? 'light') === 'dark' ? 'light_mode' : 'dark_mode' }}
                    </span>
                </button>
            </div>
            @endif
            {{-- Staff Search Bar --}}
            @if(auth()->user()->role === 'staff')
            <div class="search-container">
                <input type="text" id="searchBoxStaff" placeholder="Search" autocomplete="off" spellcheck="false">
                <button type="button" title="Search"><span class="material-icons">search</span></button>
                <a href="{{ route('staff.barcode.index') }}"><span class="material-icons">qr_code_scanner</span></a>
                <button type="button" title="Notifications"><span class="material-icons">notifications</span></button>
            </div>
            @endif

            {{-- Logout --}}
            <form method="POST" style="margin-left: auto;">
                @csrf
                <button type="submit" class="button2" formaction="{{ route('logout') }}">Logout</button>
            </form>
        </div>
    </header>

    {{-- ================= Sidebar ================= --}}
    <aside>
        <div class="profile-header">
            <a href="{{ route('settings') }}">
                <img src="{{ Auth::user()->profile?->profile_image_path 
                    ? asset('storage/' . Auth::user()->profile->profile_image_path) 
                    : asset('images/default.png') }}" 
                    class="profile-logo" alt="Profile">
            </a>
            <div class="profile-info">
                <h2>Library System</h2>
                <p>{{ ucfirst(auth()->user()->role) }} Panel</p>
            </div>
        </div>
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
                <li><a href="{{ route('settings') }}">Settings</a></li>
            </ul>
            @endif
        </nav>
    </aside>

    {{-- ================= Main Content ================= --}}
    <main>
        <div class="content">
            @yield('content')
        </div>
        @yield('scripts')
    </main>

    {{-- ================= Scripts ================= --}}
    <script>
        // Prevent Enter reload in search
        const adminSearch = document.getElementById('searchBox');
        const staffSearch = document.getElementById('searchBoxStaff');
        [adminSearch, staffSearch].forEach(box => {
            if(box) box.addEventListener('keydown', e => { if(e.key==='Enter') e.preventDefault(); });
        });

        // Theme toggle with persistence
        const themeButton = document.getElementById('themeToggle');
        let theme = localStorage.getItem('theme') || "{{ Auth::user()->profile->theme ?? 'light' }}";
        document.body.classList.toggle('dark-mode', theme === 'dark');

        const icon = themeButton.querySelector('span');
        icon.textContent = theme === 'dark' ? 'light_mode' : 'dark_mode';

        themeButton.addEventListener('click', () => {
            const isDark = document.body.classList.toggle('dark-mode');
            const newTheme = isDark ? 'dark' : 'light';
            icon.textContent = isDark ? 'light_mode' : 'dark_mode';
            localStorage.setItem('theme', newTheme);

            

            // Update DB via AJAX
            $.post("{{ route('settings.updateTheme') }}", {
                _token: "{{ csrf_token() }}",
                theme: newTheme
            }, function(res){
                toastr.success(res.message);
            }).fail(function(){
                toastr.error('Failed to update theme');
            });
        });
        // Toastr notifications
        @if(session('success')) toastr.success("{{ session('success') }}"); @endif
        @if(session('error')) toastr.error("{{ session('error') }}"); @endif
        @foreach ($errors->all() as $error) toastr.error("{{ $error }}"); @endforeach
    </script>
</body>
</html>
