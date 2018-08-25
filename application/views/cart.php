
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
<?php echo form_open('cart/update'); ?>
<!--    BEGIN CART -------------- -->
    <?php $i = 1; ?>

    <?php foreach ($this->cart->contents() as $items): ?>

    <?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>
        <ul class="cartlist gray">
            <li class="remove txt"><a href="#"><img src="public/images/delete.gif" alt=""></a></li>
            <li class="thumb"><a href="detail.html"><img src="public/images/product/<?=$items['url']?>" alt="THIS IS IMG"></a></li>
            <li class="title txt"><a href="detail.html"><?php echo $items['name']; ?></a></li>
            <li class="price txt"><?php echo $this->cart->format_number($items['price']); ?></li>
            <li class="qty">
                <?php echo form_input(array('name' => $i.'[qty]', 'value' => max(1,$items['qty']), 'maxlength' => '3', 'size' => '5','pattern' => '[0-9]+','title' => 'is number >= 0')); ?>
            </li>
            <li class="total txt">
                <?php echo $this->cart->format_number($items['subtotal']); ?>
            </li>
        </ul>
        <?php $i++; ?>
    <?php endforeach; ?>
    <!--    END CART -------------- -->
    <div class="clear">
        <div class="subtotal">
            <a href="inited.php?mod=home" class="simplebtn"><span>Continue Shopping</span></a>
            <!--<button type="submit"><span>Update</span></button>-->
            <?php echo form_submit('', 'Update'); ?>

            <a href="<?=site_url('cart/checkout')?>" class="simplebtn"><span>Check Out</span></a>
            <h3 class="colr"><?php echo $this->cart->format_number($this->cart->total()); ?></h3>
            </form>
        </div>
    </div>

</div>
<div class="clear"></div>
</div>
<div class="clear"></div>
<div class="col3_botm">&nbsp;</div>
</div>
