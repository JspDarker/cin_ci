
<h2 class="heading colr">BedSheets</h2>
<div class="shoppingcart">
    <ul class="tablehead">
        <li class="thumb colr">&nbsp;Image</li>
        <li class="title colr">Product Name</li>
        <li class="price colr">Unit Price</li>
        <li class="qty colr">QTY</li>
        <li class="total colr">Sub Total</li>
    </ul>

<!--    BEGIN CART -------------- -->
    <?php $i = 1; ?>
    <?php foreach ($this->cart->contents() as $items): ?>
    <?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>
        <ul class="cartlist gray">
<!--            <li class="remove txt"><a href="#"><img src="public/images/delete.gif" alt=""></a></li>-->
            <li class="thumb"><a href="detail.html"><img src="public/images/product/<?=$items['url']?>" alt="THIS IS IMG"></a></li>
            <li class="title txt"><a href="detail.html"><?php echo $items['name']; ?></a></li>
            <li class="price txt"><?php echo $this->cart->format_number($items['price']); ?></li>
            <li class="qty">
                <input name="<?=$i.'[qty]'?>" type="text" disabled value="<?=max(1,$items['qty'])?>">
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

            <h3 class="colr"><?php echo $this->cart->format_number($this->cart->total()); ?></h3>
        </div>
    </div>
<!--    ========================== ===================== ========================= ====================== ==================-->
    <div class="registrd">
        <h3>Checkout Information</h3>
        <div class="text-danger"><?php echo validation_errors(); ?></div>
        <?php echo form_open(''); ?>
            <ul class="forms">
                <li class="txt">Name <span class="req">*</span></li>
                <li class="inputfield">
                    <input value="<?=isset($user['name'])? $user['name'] : set_value('name')?>" type="text" name="name" class="bar" required pattern="[A-Za-z ]{2,}" title="name is character 2"><br>
                </li>
            </ul>
            <ul class="forms">
                <li class="txt">Phone <span class="req">*</span></li>
                <li class="inputfield">
                    <input value="<?=isset($user['mobile'])? $user['mobile'] : set_value('phone')?>" type="text" required name="phone" class="bar" ><br>
                </li>
            </ul>
            <ul class="forms">
                <li class="txt">Email <span class="req">*</span></li>
                <li class="inputfield">
                    <input  type="text" required name="email" class="bar" ><br>
                </li>
            </ul>
            <ul class="forms">
                <li class="txt">Address <span class="req">*</span></li>
                <li class="inputfield"><textarea required name="address" cols="28" rows="5"><?=isset($user['address'])? $user['address'] : set_value('address')?></textarea><br>
                </li>
            </ul>
            <ul class="forms">
                <li class="txt">Remark</li>
                <li class="inputfield"><textarea required name="remark" cols="28" rows="5"></textarea><br>
                </li>
            </ul>
            <ul class="forms">
                <li class="txt">&nbsp;</li>
                <li>
                    <?php if(isset($_SESSION['user_id'])):?>
                        <button type="submit" name="btn_checkout">Checkout</button>
                    <?php else:?>
                        <a href="<?=site_url('users/login')?>" class="simplebtn"><span>Login to checkout</span></a>
                    <?php endif?>
                    <!--<a href="#" class="forgot">Forgot Your Password?</a>-->
                </li>
            </ul>
        </form>

    </div>

</div>

<div class="clear"></div>
</div>
<div class="clear"></div>
<div class="col3_botm">&nbsp;</div>
</div>
