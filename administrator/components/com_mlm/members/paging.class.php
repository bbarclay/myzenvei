<?php

class PagedResults {

   /* These are defaults */
   var $TotalResults;
   private $CurrentPage = 1;
   public $PageVarName = "pageno";
   public $ResultsPerPage = 20;
   public $LinksPerPage = 10;
   private $ResultArray;
   private $TotalPages;
   
   
   function init() {
      $this->TotalPages = $this->getTotalPages();
      $this->CurrentPage = $this->getCurrentPage();
      $this->ResultArray = array(
                           "PREV_PAGE" => $this->getPrevPage(),
                           "NEXT_PAGE" => $this->getNextPage(),
                           "CURRENT_PAGE" => $this->CurrentPage,
                           "TOTAL_PAGES" => $this->TotalPages,
                           "TOTAL_RESULTS" => $this->TotalResults,
                           "PAGE_NUMBERS" => $this->getNumbers(),
                           "MYSQL_LIMIT1" => $this->getStartOffset(),
                           "MYSQL_LIMIT2" => $this->ResultsPerPage,
                           "START_OFFSET" => $this->getStartOffset(),
                           "END_OFFSET" => $this->getEndOffset(),
                           "RESULTS_PER_PAGE" => $this->ResultsPerPage,
                           );
      // echo __FILE__ . ' ' . __LINE__ ;                    
      //var_dump(debug_backtrace());
      
   }

   
   /* Start information functions */
   function getTotalPages() {
      /* Make sure we don't devide by zero */
     // echo $this->TotalResults . ' ' . $this->ResultsPerPage . '<br>';
      if($this->TotalResults != 0 && $this->ResultsPerPage != 0) {
         $result = ceil($this->TotalResults / $this->ResultsPerPage);
      }
      /* If 0, make it 1 page */
      if(isset($result) && $result == 0) {
         return 1;
      } else {
         return $result;
      }
   }

   function getStartOffset() {
      $offset = $this->ResultsPerPage * ($this->CurrentPage - 1);
      if($offset != 0) { $offset++; }
      return $offset;
   }

   function getEndOffset() {
      if($this->getStartOffset() > ($this->TotalResults - $this->ResultsPerPage)) {
         $offset = $this->TotalResults;
      } elseif($this->getStartOffset() != 0) {
         $offset = $this->getStartOffset() + $this->ResultsPerPage - 1;
      } else {
         $offset = $this->ResultsPerPage;
      }
      return $offset;
   }

   function getCurrentPage() {
      if(isset($_GET[$this->PageVarName])) {
         return $_GET[$this->PageVarName];
      } else {
         return $this->CurrentPage;
      }
   }

   function getPrevPage() {
      if($this->CurrentPage > 1) {
         return $this->CurrentPage - 1;
      } else {
         return false;
      }
   }

   function getNextPage() {
      if($this->CurrentPage < $this->TotalPages) {
         return $this->CurrentPage + 1;
      } else {
         return false;
      }
   }

   function getStartNumber() {
      $links_per_page_half = $this->LinksPerPage / 2;
      /* See if curpage is less than half links per page */
      if($this->CurrentPage <= $links_per_page_half || $this->TotalPages <= $this->LinksPerPage) {
         return 1;
      /* See if curpage is greater than TotalPages minus Half links per page */
      } elseif($this->CurrentPage >= ($this->TotalPages - $links_per_page_half)) {
         return $this->TotalPages - $this->LinksPerPage + 1;
      } else {
         return $this->CurrentPage - $links_per_page_half;
      }
   }

   function getEndNumber() {
      if($this->TotalPages < $this->LinksPerPage) {
         return $this->TotalPages;
      } else {
         return $this->getStartNumber() + $this->LinksPerPage - 1;
      }
   }

   function getNumbers() {
      for($i=$this->getStartNumber(); $i<=$this->getEndNumber(); $i++) {
         $numbers[] = $i;
      }
      return $numbers;
   }
   
   function pageHTML($qrysring='')
   {
   		$this->init();
   		$pgarray = explode("/", $_SERVER['SCRIPT_NAME']);
		$curpage = $pgarray[count($pgarray)-1];
		$curnumber = $this->ResultArray['CURRENT_PAGE'];
		$start = 1;
		$total   = $this->TotalPages;
		$start = (($curnumber - 5) > 0) ? ($curnumber-5) : 1;
		$end   = (($total - $curnumber) >= 5) ? ($curnumber+5) : $total;
		$ret   = '';
		//print"_______ $qrysring _______";
		if($qrysring=='')
		{
			if($_SERVER['QUERY_STRING'])
			{
				$qstring = preg_replace("/&?pageno=\d+/", '', $_SERVER['QUERY_STRING']);
				//echo "Query string is $qstring<br>";	
				if($qstring)
				{
					$url = $curpage . '?' . $qstring . "&pageno=";
				}
				else
				{ 
					$url = $curpage . "?pageno=";	
				}
			}
			else 
			{
				$url = $curpage . "?pageno=";
			}
		}
		else
		{
			$qrysring = preg_replace("/&?pageno=[^~?&\'\")]+/", '', $qrysring);
			$url=$qrysring;
		}
		//echo " Start is $start and end is $end<br>";
		
		for($i=$start; $i<=$end; $i++) 
		{
			//$pageurl = $url . $i;
			if($qrysring)
			{
				$pageurl = str_replace('~~i~~',$i,$url);
			}
      		
			if($this->ResultArray["CURRENT_PAGE"] == $i) 
      		{
         		$ret .=  "<a class='ftr'><b>$i</b></a> | ";
      		} 
      		else 
      		{
         		$ret .= "<a class = 'link-ftr' href='$pageurl'>$i</a> | ";
      		}
   		}
   		
   		$first = $last = $next = $previous = '';
   		
   		if($this->ResultArray["CURRENT_PAGE"]!= 1) 
   		{
      		
			if($qrysring)
		  	{
		  		
				$url2   = str_replace('~~i~~',1,$url);
				$first =  "<a class='link-ftr' href='$url2'>&lt;&lt;</a> ";
			}else
			{
				$first =  "<a class='link-ftr' href='$url" . "1'>&lt;&lt;</a> ";
			}
   		} 
   		else 
   		{
      		$first = "<a class='ftr'>&lt;&lt;</a>";
   		}
   

	   // Print out our prev link 
	   if($this->ResultArray["PREV_PAGE"]) 
	   {
	      if($qrysring)
		  {
		  	$url3   = str_replace('~~i~~',$this->ResultArray["PREV_PAGE"],$url);
			$previous =  "<a class='link-ftr' href='$url3'>Previous</a>";
		  }else
		  {
		  	$previous =  "<a class='link-ftr' href='$url" . $this->ResultArray["PREV_PAGE"] . "'>Previous</a>";
	   	   }
	   } else 
	   {
	      $previous =  "<a class='ftr'>Previous</a>";
	   }
	
	   	   // Print out our next link 
	   if($this->ResultArray["NEXT_PAGE"]) {
	     if($qrysring)
		 {
		 	$url4   = str_replace('~~i~~',$this->ResultArray["NEXT_PAGE"],$url);
			$next =  "<a class='link-ftr' href='$url4'>Next</a>";
		  }else
		  {
		  	$next =  "<a class='link-ftr' href='$url" . $this->ResultArray["NEXT_PAGE"] . "'>Next</a>";
		  }
	   } else {
	      $next =  "<a class='ftr'>Next</a>";
	   }
	
	   // Print our last link 
	   if($this->ResultArray["CURRENT_PAGE"]!= $this->ResultArray["TOTAL_PAGES"]) 
	   {
	      if($qrysring)
		 {
		 	//echo $this->ResultArray["TOTAL_PAGES"];
			$url5   = str_replace('~~i~~',$this->ResultArray["TOTAL_PAGES"],$url);
			$last =  "<a class='link-ftr' href='$url5'>&gt;&gt;</a>";
		  }else
		  {
		  	$last =  "<a class='link-ftr' href='$url" . $this->ResultArray["TOTAL_PAGES"] . "'>&gt;&gt;</a>";
		  }
	   } else 
	   {
	      $last =  "<a class='ftr'>&gt;&gt;</a>";
	   }
	   
	   // Page Summary
	   
	   $summary = "<a class='ftr'>(Page $curnumber of $total)</a>&nbsp;&nbsp;&nbsp;";

   		$ret = "$summary $first | $previous | $ret $next | $last";
   		
   		return $ret;
		
   }

}

/*
	Usage
	
	// Instantiate the paging class! 
   $Paging = new PagedResults();

   // Select the count of total results  e.g. if you are showing active prospect
  $Paging->TotalResults = $db->fetch($sql);
	$Paging->ResultsPerPage = 10; //results per page limit
	$page  = $Paging->getCurrentPage();
	if($page > 1)
		$start = ($page-1) * $Paging->ResultsPerPage;
	else 
		$start = 1;
	$end   = $Paging->ResultsPerPage;
	
	
   if($db->query("Select field1, field2........ from prospects where status < 2 order by fieldname limit $start, $end
   {
   
   }
   
   // Paging is only required if results count is  greater than number of records we have
   	if($Paging->TotalResults > $paging->ResultsPerPage) 
    	$pagelinks = $Paging->pageHTML();
    
    // Assign to smarty		
    $smarty->assign('pagelinks', $pagelinks);
    
    // In Smarty
    
    {if $pagelinks}
    	<apply any formating necessary e.g. align right etc {$pagelinks}
    {/if}	
*/
?>
