<?php
if( isset($res_register) && $res_register == true) {
  ?>
    <script>
        confirm('dang ki thanh cong, di dem trang login'); window.location.href = ('<?=site_url()?>/users/login')
    </script>
    <?php
}
?>


<h2 class="heading colr">Register</h2>

<div class="login">
    <div class="registrd">
        <h3>Please Register</h3>
        <!--<div class="text-danger"><?php /*echo validation_errors(); */?></div>-->
        <?php echo form_open(''); ?>
            <ul class="forms">
                <li class="txt">Name <span class="req">*</span></li>
                <li class="inputfield">
                    <input required value="<?=set_value('name')?>" type="text" name="name" minlength="5" maxlength="50" class="bar" ><br>
                    <span class="text-danger"><?=form_error('name')?></span>
                </li>
            </ul>
            <ul class="forms">
                <li class="txt">Email Address <span class="req">*</span></li>
                <li class="inputfield">
                    <input required value="<?=set_value('email')?>" type="text" name="email" class="bar" ><br>
                    <span class="text-danger"><?=form_error('email')?></span>
                </li>
            </ul>
            <ul class="forms">
                <li class="txt">Password <span class="req">*</span></li>
                <li class="inputfield">
                    <input required pattern="(?=.*\d)(?=.*[a-zA-Z])(?=.*[!@#$%^&]).{8,}" type="password" name="pass" class="bar" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" ><br>
                    <span class="text-danger"><?=form_error('pass')?></span>
                </li>
            </ul>
            <ul class="forms">
                <li class="txt">Password Confirm <span class="req">*</span></li>
                <li class="inputfield">
                    <input required type="password" name="pass_confirm" class="bar" ><br>
                    <span class="text-danger"><?=form_error('pass_confirm')?></span>
                </li>
            </ul>
            <ul class="forms">
                <li class="txt">&nbsp;</li>
                <li>
                    <button type="submit" name="btn_login">Register</button>
                </li>
            </ul>
        </form>

    </div>
    <div class="newcus">
        <h3>Please Sign In</h3>
        <p>
            By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more.
        </p>
        <a href="#" class="simplebtn"><span>Register</span></a>
    </div>
</div>
<div class="clear"></div>
</div>
<div class="clear"></div>
<div class="col3_botm">&nbsp;</div>
</div>