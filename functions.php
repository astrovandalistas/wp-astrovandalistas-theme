<?php 

// global $user_ID;

// $titulos = array(

// 	// 'Inicio' 		=> 'inicio.php',
// 	// 'Proyectos' 	=> 'inicio.php',
// 	// 'Proceso' 		=> 'proceso.php',
// 	// 'Manifiesto' 	=> 'page.php',
// 	// 'Bio' 			=> 'page.php',
// 	// 'Contacto' 		=> 'page.php',
// 	// 'Árma Sonora Telemática' => array(
// 	// 	"template"	=> "vacio.php",
// 	// 	"paginas"	=> array(
// 	// 		"Código"		=> "software.php",
// 	// 		"Hardware"		=> "hardware.php",
// 	// 		"Galería"		=> "galeria.php",
// 	// 		"Bitácora"		=> "bitacora.php"
// 	// 	)	
// 	// ),
// 	// 'Deep Thought V.2' => array(
// 	// 	"template"	=> "vacio.php",
// 	// 	"paginas"	=> array(
// 	// 		"Código"		=> "software.php",
// 	// 		"Hardware"		=> "hardware.php",
// 	// 		"Galería"		=> "galeria.php",
// 	// 		"Bitácora"		=> "bitacora.php"
// 	// 	)
// 	// ),
//   // 'Æffect Lab' => array(
//   //   "template"  => "vacio.php",
//   //   "paginas" => array(
//   //     "Código"    => "software.php",
//   //     "Hardware"    => "hardware.php",
//   //     "Galería"   => "galeria.php",
//   //     "Bitácora"    => "bitacora.php"
//   //   )
//   )

// );

// $madreID = 0;

// $loremImg = '<img src="'.get_stylesheet_directory_uri().'/lorem.png">';
// $loremTxt = '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. </p>';


// foreach ($titulos as $madre => $arrayOtemplate ) {
	
// 	$madreID = 0;
	
// 	$titulo = $madre;


// 	$page = array(
// 		'post_type'    => 'page',
// 		'post_content' => $loremImg . $loremTxt,
// 		'post_parent'  => 0,
// 		'post_author'  => $user_ID,
// 		'post_status'  => 'publish',
// 		'post_title'   => $titulo
// 	);


// 	$pageID = wp_insert_post ($page);
	
// 	if( !is_array($arrayOtemplate) ) {
// 		$template = $arrayOtemplate;		
// 	}
// 	if( is_array($arrayOtemplate) ) {
// 		$template = $arrayOtemplate["template"];
// 	}
// 	update_post_meta($pageID, "_wp_page_template", $template );
		

// 	if( is_array($arrayOtemplate) ) {
// 		$madreID = $pageID;
// 		$hijas = $arrayOtemplate["paginas"];
		
// 		if(count($hijas)>1){
			
// 			if ($madreID != 0) {

// 				foreach($hijas as $hija=>$template){
					
// 					$titulo = $hija;

// 					$page = array(
// 						'post_type'    => 'page',
// 						'post_content' => $loremImg . $loremTxt,
// 						'post_parent'  => $madreID,
// 						'post_author'  => $user_ID,
// 						'post_status'  => 'publish',
// 						'post_title'   => $titulo
// 					);

// 					$pageID = wp_insert_post ($page);
					
// 					update_post_meta($pageID, "_wp_page_template", $template );
				
// 				}


// 			}
// 		}
// 	}

		
// }














class MV_Cleaner_Walker_Nav_Menu extends Walker {
    var $tree_type = array( 'post_type', 'taxonomy', 'custom' );
    var $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );
    function start_lvl(&$output, $depth) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent\n";
        // $output .= "\n$indent<ul class=\"sub-menu\">\n";
    }
    function end_lvl(&$output, $depth) {
        $indent = str_repeat("\t", $depth);
        // $output .= "$indent</ul>\n";
        $output .= "$indent\n";

    }
    function start_el(&$output, $item, $depth, $args) {
        global $wp_query;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
        $class_names = $value = '';
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes = in_array( 'current-menu-item', $classes ) ? array( 'current-menu-item' ) : array();
        array_push($classes, 'menudiv');
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = strlen( trim( $class_names ) ) > 0 ? ' class="' . esc_attr( $class_names ) . '"' : '';
        
        $id = apply_filters( 'nav_menu_item_id', '', $item, $args );
        $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';
        $output .= $indent . '<div' . $id . $value . $class_names .' class="menudiv"><div class="text_table"><div class="text_container">';
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
    function end_el(&$output, $item, $depth) {
        $output .= "</div></div></div>\n";
    }
}



// echo makeDiv( "hols","",for ($i=0; $i < 10; $i++) { makeDiv("hola","","hola"); },"http://google.com" );





// function get_images( $postID, $size = 'thumbnail') {
  
// $postContent = get_post($postID)->post_content;
// $searchPattern = '~<img [^\>]*\ />~';

// preg_match_all( $searchPattern, $postContent, $photos );
  
//   $results = array();

//   if ($photos) {
//     foreach ($photos as $photo) {

//       // preg_match( '@src="([^"]+)"@' ,  , $src );

//       // get the correct image html for the selected size
//       $results[] = wp_get_attachment_image_src($photo->ID, $size);
//     }
//   }
//   return $results;
// }

function featImg( $size = 'full', $id = "" ){
  $img = wp_get_attachment_image_src( get_post_thumbnail_id(), $size);
  return $img[0];
}

function filter($title="",$filter="filter"){
  return apply_filters("the_".$filter,$title);
}

function themeDir() {
	return get_stylesheet_directory_uri();
}

function timThumb( $src, $w=200, $h=200, $zc=1, $q=100 ) {
  return get_stylesheet_directory_uri().'/scripts/timthumb/timthumb.php?src='.$src.'&w='.$w.'&h='.$h.'&zc='.$zc.'&q='.$q;
}
function get_images( $postID, $size = 'thumbnail') {
  

  $photos = get_children( array('post_parent' => $postID, 'post_status' => 'null', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC') );
  
  $results = array();

  if ($photos) {
    foreach ($photos as $photo) {
      // get the correct image html for the selected size
      $results[] = wp_get_attachment_image_src($photo->ID, $size);
    }
  }

  return $results;
}





function makeDiv($id="",$class="", $content="", $link=""){
	$str = '<div';
		if($id!="") { 		$str .= ' id="'.$id.'"';	}
		if($class!="") { 	$str .= ' class="'.$class.'"'; }

	$str .= '>';

		if($link!="") { 	$str .= '<a href="'.$link.'">';	}
		if($content!="") { 	$str .= $content;	}
		if($link!="") {		$str .= '</a>';	}
	
  $str .= '</div>';
	
	return $str;
}


function makeLi($id="",$class="", $content="", $link=""){
  $str = '<li';
    if($id!="") {     $str .= ' id="'.$id.'"';  }
    if($class!="") {  $str .= ' class="'.$class.'"'; }

  $str .= '>';

    if($link!="") {   $str .= '<a href="'.$link.'">'; }
    if($content!="") {  $str .= $content; }
    if($link!="") {   $str .= '</a>'; }
  $str .= '</li>';
  
  return $str;
}
      


function makeImg($src=""){
	if($src!="") {
  		$str = '<img src="'.$src.'">';
	}

	return $str;
}

function startDiv($id="",$class=""){
  $str = '<div';
    if($id!="") {     $str .= ' id="'.$id.'"';  }
    if($class!="") {  $str .= ' class="'.$class.'"'; }

  $str .= '>';
  
  return $str;
}



function closeDiv(){
  $str .= '</div>';
  
  return $str;
}


function makeTextDiv($content="", $link="", $align="justify"){
	
		if($link!="") { 	$str .= '<a href="'.$link.'">';	}
		if($content!="") { 	
			$str .= '<div class="text_table"><div class="text_container"><div class="vcenter_text '.$align.'">';
				$str .= $content;
			$str .= '</div></div></div>';
		}
		if($link!="") {		$str .= '</a>';	}
	
	return $str;
}


function makeTitleDiv($content="", $link="", $align="justify"){
  
    if($link!="") {   $str .= '<a href="'.$link.'">'; }
    if($content!="") {  
      $str .= makeDiv("","div_titulo",
                makeDiv("","text_table",
                  makeDiv("","text_container",
                      makeDiv("","vcenter_text ".$align,$content )
                  )
                )
              );
    }
    if($link!="") {   $str .= '</a>'; }
  
  return $str;
}


function makeBannerDiv($content="", $link="", $align="justify"){
  
    if($link!="") {   $str .= '<a href="'.$link.'">'; }
    if($content!="") {  
      $str .= makeDiv("","div_banner",
                makeDiv("","text_table",
                  makeDiv("","text_container",
                      makeDiv("","vcenter_text ".$align,$content )
                  )
                )
              );
    }
    if($link!="") {   $str .= '</a>'; }
  
  return $str;
}

function makeScrollDiv($content){
  $str .= '<div class="scroll_hide"><div class="scroller">';
    $str .= $content;
  $str .= '</div></div>';
  
  return $str;
}


function makeLink($content="",$url=""){
	if($url=="") $url = "#";
	$str = '<a href="'.$url.'">'.$content.'</a>';
	return $str;
}

?>