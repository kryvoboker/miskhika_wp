<?php get_header();

?>



<main class="main">
    <a href="deployment.configure.server">link</a>
	<section class="slider">
		<div class="container">
			<div class="slider__content" id="disable-content">
				<div class="slider-inner">
					<?php if (have_rows('slider-inner')) : ?>
						<?php while (have_rows('slider-inner')) : the_row();
							$image = get_sub_field('slider-img');
						?>
							<div class="slider-item">
								<img class="slider-img" src="<?php echo esc_url($image) ?>" alt="">
							</div>
						<?php endwhile; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>
	<section class="price" id="price">
		<div class="container">
			<h1 class="price__title">
				<?php the_field('price__title'); ?>
			</h1>
			<div class="price__inner">
				<?php $query = new WP_Query(array(
					'taxonomy_price_block' => 'first-block, second-block'
				));
				while ($query->have_posts()) : $query->the_post(); ?>
					<article class="price__item">
						<h2 class="price__item-title">
							<?php the_title(); ?>
						</h2>
						<?php if (have_rows('price__inner')) : ?>
							<?php while (have_rows('price__inner')) : the_row(); ?>
								<div class="price__item-price">
									<?php while (have_rows('price__item-price-block')) : the_row(); ?>
										<p class="price__item-price-text">
											<span><?php the_sub_field('price__item-price-text-span-one'); ?></span>
											<span><?php the_sub_field('price__item-price-text-span-two'); ?></span>
											<span><?php the_sub_field('price__item-price-text-span-three'); ?></span>
											<span><?php the_sub_field('price__item-price-text-span-four'); ?></span>
											<span><?php the_sub_field('price__item-price-text-span-five'); ?></span>
											<span><?php the_sub_field('price__item-price-text-span-six'); ?></span>
											<span><?php the_sub_field('price__item-price-text-span-seven'); ?></span>
										</p>
									<?php endwhile; ?>
								</div>
								<div class="price__include">
									<?php the_sub_field('price__include'); ?>
								</div>
								<ul class="price__lists">
									<?php while (have_rows('price__list-block')) : the_row(); ?>
										<li class="price__list">
											<?php the_sub_field('price__list'); ?>
										</li>
									<?php endwhile; ?>
								</ul>
							<?php endwhile; ?>
						<?php endif; ?>
					</article>
				<?php endwhile;
				wp_reset_postdata(); ?>

				<?php $query = new WP_Query(array(
					'taxonomy_price_block' => 'third-block'
				));
				while ($query->have_posts()) : $query->the_post(); ?>
					<article class="price__item">
						<h2 class="price__item-title">
							<?php the_title(); ?>
						</h2>
						<?php if (have_rows('price__inner-third')) : ?>
							<?php while (have_rows('price__inner-third')) : the_row(); ?>
								<div class="price__item-price">
									<?php while (have_rows('price__item-price-block')) : the_row(); ?>
										<p class="price__item-price-text">
											<span><?php the_sub_field('price__item-price-text-span-one'); ?></span>
											<span><?php the_sub_field('price__item-price-text-span-two'); ?></span>
											<span><?php the_sub_field('price__item-price-text-span-three'); ?></span><br />
											<span><?php the_sub_field('price__item-price-text-span-four'); ?></span>
										</p>
									<?php endwhile; ?>
								</div>
								<div class="price__include">
									<?php the_sub_field('price__include'); ?>
								</div>
								<ul class="price__lists">
									<?php while (have_rows('price__list-block')) : the_row(); ?>
										<li class="price__list">
											<?php the_sub_field('price__list'); ?>
										</li>
									<?php endwhile; ?>
								</ul>
							<?php endwhile; ?>
						<?php endif; ?>
					</article>
				<?php endwhile;
				wp_reset_postdata(); ?>
			</div>
			<div class="price__bottom">
				<div class="price__bottom-inner">
					<?php $query = new WP_Query(array(
						'taxonomy_for_form_projects' => 'form-projects-main-top'
					)); ?>
					<?php if ($query->have_posts()) : ?>
						<?php while ($query->have_posts()) : $query->the_post(); ?>
							<h3 class="price__bottom-title">
								<?php the_title(); ?>
							</h3>
							<div class="price__bottom-textt">
								<?php the_content(); ?>
							</div>
						<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>
					<?php endif; ?>
				</div>
				<?php echo do_shortcode('[contact-form-7 id="231" title="Форма блока цен"]'); ?>
			</div>
		</div>
	</section>
	<section class="portfolio" id="portfolio">
		<div class="container">
			<h1 class="portfolio__title-main">
				<?php the_field('portfolio__title-main'); ?>
			</h1>
			<div class="portfolio__inner">
				<?php $query = new WP_Query(array(
					'post_type' => 'projects',
					'paged' => 1
				));
				$size = array(840, 520);
				$default_attr = array(
					'class' => "portfolio__fon-img",
					'alt'   => trim(strip_tags($wp_postmeta->_wp_attachment_image_alt)),
				);
				?>
				<?php if ($query->have_posts()) : ?>
					<div class="portfolio__row" id="portfolio__container">
						<?php while ($query->have_posts()) : $query->the_post(); ?>
							<article class="portfolio__item">
								<a class="portfolio__item-link" href="<?php echo get_permalink(); ?>" target="_blank">
									<div class="portfolio__fon">
										<?php the_post_thumbnail($size, $default_attr); ?>
									</div>
								</a>
								<a class="portfolio__title" href="<?php echo get_permalink(); ?>" target="_blank">
									<h2 class="portfolio__title-title">
										<?php the_title(); ?>
									</h2>
								</a>
							</article>
						<?php endwhile; ?>
					</div>
					<?php wp_reset_postdata(); ?>

				<?php endif; ?>
				<button class="portfolio__row-btn default-btn" id="portfolio__load-more">
					Показати більше
				</button>
			</div>
		</div>
	</section>
	<section class="studio" id="studio">
		<div class="container">
			<?php $query = new WP_Query(array(
				'taxonomy_about_studio_block' => 'about-studio'
			));
			$size = 'full';
			$default_attr = array(
				'class' => "studio__image-img"
			);
			?>
			<?php if ($query->have_posts()) : ?>
				<article class="studio__row">
					<?php while ($query->have_posts()) : $query->the_post(); ?>
						<h2 class="studio__title">
							<?php the_title(); ?>
						</h2>
						<div class="studio__inner">
							<div class="studio__image">
								<?php the_post_thumbnail($size, $default_attr); ?>
								<p class="studio__image-txt">
									<?php the_field('studio__image-txt'); ?>
								</p>
								<p class="studio__image-txt">
									<?php the_field('studio__image-txt-position'); ?>
								</p>
							</div>
							<div class="studio__text">
								<p class="studio__text-txt">
									<?php the_field('studio__text-txt-bg'); ?>
								</p>
								<p class="studio__text-txt">
									<?php the_field('studio__text-txt-small'); ?>
								</p>
							</div>
						</div>
					<?php endwhile; ?>
				</article>
				<?php wp_reset_postdata(); ?>
			<?php endif; ?>
		</div>
	</section>
	<section class="contacts" id="contacts">
		<div class="container">
			<?php $query = new WP_Query(array(
				'taxonomy_contacts_block' => 'contacts-info'
			));
			$size = 'full';
			$default_attr = array(
				'class' => "contacts__fon-img"
			);
			?>
			<?php if ($query->have_posts()) : ?>
				<?php while ($query->have_posts()) : $query->the_post(); ?>
					<div class="contacts_row" style="background-image: url(<?php echo get_the_post_thumbnail_url($post, $size); ?>)">
						<article class="contacts__inner">
							<h4 class="contacts__title">
								<?php the_title(); ?>
							</h4>
							<div class="contacts__text">
								<?php the_field('contacts__text'); ?>
							</div>
							<div class="contacts__box">
								<a class="contacts__box-contact" target="_blank" href="mailto:<?php the_field('contacts__box-contact-email'); ?>">
									<?php the_field('contacts__box-contact-email'); ?>
								</a>
								<a class="contacts__box-contact" href="tel:<?php the_field('contacts__box-contact-first'); ?>">
									<?php the_field('contacts__box-contact-first'); ?>
								</a>
								<a class="contacts__box-contact" href="tel:<?php the_field('contacts__box-contact-second'); ?>">
									<?php the_field('contacts__box-contact-second'); ?>
								</a>
							</div>
							<div class="contacts__socials">
								<a class="contacts__socials-link contacts__socials-link--instagramm" href="<?php the_field('contacts__socials-link--instagramm'); ?>" target="_blank">
								</a>
								<a class="contacts__socials-link contacts__socials-link--facebook" href="<?php the_field('contacts__socials-link--facebook'); ?>" target="_blank">
								</a>
							</div>
						</article>
						<!-- форма обратно связи -->
						<?php echo do_shortcode('[contact-form-7 id="323" class:contacts__form title="Форма Свяжитесь с нами"]'); ?>
					</div>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			<?php endif; ?>
		</div>

	</section>
</main>

<?php get_footer(); ?>
