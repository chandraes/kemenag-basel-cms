# 🏛️ CMS Website Kemenag Bangka Selatan

[![Laravel 12](https://img.shields.io/badge/Laravel-12.x-red.svg)](https://laravel.com)
[![Filament PHP](https://img.shields.io/badge/Filament-v3-orange.svg)](https://filamentphp.com)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind-3.x-blue.svg)](https://tailwindcss.com)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

Sistem Manajemen Konten (CMS) resmi untuk **Kantor Kementerian Agama Kabupaten Bangka Selatan**. Dibangun untuk memodernisasi layanan informasi publik, pengelolaan berita, dan transparansi data keagamaan di wilayah Bangka Selatan.

---

## ✨ Fitur Utama

* **Advanced Dashboard:** Visualisasi data berita dan statistik layanan masyarakat.
* **Content Management:** Pengelolaan artikel, kategori, dan tag dengan fitur *draft/publish*.
* **Service Integration:** Manajemen modul layanan seperti pendaftaran Haji, Nikah, dan sertifikasi Halal.
* **Media Library:** Manajemen file gambar dan dokumen terpusat dengan kompresi otomatis.
* **Dynamic Pages:** Kemampuan membuat halaman statis (Profil, Visi Misi) tanpa menyentuh kode.
* **Role Based Access Control (RBAC):** Keamanan berlapis untuk Admin, Editor, dan Staff melalui kebijakan akses yang ketat.
* **SEO Optimized:** Meta data otomatis untuk meningkatkan visibilitas di mesin pencari.

---

## 🛠️ Tech Stack

- **Framework:** [Laravel 12](https://laravel.com) (Modern PHP Framework)
- **Admin Panel:** [FilamentPHP v3](https://filamentphp.com) (TALL Stack)
- **Styling:** [Tailwind CSS](https://tailwindcss.com)
- **Frontend Interactivity:** [Alpine.js](https://alpinejs.dev/)
- **Database:** MySQL 8.0 / MariaDB

---

## 🚀 Panduan Instalasi

### Prasyarat
* PHP >= 8.3
* Composer
* Node.js & NPM
* MySQL/PostgreSQL

### Langkah-langkah

1.  **Clone Repositori**
    ```bash
    git clone [https://github.com/chandraes/kemenag-basel-cms.git](https://github.com/chandraes/kemenag-basel-cms.git)
    cd kemenag-basel-cms
    ```

2.  **Install Dependensi**
    ```bash
    composer install
    npm install
    ```

3.  **Konfigurasi Environment**
    ```bash
    cp .env.example .env
    # Sesuaikan DB_DATABASE, DB_USERNAME, dan DB_PASSWORD di file .env
    ```

4.  **Generate Key & Migrasi**
    ```bash
    php artisan key:generate
    php artisan migrate --seed
    ```

5.  **Build Aset Frontend**
    ```bash
    npm run build
    ```

6.  **Selesai**
    ```bash
    php artisan serve
    ```
    Buka `http://localhost:8000/adxadm` untuk mengakses panel dashboard.

---

## 📂 Struktur Folder Utama

* `app/Filament/` - Konfigurasi panel admin, resource, dan widget.
* `app/Models/` - Struktur data dan relasi antar entitas.
* `resources/views/` - Template frontend website.
* `public/storage/` - Direktori aset yang diunggah.

---

## 🤝 Kontribusi

Jika Anda ingin berkontribusi pada proyek ini:
1. Fork repositori ini.
2. Buat branch fitur baru (`git checkout -b fitur/NamaFitur`).
3. Commit perubahan Anda (`git commit -m 'Menambah fitur X'`).
4. Push ke branch (`git push origin fitur/NamaFitur`).
5. Buat Pull Request.

---

## 📄 Lisensi

Proyek ini berada di bawah lisensi [MIT](LICENSE).

---

**Developed by [Chandraes](https://github.com/chandraes) for Kemenag Bangka Selatan.**
