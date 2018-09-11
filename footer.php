<?php
    if (defined( 'FW' )){
        $kdv_phone_header  = fw_get_db_settings_option('kdv_phone_header');
        $kdv_copy_footer  = fw_get_db_settings_option('kdv_copy_footer');
        $kdv_select_politic  = fw_get_db_settings_option('kdv_select_politic');
        $replace = str_replace(array(' ', '(', ')', '-'), "", $kdv_phone_header);

    }
    dynamic_sidebar( 'footer-sidebar' );
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

                    <a data-fancybox data-src="#form_calback" href="javascript:;" class="white-btn callback">Обратный звонок</a>

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
<div class="hidden_form" id="form_calback">
    <form action="<?php echo get_template_directory_uri(); ?>/send.php" method="post" id="hidden_form">
        <h3>Заполните форму</h3>
        <p>И мы свяжемся с Вами в ближайшее врмя</p>
        <input type="text" name="name" placeholder="Ваше имя" required="required" value="" class="input_text">
        <input type="text" name="phone" placeholder="Номер телефона" required="required" value="" class="input_text">
        <input type="hidden" name="page" value="">
        <input type="hidden" name="form" value="Форма - Перезвоните мне.">
        <input type="submit" name="submit" value="Отправить"  class="input_button">
    </form>
</div>
<a data-fancybox data-src="#thanks_window" href="javascript:;" style="display: none;" id="thanks_link">Спасибо</a>
<div id="thanks_window">
    <h3>Спасибо!<br>Мы свяжемся с Вами в ближайшее время</h3>
</div>
<?php wp_footer(); ?>
</body>
</html>