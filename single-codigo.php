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


	$bloques = get_group('bloque');
	$codigo = $descripcion = 0;
	
	// var_dump($bloques);
	foreach($bloques as $bloque){
		$codigo = $bloque['bloque_codigo'][1];
		$descripcion = $bloque['bloque_descripcion'][1];

		$codigo = '<pre class="brush: php">'.$codigo.'</pre>' ;
		$codigo = makeDiv( "", "bloque_codigo", $codigo );
		$descripcion = makeDiv( "", "bloque_descripcion", $descripcion );
		$bloques_codigo .= makeDiv( "", "bloque", $descripcion.$codigo );

	  
	}

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
			$titulo = filter( get_the_title(), 'title' );
			$imagen = featImg();		
			$imagen = makeImg(timThumb($imagen,350,100));
			$link = get_permalink();	

			$madre = makeDiv("","madre",$imagen.$titulo,$link);

		endwhile;					
	};

	$paginaMadre = get_page_by_path($slug)->ID;

	$subPaginas = get_pages( array ( 'parent' => $paginaMadre, 'child_of' => $paginaMadre ) );

	foreach ( $subPaginas as $subPagina ) {
		$subTitulo = $subPagina->post_title;
		$subLink = get_permalink( $subPagina->ID );
		$menu .= makeDiv( "", "menudiv", makeTextDiv($subTitulo,$subLink) );
	}
 	




 	$lateral = makeDiv("","lateral fourcol",$madre.$menu);
 	$codigo = makeDiv("","codigo",$bloques_codigo);
 	$principal = makeDiv("","contenido eightcol last",$contenido.$codigo);

 	$echo .= makeDiv("","header twelvecol row",$lateral.$principal); 
 	

 	echo makeDiv("codigo","",$echo);

endwhile; // end of the loop.

get_sidebar();
get_footer();

?>

<script type="text/javascript">
     SyntaxHighlighter.all()
</script>
