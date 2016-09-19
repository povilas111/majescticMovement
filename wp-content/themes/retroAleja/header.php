<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700&subset=latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/style.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/font-awesome/font-awesome.min.css" type="text/css">


    <?php wp_enqueue_script("jquery"); ?>
   <?php wp_head(); ?>
  </head>
  <body>
<!--<header>

    <div class="container-fluid header-container">
<div class="container">
        <div class="responsive-menu clearfix">
            <button class="hamburger hamburger--squeeze" type="button">
              <span class="hamburger-box">
                <span class="hamburger-inner"></span>
              </span>
            </button>
            <div class="logo"><a href="#"><img alt="" src="<?php header_image(); ?>" width="" height=""></a></div>
           <!-- <ul class="web-language">
                <li class="change-language">
                    <ul>
                        <li class="active"><a href="#">LT</a></li>
                        <li><a href="#">RU</a></li>
                    </ul>
                </li>
            </ul>
        </div>

        <div class="meniu">
            <div class="col-sm-4">
				<?php wp_nav_menu( array( 'theme_location' => 'top_left', 'menu_class'=>'') ); ?>
			</div>
           <div class="col-sm-4">
				<div class="logo"><a href="<?php echo site_url(); ?>"><img alt=""  src="<?php header_image(); ?>" width="" height=""></a></div>
           </div>
		   <div class="col-sm-4">
				<?php wp_nav_menu( array( 'theme_location' => 'top_right', 'menu_class'=>'') ); ?>
            </div>
        </div>
</div>

    </div>
    <div class="sticky-meniu container-fluid">
		<div class="container">
			<ul>
			<?php wp_nav_menu( array( 'theme_location' => 'meniu', 'menu_class'=>'') ); ?>
			</ul>
		</div>
	</div>
    <div class="responsive-main-menu container-fluid">
	<div class="container">
        <a href="#" class="slide-down"><h4>Produktų katalogas</h4></a>
        <div class="responsive-list">
			<?php wp_nav_menu( array( 'theme_location' => 'product_list', 'menu_class'=>'') ); ?>
        </div>
    </div>
	</div>
</header>
-->
<header>
    <div class="header-container">
        <div class="responsive-menu">
            <div class="col-md-4">
                <div class="top-left-menu">
                    <button class="hamburger hamburger--squeeze" type="button">
                        <span class="hamburger-box"><span class="hamburger-inner"></span></span>
                    </button>
                </div>
            </div>
            <div class="col-md-4">
                <div class="logo"><a href="#"><img src="<?php echo get_template_directory_uri();?>/images/logo.png"></a></div>
            </div>
            <div class="col-md-4">
                <div class="top-right-menu">
                    <div class="web-language">
                        <ul>
                            <li><a href="#">LT</a></li>
                            <li><a href="#">RU</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="meniu container">
            <div class="col-md-4">
                <div class="top-left-menu">
                    <a href="#">Produktu katalogas</a>
                    <a href="#">Apie mus</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="logo"><a href="#"><img src="<?php echo get_template_directory_uri();?>/images/logo.png"></a></div>
            </div>
            <div class="col-md-4">
                <div class="top-right-menu">
                    <a href="#">Kontaktai</a>
                    <div class="web-language">
                        <ul>
                            <li><a href="#">LT</a></li>
                            <li><a href="#">RU</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <div class="main-menu container-fluid">
        <ul>
            <li><a href="#">Svetainei</a></li>
            <li><a href="#">Valgomajam</a></li>
            <li><a href="#">Darbo kambariui</a></li>
            <li><a href="#">Miegamajam</a></li>
            <li><a href="#">Provanso</a></li>
            <li><a href="#">Sendaikčiai</a></li>
        </ul>
    </div>
    <div class="responsive-main-menu container-fluid">
        <a href="#" class="slide-down"><h4>Produktų katalogas</h4></a>
        <div class="responsive-list">
            <ul>
                <li class="menu-item-has-children"><a href="#">Svetainei </a>
                    <ul class="sub-menu">
                        <li><button class="more-info" href="#">Visi</button></li>
                        <li><a href="#">Odiniai Komplektai</a></li>
                        <li><a href="#">Sofos ir suoliukai</a></li>
                        <li><a href="#">Foteliai ir krėslai</a></li>
                        <li><a href="#">Staliukai</a></li>
                        <li><a href="#">Bufetai ir indaujos</a></li>
                        <li><a href="#">Komodos ir sekreteriai</a></li>
                        <li><a href="#">Sekcijos</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children"><a href="#">Valgomajam</a>
                    <ul class="sub-menu">
                        <li><button class="more-info" href="#">Visi</button></li>
                        <li><a href="#">Odiniai Komplektai</a></li>
                        <li><a href="#">Kėdės ir suoliukai</a></li>
                        <li><a href="#">Staliukai</a></li>
                        <li><a href="#">Bufetai ir indaujos</a></li>
                        <li><a href="#">Komodos ir sekreteriai</a></li>
                        <li><a href="#">Sekcijos</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children"><a href="#">Darbo kambariui</a></li>
                <li class="menu-item-has-children"><a href="#">Miegamajam</a></li>
                <li class="menu-item-has-children"><a href="#">Provanso</a></li>
                <li class="menu-item-has-children"><a href="#">Sendaikčiai</a></li>
            </ul>
        </div>

    </div>
</header>
<div class="wrapper">
  <div class="container">
  