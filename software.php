<?php
/*
Template Name: Código
 */

get_header();

if ( have_posts() ) while ( have_posts() ) : the_post();

$paginaMadre = $post->post_parent;


$tituloMadre = get_post($paginaMadre)->post_name;
$titulo = get_post($paginaMadre)->post_title;




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
			'terms' => $tituloMadre
		)
	)
);



$query = new WP_Query($args);

while ($query->have_posts()) : $query->the_post(); 	
	$titulo = filter( get_the_title(), 'title' );
	$contenido = filter( get_the_content(), 'content' );
	$imagen = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
	$imagen = makeImg($imagen[0]);
	$link = get_permalink($post->ID);
	$codigo .= makeDiv("","entrada",
		makeDiv("","img ".$clase,$imagen,$link)
		.
		makeDiv("","titulo",$titulo,$link)
		.
		makeDiv("","cntd",$contenido,$link)
	);

endwhile;






 	

 	


 	// $menu = makeDiv("","submenu",$menu);

 	$imagen = get_images($post->ID,'full');//[0];

 	$imagen = makeImg($imagen[0][0]);


 	$lateral = makeDiv("","lateral fourcol",$titulo.$menu);
 	$codigo = makeDiv("","eightcol last",$codigo);

 	$echo .= makeDiv("","header twelvecol row",$lateral.$codigo); 

 	echo makeDiv("codigo","",$echo);


get_sidebar();
get_footer();

?>