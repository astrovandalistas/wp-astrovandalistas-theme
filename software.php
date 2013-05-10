<?php
/*
Template Name: Código
 */

get_header();

if ( have_posts() ) while ( have_posts() ) : the_post();

$paginaMadre = $post->post_parent;

$slugMadre = get_post($paginaMadre)->post_name;
$tituloMadre = get_post($paginaMadre)->post_title;
// $imagenMadre = featImg("medium",$paginaMadre);		
// $imagenMadre = makeImg(timThumb($imagenMadre,350,100));
// $linkMadre = get_permalink();	

 	
$args = array(
	'post_type' => 'proyecto',
	'name' => $slugMadre
);

$proyecto = new WP_Query($args);

while ( $proyecto->have_posts() ) :
	$proyecto->the_post();
	$tituloMadre = makeDiv("","titulo",filter( get_the_title(), 'title' ));
	$imagenMadre = featImg();		
	$imagenMadre = makeImg(timThumb($imagenMadre,350,100));
	$linkMadre = get_permalink();	

	$madre = makeDiv("","madre",$imagenMadre.$tituloMadre,$linkMadre);

endwhile;	

// $madre = makeDiv("","madre",$imagenMadre.$tituloMadre,$linkMadre);


	$subPaginas = get_pages( array ( 'parent' => $paginaMadre, 'child_of' => $paginaMadre ) );

	foreach ( $subPaginas as $subPagina ) {
		$subTitulo = $subPagina->post_title;
		if($subTitulo==$post->post_title){ $current = ' current-menu-item'; } 
		else{ $current = ''; } 
		$subLink = get_permalink( $subPagina->ID );
		
		$menu .= makeDiv( "", "menudiv".$current, makeTextDiv($subTitulo,$subLink) );
	}


endwhile;




$args = array(
	'post_type' => 'codigo', 'posts_per_page' => -1,
	'tax_query' => array(
		array(
			'taxonomy' => 'proyectos',
			'field' => 'slug',			
			'terms' => $slugMadre
		)
	)
);



$query = new WP_Query($args);

while ($query->have_posts()) : $query->the_post(); 	
	$titulo = filter( get_the_title(), 'title' );
	$extracto = filter( get_the_excerpt(), 'excerpt' );
	$imagen = featImg('medium');
	$imagen = makeImg(timThumb($imagen,200,200 ));	
	$link = get_permalink($post->ID);
	$codigo .= makeDiv("","entrada",
		makeDiv("","titulo",$titulo,$link)
		.
		makeDiv("","img ".$clase,$imagen,$link)
		.
		makeDiv("","extracto",$extracto,$link)
	);

endwhile;




 	

 	


 	// $menu = makeDiv("","submenu",$menu);

 	$imagen = get_images($post->ID,'full');//[0];

 	$imagen = makeImg($imagen[0][0]);


 	$lateral = makeDiv("","lateral fourcol",$madre.$menu);
 	$codigo = makeDiv("","eightcol last",$codigo);

 	$echo .= makeDiv("","header twelvecol row",$lateral.$codigo); 

 	echo makeDiv("software","posts",$echo);


get_sidebar();
get_footer();

?>