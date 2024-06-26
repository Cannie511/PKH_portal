@extends('frontend.theme2.layouts.master')

@section('title')Phan Khang Ho Co., Ltd @stop
@section('description') Trang chủ chính thức của Phan Khang Home, nhà phân phối độc quyền của Watertec tại Việt Nam @stop
@section('keywords')Watertec, đại lý Watertec, van nước, vòi nước @stop

@section('bodyAttr') class="home featured" @stop

@section('pageHead')
@stop

@section('content') 

@include('frontend.theme2.partials.slider')

<div class="container mt-10">
    <div class="row">
        <div class="col-sm">
            <?php if( !empty($cms_home_marquee)): ?>
                <marquee>
                    <p style="font-size:16px; color: red;font-weight: bolder;"><% $cms_home_marquee %></p>
                </marquee>
            <?php endif; ?>
        </div>
    </div>
</div>
            
@include('frontend.theme2.partials.list-categories')

@include('frontend.theme2.partials.list-top-product', ["listProducts" => $listProductNew, "title" => "SẢN PHẨM MỚI"])

@include('frontend.theme2.partials.about-us')

<div class="container mt-10">
    <div class="row">
        <div class="col-sm">
            <?php if( !empty($cms_home_marquee_2)): ?>
                <marquee>
                    <p style="font-size:16px; color: red;font-weight: bolder;"><% $cms_home_marquee_2 %></p>
                </marquee>
            <?php endif; ?>
        </div>
    </div>
</div>

@include('frontend.theme2.partials.list-top-product', ["listProducts" => $listProductSales, "title" => "SẢN PHẨM BÁN CHẠY"])

@include('frontend.theme2.partials.home-news')

@stop