( function ($) {
  "use strict";
  
  $.widget("pektsekye.pofwOptionDescription", {
    _create: function(){   		    

      $.extend(this, this.options);
                
      this.addNotesAndDescriptions();

      this._on({
        "change select.pofw-option" : $.proxy(this.onSelectChange, this)
      });  
      
      $('.pofw-ods-tooltip').tooltip({
        tooltipClass: "pofw-ods-tooltip-popup",
        items: "span",
        show: null, // show immediately        
        content: function() {
          return $(this).find('.pofw-ods-tooltip-descr').html();
        },
        open: function(event, ui){
          if (event.originalEvent == 'undefined'){
            return false;
          }
          var $id = $(ui.tooltip).attr('id');    
          $('div.ui-tooltip').not('#' + $id).remove();// close any lingering tooltips
        },
        close: function(event, ui){
          ui.tooltip.hover(
            function(){
              $(this).stop(true).fadeTo(400, 1); 
            },
            function(){
              $(this).fadeOut('400', function(){$(this).remove()});
            }
          );
        }        
      }); 
     
      this.element[0].onclick = function(){}; // to make checkbox label tag work on iPhone                         
    },
    
    
    onSelectChange : function(e){
      var select = $(e.target);
      if (select[0].type == 'select-multiple'){
        return;
      }
      var oId = select[0].id.replace('pofw_option_', '');
      var vId = select.val();
      var descr = vId && this.descriptions[vId] ? this.descriptions[vId] : '';
      $('#pofw_ods_description_'+oId).html(descr);
    },    
    
    
    addNotesAndDescriptions : function(){
      var ii,ll, oId, vId, div, type, html;
      var l = this.optionIds.length;
      for (var i=0;i<l;i++){ 
        oId = this.optionIds[i];
        
        div = this.element.find('[name^="pofw_option['+oId+']"]').first().closest('div.field');
 
        type = this.optionTypes[oId];
        
        if (type == 'radio' || type == 'checkbox'){ 
          ll = this.vIdsByOId[oId].length;
          for (ii=0;ii<ll;ii++){        
            vId = this.vIdsByOId[oId][ii];
            html = '<span class="pofw-ods-tooltip"><span class="pofw-ods-tooltip-descr">' + this.descriptions[vId] + '</span></span>';           
            $('#pofw_option_value_' + vId).closest('div.choice').find('label').append(html);
          }        

        } else if (type == 'drop_down') {
          html = '<div id="pofw_ods_description_' + oId + '" class="pofw-ods-descr"></div>';
          $('#pofw_option_' + oId).after(html);
        }
        
        if (this.notes[oId]){
          div.append('<div class="pofw-ods-note">' + this.notes[oId] + '</div>'); 
        } 

      }
   
    }      
    
  });

})(jQuery);
    


