@echo off
setlocal

cls

:SHOW_MENU

echo.
echo *-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*
echo *                   PKH Dev Menu                      *
echo *-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*
echo.

echo # Development
echo   1. Start web (cmd_web_start.cmd)
echo   2. Reset DB (cmd_db_reset.cmd)
echo   3. Copy tool generate (cmd_cp_pkg.cmd)
echo   4. Clear cache (cmd_clear_cache.cmd)
echo.
echo # Deploy
echo   A. Export Roles (cmd_export_roles.cmd)
echo   B. Clear cache (cmd_clear_cache.cmd)
echo   C. Build for deploy (cmd_deploy.cmd)
echo   X. Exit
echo.

set /P FUNC= Choose Function= 

echo %FUNC%

if [%FUNC%] == [1] (
    goto RUN_1
) 

if [%FUNC%] == [2] (
    goto RUN_2
)

if [%FUNC%] == [3] (
    goto RUN_3
)

if [%FUNC%] == [4] (
    goto RUN_4
)

if [%FUNC%] == [A] (
    goto RUN_A
)

if [%FUNC%] == [a] (
    goto RUN_A
)

if [%FUNC%] == [X] (
    goto END
)

if [%FUNC%] == [x] (
    goto END
)

:RUN_1
call cmd_web_start.cmd
goto :SHOW_MENU

:RUN_2
call cmd_db_reset.cmd
goto :SHOW_MENU

:RUN_3
call cmd_cp_pkg.cmd
goto :SHOW_MENU

:RUN_4
call cmd_clear_cache.cmd.cm
goto :SHOW_MENU

:END
echo Bye!

endlocal