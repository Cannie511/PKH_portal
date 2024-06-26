@echo off
setlocal

SET APP_PATH="C:\Users\phucu\.vscode\extensions\kokororin.vscode-phpfmt-1.0.30\node_modules\phpfmt\fmt.phar"
SET CONFIG_FILE="E:\workspace\phankhang\pkh_src\pkh_web\phpfmt.ini"
SET PHP_EXE="D:\xampp\php\php.exe"
SET PHP_FMT_CMD=%PHP_EXE% %APP_PATH% --psr2 --config=%CONFIG_FILE% --no-backup

REM php "C:\Users\phucu\.vscode\extensions\kokororin.vscode-phpfmt-1.0.30\node_modules\phpfmt\fmt.phar" --psr2 --config="D:\Working\2017\PhanKhang\pkh_src\pkh_web\phpfmt.ini" --no-backup 

REM %PHP_FMT_CMD% ./app/Console
REM %PHP_FMT_CMD% ./app/Events
REM %PHP_FMT_CMD% ./app/Exceptions
REM %PHP_FMT_CMD% ./app/Helpers
REM %PHP_FMT_CMD% ./app/Http/Controllers/Mobile
REM %PHP_FMT_CMD% ./app/Http/Controllers
REM %PHP_FMT_CMD% ./app/Http/Middleware
REM %PHP_FMT_CMD% ./app/Http/Requests
REM %PHP_FMT_CMD% ./app/Services/Mobile
REM %PHP_FMT_CMD% ./app/Models
REM %PHP_FMT_CMD% ./app/Services

%PHP_FMT_CMD% ./app/Http
%PHP_FMT_CMD% ./app/Services

endlocal