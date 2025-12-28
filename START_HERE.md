# 🎬 MULAI DARI SINI - Langkah demi Langkah

Ikuti langkah-langkah di bawah untuk setup dan menggunakan landing page public yang telah dibuat.

## 📌 Prasyarat

- PHP 8.1+
- Composer terinstall
- Node.js & npm (untuk assets)
- MySQL/MariaDB running
- XAMPP/Laragon berjalan

## ✅ LANGKAH 1: Database Configuration

### 1.1 Buka `.env`
```bash
# Di folder project root, buka file: .env
```

### 1.2 Sesuaikan database settings
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=yayasan          # Nama database Anda
DB_USERNAME=root             # User MySQL
DB_PASSWORD=                 # Password MySQL (kosong jika default)
```

### 1.3 Buat database (jika belum ada)
```bash
# Buka phpMyAdmin atau command line
# CREATE DATABASE yayasan;
```

## ✅ LANGKAH 2: Install Dependencies

```bash
# Terminal/Command Prompt, arah ke folder project
cd c:\xampp\htdocs\yayasan

# Install PHP dependencies
composer install

# Install JavaScript dependencies (optional)
npm install
```

## ✅ LANGKAH 3: Generate Application Key

```bash
php artisan key:generate
```

## ✅ LANGKAH 4: Jalankan Migrations

```bash
php artisan migrate
```

Ini akan membuat semua tabel di database:
- `users`
- `settings`
- `landing_sections`
- `pages`
- `news`
- `menus`
- dll

## ✅ LANGKAH 5: Seed Database dengan Data Sample

```bash
php artisan db:seed
```

Ini akan membuat:
- 1 Admin user (email: `admin@yayasan.id`, password: `password`)
- Website settings
- 3 Landing sections
- 3 Pages (Profil, Visi-Misi, Kontak)
- 2 Navigation menus
- 3 Sample news posts

## ✅ LANGKAH 6: Setup Storage Link

```bash
php artisan storage:link
```

Ini membuat symlink untuk mengakses file yang diupload.

## ✅ LANGKAH 7: Jalankan Development Server

**Terminal 1 - PHP Server:**
```bash
php artisan serve
```

Output akan seperti:
```
Starting Laravel development server: http://127.0.0.1:8000
```

**Terminal 2 - Assets (optional, jika ada CSS/JS changes):**
```bash
npm run dev
```

## ✅ LANGKAH 8: Akses Landing Page

Buka browser dan akses:
```
http://localhost:8000
```

Anda akan melihat:
- Hero section
- 3 Content sections (Tentang, Visi-Misi, Program)
- 6 Latest news cards
- Professional footer

## 🔐 LANGKAH 9: Login ke Admin Panel

1. Buka: `http://localhost:8000/login`
2. Login dengan:
   - Email: `admin@yayasan.id`
   - Password: `password`
3. Redirect ke: `http://localhost:8000/admin/dashboard`

## 🎯 LANGKAH 10: Kelola Konten (Opsional)

Admin panel memungkinkan Anda untuk:

### Edit Website Settings
- Site name
- Address
- Phone number
- Email
- Social media links
- Logo

### Tambah/Edit Landing Sections
- Judul & konten panjang
- Upload gambar
- Atur urutan
- Aktifkan/nonaktifkan

### Tambah/Edit Pages
- Halaman Profil
- Halaman Visi & Misi
- Halaman Kontak
- Custom pages lainnya

### Tambah/Edit Berita/News
- Judul & konten
- Excerpt
- Upload gambar featured
- Publish otomatis dengan tanggal

### Kelola Menu Navigasi
- Tambah menu item
- Atur urutan
- Aktifkan/nonaktifkan

## 📋 Daftar Halaman yang Tersedia

| URL | Halaman | Keterangan |
|-----|---------|-----------|
| `/` | Landing Page | Halaman utama dengan sections & news |
| `/profil` | Profil Yayasan | Info profil |
| `/visi-misi` | Visi & Misi | Visi dan misi yayasan |
| `/kontak` | Kontak | Informasi kontak |
| `/berita` | Daftar Berita | Semua news posts |
| `/berita/[slug]` | Detail Berita | Baca news lengkap |
| `/login` | Login | Login admin |
| `/admin` | Admin Dashboard | Panel admin (setelah login) |

## ✨ Fitur-Fitur yang Sudah Diimplementasi

✅ **Landing Page Dinamis**
- Hero section dengan gradient
- Multiple content sections dari database
- Latest news showcase
- Call to action sections

✅ **Responsive Design**
- Mobile friendly (< 768px)
- Tablet layout (768px - 1024px)
- Desktop layout (> 1024px)
- Touch-friendly buttons

✅ **Database-Driven**
- Semua konten dari database
- Mudah dikelola via admin panel
- No hardcoded content

✅ **SEO Optimized**
- Meta titles & descriptions
- Breadcrumb navigation
- Semantic HTML
- Proper heading hierarchy

✅ **Image Support**
- Upload gambar untuk sections
- Upload gambar untuk news
- Image placeholders
- Responsive images

✅ **Social Media Integration**
- Facebook link
- Instagram link
- YouTube link
- Customizable di settings

## 🚨 Jika Ada Error

### "Database connection error"
- Periksa `.env` database settings
- Pastikan MySQL berjalan
- Restart MySQL service

### "SQLSTATE[42S02]: Table not found"
```bash
php artisan migrate
php artisan db:seed
```

### "Images not showing"
```bash
php artisan storage:link
```

### "Route not found / 404"
```bash
php artisan route:clear
php artisan cache:clear
```

### "Composer error"
```bash
composer install
composer update
```

## 💾 Mengubah Password Admin

1. Login ke admin
2. Buka profile settings
3. Ubah password
4. Save

Atau via command line:
```bash
php artisan tinker
> $user = App\Models\User::first();
> $user->update(['password' => bcrypt('password_baru')]);
> exit
```

## 📦 Backup Database (Important!)

Sebelum production:
```bash
# Backup database ke file
mysqldump -u root -p yayasan > backup_yayasan.sql

# Restore dari backup
mysql -u root -p yayasan < backup_yayasan.sql
```

## 🚀 Siap untuk Production?

Sebelum deploy ke production:

1. ✅ Ubah password admin
2. ✅ Update `.env` ke production settings
3. ✅ Set `APP_DEBUG=false`
4. ✅ Set `APP_ENV=production`
5. ✅ Setup SSL certificate (HTTPS)
6. ✅ Setup proper web server (Nginx/Apache)
7. ✅ Setup database backups
8. ✅ Configure email settings
9. ✅ Test semua halaman & forms
10. ✅ Setup analytics (Google Analytics)

## 📚 Dokumentasi Tambahan

Lihat file di project root:
- `README_LANDING_PAGE.md` - Panduan cepat
- `LANDING_PAGE_SETUP.md` - Setup lengkap
- `QUICK_REFERENCE.md` - Referensi cepat
- `SETUP_CHECKLIST.md` - Verification checklist
- `LANDING_CHANGES.md` - Summary perubahan
- `FILE_CHANGES_SUMMARY.md` - Daftar file yang diubah

## 💡 Tips & Trik

1. **Cache settings dalam database** - Gunakan Laravel caching
2. **Optimize images** - Compress sebelum upload
3. **Use CDN** - Untuk static assets di production
4. **Monitor logs** - Cek `storage/logs/laravel.log`
5. **Keep Laravel updated** - Run `composer update` secara berkala

## 🆘 Butuh Bantuan?

1. Baca dokumentasi di project folder
2. Cek Laravel documentation: https://laravel.com/docs
3. Cek log files: `storage/logs/laravel.log`
4. Hubungi developer

---

## 🎉 SELESAI!

Jika semua langkah di atas berhasil, maka:

✅ Landing page Anda sudah aktif di `http://localhost:8000`
✅ Admin panel accessible di `http://localhost:8000/admin`
✅ Anda bisa mulai mengelola konten

**Selamat menggunakan landing page public yang telah dibuat!** 🚀

Untuk pertanyaan lebih lanjut, baca dokumentasi yang tersedia atau hubungi developer Anda.
