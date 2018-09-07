<?php

    if (!defined('FW')) die('Forbidden');

    // $args_category_list = array(
    //     'type'         => 'post',
    //     'child_of'     => 0,
    //     'parent'       => '',
    //     'orderby'      => 'name',
    //     'order'        => 'ASC',
    //     'hide_empty'   => 1,
    //     'hierarchical' => 1,
    //     'exclude'      => '',
    //     'include'      => '',
    //     'number'       => 0,
    //     'taxonomy'     => 'category',
    //     'pad_counts'   => false,
    // );

    // $res_category_list =  array();

    // $category_list = get_categories( $args_category_list );

    // foreach ($category_list as $category_listt_item) {
    //     $res_category_list[$category_listt_item->term_id] = $category_listt_item->name;
    // }


    $args_page_list = array(
        'sort_order'   => 'ASC',
        'sort_column'  => 'post_title',
        'hierarchical' => 1,
        'exclude'      => '',
        'include'      => '',
        'meta_key'     => '',
        'meta_value'   => '',
        'authors'      => '',
        'child_of'     => 0,
        'parent'       => -1,
        'exclude_tree' => '',
        'number'       => '',
        'offset'       => 0,
        'post_type'    => 'page',
        'post_status'  => 'publish',
    );

    $res_page_list =  array();

    $page_list = get_pages( $args_page_list );

    foreach ($page_list as $page_list_item) {
        $res_page_list[$page_list_item->ID] = $page_list_item->post_title;
    }

//настройки для страницы настроек темы
    $options = array(
        'kdv_tap_general_opions' => array(
            'type' => 'tab',
            'options' => array(
                'kdv_phone_header' => array(
                    'type'  => 'text',
                    'value' => '+7 (812) 982-15-79',
                    'attr'  => array( 'class' => 'custom-class', 'data-foo' => 'bar' ),
                    'label' => __('Номер телефона', '{domain}'),
                    'desc'  => __('Пример: 8 (926) 321-22-23', '{domain}'),
                    'help'  => __('Укажите номер телефона для связи в верхней части сайта', '{domain}'),
                ),

                'kdv_logo' => array(
                    'type'  => 'upload',
                    'value' => array(
                        /*
                        'attachment_id' => '9',
                        'url' => '//site.com/wp-content/uploads/2014/02/whatever.jpg'
                        */
                        // if value is set in code, it is not considered and not used
                        // because there is no sense to set hardcode attachment_id
                    ),
                    'attr'  => array( 'class' => 'custom-class', 'data-foo' => 'bar' ),
                    'label' => __('Логотип', '{domain}'),
                    'desc'  => __('', '{domain}'),
                    'help'  => __('Загрузите логотип сайта (разрешенные файлы для загрузки: jpg, png, gif)', '{domain}'),
                    /**
                     * If set to `true`, the option will allow to upload only images, and display a thumb of the selected one.
                     * If set to `false`, the option will allow to upload any file from the media library.
                     */
                    'images_only' => true,
                    /**
                     * An array with allowed files extensions what will filter the media library and the upload files.
                     */
                    'files_ext' => array( 'jpg', 'png', 'gif' ),
                    /**
                     * An array with extra mime types that is not in the default array with mime types from the javascript Plupload library.
                     * The format is: array( '<mime-type>, <ext1> <ext2> <ext2>' ).
                     * For example: you set rar format to filter, but the filter ignore it , than you must set
                     * the array with the next structure array( '.rar, rar' ) and it will solve the problem.
                     */
                    'extra_mime_types' => array( 'audio/x-aiff, aif aiff' )
                ),

                'kdv_copy_footer' => array(
                    'type'  => 'text',
                    'value' => 'PictureVille © 2018 все права защищены',
                    'attr'  => array( 'class' => 'custom-class', 'data-foo' => 'bar' ),
                    'label' => __('Копирайт в футере', '{domain}'),
                ),

                'kdv_select_politic' => array(
                    'type'  => 'select',
                    'value' => '',
                    'attr'  => array( 'class' => 'custom-class', 'data-foo' => 'bar' ),
                    'label' => __('Политика конфиденциальности', '{domain}'),
                    'help'  => __('Выбирите страницу для Политики конфиденциальности', '{domain}'),
                    'choices' => $res_page_list,
                    /**
                     * Allow save not existing choices
                     * Useful when you use the select to populate it dynamically from js
                     */
                    'no-validate' => false,
                ),

                'kdv_add_new_bottom_info' => array(
                    'type' => 'addable-popup',
                    'label' => __('Инфо элементы (Footer)', '{domain}'),
                    'desc'  => __('', '{domain}'),
                    'template' => '{{- name}}',
                    'help'  => __('Добавьте элементы для отображения перед Футером', '{domain}'),
                    'popup-title' => null,
                    'size' => 'large', // small, medium, large
                    'limit' => 0, // limit the number of popup`s that can be added
                    'add-button-text' => __('Добавить элемент', '{domain}'),
                    'sortable' => true,
                    'popup-options' => array(

                        'name' => array(
                            'label' => __('Заголовок', '{domain}'),
                            'type' => 'text',
                            'value' => '',
                            'desc' => __('', '{domain}'),
                        ),

                        'icon' => array(
                        'type'  => 'icon-v2',

                        /**
                         * small | medium | large | sauron
                         * Yes, sauron. Definitely try it. Great one.
                         */
                        'preview_size' => 'medium',

                        /**
                         * small | medium | large
                         */
                        'modal_size' => 'medium',

                        /**
                         * There's no point in configuring value from code here.
                         *
                         * I'll document the result you get in the frontend here:
                         * 'value' => array(
                         *   'type' => 'icon-font', // icon-font | custom-upload
                         *
                         *   // ONLY IF icon-font
                         *   'icon-class' => '',
                         *   'icon-class-without-root' => false,
                         *   'pack-name' => false,
                         *   'pack-css-uri' => false
                         *
                         *   // ONLY IF custom-upload
                         *   // 'attachment-id' => false,
                         *   // 'url' => false
                         * ),
                         */

                        'attr'  => array( 'class' => 'custom-class', 'data-foo' => 'bar' ),
                        'label' => __('Иконка', '{domain}'),
                    )
                    ),
                )
            ),
            'title' => __('Основные настройки', '{domain}'),
            'attr' => array('class' => 'custom-class', 'data-foo' => 'bar'),
        ),

        'kdv_main_slider' => array(
            'type' => 'tab',
            'options' => array(
                'kdv_slider_off'  => array(
                    'type'  => 'switch',
                    'value' => true, // checked/unchecked
                    'label' => __('Включть слайдер', '{domain}'),
                    'desc'  => __('', '{domain}'),
                    'help'  => __('Если включить, то слайдер будет отражаться на главной странице', '{domain}')
                ),

                'kdv_add_new_main_slide' => array(
                    'type' => 'addable-popup',
                    'label' => __('Слайды', '{domain}'),
                    'desc'  => __('', '{domain}'),
                    'template' => '{{- option_1}}',
                    'popup-title' => null,
                    'size' => 'large', // small, medium, large
                    'limit' => 0, // limit the number of popup`s that can be added
                    'add-button-text' => __('Добавить слайд', '{domain}'),
                    'sortable' => true,
                    'popup-options' => array(
                        'option_3' => array(
                            'type'  => 'upload',
                            'value' => array(
                                /*
                                'attachment_id' => '9',
                                'url' => '//site.com/wp-content/uploads/2014/02/whatever.jpg'
                                */
                                // if value is set in code, it is not considered and not used
                                // because there is no sense to set hardcode attachment_id
                            ),
                            'attr'  => array( 'class' => 'custom-class', 'data-foo' => 'bar' ),
                            'label' => __('Изображение', '{domain}'),
                            'desc'  => __('', '{domain}'),
                            /**
                             * If set to `true`, the option will allow to upload only images, and display a thumb of the selected one.
                             * If set to `false`, the option will allow to upload any file from the media library.
                             */
                            'images_only' => true,
                            /**
                             * An array with allowed files extensions what will filter the media library and the upload files.
                             */
                            'files_ext' => array( 'jpg', 'png', 'gif' ),
                            /**
                             * An array with extra mime types that is not in the default array with mime types from the javascript Plupload library.
                             * The format is: array( '<mime-type>, <ext1> <ext2> <ext2>' ).
                             * For example: you set rar format to filter, but the filter ignore it , than you must set
                             * the array with the next structure array( '.rar, rar' ) and it will solve the problem.
                             */
                            'extra_mime_types' => array( 'audio/x-aiff, aif aiff' )
                        ),

                        'option_1' => array(
                            'label' => __('Заголовок', '{domain}'),
                            'type' => 'text',
                            'value' => '',
                            'desc' => __('', '{domain}'),
                        ),

                        'option_2' => array(
                            'type'  => 'textarea',
                            'value' => '',
                            'attr'  => array( 'class' => 'custom-class', 'data-foo' => 'bar' ),
                            'label' => __('Текст слайдера', '{domain}'),
                        ),

                        'option_4' => array(
                            'label' => __('Текст ссылки', '{domain}'),
                            'type' => 'text',
                            'value' => 'Узнать подробнее',
                            'desc' => __('', '{domain}'),
                        ),

                        'option_5' => array(
                            'label' => __('URL Ссылки', '{domain}'),
                            'type' => 'text',
                            'value' => '',
                            'desc' => __('', '{domain}'),
                        )
                    ),
                )
            ),

            'title' => __('Слайдер на главной', '{domain}'),
            'attr' => array('class' => 'custom-class', 'data-foo' => 'bar'),
        ),
    );

?>