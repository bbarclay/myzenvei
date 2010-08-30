<?php 
ob_start();
include_once '../../../clients/zenvieConfig.php';
?>
<link rel="stylesheet" type="text/css" href="http://www.myzenvei.com/components/com_mlm/fisheye/fisheye-menu.css" />
<script src="http://www.myzenvei.com/components/com_mlm/fisheye/fisheye.js" type='text/javascript'></script>

<center><ul id="fisheye_menu">

<li>
		<a href="index.php?option=com_mlm&amp;view=apps">
			<img src="components/com_mlm/fisheye/images/dna.png" alt="MLM Settings"  height="48" width="48"/>
			<span>DNA Control</span>
		</a>
	</li>
	<li>
		<a href="index.php?option=com_community&view=profile&userid=<?php echo $CustomUid?>&Itemid=15">
			<img src="components/com_mlm/fisheye/images/privatebox.png" alt="image description" height="48" width="48"/>
			<span>Profile</span>
		</a>
	</li>
	<li>
		<a href="index.php?option=com_mlm&page=view_reports_archieves">
			<img src="components/com_mlm/fisheye/images/bank.png" alt="Earnings"  height="48" width="48"/>
			<span>Earnings</span>
		</a>
	</li>
	<li>
		<a href="index.php?option=com_mlm&page=view_geneology">
			<img src="components/com_mlm/fisheye/images/genelist.png" alt="Geneology List" height="48" width="48"/>
			<span>Geneology List</span>
		</a>
	</li>
	<li>
		<a href="index.php?option=com_mlm&page=view_geneology_graph">
			<img src="components/com_mlm/fisheye/images/users.png" alt="Geneology Tree" height="48" width="48"/>
			<span>Geneology Tree</span>
		</a>
	</li>
	<li>
		<a href="index.php?option=com_mlm&page=view_reports">
			<img src="components/com_mlm/fisheye/images/mydocuments.png" alt="image description" height="48" width="48"/>
			<span>Reports</span>
		</a>
	</li>
	

		<li><a href="index.php?option=com_mlm&page=view_personally_enrolled">
			<img src="components/com_mlm/fisheye/images/handshake.png" alt="image description" height="48" width="48"/>
			<span>Personally Enrolled</span>
		</a>
	</li>
	<li>
		<a href="index.php?option=com_community&view=frontpage&Itemid=15">
		<img src="components/com_mlm/fisheye/images/community.png" alt="Community Home"/>
		<span>Community</span>
		</a>
	</li>

</ul></center>
<br><br><br>