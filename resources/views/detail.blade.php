@extends('layouts.app')

@section('content')
<main class="flex-grow grid place-items-center">
    <section class="py-10" x-data="carousel()">
        <div class="container gap-8 lg:flex">
            <div id="carousel" class="relative lg:w-1/3 max-lg:mb-4" data-images={{ $painting->paintingImages->pluck('image')->map(function($image) {return asset($image);}) }}>
                <img @click="openImage(selected)" :src="images[selected]" alt="{{ $painting->title }}"
                        class="object-cover w-full aspect-square object-fit">
                <button @click="prevImage" class="absolute h-10 p-2 -translate-y-1/2 border border-gray-500 rounded-full cursor-pointer bg-gray-50 bg-opacity-60 left-4 top-1/2 group aspect-square hover:bg-opacity-100">
                    <i class="ph ph-caret-left"></i>
                </button>
                <button @click="nextImage" class="absolute h-10 p-2 -translate-y-1/2 border border-gray-500 rounded-full cursor-pointer bg-gray-50 bg-opacity-60 right-4 top-1/2 group aspect-square hover:bg-opacity-100">
                    <i class="ph ph-caret-right"></i>
                </button>
                <div class="absolute bottom-0 flex justify-center p-4 space-x-2 -translate-x-1/2 left-1/2">
                    <template x-for="(image, index) in images" :key="index">
                        <button @click="goToImage(index)" class="w-2 h-2 rounded-full hover:bg-gray-300 ring-2 ring-gray-300" :class="index == selected? 'bg-gray-300' : 'bg-gray-500'"></button>
                    </template>
                </div>
            </div>
            <div class="lg:w-2/3">
                <div class="flex items-center justify-between">
                    <div class="capitalize">
                        <h2 class="mb-1.5">{{ $painting->title }}</h2>
                        <p class="lg:text-2xl">By: {{ $painting->user->name }}</p>
                    </div>
                    @auth
                        @if($liked)
                        <form action="{{ route('unlike', $painting->id) }}" method="POST">
                            @csrf
                            <x-button type="submit">
                                <i class="text-3xl lg:text-4xl ph-fill ph-heart-straight"></i>
                            </x-button>
                        </form>
                        @else
                        <form action="{{ route('like', $painting->id) }}" method="POST">
                            @csrf
                            <x-button type="submit">
                                <i class="text-3xl lg:text-4xl ph ph-heart-straight"></i>
                            </x-button>
                        </form>
                        @endif
                    @endauth
                </div>
                <hr class="block my-4">
                <div>
                    <p>{{ $painting->description }}</p>
                    <dl class="gap-8 my-4 capitalize md:flex">
                        <div>
                            <dt class="text-sm text-gray-600">year</dt>
                            <dd class="mb-2">{{ $painting->year }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm text-gray-600">material</dt>
                            <dd class="mb-2">{{ $painting->material }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm text-gray-600">dimension</dt>
                            <dd class="mb-2">{{ $painting->dimension }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm text-gray-600">category</dt>
                            <dd>
                                {{ $painting->category }}
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </section>

    @foreach ($painting->paintingImages as $paintingImage)
        <a data-fslightbox="paintings" href="{{ asset($paintingImage->image) }}"></a>
    @endforeach
</main>
@endsection

@push('script')
@if(session()->has('failed'))
    <script>
        alert("{{ session('failed') }}");
    </script>
@endif
<script src="{{ asset('js/fslightbox.js') }}"></script>
<script>
    const carousel = () => {
        const images = JSON.parse(document.getElementById('carousel').dataset.images);
        const lightbox = new FsLightbox();
        lightbox.props.sources = images;
        return {
            selected: 0,
            images: images,
            nextImage() {
                if(this.selected == ((this.images.length)-1)){
                    this.selected = 0
                }else {
                    this.selected++ 
                }
            },
            prevImage() {
                if(this.selected == 0){
                    this.selected = (this.images.length)-1
                }else {
                    this.selected--
                }
            },
            goToImage(index) {
                this.selected = index
            },
            openImage(index) {
                lightbox.open(index);
            }
        };
    };
</script>
@endpush