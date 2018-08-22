
<h4 class="heading colr">Featured Products</h4>
<div class="small_banner">
    <a href="#"><img src="public/images/small_banner.gif" alt="" ></a>
</div>
<div class="sorting">
    <p class="left colr">4 Item(s)</p>
    <ul class="right">
        <li class="text">
            Sort by Name
            <a href="<?=site_url()?>/listing/lists/<?=$ca?>/1/<?=$page?>" class="colr">DESC</a>
            <a href="<?=site_url()?>/listing/lists/<?=$ca?>/3/<?=$page?>" class="colr">ASC</a> Price
            <a href="<?=site_url()?>/listing/lists/<?=$ca?>/2/<?=$page?>" class="colr">DESC</a>
            <a href="<?=site_url()?>/listing/lists/<?=$ca?>/4/<?=$page?>" class="colr">ASC</a>
        </li>
        <li class="text">Page
            <?php for($i = 1; $i <= $total_page ; $i++):?>
                <a href="<?=site_url()?>/listing/lists/<?=$ca?>/<?=$sort?>/<?=$i?>" class="colr"><?=$i?></a>
            <?php endfor;?>
            <a href="#" class="colr">/ All</a>
        </li>
    </ul>
    <div class="clear"></div>
    <p class="left">View as: <a href="#" class="bold">Grid</a>&nbsp;<a href="#" class="colr">List</a></p>
    <ul class="right">
        <li class="text">
            Sort by Position
            <a href="#" class="colr">Name </a>
            <a href="#" class="colr">Price</a>
        </li>
    </ul>
</div>
<div class="listing">
    <h4 class="heading colr">New Products for <?php $date = new DateTime();
        echo $date->format('M Y');?></h4>
    <ul>
        <?php $count=1; ?>
        <?php foreach ($listings as $list):?>
            <li<?php echo ($count % 4 == 0) ? " class='last'" : ''; $count++?>>
                <a itemid="<?=$list['pro_id']?>" href="?mod=detail&pro_id=<?=$list['pro_id']?>" class="thumb"><img src="public/images/product/<?=$list['urlHinh']?>" alt="<?=$list['img_alt']?>" ></a>
                <h6 class="colr"><?=$list['pro_name']?></h6>
                <div class="stars">

                    <?php
                    $star = ceil($list['point']); //3
                    $max = 5;
                    for($i = 1; $i <= $max; $i++) {
                        if($i <= $star) {
                            echo '<a href="#"><img src="public/images/star_green.gif" alt="" ></a>';
                        } else {
                            echo '<a href="#"><img src="public/images/star_grey.gif" alt="" ></a>';
                        }
                    }
                    ?>
                    <br>
                    <a href="#">(<?=$list['comment']?>) Comment</a>
                </div>
                <div class="addwish">
                    <a href="#">Add to Wishlist</a>
                    <a href="#">Add to Compare</a>
                </div>
                <div class="cart_price">
                    <a href="?mod=cart_access&act=1&pro_id=<?=$list['pro_id']?>" class="adcart" itemid="<?=$list['pro_id']?>">Add to Cart</a>
                    <p class="price">$<?php echo round((($list['pro_price'])/1000000),2)?></p>
                </div>
            </li>
        <?php endforeach?>
    </ul>
</div>
</div>
<div class="clear"></div>
<div class="col2_botm">&nbsp;</div>
</div>
