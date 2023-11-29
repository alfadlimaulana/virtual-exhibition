@extends('layouts.app')

@section('content')
<main>
    <section class="py-10" x-data="form()">
        <div class="container gap-8 lg:flex">
            <div class="w-full max-lg:mb-6">
                <img src="{{asset('img/bg/header.jpg')}}" alt="art exhibition"
                    class="object-cover w-full aspect-square object-fit">
            </div>
            <div class="grid w-full place-items-center">
                <div>
                    <div class="mb-4">
                        <h2 class="mb-4">Subscription</h2>
                        <p>Hanya dengan <strong>Rp50.000/Bulan</strong> dapatkan lorem ipsum dolor sit, amet consectetur adipisicing elit. Similique ea rerum distinctio sed sapiente iste eos expedita quidem tenetur necessitatibus iure aliquid molestiae quasi accusantium maxime, excepturi fugit, est voluptatibus.</p>
                    </div>
                    <form action="{{ route('checkout') }}" method="POST">
                        @csrf
                        <table class="mb-6">
                            <tr>
                                <td class="px-2 py-1">
                                    <x-forms.label class="!mb-0" for="duration">Durasi</x-forms.label>
                                </td>
                                <td class="px-2 py-1">:</td>
                                <td class="flex gap-2 px-2 py-1 items-center">
                                    <x-forms.input x-model="duration" id="duration" name="duration" type="number" min="1" max="24" class="!w-16 h-8"/>
                                    <span>Bulan</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-2 py-1">Berakhir Pada</td>
                                <td class="px-2 py-1">:</td>
                                <td class="px-2 py-1" x-text="setExpired(duration)"></td>
                            </tr>
                            <tr>
                                <td class="px-2 py-1">Total</td>
                                <td class="px-2 py-1">:</td>
                                <td class="px-2 py-1" x-text="setTotal(duration)"></td>
                            </tr>
                        </table>
                        <x-button type="submit" class="max-md:w-full py-2.5 bg-gray-500 text-white">Buat Pesanan</x-button>
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
    const form = () => { 
        return {
            duration: 1,
            total: 50000,
            expiredDate: 0,
            setExpired(duration) {
                const currentDate = new Date();
                currentDate.setMonth(currentDate.getMonth() + parseInt(this.duration));
                this.expiredDate = currentDate.toISOString()
                return currentDate.toISOString().substring(0, 10);
            },
            setTotal(duration) {
                this.total = 50000*this.duration;
                let IDRFormat = new Intl.NumberFormat('en-ID', {
                    style: 'currency',
                    currency: 'IDR',
                }).format(50000*this.duration);
                return IDRFormat;
            }
        };
    };
</script>
@endpush