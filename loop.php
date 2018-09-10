    <div class="col-4">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>> <?php // контэйнер с классами и id ?>
        <a href="<?php the_permalink(); ?>" class="news-item">
            <span class="news-item__photo">
                <img class="pos-center" src="<?php echo get_the_post_thumbnail_url( null, 'category-thumb' ); ?>" alt="<?php the_title(); ?>">
            </span><!--news-item__photo-->
            <span class="news-item__title">
                <?php the_title(); ?>
            </span>
            <span class="news-item__date">
                <?php the_time('j F Y'); ?>
            </span>
        </a>
    </article>
</div>