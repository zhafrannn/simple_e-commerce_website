<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf" value="{{csrf_token()}}">
  @vite('resources/css/app.css')
  <title>@yield('title')</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,400;0,500;0,700;1,500&display=swap" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <style>
    * {
      font-family: 'Montserrat', sans-serif;
      color: black;
    }
  </style>
</head>

<body>
  @include('components.navbar')
  <main>
    @yield('content')
  </main>
</body>

</html>