
        <h2 class="heading colr">Login</h2>
        <div class="login">
            <div class="registrd">


                <div class="text-danger"><?php echo validation_errors(); ?></div>
                <?php echo form_open(''); ?>
                    <ul class="forms">
                        <li class="txt">Email Address <span class="req">*</span></li>
                        <li class="inputfield">

                            <input required value="<?=set_value('email')?>" type="email" name="email" class="bar" ><br>
                            <span class="text-danger"></span>
                        </li>
                    </ul>
                    <ul class="forms">
                        <li class="txt">Password <span class="req">*</span></li>
                        <li class="inputfield">
                            <input required type="password" name="pass" class="bar" ><br>
                            <span class="text-danger"></span>
                        </li>
                    </ul>
                    <ul class="forms">
                        <li class="txt">&nbsp;</li>
                        <li>
                            <button type="submit" name="btn_login">Login</button>
                            <a href="inited.php?mod=forget" class="forgot">Forgot Your Password?</a>
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