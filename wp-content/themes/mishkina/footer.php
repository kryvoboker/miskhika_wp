<footer class="footer">
		<div class="container">
			<div class="footer__inner">
				<div class="footer__menu">
					<?php 
						if( is_front_page() ){
							// если есть меню, то оно выведится, если нет - то нет
							if ( has_nav_menu('header-menu')) {
								// что-то перед меню
								wp_nav_menu( [
									'theme_location'  => 'header-menu',
								] );
							}
						}
						else {
							// если есть меню, то оно выведится, если нет - то нет
							if ( has_nav_menu('projects-header-menu')) {
								// что-то перед меню
								wp_nav_menu( [
									'theme_location'  => 'projects-header-menu',
								] );
							}
						}
					?>
				</div>

				<?php $query = new WP_Query( array( 
							'taxonomy_footer_block' => 'footer-info'
						) );
				?>
					<?php if ( $query->have_posts() ) : ?>
						<?php while ( $query->have_posts() ) : $query->the_post(); ?>
							<div class="footer__socials">
								<a class="footer__socials-link contacts__socials-link--instagramm" target="_blank"
									href="<?php the_field('contacts__socials-link--facebook'); ?>"></a>
								<a class="footer__socials-link contacts__socials-link--facebook" target="_blank"
									href="<?php the_field('contacts__socials-link--instagramm'); ?>"></a>
							</div>
							<div class="footer__license">
								<p class="footer__license-text">
									<?php the_field('footer__license-text'); ?>
								</p>
							</div>
						<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>
					<?php endif; ?>

				
			</div>
		</div>
	</footer>
	
	
	<?php wp_footer(); ?>
</body>

</html>
