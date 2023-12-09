@extends('layouts.app')

@section('content')
<main>
    <section class="w-full relative h-96 text-white bg-header bg-[rgba(0,0,0,0.4)] bg-blend-overlay flex items-center">
        <div class="container text-center">
            <h1 class="mb-4">Virtual Exhibition</h1>
            <p class="lg:text-xl">Selamat datang di Virtual Exhibition, tempat di mana seniman Indonesia menampilkan karya terbaik mereka untuk dinikmati oleh penggemar seni. Temukan inspirasi tak terbatas dan jalin koneksi dengan seniman-seniman berbakat.</p>
        </div>
    </section>
    <div class="relative gap-4 sm:container sm:py-10 lg:flex">
        @include('home._sidebar')
        <section class="max-lg:py-10 lg:w-2/3 xl:w-full">
            @if ($paintings->count())
            <div class="max-sm:container">
                <div class="grid gap-4 sm:grid-cols-2 md:max-lg:grid-cols-3 xl:grid-cols-3">
                    @foreach ($paintings as $painting)
                    <div class="border border-gray-900 rounded-md">
                        <a href="{{ route('detail', $painting->id) }}">
                            <img src="{{ asset($painting->paintingImages[0]->image) }}" alt="" class="object-cover object-center w-full aspect-square">
                        </a>
                        <div class="p-4 capitalize">
                            <a href="{{ route('detail', $painting->id) }}" class="text-xl font-bold">{{ $painting->title }}</a>
                            <p class="text-sm">By: {{ $painting->user->name }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                {{ $paintings->links() }}
            </div>
            @else
                <div class="text-xl text-gray-500 h-full grid place-items-center">No paintings found</div>
            @endif
        </section>
    </div>
</main>
@endsection