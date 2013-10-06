<?php 
/*
Template Name: Under Construction
*/

	global $smof_data; 
?>
<!DOCTYPE html>
<html class="no-js">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />

<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<style type="text/css">
	body {
		font-size: 1em;
		line-height: 1.5;
		font-family: 'Rokkitt', serif; 
		color: #a2806d; /*#bf5d3d; #BC360A;*/
		font-weight:400;
		background: #fff; /*#F8F7F5;*/
		-webkit-text-size-adjust: 1em; /* 2 */
		-ms-text-size-adjust: 1em; /* 2 */
		-webkit-font-smoothing: antialiased; /* Fix for webkit rendering */
		margin: 0;
	}
	.under-construction{
		width:960px;
		margin:150px auto;	
		text-align:center;
	}
</style>
</head>
<body <?php body_class(); ?>>
<div id="wrapper" class="clearfix">
    <div class="under-construction">
    <?php if($smof_data['theme_logo']) : ?>
    <img src="<?php echo $smof_data['theme_logo']; ?>" alt="<?php echo esc_attr( get_bloginfo('name', 'display') ); ?>" />
    <?php else: ?>
    <span><?php bloginfo( 'name' ); ?></span>
    <?php endif; ?>
    <?php
        if ( have_posts() ) :
            while ( have_posts() ) :
            the_post();
                the_content();      
            endwhile;
        endif; 
    ?>	
    </div>
</div>
<?php wp_footer(); ?>
</body>
</html>