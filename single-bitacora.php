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

 	$imagen = makeImg(timThumb(featImg(),750,300));

 	$terms = get_the_terms($post->ID,'proyectos');
	if ( $terms && ! is_wp_error( $terms ) ) { 
		foreach ( $terms as $term ) {		
			$slug = $term->slug;
		}
		$args = array(
			'post_type' => 'proyecto',
			'name' => $slug
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
	};

	$paginaMadre = get_page_by_path($slug)->ID;

	$subPaginas = get_pages( array ( 'parent' => $paginaMadre, 'child_of' => $paginaMadre ) );

	foreach ( $subPaginas as $subPagina ) {
		$subTitulo = $subPagina->post_title;
		$subLink = get_permalink( $subPagina->ID );
		$menu .= makeDiv( "", "menudiv", makeTextDiv($subTitulo,$subLink) );
	}
 	



	$titulo = makeDiv("","titulo",'<h2>'.$titulo.'</h2>');
 	$lateral = makeDiv("","lateral fourcol",$madre.$menu); 	
 	$contenido = makeDiv("","contenido",$imagen.$contenido.$bitacora);
 	$principal = makeDiv("","eightcol last",$titulo.$contenido);

 	$echo .= makeDiv("","header twelvecol row",$lateral.$principal); 
 	

 	echo makeDiv("bitacora","post",$echo);

endwhile; // end of the loop.

get_sidebar();
get_footer();

?>

<script type="text/javascript">
     SyntaxHighlighter.all()
</script>
