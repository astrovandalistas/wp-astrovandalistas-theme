<?php
/*
Template Name: Inicio
 */

get_header();

// eventos:

$divTitulo = makeTitleDiv("próximos eventos",$link);

if (class_exists('EM_Events')) {
	$eventos = EM_Events::output( array('order'=>'ASC','scope'=>'future') );
	// $eventos = '<ul id="lista_eventos">';
	// $eventos .= EM_Events::output( array('limit'=>3,'orderby'=>'name','scope'=>'past') );
	// $eventos .= '</ul>';
    $divContenido = makeDiv("lista_eventos","", $eventos );
}


$eventos = makeDiv("eventos","twelvecol home_div",$divTitulo.$divContenido);






$args = array(
	'post_type' => 'proyecto', 'posts_per_page' => 1,
    'category_name' => 'en-proceso'
);


$enproceso = new WP_Query($args);


while ($enproceso->have_posts()) : $enproceso->the_post(); 
	$img = makeImg(featImg());
	$procesoLink = get_permalink();
 	$titulo = get_the_title();
 	$titulo = filter($titulo,'title');	
 	$titulo = str_replace ( "//" , "// <br/>", $titulo );
	$divEnProceso = makeDiv("","en_proceso titulo","proyecto en proceso");
	$divTitulo = makeDiv("","titulo",$titulo);
	$divImagen = makeDiv("","imagen",$img);
	$proceso = $divEnProceso.$divTitulo.$divImagen;
endwhile;


if ( have_posts() ) while ( have_posts() ) : the_post();

	$echo = '';

	$eventos = makeDiv("eventos","",$eventos);
	$proceso = makeDiv("proceso","",$proceso,$procesoLink);
	$twitter = makeDiv("twitter","","...");
	$echo .= makeDiv("eventos","fourcol",$eventos);
	$echo .= makeDiv("proceso_twitter","eightcol last",$proceso.$twitter);

	echo $echo;


endwhile; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>



<script type='text/javascript'>

    var $j = jQuery.noConflict();

    jQuery(function($j){
	    var div = $j("#twitter");
// div.css("backgroundColor","#fff");
// div.attr("height","300px");
	    div.tweet({
            username: "astrovandalista",
            // join_text: "auto",
            avatar_size: 32,
            count: 10,
            // auto_join_text_default: "we said,",
            // auto_join_text_ed: "we",
            // auto_join_text_ing: "we were",
            // auto_join_text_reply: "we replied to",
            // auto_join_text_url: "we were checking out",
            loading_text: "***"
        });


    });

</script> 