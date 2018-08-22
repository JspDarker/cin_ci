<?php

?>

<h4 class="heading colr">Featured Products</h4>
<div id="prod_scroller">
    <a href="javascript:void(null)" class="prev">&nbsp;</a>
    <div class="anyClass scrol">
        <ul>
            <?php foreach ($product_ft as $product): ?>
            <li>
                <a href="#"><img src="public/images/product/<?=$product['url']?>" alt="<?=$product['alt']?>" ></a>
                <h6 class="colr"><?=$product['name']?></h6>
                <p class="price bold"><?php echo number_format($product['price'])?> VND</p>
                <a href="<?=site_url()?>/shopping/add/<?=$product['id']?>" class="adcart">Add to Cart</a>
            </li>
            <?php endforeach;?>
        </ul>
    </div>
    <a href="javascript:void(null)" class="next">&nbsp;</a>
</div>
<div class="clear"></div>
<div class="listing">
    <h4 class="heading colr">New Products for <?php $date = new DateTime();
        echo $date->format('M Y');?></h4>
    <ul>

        <?php $count=1; ?>
        <?php foreach ($product_newest as $list):?>
            <li<?php echo ($count % 4 == 0) ? " class='last'" : ''; $count++?>>
                <a itemid="<?=$list['id']?>" href="?mod=detail&pro_id=<?=$list['id']?>" class="thumb"><img src="public/images/product/<?=$list['url']?>" alt="<?=$list['alt']?>" ></a>
                <h6 class="colr"><?=$list['name']?></h6>
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
                    <a href="?mod=cart_access&act=1&pro_id=<?=$list['id']?>" class="adcart" itemid="<?=$list['id']?>">Add to Cart</a>
                    <p class="price">$<?php echo round((($list['price'])/1000000),2)?></p>
                </div>
            </li>
        <?php endforeach?>

    </ul>
</div>
</div>
<div class="clear"></div>
<div class="col2_botm">&nbsp;</div>
</div>
