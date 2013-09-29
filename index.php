<?php
/**
 * The main template file.
 */
get_header(); ?>
	
	<?php get_sidebar(); ?>
   	
    <div id="main">
    	
        <!-- slideshow -->
        <div class="slideshow">
        <ul class="bxslider">
        <?php 
        $args = array (
                    'post_type'		=> 'slideshow',
                    'posts_per_page'	=> 5
                );
        $slide_query = new WP_Query($args);
        if ($slide_query->have_posts()) :
			while ( $slide_query->have_posts() ) : $slide_query->the_post();		  
		?>
			<li>
			<img src="<?php echo sp_post_thumbnail('slideshow');?>" title="<?php the_title(); ?>" />
			</li>
		<?php
			endwhile;
        else: 
			echo __( 'Sorry, There are no slide, It is coming shortly.', SP_TEXT_DOMAIN );
        endif;
        ?>  
        </ul>
        </div><!--/.slideshow-->
    </div><!--#main-->

<?php get_footer(); ?>

