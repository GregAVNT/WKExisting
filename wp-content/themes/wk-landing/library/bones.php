<?php 
	add_action('after_setup_theme','bones_ahoy', 16); 
	function bones_ahoy() { add_action('init', 'bones_head_cleanup'); 
		add_filter('the_generator', 'bones_rss_version'); 
		add_filter( 'wp_head', 'bones_remove_wp_widget_recent_comments_style', 1 ); 
		add_action('wp_head', 'bones_remove_recent_comments_style', 1); 
		add_filter('gallery_style', 'bones_gallery_style'); 
		add_action('wp_enqueue_scripts', 'bones_scripts_and_styles', 999); 
		bones_theme_support(); 
		add_filter( 'get_search_form', 'bones_wpsearch' ); 
		add_filter('the_content', 'bones_filter_ptags_on_images'); 
		add_filter('excerpt_more', 'bones_excerpt_more'); 
		add_action( 'admin_head', 'bones_custom_editor_stylesheet' ); 
		} 
		
	function bones_head_cleanup() { 
		remove_action( 'wp_head', 'rsd_link' ); 
		remove_action( 'wp_head', 'wlwmanifest_link' ); 
		remove_action( 'wp_head', 'index_rel_link' ); 
		remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); 
		remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); 
		remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 ); 
		remove_action( 'wp_head', 'wp_generator' ); 
		add_filter( 'style_loader_src', 'bones_remove_wp_ver_css_js', 9999 ); 
		add_filter( 'script_loader_src', 'bones_remove_wp_ver_css_js', 9999 ); 
		} 
	function bones_rss_version() { return ''; } 
	function bones_remove_wp_ver_css_js( $src ) {
	 	if ( strpos( $src, 'ver=' ) ) $src = remove_query_arg( 'ver', $src ); 
	 	return $src; 
	 } 
	 function bones_remove_wp_widget_recent_comments_style() { 
	 	if ( has_filter('wp_head', 'wp_widget_recent_comments_style') ) { 
	 		remove_filter('wp_head', 'wp_widget_recent_comments_style' ); 
	 		} 
	 	} 
	 function bones_remove_recent_comments_style() {
		global $wp_widget_factory; 
		if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) { 
			remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style')); 
			} 
		} 
	function bones_gallery_style($css) { 
			return preg_replace("!<style type='text/css'>(.*?)</style>!s", '', $css); 
		} 
	function bones_scripts_and_styles() { 
			global $wp_styles; if (!is_admin()) { 
				wp_register_script( 'bones-modernizr', get_stylesheet_directory_uri() . '/library/js/libs/modernizr.custom.min.js', array(), '2.6.2', false ); 
				wp_register_style( 'bones-stylesheet', get_stylesheet_directory_uri() . '/library/css/style.css', array(), '1.0.0', 'all' ); 
				wp_register_style( 'bones-ie-only', get_stylesheet_directory_uri() . '/library/css/ie.css', array(), '1.0.0' ); 
				wp_register_style( 'font-awesome', '//netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.min.css', array(), '3.1.1' ); 
				wp_register_style( 'font-awesome-ie7', '//netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome-ie7.min.css', array(), '3.1.1' ); 
				wp_register_script( 'conditionizr', '//cdnjs.cloudflare.com/ajax/libs/conditionizr.js/2.2.0/conditionizr.min.js', array(), '2.2.0' ); 
				
				if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) wp_enqueue_script( 'comment-reply' ); 
				wp_register_script( 'bones-js', get_stylesheet_directory_uri() . '/library/js/scripts.min.js', array( 'jquery' ), '1.0.0', true ); 
				wp_dequeue_style( 'output' ); 
				wp_enqueue_script( 'bones-modernizr' ); 
				wp_enqueue_script( 'conditionizr' ); 
				wp_enqueue_style( 'bones-stylesheet' ); 
				wp_enqueue_style( 'font-awesome' ); 
				wp_enqueue_style( 'bones-ie-only' ); 
				wp_enqueue_style( 'font-awesome-ie7' ); 
				wp_enqueue_script( 'jquery' ); 
				wp_enqueue_script( 'bones-js' ); 
				$wp_styles->add_data( 'bones-ie-only', 'conditional', 'lt IE 9' ); 
				$wp_styles->add_data( 'font-awesome-ie7', 'conditional', 'lt IE 8' ); 
			} 
		} 
	function bones_theme_support() { 
		set_post_thumbnail_size(125, 125, true); 
		} 
	function bones_filter_ptags_on_images($content){ 
		return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content); 
		} 
	function bones_excerpt_more($more) { 
		global $post; 
		return '...  <a class="excerpt-read-more" href="'. get_permalink($post->ID) . '" title="'. __('Read', 'bonestheme') . get_the_title($post->ID).'">'. __('Read more &raquo;', 'bonestheme') .'</a>'; 
		} 
	function bones_get_the_author_posts_link() { 
		global $authordata; 
		if ( !is_object( $authordata ) ) return false; 
		$link = sprintf( 
			'<a href="%1$s" title="%2$s" rel="author">%3$s</a>', 
			get_author_posts_url( $authordata->ID, 
			$authordata->user_nicename ), 
			esc_attr( 
				sprintf( __( 'Posts by %s' ), 
				get_the_author() ) 
				), get_the_author() ); 
		return $link; 
		} 
	function bones_custom_editor_stylesheet(){ 
	add_editor_style('library/css/editor-style.css'); 
	} ?>