    <?php
        if (defined( 'FW' )){
            $kdv_add_new_bottom_info  = fw_get_db_settings_option('kdv_add_new_bottom_info');

            if(count($kdv_add_new_bottom_info) > 0){
    ?>

        <div class="advantages flex-container">
            <?php
                foreach ($kdv_add_new_bottom_info as $kdv_add_new_bottom_info_item) {
            ?>
            <div class="advantage col-3">
                <span class="advantage__icon-wrap">
                    <i class="<?php echo $kdv_add_new_bottom_info_item['icon']['icon-class']; ?>"></i>
                </span>

                <p class="advantage__title">
                    <?php echo $kdv_add_new_bottom_info_item['name']; ?>
                </p>

            </div><!--advantage-->
<?php } ?>

        </div><!--advantages-->
        <?php
            } }
        ?>