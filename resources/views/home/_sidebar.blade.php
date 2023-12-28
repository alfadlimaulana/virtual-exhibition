<aside class="p-6 border-gray-500 shadow-md bg-brand-yellow-500 sm:border sm:rounded-md lg:w-1/3 xl:w-full xl:max-w-sm lg:h-fit lg:sticky top-24">
    <form action="{{ route('home') }}">
        <div class="mb-4 lg:mb-6">
            <x-forms.label for="keyword">Cari Lukisan</x-forms.label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input type="text" value="{{ request('keyword') }}" name="keyword" id="keyword" class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Search">
            </div>
        </div>
        <div class="mb-4 lg:mb-6">
            <x-forms.label for="keyword">Provinsi</x-forms.label>
            <div class="relative">
                <x-forms.select value="{{ request('keyword') }}" name="province[]" id="province" multiple class="h-16 mb-1">
                    @foreach ($provinces as $province)
                        <option value="{{ $province }}" {{ in_array($province, (request('province') ?? [])) ? 'selected' : '' }}>{{ $province }}</option>   
                    @endforeach
                </x-forms.select>
                <span class="text-sm">*Tahan ctrl untuk memilih lebih dari 1 provinsi</span>
            </div>
        </div>
        @auth
        <div class="flex items-center mb-4 mr-4 lg:mb-6 ">
            <x-forms.checkbox id="liked" name="liked" :checked="request('liked') == 'on'" />
            <x-forms.label class="!mb-0 ml-2" for="liked">Liked by You</x-forms.label>
        </div>
        @endauth
        <div class="mb-4 lg:mb-6">
            <x-forms.label>Category</x-forms.label>
            <div class="flex flex-wrap gap-2 capitalize lg:flex-col">
                <div class="flex items-center mr-4">
                    <x-forms.checkbox id="realism" name="category[]" value="realism" :checked="in_array('realism', (request('category') ?? []))" />
                    <x-forms.label class="!mb-0 ml-2" for="realism">realism</x-forms.label>
                </div>
                <div class="flex items-center mr-4">
                    <x-forms.checkbox id="photorealism" name="category[]" value="photorealism" :checked="in_array('photorealism', (request('category') ?? []))" />
                    <x-forms.label class="!mb-0 ml-2" for="photorealism">photorealism</x-forms.label>
                </div>
                <div class="flex items-center mr-4">
                    <x-forms.checkbox id="expressionism" name="category[]" value="expressionism" :checked="in_array('expressionism', (request('category') ?? []))" />
                    <x-forms.label class="!mb-0 ml-2" for="expressionism">expressionism</x-forms.label>
                </div>
                <div class="flex items-center mr-4">
                    <x-forms.checkbox id="impressionism" name="category[]" value="impressionism" :checked="in_array('impressionism', (request('category') ?? []))" />
                    <x-forms.label class="!mb-0 ml-2" for="impressionism">impressionism</x-forms.label>
                </div>
                <div class="flex items-center mr-4">
                    <x-forms.checkbox id="abstract" name="category[]" value="abstract" :checked="in_array('abstract', (request('category') ?? []))" />
                    <x-forms.label class="!mb-0 ml-2" for="abstract">abstract</x-forms.label>
                </div>
                <div class="flex items-center mr-4">
                    <x-forms.checkbox id="surrealism" name="category[]" value="surrealism" :checked="in_array('surrealism', (request('category') ?? []))" />
                    <x-forms.label class="!mb-0 ml-2" for="surrealism">surrealism</x-forms.label>
                </div>
                <div class="flex items-center mr-4">
                    <x-forms.checkbox id="pop art" name="category[]" value="pop art" :checked="in_array('pop art', (request('category') ?? []))" />
                    <x-forms.label class="!mb-0 ml-2" for="pop art">pop art</x-forms.label>
                </div>
                <div class="flex items-center mr-4">
                    <x-forms.checkbox id="other" name="category[]" value="other" :checked="in_array('other', (request('category') ?? []))"/>
                    <x-forms.label class="!mb-0 ml-2" for="other">other</x-forms.label>
                </div>
            </div>
        </div>
        <div class="mb-4 lg:mb-6">
            <x-forms.label>Material</x-forms.label>
            <div class="flex flex-wrap gap-2 capitalize lg:flex-col">
                <div class="flex items-center mr-4">
                    <x-forms.checkbox id="acrylic" name="material[]" value="acrylic" :checked="in_array('acrylic', (request('material') ?? []))" />
                    <x-forms.label class="!mb-0 ml-2" for="acrylic">acrylic</x-forms.label>
                </div>
                <div class="flex items-center mr-4">
                    <x-forms.checkbox id="oil" name="material[]" value="oil" :checked="in_array('oil', (request('material') ?? []))" />
                    <x-forms.label class="!mb-0 ml-2" for="oil">oil</x-forms.label>
                </div>
                <div class="flex items-center mr-4">
                    <x-forms.checkbox id="watercolor" name="material[]" value="watercolor" :checked="in_array('watercolor', (request('material') ?? []))"/>
                    <x-forms.label class="!mb-0 ml-2" for="watercolor">watercolor</x-forms.label>
                </div>
                <div class="flex items-center mr-4">
                    <x-forms.checkbox id="gouache" name="material[]" value="gouache" :checked="in_array('gouache', (request('material') ?? []))"/>
                    <x-forms.label class="!mb-0 ml-2" for="gouache">gouache</x-forms.label>
                </div>
                <div class="flex items-center mr-4">
                    <x-forms.checkbox id="encaustic" name="material[]" value="encaustic" :checked="in_array('encaustic', (request('material') ?? []))"/>
                    <x-forms.label class="!mb-0 ml-2" for="encaustic">encaustic</x-forms.label>
                </div>
                <div class="flex items-center mr-4">
                    <x-forms.checkbox id="other" name="material[]" value="other" :checked="in_array('other', (request('material') ?? []))"/>
                    <x-forms.label class="!mb-0 ml-2" for="other">other</x-forms.label>
                </div>
            </div>
        </div>
        <div class="flex gap-1.5">
            <x-button-a href="{{ route('home')}} " class="w-full px-6 tracking-normal text-black capitalize border border-brand-gray hover:bg-gray-400">Reset</x-button-a>
            <x-button type="submit" class="w-full px-6 tracking-normal text-black capitalize bg-white border hover:bg-brand-cream border-brand-gray">Search</x-button>
        </div>
    </form>
</aside>