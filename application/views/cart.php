
<h2 class="heading colr">BedSheets</h2>
<div class="shoppingcart">
    <ul class="tablehead">
        <li class="remove colr">Remove</li>
        <li class="thumb colr">&nbsp;</li>
        <li class="title colr">Product Name</li>
        <li class="price colr">Unit Price</li>
        <li class="qty colr">QTY</li>
        <li class="total colr">Sub Total</li>
    </ul>
    <?php
    //$_SESSION['total'] = 0;
    ?>
    <?php foreach($product as $p): ?>
        <ul class="cartlist gray">
            <li class="remove txt"><a href="inited.php?mod=cart_access&act=3&id=<?=$p['pro_id']?>"><img src="public/images/delete.gif" alt=""></a></li>
            <li class="thumb"><a href="detail.html"><img src="public/images/product/<?=$p['pro_img']?>" alt="<?=$p['pro_alt']?>"></a></li>
            <li class="title txt"><a href="detail.html"><?=$p['pro_name']?></a></li>
            <li class="price txt"><?=number_format($p['pro_price'])?></li>
            <li class="qty">
                <form id="frm-cart" name="frm-cart" method="post" action="inited.php?mod=cart_access&act=2">
                    <input name="<?=$p['pro_id']?>" type="number" min="1" value="<?/*=$cart[$p['pro_id']];*/?>">
            </li>
            <li class="total txt">
               <!-- --><?php /*$_SESSION['total'] += $p->pro_price * $cart[$p->pro_id];
                echo number_format($p->pro_price * $cart[$p->pro_id]);
                */?>
            </li>
        </ul>
    <?php endforeach;?>
    <div class="clear">
        <div class="subtotal">
            <a href="inited.php?mod=home" class="simplebtn"><span>Continue Shopping</span></a>
            <button type="submit"><span>Update</span></button>
            </form>
            <a href="inited.php?mod=checkout" class="simplebtn"><span>Check Out</span></a>
            <h3 class="colr"><?php /*echo number_format($_SESSION['total']);*/?></h3>
        </div>
    </div>
</div>
<div class="clear"></div>
</div>
<div class="clear"></div>
<div class="col3_botm">&nbsp;</div>
</div>
