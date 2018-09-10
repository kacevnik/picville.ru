<?php get_header(); ?>
<?php kama_breadcrumbs(); ?>
<section class="content_page_wrap">
    <div class="content">
        <h1><?php single_cat_title(); // название категории ?></h1><hr class="hr">
        <div class="news__list flex-container">
            <?php if (have_posts()) : while (have_posts()) : the_post(); // если посты есть - запускаем цикл wp ?>
                <?php get_template_part('loop'); // для отображения каждой записи берем шаблон loop.php ?>
            <?php endwhile; // конец цикла
            else: echo '<h2>Нет записей.</h2>'; endif; // если записей нет, напишим "простите" ?> 
        </div>
        <nav class="pager">
            <?php pagination(); // пагинация, функция нах-ся в function.php ?>
        </nav>
    </div>
</section>
<?php get_footer(); ?>