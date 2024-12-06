<?php

/**
 * The template for displaying Project Detail Posts
 *
 * @package WordPress
 * @subpackage Custom Theme
 * @since Custom Theme 1.0
 */
get_header();
?>
<div class="container my-5">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="row">
                <h1 class="display-6 mb-4"><?php the_title(); ?></h1>
                <div class="col-12 col-sm-12 col-md-6 col-lg-6"><img src="<?php the_post_thumbnail_url(); ?>" class="img-fluid w-100 h-100" alt=""></div>
                <div class="col-12 col-sm-12 col-md-6 col-lg-6"><?php the_content(); ?></div>

                <div class="row mt-4">
                    <?php if (get_field('project_section')) : ?>
                        <div class="col-12">
                            <h5 class="mb-3">Project Details</h5>
                            <div class="d-flex justify-content-between">
                                <div class="project-start-date">
                                    <strong>Start Date:</strong> <?php echo get_field('project_section')['project_start_date']; ?>
                                </div>
                                <div class="project-end-date">
                                    <strong>End Date:</strong><?php echo get_field('project_section')['project_end_date']; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
    <?php endwhile;
    endif; ?>
</div>

<?php
get_footer();
?>