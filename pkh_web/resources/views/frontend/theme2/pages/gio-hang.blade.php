@extends('frontend.theme1.layouts.master-child')

@section('title')Về chúng tôi @stop
@section('description') Giới thiệu về Phan Khang Home, nhà phân phối độc quyền của Watertec tại Việt Nam @stop
@section('keywords')Watertec, đại lý Watertec, van nước, vòi nước @stop

@section('bodyAttr') class="all article" ng-app="pkhApp" @stop

@section('pageHead')
<script  type="text/javascript">
    jQuery.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });
    var listProduct = {};
    function myFunction(id) {
        if (!(id in listProduct)){
            listProduct[id]=1;
        } else {
            listProduct[id]++;
        }
        
        document.getElementById("demo").innerHTML = listProduct;
    }

    function submit(){
        var data={
            "list": listProduct 
        };
      
         jQuery.ajax({
            type: "GET",
            url: '/dat-hang-ngay',
            data: data,
            success: function() {
                window.location.replace("/gio-hang");
            }
        })
    }
</script>
@stop

@section('content')

<div class="container" ng-cloak ng-controller="CartController"  ng-init="initCart()">
    <div class="main">
        <div class="row">
            <div class="col-md-12">
                <div class="moduletable   mod_breadcrumbs">
                    <div class="module_content">
                        <div class="breadcrumbs ">
                            <ol id="breadcrumb" class="breadcrumb">
                                <li><a href="/"><i class="fa fa-home"></i></a></li> 
                                <!--class="pathway"-->
                                <li class="active">Giỏ hàng</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- Main content area -->
                <div class="main-content">
                    <div class="page article-view article-view__">
                        <div class="row ">
                            <a class="btn" href="/dat-hang">Quay lại đặt hàng >>></a>
                        </div>
                        <div class="page_heading article_heading">
                            <h2 class="view-item-title article_title">
                                GIỎ HÀNG : {{cart.amount}} (sản phẩm)
                                <div class="pull-right ">
                                    <a class="btn " ng-click="emptyCart()">xóa giỏ hàng</a> |
                                    <a class="btn " ng-click="updateCart()">Cập nhật giỏ hàng</a>
                                </div>
                               
                            </h2>

                        </div>
                        <div class="container">
                              <div class="box-body" >
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th >
                                                        <span>STT</span>
                                                    </th>
                                                    <th>
                                                        <span>Hình ảnh</span>
                                                    </th>
                                                    <th>
                                                        <span>Mã sản phẩm</span>
                                                    </th>
                                                    <th>
                                                        <span>Tên sản phẩm</span>
                                                    </th>
                                                  
                                                    <th>
                                                        <span>Số lượng</span>
                                                    </th>
                                                    <!-- <th class="text-right">
                                                        <span>Đơn giá</span>
                                                    </th>
                                                    <th class="text-right">
                                                        <span>Thành tiền</span>
                                                    </th> -->
                                                     <th>
                                                        <span>Hủy</span>
                                                    </th>
                                                </tr>
                                                <tr ng-repeat="item in cart.list">
                                                    <td>{{$index+1}}</td>
                                                     <td>
                                                        <img ng-if="item.noImage == 0" width="50" height="50" class="" ng-src="<% env('URL_IMAGE', 'http://phankhangco.com/img/product/')%>{{item.product_code}}.png" />
                                                        <img ng-if="item.noImage == 1" class="img-thumb-product" class="img-responsive" ng-src="<% env('URL_IMAGE', 'http://phankhangco.com/img/product/')%>WT0000.png" />
                                                    </td>
                                                    <td>{{item.product_code}}</td>
                                                    <td>{{item.name}}</td>
                                                    <td>
                                                        <input type="number" ng-model="item.amount" min="0"  max="50000" ng-change="makePayment()" />
                                                        <p style=" color:red;" class="help-block" ng-if="!item.amount">
                                                            Chưa điền số lượng  
                                                        </p>
                                                    </td>
                                                    <!-- <td class="text-right">{{item.selling_price | currency: '' : 0}}</td>
                                                    <td class="text-right">{{item.selling_price*item.amount | currency: '' : 0}} </td> -->
                                                    <td><button  class="label label-danger" ng-click="removeFromCart(item)"><i class="fa fa-minus-circle"></i></button></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-12" style="margin-bottom: 20px;">
                                       
                                        <div class="row pull-right">
                                            <p style=" color:red;" class="help-block" ng-if="checkCart ==0">
                                                Giỏ hàng rỗng không thể đặt hàng
                                            </p>
                                            <p style=" color:red;" class="help-block" ng-if="checkCart ==-1">
                                                Chưa điền số lượng không thể đặt hàng
                                            </p>
                                            <p style=" color:red;" class="help-block" ng-if="checkCart ==-2">
                                                Đơn hàng của bạn đã được ghi nhận trước đó
                                            </p>
                                            <!-- <h5><b>Thành tiền : {{payment  | currency: '' : 0}} (VND) </b></h5> -->
                                        </div>
                                     </div>
                                    
                                    <div class="col-md-12">
                                        <div class="form-group" >
                                            <label class="col-sm-2 control-label required">Họ và tên</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" ng-model="form.name" name="name" placeholder="" required>
                                                <p style=" color:red;" class="help-block" ng-if="checkName ==0">Vui lòng nhập tên ít nhất 5 kí tự và không chứa kí tự đặc biệt</p>
                                            </div>
                                            <label class="col-sm-2 control-label">Số điện thoại</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" ng-model="form.phone" name="phone" placeholder="">
                                                <p style=" color:red;" class="help-block" ng-if="checkPhone ==0">Vui lòng nhập số điện thoại gồm các chữ số viết liền nhau
                                                    <br> Ví dụ: 0906610116    
                                                </p>
                                              
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        
                                        <a style="margin-top: 20px;" class="btn btn-success btn-xs pull-right" ng-click="makeOrder()">Đặt hàng</a>
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
<script type="text/javascript" src='<% asset_url("frontend/js/cart.js") %>'></script>
@stop