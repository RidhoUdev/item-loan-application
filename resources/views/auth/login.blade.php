@extends('layouts.guest')

@section('title', 'Login ke GoPinjam')

@section('content')
<div class="flex items-center justify-center min-h-screen px-4 py-12 bg-neutralize">
    <div class="w-full max-w-4xl mx-auto">
        <div class="flex flex-col md:flex-row bg-greenSlate rounded-xl shadow-2xl overflow-hidden">

            <div class="w-full md:w-1/2 bg-greenSlate text-white p-8 sm:p-12 flex flex-col justify-center items-center text-center">
                <img src="{{ asset('img/logo-gopinjam.svg') }}" alt="GoPinjam Logo" class="w-24 h-24 mb-6">
                <h1 class="text-3xl sm:text-4xl font-bold mb-3">Selamat Datang!</h1>
                <p class="text-sm sm:text-base text-gray-300 mb-8">
                    Pinjam barang kebutuhan sekolah dengan mudah dan cepat bersama GoPinjam.
                </p>
                {{-- <div class="w-full max-w-xs h-48 bg-[--color-compound] rounded-lg flex items-center justify-center">
                    <p class="text-gray-400">Ilustrasi Aplikasi</p>
                </div> --}}
            </div>

            <div class="w-full md:w-1/2 p-8 sm:p-12 bg-white">
                <div class="w-full max-w-md mx-auto">
                    <div class="mb-8 text-center md:text-left">
                        <h2 class="text-2xl sm:text-3xl font-bold tracking-tight text-greenSlate">
                            Sign-in
                        </h2>
                        <p class="mt-2 text-sm text-gray-500">
                            Masuk untuk melanjutkan ke GoPinjam.
                        </p>
                    </div>

                    <form class="space-y-6" action="{{ route('login') }}" method="POST">
                        @csrf

                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text text-gray-700">Email atau Username</span>
                            </div>
                            <input id="login_identifier" name="login_identifier" type="text" autocomplete="username email" required
                                   value="{{ old('login_identifier') }}"
                                   class="input input-bordered w-full border-gray-300 focus:outline-0 focus:border-pastelOrange focus:ring focus:ring-pastelOrange focus:ring-opacity-50 @error('login_identifier') input-error @enderror"
                                   placeholder="Email atau username Anda"
                                   autocomplete="off"/>
                            @error('login_identifier')
                                <div class="label">
                                    <span class="label-text-alt text-red-600">{{ $message }}</span>
                                </div>
                            @enderror
                        </label>

                        <label class="form-control w-full">
                             <div class="label">
                                <span class="label-text text-gray-700">Password</span>
                            </div>
                            <input id="password" name="password" type="password" autocomplete="current-password" required
                                   class="input input-bordered w-full border-gray-300 focus:outline-0 focus:border-pastelOrange focus:ring focus:ring-pastelOrange focus:ring-opacity-50 @error('password') input-error @enderror"
                                   placeholder="••••••••"/>
                            @error('password')
                                <div class="label">
                                    <span class="label-text-alt text-red-600">{{ $message }}</span>
                                </div>
                            @enderror
                        </label>

                        <div class="mt-4">
                            <button type="submit"
                                    class="btn btn-block text-white bg-pastelOrange hover:bg-opacity-80 border-none shadow-md transition duration-150 ease-in-out">
                                Login ke Akun Saya
                            </button>
                        </div>
                    </form>

                    <div class="mt-8 text-sm text-center">
                        <span class="text-gray-500">Lupa password Anda? <a href="#" class="text-greenSlate font-semibold">Reset Password</a></span>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="font-semibold text-pastelOrange hover:underline">
                                Reset Password
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
