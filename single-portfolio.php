<?php 
//Not an AJAX request
if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']))
{
	get_header();
?>
	<div id="main" role="main">
<?php	
}
?>			
    <div class="album-cover"><?php echo get_the_post_thumbnail($post->ID, 'slideshow'); ?></div>
    <?php 
    	$heading_img = rwmb_meta( 'sp_photo_albums', $args = array('type' => 'plupload_image', 'size' => 'medium') ); 
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
		
<?php 
if(!isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
?>
	</div><!-- #main --> 
<?php 	
	get_footer();
}
?>