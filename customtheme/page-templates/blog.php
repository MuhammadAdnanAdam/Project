<?php

/**
 * Template Name: Blog Page
 */
get_header();
?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <!-- Main Content -->
        <main role="main">
            <section class="text-center my-5">
                <div class="container">
                    <h1><?php the_title(); ?></h1>
                    <?php the_content(); ?>
                    <a href="<?= site_url() . '/projects' ?>" class="btn btn-primary my-2">View Projects</a>
                </div>
            </section>
        </main>
<?php endwhile;
endif; ?>

<?php
get_footer();
?>