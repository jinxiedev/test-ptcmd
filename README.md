# Sistem Pengajuan Kredit - PT Capella Multidana

Repositori ini berisi hasil pengerjaan technical test untuk studi kasus Sistem Pengajuan Kredit. Aplikasi ini dirancang untuk mencatat, melihat, dan memproses (setujui/tolak) pengajuan kredit nasabah.

Untuk mempermudah proses review, aplikasi ini dikonfigurasi secara bawaan menggunakan SQLite sehingga tidak memerlukan setup server database secara manual (XAMPP/MySQL).

## Tech Stack
- Laravel 11 (PHP >= 8.2)
- SQLite (Local Database)
- Tailwind CSS
- Alpine.js

## Cara Menjalankan Aplikasi

Berikut adalah langkah-langkah untuk menjalankan aplikasi di lingkungan lokal:

   ```bash
   git clone https://github.com/jinxiedev/test-ptcmd
   ```

1. Buka terminal dan arahkan ke direktori root project.
    ```bash
   cd test-ptcmd
   ```
3. Install semua dependencies proyek:
   ```bash
   composer install
   ```

4. Duplikat file environment:
   ```bash
   cp .env.example .env
   ```
   *(Catatan untuk target Windows: gunakan perintah `copy .env.example .env` atau salin manual)*

5. Generate application key:
   ```bash
   php artisan key:generate
   ```

6. Jalankan migrasi database:
   ```bash
   php artisan migrate
   ```
   *(Jika muncul prompt untuk membuat file database konfigurasi SQLite, ketik 'yes')*

7. Jalankan local server:
   ```bash
   php artisan serve
   ```

8. Buka browser dan akses `http://127.0.0.1:8000`

## Pemenuhan Business Logic & Fitur

Seluruh requirements kriteria studi kasus telah diimplementasikan:
1. **Validasi Minimum Pendapatan**: Sistem otomatis menolak input jika pendapatan per bulan di bawah Rp 1.000.000.
2. **Batas Nominal**: Validasi limit nominal pengajuan maksimal di angka Rp 200.000.000.
3. **Batas Tenor**: Validasi limit durasi tenor maksimal 24 bulan.
4. **Limit Pengajuan**: Limit pengajuan yang sama per nama nasabah dibatasi maksimal 3 kali.
5. **Kalkulasi Matematis**: Cicilan (Tagihan per bulan) dihitung secara otomatis (Nominal / Tenor) dan dijabarkan pada tabel dan detail pengajuan.
6. **Approval Workflow**: Pengajuan baru berstatus default `Pending`. Tersedia interface khusus untuk memproses (mengubah) status menjadi `Disetujui` atau `Ditolak`.
7. **CRUD**: Tersedia kapabilitas operasional lengkap (Create, Read, Update, Delete) pada detail data.

*(Catatan Tambahan: Tersedia kalkulator simulasi kredit langsung pada halaman Landing Page sebagai additional feature).*
