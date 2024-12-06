<?php

/**
 * Template for displaying search forms in Custom Theme
 *
 * @package Custom Theme
 * @subpackage Custom Theme
 * @since 1.0
 * @version 1.0
 */
get_header();
?>

<?php $unique_id = esc_attr(uniqid('search-form-')); ?>

<div class="search-form">
    <form role="search" method="get" action="<?php echo home_url('/'); ?>">
        <div class="form-search">
            <input id="search" type="text" class="search-field" placeholder="Search …" value="<?php get_search_query(); ?>" name="s" title="Search for:" />
            <label for="search"><button type="submit" class="search-submit"><i class="fas fa-search"></i></button></label>
        </div>
    </form>
</div>
<?php get_footer(); ?>