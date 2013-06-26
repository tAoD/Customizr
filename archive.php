<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Customizr
 * @since Customizr 1.0
 */

function more_posts() {
  global $wp_query;
  return $wp_query->current_post + 1 < $wp_query->post_count;
}

get_header(); ?>

		<section id="primary">
			<div id="content" role="main">

			<?php 
			 	get_template_part( 'parts/post', 'list-header');
			 	query_posts( 'posts_per_page=-1' );
				if ( have_posts() ) {
	                while ( more_posts() ) {
	                    the_post();
	                    
	                    get_template_part( 'article', 'content');         
	                    
	                   	//if we display a page, check if comments are enabled in options. If it is a post, no conditions.
	                    if ((is_page() && esc_attr($tc_theme_options['tc_page_comments']) == 1) || is_single()) {
	                    	comments_template( '', true );
	                    }
	                }
	              }
			?>

			</div><!-- #content -->
		</section><!-- #primary -->
<?php get_footer(); ?>