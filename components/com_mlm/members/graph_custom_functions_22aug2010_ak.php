<?php
ob_start();
include("settings.inc");

function rebuild_tree($parent, $left) 
{   
   // the right value of this node is the left value + 1   
   $right = $left+1;   
   // get all children of this node   
  
   $result = mysql_query('SELECT username FROM mlm_geneology_tree '.   
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
   mysql_query('UPDATE mlm_geneology_tree SET lft='.$left.', rgt='.   
                $right.' WHERE username="'.$parent.'";');   
  
   // return the right value of this node + 1   
   return $right+1;    
}   


function display_tree($root) 
{  
  
   // retrieve the left and right value of the $root node  
   $result = mysql_query('SELECT lft, rgt FROM mlm_geneology_tree '.  
                          'WHERE username="'.$root.'";');  
   $row = mysql_fetch_array($result);  
 
   // start with an empty $right stack  
   $right = array();  
 
   // now, retrieve all descendants of the $root node  
   $result = mysql_query('SELECT * FROM mlm_geneology_tree '.  
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
	 
	 echo str_repeat('&nbsp______&nbsp;',count($right)).$row['username']."(".$row['lft'].",".$row['rgt'].")";  
	 
	 echo '</td></tr>';
		// add this node to the stack  
       $right[] = $row['rgt'];  
	  //print_r($right);
   }  
}  

function insert_node($root,$node,$newuser_id,$user_cookie,$shoppergroup)
{
		global $level2;
 		$level2++;
		
		$result = mysql_query("SELECT username,lft, rgt FROM mlm_geneology_tree WHERE userid='$root'");  
   		$row = mysql_fetch_array($result); 
		
		$parentname = $row['username'];
		$rightval = $row['rgt'];
		
		$rightval = $rightval-1;
		$result = mysql_query("UPDATE mlm_geneology_tree SET rgt=rgt+2 WHERE rgt > '$rightval' and spon_parent_id = '$root'"); 
		$result = mysql_query("UPDATE mlm_geneology_tree SET lft=lft+2 WHERE lft > '$rightval' and spon_parent_id = '$root'");  
   			
		$rightval = $row['rgt'];
		$left = $rightval;
		$right = $rightval+1;
		$query2 = "SELECT * FROM mlm_geneology_tree where parentid= '$root'"; 
     	$result2 = mysql_query($query2); 
  		$numrows =  mysql_num_rows($result2);
  		if($numrows ==0){$v_position ='L';}
  		if($numrows ==1){$v_position='M';}
  		if($numrows  ==2){$v_position='R';}
  		
		$level2 = $level2 - 1;
		 $result = "INSERT INTO mlm_geneology_tree "." 
						( userid, username , lft     ,  rgt      "."
						, parentid  ,  parent,spon_parent_id,level, shopperid ,position,datejoining,	status) "."
				  
				  values( '$newuser_id' ,'$node'  , '$left' , '$right'  "."
							,  '$root'  , '$parentname','$user_cookie','$level2','$shoppergroup' , '$v_position' ,now() , '1')";  
   					mysql_query($result);
					return 1;
}
// finding where to place the new node
$id2 = 0;
$level2 = -1;

function scan4place($root,$level)
{
	global $id2 , $level2;
	$query = "SELECT * FROM mlm_geneology_tree where parentid = '$root'"; 
	$result = mysql_query($query);
	$numrows =  mysql_num_rows($result);
	
	if($numrows < 3 )
	{
			if ($level2 == -1)
			{
				//echo $root." ".$level." ".$id2. " ".$level2."<br/>";
				$id2=$root;
				$level2=$level;
				
				
			}
			
			else if($level < $level2) 
			{
				//echo $root." ".$level." ".$id2. " ".$level2."<br/>";
				$id2=$root;
				$level2=$level;
			}
			
	}
		
	if($numrows == 3 )
	{	
			//echo "-";
			$level++;
			while ($row = mysql_fetch_array($result)){
		    $root = $row['userid'];
			//echo $row['parentid']."<br/>";
			scan4place($root,$level);
	}
}
	
return 1;
}





//monis

function calculate_commisions($root)
{

   //echo 'in';
   // retrieve the left and right value of the $root node  
  $result = mysql_query("SELECT lft, rgt,shopperid FROM mlm_geneology_tree WHERE userid='$root'");  
   
   $row = mysql_fetch_array($result);  
   $total_com=0;
   $right = $row['rgt'];
   $left = $row['lft'];
  
  if($row['shopperid']==6)
  	 $loop=4; // marketing associate
   elseif($row['shopperid']==8)
   	$loop=9; // business associate
	
 // echo $descendants = ( (($right - $left) - 1) / 2 );
   
   // start with an empty $right stack  
   $right = array();  
	$fast_sum=0;
   // now, retrieve all descendants of the $root node  
                            
 $result = mysql_query("SELECT a.* FROM mlm_geneology_tree as a,jos_vm_user_info as b WHERE  b.user_id=a.userid and spon_parent_id='$root'");  
  $i=0;
	
   while (($row = mysql_fetch_array($result))) 
   {  
   	if($row['level'] <=$loop)
   	{
		if($row['status'])
		{
	     /*  if (count($right)>0) 
		   {        
			   
	           while ($right[count($right)-1] < $row['rgt']) 
			   {  
	              array_pop($right);  
	           }  
	  	  }  
	     */
			
			if($row['parentid'] != 0 )
			{
				//echo '<br>';//.$row['parentid'];
				   
					if($row['level'] == 1)   /* For level 1 we have 3 persons */
					{
						
						$arr=fast_start_bonus($row['userid']);
						$order_amount = $arr['order_total'];
						$commission_total = $order_amount*.1 ; 
						$fast_sum=$arr[com];
					}
					
					else
					
					if($row['level']>1 )// && $row['level']<=9)
					{
	
						$arr=fast_start_bonus($row['userid']);
						$order_amount = $arr['order_total'];
						$commission_total = $order_amount*.3 ; 
					}
					
					$match=matching_fast_start_bonus($row['userid']);
					/* Fast start Calculation : Start*/
					//$fast_start = ($order_amount  * 25) / 100 ;
					//$fast_start .= ' $'; 
				
					/* Fast start Calculation : End*/
					$match_c=match_com($row['parent']);
					$insert=
							"
							INSERT INTO mlm_generate_report
							SET
						   `associate_name` 	= 	'".$row['username']."' ,                 
	                       `sponsored_person`	=	'".$row['parent']."',               
	                       `level`				=	'".$row['level']."',                          
	                       `fast_start`			=	'".$fast_sum."',                     
	                       `commissions`		=	'".$commission_total."',                    
	                       `preferred`			=	'',                      
	                       `fast_match`			=	'".$match."',                     
	                       `commission_match`	=	'".$match_c."',               
	                       `preferred_match`	=	'',                
	                       `associate_status`	=	'".$row['status']."',               
	                       `status_date`		=	now(),                    
	                       `phone_numbner`		=	'".$row['phone_1'].'/'.$row['phone_2']."',                  
	                       `payment_status`		=	'Unpaid'                
							";
							mysql_query($insert) or mysql_errno();
				
				}
		
			$right[] = $row['rgt'];  
			$i++;
		}
    }
   
   }

 } 
function fast_start_bonus($child)
{
	 $parent_query=
			"
			SELECT parentid,shopperid
			FROM mlm_geneology_tree
			WHERE userid='$child'
			LIMIT 1
			";
$parent_table=mysql_query($parent_query);
if(mysql_affected_rows()==1)
{
$parent_row=mysql_fetch_array($parent_table);

	if($parent_row['shopperid']==6)
	{
	$q=
		"
			Select order_total
			FROM jos_vm_orders
			WHERE user_id='$child'
		";
	}
	else
	if($parent_row['shopperid']==8)
	{
	/* $q=
		"
		SELECT order_total
		FROM jos_vm_orders
		WHERE user_id=(
						SELECT user_id
						FROM jos_vm_orders
						GROUP BY user_id
						HAVING sum(order_total)>128
						AND user_id='$child'
					  )
		ORDER BY order_id
		DESC
		";
*/
	 $q =	"SELECT order_total
		FROM jos_vm_orders
		WHERE user_id='$child'";
		
	}
	
	$table=mysql_query($q);
	if(mysql_affected_rows()==1)
	{
		$row=mysql_fetch_array($table);
		$com['order_total']=$row['order_total'];
		$com['com']=.25*$row['order_total'];
		
	
	if($com>0)
		return $com;
	else 
		return array('order_total'=>0,'com'=>0);

	}
}

}
function matching_fast_start_bonus($child)
{
$parent_query=
			"
			SELECT parentid,shopperid
			FROM mlm_geneology_tree
			WHERE userid='$child'
			LIMIT 1
			";
$parent_table=mysql_query($parent_query);
if(mysql_affected_rows()==1)
{
$parent_row=mysql_fetch_array($parent_table);

	if($parent_row['shopperid']==6)
	{
	$q=
		"
			Select sume(order_total)
			FROM jos_vm_orders
			WHERE user_id='$child'
		";
	}
	elseif($parent_row['shopperid']==8)
	{
	$q=
		"
		SELECT sum(order_total) as sum
		FROM jos_vm_orders
		WHERE user_id='$child'"; /*(
						SELECT user_id
						FROM jos_vm_orders
						GROUP BY user_id
						HAVING sum(order_total)>128
						AND user_id=$child
					  )
		ORDER BY order_id
		DESC
		";*/
	}

	$table=mysql_query($q);
	if(mysql_affected_rows()>0)
	{
		$row=mysql_fetch_array($table);
		$com=$row['sum'];

	if($com>0)
		return $com;
	else 
		return 0;

	}
}
}
function match_com($child)
{

	$q=
		"
			Select sum(commissions) as sum
			FROM mlm_generate_report
			WHERE sponsored_person='$child'
		";
	$table=mysql_query($q);
	if(mysql_affected_rows()>0)
	{
		$row=mysql_fetch_array($table);
		$com=$row['sum'];

	if($com>0)
		return $com;
	else 
		return 0;

	}

}

?>