<?php if (!defined('FW')) {
	die('Forbidden');
}

$options = array(
	'option_main' => array(
	    'type' => 'tab',
	    'title' => __('Настройки', '{domain}'),
	    'options' => array(
			'is_fullwidth' => array(
				'label'        => __('Full Width', 'fw'),
				'type'         => 'switch',
			),
			'background_color' => array(
				'label' => __('Background Color', 'fw'),
				'desc'  => __('Please select the background color', 'fw'),
				'type'  => 'color-picker',
			),
			'background_image' => array(
				'label'   => __('Background Image', 'fw'),
				'desc'    => __('Please select the background image', 'fw'),
				'type'    => 'background-image',
				'choices' => array(//	in future may will set predefined images
				)
			),

			'background_size' => array(
				'label' => __('Размер фона.', 'fw'),
				'desc'  => __('Размер фоновой картинки. Можно задать: cover, contain или в процентах.', 'fw'),
				'type'  => 'text',
			),

			'video' => array(
				'label' => __('Background Video', 'fw'),
				'desc'  => __('Insert Video URL to embed this video', 'fw'),
				'type'  => 'text',
			),

			'kdv_custom_style' => array(
				'label' => __('Пользовательский класс CSS', 'fw'),
				'desc'  => __('Укажите пользовательский класс CSS', 'fw'),
				'type'  => 'text',
			),

			'kdv_custom_id' => array(
				'label' => __('id элемента', 'fw'),
				'desc'  => __('задайте id элемента', 'fw'),
				'type'  => 'text',
			)
		)
	),

	'option_paralax' => array(
	    'type' => 'tab',
	    'title' => __('Парралакс', '{domain}'),
	    'options' => array(
			'is_paralax' => array(
				'label'        => __('Включить парралакс', 'fw'),
				'type'         => 'switch',
				'desc'         => __('Для корректной работы следует задать картинку заднего фона', 'fw'),
			),

			'speed_parallax' => array(
				'label' => __('Скорость скрола', 'fw'),
				'desc'  => __('Задайте скорость парралакс эфекта: от 0.1 до 1', 'fw'),
				'type'  => 'text',
				'value' => '0.5'
			)
	    )
	)
);
