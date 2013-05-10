<?php
/*
Template Name: Galería
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
	'posts_per_page' => -1,
	'tax_query' => array(
		array(
			'taxonomy' => 'proyectos',
			'field' => 'slug',			
			'terms' => $slugMadre
		)
	)
);



$imagenes = array();
$query = new WP_Query($args);
$posts = array();



$imgs_grandes = '';
$imgs_chicas = '';


while ($query->have_posts()) : $query->the_post(); 	

// $postContent = $post->post_content;
// $searchPattern = '~<img [^\>]*\ />~';

// // Run preg_match_all to grab all the images and save the results in $aPics
// preg_match_all( $searchPattern, $postContent, $imagenesPost );

// $imagenes = array_merge($imagenes, $imagenesPost);


$chicas = get_images($post->ID,'thumbnail' );
$grandes = get_images($post->ID,'large' );

$i = 0;

foreach ($chicas as $chica) {

	$thumb = timThumb($chica[0],150,150);

	$imgs_chicas .= '<a href="#" onclick="return false;"><img src="'.$thumb.'" id="'.$id.'"/></a>';
	$i++;
}

$i = 0;

foreach ($grandes as $grande) {

	$thumb = timThumb($grande[0],"",300);

	$thumb .= '<img src="'.$thumb.'" id="'.$i.'"/>';
	$imgs_grandes .= $thumb;

	if($i==0){ $loadImg = $grande[0]; }
	
	$i++;

}


endwhile;

$contenidoPost = apply_filters("the_content", $post->post_content );


 	

	$divChicas = makeDiv("","scroll_hide",makeDiv("","scroller",$imgs_chicas));		
 	
	$imagenes = makeDiv("","imagenes",
		$cortina
		.
		makeDiv("","imagen_grande",'<img src="'.$loadImg.'"/>')
		.
		makeDiv("","imagenes_chicas", $divChicas )
	);

	echo makeDiv( "", "imagenes_grandes", $imgs_grandes );
					
 	// $menu = makeDiv("","submenu",$menu);

 	$imagen = get_images($post->ID,'full');//[0];

 	$imagen = makeImg($imagen[0][0]);


 	$lateral = makeDiv("","lateral fourcol",$madre.$menu);
 	$galeria = makeDiv("","eightcol last",$imagenes);

 	$echo .= makeDiv("","header twelvecol row",$lateral.$galeria); 

 	echo makeDiv("galeria","posts",$echo);


get_sidebar();
get_footer();

?>



<script type="text/javascript">

	$j=jQuery.noConflict();

	$j(document).ready(function(){


		// $j('.imagenes .imagenes_chicas img').click(function(){
		// 	alert($j(this).html);
		// });
	});

	var imgs = $j('.imagenes .imagenes_chicas img');
	// var loadDiv = $j('#pagina');
	var loadDiv = $j('.imagenes .imagen_grande');

	var grandes = $j('.imagenes_grandes img');

	imgs.each(function(i){
		$j(this).click(function(event){

			// var id = event.target.id.toString();
			// id = i;
			// var id = $j(this).index;

			
			// var str = '.imagenes_grandes #'+id;

			var sigImg = grandes.eq(i);
			
			// loadDiv.html('');
			loadDiv.html(sigImg);

		});
	});

</script>