<aside class="p-6 bg-gray-400 sm:rounded-md lg:w-1/3 xl:w-full xl:max-w-sm lg:h-fit lg:sticky top-24">
    <div class="mb-4 lg:mb-6">
        <x-forms.label for="first_name">Cari Lukisan</x-forms.label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input type="search" id="search" class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Search" required>
        </div>
    </div>
    <div class="mb-4 lg:mb-6">
        <x-forms.label>Saring Berdasarkan:</x-forms.label>
        <div class="flex gap-2 lg:flex-col">
            <div class="flex items-center mr-4">
                <input id="filter-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                <x-forms.label class="!mb-0 ml-2" for="filter-checkbox">Filter 1</x-forms.label>
            </div>
            <div class="flex items-center mr-4">
                <input id="filter-2-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                <x-forms.label class="!mb-0 ml-2" for="filter-2-checkbox">Filter 2</x-forms.label>
            </div>
        </div>
    </div>
    <x-button type="submit" class="h-full px-6 tracking-normal text-white capitalize bg-gray-500 rounded-l-none hover:bg-gray-600">Search</x-button>
</aside>