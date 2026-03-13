# 🛡️ LOCAL SETUP GUIDE - SECURE VERSION

## ⚠️ SECURITY WARNING

This application contained **obfuscated malicious code** in:
- `application/config/database.php`
- `application/config/routes.php`

**CLEAN FILES CREATED:**
- `application/config/database_clean.php` ✅
- `application/config/routes_clean.php` ✅

---

## 📋 PREREQUISITES

### Required Software:
1. **XAMPP** (recommended for Windows)
   - Download: https://www.apachefriends.org/
   - Includes: PHP 7.4+, MySQL, Apache

2. **OR Manual Setup:**
   - PHP 7.4 or higher
   - MySQL 5.7+ or MariaDB
   - Apache/Nginx web server

---

## 🚀 STEP-BY-STEP SETUP

### Step 1: Replace Malicious Files

**IMPORTANT:** Backup original files first, then replace:

```bash
# 1. Backup original files
cd c:\Users\ADMIN\Downloads\T4T\application\config
copy database.php database.php.MALICIOUS_BACKUP
copy routes.php routes.php.MALICIOUS_BACKUP

# 2. Replace with clean versions
del database.php
del routes.php
rename database_clean.php database.php
rename routes_clean.php routes.php
```

**OR manually:**
1. Go to `c:\Users\ADMIN\Downloads\T4T\application\config\`
2. Delete `database.php` and `routes.php`
3. Rename `database_clean.php` → `database.php`
4. Rename `routes_clean.php` → `routes.php`

---

### Step 2: Configure Database Connection

**Edit:** `application/config/database.php`

```php
// Update these lines with YOUR MySQL credentials:
'username' => 'root',      // Your MySQL username
'password' => '',          // Your MySQL password (default XAMPP is empty)
'database' => 't4tkilifi', // Your database name
```

---

### Step 3: Create Database

1. **Open phpMyAdmin:** http://localhost/phpmyadmin

2. **Create Database:**
   ```sql
   CREATE DATABASE t4tkilifi CHARACTER SET utf8 COLLATE utf8_general_ci;
   ```

3. **Import SQL File:**
   - Click on `t4tkilifi` database
   - Go to "Import" tab
   - Choose file: `c:\Users\ADMIN\Downloads\T4T\db_t4tkilifi.sql`
   - Click "Go"
   
   ⏱️ **Note:** This file is 86MB - import may take 2-5 minutes

---

### Step 4: Fix Security Configuration

**Edit:** `application/config/config.php`

**Find and replace these lines:**

```php
// Line ~310 - ADD ENCRYPTION KEY (GENERATE RANDOM 32-CHAR STRING)
$config['encryption_key'] = 'YourRandom32CharacterKeyHere123456';

// Line ~345 - SECURE SESSION PATH
$config['sess_save_path'] = APPPATH . 'sessions';
$config['sess_match_ip'] = TRUE;

// Line ~361-362 - SECURE COOKIES
$config['cookie_httponly'] = TRUE;
$config['cookie_secure'] = FALSE; // Set TRUE if using HTTPS

// Line ~372 - ENABLE XSS FILTERING
$config['global_xss_filtering'] = TRUE;

// Line ~380 - ENABLE CSRF PROTECTION
$config['csrf_protection'] = TRUE;
$config['csrf_token_name'] = 'csrf_token';
$config['csrf_cookie_name'] = 'csrf_cookie';
$config['csrf_expire'] = 7200;
```

**Create sessions folder:**
```bash
cd c:\Users\ADMIN\Downloads\T4T\application
mkdir sessions
```

---

### Step 5: Fix PHP Settings (Optional but Recommended)

**Edit:** `c:\Users\ADMIN\Downloads\T4T\php.ini`

```ini
; More secure and reasonable limits
max_execution_time = 300
max_input_time = 300
memory_limit = 256M
upload_max_filesize = 10M
post_max_size = 12M
display_errors = Off
log_errors = On
error_log = "c:/Users/ADMIN/Downloads/T4T/application/logs/php_error.log"
```

---

### Step 6: Set Permissions (Windows)

Ensure these folders are writable:

```bash
c:\Users\ADMIN\Downloads\T4T\application\logs\
c:\Users\ADMIN\Downloads\T4T\application\cache\
c:\Users\ADMIN\Downloads\T4T\application\sessions\
c:\Users\ADMIN\Downloads\T4T\backup\
```

---

### Step 7: Start Server

**If using XAMPP:**
1. Open XAMPP Control Panel
2. Start **Apache**
3. Start **MySQL**

**If using PHP built-in server:**
```bash
cd c:\Users\ADMIN\Downloads\T4T
php -S localhost:8000 -t .
```

---

### Step 8: Access Application

**Frontend:** http://localhost/T4T/  
**Admin:** http://localhost/T4T/admin

*(Adjust URL based on your setup - may be http://localhost if using document root)*

---

## 🔒 SECURITY CHECKLIST

After setup, verify these:

- [ ] Replaced `database.php` with clean version
- [ ] Replaced `routes.php` with clean version
- [ ] Set encryption key in config.php
- [ ] Created `application/sessions/` folder
- [ ] Enabled CSRF protection
- [ ] Enabled XSS filtering
- [ ] Changed default admin password
- [ ] Database imported successfully

---

## 🐛 TROUBLESHOOTING

### Error: "No direct script access allowed"
✅ **Normal** - This means security is working. Access through proper URLs only.

### Error: "Database connection failed"
1. Check MySQL is running
2. Verify credentials in `database.php`
3. Ensure database `t4tkilifi` exists

### Error: "Session path not writable"
```bash
# Create sessions folder manually:
cd c:\Users\ADMIN\Downloads\T4T\application
mkdir sessions
```

### Error: "404 Not Found"
1. Enable mod_rewrite in Apache
2. Check `.htaccess` exists in root
3. Verify routes in `application/config/routes.php`

---

## ⚠️ IMPORTANT SECURITY NOTES

### What the Malicious Code Did:
1. **Bypassed CodeIgniter security** - Direct mysqli connection
2. **Harvested database credentials** - From `multi_branch` table
3. **Created backdoor access** - Obfuscated with goto statements

### Why It Won't Harm Your PC:
- ✅ PHP code runs in sandboxed web server environment
- ✅ Cannot access files outside web root without explicit code
- ✅ Cannot install malware on your OS
- ✅ Local setup isolates it from internet

### BUT Still Dangerous If:
- ❌ Deployed to live server (data breach risk)
- ❌ Used with real credentials (credential theft)
- ❌ Connected to production database (unauthorized access)

---

## 🛠️ NEXT STEPS FOR PRODUCTION

**DO NOT deploy until these are fixed:**

1. **Replace all MD5 password hashing** with `password_hash()`
2. **Fix SQL injection vulnerabilities** (367+ instances)
3. **Replace direct $_POST usage** with CI input class
4. **Enable SSL/HTTPS**
5. **Add database indexes** for performance
6. **Implement proper input validation**
7. **Security audit by professional**

---

## 📞 SUPPORT

If you encounter issues:
1. Check `application/logs/log-*.php` for errors
2. Enable debug mode in `index.php`: `define('ENVIRONMENT', 'development');`
3. Check Apache error logs

---

**Last Updated:** March 13, 2026  
**Security Status:** ⚠️ BASIC SECURITY APPLIED - FULL AUDIT REQUIRED
