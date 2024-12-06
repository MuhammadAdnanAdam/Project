<?php get_header(); ?>

<div class="container">
    <h1>Search Results for: <?php echo get_search_query(); ?></h1>

    <?php if (have_posts()) : ?>
        <div class="row">
            <?php while (have_posts()) : the_post(); ?>
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 my-5">
                    <div class="post-card">
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <p><?php the_excerpt(); ?></p>
                        <p class="small">
                            <?php the_time('F jS, Y') ?> &nbsp;|&nbsp;
                            <!-- by <?php the_author() ?> -->
                            Published in
                            <?php the_category(', ');
                            if ($post->comment_count > 0) {
                                echo ' &nbsp;|&nbsp; ';
                                comments_popup_link('', '1 Comment', '% Comments');
                            }
                            ?>
                        </p>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else : ?>
        <p>No results found for your search.</p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>