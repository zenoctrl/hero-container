<?php
/**
 * Plugin Name: Productive Addon for Elementor
 * Description: Hero Container
 * Version:     1.0.0
 * Author:      Azron Brian
 * Author URI:  https://www.linkedin.com/in/azronbrian/
 * Text Domain: hero-container
 *
 * Requires Plugins: elementor
 * Elementor tested up to: 3.20.0
 * Elementor Pro tested up to: 3.20.0
 */

function register_hero_widget( $widgets_manager ) {

	require_once( __DIR__ . '/widgets/hero.php' );

	$widgets_manager->register( new \Elementor_Hero() );

}
add_action( 'elementor/widgets/register', 'register_hero_widget' );
