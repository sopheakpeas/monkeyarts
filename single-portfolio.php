<?php
/**
 * The template for displaying all pages.
 */

get_header(); ?>
	
    <?php get_sidebar(); ?>
    <div id="main" role="main">
			
            <?php $heading_img = rwmb_meta( 'sp_photo_albums', $args = array('type' => 'image_advanced', 'size' => 'portfolio-thumb') ); 
				
				if ( $heading_img ):
			?>	
            <div class="entry-content">
            <article id="portfolio" class="portfolio">
            	<ul>
			<?php foreach ( $heading_img as $image ){ ?>
                	<li class="all">
                        <a href="#">
                        <img src="#" data-src="<?php echo $image['url']; ?>" alt="" class="small">
                        </a>
                    </li>
            <?php
				}
				endif;
			?>	        
                    </ul>
                </article><!-- #post -->
            </div><!-- .entry-content -->
		
    </div><!-- #main -->    
<?php get_footer(); ?>