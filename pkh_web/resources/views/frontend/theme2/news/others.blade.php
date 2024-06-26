<?php
$listNews = ah_news_list(20);
?>
<?php if(!empty($listNews)): ?>
<br/>

<div class="sub-header">
    <h5 class="sub-header-text">TIN TỨC KHÁC</h5>
    <img class="sub-title-logo" src='<% asset_url("frontend/theme2/images")%>/logo-sub-title.png' alt="">
</div>

<ul class="list-unstyled list-news-related row">
    <?php foreach($listNews as $news): ?>
        <li class="col-md-6 col-sm-12">
            <div class="media">
                <?php if( empty($news->feature_image_path)): ?>
                    <img class="img-responsive mr-3 img-news-list2" src='<% asset_url("frontend/theme2/images/img-news-default-" . rand(1,3) . ".png")%>' alt="<% $news->slug %>">
                <?php else: ?>
                    <img class="img-responsive mr-3 img-news-list2" src='<% env("URL_IMAGE_FRONTEND") . $news->feature_image_path %>' alt="<% $news->slug %>">
                <?php endif; ?>
                <div class="media-body">
                    <a href='[[url("/tin-tuc/" . $news->slug)]]'>[[$news->title]]</a>
                    <div class="text-right"><date>([[$news->publish_date]])</date></div>
                </div>
            </div>
        </li>
    <?php endforeach; ?>
</ul>

<?php endif; ?>