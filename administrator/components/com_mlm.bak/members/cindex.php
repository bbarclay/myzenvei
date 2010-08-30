<?php ob_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Reports Section</title>
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
<script language="javascript" src="mlm_z_js/javaformfunctions.js"></script>
<script type="text/javascript" src="mlm_z_js/jquery.checkbox.min.js"></script>
<script language="javascript" src="mlm_z_js/jquery.pop.js" type="text/javascript"></script>  
<script type="text/javascript" src="mlm_z_js/jquery.datepick.js"></script>
<script type="text/javascript" src="mlm_z_js/checkboxfunctions.js"  ></script>
<script type="text/javascript" src="mlm_z_js/jquery-ui-1.8.1.custom.min.js"  ></script>
<script>
	$(function() {
		$(".datepicker").datepicker();
	});
</script>



		<script type="text/javascript" charset="utf-8" src="media/js/jquery.dataTables.js"></script>
		<script type="text/javascript" charset="utf-8" src="media/ZeroClipboard/ZeroClipboard.js"></script>
		<script type="text/javascript" charset="utf-8" src="media/js/TableTools.js"></script>
        <script type="text/javascript" charset="utf-8" src="media/js/FixedHeader.js"></script>
		<script type="text/javascript" charset="utf-8">
			$(document).ready( function () {
				/* You might need to set the sSwfPath! Something like:
				 *   TableToolsInit.sSwfPath = "/media/swf/ZeroClipboard.swf";
				 */
				$('#example').dataTable( {
					"sDom": 'T<"clear">lfrtip'
				} );
			} );
		</script>
        



</head>

<body>

<?php include 'mlm_z_tableData.php';?>
</body>
</html>
<?php ob_end_flush(); ?>