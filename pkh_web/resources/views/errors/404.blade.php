@extends('frontend.theme2.layouts.master')

@section('title')Đại lý @stop
@section('description') Giới thiệu về Phan Khang Home, nhà phân phối độc quyền của Watertec tại Việt Nam @stop
@section('keywords')Watertec, đại lý Watertec, van nước, vòi nước @stop

@section('bodyAttr') class="all article" @stop

@section('pageHead')
<style type="text/css">
</style>
@stop

@section('content')

<div class="container">
    <div class="row">

        <div class="col-md-12">
            <div class="moduletable   mod_breadcrumbs">
                <div class="module_content">
                    <div class="breadcrumbs ">
                        <ol id="breadcrumb" class="breadcrumb">
                            <li><a href="/"><i class="fa fa-home"></i></a></li> 
                            <!--class="pathway"-->
                            <li class="active">Lỗi</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md">
            <div class="jumbotron" style="background-color: #fff">
                <h1 class="display-4">404</h1>
                <p class="lead">Trang này không tồn tại. Vui lòng kiểm tra lại đường dẫn.</p>
                <hr class="my-4">
                <!-- <p>It uses utility classes for typography and spacing to space content out within the larger container.</p> -->
                <a class="btn btn-info btn-lg" href="#" role="button">Trở về trang chủ</a>
            </div>
        </div>

    </div>
</div>

@stop