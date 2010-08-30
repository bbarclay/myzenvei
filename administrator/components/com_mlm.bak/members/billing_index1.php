<?php include ("settings.inc");
ob_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Billing</title>
<style type="text/css">@import "css/jquery.datepick.css";</style>
<!--<link rel="stylesheet" href="css/jquery.safari-checkbox.css" />-->
<link rel="stylesheet" type="text/css" href="mlm_z_css/layout.css" />
<link rel="stylesheet" href="mlm_z_css/jquery.checkbox.css" />   
<link rel="stylesheet" href="mlm_z_css/jquery-ui-1.8.1.custom.css" />

<style type="text/css" title="currentStyle">
			@import "media/css/demo_page.css";
			@import "media/css/demo_table.css";
			@import "media/css/TableTools.css";
			.FixedHeader_Cloned th { background-color: white; }
			
		</style>


<script type="text/javascript" src="mlm_z_js/jquery-latest.pack.js" language="javascript"></script>

<script type="text/javascript" src="mlm_z_js/jquery.checkbox.min.js"></script>
<script language="javascript" src="mlm_z_js/jquery.pop.js" type="text/javascript"></script>  
<script type="text/javascript" src="mlm_z_js/jquery.datepick.js"></script>
<script type="text/javascript" src="mlm_z_js/checkboxfunctions.js"  ></script>
<script type="text/javascript" src="mlm_z_js/jquery-ui-1.8.1.custom.min.js"  ></script>
<script>
	//$(function() {
	//	$(".datepicker").datepicker();
	//});
</script>



		<script type="text/javascript" charset="utf-8" src="media/js/jquery.dataTables.js"></script>
		<script type="text/javascript" charset="utf-8" src="media/ZeroClipboard/ZeroClipboard.js"></script>
		<script type="text/javascript" charset="utf-8" src="media/js/TableTools.js"></script>
        <script type="text/javascript" charset="utf-8" src="media/js/FixedHeader.js"></script>
        <script src="../../../../scripts/jquery.js" type="text/javascript"></script>
		<script src="../../../../scripts/jquery.form.js" type="text/javascript"></script>
        <link rel="stylesheet" href="../../../../scripts/datepicker.css" type="text/css" />
		<script type="text/javascript" src="../../../../scripts/datepicker.js"></script>
		<script type="text/javascript" src="../../../../scripts/eye.js"></script>
		<script type="text/javascript" src="../../../../scripts/utils.js"></script>
		<script type="text/javascript" src="../../../../scripts/layout.js?ver=1.0.2"></script>
		<script type="text/javascript" charset="utf-8">
			$(document).ready( function () {
				/* You might need to set the sSwfPath! Something like:
				 *   TableToolsInit.sSwfPath = "/media/swf/ZeroClipboard.swf";
				 */
				//$('#example').dataTable( {
				//	"sDom": 'T<"clear">lfrtip'
				//} );

				//alert("ready");
				$('#regfee_fdate').DatePicker({
				format:'m/d/Y',
				date: $('#regfee_fdate').val(),
				current: $('#regfee_fdate').val(),
				starts: 1,
				position: 'r',
				onBeforeShow: function(){
					$('#regfee_fdate').DatePickerSetDate($('#regfee_fdate').val(), true);
				},
				onChange: function(formated, dates){
					$('#regfee_fdate').val(formated);
					if ($('#closeOnSelect input').attr('checked')) {
						$('#regfee_fdate').DatePickerHide();
					}
				}
			});


			$('#regfee_ndate').DatePicker({
				format:'m/d/Y',
				date: $('#regfee_ndate').val(),
				current: $('#regfee_ndate').val(),
				starts: 1,
				position: 'r',
				onBeforeShow: function(){
					$('#regfee_ndate').DatePickerSetDate($('#regfee_ndate').val(), true);
				},
				onChange: function(formated, dates){
					$('#regfee_ndate').val(formated);
					if ($('#closeOnSelect input').attr('checked')) {
						$('#regfee_ndate').DatePickerHide();
					}
				}
			});
				
			} );
		</script>
        



</head>

<body>

<?php include 'billing_details.php';?>
</body>
</html>
<?php ob_end_flush(); ?>