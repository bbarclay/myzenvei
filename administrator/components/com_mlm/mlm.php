<?php
defined( '_JEXEC' ) or die( 'Restricted access' );	
	
	$task = $_GET['page'];
	
	//$dynamic_link = 'http://localhost/Brandons/site';
	$dynamic_link = 'http://www.myzenvei.com';
	
	include('members/settings.inc');
	$id = 63;
	include('members/graph_custom_functions.php');
	include('fisheye/index.html');
	
	switch( $task )
	{
	
		case 'main':
		
		include 'members/main.php';
		break;
		
		case 'view_profile':
		
		include 'members/view_profile.php';
		break;
			
		case 'active_de_active_members':
		
		include 'members/active_de_active_members.php';
		break;
		
		case 'view_personally_enrolled':
		
		include 'members/view_personally_enrolled.php';
		break;
		
		case 'view_mem_cust':
		
		include 'members/view_mem_cust.php';
		break;
		
		case 'view_geneology':
		
		include 'members/view_geneology.php';
		break;

		case 'view_geneology_graph_simple':
		include 'members/view_geneology_graph_simple.php';
		break;
		
		case 'view_geneology_graph':
		header("Location: ".$dynamic_link."/components/com_mlm/members/view_geneology_graph.php");
		//include 'members/view_geneology_graph.php';
		break;
		
		case 'view_orders':
		
		include 'members/view_orders.php';
		break;
		
		case 'view_volume_carry_over':
		
		include 'members/view_volume_carry_over.php';
		break;
		
		case 'view_commisions':
		
		include 'members/view_commisions.php';
		break;
		
		case 'view_earnings':
		header("Location: ".$dynamic_link."/administrator/components/com_mlm/members/cindex.php?drill_date=".$_GET['drill_date']."");
		//include 'members/cindex.php';
		break;
		
		case 'view_reports':
		header("Location: ".$dynamic_link."/administrator/components/com_mlm/members/reports/index.php");
		//include 'members/reports/index.php';
				
		break;
		
		
		case 'view_reports_archieves':
		include 'members/view_reports_archieves.php';
				
		break;

		case 'billing':
	
		header("Location: ".$dynamic_link."/administrator/components/com_mlm/members/billing_index.php");	
		break;
		
		case 'logout':
		include 'members/index.php';
		break;
			
		
		default:
		
		include 'members/main.php';
		break;
	}
?>