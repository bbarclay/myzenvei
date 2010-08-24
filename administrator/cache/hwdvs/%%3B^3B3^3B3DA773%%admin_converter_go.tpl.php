<?php /* Smarty version 2.6.26, created on 2010-03-16 22:11:51
         compiled from admin_converter_go.tpl */ ?>

<html>
  <head>
    <link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['mosConfig_live_site']; ?>
/administrator/components/com_hwdvideoshare/assets/css/converter.css" />
  </head>
  <body>
    <table cellpadding="0" cellspacing="0" border="0" width="100%" class="adminform">
      <tr align="left">
        <td colspan="2">
          <div style="width:100%;text-align:center;">
            <h2><?php echo @_HWDVIDS_STCV; ?>
</h2>
            <a href="<?php echo $this->_tpl_vars['mosConfig_live_site']; ?>
/components/com_hwdvideoshare/converters/converter_internal.php"><?php echo @_HWDVIDS_CONVERSIONSTART; ?>
</a>
            <div style="padding:5px;">
              <a href="<?php echo $this->_tpl_vars['mosConfig_live_site']; ?>
/components/com_hwdvideoshare/converters/converter_internal.php">
                <img src="<?php echo $this->_tpl_vars['mosConfig_live_site']; ?>
/administrator/components/com_hwdvideoshare/assets/images/go.png" border="0" alt="" />
              </a>
            </div>
          </div>
        </td>
      </tr>
      <tr align="left">
        <td width="50%" valign="top">
          <div style="padding:5px;">
            <table cellpadding="3" cellspacing="3" border="0" width="100%" class="adminform">
              <tr>
                <td align="left">
           	  <h2><?php echo @_HWDVIDS_CVST; ?>
</h2>
                  <b><?php echo @_HWDVIDS_INFO_QFCON; ?>
: <?php echo $this->_tpl_vars['total1']; ?>
</b><br />
                  <b><?php echo @_HWDVIDS_INFO_QFTUM; ?>
: <?php echo $this->_tpl_vars['total2']; ?>
</b><br />
                  <b><?php echo @_HWDVIDS_INFO_QFSWF; ?>
: <?php echo $this->_tpl_vars['total4']; ?>
</b><br />
                  <b><?php echo @_HWDVIDS_INFO_QFMP4; ?>
: <?php echo $this->_tpl_vars['total5']; ?>
</b><br />
                  <b><?php echo @_HWDVIDS_INFO_QFTRG; ?>
: <?php echo $this->_tpl_vars['total6']; ?>
</b><br />
                  <b><?php echo @_HWDVIDS_INFO_QFDRC; ?>
: <?php echo $this->_tpl_vars['total7']; ?>
</b><br />
                  <b><?php echo @_HWDVIDS_INFO_QFING; ?>
: <?php echo $this->_tpl_vars['total3']; ?>
</b><br />
                </td>
              </tr>
            </table>
          </div>
        </td>
        <td width="50%" valign="top">
          <div style="padding:5px;">
            <table cellpadding="3" cellspacing="3" border="0" width="100%" class="adminform">
              <tr>
                <td align="left" width="50%">
                  <h2><?php echo @_HWDVIDS_TT_01H; ?>
</h2><br />
                  <?php echo @_HWDVIDS_TT_01B; ?>
<br /><br />
                  <form action="index.php" method="post">
                    <input type="submit" class="inputbox" value="<?php echo @_HWDVIDS_BUTTON_RESETFCONV; ?>
">&#160;&#160;
                    <input type="hidden" name="option" value="com_hwdvideoshare" />
                    <input type="hidden" name="task" value="resetFailedConversions" />
                  </form>
                </td>
              </tr>
            </table>
          </div>
        </td>
      </tr>
    </table>
  </body>
</html>