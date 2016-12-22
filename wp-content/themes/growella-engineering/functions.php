<?php
/**
 * Child theme functions.
 *
 * @package Growella\EngineeringBlog
 */

namespace Growella\EngineeringBlog;

/**
 * Enqueue highlight.js for syntax highlighting.
 */
function load_highlight_js() {
	wp_enqueue_style(
		'highlight-js',
		'//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.9.0/styles/default.min.css',
		null,
		'9.9.0'
	);

	wp_register_script(
		'highlight-js',
		'https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.9.0/highlight.min.js',
		null,
		'9.9.0',
		true
	);

	wp_enqueue_script(
		'growella-engineering',
		get_stylesheet_directory_uri() . '/assets/js/scripts.js',
		array( 'highlight-js' ),
		null,
		true
	);
}
add_action( 'init', __NAMESPACE__ . '\load_highlight_js' );
