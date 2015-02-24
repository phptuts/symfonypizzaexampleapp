(function($){
    
    'use strict';  
    
    $.symfonyajaxvalidation = function(element, options) 
    {
        var plugin = this;


        //This is the form element
        var $element = $(element), // reference to the jQuery version of DOM element
            element = element;    // reference to the actual DOM element

        var defaults =  
        {
            submit_button_id: '',//The id of the button
            ajax_url : '',//The url to go for validation
            error_message : '',//The error message that is alerted if something goes wrong
            successCallback : function(){},//This is the function that executes if the form is valid
            validationFailsCallback: function(){},//This is called when the validation fails
            fake_error: 'fake_error', //This is for when you don't have form field
            fake_alert_close_button_class: 'close' //This is the button class hides collection / total form alerts
        };
        
        plugin.settings = {};
        plugin.submitbutton = null;
        
        /**
         * This function is used to submit the form for ajax validation
         */
        plugin.ajaxValidateForm = function()
        {
            $element.ajaxSubmit({
                beforeSubmit: function(arr, $form, options) 
                { 
                    //We loop through all the form elements and turn off the errors.
                    $element.find('input, textarea, select').each(function()
                    {
                        $.turnOffValidation($(this));
                    });
                    //Fake error are ones that are attached to the whole form or to a whole collection.
                    $element.find('.' + plugin.settings.fake_error).hide();
                },
                url: plugin.settings.ajax_url,
                success: function(data)
                {
                    //We call the success function 
                    if(data.success === true && data.hasError === false)
                    {
                        plugin.settings.successCallback();
                    }
                    //We display errors
                    else if(data.success === true && data.hasError === true)
                    {
                         displayErrors(data.errors);
                         plugin.settings.validationFailsCallback();
                    }
                    //Something went wrong
                    else
                    {
                        plugin.error();
                    }
                },
                error: function(e)
                {
                    plugin.error();
                }
                
            });
        };
        
        /**
         * This function loops through and displays the errors
         * @param array errors and array of error messsages in index by the id of the element
         */
        var displayErrors = function(errors)
        {
              for(var id in errors)
              {
                    $element.find("#" + id).parents('.form_valid').addClass('has-error');
                    $element.find("#" + id).parents('.form_valid').find('span.help-block').html(errors[id][0]);
                    $element.find("#" + id).parents('.form_valid').find('span.hide_error').show();
                    $element.find("#" + id).parents('.form_valid').show();
              }
        };
        
        /**
         * This function alert a message if something fails
         */
        plugin.error = function()
        {
            alert(plugin.settings.error_message);
        };
        
        plugin.init = function()
        {
            plugin.settings = $.extend({}, defaults, options);
            if(
                       plugin.settings.submit_button_id === "" 
                    || plugin.settings.ajax_url === "" 
                    || plugin.settings.form_id === ""
                    || plugin.settings.error_message === ""
                    || plugin.settings.successCallback === ""
                    || plugin.settings.validationFailsCallback === ""
                    || plugin.settings.fake_error === ""
                    || plugin.settings.fake_alert_close_button_class === ""
            )
            {
                throw "Please enter all of the setting for this plugin.";
            }
            
            plugin.submitbutton = $("#" + plugin.settings.submit_button_id);
            
            /**
             * Event for submitting the form
             */
            $(document).on("click", "#" + plugin.settings.submit_button_id, function(){
                plugin.ajaxValidateForm();
            });
            
            
            /**
             * Event that turns off validation
             */
            $(document).on("focusout", "form#" + $element.attr('id') + " input, form#" + $element.attr('id') + " select, form#" + $element.attr('id') + " textarea", function(){
               if($(this).val() !== "")
               {
                  $.turnOffValidation($(this));           
               } 
            });
            
            
            
            /**
             * Event that turns off validation for file inputs
             */
            $(document).on("change", "form#" + $element.attr('id') + " input[type=file]", function(){
               if($(this).val() !== "")
               {
                  $.turnOffValidation($(this));           
               } 
            });
            
            /**
             * Turns of the alert when the click on the button
             */
            $(document).on("click", "." + plugin.settings.fake_error + " ." +  plugin.settings.fake_alert_close_button_class, function(){
                $(this).parents('.' + plugin.settings.fake_error).hide();
            });

        };



        plugin.init();

    };
    
    
    $.fn.symfonyajaxvalidation = function(options)
    {
        // iterate through the DOM elements we are attaching the plugin to
        return this.each(function()
        {
           
            // if plugin has not already been attached to the element
            if (undefined === $(this).data('symfonyajaxvalidation')) 
            {
                                
                // create a new instance of the plugin
                // pass the DOM element and the user-provided options as arguments
                var plugin = new $.symfonyajaxvalidation(this, options);

                // in the jQuery version of the element
                // store a reference to the plugin object
                // you can later access the plugin and its methods and properties like
                // element.data('pluginName').publicMethod(arg1, arg2, ... argn) or
                // element.data('pluginName').settings.propertyName
                $(this).data('symfonyajaxvalidation', plugin);

            }
        });
        

    };
    
}(jQuery));