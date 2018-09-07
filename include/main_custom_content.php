    <?php
        if (defined( 'FW' )){
            $kdv_add_new_main_info  = fw_get_db_settings_option('kdv_add_new_main_info');

            if(count($kdv_add_new_main_info) > 0){

            $count = 3;
    ?>
<section class="types">
        <div class="content">
            <?php foreach ($kdv_add_new_main_info as $kdv_add_new_main_info_item) { ?>
            <div class="type flex-container">
                <?php if($count%2 > 0){ ?>
                <div class="type__photo col-6">
                    <img src="<?php $url = wp_get_attachment_image_src($kdv_add_new_main_info_item['img']['attachment_id'], 'big-thumb'); echo $url[0]; ?>" alt="<?php echo $kdv_add_new_main_info_item['title']; ?>">
                    <i class="type__arrow type__arrow-right"></i>
                </div><!--type__photo-->
                <?php }else{ ?>
                <div class="type__text col-6">
                    <div class="type__center">
                        <p class="type__title">
                            <?php echo $kdv_add_new_main_info_item['title']; ?>
                        </p>

                        <p class="type__desc">
                            <?php echo $kdv_add_new_main_info_item['body']; ?>
                        </p>

                        <a href="<?php echo $kdv_add_new_main_info_item['link']; ?>" class="red-btn type__link"><?php echo $kdv_add_new_main_info_item['link_text']; ?></a>

                    </div><!--type__center-->

                </div><!--type__text-->
                <?php } ?>
                <?php if($count%2 == 0){ ?>
                <div class="type__photo col-6">
                    <img src="<?php $url = wp_get_attachment_image_src($kdv_add_new_main_info_item['img']['attachment_id'], 'big-thumb'); echo $url[0]; ?>" alt="<?php echo $kdv_add_new_main_info_item['title']; ?>">
                    <i class="type__arrow type__arrow-left"></i>
                </div><!--type__photo-->
                <?php }else{ ?>
                <div class="type__text col-6">
                    <div class="type__center">
                        <p class="type__title">
                            <?php echo $kdv_add_new_main_info_item['title']; ?>
                        </p>

                        <p class="type__desc">
                            <?php echo $kdv_add_new_main_info_item['body']; ?>
                        </p>

                        <a href="<?php echo $kdv_add_new_main_info_item['link']; ?>" class="red-btn type__link"><?php echo $kdv_add_new_main_info_item['link_text']; ?></a>

                    </div><!--type__center-->

                </div><!--type__text-->
                <?php } ?>
            </div><!--type-->
<?php $count++; } ?>

        </div><!--content-->

    </section><!--types-->
    <?php }} ?>