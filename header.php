<?php global $smof_data; ?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name=viewport content="width=device-width,initial-scale=1">

<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="wrapper" class="clearfix">
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