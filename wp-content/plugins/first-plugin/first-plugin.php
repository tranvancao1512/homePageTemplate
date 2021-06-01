<?php
/*
Plugin Name: First Plugin
Plugin URI: https://google.com
Description: Day la plugin cua hungnd.
Version :1.0
Author : Hungnd
Author URI : https://google.com
License : GPLv2
 */
 ?>
<?php
//    Viet shortcode hello
if(!class_exists('First_Plugin')){
 class First_Plugin{
  function __construct()
  {
   if(!function_exists('add_shortcode')){
    return;
   }
   add_shortcode('hello',array(&$this,'hello_func'));
  }
  function hello_func($atts =array(),$content = null){
   extract(shortcode_atts(array('name'=>'Word'),$atts));
   return '<div><p>Hello'.$name.'!!!</p></div>';
  }
 }
}
function fl_load(){
 global  $fl;
 $fl = new First_Plugin();
}
add_action('plugin_loaded','fl_load');

//    Cach chen CSS va JS
//function enqueue_scripts_and_styles()
//{
// wp_register_style( 'hocwp-foundation', get_theme_uri() . '/lib/foundation.css', array(), get_theme_version() );
// wp_enqueue_style( 'hocwp-foundation' );
// wp_register_style( 'hocwp', get_style_uri(), array(), get_theme_version() );
// wp_enqueue_style( 'hocwp' );
// wp_enqueue_script('jquery');
// wp_register_script('my-plugin-script', plugins_url( '/js/script.js', __FILE__ ));
// wp_enqueue_script( 'my-plugin-script' );
//}
//add_action( 'wp_enqueue_scripts', 'enqueue_scripts_and_styles');
//
//
