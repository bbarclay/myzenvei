<?php



defined('_JEXEC') or die('Restricted access'); // no direct access



require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'functions.php';



$document = null;



if (isset($this))



  $document = & $this;



$baseUrl = $this->baseurl;



$templateUrl = $this->baseurl . '/templates/' . $this->template;



artxComponentWrapper($document);



?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">



<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" >



<head>



 <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />



 <jdoc:include type="head" />



 <link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/system/css/system.css" type="text/css" />



 <link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/system/css/general.css" type="text/css" />



 <link rel="stylesheet" type="text/css" href="<?php echo $templateUrl; ?>/css/template.css" media="screen" />



 <!--[if IE 6]><link rel="stylesheet" href="<?php echo $templateUrl; ?>/css/template.ie6.css" type="text/css" media="screen" /><![endif]-->



 <!--[if IE 7]><link rel="stylesheet" href="<?php echo $templateUrl; ?>/css/template.ie7.css" type="text/css" media="screen" /><![endif]-->



 <script type="text/javascript" src="<?php echo $templateUrl; ?>/script.js"></script>


<script type="text/javascript">

var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");

document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));

</script>

<script type="text/javascript">

try {

var pageTracker = _gat._getTracker("UA-15234383-1");

pageTracker._trackPageview();

} catch(err) {}</script>



</head>



<body>


<div id="art-main">



<div class="art-sheet">



    <div class="art-sheet-cc"></div>



    <div class="art-sheet-body">



<jdoc:include type="modules" name="banner1" style="artstyle" artstyle="art-nostyle" />



<?php echo artxPositions($document, array('top1', 'top2', 'top3'), 'art-block'); ?>



<div class="art-content-layout">



    <div class="art-content-layout-row">



<div class="art-layout-cell art-content">







<?php



  echo artxModules($document, 'banner2', 'art-nostyle');



  if (artxCountModules($document, 'breadcrumb'))



    echo artxPost(null, artxModules($document, 'breadcrumb'));



  echo artxPositions($document, array('user1', 'user2'), 'art-article');



  echo artxModules($document, 'banner3', 'art-nostyle');





$user_cookie = $_GET['affiliate'];
if(!empty($user_cookie))
{

?>
<table width="50%" border="0" align="center">
  <tr align="center">
    <td><a href="<?php echo "http://www.myzenvei.com/".$_GET['name'].""?>">View <?php echo $_GET['name'];?>'s profile</a></td>
  </tr>
</table>
<?php } ?>

<?php  if (artxHasMessages()) : ?><div class="art-post">



    <div class="art-post-body">



<div class="art-post-inner">



<div class="art-postcontent">



    <!-- article-content -->







<jdoc:include type="message" />







    <!-- /article-content -->



</div>



<div class="cleared"></div>







</div>







		<div class="cleared"></div>



    </div>



</div>



<?php endif; ?>



<jdoc:include type="component" />



<?php echo artxModules($document, 'banner4', 'art-nostyle'); ?>



<?php echo artxPositions($document, array('user4', 'user5'), 'art-article'); ?>



<?php echo artxModules($document, 'banner5', 'art-nostyle'); ?>



</div>







    </div>



</div>



<div class="cleared"></div>







<?php echo artxPositions($document, array('bottom1', 'bottom2', 'bottom3'), 'art-block'); ?>



<jdoc:include type="modules" name="banner6" style="artstyle" artstyle="art-nostyle" />



<div class="art-footer">



 <div class="art-footer-inner">



  <?php echo artxModules($document, 'syndicate'); ?>



  <div class="art-footer-text">



  <?php if (artxCountModules($document, 'copyright') == 0): ?>



<p>Copyright &copy; 2010 ---.<br />



All Rights Reserved.</p>







  <?php else: ?>



  <?php echo artxModules($document, 'copyright', 'art-nostyle'); ?>



  <?php endif; ?>



  </div>



 </div>



 <div class="art-footer-background"></div>



</div>







		<div class="cleared"></div>



    </div>



</div>



<div class="cleared"></div>

</div>







</body> 



</html>