<?php
/**
* Module image_scroller For Joomla 1.5.x
* Versi			: 1.0
* Created by	: Reza Erauansyah
* Email			: old_smu17@yahoo.com
* Created on	: 26 November 2009
* Las Modified 	: -
* 
* URL			: www.camp26.biz
* License GPLv2.0 - http://www.gnu.org/licenses/gpl-2.0.html
* Based on jquery(http://www.jquery.com) and interface element (http://interface.eyecon.ro)
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

$scrollerwidth		 	= $params->get( 'width', '762' );
$txtcolor				= $params->get( 'txtcolor', '#FFF' );
$backgroundcolor		= $params->get( 'background', '#e3e3e3' );
$page_control_style		= $params->get( 'page-control', '400' );
if($page_control_style == 400){$text_backgroundcolor='#004DB3';}
elseif($page_control_style == 800){$text_backgroundcolor='#00AAD2';}
elseif($page_control_style == 1800){$text_backgroundcolor='#823D1E';}
elseif($page_control_style == 2000){$text_backgroundcolor='#000'; $txtcolor='#FFF';}
elseif($page_control_style == 1400){$text_backgroundcolor='#C562A5';}
elseif($page_control_style == 2200){$text_backgroundcolor='#9A3ACC';}
elseif($page_control_style == 2400){$text_backgroundcolor='#FF6600';}
elseif($page_control_style == 1000){$text_backgroundcolor='#0CAC0C';}
elseif($page_control_style == 600){$text_backgroundcolor='#7E1616';}
elseif($page_control_style == 1200){$text_backgroundcolor='#E01C44';}
else{$text_backgroundcolor='#004DB3';}
$js_system 				= $params->get( 'js_system' );
$baseurl 				= JURI::base();
$scrollerwidth2			= $scrollerwidth-73;

$menu_img1 		= $params->get( 'menu_img1' );
$menu_url1 		= str_replace('&', '&amp;', $params->get( 'menu_url1' ));
$image_title1 		= $params->get( 'image_title1' );
$image_description1 		= $params->get( 'image_description1' );


$menu_img2		= $params->get( 'menu_img2' );
$menu_url2 		= str_replace('&', '&amp;', $params->get( 'menu_url2' ));
$image_title2 		= $params->get( 'image_title2' );
$image_description2 		= $params->get( 'image_description2' );


$menu_img3		= $params->get( 'menu_img3' );
$menu_url3 		= str_replace('&', '&amp;', $params->get( 'menu_url3' ));
$image_title3 		= $params->get( 'image_title3' );
$image_description3 		= $params->get( 'image_description3' );


$menu_img4		= $params->get( 'menu_img4' );
$menu_url4 		= str_replace('&', '&amp;', $params->get( 'menu_url4' ));
$image_title4 		= $params->get( 'image_title4' );
$image_description4 		= $params->get( 'image_description4' );


$menu_img5		= $params->get( 'menu_img5' );
$menu_url5 		= str_replace('&', '&amp;', $params->get( 'menu_url5' ));
$image_title5 		= $params->get( 'image_title5' );
$image_description5 		= $params->get( 'image_description5' );


$menu_status6 	= $params->get( 'menu_status6' );
$menu_img6		= $params->get( 'menu_img6' );
$menu_url6 		= str_replace('&', '&amp;', $params->get( 'menu_url6' ));
$image_title6 		= $params->get( 'image_title6' );
$image_description6 		= $params->get( 'image_description6' );


$menu_status7 	= $params->get( 'menu_status7' );
$menu_img7		= $params->get( 'menu_img7' );
$menu_url7 		= str_replace('&', '&amp;', $params->get( 'menu_url7' ));
$image_title7 		= $params->get( 'image_title7' );
$image_description7 		= $params->get( 'image_description7' );


$menu_status8 	= $params->get( 'menu_status8' );
$menu_img8		= $params->get( 'menu_img8' );
$menu_url8 		= str_replace('&', '&amp;', $params->get( 'menu_url8' ));
$image_title8 		= $params->get( 'image_title8' );
$image_description8 		= $params->get( 'image_description8' );


$menu_status9 	= $params->get( 'menu_status9' );
$menu_img9		= $params->get( 'menu_img9' );
$menu_url9 		= str_replace('&', '&amp;', $params->get( 'menu_url9' ));
$image_title9 		= $params->get( 'image_title9' );
$image_description9 		= $params->get( 'image_description9' );


$menu_status10 	= $params->get( 'menu_status10' );
$menu_img10		= $params->get( 'menu_img10' );
$menu_url10 		= str_replace('&', '&amp;', $params->get( 'menu_url10' ));
$image_title10 		= $params->get( 'image_title10' );
$image_description10 		= $params->get( 'image_description10' );


echo "  <link rel=\"stylesheet\" href=\"".$baseurl."modules/mod_img_news_scroller_camp26/image_scroller/all--PRO.css\" type=\"text/css\" />";
echo "  <link rel=\"stylesheet\" href=\"".$baseurl."modules/mod_img_news_scroller_camp26/image_scroller/colours-.css\" type=\"text/css\" />";
echo "  <script type=\"text/javascript\" src=\"".$baseurl."modules/mod_img_news_scroller_camp26/image_scroller/yui--PRO.js\"></script>";
echo "  <script type=\"text/javascript\" src=\"".$baseurl."modules/mod_img_news_scroller_camp26/image_scroller/dm--PROD.js\"></script>";


?>
<style type="text/css">
	.gamma-carousel .itemlist span {
		color: <?php echo $txtcolor ;?>
	}
	.news .ccogr2 {
		background-color: <?php echo $backgroundcolor; ?>;
	}
	.news .wocc {
		background-color: <?php echo $text_backgroundcolor; ?>;
	}
	
	.news .gamma-carousel div.paging-controls a.previous {
		background-position: 0 -<?php echo $page_control_style; ?>px;
	}
	.news .gamma-carousel div.paging-controls a.next {
		background-position: -50px -<?php echo $page_control_style; ?>px;
	}
</style>
<div class="scroller_page" style="width: <?php echo $scrollerwidth; ?>px;">
	<div class="news item static">
			<script type="text/javascript">DM.has("carousel");</script>
			<script type="text/javascript">DM.Carousels.Manager.register("r7c1p0",'rollover');</script>
			<div class="gamma-carousel ccogr2 cleared" id="r7c1p0">
				<div class="carousel-holder">
					<div class="carousel horizontal">
						<div class="scroller" style="width: <?php echo $scrollerwidth2;?>px; text-align:left;">
							<ul class="itemlist link-wocc linkro-wocc">

									<li>
										<a href="<?php echo $menu_url1; ?>" style="padding: 0; border: none;">
										<img src="<?php echo $baseurl;?>/modules/mod_img_news_scroller_camp26/timthumb.php?src=<?php echo $baseurl;?>/media/image_scroller/<?php echo $menu_img1; ?>&amp;h=140&amp;w=160&amp;zc=1" alt="visit camp26.biz" width="160" height="140" style="padding: 0; border: none;"  />
										<span class="wocc"><strong><?php echo $image_title1; ?></strong><br/><br/><?php echo $image_description1; ?></span>
										</a>
									</li>

									<li>
										<a href="<?php echo $menu_url2; ?>" style="padding: 0; border: none;">
										<img src="<?php echo $baseurl;?>/modules/mod_img_news_scroller_camp26/timthumb.php?src=<?php echo $baseurl;?>/media/image_scroller/<?php echo $menu_img2; ?>&amp;h=140&amp;w=160&amp;zc=1" alt="visit camp26.biz" width="160" height="140" style="padding: 0; border: none;"  />
										<span class="wocc"><strong><?php echo $image_title2; ?></strong><br /><br /><?php echo $image_description2; ?></span>
										</a>
									</li>

									<li>
										<a href="<?php echo $menu_url3; ?>" style="padding: 0; border: none;">
										<img src="<?php echo $baseurl;?>/modules/mod_img_news_scroller_camp26/timthumb.php?src=<?php echo $baseurl;?>/media/image_scroller/<?php echo $menu_img3; ?>&amp;h=140&amp;w=160&amp;zc=1" alt="visit camp26.biz" width="160" height="140"  style="padding: 0; border: none;" />
										<span class="wocc"><strong><?php echo $image_title3; ?></strong><br/><br/><?php echo $image_description3; ?>
										</span>
										</a>
									</li>
								
									<li>
										<a href="<?php echo $menu_url4; ?>" style="padding: 0; border: none;">
										<img src="<?php echo $baseurl;?>/modules/mod_img_news_scroller_camp26/timthumb.php?src=<?php echo $baseurl;?>/media/image_scroller/<?php echo $menu_img4; ?>&amp;h=140&amp;w=160&amp;zc=1" alt="visit camp26.biz" width="160" height="140"  style="padding: 0; border: none;" />
										<span class="wocc"><strong><?php echo $image_title4; ?></strong><br /><br /><?php echo $image_description4; ?>
										</span>
										</a>
									</li>

									<li>
										<a href="<?php echo $menu_url5; ?>" style="padding: 0; border: none;">
										<img src="<?php echo $baseurl;?>/modules/mod_img_news_scroller_camp26/timthumb.php?src=<?php echo $baseurl;?>/media/image_scroller/<?php echo $menu_img5; ?>&amp;h=140&amp;w=160&amp;zc=1" alt="visit camp26.biz" width="160" height="140" style="padding: 0; border: none;"  />
										<span class="wocc"><strong><?php echo $image_title5; ?></strong><br /><br /><?php echo $image_description5; ?></span>
										</a>
									</li>
								
								<?php if ($menu_status6==1) { ?>
									<li>
										<a href="<?php echo $menu_url6; ?>" style="padding: 0; border: none;">
										<img src="<?php echo $baseurl;?>/modules/mod_img_news_scroller_camp26/timthumb.php?src=<?php echo $baseurl;?>/media/image_scroller/<?php echo $menu_img6; ?>&amp;h=140&amp;w=160&amp;zc=1" alt="visit camp26.biz" width="160" height="140"  style="padding: 0; border: none;" />
										<span class="wocc"><strong><?php echo $image_title6; ?></strong><br /><br /><?php echo $image_description6; ?></span>
										</a>
									</li>
								<?php } else { ?>
								<?php } ?>
								
								<?php if ($menu_status7==1) { ?>
									<li>
										<a href="<?php echo $menu_url7; ?>" style="padding: 0; border: none;">
										<img src="<?php echo $baseurl;?>/modules/mod_img_news_scroller_camp26/timthumb.php?src=<?php echo $baseurl;?>/media/image_scroller/<?php echo $menu_img7; ?>&amp;h=140&amp;w=160&amp;zc=1" alt="visit camp26.biz" width="160" height="140"  style="padding: 0; border: none;" />
										<span class="wocc"><strong><?php echo $image_title7; ?></strong><br /><br /><?php echo $image_description7; ?></span>
										</a>
									</li>
								<?php } else { ?>
								<?php } ?>
								
								<?php if ($menu_status8==1) { ?>
									<li>
										<a href="<?php echo $menu_url8; ?>" style="padding: 0; border: none;">
										<img src="<?php echo $baseurl;?>/modules/mod_img_news_scroller_camp26/timthumb.php?src=<?php echo $baseurl;?>/media/image_scroller/<?php echo $menu_img8; ?>&amp;h=140&amp;w=160&amp;zc=1" alt="visit camp26.biz" width="160" height="140" style="padding: 0; border: none;"  />
										<span class="wocc"><strong><?php echo $image_title8; ?></strong><br/><br/><?php echo $image_description8; ?>
										</span>
										</a>
									</li>
								<?php } else { ?>
								<?php } ?>
								
								<?php if ($menu_status9==1) { ?>
									<li>
										<a href="<?php echo $menu_url9; ?>" style="padding: 0; border: none;">
										<img src="<?php echo $baseurl;?>/modules/mod_img_news_scroller_camp26/timthumb.php?src=<?php echo $baseurl;?>/media/image_scroller/<?php echo $menu_img9; ?>&amp;h=140&amp;w=160&amp;zc=1" alt="visit camp26.biz" width="160" height="140" style="padding: 0; border: none;"  />
										<span class="wocc"><strong><?php echo $image_title9; ?></strong><br/><br/><?php echo $image_description9; ?></span>
										</a>
									</li>
								<?php } else { ?>
								<?php } ?>
								
								<?php if ($menu_status10==1) { ?>
									<li>
										<a href="<?php echo $menu_url10; ?>" style="padding: 0; border: none;">
										<img src="<?php echo $baseurl;?>/modules/mod_img_news_scroller_camp26/timthumb.php?src=<?php echo $baseurl;?>/media/image_scroller/<?php echo $menu_img10; ?>&amp;h=140&amp;w=160&amp;zc=1" alt="visit camp26.biz" width="160" height="140"  style="padding: 0; border: none;" />
										<span class="wocc"><strong><?php echo $image_title10; ?></strong><br/><br/><?php echo $image_description10; ?></span>
										</a>
									</li>
								<?php } else { ?>
								<?php } ?>
								
									<li>
										<a href="<?php echo $menu_url1; ?>" style="padding: 0; border: none;">
										<img src="<?php echo $baseurl;?>/modules/mod_img_news_scroller_camp26/timthumb.php?src=<?php echo $baseurl;?>/media/image_scroller/<?php echo $menu_img1; ?>&amp;h=140&amp;w=160&amp;zc=1" alt="visit camp26.biz" width="160" height="140"  style="padding: 0; border: none;" />
										<span class="wocc"><strong><?php echo $image_title1; ?></strong><br/><br/><?php echo $image_description1; ?></span>
										</a>
									</li>
								
									<li>
										<a href="<?php echo $menu_url2; ?>" style="padding: 0; border: none;">
										<img src="<?php echo $baseurl;?>/modules/mod_img_news_scroller_camp26/timthumb.php?src=<?php echo $baseurl;?>/media/image_scroller/<?php echo $menu_img2; ?>&amp;h=140&amp;w=160&amp;zc=1" alt="visit camp26.biz" width="160" height="140"  style="padding: 0; border: none;" />
										<span class="wocc"><strong><?php echo $image_title2; ?></strong><br /><br /><?php echo $image_description2; ?></span>
										</a>
									</li>
								
								
								</ul>
							</div>
													<div class="paging-controls">
						<a class="next" href="">
						<span class="usability">Next</span>
						</a>
						<a class="previous" href="">
						<span class="usability">Previous</span>
						</a>
						</div>

						</div>
					</div>
			</div>
	<?php echo "<span class=\"laskar-link\">module by <a href=\"http://www.camp26.biz\" target=\"_blank\" >camp26</a></span>"; ?>
	<?php echo "<div style=\"clear:both;\"></div>";?>
		</div>
	<script type="text/javascript">
		DM.intellitrackerTag = 200;
		DM.init();
		DM.checkLogin('authid');
		DM.mystories.Controller.init();
	</script>
	<?php echo "<div style=\"clear:both;\"></div>";?>
</div>
