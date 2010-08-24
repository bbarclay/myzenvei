{* 
//////
//    @version [ Accetto ]
//    @package hwdPhotoShare
//    @copyright (C) 2007 - 2009 Highwood Design
//    @license http://creativecommons.org/licenses/by-nc-nd/3.0/
//////
*}

<h2>{$smarty.const._HWDPS_HOME_01}</h2>
<table cellpadding="0" cellspacing="0" border="1" width="100%" class="adminform">
    <tr>
        <td align="left" width="50%">
        <div style="float:right"><b>{$stats.photo_approvals}</b>&nbsp;&nbsp;</div>
        <b><a href="index.php?option=com_hwdphotoshare&task=approvals">Photos Waiting Approval</a></b>
        </td>
        <td align="left" width="50%">
        <div style="float:right"><b>{$stats.album_approvals}</b>&nbsp;&nbsp;</div>
        <b><a href="index.php?option=com_hwdphotoshare&task=approvals">Albums Waiting Approval</a></b>
        </td>
    </tr>
    <tr>
        <td align="left">
        <div style="float:right"><b>{$stats.reportedphotos}</b>&nbsp;&nbsp;</div>
        <b><a href="index.php?option=com_hwdphotoshare&task=reported">Reported Photos</a></b>
        </td>
        <td align="left">
        <div style="float:right"><b>{$stats.reportedaldums}</b>&nbsp;&nbsp;</div>
        <b><a href="index.php?option=com_hwdphotoshare&task=reported">Reported Albums</a></b>
        </td>
    </tr>
    <tr>
        <td align="left">
        <div style="float:right"><b>{$stats.reportedgroups}</b>&nbsp;&nbsp;</div>
        <b><a href="index.php?option=com_hwdphotoshare&task=reported">Reported Groups</a></b>
        </td>
        <td align="left">
        <div style="float:right"><b>{$stats.totalphotos}</b>&nbsp;&nbsp;</div>
        <b><a href="index.php?option=com_hwdphotoshare&task=photos">Total Photos</a></b>
        </td>
    </tr>
    <tr>
        <td align="left">
        <div style="float:right"><b>{$stats.totalalbums}</b>&nbsp;&nbsp;</div>
        <b><a href="index.php?option=com_hwdphotoshare&task=albums">Total Albums</a></b>
        </td>
        <td align="left">
        <div style="float:right"><b>{$stats.totalcategories}</b>&nbsp;&nbsp;</div>
        <b><a href="index.php?option=com_hwdphotoshare&task=categories">Total Categories</a></b>
        </td>
    </tr>
    <tr>
        <td align="left">
        <div style="float:right"><b>{$stats.totalusers}</b>&nbsp;&nbsp;</div>
        <b><a href="index.php?option=com_users&task=view">Total Members</a></b>
        </td>
        <td align="left">
        <div style="float:right"><b>{$stats.totalgroups}</b>&nbsp;&nbsp;</div>
        <b><a href="index.php?option=com_hwdphotoshare&task=groups">Total Groups</a></b>
        </td>
    </tr>
</table>
