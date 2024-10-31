<?php
if (!defined('ABSPATH')) exit;

class Pektsekye_OptionDescription_Model_Option_Value {


  public function __construct() {
    global $wpdb;
    
    $this->_wpdb = $wpdb;   
    $this->_mainTable = "{$wpdb->base_prefix}pofw_optiondescription_option_value";                        
  }    


  public function getValues($productId)
  {            
    $values = array();
   
    $productId = (int) $productId;     
    $select = "SELECT ods_value_id, value_id, description FROM {$this->_mainTable} WHERE product_id={$productId}";
    $rows = $this->_wpdb->get_results($select, ARRAY_A);      
    
    foreach($rows as $r){
      $values[$r['value_id']] = array('ods_value_id' => $r['ods_value_id'], 'description' => $r['description']); 
    }
    
    return $values;                    
  }


  public function getAllValues()
  {            
    $values = array();
       
    $select = "SELECT value_id, description FROM {$this->_mainTable} WHERE description != ''";
    $rows = $this->_wpdb->get_results($select, ARRAY_A);      
    
    foreach($rows as $r){
      $values[$r['value_id']] = array('description' => $r['description']); 
    }
    
    return $values;                    
  }    


  public function saveValues($productId, $optionId, $values)
  { 
    $productId = (int) $productId;
    $optionId = (int) $optionId;
    
    foreach ($values as $r){
      $odsValueId = isset($r['ods_value_id']) ? (int) $r['ods_value_id'] : 0;    
      $valueId = (int) $r['value_id'];           
      $description = esc_sql($r['description']);            

      if ($odsValueId > 0){             
        $this->_wpdb->query("UPDATE {$this->_mainTable} SET description = '{$description}' WHERE ods_value_id = {$odsValueId}");                        
      } else {
        $this->_wpdb->query("INSERT INTO {$this->_mainTable} SET product_id = {$productId}, option_id = {$optionId}, value_id = {$valueId}, description = '{$description}'");           
      }    
    }                     
  }  
  

  public function deleteValues($productId)
  {  
    $productId = (int) $productId;
    $this->_wpdb->query("DELETE FROM {$this->_mainTable} WHERE product_id = {$productId}");  
  }      

}
