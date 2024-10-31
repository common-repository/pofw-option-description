(function ($) {
  "use strict";

  $.widget("pektsekye.pofwOptionDescription", { 

    optionGroup : {},
    	       
    optionIds : [], 
              
    rowIds : [],
    rowIdByOption : {},	
    rowIdsByOption : {},
    optionIdByRowId : {},
    valueIdByRowId : {}, 
    childrenByRowId : {},    
    
    
    _create : function () {

      $.extend(this, this.options);
                          
      this._on({                      
        "click span.pofw-ods-showhide-link": $.proxy(this.displayEditor, this),
        "change input": $.proxy(this.setChanged, this)                                                                                                                    
      });              
      
      $.widget("ui.dialog", $.ui.dialog, {//make TinyMCE text inputs editable in jQuery dialog
        _allowInteraction: function(event) {
          return !!$(event.target).closest(".mce-container,#wp-link-wrap,.media-modal").length || this._super(event);
        }
      });              
    },       
    
    
    displayEditor : function(e){
      var link = $(e.target);
      var input = link.prev('input');
      var title = input.hasClass('pofw-ods-description-input') ? this.descrTitleText : this.noteTitleText;
            
      var editorDiv = $('#pofw_ods_wysiwyg_editor');
      var textareaId = 'pofw_ods_wysiwyg_editor_textarea';      
      var textarea = $('#' + textareaId);

              
      var editor = editorDiv.data('uiDialog');
      if (!editor){             
 
        editorDiv.dialog({
            autoOpen: false,
            modal: true,
            width: 600,  
            title: title,       
            currentInput: input,
            closeText: this.closeButtonText,
            mceInstReloaded: false,
            buttons: [
              {
                text: this.submitButtonText,
                click: function() {
                  tinyMCE.get(textareaId).save();
                  
                  var input = $(this).dialog("option", "currentInput");

                  input.val(textarea.val()).change();
                
                  $(this).dialog("close");
                }
              },
              {
                text: this.cancelButtonText,
                click: function() {
                  $( this ).dialog( "close" );
                }
              }              
            ],                        
            open: function() {               
              var input = $(this).dialog("option", "currentInput");
              tinyMCE.get(textareaId).setContent(input.val());
            },
            close: function() {
              $('#'+textareaId+'-tmce').click();//reset WordPress editor from Text to the default state Visual
            }
        });    
                 
        textarea.val(input.val());
        
        editorDiv.dialog("open");
               
        tinyMCE.execCommand('mceRemoveEditor', true, textareaId);
        tinyMCE.init(tinyMCEPreInit.mceInit['pofw_ods_wysiwyg_editor_textarea']);         
                     
      } else {
        editorDiv.dialog("option", "title", title);
        editorDiv.dialog("option", "currentInput", input);
        editorDiv.dialog("open");      
      }        
                    
    },
    
    
    setChanged : function(){
      $('#pofw_ods_changed').val(1);     
    }  	        
    	
  }); 
   
})(jQuery);
