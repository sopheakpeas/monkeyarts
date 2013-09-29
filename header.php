<?php
/**
 * The Header
 */

/* Fetch theme options variables required in this template */
?>
<!DOCTYPE html>
<!--[if IE 7]>                  <html class="ie7 no-js"  <?php language_attributes(); ?> prefix="og: http://ogp.me/ns#">     <![endif]-->
<!--[if lte IE 8]>              <html class="ie8 no-js"  <?php language_attributes(); ?> prefix="og: http://ogp.me/ns#">     <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html class="not-ie no-js" <?php language_attributes(); ?> prefix="og: http://ogp.me/ns#">  <!--<![endif]-->
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
	