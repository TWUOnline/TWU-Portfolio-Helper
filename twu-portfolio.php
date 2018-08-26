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
 * Version:           0.2
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


// extra custom code. Can't figure yet how to roll it insisde
add_shortcode( 'artifact_count', 'twu_portfolio_count_artifcats');

function twu_portfolio_count_artifcats( $atts ) {

	extract( shortcode_atts( array( "link" => 0), $atts ) );  

	if ( $link ) {
		return '<a href="' . get_post_type_archive_link( 'twu-portfolio' ) . '">' . wp_count_posts('twu-portfolio')->publish  . ' artifacts</a>';
	} else {
		return wp_count_posts('twu-portfolio')->publish  . ' artifacts';
	}
}

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
