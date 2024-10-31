<?php
if (!defined('ABSPATH')) exit;
?>
<div class="pofw-ods-container">
<?php if (!$this->getProductOptionsPluginEnabled()): ?>
  <div class="pofw_optiondescription-create-ms"><?php echo __('Please, install and enable the <a href="https://wordpress.org/plugins/pofw-option-description/" target="_blank">Product Options</a> plugin.', 'pofw-option-description'); ?></div>
<?php else: ?>
  <div id="pofw_ods_options">
    <?php foreach ($this->getOptions() as $optionId => $option): ?>
      <div>
        <div class="pofw-ods-option-title">
          <span class="pofw-title"><?php echo htmlspecialchars($option['title']); ?></span>         
          <input type="hidden" name="pofw_ods_options[<?php echo $optionId; ?>][ods_option_id]" value="<?php echo $option['ods_option_id']; ?>"/>                    
        </div>  
        <div class="pofw-ods-option-note">
          <input type="text" name="pofw_ods_options[<?php echo $optionId; ?>][note]" value="<?php echo htmlspecialchars($option['note']); ?>" autocomplete="off"/>   
          <span title="<?php echo __('WYSIWYG Editor', 'pofw-option-description') ?>" class="pofw-ods-showhide-link">e</span>                           
        </div>        
        <div class="pofw-ods-values">
          <?php foreach ($option['values'] as $valueId => $value): ?>
            <div class="pofw-ods-value">
              <div class="pofw-ods-value-title">
                <span><?php echo htmlspecialchars($value['title']); ?></span>
              </div>
              <div class="pofw-ods-value-description">
                <input id="pofw_ods_value_<?php echo $valueId; ?>_description" name="pofw_ods_options[<?php echo $optionId; ?>][values][<?php echo $valueId; ?>][description]" type="text" value="<?php echo htmlspecialchars($value['description']); ?>" class="pofw-ods-description-input" autocomplete="off">
                <span title="<?php echo __('WYSIWYG Editor', 'pofw-option-description') ?>" class="pofw-ods-showhide-link">e</span>                     
                <input type="hidden" name="pofw_ods_options[<?php echo $optionId; ?>][values][<?php echo $valueId; ?>][ods_value_id]" value="<?php echo $value['ods_value_id']; ?>"/>                            
              </div>                        
            </div>          
          <?php endforeach; ?>        
        </div>                  
      </div>    
    <?php endforeach; ?>           
    <div id="pofw_ods_wysiwyg_editor" class="pofw-ods-editor">
     <?php 
          wp_editor('', 'pofw_ods_wysiwyg_editor_textarea', array(
            'media_buttons' => true,
            'teeny' => false,
            'textarea_rows' => '3',
            'tinymce' => array('plugins' => 'charmap,colorpicker,hr,lists,media,paste,tabfocus,textcolor,wordpress,wpautoresize,wpeditimage,wpemoji,wpgallery,wplink,wpdialogs,wptextpattern,wpview' )
          )); 
     ?>
    </div>    
    <input type="hidden" id="pofw_ods_changed" name="pofw_ods_changed" value="0">        
  </div> 
   <script type="text/javascript">
      var config = {
        noteTitleText    : "<?php echo __('Option Note', 'pofw-option-description'); ?>",  
        descrTitleText   : "<?php echo __('Option Value Description', 'pofw-option-description'); ?>",
        closeButtonText  : "<?php echo __('Close', 'pofw-option-description') ?>",
        submitButtonText : "<?php echo __('Submit', 'pofw-option-description') ?>",
        cancelButtonText : "<?php echo __('Cancel', 'pofw-option-description') ?>"      
      };
  
      jQuery('#pofw_ods_options').pofwOptionDescription(config);   
        
  </script>                 
<?php endif; ?>     
</div>

    