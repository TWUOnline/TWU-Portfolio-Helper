<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://cog.dog/
 * @since      1.0.0
 *
 * @package    Twu_Portfolio
 * @subpackage Twu_Portfolio/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Twu_Portfolio
 * @subpackage Twu_Portfolio/public
 * @author     Alan Levine <cogdogblog@gmail.com>
 */
class Twu_Portfolio_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Twu_Portfolio_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Twu_Portfolio_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/twu-portfolio-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Twu_Portfolio_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Twu_Portfolio_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/twu-portfolio-public.js', array( 'jquery' ), $this->version, false );

	}


	/**
	 * Register Post Type
	 */
	public function register_post_types() {
	
	
	
			register_taxonomy( 'twu-portfolio-type', 'twu-portfolio', array(
			'hierarchical'      => true,
			'labels'            => array(
				'name'                  => esc_html__( 'Artifact Types',                 'twu-portfolio' ),
				'singular_name'         => esc_html__( 'Artifact Type',                  'twu-portfolio' ),
				'menu_name'             => esc_html__( 'Artifact Types',                 'twu-portfolio' ),
				'all_items'             => esc_html__( 'All Artifact Types',             'twu-portfolio' ),
				'edit_item'             => esc_html__( 'Edit Artifact Type',             'twu-portfolio' ),
				'view_item'             => esc_html__( 'View Artifact Type',             'twu-portfolio' ),
				'update_item'           => esc_html__( 'Update Artifact Type',           'twu-portfolio' ),
				'add_new_item'          => esc_html__( 'Add New Artifact Type',          'twu-portfolio' ),
				'new_item_name'         => esc_html__( 'New Artifact Type Name',         'twu-portfolio' ),
				'parent_item'           => esc_html__( 'Parent Artifact Type',           'twu-portfolio' ),
				'parent_item_colon'     => esc_html__( 'Parent Artifact Type:',          'twu-portfolio' ),
				'search_items'          => esc_html__( 'Search Artifact Types',          'twu-portfolio' ),
				'items_list_navigation' => esc_html__( 'Artifact type list navigation',  'twu-portfolio' ),
				'items_list'            => esc_html__( 'Artifact type list',             'twu-portfolio' ),
				'back_to_items'         => esc_html__( '&larr; Back to Artifact Types' ,   'twu-portfolio' ),
			),
			'public'            => true,
			'show_ui'           => true,
			'show_in_nav_menus' => true,
			'show_in_rest'      => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'artifact-type' ),
		) );

		register_taxonomy( 'twu-portfolio-tag', 'twu-portfolio', array(
			'hierarchical'      => false,
			'labels'            => array(
				'name'                       => esc_html__( 'Artifact Tags',                   'twu-portfolio' ),
				'singular_name'              => esc_html__( 'Artifact Tag',                    'twu-portfolio' ),
				'menu_name'                  => esc_html__( 'Artifact Tags',                   'twu-portfolio' ),
				'all_items'                  => esc_html__( 'All Artifact Tags',               'twu-portfolio' ),
				'edit_item'                  => esc_html__( 'Edit Artifact Tag',               'twu-portfolio' ),
				'view_item'                  => esc_html__( 'View Artifact Tag',               'twu-portfolio' ),
				'update_item'                => esc_html__( 'Update Artifact Tag',             'twu-portfolio' ),
				'add_new_item'               => esc_html__( 'Add New Artifact Tag',            'twu-portfolio' ),
				'new_item_name'              => esc_html__( 'New Artifact Tag Name',           'twu-portfolio' ),
				'search_items'               => esc_html__( 'Search Artifact Tags',            'twu-portfolio' ),
				'popular_items'              => esc_html__( 'Popular Artifact Tags',           'twu-portfolio' ),
				'separate_items_with_commas' => esc_html__( 'Separate tags with commas',       'twu-portfolio' ),
				'add_or_remove_items'        => esc_html__( 'Add or remove tags',              'twu-portfolio' ),
				'choose_from_most_used'      => esc_html__( 'Choose from the most used tags',  'twu-portfolio' ),
				'not_found'                  => esc_html__( 'No tags found.',                  'twu-portfolio' ),
				'items_list_navigation'      => esc_html__( 'Artifact tag list navigation',    'twu-portfolio' ),
				'items_list'                 => esc_html__( 'Artifact tag list',               'twu-portfolio' ),
				'back_to_items'         	 => esc_html__( '&larr; Back to Artifact tags' ,   'twu-portfolio' ),
			),
			'public'            => true,
			'show_ui'           => true,
			'show_in_nav_menus' => true,
			'show_in_rest'      => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'artifact-tag' ),
		) );

		register_post_type( 'twu-portfolio', array(
			'description' => __( 'Portfolio Items', 'twu-portfolio' ),
			'labels' => array(
				'name'                  => esc_html__( 'Artifacts',                   'twu-portfolio' ),
				'singular_name'         => esc_html__( 'Artifact',                    'twu-portfolio' ),
				'menu_name'             => esc_html__( 'TWU Portfolio',                  'twu-portfolio' ),
				'all_items'             => esc_html__( 'All Artifacts',               'twu-portfolio' ),
				'add_new'               => esc_html__( 'Add New',                    'twu-portfolio' ),
				'add_new_item'          => esc_html__( 'Add New Artifact',            'twu-portfolio' ),
				'edit_item'             => esc_html__( 'Edit Artifact',               'twu-portfolio' ),
				'new_item'              => esc_html__( 'New Artifact',                'twu-portfolio' ),
				'view_item'             => esc_html__( 'View Artifact',               'twu-portfolio' ),
				'search_items'          => esc_html__( 'Search Artifacts',            'twu-portfolio' ),
				'not_found'             => esc_html__( 'No Artifacts found',          'twu-portfolio' ),
				'not_found_in_trash'    => esc_html__( 'No Artifacts found in Trash', 'twu-portfolio' ),
				'filter_items_list'     => esc_html__( 'Filter artifacts list',       'twu-portfolio' ),
				'items_list_navigation' => esc_html__( 'Artifact list navigation',    'twu-portfolio' ),
				'items_list'            => esc_html__( 'Artifacts list',              'twu-portfolio' ),
			),
			'supports' => array(
				'title',
				'editor',
				'thumbnail',
				'author',
				'comments',
				'publicize',
				'wpcom-markdown',
				'revisions',
				'excerpt',
			),
			'rewrite' => array(
				'slug'       => 'portfolio',
				'with_front' => false,
				'feeds'      => true,
				'pages'      => true,
			),
			'public'          => true,
			'show_ui'         => true,
			'menu_position'   => 20,                    // below Pages
			'menu_icon'       => 'dashicons-portfolio', // 3.8+ dashicon option
			'capability_type' => 'page',
			'map_meta_cap'    => true,
			'taxonomies'      => array( 'twu-portfolio-type', 'twu-portfolio-tag' ),
			'has_archive'     => true,
			'query_var'       => 'portfolio',
			'show_in_rest'    => true,
		) );


	}


	/**
	 * Update messages for the Portfolio admin.
	 */
	public function updated_messages( $messages ) {
		global $post;

		$messages['twu-portfolio'] = array(
			0  => '', // Unused. Messages start at index 1.
			1  => sprintf( __( 'Artifact updated. <a href="%s">View artifact</a>', 'twu-portfolio'), esc_url( get_permalink( $post->ID ) ) ),
			2  => esc_html__( 'Custom field updated.', 'twu-portfolio' ),
			3  => esc_html__( 'Custom field deleted.', 'twu-portfolio' ),
			4  => esc_html__( 'Artifact updated.', 'twu-portfolio' ),
			/* translators: %s: date and time of the revision */
			5  => isset( $_GET['revision'] ) ? sprintf( esc_html__( 'Artifact restored to revision from %s', 'twu-portfolio'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6  => sprintf( __( 'Artifact published. <a href="%s">View artifact</a>', 'twu-portfolio' ), esc_url( get_permalink( $post->ID ) ) ),
			7  => esc_html__( 'Artifact saved.', 'twu-portfolio' ),
			8  => sprintf( __( 'Artifact submitted. <a target="_blank" href="%s">Preview artifact</a>', 'twu-portfolio'), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post->ID ) ) ) ),
			9  => sprintf( __( 'Artifact scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview artifact</a>', 'twu-portfolio' ),
			// translators: Publish box date format, see http://php.net/date
			date_i18n( __( 'M j, Y @ G:i', 'twu-portfolio' ), strtotime( $post->post_date ) ), esc_url( get_permalink( $post->ID ) ) ),
			10 => sprintf( __( 'Artifact item draft updated. <a target="_blank" href="%s">Preview artifact</a>', 'twu-portfolio' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post->ID ) ) ) ),
		);

		return $messages;
	}
	
	// on theme activation make sure permalinks work
	public function flush_rules_on_switch() {
			flush_rewrite_rules();
	}	


	/**
	 * Change ‘Title’ column label
	 */
	public function edit_admin_columns( $columns ) {
		// change 'Title' to 'Artifact'
		$columns['title'] = __( 'Artifact', 'twu-portfolio' );

		return $columns;
	}

}
