# DESIGN.md — Frontend SIHATI BPPKAD

## 1. Identitas Frontend

**Nama Aplikasi:** SIHATI BPPKAD  
**Kepanjangan:** Sistem Helpdesk Aduan Teknologi Informasi BPPKAD  
**Jenis Aplikasi:** Sistem helpdesk internal berbasis web  
**Backend:** Laravel  
**Frontend:** Blade Template + Tailwind CSS  
**Arah Visual:** Notion-inspired internal helpdesk dashboard  
**Target Pengguna:** Pegawai/Pelapor dan Petugas IT  

Dokumen ini hanya membahas kebutuhan **frontend**. Dokumen ini tidak membahas controller, migration, model, database, middleware, validasi backend, query laporan, authentication logic, atau proses bisnis backend secara teknis.

Frontend hanya bertugas membuat tampilan, layout, komponen, interaksi ringan, state visual, form, tabel, badge, modal, dan halaman yang nantinya akan dihubungkan dengan data dari Laravel.

---

## 2. Konsep Desain Baru

Frontend SIHATI BPPKAD menggunakan pendekatan **Notion-inspired dashboard**, yaitu tampilan yang bersih, editorial, modern, banyak ruang kosong, warna utama ungu, permukaan putih/abu hangat, aksen navy gelap, dan kartu pastel untuk membedakan informasi.

Karakter desain:

1. **Bersih** — halaman tidak terlalu padat dan mudah dipindai.
2. **Modern** — menggunakan card, badge, tabel, dan spacing yang rapi.
3. **Ramah** — warna pastel digunakan untuk mengurangi kesan kaku.
4. **Formal secukupnya** — tetap cocok untuk aplikasi internal instansi.
5. **Terstruktur** — status, prioritas, dan aksi utama harus terlihat jelas.
6. **Mudah dibaca** — cocok untuk pengguna usia kerja, termasuk 30–50 tahun.

Prinsip visual utama:

```text
Navy untuk struktur navigasi
Ungu untuk aksi utama
Putih/abu hangat untuk area kerja
Pastel untuk card informasi
Hijau/oranye/merah untuk status sistem
```

---

## 3. Role Pengguna Frontend

Aplikasi hanya menggunakan 2 role tampilan.

### 3.1 Pegawai / Pelapor

Pegawai adalah pengguna yang membuat aduan dan memantau perkembangan aduan miliknya sendiri.

Fokus tampilan pegawai:

1. Login.
2. Melihat dashboard pribadi.
3. Membuat aduan baru.
4. Melihat daftar aduan miliknya.
5. Melihat detail aduan.
6. Melihat status dan riwayat penanganan.
7. Menambahkan komentar atau informasi tambahan.
8. Mengonfirmasi aduan selesai.
9. Memberikan rating atau penilaian jika fitur tersedia.

### 3.2 Petugas IT

Petugas IT adalah pengguna yang menangani aduan sekaligus mengelola kebutuhan administratif aplikasi. Tidak ada role admin terpisah dan tidak ada role pimpinan.

Fokus tampilan petugas IT:

1. Login.
2. Melihat dashboard seluruh aduan.
3. Melihat aduan masuk.
4. Menerima tiket aduan.
5. Memproses aduan.
6. Mengubah status aduan.
7. Menambahkan catatan penanganan.
8. Menulis komentar.
9. Mengelola kategori aduan.
10. Mengelola data pengguna jika diperlukan.
11. Mengelola data bidang/unit kerja jika diperlukan.
12. Melihat laporan aduan.
13. Mencetak atau export laporan jika fitur tersedia dari backend.

---

## 4. Ruang Lingkup Frontend

Frontend yang dikerjakan meliputi:

1. Layout utama aplikasi.
2. Layout login.
3. Sidebar desktop dan drawer mobile.
4. Topbar.
5. Dashboard pegawai.
6. Dashboard petugas IT.
7. Halaman daftar aduan.
8. Halaman buat aduan.
9. Halaman detail aduan.
10. Tampilan update status aduan.
11. Tampilan timeline riwayat status.
12. Tampilan komentar atau diskusi aduan.
13. Halaman laporan.
14. Halaman data master untuk petugas IT.
15. Halaman profil.
16. Komponen button, card, badge, table, form, modal, alert, empty state, loading state, dan pagination.
17. Responsive design.
18. Standar warna, tipografi, spacing, radius, dan shadow.

Yang tidak termasuk:

1. Struktur database.
2. Route backend.
3. Controller Laravel.
4. Middleware role.
5. Validasi backend.
6. Query laporan.
7. Export PDF/Excel secara backend.
8. Upload handling secara backend.
9. Authentication logic.

---

## 5. Pembagian Tugas Frontend

Frontend dikerjakan oleh 2 orang.

### 5.1 Frontend Developer 1 — Layout, Login, Dashboard, dan Komponen Dasar

Tanggung jawab:

1. Membuat layout utama `app.blade.php`.
2. Membuat layout `guest.blade.php`.
3. Membuat halaman login.
4. Membuat sidebar dan topbar.
5. Membuat dashboard pegawai.
6. Membuat dashboard petugas IT.
7. Membuat komponen reusable dasar.
8. Menyiapkan konfigurasi warna dan token Tailwind.
9. Menjaga konsistensi spacing, typography, radius, dan shadow.

Halaman dan komponen utama:

```text
resources/views/auth/login.blade.php
resources/views/layouts/app.blade.php
resources/views/layouts/guest.blade.php
resources/views/partials/sidebar.blade.php
resources/views/partials/topbar.blade.php
resources/views/dashboard/pegawai.blade.php
resources/views/dashboard/petugas.blade.php
resources/views/components/button.blade.php
resources/views/components/card.blade.php
resources/views/components/badge.blade.php
resources/views/components/alert.blade.php
resources/views/components/modal.blade.php
resources/views/components/input.blade.php
```

### 5.2 Frontend Developer 2 — Aduan, Detail Tiket, Laporan, dan Data Master

Tanggung jawab:

1. Membuat halaman daftar aduan.
2. Membuat halaman buat aduan.
3. Membuat halaman detail aduan.
4. Membuat tampilan update status.
5. Membuat timeline riwayat status.
6. Membuat comment box.
7. Membuat halaman laporan.
8. Membuat halaman data master untuk petugas IT.
9. Menggunakan komponen yang sudah dibuat Frontend Developer 1.
10. Menguji tampilan mobile untuk form, tabel, dan detail aduan.

Halaman utama:

```text
resources/views/aduan/index.blade.php
resources/views/aduan/create.blade.php
resources/views/aduan/show.blade.php
resources/views/aduan/edit-status.blade.php
resources/views/aduan/partials/filter.blade.php
resources/views/aduan/partials/timeline.blade.php
resources/views/aduan/partials/comment-box.blade.php
resources/views/aduan/partials/status-actions.blade.php
resources/views/laporan/index.blade.php
resources/views/master/pengguna/index.blade.php
resources/views/master/bidang/index.blade.php
resources/views/master/kategori/index.blade.php
resources/views/profile/index.blade.php
```

---

## 6. Color Palette

Palette SIHATI menggunakan arah **Notion-inspired**, tetapi disesuaikan untuk aplikasi helpdesk internal.

### 6.1 Warna Utama

| Token | Hex | Fungsi |
|---|---:|---|
| `primary` | `#5645D4` | Tombol utama, aksi penting, focus ring, badge aktif |
| `primary-pressed` | `#4534B3` | Hover/pressed tombol utama |
| `primary-deep` | `#3A2A99` | Aksen ungu gelap, teks badge ungu |
| `on-primary` | `#FFFFFF` | Teks di atas primary |
| `brand-navy` | `#0A1530` | Sidebar, login hero, header gelap |
| `brand-navy-deep` | `#070F24` | Active sidebar, background gelap lebih kuat |
| `brand-navy-mid` | `#1A2A52` | Hover sidebar, panel gelap sekunder |
| `link-blue` | `#0075DE` | Link teks, bukan tombol utama |
| `link-blue-pressed` | `#005BAB` | Link hover/pressed |

### 6.2 Surface dan Border

| Token | Hex | Fungsi |
|---|---:|---|
| `canvas` | `#FFFFFF` | Background card, modal, tabel, form |
| `surface` | `#F6F5F4` | Background halaman, topbar soft, filter box |
| `surface-soft` | `#FAFAF9` | Background sangat lembut |
| `hairline` | `#E5E3DF` | Border utama |
| `hairline-soft` | `#EDE9E4` | Divider tipis |
| `hairline-strong` | `#C8C4BE` | Border input |

### 6.3 Teks

| Token | Hex | Fungsi |
|---|---:|---|
| `ink-deep` | `#000000` | Heading sangat kuat |
| `ink` | `#1A1A1A` | Teks utama |
| `charcoal` | `#37352F` | Teks utama yang lebih hangat |
| `slate` | `#5D5B54` | Teks sekunder |
| `steel` | `#787671` | Metadata, breadcrumb, keterangan |
| `stone` | `#A4A097` | Placeholder, label lemah |
| `muted` | `#BBB8B1` | Disabled state |
| `on-dark` | `#FFFFFF` | Teks di sidebar/header gelap |
| `on-dark-muted` | `#A4A097` | Teks sekunder di background gelap |

### 6.4 Pastel Card Tint

Gunakan pastel untuk card ringkasan, highlight, empty state, dan visual pembeda dashboard.

| Token | Hex | Rekomendasi Penggunaan |
|---|---:|---|
| `tint-peach` | `#FFE8D4` | Card aduan baru / informasi awal |
| `tint-rose` | `#FDE0EC` | Card ditolak / perhatian ringan |
| `tint-mint` | `#D9F3E1` | Card selesai / sukses |
| `tint-lavender` | `#E6E0F5` | Card primary / petugas / dashboard utama |
| `tint-sky` | `#DCECFA` | Card diproses / info |
| `tint-yellow` | `#FEF7D6` | Card menunggu konfirmasi |
| `tint-yellow-bold` | `#F9E79F` | Banner penting atau pengumuman |
| `tint-cream` | `#F8F5E8` | Card netral |
| `tint-gray` | `#F0EEEC` | Panel filter atau table background |

### 6.5 Semantic Color

| Token | Hex | Fungsi |
|---|---:|---|
| `success` | `#1AAE39` | Selesai, berhasil, aktif |
| `warning` | `#DD5B00` | Menunggu, perhatian, proses penting |
| `error` | `#E03131` | Ditolak, error, validasi gagal |
| `teal` | `#2A9D99` | Info alternatif, komentar petugas |
| `yellow` | `#F5D75E` | Highlight ringan |
| `pink` | `#FF64C8` | Aksen kecil, tidak untuk teks utama |
| `orange` | `#DD5B00` | Prioritas tinggi dan warning |

### 6.6 Aturan Pemakaian Warna

1. Gunakan `primary` hanya untuk aksi utama seperti Login, Kirim Aduan, Simpan, Terima Aduan, dan Cetak PDF.
2. Gunakan `brand-navy` untuk sidebar dan login hero, bukan untuk seluruh halaman.
3. Gunakan `canvas` untuk card, form, table, modal, dan area data.
4. Gunakan `surface` sebagai background halaman agar tidak terlalu putih polos.
5. Gunakan pastel tint untuk card statistik agar dashboard terasa lebih ringan.
6. Jangan memakai ungu sebagai warna teks paragraf panjang.
7. Jangan memakai pastel sebagai teks; pastel digunakan sebagai background.
8. Link teks tetap menggunakan `link-blue`, bukan `primary`.
9. Status tetap harus menampilkan teks, jangan hanya dibedakan dari warna.

---

## 7. Konfigurasi Tailwind CSS

Tambahkan token berikut ke `tailwind.config.js`.

```js
/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  theme: {
    extend: {
      colors: {
        sihati: {
          primary: '#5645D4',
          'primary-pressed': '#4534B3',
          'primary-deep': '#3A2A99',
          'on-primary': '#FFFFFF',

          navy: '#0A1530',
          'navy-deep': '#070F24',
          'navy-mid': '#1A2A52',

          link: '#0075DE',
          'link-pressed': '#005BAB',

          canvas: '#FFFFFF',
          surface: '#F6F5F4',
          'surface-soft': '#FAFAF9',

          hairline: '#E5E3DF',
          'hairline-soft': '#EDE9E4',
          'hairline-strong': '#C8C4BE',

          ink: '#1A1A1A',
          'ink-deep': '#000000',
          charcoal: '#37352F',
          slate: '#5D5B54',
          steel: '#787671',
          stone: '#A4A097',
          muted: '#BBB8B1',
          'on-dark': '#FFFFFF',
          'on-dark-muted': '#A4A097',

          peach: '#FFE8D4',
          rose: '#FDE0EC',
          mint: '#D9F3E1',
          lavender: '#E6E0F5',
          sky: '#DCECFA',
          yellow: '#FEF7D6',
          'yellow-bold': '#F9E79F',
          cream: '#F8F5E8',
          gray: '#F0EEEC',

          success: '#1AAE39',
          warning: '#DD5B00',
          error: '#E03131',
          teal: '#2A9D99',
          orange: '#DD5B00',
          pink: '#FF64C8',
        },
      },
      fontFamily: {
        notion: [
          'Inter',
          'ui-sans-serif',
          'system-ui',
          '-apple-system',
          'BlinkMacSystemFont',
          'Segoe UI',
          'sans-serif',
        ],
      },
      boxShadow: {
        subtle: 'rgba(15, 15, 15, 0.04) 0px 1px 2px 0px',
        card: 'rgba(15, 15, 15, 0.08) 0px 4px 12px 0px',
        mockup: 'rgba(15, 15, 15, 0.20) 0px 24px 48px -8px',
        modal: 'rgba(15, 15, 15, 0.16) 0px 16px 48px -8px',
      },
      borderRadius: {
        xs: '4px',
        sm: '6px',
        md: '8px',
        lg: '12px',
        xl: '16px',
        xxl: '20px',
        xxxl: '24px',
      },
      spacing: {
        '4.5': '18px',
      },
    },
  },
  plugins: [],
};
```

---

## 8. Typography

Gunakan gaya tipografi yang bersih dan mirip Notion: humanis, modern, dan mudah dibaca.

### 8.1 Font Family

Rekomendasi:

```css
font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
```

Jika ingin lebih dekat ke nuansa Notion, gunakan Inter sebagai pengganti Notion Sans karena lebih mudah dipakai di project Laravel.

### 8.2 Skala Tipografi Frontend

| Elemen | Class Tailwind | Penggunaan |
|---|---|---|
| App title besar | `text-4xl md:text-5xl font-semibold tracking-[-0.04em]` | Login hero |
| Page title | `text-2xl md:text-3xl font-semibold tracking-[-0.02em]` | Judul halaman |
| Section title | `text-xl md:text-2xl font-semibold tracking-[-0.01em]` | Bagian dashboard/detail |
| Card title | `text-base md:text-lg font-semibold` | Judul card |
| Body | `text-sm md:text-base leading-6` | Isi utama |
| Table text | `text-sm leading-5` | Isi tabel |
| Caption | `text-xs md:text-[13px]` | Metadata, tanggal, badge |
| Button | `text-sm font-medium` | Label button |
| Micro uppercase | `text-[11px] font-semibold uppercase tracking-[0.08em]` | Header tabel, label kecil |

### 8.3 Aturan Tipografi

1. Judul besar boleh memakai negative tracking agar lebih modern.
2. Body text gunakan line-height longgar agar nyaman dibaca.
3. Tabel minimal `text-sm`, jangan terlalu kecil.
4. Button gunakan `font-medium`, bukan terlalu tebal.
5. Badge gunakan `text-xs` atau `text-[13px]`.
6. Jangan gunakan terlalu banyak font family.

---

## 9. Radius, Spacing, dan Shadow

### 9.1 Border Radius

| Token | Nilai | Penggunaan |
|---|---:|---|
| `rounded-sm` | 6px | Badge kecil, tag |
| `rounded-md` | 8px | Button, input, search box |
| `rounded-lg` | 12px | Card, table wrapper, modal kecil |
| `rounded-xl` | 16px | Dashboard card, panel penting |
| `rounded-2xl` | 16px/20px | Modal besar, login card |
| `rounded-full` | Full | Badge status, avatar, pill tab |

Aturan utama:

```text
Button: 8px
Input: 8px
Card: 12px
Modal: 16px atau 20px
Badge: full atau 6px sesuai konteks
```

### 9.2 Spacing

Gunakan basis 4px dan 8px.

| Token | Nilai | Tailwind |
|---|---:|---|
| XXS | 4px | `p-1`, `gap-1` |
| XS | 8px | `p-2`, `gap-2` |
| SM | 12px | `p-3`, `gap-3` |
| MD | 16px | `p-4`, `gap-4` |
| LG | 20px | `p-5`, `gap-5` |
| XL | 24px | `p-6`, `gap-6` |
| XXL | 32px | `p-8`, `gap-8` |

### 9.3 Shadow

| Level | Class | Penggunaan |
|---|---|---|
| Flat | `border border-sihati-hairline` | Table, form, card biasa |
| Subtle | `shadow-subtle` | Hover tile, small card |
| Card | `shadow-card` | Dashboard card, login card |
| Mockup | `shadow-mockup` | Login illustration/mockup panel |
| Modal | `shadow-modal` | Modal, dropdown besar |

Jangan memakai shadow terlalu berat di semua card. Mayoritas card cukup border + shadow tipis.

---

## 10. Struktur Folder Blade Frontend

Gunakan struktur folder berikut.

```text
resources/views/
├── auth/
│   └── login.blade.php
│
├── layouts/
│   ├── app.blade.php
│   ├── guest.blade.php
│   └── print.blade.php
│
├── partials/
│   ├── sidebar.blade.php
│   ├── topbar.blade.php
│   ├── footer.blade.php
│   └── breadcrumb.blade.php
│
├── components/
│   ├── button.blade.php
│   ├── card.blade.php
│   ├── stat-card.blade.php
│   ├── badge-status.blade.php
│   ├── badge-priority.blade.php
│   ├── alert.blade.php
│   ├── modal.blade.php
│   ├── input.blade.php
│   ├── select.blade.php
│   ├── textarea.blade.php
│   ├── table.blade.php
│   ├── empty-state.blade.php
│   ├── loading.blade.php
│   └── pagination.blade.php
│
├── dashboard/
│   ├── pegawai.blade.php
│   └── petugas.blade.php
│
├── aduan/
│   ├── index.blade.php
│   ├── create.blade.php
│   ├── show.blade.php
│   ├── edit-status.blade.php
│   └── partials/
│       ├── filter.blade.php
│       ├── timeline.blade.php
│       ├── comment-box.blade.php
│       └── status-actions.blade.php
│
├── laporan/
│   ├── index.blade.php
│   └── print.blade.php
│
├── master/
│   ├── pengguna/
│   │   ├── index.blade.php
│   │   ├── create.blade.php
│   │   └── edit.blade.php
│   ├── bidang/
│   │   ├── index.blade.php
│   │   ├── create.blade.php
│   │   └── edit.blade.php
│   └── kategori/
│       ├── index.blade.php
│       ├── create.blade.php
│       └── edit.blade.php
│
└── profile/
    └── index.blade.php
```

Catatan:

1. Tidak ada folder `dashboard/admin.blade.php`.
2. Tidak ada folder `dashboard/pimpinan.blade.php`.
3. Data master tetap ada, tetapi akses UI-nya milik Petugas IT.
4. Halaman laporan tetap ada, tetapi ditampilkan untuk Petugas IT.

---

## 11. Layout Utama Aplikasi

SIHATI menggunakan layout dashboard dengan sidebar kiri, topbar atas, dan content area.

### 11.1 Desktop Layout

```text
+----------------------------------------------------------------+
| Sidebar Navy | Topbar White                                    |
|              |-------------------------------------------------|
|              | Breadcrumb / Page Header                         |
|              |-------------------------------------------------|
|              | Main Content                                     |
|              | Cards / Table / Form / Detail / Report           |
+----------------------------------------------------------------+
```

### 11.2 Mobile Layout

```text
+--------------------------------+
| Topbar + Menu Button           |
|--------------------------------|
| Page Header                    |
|--------------------------------|
| Content                        |
| Sidebar menjadi drawer         |
+--------------------------------+
```

### 11.3 App Layout Blade

```blade
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SIHATI BPPKAD')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-sihati-surface text-sihati-ink font-notion antialiased">
    <div class="min-h-screen flex">
        @include('partials.sidebar')

        <div class="flex-1 flex min-w-0 flex-col">
            @include('partials.topbar')

            <main class="flex-1 p-4 md:p-6 lg:p-8">
                @include('partials.breadcrumb')
                @yield('content')
            </main>

            @include('partials.footer')
        </div>
    </div>
</body>
</html>
```

---

## 12. Layout Guest / Login

Halaman login menjadi halaman yang paling terasa Notion-inspired.

### 12.1 Konsep Login

Gunakan layout dua kolom di desktop:

1. Kiri: hero band navy dengan nama SIHATI, deskripsi, dan kartu mockup kecil.
2. Kanan: card login putih.

Pada mobile, cukup satu kolom dengan card login.

### 12.2 Struktur Login

```text
Desktop:
+--------------------------------------------------------------+
| Navy Hero Area                     | Login Card              |
| SIHATI BPPKAD                      | Logo                    |
| Helpdesk Aduan TI                  | Username/Email          |
| Pastel dots / mockup cards         | Password                |
|                                    | Login Button            |
+--------------------------------------------------------------+

Mobile:
+-----------------------------+
| Login Card                  |
| Logo                        |
| Username/Email              |
| Password                    |
| Login Button                |
+-----------------------------+
```

### 12.3 Contoh Class Login

```blade
<body class="min-h-screen bg-sihati-surface font-notion text-sihati-ink">
    <main class="grid min-h-screen grid-cols-1 lg:grid-cols-2">
        <section class="hidden bg-sihati-navy p-10 text-sihati-on-dark lg:flex lg:flex-col lg:justify-between">
            <div>
                <p class="text-sm font-medium text-sihati-on-dark-muted">SIHATI BPPKAD</p>
                <h1 class="mt-4 text-5xl font-semibold tracking-[-0.04em]">
                    Aduan IT tercatat, penanganan lebih terpantau.
                </h1>
                <p class="mt-5 max-w-xl text-base leading-7 text-sihati-on-dark-muted">
                    Sistem helpdesk internal untuk mencatat dan memantau kendala teknologi informasi.
                </p>
            </div>

            <div class="rounded-lg border border-white/10 bg-white p-5 text-sihati-ink shadow-mockup">
                <p class="text-sm font-semibold">SIHATI-2026-0001</p>
                <p class="mt-1 text-sm text-sihati-slate">Printer tidak bisa mencetak</p>
                <span class="mt-4 inline-flex rounded-full bg-sihati-yellow px-3 py-1 text-xs font-semibold text-sihati-charcoal">
                    Menunggu Konfirmasi
                </span>
            </div>
        </section>

        <section class="flex items-center justify-center p-4 md:p-8">
            @yield('content')
        </section>
    </main>
</body>
```

---

## 13. Sidebar

Sidebar menggunakan warna `brand-navy` agar lebih tegas dan berbeda dari area konten.

### 13.1 Tampilan Sidebar

1. Background `bg-sihati-navy`.
2. Teks putih.
3. Active state menggunakan `bg-white text-sihati-ink` atau `bg-sihati-primary text-white`.
4. Hover menggunakan `bg-white/10`.
5. Logo di bagian atas.
6. Logout di bagian bawah.
7. Radius menu `rounded-md` atau `rounded-lg`.

### 13.2 Contoh Sidebar

```html
<aside class="hidden min-h-screen w-72 flex-col bg-sihati-navy text-sihati-on-dark md:flex">
  <div class="border-b border-white/10 px-6 py-5">
    <div class="flex items-center gap-3">
      <div class="flex h-10 w-10 items-center justify-center rounded-md bg-white text-sm font-semibold text-sihati-navy">
        SI
      </div>
      <div>
        <h1 class="text-base font-semibold">SIHATI</h1>
        <p class="text-xs text-sihati-on-dark-muted">BPPKAD</p>
      </div>
    </div>
  </div>

  <nav class="flex-1 space-y-1 px-3 py-4">
    <a href="#" class="flex items-center gap-3 rounded-md bg-white px-3 py-2.5 text-sm font-medium text-sihati-ink">
      Dashboard
    </a>
    <a href="#" class="flex items-center gap-3 rounded-md px-3 py-2.5 text-sm font-medium text-white/80 hover:bg-white/10 hover:text-white">
      Aduan Saya
    </a>
  </nav>
</aside>
```

### 13.3 Menu Pegawai

1. Dashboard.
2. Buat Aduan.
3. Aduan Saya.
4. Riwayat Aduan.
5. Profil Saya.
6. Logout.

### 13.4 Menu Petugas IT

1. Dashboard.
2. Aduan Masuk.
3. Aduan Baru.
4. Aduan Diproses.
5. Aduan Selesai.
6. Kategori Aduan.
7. Data Pengguna.
8. Data Bidang.
9. Laporan Aduan.
10. Profil Saya.
11. Logout.

---

## 14. Topbar

Topbar menggunakan permukaan putih agar konten terasa ringan.

### 14.1 Isi Topbar

1. Tombol hamburger di mobile.
2. Judul halaman singkat.
3. Shortcut pencarian tiket jika diperlukan.
4. Notifikasi.
5. Nama pengguna.
6. Role pengguna.
7. Dropdown profil dan logout.

### 14.2 Contoh Topbar

```html
<header class="sticky top-0 z-20 flex h-16 items-center justify-between border-b border-sihati-hairline bg-sihati-canvas px-4 md:px-6">
  <div>
    <h2 class="text-base font-semibold text-sihati-ink">Dashboard</h2>
    <p class="text-xs text-sihati-steel">Ringkasan aktivitas aduan IT</p>
  </div>

  <div class="flex items-center gap-3">
    <button class="rounded-md p-2 text-sihati-slate hover:bg-sihati-surface" aria-label="Notifikasi">
      Notifikasi
    </button>
    <div class="hidden text-right sm:block">
      <p class="text-sm font-medium text-sihati-ink">Petugas IT</p>
      <p class="text-xs text-sihati-steel">Petugas IT</p>
    </div>
  </div>
</header>
```

---

## 15. Button

Button menggunakan bentuk rectangular `rounded-md` atau 8px. Badge dan tab boleh pill, tetapi regular button jangan dibuat terlalu bulat.

### 15.1 Primary Button

Untuk aksi utama: Login, Kirim Aduan, Simpan, Terima Aduan, Cetak PDF.

```html
<button class="inline-flex h-11 items-center justify-center rounded-md bg-sihati-primary px-4.5 text-sm font-medium text-sihati-on-primary transition hover:bg-sihati-primary-pressed focus:outline-none focus:ring-2 focus:ring-sihati-primary focus:ring-offset-2">
  Simpan
</button>
```

### 15.2 Secondary Button

Untuk aksi Batal, Kembali, Reset Filter.

```html
<button class="inline-flex h-11 items-center justify-center rounded-md border border-sihati-hairline-strong bg-transparent px-4.5 text-sm font-medium text-sihati-ink transition hover:bg-sihati-surface">
  Kembali
</button>
```

### 15.3 Dark Button

Untuk aksi kontras di atas background terang.

```html
<button class="inline-flex h-11 items-center justify-center rounded-md bg-sihati-ink-deep px-4.5 text-sm font-medium text-white transition hover:bg-sihati-charcoal">
  Lihat Detail
</button>
```

### 15.4 Ghost Button

Untuk aksi ringan.

```html
<button class="inline-flex h-10 items-center justify-center rounded-sm px-3 text-sm font-medium text-sihati-ink hover:bg-sihati-surface">
  Batal
</button>
```

### 15.5 Link Button

Untuk link teks.

```html
<a href="#" class="text-sm font-medium text-sihati-link hover:text-sihati-link-pressed">
  Lihat detail
</a>
```

### 15.6 Button Variant

| Variant | Class Utama | Penggunaan |
|---|---|---|
| Primary | `bg-sihati-primary text-white` | Aksi utama |
| Secondary | `border border-sihati-hairline-strong text-sihati-ink` | Kembali, batal, reset |
| Dark | `bg-sihati-ink-deep text-white` | Detail/aksi kontras |
| Warning | `bg-sihati-orange text-white` | Proses penting, prioritas tinggi |
| Danger | `bg-sihati-error text-white` | Tolak, hapus, batalkan |
| Ghost | `hover:bg-sihati-surface` | Aksi ringan |
| Link | `text-sihati-link` | Link inline |

---

## 16. Card

Card menjadi elemen utama dashboard, detail tiket, laporan, dan form.

### 16.1 Base Card

```html
<div class="rounded-lg border border-sihati-hairline bg-sihati-canvas p-6 shadow-subtle">
  <h3 class="text-base font-semibold text-sihati-ink">Judul Card</h3>
  <p class="mt-1 text-sm leading-6 text-sihati-slate">Deskripsi card.</p>
</div>
```

### 16.2 Feature / Stat Card Pastel

```html
<div class="rounded-lg bg-sihati-lavender p-6 text-sihati-charcoal">
  <p class="text-sm font-medium">Total Aduan</p>
  <p class="mt-2 text-3xl font-semibold tracking-[-0.03em]">128</p>
  <p class="mt-3 text-sm text-sihati-slate">Seluruh aduan yang tercatat.</p>
</div>
```

### 16.3 Mapping Card Dashboard

| Card | Background | Keterangan |
|---|---|---|
| Total Aduan | `bg-sihati-lavender` | Ringkasan utama |
| Aduan Baru | `bg-sihati-peach` | Aduan baru masuk |
| Diproses | `bg-sihati-sky` | Aduan sedang dikerjakan |
| Menunggu Konfirmasi | `bg-sihati-yellow` | Butuh respons pelapor |
| Selesai | `bg-sihati-mint` | Aduan selesai |
| Ditolak | `bg-sihati-rose` | Aduan tidak valid/ditolak |

---

## 17. Badge Status dan Prioritas

Badge status menggunakan kombinasi pastel background dan teks yang kontras.

### 17.1 Status Aduan

| Status | Background | Text | Keterangan |
|---|---|---|---|
| Baru | `bg-sihati-peach` | `text-sihati-orange` | Aduan baru masuk |
| Diterima | `bg-sihati-lavender` | `text-sihati-primary-deep` | Aduan diterima petugas |
| Diproses | `bg-sihati-sky` | `text-sihati-link-pressed` | Aduan sedang dikerjakan |
| Menunggu Konfirmasi | `bg-sihati-yellow-bold` | `text-sihati-charcoal` | Menunggu respons pelapor |
| Selesai | `bg-sihati-mint` | `text-sihati-success` | Aduan selesai |
| Ditolak | `bg-sihati-rose` | `text-sihati-error` | Aduan ditolak/tidak valid |
| Dibatalkan | `bg-sihati-gray` | `text-sihati-slate` | Aduan dibatalkan |

### 17.2 Contoh Badge Status

```blade
@props(['status'])

@php
    $classes = match ($status) {
        'Baru' => 'bg-sihati-peach text-sihati-orange',
        'Diterima' => 'bg-sihati-lavender text-sihati-primary-deep',
        'Diproses' => 'bg-sihati-sky text-sihati-link-pressed',
        'Menunggu Konfirmasi' => 'bg-sihati-yellow-bold text-sihati-charcoal',
        'Selesai' => 'bg-sihati-mint text-sihati-success',
        'Ditolak' => 'bg-sihati-rose text-sihati-error',
        'Dibatalkan' => 'bg-sihati-gray text-sihati-slate',
        default => 'bg-sihati-gray text-sihati-slate',
    };
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold ' . $classes]) }}>
    {{ $status }}
</span>
```

### 17.3 Prioritas Aduan

| Prioritas | Background | Text |
|---|---|---|
| Rendah | `bg-sihati-gray` | `text-sihati-slate` |
| Sedang | `bg-sihati-sky` | `text-sihati-link-pressed` |
| Tinggi | `bg-sihati-yellow-bold` | `text-sihati-charcoal` |
| Mendesak | `bg-sihati-rose` | `text-sihati-error` |

---

## 18. Form dan Input

Input mengikuti gaya Notion: border hangat, radius 8px, tinggi 44px, focus ungu.

### 18.1 Input Text

```html
<div>
  <label for="judul" class="block text-sm font-medium text-sihati-charcoal">
    Judul Aduan <span class="text-sihati-error">*</span>
  </label>
  <input
    id="judul"
    name="judul"
    type="text"
    class="mt-2 h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink placeholder:text-sihati-stone focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20"
    placeholder="Contoh: Printer tidak bisa mencetak"
  >
</div>
```

### 18.2 Select

```html
<select class="h-11 w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 text-sm text-sihati-ink focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20">
  <option>Pilih kategori</option>
  <option>Komputer/Laptop</option>
  <option>Printer/Scanner</option>
  <option>Jaringan Internet</option>
</select>
```

### 18.3 Textarea

```html
<textarea
  rows="5"
  class="w-full rounded-md border border-sihati-hairline-strong bg-sihati-canvas px-4 py-3 text-sm text-sihati-ink placeholder:text-sihati-stone focus:border-sihati-primary focus:outline-none focus:ring-2 focus:ring-sihati-primary/20"
  placeholder="Jelaskan kendala yang dialami secara lengkap"
></textarea>
```

### 18.4 Search Pill

```html
<div class="flex h-11 items-center rounded-md border border-sihati-hairline bg-sihati-surface px-4 text-sm text-sihati-steel">
  <input class="w-full bg-transparent outline-none placeholder:text-sihati-stone" placeholder="Cari nomor tiket atau judul aduan">
</div>
```

### 18.5 Error State

```html
<input class="h-11 w-full rounded-md border border-sihati-error px-4 text-sm focus:ring-2 focus:ring-sihati-error/20">
<p class="mt-1 text-xs text-sihati-error">Judul aduan wajib diisi.</p>
```

---

## 19. Table

Tabel digunakan untuk daftar aduan, laporan, dan data master.

### 19.1 Aturan Tabel

1. Gunakan background putih.
2. Wrapper tabel memakai border dan radius 12px.
3. Header menggunakan `surface`.
4. Border row menggunakan `hairline-soft`.
5. Teks header menggunakan micro uppercase.
6. Tabel wajib dibungkus `overflow-x-auto`.
7. Kolom aksi berada di paling kanan.

### 19.2 Contoh Table

```html
<div class="overflow-hidden rounded-lg border border-sihati-hairline bg-sihati-canvas shadow-subtle">
  <div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-sihati-hairline-soft">
      <thead class="bg-sihati-surface">
        <tr>
          <th class="px-4 py-3 text-left text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">No Tiket</th>
          <th class="px-4 py-3 text-left text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">Judul</th>
          <th class="px-4 py-3 text-left text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">Status</th>
          <th class="px-4 py-3 text-right text-[11px] font-semibold uppercase tracking-[0.08em] text-sihati-steel">Aksi</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-sihati-hairline-soft bg-sihati-canvas">
        <tr class="hover:bg-sihati-surface-soft">
          <td class="px-4 py-3 text-sm font-medium text-sihati-primary">SIHATI-2026-0001</td>
          <td class="px-4 py-3 text-sm text-sihati-charcoal">Printer tidak bisa mencetak</td>
          <td class="px-4 py-3 text-sm">Diproses</td>
          <td class="px-4 py-3 text-right text-sm">
            <a href="#" class="font-medium text-sihati-link">Detail</a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
```

---

## 20. Alert dan Notification

### 20.1 Success

```html
<div class="rounded-md border border-sihati-success/30 bg-sihati-mint px-4 py-3 text-sm text-sihati-success">
  Aduan berhasil dikirim.
</div>
```

### 20.2 Error

```html
<div class="rounded-md border border-sihati-error/30 bg-sihati-rose px-4 py-3 text-sm text-sihati-error">
  Data gagal disimpan. Silakan periksa kembali.
</div>
```

### 20.3 Warning

```html
<div class="rounded-md border border-sihati-warning/30 bg-sihati-yellow-bold px-4 py-3 text-sm text-sihati-charcoal">
  Aduan membutuhkan konfirmasi dari pelapor.
</div>
```

### 20.4 Info

```html
<div class="rounded-md border border-sihati-link/20 bg-sihati-sky px-4 py-3 text-sm text-sihati-link-pressed">
  Aduan sedang diproses oleh petugas IT.
</div>
```

---

## 21. Modal

Modal digunakan untuk update status, konfirmasi selesai, tolak aduan, hapus data master, dan tambah catatan.

### 21.1 Aturan Modal

1. Overlay hitam transparan.
2. Card modal putih.
3. Radius 16px atau 20px.
4. Shadow menggunakan `shadow-modal`.
5. Judul jelas.
6. Deskripsi singkat.
7. Tombol utama di kanan.
8. Tombol batal di kiri tombol utama.

### 21.2 Contoh Modal

```html
<div class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 p-4">
  <div class="w-full max-w-lg rounded-xl bg-sihati-canvas p-6 shadow-modal">
    <h2 class="text-lg font-semibold text-sihati-ink">Ubah Status Aduan</h2>
    <p class="mt-2 text-sm leading-6 text-sihati-slate">
      Pilih status terbaru dan tambahkan catatan penanganan jika diperlukan.
    </p>

    <div class="mt-5 space-y-4">
      <!-- form -->
    </div>

    <div class="mt-6 flex justify-end gap-3">
      <button class="rounded-md border border-sihati-hairline-strong px-4 py-2 text-sm font-medium text-sihati-ink hover:bg-sihati-surface">Batal</button>
      <button class="rounded-md bg-sihati-primary px-4 py-2 text-sm font-medium text-white hover:bg-sihati-primary-pressed">Simpan</button>
    </div>
  </div>
</div>
```

---

## 22. Dashboard Pegawai

### 22.1 Tujuan

Dashboard pegawai menampilkan ringkasan aduan milik pegawai dan akses cepat untuk membuat aduan baru.

### 22.2 Elemen UI

1. Greeting pengguna.
2. Tombol `Buat Aduan Baru`.
3. Card Total Aduan.
4. Card Aduan Baru.
5. Card Diproses.
6. Card Menunggu Konfirmasi.
7. Card Selesai.
8. Tabel aduan terbaru milik pegawai.
9. Empty state jika belum ada aduan.

### 22.3 Layout

```text
Page Header + CTA
↓
Pastel Stat Cards Grid
↓
Aduan Terbaru Table
↓
Info Banner / Empty State
```

### 22.4 Contoh Header Dashboard Pegawai

```html
<div class="mb-6 rounded-lg bg-sihati-navy p-6 text-white shadow-card">
  <p class="text-sm text-sihati-on-dark-muted">Selamat datang kembali</p>
  <h1 class="mt-2 text-2xl font-semibold tracking-[-0.02em]">Laporkan kendala IT dengan mudah.</h1>
  <p class="mt-2 max-w-2xl text-sm leading-6 text-sihati-on-dark-muted">
    Buat aduan baru, pantau status, dan konfirmasi penyelesaian langsung dari SIHATI BPPKAD.
  </p>
</div>
```

---

## 23. Dashboard Petugas IT

### 23.1 Tujuan

Dashboard petugas IT menampilkan aduan yang perlu ditangani, ringkasan status, dan shortcut ke fitur pengelolaan.

### 23.2 Elemen UI

1. Total aduan masuk.
2. Aduan baru.
3. Aduan diproses.
4. Menunggu konfirmasi.
5. Aduan selesai.
6. Aduan prioritas tinggi/mendesak.
7. Tabel tiket terbaru.
8. Shortcut filter status.
9. Ringkasan kategori.
10. Link ke laporan.
11. Link ke data master.

### 23.3 Card Statistik

Gunakan pastel tint agar mudah dibedakan:

```text
Total Aduan          → Lavender
Aduan Baru           → Peach
Diproses             → Sky
Menunggu Konfirmasi  → Yellow Bold
Selesai              → Mint
Mendesak             → Rose
```

---

## 24. Halaman Daftar Aduan

### 24.1 Tujuan

Halaman daftar aduan menampilkan aduan sesuai role.

1. Pegawai hanya melihat aduan miliknya sendiri.
2. Petugas IT dapat melihat seluruh aduan.

### 24.2 Elemen UI

1. Page header.
2. Tombol `Buat Aduan` untuk pegawai.
3. Filter pencarian.
4. Tabel daftar aduan.
5. Badge status.
6. Badge prioritas.
7. Pagination.
8. Empty state.

### 24.3 Filter Aduan

Filter yang ditampilkan:

1. Nomor tiket.
2. Nama pelapor, khusus petugas IT.
3. Kategori.
4. Status.
5. Prioritas.
6. Bidang/unit kerja.
7. Tanggal awal.
8. Tanggal akhir.

### 24.4 Kolom Tabel Petugas IT

1. Nomor tiket.
2. Tanggal.
3. Pelapor.
4. Bidang.
5. Judul aduan.
6. Kategori.
7. Prioritas.
8. Status.
9. Petugas.
10. Aksi.

### 24.5 Kolom Tabel Pegawai

1. Nomor tiket.
2. Judul aduan.
3. Kategori.
4. Prioritas.
5. Status.
6. Tanggal.
7. Aksi.

---

## 25. Halaman Buat Aduan

### 25.1 Tujuan

Halaman ini digunakan pegawai untuk membuat laporan aduan baru.

### 25.2 Elemen Form

1. Judul aduan.
2. Kategori masalah.
3. Deskripsi masalah.
4. Lokasi atau ruangan.
5. Bidang/unit kerja.
6. Tingkat urgensi/prioritas.
7. Lampiran foto atau dokumen.
8. Nomor kontak pelapor.
9. Tombol kirim aduan.
10. Tombol batal.

### 25.3 Layout Form

Gunakan card putih dengan max width `max-w-4xl`.

```text
+------------------------------------------------+
| Buat Aduan Baru                                |
|------------------------------------------------|
| Judul Aduan                                    |
| Kategori              Prioritas                |
| Lokasi                Nomor Kontak             |
| Deskripsi Masalah                              |
| Upload Lampiran                                |
|------------------------------------------------|
| [Batal]                         [Kirim Aduan]  |
+------------------------------------------------+
```

### 25.4 Upload Lampiran

```html
<div class="rounded-lg border-2 border-dashed border-sihati-hairline-strong bg-sihati-surface-soft p-6 text-center hover:border-sihati-primary">
  <p class="text-sm font-medium text-sihati-charcoal">Upload lampiran</p>
  <p class="mt-1 text-xs text-sihati-steel">Format JPG, PNG, atau PDF. Maksimal 5 MB.</p>
  <input type="file" name="lampiran" class="mt-4 block w-full text-sm text-sihati-slate">
</div>
```

---

## 26. Halaman Detail Aduan

### 26.1 Tujuan

Halaman detail digunakan untuk melihat informasi lengkap aduan, status, riwayat, komentar, dan aksi penanganan.

### 26.2 Struktur Halaman

1. Header tiket.
2. Nomor tiket.
3. Judul aduan.
4. Tanggal dibuat.
5. Badge status.
6. Badge prioritas.
7. Informasi pelapor.
8. Informasi lokasi dan bidang.
9. Deskripsi masalah.
10. Lampiran.
11. Catatan penanganan.
12. Riwayat status.
13. Komentar/diskusi.
14. Tombol aksi sesuai role.

### 26.3 Layout Desktop

```text
+----------------------------------------------------------+
| Header Tiket + Status                                    |
+-------------------------------+--------------------------+
| Informasi Aduan               | Data Pelapor             |
| Deskripsi                     | Status & Prioritas       |
| Lampiran                      | Aksi                     |
+-------------------------------+--------------------------+
| Catatan Penanganan                                       |
| Riwayat Status                                           |
| Komentar / Diskusi                                       |
+----------------------------------------------------------+
```

### 26.4 Tombol Aksi Pegawai

1. Kembali.
2. Tambah komentar.
3. Konfirmasi selesai.
4. Belum selesai.
5. Beri penilaian jika status selesai.

### 26.5 Tombol Aksi Petugas IT

1. Terima aduan.
2. Proses aduan.
3. Ubah status.
4. Tambah catatan penanganan.
5. Minta konfirmasi.
6. Tolak aduan.
7. Selesaikan aduan.
8. Batalkan aduan jika diperlukan.

---

## 27. Timeline Riwayat Status

Timeline menampilkan perubahan status secara kronologis.

### 27.1 Elemen Timeline

1. Tanggal dan jam.
2. Status baru.
3. Keterangan.
4. Nama petugas atau sistem.

### 27.2 Contoh Timeline

```html
<ol class="relative border-s border-sihati-hairline">
  <li class="mb-6 ms-6">
    <span class="absolute -start-2.5 flex h-5 w-5 items-center justify-center rounded-full bg-sihati-primary ring-4 ring-sihati-canvas"></span>
    <h3 class="text-sm font-semibold text-sihati-ink">Diproses</h3>
    <time class="text-xs text-sihati-steel">02-07-2026 09:00 · Petugas IT</time>
    <p class="mt-1 text-sm leading-6 text-sihati-slate">Pemeriksaan printer dilakukan oleh petugas.</p>
  </li>
</ol>
```

---

## 28. Komentar atau Diskusi Aduan

Komentar digunakan untuk komunikasi antara pegawai dan petugas.

### 28.1 Tampilan Komentar

Komentar pegawai:

1. Background `canvas`.
2. Border `hairline`.
3. Rata kiri.
4. Nama dan waktu komentar terlihat.

Komentar petugas:

1. Background `tint-lavender` atau `tint-sky`.
2. Border kiri `primary`.
3. Nama petugas dan role ditampilkan.

### 28.2 Contoh Comment Box

```html
<div class="rounded-lg border border-sihati-hairline bg-sihati-canvas p-4">
  <div class="flex items-center justify-between">
    <p class="text-sm font-semibold text-sihati-ink">Andi</p>
    <p class="text-xs text-sihati-steel">02-07-2026 09:15</p>
  </div>
  <p class="mt-2 text-sm leading-6 text-sihati-slate">
    Printer masih belum bisa digunakan setelah dicoba ulang.
  </p>
</div>
```

### 28.3 Form Komentar

```html
<form class="mt-4 space-y-3">
  <textarea class="w-full rounded-md border border-sihati-hairline-strong px-4 py-3 text-sm focus:border-sihati-primary focus:ring-2 focus:ring-sihati-primary/20" rows="3" placeholder="Tulis komentar atau informasi tambahan"></textarea>
  <div class="flex justify-end">
    <button class="rounded-md bg-sihati-primary px-4 py-2 text-sm font-medium text-white hover:bg-sihati-primary-pressed">
      Kirim Komentar
    </button>
  </div>
</form>
```

---

## 29. Halaman Update Status

Halaman atau modal update status digunakan oleh petugas IT.

### 29.1 Field

1. Status baru.
2. Prioritas.
3. Catatan penanganan.
4. Lampiran bukti jika diperlukan.

### 29.2 UI Rules

1. Gunakan modal untuk aksi cepat.
2. Gunakan halaman khusus jika form cukup panjang.
3. Tampilkan status saat ini sebelum update.
4. Tampilkan nomor tiket agar petugas tidak salah tiket.
5. Tombol simpan harus menggunakan `primary`.
6. Aksi tolak menggunakan `error`.

---

## 30. Halaman Laporan

### 30.1 Tujuan

Halaman laporan digunakan oleh petugas IT untuk melihat rekap aduan berdasarkan periode dan filter tertentu.

### 30.2 Elemen UI

1. Filter tanggal.
2. Filter kategori.
3. Filter status.
4. Filter bidang.
5. Filter petugas.
6. Card ringkasan.
7. Tabel laporan.
8. Tombol cetak PDF.
9. Tombol export Excel jika backend menyediakan.

### 30.3 Card Ringkasan

1. Total aduan.
2. Aduan selesai.
3. Aduan diproses.
4. Aduan ditolak.
5. Aduan menunggu konfirmasi.

### 30.4 Tabel Laporan

Kolom:

1. No.
2. Nomor tiket.
3. Tanggal.
4. Pelapor.
5. Bidang.
6. Kategori.
7. Prioritas.
8. Status.
9. Petugas.
10. Tanggal selesai.

### 30.5 Print Layout

Halaman print tidak menggunakan sidebar dan topbar.

```text
Header instansi
Judul laporan
Periode laporan
Ringkasan total
Tabel laporan
Area tanda tangan jika diperlukan
```

---

## 31. Halaman Data Master

Data master ditampilkan untuk Petugas IT. Petugas IT berperan sebagai pengelola sistem, sehingga tidak perlu role admin terpisah.

### 31.1 Data Pengguna

Kolom:

1. Nama.
2. Username.
3. Email.
4. Role.
5. Bidang.
6. Status.
7. Aksi.

### 31.2 Data Bidang

Kolom:

1. Nama bidang.
2. Keterangan.
3. Jumlah pengguna jika tersedia.
4. Aksi.

### 31.3 Data Kategori

Kolom:

1. Nama kategori.
2. Deskripsi.
3. Jumlah aduan jika tersedia.
4. Status aktif/nonaktif jika tersedia.
5. Aksi.

### 31.4 Pola Tampilan Data Master

1. Page header.
2. Tombol tambah data.
3. Search field.
4. Tabel data.
5. Tombol edit.
6. Tombol hapus/nonaktifkan.
7. Pagination.
8. Modal konfirmasi.

---

## 32. Filter Box

Filter digunakan di daftar aduan dan laporan.

### 32.1 Style

1. Card putih.
2. Border `hairline`.
3. Radius 12px.
4. Grid responsive.
5. Tombol filter dan reset di kanan bawah.

### 32.2 Layout

```text
+------------------------------------------------+
| Nomor Tiket | Kategori | Status | Prioritas    |
| Tanggal Awal | Tanggal Akhir | [Reset] [Cari]|
+------------------------------------------------+
```

### 32.3 Contoh Filter Card

```html
<div class="rounded-lg border border-sihati-hairline bg-sihati-canvas p-5 shadow-subtle">
  <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">
    <!-- input filter -->
  </div>
  <div class="mt-5 flex justify-end gap-3">
    <button class="rounded-md border border-sihati-hairline-strong px-4 py-2 text-sm font-medium">Reset</button>
    <button class="rounded-md bg-sihati-primary px-4 py-2 text-sm font-medium text-white">Cari</button>
  </div>
</div>
```

---

## 33. Empty, Loading, Error, dan Success State

### 33.1 Empty State

```html
<div class="rounded-lg border border-dashed border-sihati-hairline-strong bg-sihati-canvas p-10 text-center">
  <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-lg bg-sihati-lavender text-sihati-primary">
    Icon
  </div>
  <h3 class="mt-4 text-base font-semibold text-sihati-ink">Belum ada aduan</h3>
  <p class="mt-1 text-sm text-sihati-slate">Aduan yang dibuat akan tampil di halaman ini.</p>
</div>
```

### 33.2 Button Loading

```html
<button disabled class="inline-flex h-11 items-center gap-2 rounded-md bg-sihati-primary px-4 text-sm font-medium text-white opacity-70">
  <span class="h-4 w-4 rounded-full border-2 border-white/40 border-t-white animate-spin"></span>
  Memproses...
</button>
```

### 33.3 Skeleton Card

```html
<div class="animate-pulse rounded-lg border border-sihati-hairline bg-sihati-canvas p-6">
  <div class="h-4 w-24 rounded bg-sihati-hairline"></div>
  <div class="mt-4 h-8 w-16 rounded bg-sihati-hairline"></div>
</div>
```

---

## 34. Breadcrumb

Breadcrumb membantu pengguna mengetahui posisi halaman.

```html
<nav class="mb-4 text-sm text-sihati-steel">
  <a href="#" class="hover:text-sihati-link">Dashboard</a>
  <span class="mx-2">/</span>
  <a href="#" class="hover:text-sihati-link">Aduan</a>
  <span class="mx-2">/</span>
  <span class="text-sihati-charcoal">Detail Aduan</span>
</nav>
```

---

## 35. Page Header

Setiap halaman harus memiliki heading.

```html
<div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
  <div>
    <p class="text-xs font-semibold uppercase tracking-[0.08em] text-sihati-steel">Aduan</p>
    <h1 class="mt-1 text-2xl font-semibold tracking-[-0.02em] text-sihati-ink">Daftar Aduan</h1>
    <p class="mt-1 text-sm leading-6 text-sihati-slate">Kelola dan pantau seluruh aduan teknologi informasi.</p>
  </div>

  <a href="#" class="inline-flex h-11 items-center justify-center rounded-md bg-sihati-primary px-4 text-sm font-medium text-white hover:bg-sihati-primary-pressed">
    Buat Aduan
  </a>
</div>
```

---

## 36. Icon Style

Ikon boleh menggunakan salah satu library berikut:

1. Heroicons.
2. Lucide Icons.
3. Font Awesome.
4. SVG inline sederhana.

Pilih satu agar gaya konsisten.

### 36.1 Rekomendasi Ikon

| Menu / Fitur | Ikon Cocok |
|---|---|
| Dashboard | Home / Layout Dashboard |
| Aduan | Ticket / Clipboard List |
| Buat Aduan | Plus Circle / File Plus |
| Riwayat | Clock / History |
| Kategori | Tag |
| Pengguna | Users |
| Bidang | Building |
| Laporan | File Text / Bar Chart |
| Profil | User |
| Logout | Log Out |
| Notifikasi | Bell |

### 36.2 Ukuran Ikon

| Area | Ukuran |
|---|---|
| Sidebar | `h-5 w-5` |
| Button | `h-4 w-4` |
| Stat card | `h-6 w-6` |
| Empty state | `h-12 w-12` |

---

## 37. Responsive Design

### 37.1 Breakpoint

| Breakpoint | Ukuran | Penggunaan |
|---|---:|---|
| Mobile kecil | `< 480px` | Single column |
| `sm` | `640px` | Mobile besar |
| `md` | `768px` | Tablet, sidebar mulai bisa permanen |
| `lg` | `1024px` | Laptop |
| `xl` | `1280px` | Desktop |
| `2xl` | `1536px` | Desktop besar |

### 37.2 Aturan Responsive

1. Sidebar tampil permanen mulai `md` atau `lg`, sesuai kebutuhan.
2. Sidebar menjadi drawer pada mobile.
3. Dashboard card satu kolom di mobile.
4. Dashboard card dua kolom di tablet.
5. Dashboard card empat kolom di desktop.
6. Tabel harus dibungkus `overflow-x-auto`.
7. Form dua kolom di desktop dan satu kolom di mobile.
8. Tombol aksi pada mobile boleh full width.
9. Login hero navy disembunyikan di mobile agar halaman sederhana.
10. Detail aduan dua kolom di desktop dan satu kolom di mobile.

### 37.3 Grid Responsive

```html
<div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
  <!-- stat cards -->
</div>
```

---

## 38. Accessibility

Aplikasi harus tetap nyaman digunakan oleh semua pengguna.

### 38.1 Aturan Umum

1. Setiap input wajib memiliki label.
2. Button harus memiliki teks yang jelas.
3. Jangan hanya mengandalkan warna untuk status; tampilkan teks status.
4. Kontras teks harus jelas.
5. Gunakan `focus:ring` pada input dan tombol.
6. Gambar/logo harus memiliki `alt`.
7. Icon tanpa teks harus memiliki `aria-label`.
8. Ukuran klik tombol minimal sekitar 40–44px.
9. Table tetap bisa dibaca di mobile.

### 38.2 Contoh

```html
<img src="/images/logo-sihati.png" alt="Logo SIHATI BPPKAD">
<button aria-label="Buka menu" class="rounded-md p-2 hover:bg-sihati-surface">
  Menu
</button>
```

---

## 39. Microcopy UI

Gunakan kalimat singkat, jelas, dan formal ringan.

### 39.1 Tombol

1. `Login`
2. `Buat Aduan`
3. `Kirim Aduan`
4. `Simpan`
5. `Batal`
6. `Kembali`
7. `Lihat Detail`
8. `Terima Aduan`
9. `Proses Aduan`
10. `Minta Konfirmasi`
11. `Konfirmasi Selesai`
12. `Belum Selesai`
13. `Tolak Aduan`
14. `Cetak PDF`
15. `Export Excel`
16. `Reset Filter`

### 39.2 Pesan Sukses

1. `Aduan berhasil dikirim.`
2. `Status aduan berhasil diperbarui.`
3. `Data berhasil disimpan.`
4. `Komentar berhasil ditambahkan.`
5. `Laporan berhasil ditampilkan.`

### 39.3 Pesan Error

1. `Data gagal disimpan.`
2. `Mohon lengkapi field yang wajib diisi.`
3. `File yang diunggah tidak sesuai format.`
4. `Terjadi kesalahan. Silakan coba kembali.`

### 39.4 Pesan Kosong

1. `Belum ada aduan.`
2. `Belum ada data laporan pada periode ini.`
3. `Belum ada komentar pada aduan ini.`
4. `Data kategori belum tersedia.`

---

## 40. Frontend State Berdasarkan Role

Frontend perlu menyiapkan tampilan berbeda berdasarkan role yang dikirim backend.

### 40.1 Pegawai

Pegawai dapat melihat:

1. Dashboard pegawai.
2. Buat aduan.
3. Aduan saya.
4. Detail aduan miliknya.
5. Riwayat status aduan miliknya.
6. Komentar pada aduan miliknya.
7. Konfirmasi selesai jika status menunggu konfirmasi.
8. Rating jika aduan selesai.
9. Profil saya.

Pegawai tidak menampilkan:

1. Semua aduan pengguna lain.
2. Data pengguna.
3. Data bidang.
4. Data kategori.
5. Laporan keseluruhan.
6. Tombol update status petugas.

### 40.2 Petugas IT

Petugas IT dapat melihat:

1. Dashboard petugas IT.
2. Semua aduan masuk.
3. Detail seluruh aduan.
4. Update status aduan.
5. Catatan penanganan.
6. Komentar aduan.
7. Kategori aduan.
8. Data pengguna jika fitur disediakan.
9. Data bidang jika fitur disediakan.
10. Laporan aduan.
11. Cetak/export laporan jika fitur disediakan.
12. Profil saya.

---

## 41. Penamaan Komponen dan File

### 41.1 Blade Component

Gunakan nama yang mudah dipahami.

```text
<x-button variant="primary">Simpan</x-button>
<x-card>
<x-stat-card>
<x-badge-status status="Diproses" />
<x-badge-priority priority="Sedang" />
<x-alert type="success" />
<x-empty-state />
<x-modal />
```

### 41.2 File Name

Gunakan huruf kecil dan tanda hubung jika lebih dari satu kata.

```text
index.blade.php
create.blade.php
show.blade.php
edit-status.blade.php
status-actions.blade.php
comment-box.blade.php
```

### 41.3 Class Custom

Jika perlu membuat CSS custom, gunakan prefix `sihati-`.

```css
.sihati-scrollbar
.sihati-card
.sihati-sidebar
```

---

## 42. Catatan Integrasi dengan Backend

Frontend hanya menyiapkan tampilan. Data asli akan dikirim oleh Laravel melalui controller.

Sementara backend belum siap, frontend boleh menggunakan dummy data di Blade.

### 42.1 Contoh Dummy Data

```blade
@php
$aduans = [
    [
        'nomor_tiket' => 'SIHATI-2026-0001',
        'judul' => 'Printer tidak bisa mencetak',
        'kategori' => 'Printer/Scanner',
        'status' => 'Diproses',
        'prioritas' => 'Sedang',
        'tanggal' => '02-07-2026',
    ],
];
@endphp
```

### 42.2 Data yang Perlu Disepakati dengan Backend

Frontend perlu tahu nama variabel atau struktur data untuk:

1. User login.
2. Role user.
3. Statistik dashboard.
4. Daftar aduan.
5. Detail aduan.
6. Riwayat status.
7. Komentar.
8. Kategori.
9. Bidang.
10. Laporan.
11. Pagination.
12. Flash message.
13. Error validation.

Frontend tidak membuat logic query, tetapi perlu menyesuaikan tampilan dengan data yang disediakan backend.

---

## 43. Rekomendasi Urutan Pengerjaan Frontend

Urutan pengerjaan yang disarankan:

1. Setup Tailwind CSS.
2. Tambahkan color palette Notion-inspired SIHATI ke `tailwind.config.js`.
3. Buat layout guest.
4. Buat halaman login.
5. Buat layout app.
6. Buat sidebar.
7. Buat topbar.
8. Buat komponen button, card, badge, input, table, alert, modal.
9. Buat dashboard pegawai.
10. Buat dashboard petugas IT.
11. Buat halaman daftar aduan.
12. Buat halaman buat aduan.
13. Buat halaman detail aduan.
14. Buat timeline riwayat status.
15. Buat komentar aduan.
16. Buat modal update status.
17. Buat halaman laporan.
18. Buat halaman data master untuk petugas IT.
19. Buat halaman profil.
20. Rapikan responsive design.
21. Cek konsistensi tampilan.
22. Cek tampilan mobile.
23. Ganti dummy data dengan data dari backend ketika backend siap.

---

## 44. Checklist Frontend

### 44.1 Layout

- [ ] Layout guest selesai.
- [ ] Layout app selesai.
- [ ] Sidebar desktop selesai.
- [ ] Sidebar mobile/drawer selesai.
- [ ] Topbar selesai.
- [ ] Breadcrumb selesai.
- [ ] Footer selesai.

### 44.2 Komponen

- [ ] Button selesai.
- [ ] Card selesai.
- [ ] Stat card selesai.
- [ ] Badge status selesai.
- [ ] Badge prioritas selesai.
- [ ] Alert selesai.
- [ ] Modal selesai.
- [ ] Input selesai.
- [ ] Select selesai.
- [ ] Textarea selesai.
- [ ] Table selesai.
- [ ] Empty state selesai.
- [ ] Loading state selesai.
- [ ] Pagination selesai.

### 44.3 Halaman

- [ ] Login selesai.
- [ ] Dashboard pegawai selesai.
- [ ] Dashboard petugas IT selesai.
- [ ] Daftar aduan selesai.
- [ ] Buat aduan selesai.
- [ ] Detail aduan selesai.
- [ ] Update status selesai.
- [ ] Komentar aduan selesai.
- [ ] Riwayat status selesai.
- [ ] Laporan selesai.
- [ ] Data pengguna selesai jika fitur disediakan.
- [ ] Data bidang selesai jika fitur disediakan.
- [ ] Data kategori selesai.
- [ ] Profil selesai.

### 44.4 Responsive

- [ ] Tampilan desktop rapi.
- [ ] Tampilan tablet rapi.
- [ ] Tampilan mobile rapi.
- [ ] Tabel tidak merusak layout di mobile.
- [ ] Form nyaman digunakan di mobile.
- [ ] Sidebar mobile dapat dibuka dan ditutup.
- [ ] Detail aduan tetap mudah dibaca di mobile.

### 44.5 Konsistensi

- [ ] Warna sesuai palette.
- [ ] Tidak ada warna biru lama sebagai primary.
- [ ] Button menggunakan radius 8px.
- [ ] Card menggunakan radius 12px.
- [ ] Badge konsisten.
- [ ] Form konsisten.
- [ ] Tabel konsisten.
- [ ] Spacing konsisten.
- [ ] Typography konsisten.
- [ ] Empty state tersedia.
- [ ] Error state tersedia.

---

## 45. Catatan Penting untuk Frontend

1. Jangan membuat logic backend di Blade.
2. Blade hanya digunakan untuk menampilkan data dan kondisi sederhana.
3. Gunakan komponen agar tampilan tidak berulang terlalu banyak.
4. Semua status harus memiliki badge konsisten.
5. Semua halaman harus memiliki judul dan deskripsi singkat.
6. Semua tabel harus memiliki empty state.
7. Semua form harus memiliki tampilan error.
8. Semua tombol aksi penting harus memiliki konfirmasi jika berisiko.
9. Gunakan palette SIHATI Notion-inspired secara konsisten.
10. Jangan memakai palette biru lama sebagai identitas utama.
11. Gunakan `primary` ungu hanya untuk aksi utama.
12. Gunakan `link-blue` hanya untuk link teks.
13. Gunakan pastel tint untuk card ringkasan, bukan untuk teks utama.
14. Pastikan tampilan tetap rapi ketika data panjang.
15. Pastikan role pegawai tidak melihat menu petugas IT.
16. Pastikan role petugas IT memiliki akses tampilan untuk aduan, laporan, dan data master.

---

## 46. Ringkasan Desain

Frontend SIHATI BPPKAD menggunakan pendekatan **Notion-inspired internal helpdesk dashboard**. Warna utama aplikasi adalah ungu `#5645D4` untuk aksi utama, navy `#0A1530` untuk sidebar dan login hero, putih `#FFFFFF` untuk area kerja, abu hangat `#F6F5F4` untuk background halaman, serta pastel tint untuk card dashboard.

Struktur frontend hanya mendukung 2 role:

1. **Pegawai / Pelapor** — membuat dan memantau aduan miliknya.
2. **Petugas IT** — memproses aduan sekaligus mengelola kategori, data master, dan laporan.

Tidak ada role admin terpisah dan tidak ada role pimpinan pada frontend. Fungsi administratif digabung ke Petugas IT.

Prinsip desain utama:

```text
Bersih, editorial, modern, responsif, mudah dibaca, dan konsisten.
```

