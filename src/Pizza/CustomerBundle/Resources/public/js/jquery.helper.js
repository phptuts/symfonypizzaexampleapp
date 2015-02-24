

(function($){
    
    'use strict';  
    //This turn the validation and shows the message
    $.showValidationMessage = function(element, message)
    {
      var parent_div =  element.parents("div.form_valid");
      parent_div.find("span.help-block ").html(message).show();
      parent_div.find("span.form-control-feedback").show();
      parent_div.addClass("has-error");
      
      return $;
    };
    
    //This turns off the validation
    $.turnOffValidation = function(element, fake_error_class)
    {
      if(typeof fake_error_class === 'undefined')
      {
          fake_error_class = 'fake_error_container';
      }
      var parent_div =  element.parents("div.form_valid");
      parent_div.find("span.help-block ").hide();
      parent_div.find("span.form-control-feedback").hide();
      parent_div.removeClass("has-error");
      return $;
    };
    
}(jQuery));