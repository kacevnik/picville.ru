<?php

    if (!defined('FW')) die('Forbidden');

    $args_category_list = array(
        'type'         => 'post',
        'child_of'     => 0,
        'parent'       => '',
        'orderby'      => 'name',
        'order'        => 'ASC',
        'hide_empty'   => 1,
        'hierarchical' => 1,
        'exclude'      => '',
        'include'      => '',
        'number'       => 0,
        'taxonomy'     => 'category',
        'pad_counts'   => false,
    );

    $res_category_list =  array();

    $category_list = get_categories( $args_category_list );

    foreach ($category_list as $category_listt_item) {
        $res_category_list[$category_listt_item->term_id] = $category_listt_item->name;
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
                    'label' => __('Номер телефона в хедере', '{domain}'),
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

                'kdv_slogan_1' => array(
                    'type'  => 'text',
                    'value' => 'ДОБРО ПОЖАЛОВАТЬ В ASBIS',
                    'attr'  => array( 'class' => 'custom-class', 'data-foo' => 'bar' ),
                    'label' => __('Слоган №1', '{domain}'),
                    'desc'  => __('', '{domain}'),
                    'help'  => __('Слоган на главной страрнице', '{domain}'),
                ),

                'kdv_slogan_2' => array(
                    'type'  => 'text',
                    'value' => 'Ознакомтесь с нашими последними курасами',
                    'attr'  => array( 'class' => 'custom-class', 'data-foo' => 'bar' ),
                    'label' => __('Слоган №2', '{domain}'),
                    'desc'  => __('', '{domain}'),
                    'help'  => __('Нижний слоган на главной страрнице', '{domain}'),
                ),
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