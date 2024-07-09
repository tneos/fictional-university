<?php 
 /*
 Plugin Name: Custom Block Type
 Description: Multiple choice question.
 Version: 1.0
 Author: Thomas Neos
 */

 if(! defined('ABSPATH')) exit; // Exit if accessed directly

 class CustomBType {
    function __construct()
    {
        add_action('enqueue_block_editor_assets', array($this, 'adminAssets'));
    }

    function adminAssets() {
        wp_enqueue_script('newblocktype', plugin_dir_url(__FILE__) . 'build/index.js', array('wp-blocks', 'wp-element'));
    }
 }

 $customBType = new CustomBType();