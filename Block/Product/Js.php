<?php
if (!defined('ABSPATH')) exit;

class Pektsekye_OptionDescription_Block_Product_Js {

  protected $_odsValue;
  protected $_odsOption;
    
  protected $_productOptions;     
  

	public function __construct(){
    include_once(Pektsekye_ODS()->getPluginPath() . 'Model/Option.php');
    $this->_odsOption = new Pektsekye_OptionDescription_Model_Option();
    	
    include_once(Pektsekye_ODS()->getPluginPath() . 'Model/Option/Value.php');
    $this->_odsValue = new Pektsekye_OptionDescription_Model_Option_Value();			 		  			
	}


  public function getProductId(){
    global $product;
    return (int) $product->get_id();              
  }
  
  
  public function getProductOptions() {  
    if (!isset($this->_productOptions)){
      $this->_productOptions = $this->_odsOption->getProductOptions($this->getProductId());
    }    
    return $this->_productOptions;              
  }
  
  
  public function getOptionsDataJson(){
             
    $odsOptions = $this->_odsOption->getOptions($this->getProductId());
    $odsValues = $this->_odsValue->getValues($this->getProductId());
    
    $optionIds = array();
    $vIdsByOId = array();
    $optionTypes = array();              
    $notes = array();
    $descriptions = array();
            
    foreach($this->getProductOptions() as $option){
    
      $oId = (int) $option['option_id'];
      
      $optionHasValues = false;
      
      foreach($option['values'] as $value){
        $vId = (int) $value['value_id'];       
        if (isset($odsValues[$vId]) && !empty($odsValues[$vId]['description'])){
          $descriptions[$vId] = $odsValues[$vId]['description'];
          $vIdsByOId[$oId][] = $vId;
          $optionHasValues = true;          
        }                  
      }
               
      if (isset($odsOptions[$oId]) && !empty($odsOptions[$oId]['note'])){
        $notes[$oId] = $odsOptions[$oId]['note'];
        $optionHasValues = true;
      } 
              
      if ($optionHasValues){
        $optionIds[] = $oId;     
        $optionTypes[$oId] = $option['type'];      
      }             
    }    
    
    return json_encode(array('optionIds' => $optionIds, 'vIdsByOId' => $vIdsByOId, 'optionTypes' => $optionTypes, 'notes' => $notes, 'descriptions' => $descriptions));              
  }
   
    
  public function toHtml(){  
    include_once(Pektsekye_ODS()->getPluginPath() . 'view/frontend/templates/product/js.php');
  }


}
