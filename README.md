<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="350" alt="Laravel Logo">
  </a>
</p>

<h1 align="center">GoPinjam 📦✨</h1>

<p align="center">
  Sistem peminjaman barang sekolah berbasis web yang intuitif dan efisien. <br />
  Dirancang untuk memudahkan pengelolaan inventaris, pemrosesan permintaan, dan pelacakan status barang.
</p>

<p align="center">
  <img src="https://img.shields.io/badge/PHP-^8.2-777BB4?logo=php" alt="PHP Version">
  <img src="https://img.shields.io/badge/Laravel-Framework-FF2D20?logo=laravel" alt="Laravel Framework">
  <img src="https://img.shields.io/badge/MySQL-Database-4479A1?logo=mysql" alt="MySQL">
  </p>

---

## 🚀 Sekilas Tentang GoPinjam

GoPinjam adalah solusi modern untuk manajemen peminjaman aset sekolah. Dengan antarmuka yang ramah pengguna, aplikasi ini bertujuan untuk menyederhanakan proses bagi:

* 👨‍💼 **Admin:** Kontrol penuh atas sistem, pengguna, dan inventaris.
* 🧑‍💻 **Operator:** Memproses permintaan peminjaman dan pengembalian dengan mudah.
* 🙋 **Peminjam:** Mengajukan peminjaman dan melacak status barang pinjaman.

---

## ✅ Prasyarat Sistem

Pastikan perangkat lunak berikut sudah terinstal dan terkonfigurasi dengan baik di sistem Anda:

* 🐘 **PHP:** Versi `^8.2` (atau sesuai kebutuhan proyek Anda)
* 🎼 **Composer:** [Versi terbaru](https://getcomposer.org/)
* 🟢 **Node.js & NPM (atau Yarn):** Versi `^18.0` direkomendasikan
* 🐬 **Database:** MySQL (Pastikan server database Anda berjalan)
* 🌿 **Git:** Untuk kloning repositori

---

## 🛠️ Langkah Instalasi & Konfigurasi Lokal

Ikuti panduan ini untuk menjalankan BorrowBox di lingkungan pengembangan lokal Anda:

1.  **Clone Repositori Proyek:**
    Buka terminal atau command prompt, lalu navigasi ke direktori kerja Anda dan jalankan:
    ```bash
    git clone -b main [https://github.com/RidhoUdev/item-loan-application.git](https://github.com/RidhoUdev/item-loan-application.git)
    ```

2.  **Masuk ke Direktori Proyek:**
    ```bash
    cd GoPinjam
    ```

3.  **Install Dependensi PHP (via Composer):**
    Perintah ini akan mengunduh dan menginstal semua paket PHP yang dibutuhkan oleh proyek.
    ```bash
    composer install
    ```

4.  **Buat File Environment (`.env`):**
    Salin file konfigurasi contoh `.env.example` menjadi `.env`. File ini akan menyimpan konfigurasi spesifik untuk lingkungan lokal Anda.
    ```bash
    cp .env.example .env
    ```

5.  **Generate Kunci Aplikasi Unik:**
    Setiap aplikasi Laravel membutuhkan kunci enkripsi yang aman.
    ```bash
    php artisan key:generate
    ```

6.  **Konfigurasi Database pada File `.env`:**
    Buka file `.env` menggunakan editor teks favorit Anda. Sesuaikan bagian koneksi database seperti contoh di bawah. **Pastikan Anda sudah membuat database kosong** (misalnya bernama `gopinjam`) sebelum melanjutkan.

    ```dotenv
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=gopinjam
    DB_USERNAME=root
    DB_PASSWORD=
    ```

7.  **Jalankan Migrasi Database:**
    Perintah ini akan membuat semua tabel yang diperlukan dalam database Anda sesuai skema proyek.
    ```bash
    php artisan migrate
    ```

8.  **Buat Symbolic Link untuk Storage:**
    Ini penting agar file yang diunggah (seperti gambar profil atau barang) dapat diakses publik.
    ```bash
    php artisan storage:link
    ```

9.  **Install Dependensi Frontend (Node.js):**
    Jika proyek Anda menggunakan Vite atau Mix untuk aset frontend:
    ```bash
    npm install
    ```

10. **Compile Aset Frontend:**
    ```bash
    npm run dev

11. **Jalankan Server Pengembangan Lokal:** 🚀
    Cara termudah untuk menjalankan server PHP bawaan Laravel:
    ```bash
    php artisan serve
    ```
    Aplikasi Anda sekarang akan dapat diakses melalui peramban web di alamat: `http://127.0.0.1:8000`

🎉 **Selamat!** GoPinjam seharusnya sudah berjalan di sistem lokal Anda.

---

## ✨ Fitur Utama (Contoh)

* Manajemen Inventaris Barang
* Proses Peminjaman dan Pengembalian
* Manajemen Pengguna (Admin, Operator, Peminjam)
* Notifikasi Status Peminjaman
* Riwayat Peminjaman
* Pencarian Barang Mudah
* Desain Responsive


---

## 🖼️ Tampilan Aplikasi 


**Contoh:**

* *Halaman Login*

* *Dashboard Admin*

* *Proses Peminjaman*

---

## 📜 Lisensi

Proyek ini dilisensikan di bawah Lisensi 

---

<p align="center">
  Dibuat dengan ❤️ menggunakan Laravel.
</p>
