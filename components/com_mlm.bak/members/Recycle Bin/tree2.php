<?php include 'db_connect_124.inc';

$rootid = $_REQUEST['id'];

if($rootid == "")
{
	$rootid = 1;
}


   // retrieve the left and right value of the $root node  
   $result = mysql_query('SELECT userid FROM tree '.  
                          'WHERE parentid="'.$rootid.'";');  

  // first level child
	$ctr = 1;
	$node1 = -1;
	$node2 = -1;
	$node3 = -1;
   while ($row = mysql_fetch_array($result))
	{
	   if($ctr == 1)
		{
		  $node1 = $row['userid'];
		}
	   if($ctr == 2)
		{
			$node2 = $row['userid'];
		}
	   if($ctr == 3)
		{
		   $node3 = $row['userid'];
		}

		$ctr = $ctr + 1;
	}

//second level child tha is node 1
    $ctr = 4;
	$node4 = -1;
	$node5 = -1;
	$node6 = -1;
	if($node1 != -1)
	{
		$node1_res = mysql_query("select userid from tree where parentid='".$node1."'");

		while($node1_row = mysql_fetch_array($node1_res))
		{
			if($ctr == 4)
			{
				$node4 = $node1_row['userid'];
			}
			if($ctr == 5)
			{
				$node5 = $node1_row['userid'];
			}
			if($ctr == 6)
			{
				$node6 = $node1_row['userid'];
			}
			$ctr = $ctr + 1 ;
		}
	}

//second level of node 2
	$ctr = 7;
	$node7 = -1;
	$node8 = -1;
	$node9 = -1;
	if($node2 != -1)
	{
		$node2_res = mysql_query("select userid from tree where parentid='".$node2."'");

		while($node2_row = mysql_fetch_array($node2_res))
		{
			if($ctr == 7)
			{
				$node7 = $node2_row['userid'];
			}
			if($ctr == 8)
			{
				$node8 = $node2_row['userid'];
			}
			if($ctr == 9)
			{
				$node9 = $node2_row['userid'];
			}

			$ctr = $ctr+1;
		}

	}

//second level of node 3
	$ctr = 10;
	$node10 = -1;
	$node11 = -1;
	$node12 = -1;

	if($node3 != -1)
	{
		$node3_res = mysql_query("select userid from tree where parentid='".$node3."'");

		while($node3_row = mysql_fetch_array($node3_res))
		{
			if($ctr == 10)
			{
				$node10 = $node3_row['userid'];
			}
			if($ctr == 11)
			{
				$node11 = $node3_row['userid'];
			}
			if($ctr == 12)
			{
				$node12 = $node3_row['userid'];
			}
			$ctr = $ctr + 1;
		}
	}

//level 3 node 4
$ctr = 13;
	$node13 = -1;
	$node14 = -1;
	$node15 = -1;

	if($node4 != -1)
	{
		$node3_res = mysql_query("select userid from tree where parentid='".$node4."'");

		while($node3_row = mysql_fetch_array($node3_res))
		{
			if($ctr == 13)
			{
				$node13 = $node3_row['userid'];
			}
			if($ctr == 14)
			{
				$node14 = $node3_row['userid'];
			}
			if($ctr == 15)
			{
				$node15 = $node3_row['userid'];
			}
			$ctr = $ctr + 1;
		}
	}

//level 3 node 5
$ctr = 16;
	$node16 = -1;
	$node17 = -1;
	$node18 = -1;

	if($node5 != -1)
	{
		$node3_res = mysql_query("select userid from tree where parentid='".$node5."'");

		while($node3_row = mysql_fetch_array($node3_res))
		{
			if($ctr == 16)
			{
				$node16 = $node3_row['userid'];
			}
			if($ctr == 17)
			{
				$node17 = $node3_row['userid'];
			}
			if($ctr == 18)
			{
				$node18 = $node3_row['userid'];
			}
			$ctr = $ctr + 1;
		}
	}
//level 3 node 6
$ctr = 19;
	$node19 = -1;
	$node20 = -1;
	$node21 = -1;

	if($node6 != -1)
	{
		$node3_res = mysql_query("select userid from tree where parentid='".$node6."'");

		while($node3_row = mysql_fetch_array($node3_res))
		{
			if($ctr == 19)
			{
				$node19 = $node3_row['userid'];
			}
			if($ctr == 20)
			{
				$node20 = $node3_row['userid'];
			}
			if($ctr == 21)
			{
				$node21 = $node3_row['userid'];
			}
			$ctr = $ctr + 1;
		}
	}
	
	
//level 3 node 7
$ctr = 22;
	$node22 = -1;
	$node23 = -1;
	$node24 = -1;

	if($node7 != -1)
	{
		$node3_res = mysql_query("select userid from tree where parentid='".$node7."'");

		while($node3_row = mysql_fetch_array($node3_res))
		{
			if($ctr == 22)
			{
				$node22 = $node3_row['userid'];
			}
			if($ctr == 23)
			{
				$node23 = $node3_row['userid'];
			}
			if($ctr == 24)
			{
				$node24 = $node3_row['userid'];
			}
			$ctr = $ctr + 1;
		}
	}	

//level 3 node 8
$ctr = 25;
	$node25 = -1;
	$node26 = -1;
	$node27 = -1;

	if($node8 != -1)
	{
		$node3_res = mysql_query("select userid from tree where parentid='".$node8."'");

		while($node3_row = mysql_fetch_array($node3_res))
		{
			if($ctr == 25)
			{
				$node25 = $node3_row['userid'];
			}
			if($ctr == 26)
			{
				$node26 = $node3_row['userid'];
			}
			if($ctr == 27)
			{
				$node27 = $node3_row['userid'];
			}
			$ctr = $ctr + 1;
		}
	}	
//level 3 node 9
$ctr = 28;
	$node28 = -1;
	$node29 = -1;
	$node30 = -1;

	if($node9 != -1)
	{
		$node3_res = mysql_query("select userid from tree where parentid='".$node9."'");

		while($node3_row = mysql_fetch_array($node3_res))
		{
			if($ctr == 28)
			{
				$node28 = $node3_row['userid'];
			}
			if($ctr == 29)
			{
				$node29 = $node3_row['userid'];
			}
			if($ctr == 30)
			{
				$node30 = $node3_row['userid'];
			}
			$ctr = $ctr + 1;
		}
	}	

//level 3 node 10
$ctr = 31;
	$node31 = -1;
	$node32 = -1;
	$node33 = -1;

	if($node10 != -1)
	{
		$node3_res = mysql_query("select userid from tree where parentid='".$node10."'");

		while($node3_row = mysql_fetch_array($node3_res))
		{
			if($ctr == 31)
			{
				$node31 = $node3_row['userid'];
			}
			if($ctr == 32)
			{
				$node32 = $node3_row['userid'];
			}
			if($ctr == 33)
			{
				$node33 = $node3_row['userid'];
			}
			$ctr = $ctr + 1;
		}
	}
	
//level 3 node 11
$ctr = 31;
	$node31 = -1;
	$node32 = -1;
	$node33 = -1;

	if($node10 != -1)
	{
		$node3_res = mysql_query("select userid from tree where parentid='".$node10."'");

		while($node3_row = mysql_fetch_array($node3_res))
		{
			if($ctr == 31)
			{
				$node31 = $node3_row['userid'];
			}
			if($ctr == 32)
			{
				$node32 = $node3_row['userid'];
			}
			if($ctr == 33)
			{
				$node33 = $node3_row['userid'];
			}
			$ctr = $ctr + 1;
		}
	}
//level 3 node 11
$ctr = 34;
	$node34 = -1;
	$node35 = -1;
	$node36 = -1;

	if($node11 != -1)
	{
		$node3_res = mysql_query("select userid from tree where parentid='".$node11."'");

		while($node3_row = mysql_fetch_array($node3_res))
		{
			if($ctr == 34)
			{
				$node34 = $node3_row['userid'];
			}
			if($ctr == 35)
			{
				$node35 = $node3_row['userid'];
			}
			if($ctr == 36)
			{
				$node36 = $node3_row['userid'];
			}
			$ctr = $ctr + 1;
		}
	}

//level 3 node 12
$ctr = 37;
	$node37 = -1;
	$node38 = -1;
	$node39 = -1;

	if($node12 != -1)
	{
		$node3_res = mysql_query("select userid from tree where parentid='".$node12."'");

		while($node3_row = mysql_fetch_array($node3_res))
		{
			if($ctr == 37)
			{
				$node37 = $node3_row['userid'];
			}
			if($ctr == 38)
			{
				$node38 = $node3_row['userid'];
			}
			if($ctr == 39)
			{
				$node39 = $node3_row['userid'];
			}
			$ctr = $ctr + 1;
		}
	}

//level 4 node 13

$ctr = 40;
	$node40 = -1;
	$node41 = -1;
	$node42 = -1;

	if($node13 != -1)
	{
		$node3_res = mysql_query("select userid from tree where parentid='".$node13."'");

		while($node3_row = mysql_fetch_array($node3_res))
		{
			if($ctr == 40)
			{
				$node40 = $node3_row['userid'];
			}
			if($ctr == 41)
			{
				$node41 = $node3_row['userid'];
			}
			if($ctr == 42)
			{
				$node42 = $node3_row['userid'];
			}
			$ctr = $ctr + 1;
		}
	}

//level 4 node 14
$ctr = 43;
	$node43 = -1;
	$node44 = -1;
	$node45 = -1;

	if($node14 != -1)
	{
		$node3_res = mysql_query("select userid from tree where parentid='".$node14."'");

		while($node3_row = mysql_fetch_array($node3_res))
		{
			if($ctr == 43)
			{
				$node43 = $node3_row['userid'];
			}
			if($ctr == 44)
			{
				$node44 = $node3_row['userid'];
			}
			if($ctr == 45)
			{
				$node45 = $node3_row['userid'];
			}
			$ctr = $ctr + 1;
		}
	}

//level 4 node 15
$ctr = 46;
	$node46 = -1;
	$node47 = -1;
	$node48 = -1;

	if($node15 != -1)
	{
		$node3_res = mysql_query("select userid from tree where parentid='".$node15."'");

		while($node3_row = mysql_fetch_array($node3_res))
		{
			if($ctr == 46)
			{
				$node46 = $node3_row['userid'];
			}
			if($ctr == 47)
			{
				$node47 = $node3_row['userid'];
			}
			if($ctr == 48)
			{
				$node48 = $node3_row['userid'];
			}
			$ctr = $ctr + 1;
		}
	}
	
//level 4 node 16
$ctr = 49;
	$node49 = -1;
	$node50 = -1;
	$node51 = -1;

	if($node16 != -1)
	{
		$node3_res = mysql_query("select userid from tree where parentid='".$node16."'");

		while($node3_row = mysql_fetch_array($node3_res))
		{
			if($ctr == 49)
			{
				$node49 = $node3_row['userid'];
			}
			if($ctr == 50)
			{
				$node50 = $node3_row['userid'];
			}
			if($ctr == 51)
			{
				$node51 = $node3_row['userid'];
			}
			$ctr = $ctr + 1;
		}
	}
	
//level 4 node 17
$ctr = 52;
	$node52 = -1;
	$node53 = -1;
	$node54 = -1;

	if($node17 != -1)
	{
		$node3_res = mysql_query("select userid from tree where parentid='".$node17."'");

		while($node3_row = mysql_fetch_array($node3_res))
		{
			if($ctr == 52)
			{
				$node52 = $node3_row['userid'];
			}
			if($ctr == 53)
			{
				$node53 = $node3_row['userid'];
			}
			if($ctr == 54)
			{
				$node54 = $node3_row['userid'];
			}
			$ctr = $ctr + 1;
		}
	}
	
//level 4 node 18
$ctr = 55;
	$node55 = -1;
	$node56 = -1;
	$node57 = -1;

	if($node18 != -1)
	{
		$node3_res = mysql_query("select userid from tree where parentid='".$node18."'");

		while($node3_row = mysql_fetch_array($node3_res))
		{
			if($ctr == 55)
			{
				$node55 = $node3_row['userid'];
			}
			if($ctr == 56)
			{
				$node56 = $node3_row['userid'];
			}
			if($ctr == 57)
			{
				$node57 = $node3_row['userid'];
			}
			$ctr = $ctr + 1;
		}
	}
	
//level 4 node 19
$ctr = 58;
	$node58 = -1;
	$node59 = -1;
	$node60 = -1;

	if($node19 != -1)
	{
		$node3_res = mysql_query("select userid from tree where parentid='".$node19."'");

		while($node3_row = mysql_fetch_array($node3_res))
		{
			if($ctr == 58)
			{
				$node58 = $node3_row['userid'];
			}
			if($ctr == 59)
			{
				$node59 = $node3_row['userid'];
			}
			if($ctr == 60)
			{
				$node60 = $node3_row['userid'];
			}
			$ctr = $ctr + 1;
		}
	}
	
//level 4 node 20
$ctr = 61;
	$node61 = -1;
	$node62 = -1;
	$node63 = -1;

	if($node20 != -1)
	{
		$node3_res = mysql_query("select userid from tree where parentid='".$node20."'");

		while($node3_row = mysql_fetch_array($node3_res))
		{
			if($ctr == 61)
			{
				$node61 = $node3_row['userid'];
			}
			if($ctr == 62)
			{
				$node62 = $node3_row['userid'];
			}
			if($ctr == 63)
			{
				$node63 = $node3_row['userid'];
			}
			$ctr = $ctr + 1;
		}
	}

//level 4 node 21
$ctr = 64;
	$node64 = -1;
	$node65 = -1;
	$node66 = -1;

	if($node21 != -1)
	{
		$node3_res = mysql_query("select userid from tree where parentid='".$node21."'");

		while($node3_row = mysql_fetch_array($node3_res))
		{
			if($ctr == 64)
			{
				$node64 = $node3_row['userid'];
			}
			if($ctr == 65)
			{
				$node65 = $node3_row['userid'];
			}
			if($ctr == 66)
			{
				$node66 = $node3_row['userid'];
			}
			$ctr = $ctr + 1;
		}
	}

//level 4 node 22
$ctr = 67;
	$node67 = -1;
	$node68 = -1;
	$node69 = -1;

	if($node22 != -1)
	{
		$node3_res = mysql_query("select userid from tree where parentid='".$node22."'");

		while($node3_row = mysql_fetch_array($node3_res))
		{
			if($ctr == 67)
			{
				$node67 = $node3_row['userid'];
			}
			if($ctr == 68)
			{
				$node68 = $node3_row['userid'];
			}
			if($ctr == 69)
			{
				$node69 = $node3_row['userid'];
			}
			$ctr = $ctr + 1;
		}
	}
	
//level 4 node 23
$ctr = 70;
	$node70 = -1;
	$node71 = -1;
	$node72 = -1;

	if($node23 != -1)
	{
		$node3_res = mysql_query("select userid from tree where parentid='".$node23."'");

		while($node3_row = mysql_fetch_array($node3_res))
		{
			if($ctr == 70)
			{
				$node70 = $node3_row['userid'];
			}
			if($ctr == 71)
			{
				$node71 = $node3_row['userid'];
			}
			if($ctr == 72)
			{
				$node72 = $node3_row['userid'];
			}
			$ctr = $ctr + 1;
		}
	}
	
//level 4 node 24
$ctr = 73;
	$node73 = -1;
	$node74 = -1;
	$node75 = -1;

	if($node24 != -1)
	{
		$node3_res = mysql_query("select userid from tree where parentid='".$node24."'");

		while($node3_row = mysql_fetch_array($node3_res))
		{
			if($ctr == 73)
			{
				$node73 = $node3_row['userid'];
			}
			if($ctr == 74)
			{
				$node74 = $node3_row['userid'];
			}
			if($ctr == 75)
			{
				$node75 = $node3_row['userid'];
			}
			$ctr = $ctr + 1;
		}
	}
	
//level 4 node 25
$ctr = 76;
	$node76 = -1;
	$node77 = -1;
	$node78 = -1;

	if($node25 != -1)
	{
		$node3_res = mysql_query("select userid from tree where parentid='".$node25."'");

		while($node3_row = mysql_fetch_array($node3_res))
		{
			if($ctr == 76)
			{
				$node76 = $node3_row['userid'];
			}
			if($ctr == 77)
			{
				$node77 = $node3_row['userid'];
			}
			if($ctr == 78)
			{
				$node78 = $node3_row['userid'];
			}
			$ctr = $ctr + 1;
		}
	}
	
	
//level 4 node 26
$ctr = 79;
	$node79 = -1;
	$node80 = -1;
	$node81 = -1;

	if($node26 != -1)
	{
		$node3_res = mysql_query("select userid from tree where parentid='".$node26."'");

		while($node3_row = mysql_fetch_array($node3_res))
		{
			if($ctr == 79)
			{
				$node79 = $node3_row['userid'];
			}
			if($ctr == 80)
			{
				$node80 = $node3_row['userid'];
			}
			if($ctr == 81)
			{
				$node81 = $node3_row['userid'];
			}
			$ctr = $ctr + 1;
		}
	}

//level 4 node 27
$ctr = 82;
	$node82 = -1;
	$node83 = -1;
	$node84 = -1;

	if($node27 != -1)
	{
		$node3_res = mysql_query("select userid from tree where parentid='".$node27."'");

		while($node3_row = mysql_fetch_array($node3_res))
		{
			if($ctr == 82)
			{
				$node82 = $node3_row['userid'];
			}
			if($ctr == 83)
			{
				$node83 = $node3_row['userid'];
			}
			if($ctr == 84)
			{
				$node84 = $node3_row['userid'];
			}
			$ctr = $ctr + 1;
		}
	}
	
	
//level 4 node 28
$ctr = 85;
	$node85 = -1;
	$node86 = -1;
	$node87 = -1;

	if($node28 != -1)
	{
		$node3_res = mysql_query("select userid from tree where parentid='".$node28."'");

		while($node3_row = mysql_fetch_array($node3_res))
		{
			if($ctr == 85)
			{
				$node85 = $node3_row['userid'];
			}
			if($ctr == 86)
			{
				$node86 = $node3_row['userid'];
			}
			if($ctr == 87)
			{
				$node87 = $node3_row['userid'];
			}
			$ctr = $ctr + 1;
		}
	}	


//level 4 node 29
$ctr = 88;
	$node85 = -1;
	$node86 = -1;
	$node87 = -1;

	if($node29 != -1)
	{
		$node3_res = mysql_query("select userid from tree where parentid='".$node29."'");

		while($node3_row = mysql_fetch_array($node3_res))
		{
			if($ctr == 88)
			{
				$node88 = $node3_row['userid'];
			}
			if($ctr == 89)
			{
				$node89 = $node3_row['userid'];
			}
			if($ctr == 90)
			{
				$node90 = $node3_row['userid'];
			}
			$ctr = $ctr + 1;
		}
	}	

//level 4 node 30
$ctr = 91;
	$node91 = -1;
	$node92 = -1;
	$node93 = -1;

	if($node30 != -1)
	{
		$node3_res = mysql_query("select userid from tree where parentid='".$node30."'");

		while($node3_row = mysql_fetch_array($node3_res))
		{
			if($ctr == 91)
			{
				$node91 = $node3_row['userid'];
			}
			if($ctr == 92)
			{
				$node92 = $node3_row['userid'];
			}
			if($ctr == 93)
			{
				$node93 = $node3_row['userid'];
			}
			$ctr = $ctr + 1;
		}
	}
	
//level 4 node 31
$ctr = 94;
	$node94 = -1;
	$node95 = -1;
	$node96 = -1;

	if($node31 != -1)
	{
		$node3_res = mysql_query("select userid from tree where parentid='".$node31."'");

		while($node3_row = mysql_fetch_array($node3_res))
		{
			if($ctr == 94)
			{
				$node95 = $node3_row['userid'];
			}
			if($ctr == 95)
			{
				$node95 = $node3_row['userid'];
			}
			if($ctr == 96)
			{
				$node96 = $node3_row['userid'];
			}
			$ctr = $ctr + 1;
		}
	}
	
//level 4 node 32
$ctr = 97;
	$node97 = -1;
	$node98 = -1;
	$node99 = -1;

	if($node32 != -1)
	{
		$node3_res = mysql_query("select userid from tree where parentid='".$node32."'");

		while($node3_row = mysql_fetch_array($node3_res))
		{
			if($ctr == 97)
			{
				$node97 = $node3_row['userid'];
			}
			if($ctr == 98)
			{
				$node98 = $node3_row['userid'];
			}
			if($ctr == 99)
			{
				$node99 = $node3_row['userid'];
			}
			$ctr = $ctr + 1;
		}
	}
	
//level 4 node 33
$ctr = 100;
	$node100 = -1;
	$node101 = -1;
	$node102= -1;

	if($node33!= -1)
	{
		$node3_res = mysql_query("select userid from tree where parentid='".$node33."'");

		while($node3_row = mysql_fetch_array($node3_res))
		{
			if($ctr == 100)
			{
				$node100 = $node3_row['userid'];
			}
			if($ctr == 101)
			{
				$node101 = $node3_row['userid'];
			}
			if($ctr == 102)
			{
				$node102 = $node3_row['userid'];
			}
			$ctr = $ctr + 1;
		}
	}

	
//level 4 node 34
$ctr = 103;
	$node103 = -1;
	$node104 = -1;
	$node105= -1;

	if($node34!= -1)
	{
		$node3_res = mysql_query("select userid from tree where parentid='".$node34."'");

		while($node3_row = mysql_fetch_array($node3_res))
		{
			if($ctr == 103)
			{
				$node103 = $node3_row['userid'];
			}
			if($ctr == 104)
			{
				$node104 = $node3_row['userid'];
			}
			if($ctr == 105)
			{
				$node105 = $node3_row['userid'];
			}
			$ctr = $ctr + 1;
		}
	}
	
//level 4 node 35
$ctr = 106;
	$node106 = -1;
	$node107 = -1;
	$node108= -1;

	if($node35!= -1)
	{
		$node3_res = mysql_query("select userid from tree where parentid='".$node35."'");

		while($node3_row = mysql_fetch_array($node3_res))
		{
			if($ctr == 106)
			{
				$node106 = $node3_row['userid'];
			}
			if($ctr == 107)
			{
				$node107 = $node3_row['userid'];
			}
			if($ctr == 108)
			{
				$node108 = $node3_row['userid'];
			}
			$ctr = $ctr + 1;
		}
	}

//level 4 node 36
$ctr = 109;
	$node109 = -1;
	$node110 = -1;
	$node111= -1;

	if($node36!= -1)
	{
		$node3_res = mysql_query("select userid from tree where parentid='".$node36."'");

		while($node3_row = mysql_fetch_array($node3_res))
		{
			if($ctr == 109)
			{
				$node109 = $node3_row['userid'];
			}
			if($ctr == 110)
			{
				$node110 = $node3_row['userid'];
			}
			if($ctr == 111)
			{
				$node111 = $node3_row['userid'];
			}
			$ctr = $ctr + 1;
		}
	}

//level 4 node 37
$ctr = 112;
	$node112 = -1;
	$node113 = -1;
	$node114 = -1;

	if($node37!= -1)
	{
		$node3_res = mysql_query("select userid from tree where parentid='".$node37."'");

		while($node3_row = mysql_fetch_array($node3_res))
		{
			if($ctr == 112)
			{
				$node112 = $node3_row['userid'];
			}
			if($ctr == 113)
			{
				$node113 = $node3_row['userid'];
			}
			if($ctr == 114)
			{
				$node114 = $node3_row['userid'];
			}
			$ctr = $ctr + 1;
		}
	}

//level 4 node 38
$ctr = 115;
	$node115 = -1;
	$node116 = -1;
	$node117 = -1;

	if($node38!= -1)
	{
		$node3_res = mysql_query("select userid from tree where parentid='".$node38."'");

		while($node3_row = mysql_fetch_array($node3_res))
		{
			if($ctr == 115)
			{
				$node115 = $node3_row['userid'];
			}
			if($ctr == 116)
			{
				$node116 = $node3_row['userid'];
			}
			if($ctr == 117)
			{
				$node117 = $node3_row['userid'];
			}
			$ctr = $ctr + 1;
		}
	}

//level 4 node 39
$ctr = 118;
	$node118 = -1;
	$node119 = -1;
	$node120 = -1;

	if($node39!= -1)
	{
		$node3_res = mysql_query("select userid from tree where parentid='".$node39."'");

		while($node3_row = mysql_fetch_array($node3_res))
		{
			if($ctr == 118)
			{
				$node118 = $node3_row['userid'];
			}
			if($ctr == 119)
			{
				$node119 = $node3_row['userid'];
			}
			if($ctr == 120)
			{
				$node117 = $node3_row['userid'];
			}
			$ctr = $ctr + 1;
		}
	}

?>
<body>
<div align="center">
  <table width=5000" border="0">
    <TR>
      <TD height="19" colspan="9" align="center" valign="top">
      <h1 align="center">Graph</h1></TD>
      </TR>	
    <tr>
      <td colspan="9" align="center">
        <?php
			if($rootid != -1){
			
		?>
        <br />
        <img src="green.gif" border="0">
        <br>
        <?php echo $node1; ?>
        
        <?php
				
			} else {
				echo "<img src='empty.gif' border='0'>";
			}
		?>
      </td>
    </tr>
    
    <tr>
      <td colspan="9" align="center">
        
        <img src="big_bar.jpg" width="3343" height="27" border="0">
      </td>
    </tr>
    
    <tr>
      <td colspan="3" align="center">
        <?php
			if($node1 != -1){
			
		?>
        <br />
        <img src="green.gif" border="0">
        <br>
        <a href="tree.php?id=<?php echo $node1;?>"><?php echo $node1; ?></a></font>
        
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			}
		?>
        
      </td>
      <td colspan="3" align="center">
        <?php
			if($node2 != -1){
			
		?>
        <br />
        <img src="green.gif" border="0">
        <br>
        <a href="tree.php?id=<?php echo $node2;?>"><?php echo $node2; ?></a>
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			}
		?>
      </td>
      
      <td colspan="3" align="center">
        <?php
			if($node3 != -1){
			
		?>
        <br />
        <img src="green.gif" border="0">
        <br>
        <a href="tree.php?id=<?php echo $node3;?>"><?php echo $node3; ?></a>
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			}
		?>
      </td>
    </tr>
    
    <tr>
      <td colspan="3" align="center">
      <img src="small_bar.jpg" width="1119" height="31" border="0"></td>
      <td colspan="3" align="center">
      <img src="small_bar.jpg" width="1122" height="31" border="0" align="middle">&nbsp;&nbsp;&nbsp;&nbsp;</td>
      <td colspan="3" align="center">
     <img src="small_bar.jpg" width="1119" height="31" border="0"></td>
      
    </tr>
    
    <tr>
      <td width="11.11%" align="center">
        <?php
			if($node4 != -1){
			
		?>
        <br />
        <img src="green.gif" border="0">
        <br>
        <a href="tree.php?id=<?php echo $node4 ;?>"><?php echo $node4; ?></a>
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
        
      </td>
      
      <td width="11.11%" align="center">
        <?php
			if($node5 != -1){
			
		?>
        <br />
        <img src="green.gif" border="0">
        <br>
        <a href="tree.php?id=<?php echo $node5 ;?>"><?php echo $node5; ?></a>
        <?php
			
			}else{
				echo "&nbsp;";
			} 
		?>
        
      </td>
      <td width="11.11%" align="center">
        <?php
			if($node6 != -1){
			
		?>
        <br />
        <img src="green.gif" border="0">
        <br>
        <a href="tree.php?id=<?php echo $node6 ;?>"><?php echo $node6; ?></a>
        <?php
			
			}else{
				echo "&nbsp;";
			} 
		?>
        
      </td>
      <td width="11.11%" align="center">
        <?php
			if($node7 != -1){
			
		?>
        <br />
        <img src="green.gif" border="0">
        <br>
        <a href="tree.php?id=<?php echo $node7;?>"><?php echo $node7; ?></a>
        <?php
			
			}else{
				echo "&nbsp;";
			} 
		?>
        
      </td>
      
      <td width="11.11%" align="center">
        <?php
			if($node8 != -1){
			
		?>
        <br />
        <img src="green.gif" border="0">
        <br>
        <a href="tree.php?id=<?php echo $node8;?>"><?php echo $node8; ?></a>
        <?php
			
			}else{
				echo "&nbsp;";
			} 
		?>
        
      </td>
      
      <td width="11.11%" align="center">
        <?php
			if($node9 != -1){
			
		?>
        <br />
        <img src="green.gif" border="0">
        <br>
        <a href="tree.php?id=<?php echo $node9;?>"><?php echo $node9; ?></a>
        <?php
			
			}else{
				echo "&nbsp;";
			} 
		?>
        
      </td>
      
      <td width="11.11%" align="center">
        <?php
			if($node10 != -1){
			
		?>
        <br />
        <img src="green.gif" border="0">
        <br>
        <a href="tree.php?id=<?php echo $node10;?>"><?php echo $node10; ?></a>
        <?php
			
			}else{
				echo "&nbsp;";
			} 
		?>
        
      </td>
      
      <td width="11.11%" align="center">
        <?php
			if($node11 != -1){
			
		?>
        <br />
        <img src="green.gif" border="0">
        <br>
        <a href="tree.php?id=<?php echo $node11;?>"><?php echo $node11; ?></a>
        <?php
			
			}else{
				echo "&nbsp;";
			} 
		?>
        
      </td>
      
      <td width="11.11%" align="center">
        <?php
			if($node12 != -1){
			
		?>
        <br />
        <img src="green.gif" border="0">
        <br>
        <a href="tree.php?id=<?php echo $node12;?>"><?php echo $node12; ?></a>
        <?php
			
			}else{
				echo "&nbsp;";
			} 
		?>
        
      </td>
    </tr>
    <tr>
    </tr>
  </table>
</div>
<div align="center">
  <table width=5000" border="0">
  <tr>
    <td width="85" ><div align="right">
      <table width=5000" border="0">
        <tr>
          <td width=11.11% align="center"><img src="small_bar.jpg" width="383" border="0"></td>
          <td width=11.11%  align="center"><img src="small_bar.jpg" width="383" border="0"></td>
          <td width=11.11%  align="center"><img src="small_bar.jpg" width="383" border="0"></td>
          <td width=11.11%"  align="center"><img src="small_bar.jpg" width="383" border="0"></td>
          <td width=11.11%  align="center"><img src="small_bar.jpg" width="383" border="0"></td>
          <td width=11.11%  align="center"><img src="small_bar.jpg" width="383" border="0"></td>
          <td width=11.11%  align="center"><img src="small_bar.jpg" width="383" border="0"></td>
          <td width=11.11%  align="center"><img src="small_bar.jpg" width="383" border="0"></td>
          <td width=11.11%  align="center"><img src="small_bar.jpg" width="383" border="0"></td>
          <?php //for ($i=0; $i<8; $i++){ echo "<td>e</td>";}?>
        </tr>
        <tr>
          
        </tr>
      </table>
    </div></td>
  </tr>
  </table>
</div>
<div align="center">
  <table width=5000" border="0">
  <tr>
  <td width="164" ><div align="center">
            <?php
			if($node13 != -1){
		?>
            <br />
           <img src="green.gif" border="0"> <br>
            <a href="tree.php?id=<?php echo $node13 ;?>"><?php echo $node13; ?></a>
            <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
          </div></td>
          <td width="200" ><div align="center">
            <?php
			if($node14 != -1){
		?>
            <br />
            <img src="green.gif" border="0"> <br>
            <a href="tree.php?id=<?php echo $node14 ;?>"><?php echo $node14; ?></a>
            <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
          </div></td>
          <td width="179" ><div align="center">
            <?php
			if($node15 != -1){
		?>
            <br />
            <img src="green.gif" border="0"> <br>
            <a href="tree.php?id=<?php echo $node15 ;?>"><?php echo $node15; ?></a>
            <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
          </div></td>
          <td width="172" ><div align="center">
            <?php
			if($node16 != -1){
		?>
            <br />
            <img src="green.gif" border="0"> <br>
           <a href="tree.php?id=<?php echo $node16 ;?>"><?php echo $node16; ?></a>
            <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
          </div></td>
          <td width="192" ><div align="center">
            <?php
			if($node17 != -1){
		?>
            <br />
              <img src="green.gif" border="0"> <br>
            <a href="tree.php?id=<?php echo $node17 ;?>"><?php echo $node17; ?></a>
            <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
          </div></td>
          <td width="179" ><div align="center">
            <?php
			if($node18 != -1){
		?>
            <br />
            <img src="green.gif" border="0"> <br>
            <a href="tree.php?id=<?php echo $node18 ;?>"><?php echo $node18; ?></a>
            <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
          </div></td>
          <td width="181" ><div align="center">
            <?php
			if($node19 != -1){
		?>
            <br />
            <img src="green.gif" border="0"> <br>
            ;<a href="tree.php?id=<?php echo $node19 ;?>"><?php echo $node19; ?></a>
            <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
          </div></td>
          <td width="183" ><div align="center">
            <?php
			if($node20 != -1){
		?>
            <br />
            <img src="green.gif" border="0"> <br>
            <a href="tree.php?id=<?php echo $node20 ;?>"><?php echo $node20; ?></a>
            <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
          </div></td>
          <td width="179" ><div align="center">
            <?php
			if($node21 != -1){
		?>
            <br />
            <img src="green.gif" border="0"> <br>
            <a href="tree.php?id=<?php echo $node21 ;?>"><?php echo $node21; ?></a>
            <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
          </div></td>
          <td width="181" ><div align="left">
            <?php
			if($node22 != -1){
		?>
            <br />
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="green.gif" border="0"> <br>
            &nbsp;&nbsp;&nbsp;&nbsp;<a href="tree.php?id=<?php echo $node22 ;?>"><?php echo $node22; ?></a>
            <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
          </div></td>
          <td width="183" ><div align="center">
            <?php
			if($node23 != -1){
		?>
            <br />
            <img src="green.gif" border="0"> <br>
            <a href="tree.php?id=<?php echo $node23 ;?>"><?php echo $node23; ?></a>
            <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
          </div></td>
          <td width="179" ><div align="center">
            <?php
			if($node24 != -1){
		?>
            <br />
            <img src="green.gif" border="0"><br>
            <a href="tree.php?id=<?php echo $node24 ;?>"><?php echo $node24; ?></a>
            <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
          </div></td>
          <td width="181" ><div align="center">
            <?php
			if($node25 != -1){
		?>
            <br />
            <img src="green.gif" border="0"> <br>
            <a href="tree.php?id=<?php echo $node25 ;?>"><?php echo $node23; ?></a>
            <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
          </div></td>
          <td width="183" ><div align="center">
            <?php
			if($node26 != -1){
		?>
            <br />
            <img src="green.gif" border="0"> <br>
            <a href="tree.php?id=<?php echo $node26 ;?>"><?php echo $node26; ?></a>
            <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
          </div></td>
          <td width="179" ><div align="center">
            <?php
			if($node27 != -1){
		?>
            <br />
            <img src="green.gif" border="0"> <br>
            <a href="tree.php?id=<?php echo $node27 ;?>"><?php echo $node27; ?></a>
            <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
          </div></td>
          <td width="181" ><div align="center">
            <?php
			if($node28 != -1){
		?>
            <br />
            <img src="green.gif" border="0"> <br>
            <a href="tree.php?id=<?php echo $node28 ;?>"><?php echo $node28; ?></a>
            <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
          </div></td>
          <td width="183" ><div align="center">
            <?php
			if($node29 != -1){
		?>
            <br />
            <img src="green.gif" border="0"> <br>
            <a href="tree.php?id=<?php echo $node29 ;?>"><?php echo $node29; ?></a>
            <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
          </div></td>
          <td width="179" ><div align="center">
            <?php
			if($node30 != -1){
		?>
            <br />
            <img src="green.gif" border="0"> <br>
            <a href="tree.php?id=<?php echo $node30 ;?>"><?php echo $node30; ?></a>
            <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
          </div></td>
          <td width="181" ><div align="center">
            <?php
			if($node31 != -1){
		?>
            <br />
           <img src="green.gif" border="0"> <br>
            &nbsp;&nbsp;&nbsp;&nbsp;<a href="tree.php?id=<?php echo $node31 ;?>"><?php echo $node31; ?></a>
            <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
          </div></td>
          <td width="183" ><div align="center">
            <?php
			if($node32 != -1){
		?>
            <br />
            <img src="green.gif" border="0"> <br>
            <a href="tree.php?id=<?php echo $node32 ;?>"><?php echo $node32; ?></a>
            <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
          </div></td>
          <td width="179" ><div align="center">
            <?php
			if($node33 != -1){
		?>
            <br />
            <img src="green.gif" border="0"> <br>
            <a href="tree.php?id=<?php echo $node33 ;?>"><?php echo $node33; ?></a>
            <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
          </div></td>
          <td width="181" ><div align="center">
            <?php
			if($node34 != -1){
		?>
            <br />
           <img src="green.gif" border="0"> <br>
            <a href="tree.php?id=<?php echo $node34 ;?>"><?php echo $node34; ?></a>
            <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
          </div></td>
          <td width="183" ><div align="center">
            <?php
			if($node35 != -1){
		?>
            <br />
            <img src="green.gif" border="0"> <br>
            <a href="tree.php?id=<?php echo $node35 ;?>"><?php echo $node35; ?></a>
            <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
          </div></td>
          <td width="179" ><div align="center">
            <?php
			if($node36 != -1){
		?>
            <br />
            <img src="green.gif" border="0"> <br>
            <a href="tree.php?id=<?php echo $node36 ;?>"><?php echo $node36; ?></a>
            <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
          </div></td>
          <td width="181" ><div  align="center">
            <?php
			if($node37 != -1){
		?>
            <br />
            <img src="green.gif" border="0"> <br>
            <a href="tree.php?id=<?php echo $node37 ;?>"><?php echo $node37; ?></a>
            <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
          </div></td>
          <td width="183" ><div align="center">
            <?php
			if($node38 != -1){
		?>
            <br />
            <img src="green.gif" border="0"> <br>
            <a href="tree.php?id=<?php echo $node38 ;?>"><?php echo $node38; ?></a>
            <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
          </div></td>
          <td width="182" ><div  align="center">
            <?php
			if($node39 != -1){
		?>
            <br />
            <img src="green.gif" border="0"> <br>
            <a href="tree.php?id=<?php echo $node39 ;?>"><?php echo $node39; ?></a>&nbsp;&nbsp;&nbsp;&nbsp;
            <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
          </div></td>
  </tr>
  </table>
  
       <table width=5000" border="0">
        <tr>
          <td width="175"  align="center"><img src="small_bar.jpg" width="139" height="17" border="0"></td>
          <td width="179"  align="center"><img src="small_bar.jpg" width="139" height="17" border="0"></td>
          <td width="192"  align="center"><img src="small_bar.jpg" width="139" height="17" border="0"></td>
          <td width="170"  align="center"><img src="small_bar.jpg" width="139" height="17" border="0"></td>
          <td width="192"  align="center"><img src="small_bar.jpg" width="139" height="17" border="0"></td>
          <td width="179"  align="center"><img src="small_bar.jpg" width="139" height="17" border="0"></td>
          <td width="180"  align="center"><img src="small_bar.jpg" width="139" height="17" border="0"></td>
          <td width="184"  align="center"><img src="small_bar.jpg" width="139" height="17" border="0"></td>
          <td width="179"  align="center"><img src="small_bar.jpg" width="139" height="17" border="0"></td>
          <td  width="182"center"><img src="small_bar.jpg" width="139" height="17" border="0"></td>
          <td width="182"  align="center"><img src="small_bar.jpg" width="139" height="17" border="0"></td>
          <td width="178"  align="center"><img src="small_bar.jpg" width="139" height="17" border="0"></td>
          <td width="181"  align="center"><img src="small_bar.jpg" width="139" height="17" border="0"></td>
          <td width="183"  align="center"><img src="small_bar.jpg" width="139" height="17" border="0"></td>
          <td width="182"  align="center"><img src="small_bar.jpg" width="139" height="17" border="0"></td>
          <td width="185"  align="center"><img src="small_bar.jpg" width="139" height="17" border="0"></td>
          <td width="171"  align="center"><img src="small_bar.jpg" width="139" height="17" border="0"></td>
          <td width="187"  align="center"><img src="small_bar.jpg" width="139" height="17" border="0"></td>
          <td width="177"  align="center"><img src="small_bar.jpg" width="139" height="17" border="0"></td>
          <td width="184"  align="center"><img src="small_bar.jpg" width="139" height="17" border="0"></td>
          <td width="180"  align="center"><img src="small_bar.jpg" width="139" height="17" border="0"></td>
          <td width="182"  align="center"><img src="small_bar.jpg" width="139" height="17" border="0"></td>
          <td width="182"  align="center"><img src="small_bar.jpg" width="139" height="17" border="0"></td>
          <td width="179"  align="center"><img src="small_bar.jpg" width="139" height="17" border="0"></td>
          <td width="181"  align="center"><img src="small_bar.jpg" width="139" height="17" border="0"></td>
          <td width="182"  align="center"><img src="small_bar.jpg" width="139" height="17" border="0"></td>
          <td width="182"  align="center"><img src="small_bar.jpg" width="139" height="17" border="0"></td>
          <?php //for ($i=0; $i<8; $i++){ echo "<td>e</td>";}?>
        </tr>
        <tr>
          
        </tr>
      </table>
      
      
      
</div>
<div align="center">
  <table width=5000 border="0">
    <tr>
      <td width="45" ><div align="left">
        <?php
			if($node40 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        &nbsp;&nbsp;&nbsp;<a href="tree.php?id=<?php echo $node40 ;?>"><?php echo $node40; ?></a>
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="49" ><div align="center">
        <?php
			if($node41 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        <a href="tree.php?id=<?php echo $node41 ;?>"><?php echo $node41; ?></a>
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="61" ><div align="right">
        <?php
			if($node42 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        <a href="tree.php?id=<?php echo $node42 ;?>"><?php echo $node42; ?></a>&nbsp;&nbsp;&nbsp;&nbsp;
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="56" ><div align="left">
        <?php
			if($node43 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        &nbsp;&nbsp;&nbsp;<a href="tree.php?id=<?php echo $node43 ;?>"><?php echo $node43; ?></a>
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="76" ><div align="center">
        <?php
			if($node44 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        <a href="tree.php?id=<?php echo $node44 ;?>"><?php echo $node44; ?></a>
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="62" ><div align="right">
        <?php
			if($node45 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        <a href="tree.php?id=<?php echo $node45 ;?>"><?php echo $node45; ?></a>&nbsp;&nbsp;&nbsp;&nbsp;
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="57" ><div align="left">
        <?php
			if($node46 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        &nbsp;&nbsp;&nbsp;<a href="tree.php?id=<?php echo $node46 ;?>"><?php echo $node46; ?></a>
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="63" ><div align="center">
        <?php
			if($node47 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        <a href="tree.php?id=<?php echo $node47 ;?>"><?php echo $node47; ?></a>
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="52" ><div align="right">
        <?php
			if($node48 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        <a href="tree.php?id=<?php echo $node48 ;?>"><?php echo $node48; ?></a>&nbsp;&nbsp;&nbsp;&nbsp;
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="56" ><div align="left">
        <?php
			if($node49 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        &nbsp;&nbsp;&nbsp;<a href="tree.php?id=<?php echo $node49 ;?>"><?php echo $node49; ?></a>
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="49" ><div align="center">
        <?php
			if($node50 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        <a href="tree.php?id=<?php echo $node50 ;?>"><?php echo $node50; ?></a>
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="59" ><div align="right">
        <?php
			if($node51 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        <a href="tree.php?id=<?php echo $node51 ;?>"><?php echo $node51; ?></a>&nbsp;&nbsp;&nbsp;&nbsp;
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="59" ><div align="left">
        <?php
			if($node52 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        &nbsp;&nbsp;&nbsp;<a href="tree.php?id=<?php echo $node52 ;?>"><?php echo $node52; ?></a>
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="62" ><div align="center">
        <?php
			if($node53 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        <a href="tree.php?id=<?php echo $node53 ;?>"><?php echo $node53; ?></a>
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="63" ><div align="right">
        <?php
			if($node54 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        <a href="tree.php?id=<?php echo $node54 ;?>"><?php echo $node54; ?></a>&nbsp;&nbsp;&nbsp;&nbsp;
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="57" ><div align="left">
        <?php
			if($node55 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        &nbsp;&nbsp;&nbsp;<a href="tree.php?id=<?php echo $node55 ;?>"><?php echo $node55; ?></a>
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="48" ><div align="center">
        <?php
			if($node56 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        <a href="tree.php?id=<?php echo $node56 ;?>"><?php echo $node56; ?></a>
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="64" ><div align="right">
        <?php
			if($node57 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        <a href="tree.php?id=<?php echo $node57 ;?>"><?php echo $node57; ?></a>&nbsp;&nbsp;&nbsp;&nbsp;
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="55" ><div align="left">
        <?php
			if($node58 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        &nbsp;&nbsp;&nbsp;<a href="tree.php?id=<?php echo $node58 ;?>"><?php echo $node58; ?></a>
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="56" ><div align="center">
        <?php
			if($node59 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        <a href="tree.php?id=<?php echo $node59 ;?>"><?php echo $node59; ?></a>
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="60" ><div align="right">
        <?php
			if($node60 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        <a href="tree.php?id=<?php echo $node60 ;?>"><?php echo $node60; ?></a>&nbsp;&nbsp;&nbsp;&nbsp;
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="56" ><div align="left">
        <?php
			if($node61 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        <a href="tree.php?id=<?php echo $node61 ;?>"><?php echo $node61; ?></a>
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="59" ><div align="center">
        <?php
			if($node62 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        <a href="tree.php?id=<?php echo $node62 ;?>"><?php echo $node62; ?></a>
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="62" ><div align="right">
        <?php
			if($node63 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        <a href="tree.php?id=<?php echo $node63 ;?>"><?php echo $node63; ?></a>&nbsp;&nbsp;&nbsp;&nbsp;
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="60" ><div align="left">
        <?php
			if($node64 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        &nbsp;&nbsp;&nbsp;<a href="tree.php?id=<?php echo $node64 ;?>"><?php echo $node64; ?></a>
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="50" ><div align="center">
        <?php
			if($node65 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        <a href="tree.php?id=<?php echo $node65 ;?>"><?php echo $node65; ?></a>
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="62" ><div align="right">
        <?php
			if($node66 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        <a href="tree.php?id=<?php echo $node66 ;?>"><?php echo $node66; ?></a>&nbsp;&nbsp;&nbsp;&nbsp;
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="60" ><div align="left">
        <?php
			if($node67 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        &nbsp;&nbsp;&nbsp;<a href="tree.php?id=<?php echo $node67 ;?>"><?php echo $node67; ?></a>
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="57" ><div align="center">
        <?php
			if($node68 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        <a href="tree.php?id=<?php echo $node68 ;?>"><?php echo $node68; ?></a>
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="59" ><div align="right">
        <?php
			if($node69 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        <a href="tree.php?id=<?php echo $node69 ;?>"><?php echo $node69; ?></a>&nbsp;&nbsp;&nbsp;&nbsp;
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="58" ><div align="left">
        <?php
			if($node70 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        &nbsp;&nbsp;&nbsp;<a href="tree.php?id=<?php echo $node70 ;?>"><?php echo $node70; ?></a>
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="50" ><div align="center">
        <?php
			if($node71 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        <a href="tree.php?id=<?php echo $node71 ;?>"><?php echo $node71; ?></a>
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="68" ><div align="right">
        <?php
			if($node72 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        <a href="tree.php?id=<?php echo $node72 ;?>"><?php echo $node72; ?></a>&nbsp;&nbsp;&nbsp;&nbsp;
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="54" ><div align="left">
        <?php
			if($node73 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        &nbsp;&nbsp;&nbsp;<a href="tree.php?id=<?php echo $node73 ;?>"><?php echo $node73; ?></a>
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="49" ><div align="center">
        <?php
			if($node74 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        <a href="tree.php?id=<?php echo $node74 ;?>"><?php echo $node74; ?></a>
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="62" ><div align="right">
        <?php
			if($node75 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        <a href="tree.php?id=<?php echo $node75 ;?>"><?php echo $node75; ?></a>&nbsp;&nbsp;&nbsp;&nbsp;
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="52" ><div align="left">
        <?php
			if($node76 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        &nbsp;&nbsp;&nbsp;<a href="tree.php?id=<?php echo $node76 ;?>"><?php echo $node76; ?></a>
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="64" ><div align="center">
        <?php
			if($node77 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        <a href="tree.php?id=<?php echo $node77 ;?>"><?php echo $node77; ?></a>
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="59" ><div align="right">
        <?php
			if($node78 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        <a href="tree.php?id=<?php echo $node78 ;?>"><?php echo $node78; ?></a>&nbsp;&nbsp;&nbsp;&nbsp;
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="58" ><div align="left">
        <?php
			if($node79 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        &nbsp;&nbsp;&nbsp;<a href="tree.php?id=<?php echo $node79 ;?>"><?php echo $node79; ?></a>
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="49" ><div align="center">
        <?php
			if($node80 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        <a href="tree.php?id=<?php echo $node80 ;?>"><?php echo $node80; ?></a>
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="68" ><div align="right">
        <?php
			if($node81 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        <a href="tree.php?id=<?php echo $node81 ;?>"><?php echo $node81; ?></a>&nbsp;&nbsp;&nbsp;&nbsp;
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="56" ><div align="left">
        <?php
			if($node82 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        &nbsp;&nbsp;&nbsp;<a href="tree.php?id=<?php echo $node82 ;?>"><?php echo $node82; ?></a>
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="64" ><div align="center">
        <?php
			if($node83 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        <a href="tree.php?id=<?php echo $node83 ;?>"><?php echo $node83; ?></a>
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="52" ><div align="right">
        <?php
			if($node84 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        <a href="tree.php?id=<?php echo $node84 ;?>"><?php echo $node84; ?></a>
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="69" ><div align="left">
        <?php
			if($node85 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        &nbsp;&nbsp;&nbsp;<a href="tree.php?id=<?php echo $node85 ;?>"><?php echo $node85; ?></a>
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="51" ><div  align="center">
        <?php
			if($node86 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        &nbsp;&nbsp;&nbsp;<a href="tree.php?id=<?php echo $node86 ;?>"><?php echo $node86; ?></a>
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="55" ><div align="right">
        <?php
			if($node87 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        <a href="tree.php?id=<?php echo $node87 ;?>"><?php echo $node87; ?></a>
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="61" ><div align="left">
        <?php
			if($node88 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        <a href="tree.php?id=<?php echo $node88 ;?>"><?php echo $node88; ?></a>&nbsp;&nbsp;&nbsp;&nbsp;
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="69" ><div align="center">
        <?php
			if($node89 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        &nbsp;&nbsp;&nbsp;<a href="tree.php?id=<?php echo $node89 ;?>"><?php echo $node89; ?></a>
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="46" ><div align="right">
        <?php
			if($node90 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        <a href="tree.php?id=<?php echo $node90 ;?>"><?php echo $node90; ?></a>
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="64" ><div align="left">
        <?php
			if($node91 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        <a href="tree.php?id=<?php echo $node91 ;?>"><?php echo $node91; ?></a>&nbsp;&nbsp;&nbsp;&nbsp;
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="53" ><div align="center">
        <?php
			if($node92 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        &nbsp;&nbsp;&nbsp;<a href="tree.php?id=<?php echo $node92 ;?>"><?php echo $node92; ?></a>
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="52" ><div align="right">
        <?php
			if($node93 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        <a href="tree.php?id=<?php echo $node93 ;?>"><?php echo $node93; ?></a>
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="62" ><div align="left">
        <?php
			if($node94 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        <a href="tree.php?id=<?php echo $node94 ;?>"><?php echo $node94; ?></a>&nbsp;&nbsp;&nbsp;&nbsp;
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="54" ><div align="center">
        <?php
			if($node95 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        &nbsp;&nbsp;&nbsp;<a href="tree.php?id=<?php echo $node95 ;?>"><?php echo $node95; ?></a>
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="57" ><div align="right">
        <?php
			if($node96 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        <a href="tree.php?id=<?php echo $node96 ;?>"><?php echo $node96; ?></a>
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="59" ><div align="left">
        <?php
			if($node97 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        <a href="tree.php?id=<?php echo $node97 ;?>"><?php echo $node97; ?></a>&nbsp;&nbsp;&nbsp;&nbsp;
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="58" ><div align="center">
        <?php
			if($node98 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        &nbsp;&nbsp;&nbsp;<a href="tree.php?id=<?php echo $node98 ;?>"><?php echo $node98; ?></a>
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="56" ><div align="right">
        <?php
			if($node99 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        <a href="tree.php?id=<?php echo $node99 ;?>"><?php echo $node99; ?></a>
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="65" ><div align="left">
        <?php
			if($node100 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        <a href="tree.php?id=<?php echo $node100 ;?>"><?php echo $node100; ?></a>&nbsp;&nbsp;&nbsp;&nbsp;
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="52" ><div align="center">
        <?php
			if($node101 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        &nbsp;&nbsp;&nbsp;<a href="tree.php?id=<?php echo $node101 ;?>"><?php echo $node101; ?></a>
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="63" ><div align="right">
        <?php
			if($node102 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        <a href="tree.php?id=<?php echo $node102 ;?>"><?php echo $node102; ?></a>
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="63" ><div align="left">
        <?php
			if($node103 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        <a href="tree.php?id=<?php echo $node103 ;?>"><?php echo $node103; ?></a>&nbsp;&nbsp;&nbsp;&nbsp;
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="53" ><div align="center">
        <?php
			if($node104 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        &nbsp;&nbsp;&nbsp;<a href="tree.php?id=<?php echo $node104 ;?>"><?php echo $node104; ?></a>
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="52" ><div align="right">
        <?php
			if($node105 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        <a href="tree.php?id=<?php echo $node105 ;?>"><?php echo $node105; ?></a>
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="56" ><div align="left">
        <?php
			if($node106 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        <a href="tree.php?id=<?php echo $node106 ;?>"><?php echo $node106; ?></a>
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="51" ><div align="center">
        <?php
			if($node107 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        &nbsp;&nbsp;&nbsp;<a href="tree.php?id=<?php echo $node107 ;?>"><?php echo $node107; ?></a>
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="64" ><div align="right">
        <?php
			if($node108 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        <a href="tree.php?id=<?php echo $node108 ;?>"><?php echo $node108; ?></a>
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="56" ><div align="left">
        <?php
			if($node109 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        &nbsp;&nbsp;&nbsp;<a href="tree.php?id=<?php echo $node109 ;?>"><?php echo $node109; ?></a>
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="61" ><div align="center">
        <?php
			if($node110 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        <a href="tree.php?id=<?php echo $node110 ;?>"><?php echo $node110; ?></a>
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="55" ><div align="right">
        <?php
			if($node111 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        &nbsp;&nbsp;&nbsp;<a href="tree.php?id=<?php echo $node111 ;?>"><?php echo $node111; ?></a>
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="50" ><div align="left">
        <?php
			if($node112 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        <a href="tree.php?id=<?php echo $node112 ;?>"><?php echo $node112; ?></a>
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="61" ><div align="center">
        <?php
			if($node113 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        <a href="tree.php?id=<?php echo $node113 ;?>"><?php echo $node113; ?></a>
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="61" ><div align="right">
        <?php
			if($node14 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        <a href="tree.php?id=<?php echo $node14 ;?>"><?php echo $node14; ?></a>&nbsp;&nbsp;&nbsp;&nbsp;
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="52" ><div align="left">
        <?php
			if($node115 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        <a href="tree.php?id=<?php echo $node115 ;?>"><?php echo $node115; ?></a>
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="58" ><div align="center">
        <?php
			if($node116 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        <a href="tree.php?id=<?php echo $node116 ;?>"><?php echo $node116; ?></a>
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="65" ><div align="right">
        <?php
			if($node117 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        <a href="tree.php?id=<?php echo $node117 ;?>"><?php echo $node117; ?></a>&nbsp;&nbsp;&nbsp;&nbsp;
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="52" ><div align="left">
        <?php
			if($node118 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        <a href="tree.php?id=<?php echo $node118 ;?>"><?php echo $node118; ?></a>
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="73" ><div align="center">
        <?php
			if($node119 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        <a href="tree.php?id=<?php echo $node119 ;?>"><?php echo $node119; ?></a>
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
      <td width="48" ><div align="right">
        <?php
			if($node120 != -1){
		?>
        <br />
        <img src="green.gif" border="0"> <br>
        <a href="tree.php?id=<?php echo $node120 ;?>"><?php echo $node120; ?></a>&nbsp;&nbsp;&nbsp;&nbsp;
        <?php
			
			}else{
				echo "<img src='empty.gif' border='0'>";
			} 
		?>
      </div></td>
    </tr>
  </table>
</div>
          

</body>

