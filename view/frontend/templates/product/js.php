<?php
if (!defined('ABSPATH')) exit;
?>
<?php if (count($this->getProductOptions()) > 0): ?>   
<script type="text/javascript"> 
    var config = {};
    
    var pofwOdsData = <?php echo $this->getOptionsDataJson(); ?>;
    
    jQuery.extend(config, pofwOdsData);
      
    jQuery("#pofw_product_options").pofwOptionDescription(config);
    
</script>        
<?php endif; ?>
