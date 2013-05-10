<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */

get_header(); 

 if ( have_posts() ) while ( have_posts() ) : the_post();


 	$titulo = get_the_title();
 	$titulo = filter($titulo,'title');

 	$contenido = get_the_content();
 	$contenido = filter($contenido,'content');


 	

	$paginaMadre = get_page_by_path($post->post_name)->ID;

	$subPaginas = get_pages( array ( 'parent' => $paginaMadre, 'child_of' => $paginaMadre ) );

	foreach ( $subPaginas as $subPagina ) {
		$subTitulo = $subPagina->post_title;
		$subLink = get_permalink( $subPagina->ID );
		$menu .= makeDiv( "", "menudiv", makeTextDiv($subTitulo,$subLink) );
	}
 	


 	// $menu = makeDiv("","submenu",$menu);

 	$imagen = get_images($post->ID,'full');//[0];

 	$imagen = makeImg(timThumb(featImg(),750,450));


 	$lateral = makeDiv("","lateral fourcol",$titulo.$menu);
 	$imagen = makeDiv("","eightcol last",$imagen);

 	$echo .= makeDiv("","header twelvecol row",$lateral.$imagen); 
 	$echo .= makeDiv("","contenido twelvecol row",$contenido); 

 	echo makeDiv("proyecto","",$echo);

endwhile; // end of the loop.

get_sidebar();
get_footer();

?>