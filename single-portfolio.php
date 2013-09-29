<?php
/**
 * The template for displaying all pages.
 */

get_header(); ?>
	
    <div id="main" role="main">
			<header class="entry-header">
				<h1 class="entry-title"><?php the_title(); ?></h1>
			</header>
            <div class="entry-content">
            	<article id="photo-<?php the_ID(); ?>" <?php post_class(); ?>>   
                	photos will goes here
                </article><!-- #post -->
            </div><!-- .entry-content -->
		
    </div><!-- #main -->    
<?php get_footer(); ?>