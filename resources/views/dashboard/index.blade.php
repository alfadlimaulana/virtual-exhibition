@extends('layouts.app')

@section('content')
<main class="flex-grow py-12">
    <div class="container">
        <div class="xl:flex mb-8">
            <h3 class="max-xl:mb-8 max-xl:text-center w-full whitespace-nowrap">Dashboard Pelukis</h1>
            <div class="md:flex gap-3 w-full">
                <form action="{{ route('dashboard.paintings') }}" class="w-full">
                    <div class="relative">
                        <input type="text" value="{{ request('keyword') }}" name="keyword" id="keyword" class="block w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Search">
                        <button type="submit" class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-gray-500 rounded-e-lg border border-gray-700 hover:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-blue-300">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                            <span class="sr-only">Search</span>
                        </button>
                    </div>
                </form>
                <x-button class="bg-gray-200 whitespace-nowrap max-md:mt-2.5 max-md:ml-auto">Tambah Lukisan</x-button>
            </div>
        </div>
        <div class="relative w-full overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-900">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <th scope="col" class="px-3 py-2">Title</th>
                    <th scope="col" class="px-3 py-2 max-lg:max-w-[125px]">Description</th>
                    <th scope="col" class="px-3 py-2">Year</th>
                    <th scope="col" class="px-3 py-2">Material</th>
                    <th scope="col" class="px-3 py-2">Category</th>
                    <th scope="col" class="px-3 py-2">Dimension</th>
                    <th scope="col" class="px-3 py-2">Status</th>
                </thead>
                <tbody>
                    @foreach ($paintings as $painting)
                        <tr class="border-b">
                            <td class="px-3 py-2">{{ $painting->title }}</td>
                            <td class="px-3 py-2 max-lg:max-w-[125px]">
                                <div class="max-lg:truncate">{{ $painting->description }}</div>
                            </td>
                            <td class="px-3 py-2">{{ $painting->year }}</td>
                            <td class="px-3 py-2">{{ $painting->material }}</td>
                            <td class="px-3 py-2">{{ $painting->category }}</td>
                            <td class="px-3 py-2">{{ $painting->dimension }}</td>
                            <td class="px-3 py-2">{{ $painting->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $paintings->links() }}
    </div>
</main>
@endsection