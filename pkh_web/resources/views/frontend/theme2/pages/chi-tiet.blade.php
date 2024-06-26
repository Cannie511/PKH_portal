@extends('frontend.theme1.layouts.master-child')

@section('title')Về chúng tôi @stop
@section('description') Giới thiệu về Phan Khang Home, nhà phân phối độc quyền của Watertec tại Việt Nam @stop
@section('keywords')Watertec, đại lý Watertec, van nước, vòi nước @stop

@section('bodyAttr') class="all article" ng-app="pkhApp" @stop

@section('pageHead')
<style type="text/css">
    ul > li{margin-right:25px;font-weight:lighter;cursor:pointer}
li.active{border-bottom:3px solid silver;}

.item-photo{display:flex;justify-content:center;align-items:center;border-right:1px solid #f6f6f6;}
.menu-items{list-style-type:none;font-size:11px;display:inline-flex;margin-bottom:0;margin-top:20px}
.btn-success{width:100%;border-radius:0;}
.section{width:100%;margin-left:-15px;padding:2px;padding-left:15px;padding-right:15px;background:#f8f9f9}
.title-price{margin-top:30px;margin-bottom:0;color:black}
.title-attr{margin-top:0;margin-bottom:0;color:black;}
.btn-minus{cursor:pointer;font-size:7px;display:flex;align-items:center;padding:5px;padding-left:10px;padding-right:10px;border:1px solid gray;border-radius:2px;border-right:0;}
.btn-plus{cursor:pointer;font-size:7px;display:flex;align-items:center;padding:5px;padding-left:10px;padding-right:10px;border:1px solid gray;border-radius:2px;border-left:0;}
div.section > div {width:100%;display:inline-flex;}
div.section > div > input {margin:0;padding-left:5px;font-size:10px;padding-right:5px;max-width:18%;text-align:center;}
.attr,.attr2{cursor:pointer;margin-right:5px;height:20px;font-size:10px;padding:2px;border:1px solid gray;border-radius:2px;}
.attr.active,.attr2.active{ border:1px solid orange;}

@media (max-width: 426px) {
    .container {margin-top:0px !important;}
    .container > .row{padding:0 !important;}
    .container > .row > .col-xs-12.col-sm-5{
        padding-right:0 ;    
    }
    .container > .row > .col-xs-12.col-sm-9 > div > p{
        padding-left:0 !important;
        padding-right:0 !important;
    }
    .container > .row > .col-xs-12.col-sm-9 > div > ul{
        padding-left:10px !important;
        
    }            
    .section{width:104%;}
    .menu-items{padding-left:0;}
}
</style>
<script  type="text/javascript">
    jQuery.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });
   
</script>
@stop

@section('content')

<div class="container" ng-cloak ng-controller="DetailController"  ng-init="">
    <div class="main">
        <div class="row">
            <div class="col-md-12">
                <div class="moduletable   mod_breadcrumbs">
                    <div class="module_content">
                        <div class="breadcrumbs ">
                            <ol id="breadcrumb" class="breadcrumb">
                                <li><a href="/"><i class="fa fa-home"></i></a></li> 
                                <!--class="pathway"-->
                                <li ><a href="/dat-hang">Đặt hàng</a></li>
                                <li >Chi tiết sản phẩm</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- Main content area -->
                <div class="main-content">
                    <div class="page article-view article-view__">
                        <div class="page_heading article_heading">
                            <h2 class="view-item-title article_title">
                                CHI TIẾT SẢN PHẨM 
                                
                            </h2>
                        </div>
                        <div class="container">
                            <div class="box-body" >
                                  <div class="container">
        	<div class="row">
               <div class="col-xs-4 item-photo">
                    <img style="max-width:100%;" src="<% env('URL_IMAGE', 'http://phankhangco.com/img/product/')%><?php echo $product->product_code; ?>.png" />
                </div>
                <div class="col-xs-5" style="border:0px solid gray">
                    <!-- Datos del vendedor y titulo del producto -->
                    <h3><?php echo $product->product_code ?></h3>    
                    <h5><span><b>Tên :</b></span><?php echo $product->name ?></h5> 
                    <h5><span><b>Nhà sản xuất :</b></span>WATERTEC</h5>    
                    <h5><span><b>Xuất xứ :</b></span>Malaysia</h5>
                    <h5><span><b>Màu sắc :</b></span><?php echo $product->color ?></h5>
                    <h5><span><b>Đóng gói :</b></span><?php echo $product->standard_packing ?> (cái/thùng)</h5>
                  
                    <!-- <h3 style="margin-top:0px;"> <?php echo number_format($product->selling_price,2) ?> (VND)</h3> -->
        
                    <!-- Detalles especificos del producto -->
                  
                    <div class="section" style="padding-bottom:20px;">
                        <h6 class="title-attr"><small>Số lượng</small></h6>                    
                        <div>
                            <div class="btn-minus"><span class="glyphicon glyphicon-minus"></span></div>
                            <input value="1" />
                            <div class="btn-plus"><span class="glyphicon glyphicon-plus"></span></div>
                        </div>
                    </div>                
        
                    <!-- Botones de compra -->
                    <!--div class="section" style="padding-bottom:20px;">
                        <button ng-click="addToCart(<?php echo $product->product_id ?>)" class="btn btn-success"><span style="margin-right:20px" class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> ĐẶT HÀNG</button>
                    </div-->                                        
                </div>                              
        
                <div class="col-xs-9">
                    <ul class="menu-items">
                        <li class="active">Thông tin chi tiết</li>
                    </ul>
                    <div style="width:100%;border-top:1px solid silver">
                        <!--p style="padding:15px;">
                            <h5>
                            Stay connected either on the phone or the Web with the Galaxy S4 I337 from Samsung. With 16 GB of memory and a 4G connection, this phone stores precious photos and video and lets you upload them to a cloud or social network at blinding-fast speed. With a 17-hour operating life from one charge, this phone allows you keep in touch even on the go. 
        
                            With its built-in photo editor, the Galaxy S4 allows you to edit photos with the touch of a finger, eliminating extraneous background items. Usable with most carriers, this smartphone is the perfect companion for work or entertainment.
                            </h5>
                        </p-->
                        <small>
                           
                        </small>
                    </div>
                </div>		
            </div>
        </div>        
                            </div>
                                                 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop


@section('pagescript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.6.5/angular.js"></script>
<script type="text/javascript" src='<% asset_url("frontend/js/detail.js") %>'></script>
@stop