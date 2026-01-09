# Panduan Hosting TaskFlow

## 🚀 Setup untuk Hosting dengan Index di Root

### Struktur Folder yang Sudah Disiapkan:
```
todo_app/
├── index.php              # ✅ Entry point baru (root)
├── .htaccess              # ✅ Konfigurasi URL routing
├── app/                  # Logic aplikasi
├── public/                # Assets (CSS, JS, images)
├── database/              # Database files
└── screenshots/           # Dokumentasi
```

### 📋 Langkah-Langkah Hosting:

#### 1. Upload Files
- Upload seluruh folder `todo_app` ke hosting
- Pastikan struktur folder tetap terjaga

#### 2. Konfigurasi Database
```sql
-- Import database melalui phpMyAdmin
-- Gunakan file: database/todo_app.sql
```

#### 3. Update Konfigurasi Database
Edit file `app/config/Config.php`:
```php
<?php
// Database Configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'nama_database_hosting');
define('DB_USER', 'username_database');
define('DB_PASS', 'password_database');

// Application Configuration
define('BASE_URL', 'https://domain-anda.com');
define('APP_NAME', 'TaskFlow');
define('APP_VERSION', '1.0.0');
```

#### 4. Set Permissions (Linux Hosting)
```bash
chmod 755 todo_app/
chmod 755 todo_app/app/
chmod 644 todo_app/app/config/Config.php
chmod 755 todo_app/public/
chmod 644 todo_app/public/css/
chmod 644 todo_app/public/js/
```

#### 5. Testing Akses
- Buka: `https://domain-anda.com/`
- Akan langsung mengarah ke halaman login TaskFlow

---

## 🔧 Konfigurasi yang Telah Disesuaikan:

### ✅ index.php (Root Level)
- Path relatif ke folder app (tanpa `../`)
- Autoloader yang sudah disesuaikan
- Session management yang aman

### ✅ .htaccess (Root Level)
- URL routing ke index.php
- Security headers untuk proteksi
- Block akses ke folder sensitif (`app/`, `database/`, `tests/`)
- Hide sensitive files

---

## 🌐 URL Structure Setelah Hosting:

### **Base URL**: `https://domain-anda.com/`
- **Login**: `https://domain-anda.com/auth`
- **Dashboard**: `https://domain-anda.com/task`
- **Admin**: `https://domain-anda.com/user`
- **Registrasi**: `https://domain-anda.com/auth/register`

### **Static Assets**:
- **CSS**: `https://domain-anda.com/public/css/style.css`
- **JS**: `https://domain-anda.com/public/js/main.js`
- **Images**: `https://domain-anda.com/public/images/`

---

## 🔒 Security Features:

### ✅ Proteksi Folder:
- `app/` - Blocked direct access
- `database/` - Blocked direct access
- `tests/` - Blocked direct access
- Config files - Hidden dari public

### ✅ Security Headers:
- X-Frame-Options: SAMEORIGIN
- X-Content-Type-Options: nosniff
- X-XSS-Protection: 1; mode=block
- Referrer-Policy: strict-origin-when-cross-origin

---

## 🛠 Troubleshooting Hosting:

### **Error 404/500**:
1. Pastikan mod_rewrite aktif
2. Check file permissions
3. Verify .htaccess configuration

### **Database Connection Error**:
1. Check database credentials
2. Verify database exists
3. Check MySQL server status

### **Blank Page**:
1. Check PHP error logs
2. Verify file paths
3. Check session settings

---

## 📱 Mobile & SEO Setup:

### ✅ Responsive Design:
- Bootstrap 5 grid system
- Mobile-first approach
- Touch-friendly interface

### ✅ SEO Friendly:
- Semantic HTML5 structure
- Proper meta tags
- Clean URL structure

---

## 🚀 Ready for Production!

Project TaskFlow Anda sudah siap untuk hosting dengan:
- ✅ Index di root folder
- ✅ Security terintegrasi
- ✅ URL structure yang clean
- ✅ Mobile responsive
- ✅ SEO optimized

**Selamat menghosting project TaskFlow Anda!** 🎉
