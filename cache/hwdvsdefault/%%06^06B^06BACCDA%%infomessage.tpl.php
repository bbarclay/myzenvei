<?php /* Smarty version 2.6.26, created on 2010-08-22 00:15:52
         compiled from infomessage.tpl */ ?>

<?php if ($this->_tpl_vars['full']): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?>

<div class="standard">
  <h2><?php echo $this->_tpl_vars['title']; ?>
</h2>
  <div class="padding">
    <img src="<?php echo $this->_tpl_vars['icon']; ?>
" border="0" style="vertical-align:middle;" />&nbsp;&nbsp;<?php echo $this->_tpl_vars['message']; ?>
<br /><br />
    <?php echo $this->_tpl_vars['backlink']; ?>

  </div>
</div>

<?php if ($this->_tpl_vars['showconnectionbox']): ?>
<div class="standard">
  <h2>Get Connected!</h2>
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
            <a id="joinButton" href="<?php echo $this->_tpl_vars['mosConfig_live_site']; ?>
/index.php?option=com_user&view=register" title="Join">Join Our Website Now!</a>
          </div>
        </div>
      </td>
      <td width="200">
        <div class="loginform">
          <form action="<?php echo $this->_tpl_vars['mosConfig_live_site']; ?>
/index.php?option=com_user&task=login" method="post" name="login" id="form-login" >
      
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
    
            <a href="<?php echo $this->_tpl_vars['mosConfig_live_site']; ?>
/index.php?option=com_user&amp;view=reset&amp;Itemid=6" class="login-forgot-password">
              <span>Forgot your password?</span>
            </a>
            <br />
            <a href="<?php echo $this->_tpl_vars['mosConfig_live_site']; ?>
/index.php?option=com_user&amp;view=remind&amp;Itemid=6" class="login-forgot-username">
              <span>Forgot your username?</span>
            </a>

	    <input type="hidden" name="return" value="<?php echo $this->_tpl_vars['session_return']; ?>
" />
	    <?php echo $this->_tpl_vars['session_token']; ?>


          </form>
        </div>
      </td>
    </tr>
  </table>

  </div>
</div>

<?php endif; ?>

<?php if ($this->_tpl_vars['full']): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?>