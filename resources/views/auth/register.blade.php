@extends('layouts.app')

@section('content')
<main class="flex-grow grid place-items-center">
    <div class="flex items-center w-full max-w-2xl p-8 md:border border-black rounded-md aspect-video">
        <div class="w-full max-w-xs mx-auto">
            <h4 class="mb-6  text-center">Daftar</h4>
            
            <form method="POST" action="register" class="mb-3">
                @csrf
            
                <!-- Name -->
                <div class="mb-3">
                    <x-forms.label for="name">Nama Lengkap</x-forms.label>
                    <x-forms.input id="name" name="name" :value="old('name')" required maxlength="64"/>
                    @error('name')
                        <x-forms.error>{{ $message }}</x-forms.error>
                    @enderror
                </div>
            
                <!-- Phone -->
                <div class="mb-3">
                    <x-forms.label for="phone">Phone</x-forms.label>
                    <x-forms.input id="phone" name="phone" :value="old('phone')" required maxlength="12" pattern="[0-9]+"/>
                    @error('phone')
                        <x-forms.error>{{ $message }}</x-forms.error>
                    @enderror
                </div>

                <div class="mb-3">
                    <x-forms.label for="province">Provinsi</x-forms.label>
                    <x-forms.select id="province" name="province" :value="old('province')" required>
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
                    <x-forms.input id="email" type="email" name="email" :value="old('email')" required />
                    @error('email')
                        <x-forms.error>{{ $message }}</x-forms.error>
                    @enderror
                </div>
            
                <!-- Password -->
                <div class="mb-3">
                    <x-forms.label for="password">Password</x-forms.label>
                    <x-forms.input id="password" type="password" name="password" required min="8"/>
                    @error('password')
                        <x-forms.error>{{ $message }}</x-forms.error>
                    @enderror
                </div>
            
                <!-- Confirm Password -->
                <div class="mb-6">
                    <x-forms.label for="password_confirmation">Confirm Password</x-forms.label>
                    <x-forms.input id="password_confirmation" type="password" name="password_confirmation" required/>
                    @error('password_confirmation')
                        <x-forms.error>{{ $message }}</x-forms.error>
                    @enderror
                </div>
    
                <x-button type="submit" class="w-full text-white bg-gray-500 hover:bg-gray-600">
                    Daftar
                </x-button>
            </form>
            
            <p class="text-center">Sudah punya akun? <a href="{{ route('login') }}" class="text-gray-700 underline hover:text-gray-800">Masuk disini.</a></p>
        </div>
    </div>
</main>
@endsection
