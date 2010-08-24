<script type="text/javascript" src="tab_css_js/jquery.quickflip.js" ></script>
<link rel="stylesheet" type="text/css" href="tab_css_js/styles.css" />
<script type="text/javascript">
	$('document').ready(function(){
		$('#flip-container').quickFlip();
		
		$('#flip-navigation li a').each(function(){
			$(this).click(function(){
				$('#flip-navigation li').each(function(){
					$(this).removeClass('selected');
				});
				$('#flip-navigation li #tab-0').removeClass('error_tab');
				$('#flip-navigation li #tab-1').removeClass('error_tab');
				$('#flip-navigation li #tab-2').removeClass('error_tab');
				$('#flip-navigation li #tab-3').removeClass('error_tab');
				$(this).parent().addClass('selected');
				
				var flipid = $(this).attr('id').substr(4);
				$('#cur_tab').val(flipid);
				$('#flip-container').quickFlipper({ }, flipid, 1);
				return false;
			});
		});
	});
	
	
	function _up(input)
	{
		var qty_el = document.getElementById(input); 
		var qty = qty_el.value; 
		if( !isNaN( qty ))
		{
			qty_el.value++;
			
			if(input == 'red_qty')
			{
				qty = parseInt($(qty_el).val());
				var price = parseInt($('#rprice').html()); 
				var item_total = qty*price;
				$('#qtr').val(qty);
				$('#red_total').val(item_total);
				shipping();
				update();
			}
			if(input == 'blue_qty')
			{
				qty = parseInt($(qty_el).val());
				var price = parseInt($('#bprice').html()); 
				var item_total = qty*price;
				$('#qtb').val(qty);
				$('#blue_total').val(item_total);
				shipping();
				update();
			}
			if(input == 'green_qty')
			{
				qty = parseInt($(qty_el).val());
				var price = parseInt($('#gprice').html()); 
				var item_total = qty*price;
				$('#qtg').val(qty);
				$('#green_total').val(item_total);
				shipping();
				update();
			}
			if(input == 'silver_qty')
			{
				qty = parseInt($(qty_el).val());
				var price = parseInt($('#sprice').html()); 
				var item_total = qty*price;
				$('#qts').val(qty);
				$('#silver_total').val(item_total);
				shipping();
				update();
			}
			if(input == 'red_qty2')
			{
				qty = parseInt($(qty_el).val());
				var price = parseInt($('#rprice2').html()); 
				var item_total = qty*price;
				$('#qtr').val(qty);
				$('#red_total2').val(item_total);
				shipping2();
				update();
			}
			if(input == 'blue_qty2')
			{
				qty = parseInt($(qty_el).val());
				var price = parseInt($('#bprice2').html()); 
				var item_total = qty*price;
				$('#qtb').val(qty);
				$('#blue_total2').val(item_total);
				shipping2();
				update();
			}
			if(input == 'green_qty2')
			{
				qty = parseInt($(qty_el).val());
				var price = parseInt($('#gprice2').html()); 
				var item_total = qty*price;
				$('#qtg').val(qty);
				$('#green_total2').val(item_total);
				shipping2();
				update();
			}
			if(input == 'silver_qty2')
			{
				qty = parseInt($(qty_el).val());
				var price = parseInt($('#sprice2').html()); 
				var item_total = qty*price;
				$('#qts').val(qty);
				$('#silver_total2').val(item_total);
				shipping2();
				update();
			}
		}
		else
		{
			return false;
		}
		
	}
	function _down(input)
	{
		
		var qty_el = document.getElementById(input); 
		var qty = qty_el.value;
		if( !isNaN( qty ) && qty > 0 )
		{
			qty_el.value--;
			
			if(input == 'red_qty')
			{
				qty = parseInt($(qty_el).val());
				var price = parseInt($('#rprice').html()); 
				var item_total = qty*price;
				$('#qtr').val(qty);
				$('#red_total').val(item_total);
				shipping();
				update();
			}
			if(input == 'blue_qty')
			{
				qty = parseInt($(qty_el).val());
				var price = parseInt($('#bprice').html()); 
				var item_total = qty*price;
				$('#qtb').val(qty);
				$('#blue_total').val(item_total);
				shipping();
				update();
			}
			if(input == 'green_qty')
			{
				qty = parseInt($(qty_el).val());
				var price = parseInt($('#gprice').html()); 
				var item_total = qty*price;
				$('#qtg').val(qty);
				$('#green_total').val(item_total);
				shipping();
				update();
			}
			if(input == 'silver_qty')
			{
				qty = parseInt($(qty_el).val());
				var price = parseInt($('#sprice').html()); 
				var item_total = qty*price;
				$('#qts').val(qty);
				$('#silver_total').val(item_total);
				shipping();
				update();
			}
			if(input == 'red_qty2')
			{
				qty = parseInt($(qty_el).val());
				var price = parseInt($('#rprice2').html()); 
				var item_total = qty*price;
				$('#qtr').val(qty);
				$('#red_total2').val(item_total);
				shipping2();
				update();
			}
			if(input == 'blue_qty2')
			{
				qty = parseInt($(qty_el).val());
				var price = parseInt($('#bprice2').html()); 
				var item_total = qty*price;
				$('#qtb').val(qty);
				$('#blue_total2').val(item_total);
				shipping2();
				update();
			}
			if(input == 'green_qty2')
			{
				qty = parseInt($(qty_el).val());
				var price = parseInt($('#gprice2').html()); 
				var item_total = qty*price;
				$('#qtg').val(qty);
				$('#green_total2').val(item_total);
				shipping2();
				update();
			}
			if(input == 'silver_qty2')
			{
				qty = parseInt($(qty_el).val());
				var price = parseInt($('#sprice2').html()); 
				var item_total = qty*price;
				$('#qts').val(qty);
				$('#silver_total2').val(item_total);
				shipping2();
				update();
			}
			
		}
		else
		{
			return false;
		}
	}
	
	
	//Check here!
	function checkUsername(params)
		{
			params = params.toLowerCase();
			$("#username").val(params);
			
			if(params.length >= 3)
			{

				$("#status").html('<img src="../loader.gif" align="absmiddle">&nbsp;Checking availability...');
				$.ajax({  
						type: "POST",  
						url: "check.php",  
						data: "username="+ params,  
						success: function(msg){
						if(msg == 'OK')
						{
							$("#username").removeClass('object_error'); // if necessary
							$("#username").addClass("object_ok");
							$("#status").html('&nbsp;<img src="../accepted.png" align="absmiddle"> <font color="Green"> Congratulations your username is available </font>  ');
							
						}  
						else  
						{
							$("#username").removeClass('object_ok'); // if necessary
							$("#username").addClass("object_error");
							$("#status").html(msg);
							//jQuery("#username").val('');
							//var fst = document.getElementById('username');
							//$("#username").val('');
							fst.focus();
							//document.getElementById('username').value='';
							return false;
						}	
					 }
				});
			}
			else
			{
				$("#status").html('<font color="red">The username should have atleast <strong>3</strong> characters.</font>');
				$("#username").removeClass('object_ok'); // if necessary
				$("#username").addClass("object_error");
			}
		}

		//checking Replicated id already exist
		function checkRep(params)
		{
			params = params.toLowerCase();
			$("#replicated_siteid").val(params);
			if(params.length >= 3)
			{
				if(params.indexOf('.zenvei.com') != -1)
				{
					$("#replicated_siteid").val('');
					var arr = params.split('.zenvei.com');
					var params = arr[0];
					$("#replicated_siteid").val(params);
				}
				if(params.indexOf(' ') != -1)
				{
					$("#replicated_siteid").val('');
					var arr = params.split(' ');
					var params = arr[0];
					$("#replicated_siteid").val(params);
				}
				
				$("#replicated_status").html('<img src="../loader.gif" align="absmiddle">&nbsp;Checking availability...');
				$.ajax({  
						type: "POST",  
						url: "check.php",  
						data: "replicated_siteid="+ params,  
						success: function(msg){
						if(msg == 'OK')
						{ 
							$("#replicated_siteid").removeClass('object_error'); // if necessary
							$("#replicated_siteid").addClass("object_ok");
							$("#replicated_status").html('&nbsp;<img src="../accepted.png" align="absmiddle"> <font color="Green"> Congratulations your site ID is available </font>  ');
						}  
						else  
						{  
							$("#replicated_siteid").removeClass('object_ok'); // if necessary
							$("#replicated_siteid").addClass("object_error");
							$("#replicated_status").html(msg);
							//$("#replicated_siteid").val('');
							//document.getElementById('replicated_siteid').value='';
							var vst = document.getElementById('replicated_siteid');
							vst.focus(); return false;
						}
					 }
				});
			}
			else
			{
				$("#replicated_status").html('<font color="red">The site ID should have atleast <strong>3</strong> characters.</font>');
				$("#replicated_siteid").removeClass('object_ok'); // if necessary
				$("#replicated_siteid").addClass("object_error");
			}
		}

		//checking email already exist
		function checkEmail(params)
		{
			$("#email_status").html('<img src="../loader.gif" align="absmiddle">&nbsp;Checking availability...');
			$.ajax({  
					type: "POST",  
					url: "check.php",  
					data: "email="+ params,  
					success: function(msg){
					if(msg == 'OK')
					{ 
						$("#email").removeClass('object_error'); // if necessary
						$("#email").addClass("object_ok");
						$("#email_status").html('&nbsp;<img src="../accepted.png" align="absmiddle"> <font color="Green"> Congratulations your email is available </font>  ');
					}  
					else  
					{  
						$("#email").removeClass('object_ok'); // if necessary
						$("#email").addClass("object_error");
						$("#email_status").html(msg);
						$("#email").val('');
						var vst = document.getElementById('email');
						vst.focus();vst.focus(); return false;
					}
				 }
			});
		}
		
		function state_tax()
		{
			//Get current tax.
			var current_tax = parseInt($('#taxx').val());
			
			//Get current total price
			var prod_total = parseInt($('#prod_total').val());
			
			//Get shipping total
			var current_shipping = parseInt($('#shipping').val());
			
			//Get reg_fee
			var reg_fee = parseInt($('#reg_fee').val());
			
			//Get state
			var state = document.getElementById('state_ship').value;
			var arr = state.split('_');
			var state_taxx = arr[1];
			
			if(state_taxx == 'none')
			{
				state_taxx = 0;
			}
			
			$('#state_taxx').val(state_taxx);
			
			var total_tax = current_tax + (prod_total * (state_taxx/100));
			$('#tax_amount').html(total_tax.toFixed(2));
			
			var new_total = reg_fee+prod_total+total_tax+current_shipping;
			
			
			$('#totals').val(new_total.toFixed(2));
			$('#total_amount').html(new_total.toFixed(2));
			
			
		}
		/*function _previous()
		{
			$('#flip-container').quickFlip();	
			var cur_tab = $('#cur_tab').val();
			
			$('#flip-navigation li #tab-0').removeClass('error_tab');
			$('#flip-navigation li #tab-1').removeClass('error_tab');
			$('#flip-navigation li #tab-2').removeClass('error_tab');
			$('#flip-navigation li #tab-3').removeClass('error_tab');
			
			if(cur_tab == 0)
			{
				return false;
			}
			if(cur_tab == 1)
			{
				$('#flip-navigation li #tab-1').parent().removeClass('selected');					
				$('#flip-navigation li #tab-0').parent().addClass('selected');
				
				$('#flip-container').quickFlipper({ }, 0, 1);
			}
			if(cur_tab == 2)
			{
				$('#flip-navigation li #tab-2').parent().removeClass('selected');					
				$('#flip-navigation li #tab-1').parent().addClass('selected');
				
				$('#flip-container').quickFlipper({ }, 1, 1);
			}
			if(cur_tab == 3)
			{
				$('#flip-navigation li #tab-3').parent().removeClass('selected');					
				$('#flip-navigation li #tab-2').parent().addClass('selected');
				
				$('#flip-container').quickFlipper({ }, 2, 1);
			}
			
			
			$('#cur_tab').val(cur_tab-1);
		}
		function _next()
		{
			$('#flip-container').quickFlip();	
			var cur_tab = $('#cur_tab').val();
			
			$('#flip-navigation li #tab-0').removeClass('error_tab');
			$('#flip-navigation li #tab-1').removeClass('error_tab');
			$('#flip-navigation li #tab-2').removeClass('error_tab');
			$('#flip-navigation li #tab-3').removeClass('error_tab');
			
			if(cur_tab == 0)
			{
				$('#flip-navigation li #tab-0').parent().removeClass('selected');					
				$('#flip-navigation li #tab-1').parent().addClass('selected');
				$('#flip-container').quickFlipper({ }, 1, 1);
			}
			if(cur_tab == 1)
			{
				$('#flip-navigation li #tab-1').parent().removeClass('selected');					
				$('#flip-navigation li #tab-2').parent().addClass('selected');
				$('#flip-container').quickFlipper({ }, 2, 1);
			}
			if(cur_tab == 2)
			{
				$('#flip-navigation li #tab-2').parent().removeClass('selected');					
				$('#flip-navigation li #tab-3').parent().addClass('selected');
				$('#flip-container').quickFlipper({ }, 3, 1);
	
			}
			if(cur_tab == 3)
			{
				
				return false;
			}
			
			$('#cur_tab').val(cur_tab+1);
		}*/
		
		
		function IdidntSleep(qtr,qtb,qtg,qts)
			{ 
				$('#qtr').val(qtr);
				$('#qtb').val(qtb);
				$('#qtg').val(qtg);
				$('#qts').val(qts);
				
				price_r = parseInt($('#rprice2').html());
				price_b = parseInt($('#bprice2').html());
				price_g = parseInt($('#gprice2').html());
				price_s = parseInt($('#sprice2').html());
					
				prod_total2 = ((qtr * price_r)+(qtb * price_b)+ (qtg * price_g) + (qts * price_s));
				
				$('#red_total2').val(qtr * price_r);
				$('#blue_total2').val(qtb * price_b);
				$('#green_total2').val(qtg * price_g);
				$('#silver_total2').val(qts * price_s);
			
				w_o_blue = qtr+qtg+qts;
				
				if(qtb==0)
				{
					if(w_o_blue<=6)
					{
						$('#shipping2').val(8);
					}else
					{
						$('#shipping2').val(16);
					}
				}
				else
				{
					if(qtb<3)
					{
						if(w_o_blue>6)
						{
						
							$('#shipping2').val(28);
						}
						else if((w_o_blue>0))
						{
							$('#shipping2').val(20);				
						}else
						{
							$('#shipping2').val(12);	
						}
					}
					else
					{
						if(w_o_blue>6)
						{
							$('#shipping2').val(40);				
						}
						else if((w_o_blue>0))
						{
							$('#shipping2').val(32);				
						}
						else
						{
							$('#shipping2').val(24);	
						}
					}
				}	
				shipping2 = parseInt($('#shipping2').val());
				tax_amount2 = (prod_total2/100)*6.5;
				auto_ship = prod_total2+tax_amount2+shipping2;
				
				$('#autoship_amount').html(auto_ship.toFixed(2));
				$('#auto_ships').val(auto_ship.toFixed(2));
			}
			
			function deleteMe(select)
			{
				while(select.hasChildNodes())
				{
					select.removeChild(select.firstChild);
				}
			}
			
			function repoblate(color,pos)
			{
				color.options[0] = new Option('Select Quantity','0');
				for(i=1;i<=10;i++)
				{
					color.options[i] = new Option(i,i);
				}
				color.options[pos].selected = true;
			}
				
			function Changedrop1options(select1,select2)
			{
				var option1 = select1.options[select1.selectedIndex].text;
				var select2 = document.getElementById(select2);
				
				var selectr = document.getElementById('red_qty2');
				var selectb = document.getElementById('blue_qty2');
				var selectg = document.getElementById('green_qty2');
				var selects = document.getElementById('silver_qty2');
				
				var new1 = new Option('Select Options','Select Options');
				var new2 = new Option('Marketing Associate','Marketing Associate');
				var new3 = new Option('Business Associate','Business Associate');
				
			
				if(option1 == 'Select Package')
				{
					deleteMe(select2);
					select2.options[0] = new1;
					select2.options[1] = new2;
					select2.options[2] = new3;
					
					/*deleteMe(selectr);
					deleteMe(selectb);
					deleteMe(selectg);
					deleteMe(selects);
					
					repoblate(selectr,0);
					repoblate(selectb,0);
					repoblate(selectg,0);
					repoblate(selects,0);*/
					
					selectr.value = 0;
					selectb.value = 0;
					selectg.value = 0;
					selects.value = 0;
					
					$('#qtr').val(0);
					$('#qtb').val(0);
					$('#qtg').val(0);
					$('#qts').val(0);
					
					$('#rprice2').val(0);
					$('#bprice2').val(0);
					$('#gprice2').val(0);
					$('#sprice2').val(0);
					
					$('#shipping2').val(0.00);
					$('#shipping_amount').html('0.00');
					
					$('#autoship_amount').html('0.00');
					$('#auto_ships').val(0.00);
					
				}
				
				if(option1 == 'Marketing Associate Pack')
				{
					deleteMe(select2);
					select2.options[0] = new1;
					select2.options[1] = new2;
					select2.options[1].selected = true;
					
					selectr.value = 1;
					selectb.value = 1;
					selectg.value = 1;
					selects.value = 0;
					
					qtr = selectr.value;
					qtb = selectb.value;
					qtg = selectg.value;
					qts = selects.value;
					
					/*deleteMe(selectr);
					deleteMe(selectb);
					deleteMe(selectg);
					deleteMe(selects);
					
					repoblate(selectr,1);
					repoblate(selectb,1);
					repoblate(selectg,1);
					repoblate(selects,0);
					
					qtr = selectr.options[selectr.selectedIndex].text
					qtb = selectb.options[selectb.selectedIndex].text
					qtg = selectg.options[selectg.selectedIndex].text
					qts = 0;*/
					
					IdidntSleep(qtr,qtb,qtg,qts);
				}
				if(option1 == 'Business Associate Pack')
				{
					/*deleteMe(selectr);
					deleteMe(selectb);
					deleteMe(selectg);
					
					repoblate(selectr,1);
					repoblate(selectb,2);
					repoblate(selectg,1);
					
					qtr = selectr.options[selectr.selectedIndex].text
					qtb = selectb.options[selectb.selectedIndex].text
					qtg = selectg.options[selectg.selectedIndex].text
					qts = 0;*/
					
					selectr.value = 1;
					selectb.value = 2;
					selectg.value = 1;
					selects.value = 0;
					
					qtr = selectr.value;
					qtb = selectb.value;
					qtg = selectg.value;
					qts = selects.value;
					
					IdidntSleep(qtr,qtb,qtg,qts);
					
				}
				if(option1 == 'Master Pack')
				{
					/*deleteMe(selectr);
					deleteMe(selectb);
					deleteMe(selectg);
					
					repoblate(selectr,2);
					repoblate(selectb,2);
					repoblate(selectg,2);
					
					qtr = selectr.options[selectr.selectedIndex].text
					qtb = selectb.options[selectb.selectedIndex].text
					qtg = selectg.options[selectg.selectedIndex].text
					qts = 0;*/
					
					selectr.value = 2;
					selectb.value = 2;
					selectg.value = 2;
					selects.value = 0;
					
					qtr = selectr.value;
					qtb = selectb.value;
					qtg = selectg.value;
					qts = selects.value;
					
					IdidntSleep(qtr,qtb,qtg,qts);
					
				}
				if(option1 == 'Mega Master Pack')
				{
					/*deleteMe(selectr);
					deleteMe(selectb);
					deleteMe(selectg);
					
					repoblate(selectr,4);
					repoblate(selectb,4);
					repoblate(selectg,4);
					
					qtr = selectr.options[selectr.selectedIndex].text
					qtb = selectb.options[selectb.selectedIndex].text
					qtg = selectg.options[selectg.selectedIndex].text
					qts = 0;*/
					
					selectr.value = 4;
					selectb.value = 4;
					selectg.value = 4;
					selects.value = 0;
					
					qtr = selectr.value;
					qtb = selectb.value;
					qtg = selectg.value;
					qts = selects.value;
					
					IdidntSleep(qtr,qtb,qtg,qts);
					
				}
				
				if(option1 == 'Business Associate Pack' || option1 == 'Master Pack' || option1 == 'Mega Master Pack')
				{
					deleteMe(select2);
					select2.options[0] = new1;
					select2.options[1] = new3;
					select2.options[1].selected = true;
				}
				
			
			}
		
			function Changedrop2options(select1, select2)
			{
				
				var option1 = select1.options[select1.selectedIndex].text;
				var select2 = document.getElementById(select2);
							
				var newA = new Option('Select Package','Select Package');
				var newB = new Option('Marketing Associate Pack','Marketing Associate Pack');
				var newC = new Option('Business Associate Pack','Business Associate Pack');
				var newD = new Option('Master Pack','Master Pack');
				var newE = new Option('Mega Master Pack','Mega Master Pack');
				
				var new1 = new Option('Select Options','Select Options');
				var new2 = new Option('Marketing Associate','Marketing Associate');
				var new3 = new Option('Business Associate','Business Associate');
				var new4 = new Option('Preferred Customer','Preferred Customer');
				
				if(option1 == 'Select Options')
				{
					deleteMe(select2);
					select1.options[0] = new1;
					select1.options[1] = new2;
					select1.options[2] = new3;
					select1.options[3] = new4;
					
					select2.options[0] = newA;
					select2.options[1] = newB;
					select2.options[2] = newC;
					select2.options[3] = newD;
					select2.options[4] = newE;
					
				}
				
				if(option1 == 'Marketing Associate')
				{
					deleteMe(select2);
					select2.options[0] = newA;
					select2.options[1] = newB;
					
				
				}
				if(option1 == 'Business Associate')
				{
					deleteMe(select2);
					select2.options[0] = newA;
					select2.options[1] = newC;
					select2.options[2] = newD;
					select2.options[3] = newE;
				}
				if(option1 == 'Preferred Customer')
				{
					window.location = location.href = 'index.php';
				}
				
			}
		
</script>
<!--<div><input type="button" class="previous" onClick="_previous();" name="Previous" value="Previous">&nbsp;&nbsp;&nbsp;<input type="button" class="next" onClick="_next();" name="Next" value="Next"></div><br>-->
<div id="mainbody" >
	<div id="flip-tabs" >
		<ul id="flip-navigation" >
			<li class="selected"><a href="#" id="tab-0">Todays Order</a></li>
			<li><a href="#" id="tab-1" >Future Autoship</a></li>
			<li><a href="#" id="tab-2" >User Information</a></li>
			<li><a href="#" id="tab-3">Terms</a></li>
		</ul>
		<div id="flip-container" >
	  <div>
				<ul class="blue">
				  <table cellspacing="0" width="70">
					<tr>
                      <td>*Shipping Method</td>
                      <td><select name="ship_method" id="ship_method">
                        <option value="">Select Shipping Method</option>
                        <option value="US Mail">US Mail</option>
						 <option value="Will-Call">Will-Call</option>
                        </select>
                      </td>
					 </tr>
					 <tr>
						<td>&nbsp;</td>
					 </tr>
                    <tr>
                      <td width="98" class="bold">ZENVEI RED</td>
                      <td width="215">Improves and maintains cardiovascular function. </td>
                      <td width="30" align="left" class="b">$<span id="rprice">32</span>
                       </td>
                      <td width="118">
						<input type="text" class="inputboxquantity" size="4" id="red_qty" name="quantity[]" value="0" />
						<input type="button" class="up_arrow" 	onclick="_up('red_qty');" />
						<input type="button" class="down_arrow" onclick="_down('red_qty');" />
                      </td>
                      <td width="225"><img src="../images/red_bottle.gif" alt="" width="225" height="236" /></td>
                    </tr>
                    <tr>
                      <td class="bold">ZENVEI BLUE</td>
                      <td>Immunity, brain function and cell therapy</td>
                      <td align="left" class="b">$<span id="bprice">35</span></td>
                      <td>
						<input type="text" class="inputboxquantity" size="4" id="blue_qty" name="quantity[]" value="0" />
						<input type="button" class="up_arrow" 	onclick="_up('blue_qty')" />
						<input type="button" class="down_arrow" onclick="_down('blue_qty')" />
					  </td>
                      <td><img src="../images/blue_bottle.gif" alt="" width="225" height="236" /></td>
                    </tr>
                    <tr>
                      <td class="bold">ZENVEI GREEN </td>
                      <td>Cellular detoxification</td>
                      <td align="left" class="b">$<span id="gprice">32</span></td>
                      <td>
						<input type="text" class="inputboxquantity" size="4" id="green_qty" name="quantity[]" value="0" />
						<input type="button" class="up_arrow" 	onclick="_up('green_qty')" />
						<input type="button" class="down_arrow" onclick="_down('green_qty')" />
					  </td>
                      <td><img src="../images/green_bottle.gif" alt="" width="225" height="236" /></td>
                    </tr>
                    <tr>
                      <td class="bold">ZENVEI SILVER</td>
                      <td>True Colloidal Silver</td>
                      <td align="left" class="b">$<span id="sprice">32</span></td>
                      <td>
						<input type="text" class="inputboxquantity" size="4" id="silver_qty" name="quantity[]" value="0" />
						<input type="button" class="up_arrow"  onclick="_up('silver_qty')" />
						<input type="button" class="down_arrow" onclick="_down('silver_qty')" />
					  </td>
                      <td><img src="../images/silver_bottle.png" alt="" width="225" height="236" /></td>
                    </tr>
                    <tr>
                      </td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                  </table>
		  </ul>
		  </div>
	  <div>
				<ul class="green">
				   <h3>Select Monthly AutoShip Program.</h3>
    <p>Your first order will ship immedialtely and on that date every month thereafter, until you contact Zenvei<br /> to cancel. </p>
    <p>To qualify as a <span class="bus">Business</span><span class="mar">MARKETING</span><span class="noauto" style="display:none;">MARKETING</span>  Associate you must choose a combination of products totallying $<span class="bus">128</span><span class="mar">70</span><span class="noauto" style="display:none;">0</span></p>
    <p> or more. 
      To enjoy the benefits of a <span class="bus">Business</span><span class="mar">MARKETING</span><span class="noauto" style="display:none;">MARKETING</span>  Associate, your monthly qualifying purchase</p>
    <p> would be a combination 
      of products totallying $<span class="bus">128</span><span class="mar">70</span><span class="noauto" style="display:none;">0</span> or more.</p>
    <p>&nbsp;</p>
 
	<p>===============================================================================</p>
				<table cellspacing="0" width="70">
					<tr>
                      <td>*Shipping Method</td>
                      <td><select name="ship_method2" id="ship_method2">
                        <option value="">Select Shipping Method</option>
                        <option value="US Mail">US Mail</option>
						 <option value="Will-Call">Will-Call</option>
                        </select>
                      </td>
					 </tr>
					 <tr>
						<td>This field is required</td>
					 </tr>
                    <tr>
                      <td width="98" class="bold">ZENVEI RED</td>
                      <td width="215">Improves and maintains cardiovascular function. </td>
                      <td width="30" align="left" class="b">$<span id="rprice2">32</span>
                          <!--<span class="bus">32</span><span class="mar">35</span> --></td>
                      <td width="118">
						<input type="text" class="inputboxquantity" size="4" id="red_qty2" name="quantity[]" value="0" />
						<input type="button" class="up_arrow" 	onclick="_up('red_qty2');" />
						<input type="button" class="down_arrow" onclick="_down('red_qty2');" />
                      </td>
                      <td width="225"><img src="../images/red_bottle.gif" alt="" width="225" height="236" /></td>
                    </tr>
                    <tr>
                      <td class="bold">ZENVEI BLUE</td>
                      <td>Immunity, brain function and cell therapy</td>
                      <td align="left" class="b">$<span id="bprice2">35</span></td>
                      <td>
						<input type="text" class="inputboxquantity" size="4" id="blue_qty2" name="quantity[]" value="0" />
						<input type="button" class="up_arrow" 	onclick="_up('blue_qty2');" />
						<input type="button" class="down_arrow" onclick="_down('blue_qty2');" />
					  </td>
                      <td><img src="../images/blue_bottle.gif" alt="" width="225" height="236" /></td>
                    </tr>
                    <tr>
                      <td class="bold">ZENVEI GREEN </td>
                      <td>Cellular detoxification</td>
                      <td align="left" class="b">$<span id="gprice2">32</span></td>
                      <td>
							<input type="text" class="inputboxquantity" size="4" id="green_qty2" name="quantity[]" value="0" />
						<input type="button" class="up_arrow" 	onclick="_up('green_qty2');" />
						<input type="button" class="down_arrow" onclick="_down('green_qty2');" />
					  </td>
                      <td><img src="../images/green_bottle.gif" alt="" width="225" height="236" /></td>
                    </tr>
                    <tr>
                      <td class="bold">ZENVEI SILVER</td>
                      <td>True Colloidal Silver</td>
                      <td align="left" class="b">$<span id="sprice2">32</span></td>
                      <td>
						<input type="text" class="inputboxquantity" size="4" id="silver_qty2" name="quantity[]" value="0" />
						<input type="button" class="up_arrow" 	onclick="_up('silver_qty2');" />
						<input type="button" class="down_arrow" onclick="_down('silver_qty2');" />
					  </td>
                      <td><img src="../images/silver_bottle.png" alt="" width="225" height="236" /></td>
                    </tr>
					<tr>
                      </td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                  </table>
				</ul>
		  </div>
		  
		  <div>
				<ul class="user">
				 <div>
					<table cellspacing="0" width="100%">        
					<tr>
						<td colspan="2"><h3>Step 1: User Information </h3></td>
						<td colspan="2" class="bold">&nbsp;</td>
					</tr>
					<tr>
					  <td colspan="2"><div id="status">  &nbsp;</div></td>
					  <td colspan="2"><div id="replicated_status">  &nbsp;</div></td>
					</tr>
					<tr>
						<td><?php echo JText::_('CLI_DF_USERNAME');?></td>
						<td>
							<input id="username"  type="text" name="username[]" onKeyUp="checkUsername(this.value)" />		 </td>
						<td><?php echo JText::_('CLI_DF_SITEID');?></td>
						<td><input id="replicated_siteid"  type="text" name="replicated_siteid[]" onKeyUp="checkRep(this.value)" /></td>
					</tr>
					<tr>
					  <td><?php echo JText::_('CLI_DF_PASSWORD');?></td>
					  <td><input name="password[]" type="password" id="password" /></td>
					  <td><?php echo JText::_('CLI_DF_VERIFYPASSWORD');?> </td>
					<td class="bold"><input name="vpassword[]" type="password" id="vpassword" /></td>
					</tr>
					<tr>
					  <td colspan="2"><h3><?php echo JText::_('CLI_DF_STEP2_HEAD');?></h3></td>
					  <td colspan="2" class="bold">Signup as Business
					  <input name="as_buss[]" type="checkbox" class="check" id="as_buss" value="1" /></td>
					</tr>
					<tr>
					  <td width="15%" height="30"><?php echo JText::_('CLI_DF_FIRSTNAME');?></td>
					  <td width="33%">
						<input name="fname[]" type="text" id="fname" />          </td>
					  <td width="17%"><?php echo JText::_('CLI_DF_LASTNAME');?> </td>
					  <td width="35%"><input name="lname[]" type="text" id="lname" /></td>
					</tr>
					<tr>
					  <td><?php echo JText::_('CLI_DF_BIRTH');?> </td>
					  <td><input name="b_day2[]" type="text"  id="b_day2" /></td>
					  <td>&nbsp;</td>
					  <td>&nbsp;</td>
					</tr>
					<tr id="buss_name_field">
					  <td><?php echo JText::_('CLI_DF_BUSINESS_NAME');?></td>
					  <td colspan="3"><input name="buss_name[]" type="text" class="large" id="buss_name" /></td>
					</tr>		
					<tr>
					  <td colspan="2"><div id="email_status"></div></td>
					  <td colspan="2"></td>
					</tr>
					<tr>
					  <td><?php echo JText::_('CLI_DF_EMAIL');?></td>
					  <td><input name="email[]" type="text" id="email" onBlur="checkEmail(this.value)" /><br /><span id="email_err"></span></td>
					  <td><?php echo JText::_('CLI_DF_CONFIRM_EMAIL');?></td>
					  <td><input name="c_email[]" type="text" id="c_email" /></td>
					</tr>
					<tr>
					  <td><span class="ssn_text"><?php echo JText::_('CLI_DF_SSN');?></span> </td>
					  <td><input name="ssn[]" type="text" id="ssn" /></td>
					  <td>Confirm <span class="ssn_text"><?php echo JText::_('CLI_DF_SSN');?></span> </td>
					  <td><input name="c_ssn[]" type="text" id="c_ssn" /></td>
					</tr>
					<tr>
					  <td>&nbsp;</td>
					  <td class="bold"><?php echo JText::_('CLI_WHY_SSN');?></td>
					  <td>&nbsp;</td>
					  <td>&nbsp;</td>
					</tr>
					<tr>
					  <td><?php echo JText::_('CLI_DAYTIME_PHONE');?> </td>
					  <td><input name="day_phone[]" type="text" id="day_phone" /></td>
					  <td><?php echo JText::_('CLI_EVE_PHONE');?> </td>
					  <td><input name="even_phone[]" type="text" id="even_phone" /></td>
					</tr>
					<tr>
					  <td><?php echo JText::_('CLI_CELL_PHONE');?> </td>
					  <td><input name="cell[]" type="text" id="cell" /></td>
					  <td><?php echo JText::_('CLI_FAX_NUMBER');?> </td>
					  <td><input name="fax[]" type="text" id="fax" /></td>
					</tr>
					<tr>
					  <td>&nbsp;</td>
					  <td>&nbsp;</td>
					  <td>&nbsp;</td>
					  <td>&nbsp;</td>
					</tr>
					<tr>
					  <td>&nbsp;</td>
					  <td class="bold"><?php echo JText::_('CLI_COAPP_INFO');?></td>
					  <td>&nbsp;</td>
					  <td>&nbsp;</td>
					</tr>
					<tr>
					  <td><?php echo JText::_('CLI_DF_FIRSTNAME');?> </td>
					  <td><input name="fname_co[]" type="text" id="fname_co" /></td>
					  <td><?php echo JText::_('CLI_DF_LASTNAME');?></td>
					  <td><input name="lname_co[]" type="text" id="lname_co" /></td>
					</tr>
					<tr>
					  <td><?php echo JText::_('CLI_DF_BIRTH');?> </td>
					  <td><input name="b_day_co[]" type="text" id="b_day_co" /></td>
					 </tr>
					 <tr>
						<td><?php echo JText::_('CLI_FORM_D1_OPTION2');?>/<?php echo JText::_('CLI_DF_LASTNAME');?></td>
					 </tr>
					<tr>
					  <td>&nbsp;</td>
					  <td>&nbsp;</td>
					  <td>&nbsp;</td>
					  <td>&nbsp;</td>
					</tr>
				</table>
			</div>
<!--end step2 -->
<!--step3 starts -->
<div id="step3">
     <h3><?php echo JText::_('CLI_STEP3_HEADER');?> </h3>
    <table cellspacing="0" width="96%">
        <tr>
          <td colspan="2" class="bold">Shipping Address: (No PO Boxes)</td>
          <td width="156"></td>
          <td width="252"></td>
        </tr>
        <tr>
          <td width="147"><?php echo JText::_('CLI_SHIP_ADDRESS1');?> </td>
          <td colspan="3"><input name="add1_ship[]" type="text" class="large" id="add1_ship" /></td>
        </tr>
        <tr>
          <td><?php echo JText::_('CLI_SHIP_ADDRESS2');?>  </td>
          <td colspan="3"><input name="add2_ship[]" type="text" class="large" id="add2_ship" /></td>
        </tr>
        <tr>
          <td><?php echo JText::_('CLI_CITY');?> </td>
          <td width="275"><input name="city_ship[]" type="text" id="city_ship" /></td>
          <td><?php echo JText::_('CLI_STATE');?></td>
          <td><select name="state_ship[]" id="state_ship">
            <option value="">Select a state</option>
            <option value="AL">Alabama</option>
            <option value="AK">Alaska</option>
            <option value="AZ">Arizona</option>
            <option value="AR">Arkansas</option>
            <option value="CA">California</option>
            <option value="CO">Colorado</option>
            <option value="CT">Connecticut</option>
            <option value="DE">Delaware</option>
            <option value="DC">District of Columbia</option>
            <option value="FL">Florida</option>
            <option value="GA">Georgia</option>
            <option value="HI">Hawaii</option>
            <option value="ID">Idaho</option>
            <option value="IL">Illinois</option>
            <option value="IN">Indiana</option>
            <option value="IA">Iowa</option>
            <option value="KS">Kansas</option>
            <option value="KY">Kentucky</option>
            <option value="LA">Louisiana</option>
            <option value="ME">Maine</option>
            <option value="MD">Maryland</option>
            <option value="MA">Massachusetts</option>
            <option value="MI">Michigan</option>
            <option value="MS">Mississippi</option>
            <option value="MO">Missouri</option>
            <option value="MT">Montana</option>
            <option value="NE">Nebraska</option>
            <option value="NV">Nevada</option>
            <option value="NH">New Hampshire</option>
            <option value="NJ">New Jersey</option>
            <option value="NM">New Mexico</option>
            <option value="NY">New York</option>
            <option value="NC">North Carolina</option>
            <option value="ND">North Dakota</option>
            <option value="OH">Ohio</option>
            <option value="OK">Oklahoma</option>
            <option value="OR">Oregon</option>
            <option value="PA">Pennsylvania</option>
            <option value="RI">Rhode Island</option>
            <option value="SC">South Carolina</option>
            <option value="SD">South Dakota</option>
            <option value="TN">Tennessee</option>
            <option value="TX">Texas</option>
            <option value="UT">Utah</option>
            <option value="VT">Vermont</option>
            <option value="VA">Virginia</option>
            <option value="WA">Washington</option>
            <option value="DC">Washington D.C.</option>
            <option value="WV">West Virginia</option>
            <option value="WI">Wisconsin</option>
            <option value="WY">Wyoming</option>
          </select></td>
        </tr>
        <tr>
          <td height="63">Zip:</td>
          <td><input name="zip_ship[]" type="text" id="zip_ship" /></td>
          <td>Country: </td>
          <td><input name="country_ship[]" type="text" id="country_ship"  value="USA"/></td>
        </tr>
        <tr>
          <td height="63"></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td></td>
        </tr>
        <tr>
          <td height="63" class="bold">Billing Address:</td>
          <td valign="top">Same as shipping          
          <input name="same_as_ship[]" type="checkbox" class="check" id="same_as_ship" value="1" /></td>
          <td>&nbsp;</td>
          <td></td>
        </tr>
        <tr>
          <td>Address 1: </td>
          <td colspan="3"><input name="add1_bill[]" type="text" class="large" id="add1_bill" /></td>
        </tr>
        <tr>
          <td>Address 2: </td>
          <td colspan="3"><input name="add2_bill[]" type="text" class="large" id="add2_bill" /></td>
        </tr>
        <tr>
          <td>City: </td>
          <td><input name="city_bill[]" type="text" id="city_bill" /></td>
          <td>State:</td>
          <td><select name="state_bill[]" id="state_bill">
              <option value="">Select a state</option>
              <option value="AL">Alabama</option>
              <option value="AK">Alaska</option>
              <option value="AZ">Arizona</option>
              <option value="AR">Arkansas</option>
              <option value="CA">California</option>
              <option value="CO">Colorado</option>
              <option value="CT">Connecticut</option>
              <option value="DE">Delaware</option>
              <option value="DC">District of Columbia</option>
              <option value="FL">Florida</option>
              <option value="GA">Georgia</option>
              <option value="HI">Hawaii</option>
              <option value="ID">Idaho</option>
              <option value="IL">Illinois</option>
              <option value="IN">Indiana</option>
              <option value="IA">Iowa</option>
              <option value="KS">Kansas</option>
              <option value="KY">Kentucky</option>
              <option value="LA">Louisiana</option>
              <option value="ME">Maine</option>
              <option value="MD">Maryland</option>
              <option value="MA">Massachusetts</option>
              <option value="MI">Michigan</option>
              <option value="MS">Mississippi</option>
              <option value="MO">Missouri</option>
              <option value="MT">Montana</option>
              <option value="NE">Nebraska</option>
              <option value="NV">Nevada</option>
              <option value="NH">New Hampshire</option>
              <option value="NJ">New Jersey</option>
              <option value="NM">New Mexico</option>
              <option value="NY">New York</option>
              <option value="NC">North Carolina</option>
              <option value="ND">North Dakota</option>
              <option value="OH">Ohio</option>
              <option value="OK">Oklahoma</option>
              <option value="OR">Oregon</option>
              <option value="PA">Pennsylvania</option>
              <option value="RI">Rhode Island</option>
              <option value="SC">South Carolina</option>
              <option value="SD">South Dakota</option>
              <option value="TN">Tennessee</option>
              <option value="TX">Texas</option>
              <option value="UT">Utah</option>
              <option value="VT">Vermont</option>
              <option value="VA">Virginia</option>
              <option value="WA">Washington</option>
              <option value="DC">Washington D.C.</option>
              <option value="WV">West Virginia</option>
              <option value="WI">Wisconsin</option>
              <option value="WY">Wyoming</option>
          </select></td>
        </tr>
        <tr>
          <td><?php echo JText::_('CLI_ZIPCODE');?></td>
          <td><input name="zip_bill[]" type="text" id="zip_bill" /></td>
          <td><?php echo JText::_('CLI_COUNTRY');?> </td>
          <td><input name="country_bill[]" type="text" id="country_bill" value="USA" /></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td colspan="2" class="bold">&nbsp;</td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td colspan="2" class="bold"><?php echo JText::_('CLI_CC_INFO');?></td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td><?php echo JText::_('CLI_CC_TYPE');?> </td>
          <td>
          	<select name="card_type[]" id="card_type">
            	<option value="AMEX">American Express</option>
                <option value="Visa">Visa</option>
                <option value="MasterCard">MasterCard</option>
                <option value="Discover">Discover</option>
            </select>
          </td>
          <td><?php echo JText::_('CLI_NAME_ON_CARD');?> </td>
          <td><input name="name_card[]" type="text" id="name_card" /></td>
        </tr>
        <tr>
          <td><?php echo JText::_('CLI_CC_NUMBER');?> </td>
          <td><input name="card_no[]" type="text" id="card_no" maxlength="18" /></td>
          <td><?php echo JText::_('CLI_EXP_DATE');?></td>
          <td>
		  <select id="expire_date[]" name="expire_date">
		  <option value=''><?php echo JText::_('CLI_FORM_D1_OPTION0');?></option>
		<option value='01'>January</option>
		<option value='02'>February</option>
		<option value='03'>March</option>
		<option value='04'>April</option>
		<option value='05'>May</option>
		<option value='06'>June</option>
		<option value='07'>July</option>
		<option value='08'>August</option>
		<option value='09'>September</option>
		<option value='10'>October</option>
		<option value='11'>November</option>
		<option value='12'>December</option>
		</select>
/
	  <select id="expire_year[]" name="expire_year">
		<option value='2010'>2010</option>
		<option value='2011'>2011</option>
		<option value='2012'>2012</option>
		<option value='2013'>2013</option>
		<option value='2014'>2014</option>
		<option value='2015'>2015</option>

		</select>


</td>
        </tr>
        <tr>
          <td><?php echo JText::_('CLI_CSV');?></td>
          <td><input name="csv[]" type="text" id="csv" maxlength="18" /></td>
          <td></td>
          <td></td>
        </tr>
    </table>
</div>	
				</ul>
		  </div>
		  <div>
			<ul class="terms">
				<h2><?php echo JText::_('CLI_STEP4_TERMS');?> 
				<p>&nbsp;</p>

				<p><input name="terms_condition[]" type="checkbox" class="check" id="terms_condition" /> &nbsp;<?php echo JText::_('CLI_STEP4_AFTERCHECK');?><p class="ecxecxMsoNormal"> </p>
				<p class="ecxecxMsoNormal"><a rel="lightbox" href="https://www.zenvei.com/index.php?option=com_content&amp;view=article&amp;id=44" class="jcepopup"><?php echo JText::_('CLI_STEP4_TERMS_CLICK');?></a></p>
				<p class="ecxecxMsoNormal"> </p></p>
				<p>&nbsp;</p>
				<input type="submit" value="<?php echo JText::_('CLI_SUBMITNOW');?>" name="Submit" />
				<p>&nbsp;</p> 

				<?php echo JText::_('CLI_CONGRATS');?>
			<div> <?php include('../jumi_include.php') ;?> </div>
			<p>&nbsp;</p>
			<p>==============================================================================</p>
			 <h3><?php echo JText::_('CLI_REGFEE_HEAD');?> </h3>
			<?php echo JText::_('CLI_REGFEE_BODY');?>
			<p>&nbsp;</p>
    
    
			</ul>
		  </div>
	</div>
	</div>
	</div>
	</form> 