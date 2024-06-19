<?php 



   /*
  Plugin Name: Test Plugin
  First personal plugin
  Version: 1.0
  Author: Thomas Neos
   */

   /* PHP class */
   class WordCountAndTimePlugin {
      function __construct(){
         add_action('admin_menu', array($this, 'adminPage'));
         add_action('admin_init', array($this, 'settings'));
      }

      function settings () {
         add_settings_section('wcp_first_section', null, null, 'word-count-settings-page');
         // Register location field
         add_settings_field('wcp_location', 'Display Location', array($this, 'locationHTML'), 'word-count-settings-page', 'wcp_first_section');
         register_setting('wordcountplugin', 'wcp_location', array('sanitize_callback' => array($this, 'sanitizeLocation'), 'default' => '0'));
         // Register headline text
         add_settings_field('wcp_headline', 'Headline Text', array($this, 'headlineHTML'), 'word-count-settings-page', 'wcp_first_section');
         register_setting('wordcountplugin', 'wcp_headline', array('sanitize_callback' => 'sanitize_text_field', 'default' => 'Post Statistics'));
         // Register word count checkbox
         add_settings_field('wcp_wordcount', 'Word Count', array($this, 'checkboxHTML'), 'word-count-settings-page', 'wcp_first_section', array('theName' => 'wcp_wordcount'));
         register_setting('wordcountplugin', 'wcp_wordcount', array('sanitize_callback' => 'sanitize_text_field', 'default' => '1'));
         // Register character count checkbox
         add_settings_field('wcp_charcount', 'Character Count', array($this, 'checkboxHTML'), 'word-count-settings-page', 'wcp_first_section', array('theName' => 'wcp_charcount'));
         register_setting('wordcountplugin', 'wcp_charcount', array('sanitize_callback' => 'sanitize_text_field', 'default' => '1'));
         // Register read time checkbox
         add_settings_field('wcp_readtime', 'Read Time', array($this, 'checkboxHTML'), 'word-count-settings-page', 'wcp_first_section', array('theName' => 'wcp_readtime'));
         register_setting('wordcountplugin', 'wcp_readtime', array('sanitize_callback' => 'sanitize_text_field', 'default' => '1'));
      }
      
      // If input field different than 0 or 1 display error and return previous value
      function sanitizeLocation($input) {
        if($input != '0' AND $input != '1'){
          add_settings_error('wcp_location', 'wcp_location_error', 'Display location must be either beginning or end');
          return get_option('wcp_location');
        }
        return $input;
      }

      // Callback HTML 
      function checkboxHTML($args) { ?>
         <input type="checkbox" name="<?php echo $args['theName'] ?>" value="1" <?php checked(get_option($args['theName']), '1') ?>>
      <?php }
    

      // Headline HTML
      function headlineHTML() { ?>
         <input type="text" name="wcp_headline" value="<?php echo esc_attr(get_option("wcp_headline")) ?>">
      <?php }

      // HTML for new setting
      function locationHTML() { ?>
        <select name="wcp_location">
         <option value="0" <?php selected(get_option('wcp_location'), '0') ?>>Beginning of post</option>
         <option value="1" <?php selected(get_option('wcp_location'), '1') ?>>End of post</option>
        </select>
      <?php  }

      function adminPage () {
         add_options_page('Word Count Settings', 'Word Count', 'manage_options', 'word-count-settings-page', array($this, 'ourHTML'));
       }

      function ourHTML () { ?>
        <div class="wrap">
           <h1>Word Count Settings</h1>
           <form action="options.php" method="POST">
            <?php 
              settings_fields('wordcountplugin');
              do_settings_sections('word-count-settings-page');
              submit_button();
            ?>
           </form>
        </div>
      <?php } 
   }

   $wordCountAndTimePlugin = new WordCountAndTimePlugin();

 

 
 
   

?>