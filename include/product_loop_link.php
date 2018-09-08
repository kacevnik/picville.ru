<?php

    if ( ! defined( 'ABSPATH' ) ) {
        exit; // Exit if accessed directly
    }

    global $product;

    echo '<a href="' . esc_url( get_the_permalink() ) . '" class="red-btn-small product__link">Подробнее</a>';

?>