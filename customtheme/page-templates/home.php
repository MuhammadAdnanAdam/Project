<?php

/**
 * Template Name: Home Page
 */
get_header();
?>

<main role="main">
        <section class="text-center my-5">
                <div class="container">
                        <h1><?php the_title(); ?></h1>
                        <?php the_content(); ?>
                        <a href="<?= site_url() . '/projects' ?>" class="btn btn-primary my-2">View Projects</a>
                </div>
        </section>
</main>

<?php
get_footer();
?>