<?php defined('_JEXEC') or die('Restricted access'); // no direct access

// get the document object
$doc =& JFactory::getDocument();

// add your stylesheet
$doc->addStyleSheet( 'modules/mod_hot_joomla_carousel/tmpl/hot_joomla_carousel.css' );

// style declaration
$doc->addStyleDeclaration( '

.hotcarousel img {
	border:'.$imageBorderWidth.'px solid #'.$imageBorderColor.';
	margin:0 '.$imageMarginReal.'px;
	padding:'.$imagePadding.'px;
}

.hotcarousel .js {
	overflow:hidden;
	width:'.$moduleWidth.'px;
	height:'.$moduleHeight.'px;
}

.hotcarousel .carousel-next {
	background: url('.$mosConfig_live_site.'/modules/mod_hot_joomla_carousel/images/circleright32.png) 0 '.$controlPositon.'px no-repeat;float:left;
}

.hotcarousel .carousel-previous {
	background: url('.$mosConfig_live_site.'/modules/mod_hot_joomla_carousel/images/circleleft32.png) 0 '.$controlPositon.'px no-repeat;float:left;
}

.hotcarousel .carousel-control{height:'.$moduleHeight.'px;}

' );

?>

<?php if ($enablejQuery!=0) { ?>
<script type="text/javascript" src="<?php echo $mosConfig_live_site; ?>/modules/mod_hot_joomla_carousel/js/jquery-1.3.2.min.js"></script>
<?php } ?>

<script type="text/javascript" src="<?php echo $mosConfig_live_site; ?>/modules/mod_hot_joomla_carousel/js/jquery.carousel.js"></script>
<script type="text/javascript">
    jQuery(function(){
        jQuery("div.foo").carousel({
			direction: "<?php echo $carouselDirection; ?>",
			loop: <?php echo $carouselLoop; ?>,
			dispItems: <?php echo $imageNumber; ?>,
			pagination: <?php echo $carouselPagination; ?>,
			paginationPosition: "inside",
			autoSlide: <?php echo $carouselAutoSlide; ?>,
			autoSlideInterval: <?php echo $carouselAutoSlideInterval; ?>,
			delayAutoSlide: false,
			combinedClasses: false,
			effect: "<?php echo $carouselEffect; ?>",
			slideEasing: "swing",
			animSpeed: "<?php echo $carouselAnimSpeed; ?>",
			equalWidths: "true"
		});
    });
</script>
    
<div class="hotcarousel">
    <div class="foo">
         <ul style="margin:0; padding:0">
    
            <?php  
            $carouselPath = $_SERVER['SCRIPT_FILENAME'];
            $carouselRealPath = substr_replace($carouselPath ,"",-9);
            $carouselFullPath = $carouselRealPath.$carouselImagesPath;
                if ($handle = opendir($carouselFullPath)) {
                    while (false !== ($file = readdir($handle))) {
                        if ($file != "." && $file != "..") {
                            $infinite_list = $infinite_list."$file"."||";
                        }
                    }
                    closedir($handle);
                    $infinite_pic = explode("||", $infinite_list);
                    $infinite_pics_number = count($infinite_pic) - 2;
                    for ($loop = 0; $loop <= $infinite_pics_number; $loop += 1) {
						$pic_type = explode(".", $infinite_pic[$loop]);
						if ((($pic_type[1]=="jpg")or($pic_type[1]=="gif"))or(($pic_type[1]=="jpeg")or($pic_type[1]=="png"))) {
							echo '<li><img src="'.$carouselImagesPath.'/'.$infinite_pic[$loop].'" alt="" width="'.$imageWidth.'" height="'.$imageHeight.'" /></li>';
							echo "\n";
						} elseif ((($pic_type[1]=="JPG")or($pic_type[1]=="GIF"))or(($pic_type[1]=="JPEG")or($pic_type[1]=="PNG"))) {
							echo '<li><img src="'.$carouselImagesPath.'/'.$infinite_pic[$loop].'" alt="" width="'.$imageWidth.'" height="'.$imageHeight.'" /></li>';
							echo "\n";						
						}
                    }
                }
            ?>
    
        </ul>
    </div>
</div>