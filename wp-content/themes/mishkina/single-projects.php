<?php get_header(); ?>

<main class="main">
	<div class="container">
		<section class="photos">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<article class="photos__content">
						<h1 class="photos__title">
							<?php the_title(); ?>
						</h1>
						<div class="photos__inner">
							<div class="photos__text">
								<?php the_field('photos__text'); ?>
							</div>
							<?php if (have_rows('photos__lists')) : ?>
								<?php while (have_rows('photos__lists')) : the_row(); ?>
									<ul class="photos__lists">
										<li class="photos__list"><?php the_sub_field('photos__list-area'); ?><span><?php the_sub_field('photos__list-squares'); ?></span></li>
										<li class="photos__list"><?php the_sub_field('photos__list-location'); ?></li>
										<li class="photos__list"><?php the_sub_field('photos__list-year'); ?></li>
										<li class="photos__list"><?php the_sub_field('photos__list-status'); ?></li>
									</ul>
								<?php endwhile; ?>
							<?php endif; ?>
						</div>
						<div class="photos__row">
							<div class="grid">
								<div class="grid-item grid-item--width3">
									<a href="<?php the_field('photos__list-img-first'); ?>" data-fancybox>
										<img class="photo__img" src="<?php the_field('photos__list-img-first'); ?>" alt="">
									</a>
								</div>
								<?php if (have_rows('grid')) : ?>
									<div class="grid-sizer"></div>
									<div class="gutter-sizer"></div>
									<div class="grid-item grid-item--width2"></div>
									<?php while (have_rows('grid')) : the_row(); ?>
										<div class="grid-item">
											<a href="<?php the_sub_field('photo__img'); ?>" data-fancybox>
												<img class="photo__img" src="<?php the_sub_field('photo__img'); ?>" alt="">
											</a>
										</div>
									<?php endwhile; ?>
								<?php endif; ?>
								<div class="grid-item grid-item--width3">
									<a href="<?php the_field('photos__list-img-last'); ?>" data-fancybox>
										<img class="photo__img" src="<?php the_field('photos__list-img-last'); ?>" alt="">
									</a>
								</div>
							</div>
						<?php endwhile;
				else : ?>
					<?php endif; ?>
					<div class="projects__form-box" id="order">
						<div class="projects__bottom">
							<div class="projects__bottom-inner">
								<?php $query = new WP_Query(array(
									'taxonomy_for_form_projects' => 'form-projects-page'
								)); ?>
								<?php if ($query->have_posts()) : ?>
									<?php while ($query->have_posts()) : $query->the_post(); ?>
										<h3 class="projects__bottom-title">
											<?php the_title(); ?>
										</h3>
										<div class="projects__bottom-text">
											<?php the_content(); ?>
										</div>
									<?php endwhile; ?>
									<?php wp_reset_postdata(); ?>
								<?php endif; ?>
								<div class="projects__form default-projects-form">
									<!-- форма обратно связи -->
									<?php echo do_shortcode('[contact-form-7 id="455" title="Форма страницы проекта"]'); ?>
								</div>
							</div>
						</div>
					</div>
						</div>
					</article>
		</section>
	</div>
</main>




<?php get_footer(); ?>