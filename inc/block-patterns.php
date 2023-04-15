<?php
/**
 * NaydenovaArt Theme: Block Patterns
 *
 * @package NaydenovaArt
 */
if (!function_exists('naydenova_art_register_block_patterns')):
	function naydenova_art_register_block_patterns() {
		if (function_exists('register_block_pattern_category')) {
			register_block_pattern_category(
				'naydenova_art',
				array('label' => __('NaydenovaArt', 'naydenova_art'))
			);
		}

		if (function_exists('register_block_pattern')) {
			// register header template
			register_block_pattern(
				'naydenova_art/header',
				array(
					'title'      => __('Header', 'naydenova_art'),
					'categories' => array('header'),
					'blockTypes' => array('core/template-part/header'),
					'content'    => file_get_contents(get_theme_file_path('/parts/header.html')),
				)
			);
		}
	}
endif;

add_action('init', 'naydenova_art_register_block_patterns', 9);
