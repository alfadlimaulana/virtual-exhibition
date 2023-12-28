@extends('layouts.app')

@section('content')    
<!-- Session Status -->
<main class="flex items-center justify-center flex-grow">
    <div class="flex items-center w-full max-w-2xl p-8 bg-brand-cream border-black rounded-lg md:border aspect-video shadow-lg">
        <div class="w-full max-w-xs mx-auto text-center">
            <h4 class="mb-6">Masuk</h4>
            
            @error('login')
            <div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50">
                <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <div>
                  {{ $message }}
                </div>
            </div>
            @enderror
            
            <form method="POST" action="login" class="mb-4">
                @csrf
            
                <div class="flex flex-col gap-2 mb-6">
                    <x-forms.input id="email" class="mt-1 !border-brand-gray" type="email" name="email" :value="old('email')" placeholder="Email" required />
                    <x-forms.input id="password" class="max-w-xs !border-brand-gray" type="password" name="password" placeholder="Password"/>
                </div>
            
                <x-button type="submit" class="w-full text-black bg-brand-yellow-500 hover:bg-brand-yellow-600">
                    Masuk
                </x-button>
            </form>
            
            <p>Belum punya akun? <a href="{{ route('register') }}" class="text-brand-gray underline hover:text-black">Daftar disini.</a></p>
        </div>
    </div>
</main>
@endsection
