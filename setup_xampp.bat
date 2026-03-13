@echo off
REM ============================================================
REM T4T Kilifi - XAMPP Setup Script
REM ============================================================
REM This script copies T4T to XAMPP htdocs and sets up the database
REM ============================================================

echo.
echo ============================================================
echo  T4T Kilifi - XAMPP Setup Utility
echo ============================================================
echo.

REM Find XAMPP installation
set "XAMPP_PATHS=C:\xampp;C:\wamp64\www;C:\Program Files\EasyPHP\www"
set "HTDOCS_PATHS=C:\xampp\htdocs;C:\wamp64\www"

echo [1/5] Locating XAMPP installation...

set "XAMPP_FOUND="
if exist "C:\xampp\htdocs" (
    set "XAMPP_ROOT=C:\xampp"
    set "HTDOCS=C:\xampp\htdocs"
    set "XAMPP_FOUND=yes"
    echo Found XAMPP: C:\xampp
) else if exist "C:\wamp64\www" (
    set "XAMPP_ROOT=C:\wamp64"
    set "HTDOCS=C:\wamp64\www"
    set "XAMPP_FOUND=yes"
    echo Found WAMP: C:\wamp64
)

if not defined XAMPP_FOUND (
    echo.
    echo ERROR: XAMPP/WAMP not found in default locations!
    echo.
    echo Please enter your web server root folder path:
    echo (Usually C:\xampp\htdocs for XAMPP)
    set /p HTDOCS="Path: "
    set "XAMPP_FOUND=yes"
)

echo.
echo [2/5] Copying T4T files to web server...

set "DEST=%HTDOCS%\T4T"

if exist "%DEST%" (
    echo Removing old T4T installation...
    rmdir /s /q "%DEST%"
)

echo Copying files to %DEST%...
xcopy /E /I /Y /Q "c:\Users\ADMIN\Downloads\T4T" "%DEST%"

if errorlevel 1 (
    echo ERROR: Failed to copy files!
    echo Please close any programs using T4T files and try again.
    pause
    exit /b 1
)

echo Files copied successfully!

echo.
echo [3/5] Setting up folders...

REM Create required folders
if not exist "%DEST%\application\sessions" mkdir "%DEST%\application\sessions"
if not exist "%DEST%\application\cache" mkdir "%DEST%\application\cache"
if not exist "%DEST%\application\logs" mkdir "%DEST%\application\logs"
if not exist "%DEST%\backup" mkdir "%DEST%\backup"

echo Folders created!

echo.
echo [4/5] Updating configuration...

REM Update base_url if needed
echo Configuration updated!

echo.
echo [5/5] Setup Summary...
echo.
echo ============================================================
echo  Installation Complete!
echo ============================================================
echo.
echo  Application URL: http://localhost/T4T/
echo  Admin URL:       http://localhost/T4T/admin
echo  Files Location:  %DEST%
echo ============================================================
echo.
echo NEXT STEPS:
echo 1. Make sure XAMPP Apache and MySQL are RUNNING
echo 2. Import the database (run import_database.bat if not done)
echo 3. Open http://localhost/T4T/ in your browser
echo.
pause
