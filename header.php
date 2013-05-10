<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title><?php
		/*
		 * Print the <title> tag based on what is being viewed.
		 * We filter the output of wp_title() a bit -- see
		 * twentyten_filter_wp_title() in functions.php.
		 */
		wp_title( '|', true, 'right' );
	
		?></title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />

	<!-- 1140px Grid styles for IE -->
	<!--[if lte IE 9]><link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/css/ie.css" type="text/css" media="screen" /><![endif]-->
	
	<!-- The 1140px Grid - http://cssgrid.net/ -->
	<link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/css/1140.css" type="text/css" media="screen" />

	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	
	<!--css3-mediaqueries-js - http://code.google.com/p/css3-mediaqueries-js/ - Enables media queries in some unsupported browsers-->
	<script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/js/css3-mediaqueries.js"></script>

	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<!--    
	   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
	 -->
	<?php
		/* We add some JavaScript to pages with the comment form
		 * to support sites with threaded comments (when in use).
		 */
		if ( is_singular() && get_option( 'thread_comments' ) )
			wp_enqueue_script( 'comment-reply' );
	
		/* Always have wp_head() just before the closing </head>
		 * tag of your theme, or you will break many plugins, which
		 * generally use this hook to add elements to <head> such
		 * as styles, scripts, and meta tags.
		 */
		wp_enqueue_script( 'jquery' );
		wp_head();
	?>
<!-- 
<link rel="stylesheet" type="text/css" href="<?php echo themeDir(); ?>/scripts/google-code-prettify/prettify.css"/>
<script type="text/javascript" src="<?php echo themeDir(); ?>/scripts/google-code-prettify/prettify.js"></script> 
 -->

<!-- Include required JS files -->
<script type="text/javascript" src="<?php echo themeDir(); ?>/scripts/syntaxhighlighter/scripts/shCore.js"></script>
 
<!--
    At least one brush, here we choose JS. You need to include a brush for every
    language you want to highlight
-->
<script type="text/javascript" src="<?php echo themeDir(); ?>/scripts/syntaxhighlighter/scripts/shBrushJScript.js"></script>
<script type="text/javascript" src="<?php echo themeDir(); ?>/scripts/syntaxhighlighter/scripts/shBrushPhp.js"></script>
 
<!-- Include *at least* the core style and default theme -->
<link href="<?php echo themeDir(); ?>/scripts/syntaxhighlighter/styles/shCore.css" rel="stylesheet" type="text/css" />
<link href="<?php echo themeDir(); ?>/scripts/syntaxhighlighter/styles/shThemeEmacs.css" rel="stylesheet" type="text/css" />

 

 
<!-- Finally, to actually run the highlighter, you need to include this JS on your page -->

<!-- <link rel="stylesheet" type="text/css" href="<?php echo themeDir(); ?>/scripts/mobilyslider/css/default.css"/> -->

<script type="text/javascript" src="<?php echo themeDir(); ?>/scripts/tweet/tweet/jquery.tweet.js"></script> 
<script type="text/javascript" src="<?php echo themeDir(); ?>/scripts/imagesloaded/jquery.imagesloaded.js"></script>
<script type="text/javascript" src="<?php echo themeDir(); ?>/scripts/jquery.masonry.min.js"></script>



 
</head>

<body <?php body_class(); ?>>

			<div class="container">
				<div id="header" class="row">
					<!-- <div class="twelvecol last"> -->
						<?php
							$img = makeImg( themeDir()."/imagenes/asteriscoheader.png" );
							$logoDiv = makeDiv("","",$img );
							$logoDiv .= makeDiv("","",esc_attr( get_bloginfo( 'name', 'display' ) ) );
							$logoDiv = makeDiv("","logoDiv",$logoDiv);
							echo makeDiv( "logo", "threecol", makeTextDiv( $logoDiv ) , home_url( '/' ) );
						?>
						
					
						<div id="menu" role="navigation"  class="ninecol last">
						  	<?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary', 'walker' => new MV_Cleaner_Walker_Nav_Menu() ) ); ?>
						</div><!-- #access -->
					</div>
				</div>



<?php 
	echo startDiv("contenido","row");
?>