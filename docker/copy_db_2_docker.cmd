
@REM SET DB_FILE=E:\workspace\phankhang\pkh-backup\database\pkh_db_prod.sql
SET DB_FILE=G:\TaskPKH\
docker cp %DB_FILE% mysql:/pkh_db_prod.sql
docker exec mysql bash -c "mysql -u user -p abc123456 phankhang < /pkh_db_prod.sql" 