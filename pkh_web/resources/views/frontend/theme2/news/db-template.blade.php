@extends('frontend.theme2.layouts.master')

@section('title')Tin tức | <?php echo $data->title; ?> @stop
@section('description') <?php echo $data->description; ?> @stop
@section('keywords') <?php echo $data->keywords; ?> @stop

@section('news-title') <?php echo $data->title; ?> @stop


@section('pagescript')

<script src="<%% asset_url('js/final.js?'.ah_js_version()) %%>"></script>

<script>
angular.module("textAngularTest", ['textAngular'])
	.controller('wysiwygeditor', ['$scope', 'textAngularManager', function wysiwygeditor($scope, textAngularManager) {
		$scope.version = textAngularManager.getVersion();
		$scope.versionNumber = $scope.version.substring(1);
		$scope.orightml = `<?php echo $data->content;?>`;
		$scope.htmlcontent = $scope.orightml;
		$scope.disabled = false;
	}]);
</script>
  
@stop

@section('content')

@include('frontend.theme2.partials.slider')

<div class="container" ng-app="textAngularTest" ng-controller="wysiwygeditor" >
	<div class="news-detail row">
		<div class="col-md-12">

			<div ta-bind ng-model="htmlcontent"></div>
			
			<p class="text-right">
				<i>(Ngày <?php echo $data->publish_date; ?>)</i>
			</p>

		</div>
	</div>
	
	<?php
		$nextNews = ah_news_next($data->id);
		$prevNews = ah_news_prev($data->id);
	?>

	<div class="row">
		<div class="col-6">
			<?php if(!empty($prevNews)): ?>
				<a class="btn btn-outline-secondary btn-detail" href='[[url("/tin-tuc/" . $prevNews->slug)]]'>CŨ HƠN</a>
			<?php endif;?>
		</div>
		<div class="col-6">
			<?php if(!empty($nextNews)): ?>
				<a class="btn btn-outline-secondary btn-detail pull-right" href='[[url("/tin-tuc/" . $nextNews->slug)]]'>MỚI HƠN</a>
			<?php endif;?>
		</div>
	</div>

	@include('frontend.theme2.news.others')
</div>

@stop
