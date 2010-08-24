<?php
defined( '_JEXEC' ) or die( 'Restricted access' );	
	include('admin/settings.inc');
	$task = $_GET['page'];
	
	switch( $task )
	{
	
		case 'main':
		include 'admin/main.php';
		break;
		
		case 'view_profile':
		include 'admin/view_profile.php';
		break;
			
		case 'active_de_active_members':
		include 'admin/active_de_active_members.php';
		break;
		
		case 'view_personally_enrolled':
		include 'admin/view_personally_enrolled.php';
		break;
		
		case 'view_mem_cust':
		include 'admin/view_mem_cust.php';
		break;
		
		case 'view_geneology':
		include 'admin/view_geneology.php';
		break;
		
		
		case 'view_geneology_graph':
		include 'admin/view_geneology_graph.php';
		break;
		
		case 'view_orders':
		include 'admin/view_orders.php';
		break;
		
		case 'view_volume_carry_over':
		include 'admin/view_volume_carry_over.php';
		break;
		
		case 'view_commisions':
		include 'admin/view_commisions.php';
		break;
		
		case 'view_earnings':
		include 'admin/view_earnings.php';
		break;
		
		case 'logout':
		include 'admin/index.php';
		break;
			
		
		default:
		include 'admin/main.php';
		break;
	}
?>