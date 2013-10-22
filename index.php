<?php
/**
 * The main template file.
 */
get_header(); ?>
	
	<div id="main">
    	
        <!-- slideshow -->
        <div class="slideshow">
        <ul class="bxslider">
        <?php 
        $args = array (
                    'post_type'		=> 'slideshow',
                    'posts_per_page'	=> 1
                );
        $slide_query = new WP_Query($args);
        if ($slide_query->have_posts()) :
			while ( $slide_query->have_posts() ) : $slide_query->the_post();

            $slides = rwmb_meta('sp_photo_slides', array('type' => 'plupload_image', 'size' => 'slideshow'));		  
            $cap_pos = get_post_meta( get_the_ID(), 'sp_caption_pos', true );
		?>
        <?php foreach ( $slides as $image ){ ?>
			<li class="<?php echo $cap_pos; ?>">
			<img src="<?php echo $image['url']; ?>" title="<?php the_title();?>" />
			</li>
        <?php } ?>    
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

