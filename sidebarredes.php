<div id="news_feed" class="titulo_sidebar">
		<?php
		$d=qtrans_getLanguage();
		if ($d=="es"||$d=="ES")
		echo 'NOTICIAS';
		elseif ($d=="en"||$d=="EN")
		echo 'NEWS_FEED';
		?>

	</div>
	<div id="twitter">
		<div id="twitterwidget">
<!-- 		<?php
		if ( ! dynamic_sidebar( 'third-widget-area' ) ) : ?>
		<?php endif; ?>
 -->
 		</div>
		<div id="contactos">
			<div id="followbotones">
				<div id="follow" class="barra_sidebar">
				<?php
				$d=qtrans_getLanguage();
				if ($d=="es"||$d=="ES")
				echo 'SÍGUENOS EN';
				elseif ($d=="en"||$d=="EN")
				echo 'FOLLOW US IN';
				?>
				</div>
				<div id="botones">
					<a href="http://twitter.com/centro_news">
            <?php echo '<img src="'
						.get_bloginfo('stylesheet_directory').
              '/imgs/twitter.png"></img>'; ?>
          </a>
					<a href="http://twitter.com/centro_news">
          <?php echo '<img src="'
						.get_bloginfo('stylesheet_directory').
						'/imgs/facebook.png"></img>'; ?>
          </a>
				</div>
			</div>
			</div>
			<div id="newsletter" class="barra_sidebar">
				<?php
				$d=qtrans_getLanguage();
				if ($d=="es"||$d=="ES") {
				echo 'SUBSCRÍBETE AL NEWSLETTER';
				echo '<br/>';
				echo do_shortcode( '[contact-form-7 id="3231" title="NEWSLETTERES"]' );
				}
				elseif ($d=="en"||$d=="EN"){
				echo 'SUBSCRÍBE TO THE NEWSLETTER';
				echo '<br/>';

				echo do_shortcode( '[contact-form-7 id="3232" title="NEWSLETTEREN"]' ); 
				}
				?>		
				
			</div>
		</div>

	</div>	