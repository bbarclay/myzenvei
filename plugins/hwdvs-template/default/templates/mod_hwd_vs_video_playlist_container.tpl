{* 
//////
//    @version [ Dannevirke ]
//    @package hwdVideoShare
//    @copyright (C) 2007 - 2009 Highwood Design
//    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
//////
*}

    <div class="padding" style="float:right;">{$videoplayer->deletevideo}&nbsp;{$videoplayer->editvideo}&nbsp{$videoplayer->publishvideo}</div>
    
    <h2>{$videoplayer->title}</h2>
    
    <div class="padding">
      <div style="float:left;padding-right:5px;">
        {$videoplayer->player}
      </div>
      <div class="padding">{$videoplayer->description}</div>
      <div class="padding" style="height:40px;"><div style="float:left;">{$videoplayer->ratingsystem}</div></div>
      <div class="padding">{$videoplayer->duration}</div>
      <div class="padding"><a href="{$mosConfig_live_site}/index.php?option=com_hwdvideoshare&task=viewvideo&Itemid={$Itemid}&video_id={$videoplayer->id}" class="swap">{$smarty.const._HWDVIDS_GTVP}</a> &raquo;</div>
    </div>
        
    <div style="clear:both;"></div>

    </div>

