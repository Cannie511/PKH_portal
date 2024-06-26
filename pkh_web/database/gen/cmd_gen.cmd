@echo off
setlocal

SET ANT_HOME=D:\soft\java\apache-ant-1.10.8
SET ANT_LIB=%ANT_HOME%\lib
SET ANT_DIR=%ANT_HOME%\bin
SET JAVACMD=C:\Program Files\Java\jdk1.8.0_251\bin\java
REM SET JAVACMD=java
SET GEN_DIR=temp\tpl-laravel-admin
SET DEST_DIR=..\..\app

REM %ANT_DIR%\ant --help
call %ANT_DIR%\ant -lib "%ANT_LIB%;lib\**.*" -f gen-laravel-admin.xml

del %GEN_DIR%\App\Models\PasswordResets.php /F /S /Q
del %GEN_DIR%\App\Models\PermissionRole.php /F /S /Q
del %GEN_DIR%\App\Models\Permissions.php /F /S /Q
del %GEN_DIR%\App\Models\PermissionUser.php /F /S /Q
del %GEN_DIR%\App\Models\Roles.php /F /S /Q
del %GEN_DIR%\App\Models\RoleUser.php /F /S /Q
del %GEN_DIR%\App\Models\Users.php /F /S /Q

xcopy %GEN_DIR%\App\Models %DEST_DIR%\Models /E /C /I /R /Y /Q

del %GEN_DIR%\App\Models\*.php /F /S /Q
rmdir %GEN_DIR%
rd %GEN_DIR%
rd null

endlocal