@echo off
setlocal

SET DIR_SQL=D:\Dev\WebServer\xampp7\mysql\bin
SET DB_NAME=phankhang2

REM

echo -- Truncate > database\roles.sql
echo delete from permission_role; >> database\roles.sql
REM echo delete from permission_user; > database\roles.sql
REM echo delete from role_user; > database\roles.sql
REM echo delete from roles; > database\roles.sql
echo delete from permissions; >> database\roles.sql
echo.

REM %DIR_SQL%\mysqldump --no-create-info -u root -p123456 phankhang roles >> database\roles.sql
REM %DIR_SQL%\mysqldump --no-create-info -u root -p123456 phankhang role_user >> database\roles.sql

%DIR_SQL%\mysqldump --no-create-info -u root -p123456 %DB_NAME% permissions >> database\roles.sql
%DIR_SQL%\mysqldump --no-create-info -u root -p123456 %DB_NAME% permission_role >> database\roles.sql
REM %DIR_SQL%\mysqldump --no-create-info -u root -p123456 phankhang permission_user >> database\roles.sql

endlocal