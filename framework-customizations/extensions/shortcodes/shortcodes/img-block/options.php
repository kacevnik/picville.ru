<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$animation_arr = array(
	array(
		'attr'    => array('label' => __('Attention Seekers', '{domain}')),
		'choices' => array(
            'bounce'             => __('bounce', '{domain}'),
            'flash'              => __('flash', '{domain}'),
            'pulse'              => __('pulse', '{domain}'),
            'rubberBand'         => __('rubberBand', '{domain}'),
            'shake'              => __('shake', '{domain}'),
            'swing'              => __('swing', '{domain}'),
            'tada'               => __('tada', '{domain}'),
            'wobble'             => __('wobble', '{domain}'),
            'jello'              => __('jello', '{domain}')
        )
    ),

	array(
       	'attr'    => array('label' => __('Bouncing Entrances', '{domain}')),
		'choices' => array(
            'bounceIn'           => __('bounceIn', '{domain}'),
            'bounceInDown'       => __('bounceInDown', '{domain}'),
            'bounceInLeft'       => __('bounceInLeft', '{domain}'),
            'bounceInRight'      => __('bounceInRight', '{domain}'),
            'bounceInUp'         => __('bounceInUp', '{domain}')
        )
    ),

    array(
        'attr'    => array('label' => __('Bouncing Exits', '{domain}')),
		'choices' => array(
            'bounceOut'          => __('bounceOut', '{domain}'),
            'bounceOutDown'      => __('bounceOutDown', '{domain}'),
            'bounceOutLeft'      => __('bounceOutLeft', '{domain}'),
            'bounceOutRight'     => __('bounceOutRight', '{domain}'),
            'bounceOutUp'        => __('bounceOutUp', '{domain}')
        )
    ),

    array(
       	'attr'    => array('label' => __('Fading Entrances', '{domain}')),
		'choices' => array(
            'fadeIn'             => __('fadeIn', '{domain}'),
            'fadeInDown'         => __('fadeInDown', '{domain}'),
            'fadeInDownBig'      => __('fadeInDownBig', '{domain}'),
            'fadeInLeft'         => __('fadeInLeft', '{domain}'),
            'fadeInLeftBig'      => __('fadeInLeftBig', '{domain}'),
            'fadeInRight'        => __('fadeInRight', '{domain}'),
            'fadeInRightBig'     => __('fadeInRightBig', '{domain}'),
            'fadeInUp'           => __('fadeInUp', '{domain}'),
            'fadeInUpBig'        => __('fadeInUpBig', '{domain}')
        )
    ),

    array(
       	'attr'    => array('label' => __('Fading Exits', '{domain}')),
		'choices' => array(
            'fadeOut'            => __('fadeOut', '{domain}'),
            'fadeOutDown'        => __('fadeOutDown', '{domain}'),
            'fadeOutDownBig'     => __('fadeOutDownBig', '{domain}'),
            'fadeOutLeft'        => __('fadeOutLeft', '{domain}'),
            'fadeOutLeftBig'     => __('fadeOutLeftBig', '{domain}'),
            'fadeOutRight'       => __('fadeOutRight', '{domain}'),
            'fadeOutRightBig'    => __('fadeOutRightBig', '{domain}'),
            'fadeOutUp'          => __('fadeOutUp', '{domain}'),
            'fadeOutUpBig'       => __('fadeOutUpBig', '{domain}')
        )
    ),

    array(
        'attr'    => array('label' => __('Flippers', '{domain}')),
		'choices' => array(
            'flip'               => __('flip', '{domain}'),
            'flipInX'            => __('flipInX', '{domain}'),
            'flipInY'            => __('flipInY', '{domain}'),
            'flipOutX'           => __('flipOutX', '{domain}'),
            'flipOutY'           => __('flipOutY', '{domain}')
        )
    ),

    array(
        'attr'    => array('label' => __('Lightspeed', '{domain}')),
		'choices' => array(
            'lightSpeedIn'       => __('lightSpeedIn', '{domain}'),
            'lightSpeedOut'      => __('lightSpeedOut', '{domain}')
        )
    ),

    array(
        'attr'    => array('label' => __('Rotating Entrances', '{domain}')),
		'choices' => array(
            'rotateIn'           => __('rotateIn', '{domain}'),
            'rotateInDownLeft'   => __('rotateInDownLeft', '{domain}'),
            'rotateInDownRight'  => __('rotateInDownRight', '{domain}'),
            'rotateInUpLeft'     => __('rotateInUpLeft', '{domain}'),
            'rotateInUpRight'    => __('rotateInUpRight', '{domain}')
        )
    ),

    array(
        'attr'    => array('label' => __('Rotating Exits', '{domain}')),
		'choices' => array(
            'rotateOut'          => __('rotateOut', '{domain}'),
            'rotateOutDownLeft'  => __('rotateOutDownLeft', '{domain}'),
            'rotateOutDownRight' => __('rotateOutDownRight', '{domain}'),
            'rotateOutUpLeft'    => __('rotateOutUpLeft', '{domain}'),
            'rotateOutUpRight'   => __('rotateOutUpRight', '{domain}')
        )
    ),

    array(
        'attr'    => array('label' => __('Sliding Entrances', '{domain}')),
		'choices' => array(
            'slideInUp'          => __('slideInUp', '{domain}'),
            'slideInDown'        => __('slideInDown', '{domain}'),
            'slideInLeft'        => __('slideInLeft', '{domain}'),
            'slideInRight'       => __('slideInRight', '{domain}')
        )
    ),

    array(
        'attr'    => array('label' => __('Sliding Exits', '{domain}')),
		'choices' => array(
            'slideOutUp'         => __('slideOutUp', '{domain}'),
            'slideOutDown'       => __('slideOutDown', '{domain}'),
            'slideOutLeft'       => __('slideOutLeft', '{domain}'),
            'slideOutRight'      => __('slideOutRight', '{domain}')
        )
    ),

    array(
        'attr'    => array('label' => __('Zoom Entrances', '{domain}')),
		'choices' => array(
            'zoomIn'             => __('zoomIn', '{domain}'),
            'zoomInDown'         => __('zoomInDown', '{domain}'),
            'zoomInLeft'         => __('zoomInLeft', '{domain}'),
            'zoomInRight'        => __('zoomInRight', '{domain}'),
            'zoomInUp'           => __('zoomInUp', '{domain}')
        )
    ),

    array(
        'attr'    => array('label' => __('Specials', '{domain}')),
		'choices' => array(
            'hinge'              => __('hinge', '{domain}'),
            'rollIn'             => __('rollIn', '{domain}'),
            'rollOut'            => __('rollOut', '{domain}')
        )
    )

);

$options = array(
	'option_main' => array(
	    'type' => 'tab',
	    'title' => __('Настройки', '{domain}'),
	    'options' => array(
			'title' => array(
				'type'  => 'text',
				'label' => __( 'Заголовок', 'fw' ),
				'help'  => __( 'Укажите заголовок блока (выводиться в тегах h3)', 'fw' ),
			),

			'custom_text' => array(
			    'type'          => 'wp-editor',
			    'label'         => __('Произвольный текст', '{domain}'),
			    'size'          => 'small', // small, large
			    'editor_height' => 400,
			    'wpautop'       => true,
			    'editor_type'   => true, // tinymce, html
                'size'          => 'large', // small, large

			    /**
			     * Also available
			     * https://github.com/WordPress/WordPress/blob/4.4.2/wp-includes/class-wp-editor.php#L80-L94
			     */
			),

            'dop_text' => array(
                'type'  => 'textarea',
                'value' => '',
                'label' => __('Дополнительный HTML', '{domain}'),
                'desc'  => __('Задайте дополнительный html код при обрезке визуальным редактором', '{domain}'),
            ),

			'bg_color' => array(
			    'type'  => 'color-picker',
			    // palette colors array
			    'label' => __('Цвет фона', '{domain}'),
			    'help'  => __('Укажите цвет фона', '{domain}'),
			),

			'custom_class' => array(
				'type'  => 'text',
				'label' => __( 'Пользовательский CSS клас', 'fw' ),
				'desc'  => __( '', 'fw' ),
			),

			'custom_id' => array(
				'type'  => 'text',
				'label' => __( 'Пользовательский id элемента', 'fw' ),
			)
		)
    ),

    'option_header' => array(
        'type' => 'tab',
        'title' => __('Заголовок', '{domain}'),
        'options' => array(
            'header' => array(
                'type'  => 'select',
                'label' => __( 'Тип Заголовка', 'fw' ),
                'help'  => __( 'Укажите тип заголовка (от H1 до H6)', 'fw' ),
                'choices' => array(
                    'h1' => 'h1',
                    'h2' => 'h2',
                    'h3' => 'h3',
                    'h4' => 'h4',
                    'h5' => 'h5',
                    'h6' => 'h6',
                ),
                'no-validate' => false
            )
        )
    ),

    'option_animate' => array(
	    'type' => 'tab',
	    'title' => __('Анимация', '{domain}'),
	    'options' => array(
    		'animate_off' => array(
			    'type'  => 'switch',
			    'label' => __('Анимация включена', '{domain}'),
			),

			'select_animate' => array(
			    'type'  => 'select',
			    'label' => __('Тип анимации', '{domain}'),
			    'help'  => __('Выберие тип анимации. Примеры работы можно посмотреть на сайте daneden.github.io/animate.css/', '{domain}'),
			    'choices' => $animation_arr,

			    /**
			     * Allow save not existing choices
			     * Useful when you use the select to populate it dynamically from js
			     */
			    'no-validate' => false
			),

			'duration' => array(
				'type'  => 'text',
				'label' => __( 'Продолжительность анимации', 'fw' ),
				'help'  => __( 'Укажите продолжительность анимации (в милисикундах)', 'fw' ),
			),

			'delay' => array(
				'type'  => 'text',
				'label' => __( 'Задержка', 'fw' ),
				'help'  => __( 'Задержка перед началом анимации (в милисикундах)', 'fw' ),
			),

			'offset' => array(
				'type'  => 'text',
				'label' => __( 'Отступ', 'fw' ),
				'help'  => __( 'Расстояние до запуска анимации (относительно нижней части окна браузера в px)', 'fw' ),
			),

			'iteration' => array(
				'type'  => 'text',
				'label' => __( 'Повтор', 'fw' ),
				'help'  => __( 'Повторяем анимацию «столько-то раз»', 'fw' ),
			)
		)
    )
);