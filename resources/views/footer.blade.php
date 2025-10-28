<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<style>
.footer-area{
    padding: 40px 0px;
    background-color: #4a76a8;
    color: #fff;
}
.footer-area a{
    text-decoration: none;
}
.footer-area .footer-heading{
    font-size: 24px;
    color: #fff;
}
.footer-area .footer-underline{
    height: 1px;
    width: 70px;
    background-color: #ddd;
    margin: 10px 0px;
}
.copyright-area{
    padding: 14px 0px;

    background-color: #262626;
}
.copyright-area p{
    margin-bottom: 0px;
    color: #fff;
}
.copyright-area .social-media{
    text-align: end;
}
.copyright-area .social-media a{
    margin: 0px 10px;
    color: #fff;
    width: 20px;
}
</style>
<body>

    <div>
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
                        <div class="mb-2"></div>
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
                            <a href="" class="text-white">
                                <i class="fa fa-phone"></i> {{ $libraries->contact_phone ?? '+91 7708151456' }}
                            </a>
                        </div>
                        <div class="mb-2">
                            <a href="" class="text-white">
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
                        <p class=""> &copy; 2022 - {{ $libraries->library_name ?? 'LibrarySystem' }}. All rights reserved.</p>
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>