<?php

// правильный способ подключить стили и скрипты
add_action('wp_enqueue_scripts', 'mishkinaStyles');
function mishkinaStyles()
{
	wp_enqueue_style('main-style', get_stylesheet_uri());
	wp_enqueue_style('pages-style', get_template_directory_uri() . '/assets/css/projects.min.css');
}

add_action('wp_enqueue_scripts', 'mishkinaScripts');
function mishkinaScripts()
{
	wp_deregister_script('jquery');
	wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js');
	wp_enqueue_script('jquery');

	wp_enqueue_script('main-script', get_template_directory_uri() . '/assets/js/main.min.js', array('jquery'), null, true);
	wp_enqueue_script('projects-script', get_template_directory_uri() . '/assets/js/projects/projects.min.js', array('jquery'), null, true);
}

// ===============================================регистрация динамического меню=======================================
//=============меню главной страницы===================
add_action('after_setup_theme', function () {
	register_nav_menus([
		'header-menu' => 'Верхнее меню главной страницы',
		'projects-header-menu' => 'Верхнее меню проектов'
	]);
});

// Изменяет основные параметры меню
add_filter('wp_nav_menu_args', 'filter_wp_header_menu_args');
function filter_wp_header_menu_args($args)
{
	if ($args['theme_location'] === 'header-menu') {
		$args['container']  = 'nav';
		$args['container_class']  = 'header__menu';
		$args['items_wrap'] = '<ul class="%2$s">%3$s</ul>';
		$args['menu_class'] = 'header__menu-list';
	}
	return $args;
}
// Изменяем атрибут id у тега li
add_filter('nav_menu_item_id', 'filter_header_menu_item_css_id', 10, 4);
function filter_header_menu_item_css_id($menu_id, $item, $args, $depth)
{
	return $args->theme_location === 'header-menu' ? '' : $menu_id;
}
// Изменяем атрибут class у тега li
add_filter('nav_menu_css_class', 'filter_nav_header_menu_css_classes', 10, 4);
function filter_nav_header_menu_css_classes($classes, $item, $args, $depth)
{
	if ($args->theme_location === 'header-menu') {
		$classes = [
			'header__menu-lists'
		];
	}
	return $classes;
}
// Добавляем классы ссылкам
add_filter('nav_menu_link_attributes', 'filter_nav_header_menu_link_attributes', 10, 4);
function filter_nav_header_menu_link_attributes($atts, $item, $args, $depth)
{
	if ($args->theme_location === 'header-menu') {
		$atts['class'] = 'header__menu-link btn btn-main btn-order';
	}
	return $atts;
}
//=============меню главной страницы===================

//=============меню страницы проектов===================
// Изменяет основные параметры меню
add_filter('wp_nav_menu_args', 'filter_wp_projects_menu_args');
function filter_wp_projects_menu_args($args)
{
	if ($args['theme_location'] === 'projects-header-menu') {
		$args['container']  = 'nav';
		$args['container_class']  = 'header__projects-menu';
		$args['items_wrap'] = '<ul class="%2$s">%3$s</ul>';
		$args['menu_class'] = 'header__projects-menu-list';
	}
	return $args;
}
// Изменяем атрибут id у тега li
add_filter('nav_menu_item_id', 'filter_projects_menu_item_css_id', 10, 4);
function filter_projects_menu_item_css_id($menu_id, $item, $args, $depth)
{
	return $args->theme_location === 'projects-header-menu' ? '' : $menu_id;
}
// Изменяем атрибут class у тега li
add_filter('nav_menu_css_class', 'filter_nav_projects_menu_css_classes', 10, 4);
function filter_nav_projects_menu_css_classes($classes, $item, $args, $depth)
{
	if ($args->theme_location === 'projects-header-menu') {
		$classes = [
			'header__projects-menu-lists'
		];
	}
	return $classes;
}
// Добавляем классы ссылкам
add_filter('nav_menu_link_attributes', 'filter_nav_projects_menu_link_attributes', 10, 4);
function filter_nav_projects_menu_link_attributes($atts, $item, $args, $depth)
{
	if ($args->theme_location === 'projects-header-menu') {
		$atts['class'] = 'header__projects-menu-link btn btn-order';
	}
	return $atts;
}
//=============меню страницы проектов===================
// ===============================================регистрация динамического меню=======================================

show_admin_bar(false);

// ===============================================регистрация постов и таксономий======================================

add_theme_support('post-thumbnails', array('logo', 'about_studio_block', 'contacts_block', 'projects'));

add_action('init', 'logo_custom_init');
function logo_custom_init()
{
	register_post_type('logo', array( // первый параметр - это ID
		'labels'             => array(
			'name'               => 'Логотип', // Основное название типа записи
			'singular_name'      => 'Логотип', // отдельное название записи типа Book
			'add_new'            => 'Добавить новый логотип',
			'add_new_item'       => 'Добавить новый логотип',
			'all_items'          => 'Все логотипы'
		),
		'public'             => true,
		'menu_position'      => 5,
		'supports'           => array('title', 'thumbnail')
	));

	register_taxonomy('taxonomy_logo', ['logo'], [
		'label'                 => 'Категории логотипов', // определяется параметром $labels->name
		'hierarchical'          => true,
		'rewrite'               => true,
		'show_admin_column'     => true
	]);
}

add_action('init', 'price_block_custom_init');
function price_block_custom_init()
{
	register_post_type('price_block', array( // первый параметр - это ID
		'labels'             => array(
			'name'               => 'Блоки цен', // Основное название типа записи
			'singular_name'      => 'Блоки цен', // отдельное название записи типа Book
			'add_new'            => 'Добавить новый блок цен',
			'add_new_item'       => 'Добавить новый блок цен (начинать наполнять блоки информацией нужно с третьего по первый, чтобы они правильно расставились)',
			'all_items'          => 'Все блоки цен'
		),
		'public'             => true,
		'menu_position'      => 5,
		'supports'           => array('title')
	));

	register_taxonomy('taxonomy_price_block', ['price_block'], [
		'label'                 => 'Категории блоков цен', // определяется параметром $labels->name
		'hierarchical'          => true,
		'rewrite'               => true,
		'show_admin_column'     => true
	]);
}

add_action('init', 'projects_custom_init');
function projects_custom_init()
{
	register_post_type('projects', array( // первый параметр - это ID
		'labels'             => array(
			'name'               => 'Проекты', // Основное название типа записи
			'singular_name'      => 'Проекты', // отдельное название записи типа Book
			'add_new'            => 'Добавить новый проект',
			'add_new_item'       => 'Добавить новый проект',
			'all_items'          => 'Все проекты'
		),
		'public'             => true,
		'menu_position'      => 4,
		'supports'           => array('title', 'thumbnail')
	));

	register_taxonomy('taxonomy_projects', ['projects'], [
		'label'                 => 'Категории проектов', // определяется параметром $labels->name
		'hierarchical'          => true,
		'rewrite'               => true,
		'show_admin_column'     => true
	]);
}

add_action('init', 'about_studio_block_custom_init');
function about_studio_block_custom_init()
{
	register_post_type('about_studio_block', array( // первый параметр - это ID
		'labels'             => array(
			'name'               => 'Студия', // Основное название типа записи
			'singular_name'      => 'О студии', // отдельное название записи типа Book
			'add_new'            => 'Добавить описание о студии',
			'add_new_item'       => 'Добавить описание о студии',
		),
		'public'             => true,
		'menu_position'      => 7,
		'supports'           => array('title', 'thumbnail')
	));

	register_taxonomy('taxonomy_about_studio_block', ['about_studio_block'], [
		'label'                 => 'Категории студии', // определяется параметром $labels->name
		'hierarchical'          => true,
		'rewrite'               => true,
		'show_admin_column'     => true
	]);
}

add_action('init', 'contacts_block_custom_init');
function contacts_block_custom_init()
{
	register_post_type('contacts_block', array( // первый параметр - это ID
		'labels'             => array(
			'name'               => 'Контакты', // Основное название типа записи
			'singular_name'      => 'Контакты', // отдельное название записи типа Book
			'add_new'            => 'Добавить информацию в контакты',
			'add_new_item'       => 'Добавить информацию в контакты',
			'all_items'          => 'Все контакты'
		),
		'public'             => true,
		'menu_position'      => 7,
		'supports'           => array('title', 'thumbnail')
	));

	register_taxonomy('taxonomy_contacts_block', ['contacts_block'], [
		'label'                 => 'Категории контактов', // определяется параметром $labels->name
		'hierarchical'          => true,
		'rewrite'               => true,
		'show_admin_column'     => true
	]);

	register_taxonomy('taxonomy_footer_block', ['contacts_block'], [
		'label'                 => 'Категории нижней части сайта', // определяется параметром $labels->name
		'hierarchical'          => true,
		'rewrite'               => true,
		'show_admin_column'     => true
	]);
}

add_action('init', 'for_form_projects_custom_init');
function for_form_projects_custom_init()
{
	register_post_type('for_form_projects', array( // первый параметр - это ID
		'labels'             => array(
			'name'               => 'Для формы проектов', // Основное название типа записи
			'singular_name'      => 'Для формы проектов', // отдельное название записи типа Book
			'add_new'            => 'Добавить описание к форме проектов',
			'add_new_item'       => 'Добавить описание к форме проектов',
		),
		'public'             => true,
		'menu_position'      => 7,
		'supports'           => array('title', 'editor')
	));

	register_taxonomy('taxonomy_for_form_projects', ['for_form_projects'], [
		'label'                 => 'Категории описаний', // определяется параметром $labels->name
		'hierarchical'          => true,
		'rewrite'               => true,
		'show_admin_column'     => true
	]);
}

// ===============================================регистрация постов и таксономий======================================
//================================================ajax load more=======================================================

add_action('wp_footer', 'load_more_action_javascript'); // Write our JS below here

function load_more_action_javascript()
{ ?>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			var page_count = <?php echo ceil(wp_count_posts('projects')->publish / 2); ?>;
			var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
			var page = 2;

			jQuery('#portfolio__load-more').click(function() {
				var data = {
					'action': 'load_more_action',
					'page': page
				};
				// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
				jQuery.post(ajaxurl, data, function(response) {
					jQuery('#portfolio__container').append(response);

					if (page_count == page) {
						jQuery('#portfolio__load-more').hide();
					}
					page = page + 1;
				});
			});
		});
	</script>
	<?php
}

add_action('wp_ajax_load_more_action', 'load_more_action');
add_action('wp_ajax_nopriv_load_more_action', 'load_more_action');

function load_more_action()
{

	// The Query
	$query = new WP_Query(array(
		'post_type' => 'projects',
		'paged' => $_POST['page']
	));
	$size = array(840, 520);
	$default_attr = array(
		'class' => "portfolio__fon-img",
		'alt'   => trim(strip_tags($wp_postmeta->_wp_attachment_image_alt)),
	);

	// The Loop
	if ($query->have_posts()) {
		while ($query->have_posts()) {
			$query->the_post();
	?>
			<div class="portfolio__item">
				<a class="portfolio__item-link" href='<?php echo get_permalink(); ?>' target="_blank">
					<div class="portfolio__fon">
						<?php the_post_thumbnail($size, $default_attr); ?>
					</div>
				</a>
				<a class="portfolio__title" href='<?php echo get_permalink(); ?>' target="_blank">
					<h2 class="portfolio__title-title">
						<?php the_field('portfolio__title-title'); ?>
					</h2>
				</a>
			</div>
<?php
		}
	}
	wp_reset_postdata();
	wp_die(); // this is required to terminate immediately and return a proper response

}

//================================================ajax load more=======================================================

//================================================удалие <br> с Contact Form 7=========================================
add_filter('wpcf7_autop_or_not', '__return_false');
//================================================удалие <br> с Contact Form 7=========================================
