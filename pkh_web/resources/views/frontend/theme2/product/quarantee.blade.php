@extends('frontend.theme2.layouts.master')

@section('title')Danh mục sản phẩm @stop
@section('description') Giới thiệu về Phan Khang Ho, nhà phân phối độc quyền của Watertec tại Việt Nam @stop
@section('keywords')Watertec, đại lý Watertec, van nước, vòi nước @stop

@section('bodyAttr') class="all article" @stop

@section('pageHead') 
<link rel="stylesheet" href='<% asset_url("frontend/js/jQuery-flexImages-master/jquery.flex-images.css") %>'>
<!--<script type="text/javascript" src='<% asset_url("frontend/js/jQuery-flexImages-master/jquery.flex-images.min.js") %>'></script>-->
<style>
	.product-info {
		background-color: #e9ecef;
		padding: 15px;
	}
	.product-info label {
		fontWeight: bold;
	}
	.image-product {
		max-width: 120px;
		max-height: 120px;
	}
</style>
@stop

@section('pagescript')
<script src="https://cdn.jsdelivr.net/npm/vue"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script type="text/javascript">
jQuery(function(){
});

var app = new Vue({
	el: '#app',
	data: {
		listArea1: <?php echo json_encode($listArea1, true); ?>,
		listArea2: <?php echo json_encode($listArea2, true); ?>,
		state: 1,
		form: {
			name: null,
			date: "<?php echo date('Y-m-d'); ?>",
			tel: null,
			store: null,
			area1: null,
			area2: null
		}
	},
	methods: {
		send: async function(event) {
			event.preventDefault();

			// Send
			let url = window.location.href;
			let data = this.form;
			this.state = 2;
			try {
				let result = await axios.post(url, data);
			} catch (e) { console.log(e) };
		},
		selectDistrict: function(area) {
			if (area == null) return null;
			let temp = this.listArea2.filter(item => item.parent_area_id == area);
			return temp;
		},
		selectProvince: function(event) {
			this.form.area2 = null;
		}
	}
});
</script>
@stop

@section('content')

<div class="container" id="app">
    <div class="main">
        <div class="row">
            <div class="col-md-12">
                <div class="moduletable mod_breadcrumbs">
                    <div class="module_content">
                        <div class="breadcrumbs ">
                            <ol id="breadcrumb" class="breadcrumb">
                                <li><a href="/"><i class="fa fa-home"></i></a></li> 
                                <!--class="pathway"-->
                                <li class="active">Đăng ký bảo hành</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- Main content area -->
                <div class="main-content">

					<div class="sub-header">
						<h5 class="sub-header-text">Đăng ký bảo hành</h5>
						<img class="sub-title-logo" src='<% asset_url("frontend/theme2/images")%>/logo-sub-title.png' alt="">
					</div>

					<div class="row mt-30">
						<div class="col-lg-4 col-md-4 col-sm-12">
							<div class="product-info">
								<form>
									<?php 
										//$code = $product->supplier_id == 1 ? substr($product->product_code, 0, 6) : $product->product_code;
										$code = substr($product->product_code, 0, 6);
										$imgUrl = env('URL_IMAGE', 'http://phankhangco.com/img/product/') . $code . ".png";
									?>
									<div class="text-center">
										<img class="image-product" src="<?= $imgUrl?>" alt="<?= $product->name ?>" class="rounded">
									</div>
									<div class="form-group">
										<label>Mã sản phẩm:</label>
										<p class="form-control-plaintext"><?= $product->product_code ?></p>
									</div>
									<div class="form-group">
										<label>Tên sản phẩm:</label>
										<p class="form-control-plaintext"><?= $product->name ?></p>
									</div>
									<div class="form-group">
										<p class="form-control-plaintext"><label>Thời gian bảo hành:</label> <?= $product->warranty_year ?> năm</p>
									</div>
									<div class="form-group">
										<p class="form-control-plaintext"><label>Màu:</label> <?= $product->color ?></p>
									</div>
								</form>
							</div>
						</div>
						<div class="col-lg-8 col-md-8 col-sm-12">

							<div class="alert alert-success" role="alert"  v-if="state == 2">
								Cảm ơn qúi khách đã tin tưởng sử dụng sản phẩm Watertec của chúng tôi. <br/>Thông tin của quí khác đã được lưu trữ thành công.
							</div>

							<form @submit="send" v-if="state == 1">
								
								<div class="row">
									<div class="col-md-6 col-xs-12">
										<div class="form-group">
											<label for="txtName">Tên (*):</label>
											<input type="text" id="txtName" class="form-control" placeholder="Nhập tên" required="required" v-model="form.name" maxlength="64">
										</div>
									</div>
									<div class="col-md-6 col-xs-12">
										<div class="form-group">
											<label for="txtDate">Ngày mua:</label>
											<input type="date" id="txtDate" class="form-control" placeholder="yyyy-MM-dd" v-model="form.date" min="2016-01-01" max="2030-12-31" required pattern="\d{4}-\d{2}-\d{2}">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-6 col-xs-12">
										<div class="form-group">
											<label for="txtEmail">Email:</label>
											<input type="email" id="txtEmail" class="form-control" placeholder="Nhập email" v-model="form.email" maxlength="128">
										</div>
									</div>
									<div class="col-md-6 col-xs-12">
										<div class="form-group">
											<label for="txtTel">Điện thoại:</label>
											<input type="text" id="txtTel" class="form-control" placeholder="Nhập điện thoại" v-model="form.tel"  maxlength="32">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-6 col-xs-12">
										<div class="form-group">
											<label for="ddlProvince">Tỉnh/Thành phố:</label>
											<select class="form-control" id="ddlProvince" v-model="form.area1" required @change="selectProvince($event)">
												<option v-for="item in listArea1" :key="item.area_id" :value="item.area_id">{{item.name}}</option>
											</select>
										</div>
									</div>
									<div class="col-md-6 col-xs-12" v-if="form.area1 > 0">
										<div class="form-group">
											<label for="ddlWard">Quận huyện:</label>
											<select class="form-control" id="ddlWard" v-model="form.area2">
												<option v-for="item in selectDistrict(form.area1)" :key="item.area_id" :value="item.area_id">{{item.name}}</option>
											</select>
										</div>
									</div>
								</div>

								<div class="form-group">
									<label for="exampleInputEmail1">Cửa hàng:</label>
									<input type="text" id="txtStore" class="form-control" placeholder="Nhập cửa hàng" v-model="form.store" maxlength="512"/>
								</div>
								
								<button type="submit" class="btn btn-detail">Gửi thông tin</button>
							</form>
						</div>
					</div>

                </div>
            </div>
        </div>
    </div>
</div>

@stop