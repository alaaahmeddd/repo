<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />


        <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
   
   <link href="home/css/font-awesome.min.css" rel="stylesheet" />

   <link href="home/css/style.css" rel="stylesheet" />

   <link href="home/css/responsive.css" rel="stylesheet" />


        <!-- Styles -->
    </head>
    <body class="antialiased">
    <x-app-layout>

    </x-app-layout>
    @include('slider')
    @include('users.products.products')
    @include('footer')

    </body>
</html>
