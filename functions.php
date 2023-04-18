<?php
if (!function_exists('naydenova_art_support')) :
	function naydenova_art_support() {
		// Alignwide and alignfull classes in the block editor.
		add_theme_support('align-wide');

		// Add support for responsive embedded content.
		// https://github.com/WordPress/gutenberg/issues/26901
		add_theme_support('responsive-embeds');

		// Add support for editor styles.
		add_theme_support('editor-styles');

		add_theme_support( 'disable-layout-styles' );

		// Enqueue editor styles.
		add_editor_style(
			array(
				'/assets/style.min.css',
			)
		);

		// Register nav menus
		if (defined('IS_GUTENBERG_PLUGIN')) {
			register_nav_menus(
				array(
					'primary' => __('Primary Navigation', 'naydenova_art'),
				)
			);
		}

		add_filter(
			'block_editor_settings_all',
			function($settings) {
				$settings['defaultBlockTemplate'] = '<!-- wp:group {"layout":{"inherit":true}} --><div class="Group"><!-- wp:post-content /--></div><!-- /wp:group -->';
				return $settings;
			}
		);
	}
endif;
add_action('after_setup_theme', 'naydenova_art_support', 9);

/**
 *
 * Enqueue scripts and styles.
 */
function naydenova_art_editor_styles() {
	// Add the child theme CSS if it exists.
	if (file_exists(get_stylesheet_directory() . '/assets/theme.css')) {
		add_editor_style(
			'/assets/theme.css'
		);
	}
}
add_action('admin_init', 'naydenova_art_styles');

/**
 *
 * Enqueue scripts and styles.
 */
function naydenova_art_styles() {
	wp_enqueue_style('naydenova_art_main_stylesheet', get_template_directory_uri() . '/assets/style.min.css', array(), wp_get_theme()->get('Version'));

	// Add the child theme CSS if it exists.
	if (file_exists(get_stylesheet_directory() . '/assets/theme.css')) {
		wp_enqueue_style('naydenova_art_child_styles', get_stylesheet_directory_uri() . '/assets/theme.css', array('naydenova_art_main_stylesheet'), wp_get_theme()->get('Version'));
	}

	wp_register_script('main-js', get_template_directory_uri() . '/assets/main.min.js');
	wp_enqueue_script( 'main-js' );
}
add_action('wp_enqueue_scripts', 'naydenova_art_styles');

// Load block patterns
require get_template_directory() . '/inc/block-patterns.php';

// Add the child theme patterns if they exist.
if (file_exists(get_stylesheet_directory() . '/inc/block-patterns.php')) {
	require_once get_stylesheet_directory() . '/inc/block-patterns.php';
}

// Remove skip to content link injection with JS
remove_action('wp_footer', 'the_block_template_skip_link');

// Change the elipsis of excerpt fields
function new_excerpt_more($more) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

add_filter('comment_form_logged_in', function( $logged_in_as, $commenter, $user_identity) {
  return sprintf(
		'<p class="CommentProfile">%s</p>',
		sprintf(
				__('<div class="CommentProfile-avatarRow"><img width="40" height="40" src="http://2.gravatar.com/avatar/28c37fbdafc205b92859ddbe02cf3878?s=40&d=mm&r=g" class="CommentProfile-avatar" loading="lazy" /> <div class="CommentProfile-usernameLogout"><a class="CommentProfile-username d-block" href="%1$s" aria-label="%2$s">%3$s</a><a class="CommentProfile-secondary d-block" href="%4$s">Излизане</a></div></div>'),
				get_edit_user_link(),
				esc_attr(sprintf(__('В момента коментирате, използвайки вашия профил: %s. Настройки на профила.'), $user_identity)),
				$user_identity,
				wp_logout_url(apply_filters('the_permalink', get_permalink(get_the_ID()), get_the_ID()))
		)
);
}, 10, 3 );

add_filter('comment_form_default_fields', 'website_remove');
function website_remove($fields) {
	if(isset($fields['url']))
	unset($fields['url']);
	return $fields;
}
