@extends('layouts.app')

@section('content')
<main class="flex-grow grid place-items-center p-8">
    <div class="flex items-center w-full max-w-5xl p-8 md:border border-black rounded-md aspect-video">
        <div class="w-full max-w-xl mx-auto">
            <h4 class="mb-6  text-center">Tambah Lukisan</h4>
            
            <form method="POST" action="{{ route('dashboard.paintings.store') }}" class="mb-3" enctype="multipart/form-data">
                @csrf
            
                <div class="mb-3 md:flex gap-3">
                    <!-- Judul -->
                    <div class="max-md:mb-3 w-full">
                        <x-forms.label for="title">Judul</x-forms.label>
                        <x-forms.input id="title" name="title" :value="old('title')" required maxlength="32"/>
                        @error('title')
                        <x-forms.error>{{ $message }}</x-forms.error>
                        @enderror
                    </div>
                    <!-- Tahun -->
                    <div>
                        <x-forms.label for="year">Tahun</x-forms.label>
                        <x-forms.input id="year" name="year" :value="old('year')" required pattern="\d{4}"/>
                        @error('year')
                            <x-forms.error>{{ $message }}</x-forms.error>
                        @enderror
                    </div>
                </div>
            
                <!-- Deskripsi -->
                <div class="mb-3">
                    <x-forms.label for="description">Deskripsi</x-forms.label>
                    <x-forms.textarea rows="3" id="description" name="description" :value="old('description')" required></x-forms.textarea>                    
                    @error('description')
                        <x-forms.error>{{ $message }}</x-forms.error>
                    @enderror
                </div>
            
                <!-- Material -->
                <div class="mb-3">
                    <x-forms.label for="material">Material</x-forms.label>
                    <x-forms.select id="material" name="material" :value="old('material')" required>
                        <option selected disabled>Pilih Material</option>
                        <option value="acrylic">acrylic</option>
                        <option value="oil">oil</option>
                        <option value="watercolor">watercolor</option>
                        <option value="gouache">gouache</option>
                        <option value="encaustic">encaustic</option>
                        <option value="other">other</option>
                    </x-forms.select>
                    @error('material')
                        <x-forms.error>{{ $message }}</x-forms.error>
                    @enderror
                </div>
                
                <!-- Category -->
                <div class="mb-3">
                    <x-forms.label for="category">Kategori</x-forms.label>
                    <x-forms.select id="category" name="category" :value="old('category')" required>
                        <option selected disabled>Pilih category</option>
                        <option value="realism">realism</option>
                        <option value="photorealism">photorealism</option>
                        <option value="expressionism">expressionism</option>
                        <option value="impressionism">impressionism</option>
                        <option value="abstract">abstract</option>
                        <option value="surrealism">surrealism</option>
                        <option value="pop art">pop art</option>
                        <option value="other">other</option>
                    </x-forms.select>
                    @error('category')
                        <x-forms.error>{{ $message }}</x-forms.error>
                    @enderror
                </div>
            
                <!-- Dimensi -->
                <div class="mb-3 flex items-center gap-3">
                    <div class="max-md:mb-3 w-full">
                        <x-forms.label for="height">Panjang (cm)</x-forms.label>
                        <x-forms.input type="number" id="height" name="height" :value="old('height')" required min="1" max="999"/>
                        @error('height')
                        <x-forms.error>{{ $message }}</x-forms.error>
                        @enderror
                    </div>
                    <div>x</div>
                    <div class="w-full">
                        <x-forms.label for="width">Lebar (cm)</x-forms.label>
                        <x-forms.input type="number" id="width" name="width" :value="old('width')" required min="1" max="999"/>
                        @error('width')
                            <x-forms.error>{{ $message }}</x-forms.error>
                        @enderror
                    </div>
                </div>

                <div class="mb-8">
                    <x-forms.label for="images">Gambar</x-forms.label>
                    <x-forms.input type="file" id="images" name="images[]" :value="old('images')" required multiple/>
                    @error('images')
                        <x-forms.error>{{ $message }}</x-forms.error>
                    @enderror
                </div>
    
                <x-button type="submit" class="w-full ml-auto px-8 !text-base text-white bg-gray-500 hover:bg-gray-600">
                    Tambah
                </x-button>
            </form>
        </div>
    </div>
</main>
@endsection