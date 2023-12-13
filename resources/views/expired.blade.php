@extends('layouts.app')

@section('content')
<main class="flex items-center justify-center flex-grow">
    <section class="py-10">
        <div class="container text-center">
            <h1 class="mb-8">Maaf, Masa Berlangganan Anda Habis</h1>
            <x-button-a href="{{ route('pricing') }}" class="bg-gray-500 hover:bg-gray-600 text-white !text-lg">Perpanjang</x-button-a>
        </div>
    </section>
</main>
@endsection