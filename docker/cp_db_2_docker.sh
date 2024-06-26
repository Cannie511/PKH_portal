docker cp "G:\TaskPKH\pkh_db_prod.sql" mysql:/pkh_db_prod.sql
docker exec -it mysql bash
#  mysql -u user -p laviedecor2 < /pkh_db_prod.sql 
mysql -u root -p phankhang < /pkh_db_prod.sql