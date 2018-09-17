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
	
	
	// Set up shortcodes
	public function register_shortcodes(){
   		add_shortcode( 'artifact_count', array( &$this, 'twu_portfolio_count_artifcats' ) );
   		add_shortcode( 'artifact_types', array( &$this, 'twu_portfolio_taxonomy_list' ) );
   		add_shortcode( 'twu_portfolio', array( &$this, 'twu_portfolio_shortcode' ) );
	}

// --------------------- Artifact Shortcode ------------------------------------ 

	public function twu_portfolio_count_artifcats( $atts ) {

		extract( shortcode_atts( array( "link" => 0), $atts ) );  

		if ( $link ) {
			// hyperlink to portfolio archive
			return '<a href="' . get_post_type_archive_link( 'twu-portfolio' ) . '">' . wp_count_posts('twu-portfolio')->publish  . ' artifacts</a>';
		} else {
	
			// just the text, please
			return wp_count_posts('twu-portfolio')->publish  . ' artifacts';
		}
	}
	
// --------------------- Taxonomy Shortcode ------------------------------------ 
// Generates an index of the Artifact taxonomy of types, each linked and displaying a count
// started from this code https://wordpress.org/plugins/taxonomy-list/

	public function twu_portfolio_taxonomy_list( $atts ) {

	   extract( shortcode_atts( 
			array(
				'name' => 'twu-portfolio-type',
				'hide_empty' => false,
				'orderby' => 'id',
				'order' => 'ASC',
				'show_description' => true,
				'show_children' => true
			 ),
		$atts ) ); 
		 
		$args = array(
			'taxonomy' => $name,
			'hide_empty' => $hide_empty,
			'orderby' =>    $orderby,
			'order' => $order,
			'count' => true,
			'pad_counts' => true,
			'parent'   => 0
		);

		$term_query = new WP_Term_Query( $args );
	
		$html = '<ul class="type-list">';

		if ( !empty( $term_query->terms ) ) {
			foreach ( $term_query->terms as $term ) {
										
				$has_children = false;
				$child_html = '';
			 
				if ( $this->twu_portfolio_has_child_terms( $name, $term->term_id, $hide_empty ) == true AND  $show_children == true ) {
			
					$has_children = true;
					$child_count = 0;
					$child_html = '<ul class="type-sublist">';
			
						$child_args = array(
							'taxonomy' => $name,
							'hide_empty' => $hide_empty,
							'orderby' =>    $orderby,
							'order' => $order,
							'count' => true, 
							'parent'   => $term->term_id
						);

						$child_term_query = new WP_Term_Query( $child_args );

							foreach ( $child_term_query->terms as $child_term ) {
								
								$child_term_link = get_term_link( $child_term );
								$child_html .= '<li><a href="' . esc_url( $child_term_link ) . '">' . $child_term->name . '</a> (' . $child_term->count . ')';
								if ( $child_term->description AND $show_description ) {
									$child_html .= '<br /><span class="term-description">' .  $child_term->description . '</span>';
								}
							
								$child_count += $child_term->count;
					
								$child_html .= '</li>';
						}
			
					$child_html .= '</ul>';
				} // has child terms
  
  
				  $term_link = get_term_link( $term );
			  
				  $the_count = ( $has_children ) ? $term->count + $child_count :  $term->count;
  
				  $html .= '<li><a href="' . esc_url( $term_link ) . '">' . $term->name . '</a> (' .  $the_count . ')';
			  
				  // add description if parameter set, and there is one to show
				  if ( $term->description AND $show_description ) {
					 $html .= '<br /><span class="term-description">' . $term->description . '</span>';
				  }
		  
				$html .=  $child_html . '</li>';
			} // foreach terms
		
			$html .= '</ul>';      
		}
	
		return $html;
	}

	// a wee helper function to sort uf a term has kids
	 function twu_portfolio_has_child_terms( $taxonomy, $parent_id, $hide_empty ) {
		$has_child_terms = get_terms( array(
			'taxonomy' => $taxonomy,
			'hide_empty' => $hide_empty,
			'parent'   => $parent_id
		) );
	
		if( !empty( $has_child_terms ) )
			return true;
		else 
			return false;
	}	

	// --------------------- Portfolio Shortcode ------------------------------------ 
	// Lifted from JetPack, a portfolio display dhortcode
	public function  twu_portfolio_shortcode( $atts ) {
			$atts = shortcode_atts( array(
				'display_types'   => true,
				'display_tags'    => true,
				'display_content' => true,
				'display_author'  => false,
				'display_thumbnail' => true,
				'show_filter'     => false,
				'include_type'    => false,
				'include_tag'     => false,
				'columns'         => 2,
				'count'       	  => 3,
				'order'           => 'desc',
				'orderby'         => 'date',
			), $atts, 'twu-portfolio' );
	
		// A little sanitization
		if ( $atts['display_types'] && 'true' != $atts['display_types'] ) {
			$atts['display_types'] = false;
		}

		if ( $atts['display_tags'] && 'true' != $atts['display_tags'] ) {
			$atts['display_tags'] = false;
		}

		if ( $atts['display_author'] && 'true' != $atts['display_author'] ) {
			$atts['display_author'] = false;
		}

		if ( $atts['display_thumbnail'] && 'true' != $atts['display_thumbnail'] ) {
			$atts['display_thumbnail'] = false;
		}
	
		if ( $atts['display_content'] && 'true' != $atts['display_content'] && 'full' != $atts['display_content'] ) {
			$atts['display_content'] = false;
		}

		if ( $atts['include_type'] ) {
			$atts['include_type'] = explode( ',', str_replace( ' ', '', $atts['include_type'] ) );
		}

		if ( $atts['include_tag'] ) {
			$atts['include_tag'] = explode( ',', str_replace( ' ', '', $atts['include_tag'] ) );
		}

		$atts['columns'] = absint( $atts['columns'] );

		$atts['count'] = intval( $atts['count'] );


		if ( $atts['order'] ) {
			$atts['order'] = urldecode( $atts['order'] );
			$atts['order'] = strtoupper( $atts['order'] );
			if ( 'DESC' != $atts['order'] ) {
				$atts['order'] = 'ASC';
			}
		}

		if ( $atts['orderby'] ) {
			$atts['orderby'] = urldecode( $atts['orderby'] );
			$atts['orderby'] = strtolower( $atts['orderby'] );
			$allowed_keys = array( 'author', 'date', 'title', 'rand' );

			$parsed = array();
			foreach ( explode( ',', $atts['orderby'] ) as $portfolio_index_number => $orderby ) {
				if ( ! in_array( $orderby, $allowed_keys ) ) {
					continue;
				}
				$parsed[] = $orderby;
			}

			if ( empty( $parsed ) ) {
				unset( $atts['orderby'] );
			} else {
				$atts['orderby'] = implode( ' ', $parsed );
			}
		}
	
		// styles too
	
		wp_enqueue_style( 'twu-portfolio-style', plugins_url( 'css/portfolio-shortcode.css', __FILE__ ), array(), '20180912' );
	
		return $this->twu_portfolio_shortcode_html( $atts );
	}

	public function twu_portfolio_query( $atts ) {
			// Default query arguments
			$default = array(
				'order'          => $atts['order'],
				'orderby'        => $atts['orderby'],
				'posts_per_page' => $atts['count'],
			);

			$args = wp_parse_args( $atts, $default );
			$args['post_type'] = 'twu-portfolio'; // Force this post type

			if ( false != $atts['include_type'] || false != $atts['include_tag'] ) {
				$args['tax_query'] = array();
			}

			// If 'include_type' has been set use it on the main query
			if ( false != $atts['include_type'] ) {
				array_push( $args['tax_query'], array(
					'taxonomy' => 'twu-portfolio-type',
					'field'    => 'slug',
					'terms'    => $atts['include_type'],
				) );
			}

			// If 'include_tag' has been set use it on the main query
			if ( false != $atts['include_tag'] ) {
				array_push( $args['tax_query'], array(
					'taxonomy' => 'twu-portfolio-tag',
					'field'    => 'slug',
					'terms'    => $atts['include_tag'],
				) );
			}

			if ( false != $atts['include_type'] && false != $atts['include_tag'] ) {
				$args['tax_query']['relation'] = 'AND';
			}

			// Run the query and return
			$query = new WP_Query( $args );
			return $query;
		}
	
	
	public function get_portfolio_thumbnail_link( $post_id ) {
			if ( has_post_thumbnail( $post_id ) ) {
				/**
				 * Change the Portfolio thumbnail size.
				 *
				 * @module custom-content-types
				 *
				 * @since 3.4.0
				 *
				 * @param string|array $var Either a registered size keyword or size array.
				 */
				return '<a class="portfolio-featured-image" href="' . esc_url( get_permalink( $post_id ) ) . '">' . get_the_post_thumbnail( $post_id, 'large'  ) . '</a>';
			}
		}

	public function twu_portfolio_shortcode_html( $atts ) {

			$query =  $this->twu_portfolio_query( $atts );
			$portfolio_index_number = 0;

			ob_start();

			// If we have posts, create the html
			// with hportfolio markup
			if ( $query->have_posts() ) {


			?>
				<div class="twu-portfolio-shortcode column-<?php echo esc_attr( $atts['columns'] ); ?>">
				<?php  // open .jetpack-portfolio

				// Construct the loop...
				while ( $query->have_posts() ) {
					$query->the_post();
					$post_id = get_the_ID();
					?>
					<div class="portfolio-entry <?php echo esc_attr( $this->get_project_class( $portfolio_index_number, $atts['columns'] ) ); ?>">
						<header class="portfolio-entry-header">
						<?php
						// Featured image
						 if ( $atts['display_thumbnail'] == true ) echo $this->get_portfolio_thumbnail_link( $post_id );
						?>

						<h2 class="portfolio-entry-title"><a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo esc_attr( the_title_attribute( ) ); ?>"><?php the_title(); ?></a></h2>

							<div class="portfolio-entry-meta">
							<?php
							if ( false != $atts['display_types'] ) {
								echo $this->get_project_type( $post_id );
							}

							if ( false != $atts['display_tags'] ) {
								echo $this->get_project_tags( $post_id );
							}

							if ( false != $atts['display_author'] ) {
								echo $this->get_project_author( $post_id );
							}
							?>
							</div>

						</header>

					<?php
					// The content
					if ( false !== $atts['display_content'] ) {

						if ( 'full' === $atts['display_content'] ) {
						?>
							<div class="portfolio-entry-content"><?php the_content(); ?></div>
						<?php
						} else {
						?>
							<div class="portfolio-entry-content"><?php the_excerpt(); ?></div>
						<?php
						}
					}
					?>
					</div><!-- close .portfolio-entry -->
					<?php $portfolio_index_number++;
				} // end of while loop

				wp_reset_postdata();
				?>
				</div><!-- close .twu-portfolio -->
			<?php
			} else { ?>
				<p><em><?php _e( 'Your Portfolio Archive currently has no artifacts. You can start creating them on your dashboard.', 'twu-portfolio' ); ?></p></em>
			<?php
			}
			$html = ob_get_clean();

			// If there is a [portfolio] within a [portfolio], remove the shortcode
			if ( has_shortcode( $html, 'twu-portfolio' ) ){
				remove_shortcode( 'twu-portfolio' );
			}

			// Return the HTML block
			return $html;
		}


	 public function get_project_class( $portfolio_index_number, $columns ) {
			$project_types = wp_get_object_terms( get_the_ID(), 'twu-portfolio-type', array( 'fields' => 'slugs' ) );
			$class = array();

			$class[] = 'portfolio-entry-column-'.$columns;
			// add a type- class for each project type
			foreach ( $project_types as $project_type ) {
				$class[] = 'type-' . esc_html( $project_type );
			}
			if( $columns > 1) {
				if ( ( $portfolio_index_number % 2 ) == 0 ) {
					$class[] = 'portfolio-entry-mobile-first-item-row';
				} else {
					$class[] = 'portfolio-entry-mobile-last-item-row';
				}
			}

			// add first and last classes to first and last items in a row
			if ( ( $portfolio_index_number % $columns ) == 0 ) {
				$class[] = 'portfolio-entry-first-item-row';
			} elseif ( ( $portfolio_index_number % $columns ) == ( $columns - 1 ) ) {
				$class[] = 'portfolio-entry-last-item-row';
			}


			/**
			 * Filter the class applied to project div in the portfolio
			 *
			 * @module custom-content-types
			 *
			 * @since 3.1.0
			 *
			 * @param string $class class name of the div.
			 * @param int $portfolio_index_number iterator count the number of columns up starting from 0.
			 * @param int $columns number of columns to display the content in.
			 *
			 */
			return apply_filters( 'portfolio-project-post-class', implode( " ", $class ) , $portfolio_index_number, $columns );
		}


	public function get_project_type( $post_id ) {
			$project_types = get_the_terms( $post_id, 'twu-portfolio-type' );

			// If no types, return empty string
			if ( empty( $project_types ) || is_wp_error( $project_types ) ) {
				return;
			}

			$html = '<div class="project-types"><span>' . __( 'Types', 'twu-portfolio' ) . ':</span>';
			$types = array();
			// Loop thorugh all the types
			foreach ( $project_types as $project_type ) {
				$project_type_link = get_term_link( $project_type, 'twu-portfolio-type' );

				if ( is_wp_error( $project_type_link ) ) {
					return $project_type_link;
				}

				$types[] = '<a href="' . esc_url( $project_type_link ) . '" rel="tag">' . esc_html( $project_type->name ) . '</a>';
			}
			$html .= ' '.implode( ', ', $types );
			$html .= '</div>';

			return $html;
		}

	/**
	 * Displays the project tags that a project belongs to.
	 *
	 * @return html
	 */
	 public function get_project_tags( $post_id ) {
		$project_tags = get_the_terms( $post_id, 'twu-portfolio-tag' );

		// If no tags, return empty string
		if ( empty( $project_tags ) || is_wp_error( $project_tags ) ) {
			return false;
		}

		$html = '<div class="project-tags"><span>' . __( 'Tags', 'twu-portfolio' ) . ':</span>';
		$tags = array();
		// Loop thorugh all the tags
		foreach ( $project_tags as $project_tag ) {
			$project_tag_link = get_term_link( $project_tag, 'twu-portfolio-type' );

			if ( is_wp_error( $project_tag_link ) ) {
				return $project_tag_link;
			}

			$tags[] = '<a href="' . esc_url( $project_tag_link ) . '" rel="tag">' . esc_html( $project_tag->name ) . '</a>';
		}
		$html .= ' '. implode( ', ', $tags );
		$html .= '</div>';

		return $html;
	}	
	

}
