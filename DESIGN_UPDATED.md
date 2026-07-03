# SIHATI BPPKAD — Desain Frontend dan Backend (Update ERD Terbaru)

**Nama aplikasi:** SIHATI BPPKAD  
**Kepanjangan:** Sistem Helpdesk Aduan Teknologi Informasi BPPKAD  
**Backend:** Laravel, PHP, MySQL/MariaDB  
**Frontend:** Laravel Blade + Tailwind CSS  
**Acuan frontend:** `DESIGN1.md`  
**Role aplikasi:** `pegawai` dan `admin`

Dokumen ini adalah versi update yang menyesuaikan:

1. kebutuhan frontend tetap mengikuti gaya **DESIGN1.md**,
2. role aplikasi hanya **Pegawai** dan **Admin**,
3. struktur backend mengikuti **ERD terbaru**,
4. status aduan hanya terdiri dari **diterima**, **diproses**, dan **selesai**,
5. fitur **log aktivitas** tetap dipertahankan.

---

## 1. Ringkasan Sistem

SIHATI BPPKAD digunakan untuk mencatat, memantau, menangani, dan mendokumentasikan aduan teknologi informasi di lingkungan BPPKAD.

Contoh aduan:

1. Komputer atau laptop bermasalah.
2. Printer atau scanner tidak bisa digunakan.
3. Jaringan internet lambat atau terputus.
4. Aplikasi internal tidak dapat diakses.
5. Akun pengguna bermasalah.
6. Perangkat pendukung kerja lainnya.

### 1.1 Alur Utama Sistem

```text
Pegawai login
→ Pegawai membuat aduan
→ Sistem membuat nomor tiket otomatis
→ Sistem menyimpan status awal: diterima
→ Admin melihat aduan
→ Admin mengerjakan aduan
→ Status diubah menjadi diproses
→ Admin menambahkan catatan/komentar/lampiran jika perlu
→ Admin menyelesaikan aduan
→ Status diubah menjadi selesai
→ Pegawai melihat hasil penanganan
→ Jika fitur rating diaktifkan, pegawai dapat memberi penilaian
→ Data masuk ke laporan dan log aktivitas
```

## 2. Tim Pengembangan

Pengerjaan aplikasi dilakukan oleh **4 orang** dengan pembagian sebagai berikut.

### 2.1 Backend Developer 1

Fokus pekerjaan:

- Membuat struktur database sesuai ERD terbaru.
- Membuat migration, model, dan relasi Laravel.
- Membuat autentikasi login/logout.
- Membuat role pengguna, yaitu **pegawai** dan **admin**.
- Membuat middleware akses berdasarkan role.
- Membuat fitur pengelolaan pengguna.
- Membuat fitur data master seperti bidang, kategori, prioritas, dan status.
- Membuat seeder awal untuk admin, prioritas, dan status aduan.
- Memastikan status aduan hanya menggunakan **diterima**, **diproses**, dan **selesai**.

### 2.2 Backend Developer 2

Fokus pekerjaan:

- Membuat fitur aduan/tiket.
- Membuat nomor tiket otomatis.
- Membuat status awal aduan menjadi **diterima**.
- Membuat fitur perubahan status aduan dari **diterima → diproses → selesai**.
- Membuat fitur riwayat perubahan status aduan.
- Membuat fitur catatan penanganan.
- Membuat fitur komentar/diskusi aduan.
- Membuat fitur upload lampiran aduan.
- Membuat fitur rating layanan setelah aduan selesai.
- Membuat fitur log aktivitas sistem.
- Membuat fitur laporan, export, dan cetak.

### 2.3 Frontend Developer 1

Fokus pekerjaan:

- Membuat layout utama Blade.
- Membuat layout guest untuk halaman login.
- Membuat halaman login.
- Membuat dashboard untuk role **pegawai** dan **admin**.
- Membuat sidebar, topbar/navbar, card statistik, dan komponen umum.
- Membuat komponen badge status untuk **diterima**, **diproses**, dan **selesai**.
- Membuat komponen badge prioritas.
- Membuat komponen form, button, card, alert, modal, empty state, dan pagination.
- Menyesuaikan tampilan frontend dengan **DESIGN1.md**.
- Membuat halaman data master.

### 2.4 Frontend Developer 2

Fokus pekerjaan:

- Membuat halaman aduan.
- Membuat form buat aduan.
- Membuat halaman detail aduan.
- Membuat tampilan riwayat status.
- Membuat tampilan catatan penanganan.
- Membuat tampilan komentar/diskusi aduan.
- Membuat tampilan upload lampiran.
- Membuat tampilan rating layanan.
- Membuat tabel, filter, badge status, modal, dan halaman laporan.
- Membuat halaman log aktivitas untuk admin.
- Memastikan tampilan responsive di desktop dan mobile.
---

## 3. Role Pengguna

Aplikasi hanya menggunakan 2 role.

### 3.1 Pegawai

Pegawai adalah pengguna yang membuat aduan dan memantau aduan miliknya sendiri.

Hak akses Pegawai:

1. Login dan logout.
2. Melihat dashboard pribadi.
3. Membuat aduan baru.
4. Melihat daftar aduan miliknya sendiri.
5. Melihat detail aduan miliknya sendiri.
6. Menambahkan komentar pada aduan miliknya.
7. Mengunggah lampiran saat membuat aduan atau pada diskusi jika diizinkan.
8. Melihat riwayat perubahan status.
9. Melihat catatan penanganan.
10. Memberikan rating layanan ketika aduan sudah selesai, jika fitur rating diaktifkan.
11. Mengelola profil pribadi terbatas.

Pegawai tidak boleh:

1. Melihat aduan milik pengguna lain.
2. Mengubah status aduan.
3. Mengelola data master.
4. Melihat laporan keseluruhan sistem.
5. Mengakses log aktivitas sistem.

### 3.2 Admin

Admin adalah pengguna yang menangani aduan sekaligus mengelola kebutuhan administratif aplikasi.

Hak akses Admin:

1. Login dan logout.
2. Melihat dashboard seluruh aduan.
3. Melihat seluruh aduan.
4. Mengubah status aduan dari `diterima` → `diproses` → `selesai`.
5. Menambahkan catatan penanganan.
6. Menambahkan komentar.
7. Mengunggah lampiran tambahan bila diperlukan.
8. Mengelola kategori aduan.
9. Mengelola bidang/unit kerja.
10. Mengelola pengguna.
11. Melihat laporan aduan.
12. Mencetak atau export laporan jika fitur backend tersedia.
13. Melihat log aktivitas.
14. Mengelola profil pribadi.

---

## 4. Value Role di Database

Gunakan value role berikut:

```text
pegawai
admin
```

Contoh implementasi:

```text
role ENUM('pegawai', 'admin') DEFAULT 'pegawai'
```

Label UI:

| Value Database | Label UI |
|---|---|
| `pegawai` | Pegawai |
| `admin` | Admin |

---

## 5. Status Aduan

Sesuai update terbaru, status aduan hanya menggunakan 3 status.

```text
diterima
diproses
selesai
```

Label UI:

| Value Database | Label UI | Keterangan |
|---|---|---|
| `diterima` | Diterima | Status awal ketika aduan berhasil dibuat dan masuk ke sistem |
| `diproses` | Diproses | Aduan sedang dikerjakan oleh Admin |
| `selesai` | Selesai | Aduan telah diselesaikan |

### 5.1 Urutan Status

| Kode | Nama Status | Urutan | Final |
|---|---|---:|---|
| `diterima` | Diterima | 1 | Tidak |
| `diproses` | Diproses | 2 | Tidak |
| `selesai` | Selesai | 3 | Ya |

### 5.2 Alur Transisi Status

```text
diterima
→ diproses
→ selesai
```

Catatan:

1. Saat pegawai membuat aduan, sistem langsung memberi status awal `diterima`.
2. Admin mengubah status ke `diproses` saat mulai menangani.
3. Admin mengubah status ke `selesai` saat pekerjaan selesai.
4. Setiap perubahan status wajib membuat data pada `aduan_status_histories`.
5. Setiap perubahan status juga wajib dicatat pada `activity_logs`.

---

## 6. Struktur Database Berdasarkan ERD Terbaru

Berikut tabel-tabel utama yang digunakan.

### 6.1 Tabel `bidangs`

| Kolom | Tipe | Keterangan |
|---|---|---|
| `id` | BIGINT PK | ID bidang |
| `nama_bidang` | VARCHAR(100) | Nama bidang/unit kerja |
| `keterangan` | TEXT NULL | Keterangan tambahan |
| `created_at` | TIMESTAMP | Waktu dibuat |
| `updated_at` | TIMESTAMP | Waktu diperbarui |

### 6.2 Tabel `users`

| Kolom | Tipe | Keterangan |
|---|---|---|
| `id` | BIGINT PK | ID user |
| `bidang_id` | BIGINT FK NULL | Relasi ke `bidangs.id` |
| `name` | VARCHAR(100) | Nama lengkap |
| `username` | VARCHAR(50) UNIQUE | Username |
| `email` | VARCHAR(100) UNIQUE | Email |
| `password` | VARCHAR(255) | Password hash |
| `no_hp` | VARCHAR(20) NULL | Nomor HP |
| `role` | ENUM/USER_ROLE | `pegawai` atau `admin` |
| `is_active` | BOOLEAN | Status aktif user |
| `email_verified_at` | TIMESTAMP NULL | Waktu verifikasi email |
| `remember_token` | VARCHAR(100) NULL | Token remember me |
| `created_at` | TIMESTAMP | Waktu dibuat |
| `updated_at` | TIMESTAMP | Waktu diperbarui |

### 6.3 Tabel `categories`

| Kolom | Tipe | Keterangan |
|---|---|---|
| `id` | BIGINT PK | ID kategori |
| `nama_kategori` | VARCHAR(100) | Nama kategori aduan |
| `deskripsi` | TEXT NULL | Deskripsi kategori |
| `is_active` | BOOLEAN | Status aktif/nonaktif |
| `created_at` | TIMESTAMP | Waktu dibuat |
| `updated_at` | TIMESTAMP | Waktu diperbarui |

### 6.4 Tabel `priorities`

| Kolom | Tipe | Keterangan |
|---|---|---|
| `id` | BIGINT PK | ID prioritas |
| `nama_prioritas` | VARCHAR(50) | Nama prioritas |
| `keterangan` | TEXT NULL | Keterangan prioritas |
| `level` | INTEGER | Level urutan prioritas |
| `created_at` | TIMESTAMP | Waktu dibuat |
| `updated_at` | TIMESTAMP | Waktu diperbarui |

Contoh isi data:

1. Rendah
2. Sedang
3. Tinggi
4. Mendesak

### 6.5 Tabel `statuses`

| Kolom | Tipe | Keterangan |
|---|---|---|
| `id` | BIGINT PK | ID status |
| `kode_status` | VARCHAR(50) UNIQUE | Kode status |
| `nama_status` | VARCHAR(100) | Label status |
| `urutan` | INTEGER | Urutan transisi |
| `is_final` | BOOLEAN | Penanda status final |
| `created_at` | TIMESTAMP | Waktu dibuat |
| `updated_at` | TIMESTAMP | Waktu diperbarui |

Contoh seed data:

| kode_status | nama_status | urutan | is_final |
|---|---|---:|---|
| `diterima` | Diterima | 1 | 0 |
| `diproses` | Diproses | 2 | 0 |
| `selesai` | Selesai | 3 | 1 |

### 6.6 Tabel `aduans`

| Kolom | Tipe | Keterangan |
|---|---|---|
| `id` | BIGINT PK | ID aduan |
| `nomor_tiket` | VARCHAR(30) UNIQUE | Nomor tiket otomatis |
| `pelapor_id` | BIGINT FK | Relasi ke `users.id`, pembuat aduan |
| `petugas_id` | BIGINT FK NULL | Relasi ke `users.id`, admin penangan |
| `bidang_id` | BIGINT FK | Relasi ke `bidangs.id` |
| `category_id` | BIGINT FK | Relasi ke `categories.id` |
| `priority_id` | BIGINT FK NULL | Relasi ke `priorities.id` |
| `status_id` | BIGINT FK | Relasi ke `statuses.id` |
| `judul` | VARCHAR(150) | Judul aduan |
| `deskripsi` | TEXT | Deskripsi aduan |
| `lokasi` | VARCHAR(150) NULL | Lokasi/ruangan |
| `no_kontak` | VARCHAR(20) NULL | Kontak tambahan |
| `tanggal_aduan` | TIMESTAMP | Waktu aduan dibuat |
| `tanggal_diterima` | TIMESTAMP NULL | Waktu status diterima |
| `tanggal_diproses` | TIMESTAMP NULL | Waktu status diproses |
| `tanggal_selesai` | TIMESTAMP NULL | Waktu status selesai |
| `created_at` | TIMESTAMP | Waktu dibuat |
| `updated_at` | TIMESTAMP | Waktu diperbarui |

Catatan:

1. `pelapor_id` = user pegawai pembuat tiket.
2. `petugas_id` = admin yang menangani tiket.
3. Status awal saat create adalah `diterima`.
4. `status_id` mengarah ke tabel `statuses`, bukan enum langsung di tabel `aduans`.

### 6.7 Tabel `aduan_attachments`

| Kolom | Tipe | Keterangan |
|---|---|---|
| `id` | BIGINT PK | ID lampiran |
| `aduan_id` | BIGINT FK | Relasi ke `aduans.id` |
| `uploaded_by` | BIGINT FK | Relasi ke `users.id` |
| `file_name` | VARCHAR(255) | Nama file |
| `file_path` | VARCHAR(255) | Path file |
| `file_type` | VARCHAR(50) NULL | Tipe file |
| `file_size` | INTEGER NULL | Ukuran file |
| `created_at` | TIMESTAMP | Waktu upload |
| `updated_at` | TIMESTAMP | Waktu diperbarui |

### 6.8 Tabel `aduan_notes`

| Kolom | Tipe | Keterangan |
|---|---|---|
| `id` | BIGINT PK | ID catatan |
| `aduan_id` | BIGINT FK | Relasi ke `aduans.id` |
| `petugas_id` | BIGINT FK | Relasi ke `users.id`, admin pencatat |
| `catatan` | TEXT | Catatan penanganan |
| `created_at` | TIMESTAMP | Waktu dibuat |
| `updated_at` | TIMESTAMP | Waktu diperbarui |

### 6.9 Tabel `aduan_comments`

| Kolom | Tipe | Keterangan |
|---|---|---|
| `id` | BIGINT PK | ID komentar |
| `aduan_id` | BIGINT FK | Relasi ke `aduans.id` |
| `user_id` | BIGINT FK | Relasi ke `users.id` |
| `komentar` | TEXT | Isi komentar |
| `created_at` | TIMESTAMP | Waktu dibuat |
| `updated_at` | TIMESTAMP | Waktu diperbarui |

### 6.10 Tabel `ratings`

| Kolom | Tipe | Keterangan |
|---|---|---|
| `id` | BIGINT PK | ID rating |
| `aduan_id` | BIGINT FK | Relasi ke `aduans.id` |
| `user_id` | BIGINT FK | Relasi ke `users.id` |
| `rating` | TINYINT | Nilai rating |
| `komentar` | TEXT NULL | Komentar rating |
| `created_at` | TIMESTAMP | Waktu dibuat |
| `updated_at` | TIMESTAMP | Waktu diperbarui |

### 6.11 Tabel `aduan_status_histories`

| Kolom | Tipe | Keterangan |
|---|---|---|
| `id` | BIGINT PK | ID history status |
| `aduan_id` | BIGINT FK | Relasi ke `aduans.id` |
| `status_sebelumnya_id` | BIGINT FK NULL | Status sebelum perubahan |
| `status_baru_id` | BIGINT FK | Status setelah perubahan |
| `changed_by` | BIGINT FK | User yang mengubah status |
| `keterangan` | TEXT NULL | Catatan perubahan |
| `created_at` | TIMESTAMP | Waktu perubahan |
| `updated_at` | TIMESTAMP | Waktu diperbarui |

Catatan:

1. Saat aduan pertama kali dibuat, `status_sebelumnya_id` boleh `NULL`.
2. Saat create awal, `status_baru_id` berisi status `diterima`.
3. Saat admin mengubah ke `diproses` atau `selesai`, wajib menambah record baru.

### 6.12 Tabel `activity_logs`

| Kolom | Tipe | Keterangan |
|---|---|---|
| `id` | BIGINT PK | ID log aktivitas |
| `user_id` | BIGINT FK NULL | User yang melakukan aksi |
| `action` | VARCHAR(100) | Aksi ringkas |
| `module` | VARCHAR(100) | Modul terkait |
| `description` | TEXT | Deskripsi aktivitas |
| `target_table` | VARCHAR(100) NULL | Nama tabel target |
| `target_id` | BIGINT NULL | ID data target |
| `old_values` | JSON NULL | Data lama |
| `new_values` | JSON NULL | Data baru |
| `ip_address` | VARCHAR(45) NULL | IP address |
| `user_agent` | TEXT NULL | User agent |
| `created_at` | TIMESTAMP | Waktu aktivitas |

---

## 7. Relasi Utama Antar Tabel

Ringkasan relasi sesuai ERD:

```text
Bidang hasMany Users
Bidang hasMany Aduans

User belongsTo Bidang
User hasMany Aduans as pelapor
User hasMany Aduans as petugas
User hasMany AduanAttachments as uploader
User hasMany AduanComments
User hasMany AduanNotes as petugas
User hasMany Ratings
User hasMany ActivityLogs

Category hasMany Aduans
Priority hasMany Aduans
Status hasMany Aduans
Status hasMany AduanStatusHistories as previous/new status

Aduan belongsTo User as pelapor
Aduan belongsTo User as petugas
Aduan belongsTo Bidang
Aduan belongsTo Category
Aduan belongsTo Priority
Aduan belongsTo Status
Aduan hasMany AduanAttachments
Aduan hasMany AduanNotes
Aduan hasMany AduanComments
Aduan hasMany AduanStatusHistories
Aduan hasMany Ratings
```

---

## 8. Alur Backend per Modul

### 8.1 Login

Flow:

```text
User membuka halaman login
→ Input username/email dan password
→ Backend validasi kredensial
→ Cek user aktif
→ Login berhasil
→ Redirect sesuai role
→ Simpan activity log: login
```

### 8.2 Pegawai Membuat Aduan

Flow:

```text
Pegawai membuka form buat aduan
→ Isi judul, kategori, prioritas, deskripsi, lokasi, kontak, lampiran
→ Backend validasi
→ Generate nomor_tiket
→ Ambil status awal = diterima
→ Simpan ke tabel aduans
→ Simpan lampiran jika ada
→ Simpan history status awal
→ Simpan activity log
→ Redirect ke detail aduan
```

Aturan utama:

1. `tanggal_aduan` diisi saat create.
2. `tanggal_diterima` dapat diisi sama dengan waktu create awal.
3. `petugas_id` boleh `NULL` dulu atau langsung diisi jika admin penangan sudah ditentukan.

### 8.3 Admin Melihat dan Menangani Aduan

Flow:

```text
Admin membuka daftar aduan
→ Backend menampilkan seluruh aduan
→ Admin memilih tiket
→ Admin melihat detail, komentar, lampiran, catatan, history
→ Admin mulai menangani
→ Status diubah menjadi diproses
→ Simpan tanggal_diproses
→ Simpan history status
→ Simpan activity log
```

### 8.4 Admin Menambah Catatan Penanganan

Flow:

```text
Admin membuka detail aduan
→ Admin menambahkan catatan
→ Backend simpan ke tabel aduan_notes
→ Simpan activity log
```

### 8.5 Komentar Aduan

Flow:

```text
Pegawai/Admin membuka detail aduan
→ User menulis komentar
→ Backend validasi
→ Simpan ke tabel aduan_comments
→ Simpan activity log
```

### 8.6 Upload Lampiran

Flow:

```text
User memilih file
→ Backend validasi file
→ Simpan file ke storage
→ Simpan metadata ke aduan_attachments
→ Simpan activity log
```

Aturan upload:

```text
Format: jpg, jpeg, png, pdf
Maksimal: 5 MB
Storage: storage/app/public/aduan
```

### 8.7 Menyelesaikan Aduan

Flow:

```text
Admin membuka detail aduan yang sedang diproses
→ Admin menekan aksi selesai
→ Backend ubah status ke selesai
→ Simpan tanggal_selesai
→ Simpan history status
→ Simpan activity log
→ Aduan masuk laporan selesai
```

### 8.8 Rating Layanan

Flow:

```text
Pegawai membuka detail aduan selesai
→ Pegawai memberi rating dan komentar
→ Backend validasi
→ Simpan ke tabel ratings
→ Simpan activity log
```

### 8.9 Laporan

Flow:

```text
Admin membuka halaman laporan
→ Backend ambil data rekap
→ Filter berdasarkan tanggal, kategori, prioritas, bidang, status, petugas
→ Tampilkan ringkasan dan tabel
→ Jika print/export dijalankan, simpan activity log
```

### 8.10 Log Aktivitas

Flow:

```text
Setiap aksi penting terjadi
→ Panggil ActivityLogService
→ Simpan data user, module, action, description, target_table, target_id
→ Simpan old_values/new_values bila relevan
→ Simpan ip_address dan user_agent
```

Contoh event yang dicatat:

1. Login.
2. Logout.
3. Buat aduan.
4. Ubah status aduan.
5. Tambah komentar.
6. Upload lampiran.
7. Tambah catatan penanganan.
8. Tambah rating.
9. CRUD data master.
10. Print/export laporan.

---

## 9. Rekomendasi Model Laravel

Model yang disiapkan:

1. `User`
2. `Bidang`
3. `Category`
4. `Priority`
5. `Status`
6. `Aduan`
7. `AduanAttachment`
8. `AduanNote`
9. `AduanComment`
10. `Rating`
11. `AduanStatusHistory`
12. `ActivityLog`

---

## 10. Rekomendasi Route Laravel

### 10.1 Route Umum

```php
Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');
```

### 10.2 Route Pegawai

```php
Route::middleware(['auth', 'role:pegawai'])->prefix('pegawai')->name('pegawai.')->group(function () {
    Route::get('/dashboard', [PegawaiDashboardController::class, 'index'])->name('dashboard');
    Route::resource('aduan', PegawaiAduanController::class)->only(['index', 'create', 'store', 'show']);
    Route::post('/aduan/{aduan}/comments', [AduanCommentController::class, 'store'])->name('aduan.comments.store');
    Route::post('/aduan/{aduan}/ratings', [RatingController::class, 'store'])->name('aduan.ratings.store');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});
```

### 10.3 Route Admin

```php
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::resource('aduan', AdminAduanController::class)->only(['index', 'show']);
    Route::patch('/aduan/{aduan}/status', [AdminAduanStatusController::class, 'update'])->name('aduan.status.update');
    Route::post('/aduan/{aduan}/notes', [AduanNoteController::class, 'store'])->name('aduan.notes.store');
    Route::post('/aduan/{aduan}/comments', [AduanCommentController::class, 'store'])->name('aduan.comments.store');
    Route::post('/aduan/{aduan}/attachments', [AduanAttachmentController::class, 'store'])->name('aduan.attachments.store');

    Route::resource('categories', CategoryController::class);
    Route::resource('bidangs', BidangController::class);
    Route::resource('users', UserController::class);

    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/print', [LaporanController::class, 'print'])->name('laporan.print');
    Route::get('/laporan/export', [LaporanController::class, 'export'])->name('laporan.export');

    Route::get('/log-aktivitas', [ActivityLogController::class, 'index'])->name('activity-logs.index');
    Route::get('/log-aktivitas/{activityLog}', [ActivityLogController::class, 'show'])->name('activity-logs.show');

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});
```

---

## 11. Dampak ke Frontend

Frontend tetap mengikuti **DESIGN1.md** dengan penyesuaian berikut:

1. Role hanya **Pegawai** dan **Admin**.
2. Tidak ada dashboard petugas terpisah; gunakan `dashboard/admin.blade.php`.
3. Status badge hanya 3:
   - Diterima
   - Diproses
   - Selesai
4. Tabel detail dan filter harus membaca relasi `status`, `priority`, `category`, dan `bidang`.
5. Halaman log aktivitas hanya untuk Admin.
6. Halaman data master hanya untuk Admin.

### 11.1 Struktur View yang Disarankan

```text
resources/views/
├── auth/
│   └── login.blade.php
├── layouts/
│   ├── app.blade.php
│   ├── guest.blade.php
│   └── print.blade.php
├── partials/
│   ├── sidebar.blade.php
│   ├── topbar.blade.php
│   ├── breadcrumb.blade.php
│   └── footer.blade.php
├── components/
│   ├── button.blade.php
│   ├── card.blade.php
│   ├── stat-card.blade.php
│   ├── badge-status.blade.php
│   ├── badge-priority.blade.php
│   ├── alert.blade.php
│   ├── modal.blade.php
│   ├── empty-state.blade.php
│   └── pagination.blade.php
├── dashboard/
│   ├── pegawai.blade.php
│   └── admin.blade.php
├── aduan/
│   ├── index.blade.php
│   ├── create.blade.php
│   ├── show.blade.php
│   └── partials/
│       ├── filter.blade.php
│       ├── timeline.blade.php
│       ├── notes.blade.php
│       └── comment-box.blade.php
├── laporan/
│   ├── index.blade.php
│   └── print.blade.php
├── master/
│   ├── users/
│   ├── bidangs/
│   └── categories/
├── activity-logs/
│   ├── index.blade.php
│   └── show.blade.php
└── profile/
    └── index.blade.php
```

### 11.2 Mapping Badge Status Frontend

Karena frontend mengikuti DESIGN1.md, badge status disarankan seperti berikut:

| Status | Background | Teks |
|---|---|---|
| Diterima | `bg-sihati-lavender` | `text-sihati-primary-deep` |
| Diproses | `bg-sihati-sky` | `text-sihati-link-pressed` |
| Selesai | `bg-sihati-mint` | `text-sihati-success` |

---

## 12. Kontrak Data Backend ke Frontend

### 12.1 Contoh Data User

```json
{
  "id": 2,
  "bidang_id": 1,
  "name": "Andi Saputra",
  "username": "andi",
  "email": "andi@example.com",
  "no_hp": "08123456789",
  "role": "pegawai",
  "is_active": true
}
```

### 12.2 Contoh Data Aduan List

```json
{
  "id": 1,
  "nomor_tiket": "SIHATI-2026-0001",
  "judul": "Printer tidak bisa mencetak",
  "deskripsi": "Printer menyala tetapi dokumen tidak keluar.",
  "lokasi": "Ruang Bidang Anggaran",
  "no_kontak": "08123456789",
  "tanggal_aduan": "2026-07-03 08:10:00",
  "tanggal_diterima": "2026-07-03 08:10:00",
  "tanggal_diproses": null,
  "tanggal_selesai": null,
  "pelapor": {
    "id": 2,
    "name": "Andi Saputra"
  },
  "petugas": null,
  "bidang": {
    "id": 1,
    "nama_bidang": "Bidang Anggaran"
  },
  "category": {
    "id": 2,
    "nama_kategori": "Printer/Scanner"
  },
  "priority": {
    "id": 2,
    "nama_prioritas": "Sedang"
  },
  "status": {
    "id": 1,
    "kode_status": "diterima",
    "nama_status": "Diterima"
  }
}
```

### 12.3 Contoh Data Log Aktivitas

```json
{
  "id": 15,
  "user_id": 1,
  "action": "update_status",
  "module": "aduan",
  "description": "Admin mengubah status aduan SIHATI-2026-0001 dari diterima menjadi diproses.",
  "target_table": "aduans",
  "target_id": 1,
  "old_values": { "status_id": 1, "status": "diterima" },
  "new_values": { "status_id": 2, "status": "diproses" },
  "ip_address": "127.0.0.1",
  "user_agent": "Mozilla/5.0 ...",
  "created_at": "2026-07-03 09:30:00"
}
```

---

## 13. Checklist Implementasi Backend

### 13.1 Database

- [ ] Migration `bidangs`
- [ ] Migration `users`
- [ ] Migration `categories`
- [ ] Migration `priorities`
- [ ] Migration `statuses`
- [ ] Migration `aduans`
- [ ] Migration `aduan_attachments`
- [ ] Migration `aduan_notes`
- [ ] Migration `aduan_comments`
- [ ] Migration `ratings`
- [ ] Migration `aduan_status_histories`
- [ ] Migration `activity_logs`
- [ ] Seeder `priorities`
- [ ] Seeder `statuses`
- [ ] Seeder admin awal

### 13.2 Logic Aplikasi

- [ ] Login dan logout
- [ ] Middleware role `pegawai` dan `admin`
- [ ] Generate nomor tiket otomatis
- [ ] Simpan status awal `diterima`
- [ ] Update status `diproses`
- [ ] Update status `selesai`
- [ ] Simpan history status
- [ ] Upload lampiran
- [ ] Komentar aduan
- [ ] Catatan penanganan
- [ ] Rating aduan selesai
- [ ] Laporan dan filter
- [ ] Activity log service

---

## 14. Checklist Implementasi Frontend

Frontend tetap mengikuti **DESIGN1.md**.

- [ ] Login page sesuai DESIGN1
- [ ] Dashboard Pegawai
- [ ] Dashboard Admin
- [ ] Daftar aduan Pegawai
- [ ] Daftar aduan Admin
- [ ] Form buat aduan
- [ ] Detail aduan
- [ ] Komentar aduan
- [ ] Catatan penanganan
- [ ] Timeline status
- [ ] Halaman laporan
- [ ] Halaman data master kategori
- [ ] Halaman data master bidang
- [ ] Halaman data master user
- [ ] Halaman log aktivitas
- [ ] Badge status hanya 3 status
- [ ] Responsive desktop/tablet/mobile

---

## 15. Ringkasan Final

Versi update ini menyesuaikan sistem SIHATI dengan **ERD terbaru** dan aturan bisnis yang lebih sederhana.

Poin terpentingnya:

1. Role hanya **Pegawai** dan **Admin**.
2. Frontend tetap mengikuti **DESIGN1.md**.
3. Status aduan hanya **diterima**, **diproses**, dan **selesai**.
4. Struktur tabel mengikuti ERD terbaru: `users`, `bidangs`, `categories`, `priorities`, `statuses`, `aduans`, `aduan_attachments`, `aduan_notes`, `aduan_comments`, `ratings`, `aduan_status_histories`, dan `activity_logs`.
5. Log aktivitas tetap ada untuk audit trail.
6. Sistem lebih mudah diimplementasikan karena alur status lebih ringkas.

Prinsip akhirnya tetap sama:

```text
Bersih di frontend, rapi di backend, dan konsisten dengan ERD.
```
