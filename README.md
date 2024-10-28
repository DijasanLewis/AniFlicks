# AniFlicks

AniFlicks adalah aplikasi berbasis web yang menyediakan database komprehensif untuk film dan anime. Aplikasi ini memungkinkan pengguna untuk mengeksplorasi judul film dan anime, membuat daftar tontonan, memberikan ulasan, dan rating. AniFlicks dikembangkan menggunakan PHP, HTML, CSS, dan JavaScript (vanilla) sebagai bagian dari proyek mata kuliah Pemrograman Berbasis Web di Politeknik Statistika STIS.

## Fitur Utama
- **Eksplorasi film dan anime**: Temukan informasi lengkap mengenai film dan anime termasuk judul, poster, tanggal rilis, karakter, dan studio.
- **Daftar Tontonan Pribadi**: Pengguna dapat membuat dan mengelola daftar tontonan mereka.
- **Rating dan Ulasan**: Pengguna dapat memberikan rating dan ulasan serta membaca ulasan pengguna lain.
- **Akses Admin**: Admin memiliki akses untuk mengelola data film, karakter, dan pengguna.

## Cara Menjalankan Proyek Secara Lokal

Ikuti langkah-langkah berikut untuk mengunduh dan menjalankan AniFlicks secara lokal di komputer Anda.

### 1. Clone Repositori
Pertama, unduh repositori ini ke komputer Anda dengan menggunakan perintah berikut di terminal:

```bash
git clone https://github.com/DijasanLewis/AniFlicks.git
```

Ini akan mengunduh semua file dan kode sumber AniFlicks ke direktori lokal.

### 2. Instalasi XAMPP
Unduh dan instal [XAMPP](https://www.apachefriends.org/index.html), software yang menyediakan lingkungan server lokal untuk menjalankan aplikasi berbasis web. Pastikan untuk memulai modul Apache dan MySQL setelah instalasi.

### 3. Konfigurasi Database
- Buka `phpMyAdmin` melalui `http://localhost/phpmyadmin`.
- Buat database baru dengan nama `DatabaseAniFlicks`.
- Impor file `DatabaseAniFlicks.sql` yang ada di folder proyek ke database yang baru dibuat.

### 4. Menjalankan Proyek
- Pindahkan folder AniFlicks ke direktori `htdocs` di instalasi XAMPP Anda (biasanya ada di `C:/xampp/htdocs/`).
- Buka browser dan akses AniFlicks melalui `http://localhost/AniFlicks`.

Sekarang Anda dapat mulai menjelajahi fitur-fitur AniFlicks secara lokal!

## Akun Pengguna
Gunakan akun berikut untuk mencoba fitur pengguna dan admin:

### Admin
- **Email**: admin@gmail.com
- **Password**: password

### Pengguna Biasa
- **Email**: user@gmail.com
- **Password**: password

## Saran Pengembangan
Jika Anda ingin berkontribusi atau memiliki saran untuk pengembangan lebih lanjut, silakan buat pull request atau hubungi saya melalui repositori ini.

## Lisensi
Proyek ini dikembangkan untuk keperluan akademik dan bersifat open-source.
