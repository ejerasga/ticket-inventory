<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Fuji-Haya Electric')</title>

    <link rel="icon" href="{{ asset('assets/images/FUJI-HAYA.png') }}">

    <!-- custome css login-->
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
    <link rel="icon" href="{{ asset('assets/images/FUJI-HAYA.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Navbar styling -->
    <link rel="stylesheet" href="{{ asset('assets/css') }}">










</head>
<body>
    


        @yield('content')





</body>
</html>