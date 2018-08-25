<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Estore 16</title>
    <!-- // Stylesheets // -->
    <base href="<?=base_url()?>">
    <link rel="stylesheet" href="public/css/style.css" type="text/css" >
    <link rel="stylesheet" href="public/css/nivo-slider.css" type="text/css" media="screen" >
    <link rel="stylesheet" href="public/css/default.advanced.css" type="text/css" >
    <link rel="stylesheet" href="public/css/contentslider.css" type="text/css"  >
    <link rel="stylesheet" href="public/css/jquery.fancybox-1.3.1.css" type="text/css" media="screen" >
    <!-- // Javascript // -->
    <script type="text/javascript" src="public/js/jquery.min.js"></script>
    <script type="text/javascript" src="public/js/jquery.min14.js"></script>
    <script type="text/javascript" src="public/js/jquery.easing.1.2.js"></script>
    <script type="text/javascript" src="public/js/jcarousellite_1.0.1.js"></script>
    <script type="text/javascript" src="public/js/scroll.js"></script>
    <script type="text/javascript" src="public/js/ddaccordion.js"></script>
    <script type="text/javascript" src="public/js/acordn.js"></script>
    <script type="text/javascript" src="public/js/cufon-yui.js"></script>
    <script type="text/javascript" src="public/js/Trebuchet_MS_400-Trebuchet_MS_700-Trebuchet_MS_italic_700-Trebuchet_MS_italic_400.font.js"></script>
    <script type="text/javascript" src="public/js/cufon.js"></script>
    <script type="text/javascript" src="public/js/contentslider.js"></script>
    <script type="text/javascript" src="public/js/jquery.fancybox-1.3.1.js"></script>
    <script type="text/javascript" src="public/js/lightbox.js"></script>
    <style>
        .high-light{color: #2aabd2!important; font-weight: bold!important; font-size: large}
        .text-danger{color: red; font-size: small}
        .sort-high-light{color: red!important;
            font-weight: bold;
            background-color: yellow;}
    </style>
</head>

<body>
<a name="top"></a>
<div id="wrapper_sec">
    <!-- Header -->
    <div id="masthead">
        <div class="secnd_navi">
            <ul class="links">
                <li style="color: aqua; font-weight: bold">Welcome LAMPART</li>
                <li><a style="color: red; font-weight: bold" href="<?=site_url('cart/show_order')?>"><?=$this->session->user_name?></a></li>
                <li><a href="<?=site_url()?>/cart/show">My Cart</a></li>
                <li><a href="<?=site_url()?>/cart/checkout">Checkout</a></li>
                <?php ?>
                <?php if($this->session->has_userdata('user_id')):?>
                    <li ><a href="<?=site_url()?>/users/Logout">Logout</a></li>
                    <li class="last"><a href="<?=site_url()?>/users/update">Update Profile</a></li>
                <?php else:?>
                    <li><a href="<?=site_url()?>/users/login">Log In</a></li>
                    <li class="last"><a href="<?=site_url()?>/users/register">Register</a></li>
                <?php endif;?>
            </ul>
            <ul class="network">
                <li>Share with us:</li>
                <li><a href="#"><img src="public/images/linkdin.gif" alt="" ></a></li>
                <li><a href="#"><img src="public/images/rss.gif" alt="" ></a></li>
                <li><a href="#"><img src="public/images/twitter.gif" alt="" ></a></li>
                <li><a href="#"><img src="public/images/facebook.gif" alt="" ></a></li>
            </ul>
        </div>
        <div class="clear"></div>
        <div class="logo">
            <a href="index.html"><img src="public/images/logo.png" alt="" ></a>
            <h5 class="slogn">The best watches for all</h5>
        </div>
        <ul class="search">
            <li><input type="text" value="Search" id="searchBox" name="s" onblur="if(this.value == '') { this.value = 'Search'; }" onfocus="if(this.value == 'Search') { this.value = ''; }" class="bar" ></li>
            <li><a href="#" class="searchbtn">Search for Products</a></li>
        </ul>
        <div class="clear"></div>
        <div class="navigation">
            <ul id="nav" class="dropdown dropdown-linear dropdown-columnar">
                <li><a href="<?=site_url()?>/home">Home</a></li>
                <li><a href="static.html">About Us</a></li>
                <li class="dir"><a href="#">Department More</a>
                    <ul class="bordergr big">

                        <?php foreach ($menus as $depart => $cate): ?>
                        <li class="dir"><span class="colr navihead bold"><?=$depart?></span>
                            <ul>
                                <?php foreach ($cate as $ca): ?>
                                <li><a href="<?=site_url()?>/listing/lists/<?=$ca['fc_id']?>"><?=$ca['fc_name']?></a></li>
                                <?php endforeach;?>
                            </ul>
                        </li>
                        <?php endforeach;?>

                    </ul>
                </li>
                <li><a href="login.html">BedSheets</a></li>
                <li class="dir"><a href="#">Pages</a>
                    <ul class="bordergr small">
                        <li class="dir"><span class="colr navihead bold">Pages</span>
                            <ul>
                                <li class="clear"><a href="<?=site_url()?>/home">Home Page</a></li>
                                <li class="clear"><a href="account.html">Account Page</a></li>
                                <li class="clear"><a href="cart.html">Shopping Cart Page</a></li>
                                <li class="clear"><a href="categories.html">Categories</a></li>
                                <li class="clear"><a href="detail.html">Product Detail Page</a></li>
                                <li class="clear"><a href="listing.html">Listing Page</a></li>
                                <li class="clear"><a href="login.html">Login Page</a></li>
                                <li class="clear"><a href="static.html">Static Page</a></li>
                                <li class="clear"><a href="contact.html">Contact Page</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li><a href="contact.html">Contact</a></li>
                <li class="dir"><a href="#">Themes</a>
                    <ul class="bordergr small">
                        <li class="dir"><span class="colr navihead bold">Themes</span>
                            <ul>
                                <li class="clear"><a href="../blue/index.html">Blue</a></li>
                                <li class="clear"><a href="../green/index.html">Green</a></li>
                                <li class="clear"><a href="../orange/index.html">Orange</a></li>
                                <li class="clear"><a href="index.html">Purple</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul class="lang">
                <li>Your Language:</li>
                <li><a href="#"><img src="public/images/flag1.gif" alt="" ></a></li>
                <li><a href="#"><img src="public/images/flag2.gif" alt="" ></a></li>
                <li><a href="#"><img src="public/images/flag3.gif" alt="" ></a></li>
            </ul>
        </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>

    <div class="clear"></div>
    <!-- Scroolling Products -->
    <div class="content_sec">
        <!-- Column2 Section -->
        <div class="col2">
            <div class="col2_top">&nbsp;</div>
            <div class="col2_center">
