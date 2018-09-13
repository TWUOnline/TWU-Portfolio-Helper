<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://cog.dog/
 * @since             1.0.0
 * @package           Twu_Portfolio
 *
 * @wordpress-plugin
 * Plugin Name:       TWU Portfolio Helper
 * Plugin URI:        https://github.com/TWUOnline/twu-portfolio-helper
 * Description:       This provides additional functionality, content types for the learning portfolios at TWU
 * Version:           0.4
 * Author:            Alan Levine
 * Author URI:        https://cog.dog/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       twu-portfolio
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLUGIN_NAME_VERSION', '0.1' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-twu-portfolio-activator.php
 */
function activate_twu_portfolio() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-twu-portfolio-activator.php';
	Twu_Portfolio_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-twu-portfolio-deactivator.php
 */
function deactivate_twu_portfolio() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-twu-portfolio-deactivator.php';
	Twu_Portfolio_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_twu_portfolio' );
register_deactivation_hook( __FILE__, 'deactivate_twu_portfolio' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-twu-portfolio.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_twu_portfolio() {

	$plugin = new Twu_Portfolio();
	$plugin->run();

}
run_twu_portfolio();

// alan tacks on extra custom code. Can't figure yet how to roll it inside this class thing



// --------------------- Artifact Shortcode ------------------------------------ 
add_shortcode( 'artifact_count', 'twu_portfolio_count_artifcats');

function twu_portfolio_count_artifcats( $atts ) {

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

add_shortcode( 'artifact_types', 'twu_portfolio_taxonomy_list' );

function twu_portfolio_taxonomy_list( $atts ) {

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
             
            if ( twu_portfolio_has_child_terms( $name, $term->term_id, $hide_empty ) == true AND  $show_children == true ) {
            
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

add_shortcode( 'twu-portfolio', 'twu_portfolio_shortcode' );

function  twu_portfolio_shortcode( $atts ) {
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
	
	return twu_portfolio_shortcode_html( $atts );
}

function twu_portfolio_query( $atts ) {
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
	
	
function get_portfolio_thumbnail_link( $post_id ) {
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

function twu_portfolio_shortcode_html( $atts ) {

		$query =  twu_portfolio_query( $atts );
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
				<div class="portfolio-entry <?php echo esc_attr( get_project_class( $portfolio_index_number, $atts['columns'] ) ); ?>">
					<header class="portfolio-entry-header">
					<?php
					// Featured image
					 if ( $atts['display_thumbnail'] == true ) echo get_portfolio_thumbnail_link( $post_id );
					?>

					<h2 class="portfolio-entry-title"><a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo esc_attr( the_title_attribute( ) ); ?>"><?php the_title(); ?></a></h2>

						<div class="portfolio-entry-meta">
						<?php
						if ( false != $atts['display_types'] ) {
							echo get_project_type( $post_id );
						}

						if ( false != $atts['display_tags'] ) {
							echo get_project_tags( $post_id );
						}

						if ( false != $atts['display_author'] ) {
							echo get_project_author( $post_id );
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


 function get_project_class( $portfolio_index_number, $columns ) {
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


function get_project_type( $post_id ) {
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
 function get_project_tags( $post_id ) {
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


