<?php
/*
Plugin Name: Youtube subscribe
Plugin URI: https://sourceextension.com
Description:Youtube subscribe button Widget
Version: 1.0.0
Author: Hiren Patel
Author URI: http://sourceextension.com
Text Domain: yts-domain
*/

/** restricting direct access to file */
if(!defined('ABSPATH')){
    exit;
}

/**include youtubesubscribe-scripts.php file to load css and js resources */
require_once(plugin_dir_path(__FILE__).'/includes/youtubesubscribe-scripts.php');

/**include youtubesubscribe-class.php file to load widget class  */
require_once(plugin_dir_path(__FILE__).'/includes/youtubesubscribe-class.php');

/**register widget class to wordpress using register_widget method */

function register_youtubesubscribe(){
    register_widget('Youtubesubscribe_Widget');
}

/**hook in function to call register function using add_action */
add_action('widgets_init','register_youtubesubscribe');