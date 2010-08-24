jQuery.extend({

    createUploadIframe: function(id, uri)
	{
			//create frame
            var frameId = 'jUploadFrame' + id;
            
            if(window.ActiveXObject) {
                var io = document.createElement('<iframe id="' + frameId + '" name="' + frameId + '" />');
                if(typeof uri== 'boolean'){
                    io.src = 'javascript:false';
                }
                else if(typeof uri== 'string'){
                    io.src = uri;
                }
            }
            else {
                var io = document.createElement('iframe');
                io.id = frameId;
                io.name = frameId;
            }
            io.style.position = 'absolute';
            io.style.top = '-1000px';
            io.style.left = '-1000px';

            document.body.appendChild(io);

            return io			
    },
    createUploadForm: function(id, fileElementId)
	{
		//create form	
		var formId = 'jUploadForm' + id;
		var fileId = 'jUploadFile' + id;
		
		var form = jQuery('<form  action="" method="POST" name="' + formId + '" id="' + formId + '" enctype="multipart/form-data"></form>');	
		var oldElement = jQuery('#' + fileElementId);
		var newElement = jQuery(oldElement).clone();
		jQuery(oldElement).attr('id', fileId);
		jQuery(oldElement).before(newElement);
		jQuery(oldElement).appendTo(form);
		//set attributes
		jQuery(form).css('position', 'absolute');
		jQuery(form).css('top', '-1200px');
		jQuery(form).css('left', '-1200px');
		jQuery(form).appendTo('body');

		return form;
    },

    ajaxFileUpload: function(s) {
        // TODO introduce global settings, allowing the client to modify them for all requests, not only timeout		
        s			= jQuery.extend({}, jQuery.ajaxSettings, s);
        var id		= new Date().getTime()        
		var form	= jQuery.createUploadForm(id, s.fileElementId);
		var io 		= jQuery.createUploadIframe(id, s.secureuri);
		var frameId = 'jUploadFrame' + id;
		var formId	= 'jUploadForm' + id;		
        
		// Watch for a new set of requests
        if ( s.global && ! jQuery.active++ )
		{
			jQuery.event.trigger( "ajaxStart" );
		}            
        var requestDone = false;
        
		// Create the request object
        var xml = {}   
        if ( s.global )
            jQuery.event.trigger("ajaxSend", [xml, s]);
        
		// Wait for a response to come back
        var uploadCallback = function(isTimeout)
		{			
			var io = document.getElementById(frameId);
            try
			{
				if(io.contentWindow)
				{
					 xml.responseText = io.contentWindow.document.body?io.contentWindow.document.body.innerHTML:null;
                	 xml.responseXML = io.contentWindow.document.XMLDocument?io.contentWindow.document.XMLDocument:io.contentWindow.document;
					 
				}
				else if(io.contentDocument)
				{
					xml.responseText = io.contentDocument.document.body?io.contentDocument.document.body.innerHTML:null;
                	xml.responseXML = io.contentDocument.document.XMLDocument?io.contentDocument.document.XMLDocument:io.contentDocument.document;
				}						
            }
			catch(e)
			{
				jQuery.handleError(s, xml, null, e);
			}
			
            if ( xml || isTimeout == "timeout") 
			{				
                requestDone = true;
                var status;
                try
				{
                    status = isTimeout != "timeout" ? "success" : "error";
                    
					// Make sure that the request was successful or notmodified
                    if ( status != "error" )
					{
                        // process the data (runs the xml through httpData regardless of callback)
                        var data = jQuery.uploadHttpData( xml, s.dataType );    

						// If a local callback was specified, fire it and pass it the data
                        if ( s.success )
                        {
                        	s.success( data, status );
						}

                        // Fire the global callback
                        if( s.global )
                        {
                        	jQuery.event.trigger( "ajaxSuccess", [xml, s] );
						}                            
                    }
					else
					{
						jQuery.handleError(s, xml, status);
					}
                }
				catch(e) 
				{
                    status = "error";
                    jQuery.handleError(s, xml, status, e);
                }

                // The request was completed
                if( s.global )
                    jQuery.event.trigger( "ajaxComplete", [xml, s] );

                // Handle the global AJAX counter
                if ( s.global && ! --jQuery.active )
                    jQuery.event.trigger( "ajaxStop" );

                // Process result
                if ( s.complete )
                    s.complete(xml, status);

                jQuery(io).unbind()

                setTimeout(function()
									{	try 
										{
											jQuery(io).remove();
											jQuery(form).remove();	
											
										} catch(e) 
										{
											jQuery.handleError(s, xml, null, e);
										}									

									}, 100)

                xml = null

            }
        }
        // Timeout checker
        if ( s.timeout > 0 ) 
		{
            setTimeout(function(){
                // Check to see if the request is still happening
                if( !requestDone ) uploadCallback( "timeout" );
            }, s.timeout);
        }
        try 
		{
           // var io = $('#' + frameId);
			var form = jQuery('#' + formId);
			jQuery(form).attr('action', s.url);
			jQuery(form).attr('method', 'POST');
			jQuery(form).attr('target', frameId);
            if(form.encoding)
			{
                form.encoding = 'multipart/form-data';				
            }
            else
			{				
                form.enctype = 'multipart/form-data';
            }			
            jQuery(form).submit();

        } catch(e) 
		{			
            jQuery.handleError(s, xml, null, e);
        }
        if(window.attachEvent){
            document.getElementById(frameId).attachEvent('onload', uploadCallback);
        }
        else{
            document.getElementById(frameId).addEventListener('load', uploadCallback, false);
        } 		
        return {abort: function () {}};	

    },

    uploadHttpData: function( r, type ) {
        var data = !type;
        
        data	= type == "xml" || data ? r.responseXML : r.responseText;
        
		// If the type is "script", eval it in global context
        if ( type == "script" )
        {
        	jQuery.globalEval( data );
		}
            
        // Get the JavaScript object, if JSON is used.
        if ( type == "json" )
		{
			//alert(data);
            eval( "data = " + data );
        }

        // evaluate scripts within html
        if ( type == "html" )
        {
        	jQuery("<div>").html(data).evalScripts();
		}

        return data;
    }
});

joms.uploader = {
	startIndex: 0,
	postUrl: '',
	uploadText: '',
	addNewUpload: function(){
		this.startIndex	+= 1;
		
		var html	= jQuery('#photoupload').clone();
		html		= jQuery(html).attr('id', 'photoupload-' + this.startIndex  ).css('display','block');

		// Apend data into the container
		jQuery('#photoupload-container').append( html );
	
	 	// Set the input id correctly
	 	jQuery('#photoupload-' + this.startIndex + ' :file').attr('id', 'Filedata-' + this.startIndex );
	 	jQuery('#photoupload-' + this.startIndex + ' :file').attr('name', 'Filedata-' + this.startIndex );
	 	jQuery( '#photoupload-' + this.startIndex + ' :input:hidden' ).attr('value' , this.startIndex );

		// Bind remove function
	 	jQuery( '#photoupload-' + this.startIndex + ' .remove' ).bind( 'click' , function(){
	 		jQuery( this ).parent().remove();
	 	} );
		  	
	},
	startUpload: function() {
		var currentIndex	= jQuery('#photoupload').next().find('.elementIndex').val();

		// If this is called, we need to disable the upload button so that no duplicates will happen.
		jQuery( '#upload-photos-button' ).hide();	
		jQuery( '.add-new-upload' ).hide();
		jQuery('#photoupload-container input').filter(function(){return jQuery(this).parent().css('display') == 'block';}).attr('disabled',true);
		joms.uploader.upload( currentIndex );
	},
	upload: function ( elementIndex ){
		jQuery('#Filedata-' + elementIndex).attr('disabled', false );
		
		if( jQuery('#Filedata-' + elementIndex).val() == '' )
		{
			jQuery( '#photoupload-' + elementIndex ).remove();
			joms.uploader.upload();

			// Test if there is a form around if it doesn't add a new form.
			if( jQuery('#photoupload').next().length == 0 )
			{
				joms.uploader.addNewUpload();
			}
			else
			{
				jQuery('#photoupload-container input').filter(function(){return jQuery(this).parent().css('display') == 'block';}).attr('disabled',false);
			}
			jQuery( '#upload-photos-button' ).show();

			jQuery( '.add-new-upload' ).show();
			return;
		}

		// Check whether photo uploaded is set to be the default.
		var defaultPhoto	= (jQuery('#photoupload-' + elementIndex + ' :input:checked').val() == "1" ) ? '&defaultphoto=1' : '';
		
		// Get the next upload id so it can pass back to this function again
		var nextUpload		= jQuery( '#photoupload-' + elementIndex ).next().find('.elementIndex').val();
		nextUpload			= (nextUpload != '' ) ? '&nextupload=' + nextUpload : '';

		// Hide existing form and whow a loading image so the user knows it's uploading.
		jQuery('#photoupload-' + elementIndex ).children().each(function(){ 
			jQuery(this).css('display','none');
		} );
		
		jQuery('#photoupload-' + elementIndex ).append('<div id="photoupload-loading-' + elementIndex + '"><span class="loading" style="display:block;float: none;margin: 0px;"></span><span>' + joms.uploader.uploadText + '</span></div>');
		
		jQuery.ajaxFileUpload({
				url: this.postUrl + defaultPhoto + nextUpload,
				secureuri:false,
				fileElementId:'Filedata-' + elementIndex,
				dataType: 'json',
				success: function (data, status){
				
					// Hide the loading class because it was added before the upload started.
					jQuery( '#photoupload-loading-' + elementIndex ).remove();

					if(typeof(data.error) != 'undefined' && data.error == 'true' )
					{
						// Show nice red background stating error
						jQuery( '#photoupload-' + elementIndex ).css('background', '#ffeded');
	
						// There was an error during the post, show the error message the user.
						jQuery( '#photoupload-' + elementIndex).append( '<span class="error">' + data.msg + '</span>' );
					}
					else
					{
						// Upon success post to the site, we need to add some status.
						jQuery( '#photoupload-' + elementIndex ).css('background', '#edfff3');
						jQuery( '#photoupload-' + elementIndex ).append( '<span class="success">' + data.msg + '</span>');
					}

					// Fadeout existing upload form
					jQuery( '#photoupload-' + elementIndex).fadeOut( 4500 , function() {
						jQuery( '#photoupload-' + elementIndex ).remove();
		
						// Test if there is a form around if it doesn't add a new form.
						if( jQuery('#photoupload').next().length == 0 )
						{
							joms.uploader.addNewUpload();
						}
					});

					// Show the remove button
					jQuery( '#photoupload-' + elementIndex + ' .remove').css('display','block');
					
					if( data.nextupload != 'undefined' )
					{
						joms.uploader.upload( data.nextupload );
						return;
					}
					else
					{
						jQuery( '#upload-photos-button' ).show();	
						jQuery( '.add-new-upload' ).show();
					}

				},
				error: function (data, status, e){
	// 				var names = '';
	// 				
	// 				for(var name in data)
	// 					names += name + "\n";
	// 				
	// 				alert(names);
	// 				alert(e.description);
				}
			}
		)
		return false;
	}
}

