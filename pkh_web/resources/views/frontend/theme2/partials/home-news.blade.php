
<?php
$listNews = ah_news_list(9);

$listGroup = array_chunk($listNews, 3);
?>
<?php if(!empty($listNews)): ?>

<div class="container mt-30">

    <div class="sub-header">
        <h5 class="sub-header-text">TIN TỨC</h5>
        <img class="sub-title-logo" src='<% asset_url("frontend/theme2/images")%>/logo-sub-title.png' alt="">
    </div>

    <!-- <div class="row mt-10">
        <?php $imgIndex = 1; ?>
        <?php foreach($listNews as $news): ?>
            <div class="col-sm mt-10 text-center">
                <img class="img-responsive" src='<% asset_url("frontend/theme2/images/categories/cat-" . $imgIndex . ".png")%>' alt="phan khang news">
                <a href='[[url("/tin-tuc/" . $news->slug)]]'>[[$news->title]]</a>
            </div>
            <?php 
                $imgIndex = $imgIndex < 3 ? $imgIndex + 1 : 1;
            ?>
        <?php endforeach; ?>
    </div> -->

    <div id="news-carousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#news-carousel" data-slide-to="0" class="active"></li>
            <li data-target="#news-carousel" data-slide-to="1"></li>
            <li data-target="#news-carousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <?php $first = true; ?>
            <?php foreach($listGroup as $group): ?>
                <div class="carousel-item <?php if( $first ) echo 'active'; ?>">
                    <?php $first = false; ?>
                    <?php $imgIndex = 1; ?>
                    <div class="row">
                        <?php foreach($group as $news): ?>
                            <div class="col-sm mt-10 text-center">
                                <?php if( empty($news->feature_image_path)): ?>
                                <img class="img-responsive img-new-home" src='<% asset_url("frontend/theme2/images/img-news-default-" . $imgIndex . ".png")%>' alt="<% $news->slug %>">
                                <?php else: ?>
                                <img class="img-responsive img-new-home" src='<% env("URL_IMAGE_FRONTEND") . $news->feature_image_path %>' alt="<% $news->slug %>">
                                <?php endif; ?>
                                <!-- <h5 class="header-text"><?php echo $news->title; ?></h5> -->
                                <a href='[[url("/tin-tuc/" . $news->slug)]]'>[[$news->title]]</a>
                                <!-- <a class="btn btn-outline-secondary btn-detail" href='[[url("/tin-tuc/" . $news->slug)]]'>CHI TIẾT</a> -->
                            </div>
                            <?php 
                                $imgIndex = $imgIndex < 3 ? $imgIndex + 1 : 1;
                            ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <a class="carousel-control-prev" href="#news-carousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#news-carousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div class="text-center mt-30">
        <a class="btn btn-outline-secondary btn-lg btn-detail btn-detail-2x" href='[[url("/tin-tuc/")]]'>XEM THÊM</a>
    </div>
</div>

<?php endif; ?>


