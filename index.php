<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package geist
 */

get_header();

$geist_custom_logo_id = get_theme_mod( 'custom_logo' );
$geist_image = wp_get_attachment_image_src( $geist_custom_logo_id , 'full' );

$geist_blog_name = get_bloginfo( 'name' );
$geist_blog_description = get_bloginfo( 'description' );

?>

<?php get_template_part('template-parts/header'); ?>
    <div class="inner">
        <div class="site-header-content">
            <h1 class="site-title">
                <?php if( $geist_custom_logo_id ){ ?>
                    <img class="site-logo" src="<?php echo esc_url( $geist_image[0] ); ?>" alt="<?php echo esc_html( $geist_blog_name ); ?>" />
                <?php }else{ ?>
                    <?php echo esc_html( $geist_blog_name ); ?>
                <?php } ?>
            </h1>
            <h2 class="site-description"><?php echo esc_html( $geist_blog_description ); ?></h2>
        </div>
        <?php get_template_part('template-parts/site-nav'); ?>
    </div>
</header>

<!-- The main content area -->
<main id="site-main" class="site-main outer">
    <div class="inner">

        <div id="content" class="post-feed">
            <?php
            // Custom query to modify the post order
            global $wp_query;
            $args = array_merge(
                $wp_query->query_vars,
                array(
                    'post_type' => 'post',
                    'orderby' => 'date',
                    'order' => 'DESC'
                )
            );
            query_posts( $args );

            // The Loop
            if ( have_posts() ) :

                if ( is_home() && ! is_front_page() ) :
                    ?>
                    <header>
                        <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
                    </header>
                    <?php
                endif;

                /* Start the Loop */
                while ( have_posts() ) :
                    the_post();

                    /*
                     * Include the Post-Type-specific template for the content.
                     * If you want to override this in a child theme, then include a file
                     * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                     */
                    get_template_part( 'template-parts/content', get_post_type() );

                endwhile;

                the_posts_navigation(
                    array(
                        'prev_text' => __('Older Posts', 'geist'),
                        'next_text' => __('Newer Posts', 'geist'),
                    )
                );

            else :

                get_template_part( 'template-parts/content', 'none' );

            endif;
            // Reset Query
            wp_reset_query();
            ?>
        </div>

    </div>
</main>

<?php
get_footer();
