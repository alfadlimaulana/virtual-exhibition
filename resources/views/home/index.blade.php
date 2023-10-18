@extends('layouts.app')

@section('content')
<section class="relative h-96 text-white bg-header bg-[rgba(0,0,0,0.4)] bg-blend-overlay flex items-center">
    <div class="container text-center">
        <h1 class="mb-4">Lorem Ipsum</h1>
        <p>Lorem ipsum dolor sit amet consectetur. Sit posuere dictumst gravida sed. Et volutpat dolor gravida mattis vitae. Elit venenatis nibh in sed nisl. Nunc nunc nunc fringilla ornare egestas. Magna purus eget et enim phasellus in nullam. Et morbi convallis vitae ipsum. Quis vulputate augue vivamus risus.</p>
    </div>
</section>
<div class="sm:container relative sm:py-10 lg:flex gap-4">
    @include('home._sidebar')
    <section class="max-lg:py-10 lg:w-2/3 xl:w-full">
        <div class="max-sm:container grid sm:grid-cols-2 md:max-lg:grid-cols-3 xl:grid-cols-3 gap-4">
            @for ($i = 0; $i < 9; $i++)
            <div class="border border-gray-900 rounded-md">
                <img src="{{asset('img/painting-dummy.jpg')}}" alt="" class="w-full aspect-square object-cover object-center">
                <div class="p-4">
                    <h5 class="text-2xl">Card Title</h5>
                    <p>By: Artist</p>
                </div>
            </div>
            @endfor
        </div>
    </section>
</div>
@endsection