
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

			<div class="hdfrm">Personal Information</div>
			
			<label for="name">Full Name <span class="required">(required)</span></label>
			<input name="name" id="name" type="text" value="" />
			<label for="company">Company</label>
			<input type="text" name="company" />
			<label for="email">Email <span class="required">(required)</span></label>
			<input name="email" id="email" type="text" value="" />

			<div class="hdfrm">Address Information</div>
			 
			<label for="street">Street Address</label>
			<input type="text" name="street" />
			<label for="Apart">Apartment Number</label>
			<input type="text" name="Apart"/>
			<label for="zip">Zip Code</label>
			<input name="zip" id="zip" type="text"  />
			
			<div class="hdfrm">Contact Information</div>
			
			<label for="phone">Phone Number <span class="required">(required)</span></label>
			<input name="phone" id="phone" type="text" value="" />
			<label for="altphone">Alternate Phone Number</label>
			<input name="altphone" id="altphone" type="text" value="" />
			<label for="fax">Fax Number</label>
			<input name="fax" id="fax" type="text"  />
			 <label for="aolIM">AOL/IM </label>
			<input name="aolIM" id="aolIM" type="text"   />
	   
	   
	    <fieldset class="radio">
            <legend><label for="contact_me_by">Contact Me By? <span class="required">(required)</span></label></legend>
            <label><input type="radio" name="contact_me_by" id="contact_me_by" value="Email" /> Email</label>
            <label><input type="radio" name="contact_me_by" id="contact_me_by" value="Phone" /> Phone</label>
        </fieldset>

	</fieldset>
    <br>
	<fieldset>
         <legend><h3>Projector Information.</h3></legend>
		 <p>
			Please fill out your projector information.<br />
			The more information you give us, the better we can help you.<br />
		</p>
		
		<div class="hdfrm">Service Details</div>
			
			  <label for="projector_type_repair">Type of Repair <span class="required">(required)</span></label>
				  	<select name="projector_type_repair" id="projector_type_repair" >
					    <option value="">- Select Type of Repair -</option>
						<option value="Out of Warranty Repair">Out of Warranty Repair</option>
						<option value="Preventive Maintenance">Preventive Maintenance</option>
						<option value="Lamp/Bulb Replacement">Lamp/Bulb Replacement</option>
					</select>
				
			  <label for="projector_brand">Projector Brand</label>
			  <input type="text" name="projector_brand" id="projector_brand" value="">
			  <label for="projector_model">Projector Model</label>
			  <input type="text" name="projector_model" id="projector_model" value="">
    		  <label for="projector_serial_number">Projector Serial Number</label>
			  <input type="text" name="projector_serial_number" id="projector_serial_number" value="" >

		
    </fieldset>
	
	<br>		
	<fieldset>
			 <legend> <h3>Service/Appointment Options</h3></legend>
				  <p>
				  Please let us know when you would like us to pick up your Projector
				  or when you would like to drop it off.<br />
			      </p>
				
				<div class="hdfrm">Appointments</div>
	
			 <label for="priority">Priority <span class="required">(required)</span></label>
				  	<select name="priority" id="priority" >
					    <option value="">- Select Level of Priority -</option>
						<option value="High">High</option>
						<option value="Medium">Medium</option>
						<option value="Low">Low</option>
					</select>
   
				<fieldset class="radio">
					<legend><label for="service_type">Service Type? <span class="required">(required)</span></label></legend>
					<label><input type="radio" name="service_type" id="service_type" value="Pickup" checked /> Pickup</label>
					<label><input type="radio" name="service_type" id="service_type" value="DropOff" /> Drop Off</label>
				</fieldset>

				<label for="appointment_date">Appointment date</label>
				<input type="text" name="appointment_date" id="appointment_date"  />

				<label for="additional_information">Additional Information</label>
				
				<textarea name="additional_information" id="additional_information"  rows="10" cols="70"> </textarea>
				

  				<div class="clr"></div>
		 </fieldset>


        <p><button type="submit" class="btnsubmit"></button></p>
   
	</form>