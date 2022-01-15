<!DOCTYPE html>
<html lang="uk">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php bloginfo('description'); ?></title>
	<?php wp_head(); 
	
	
	?>
</head>

<body>
	<header class="header" id="main">
		<div class="container">
			<div class="header__top">
				<div class="header__logo-inner">
					<?php $query = new WP_Query(array(
						'taxonomy_logo' => 'logotype'
					));
					$size = array(64, 64);
					$default_attr = array(
						'class' => "header__logo-img",
						'alt'   => trim(strip_tags($wp_postmeta->_wp_attachment_image_alt)),
					);
					?>
					<?php if ($query->have_posts()) : ?>
						<?php while ($query->have_posts()) : $query->the_post(); ?>
							<a class="header__logo" href="<?php echo get_home_url(); ?>">
								<?php the_post_thumbnail($size, $default_attr); ?>
							</a>
						<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>
					<?php endif; ?>
				</div>
				<?php
				if (is_front_page()) {
					// если есть меню, то оно выведится, если нет - то нет
					if (has_nav_menu('header-menu')) {
						// что-то перед меню
						wp_nav_menu([
							'theme_location'  => 'header-menu',
						]);
					}
				?>
					<div class="header__burger">
						<div id="menuToggle">
							<input type="checkbox" id="checkBox" />
							<span id="span1"></span>
							<span id="span2"></span>
							<span id="span3"></span>
						</div>
					</div>
				<?php
				} else {
					// если есть меню, то оно выведится, если нет - то нет
					if (has_nav_menu('projects-header-menu')) {
						// что-то перед меню
						wp_nav_menu([
							'theme_location'  => 'projects-header-menu',
						]);
					}
				}
				?>
			</div>
		</div>
	</header>