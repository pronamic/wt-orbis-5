<?php

/**
 * Theme
 */
class Orbis_Theme {
	/**
	 * Scripts
	 *
	 * @var Orbis_Theme_Scripts
	 */
	private $scripts;

	/**
	 * Admin
	 *
	 * @var Orbis_Theme_Admin|null
	 */
	private $admin;

	/**
	 * Construct
	 */
	public function __construct() {
		// Scripts
		$this->scripts = new Orbis_Theme_Scripts();

		// Admin
		if ( is_admin() ) {
			$this->admin = new Orbis_Theme_Admin();
		}

		// Actions
		add_action( 'after_setup_theme', [ $this, 'after_setup_theme' ] );
		add_action( 'init', [ $this, 'register_block_styles' ] );

		add_action( 'template_redirect', [ $this, 'template_redirect' ] );
		add_filter( 'query_vars', [ $this, 'query_vars' ] );
		add_action( 'pre_get_posts', [ $this, 'pre_get_posts' ] );

		add_filter( 'navigation_markup_template', [ $this, 'navigation_markup_template' ], 10, 2 );
		add_filter( 'render_block_core/list', [ $this, 'render_list_block' ], 10, 2 );
		add_filter( 'render_block_core/post-template', [ $this, 'render_post_template_block' ], 10, 2 );
	}

	/**
	 * Register block styles.
	 */
	public function register_block_styles() {
		register_block_style(
			'core/list',
			[
				'name'  => 'bootstrap-list-group',
				'label' => __( 'Bootstrap List Group', 'orbis-5' ),
			]
		);

		register_block_style(
			'core/post-template',
			[
				'name'  => 'bootstrap-list-group',
				'label' => __( 'Bootstrap List Group', 'orbis-5' ),
			]
		);
	}

	/**
	 * Render List block.
	 *
	 * @param string $block_content Block content.
	 * @param array  $block         Block data.
	 * @return string
	 */
	public function render_list_block( $block_content, $block ) {
		$class_name = $block['attrs']['className'] ?? '';

		if ( '' === $block_content || ! in_array( 'is-style-bootstrap-list-group', preg_split( '/\s+/', $class_name ), true ) ) {
			return $block_content;
		}

		$processor = new WP_HTML_Tag_Processor( $block_content );

		if ( ! $processor->next_tag() || ! $processor->has_class( 'wp-block-list' ) ) {
			return $block_content;
		}

		$processor->add_class( 'list-group' );

		while ( $processor->next_tag( 'LI' ) ) {
			$processor->add_class( 'list-group-item' );
		}

		return $processor->get_updated_html();
	}

	/**
	 * Render Post Template block.
	 *
	 * @param string $block_content Block content.
	 * @param array  $block         Block data.
	 * @return string
	 */
	public function render_post_template_block( $block_content, $block ) {
		$class_name = $block['attrs']['className'] ?? '';

		if ( '' === $block_content || ! in_array( 'is-style-bootstrap-list-group', preg_split( '/\s+/', $class_name ), true ) ) {
			return $block_content;
		}

		$processor = new WP_HTML_Tag_Processor( $block_content );

		if ( ! $processor->next_tag( 'UL' ) || ! $processor->has_class( 'wp-block-post-template' ) ) {
			return $block_content;
		}

		$processor->add_class( 'list-group' );

		while ( $processor->next_tag( 'LI' ) ) {
			if ( ! $processor->has_class( 'wp-block-post' ) ) {
				continue;
			}

			$processor->add_class( 'list-group-item' );
		}

		return $processor->get_updated_html();
	}

	/**
	 * After Setup Theme
	 */
	public function after_setup_theme() {
		/* Editor Style */
		$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		add_editor_style( '/css/editor-style' . $min . '.css' );

		/* Text Domain */
		load_theme_textdomain( 'orbis-5', get_template_directory() . '/languages' );
		load_theme_textdomain( 'pronamic-money', get_template_directory() . '/vendor/pronamic/wp-money/languages/' );

		/* Theme support */
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-formats', [ 'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat' ] );
		add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ] );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'title-tag' );

		/* Navigation menu's */
		register_nav_menus(
			[
				'primary' => __( 'Primary Menu', 'orbis-5' ),
			]
		);

		/* Image sizes */
		add_image_size( 'featured', 244, 150, true );
		add_image_size( 'avatar', 60, 60, true );
	}

	public function template_redirect() {
		if ( ! is_post_type_archive( 'orbis_person' ) ) {
			return;
		}

		$url = get_post_type_archive_linK( 'orbis_person' );

		$args = $_GET; // WPCS: CSRF ok.

		$args = array_filter( $args );

		if ( isset( $args['c'] ) && is_array( $args['c'] ) ) {
			$terms = get_terms(
				[
					'taxonomy' => 'orbis_person_category',
					'include'  => $args['c'],
				]
			);

			$args['c'] = implode( ',', wp_list_pluck( $terms, 'slug' ) );
		}

		if ( $args !== $_GET ) { // WPCS: CSRF ok.
			$url = add_query_arg( $args, $url );

			wp_safe_redirect( $url );

			exit;
		}
	}

	/**
	 * Query vars.
	 *
	 * @see https://codex.wordpress.org/Plugin_API/Filter_Reference/query_vars
	 * @param array $query_vars
	 * @return array
	 */
	public function query_vars( $query_vars ) {
		$query_vars[] = 'c';

		return $query_vars;
	}

	/**
	 * Pre get posts.
	 *
	 * @see https://codex.wordpress.org/Plugin_API/Action_Reference/pre_get_posts
	 * @see https://codex.wordpress.org/Class_Reference/WP_Query
	 * @param WP_Query $query
	 */
	public function pre_get_posts( $query ) {
		$c = $query->get( 'c' );

		if ( '' === $c ) {
			return;
		}

		$slugs = explode( ',', $c );

		$tax_query = $query->get( 'tax_query' );
		$tax_query = is_array( $tax_query ) ? $tax_query : [];

		$tax_query[] = [
			'taxonomy' => 'orbis_person_category',
			'field'    => 'slug',
			'terms'    => $slugs,
		];

		$query->set( 'tax_query', $tax_query );
	}

	/**
	 * Navigation markup template.
	 *
	 * @see https://getbootstrap.com/docs/4.0/components/pagination/
	 * @see https://github.com/WordPress/WordPress/blob/4.8/wp-includes/link-template.php#L2567-L2610
	 * @see https://codex.wordpress.org/Function_Reference/the_posts_pagination
	 * @see https://codex.wordpress.org/Function_Reference/get_the_posts_pagination
	 */
	public function navigation_markup_template( $template, $class ) {
		return '<nav aria-label="%2$s">%3$s</nav>';
	}
}
