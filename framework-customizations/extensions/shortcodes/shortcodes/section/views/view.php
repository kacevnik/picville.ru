<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$bg_color = '';
if ( ! empty( $atts['background_color'] ) ) {
	$bg_color = 'background-color:' . $atts['background_color'] . ';' . PHP_EOL;
}

if( $atts['background_image'] && $atts['is_paralax']){
	$paralax = ($atts['speed_parallax']) ? ' data-stellar-background-ratio="'. $atts['speed_parallax'] .'"' : ' data-stellar-background-ratio="0.5"';
}

$bg_image = '';
$bg_img_size = '';
if ( ! empty( $atts['background_image'] ) && ! empty( $atts['background_image']['data']['icon'] ) ) {
	$bg_image = 'background-image: url(' . $atts['background_image']['data']['icon'] . ');' . PHP_EOL;
	if( $atts['background_size'] ){	
		$bg_img_size = 'background-size: '. $atts['background_size'] . ';' . PHP_EOL;
	}
}

if( $bg_img_size || $bg_image || $atts['background_color']){
	$time_custom_class = 'kdv-custom-' . md5(microtime());
	$time_custom_class_1 = '.' . $time_custom_class;
	$time_custom_class_2 = ' ' . $time_custom_class;
?>
<style type="text/css">
	<?php echo $time_custom_class_1; ?>{
		<?php if( $atts['background_image'] ){echo  $bg_image; } ?>
		<?php if( $atts['background_size'] && $atts['background_image'] ){ echo $bg_img_size; } ?>
		<?php if( $atts['background_color'] ){echo  $bg_color; } ?>
	}
</style>
<?php
}

$bg_video_data_attr    = '';
$section_extra_classes = '';
if ( ! empty( $atts['video'] ) ) {
	$filetype           = wp_check_filetype( $atts['video'] );
	$filetypes          = array( 'mp4' => 'mp4', 'ogv' => 'ogg', 'webm' => 'webm', 'jpg' => 'poster' );
	$filetype           = array_key_exists( (string) $filetype['ext'], $filetypes ) ? $filetypes[ $filetype['ext'] ] : 'video';
	$data_name_attr = version_compare( fw_ext('shortcodes')->manifest->get_version(), '1.3.9', '>=' ) ? 'data-background-options' : 'data-wallpaper-options';
	$bg_video_data_attr = $data_name_attr.'="' . fw_htmlspecialchars( json_encode( array( 'source' => array( $filetype => $atts['video'] ) ) ) ) . '"';
	$section_extra_classes .= ' background-video';
}

if($atts['kdv_custom_style']){$kdv_custom_stile = ' '.$atts['kdv_custom_style'];}else{$kdv_custom_stile = '';}
if($atts['kdv_custom_id']){$kdv_custom_id = ' id="'.$atts['kdv_custom_id'].'"';}else{$kdv_custom_id = '';}

$container_class = ( isset( $atts['is_fullwidth'] ) && $atts['is_fullwidth'] ) ? 'fw-container-fluid' : 'fw-container';
?>
<section class="fw-main-row <?php echo esc_attr($section_extra_classes).$kdv_custom_stile.$time_custom_class_2; ?>"<?php echo $kdv_custom_id; ?><?php echo $paralax; ?> <?php echo $bg_video_data_attr; ?>>
	<div class="<?php echo esc_attr($container_class); ?>">
		<?php echo do_shortcode( $content ); ?>
	</div>
</section>
