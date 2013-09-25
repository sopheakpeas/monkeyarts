<?php

/**
 * Sets up the content width value based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 600;
		
		
		//ACTION & FILTER
		add_action( 'after_setup_theme', 'sp_theme_setup' );
		add_action('wp_enqueue_scripts', 'sp_print_scripts_styles'); //print Script and CSS
		add_action( 'wp_head', 'sp_print_custom_css_js' );//Custom CSS and JS when page load
		add_action('wp_footer', 'google_analytics_script');
		
		add_filter('wp_title', 'sp_filter_wp_title', 10, 2);
		//TinyMCE customization
		if ( is_admin() ) {
			add_filter( 'mce_buttons', 'sp_add_buttons_row1' );
			add_filter( 'mce_buttons_2', 'sp_add_buttons_row2' );
		}
		
		add_filter( 'the_excerpt_rss', 'sp_rss_post_thumbnail' );//Display thumbnails in RSS
		add_filter( 'the_content_feed', 'sp_rss_post_thumbnail' );//Display thumbnails in RSS
		
		//BRANDING
		add_action('wp_dashboard_setup', 'remove_dashboard_widgets' );
		add_action( 'admin_head', 'sp_adminfavicon' );//Set favicons for backend code
		add_action('login_head', 'sp_custom_login_logo');// Custom logo login
		add_action( 'wp_before_admin_bar_render', 'sp_remove_admin_bar_links' );//	Remove logo and other items in Admin menu bar
		add_filter('login_headerurl', 'sp_remove_link_on_admin_login_info');//  Remove wordpress link on admin login logo
		add_filter('login_headertitle', 'sp_change_loging_logo_title');// Change login logo title
		add_filter('admin_footer_text', 'sp_modify_footer_admin'); // Customising footer text
		
		remove_action('wp_head', 'wp_generator'); // Remove Generator from head

/*-----------------------------------------------------------------------------------*/
/*	theme set up
/*-----------------------------------------------------------------------------------*/ 
function sp_theme_setup() {

	// Makes theme available for translation.
	load_theme_textdomain( SP_TEXT_DOMAIN, get_template_directory() . '/languages' );

	// Add visual editor stylesheet support
	add_editor_style( SP_ASSETS_THEME . 'css/editor-style.css');

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// Add post formats
	add_theme_support( 'post-formats', array( 'gallery', 'video') );

	// Add navigation menus
	register_nav_menus( array(
		'primary'	=> __( 'Primary Menu', SP_TEXT_DOMAIN )
	) );

	// Add suport for post thumbnails and set default sizes
	add_theme_support( 'post-thumbnails' );

	// Add custom image sizes
	add_image_size('blog-post-thumb', 270);
	add_image_size('blog-post-detail', 380);
	add_image_size('portfolio-thumb', 300, 150, TRUE);
	add_image_size('portfolio-media', 940);
	add_image_size( 'slideshow', 960, 400, true );

}

/* ---------------------------------------------------------------------- */
/*	Register CSS and JS
/* ---------------------------------------------------------------------- */

function sp_print_scripts_styles() {
	
	global $wp_styles, $smof_data, $is_IE;
	
	if(!is_admin()){
		//CSS
		//wp_enqueue_style('open-sans', 'http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700', false, SP_THEME_VERSION);
		wp_enqueue_style('sp-theme-styles', SP_BASE_URL . 'style.css', false, SP_THEME_VERSION);
		wp_enqueue_style('sp-base', SP_ASSETS_THEME . 'css/base.css', false, SP_THEME_VERSION);
		wp_enqueue_style( 'flexslider', SP_ASSETS_THEME . 'css/flexslider.css', false, SP_THEME_VERSION);
		wp_enqueue_style('sp-layout', SP_ASSETS_THEME . 'css/layout.css', false, SP_THEME_VERSION);
		//wp_enqueue_style('sp-shortcodes', SP_ASSETS_THEME . 'css/shortcodes.css', false, SP_THEME_VERSION);
		
		// Internet Explorer specific stylesheet
		wp_enqueue_style('ie8-style',SP_ASSETS_THEME . '/css/ie8.min.css', array(), SP_THEME_VERSION);
		$wp_styles->add_data( 'ie8-style', 'conditional', 'IE 8');
		
		wp_enqueue_style('ie9-style',SP_ASSETS_THEME . '/css/ie9.min.css');
		$wp_styles->add_data( 'ie9-style', 'conditional', 'IE 9', array(), SP_THEME_VERSION);
		
		//JS
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script("plugins", SP_ASSETS_THEME."/js/plugins.js",array(),false,true);
		if ( $is_IE ) {
			wp_enqueue_script("html5", SP_ASSETS_THEME."/js/html5.js",array(),false,false);
		}
		wp_enqueue_script( 'shortcodes',    SP_ASSETS_THEME . 'js/shortcodes.js', array(), SP_THEME_VERSION, true );
		wp_enqueue_script( 'custom-scripts',    SP_ASSETS_THEME . 'js/custom.js', array(), SP_THEME_VERSION, true );
		
		if ( is_singular() ) wp_enqueue_script( "comment-reply");
		
	}
}
	
//custom scripts and styles
function sp_print_custom_css_js() { 

}

/*-----------------------------------------------------------------------------------*/
/* Makes some changes to the <title> tag, by filtering the output of wp_title()
/*-----------------------------------------------------------------------------------*/
function sp_filter_wp_title( $title, $separator ) {

	if ( is_feed() ) return $title;

	global $paged, $page;

	if ( is_search() ) {
		$title = sprintf(__('Search results for %s', 'sptheme_admin'), '"' . get_search_query() . '"');

		if ( $paged >= 2 )
			$title .= " $separator " . sprintf(__('Page %s', 'sptheme_admin'), $paged);

		$title .= " $separator " . get_bloginfo('name', 'display');

		return $title;
	}

	$title .= get_bloginfo('name', 'display');
	$site_description = get_bloginfo('description', 'display');

	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $separator " . $site_description;

	if ( $paged >= 2 || $page >= 2)
		$title .= " $separator " . sprintf(__('Page %s', 'sptheme_admin'), max($paged, $page) );

	return $title;

}

/*-----------------------------------------------------------------------------------*/
/* Embeded script in footer
/*-----------------------------------------------------------------------------------*/

function google_analytics_script() { 
	global $smof_data;
	if ( $smof_data['google_analytics']) echo htmlspecialchars_decode( stripslashes( $smof_data['google_analytics'] )); 
} 	

/* ---------------------------------------------------------------------- */
/*	Visual editor improvment
/* ---------------------------------------------------------------------- */
	
/*
* Add buttons to visual editor first row
*
* $buttons = ARRAY [default WordPress visual editor buttons array]
*/
if ( ! function_exists( 'sp_add_buttons_row1' ) ) {
	function sp_add_buttons_row1( $buttons ) {
		//inserting buttons after "italic" button
		$pos = array_search( 'italic', $buttons, true );
		if ( $pos != false ) {
			$add = array_slice( $buttons, 0, $pos + 1 );
			$add[] = 'underline';
			$buttons = array_merge( $add, array_slice( $buttons, $pos + 1 ) );
		}

		//inserting buttons after "justifyright" button
		$pos = array_search( 'justifyright', $buttons, true );
		if ( $pos != false ) {
			$add = array_slice( $buttons, 0, $pos + 1 );
			$add[] = 'justifyfull';
			$buttons = array_merge( $add, array_slice( $buttons, $pos + 1 ) );
		}
		
		return $buttons;
	}
} // /sp_add_buttons_row1

/*
* Add buttons to visual editor second row
*
* $buttons = ARRAY [default WordPress visual editor buttons array]
*/
if ( ! function_exists( 'sp_add_buttons_row2' ) ) {
	function sp_add_buttons_row2( $buttons ) {
		//inserting buttons before "underline" button
		$pos = array_search( 'underline', $buttons, true );
		if ( $pos != false ) {
			$add = array_slice( $buttons, 0, $pos );
			$add[] = 'removeformat';
			$add[] = '|';
			$buttons = array_merge( $add, array_slice( $buttons, $pos + 1 ) );
		}

		//remove "justify full" button from second row
		$pos = array_search( 'justifyfull', $buttons, true );
		if ( $pos != false ) {
			unset( $buttons[$pos] );
			$add = array_slice( $buttons, 0, $pos + 1 );
			$add[] = '|';
			$add[] = 'sub';
			$add[] = 'sup';
			$add[] = '|';
			$buttons = array_merge( $add, array_slice( $buttons, $pos + 1 ) );
		}

		return $buttons;
	}
} // sp_add_buttons_row2

//Display thumbnails in RSS
if ( ! function_exists( 'sp_rss_post_thumbnail' ) ) {
	function sp_rss_post_thumbnail( $content ) {
		global $post;

		if ( has_post_thumbnail( $post->ID ) )
			$content = '<p>' . get_the_post_thumbnail( $post->ID ) . '</p>' . get_the_content();

		return $content;
	}
} // /sp_rss_post_thumbnail

/* ---------------------------------------------------------------------- */
/*	Customizable login screen and WordPress admin area
/* ---------------------------------------------------------------------- */

//Remove WordPress Dashboard Widgets
function remove_dashboard_widgets() {
	global $wp_meta_boxes;

	//unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
	//unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);

}

// Custom logo login
function sp_custom_login_logo() {
    echo '<style type="text/css">
		body.login{ background-color:#fff; }
        .login h1 a { background-image:url('.SP_ASSETS_THEME.'images/logo.gif) !important; height:50px !important; background-size: auto auto !important;}
    </style>';
}

// Remove wordpress link on admin login logo
function sp_remove_link_on_admin_login_info() {
     return  get_bloginfo('url');
}

// Change login logo title
function sp_change_loging_logo_title(){
	return 'Go to '.get_bloginfo('name').' Homepage';
}

//	Remove logo and other items in Admin menu bar
function sp_remove_admin_bar_links() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu('comments');
	$wp_admin_bar->remove_menu('wp-logo');
}

// Customising footer text
function sp_modify_footer_admin () {  
  echo 'Created by <a href="http://www.linkedin.com/profile/view?id=27373514&trk=nav_responsive_tab_profile" target="_blank">Sopheak</a>. Powered by <a href="http://www.wordpress.org" target="_blank">WordPress</a>';  
} 

//  Set favicons for backend code
function sp_adminfavicon() {
echo '<link rel="icon" type="image/x-icon" href="'.SP_BASE_URL.'favicon.ico" />';
}
