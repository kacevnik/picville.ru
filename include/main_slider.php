    <?php
        if (defined( 'FW' )){
            $kdv_slider_off  = fw_get_db_settings_option('kdv_slider_off');

            if($kdv_slider_off){
                $kdv_add_new_main_slide = fw_get_db_settings_option('kdv_add_new_main_slide');
    ?>
    <section class="main-slider">
        <div class="main-slider__slides owl-carousel">
            <?php
                foreach ($kdv_add_new_main_slide as $slider_item) {
            ?>
            <div class="main-slider__slide">
                <div class="content">
                    <div class="main-slider__left">
                        <p class="main-slider__title">
                            <?php echo $slider_item['option_1']; ?>
                        </p>

                        <p class="main-slider__desc">
                            <?php echo $slider_item['option_2']; ?>
                        </p>

                        <a href="<?php echo $slider_item['option_5']; ?>" class="red-btn main-slider__link">
                            <?php echo $slider_item['option_4']; ?>
                        </a>

                    </div><!--main-slide__left-->

                </div><!--content-->

                <i class="main-slider__bg" style="background-image: url('<?php echo $slider_item['option_3']['url']; ?>');"></i>

            </div>

<?php
    }
?>
        </div>

    </section><!--main-slider-->
<?php
    } }
?>