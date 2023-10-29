@extends('layouts.app')

@section('content')
<section class="relative h-96 text-white bg-header bg-[rgba(0,0,0,0.4)] bg-blend-overlay flex items-center">
    <div class="container text-center">
        <h1 class="mb-4">Lorem Ipsum</h1>
        <p>Lorem ipsum dolor sit amet consectetur. Sit posuere dictumst gravida sed. Et volutpat dolor gravida mattis vitae. Elit venenatis nibh in sed nisl. Nunc nunc nunc fringilla ornare egestas. Magna purus eget et enim phasellus in nullam. Et morbi convallis vitae ipsum. Quis vulputate augue vivamus risus.</p>
    </div>
</section>
<div class="relative gap-4 sm:container sm:py-10 lg:flex">
    @include('home._sidebar')
    <section class="max-lg:py-10 lg:w-2/3 xl:w-full">
        <div class="grid gap-4 max-sm:container sm:grid-cols-2 md:max-lg:grid-cols-3 xl:grid-cols-3">
            @foreach ($paintings as $painting)
            <div class="border border-gray-900 rounded-md">
                <img src="{{asset($painting->paintingImages[1]->image)}}" alt="" class="object-cover object-center w-full aspect-square">
                <div class="p-4">
                    <h5 class="text-2xl">Card Title</h5>
                    <p>By: Artist</p>
                </div>
            </div>
            @endforeach
        </div>

        {{ $paintings->links() }}
    </section>
</div>
@endsection