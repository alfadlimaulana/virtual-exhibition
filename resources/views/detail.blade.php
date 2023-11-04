@extends('layouts.app')

@section('content')
    <section class="py-10" x-data="carousel()">
        <div class="container lg:flex gap-8">
            <div id="carousel" class="relative lg:w-1/3 max-lg:mb-4" data-images={{ $painting->paintingImages->pluck('image')}}>
                <img :src="`{{asset('${images[selected]}')}}`" alt="{{ $painting->title }}"
                        class="w-full aspect-square object-fit object-cover">
                <button @click="prevImage" class="absolute bg-gray-50 bg-opacity-60 border border-gray-500 left-4 top-1/2 -translate-y-1/2 p-2 group h-10 aspect-square rounded-full hover:bg-opacity-100 cursor-pointer">
                    <i class="ph ph-caret-left"></i>
                </button>
                <button @click="nextImage" class="absolute bg-gray-50 bg-opacity-60 border border-gray-500 right-4 top-1/2 -translate-y-1/2 p-2 group h-10 aspect-square rounded-full hover:bg-opacity-100 cursor-pointer">
                    <i class="ph ph-caret-right"></i>
                </button>
                <div class="absolute bottom-0 left-1/2 -translate-x-1/2 p-4 flex justify-center space-x-2">
                    <template x-for="(image, index) in images" :key="index">
                        <button @click="goToImage(index)" class="h-2 w-2 rounded-full hover:bg-gray-300 ring-2 ring-gray-300" :class="index == selected? 'bg-gray-300' : 'bg-gray-500'"></button>
                    </template>
                </div>
            </div>
            <div class="lg:w-2/3">
                <div class="capitalize">
                    <h2 class="mb-1.5">{{ $painting->title }}</h2>
                    <p class="lg:text-2xl">By: {{ $painting->user->name }}</p>
                </div>
                <hr class="block my-4">
                <div>
                    <p>{{ $painting->description }}</p>
                    <dl class="capitalize my-4 md:flex gap-8">
                        <div>
                            <dt class="text-gray-600 text-sm">year</dt>
                            <dd class="mb-2">{{ $painting->year }}</dd>
                        </div>
                        <div>
                            <dt class="text-gray-600 text-sm">material</dt>
                            <dd class="mb-2">{{ $painting->material }}</dd>
                        </div>
                        <div>
                            <dt class="text-gray-600 text-sm">dimension</dt>
                            <dd class="mb-2">{{ $painting->dimension }}</dd>
                        </div>
                        <div>
                            <dt class="text-gray-600 text-sm">category</dt>
                            <dd>
                                {{ $painting->category }}
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
<script>
    const carousel = () => {
        const images = JSON.parse(document.getElementById('carousel').dataset.images);
        console.log(images.length);
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
            }
        };
    };
</script>
@endpush