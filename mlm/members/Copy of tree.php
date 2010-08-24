<?php
include 'header.php';


if($_POST['submit'] != '')
{
	
	if(empty($_POST['user']) OR empty($_POST['refferal']))
	{
		$error = 'Please select Parent and enter username'; 
	}
	else
	{
	
		$root = $_POST['user'];
		$node = $_POST['refferal'];
		$result = mysql_query('SELECT vlft, rgt FROM tree '.  
                          'WHERE userid="'.$root.'";');  
   		$row = mysql_fetch_array($result); 
		
		$parentname = $row['username'];
		$rightval = $row['rgt'];
		
		$rightval = $rightval-1;
		$result = mysql_query('UPDATE tree SET rgt=rgt+2 WHERE rgt > '.$rightval.''); 
		$result = mysql_query('UPDATE tree SET lft=lft+2 WHERE lft > '.$rightval.'');  
   			
		$rightval = $row['rgt'];
		$left = $rightval;
		$right = $rightval+1;
		
		$result = "INSERT INTO tree (username,lft,rgt,parentid,parent) values('$node','$left','$right','$root','$parentname')";  
   		mysql_query($result);	
	}
}

function display_tree($root) 
{  
  
   // retrieve the left and right value of the $root node  
   $result = mysql_query('SELECT lft, rgt FROM tree '.  
                          'WHERE username="'.$root.'";');  
   $row = mysql_fetch_array($result);  
 
   // start with an empty $right stack  
   $right = array();  
 
   // now, retrieve all descendants of the $root node  
   $result = mysql_query('SELECT * FROM tree '.  
                          'WHERE lft BETWEEN '.$row['lft'].' AND '.  
                          $row['rgt'].' ORDER BY lft ASC;');  
 
 	$i=0;
   // display each row  
   while ($row = mysql_fetch_array($result)) 
   {  
     //echo $i;
	   // only check stack if there is one  
       if (count($right)>0) 
	   {  
           
		   // check if we should remove a node from the stack  
           while ($right[count($right)-1] < $row['rgt']) 
		   {  
              array_pop($right);  
           }  
  	  }  
 
	 //print_r($right);
	 // display indented node title  
	
	if($row['parentid'] == 1)
	{
		$color = "#00FF00";
	}
	else
	{
		 $color = "";
	}
	
	 echo "<tr bgcolor='$color'><td >";
	 
	 echo str_repeat('&nbsp______&nbsp;',count($right)).$row['username']."<br><br>";  
	 
	 echo '</td></tr>';

	
	
	
/* 	$parentval = $row['parentid'];
	if($i == 0 )
	{
		
	  	echo '<tr align=center colspan=11>
	  			<td >';
				echo $row['username'].'  </td></tr><tr align=center >
	  			'; 
	}	 
	elseif($i  >= 1 )
	{
		echo '<td >';
		echo $row['username'].''; 
		echo '</td>';
	}
	 



	
	$i++;  */

		 //(".$row['lft'].",".$row['rgt'].")
			
	
	   
	   // add this node to the stack  
       $right[] = $row['rgt'];  
	  //print_r($right);
   }  
}  

echo '<table width="100%" border="1" bgcolor="#FFFFFF" >';
echo display_tree('Fahd');

echo '</table>'; 


 function rebuild_tree($parent, $left) {   
   // the right value of this node is the left value + 1   
   $right = $left+1;   
  
   // get all children of this node   
   $result = mysql_query('SELECT username FROM tree '.   
                          'WHERE parent="'.$parent.'";');   
   while ($row = mysql_fetch_array($result)) {   
       // recursive execution of this function for each   
       // child of this node   
       // $right is the current right value, which is   
       // incremented by the rebuild_tree function   
       $right = rebuild_tree($row['username'], $right);  
   }   
  
   // we've got the left value, and now that we've processed   
   // the children of this node we also know the right value   
   mysql_query('UPDATE tree SET lft='.$left.', rgt='.   
                $right.' WHERE username="'.$parent.'";');   
  
   // return the right value of this node + 1   
   return $right+1;   
}   

//echo rebuild_tree('Food',1);




?>

<%@LANGUAGE="JAVASCRIPT" CODEPAGE="1252"%>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
</head>



<body>	
<br>

Select user and input name to insert: <font color="#FF0000"><? echo $error; ?></font>
<form name="frm1" method="post" action="">

<select name = 'user' id="user">
		<option value="">Select user</option>
		<option value="1">Food</option>
		<?php
		$result = '';
		$row = '';
		$result = mysql_query('SELECT * FROM tree');  
		$row = mysql_fetch_array($result); 
		
		
		while ($row = mysql_fetch_array($result)) 
		{
			echo "<option value = ".$row['userid'].">".$row['username']."</option>";
		}
		
		?>
</select>
.
<input name="refferal" type="text"  />
<input type="submit" name="submit" value="Submit"/>
</form>
</body>
</html>
