# ✅ Landing Page Setup Checklist

Gunakan checklist ini untuk memastikan semua sudah configured dengan benar.

## 🔧 Installation & Setup

- [ ] Clone/download project
- [ ] Run `composer install`
- [ ] Run `npm install`
- [ ] Copy `.env.example` to `.env`
- [ ] Generate app key: `php artisan key:generate`
- [ ] Configure database di `.env`

## 🗄️ Database Setup

- [ ] Run migrations: `php artisan migrate`
- [ ] Run seeders: `php artisan db:seed`
- [ ] Verify tables created:
  - [ ] `settings` table
  - [ ] `landing_sections` table
  - [ ] `pages` table
  - [ ] `news` table
  - [ ] `menus` table

## 📁 File System

- [ ] Create storage link: `php artisan storage:link`
- [ ] Check `storage/app/public` folder exists
- [ ] Check `public/storage` symlink exists

## 🌐 Application Testing

### Homepage (`http://localhost:8000`)
- [ ] Page loads without errors
- [ ] Hero section displays with proper styling
- [ ] Dynamic sections render from database
- [ ] Latest news cards display
- [ ] Images show properly (or placeholder)
- [ ] All buttons are clickable
- [ ] Responsive on mobile (test with DevTools)

### Navbar & Navigation
- [ ] Logo/site name displays
- [ ] Menu items from database appear
- [ ] Mobile hamburger menu works
- [ ] All navigation links functional
- [ ] Active page highlighted

### Landing Sections
- [ ] Section 1 (Tentang) renders
- [ ] Section 2 (Visi & Misi) renders
- [ ] Section 3 (Program) renders
- [ ] Content displays with proper formatting
- [ ] Alternating background colors work

### News Section
- [ ] 6 latest news cards display
- [ ] News images visible
- [ ] Publication dates in Indonesian format
- [ ] "Baca Selengkapnya" links work

### Pages
- [ ] `/profil` page loads
  - [ ] Breadcrumb shows
  - [ ] Title displays
  - [ ] Content renders
- [ ] `/visi-misi` page loads
  - [ ] Breadcrumb shows
  - [ ] Content displays
- [ ] `/kontak` page loads
  - [ ] Contact information visible

### News Detail
- [ ] Click on a news item → detail page loads
- [ ] Breadcrumb shows: Beranda / Berita / Title
- [ ] Article header with date/author displays
- [ ] Featured image shows
- [ ] Full content readable
- [ ] "Kembali ke Berita" button works

### Footer
- [ ] Site name displays
- [ ] Address shows
- [ ] Phone number shows
- [ ] Email shows
- [ ] Social media links present
- [ ] Copyright year is current

### Responsive Design
- [ ] Test on mobile (< 768px)
  - [ ] Menu collapses to hamburger
  - [ ] Cards stack to 1 column
  - [ ] Text readable
  - [ ] Buttons touch-friendly
- [ ] Test on tablet (768px - 1024px)
  - [ ] Cards show 2 columns
- [ ] Test on desktop (> 1024px)
  - [ ] Cards show 3 columns
  - [ ] Layout full width

## 🔑 Admin Panel Access

- [ ] Login page accessible at `/login`
- [ ] Can login with:
  - Email: `admin@yayasan.id`
  - Password: `password`
- [ ] Admin dashboard accessible
- [ ] Can access admin panel (Filament/custom admin)

## 📝 Content Management (Optional - if using admin panel)

- [ ] Admin can view Settings
- [ ] Admin can edit Landing Sections
- [ ] Admin can create/edit Pages
- [ ] Admin can create/edit News
- [ ] Admin can manage Menus
- [ ] File uploads work

## 🎨 Visual Checks

- [ ] Colors are consistent (blue theme)
- [ ] Typography is readable
- [ ] Spacing/padding is consistent
- [ ] No broken layouts
- [ ] No overlapping elements
- [ ] All hover states work

## ⚡ Performance

- [ ] Page loads quickly (< 3s)
- [ ] Images optimized
- [ ] No console errors (F12 → Console)
- [ ] No console warnings (warnings ok, errors not ok)

## 🔍 SEO Checks

- [ ] Meta title on homepage
- [ ] Meta description on homepage
- [ ] Meta titles on all pages
- [ ] Meta descriptions on news
- [ ] Breadcrumbs present on all pages
- [ ] Semantic HTML (h1, h2, etc. in order)

## 🚀 Deployment Checklist (When ready to production)

- [ ] Update `.env` with production settings
- [ ] Set `APP_DEBUG=false`
- [ ] Set `APP_ENV=production`
- [ ] Run `php artisan config:cache`
- [ ] Run `php artisan route:cache`
- [ ] Run `php artisan view:cache`
- [ ] Setup proper SSL certificate
- [ ] Configure database backups
- [ ] Setup email configuration
- [ ] Test all forms and validations

## 📞 Support Links

- **Laravel Documentation:** https://laravel.com/docs
- **Filament Documentation:** https://filamentphp.com
- **Tailwind CSS:** https://tailwindcss.com/docs

---

## ❌ Troubleshooting

### Images not showing
```bash
php artisan storage:link
```

### Routes not working
```bash
php artisan route:clear
php artisan route:cache
```

### Database errors
```bash
php artisan migrate:fresh --seed
```

### Clear all caches
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

---

**Jika semua checklist ✅, landing page Anda siap untuk digunakan!**
