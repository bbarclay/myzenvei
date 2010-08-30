<?php
//include("settings.inc");
//calculate_commisions(63);


//monis


function calculate_commisions($root)
{

  
   // retrieve the left and right value of the $root node  
   $result = mysql_query('SELECT lft, rgt,shopperid FROM mlm_geneology_tree '.  
                          'WHERE userid="'.$root.'";');  
   
   $row = mysql_fetch_array($result);  
 	$total_com=0;
   $right = $row['rgt'];
   $left = $row['lft'];
  
  if($row['shopperid']==6)
   $loop=4;
   elseif($row['shopperid']==8)
   $loop=9;
	
 // echo $descendants = ( (($right - $left) - 1) / 2 );
   
   // start with an empty $right stack  
   $right = array();  
$fast_sum=0;
   // now, retrieve all descendants of the $root node  
   $result = mysql_query('SELECT * FROM mlm_geneology_tree as a,jos_vm_user_info as b '.  
                          'WHERE lft BETWEEN '.$row['lft'].' AND '.  
                          $row['rgt'].' and  b.user_id=a.userid');  
   $i=0;

   while (($row = @mysql_fetch_array($result)) && ($row['level'] <=$loop)) 
   {  
	if($row['status'])
	{
       if (count($right)>0) 
	   {  
           
		     
           while ($right[count($right)-1] < $row['rgt']) 
		   {  
              array_pop($right);  
           }  
  	  }  
 
		
		if($row['parentid'] != 0 )
		{
			echo '<br>';//.$row['parentid'];
			   
				if($row['level'] == 1)   /* For level 1 we have 3 persons */
				{
					
					$arr=fast_start_bonus($row['userid']);
					$order_amount = $arr[order_total];
					$commission_total = $order_amount*.1 ; 
					$fast_sum=$arr[com];
				}
				
				elseif($row['level']>1 && $row['level']<=9)
				{

					$arr=fast_start_bonus($row['userid']);
					$order_amount = $arr[order_total];
					$commission_total = $order_amount*.3 ; 
				}
				$match=matching_fast_start_bonus($row['userid']);
				/* Fast start Calculation : Start*/
				
				$fast_start = ($order_amount  * 25) / 100 ;
				$fast_start .= ' $'; 
			
				/* Fast start Calculation : End*/
			$match_c=match_com($row['parent']);
			$insert ="INSERT INTO mlm_generate_report SET
					   
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
                       `status_date`		=	'".$row['datejoining']."',                    
                       `phone_numbner`		=	'".$row['phone_1'].'/'.$row['phone_2']."',                  
                       `payment_status`		=	'paid'                
						";
			mysql_query($insert);
			/*	
			
				echo '<tr >
						 <td>-'.$row['userid'].'-----</td>
						 <td>-'.$row['parentid'].'-----</td>
						 <td>-'.$row['username'].'-----</td>
						 <td>'.$row['parent'].'-----</td>
						 <td>'.$row['level'].'-----</td>
						 <td>'.$order_amount.'$-----</td>
						 <td>20-05-2010</td>
						 <td>'.$fast_start.'-----</td>
						 <td>'.$commission_percentage.' = '.$commission_total.'-----</td>
						 <td>'. $total_com.'-----</td>
						 <td>'.$fast_sum.'</td>
						 <td></td>
						 <td></td>
						 <td></td>
						 <td></td>
						 <td></td>
						 <td></td>
					</tr>';
					*/
			  // $total_com+=$commission_total;
   		}
		
	$right[] = $row['rgt'];  
	$i++;
   }
   }
  // $arra[total_com]=$total_com;
   //$arra[fast_sum]=$fast_sum;
 //return $arra;
} 
function fast_start_bonus($child)
{
$parent_query=
			"
			SELECT parentid,shopperid
			FROM mlm_geneology_tree
			WHERE userid=$child
			LIMIT 1
			";
$parent_table=mysql_query($parent_query);
if(mysql_affected_rows()==1)
{
$parent_row=mysql_fetch_array($parent_table);

	if($parent_row[shopperid]==6)
	{
	$q=
		"
			Select order_total
			FROM jos_vm_orders
			WHERE user_id=$child
		";
	}
	elseif($parent_row[shopperid]==8)
	{
	$q=
		"
		SELECT order_total
		FROM jos_vm_orders
		WHERE user_id=(
						SELECT user_id
						FROM jos_vm_orders
						GROUP BY user_id
						HAVING sum(order_total)>128
						AND user_id=$child
					  )
		ORDER BY order_id
		DESC
		";
	}
	$table=mysql_query($q);
	if(mysql_affected_rows()==1)
	{
	$row=mysql_fetch_array($table);
	$com['order_total']=$row[order_total];
	$com['com']=.25*$row[order_total];
	
	if($com>0)
	return $com;
	else return array('order_total'=>0,'com'=>0);

	}
}
}
function matching_fast_start_bonus($child)
{
$parent_query=
			"
			SELECT parentid,shopperid
			FROM mlm_geneology_tree
			WHERE userid=$child
			LIMIT 1
			";
$parent_table=mysql_query($parent_query);
if(mysql_affected_rows()==1)
{
$parent_row=mysql_fetch_array($parent_table);

	if($parent_row[shopperid]==6)
	{
	$q=
		"
			Select sume(order_total)
			FROM jos_vm_orders
			WHERE user_id=$child
		";
	}
	elseif($parent_row[shopperid]==8)
	{
	$q=
		"
		SELECT sum(order_total) as sum
		FROM jos_vm_orders
		WHERE user_id=(
						SELECT user_id
						FROM jos_vm_orders
						GROUP BY user_id
						HAVING sum(order_total)>128
						AND user_id=$child
					  )
		ORDER BY order_id
		DESC
		";
	}

	$table=mysql_query($q);
	if(mysql_affected_rows()>0)
	{
	$row=mysql_fetch_array($table);
	$com=$row[sum];

	if($com>0)
	return $com;
	else return 0;

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
	$com=$row[sum];

	if($com>0)
	return $com;
	else return 0;

	}

}

?>