@extends('frontend.theme2.layouts.master')

@section('title')Bảng báo giá @stop
@section('description') Bảng báo giá sản phẩm vòi nhựa WATERTEC của nhà phân phối độc quyền của Watertec tại Việt Nam - Phan Khang Home @stop
@section('keywords')Watertec, đại lý Watertec, van nước, vòi nước @stop

@section('bodyAttr') class="all article" @stop

@section('pageHead') 
<style>
	.img-thumb {
		max-width: 100px;
   		max-height: 100px;
	}

	.table {
		width: 100%;
	}

	.rowHeader {
		background: #01b4bd;
    	color: #fff;
	}

	.rowHeader1 {
		background: #00bcd4c7;
    	color: #fff;
		font-weight: bold;
	}

	.rowHeader2 {
		background: #ececec;
    	color: #6e6e6e;
		font-weight: bold;
	}
</style>
@stop

@section('pagescript')
<script type="text/javascript">
jQuery(function(){
});
</script>
@stop

@section('content')

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
                                <li class="active">Bảng giá</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- Main content area -->
                <div class="main-content">
                    <div class="page article-view article-view__">
                        <div class="page_heading article_heading">
                            <h2 class="view-item-title article_title">
                                Bảng giá			
                            </h2>
                        </div>
						<div class="article_text row">	
							<p class="text-center">

								<table class="table table-bordered">
									<thead>
										<tr class="rowHeader">
											<!-- <th class="text-center">STT</th> -->
											<th style="width:110px" class="text-center">Hình ảnh</th>
											<th class="text-center">Sản phẩm</th>
											<th class="text-center">Màu</th>
											<th class="text-center">Năm BH</th>
											<th class="text-center">Giá</th>
										</tr>
									</thead>
									<tbody>
										<?php $index = 1;?>
										<?php foreach ($priceList as $cat): ?>
											<tr class="rowHeader1">
												<td colspan="5"><% htmlspecialchars($cat["name"]) %></td>
											</tr>

											<?php foreach ($cat["items"] as $cat2): ?>
												<?php if ($cat2["type"] == "CAT"): ?>
													<tr class="rowHeader2">
														<td colspan="5"><% htmlspecialchars($cat2["name"]) %></td>
													</tr>
													<?php foreach ($cat2["items"] as $item): ?>
													<tr>
														<!-- <td><% $index++ %></td> -->
														<td><img class="img-thumb img-responsive" alt='<% $item["product_code"] %>' src='<% $item["img_url"] %>'/></td>
														<td>
															<b><% $item["product_code"] %></b> <br/>
															<% $item["name"] %>
														</td>
														<td><% $item["color" ]%></td>
														<td class="text-right"><% $item["warranty_year"] %></td>
														<td class="text-right"><% number_format($item["selling_price"]) %></td>
													</tr>
													<?php endforeach; ?>
												<?php endif; ?>
											<?php endforeach; ?>
										<?php endforeach; ?>
									</tbody>
								<table>
							</p>
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop