@extends('layouts.app')

@section('content')
<main class="flex items-center justify-center flex-grow py-12">
    <div class="flex items-center w-full max-w-2xl p-8 bg-brand-cream border-black rounded-lg md:border aspect-video shadow-lg">
        <div class="w-full max-w-xs mx-auto">
            <h4 class="mb-6 text-center">Daftar</h4>
            
            <form method="POST" action="register" class="mb-3">
                @csrf
            
                <!-- Name -->
                <div class="mb-3">
                    <x-forms.label for="name">Nama Lengkap</x-forms.label>
                    <x-forms.input class="!border-brand-gray" id="name" name="name" :value="old('name')" required maxlength="64"/>
                    @error('name')
                        <x-forms.error>{{ $message }}</x-forms.error>
                    @enderror
                </div>
            
                <!-- Phone -->
                <div class="mb-3">
                    <x-forms.label for="phone">Phone</x-forms.label>
                    <x-forms.input class="!border-brand-gray" id="phone" name="phone" :value="old('phone')" required maxlength="12" pattern="[0-9]+"/>
                    @error('phone')
                        <x-forms.error>{{ $message }}</x-forms.error>
                    @enderror
                </div>

                <div class="mb-3">
                    <x-forms.label for="province">Provinsi</x-forms.label>
                    <x-forms.select class="!border-brand-gray" id="province" name="province" :value="old('province')" required>
                        <option value="" disabled selected>Pilih Provinsi</option>
                        @foreach ($provinces as $province)
                            <option value="{{ $province }}" {{ old('province') == $province? 'selected' : '' }}>{{ $province }}</option>
                        @endforeach
                    </x-forms.select>
                    @error('province')
                        <x-forms.error>{{ $message }}</x-forms.error>
                    @enderror
                </div>
            
                <!-- Email Address -->
                <div class="mb-3">
                    <x-forms.label for="email">Email</x-forms.label>
                    <x-forms.input class="!border-brand-gray" id="email" type="email" name="email" :value="old('email')" required />
                    @error('email')
                        <x-forms.error>{{ $message }}</x-forms.error>
                    @enderror
                </div>
            
                <!-- Password -->
                <div class="mb-3">
                    <x-forms.label for="password">Password</x-forms.label>
                    <x-forms.input class="!border-brand-gray" id="password" type="password" name="password" required min="8"/>
                    @error('password')
                        <x-forms.error>{{ $message }}</x-forms.error>
                    @enderror
                </div>
            
                <!-- Confirm Password -->
                <div class="mb-6">
                    <x-forms.label for="password_confirmation">Confirm Password</x-forms.label>
                    <x-forms.input class="!border-brand-gray" id="password_confirmation" type="password" name="password_confirmation" required/>
                    @error('password_confirmation')
                        <x-forms.error>{{ $message }}</x-forms.error>
                    @enderror
                </div>
    
                <x-button type="submit" class="w-full text-black bg-brand-yellow-500 hover:bg-brand-yellow-600">
                    Daftar
                </x-button>
            </form>
            
            <p class="text-center">Sudah punya akun? <a href="{{ route('login') }}" class="text-brand-gray underline hover:text-black">Masuk disini.</a></p>
        </div>
    </div>
</main>
@endsection
