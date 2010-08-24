<?php

# ------------------------------------------------------------ #
// SIMPLEFORM CONFIGURATION								      //
# ------------------------------------------------------------ #

/* GENERAL CONFIGURATION
/////////////////////////////*/

// The name of the website/client. Example: "My Website".
$aSettings["szFrom"] = "Quote from ProjectorsMD+";						

// The email address that will receive the emails. Example: "me@myemail.com".
$aSettings["szRecipient"] = "jalalion@gmail.com,Tim@LaptopMD.com";	

/* The email address that will be used to send the emails. To work properly this has to be a real account
configured on the same server of the site. Example: "noreply@mywebsite.com". */
$aSettings["szFromEmail"] = "jalalion@gmail.com";					    

/* FORMS CONFIGURATION
/////////////////////////////*/

/* The next step is to configure the Form/s. 
   You can add as many as you want. */

$aForms = array(

	1 => array( 											// FORM ID
		"szFormTitle" => "Quote from ProjectorsMD+", 				// FORM TITLE
		"szFormURL" => "../quote.php",							// FORM URL ( users will be redirected to this page )
		"szFormRequired" => array(							/* REQUIRED FIELDS ( array of name attributes ) */
			"name",
			"email",
			"phone",
			"contact_me_by",
			"projector_type_repair",
			"priority",
			"service_type",
		),  
		"aFormFields" => array( 							/* LIST OF FORM FIELDS AND THEIR OUTPUT NAME
 													   		All input fields coming from the form should go here.
													   		The first value is the name attribute used and the second value
													   		on the right the name displayed on the outputed data.
															
															Any required field that contains the word "email" will have 
															its value validated as an email address. */
		   	"-sep1" => "Personal Information",
			
			"name" => "Full Name",					  
			"company" => "Company",
			"email" => "E-mail",						
					
			"-sep2" => "Address Information",
			
			"street" => "Street Address",
			"Apart" => "Apartment Number",
			"zip" => "Zip Code",

			"-sep3" => "Contact Information",
			
			"phone" => "Telephone",
			"altphone" => "Alternate Phone Number",
			"fax" => "Fax Number",
			"aolIM" => "AOL/IM",
			"contact_me_by" => "Contact Me By ?",
			
			"-sep4" => "Contact Information",
			
			
			"projector_type_repair" => "Type of Repair",
			"projector_brand" => "Projector Brand",
			"projector_model" => "Projector Model",
			"projector_serial_number" => "Projector Serial Number",
				
			
			"-sep5" => "Service/Appointment Options",
			
			"priority" => "Priority",
			"service_type" => "Service Type ?",
			"appointment_date" => "Appointment Date",
			"additional_information" => "Additional Information",

			
			"service_type" => "Service Type",
			
			// This is a separator. Any variable starting with the sign "-" will act as a content separator.
			
		
			
		
			/* add more */
			)
	),
	
2 => array(										
	"szFormTitle" => "Orders Form",
	"szFormRequired" => array("pname","pemail","size"),
	"szFormURL" => "multiple.php",
	"aFormFields" => array( 
		"pname" => "Product Name",
		"pemail" => "Email",
		"pphone" => "Telephone",
		"size" => "Size Selected",
		)
),
);

/* RESPONSE CONFIGURATION
/////////////////////////////*/

/* Response Messages: These are the variables that hold the messages 
the system prints as response. You can modify them to suit your project needs. */

$aSettings["aMessages"]["szSubmitSucess"]  = "Your message has been sent succesfully. Thanks!";
$aSettings["aMessages"]["szMissingFields"] = "Please complete all required fields.";
$aSettings["aMessages"]["szUnvalidEmail"]  = "Please insert a valid email address.";
$aSettings["aMessages"]["szSystemError"]   = "There was an error in the system. Please try again later. Thanks!";

/* ADVANCED CONFIGURATION
/////////////////////////////*/

define( "GET_NAME", "response");
define( "DEBUG_MODE" , false );
define( "CHECK_EMAIL_ADDRESS_DNS" , false ); 
?>