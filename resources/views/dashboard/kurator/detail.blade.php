@extends('layouts.app')

@section('content')
<main class="grid flex-grow place-items-center" x-data="modals()">
    <section class="w-full py-10" >
        <div x-data="carousel()" class="container gap-8 xl:flex">
            <div id="carousel" class="relative xl:w-2/5 max-xl:mb-4 align-self-stretch" data-images={{ $painting->paintingImages->pluck('image')->map(function($image) {return asset($image);}) }}>
                <img @click="openImage(selected)" :src="images[selected]" alt="{{ $painting->title }}"
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
            <div class="p-8 border border-black rounded-md xl:w-3/5">
                <div class="w-full mx-auto">
                    <h4 class="mb-6 text-center">Detail Lukisan</h4>
                    <div class="gap-3 mb-3 md:flex">
                        <!-- Judul -->
                        <div class="w-full max-md:mb-3">
                            <x-forms.label for="title">Judul</x-forms.label>
                            <x-forms.input id="title" name="title" value="{{ $painting->title }}" disabled maxlength="32"/>
                            @error('title')
                            <x-forms.error>{{ $message }}</x-forms.error>
                            @enderror
                        </div>
                        <!-- Tahun -->
                        <div>
                            <x-forms.label for="year">Tahun</x-forms.label>
                            <x-forms.input id="year" name="year" value="{{ $painting->year }}" disabled pattern="\d{4}" max={{ Carbon::now()->year }}/>
                            @error('year')
                                <x-forms.error>{{ $message }}</x-forms.error>
                            @enderror
                        </div>
                    </div>
                
                    <!-- Deskripsi -->
                    <div class="mb-3">
                        <x-forms.label for="description">Deskripsi</x-forms.label>
                        <x-forms.textarea rows="3" id="description" name="description" value="" disabled> {{ $painting->description }} </x-forms.textarea>                    
                        @error('description')
                            <x-forms.error>{{ $message }}</x-forms.error>
                        @enderror
                    </div>
                
                    <!-- Material -->
                    <div class="mb-3">
                        <x-forms.label for="material">Material</x-forms.label>
                        <x-forms.select id="material" name="material" disabled>
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
                        <x-forms.select id="category" name="category" :value="old('category')" disabled>
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
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-full max-md:mb-3">
                            <x-forms.label for="height">Panjang (cm)</x-forms.label>
                            <x-forms.input type="number" id="height" name="height" value="{{ explode(' X ', $painting->dimension)[0] }}" disabled min="1" max="999"/>
                            @error('height')
                            <x-forms.error>{{ $message }}</x-forms.error>
                            @enderror
                        </div>
                        <div>x</div>
                        <div class="w-full">
                            <x-forms.label for="width">Lebar (cm)</x-forms.label>
                            <x-forms.input type="number" id="width" name="width" value="{{ explode(' X ', $painting->dimension)[1] }}" disabled min="1" max="999"/>
                            @error('width')
                                <x-forms.error>{{ $message }}</x-forms.error>
                            @enderror
                        </div>
                    </div>

                    @if($painting->status == 'on review')
                    <div class="flex justify-end gap-3">
                        <x-button @click="showModal()" class="px-8 !text-base border border-gray-500 hover:bg-gray-100">
                            Tolak
                        </x-button>
                        <x-button-a href="{{ route('dashboard.kurator.paintings.approve', $painting->id) }}" class="px-8 !text-base text-white bg-gray-500 hover:bg-gray-600">
                            Setujui
                        </x-button-a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <template x-if="true">
        <div x-show="show" id="popup-modal" class="fixed top-0 left-0 right-0 z-50 items-center justify-center w-full h-full overflow-x-hidden overflow-y-auto md:inset-0" :class="show ? 'bg-black bg-opacity-40' : ''">
            <div class="relative w-full max-w-md max-h-full p-4 mx-auto -translate-y-1/2 top-1/2">
                <div class="relative bg-white rounded-lg shadow">
                    <div class="flex items-center justify-between p-2.5 md:p-3 border-b rounded-t">
                        <h3 class="text-lg font-semibold text-gray-900">
                            Beri Umpan Balik
                        </h3>
                        <button @click="hideModal()" type="button" class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto" data-modal-toggle="crud-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <form action="{{ route('dashboard.kurator.paintings.reject', $painting->id) }}" class="p-2.5 md:p-3">
                        <div class="mb-4">
                            <div>
                                <x-forms.label for="message">Pesan</x-forms.label>
                                <x-forms.textarea rows="3" id="message" name="message" value="" required></x-forms.textarea>                    
                                @error('message')
                                    <x-forms.error>{{ $message }}</x-forms.error>
                                @enderror
                            </div>
                        </div>
                        <x-button type="submit" class="ml-auto text-white bg-gray-500 hover:bg-gray-600">
                            Kirimkan
                        </x-button>
                    </form>
                </div>
            </div>
        </div>
    </template>
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

    let modals = () => {
        return {
            show: false,
            showModal(id) {
                this.show = true
            },
            hideModal() {
                this.show = false
            },
            submitForm(id) {
                form = document.getElementById(id);
                form.submit()
            }
        }
    }
</script>
@endpush