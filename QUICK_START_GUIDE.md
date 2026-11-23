# Quick Start Guide - LEFT JOIN Implementation

## 📋 Ringkasan Fitur

Implementasi query **LEFT JOIN** antara 3 tabel utama:
- **tb_kendaraan** (Data Kendaraan)
- **tb_transaksi** (Data Transaksi Parkir)
- **tb_area_parkir** (Data Area Parkir)

---

## 🚀 Setup Cepat

### Step 1: Jalankan Migrations
```bash
php artisan migrate
```

**Output yang diharapkan:**
```
Migrating: database/migrations/0001_01_01_000003_create_tb_area_parkir_table.php
Migrated:  database/migrations/0001_01_01_000003_create_tb_area_parkir_table.php
Migrating: database/migrations/0001_01_01_000004_create_tb_kendaraan_table.php
Migrated:  database/migrations/0001_01_01_000004_create_tb_kendaraan_table.php
Migrating: database/migrations/0001_01_01_000005_create_tb_transaksi_table.php
Migrated:  database/migrations/0001_01_01_000005_create_tb_transaksi_table.php
```

### Step 2: Seed Database dengan Data Sample
```bash
php artisan db:seed
```

**Output yang diharapkan:**
```
Seeding: Database\Seeders\DatabaseSeeder
Seeding: Database\Seeders\AreaParkirSeeder
Seeded:  Database\Seeders\AreaParkirSeeder (XX.XXXms)
Seeding: Database\Seeders\KendaraanSeeder
Seeded:  Database\Seeders\KendaraanSeeder (XX.XXXms)
Seeding: Database\Seeders\TransaksiSeeder
Seeded:  Database\Seeders\TransaksiSeeder (XX.XXXms)
Database seeding completed successfully.
```

### Step 3: Jalankan Development Server
```bash
php artisan serve
```

---

## 🌐 Mengakses Halaman

Buka browser dan akses URL berikut:

### 1. Data Transaksi (Semua Data)
📍 **URL:** `http://localhost:8000/data-transaksi`

**Fitur:**
- Menampilkan SEMUA kendaraan
- Kendaraan dengan/tanpa transaksi ditampilkan
- Data dari ketiga tabel digabungkan dengan LEFT JOIN
- Klik "Detail" untuk melihat riwayat transaksi kendaraan

### 2. Transaksi Aktif
📍 **URL:** `http://localhost:8000/data-transaksi/aktif`

**Fitur:**
- Menampilkan kendaraan yang sedang parkir (status = aktif)
- Statistik: Total kendaraan aktif, total tarif, total potensi pendapatan
- Tabel terurut dari transaksi terbaru
- Durasi dihitung otomatis dari waktu masuk

### 3. Statistik Area Parkir
📍 **URL:** `http://localhost:8000/data-transaksi/statistik-area`

**Fitur:**
- Menampilkan statistik setiap area parkir
- Informasi: Kapasitas, terisi, ketersediaan
- Aggregation: Total transaksi, transaksi aktif, total pendapatan
- Color coding untuk indikator ketersediaan

### 4. Detail Kendaraan
📍 **URL:** `http://localhost:8000/data-transaksi/detail-kendaraan/{id}`

Contoh:
- `http://localhost:8000/data-transaksi/detail-kendaraan/1` - Kendaraan ID 1
- `http://localhost:8000/data-transaksi/detail-kendaraan/2` - Kendaraan ID 2

**Fitur:**
- Informasi lengkap kendaraan
- Statistik kendaraan (total transaksi, transaksi aktif, total pendapatan)
- Riwayat semua transaksi kendaraan
- Terurut dari transaksi terbaru

---

## 🗂️ File-File Penting

### Controllers
```
app/Http/Controllers/DataTransaksiController.php
```
**Method:**
- `index()` - Semua data dengan LEFT JOIN
- `aktif()` - Transaksi aktif
- `statistikArea()` - Statistik area parkir
- `detailKendaraan($id)` - Detail kendaraan

### Models
```
app/Models/Kendaraan.php
app/Models/AreaParkir.php
app/Models/Transaksi.php
```

### Migrations
```
database/migrations/0001_01_01_000003_create_tb_area_parkir_table.php
database/migrations/0001_01_01_000004_create_tb_kendaraan_table.php
database/migrations/0001_01_01_000005_create_tb_transaksi_table.php
```

### Seeders
```
database/seeders/AreaParkirSeeder.php
database/seeders/KendaraanSeeder.php
database/seeders/TransaksiSeeder.php
```

### Views
```
resources/views/data-transaksi/index.blade.php
resources/views/data-transaksi/aktif.blade.php
resources/views/data-transaksi/statistik-area.blade.php
resources/views/data-transaksi/detail-kendaraan.blade.php
```

### Routes
```
routes/web.php - Routes dengan prefix 'data-transaksi'
```

---

## 📚 Dokumentasi Lengkap

Untuk penjelasan detail tentang LEFT JOIN queries, silakan buka:
```
LEFT_JOIN_DOCUMENTATION.md
```

---

## 🔄 Workflow Umum

```
1. User mengakses /data-transaksi
   ↓
2. Controller mengexecute query LEFT JOIN
   ↓
3. Database mengembalikan result set
   ↓
4. View menampilkan data dalam tabel/cards
   ↓
5. User dapat navigate ke detail atau halaman lain
```

---

## 💡 Contoh Query SQL yang Dihasilkan

Saat mengakses `/data-transaksi`, query yang dijalankan kurang lebih seperti:

```sql
SELECT 
    k.id, k.plat_nomor, k.jenis_kendaraan, k.merek, k.warna, k.pemilik, k.nomor_telepon,
    t.id as transaksi_id, t.waktu_masuk, t.waktu_keluar, t.durasi_jam, t.tarif, t.biaya_total, t.status,
    a.id as area_id, a.nama_area, a.kapasitas, a.terisi, a.lokasi
FROM tb_kendaraan k
LEFT JOIN tb_transaksi t ON k.id = t.kendaraan_id
LEFT JOIN tb_area_parkir a ON t.area_parkir_id = a.id
ORDER BY k.id;
```

---

## ⚙️ Troubleshooting

### Problem: Halaman menampilkan error "Class not found"
**Solusi:** Pastikan telah menjalankan `php artisan migrate`

### Problem: Database kosong (tidak ada data)
**Solusi:** Jalankan `php artisan db:seed`

### Problem: Relationship error
**Solusi:** Pastikan Models sudah dibuat dan di-import di Controller

### Problem: Routes tidak ditemukan
**Solusi:** Jalankan `php artisan route:list` untuk melihat semua routes yang terdaftar

---

## 🎯 Fitur Tambahan yang Bisa Dikembangkan

1. **Export ke Excel:** Tambahkan functionality untuk export data
2. **Filter & Search:** Tambahkan filter berdasarkan area, tanggal, status
3. **Charts & Graphs:** Visualisasi data dengan chart libraries
4. **Real-time Updates:** Gunakan WebSockets untuk update real-time
5. **Advanced Reporting:** Buat laporan detail dengan PDF export
6. **API Endpoints:** Buat RESTful API untuk data ini

---

## 📞 Support

Jika ada pertanyaan atau masalah, silakan:
1. Baca dokumentasi lengkap: `LEFT_JOIN_DOCUMENTATION.md`
2. Check file-file di folder yang sesuai
3. Verifikasi bahwa migrations dan seeders sudah berjalan

---

**Last Updated:** 2026-08-31
