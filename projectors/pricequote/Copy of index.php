
	<link rel="stylesheet" href="pricequote/style.css" type="text/css" media="screen"/>

	<link rel="stylesheet" href="pricequote/simpleform.css" type="text/css" media="screen"/>
	<script type="text/javascript" src="pricequote/checkform.mini.js"></script>


	<?php
	define('CONFIG_PATH', 'pricequote/');
	require_once "simpleform.php";
	$sForm = new simpleForm();
	
	$sForm->handleMessage();
	?>
		    
	<form action="pricequote/simpleform.php" method="post" onsubmit="return checkform(this)">  
 	<fieldset>
		<?php $sForm->printData(1); ?>
		<legend><h3>Personal Contact Information</h3></legend>
		<p>
		 Please fill out your contact information.<br />
		 If you already have an account, you can login here.<br />
		</p>

			<div class="hdfrm">User Information</div>
			
			<label for="name">Full Name <span class="required">(required)</span></label>
			<input name="name" id="name" type="text" value="" />
			
			<label for="company">Company</label>
			<input type="text" name="company"  maxlength="8"/>
			
			<label for="email">Email <span class="required">(required)</span></label>
			<input name="email" id="email" type="text" value="" />
	<label for="phone">Telephone <span class="required">(required)</span></label>
        <input name="phone" id="phone" type="text" value="" />
        <label for="color">Color Options: <span class="required">(required)</span></label>
        <select name="color" id="color">
			<option value="-">Choose a color</option>
			<option value="Red">Red</option>
			<option value="Green">Green</option>
			<option value="Blue">Blue</option>
		</select>
			<div class="hdfrm">Address</div>
			 
			<label for="street">Street</label>
			<input type="text" name="street" />
			  
			<label for="Apart">Apart.</label>
			<input type="text" name="Apart"/>
			
			<label for="zip">Zip </label>
			<input name="zip" id="zip" type="text"  />
			
			<div for="clr"></div>
			<div class="hdfrm">Contact Information</div>
			
			<label for="phone">Phone <span class="required">(required)</span></label>
			<input name="phone" id="phone" type="text" value="" />
				   
			<label for="mobile">Mobile</label>
			<input type="text" name="mobile" id="mobile"  />
				 
			<label for="fax">Fax </label>
			<input name="fax" id="fax" type="text"  />
			 
			<label for="aolIM">AOL/IM </label>
			<input name="aolIM" id="aolIM" type="text"   />
			
			<p class="radio">
			<label for="email">Contact me by</label> <br>
     		<label><input type="radio" name="email" value="Email" /> Email</label>
            <label><input type="radio" name="email" value="Phone" /> Phone</label>
       		</p>
	</fieldset>
    
	<fieldset>
         <legend><h3>Projector Information.</h3></legend>
		 <p>
			Please fill out your projector information.<br />
			The more information you give us, the better we can help you.<br />
		</p>
		
		<div class="hdfrm">Add a new projector</div>
			
			  <label for="projector_type">Type</label>
				  	<select name="projector_type" id="projector_type" >
					    <option value="">- Select -</option>
						<option value="MAC Desktop">MAC Desktop</option>
						<option value="MAC Laptop">MAC Laptop</option>
						<option value="PC Desktop">PC Desktop</option>
						<option value="PC Laptop">PC Laptop</option>
				   </select>
				
			  <label for="projector_model">Projector model</label>
			  <input type="text" name="projector_model" id="projector_model" value="">
    			
			  <label for="serial_number">Projector serial number</label>
			  <input type="text" name="serial_number" id="serial_number" value="" >
	    	  
			  <label for="operation_system">Operation system</label>
			  <select name="operation_system" id="operation_system" > 
                  <option value="MAC OS">MAC OS </option> 
                  <option value="Windows Vista">Windows Vista </option> 
                  <option value="Windows XP">Windows XP </option> 
                  <option value="Windows 2000">Windows 2000</option> 
                  <option value="Windows 98">Windows 98</option> 
               </select>
				
		     <label for="os_serial_number">Operation system serial number</label>
			  <input type="text" name="os_serial_number" value="" />

		
		
		
		
    </fieldset>
	
	<br>		
	<fieldset>
			 <legend> <h3>Appointments</h3></legend>
				  <p>
				  Please let us know when you would like us to pick up your computer
				  or when you would like to drop it off.<br />
			      </p>
				
				<div class="hdfrm">Appointments</div>
				
				<br />
				
				<label class="priority">Priority</label>
				<input type="text" name="Priority" />
				<br />
				
				<label for="appointment_type">Appointment Type</label>
				<input type="text" name="appointment_type" />
				
				<label for="appointment_date">Appointment date</label>
				<input type="text" name="appointment_date"  />
				
				<label for="service_required">Service Required</label>
				<input type="text" name="service_required"  />
				
				<label for="additional_information">Additional Information</label>
				
				<textarea name="additional_information" id="additional_information"  rows="10" cols="70"> </textarea>
				

  				<div class="clr"></div>
		 </fieldset>


    <button class="btnsubmit" type="submit"></button>
   
	</form>