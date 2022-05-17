<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>{{ config('app.name') }}</title>
   <link rel="stylesheet" href="{{ mix('css/app.css') }}">
   @livewireStyles
</head>
<body>
   @include('partials.navbar')
   @include('partials.sidebar')
   <main class="mt-5 py-4 px-2">
      @yield('content')
   </main>
   <script src="{{ mix('js/app.js') }}"></script>
   @livewireScripts
   @stack('script')
</body>
</html>