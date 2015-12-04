<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <span class="date"><?php echo get_the_date( 'Y-m-d' ); ?></span>
    <span class='content'><?php the_title(); ?></span>
</article>