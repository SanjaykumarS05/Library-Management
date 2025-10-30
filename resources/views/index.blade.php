<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @include('Style.style')
       
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-book-open me-2"></i>{{ $libraries->library_name ?? 'LibrarySystem' }}
            </a>
            <div class="d-flex">
                <button class="btn btn-outline-primary me-2" onclick="openModal('authModal', 'login')">Sign In</button>
                <button class="btn btn-primary" onclick="openModal('authModal', 'register')">Sign Up</button>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-5 fw-bold mb-4">Simple Library Management</h1>
                    <p class="lead mb-4">Easily manage books, members, and loans with our intuitive system.</p>
                    <div class="d-flex gap-3">
                        <a href="#features" class="btn btn-light btn-lg">Learn More</a>
                        <button class="btn btn-outline-light btn-lg" onclick="openModal('authModal', 'register')">Get Started</button>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="https://images.unsplash.com/photo-1481627834876-b7833e8f5570?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" 
                         alt="Library" class="img-fluid rounded">
                </div>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section id="features" class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Key Features</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card feature-card h-100 text-center p-4">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-book"></i>
                        </div>
                        <h4>Book Management</h4>
                        <p>Catalog and organize your book collection with ease.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card feature-card h-100 text-center p-4">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-users"></i>
                        </div>
                        <h4>Member Management</h4>
                        <p>Track members and their borrowing history.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card feature-card h-100 text-center p-4">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <h4>Reports</h4>
                        <p>Generate insights with comprehensive reports.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card feature-card h-100 text-center p-4">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <h4>Tracking</h4>
                        <p>Monitor book loans and returns effectively.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card feature-card h-100 text-center p-4">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-cogs"></i>
                        </div>
                        <h4>Customizable Settings</h4>
                        <p>Adjust system settings to fit your library's needs.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card feature-card h-100 text-center p-4">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <h4>Sent Notifications</h4>
                        <p>Keep users informed with timely notifications.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Latest Books Section - Updated to match features styling -->
    <section id="latest-books" class="py-5 bg-light">
        
        <div class="container">
            <h2 class="text-center mb-5">Latest Books</h2>
            <div class="row g-4">
                @foreach($books as $book)
                    <div class="col-md-4">
                        <div class="card book-card h-100 text-center p-4">
                            <div class="book-icon mb-3">
                                <i class="fas fa-book"></i>
                            </div>
                            <img src="{{ asset('storage/' . $book->image_path) }}" alt="{{ $book->title }}" class="book-image mb-3">
                            <div class="card-body p-0">
                                <h4 class="card-title">{{ $book->title }}</h4>
                                <p class="card-text text-muted">{{ $book->author }}</p>
                                <p class="card-text"><small class="text-primary">{{ $book->category->name }}</small></p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5">How It Works</h2>
            <div class="row">
                <div class="col-md-4 text-center mb-4">
                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                         style="width: 70px; height: 70px;">
                        <h4 class="mb-0">1</h4>
                    </div>
                    <h4>Sign Up</h4>
                    <p>Create your account in minutes</p>
                </div>
                <div class="col-md-4 text-center mb-4">
                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                         style="width: 70px; height: 70px;">
                        <h4 class="mb-0">2</h4>
                    </div>
                    <h4>Search Books</h4>
                    <p>Find the books you need quickly</p>
                </div>
                <div class="col-md-4 text-center mb-4">
                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                         style="width: 70px; height: 70px;">
                        <h4 class="mb-0">3</h4>
                    </div>
                    <h4>Request Books</h4>
                    <p>Submit requests for the books you need</p>
                </div>
                <div class="col-md-4 text-center mb-4">
                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                         style="width: 70px; height: 70px;">
                        <h4 class="mb-0">4</h4>
                    </div>
                    <h4>Start Managing</h4>
                    <p>Begin tracking loans and members</p>
                </div>
                <div class="col-md-4 text-center mb-4">
                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                         style="width: 70px; height: 70px;">
                        <h4 class="mb-0">5</h4>
                    </div>
                    <h4>Return Books</h4>
                    <p>Return borrowed books to the library</p>
                </div>
                <div class="col-md-4 text-center mb-4">
                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                         style="width: 70px; height: 70px;">
                        <h4 class="mb-0">6</h4>
                    </div>
                    <h4>View Reports</h4>
                    <p>Access detailed reports on loans and members</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Sign Up Section -->
    <section id="signup" class="py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <h2 class="mb-4">Ready to Get Started?</h2>
                    <p class="lead mb-4">Join hundreds of libraries using our system</p>
                    <button class="btn btn-primary btn-lg" onclick="openModal('authModal', 'register')">Create Your Account</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Auth Modal -->
    <div class="modal-bg" id="authModal">
        <div class="modal-box">
            <button class="close-btn" onclick="closeModal('authModal')">✖</button>
            
            <div class="auth-tabs">
                <div class="auth-tab active" id="loginTab" onclick="switchTab('login')">Sign In</div>
                <div class="auth-tab" id="registerTab" onclick="switchTab('register')">Sign Up</div>
            </div>
            
            <!-- Login Form - Regular form submission (not AJAX) -->
            <form class="auth-form active" id="loginForm" method="POST" action="{{ route('submit') }}">
                @csrf
                <div class="input-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required value="{{ old('email') }}">
                    <i class="material-icons input-icon">email</i>
                </div>

                <div class="input-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                    <i class="material-icons input-icon">lock</i>
                    <div class="show-password">
                        <input type="checkbox" onclick="togglePassword('password')"> Show Password
                    </div>
                </div>

                <div class="input-group">
                    <button type="submit" class="submit-btn">Login</button>
                </div>
                
                <div class="auth-footer">
                    <p>Don't have an account? <a href="#" onclick="switchTab('register')">Sign up</a></p>
                </div>
            </form>
            
            <!-- Register Form - Regular form submission (not AJAX) -->
            <form class="auth-form" id="registerForm" method="POST" action="{{ route('store') }}">
                @csrf
                <div class="input-group">
                    <label for="name">Full Name:</label>
                    <input type="text" id="name" name="name" placeholder="Enter your full name" required value="{{ old('name') }}">
                    <i class="material-icons input-icon">person</i>
                    @error('name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="input-group">
                    <label for="registerEmail">Email:</label>
                    <input type="text" id="registerEmail" name="email" placeholder="Enter your email" value="{{ old('email') }}">
                    <i class="material-icons input-icon">email</i>
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="input-group">
                    <label for="registerPassword">Password:</label>
                    <input type="password" id="registerPassword" name="password" placeholder="Create a password (min. 6 characters)" required>
                    <i class="material-icons input-icon">lock</i>
                    <div class="show-password">
                        <input type="checkbox" onclick="togglePassword('registerPassword')"> Show Password
                    </div>
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="input-group">
                    <label for="password_confirmation">Confirm Password:</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm your password" required>
                    <i class="material-icons input-icon">lock</i>
                </div>

                <!-- Hidden role field as required by UserRequest -->
                <input type="hidden" name="role" value="user">

                <div class="input-group">
                    <button type="submit" class="submit-btn">Register</button>
                </div>
                
                <div class="auth-footer">
                    <p>Have an account? <a href="#" onclick="switchTab('login')">Sign in</a></p>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->

    @include('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        
        // Modal functionality
        function openModal(modalId, tab = 'login') {
            document.getElementById(modalId).style.display = "flex";
            switchTab(tab);
        }
        
        function closeModal(modalId) {
            document.getElementById(modalId).style.display = "none";
        }
        
        // Switch between login and register tabs
        function switchTab(tab) {
            const loginTab = document.getElementById('loginTab');
            const registerTab = document.getElementById('registerTab');
            const loginForm = document.getElementById('loginForm');
            const registerForm = document.getElementById('registerForm');
            
            if (tab === 'login') {
                loginTab.classList.add('active');
                registerTab.classList.remove('active');
                loginForm.classList.add('active');
                registerForm.classList.remove('active');
            } else {
                registerTab.classList.add('active');
                loginTab.classList.remove('active');
                registerForm.classList.add('active');
                loginForm.classList.remove('active');
            }
        }
        
        // Toggle password visibility
        function togglePassword(inputId) {
            const passwordInput = document.getElementById(inputId);
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        }
        
        // Close modal when clicking outside
        window.addEventListener('click', function(event) {
            if (event.target.classList.contains('modal-bg')) {
                event.target.style.display = 'none';
            }
        });

        // Auto-open modal if there are validation errors or session directive
        document.addEventListener('DOMContentLoaded', function() {
            @if($errors->any())
                openModal('authModal', 'register');
            @endif
            
            @if(session('openModal'))
                openModal('authModal', '{{ session('openModal') }}');
            @endif
        });
        
        // Toastr notifications
        @if(session('success'))
            toastr.success("{{ session('success') }}");
        @endif
        @if(session('error'))
            toastr.error("{{ session('error') }}");
        @endif
    </script>
</body>
</html>