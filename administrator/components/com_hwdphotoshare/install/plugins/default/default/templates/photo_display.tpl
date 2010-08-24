{* 
//////
//    @version [ Accetto ]
//    @package hwdPhotoShare
//    @copyright (C) 2007 - 2009 Highwood Design
//    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
//////
*}

{include file="header.tpl"}

<div class="standard">
  <h2>{$photo->title} {$deletevideo} {$editvideo}</h2>
  <div class="padding">
    <div class="pageNavigation">{$pageNavigation}</div>
    <div class="pageData">
      {$pageData}
    </div>
    <div class="albumLinks">
    
      &nbsp;|&nbsp;<a href="{$back_link}">{$back_text}</a>
      
      {if $edit_print}&nbsp;|&nbsp;<a href="{$edit_link}">{$edit_text}</a>{/if}
      
      {if $profile_print}&nbsp;|&nbsp;{$profile_username}{/if}
      
      &nbsp;|&nbsp;<a href="{$ss_link}" target="_blank">{$ss_text}</a>
    
    </div>
    <div style="clear:both"></div>
  </div>
  <div class="padding"><center>{$photo->photo}</center></div>
</div>

<div class="sic-container">
  
  <div class="sic-center" style="width:65%!important;">
  
    <div class="standard">
      <h2>{$smarty.const._HWDPS_PHOTOCOMMS}</h2>
        <div class="padding">
	{$comment_code}
	</div>
    </div>
    
  </div>
  
  <div class="sic-right">
		
    <div class="standard">
      
      {if $print_caption}<div class="padding">{$photo->caption}</div>{/if}

      <div class="padding">{$photo->ratingsystem}</div>

      <div class="padding">
	     <div id="addremfav">{$photo->favourites}</div>
	     <!--Report this photo-->
	     {$photo->download}
             <div id="ajaxresponse"></div>
      </div>
         
      <div class="padding">{$smarty.const._HWDPS_CATEGORY}: {$photo->category}</div>

      <div class="padding">{$socialbmlinks}</div>

      {if $print_tags}<div class="padding">Tags: {$photo->tags}</div>{/if}

      <!--<div class="padding">Groups</div>-->

      <div class="padding">
             {$smarty.const._HWDPS_TAKENIN} <strong>{$photo->location}</strong><br />
             {$smarty.const._HWDPS_VIEWED} {$photo->views} {$smarty.const._HWDPS_TIMES}<br />
             {$smarty.const._HWDPS_UPLOADEDON} {$photo->uploaded}<br />
             {$smarty.const._HWDPS_FROMTHEALBUM} <strong>{$photo->album_title}</strong>, {$photo->album_description}
      </div>

      <div class="padding">
             {$photo->avatar}
      </div>
      
    </div>

  </div>
  
  <div style="clear:both;"></div>
    
</div>

{include file="footer.tpl"}



