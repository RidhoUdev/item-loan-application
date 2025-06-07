@extends('layouts.guest') {{-- Menggunakan layout guest yang mungkin sudah Anda miliki --}}

@section('title', 'GoPinjam - Aplikasi Peminjaman Barang Sekolah')

@push('styles')
{{-- Tambahkan style khusus jika ada, atau pastikan tema custom Anda sudah terload --}}
<style>
    /* Pastikan variabel warna CSS Anda terdefinisi di file CSS utama atau di sini jika perlu */
    /* Contoh jika belum terdefinisi di app.css yang di-bundle Vite:
    :root {
        --color-greenSlate: oklch(35.52% 0.041 238.65);
        --color-neutralize: oklch(94.88% 0.005 95.10);
        --color-pastelOrange: oklch(72.07% 0.178 40.61);
        --color-compound: oklch(39.54% 0.043 257.42);
    }
    */
    .hero-bg-gradient {
        background-image: linear-gradient(to bottom right, var(--color-neutralize), oklch(90% 0.01 240)); /* Gradien lembut */
    }
    .cta-bg-dark {
        background-color: var(--color-greenSlate);
    }
    .btn-custom-orange {
        background-color: var(--color-pastelOrange);
        border-color: var(--color-pastelOrange);
        color: white;
    }
    .btn-custom-orange:hover {
        background-color: oklch(72.07% 0.178 40.61 / 0.9);
        border-color: oklch(72.07% 0.178 40.61 / 0.9);
    }
    .text-custom-greenSlate {
        color: var(--color-greenSlate);
    }
    .border-custom-greenSlate {
        border-color: var(--color-greenSlate);
    }
</style>
@endpush

@section('content')
    {{-- Navbar Landing Page --}}
    <header class="sticky top-0 z-50 bg-white shadow-md">
        <div class="container mx-auto">
            <div class="navbar px-0">
                <div class="navbar-start">
                    <a href="{{ url('/') }}" class="btn btn-ghost text-2xl font-bold text-custom-greenSlate">
                        <img src="{{ asset('img/logo-gopinjam.svg') }}" alt="GoPinjam Logo" class="h-8 w-auto mr-2">
                        GoPinjam
                    </a>
                </div>
                <div class="navbar-end">
                    <a href="{{ route('login') }}" class="btn btn-outline border-custom-greenSlate text-custom-greenSlate hover:bg-custom-greenSlate hover:text-white btn-sm sm:btn-md mr-2">Login</a>
                    {{-- @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-custom-orange btn-sm sm:btn-md">Daftar</a>
                    @endif --}}
                </div>
            </div>
        </div>
    </header>

    {{-- Hero Section --}}
    <section class="hero-bg-gradient py-20 md:py-32">
        <div class="container mx-auto text-center px-6">
            <h1 class="text-4xl md:text-6xl font-bold text-custom-greenSlate mb-6 leading-tight">
                Pinjam Barang Sekolah <br class="hidden md:inline"> Jadi Lebih Mudah!
            </h1>
            <p class="text-lg md:text-xl text-gray-600 mb-10 max-w-2xl mx-auto">
                GoPinjam hadir untuk menyederhanakan proses peminjaman dan pengembalian barang di sekolah Anda. Cepat, transparan, dan terorganisir.
            </p>
            <div class="flex justify-center gap-4">
                <a href="{{ route('login') }}" class="btn btn-lg btn-custom-orange shadow-lg transform hover:scale-105 transition-transform duration-300">
                    Mulai Pinjam Sekarang
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 ml-2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
                </a>
                {{-- <a href="#features" class="btn btn-lg btn-outline border-custom-greenSlate text-custom-greenSlate hover:bg-custom-greenSlate hover:text-white">
                    Pelajari Lebih Lanjut
                </a> --}}
            </div>
        </div>
    </section>

    {{-- Ilustrasi Aplikasi (Contoh) --}}
    <section class="py-10 bg-white">
        <div class="container mx-auto px-6 text-center">
             <img src="{{ asset('img/home.png') }}" alt="GoPinjam App Preview" class="max-w-3xl mx-auto rounded-lg shadow-2xl -mt-16 md:-mt-24 relative z-10">
             {{-- Ganti dengan gambar preview aplikasi Anda jika ada --}}
             {{-- Jika tidak ada, Anda bisa menggunakan ilustrasi generik atau menghapus bagian ini --}}
        </div>
    </section>


    {{-- Fitur Unggulan Section --}}
    <section id="features" class="py-16 md:py-24 bg-neutralize">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12 md:mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-custom-greenSlate mb-4">Mengapa Memilih GoPinjam?</h2>
                <p class="text-gray-600 max-w-xl mx-auto">Kami menyediakan solusi terbaik untuk manajemen peminjaman barang di lingkungan sekolah.</p>
            </div>
            <div class="grid md:grid-cols-3 gap-8 text-center">
                {{-- Fitur 1 --}}
                <div class="card bg-base-100 shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
                    <div class="flex justify-center mb-4">
                        <div class="bg-pastelOrange bg-opacity-20 p-4 rounded-full">
                            <span class="iconify w-8 h-8 flex-shrink-0" data-icon="icon-park:search"></span>
                        </div>
                    </div>
                    <h3 class="text-xl font-semibold text-custom-greenSlate mb-2">Pencarian Mudah</h3>
                    <p class="text-gray-500 text-sm">Temukan barang yang Anda butuhkan dengan cepat melalui fitur pencarian dan kategori yang jelas.</p>
                </div>
                {{-- Fitur 2 --}}
                <div class="card bg-base-100 shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
                     <div class="flex justify-center mb-4">
                        <div class="bg-pastelOrange bg-opacity-20 p-4 rounded-full">
                            <span class="iconify w-8 h-8 flex-shrink-0" data-icon="material-symbols:electric-bolt-outline-rounded"></span>
                        </div>
                    </div>
                    <h3 class="text-xl font-semibold text-custom-greenSlate mb-2">Proses Cepat & Transparan</h3>
                    <p class="text-gray-500 text-sm">Ajukan peminjaman, dapatkan persetujuan, dan lacak status pinjaman Anda secara online tanpa ribet.</p>
                </div>
                {{-- Fitur 3 --}}
                <div class="card bg-base-100 shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
                     <div class="flex justify-center mb-4">
                        <div class="bg-pastelOrange bg-opacity-20 p-4 rounded-full">
                            <span class="iconify w-8 h-8 flex-shrink-0" data-icon="icon-park-outline:date-comes-back"></span>
                        </div>
                    </div>
                    <h3 class="text-xl font-semibold text-custom-greenSlate mb-2">Terorganisir & Terlacak</h3>
                    <p class="text-gray-500 text-sm">Semua riwayat peminjaman tercatat dengan baik. Notifikasi pengingat membantu Anda mengembalikan barang tepat waktu.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Cara Kerja Section (Sederhana) --}}
    <section class="py-16 md:py-24 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12 md:mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-custom-greenSlate mb-4">Cara Mudah Meminjam</h2>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="flex flex-col items-center text-center p-4">
                    <div class="bg-greenSlate text-white rounded-full w-16 h-16 flex items-center justify-center text-2xl font-bold mb-4">1</div>
                    <h3 class="text-xl font-semibold text-custom-greenSlate mb-2">Cari & Pilih Barang</h3>
                    <p class="text-gray-500 text-sm">Jelajahi daftar barang yang tersedia atau gunakan fitur pencarian.</p>
                </div>
                <div class="flex flex-col items-center text-center p-4">
                    <div class="bg-greenSlate text-white rounded-full w-16 h-16 flex items-center justify-center text-2xl font-bold mb-4">2</div>
                    <h3 class="text-xl font-semibold text-custom-greenSlate mb-2">Ajukan Peminjaman</h3>
                    <p class="text-gray-500 text-sm">Isi form peminjaman dengan detail yang diperlukan dan tentukan tanggal pengembalian.</p>
                </div>
                <div class="flex flex-col items-center text-center p-4">
                    <div class="bg-greenSlate text-white rounded-full w-16 h-16 flex items-center justify-center text-2xl font-bold mb-4">3</div>
                    <h3 class="text-xl font-semibold text-custom-greenSlate mb-2">Ambil & Kembalikan</h3>
                    <p class="text-gray-500 text-sm">Setelah disetujui, ambil barang Anda. Kembalikan tepat waktu sesuai jadwal.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Call to Action Section --}}
    <section class="bg-greenSlate text-white py-20 md:py-28">
        <div class="container mx-auto text-center px-6">
            <h2 class="text-3xl md:text-4xl font-bold mb-6">Siap Mempermudah Manajemen Peminjaman?</h2>
            <p class="text-lg text-gray-300 mb-10 max-w-xl mx-auto">
                Bergabunglah dengan GoPinjam sekarang dan rasakan kemudahannya!
            </p>
            {{-- <a href="{{ route('register') }}" class="btn btn-lg btn-custom-orange shadow-lg transform hover:scale-105 transition-transform duration-300">
                Daftar Akun Gratis
            </a> --}}
        </div>
    </section>

    {{-- Footer --}}
    <footer class="bg-neutralize border-t border-base-300">
        <div class="container mx-auto py-8 px-6 text-center text-gray-500 text-sm">
            &copy; {{ date('Y') }} GoPinjam. Semua Hak Cipta Dilindungi.
            {{-- <div class="mt-2">
                <a href="#" class="hover:text-custom-greenSlate mx-2">Kebijakan Privasi</a>
                <a href="#" class="hover:text-custom-greenSlate mx-2">Syarat & Ketentuan</a>
            </div> --}}
        </div>
    </footer>

@endsection
