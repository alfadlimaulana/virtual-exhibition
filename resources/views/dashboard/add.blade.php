@extends('layouts.app')

@section('content')
<main class="flex items-center justify-center flex-grow p-8">
    <div class="flex items-center w-full max-w-5xl p-8 border-black rounded-md md:border">
        <div class="w-full max-w-xl mx-auto">
            <h4 class="mb-6 text-center">Tambah Lukisan</h4>
            
            <form method="POST" action="{{ route('dashboard.paintings.store') }}" class="mb-3" enctype="multipart/form-data">
                @csrf
            
                <div class="gap-3 mb-3 md:flex">
                    <!-- Judul -->
                    <div class="w-full max-md:mb-3">
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
                    <x-forms.textarea rows="3" id="description" name="description" :value="old('description')" required>{{ old('description') }}</x-forms.textarea>                    
                    @error('description')
                        <x-forms.error>{{ $message }}</x-forms.error>
                    @enderror
                </div>
            
                <!-- Material -->
                <div class="mb-3">
                    <x-forms.label for="material">Material</x-forms.label>
                    <x-forms.select id="material" name="material" :value="old('material')" required>
                        <option selected disabled>Pilih Material</option>
                        <option value="acrylic" {{ old('material') == 'acrylic' ? 'selected' : '' }}>acrylic</option>
                        <option value="oil" {{ old('material') == 'oil' ? 'selected' : '' }}>oil</option>
                        <option value="watercolor" {{ old('material') == 'watercolor' ? 'selected' : '' }}>watercolor</option>
                        <option value="gouache" {{ old('material') == 'gouache' ? 'selected' : '' }}>gouache</option>
                        <option value="encaustic" {{ old('material') == 'encaustic' ? 'selected' : '' }}>encaustic</option>
                        <option value="other" {{ old('material') == 'other' ? 'selected' : '' }}>other</option>
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
                        <option value="realism" {{ old('category') == 'realism' ? 'selected' : '' }}>realism</option>
                        <option value="photorealism" {{ old('category') == 'photorealism' ? 'selected' : '' }}>photorealism</option>
                        <option value="expressionism" {{ old('category') == 'expressionism' ? 'selected' : '' }}>expressionism</option>
                        <option value="impressionism" {{ old('category') == 'impressionism' ? 'selected' : '' }}>impressionism</option>
                        <option value="abstract" {{ old('category') == 'abstract' ? 'selected' : '' }}>abstract</option>
                        <option value="surrealism" {{ old('category') == 'surrealism' ? 'selected' : '' }}>surrealism</option>
                        <option value="pop art" {{ old('category') == 'pop art' ? 'selected' : '' }}>pop art</option>
                        <option value="other" {{ old('category') == 'other' ? 'selected' : '' }}>other</option>
                    </x-forms.select>
                    @error('category')
                        <x-forms.error>{{ $message }}</x-forms.error>
                    @enderror
                </div>
            
                <!-- Dimensi -->
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-full max-md:mb-3">
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
                    @if($errors->has('images'))
                        <x-forms.error>{{ $errors->first('images') }}</x-forms.error>
                    @elseif($errors->has('images.*'))
                        <x-forms.error>{{ $errors->first('images.*') }}</x-forms.error>
                    @else
                        <p class="mt-1 text-sm">* Maksimal 3 foto di bawah 2 Mb dengan format jpg, jpeg, atau png..</p>
                    @enderror
                </div>
                
                <div class="flex max-sm:flex-col gap-1.5">
                    <x-button-a href="{{ route('dashboard.paintings') }}" type="submit" class="max-sm:order-2 w-full ml-auto px-8 !text-base border border-gray-500 hover:bg-gray-100">
                        Batal
                    </x-button-a>
                    <x-button type="submit" class="w-full ml-auto px-8 !text-base text-white bg-gray-500 hover:bg-gray-600">
                        Tambah
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection