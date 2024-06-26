select * from trn_supplier_delivery
select * from trn_supplier_delivery_detail

-- 
select * from mst_product where product_code = 'WT002N-6QUVCTR-1';

select * from  trn_supplier_delivery where supplier_delivery_id = 11;
select * from trn_supplier_delivery_detail where supplier_delivery_id = 11;
select sum(amount * price) total, sum(amount * price_vi) total_vi from trn_supplier_delivery_detail where supplier_delivery_id = 11;

select * from  trn_supplier_delivery where supplier_delivery_id = 12;
select * from trn_supplier_delivery_detail where supplier_delivery_id = 12;
select sum(amount * price) total, sum(amount * price_vi) total_vi from trn_supplier_delivery_detail where supplier_delivery_id = 12;

select * from trn_supplier_delivery_detail where supplier_delivery_id in (11,12)   and product_id = 28

--

update trn_supplier_order_detail set amount = 0 where supplier_order_id = 11 and product_id = 57;
update trn_supplier_delivery_detail set amount = 0 where supplier_delivery_id = 11 and product_id = 57;
update trn_warehouse_change set amount = 0 where supplier_delivery_id = 11 and product_id = 57;
update trn_supplier_delivery set total = (
select sum(amount * price ) total from trn_supplier_delivery_detail where supplier_delivery_id = 11
)  where supplier_delivery_id = 11 ;
update trn_supplier_delivery set total_vi = (
select sum(amount * price_vi ) total from trn_supplier_delivery_detail where supplier_delivery_id = 11
)  where supplier_delivery_id = 11 ;

update trn_supplier_order_detail set amount = 13000 where supplier_order_id = 12 and product_id = 16;
update trn_supplier_delivery_detail set amount = 13000 where supplier_delivery_id = 12 and product_id = 16;
update trn_warehouse_change set amount = 13000 where supplier_delivery_id = 12 and product_id = 16;
update trn_supplier_delivery set total = (
select sum(amount * price ) total from trn_supplier_delivery_detail where supplier_delivery_id = 16
)  where supplier_delivery_id = 16 ;
update trn_supplier_delivery set total_vi = (
select sum(amount * price_vi ) total from trn_supplier_delivery_detail where supplier_delivery_id = 16
)  where supplier_delivery_id = 16 ;

update trn_supplier_order_detail set amount = 1150 where supplier_order_id = 12 and product_id = 26;
update trn_supplier_delivery_detail set amount = 1150 where supplier_delivery_id = 12 and product_id = 26;
update trn_warehouse_change set amount = 1150 where supplier_delivery_id = 12 and product_id = 26;
update trn_supplier_delivery set total = (
select sum(amount * price ) total from trn_supplier_delivery_detail where supplier_delivery_id = 26
)  where supplier_delivery_id = 26 ;
update trn_supplier_delivery set total_vi = (
select sum(amount * price_vi ) total from trn_supplier_delivery_detail where supplier_delivery_id = 26
)  where supplier_delivery_id = 26 ;

update trn_supplier_order_detail set amount = 2400 where supplier_order_id = 12 and product_id = 28;
update trn_supplier_delivery_detail set amount = 2400 where supplier_delivery_id = 12 and product_id = 28;
update trn_warehouse_change set amount = 2400 where supplier_delivery_id = 12 and product_id = 28;
update trn_supplier_delivery set total = (
select sum(amount * price ) total from trn_supplier_delivery_detail where supplier_delivery_id = 28
)  where supplier_delivery_id = 28 ;
update trn_supplier_delivery set total_vi = (
select sum(amount * price_vi ) total from trn_supplier_delivery_detail where supplier_delivery_id = 28
)  where supplier_delivery_id = 28 ;


update trn_supplier_delivery set total = (
select sum(amount * price ) total from trn_supplier_delivery_detail where supplier_delivery_id = 12
)  where supplier_delivery_id = 12 ;
update trn_supplier_delivery set total_vi = (
select sum(amount * price_vi ) total from trn_supplier_delivery_detail where supplier_delivery_id = 12
)  where supplier_delivery_id = 12 ;

update trn_supplier_delivery set total = (
select sum(amount * price ) total from trn_supplier_delivery_detail where supplier_delivery_id = 11
)  where supplier_delivery_id = 11 ;
update trn_supplier_delivery set total_vi = (
select sum(amount * price_vi ) total from trn_supplier_delivery_detail where supplier_delivery_id = 11
)  where supplier_delivery_id = 11 ;


select
  a.product_id
  , b.product_code
  , sum(a.amount) 
from
  trn_supplier_delivery_detail a 
  join mst_product b 
    on a.product_id = b.product_id 
where
  a.supplier_delivery_id in (11, 12) 
  and product_code = 'WT002L-6BKB3TR-3'
group by
  a.product_id
  , b.product_code
  
  
  select  * from trn_delivery
