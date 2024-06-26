<div class="list-categories container">

    <?php
    use Illuminate\Support\Str;
    $listCats = ah_categories_list();
    ?>

    <div class="row">
        <?php $imgIndex = 1; ?>
        <?php foreach($listCats as $cat): ?>
            <div class="col-sm">
                <img class="img-responsive margin-auto" src='<% asset_url("frontend/theme2/images/categories/cat-" . $imgIndex . ".png")%>' alt="phan khang news">
                <h5 class="header-text text-upercase"><?php echo $cat["name"]; ?></h5>
                <p class="text-upercase"><?php echo $cat["description"]; ?></p>
                <a class="btn btn-outline-secondary btn-detail mb-5" href="/danh-muc/<?php echo Str::slug($cat["name"]) . "/" . $cat["product_cat_code"];?>">CHI TIẾT</a>
            </div>
            <?php 
                $imgIndex = $imgIndex < 3 ? $imgIndex + 1 : 1;
            ?>
        <?php endforeach; ?>
    </div>

</div>