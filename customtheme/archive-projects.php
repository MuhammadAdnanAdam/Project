<?php

/**
 * The template for displaying Archive Project
 *
 * @package WordPress
 * @subpackage Custom Theme
 * @since Custom Theme 1.0
 */
get_header(); ?>

<div id="container">
    <div id="content" role="main">
        <div class="row">
            <?php
            $args = array(
                'post_type' => 'projects',
                'posts_per_page' => 6
            );
            $the_query = new WP_Query($args); ?>

            <?php if ($the_query->have_posts()) : ?>

                <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>


                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 my-3">
                        <div class="card">
                            <img src="<?php the_post_thumbnail_url(); ?>" class="img-fluid card-img-top" alt="">
                            <div class="card-body">
                                <h3 class="card-title"><?php the_title(); ?></h3>
                                <div class="project-desc pt-2 card-text">
                                    <?php echo wp_trim_words(get_the_content(), 30, '...'); ?>
                                </div>
                                <?php if (get_field('project_section')) : ?>
                                    <div class="d-flex flex-column mt-2">
                                        <div class="project-start-date">
                                            <strong>Start Date:</strong> <?php echo get_field('project_section')['project_start_date']; ?>
                                        </div>
                                        <div class="project-start-date">
                                            <strong>End Date:</strong> <?php echo get_field('project_section')['project_end_date']; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <a href="<?php the_permalink(); ?>" class="btn btn-primary mt-3">Read More...</a>
                            </div>
                        </div>
                    </div>

                <?php endwhile; ?>

                <?php wp_reset_postdata(); ?>

            <?php endif; ?>

        </div>

    </div><!-- #content -->
</div><!-- #container -->

<?php get_footer(); ?>