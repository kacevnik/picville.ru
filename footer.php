<?php
    if (defined( 'FW' )){
        $kdv_phone_header  = fw_get_db_settings_option('kdv_phone_header');
        $kdv_copy_footer  = fw_get_db_settings_option('kdv_copy_footer');
        $kdv_select_politic  = fw_get_db_settings_option('kdv_select_politic');
        $replace = str_replace(array(' ', '(', ')', '-'), "", $kdv_phone_header);

    }
?>
    <footer class="footer">
        <div class="content spacer">
            <?php $args = array(
                'theme_location' => 'bottom-1',
                'container'=> false,
                'menu_class' => 'site-map',
            );
            wp_nav_menu($args);
            ?>

            <?php $args = array(
                'theme_location' => 'bottom-2',
                'container'=> false,
                'menu_class' => 'site-map',
            );
            wp_nav_menu($args);
            ?>

            <div class="footer__right">
                <div class="spacer">
                    <a href="tel:<?php echo $replace; ?>" class="phone phone_white">
                        <svg class="icon icon-phone-red"><use xlink:href="#icon-phone"></use></svg>
                        <span><?php echo $kdv_phone_header; ?></span>
                    </a>

                    <button class="white-btn callback">Обратный звонок</button>

                    <div class="basket basket_white">
                        <?php global $woocommerce; ?>
                        <a href="<?php echo $woocommerce->cart->get_cart_url() ?>">
                            <span class="basket__count">
                                <svg class="icon icon-basket-white"><use xlink:href="#icon-basket"></use></svg>
                                <i class="basket_count_fun"><?php echo sprintf($woocommerce->cart->cart_contents_count); ?></i>
                            </span>

                            <span class="basket__sum">
                                <?php echo $woocommerce->cart->get_cart_total(); ?>
                            </span>
                        </a>
                    </div><!--basket-->

                </div><!--spacer-->

                <div class="footer__bottom">
                    <p class="copyright">
                        <?php echo $kdv_copy_footer; ?>
                    </p>

                    <a href="<?php echo get_permalink($kdv_select_politic); ?>" class="privacy"><?php echo get_the_title( $kdv_select_politic ); ?></a>

                </div><!--footer__bottom-->


            </div><!--header__right-->

        </div><!--content-->
        
    </footer>

</section><!--page-wrap-->
<?php wp_footer(); ?>
</body>
</html>