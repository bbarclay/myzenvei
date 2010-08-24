<?php
	
	$jspath = JPATH_ROOT . DS . 'components' . DS . 'com_community';
	include_once($jspath. DS . 'libraries' . DS . 'core.php');
 
	// Get CUser object
	$user  = CFactory::getUser( $userid );
	$name  = $user->getDisplayName();
	
	echo '<span>Welcome : ' . $name . '</span><br>';
	$id = $user->id;
	 
	echo $id;

?>
<table width="98%" border="0">
  <tr align="right">
    <td>

<?php	



	$query = "SELECT shopperid FROM mlm_geneology_tree where userid= '$id'"; 
    $result = mysql_query($query); 
  	$numrows =  mysql_num_rows($result);
	
	$row = mysql_fetch_array($result);
	

	$shopperid = $row['shopperid'];
					
	if($shopperid == 8)
	{
		echo '<span><Font color=green>Business Associate</font></span>';
	}
	elseif($shopperid == 6)
	{
		echo '<span><Font color=red>Marketing Associate</font></span>';
	}
	else
	{
		echo '<span><Font color=red>No Autoship</font></span>';
	}
?>

	</td>
  </tr>
</table>
