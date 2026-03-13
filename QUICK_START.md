# 🚀 T4T KILIFI - QUICK START GUIDE

**Last Updated:** March 13, 2026  
**Status:** ✅ Security fixes applied, ready for local setup

---

## ⚡ FASTEST SETUP (3 Steps)

### Step 1: Import Database (One Click)
```bash
# Double-click this file:
c:\Users\ADMIN\Downloads\T4T\import_database.bat
```

**OR** manually via command line:
```bash
cd C:\xampp\mysql\bin
mysql -u root -e "CREATE DATABASE dedicat1_t4tkilifi CHARACTER SET utf8 COLLATE utf8_general_ci;"
mysql -u root dedicat1_t4tkilifi < "c:\Users\ADMIN\Downloads\T4T\db_t4tkilifi.sql"
```

### Step 2: Start XAMPP
- Open XAMPP Control Panel
- Start **Apache** ✓
- Start **MySQL** ✓

### Step 3: Access Application
- **Frontend:** http://localhost/T4T/
- **Admin:** http://localhost/T4T/admin

---

## 📋 DETAILED SETUP

### Prerequisites
- ✅ XAMPP installed (or WAMP/MAMP)
- ✅ PHP 7.4+ available
- ✅ MySQL/MariaDB available

### 1. Database Setup

**Option A: Automated (Recommended)**
```bash
# Run the import script
c:\Users\ADMIN\Downloads\T4T\import_database.bat
```

**Option B: Manual Command Line**
```bash
# Open Command Prompt
cd C:\xampp\mysql\bin

# Create database
mysql -u root -e "CREATE DATABASE dedicat1_t4tkilifi CHARACTER SET utf8 COLLATE utf8_general_ci;"

# Import SQL
mysql -u root dedicat1_t4tkilifi < "c:\Users\ADMIN\Downloads\T4T\db_t4tkilifi.sql"
```

**Option C: phpMyAdmin**
1. Open http://localhost/phpmyadmin
2. Create database: `dedicat1_t4tkilifi`
3. Import file: `db_t4tkilifi.sql`
4. ⏱️ Wait 2-5 minutes

### 2. Configuration (Already Done ✅)

These files have been cleaned and secured:
- ✅ `application/config/database.php` - Malicious code removed
- ✅ `application/config/routes.php` - Obfuscated code removed
- ✅ `application/config/config.php` - Security hardened
- ✅ `php.ini` - Resource limits fixed
- ✅ `.htaccess` - Security headers added
- ✅ `application/sessions/` - Secure session folder created

### 3. Verify Setup

**Check database:**
```bash
mysql -u root -e "USE dedicat1_t4tkilifi; SHOW TABLES;"
```
Should show 176 tables.

**Check application:**
- Visit: http://localhost/T4T/
- Should see homepage without errors

---

## 🔐 DEFAULT CREDENTIALS

**⚠️ CHANGE THESE IMMEDIATELY AFTER FIRST LOGIN!**

Database:
- Host: `localhost`
- Username: `root`
- Password: `` (empty)
- Database: `dedicat1_t4tkilifi`

Application Admin:
- Check your imported database for default admin credentials
- Usually found in `admin` table

---

## 🛡️ SECURITY STATUS

### ✅ Fixed (March 13, 2026)
- [x] Malicious backdoor removed from config files
- [x] Encryption key set
- [x] CSRF protection enabled
- [x] Session security hardened
- [x] XSS filtering enabled
- [x] Cookie security improved
- [x] PHP resource limits fixed
- [x] Security headers added

### ⚠️ Remaining (Before Production)
- [ ] Fix 367+ SQL injection vulnerabilities
- [ ] Replace MD5 password hashing
- [ ] Fix direct $_POST usage
- [ ] Enable SSL/HTTPS
- [ ] Professional security audit

**Status:** ✅ Safe for local development, ❌ NOT ready for production

---

## 📁 FILES CREATED/MODIFIED

| File | Status | Purpose |
|------|--------|---------|
| `application/config/database.php` | ✅ Replaced | Clean DB config |
| `application/config/routes.php` | ✅ Replaced | Clean routes |
| `application/config/config.php` | ✅ Modified | Security hardening |
| `php.ini` | ✅ Modified | Resource limits |
| `.htaccess` | ✅ Created | Security & routing |
| `import_database.bat` | ✅ Created | Auto import script |
| `split_sql.bat` | ✅ Created | SQL splitter |
| `application/sessions/` | ✅ Created | Session storage |
| `SETUP_GUIDE.md` | ✅ Created | Setup docs |
| `DATABASE_IMPORT_GUIDE.md` | ✅ Created | Import help |
| `SECURITY_FIXES_APPLIED.md` | ✅ Created | Security report |
| `QUICK_START.md` | ✅ Created | This file |

---

## 🐛 TROUBLESHOOTING

### Database Import Fails
**Error:** "max_allowed_packet" or timeout
```bash
# Use BigDump method instead
# See DATABASE_IMPORT_GUIDE.md Method 3
```

### Application Shows Error Page
**Check:** 
1. Database imported successfully?
2. `application/config/database.php` has correct credentials?
3. Apache and MySQL running?

### "No direct script access allowed"
✅ **Normal** - This is security working. Access via proper URLs only.

### Session Errors
```bash
# Ensure folder exists and is writable
mkdir c:\Users\ADMIN\Downloads\T4T\application\sessions
```

### 404 Errors
- Check `.htaccess` exists in root
- Enable mod_rewrite in Apache
- Verify URL: http://localhost/T4T/ (not http://localhost/)

---

## 📞 SUPPORT FILES

For detailed help, see:
- **Setup Issues:** `SETUP_GUIDE.md`
- ** Database Import:** `DATABASE_IMPORT_GUIDE.md`
- **Security Details:** `SECURITY_FIXES_APPLIED.md`

---

## ✅ SETUP CHECKLIST

- [ ] XAMPP installed and running
- [ ] Database `dedicat1_t4tkilifi` created
- [ ] SQL file imported (176 tables)
- [ ] Apache running
- [ ] MySQL running
- [ ] Application loads at http://localhost/T4T/
- [ ] No errors in browser console
- [ ] Can access admin panel
- [ ] Changed default passwords

---

## 🎯 NEXT STEPS

1. **Import database** using `import_database.bat`
2. **Start XAMPP** (Apache + MySQL)
3. **Test application** at http://localhost/T4T/
4. **Change default passwords**
5. **Review security fixes** in `SECURITY_FIXES_APPLIED.md`

---

**Need Help?**  
Check the detailed guides or review error logs in:
- `application/logs/log-*.php`
- XAMPP Apache error log
- XAMPP MySQL error log

---

**Setup Time:** 5-10 minutes  
**Difficulty:** Easy  
**Security Status:** ⚠️ Local Dev Only
