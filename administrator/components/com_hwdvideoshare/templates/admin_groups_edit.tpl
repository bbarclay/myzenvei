{* 
//////
//    @version [ Dannevirke ]
//    @package hwdVideoShare
//    @copyright (C) 2007 - 2009 Highwood Design
//    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
//////
*}

{include file='admin_header.tpl'}

<table cellpadding="4" cellspacing="1" border="0" class="adminform">
  <tr>
    <th colspan="2"><h2>{$smarty.const._HWDVIDS_GROUPDET}</h2></th>
  </tr>
  <tr>
    <td valign="top" align="left" width="60%">
      <table>
        <tr>
          <td>{$smarty.const._HWDVIDS_TITLE}</td>
          <td><input name="group_name" value="{$group_name}" size="55" maxlength="50"></td>
        </tr>
        <tr>
          <td valign="top">{$smarty.const._HWDVIDS_DESC}</td>
          <td valign="top"><textarea rows="5" cols="80" name ="group_description">{$group_description}</textarea></td>
        </tr>
      </table>
    </td>
    <td valign="top" align="right" width="40%">
      <table>
        <tr>
          <td valign="top" width="40%">
            {$startpane}
            {$starttab1}
            <table>
              <tr>
                <td>{$smarty.const._HWDVIDS_PUB}</td>
                <td>{$group_published}</td>
              </tr>
              <tr>
                <td>{$smarty.const._HWDVIDS_FEATURED}</td>
                <td>{$group_featured}</td>
              </tr>
              <tr>
                <td>{$smarty.const._HWDVIDS_ADMIN}</td>
                <td>{$group_admin}</td>
              </tr>
              <tr>
                <td>{$smarty.const._HWDVIDS_ACCESS}</td>
                <td>{$group_access}</td>
              </tr>
              <tr>
                <td>{$smarty.const._HWDVIDS_ACOMMENTS}</td>
                <td>{$group_comments}</td>
              </tr>
            </table>
            {$endtab}
            {$starttab2}
            <table>
              <tr>
                <td valign="top">UNDER DEVELOPMENT</td>
	        <td valign="top"></td>
              </tr>
            </table>
            {$endtab}
            {$starttab3}
            <table>
              <tr>
                <td valign="top">UNDER DEVELOPMENT</td>
                <td valign="top"></td>
              </tr>
            </table>
            {$endtab}
            {$endpane}
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>

{include file='admin_footer.tpl'}
