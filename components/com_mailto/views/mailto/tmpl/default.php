<?php // no direct access

defined('_JEXEC') or die('Restricted access'); ?>
<link type="text/css" rel="stylesheet" href="<?php echo JURI::base() ?>css/style.css" />
<style>

.input {
    border: 1px solid #000;
    background: #9ED37A;
}
.button {
    border: 1px solid #000;
    background: #9ED37A;
}
</style>
<script language="javascript" type="text/javascript">

<!--

	function submitbutton(pressbutton) {

	    var form = document.mailtoForm;



		// do field validation

		if (form.mailto.value == "" || form.from.value == "") {

			alert( '<?php echo JText::_('Please Enter Required Fields.'); ?>' );

			return false;

		}

		form.submit();

	}

-->

</script>

<?php

$data	= $this->get('data');
//echo '<br>'.$_SERVER["HTTP_REFERER"];
?>



<form action="<?php echo JURI::base() ?>index.php" name="mailtoForm" method="post">

      <div style="padding: 0px;" align="center">


					  <font style="border-bottom:1px solid black;"><h3>Tell A Friend</h3></font>

<br>
<p>
<h4>
		<?php 
		//echo JText::_('EMAIL_TO'); 
		echo JText::_('Friend\'s Email'); 
		?>*:
</h4>
		

		<input type="text" name="mailto" class="inputbox" size="25" value="<?php echo $this->escape($data->mailto) ?>"/>
	</p>
<input type="hidden" name="k_link" id="k_link" class="inputbox" size="25" value="<?php echo $_SERVER["HTTP_REFERER"]; ?>"  />


	<p>

		<h4><?php echo JText::_('Your Name'); ?>*:</h4>

		

		<input type="text" name="sender" class="inputbox" value="<?php echo $this->escape($data->sender) ?>" size="25" />
	</p>



	<p>

		<h4><?php echo JText::_('Your Email'); ?>*:</h4>

		

		<input type="text" name="from" class="inputbox" value="<?php echo $this->escape($data->from) ?>" size="25" />
	</p>



	<p>

		<h4><?php echo JText::_('Subject'); ?>:</h4>

		
		<input type="text" name="subject" class="inputbox" value="<?php echo $this->escape($data->subject) ?>" size="25" />
	</p>

<br>
<i>(* required fields)</i>
<br><br>

	<p>

		<button class="button" onclick="return submitbutton('send');">

			<?php echo JText::_('SEND'); ?>		</button>

		<button class="button" onclick="window.close();return false;">

			<?php echo JText::_('CANCEL'); ?>		</button>
	    </p>
</div>



	<input type="hidden" name="layout" value="<?php echo $this->getLayout();?>" />

	<input type="hidden" name="option" value="com_mailto" />

	<input type="hidden" name="task" value="send" />

	<input type="hidden" name="tmpl" value="component" />

	<input type="hidden" name="link" value="<?php echo $data->link; ?>" />

	<?php echo JHTML::_( 'form.token' ); ?></td>
 
</form>