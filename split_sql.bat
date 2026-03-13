@echo off
REM SQL File Splitter for Large Imports
REM This splits the large SQL file into smaller 10MB chunks

setlocal enabledelayedexpansion

set "INPUT_FILE=c:\Users\ADMIN\Downloads\T4T\db_t4tkilifi.sql"
set "OUTPUT_DIR=c:\Users\ADMIN\Downloads\T4T\sql_chunks"
set "LINES_PER_FILE=5000"

if not exist "%OUTPUT_DIR%" mkdir "%OUTPUT_DIR%"

echo Splitting large SQL file...
powershell -Command "$content = Get-Content '%INPUT_FILE%'; $i = 0; $chunk = 0; $outFile = '%OUTPUT_DIR%\chunk_001.sql'; Get-Content '%INPUT_FILE%' | ForEach-Object { if ($i %% $LINES_PER_FILE -eq 0 -and $i -gt 0) { $chunk++; $outFile = '%OUTPUT_DIR%\chunk_{0:D3}.sql' -f $chunk }; Add-Content $outFile $_; $i++ }"

echo Done! Files created in %OUTPUT_DIR%
echo Import each chunk sequentially into phpMyAdmin
pause
