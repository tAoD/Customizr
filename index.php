<?php
/**
 * The main template file.
 *
 *
 * @package Customizr
 * @since Customizr 1.0
 */
get_header();

      //get layout options
      global $tc_theme_options;
      
      $tc_type =  get_post_type( tc_get_the_ID());

      //hook here to execute action before the featured pages
      do_action('tc_before_featured_pages');

      tc_get_sidebar('front');

      tc_get_breadcrumb();

      ?>
            <div class="container" role="main">
                <div class="row">
                    <?php

                        tc_get_sidebar('left');

				         //initialize the thumbnail class alternative index
				        global $tc_i;
				        $tc_i = 1;
				        echo '<div class="'.$tc_theme_options['tc_current_screen_layout']['class'].' article-container">';

				            /* get additionnal header for archive, search, 404 */
				            get_template_part( 'parts/post', 'list-header');

				              /* Start the Loop for all other case*/
				              if ( have_posts() ) {
				                while ( have_posts() ) {
				                    the_post();
				                    
				                    get_template_part( 'article', 'content');         
				                    
				                   	//if we display a page, check if comments are enabled in options. If it is a post, no conditions.
				                    if ((is_page() && esc_attr($tc_theme_options['tc_page_comments']) == 1) || is_single()) {
				                    	comments_template( '', true );
				                    }

				                $tc_i++;
				                }
				              }
				              //no loop if error 404 or no search results
				              else { //(is_404() || (is_search() && !have_posts())) 
				                get_template_part( 'article', 'content');
				              }

				             if ($tc_type == 'page') {
				             	get_template_part('archive');
				             }

				            /* include navigation for posts */
				            if($tc_type != 'page' && $tc_type != 'post')
				              get_template_part( 'parts/nav');

				        echo '</div>';//end of current post layout class

                        tc_get_sidebar('right');

                    ?>
                </div><!--#row -->
            </div><!-- #container -->
    <?php

get_footer();

?>