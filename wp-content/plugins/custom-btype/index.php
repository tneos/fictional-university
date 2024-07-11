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
        add_action('init', array($this, 'adminAssets'));
    }

    function adminAssets() {
        wp_register_script('newblocktype', plugin_dir_url(__FILE__) . 'build/index.js', array('wp-blocks', 'wp-element'));
        register_block_type("plugins/custom-btype", array(
            'editor_script' => 'newblocktype',
            'render_callback' => array($this, 'frontEndHTML')
        ));
    }

    function frontEndHTML($attributes) {
        ob_start(); ?>
        <h2>Today the sky is  <?php echo esc_html($attributes['skyColor'])?>  and the grass is  <?php echo esc_html($attributes['grassColor']) ?>  !!?</h2>
        <?php return ob_get_clean();
    }
 }

 $customBType = new CustomBType();