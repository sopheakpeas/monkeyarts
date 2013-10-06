<?php

class sp_widget_social extends WP_Widget {
	
	function __construct() {
		
		$id     = 'sp-widget-social-icons';
		$prefix = SP_THEME_NAME . ': ';
		$name   = '<span>' . $prefix . __( 'Social Icons', 'sptheme_widget' ) . '</span>';
		$widget_ops = array(
			'classname'   => 'sp-widget-social-icons',
			'description' => __( 'For people easy to connect our social network','sptheme_widget' )
			);
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => $id );

		parent::__construct( $id, $name, $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		$tran_bg = $instance['tran_bg'];
		$newtap = $instance['newtap'];
		$icons_size = $instance['icons_size'];
		

		if( !$tran_bg ){
			echo $before_widget;
			echo $before_title;
			echo $title ; 
			echo $after_title;
				sp_get_social($newtab= $newtap, $icon_size=$icons_size);
			echo $after_widget;
		}
		else { ?>
			<div class="widget">
			<?php sp_get_social($newtab= $newtap, $icon_size=$icons_size); ?>
			</div>
		<?php }			
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['icons_size'] = strip_tags( $new_instance['icons_size'] );
		$instance['tran_bg'] = strip_tags( $new_instance['tran_bg'] );
		$instance['newtap'] = strip_tags( $new_instance['newtap'] );
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' =>__('Social' , 'sptheme_widget') , 'icon_size' =>'16' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'tran_bg' ); ?>">Transparent Background :</label>
			<input id="<?php echo $this->get_field_id( 'tran_bg' ); ?>" name="<?php echo $this->get_field_name( 'tran_bg' ); ?>" value="true" <?php if( $instance['tran_bg'] ) echo 'checked="checked"'; ?> type="checkbox" />
			<br /><small>if this active the title will disappear</small>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'newtap' ); ?>">Open links in a new tab :</label>
			<input id="<?php echo $this->get_field_id( 'newtap' ); ?>" name="<?php echo $this->get_field_name( 'newtap' ); ?>" value="yes" <?php if( $instance['newtap'] ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'icons_size' ); ?>">Icons Size : </label>
			<select id="<?php echo $this->get_field_id( 'icons_size' ); ?>" name="<?php echo $this->get_field_name( 'icons_size' ); ?>" >
				<option value="16" <?php if( $instance['icons_size'] == '16' ) echo "selected=\"selected\""; else echo ""; ?>>16px</option>
				<option value="24" <?php if( $instance['icons_size'] == '24' ) echo "selected=\"selected\""; else echo ""; ?>>24px</option>
				<option value="32" <?php if( $instance['icons_size'] == '32' ) echo "selected=\"selected\""; else echo ""; ?>>32px</option>
			</select>
		</p>
		


	<?php
	}
}
?>