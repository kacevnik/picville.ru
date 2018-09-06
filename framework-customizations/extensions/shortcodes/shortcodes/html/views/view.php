<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

/**
 * @var array $atts
 */

if($atts['custom_class']){$custom_class = ' '.$atts['custom_class'];}else{$custom_class = '';}
if($atts['custom_id']){$custom_id = ' id="'.$atts['custom_id'].'"';}else{$custom_id = '';}

?>
<div class="fw-kdv-custom-html<?php echo $custom_class; ?>"<?php echo $custom_id; ?>>
<?php
	echo $atts['custom_text'];
?>
</div>