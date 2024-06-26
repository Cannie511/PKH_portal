@extends('frontend.theme2.layouts.master')

@section('title')Đại lý @stop
@section('description') Giới thiệu về Phan Khang Home, nhà phân phối độc quyền của Watertec tại Việt Nam @stop
@section('keywords')Watertec, đại lý Watertec, van nước, vòi nước @stop

@section('bodyAttr') class="all article" @stop

@section('pageHead')
<style type="text/css">
    .order-info .form-group {
        margin-bottom: 0px;
    }
    .image-product {
        max-width: 100px;
        max-height: 100px;
    }
    .col-form-label {
        font-weight: bold;
    }
    @media only screen and (max-width: 480px) {
        .btn-kiemtra {
            margin-top: 1rem;
            width: 100%;
        }
    }
</style>
@stop

@section('content')

@include('frontend.theme2.partials.slider')

<div class="container">
    <div class="main">
        <div class="row">
            <div class="col-md-12">
                <div class="moduletable   mod_breadcrumbs">
                    <div class="module_content">
                        <div class="breadcrumbs ">
                            <ol id="breadcrumb" class="breadcrumb">
                                <li><a href="/"><i class="fa fa-home"></i></a></li> 
                                <!--class="pathway"-->
                                <li class="active">Tình trạng đơn hàng</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- Main content area -->
                <div class="main-content">
                    <div class="page article-view article-view__">
                        <!-- <div class="page_heading article_heading">
                            <h2 class="view-item-title article_title">
                                Tình trạng đơn hàng
                            </h2>
                        </div> -->
                        <div class="article_text">
                            <div class="row area">
                                <div class="col-md-12">

                                    <form style="width: 100%" action="/don-hang" method="GET">
                                        <div class="row mb-3">
                                            <label for="orderId" class="col-md-2 col-sm-12 col-form-label text-right" style="max-width:130px">Mã đơn hàng</label>
                                            <div class="col-md-4 col-sm-12">
                                                <input type="text" class="form-control" id="orderId" name="orderId">
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <button type="submit" class="btn btn-primary btn-kiemtra">Kiểm tra</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <?php if (isset($orderId)):?>
                        <div class="article_text">
                            <div class="row area">
                            <?php if (isset($error)):?>
                                <div class="col-md-12">
                                    <div class="alert alert-danger" role="alert">
                                        <?php echo $error; ?>
                                    </div>
                                </div>
                            <?php else:?>
                                <div class="col-md-12 order-info">
                                    <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-3 col-form-label">Mã đơn: </label>
                                        <div class="col-sm-9">
                                            <span class="form-control-plaintext"><?php echo $delivery->store_delivery_code;?></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-3 col-form-label">Khách hàng: </label>
                                        <div class="col-sm-9">
                                            <span class="form-control-plaintext"><?php echo $delivery->name;?></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-3 col-form-label">Ngày giao: </label>
                                        <div class="col-sm-9">
                                            <span class="form-control-plaintext"><?php echo $delivery->delivery_date;?></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-3 col-form-label">Tổng tiền: </label>
                                        <div class="col-sm-9">
                                            <span class="form-control-plaintext"><?php echo number_format($delivery->total, 0);?> VND</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-3 col-form-label">Chiết khấu: </label>
                                        <div class="col-sm-9">
                                            <span class="form-control-plaintext"><?php echo number_format($delivery->discount_1 + $delivery->discount_2, 0);?> %</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-3 col-form-label">Tổng tiền sau chiết khấu: </label>
                                        <div class="col-sm-9">
                                            <span class="form-control-plaintext"><?php echo number_format($delivery->total_with_discount, 0);?> VND</span>
                                        </div>
                                    </div>
                                </div>

                                <br/>

                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th class="text-center">STT</th>
                                                <th class="text-center"></th>
                                                <th class="text-center">Mã sản phẩm</th>
                                                <th class="text-center">Sản phẩm</th>
                                                <th class="text-center">Số lượng</th>
                                                <th class="text-center">Đơn giá</th>
                                                <th class="text-center">Thành tiền</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $index = 1;?>
                                        <?php foreach($detail as $product):?>
                                            <tr>
                                                <td class="text-center"><?php echo $index++; ?></td>
                                                <td class="text-center">
                                                    <img class="img-responsive margin-auto image-product " src="<?php echo $product->imgUrl; ?>" alt='<?php echo $product->product_name; ?>'>
                                                </td>
                                                <td><?php echo $product->product_code; ?></td>
                                                <td><?php echo $product->product_name; ?></td>
                                                <td class="text-right"><?php echo number_format($product->amount, 0); ?></td>
                                                <td class="text-right"><?php echo number_format($product->unit_price, 0); ?></td>
                                                <td class="text-right"><?php echo number_format($product->amount * $product->unit_price, 0); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>

                            <?php endif;?>
                            </div>
                        </div>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop