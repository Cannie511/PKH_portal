@extends('frontend.theme1.layouts.master-child')

@section('title')Về chúng tôi @stop
@section('description') Giới thiệu về Phan Khang Home, nhà phân phối độc quyền của Watertec tại Việt Nam @stop
@section('keywords')Watertec, đại lý Watertec, van nước, vòi nước @stop

@section('bodyAttr') class="all article" ng-app="pkhApp" @stop

@section('pageHead')
<style type="text/css">
  .glyphicon { margin-right:5px; }
.thumbnail
{
    margin-bottom: 20px;
    padding: 0px;
    -webkit-border-radius: 0px;
    -moz-border-radius: 0px;
    border-radius: 0px;
}

.item.list-group-item
{
    float: none;
    width: 100%;
    background-color: #b0e0e6;
    margin-bottom: 10px;
}
.item.list-group-item:nth-of-type(odd):hover,.item.list-group-item:hover
{
    background: #428bca;
}

.item.list-group-item .list-group-image
{
    margin-right: 10px;
}
.item.list-group-item .thumbnail
{
    margin-bottom: 0px;
}
.item.list-group-item .caption
{
    padding: 9px 9px 0px 9px;
}
.item.list-group-item:nth-of-type(odd)
{
    background: #eeeeee;
}

.item.list-group-item:before, .item.list-group-item:after
{
    display: table;
    content: " ";
}

.item.list-group-item img
{
    float: left;
}
.item.list-group-item:after
{
    clear: both;
}
.list-group-item-text
{
    margin: 0 0 11px;
    white-space: nowrap;
    text-overflow: ellipsis;
    max-width: 100%;
    overflow: hidden;
}
img {
    display: block;
    margin: 0 auto;
}
.sidebar-nav {
    display: block;
    float: left;
    width: 150px;
    list-style: none;
    margin: 0;
    padding: 0;
}
#sidebar_menu li a, .sidebar-nav li a {
    color: #999;
    display: block;
    float: left;
    text-decoration: none;
    width: 250px;
    background: #252525;
    border-top: 1px solid #373737;
    border-bottom: 1px solid #1A1A1A;
    -webkit-transition: background .5s;
    -moz-transition: background .5s;
    -o-transition: background .5s;
    -ms-transition: background .5s;
    transition: background .5s;
}
.sidebar_name {
    padding-top: 25px;
    color: #fff;
    opacity: .7;
}

.sidebar-nav li {
  line-height: 40px;
  text-indent: 20px;
}

.sidebar-nav li a {
  color: #999999;
  display: block;
  text-decoration: none;
}

.sidebar-nav li a:hover {
  color: #666666;
  background: rgba(255,255,255,0.2);
  text-decoration: none;
}

.sidebar-nav li a:active,
.sidebar-nav li a:focus {
  text-decoration: none;
}

.sidebar-nav > .sidebar-brand {
  height: 65px;
  line-height: 60px;
  font-size: 18px;
}

.sidebar-nav > .sidebar-brand a {
  color: #999999;
}

.sidebar-nav > .sidebar-brand a:hover {
  color: #fff;
  background: none;
}
#main_icon
{
    float:right;
   padding-right: 65px;
   padding-top:20px;
}
.sub_icon
{
    float:right;
   padding-right: 65px;
   padding-top:10px;
}
.content-header {
  height: 65px;
  line-height: 65px;
}

.content-header h1 {
  margin: 0;
  margin-left: 20px;
  line-height: 65px;
  display: inline-block;
}

[ng\:cloak],
    [ng-cloak],
    [data-ng-cloak],
    [x-ng-cloak],
    .ng-cloak,
    .x-ng-cloak {
        display: none !important;
    }

.list-group-item-heading {
    font-size: 22px;
    text-align: center;
    padding: 5px 0px;
}

.list-group-item {
    border: none;
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
 <?php
    
  ?>

<div class="container" ng-cloak ng-controller="OrderController" ng-init="initOrder()">
    <div class="main">
        <div class="row">
            <div class="col-md-12">
                <div class="moduletable   mod_breadcrumbs">
                    <div class="module_content">
                        <div class="breadcrumbs ">
                            <ol id="breadcrumb" class="breadcrumb">
                                <li><a href="/"><i class="fa fa-home"></i></a></li> 
                                <!--class="pathway"-->
                                <li class="active" >Danh sách sản phẩm</li>
                                <li class="active" > {{productTypeName}}</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- Main content area -->
                <div class="main-content">
                    <div class="page article-view article-view__">
                        <div class="page_heading article_heading">
                            <h2 class="view-item-title article_title">
                                {{productTypeName}} - GIÁ BÁN SỈ CHO ĐẠI LÝ
                                <div class="pull-right">
                                    <a class="btn btn-success" href="/gio-hang"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Giỏ hàng <span class="badge">{{cartAmount}}</span></a>
                                </div>
                            </h2>
                        </div>
                        <div class="container">
                            <div class="col-xs-3 col-lg-3">
                               <aside class="main-sidebar">
                                    <section class="sidebar">
                                       
                                        <ul class="sidebar-nav" id="sidebar">
                                            <li ng-repeat="itemCate in cateList"><a ng-click="filterProductList(itemCate.product_cat_id,itemCate.name)" href=""> {{itemCate.name}}</a></li>
                                        </ul>
                                    </section>
                                </aside>
                            </div>
                            <div class="col-xs-9 col-lg-9">
                                <div >
                                    <div class="item col-sm-12 col-xs-6 col-lg-4" ng-repeat="item in productList" ng-if="item.noImage==0&&(item.product_cat_id ==productType|| productType == 0)">
                                        <div class="thumbnail">
                                            <div class="list-group-item" >
                                                <img class="img-thumb"width="150" height="150" class="img-responsive"  src="<% env('URL_IMAGE', 'http://phankhangco.com/img/product/')%>{{item.product_code}}.png" alt="" />
                                            </div>  
                                            <div class="caption">
                                                <h4 class="group inner list-group-item-heading">
                                                {{item.product_code}} </h4>
                                                <p class="group inner list-group-item-text">
                                                    <strong>Tên :</strong>{{item.name}}</h4></p>
                                                <p class="group inner list-group-item-text">
                                                    <strong>NSX :</strong>WATERTEC</h4></p> 
                                                <!-- <p class="group inner list-group-item-text">
                                                    <strong>Giá:</strong> {{item.selling_price | currency: '' : 0}} (VND) </p> -->
                                                <div class="row">
                                                    <div class="col-xs-3 col-md-6">
                                                        <a href="/chi-tiet/{{item.product_id}}">Chi tiết...</a>
                                                        
                                                    </div>
                                                    
                                                    <div class="col-xs-12 col-md-12" style="margin-top:20px; margin-bottom:15px; text-align:center;">
                                                        <a class="btn btn-success btn-sm" ng-click="addToCart(item)">Đặt 
                                                            <span ng-if="cart.list[item.product_id]" class="badge">{{cart.list[item.product_id].amount}}</span>
                                                            <span ng-if="!cart.list[item.product_id]" class="badge">0</span>
                                                        </a>
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
    </div>
</div>

@stop


@section('pagescript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.6.5/angular.js"></script>
<script type="text/javascript" src='<% asset_url("frontend/js/order.js") %>'></script>
@stop