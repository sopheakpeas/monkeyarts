<?php global $smof_data; ?>
<aside id="sidebar">
	<div class="brand" role="banner">
        <?php if( !is_singular() ) echo '<h1>'; else echo '<h2>'; ?>
        
        <a  href="<?php echo home_url() ?>/"  title="<?php echo esc_attr( get_bloginfo('name', 'display') ); ?>">
            <?php if($smof_data['theme_logo']) : ?>
            <img src="<?php echo $smof_data['theme_logo']; ?>" alt="<?php echo esc_attr( get_bloginfo('name', 'display') ); ?>" />
            <?php else: ?>
            <span><?php bloginfo( 'name' ); ?></span>
            <?php endif; ?>
        </a>
        
        <?php if( !is_singular() ) echo '</h1>'; else echo '</h2>'; ?>
    </div><!-- end .logo -->
	
	<?php sp_main_navigation(); ?>
</aside>