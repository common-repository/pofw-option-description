<?php
if (!defined('ABSPATH')) exit;

class Pektsekye_OptionDescription_Controller_Product {


	public function __construct() {
    add_action('wp_enqueue_scripts', array($this, 'enqueue_frontend_scripts')); 	
    add_action('woocommerce_before_add_to_cart_button', array($this, 'display_options_on_product_page'), 12);	//after product options							  				
	}


  public function enqueue_frontend_scripts(){
    wp_enqueue_script('pofw_ods_product_view', Pektsekye_ODS()->getPluginUrl() . 'view/frontend/web/main.js', array('jquery', 'jquery-ui-widget', 'jquery-ui-tooltip'));
    wp_enqueue_style('pofw_ods_product_view', Pektsekye_ODS()->getPluginUrl() . 'view/frontend/web/main.css', array('dashicons'));
    wp_enqueue_style('pofw_ods_product_view_tooltip', Pektsekye_ODS()->getPluginUrl() . 'view/frontend/web/ui-tooltip.css');      		  		  			
  }
  
  
	public function display_options_on_product_page() { 
    include_once(Pektsekye_ODS()->getPluginPath() . 'Block/Product/Js.php');
    $block = new Pektsekye_OptionDescription_Block_Product_Js();
    $block->toHtml();
  }
  

}
