<x-app-layout>
</x-app-layout>
@if (Auth::check() && Auth::user()->role == 'admin')
    @include('users.products.products')

@else
    @include('users.products.userpage')
@endif    

