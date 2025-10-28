<footer>
    <div class="footer-area">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h4 class="footer-heading">{{ $libraries->library_name ?? 'LibrarySystem' }}</h4>
                    <div class="footer-underline"></div>
                    <p>
                        Our library management system is designed to provide a seamless and user-friendly experience for
                        readers and administrators. We aim to promote knowledge, encourage reading habits, and make
                        accessing books easier than ever.
                    </p>
                </div>
                <div class="col-md-3">
                    <h4 class="footer-heading">Quick Links</h4>
                    <div class="footer-underline"></div>
                    <div class="mb-2"><a href="{{ route('dashboard') }}" class="text-white">Dashboard</a></div>
                    <div class="mb-2"><a href="{{ route('home') }}" class="text-white">Home Page</a></div>
                    <div class="mb-2"><a href="https://sanjaykumarsachinsk.blogspot.com/" class="text-white">Blogs</a></div>
                </div>
                <div class="col-md-3">
                    <h4 class="footer-heading">Library Details</h4>
                    <div class="footer-underline"></div>
                    <div class="mb-2">Timing: {{ $libraries->working_hours ?? '9 AM - 5 PM' }}</div>
                    <div class="mb-2">Location: Pattabira, Avadi, Chennai -600072</div>
                    <div class="mb-2">Collections: Fiction, Non-Fiction, Science, History</div>
                </div>
                <div class="col-md-3">
                    <h4 class="footer-heading">Reach Us</h4>
                    <div class="footer-underline"></div>
                    <div class="mb-2">
                        <p>
                            <i class="fa fa-map-marker"></i>
                            {{ $libraries->address ?? 'Pattabira, Avadi, Chennai -600072' }}
                        </p>
                    </div>
                    <div class="mb-2">
                        <a href="#" class="text-white">
                            <i class="fa fa-phone"></i> {{ $libraries->contact_phone ?? '+91 7708151456' }}
                        </a>
                    </div>
                    <div class="mb-2">
                        <a href="#" class="text-white">
                            <i class="fa fa-envelope"></i> {{ $libraries->contact_email ?? 'info@librarysystem.com' }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="copyright-area">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <p>&copy; 2022 - {{ $libraries->library_name ?? 'LibrarySystem' }}. All rights reserved.</p>
                </div>
                <div class="col-md-4">
                    <div class="social-media">
                        Get Connected:
                        <a href="{{ $libraries->facebook ?? '#' }}"><i class="fa fa-facebook"></i></a>
                        <a href="{{ $libraries->twitter ?? '#' }}"><i class="fa fa-twitter"></i></a>
                        <a href="{{ $libraries->instagram ?? '#' }}"><i class="fa fa-instagram"></i></a>
                        <a href="{{ $libraries->youtube ?? '#' }}"><i class="fa fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
