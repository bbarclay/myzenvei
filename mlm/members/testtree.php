<?php
include 'header.php';

function show_hierarchy_3()
{ 
	$query = "SELECT * FROM treetest WHERE L1!=0  ORDER BY L1, L2, L3 , L4, L5, L6,L7, L8, L9"; 
	$result = mysql_query($query); 
	echo '<br>';
	while ($row = mysql_fetch_array($result))
	{   
		
		$level = -1;   
		if ($row['L1'] != '0' )
		{ 
			$level = $level + 1; 
		}   
		
		if ($row['L2'] != '0' )
		{ 
			$level = $level + 1; 
		}   
		
		if ($row['L3'] != '0' )
		{ 
			$level = $level + 1; 
		}   
		if ($row['L4'] != '0' )
		{ 
			$level = $level + 1; 
		}   
		if ($row['L5'] != '0' )
		{ 
			$level = $level + 1; 
		}   
		
		if ($row['L6'] != '0' )
		{ 
			$level = $level + 1; 
		}   
		if ($row['L7'] != '0' )
		{ 
			$level = $level + 1; 
		}   
		if ($row['L8'] != '0' )
		{ 
			$level = $level + 1; 
		}   
		if ($row['L9'] != '0' )
		{ 
			$level = $level + 1; 
		}   
		
		
		
		
		/* $tracking = '(' . $row['L1'].'.' .$row['L2'].'.' .$row['L3'] .'.' .$row['L4'] .'.' .$row['L5'] .'.' .$row['L6'] .'.' .$row['L7'] .'.' .$row['L8'] .'.' .$row['L9'] . ')'; */
		
		echo str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',$level); 
			
		echo $row['username'].'&nbsp;'.$tracking; 
		
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color=red>(Level $level)</font>".'&nbsp;';
		
		echo "<br><br><br>";   
	} 
}

echo show_hierarchy_3();
//http://www.alandelevie.com/2008/07/12/recursion-less-storage-of-hierarchical-data-in-a-relational-database/#ixzz0mOPhvafg

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<!--<table width="100%" border="0">
  <tr>
    <td width="11%">&nbsp;</td>
    <td width="11%">&nbsp;</td>
    <td width="20%">&nbsp;</td>
    <td width="18%" align="center">khan</td>
    <td width="18%">&nbsp;</td>
    <td width="11%">&nbsp;</td>
    <td width="11%">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center">User 1 </td>
    <td align="center">User 2 </td>
    <td align="center">User 3 </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table> -->
</body>
</html>
