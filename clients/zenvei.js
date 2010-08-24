function shipping(){
	
	var qtr = parseInt($('#qtr').val());
	var qtb = parseInt($('#qtb').val());
	var qtg = parseInt($('#qtg').val());
	var qts = parseInt($('#qts').val());
	
	var w_o_blue = qtr+qtg+qts;
	
	if(qtb==0){
		
		if(w_o_blue<=6){
			
			$('#shipping').val(8);
		}else{
			
			$('#shipping').val(16);
		}
	}else{
		
		if(qtb<3){
			
			if(w_o_blue>6){
				
				$('#shipping').val(28);	
				
			}else if((w_o_blue>0)){
				
				$('#shipping').val(20);	
				
			}else{
				
				$('#shipping').val(12);	
			}
		}else{
			
			if(w_o_blue>6){
				
				$('#shipping').val(40);	
				
			}else if((w_o_blue>0)){
				
				$('#shipping').val(32);	
				
			}else{
				
				$('#shipping').val(24);	
			}
		}
	}
	
}
function shipping2(){
	
	var qtr = parseInt($('#qtr').val());
	var qtb = parseInt($('#qtb').val());
	var qtg = parseInt($('#qtg').val());
	var qts = parseInt($('#qts').val());
	
	var w_o_blue = qtr+qtg+qts;
	
	if(qtb==0){
		
		if(w_o_blue<=6){
			
			$('#shipping').val(8);
		}else{
			
			$('#shipping').val(16);
		}
	}else{
		
		if(qtb<3){
			
			if(w_o_blue>6){
				
				$('#shipping').val(28);	
				
			}else if((w_o_blue>0)){
				
				$('#shipping').val(20);	
				
			}else{
				
				$('#shipping').val(12);	
			}
		}else{
			
			if(w_o_blue>6){
				
				$('#shipping').val(40);	
				
			}else if((w_o_blue>0)){
				
				$('#shipping').val(32);	
				
			}else{
				
				$('#shipping').val(24);	
			}
		}
	}
	
}

	function update(){
	
	var reg_fee = parseFloat($('#reg_fee').val());
	
	var red_total = parseInt($('#red_total').val());
	var blue_total = parseInt($('#blue_total').val());
	var green_total = parseInt($('#green_total').val());
	var silver_total = parseInt($('#silver_total').val());
	
	var red_total2 = parseInt($('#red_total2').val());
	var blue_total2 = parseInt($('#blue_total2').val());
	var green_total2 = parseInt($('#green_total2').val());
	var silver_total2 = parseInt($('#silver_total2').val());
	
	var prod_total = red_total+blue_total+green_total+silver_total;
	var prod_total2 = red_total2+blue_total2+green_total2+silver_total2;
	
	var shipping = parseInt($('#shipping').val());
	var shipping2 = parseInt($('#shipping2').val());
	
	var tax_amount = (prod_total/100)*6.5;
	var tax_amount2 = (prod_total2/100)*6.5;
	
    var all_total = reg_fee+prod_total+tax_amount+shipping;
	
	var auto_ship = prod_total2+tax_amount2+shipping2;
	
	$('#prod_total').val(prod_total);
	$('#products_total').html(prod_total);
	
	$('#shipping_amount').html(shipping);
	
	$('#taxx').val(tax_amount.toFixed(2));
	//$('#tax_amount').html(tax_amount.toFixed(2));
	
	$('#total_amount').html(all_total.toFixed(2));
	$('#totals').val(all_total.toFixed(2));
	
	$('#autoship_amount').html(auto_ship.toFixed(2));
	$('#auto_ships').val(auto_ship.toFixed(2));
}		
	$(function(){
		   $('.dates').datepicker();
		   $('#dates').datepicker('option', {dateFormat: "dd-mm-yy",  
								  			 changeMonth: true, 
											 changeYear: true,
											 yearRange: '1920:2030'
											 });
		   
		   var lefti = ($(window).width()/2)+300;
		   $('#package').css({ 'left':  lefti+'px' });
		   
		   $('#as_buss').click(function(){
				
				if($(this).val()==1){
					
					$(this).val(0);
					$('.ssn_text').html('Tax ID');
					$('#buss_name_field').show();
					//$(this).attr('checked', 'checked');
				}else{
					
					$(this).val(1);
					$('.ssn_text').html('SSN/SIN');
					$('#buss_name_field').hide();
					//$(this).attr('checked', 'checked');
				}
			});
		   
		   
// Same as shipping Address 		   
		   $('#same_as_ship').click(function(){
				
				if($(this).val()==1){
					
					$(this).val(0);
					var ind = $('#state_ship').attr('selectedIndex');
					$('#add1_bill').val($('#add1_ship').val());
					$('#add2_bill').val($('#add2_ship').val());
					$('#city_bill').val($('#city_ship').val());
					$('#state_bill').attr('selectedIndex', ind);
					$('#zip_bill').val($('#zip_ship').val());
					$('#country_bill').val($('#country_ship').val());
					
					
				}else{
					
					$(this).val(1);
					
					
					$('#add1_bill').val('');
					$('#add2_bill').val('');
					$('#city_bill').val('');
					$('#zip_bill').val('');
					$('#state_bill').attr('selectedIndex', 0);
					$('#country_bill').val('');
				}
			});

	/*$("#form").validate({
							
	    invalidHandler: function(form, validator) 
		{
				var error = 1;
				
				$('label.error').html('');
				if($('#ship_method').val() == '')
				{
					error = 0;
					$('#flip-navigation li #tab-0').addClass('error_tab');
					$('#flip-navigation li #tab-0').fadeOut(500).fadeIn(500).fadeOut(500).fadeIn(500).fadeOut(500).fadeIn(500);
				}
				else
				{
					error = 1;
				}
				if($('#ship_method2').val() == '')
				{
					error = 0;
					$('#flip-navigation li #tab-1').addClass('error_tab');
					$('#flip-navigation li #tab-1').fadeOut(500).fadeIn(500).fadeOut(500).fadeIn(500).fadeOut(500).fadeIn(500);
				}
				else
				{
					error = 1;
				}
				
				if(error == 1 || error == 0)
				{
					$('#flip-navigation li #tab-2').addClass('error_tab');
					$('#flip-navigation li #tab-2').fadeOut(500).fadeIn(500).fadeOut(500).fadeIn(500).fadeOut(500).fadeIn(500);
				}
					
					$('#error_on_tab').html('Check all tabs in red for missing information.');
			
		},
		rules: {
				  ship_method: "required",
				  //username: "required",
				  password: "required",
				  vpassword: {
						  required: true,
						  equalTo: "#password"
				  },
				  username: "required",
				  replicated_siteid: "required",
				  fname: "required",
				  lname: "required",
				  b_day2: "required",
				  //buss_name: "required",
				  email: {
						  required: true,
						  email: true
				  },
				  c_email: {
						  required: true,
						  equalTo: "#email"
				  },
				  ssn: "required",
				  c_ssn: {
						  required: true,
						  equalTo: "#ssn"
				  },
				  
				  ship_method: "required",
				  ship_method2: "required",
				  add1_ship: "required",
				  city_ship: "required",
				  country_ship: "required",
				  
				  card_type: "required",
				  name_card: "required",
				  card_no: "required",
				  expire_date: "required",
				  
				  csv: "required",
				  terms_policy: "required",
				  terms_condition: "required"
				  

		},// rules end
		
		messages: {
				//  name: "Please Enter Name",

		}// messages end
	});// validate*/
	
	
	
    
	 
	

function update(){
	
	var reg_fee = parseFloat($('#reg_fee').val());
	
	var red_total = parseInt($('#red_total').val());
	var blue_total = parseInt($('#blue_total').val());
	var green_total = parseInt($('#green_total').val());
	var silver_total = parseInt($('#silver_total').val());
	
	var red_total2 = parseInt($('#red_total2').val());
	var blue_total2 = parseInt($('#blue_total2').val());
	var green_total2 = parseInt($('#green_total2').val());
	var silver_total2 = parseInt($('#silver_total2').val());
	
	var prod_total = red_total+blue_total+green_total+silver_total;
	var prod_total2 = red_total2+blue_total2+green_total2+silver_total2;
	
	var shipping = parseInt($('#shipping').val());
	var shipping2 = parseInt($('#shipping2').val());
	
	var tax_amount = (prod_total/100)*6.5;
	var tax_amount2 = (prod_total2/100)*6.5;
	
    var all_total = reg_fee+prod_total+tax_amount+shipping;
	
	var auto_ship = prod_total2+tax_amount2+shipping2;
	
	$('#prod_total').val(prod_total);
	$('#products_total').html(prod_total);
	
	$('#shipping_amount').html(shipping);
	
	$('#taxx').val(tax_amount.toFixed(2));
	//$('#tax_amount').html(tax_amount.toFixed(2));
	
	$('#total_amount').html(all_total.toFixed(2));
	$('#totals').val(all_total.toFixed(2));
	
	$('#autoship_amount').html(auto_ship.toFixed(2));
	$('#auto_ships').val(auto_ship.toFixed(2));
}

}); // jQuery




//OTHER OTHER
	
	pic1 = new Image(15, 15); 
	pic1.src = "../loader.gif";

	/*$(document).ready(function()
	{
		$("#username").blur(function() 
		{ 
			var usr = $("#username").val();

			if(usr.length >= 3)
			{
				$("#status").html('<img src="../loader.gif" align="absmiddle">&nbsp;Checking availability...');

    			$.ajax({  
   			    type: "POST",  
    			url: "../check.php",  
   				data: "username="+ usr,  
   			    success: function(msg){  
   
   				$("#status").ajaxComplete(function(event, request, settings){ 
				if(msg == 'OK')
				{
					alert(msg);
        			$("#username").removeClass('object_error'); // if necessary
					$("#username").addClass("object_ok");
					$(this).html('&nbsp;<img src="../accepted.png" align="absmiddle"> <font color="Green"> Congratulations your username is available </font>  ');
					
				}  
				else  
				{
					alert(msg);
					$("#username").removeClass('object_ok'); // if necessary
					$("#username").addClass("object_error");
					$(this).html(msg);
					//jQuery("#username").val('');
					var fst = document.getElementById('username');
					fst.focus();
					$("#username").val('');
					//document.getElementById('username').value='';
					return false;

				} });

	 			} }); 

			}
			else
			{
				$("#status").html('<font color="red">The username should have atleast <strong>3</strong> characters.</font>');
				$("#username").removeClass('object_ok'); // if necessary
				$("#username").addClass("object_error");
			}

		});

		});
		
		
		$(document).ready(function()
		{
		$("#replicated_siteid").change(function() 
		{ 
			var usr = $("#replicated_siteid").val();

			if(usr.length >= 3)
			{
				$("#replicated_status").html('<img src="../loader.gif" align="absmiddle">&nbsp;Checking availability...');

    			$.ajax({  
   			    type: "POST",  
    			url: "../check.php",  
   				data: "replicated_siteid="+ usr,  
   			    success: function(msg){  
   
   				$("#replicated_status").ajaxComplete(function(event, request, settings){ 
				if(msg == 'OK')
				{ 
        			$("#replicated_siteid").removeClass('object_error'); // if necessary
					$("#replicated_siteid").addClass("object_ok");
					$(this).html('&nbsp;<img src="../accepted.png" align="absmiddle"> <font color="Green"> Congratulations your site ID is available </font>  ');
				}  
				else  
				{  
					$("#replicated_siteid").removeClass('object_ok'); // if necessary
					$("#replicated_siteid").addClass("object_error");
					$(this).html(msg);
					//jQuery("#replicated_siteid").val('');
					document.getElementById('replicated_siteid').value='';
					var vst = document.getElementById('replicated_siteid');
					vst.focus();vst.focus(); return false;

				} });

	 			} }); 

			}
			else
			{
				$("#replicated_status").html('<font color="red">The site ID should have atleast <strong>3</strong> characters.</font>');
				$("#replicated_siteid").removeClass('object_ok'); // if necessary
				$("#replicated_siteid").addClass("object_error");
			}

		});

		});*/
		
		
		
		//DROPDOWN
		