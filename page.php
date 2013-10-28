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
    
    
		<?php
        if ( have_posts() ) :
			while ( have_posts() ) :
			the_post(); ?>
            <div id="scrollbar1">
            <div class="scrollbar"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>
            <div class="viewport">
                <div class="overview">
                
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <?php $is_page_title = get_post_meta( $post->ID, 'sp_is_page_title', true );?>
                <?php if ($is_page_title){ ?>
                <header class="entry-header">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                </header>
                <?php } ?>
                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div><!-- .entry-content -->
                </article><!-- #post -->
                
                 </div><!-- .overview -->
                </div><!-- .viewport -->
            </div><!-- #scrollbar1 -->
		<?php endwhile;
        else : ?>
			<article id="post-0" class="post no-results not-found">
			<header class="entry-header">
				<h1 class="entry-title"><?php _e( 'Nothing Found', SP_TEXT_DOMAIN ); ?></h1>
			</header>
			<div class="entry-content">
				<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', SP_TEXT_DOMAIN ); ?></p>
				<?php get_search_form(); ?>
			</div><!-- .entry-content -->
			</article><!-- #post-0 -->
        <?php endif; ?>
    
<?php 
if(!isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
?>
	</div><!-- #main --> 
<?php 	
	get_footer();
}
?>