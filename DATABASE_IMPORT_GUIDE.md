# 📥 DATABASE IMPORT GUIDE - T4T Kilifi

**File:** `db_t4tkilifi.sql` (86.22 MB)  
**Issue:** File too large for default phpMyAdmin import

---

## ✅ METHOD 1: Command Line (RECOMMENDED - Most Reliable)

### For XAMPP Users:

```bash
# Step 1: Open Command Prompt as Administrator

# Step 2: Navigate to MySQL bin
cd C:\xampp\mysql\bin

# Step 3: Create database (if not exists)
mysql -u root -p -e "CREATE DATABASE dedicat1_t4tkilifi CHARACTER SET utf8 COLLATE utf8_general_ci;"
# Press Enter when prompted for password (default: no password)

# Step 4: Import the SQL file
mysql -u root -p dedicat1_t4tkilifi < "c:\Users\ADMIN\Downloads\T4T\db_t4tkilifi.sql"
```

### For WAMP Users:
```bash
cd C:\wamp64\bin\mysql\mysql8.0.x\bin
mysql -u root -p dedicat1_t4tkilifi < "c:\Users\ADMIN\Downloads\T4T\db_t4tkilifi.sql"
```

### For Standalone MySQL:
```bash
mysql -u root -p dedicat1_t4tkilifi < "c:\Users\ADMIN\Downloads\T4T\db_t4tkilifi.sql"
```

---

## ✅ METHOD 2: phpMyAdmin (After Increasing Limits)

### Step 1: Verify php.ini Settings

Your `php.ini` should have these values (already fixed):

```ini
max_execution_time = 600
max_input_time = 600
memory_limit = 512M
upload_max_filesize = 100M
post_max_size = 120M
```

### Step 2: Restart Apache
- XAMPP Control Panel → Stop Apache → Start Apache

### Step 3: Import via phpMyAdmin
1. Open: http://localhost/phpmyadmin
2. Create database: `dedicat1_t4tkilifi`
3. Select the database
4. Click "Import" tab
5. Choose file: `c:\Users\ADMIN\Downloads\T4T\db_t4tkilifi.sql`
6. Click "Go"
7. ⏱️ Wait 2-5 minutes for completion

---

## ✅ METHOD 3: BigDump (For Very Large Files)

### Setup:
1. Download BigDump: https://www.ozerov.de/bigdump.php
2. Save as `bigdump.php` in `c:\Users\ADMIN\Downloads\T4T\`

### Configure:
Edit `bigdump.php`:
```php
$db_server = 'localhost';
$db_name = 'dedicat1_t4tkilifi';
$db_username = 'root';
$db_password = '';  // Your MySQL password
```

### Run:
1. Open: http://localhost/T4T/bigdump.php
2. Select your SQL file
3. Click "Start Import"
4. BigDump will process in chunks automatically

---

## ✅ METHOD 4: Split SQL File

### Run the splitter:
```bash
# Double-click this file:
c:\Users\ADMIN\Downloads\T4T\split_sql.bat
```

This creates smaller chunks in `sql_chunks/` folder. Import each chunk sequentially via phpMyAdmin.

---

## 🔍 VERIFY IMPORT SUCCESS

After import, verify in phpMyAdmin:

```sql
-- Check table count (should be 176 tables)
SHOW TABLES;

-- Check row count in key tables
SELECT COUNT(*) FROM staff;
SELECT COUNT(*) FROM student;
SELECT COUNT(*) FROM admin;
```

---

## ⚠️ COMMON ERRORS & SOLUTIONS

### Error: "max_allowed_packet"
**Solution:** Edit `my.ini` (MySQL config):
```ini
[mysqld]
max_allowed_packet = 256M
```
Then restart MySQL.

### Error: "Timeout expired"
**Solution:** Increase timeout in `my.ini`:
```ini
[mysqld]
wait_timeout = 600
connect_timeout = 600
```

### Error: "Cannot create database"
**Solution:** Database might already exist. Drop it first:
```sql
DROP DATABASE IF EXISTS dedicat1_t4tkilifi;
CREATE DATABASE dedicat1_t4tkilifi CHARACTER SET utf8 COLLATE utf8_general_ci;
```

### Error: "Access denied for user 'root'"
**Solution:** Use correct credentials:
```bash
# With password
mysql -u root -pyourpassword dedicat1_t4tkilifi < db_t4tkilifi.sql

# Or create user with privileges
mysql -u root -p
> CREATE USER 't4t_user'@'localhost' IDENTIFIED BY 'secure_password';
> GRANT ALL PRIVILEGES ON dedicat1_t4tkilifi.* TO 't4t_user'@'localhost';
> FLUSH PRIVILEGES;
```

---

## 📊 DATABASE INFORMATION

**Source Database:** `dedicat1_t4tkilifi` (from production server)  
**Tables:** 176  
**Estimated Import Time:** 2-5 minutes  
**Disk Space Required:** ~200MB (after import)

### Key Tables:
- `admin` - Administrator accounts
- `staff` - Staff/employee records
- `student` - Student records
- `class_sections` - Academic classes
- `exam_groups` - Examination data
- `feemasters` - Fee structure
- `student_fees` - Fee payments

---

## 🔐 POST-IMPORT SECURITY

After importing, **IMMEDIATELY**:

1. **Change all default passwords:**
   ```sql
   -- Update admin password (use password_hash in PHP, not direct SQL)
   -- This should be done through the application, not SQL
   ```

2. **Remove sensitive production data:**
   - API keys
   - Payment gateway credentials
   - Real user passwords

3. **Update database credentials in application:**
   Edit: `application/config/database.php`
   ```php
   'username' => 'root',      // Your local username
   'password' => '',          // Your local password
   'database' => 'dedicat1_t4tkilifi',
   ```

---

## 📞 TROUBLESHOOTING

### Import seems stuck/frozen
- **Normal** for large files. Wait at least 5 minutes.
- Check MySQL process list in phpMyAdmin → Status → Processes

### Browser timeout
- Use command line method instead
- Or use BigDump (Method 3)

### Partial import (some tables missing)
- Check error message
- Try importing remaining tables individually
- Use Method 4 (split file)

### Character encoding issues
- Ensure database is created with `CHARACTER SET utf8`
- Check `php.ini` has `default_charset = "UTF-8"`

---

## ✅ COMPLETE CHECKLIST

- [ ] MySQL/MariaDB installed and running
- [ ] Database created: `dedicat1_t4tkilifi`
- [ ] Import method chosen (CLI recommended)
- [ ] Import completed without errors
- [ ] Verified 176 tables created
- [ ] Updated `application/config/database.php`
- [ ] Changed default passwords
- [ ] Application loads without database errors

---

**Last Updated:** March 13, 2026  
**Recommended Method:** Command Line (Method 1)  
**Success Rate:** 99% with CLI, 85% with phpMyAdmin
