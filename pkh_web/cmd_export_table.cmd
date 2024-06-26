@echo off
setlocal

REM SELECT concat('%DIR_SQL%\\mysqldump --no-create-info -u root -p123456 phankhang ', TABLE_NAME, ' > database\\seeds\\sql\\data\\', TABLE_NAME, '.sql') REM FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'phankhang' and TABLE_NAME not in ('migrations', 'password_resets', 'permission_role', 'permission_user', 'permissions', 'role_user', 'roles', 'users', 'mst_cd', 'mst_func_conf');

REM SELECT concat('type database\\seeds\\sql\\data\\', TABLE_NAME , '.sql | find /v "Dump completed on"', ' > database\\seeds\\sql\\data\\', TABLE_NAME, '.sql') REM FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'phankhang' and TABLE_NAME not in ('migrations', 'trn_supplier_delivery1', 'trn_supplier_delivery_detail1', 'trn_supplier_order1', 'trn_supplier_order_detail1', 'mst_news', 'password_resets', 'permission_role', 'permission_user', 'permissions', 'role_user', 'roles', 'users', 'mst_cd', 'mst_func_conf', 'mst_news');

SET DIR_SQL=D:\Dev\WebServer\xampp7\mysql\bin

REM
%DIR_SQL%\mysqldump --no-create-info -u root -p123456 phankhang mst_area > database\seeds\sql\data\mst_area.sql
%DIR_SQL%\mysqldump --no-create-info -u root -p123456 phankhang mst_area_group > database\seeds\sql\data\mst_area_group.sql
%DIR_SQL%\mysqldump --no-create-info -u root -p123456 phankhang mst_bank_account > database\seeds\sql\data\mst_bank_account.sql
%DIR_SQL%\mysqldump --no-create-info -u root -p123456 phankhang mst_dealer > database\seeds\sql\data\mst_dealer.sql
%DIR_SQL%\mysqldump --no-create-info -u root -p123456 phankhang mst_delivery_vendor > database\seeds\sql\data\mst_delivery_vendor.sql
%DIR_SQL%\mysqldump --no-create-info -u root -p123456 phankhang mst_gift > database\seeds\sql\data\mst_gift.sql
%DIR_SQL%\mysqldump --no-create-info -u root -p123456 phankhang mst_news > database\seeds\sql\data\mst_news.sql
%DIR_SQL%\mysqldump --no-create-info -u root -p123456 phankhang mst_packaging > database\seeds\sql\data\mst_packaging.sql
%DIR_SQL%\mysqldump --no-create-info -u root -p123456 phankhang mst_product > database\seeds\sql\data\mst_product.sql
%DIR_SQL%\mysqldump --no-create-info -u root -p123456 phankhang mst_product2 > database\seeds\sql\data\mst_product2.sql
%DIR_SQL%\mysqldump --no-create-info -u root -p123456 phankhang mst_product_cat > database\seeds\sql\data\mst_product_cat.sql
%DIR_SQL%\mysqldump --no-create-info -u root -p123456 phankhang mst_product_series > database\seeds\sql\data\mst_product_series.sql
%DIR_SQL%\mysqldump --no-create-info -u root -p123456 phankhang mst_promotion > database\seeds\sql\data\mst_promotion.sql
%DIR_SQL%\mysqldump --no-create-info -u root -p123456 phankhang mst_store > database\seeds\sql\data\mst_store.sql
%DIR_SQL%\mysqldump --no-create-info -u root -p123456 phankhang mst_supplier > database\seeds\sql\data\mst_supplier.sql
%DIR_SQL%\mysqldump --no-create-info -u root -p123456 phankhang mst_warehouse > database\seeds\sql\data\mst_warehouse.sql
%DIR_SQL%\mysqldump --no-create-info -u root -p123456 phankhang mst_warehouse_block > database\seeds\sql\data\mst_warehouse_block.sql
%DIR_SQL%\mysqldump --no-create-info -u root -p123456 phankhang mst_warehouse_block_lot > database\seeds\sql\data\mst_warehouse_block_lot.sql
%DIR_SQL%\mysqldump --no-create-info -u root -p123456 phankhang mst_warehouse_lot > database\seeds\sql\data\mst_warehouse_lot.sql
%DIR_SQL%\mysqldump --no-create-info -u root -p123456 phankhang mst_warehouse_product > database\seeds\sql\data\mst_warehouse_product.sql
%DIR_SQL%\mysqldump --no-create-info -u root -p123456 phankhang trn_absent > database\seeds\sql\data\trn_absent.sql
%DIR_SQL%\mysqldump --no-create-info -u root -p123456 phankhang trn_absent_setting > database\seeds\sql\data\trn_absent_setting.sql
%DIR_SQL%\mysqldump --no-create-info -u root -p123456 phankhang trn_audit_log > database\seeds\sql\data\trn_audit_log.sql
%DIR_SQL%\mysqldump --no-create-info -u root -p123456 phankhang trn_check_warehouse > database\seeds\sql\data\trn_check_warehouse.sql
%DIR_SQL%\mysqldump --no-create-info -u root -p123456 phankhang trn_check_warehouse_detail > database\seeds\sql\data\trn_check_warehouse_detail.sql
%DIR_SQL%\mysqldump --no-create-info -u root -p123456 phankhang trn_delivery > database\seeds\sql\data\trn_delivery.sql
%DIR_SQL%\mysqldump --no-create-info -u root -p123456 phankhang trn_delivery_detail > database\seeds\sql\data\trn_delivery_detail.sql
%DIR_SQL%\mysqldump --no-create-info -u root -p123456 phankhang trn_display_price_table > database\seeds\sql\data\trn_display_price_table.sql
%DIR_SQL%\mysqldump --no-create-info -u root -p123456 phankhang trn_etest > database\seeds\sql\data\trn_etest.sql
%DIR_SQL%\mysqldump --no-create-info -u root -p123456 phankhang trn_etest_assign > database\seeds\sql\data\trn_etest_assign.sql
%DIR_SQL%\mysqldump --no-create-info -u root -p123456 phankhang trn_etest_result > database\seeds\sql\data\trn_etest_result.sql
%DIR_SQL%\mysqldump --no-create-info -u root -p123456 phankhang trn_etest_sentence > database\seeds\sql\data\trn_etest_sentence.sql
%DIR_SQL%\mysqldump --no-create-info -u root -p123456 phankhang trn_gift_use > database\seeds\sql\data\trn_gift_use.sql
%DIR_SQL%\mysqldump --no-create-info -u root -p123456 phankhang trn_import_wh_factory > database\seeds\sql\data\trn_import_wh_factory.sql
%DIR_SQL%\mysqldump --no-create-info -u root -p123456 phankhang trn_import_wh_store > database\seeds\sql\data\trn_import_wh_store.sql
%DIR_SQL%\mysqldump --no-create-info -u root -p123456 phankhang trn_import_wh_store_detail > database\seeds\sql\data\trn_import_wh_store_detail.sql
%DIR_SQL%\mysqldump --no-create-info -u root -p123456 phankhang trn_order_edit_request > database\seeds\sql\data\trn_order_edit_request.sql
%DIR_SQL%\mysqldump --no-create-info -u root -p123456 phankhang trn_payment > database\seeds\sql\data\trn_payment.sql
%DIR_SQL%\mysqldump --no-create-info -u root -p123456 phankhang trn_product_price_his > database\seeds\sql\data\trn_product_price_his.sql
%DIR_SQL%\mysqldump --no-create-info -u root -p123456 phankhang trn_salesman_store > database\seeds\sql\data\trn_salesman_store.sql
%DIR_SQL%\mysqldump --no-create-info -u root -p123456 phankhang trn_store > database\seeds\sql\data\trn_store.sql
%DIR_SQL%\mysqldump --no-create-info -u root -p123456 phankhang trn_store_delivery > database\seeds\sql\data\trn_store_delivery.sql
%DIR_SQL%\mysqldump --no-create-info -u root -p123456 phankhang trn_store_delivery_detail > database\seeds\sql\data\trn_store_delivery_detail.sql
%DIR_SQL%\mysqldump --no-create-info -u root -p123456 phankhang trn_store_order > database\seeds\sql\data\trn_store_order.sql
%DIR_SQL%\mysqldump --no-create-info -u root -p123456 phankhang trn_store_order_detail > database\seeds\sql\data\trn_store_order_detail.sql
%DIR_SQL%\mysqldump --no-create-info -u root -p123456 phankhang trn_store_rank > database\seeds\sql\data\trn_store_rank.sql
%DIR_SQL%\mysqldump --no-create-info -u root -p123456 phankhang trn_store_working > database\seeds\sql\data\trn_store_working.sql
%DIR_SQL%\mysqldump --no-create-info -u root -p123456 phankhang trn_supplier_delivery > database\seeds\sql\data\trn_supplier_delivery.sql
%DIR_SQL%\mysqldump --no-create-info -u root -p123456 phankhang trn_supplier_delivery_detail > database\seeds\sql\data\trn_supplier_delivery_detail.sql
%DIR_SQL%\mysqldump --no-create-info -u root -p123456 phankhang trn_supplier_order > database\seeds\sql\data\trn_supplier_order.sql
%DIR_SQL%\mysqldump --no-create-info -u root -p123456 phankhang trn_supplier_order_detail > database\seeds\sql\data\trn_supplier_order_detail.sql
%DIR_SQL%\mysqldump --no-create-info -u root -p123456 phankhang trn_warehouse_change > database\seeds\sql\data\trn_warehouse_change.sql
%DIR_SQL%\mysqldump --no-create-info -u root -p123456 phankhang trn_wh_product_time > database\seeds\sql\data\trn_wh_product_time.sql
%DIR_SQL%\mysqldump --no-create-info -u root -p123456 phankhang trn_working_img > database\seeds\sql\data\trn_working_img.sql


endlocal