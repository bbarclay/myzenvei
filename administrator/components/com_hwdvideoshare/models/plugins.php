<?php
/**
 *    @version [ Dannevirke ]
 *    @package hwdVideoShare
 *    @copyright (C) 2007 - 2009 Highwood Design
 *    @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 ***
 *    Originally Joomla/Mambo Community Builder : Plugin Handler
 *    @package Community Builder
 *    @copyright (C) Beat and JoomlaJoe, www.joomlapolis.com and various
 *    @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU/GPL version 2
 ***
 *    This program is free software: you can redistribute it and/or modify
 *    it under the terms of the GNU General Public License as published by
 *    the Free Software Foundation, either version 3 of the License, or
 *    (at your option) any later version.
 *
 *    This program is distributed in the hope that it will be useful,
 *    but WITHOUT ANY WARRANTY; without even the implied warranty of
 *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *    GNU General Public License for more details.
 *
 *    You should have received a copy of the GNU General Public License
 *    along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

class hwdvids_BE_plugins
{
   /**
	* view the plugin page
	*/
	function plugins() {
		hwdvids_HTML::plugins();
		return true;
	}
   /**
	* view the plugin page
	*/
	function insertVideo() {
		$eName	= JRequest::getVar('e_name');
		$eName	= preg_replace( '#[^A-Z0-9\-\_\[\]]#i', '', $eName );
		?>
		<script type="text/javascript">
			function insertPagebreak()
			{
				var video_id = document.getElementById("video_id").value;
				var video_width = document.getElementById("video_width").value;
				var video_height = document.getElementById("video_height").value;

				var tag = "\{hwdvideoshare\}id="+video_id+"|width="+video_width+"|height="+video_height+"\{/hwdvideoshare\}";

				window.parent.jInsertEditorText(tag, '<?php echo $eName; ?>');
				window.parent.document.getElementById('sbox-window').close();
				return false;
			}
		</script>

		<form>
		<table width="100%" cellpadding="2" cellspacing="2" border="0" style="padding: 10px;">
			<tr>
				<td class="key" align="right" width="40%">
					<label for="title">
						<?php echo JText::_( 'Video ID' ); ?>
					</label>
				</td>
				<td width="60%">
					<input type="text" id="video_id" name="video_id" />
				</td>
			</tr>
			<tr>
				<td class="key" align="right">
					<label for="alias">
						<?php echo JText::_( 'Video Width' ); ?>
					</label>
				</td>
				<td>
					<input type="text" id="video_width" name="video_width" />
				</td>
			</tr>
			<tr>
				<td class="key" align="right">
					<label for="alias">
						<?php echo JText::_( 'Video Height' ); ?>
					</label>
				</td>
				<td>
					<input type="text" id="video_height" name="video_height" />
				</td>
			</tr>
			<tr>
				<td class="key" align="right"></td>
				<td>
					<button onclick="insertPagebreak();return false;"><?php echo JText::_( 'Insert Video' ); ?></button>
				</td>
			</tr>
		</table>
		</form>
		<?php
	}
}
?>