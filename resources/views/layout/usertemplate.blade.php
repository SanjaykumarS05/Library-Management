<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Icons & Toastr -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @include('Style.templatecss')
</head>

<body class="{{ Auth::user()->profile->theme ?? 'light' }}">
    {{-- ================= Header ================= --}}
    <header>
        <i class="material-icons" id="menuToggle">menu</i>
        <div class="box" style="display: flex; justify-content: center; align-items: center;">
            {{-- User Search Bar --}}
            <h1  style="margin-right: 50px;">{{ $library->library_name ?? 'Library Management System' }}</h1>
            <div class="search-container">
                <form id="headerSearchForm" method="GET" style="display:flex; align-items:center;">
                    <input type="text" name="query" id="searchBox" placeholder="Search">
                    <button type="submit"><span class="material-icons">search</span></button>
                </form>
                <a href="{{ route('user.notifications') }}"><span class="material-icons">notifications</span></a>
                <button id="themeToggle" type="button" title="Toggle Theme" style="margin-left:10px;">
                    <span class="material-icons">
                        {{ (Auth::user()->profile->theme ?? 'light') === 'dark' ? 'light_mode' : 'dark_mode' }}
                    </span>
                </button>
            </div>
            {{-- Logout --}}
            <form method="POST" style="margin-left: auto;">
                @csrf
                <button type="submit" class="button2" formaction="{{ route('logout') }}">➜] Logout</button>
            </form>
        </div>
    </header>

    {{-- ================= Sidebar ================= --}}
    <aside>
        <div class="profile-header">
            <a href="{{ route('user.settings') }}">
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
            <ul>
                <li><a href="{{ route('dashboard') }}" class="{{ request()->routeIs('user.dashboard') ? 'active' : '' }}">Dashboard</a></li>
                <li><a href="{{ route('user.browse_library') }}" class="{{ request()->routeIs('user.browse_library') ? 'active' : '' }}">Browse Library</a></li>
                <li><a href="{{ route('user.search') }}" class="{{ request()->routeIs('user.search') ? 'active' : '' }}">Search Books</a></li>
                <li><a href="{{ route('book-requests.index') }}" class="{{ request()->routeIs('book-requests.index') ? 'active' : '' }}">Book Request</a></li>
                <li><a href="{{ route('user.history') }}" class="{{ request()->routeIs('user.history') ? 'active' : '' }}">My History</a></li>
                <li><a href="{{ route('user.settings') }}" class="{{ request()->routeIs('user.settings') ? 'active' : '' }}">Settings</a></li>
            </ul>
        </nav>
    </aside>

    {{-- ================= Main Content ================= --}}
    <main>
        <div class="content">
            @yield('content')
        </div>
        @yield('scripts')
    </main>
    <footer>
        <p>&copy; {{ now()->year }} {{ $library->library_name ?? 'Library Management System' }}. All rights reserved.<span class="social-media">
                            <a href="{{ $library->facebook ?? '#' }}"><i class="fa fa-facebook"></i></a>
                            <a href="{{ $library->twitter ?? '#' }}"><i class="fa fa-twitter"></i></a>
                            <a href="{{ $library->instagram ?? '#' }}"><i class="fa fa-instagram"></i></a>
                            <a href="{{ $library->youtube ?? '#' }}"><i class="fa fa-youtube"></i></a>
                        </span></p>
    </footer>

    <!-- ================= Footer ================= -->
  
    {{-- ================= Scripts ================= --}}
    <script>
        @if(session('success')) toastr.success("{{ session('success') }}"); @endif
        @if(session('error')) toastr.error("{{ session('error') }}"); @endif
        @foreach ($errors->all() as $error) toastr.error("{{ $error }}"); @endforeach
        
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
            $.post("{{ route('user.settings.updateTheme') }}", {
                _token: "{{ csrf_token() }}",
                theme: newTheme
            }, function(res){
                toastr.success(res.message);
            }).fail(function(){
                toastr.error('Failed to update theme');
            });
        });

         // Sidebar toggle
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.querySelector('aside');
        const mainContent = document.querySelector('main');

        menuToggle.addEventListener('click', function() {
            sidebar.classList.toggle('closed');
            mainContent.classList.toggle('full-width');
        });
        
        // 🖨️ Print Report
        function printReport() {
        let tableClone = document.getElementById('report-table').cloneNode(true);

        // Remove 'Actions' column before printing
        tableClone.querySelectorAll('.no-export').forEach(el => el.remove());

        const printWindow = window.open('', '', 'height=600,width=800');
        printWindow.document.write(`
            <html>
                <head>
                    <title>Book Report</title>
                    <style>
                        table { border-collapse: collapse; width: 100%; }
                        th, td { border: 1px solid #333; padding: 6px; text-align: left; }
                        h2 { text-align: center; }
                    </style>
                </head>
                <body>
                    <h2>Library Book Report</h2>
                    ${tableClone.innerHTML}
                </body>
            </html>
        `);
        printWindow.document.close();
        printWindow.print();
    }

            // 📊 Export to Excel
            function exportToExcel() {
                let tableClone = document.getElementById('report-table').cloneNode(true);
                tableClone.querySelectorAll('.no-export').forEach(el => el.remove());

                const tableHTML = `
                    <html xmlns:o="urn:schemas-microsoft-com:office:office" 
                        xmlns:x="urn:schemas-microsoft-com:office:excel" 
                        xmlns="http://www.w3.org/TR/REC-html40">
                    <head><meta charset="utf-8"></head>
                    <body>${tableClone.innerHTML}</body>
                    </html>`;

                const a = document.createElement('a');
                a.href = 'data:application/vnd.ms-excel,' + encodeURIComponent(tableHTML);
                a.download = 'book_report.xls';
                a.click();
            }
            
            document.getElementById('headerSearchForm').addEventListener('submit', function(e) {
                e.preventDefault(); // Prevent default form submission
                const query = document.getElementById('searchBox').value.toLowerCase().trim();
                let url = "{{ route('user.search') }}"; // default action

                // Conditional routing based on query keywords
                if(query.includes("dashboard")) {
                    url = "{{ route('user.dashboard') }}";
                } else if(query.includes("browse")) {
                    url = "{{ route('user.browse_library') }}";
                } else if(query.includes("search")) {
                    url = "{{ route('user.search') }}";
                } else if(query.includes("my history")) {
                    url = "{{ route('user.history') }}";
                } else if(query.includes("book request")) {
                    url = "{{ route('book-requests.index') }}";
                } else if(query.includes("settings")) {
                    url = "{{ route('user.settings') }}";
                } else if(query.includes("notification")) {
                    url = "{{ route('user.notifications') }}";
                }
                // Redirect to the chosen URL with the query as GET parameter if needed
                window.location.href = url + (url === "{{ route('user.search') }}" ? "?query=" + encodeURIComponent(query) : "");
            });
        </script>
    </body>
    </html>
