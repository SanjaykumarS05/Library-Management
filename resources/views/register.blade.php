<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sign Up</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</head>
<body>
    <div class="container">
        <form action="{{ route('store') }}" method="post" >
        @csrf
        <h1>Sign Up</h1>
        <div class="input-group">
            <i class="material-icons">person</i>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" >
        </div>

        <div class="input-group">
            <i class="material-icons">email</i>
            <label for="email">Email:</label>
            <input type="text" id="email" name="email">
        </div>

        <div class="input-group">
            <i class="material-icons">lock</i>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password">
            <input type="checkbox" onclick="document.getElementById('password').type = this.checked ? 'text' : 'password'"> Show Password
        </div>
        <input type="hidden" name="role" value="user">

        <div class="input-group">
            <button type="submit" class="submit">Register</button>
        </div>
        <p class="p2">Have an account? <a href="{{ route('login') }}">Sign in</a></p>
        </form>
    </div>
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
