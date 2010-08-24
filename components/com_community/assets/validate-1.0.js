function cValidate()
{    
	/**
	 * Attach event to all form element with 'required' class
	 */	
	this.message = ''; 
	 
	  	
	this.init = function(){	
		
			jQuery('#community-wrap form.community-form-validate :input.required').blur(			
				function(){
					if( ! jQuery(this).hasClass('validate-custom-date') )
					{
						if(cvalidate.validateElement(this))
							cvalidate.markValid(this);
						else					
							cvalidate.markInvalid(this);
					}
				}
			);
			
			jQuery('#community-wrap form.community-form-validate :input.validate-custom-date').blur(
				function(){
					if(cvalidate.validateElement(this))
						cvalidate.markValid(this);
					else					
						cvalidate.markInvalid(this);
				}
			);			
			
			
			jQuery('#community-wrap form.community-form-validate :input.validateSubmit').click(			
				function(){
					if(cvalidate.validateForm()){
						return true;
					} else {
						var message = 'Required entry missing or entry contain invalid value!';
						cWindowShow('jQuery(\'#cWindowContent\').html(\''+message+'\')' , 'Notice' , 450 , 70 , 'warning');
						jQuery("#community-wrap form.community-form-validate :input.required[value='']").each(
						
							function(i){cvalidate.markInvalid(this);}
						);
// 	 					jQuery('#'+formid+' input[type="checkbox"].required[checked=""]').each(
// 	 						function(i){cvalidate.markInvalid(this);}
// 	 					);
						
						return false;
					}
				}
			);
			
						
				
	}
	
	this.markInvalid= function(el){
	    var fieldName = el.name;
	    
        if(jQuery(el).hasClass('validate-custom-date')){
	       //since we knwo custom date come from an array. so we have to invalid all.
	       jQuery("#community-wrap form.community-form-validate input[name='"+fieldName+"']").addClass('invalid');
	       jQuery("#community-wrap form.community-form-validate select[name='"+fieldName+"']").addClass('invalid');
	    } else {
           jQuery(el).addClass('invalid');
	    }
	}
	
	this.markValid= function(el){
	    var fieldName = el.name;
	    	    
	    if(jQuery(el).hasClass('validate-custom-date')){
	       //since we knwo custom date come from an array. so we have to valid all.
	       jQuery("#community-wrap form.community-form-validate input[name='"+fieldName+"']").removeClass('invalid');
	       jQuery("#community-wrap form.community-form-validate select[name='"+fieldName+"']").removeClass('invalid');	       
	       
	    } else {	
		    jQuery(el).removeClass('invalid');
		}

	    //hide error only for those custom fields
	    if(fieldName != null){
			fieldName = fieldName.replace('[]','');
		    jQuery('#err'+fieldName+'msg').hide();	          
			jQuery('#err'+fieldName+'msg').html('&nbsp');
		}		
		
	}
	
	/**
	 *
	 */	
	this.validateElement = function(el){
	    var isValid = true;
	    var fieldName = el.name;
	    
	    if(jQuery(el).attr('type') == 'text' || jQuery(el).attr('type') == 'password' || jQuery(el).attr('type') == 'textarea'){
	    
	       if(jQuery.trim(jQuery(el).val()) == '') {	       
	          isValid = false;
	          //show error only for those custom fields
	          fieldName = fieldName.replace('[]','');	    		   
	               	           
	          lblName   = jQuery('#lbl'+fieldName).html();
	      
	          if(lblName == null){
		          lblName = 'Field';
	          } else {	              
	              lblName = lblName.replace('*','');
	          }
	          	          		      
		      this.setMessage(fieldName, lblName, 'CC INVALID VALUE');		      
	          
		   } else {
		   		   		   
		       if(jQuery(el).hasClass('validate-name')){
		           //checking the string length
		           if(jQuery(el).val().length < 3){
			           this.setMessage(fieldName, '', 'CC NAME TOO SHORT');
		               isValid = false;
		           } else {
		               jQuery('#err' + fieldName + 'msg').hide();
					   jQuery('#err' + fieldName + 'msg').html('&nbsp');
		               isValid = true;		           
		           }
		       }		   
		   
		       if(jQuery(el).hasClass('validate-username')){
		           //use ajax to check the pages.
		           if(jQuery('#usernamepass').val() != jQuery(el).val()){
		               isValid = cvalidate.ajaxValidateUserName(jQuery(el));
		           }//end if
		       }		   
		       if(jQuery(el).hasClass('validate-email')){
		   		   regex=/^[a-zA-Z0-9._-]+@([a-zA-Z0-9.-]+\.)+[a-zA-Z0-9.-]{2,4}$/;
			       isValid = regex.test(jQuery(el).val());
			       
			       if(isValid == false){
					   this.setMessage(fieldName, '', 'CC INVALID EMAIL');
			       } else {
		               jQuery('#err' + fieldName + 'msg').hide();
					   jQuery('#err' + fieldName + 'msg').html('&nbsp');
					   				   
			           //use ajax to check the pages.
			           if(jQuery('#emailpass').val() != jQuery(el).val()){
			               isValid = cvalidate.ajaxValidateEmail(jQuery(el));
			           }//end if
				   }				          
		       }
		       
		       if(jQuery(el).hasClass('validate-password') && el.name == 'jspassword'){
		           if(jQuery(el).val().length < 6){
					   this.setMessage(fieldName, '', 'CC PASSWORD TOO SHORT');
		               isValid = false;
		           } else {
		               jQuery('#err' + fieldName + 'msg').hide();
					   jQuery('#err' + fieldName + 'msg').html('&nbsp');					   
		               isValid = true;		           
		           }
		       }		       
		       
		       if(jQuery(el).hasClass('validate-passverify') && el.name == 'jspassword2'){
		           isValid = (jQuery('#jspassword').val() == jQuery(el).val());
		           
		           if(isValid == false){
					   this.setMessage('jspassword2', '', 'CC PASSWORD NOT SAME');
		           } else {
		               jQuery('#errjspassword2msg').hide();
					   jQuery('#errjspassword2msg').html('&nbsp');		           
		           }
		       }
		       
		       //now check for any custom field validation
		       if(jQuery(el).hasClass('validate-custom-date')){
		           isValid = this.checkCustomDate(el);
		       }
		       
           }//end if else
	       
	    } else if(jQuery(el).attr('type') == 'checkbox'){
	       if(jQuery(el).hasClass('validate-custom-checkbox')){
	           //var cbObj = jQuery("#community-wrap form.community-form-validate input[name='"+fieldName+"']");
	           
			   if(jQuery("#community-wrap form.community-form-validate input[name='"+fieldName+"']:checked").size() == 0)
			   {
			   		isValid = false;
			   }
			   
			   if(isValid == false){
		          fieldName = fieldName.replace('[]','');
		          lblName   = jQuery('#lbl'+fieldName).html();		      
		          if(lblName == null){
			          lblName = 'Field';
		          } else {	              
		              lblName = lblName.replace('*','');
		          }
		          		          
		          this.setMessage(fieldName, lblName, 'CC INVALID VALUE');
			   }//end if
	       	       	       	       	       	       	       
	       
	       } else {
              if(! jQuery(el).attr('checked')) isValid = false;
	       }	    	    	       	       
	       
	       
	    } else if(jQuery(el).attr('type') == 'select-one'){	       
	       if(jQuery(el).children(':selected').length == 0) isValid = false;
		   
		   
	       //now check for any custom field validation
	       if(jQuery(el).hasClass('validate-custom-date')){
	           isValid = this.checkCustomDate(el);
	       } else if(isValid == false){
		          fieldName = fieldName.replace('[]','');	    		   
		               	           
		          lblName   = jQuery('#lbl'+fieldName).html();
		      
		          if(lblName == null){
			          lblName = 'Field';
		          } else {
		              lblName = lblName.replace('*','');
		          }
                  this.setMessage(fieldName, lblName, 'CC INVALID VALUE');
	       }
		   	       	       
        } else if(jQuery(el).attr('type') == 'select-multiple') {
              if(jQuery(el).children(':selected').length == 0) isValid = false;
                            
              if(isValid == false){
		          fieldName = fieldName.replace('[]','');
		          lblName   = jQuery('#lbl'+fieldName).html();
		      
		          if(lblName == null){
			          lblName = 'Field';
		          } else {	              
		              lblName = lblName.replace('*','');
		          }
		          this.setMessage(fieldName, lblName, 'CC INVALID VALUE');
              }              
        }
        
		return isValid;   
	} 	
	
	/**
	 * Check & validate form elements
	 */	 	
	this.validateForm = function(){
	    var isValid = true;
		jQuery('#community-wrap form.community-form-validate :input.required').each(		    
			function(i){
				if(! cvalidate.validateElement(this)) isValid = false;
			}
		);
		return isValid;
	}
	 
	/**
	 * Check the username whether already exisit or not.
	 */	 
	 this.ajaxValidateUserName = function(el){		 
	     jax.call('community', 'register,ajaxCheckUserName',jQuery(el).val());	      	     	 
	 }
	 
	/**
	 * Check the email whether already exisit or not.
	 */
	 this.ajaxValidateEmail = function(el){
	     jax.call('community', 'register,ajaxCheckEmail',jQuery(el).val());	 	     	     		 
	 }
	 
	 /**
	  * check custom date
	  */
	  this.checkCustomDate = function(el){
	      var isValid = true;
	      var fieldName = el.name;
	       //now check for any custom field validation
	       if(jQuery(el).hasClass('validate-custom-date')){
	           //we know this field is an array type.
	           fieldId = fieldName.replace('[]','');
	           var dateObj = jQuery("#community-wrap form.community-form-validate input[name='"+fieldName+"']");
	           
	           for(var i=0; i < dateObj.length; i++){
	               if (!/^-?\d+$/.test(dateObj[i].value)){
					    isValid = false;
				   }//end if
	           }//end for
	           
	           //now check whether the date is valid or not.
	           var dateObj2 = jQuery("#community-wrap form.community-form-validate select[name='"+fieldName+"']");
	           
	           //dd / mm/ yyyy
	           var dd = dateObj[0].value;
	           var mm = dateObj2[0].value;
	           var yy = dateObj[1].value;		           
	           		           		           
	           var dayobj = new Date(yy, eval(mm-1), dd);
	           
	           if ((dayobj.getMonth()+1!=mm)||(dayobj.getDate()!=dd)||(dayobj.getFullYear()!=yy)){
	               isValid = false;
	           }
	           
	           if(isValid == false){
                   this.setMessage(fieldId, '', 'CC INVALID DATE');				   		           
	           } else {
                   jQuery('#err'+fieldId+'msg').hide();
		           jQuery('#err'+fieldId+'msg').html('&nbsp');		           
	           }
	       }
		   return isValid;
	  
	  }
	  
	  /*
	   * Get the message text from langauge file using ajax
	   */
	  this.setMessage = function(fieldName, txtLabel, msgStr){
	      jax.call('community', 'register,ajaxSetMessage',fieldName, txtLabel, msgStr);	      
	  }
	
}

var cvalidate = new cValidate();
