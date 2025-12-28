# 📖 Quick Reference Guide - Landing Page Public

Panduan cepat untuk menggunakan dan manage landing page public.

## 🚀 Starting the Application

```bash
# Terminal 1: Start PHP server
php artisan serve

# Terminal 2: Build assets (jika ada)
npm run dev
```

Akses di: `http://localhost:8000`

## 📄 Page Routes Reference

| Route | URL | File | Deskripsi |
|-------|-----|------|-----------|
| landing | `/` | landing.blade.php | Halaman utama |
| profil | `/profil` | page.blade.php | Halaman profil |
| visi-misi | `/visi-misi` | page.blade.php | Halaman visi & misi |
| kontak | `/kontak` | page.blade.php | Halaman kontak |
| news.index | `/berita` | news/index.blade.php | Daftar berita |
| news.show | `/berita/{slug}` | news/show.blade.php | Detail berita |
| login | `/login` | auth page | Login admin |
| admin.* | `/admin/*` | Filament | Admin panel |

## 🎨 Tailwind Classes Quick Reference

### Colors (digunakan di landing page)
```
bg-blue-600        Primary button
bg-gray-50         Light background
bg-gray-800        Dark footer
text-gray-800      Main text
hover:text-blue-600 Link hover
```

### Responsive
```
hidden md:flex      Hidden on mobile, show on tablet+
grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3
max-w-4xl          Max width container
container mx-auto   Centered with side padding
```

## 🗄️ Database Query Examples

### Get all active landing sections
```php
$sections = LandingSection::where('is_active', true)
    ->orderBy('order')
    ->get();
```

### Get published news
```php
$news = News::whereNotNull('published_at')
    ->where('published_at', '<=', now())
    ->latest('published_at')
    ->get();
```

### Get website settings
```php
$settings = Setting::first();
echo $settings->site_name;
echo $settings->phone;
```

### Get navigation menus
```php
$menus = Menu::where('is_active', true)
    ->orderBy('order')
    ->get();
```

## ✏️ Common Edits

### Change Primary Color
Find and replace in all blade files:
```
blue-600  → your-color-600
blue-700  → your-color-700
blue-800  → your-color-800
blue-100  → your-color-100
```

### Change Max Container Width
In `landing.blade.php`:
```blade
<div class="max-w-4xl mx-auto">  <!-- Change max-w-4xl -->
```

### Add New Page
1. Create migration: `php artisan make:migration create_pages_table`
2. Create model: `php artisan make:model Page`
3. Add in seeder
4. Create route in `routes/web.php`
5. Create controller method
6. Create blade view

### Add New News Post
1. Use admin panel, atau
2. Manually insert in `pages` table dengan:
   - title
   - slug (auto-generated)
   - excerpt
   - content
   - published_at (set ke now() untuk publish)

## 🔍 View Variables Available

### In `landing.blade.php`
```php
$sections      // Collection of LandingSection
$latestNews    // Collection of News (limit 6)
$settings      // Array of settings
```

### In `layout.blade.php`
```php
$settings      // Setting model (first())
$menus         // Collection of Menu
```

### In `page.blade.php`
```php
$page          // Page model
```

### In `news/show.blade.php`
```php
$news          // News model
$news->author  // User who wrote the news
```

## 📤 File Upload Handling

### Upload location
```
storage/app/public/news/
storage/app/public/sections/
storage/app/public/pages/
```

### Access uploaded file
```blade
<img src="{{ asset('storage/' . $model->image) }}">
```

## 🐛 Debug Tips

### Check routes
```bash
php artisan route:list
```

### View all database records
```bash
php artisan tinker
> News::all();
> Page::all();
> LandingSection::all();
```

### Clear cache if things look weird
```bash
php artisan cache:clear
php artisan view:clear
php artisan route:clear
php artisan config:clear
```

## 🎯 Common Tasks

### Add a new menu item
```php
Menu::create([
    'title' => 'Galeri',
    'url' => '/galeri',
    'order' => 3,
    'is_active' => true,
]);
```

### Publish a news item
```php
$news = News::find(1);
$news->published_at = now();
$news->save();
```

### Hide a landing section
```php
$section = LandingSection::find(1);
$section->is_active = false;
$section->save();
```

### Update website settings
```php
$settings = Setting::first();
$settings->update([
    'site_name' => 'Nama Baru',
    'phone' => '+62-xxx-xxx',
    'email' => 'email@baru.com'
]);
```

## 🔐 Security Notes

- Never commit `.env` file
- Change default admin password in production
- Use proper validation for all forms
- Sanitize user input
- Keep Laravel updated
- Use HTTPS in production

## 📊 Performance Tips

1. **Cache queries** - Use Laravel caching for frequently used data
2. **Optimize images** - Compress images before upload
3. **Lazy load images** - Already implemented with modern img tags
4. **Minify CSS/JS** - Run `npm run build` for production
5. **Use CDN** - For static assets in production

## 📚 Useful Links

- **Laravel Docs**: https://laravel.com/docs
- **Blade Templating**: https://laravel.com/docs/blade
- **Eloquent ORM**: https://laravel.com/docs/eloquent
- **Tailwind CSS**: https://tailwindcss.com
- **Filament Admin**: https://filamentphp.com

## 🆘 When Things Break

1. Check Laravel logs: `storage/logs/laravel.log`
2. Run database migrations: `php artisan migrate`
3. Clear all caches: `php artisan cache:clear && php artisan view:clear`
4. Check database connection in `.env`
5. Verify storage link: `php artisan storage:link`

---

**Keep this guide handy! Refer to it whenever working with the landing page.** 📋
