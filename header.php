<?php
    if (defined( 'FW' )){
        $kdv_phone_header  = fw_get_db_settings_option('kdv_phone_header');
        $kdv_logo_header   = fw_get_db_settings_option('kdv_logo');
        $replace = str_replace(array(' ', '(', ')', '-'), "", $kdv_phone_header);
    }
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <title><?php wp_title('/'); ?></title>
    <link rel="alternate" type="application/rdf+xml" title="RDF mapping" href="<?php bloginfo('rdf_url'); ?>">
    <link rel="alternate" type="application/rss+xml" title="RSS" href="<?php bloginfo('rss_url'); ?>">
    <link rel="alternate" type="application/rss+xml" title="Comments RSS" href="<?php bloginfo('comments_rss2_url'); ?>">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/style.css">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<section class="page-wrap">
    <header class="header content spacer">
        <a href="<?php echo home_url(); ?>" class="logo" style="background: url(<?php echo $kdv_logo_header['url']; ?>) no-repeat;"></a>

        <div class="header__right spacer">
            <a href="tel:<?=$replace?>" class="phone">
                <svg class="icon icon-phone"><use xlink:href="#icon-phone"></use></svg>
                <span><?=$kdv_phone_header?></span>
            </a>

            <button class="black-btn callback">Обратный звонок</button>

            <div class="basket">
                <?php global $woocommerce; ?>
                <a href="<?php echo $woocommerce->cart->get_cart_url() ?>">
                <span class="basket__count">
                    <svg class="icon icon-basket"><use xlink:href="#icon-basket"></use></svg>
                    <i class="basket_count_fun"><?php echo sprintf($woocommerce->cart->cart_contents_count); ?></i>
                </span>

                <span class="basket__sum">
                    <?php echo $woocommerce->cart->get_cart_total(); ?>
                </span>
                </a>
            </div><!--basket-->

        </div><!--header__right-->

    </header>
    <nav class="nav content">
        <span class="nav__btn"></span>
            <?php
                $args = array('theme_location' => 'top', 'container'=> false, 'menu_class' => 'nav__list spacer', 'menu_id' => 'main-nav', 'depth' => 0);
                wp_nav_menu($args);
            ?>
    </nav>