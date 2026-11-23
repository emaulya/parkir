# Dokumentasi LEFT JOIN - Sistem Parkir

## Overview

Proyek ini mengimplementasikan query **LEFT JOIN** untuk menampilkan data yang terhubung antara tiga tabel utama:
- `tb_kendaraan` (Vehicles)
- `tb_transaksi` (Transactions)
- `tb_area_parkir` (Parking Areas)

## Struktur Database

### Tabel: tb_kendaraan
Menyimpan data kendaraan yang parkir

```
Columns:
- id (Primary Key)
- plat_nomor (String, Unique)
- jenis_kendaraan (String)
- merek (String)
- warna (String)
- pemilik (String)
- nomor_telepon (String)
- keterangan (Text)
- timestamps
```

### Tabel: tb_area_parkir
Menyimpan data area/zona parkir

```
Columns:
- id (Primary Key)
- nama_area (String, Unique)
- deskripsi (Text)
- kapasitas (Integer)
- terisi (Integer)
- lokasi (String)
- timestamps
```

### Tabel: tb_transaksi
Menyimpan data transaksi parkir yang menghubungkan kendaraan dan area parkir

```
Columns:
- id (Primary Key)
- kendaraan_id (Foreign Key -> tb_kendaraan.id)
- area_parkir_id (Foreign Key -> tb_area_parkir.id)
- waktu_masuk (DateTime)
- waktu_keluar (DateTime, Nullable)
- durasi_jam (Integer, Nullable)
- tarif (Decimal)
- biaya_total (Decimal)
- status (String: 'aktif' or 'selesai')
- keterangan (Text)
- timestamps
```

## Relationships

```
tb_kendaraan
    └── hasMany → tb_transaksi (via kendaraan_id)

tb_area_parkir
    └── hasMany → tb_transaksi (via area_parkir_id)

tb_transaksi
    ├── belongsTo → tb_kendaraan (via kendaraan_id)
    └── belongsTo → tb_area_parkir (via area_parkir_id)
```

## Query LEFT JOIN Utama

### 1. Query: Semua Data dengan LEFT JOIN

**File:** `app/Http/Controllers/DataTransaksiController.php` - Method: `index()`

```php
DB::table('tb_kendaraan')
    ->leftJoin('tb_transaksi', 'tb_kendaraan.id', '=', 'tb_transaksi.kendaraan_id')
    ->leftJoin('tb_area_parkir', 'tb_transaksi.area_parkir_id', '=', 'tb_area_parkir.id')
    ->select(
        'tb_kendaraan.id as kendaraan_id',
        'tb_kendaraan.plat_nomor',
        'tb_kendaraan.jenis_kendaraan',
        'tb_kendaraan.merek',
        'tb_kendaraan.warna',
        'tb_kendaraan.pemilik',
        'tb_kendaraan.nomor_telepon',
        'tb_transaksi.id as transaksi_id',
        'tb_transaksi.waktu_masuk',
        'tb_transaksi.waktu_keluar',
        'tb_transaksi.durasi_jam',
        'tb_transaksi.tarif',
        'tb_transaksi.biaya_total',
        'tb_transaksi.status',
        'tb_area_parkir.id as area_id',
        'tb_area_parkir.nama_area',
        'tb_area_parkir.kapasitas',
        'tb_area_parkir.terisi',
        'tb_area_parkir.lokasi'
    )
    ->orderBy('tb_kendaraan.id')
    ->get();
```

**Penjelasan:**
- Menampilkan **SEMUA kendaraan** dari `tb_kendaraan` (LEFT table)
- Kendaraan yang memiliki transaksi akan menampilkan data transaksi dan area parkir
- Kendaraan yang TIDAK memiliki transaksi akan menampilkan NULL untuk field transaksi dan area parkir

**Route:** `GET /data-transaksi`

---

### 2. Query: Transaksi Aktif (dengan WHERE Clause)

**File:** `app/Http/Controllers/DataTransaksiController.php` - Method: `aktif()`

```php
DB::table('tb_kendaraan')
    ->leftJoin('tb_transaksi', 'tb_kendaraan.id', '=', 'tb_transaksi.kendaraan_id')
    ->leftJoin('tb_area_parkir', 'tb_transaksi.area_parkir_id', '=', 'tb_area_parkir.id')
    ->where('tb_transaksi.status', 'aktif')
    ->select(...)
    ->orderBy('tb_transaksi.waktu_masuk', 'DESC')
    ->get();
```

**Penjelasan:**
- Menampilkan hanya kendaraan yang sedang melakukan parkir (status = 'aktif')
- WHERE clause diterapkan **setelah** LEFT JOIN
- Hasil hanya menampilkan baris yang memiliki transaksi aktif

**Route:** `GET /data-transaksi/aktif`

---

### 3. Query: Statistik Area Parkir (dengan GROUP BY & Aggregation)

**File:** `app/Http/Controllers/DataTransaksiController.php` - Method: `statistikArea()`

```php
DB::table('tb_area_parkir')
    ->leftJoin('tb_transaksi', 'tb_area_parkir.id', '=', 'tb_transaksi.area_parkir_id')
    ->leftJoin('tb_kendaraan', 'tb_transaksi.kendaraan_id', '=', 'tb_kendaraan.id')
    ->select(
        'tb_area_parkir.id as area_id',
        'tb_area_parkir.nama_area',
        'tb_area_parkir.deskripsi',
        'tb_area_parkir.kapasitas',
        'tb_area_parkir.terisi',
        'tb_area_parkir.lokasi',
        DB::raw('COUNT(tb_transaksi.id) as total_transaksi'),
        DB::raw('COUNT(CASE WHEN tb_transaksi.status = "aktif" THEN 1 END) as transaksi_aktif'),
        DB::raw('SUM(tb_transaksi.biaya_total) as total_pendapatan')
    )
    ->groupBy(
        'tb_area_parkir.id', 
        'tb_area_parkir.nama_area', 
        'tb_area_parkir.deskripsi', 
        'tb_area_parkir.kapasitas', 
        'tb_area_parkir.terisi', 
        'tb_area_parkir.lokasi'
    )
    ->get();
```

**Penjelasan:**
- **LEFT table:** `tb_area_parkir` (semua area akan ditampilkan)
- **Aggregation Functions:**
  - `COUNT(tb_transaksi.id)` - Total transaksi per area
  - `COUNT(CASE WHEN ...)` - Total transaksi aktif per area
  - `SUM(tb_transaksi.biaya_total)` - Total pendapatan per area
- **GROUP BY** mengelompokkan hasil berdasarkan area parkir
- Area yang tidak memiliki transaksi akan menampilkan 0 untuk aggregate values

**Route:** `GET /data-transaksi/statistik-area`

---

### 4. Query: Detail Kendaraan (Single Record dengan Multiple Joins)

**File:** `app/Http/Controllers/DataTransaksiController.php` - Method: `detailKendaraan($id)`

```php
DB::table('tb_kendaraan')
    ->where('tb_kendaraan.id', $id)
    ->leftJoin('tb_transaksi', 'tb_kendaraan.id', '=', 'tb_transaksi.kendaraan_id')
    ->leftJoin('tb_area_parkir', 'tb_transaksi.area_parkir_id', '=', 'tb_area_parkir.id')
    ->select(...)
    ->orderBy('tb_transaksi.waktu_masuk', 'DESC')
    ->get();
```

**Penjelasan:**
- Menampilkan detail kendaraan spesifik + semua transaksinya
- WHERE clause memfilter berdasarkan kendaraan_id
- Transaksi ditampilkan terurut dari yang paling baru

**Route:** `GET /data-transaksi/detail-kendaraan/{id}`

---

## Models dan Relationships

### Model: Kendaraan
```php
class Kendaraan extends Model
{
    protected $table = 'tb_kendaraan';
    
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'kendaraan_id');
    }
}
```

### Model: AreaParkir
```php
class AreaParkir extends Model
{
    protected $table = 'tb_area_parkir';
    
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'area_parkir_id');
    }
}
```

### Model: Transaksi
```php
class Transaksi extends Model
{
    protected $table = 'tb_transaksi';
    
    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'kendaraan_id');
    }

    public function areaParkir()
    {
        return $this->belongsTo(AreaParkir::class, 'area_parkir_id');
    }
}
```

---

## Setup & Cara Menggunakan

### 1. Jalankan Migrations
```bash
php artisan migrate
```

### 2. Seed Database dengan Data Sample
```bash
php artisan db:seed
```

Atau seed class spesifik:
```bash
php artisan db:seed --class=AreaParkirSeeder
php artisan db:seed --class=KendaraanSeeder
php artisan db:seed --class=TransaksiSeeder
```

### 3. Akses Routes

| Route | Metode | Deskripsi |
|-------|--------|-----------|
| `/data-transaksi` | GET | Menampilkan semua data dengan LEFT JOIN |
| `/data-transaksi/aktif` | GET | Menampilkan transaksi aktif |
| `/data-transaksi/statistik-area` | GET | Menampilkan statistik area parkir |
| `/data-transaksi/detail-kendaraan/{id}` | GET | Menampilkan detail kendaraan & transaksinya |

---

## Visualisasi LEFT JOIN

### Diagram: Kendaraan LEFT JOIN Transaksi LEFT JOIN Area Parkir

```
tb_kendaraan (LEFT TABLE)
│
├─ Kendaraan 1 (B 1234 ABC)
│  │
│  └─→ [LEFT JOIN] tb_transaksi
│      │
│      ├─ Transaksi 1 (2024-01-15 08:00)
│      │  └─→ [LEFT JOIN] tb_area_parkir → Area A
│      │
│      └─ Transaksi 2 (2024-01-14 10:00)
│         └─→ [LEFT JOIN] tb_area_parkir → Area B
│
├─ Kendaraan 2 (B 5678 DEF)
│  │
│  └─→ [LEFT JOIN] tb_transaksi
│      │
│      └─ Transaksi 3 (2024-01-15 14:00)
│         └─→ [LEFT JOIN] tb_area_parkir → Area A
│
└─ Kendaraan 3 (B 2468 GHI) - Tanpa Transaksi
   │
   └─→ [LEFT JOIN] tb_transaksi → NULL
      └─→ [LEFT JOIN] tb_area_parkir → NULL
```

---

## SQL Comparison: INNER vs LEFT JOIN

### INNER JOIN (Hanya yang cocok di kedua tabel)
```sql
SELECT k.plat_nomor, t.waktu_masuk, a.nama_area
FROM tb_kendaraan k
INNER JOIN tb_transaksi t ON k.id = t.kendaraan_id
INNER JOIN tb_area_parkir a ON t.area_parkir_id = a.id;

-- Hasil: 10 rows (hanya kendaraan yang punya transaksi)
```

### LEFT JOIN (Semua dari left table, cocok dari right table)
```sql
SELECT k.plat_nomor, t.waktu_masuk, a.nama_area
FROM tb_kendaraan k
LEFT JOIN tb_transaksi t ON k.id = t.kendaraan_id
LEFT JOIN tb_area_parkir a ON t.area_parkir_id = a.id;

-- Hasil: 12 rows (semua kendaraan, termasuk yang tidak punya transaksi)
```

---

## Contoh Data Hasil Query

| plat_nomor | pemilik | jenis_kendaraan | nama_area | waktu_masuk | status |
|-----------|---------|-----------------|-----------|------------|--------|
| B 1234 ABC | Budi | Mobil | Area A | 2024-01-15 08:30 | aktif |
| B 5678 DEF | Siti | Mobil | Area B | 2024-01-15 09:15 | aktif |
| B 2468 GHI | Ahmad | Motor | Area A | 2024-01-15 10:00 | aktif |
| B 1357 JKL | Rini | Motor | NULL | NULL | NULL |
| B 9876 MNO | Hendra | Mobil | Area A | 2024-01-15 11:00 | selesai |

*Baris terakhir menunjukkan kendaraan yang belum memiliki transaksi*

---

## Performance Tips

1. **Index Fields yang Sering Digunakan dalam JOIN:**
   ```php
   // Dalam migration
   $table->foreign('kendaraan_id')->constrained('tb_kendaraan')->onDelete('cascade');
   $table->foreign('area_parkir_id')->constrained('tb_area_parkir')->onDelete('cascade');
   ```

2. **Gunakan Select untuk Kolom yang Diperlukan:**
   ```php
   // ✓ Baik - Hanya select kolom yang dibutuhkan
   ->select('tb_kendaraan.id', 'tb_kendaraan.plat_nomor', ...)
   
   // ✗ Kurang efisien - Select semua kolom
   ->select('*')
   ```

3. **Eager Load Relationships saat menggunakan ORM:**
   ```php
   $kendaraan = Kendaraan::with('transaksi.areaParkir')->get();
   ```

---

## File Structure

```
app/
├── Http/Controllers/
│   └── DataTransaksiController.php
├── Models/
│   ├── Kendaraan.php
│   ├── AreaParkir.php
│   └── Transaksi.php

database/
├── migrations/
│   ├── 0001_01_01_000003_create_tb_area_parkir_table.php
│   ├── 0001_01_01_000004_create_tb_kendaraan_table.php
│   └── 0001_01_01_000005_create_tb_transaksi_table.php
├── seeders/
│   ├── AreaParkirSeeder.php
│   ├── KendaraanSeeder.php
│   ├── TransaksiSeeder.php
│   └── DatabaseSeeder.php

resources/views/
└── data-transaksi/
    ├── index.blade.php
    ├── aktif.blade.php
    ├── statistik-area.blade.php
    └── detail-kendaraan.blade.php

routes/
└── web.php
```

---

## Kesimpulan

Implementasi **LEFT JOIN** ini mendemonstrasikan:
- ✓ Multi-table joins (3 tabel)
- ✓ Relationship mapping di Laravel
- ✓ Aggregation functions (COUNT, SUM)
- ✓ GROUP BY clause
- ✓ WHERE filtering setelah JOIN
- ✓ Null value handling
- ✓ Complex data relationships

Semua konsep ini adalah fondasi penting untuk query database yang kompleks dan efisien!

---

**Version:** 1.0  
**Last Updated:** 2026-08-31  
**Author:** Database Team
