<?php
/*
Template Name: Proyectos
 */

get_header(); 

if ( have_posts() ) while ( have_posts() ) : the_post();

	$echo = '';

	$contenido = apply_filters("the_content",get_the_content());
	$intro = makeDiv("intro","",$contenido);
	$proceso = makeDiv("proceso","",makeBannerDiv("proyecto en proceso","left"));


	$proyectos='';


endwhile;



$args = array(
	'post_type' => 'proyecto', 'posts_per_page' => -1
);

$query = new WP_Query($args);

	while ( $query->have_posts() ) :
		$query->the_post();
		$titulo = filter( get_the_title(), 'title' );
		$imagen = featImg();
		$imagen = makeImg($imagen);
		$link = get_permalink($post->ID);
		$proyectos .= makeDiv("","proyecto",makeDiv("","img ".$clase,$imagen,$link).makeDiv("","titulo",$titulo,$link));

	endwhile;



$proyectos = makeDiv("proyectos","",$proyectos);
$echo .= makeDiv("intro_proceso","fourcol", $intro.$proceso);
$echo .= makeDiv("proyectos","eightcol last",$proyectos);

echo $echo;



get_sidebar(); 
get_footer(); 


?>

<script type="text/javascript">

	$j=jQuery.noConflict();
	$j(document).ready( function(){ 
		

		// $j('#proyectos').masonry({
		// 	itemSelector : '.proyecto',
		// 	columnWidth : 260
		// });
var proyectos = $j('#proyectos');
proyectos.imagesLoaded(function(){
	proyectos.masonry({
	    itemSelector : '.proyecto',
	    columnWidth : 370
	});
});


	});
	
	 

</script>