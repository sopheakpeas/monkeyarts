<?php
/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit: 
 * @link http://www.deluxeblogtips.com/2010/04/how-to-create-meta-box-wordpress-post.html
 */

/********************* META BOX DEFINITIONS ***********************/

$prefix = 'sp_';

global $meta_boxes, $sidebars;

$meta_boxes = array();
		


/* ---------------------------------------------------------------------- */
/*	POST FORMAT: VIDEO
/* ---------------------------------------------------------------------- */

$meta_boxes[] = array(
	'id'       => 'post-video-settings',
	'title'    => __('External Video Settings', 'sptheme_admin'),
	'pages'    => array('post'),
	'context'  => 'normal',
	'priority' => 'high',
	'fields'   => array(
		array(
			'name' => __('Video URL', 'sptheme_admin'),
			'id'   => $prefix . 'video_id',
			'type' => 'text',
			'std'  => '',
			'desc' => __('ex: http://www.youtube.com/watch?v=sdUUx5FdySs.', 'sptheme_admin'),
		)
	)
);

/* ---------------------------------------------------------------------- */
/*	POST FORMAT: VIDEO
/* ---------------------------------------------------------------------- */

$meta_boxes[] = array(
	'id'       => 'post-audio-settings',
	'title'    => __('External Audio Settings', 'sptheme_admin'),
	'pages'    => array('post'),
	'context'  => 'normal',
	'priority' => 'high',
	'fields'   => array(
		array(
			'name' => __('Audio/Sound URL', 'sptheme_admin'),
			'id'   => $prefix . 'audio_external',
			'type' => 'text',
			'std'  => '',
			'desc' => __('ex: https://soundcloud.com/loy9/loy9-radio-pro-81-all-my.', 'sptheme_admin'),
		)
	)
);

/* ---------------------------------------------------------------------- */
/*	Portfolio
/* ---------------------------------------------------------------------- */

$meta_boxes[] = array(
	'id'       => 'portfolio-settings',
	'title'    => __('Upload setting', 'sptheme_admin'),
	'pages'    => array('portfolio'),
	'context'  => 'normal',
	'priority' => 'default',
	'fields'   => array(
		array(
			'name' => __('Photo albums', 'sptheme_admin'),
			'id'   => $prefix . 'photo_albums',
			'type' => 'image_advanced',
			'max_file_uploads' => 90,
			'desc' => __('e.g: upload photos for this album and each photos size is 1280px by 800px', 'sptheme_admin'),
		)
	)
);

/* ---------------------------------------------------------------------- */
/*	Slideshow
/* ---------------------------------------------------------------------- */

$meta_boxes[] = array(
	'id'       => 'slideshow-settings',
	'title'    => __('Slide settings', 'sptheme_admin'),
	'pages'    => array('slideshow'),
	'context'  => 'normal',
	'priority' => 'default',
	'fields'   => array(
		array(
			'name' => __('Photo slides', 'sptheme_admin'),
			'id'   => $prefix . 'photo_slides',
			'type' => 'image_advanced',
			'max_file_uploads' => 5,
			'desc' => __('e.g: upload photos for homepage slideshow and each photos size is 1280px by 800px', 'sptheme_admin'),
		),
		array(
			'name' => __('Caption position', 'sptheme_admin'),
			'id'   => $prefix . 'caption_pos',
			'type' => 'select',
			'desc' => __('e.g: choose position of caption', 'sptheme_admin'),
			'options' => array(
				'bottom-right' => 'Bottom Right',
				'top-right'         => 'Top Right',
				'bottom-left' => 'Bottom Left',
				'top-left' => 'Top Left',
			),
		)
	)
);



/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function sp_register_meta_boxes()
{
	global $meta_boxes;

	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( class_exists( 'RW_Meta_Box' ) )
	{
		foreach ( $meta_boxes as $meta_box )
		{
			new RW_Meta_Box( $meta_box );
		}
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded
//  before (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'sp_register_meta_boxes' );