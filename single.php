<?php get_header(); ?>
<?php kama_breadcrumbs(); ?>
<section class="content content_single">
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); // старт цикла ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>> <?php // контэйнер с классами и id ?>
        <h1><?php the_title(); // заголовок поста ?></h1><hr class="hr">
            <div class="content_single_text">
                <?php the_content(); // контент ?>
            </div>
    </article>
<?php endwhile; // конец цикла ?>
</section>
<?php get_footer(); ?>