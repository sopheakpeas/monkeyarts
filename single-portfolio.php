<?php
/**
 * The template for displaying all pages.
 */
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    define('WP_USE_THEMES', false);  
    require_once('../../../wp-load.php');
}
else
{
	get_header(); 
}
?>
	
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
                        <a href="<?php echo $image['full_url']?>" rel="prettyPhoto[pp_gal]">
                        <img src="<?php echo $image['url']; ?>" class="small">
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
<?php 
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

}else{
    get_footer();
}
?>