# 🎯 PANDUAN CEPAT - LANDING PAGE PUBLIC

Ini adalah panduan singkat untuk langsung menggunakan landing page yang telah dibuat.

## ⚡ Setup Awal (5 Menit)

```bash
# 1. Buka terminal di folder project
cd c:\xampp\htdocs\yayasan

# 2. Migrasi database
php artisan migrate

# 3. Isi database dengan data contoh
php artisan db:seed

# 4. Setup folder penyimpanan file
php artisan storage:link

# 5. Jalankan server
php artisan serve
```

Selesai! Buka browser dan akses: **http://localhost:8000**

## 📍 Halaman-Halaman yang Ada

| Halaman | URL | Keterangan |
|---------|-----|-----------|
| Beranda | http://localhost:8000 | Halaman utama dengan sections & berita terbaru |
| Profil | http://localhost:8000/profil | Informasi profil yayasan |
| Visi & Misi | http://localhost:8000/visi-misi | Visi dan misi yayasan |
| Kontak | http://localhost:8000/kontak | Informasi kontak |
| Berita | http://localhost:8000/berita | Daftar semua berita |
| Detail Berita | http://localhost:8000/berita/[slug] | Baca berita lengkap |
| Login | http://localhost:8000/login | Login admin |
| Admin | http://localhost:8000/admin | Panel admin (setelah login) |

## 🔑 Akun Admin Default

```
Email: admin@yayasan.id
Password: password
```

⚠️ **Penting:** Ubah password di production!

## 📝 Cara Mengelola Konten

### 1. Edit Nama Website & Kontak
Login → Admin → Settings
- Nama website
- Alamat
- Nomor telepon
- Email
- Social media (Facebook, Instagram, YouTube)

### 2. Edit Landing Sections (Bagian-bagian di halaman utama)
Login → Admin → Landing Sections
- Tambah section baru
- Edit judul & konten
- Upload gambar
- Atur urutan
- Aktifkan/nonaktifkan

### 3. Kelola Halaman Statis
Login → Admin → Pages
- Edit Profil
- Edit Visi & Misi
- Edit Kontak

### 4. Tambah Berita/Pengumuman
Login → Admin → News
- Klik "New"
- Isi Judul, excerpt, konten
- Upload gambar (optional)
- Klik "Publish"

### 5. Atur Menu Navigasi
Login → Admin → Menus
- Tambah menu item baru
- Atur urutan
- Aktifkan/nonaktifkan

## 🎨 Struktur Landing Page (Apa yang Ditampilkan)

```
┌─────────────────────────────────┐
│    NAVBAR (dinamis)             │  ← Logo, menu dari DB
├─────────────────────────────────┤
│    HERO SECTION                 │  ← Judul + tagline dari settings
├─────────────────────────────────┤
│    SECTION 1 (Tentang)          │  ← Dari database
│    - Judul                      │
│    - Konten panjang             │
│    - Gambar (optional)          │
├─────────────────────────────────┤
│    SECTION 2 (Visi & Misi)      │
│    - Judul & konten             │
├─────────────────────────────────┤
│    SECTION 3 (Program)          │
│    - Judul & konten             │
├─────────────────────────────────┤
│    BERITA TERBARU (6 card)      │  ← Dari database news
│    - Gambar                     │
│    - Judul & excerpt            │
│    - Tanggal                    │
│    - "Baca Selengkapnya" link   │
├─────────────────────────────────┤
│    CALL TO ACTION                │  ← "Hubungi Kami"
├─────────────────────────────────┤
│    FOOTER (dinamis)             │  ← Kontak & menu
└─────────────────────────────────┘
```

## 🖥️ Data Contoh yang Sudah Ada

Ketika Anda menjalankan `php artisan db:seed`, sistem akan membuat:

✅ 1 Admin User
- Email: `admin@yayasan.id`
- Password: `password`

✅ Website Settings
- Nama: Yayasan Sosial Indonesia
- Alamat, telepon, email
- Social media links

✅ 3 Landing Sections
- Tentang Kami
- Visi & Misi
- Program Utama

✅ 3 Static Pages
- Profil
- Visi & Misi
- Kontak

✅ 2 Navigation Menus
- Profil
- Visi & Misi

✅ 3 Sample News Posts
- Program Beasiswa
- Pemeriksaan Kesehatan
- Pelatihan UMKM

## 🚨 Jika Ada Masalah

### "Gambar tidak muncul"
```bash
php artisan storage:link
```

### "Halaman tidak muncul / 404 error"
```bash
php artisan route:clear
php artisan route:cache
```

### "Database error / table not found"
```bash
php artisan migrate
php artisan db:seed
```

### "Hapus semua dan mulai dari awal"
```bash
php artisan migrate:fresh --seed
```

## 📁 File-File Penting

```
resources/views/public/
├── landing.blade.php          ← Landing page utama
├── layout.blade.php           ← Template navbar & footer
├── page.blade.php             ← Halaman statis
└── news/
    ├── index.blade.php        ← Daftar berita
    └── show.blade.php         ← Detail berita

app/Http/Controllers/Public/
├── LandingController.php      ← Logic landing page
├── PageController.php         ← Logic halaman statis
└── NewsController.php         ← Logic berita
```

## ✨ Fitur-Fitur

✅ Responsive (mobile, tablet, desktop)
✅ Dynamic menu dari database
✅ Dynamic konten halaman
✅ Dynamic berita dari database
✅ Pretty URLs (SEO friendly)
✅ Breadcrumb navigation
✅ Social media links
✅ Image support
✅ Rich text editor (di admin panel)

## 🎯 Next Steps

1. **Ubah data contoh:**
   - Login ke admin
   - Edit settings dengan info yayasan Anda
   - Edit halaman profil, kontak, dll

2. **Tambah konten:**
   - Buat landing sections baru
   - Tambah berita/pengumuman
   - Edit menu navigasi

3. **Customize desain (optional):**
   - Edit warna (ubah `blue-600` ke warna pilihan)
   - Edit spacing dan size
   - Ubah layout sections

4. **Deploy ke production:**
   - Update `.env` dengan database production
   - Setup SSL certificate
   - Ganti password admin
   - Set `APP_DEBUG=false`

## 💡 Tips Penting

1. **Jangan edit hardcoded** - Semua konten harus via admin panel
2. **Backup database** - Sebelum production, backup data
3. **Compress images** - Sebelum upload, compress gambar
4. **Test di mobile** - Pastikan responsive sebelum launch
5. **Setup email** - Jika ada form, configure email di `.env`

## 📞 Dokumentasi Lengkap

Lihat file-file di folder project:
- `LANDING_PAGE_SETUP.md` - Setup lengkap
- `QUICK_REFERENCE.md` - Referensi cepat
- `SETUP_CHECKLIST.md` - Checklist verifikasi

---

**Selamat! Landing page public Anda sudah siap digunakan.** 🎉

Jika ada pertanyaan, cek dokumentasi atau tanya developer.
