@extends('frontend.theme2.layouts.master')

@section('title')Danh mục sản phẩm @stop
@section('description') Giới thiệu về Phan Khang Home, nhà phân phối độc quyền của Watertec tại Việt Nam @stop
@section('keywords')Watertec, đại lý Watertec, van nước, vòi nước @stop

@section('bodyAttr') class="all article" @stop

@section('pageHead') 
<link rel="stylesheet" href='<% asset_url("frontend/js/jQuery-flexImages-master/jquery.flex-images.css") %>'>
<style>
	.item-product.item {
		text-align: center;
		border: 1px solid #eee;
		width: 180px;
		height: 213px;
	}
	.item-product.item img {
		max-width: 180px;
		max-height: 180px;
		margin: auto;
	}
	.bottom {
		border-top: 1px solid #eee;
		padding: 3px;
		font-size: 11px;
		line-height: 1.2em;
		background-color: #fafafa;
	}
	.group-cat {
		padding-top: 30px;
	}
	.dark-group {
		background-color: #eaeaea;
	}
	.header-text {
		text-transform: uppercase;
	}

	.bookContainer {
        height: 800px;
        width: 100%;
        margin: 20px auto;
        /* border: 2px solid red; */
        box-shadow: 0 0 3px #949494;
    }

</style>
@stop

@section('pagescript')

<script src='<% asset_url("frontend/theme2/js/jq-3d-flip-book/js/html2canvas.min.js") %>'></script>
<script src='<% asset_url("frontend/theme2/js/jq-3d-flip-book/js/three.min.js") %>'></script>
<script src='<% asset_url("frontend/theme2/js/jq-3d-flip-book/js/pdf.min.js") %>'></script>
<script src='<% asset_url("frontend/theme2/js/jq-3d-flip-book/js/3dflipbook.min.js") %>'></script>

<script type="text/javascript">

function getImage(n) {
	let imgUrl = "/frontend/theme2/images/catalog-2021/page-" + n + ".jpg";
	return {
		type: 'image',
		src: imgUrl,
		interactive: false
	};
}

$(function () {
	$('#bookContainer').FlipBook({
        pageCallback: getImage,
        pages: 15,
        propertiesCallback: function(props) {
		  props.cssLayersLoader = function(n, clb) {// n - page number
            clb([{
            //   css: '.hd {margin-top: 200px;background-color: red;}',
            //   html: '<h1 class="hd">CSS3 Layer - Hello</h1>',
              js: function (jContainer) {
				console.log(jContainer);
				let noop = function() {};
                return {
                  hide: noop,
                  hidden: noop,
                  show: noop,
                  shown: noop,
                  dispose: noop
                //   hide: function() {console.log('hide');},
                //   hidden: function() {console.log('hidden');},
                //   show: function() {console.log('show');},
                //   shown: function() {console.log('shown');},
                //   dispose: function() {console.log('dispose');}
                };
              }
            }]);
          };
          props.cover.color = 0x000000;
          return props;
        },
        template: {
          html: '/frontend/theme2/js/jq-3d-flip-book/templates/pkh-book-view.html',
          styles: [
            '/frontend/theme2/js/jq-3d-flip-book/css/white-book-view.css'
          ],
          links: [
            {
              rel: 'stylesheet',
              href: '/frontend/theme2/js/jq-3d-flip-book/css/font-awesome.min.css'
            }
          ],
          script: '/frontend/theme2/js/jq-3d-flip-book/js/default-book-view.js',
          sounds: {
            startFlip: '/frontend/theme2/js/jq-3d-flip-book/sounds/start-flip.mp3',
            endFlip: '/frontend/theme2/js/jq-3d-flip-book/sounds/end-flip.mp3'
          }
        }
      });
});

</script>

@stop

@section('content')

@include('frontend.theme2.partials.slider')

<?php
use Illuminate\Support\Str;
$listProductCatChunkArr = array_chunk($listProductCat, 3, true);
?>

<div class="container">
	<div class="bookContainer" id="bookContainer">
    </div>
</div>

<?php foreach($listProductCatChunkArr as $groupIndex => $listCat3): ?>
	<?php 
		$imgIndex = 1; 
		$className = $groupIndex % 2 == 0 ? "": "dark-group";
	?>
	<div class="group-cat <?= $className?>">
		<div class="list-categories container">
			<div class="row">
			<?php foreach($listCat3 as $key => $cat): ?>
				<div class="col-sm">
					<img class="img-responsive margin-auto" src='<% asset_url("frontend/theme2/images/categories/cat-" . $imgIndex . ".png")%>' alt="phan khang news">
					<h5 class="header-text"><?php echo $cat->name; ?></h5>
					<!-- <p class="text-desc"><?php echo $cat->short_content; ?></p> -->
					<a class="btn btn-outline-secondary btn-detail mb-5" href="/danh-muc/<?php echo Str::slug($cat->name) . "/" . $cat->product_cat_code;?>">CHI TIẾT</a>
				</div>
				<?php 
					$imgIndex = $imgIndex < 3 ? $imgIndex + 1 : 1;
				?>
			<?php endforeach; ?>
			</div>
		</div>
	</div>

<?php endforeach; ?>

@stop