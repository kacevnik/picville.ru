<?php get_header(); ?>
<?php kama_breadcrumbs(); ?>
<section class="content_page_wrap">
    <div class="content">
    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); // старт цикла ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>> <?php // контэйнер с классами и id ?>
            <h1><?php the_title(); // заголовок ?></h1><hr class="hr">
            <?php the_content(); // контент ?>
        </article>
    <?php endwhile; // конец цикла ?>
    </div>
</section>
<?php get_footer(); ?>