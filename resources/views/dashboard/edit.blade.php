@extends('layouts.app')

@section('content')
<main class="flex-grow">
    <section class="py-10" x-data="carousel()">
        <div class="container gap-8 xl:flex">
            <div id="carousel" class="relative xl:w-2/5 max-xl:mb-4 align-self-stretch" data-images={{ $painting->paintingImages->pluck('image')}}>
                <img :src="`{{asset('${images[selected]}')}}`" alt="{{ $painting->title }}"
                        class="object-cover w-full xl:h-full aspect-square md:max-xl:aspect-video">
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
            <div class="xl:w-3/5 border p-8 border-black rounded-md">
                <div class="w-full mx-auto">
                    <h4 class="mb-6 text-center">Ubah Lukisan</h4>
                    <form method="POST" action="{{ route('dashboard.paintings.update', $painting->id) }}" class="mb-3" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3 md:flex gap-3">
                            <!-- Judul -->
                            <div class="max-md:mb-3 w-full">
                                <x-forms.label for="title">Judul</x-forms.label>
                                <x-forms.input id="title" name="title" value="{{ $painting->title }}" required maxlength="32"/>
                                @error('title')
                                <x-forms.error>{{ $message }}</x-forms.error>
                                @enderror
                            </div>
                            <!-- Tahun -->
                            <div>
                                <x-forms.label for="year">Tahun</x-forms.label>
                                <x-forms.input id="year" name="year" value="{{ $painting->year }}" required pattern="\d{4}"/>
                                @error('year')
                                    <x-forms.error>{{ $message }}</x-forms.error>
                                @enderror
                            </div>
                        </div>
                    
                        <!-- Deskripsi -->
                        <div class="mb-3">
                            <x-forms.label for="description">Deskripsi</x-forms.label>
                            <x-forms.textarea rows="3" id="description" name="description" value="" required> {{ $painting->description }} </x-forms.textarea>                    
                            @error('description')
                                <x-forms.error>{{ $message }}</x-forms.error>
                            @enderror
                        </div>
                    
                        <!-- Material -->
                        <div class="mb-3">
                            <x-forms.label for="material">Material</x-forms.label>
                            <x-forms.select id="material" name="material" required>
                                <option disabled>Pilih Material</option>
                                <option value="acrylic" {{ $painting->material == 'acrylic' ? 'selected' : '' }}>acrylic</option>
                                <option value="oil" {{ $painting->material == 'oil' ? 'selected' : '' }}>oil</option>
                                <option value="watercolor" {{ $painting->material == 'watercolor' ? 'selected' : '' }}>watercolor</option>
                                <option value="gouache" {{ $painting->material == 'acrylic' ? 'selected' : '' }}>gouache</option>
                                <option value="encaustic" {{ $painting->material == 'encaustic' ? 'selected' : '' }}>encaustic</option>
                                <option value="other" {{ $painting->material == 'other' ? 'selected' : '' }}>other</option>
                            </x-forms.select>
                            @error('material')
                                <x-forms.error>{{ $message }}</x-forms.error>
                            @enderror
                        </div>
                        
                        <!-- Category -->
                        <div class="mb-3">
                            <x-forms.label for="category">Kategori</x-forms.label>
                            <x-forms.select id="category" name="category" :value="old('category')" required>
                                <option disabled>Pilih category</option>
                                <option value="realism" {{ $painting->category == 'realism' ? 'selected' : '' }}>realism</option>
                                <option value="photorealism" {{ $painting->category == 'photorealism' ? 'selected' : '' }}>photorealism</option>
                                <option value="expressionism" {{ $painting->category == 'expressionism' ? 'selected' : '' }}>expressionism</option>
                                <option value="impressionism" {{ $painting->category == 'impressionism' ? 'selected' : '' }}>impressionism</option>
                                <option value="abstract" {{ $painting->category == 'abstract' ? 'selected' : '' }}>abstract</option>
                                <option value="surrealism" {{ $painting->category == 'surrealism' ? 'selected' : '' }}>surrealism</option>
                                <option value="pop art" {{ $painting->category == 'pop art' ? 'selected' : '' }}>pop art</option>
                                <option value="other" {{ $painting->category == 'other' ? 'selected' : '' }}>other</option>
                            </x-forms.select>
                            @error('category')
                                <x-forms.error>{{ $message }}</x-forms.error>
                            @enderror
                        </div>
                    
                        <!-- Dimensi -->
                        <div class="mb-3 flex items-center gap-3">
                            <div class="max-md:mb-3 w-full">
                                <x-forms.label for="height">Panjang (cm)</x-forms.label>
                                <x-forms.input type="number" id="height" name="height" value="{{ explode(' X ', $painting->dimension)[0] }}" required min="1" max="999"/>
                                @error('height')
                                <x-forms.error>{{ $message }}</x-forms.error>
                                @enderror
                            </div>
                            <div>x</div>
                            <div class="w-full">
                                <x-forms.label for="width">Lebar (cm)</x-forms.label>
                                <x-forms.input type="number" id="width" name="width" value="{{ explode(' X ', $painting->dimension)[1] }}" required min="1" max="999"/>
                                @error('width')
                                    <x-forms.error>{{ $message }}</x-forms.error>
                                @enderror
                            </div>
                        </div>
        
                        <div class="mb-8">
                            <x-forms.label for="images">Gambar</x-forms.label>
                            <div class="flex items-center p-2.5 mb-2 text-sm text-yellow-800 border border-yellow-300 rounded-lg bg-yellow-50" role="alert">
                                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                                </svg>
                                <span class="sr-only">Info</span>
                                <div>
                                    <span class="font-medium">Warning!</span> Gambar baru akan menimpa gambar sebelumnya dan perlu ditinjau ulang oleh kurator.
                                </div>
                            </div>
                            <x-forms.input type="file" id="images" name="images[]" value="" multiple/>
                            @error('images')
                                <x-forms.error>{{ $message }}</x-forms.error>
                            @enderror
                            @error('images.*')
                                <x-forms.error>{{ $message }}</x-forms.error>
                            @enderror
                            @if(!$errors->has('images') && !$errors->has('images.*'))
                                <p class="text-sm mt-1.5">* Maksimal 3 foto di bawah 3 Mb dengan format jpg, jpeg, atau png.</p>
                            @endif
                        </div>
            
                        <x-button type="submit" class="w-full ml-auto px-8 !text-base text-white bg-gray-500 hover:bg-gray-600">
                            Ubah
                        </x-button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@push('script')
@if(session()->has('failed'))
    <script>
        alert("{{ session('failed') }}");
    </script>
@endif
<script>
    const carousel = () => {
        const images = JSON.parse(document.getElementById('carousel').dataset.images);
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

{{-- @section('content')
<main class="flex-grow flex items-center p-8">
    <div class="w-full flex flex-col gap-3">
        @foreach ($painting->paintingImages as $image)
            <img class="w-full aspect-square" src="{{ asset($image->image) }}" alt="">
        @endforeach
    </div>
    <div class="flex items-center w-full max-w-5xl p-8 md:border border-black rounded-md aspect-video">
        
    </div>
</main>
@endsection --}}