# Landing Page Public - Panduan Setup

Landing page public telah dibuat dengan sistem yang **dinamis** mengambil data dari database. Berikut panduan lengkapnya.

## 📋 Struktur Landing Page

Landing page terdiri dari:

1. **Header/Navbar** - Dinamis dari database
2. **Hero Section** - Dengan tagline dari settings
3. **Sections Dinamis** - Dari table `landing_sections` (Admin dapat menambah/edit)
4. **Berita/News** - Dari table `news` (Published news)
5. **Call to Action** - Link ke halaman kontak
6. **Footer** - Dinamis dari database settings & menus

## 🔧 File-File yang Telah Dibuat/Diupdate

### Controllers
- `app/Http/Controllers/Public/LandingController.php` - Controller untuk landing page
- `app/Http/Controllers/Public/PageController.php` - Controller untuk halaman statis (Profil, Visi-Misi, Kontak)
- `app/Http/Controllers/Public/NewsController.php` - Controller untuk daftar & detail berita

### Views
- `resources/views/public/landing.blade.php` - Landing page utama ✨ **Sudah ditingkatkan**
- `resources/views/public/layout.blade.php` - Template layout ✨ **Sudah ditingkatkan**
- `resources/views/public/page.blade.php` - Halaman statis ✨ **Sudah ditingkatkan**
- `resources/views/public/news/index.blade.php` - Daftar berita ✨ **Sudah ditingkatkan**
- `resources/views/public/news/show.blade.php` - Detail berita ✨ **Sudah ditingkatkan**

### Models
- `app/Models/LandingSection.php` - Model untuk landing sections
- `app/Models/Page.php` - Model untuk halaman statis
- `app/Models/News.php` - Model untuk berita
- `app/Models/Setting.php` - Model untuk settings website
- `app/Models/Menu.php` - Model untuk menu navigasi

### Database
- Migrations sudah ada di `database/migrations/`
- Seeders sudah ada di `database/seeders/`

## 🚀 Cara Setup

### 1. Migrasi Database
```bash
php artisan migrate
```

### 2. Seed Database (Isi data awal)
```bash
php artisan db:seed
```

Ini akan membuat:
- Admin user (email: `admin@yayasan.id`, password: `password`)
- Settings website
- 3 Landing sections
- 3 Halaman statis (Profil, Visi-Misi, Kontak)
- 2 Menu navigasi
- 3 Sample news posts

### 3. Setup Storage Link (untuk upload file)
```bash
php artisan storage:link
```

## 📱 Fitur-Fitur Landing Page

### Dynamic Navbar
- Mengambil `site_name` dari database settings
- Menu diambil dari table `menus`
- Responsive dengan mobile menu
- Link login dan navigasi

### Hero Section
- Judul: "Selamat Datang"
- Tagline dari database (bisa diedit di admin)
- Call to action buttons

### Content Sections
Admin dapat menambah unlimited sections di dashboard:
- Judul & Konten (dengan rich editor)
- Gambar untuk setiap section
- Order/urutan sections
- Toggle aktif/non-aktif

### Latest News
- Menampilkan 6 news terbaru yang published
- Gambar preview, tanggal, dan excerpt
- Link ke full article
- Button "Lihat Semua Berita"

### Footer
- Site name, address, phone, email
- Social media links (Facebook, Instagram, YouTube)
- Menu links
- Copyright year otomatis

## 🔑 Kunci Database

### Settings Table
```
- site_name (required)
- logo (optional)
- address (optional)
- phone (optional)
- email (optional)
- facebook (optional)
- instagram (optional)
- youtube (optional)
```

### Landing Sections Table
```
- key (identifier - hero, about, dll)
- title (required)
- content (longText - bisa pake HTML)
- image (optional)
- order (untuk sorting)
- is_active (boolean - untuk show/hide)
```

### Pages Table
```
- slug (required - unique identifier)
- title (required)
- content (longText)
- meta_title (SEO)
- meta_description (SEO)
- is_active (boolean)
```

### News Table
```
- title (required)
- slug (auto-generated dari title)
- excerpt (short description)
- content (longText)
- image (optional)
- meta_title (SEO)
- meta_description (SEO)
- published_at (datetime - hanya news published yang tampil)
- user_id (author)
```

### Menus Table
```
- title (required)
- url (required - bisa pakai route helpers)
- order (untuk sorting)
- is_active (boolean)
```

## ✏️ Cara Edit dari Admin Panel

1. Login ke `/admin` dengan email: `admin@yayasan.id`, password: `password`
2. Edit Settings - untuk site name, kontak, social media
3. Edit Landing Sections - untuk section-section di landing page
4. Create/Edit News - untuk berita/pengumuman
5. Create/Edit Pages - untuk halaman statis (Profil, Visi-Misi, Kontak)
6. Create/Edit Menus - untuk menu navigasi

## 🎨 Styling

Landing page menggunakan **Tailwind CSS** dengan:
- Responsive grid (1 kolom mobile, 2 kolom tablet, 3 kolom desktop)
- Color scheme: Blue (#3B82F6) sebagai primary color
- Shadow & hover effects
- Gradient backgrounds

## 📝 Routes

Public routes sudah dikonfigurasi di `routes/web.php`:

```
GET / → landing page
GET /profil → halaman profil
GET /visi-misi → halaman visi & misi
GET /kontak → halaman kontak
GET /berita → daftar berita
GET /berita/{slug} → detail berita
```

## 🔍 SEO

Setiap halaman sudah memiliki:
- Meta title
- Meta description
- Breadcrumbs
- Semantic HTML

## 📦 Upload Gambar

Untuk upload gambar di admin:
1. Upload otomatis tersimpan di `storage/app/public/`
2. Akses via `asset('storage/' . $path)`
3. Pastikan sudah run `php artisan storage:link`

## 🐛 Troubleshooting

### Gambar tidak muncul
- Pastikan sudah jalankan: `php artisan storage:link`
- Check folder `storage/app/public/` ada atau tidak

### Route not found
- Clear route cache: `php artisan route:clear`
- Regenerate: `php artisan route:cache`

### Database error
- Run migrations: `php artisan migrate`
- Seed data: `php artisan db:seed`

## 💡 Tips

1. Untuk mengubah warna tema, edit Tailwind color classes (currently: blue)
2. Untuk menambah sections, gunakan admin panel → jangan manual edit
3. Untuk SEO lebih baik, isi semua meta_title dan meta_description
4. News hanya tampil jika `published_at` sudah terlewat

---

**Landing page public Anda sudah siap digunakan! 🎉**

Jika ada pertanyaan atau perlu customize lebih lanjut, hubungi developer Anda.
