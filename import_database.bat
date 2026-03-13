@echo off
REM ============================================================
REM T4T Kilifi - Quick Database Import Script
REM ============================================================
REM This script imports the database using MySQL command line
REM ============================================================

echo.
echo ============================================================
echo  T4T Kilifi School Management System
echo  Database Import Utility
echo ============================================================
echo.

REM Configuration
set MYSQL_USER=root
set MYSQL_PASS=
set MYSQL_HOST=localhost
set DB_NAME=dedicat1_t4tkilifi
set SQL_FILE=c:\Users\ADMIN\Downloads\T4T\db_t4tkilifi.sql

REM Find MySQL installation
set MYSQL_PATHS=C:\xampp\mysql\bin;C:\wamp64\bin\mysql\mysql8.0.x\bin;C:\Program Files\MySQL\MySQL Server 8.0\bin;C:\Program Files\MariaDB 10.11\bin

echo [1/4] Locating MySQL installation...
set "MYSQL_FOUND="
for %%p in (%MYSQL_PATHS%) do (
    if exist "%%p\mysql.exe" (
        set "MYSQL_BIN=%%p\mysql.exe"
        set "MYSQL_FOUND=yes"
        echo Found MySQL: !MYSQL_BIN!
        goto :found
    )
)

:found
if not defined MYSQL_BIN (
    echo ERROR: MySQL not found in common locations!
    echo.
    echo Please manually enter the path to mysql.exe:
    set /p MYSQL_BIN="Path: "
)

echo.
echo [2/4] Creating database...
if "%MYSQL_PASS%"=="" (
    "%MYSQL_BIN%" -u %MYSQL_USER% -h %MYSQL_HOST% -e "DROP DATABASE IF EXISTS %DB_NAME%;"
    "%MYSQL_BIN%" -u %MYSQL_USER% -h %MYSQL_HOST% -e "CREATE DATABASE %DB_NAME% CHARACTER SET utf8 COLLATE utf8_general_ci;"
) else (
    "%MYSQL_BIN%" -u %MYSQL_USER% -p%MYSQL_PASS% -h %MYSQL_HOST% -e "DROP DATABASE IF EXISTS %DB_NAME%;"
    "%MYSQL_BIN%" -u %MYSQL_USER% -p%MYSQL_PASS% -h %MYSQL_HOST% -e "CREATE DATABASE %DB_NAME% CHARACTER SET utf8 COLLATE utf8_general_ci;"
)

if errorlevel 1 (
    echo ERROR: Failed to create database!
    echo Please check if MySQL is running and credentials are correct.
    pause
    exit /b 1
)
echo Database created successfully!

echo.
echo [3/4] Importing SQL file (this may take 2-5 minutes)...
echo File: %SQL_FILE%
echo.

if "%MYSQL_PASS%"=="" (
    "%MYSQL_BIN%" -u %MYSQL_USER% -h %MYSQL_HOST% %DB_NAME% < "%SQL_FILE%"
) else (
    "%MYSQL_BIN%" -u %MYSQL_USER% -p%MYSQL_PASS% -h %MYSQL_HOST% %DB_NAME% < "%SQL_FILE%"
)

if errorlevel 1 (
    echo.
    echo ERROR: Import failed!
    echo Possible solutions:
    echo 1. Increase max_allowed_packet in my.ini
    echo 2. Use BigDump method (see DATABASE_IMPORT_GUIDE.md)
    echo 3. Split the SQL file using split_sql.bat
    pause
    exit /b 1
)

echo.
echo [4/4] Verifying import...
if "%MYSQL_PASS%"=="" (
    for /f "tokens=1" %%i in ('"%MYSQL_BIN%" -u %MYSQL_USER% -h %MYSQL_HOST% -N -e "SELECT COUNT(*) FROM information_schema.tables WHERE table_schema='%DB_NAME%';" %DB_NAME%') do set TABLE_COUNT=%%i
) else (
    for /f "tokens=1" %%i in ('"%MYSQL_BIN%" -u %MYSQL_USER% -p%MYSQL_PASS% -h %MYSQL_HOST% -N -e "SELECT COUNT(*) FROM information_schema.tables WHERE table_schema='%DB_NAME%';" %DB_NAME%') do set TABLE_COUNT=%%i
)

echo.
echo ============================================================
echo  Import Completed Successfully!
echo ============================================================
echo  Database: %DB_NAME%
echo  Tables imported: %TABLE_COUNT%
echo ============================================================
echo.
echo Next Steps:
echo 1. Update application/config/database.php with your credentials
echo 2. Change default admin password
echo 3. Access application at: http://localhost/T4T/
echo.
pause
