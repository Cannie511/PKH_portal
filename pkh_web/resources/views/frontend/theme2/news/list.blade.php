@extends('frontend.theme2.layouts.master')

@section('title')Tin tức @stop
@section('description') Giới thiệu về Phan Khang Ho, nhà phân phối độc quyền của Watertec tại Việt Nam @stop
@section('keywords')Watertec, đại lý Watertec, van nước, vòi nước @stop

@section('bodyAttr') class="all article" @stop

@section('pageHead')
<style type="text/css">

</style>
@stop

@section('content')

<div class="container">
    <div class="main">

        <?php 
            use Illuminate\Support\Str;
        ?>

        
        <?php if(!empty($latestNews)): ?>
            <?php foreach($latestNews as $news): ?>
                <div class="news-item row">
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <?php if( empty($news->feature_image_path)): ?>
                            <img class="img-responsive img-news-list1" src='<% asset_url("frontend/theme2/images/img-news-default-" . rand(1,3) . ".png")%>' alt="phan khang news">
                        <?php else: ?>
                            <img class="img-responsive img-news-list1" src='<% env("URL_IMAGE_FRONTEND") . $news->feature_image_path %>' alt="phan khang news">
                        <?php endif; ?>
                    </div>
                    <div class="col-md-8 col-sm-6 col-xs-12">
                        <h4 class="news-title"><a href='[[url("/tin-tuc/" . $news->slug)]]'>[[$news->title]]</a></h4>
                        <div class="news-date text-right"><date>[[$news->publish_date]]</date></div>
                        
                        <?php if(!empty($news->short_content)): ?>
                            <p>[[$news->short_content]]</p>
                        <?php endif; ?>

                        <a class="btn btn-outline-secondary btn-lg btn-detail" href='[[url("/tin-tuc/" . $news->slug)]]'>CHI TIẾT</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if(!empty($relatedNews)): ?>
            <ul class="list-unstyled list-news-related row">
                <?php foreach($relatedNews as $news): ?>
                    <li class="col-md-6 col-sm-12">
                        <div class="media">
                            <?php if( empty($news->feature_image_path)): ?>
                                <img class="img-responsive mr-3 img-news-list2" src='<% asset_url("frontend/theme2/images/img-news-default-" . rand(1,3) . ".png")%>' alt="<% $news->slug %>">
                            <?php else: ?>
                                <img class="img-responsive mr-3 img-news-list2" src='<% env("URL_IMAGE_FRONTEND") . $news->feature_image_path %>' alt="<% $news->slug %>">
                            <?php endif; ?>
                            <div class="media-body">
                                <!-- <h5 class="mt-0">Media heading</h5> -->
                                <a href='[[url("/tin-tuc/" . $news->slug)]]'>[[$news->title]]</a>
                                <div class="text-right"><date>([[$news->publish_date]])</date></div>
                                <!-- Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus. -->
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

    </div>
</div>

@stop