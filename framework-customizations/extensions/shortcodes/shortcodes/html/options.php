<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(

	'custom_text' => array(
	    'type'  => 'textarea',
	    'label' => __('html код элемента', '{domain}'),
	    'help'  => __('Используйте html код элемента для вставки в теги div', '{domain}'),
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
);