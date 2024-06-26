drop view if exists v_warehouse;
CREATE VIEW v_warehouse AS ( 
  select
    a.product_id
    , a.product_code
    , a.product_cat_id
    , a.stock_code
    , a.name
    , a.name_origin
    , a.color
    , a.standard_packing
    , a.selling_price
    , b.product_cat_code
    , b.name product_cat_name
    , c.supplier_code
    , c.name supplier_name
    , ( 
      d.in_num + d.in_num_edit + d.in_num_warehouse - d.out_num - d.out_num_edit - d.out_num_warehouse
    ) as amount
    , e.length * e.width * e.height / 1000000000 as volume 
  from
    mst_product a 
    left join mst_product_cat b 
      on a.product_cat_id = b.product_cat_id 
    left join mst_supplier c 
      on a.supplier_id = c.supplier_id join ( 
        select
          a.product_id
          , sum( 
            case 
              when a.warehouse_change_type in (1, 5, 6) 
                then amount 
              else 0 
              end
          ) in_num
          , sum( 
            case 
              when a.warehouse_change_type = 2 
                then amount 
              else 0 
              end
          ) out_num
          , sum( 
            case 
              when a.warehouse_change_type = 3 
                then amount 
              else 0 
              end
          ) in_num_edit
          , sum( 
            case 
              when a.warehouse_change_type = 4 
                then amount 
              else 0 
              end
          ) out_num_edit
          , sum( 
            case 
              when a.warehouse_change_type = 7 
                then amount 
              else 0 
              end
          ) in_num_warehouse
          , sum( 
            case 
              when a.warehouse_change_type = 8 
                then amount 
              else 0 
              end
          ) out_num_warehouse 
        from
          trn_warehouse_change a 
        where
          a.active_flg = '1' 
        group by
          a.product_id
      ) d 
      on a.product_id = d.product_id 
    left join mst_packaging e 
      on e.packaging_id = a.packaging_id 
  where
    a.active_flg = '1' 
    and ( 
      d.in_num + d.in_num_edit + d.in_num_warehouse - d.out_num - d.out_num_edit - d.out_num_warehouse
    ) <> 0 
  order by
    ( 
      d.in_num + d.in_num_edit + d.in_num_warehouse - d.out_num - d.out_num_edit - d.out_num_warehouse
    ) desc
);