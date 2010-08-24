<?php
/**
 * denVIDEO 4.0b
 *
 * @copyright (C) 2007- 2008 3DEN Open Software
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */


// no direct access
defined( '_JEXEC' ) or die( 'Access Denied!' );
jimport( 'joomla.plugin.plugin' );

// Register Event Functions
//$mainframe->registerEvent( 'onPrepareContent', 'plgContentcontusvideo' );
//_contusVideoImports();
class plgContentcontusvideo extends JPlugin {
    function ss() {
        static $plgParams;

        if( !empty($plgParams) ) {
            return $plgParams;
        }

        // PARAMs
        $plugin =& JPluginHelper::getPlugin('content', 'contusvideo');
        $plgParams = new JParameter( $plugin->params );
        $height	= $plgParams->get( 'height' );
        $width	= $plgParams->get( 'width' );

        // Path to plugin folder
        $plgParams->set('dir_plg',
                JPATH_PLUGINS.DS.'content'.DS.'contusvideo' .DS );
        $plgParams->set( 'uri_plg',
                JURI::base().'plugins/content/contusvideo/' );

        // Path to default videos folder
        $defdir = $plgParams->get('defaultdir', 'components/com_hdflvplayer/videos');
        if(!eregi('http://', $defdir)) {
            $defdir = JURI::base().$defdir;
            $plgParams->get('defaultdir', $defdir);
        }
        $plgParams->set('uri_img', $defdir);

        return $plgParams;
    }

    function getContusVideoParam($key, $default='', $group = '_default') {
        $plgParams = $this->ss();
        return $plgParams->get( $key, $default, $group = '_default' );
    }


    function showContusVideo($width=0, $height =0, $enablexml=0, $idval,$playlistname,$autoplay) {
        $pparams =$this->ss();
        $width=$width;
        $height=$height;
        $enablexml = (boolean)$enablexml;
        $video="";
        $type = substr( $video, strrpos($video, "playlist"));
        $type = strtolower($type);
        $db =& JFactory::getDBO();
        $playlistname=strtolower($playlistname);
        $autoplay=strtolower($autoplay);
        $playid=0;

        if($playlistname!=" ") {
            $query="SELECT id FROM #__hdflvplayername where name='$playlistname'";
            $db->setQuery( $query );
            $rows = $db->loadObjectList();
            if($playlistname=="none")
                $playid=0;
            else
                $playid=$rows[0]->id;

            //echo $query."<br>";
            //echo $playid;

        }
        $replace = $this->addVideoHdplayer($video, $width, $height, $enablexml,$idval,$playid,$autoplay);
        return $replace;

    }

    function removesextraspace($str1) {
        $str2=trim(str_replace("]", "", (trim($str1))));
        return $str2;
    }

    function onPrepareContent( &$row, &$params, $page=0 ) {
        $db =& JFactory::getDBO();
        $query="SELECT title,id FROM #__hdflvplayerupload";
        $db->setQuery( $query );
        $rows = $db->loadObjectList();
        //include_once( dirname(__FILE__) .'/contusvideo/embed.php' );
        $regexwidth='/\[hdplay videoid(.*?)]/i';
        $str1=preg_match_all( $regexwidth, $row->text,$matches);
        $widthm=$matches[0];
        $cnt=count($widthm);
        $width=0;
        $height=0;
        $enablexml=0;
        for($i=0;$i<$cnt;$i++) {
            $strwhole=$widthm[$i];
            $bol_value_fileid=0;
            $bol_value_width=0;
            $bol_value_height=0;
            $bol_value_widthheight=0;
            $bol_value_playlist=0;
            $str_fileid=0;
            $playname=" ";
            $autoplay="false";
            $width=0;
            $height=0;
            $enablexml=0;

            //$strwhole=str_replace(ord(" "),"",$strwhole);
            //$strwhole=str_replace(" ","",$strwhole);
            //$ascii_space=ord("   ");
            //echo $strwhole."<br>";
            //print_r(count_chars($strwhole,1))."<br>";
            //echo $ascii_space;


            $no = explode(" ",$strwhole);

            for($k=0;$k<count($no);$k++) {
                $str =$no[$k];
                if (strstr($str,'videoid')) {
                    $fileidarr = explode("=",$str);
                    $idval=$this->removesextraspace(trim($fileidarr[1]));
                    $idval=rtrim($idval);
                }
                if (strstr($str,'width')) {
                    $widtharr = explode("=",$no[$k]);
                    $width=$this->removesextraspace(trim($widtharr[1]));
                    //echo "width :".$width."<br>";

                }
                if (strstr($str,'height')) {
                    $heightarr = explode("=",$no[$k]);
                    $height=$this->removesextraspace(trim($heightarr[1]));
                    //echo "height :".$height."<br>";
                }
                if (strstr($str,'playlist')) {
                    $playlistarr = explode("=",$no[$k]);
                    $playname=$this->removesextraspace(trim($playlistarr[1]));
                    //echo "playname :".$playname."<br>";
                }
                if (strstr($str,'autoplay')) {
                    $autoplayarr = explode("=",$no[$k]);
                    $autoplay=$this->removesextraspace(trim($autoplayarr[1]));
                    //echo " autoplay :". $autoplay."<br>";
                }

            }
            if($width==0)
                $width=700;
            if($height==0)
                $height=400;

            $regex=$strwhole;
            $replace = $this->showContusVideo($width, $height, $enablexml,$idval,$playname,$autoplay);
            $row->text = str_replace($regex, $replace, $row->text );
            /* for google add */
            $db =& JFactory::getDBO();
            $query1 = "select * from #__hdflvaddgoogle where publish='1' and id='1'";
            $db->setQuery( $query1 );
            $fields = $db->loadObjectList();
            if(count($fields)>0)
            {
            $detailmodule = array('closeadd'=>$fields[0]->closeadd,'reopenadd'=>$fields[0]->reopenadd,'ropen'=>$fields[0]->ropen,'publish'=>$fields[0]->publish,'showaddp'=>$fields[0]->showaddp);

            $closeadd1 = $detailmodule['closeadd'];
            $ropen1 = $detailmodule['ropen'];
            ?>
            <script language="javascript">

                var closeadd =  <? echo $closeadd1 * 1000; ?>;

                var ropen = <? echo $ropen1 * 1000; ?>;


            </script>
            <script src="components/com_hdflvplayer/hdflvplayer/googleadds.js"></script>

<?php } }
//exit();

}


function addPicture( $video, $width='', $height='', $a='' ){
	$replace= 	'<img '. $a .' class="contusvideo" style="'.$width . $height.'" src="'. $video .'" />';

	return $replace;
    }
    function addVideoYoutube( $video, $width='', $height='', $params=array() ){

	if( strpos( $video, '/v/' ) ) {// If yes, New way
		$video = substr( strstr( $video, '/v/' ), 3 );
		$video = explode( '/', $video);
		$video = $video[0];
	}
	else{// Else, Old way
		$video = substr( strstr( $video, 'v=' ), 2 ) ;
		$video = explode( '&', $video);
		$video = $video[0];
	}

	$player = 'http://www.youtube.com/v/'. $video .'&'. implode('&', $params);

	$a = '';
	$p = '';

	$replace = 	addVideoHdplayer( $player, $width, $height, $a, $p );
	return $replace;
    }

    function addVideoHdplayer($video, $width, $height,$enablexml,$idval,$playid,$autoplay){
    $baseurl=JURI::base();
    if($playid==0)
    $enablexml="false";
    else
    $enablexml="true";
    $playid=trim($playid);
    $idval=trim($idval);
    ?>
    
                <?php

            $playerpath="components/com_hdflvplayer/hdflvplayer/hdplayer.swf";
//$playerpath="index.php?option=com_hdflvplayer&task=player";
            $db =& JFactory::getDBO();
            $query1 = "select * from #__hdflvaddgoogle where publish='1' and id='1'";
            $db->setQuery( $query1 );
            $fields = $db->loadObjectList();
            if(count($fields)>0)
            {
            $detailmodule = array('closeadd'=>$fields[0]->closeadd,'reopenadd'=>$fields[0]->reopenadd,'ropen'=>$fields[0]->ropen,'publish'=>$fields[0]->publish,'showaddp'=>$fields[0]->showaddp);

            if($detailmodule['publish'] == '1' && $detailmodule['showaddp'] == '1' ) {

                    $replace .='<div id="lightm"  style="width:468px;height:60px;position:absolute;background-color:#FFFFFF;display:none;">

    <span id="divimgm" ><img id="closeimgm" src="components/com_hdflvplayer/images/close.png" style=" width:48px;height:12px;cursor:pointer;position:absolute;top:-8px;left:420px;" onclick="googleclose();"></span>

    <iframe height="60" scrolling="no" align="middle" width="468" id="IFrameName" src=""     name="IFrameName" marginheight="0" marginwidth="0" frameborder="0"></iframe>

</div>';
                } }
            ?>
<!-- Hdflvplayer Plugins Verion 1.3-->
<?php
                $replace .='<div class="HDFLVPlayer1" id="HDFLVPlayer1" align="center" style="width:'.$width.'px;height:'.$height.'px" ><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,40,0" width='.$width.' height='.$height.'>'
                        .'<param name="wmode" value="transparent"/>'
                        .'<param name="movie" value="'.$baseurl.'index.php?option=com_hdflvplayer&task=player&playid='.$playid.'&id='.$idval.'"/>'
                        .'<param name="allowFullScreen" value="true"/>'
                        .'<param name="flashvars" value="baserefJ='.$baseurl.'&autoplay='.$autoplay.'&showPlaylist='.$enablexml.'"/>'
                        .'<param name="allowscriptaccess" value="always"/>'
                        .'<embed src="'.$baseurl.'index.php?option=com_hdflvplayer&task=player&playid='.$playid.'&id='.$idval.'" allowFullScreen="true"  allowScriptAccess="always"type="application/x-shockwave-flash"wmode="transparent" flashvars="baserefJ='.$baseurl.'&autoplay='.$autoplay.'&showPlaylist='.$enablexml.'" width='.trim($width).' height='.trim($height).'"/></embed>'
                        .'</object></div>';


                return $replace;
            }




        }

    ?>

