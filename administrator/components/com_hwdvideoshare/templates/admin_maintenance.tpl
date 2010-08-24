{* 
//////
//    @version [ Dannevirke ]
//    @package hwdVideoShare
//    @copyright (C) 2007 - 2009 Highwood Design
//    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
//////
*}

{include file='admin_header.tpl'}
		
<table cellpadding="0" cellspacing="0" border="0" width="100%">
  <tr>
    <td align="left" valign="top" width="50%">
      
      <div style="border: 1px solid #ccc; padding: 5px; margin: 0 5px 5px 0;">
      
          <h2>{$smarty.const._HWDVIDS_TITLE_DELETEOLDVIDS}</h2>
          <p>{$smarty.const._HWDVIDS_INFO_PERMDEL1}</p>
          <p>{$smarty.const._HWDVIDS_INFO_PERMDEL2} <b>{$total}</b> {$smarty.const._HWDVIDS_INFO_PERMDEL3}</p>
          <select name="run_permdel">
            <option value="1" selected="selected">{$smarty.const._HWDVIDS_MAIN_RN}</option>
            <option value="0">{$smarty.const._HWDVIDS_MAIN_DRN}</option>
          </select>
          
      </div>
      
    </td>
    <td align="left" valign="top">
      
      <div style="border: 1px solid #ccc; padding: 5px; margin: 0 0 5px 0;">
      
          <h2>{$smarty.const._HWDVIDS_MAIN_FDE}</h2>
          <p><b>{$smarty.const._HWDVIDS_MAIN_LR} {$fixerror_cache}</b></p>
          <select name="run_fixerrors">
            <option value="2">{$smarty.const._HWDVIDS_MAIN_RIR}</option>
            <option value="1" selected="selected">{$smarty.const._HWDVIDS_MAIN_RN}</option>
            <option value="0">{$smarty.const._HWDVIDS_MAIN_DRN}</option>
          </select>  

      </div>
      
    </td>
    <td align="left" valign="top">
  </tr>
  <tr>
    <td align="left" valign="top" width="50%">

      <div style="border: 1px solid #ccc; padding: 5px; margin: 0 5px 5px 0;">
      
          <h2>{$smarty.const._HWDVIDS_MAIN_RDS}</h2>
          <p><b>{$smarty.const._HWDVIDS_MAIN_LR} {$recount_cache}</b></p>
          <select name="run_recount">
            <option value="2">{$smarty.const._HWDVIDS_MAIN_RIR}</option>
            <option value="1" selected="selected">{$smarty.const._HWDVIDS_MAIN_RN}</option>
            <option value="0">{$smarty.const._HWDVIDS_MAIN_DRN}</option>
          </select>  
          
      </div>

    </td>
    <td align="left" valign="top">
      
      <div style="border: 1px solid #ccc; padding: 5px; margin: 0 0 5px 0;">
      
          <h2>{$smarty.const._HWDVIDS_MAIN_AAL}</h2>
          <p><b>{$smarty.const._HWDVIDS_MAIN_LR} {$archive_cache}</b></p>
          <select name="run_archivelogs">
            <option value="2">{$smarty.const._HWDVIDS_MAIN_RIR}</option>
            <option value="1" selected="selected">{$smarty.const._HWDVIDS_MAIN_RN}</option>
            <option value="0">{$smarty.const._HWDVIDS_MAIN_DRN}</option>
          </select>   

      </div>
      
    </td>
  </tr>
  <tr>
    <td align="left" valign="top" width="50%">

      <div style="border: 1px solid #ccc; padding: 5px; margin: 0 5px 5px 0;">
      
          <h2>{$smarty.const._HWDVIDS_REGENTHUMB}</h2>
          <div style="padding:5px;">
            <a href="{$mosConfig_live_site}/administrator/index.php?option=com_hwdvideoshare&task=regeneratethumbnails">
              <img src="{$mosConfig_live_site}/administrator/components/com_hwdvideoshare/assets/images/go.png" border="0" alt="{$smarty.const._HWDVIDS_MAIN_RN}" />
            </a>
          </div>   
          
      </div>

    </td>
    <td align="left" valign="top">

      <div style="border: 1px solid #ccc; padding: 5px; margin: 0 5px 5px 0;">
      
          <h2>{$smarty.const._HWDVIDS_RECALDUR}</h2>
          <div style="padding:5px;">
            <a href="{$mosConfig_live_site}/administrator/index.php?option=com_hwdvideoshare&task=recalculatedurations">
              <img src="{$mosConfig_live_site}/administrator/components/com_hwdvideoshare/assets/images/go.png" border="0" alt="{$smarty.const._HWDVIDS_MAIN_RN}" />
            </a>
          </div>    
          
      </div>
      
    </td>
  </tr>  
</table>

{include file='admin_footer.tpl'}
