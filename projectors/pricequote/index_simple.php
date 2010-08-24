
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
		
		<legend>Personal Details:</legend>
        <label for="name" >Name</label>
        <input name="name" id="name" type="text" value="" />
        
		
		<label for="email">Email <span class="required">(required)</span></label>
        <input name="email" id="email" type="text" value="" />
		
		<label for="phone">Telephone <span class="required">(required)</span></label>
        <input name="phone" id="phone" type="text" value="" />

        </fieldset>


        <p><button type="submit">Submit this!</button></p>
    </form>

				
				
				
		