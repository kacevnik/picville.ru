<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

/**
 * @var array $atts
 */

if($atts['select_form'] != '0'){

	$style = '';
	$animate = '';
	$animate_class = '';
	$add_custom_class= '';
	$title = '';


	if($atts['title'] && $atts['header']){ 
		$header = '<' . $atts['header'] . '>';
		$header_end = '</' . $atts['header'] . '>';
		$title = $header.$atts['title'].$header_end;
	}


	if($atts['custom_class']){$custom_class = ' '.$atts['custom_class'];}else{$custom_class = '';}
	if($atts['custom_id']){$custom_id = ' id="'.$atts['custom_id'].'"';}else{$custom_id = '';}

	if($atts['animate_off'] == 1){
		if($atts['select_animate']){
			$animate_class = ' wow ' . $atts['select_animate'];
		}

		if($atts['duration']){
			$animate = $animate . ' data-wow-duration="' . ($atts['duration'] / 1000) .'s"';
		}

		if($atts['delay']){
			$animate = $animate . ' data-wow-delay="' . ($atts['delay'] / 1000) .'s"';
		}

		if($atts['offset']){
			$animate = $animate . ' data-wow-offset="' . $atts['offset'] .'"';
		}

		if($atts['iteration']){
			$animate = $animate . ' data-wow-iteration="' . $atts['iteration'] .'"';
		}
	}

	if($atts['bg_color']){
		$add_custom_class = 'kdv-custom-'.md5(microtime());
		$add_custom_class_1 = ' ' . $add_custom_class;
		$add_custom_class_2 = '.' . $add_custom_class;
		if($atts['bg_color']){$bg_color = 'background-color: ' . $atts['bg_color'];}else{$bg_color = '';}
		$style = ' style="' . $bg_color . '"';
	}

	?>


	<?php
	if($add_custom_class){
	?>
	<style type="text/css">
		<?php echo $add_custom_class_2; ?>{
			<?php if($atts['bg_color']){echo 'background-color: ' . $atts['bg_color'] . ';';} ?>
		}
	?>
	</style>
	<?php
	}
	?>
	<div class="fw-kdv-custom-img-block<?php echo $custom_class.$animate_class; ?><?php echo $add_custom_class_1; ?>"<?php echo $custom_id; ?><?php echo $add_custom_class_1; ?><?php echo $animate; ?>>

		<?php echo $title; ?>
	<?php
		echo do_shortcode($atts['select_form']);
	?>
	</div>

<?php
}
?>