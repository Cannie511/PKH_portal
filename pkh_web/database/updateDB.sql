-- Thiết lập ngày có order đầu tiên cho cửa hàng
update mst_store a
, ( 
  select
    a.store_id
    , min(a.order_date) first_date 
  from
    trn_store_order a 
  group by
    a.store_id
) b 
set
  a.first_order = b.first_date 
where
  a.store_id = b.store_id;


-- Xếp loại đại lý

insert 
into trn_store_rank( 
  store_id
  , year
  , month
  , store_rank
  , order_total
  , order_total_with_discount
  , delivery_total
  , delivery_total_with_discount
  , payment
  , active_flg
  , created_at
  , created_by
  , updated_at
  , updated_by
  , version_no
) 
select
  temp.store_id
  , temp.year
  , temp.month
  , temp.store_rank
  , temp.order_total
  , temp.order_total_with_discount
  , temp.delivery_total
  , temp.delivery_total_with_discount
  , temp.payment
  , '1'
  , now()
  , 1
  , now()
  , 1
  , 1 
from
  ( 
    select
      a.store_id
      , a.year
      , a.month
      , case 
        when sum(a.order_total) >= 100000000 
        then 1 
        when sum(a.order_total) >= 50000000 
        then 2 
        when sum(a.order_total) >= 10000000 
        then 3 
        when sum(a.order_total) >= 1000000 
        then 4 
        else 5 
        end as store_rank
      , sum(a.order_total) order_total
      , sum(a.order_total_with_discount) order_total_with_discount
      , sum(a.delivery_total) delivery_total
      , sum(a.delivery_total_with_discount) delivery_total_with_discount
      , sum(a.payment) payment 
    from
      ( 
        select
          a.store_id
          , year (a.order_date) as year
          , month (a.order_date) as month
          , sum(a.total) as order_total
          , sum(a.total_with_discount) as order_total_with_discount
          , 0 as delivery_total
          , 0 as delivery_total_with_discount
          , 0 as payment 
        from
          trn_store_order a 
        group by
          a.store_id
          , year (a.order_date)
          , month (a.order_date) 
        union all 
        select
          b.store_id
          , year (a.delivery_date) as year
          , month (a.delivery_date) as month
          , 0 as order_total
          , 0 as order_total_with_discount
          , sum(a.total) as delivery_total
          , sum(a.total_with_discount) as delivery_total_with_discount
          , 0 as payment 
        from
          trn_store_delivery a 
          left join trn_store_order b 
            on a.store_order_id = b.store_order_id 
        group by
          b.store_id
          , year (a.delivery_date)
          , month (a.delivery_date)
      ) a 
    group by
      a.store_id
      , a.year
      , a.month
  ) temp;

-- Tim ngay nhap hang ton
select
  a.changed_date
  , case a.warehouse_change_type 
    when 1 then 'Xuat' 
    else 'Nhap' 
    end as type
  , a.product_id
  , b.product_code
  , a.amount 
from
  trn_warehouse_change a 
  left join mst_product b 
    on a.product_id = b.product_id 
order by
  a.changed_date
  , a.warehouse_change_type
  , b.product_code

-- Update gia hang cu
select
  b.store_order_id
  , b.store_order_code
  , b.store_id
  , c.name
  , b.discount_1
  , b.discount_2
  , b.order_date
  , b.total
  , b.total_with_discount
  , b.order_sts
  , b.notes
  , a.seq_no
  , a.product_id
  , d.product_code
  , a.amount
  , a.unit_price 
from
  trn_store_order_detail a 
  left join trn_store_order b 
    on b.store_order_id = a.store_order_id 
  left join mst_store c 
    on c.store_id = b.store_id 
  left join mst_product d 
    on d.product_id = a.product_id 
where
  b.store_order_code in ( 
    'ORD1705-014A-0000KF'
    , 'ORD1705-014G-0000KE'
    , 'ORD1705-01E0-0000KG'
    , 'ORD1705-01C9-0000KD'
    , 'ORD1705-0112-0000KJ'
    , 'ORD1705-01D6-0000KH'
    , 'ORD1706-0112-0000M8'
  ) 
order by
  b.store_order_id
  , a.seq_no


-- Xuat danh sach xuat don hang
select
  c.store_id
  , c.name
  , c.address
  , b.store_order_code
  , a.store_delivery_id
  , a.delivery_date
  , a.discount_1
  , a.discount_2
  , a.total
  , a.total_with_discount
  , a.delivery_sts
from
  trn_store_delivery a 
  left join trn_store_order b 
    on a.store_order_id = b.store_order_id 
  left join mst_store c 
    on b.store_id = c.store_id 
where
  a.delivery_sts in (0, 1, 4)
order by store_id, delivery_date

-- Cua hang da mua

select
  h.name area_group
  , f.name area1
  , g.name area2
  , e.name
  , e.address
  , c.store_order_code
  , c.order_date
  , b.delivery_date
  , a.store_delivery_id
  , a.product_id
  , d.product_code
  , d.name
  , a.seq_no
  , a.amount
  , a.unit_price
  , b.delivery_sts 
from
  trn_store_delivery_detail a join trn_store_delivery b 
    on b.store_delivery_id = a.store_delivery_id 
  left join trn_store_order c 
    on c.store_order_id = b.store_order_id 
  left join mst_product d 
    on d.product_id = a.product_id 
  left join mst_store e 
    on e.store_id = c.store_id 
  left join mst_area f 
    on f.area_id = e.area1 
  left join mst_area g 
    on g.area_id = e.area2 
  left join mst_area_group h 
    on h.area_group_id = f.area_group_id 
where
  b.delivery_sts in (0, 1, 2, 3, 4) 
order by
  c.order_date
  , b.delivery_date
  , c.store_order_code
  , a.seq_no
;

-- Cua hang chua mua
select
  a.store_id
  , a.name store_name
  , a.address
  , b.product_id
  , b.product_code
  , b.name product_name 
from
  ( 
    select
      * 
    from
      mst_store 
    where
      store_id in (select store_id from trn_store_order)
  ) a join ( 
    select
      * 
    from
      mst_product 
    where
      selling_price > 0
  ) b 
where
  (a.store_id, b.product_id) not in ( 
    select
      b.store_id
      , a.product_id 
    from
      trn_store_order_detail a join trn_store_order b 
        on a.store_order_id = b.store_order_id
  ) 


-- Add warehouse - 4
insert 
into trn_warehouse_change( 
  warehouse_change_type
  , product_id
  , changed_date
  , amount
  , supplier_delivery_id
  , store_delivery_id
  , description
  , active_flg
  , created_at
  , created_by
  , updated_at
  , updated_by
  , version_no
) value (
	4
  , (select product_id from mst_product where product_code = 'WT001M-6VIVHTR-6' limit 1)
  , '2017-04-30'
  , 199
  , 1
  , null
  , null
  , 1
  , now()
  , 1
  , now()
  , 1
  , 1)

-- Add warehouse + 3
insert 
into trn_warehouse_change( 
  warehouse_change_type
  , product_id
  , changed_date
  , amount
  , supplier_delivery_id
  , store_delivery_id
  , description
  , active_flg
  , created_at
  , created_by
  , updated_at
  , updated_by
  , version_no
) value (
	3
  , (select product_id from mst_product where product_code = 'WT001M-6VIVHTR-6' limit 1)
  , '2017-04-30'
  , 1
  , 1
  , null
  , null
  , 1
  , now()
  , 1
  , now()
  , 1
  , 1)

-- Select from PI
select
  1 warehouse_change_type
  , product_id
  , '2017-08-19' changed_date
  , amount
  , supplier_delivery_id
  , null store_delivery_id
  , null description
  , 1 active_flg
  , now() created_at
  , 1 created_by
  , now() updated_at
  , 1 updated_by
  , 1 version_no 
from
  trn_supplier_delivery_detail 
where
  supplier_delivery_id = 16

-- Batch
BAT0100 --month=2016-11
BAT0100 --month=2016-12
BAT0100 --month=2017-01
BAT0100 --month=2017-02
BAT0100 --month=2017-03
BAT0100 --month=2017-04
BAT0100 --month=2017-05
BAT0100 --month=2017-06
BAT0100 --month=2017-07
BAT0100 --month=2017-08
BAT0100 --month=2017-09
BAT0100 --month=2017-10

-- Nhập cửa hàng
update trn_store_order set store_id = 1513 where store_id = 1404;
update trn_store_delivery set store_id = 1513 where store_id = 1404;
update trn_payment set store_id = 1513 where store_id = 1404;
update mst_store set active_flg = '0' where store_id = 1404;

-- Kiểm tra đơn hàng
select
  a.store_order_id
  , a.store_order_code
  , a.store_id
  , c.name
  , a.active_flg
  , a.total
  , a.total_with_discount
  , b.total as total_detail
  , ( 
    b.total * (100 - a.discount_1 - a.discount_2) / 100
  ) as total_detail_with_discount 
from
  trn_store_order a 
  left join ( 
    select
      b.store_order_id
      , sum(b.amount * b.unit_price) as total 
    from
      trn_store_order_detail b 
    group by
      store_order_id
  ) b 
    on a.store_order_id = b.store_order_id 
  left join mst_store c 
    on a.store_id = c.store_id 
where
  a.total < 10




