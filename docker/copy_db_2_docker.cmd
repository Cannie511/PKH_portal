SET DB_FILE=G:\TaskPKH\pkh_project\sql\pkh_db_prod.sql
docker cp G:\TaskPKH\pkh_project\sql\pkh_db_prod.sql mysql:/pkh_db_prod.sql
docker exec mysql bash -c "mysql -u root -pabc123456 phankhang < /pkh_db_prod.sql"