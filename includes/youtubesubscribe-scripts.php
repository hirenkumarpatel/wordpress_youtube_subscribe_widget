<?php
/**loading css and js scripts */
function yts_load_resources(){

    /** loading style.css file */
    wp_enqueue_style('yts-style',plugins_url().'/youtubesubscribe/includes/css/style.css');

    /**loading main.js script file */
    wp_enqueue_script('yts-script',plugins_url().'/youtubesubscribe/includes/js/main.js');

    /**js file to load youtube subscribe button in the widget */
    wp_enqueue_script('google-api','https://apis.google.com/js/platform.js');
}
add_action('wp_enqueue_scripts','yts_load_resources');