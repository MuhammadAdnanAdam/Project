<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Lorem Ipsum is simply dummy text of the printing and typesetting industry." />
    <meta name="robots" content="follow, index, max-snippet:-1, max-video-preview:-1, max-image-preview:large" />
    <link rel="canonical" href="http://localhost/custom-theme/" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Welcome to Custom Theme" />
    <meta property="og:description" content="Lorem Ipsum is simply dummy text of the printing and typesetting industry." />
    <meta property="og:url" content="http://localhost/custom-theme/" />
    <meta property="og:site_name" content="Custom Theme" />
    <meta property="og:updated_time" content="2023-02-22T16:12:13+05:00" />
    <meta property="fb:app_id" content="" />
    <meta property="article:published_time" content="2020-02-19T11:04:52+05:00" />
    <meta property="article:modified_time" content="2023-02-22T16:12:13+05:00" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="Welcome to Custom Theme" />
    <meta name="twitter:description" content="Lorem Ipsum is simply dummy text of the printing and typesetting industry." />
    <meta name="twitter:site" content="" />
    <meta name="twitter:creator" content="" />
    <meta name="twitter:label1" content="Written by" />
    <meta name="twitter:data1" content="manager" />
    <meta name="twitter:label2" content="Time to read" />
    <meta name="twitter:data2" content="Less than a minute" />
    <title><?php bloginfo('name'); ?></title>
    <!-- WordPress Header Hook -->
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <!-- Container start here -->
    <div class="container">
        <!-- Header section start here -->
        <header>
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container-fluid d-flex justify-content-between align-items-center">
                    <!-- Logo -->
                    <div class="navbar-brand d-flex justify-content-start">
                        <a href="<?php the_field('url', 'option'); ?>">
                            <img src="<?php the_field('logo', 'option'); ?>" alt="Logo" class="img-fluid" id="navbarLogo">
                        </a>
                    </div>

                    <!-- Toggler mobile -->
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <!-- Navwalker menu -->
                    <div class="collapse navbar-collapse justify-content-center" id="navbarNavDropdown">
                        <?php
                        wp_nav_menu(array(
                            'theme_location'  => 'primary',
                            'depth'           => 2,
                            'container'       => false,
                            'menu_class'      => 'navbar-nav',
                            'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
                            'walker'           => new WP_Bootstrap_Navwalker(),
                        ));
                        ?>
                    </div>

                    <!-- Search Form -->
                    <form class="d-flex" id="searchForm" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                        <input type="search" name="s" id="searchInput" class="form-control" placeholder="Search..." aria-label="Search" value="<?php echo get_search_query(); ?>">
                        <button class="btn btn-outline-success ms-2" type="submit">Search</button>
                    </form>

                </div>
            </nav>


        </header>
        <!-- Header section close here -->