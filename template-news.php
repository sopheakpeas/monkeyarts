<?php
/*
Template Name: News
*/

if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    define('WP_USE_THEMES', false);  
    //require_once('../../../../wp-load.php');
}
else
{
    get_header();
}
?>
<div id="blog">
	<div class="blog-classic">
	<!--<header class="entry-header">
        <h1 class="entry-title"><?php the_title(); ?></h1>
    </header>-->
<?php
wp_reset_query();

query_posts( 'posts_per_page=-1' );

if ( have_posts() ) : 
	while ( have_posts() ) : the_post();
		get_template_part( 'formats/archive', 'classic' ); 
	endwhile;
else: 
?>
    <article id="post-0" class="post no-results not-found">
        <h3><?php _e( 'Sorry, there are no article', SP_TEXT_DOMAIN ); ?></h3>
    </article><!-- end .hentry -->

<?php endif; ?>

</div> <!-- .blog-classic -->

<?php get_sidebar('blog'); ?>
</div><!-- #blog -->
<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

}else{
    get_footer();
}
?>
