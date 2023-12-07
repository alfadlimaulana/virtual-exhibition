@extends('layouts.app')

@push('head-script')
    <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
    <script type="text/javascript"
      src="https://app.sandbox.midtrans.com/snap/snap.js"
      data-client-key="{{ config('midtrans.client_key') }}"></script>
    <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->
@endpush

@section('content')
<main>
    <section class="py-10" x-data="form()">
        <div class="container gap-8 lg:flex">
            <div class="w-full max-lg:mb-6">
                <img src="{{asset('img/bg/header.jpg')}}" alt="art exhibition"
                    class="object-cover w-full aspect-square object-fit">
            </div>
            <div class="flex w-full items-center">
                <div>
                    <div class="mb-4">
                        <h2 class="mb-4">Ringkasan Pemesanan</h2>
                        <p>Mohon periksa kembali data pesanan anda sebelum melanjutkan ke pembayaran.</p>
                    </div>
                    <div>
                        <h5 class="mb-2.5">User Detail</h5>
                        <table class="mb-6">
                            <tr>
                                <td class="pl-0 px-2 py-1">Nama</td>
                                <td class="px-2 py-1">:</td>
                                <td class="px-2 py-1">{{ auth()->user()->name }}</td>
                            </tr>
                            <tr>
                                <td class="pl-0 px-2 py-1">Email</td>
                                <td class="px-2 py-1">:</td>
                                <td class="px-2 py-1">{{ auth()->user()->email }}</td>
                            </tr>
                            <tr>
                                <td class="pl-0 px-2 py-1">No. Telepon</td>
                                <td class="px-2 py-1">:</td>
                                <td class="px-2 py-1">{{ auth()->user()->phone }}</td>
                            </tr>
                        </table>
                    </div>
                    <div>
                        <h5 class="mb-2.5">Order Detail</h5>
                        <table class="mb-6">
                            <tr>
                                <td class="pl-0 px-2 py-1">Durasi</td>
                                <td class="px-2 py-1">:</td>
                                <td class="px-2 py-1">{{ $payment->quantity }}</td>
                            </tr>
                            <tr>
                                <td class="pl-0 px-2 py-1">Berakhir Pada</td>
                                <td class="px-2 py-1">:</td>
                                <td class="px-2 py-1">{{ \Carbon\Carbon::now()->addMonths($payment->qty) }}</td>
                            </tr>
                            <tr>
                                <td class="pl-0 px-2 py-1">Total</td>
                                <td class="px-2 py-1">:</td>
                                <td class="px-2 py-1">@rupiah($payment->total)</td>
                            </tr>
                        </table>
                    </div>
                    <x-button id="pay-button" class="max-md:w-full py-2.5 bg-gray-500 text-white !text-base">Bayar Sekarang</x-button>
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
    
<script type="text/javascript">
    const snapToken = "{{ $snapToken }}"
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function () {
      window.snap.pay(snapToken, {
        onSuccess: function(result){
          alert("payment success!"); console.log(result);
          window.location.href = '/'
        },
        onPending: function(result){
          alert("wating your payment!"); console.log(result);
        },
        onError: function(result){
          alert("payment failed!"); console.log(result);
        },
        onClose: function(){
          alert('you closed the popup without finishing the payment');
        }
      })
    });
</script>
@endpush