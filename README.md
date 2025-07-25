# 🚢 ASDP HR – Laravel 9

![Laravel](https://img.shields.io/badge/Laravel-9.x-red.svg)
![PHP](https://img.shields.io/badge/PHP-8.0+-blue.svg)
![Docker](https://img.shields.io/badge/Docker-supported-success.svg)

ASDP HR adalah sistem manajemen SDM berbasis web yang dibangun dengan Laravel 9. Proyek ini dirancang untuk mengelola data karyawan secara efisien dan terstruktur.

---

## 🛠️ Fitur Utama

-   📋 Manajemen Data Karyawan
-   🕒 Pelacakan Kehadiran
-   🗓️ Pengajuan & Persetujuan Cuti
-   📈 Evaluasi Kinerja Karyawan
-   ⚙️ Fitur HR Lainnya yang Siap Dikembangkan

---

## 🧰 Prasyarat Instalasi

Pastikan sistem Anda telah memiliki:

-   🐘 **PHP 8.0 atau lebih tinggi**
-   🎼 **Composer** (untuk mengelola dependensi PHP)
-   🐬 **MySQL 5.7+ atau MariaDB 10.3+** (untuk database)
-   🟢 **Node.js 14+** (untuk kompilasi frontend assets seperti CSS & JS)
-   🐳 **Docker** (opsional, jika ingin menggunakan container)

---

## 🚀 Cara Menjalankan (Tanpa Docker)

### 1. Clone Project

```bash
git clone https://github.com/ReGHZ/asdp.git
cd asdp
```

### 2. Install Dependency Composer

```bash
composer update
composer install
```

### 3. Konfigurasi File `.env`

Salin dari file `.env.example`:

```bash
cp .env.example .env
```

Edit bagian konfigurasi database:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=asdp_hr
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 4. Generate Key dan Migrasi Database

```bash
php artisan key:generate
php artisan migrate
```

### 5. (Opsional) Seed database untuk sample data

```bash
php artisan db:seed
```

### ✅ Selesai!

Sekarang kamu bisa akses aplikasi di:

```
http://localhost:8000
```

---

## 🐳 (Opsional) Menjalankan dengan Docker

Jika kamu ingin menggunakan Docker untuk development:

```bash
docker-compose up -d --build
```

Aplikasi akan berjalan di: `http://localhost:8000`

---

## 👨‍💻 Kontribusi

Pull request dan issue sangat diterima! Feel free untuk fork dan bantu mengembangkan proyek ini.

---

## 📄 Lisensi

MIT License © 2025 [ReGHZ](https://github.com/ReGHZ)
