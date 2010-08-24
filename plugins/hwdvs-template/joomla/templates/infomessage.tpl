{* 
//////
//    @version [ Dannevirke ]
//    @package hwdVideoShare
//    @copyright (C) 2007 - 2009 Highwood Design
//    @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
//////
//    hwdVideoShare Template System:::This template system uses the Smarty Template Engine. 
//    For full documentation, including syntax usage please refer to http://www.smarty.net 
//    or our website at http://www.hwdmediashare.co.uk   
//////
//    This file generates the display if there are any notices or error messages to display.
//////
//    VARIABLES AVAILBLE IN THIS TEMPLATE FILE:                                        
//    -- $title.............Title for error or notice message
//    -- $icon..............The filename of the icon use display                              
//    -- $message...........The full message to display                  
//////
*}

{include file='header.tpl'}

<h2 class="contentheading">{$title}</h2>
<div class="standard">
  <div class="padding">
    <img src="{$icon}" border="0" style="vertical-align:middle;" />&nbsp;&nbsp;{$message}<br /><br />
    {$backlink}
  </div>
</div>

{if $showconnectionbox}
<h2 class="contentheading">Get Connected!</h2>
<div class="standard">
  <div class="padding">
  <table cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr>
      <td valign="top">
        <div class="introduction">
          <ul id="featurelist">
            <li>Share your videos and photos</li>
            <li>Connect and expand your network</li>
            <li>View community videos and photoss</li>
            <li>Make and add new friends</li>
            <li>Create your own video and photos groups</li>
          </ul>
          <div class="joinbutton">
            <a id="joinButton" href="{$mosConfig_live_site}/index.php?option=com_user&view=register" title="Join">Join Our Website Now!</a>
          </div>
        </div>
      </td>
      <td width="200">
        <div class="loginform">
          <form action="{$mosConfig_live_site}/index.php?option=com_user&task=login" method="post" name="login" id="form-login" >
      
            <label>
              Username<br />
              <input type="text" class="inputbox" name="username" id="username" />
            </label>
      
            <label>
              Password<br />
              <input type="password" class="inputbox" name="passwd" id="password" />
            </label>
            
            <br />
      
            <label for="remember">
              <input type="checkbox" alt="Remember my details" value="yes" id="remember" name="remember"/>
              Remember my details
            </label>
      
            <div style="text-align: left; padding: 10px 0 5px;">
              <input type="submit" value="Login" name="submit" id="submit" class="button" />
            </div>
    
            <a href="{$mosConfig_live_site}/index.php?option=com_user&amp;view=reset&amp;Itemid=6" class="login-forgot-password">
              <span>Forgot your password?</span>
            </a>
            <br />
            <a href="{$mosConfig_live_site}/index.php?option=com_user&amp;view=remind&amp;Itemid=6" class="login-forgot-username">
              <span>Forgot your username?</span>
            </a>

	    <input type="hidden" name="return" value="{$session_return}" />
	    {$session_token}

          </form>
        </div>
      </td>
    </tr>
  </table>
  </div>
</div>
{/if}

{include file='footer.tpl'}
