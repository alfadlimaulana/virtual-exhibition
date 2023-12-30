@extends('layouts.app')

@section('content')
<main x-data="modals()" class="flex-grow py-12">
    <div class="container">
        <div class="mb-8 xl:flex">
            <h3 class="w-full max-xl:mb-8 max-xl:text-center whitespace-nowrap">Dashboard Pelukis</h1>
            <div class="w-full gap-3 md:flex">
                <form action="{{ route('dashboard.paintings') }}" class="w-full">
                    <div class="relative">
                        <input type="text" value="{{ request('keyword') }}" name="keyword" id="keyword" class="block w-full p-2 text-sm text-gray-900 border border-brand-gray rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Search">
                        <button type="submit" class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-black bg-brand-yellow-500 rounded-e-lg border border-brand-gray hover:bg-brand-yellow-600 focus:ring-4 focus:outline-none focus:ring-blue-300">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                            <span class="sr-only">Search</span>
                        </button>
                    </div>
                </form>
                <x-button-a href="{{ route('dashboard.paintings.add') }}" class="bg-brand-yellow-500 hover:bg-brand-yellow-600 border border-brand-gray whitespace-nowrap max-md:mt-2.5 max-md:ml-auto">Tambah Lukisan</x-button-a>
            </div>
        </div>
        <div class="relative w-full overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-900">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <th scope="col" class="px-3 py-2">Judul</th>
                    <th scope="col" class="px-3 py-2">Tahun</th>
                    <th scope="col" class="px-3 py-2">Kategori</th>
                    <th scope="col" class="px-3 py-2">Disukai</th>
                    <th scope="col" class="px-3 py-2">Dibuat Pada</th>
                    <th scope="col" class="px-3 py-2">Status</th>
                    <th scope="col" class="px-3 py-2 text-center">Aksi</th>
                </thead>
                <tbody>
                    @foreach ($paintings as $key => $painting)
                        <tr class="border-b">
                            <td class="px-3 py-2">{{ $painting->title }}</td>
                            <td class="px-3 py-2">{{ $painting->year }}</td>
                            <td class="px-3 py-2">{{ $painting->category }}</td>
                            <td class="px-3 py-2">{{ $painting->liked_paintings_count }}</td>
                            <td class="px-3 py-2">{{ \Carbon\Carbon::parse($painting->created_at)->format('d-m-Y') }}</td>
                            <td class="px-3 py-2">{{ $painting->status }}</td>
                            <td class="flex justify-center gap-2 px-3 py-2">
                                <x-button-a href="{{ route('dashboard.paintings.edit', $painting->id) }}" class="bg-brand-yellow-500 hover:bg-brand-yellow-600 border border-brand-gray !w-8 !h-8 !p-0 rounded-md grid place-items-center">
                                    <i class="text-black ph-bold ph-pencil-simple"></i>
                                </x-button-a>
                                <form id="deleteForm" action="{{ route('dashboard.paintings.delete', $painting->id)}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <x-button type="button" @click="showModal()" class="bg-brand-orange-500 hover:bg-brand-orange-600 border border-brand-gray !w-8 !h-8 !p-0 rounded-md grid place-items-center">
                                        <i class="text-black ph-bold ph-trash"></i>
                                    </x-button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $paintings->links() }}
    </div>
    
    <template x-if="true">
        <div x-show="show" id="popup-modal" class="fixed top-0 left-0 right-0 z-50 items-center justify-center w-full h-full overflow-x-hidden overflow-y-auto md:inset-0" :class="show ? 'bg-black bg-opacity-40' : ''">
            <div class="relative w-full max-w-md max-h-full p-4 mx-auto -translate-y-1/2 top-1/2">
                <div class="relative bg-white rounded-lg shadow">
                    <button @click="hideModal()" type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="popup-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-4 text-center md:p-5">
                        <svg class="w-12 h-12 mx-auto mb-4 text-brand-orange-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500">Yakin ingin menghapus lukisan ini?</h3>
                        <div class="flex justify-center gap-2">
                            <x-button @click="submitForm('deleteForm')" class="text-black bg-brand-orange-500 hover:bg-brand-orange-600 border border-brand-gray px-5 py-2.5">
                                Ya, Hapus
                            </x-button>
                            <x-button @click="hideModal()" class="border border-gray-500 text-gray-500 bg-white hover:bg-gray-100 hover:text-gray-900 px-5 py-2.5">Batalkan</x-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>
</main>

@push('script')
    @if(session()->has('success'))
        <script>
            alert("{{ session('success') }}");
        </script>
    @endif
    <script>
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
@endsection

