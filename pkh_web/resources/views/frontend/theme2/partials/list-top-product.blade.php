<div class="list-top-product container">

    <?php
    use Illuminate\Support\Str;
    if(!isset($listProducts) || count($listProducts) == 0) {
        // $listProducts = ah_top_product();
        $listProducts = [];
    }
    if (!isset($title)) {
        $title = "SẢN PHẨM BÁN CHẠY";
    }
    ?>

    <?php if(count($listProducts) > 0): ?>

    <div class="sub-header">
        <h5 class="sub-header-text"><?php echo $title; ?></h5>
        <img class="sub-title-logo" src='<% asset_url("frontend/theme2/images")%>/logo-sub-title.png' alt="">
    </div>
    <br/>

    <div id="topProduct" class="top-product-container">
        <?php foreach($listProducts as $product): ?>
           <div class="product-item">
                <?php 
                    //$code = $product->supplier_id == 1 ? substr($product->product_code, 0, 6) : $product->product_code;
                    $code = substr($product->product_code, 0, 6);
					$imgUrl = env('URL_IMAGE', 'http://phankhangco.com/img/product/') . $code . ".png";
					if ( !file_exists(public_path("img/product/" . $code . ".png"))) {
						$imgUrl = env('URL_IMAGE', 'http://phankhangco.com/img/product/') . "WT0000.png";
					}
				?>
                <img class="img-responsive margin-auto image-product" src="<?= $imgUrl?>" alt="<?php echo $product->product_code . " " . $product->name; ?>">
					<h6 class="header-text"><?php echo $product->product_code; ?></h6>
					<h6 class="header-text"><?php echo $product->name; ?></h6>
					<a class="btn btn-outline-secondary btn-detail mb-5" href="/san-pham/<?php echo Str::slug($product->name) . "/" . substr($product->product_code,0,6);?>">CHI TIẾT</a>
           </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

</div>
