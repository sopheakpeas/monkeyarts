<?php

/* ---------------------------------------------------------------------- */
/*	Register sidebars
/* ---------------------------------------------------------------------- */
function sp_widgets_init() {
	
	// Blog Sidebar
	register_sidebar( array(
		'name' 			=> __( 'Blog Sidebar', 'sptheme_admin' ),
		'id' 			=> 'blog-sidebar',
		'description' 	=> __( 'Sidebar use for blog page.', 'sptheme_admin' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' 	=> "</div>",
		'before_title' 	=> '<div class="widget-title"><h3>',
		'after_title' 	=> '</h3></div>',
	) );
	
	
	// Addon widgets		
	require_once ( SP_BASE_DIR . 'library/widgets/widget-category-post.php' );
	require_once ( SP_BASE_DIR . 'library/widgets/widget-social.php' );
	require_once ( SP_BASE_DIR . 'library/widgets/widget-feedburner.php' );
	require_once ( SP_BASE_DIR . 'library/widgets/widget-video.php' );
		
	// Register widgets
	register_widget( 'sp_widget_category_post' );
	register_widget( 'sp_widget_social' );
	register_widget( 'sp_widget_feedburner' );
	register_widget( 'sp_widget_video' );
	
	
}
add_action('widgets_init', 'sp_widgets_init');