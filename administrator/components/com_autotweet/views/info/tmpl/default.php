<?php defined('_JEXEC') or die('Restricted access'); ?>
<h3>Support 1st-movers.com</h3>
<p>&nbsp;</p>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="8983733">
<input type="image" src="https://www.paypal.com/en_US/DE/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypal.com/de_DE/i/scr/pixel.gif" width="1" height="1">
</form>
<p>&nbsp;</p>
<p><strong><?php echo '<a href="' . $this->comp['twitter'] . '" target="_blank">Follow us on twitter</a>'; ?></strong></p>
<p>&nbsp;</p>
<hr />
<h3>General information</h3>
<p><strong>Latest news from 1st-movers.com:&nbsp;</strong> <?php echo $this->comp['news']; ?></p>
<p>&nbsp;</p>
<ul>
<li><?php echo 'Visit <a href="' . $this->comp['home'] . '" target="_blank">1st-movers.com</a>.'; ?></li>
<li><?php echo 'Problems? - Visit the <a href="' . $this->comp['support'] . '" target="_blank">support forum</a>.'; ?></li>
<li><?php echo 'Find some aditional information in the <a href="' . $this->comp['faq'] . '" target="_blank">FAQ</a>.'; ?></li>
<li><?php echo 'Have a look on our <a href="' . $this->comp['products'] . '" target="_blank">other products</a>.'; ?></li>
</ul>
<p>&nbsp;</p>
<hr />
<p>&nbsp;</p>
<h3>Component information</h3>
<table class="adminlist">
<thead>
	<tr>
		<th width="200">
			<?php echo JText::_( 'Name' ); ?>
		</th>
		<th width="100">
			<?php echo JText::_( 'Installed version' ); ?>
		</th>
		<th width="100">
			<?php echo JText::_( 'Newest version' ); ?>
		</th>
		<th width="60">&nbsp;</th>
		<th>
			<?php echo JText::_( 'Version info' ); ?>
		</th>
	</tr>
</thead>
<tr>
	<td>
		<?php echo $this->comp['name']; ?>
	</td>
	<?php
		$version_client = $this->comp['client_version'];
		if (FALSE === JString::strrpos($version_client, 'Pro')) {
			$version_server = $this->comp['server_freeversion'];
			if ($version_client == $version_server) {
				$version_color = '#00FF00';
				$version_html = '';
				$version_message = '';
			}
			else {
				$version_color = '#FF0000';
				$version_html = '<a href="' . $this->comp['download'] . '" target="_blank">download</a>';
				$version_message = $this->comp['freemessage'];
			}
		}
		else {
			$version_server = $this->comp['server_proversion'];
			if ($version_client == $version_server) {
				$version_color = '#00FF00';
				$version_html = '';
				$version_message = '';
			}
			else {
				$version_color = '#FF0000';
				$version_html = '<a href="' . $this->comp['download'] . '" target="_blank">download</a>';
				$version_message = $this->comp['promessage'];
			}
		}
	?>
	<td align="right">
		<?php echo $version_client; ?>
	</td>
	<td align="right">
		<?php echo $version_server; ?>
	</td>
	<td align="center" style="background-color:<?php echo $version_color; ?>">
		<?php echo $version_html; ?>
	</td>
	<td>
		<?php echo $version_message; ?>
	</td>
</tr>
</table>
<p>&nbsp;</p>
<h3>Extension information</h3>
<table class="adminlist">
<thead>
	<tr>
		<th width="200">
			<?php echo JText::_( 'Name' ); ?>
		</th>
		<th width="40">
			<?php echo JText::_( 'State' ); ?>
		</th>
		<th width="100">
			<?php echo JText::_( 'Installed version' ); ?>
		</th>
		<th width="100">
			<?php echo JText::_( 'Newest version' ); ?>
		</th>
		<th width="60">&nbsp;</th>
				<th>
			<?php echo JText::_( 'Version info' ); ?>
		</th>
	</tr>
</thead>
<?php
foreach ($this->plugins as $plugin)	{
?>
	<tr>
		<td>
			<?php echo $plugin['name']; ?>
		</td>
		<td>
			<?php echo $plugin['state']; ?>
		</td>
		<td align="right">
			<?php echo $plugin['client_version']; ?>
		</td>
		<td align="right">
			<?php echo $plugin['server_version']; ?>
		</td>
		<?php
			if ('not installed' == $plugin['state']) {
				$version_color = '#FFFFFF';
				$version_html = '<a href="' . $this->comp['download'] . '" target="_blank">download</a>';
				$version_message = $plugin['message'];
			}
			elseif ($plugin['client_version'] != $plugin['server_version']) {
				$version_color = '#FF0000';
				$version_html = '<a href="' . $this->comp['download'] . '" target="_blank">download</a>';
				$version_message = $plugin['message'];
			}
			elseif ('disabled' == $plugin['state']) {
				$version_color = '#FFFF00';
				$version_html = '<a href="' . $plugin['config'] . '">enable</a>';
				$version_message = '';
			}
			else {
				$version_color = '#00FF00';
				$version_html = '<a href="' . $plugin['config'] . '">options</a>';
				$version_message = '';
			}
		?>
		<td align="center" style="background-color:<?php echo $version_color; ?>">
			<?php echo $version_html; ?>
		</td>
		<td>
			<?php echo $version_message; ?>
		</td>		
	</tr>
<?php
}
?>
</table>
<p>&nbsp;</p>
