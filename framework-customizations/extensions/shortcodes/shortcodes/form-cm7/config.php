<?php if (!defined('FW')) die('Forbidden');

$cfg = array();

$cfg = array(
    'page_builder' => array(
    'title'         => __('CF-7', 'fw'),
    'description'   => __('Блок с контактной формой плагина Contact Form 7.', 'fw'),
    'tab'           => __('Content Elements', 'fw'),
    'popup_size'    => 'medium', // can be large, medium or small

        /*
        // Icon examples
        // Note: By default is loaded {your-shortcode}/static/img/page_builder.png
        'icon' => 'http://.../image-16x16.png', // background color should be #8c8c8c
        'icon' => 'dashicons dashicons-admin-site',
        'icon' => 'unycon unycon-crown',*/
    'icon' => 'fa fa-envelope-open-o',
        

        /*
        // Title Template examples
        //
        // Syntax:
        // * {{- variable }} - Output with html escape
        // * {{= variable }} - Output raw (without html escape)
        // * {{ if (execute.any(javascript, code)) { console.log('Hi'); } }}
        //
        // Available variables:
        // * title - shortcode title (from config)
        // * o - an object with all shortcode options values
        'title_template' => '{{- title }} Lorem {{- o.option_id }} ipsum {{= o["option-id"] }}',
        'title_template' => '{{- title }}: {{- o.label }}{{ if (o.target == "_blank") { }} <span class="dashicons dashicons-external"></span>{{ } }}',
        */
    )
);