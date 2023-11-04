@extends('layouts.app')

@section('content')
    <section>
        <div class="container">
            <img src="{{ asset($painting->paintingImages[1]->image)}}" alt="{{ $painting->title }}"
                    class="w-full aspect-square object-fit object-cover mb-4">
            <div class="capitalize">
                <h2 class="mb-1">{{ $painting->title }}</h2>
                <p>{{ $painting->user->name }}</p>
            </div>
            <hr class="block my-4">
            <div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam vel sunt soluta. Vero rerum minima tenetur accusantium repellat rem quis doloremque magni? Ratione voluptatibus magni obcaecati sunt dolorum eaque distinctio?</p>
                <dl class="capitalize my-4">
                    <dt class="text-gray-600 text-sm">year</dt>
                    <dd class="mb-2">{{ $painting->year }}</dd>
                    <dt class="text-gray-600 text-sm">material</dt>
                    <dd class="mb-2">{{ $painting->material }}</dd>
                    <dt class="text-gray-600 text-sm">dimension</dt>
                    <dd class="mb-2">{{ $painting->dimension }}</dd>
                    <dt class="text-gray-600 text-sm">category</dt>
                    <dd>
                        {{ $painting->category }}
                    </dd>
                </dl>
            </div>
        </div>
    </section>
@endsection