# 🔧 FIX: "Not Found" Error for http://localhost/T4T/

## ❌ THE PROBLEM

Your T4T folder is at:
```
c:\Users\ADMIN\Downloads\T4T\
```

But **XAMPP serves files ONLY from**:
```
C:\xampp\htdocs\
```

So `http://localhost/T4T/` looks for files in `C:\xampp\htdocs\T4T\` which doesn't exist!

---

## ✅ SOLUTION (Choose One)

### **OPTION 1: Copy T4T to XAMPP htdocs (RECOMMENDED)**

#### **Easy Way - Run the Script:**
```bash
# Double-click this file:
c:\Users\ADMIN\Downloads\T4T\setup_xampp.bat
```

This automatically:
1. Finds XAMPP installation
2. Copies T4T to `C:\xampp\htdocs\T4T\`
3. Creates required folders
4. Sets up configuration

#### **Manual Way:**
```bash
# 1. Copy the entire T4T folder
# From: c:\Users\ADMIN\Downloads\T4T\
# To:   C:\xampp\htdocs\T4T\

# 2. Or use Command Prompt:
xcopy /E /I /Y "c:\Users\ADMIN\Downloads\T4T" "C:\xampp\htdocs\T4T"
```

#### **Then:**
1. Start XAMPP Apache
2. Visit: http://localhost/T4T/ ✅

---

### **OPTION 2: Access Directly from Downloads (NOT Recommended)**

You can access it directly, but the URL will be long:

```
http://localhost:8080/?c:\Users\ADMIN\Downloads\T4T\index.php
```

**OR** use PHP built-in server:

```bash
# Open Command Prompt in T4T folder
cd c:\Users\ADMIN\Downloads\T4T

# Start PHP server
php -S localhost:8000

# Access at:
http://localhost:8000/
```

---

### **OPTION 3: Create Virtual Host (Advanced)**

**Edit:** `C:\xampp\apache\conf\extra\httpd-vhosts.conf`

**Add:**
```apache
<VirtualHost *:80>
    DocumentRoot "c:/Users/ADMIN/Downloads/T4T"
    ServerName t4t.local
    <Directory "c:/Users/ADMIN/Downloads/T4T">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

**Edit:** `C:\Windows\System32\drivers\etc\hosts` (as Administrator)

**Add:**
```
127.0.0.1 t4t.local
```

**Restart Apache**, then access:
```
http://t4t.local/
```

---

## 🎯 RECOMMENDED: OPTION 1

### **Step-by-Step:**

1. **Stop Apache** in XAMPP Control Panel (if running)

2. **Copy Files:**
   ```bash
   # Method A: Use the setup script
   c:\Users\ADMIN\Downloads\T4T\setup_xampp.bat
   
   # Method B: Manual copy-paste in File Explorer
   # Copy: c:\Users\ADMIN\Downloads\T4T
   # Paste: C:\xampp\htdocs\T4T
   ```

3. **Verify folder exists:**
   ```
   C:\xampp\htdocs\T4T\index.php  ← Should exist
   ```

4. **Start Apache** in XAMPP Control Panel

5. **Access:**
   - Frontend: http://localhost/T4T/
   - Admin: http://localhost/T4T/admin

---

## 🔍 VERIFY XAMPP INSTALLATION

### **Check if XAMPP is installed:**
```bash
# Check these locations:
C:\xampp\
C:\wamp64\
```

### **If XAMPP is NOT installed:**
1. Download: https://www.apachefriends.org/
2. Install to: `C:\xampp\`
3. Start Apache + MySQL
4. Run `setup_xampp.bat`

---

## 📁 FOLDER STRUCTURE (After Copy)

```
C:\xampp\htdocs\T4T\
├── index.php              ← Main entry point
├── application\
│   ├── config\
│   │   ├── database.php   ← DB config
│   │   ├── config.php     ← App config
│   │   └── routes.php     ← URL routes
│   ├── controllers\
│   ├── models\
│   ├── views\
│   └── sessions\          ← Created by setup script
├── system\
├── db_t4tkilifi.sql
└── .htaccess
```

---

## 🐛 TROUBLESHOOTING

### Still getting "Not Found"?

**Check 1:** Is Apache running?
- Open XAMPP Control Panel
- Apache should show **green "Running"**

**Check 2:** Is T4T in correct folder?
```bash
# This file should exist:
C:\xampp\htdocs\T4T\index.php
```

**Check 3:** Is port 80 available?
- Skype/other apps may use port 80
- Try: http://localhost:8080/T4T/

**Check 4:** Check Apache error log
```
C:\xampp\apache\logs\error.log
```

### "Index of /" instead of application?
- `.htaccess` file missing or not working
- Enable mod_rewrite in Apache config

### Blank white page?
- Database not imported
- Check `application/logs/log-*.php` for errors

---

## ✅ COMPLETE SETUP CHECKLIST

- [ ] XAMPP installed at `C:\xampp\`
- [ ] T4T copied to `C:\xampp\htdocs\T4T\`
- [ ] Apache running in XAMPP
- [ ] MySQL running in XAMPP
- [ ] Database `dedicat1_t4tkilifi` created
- [ ] SQL file imported
- [ ] `application/config/database.php` configured
- [ ] http://localhost/T4T/ loads without errors

---

## 🎯 QUICK COMMANDS

```bash
# Copy T4T to htdocs
xcopy /E /I /Y "c:\Users\ADMIN\Downloads\T4T" "C:\xampp\htdocs\T4T"

# Start Apache (if you have XAMPP CLI)
C:\xampp\xampp-control.exe

# Import database
cd C:\xampp\mysql\bin
mysql -u root dedicat1_t4tkilifi < "C:\xampp\htdocs\T4T\db_t4tkilifi.sql"
```

---

**After copying to htdocs, your URLs will work:**
- ✅ http://localhost/T4T/
- ✅ http://localhost/T4T/admin
- ✅ http://localhost/T4T/frontend

---

**Last Updated:** March 13, 2026
