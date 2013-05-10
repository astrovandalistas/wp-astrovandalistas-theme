<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */
?>

<?php echo closeDiv(); // contenido ?>
				<div id="footer" class="row">
					<div class="twelvecol last">

						<?php  echo makeLink(makeImg(themeDir().'/imagenes/copyleft.png'),"https://github.com/astrovandalistas/astrovandalistas.cc"); ?>  astrovandalistas* 2013
						
					</div>
				</div>
				
				
			</div><!-- container -->

<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
</body>
</html>


