<?php
/**
 * @package	JomSocial
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license http://www.jomsocial.com Copyrighted Commercial Software
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

class CommunitySystemController extends CommunityBaseController
{
	function ajaxReport( $reportFunc , $pageLink )
	{
		$objResponse    = new JAXResponse();
		$config			= CFactory::getConfig();
		
		$reports		= JString::trim( $config->get( 'predefinedreports' ) );
		
		$reports		= empty( $reports ) ? false : explode( "\n" , $reports );

		$html = '';

		$argsCount		= func_num_args();

		$argsData		= '';
		
		if( $argsCount > 1 )
		{
			
			for( $i = 2; $i < $argsCount; $i++ )
			{
				$argsData	.= "\'" . func_get_arg( $i ) . "\'";
				$argsData	.= ( $i != ( $argsCount - 1) ) ? ',' : '';
			}
		}

		ob_start();
?>
		<form id="report-form">
			<table class="cWindowForm" cellspacing="1" cellpadding="0">
				<tr>
					<td class="cWindowFormKey"><?php echo JText::_('CC PREDEFINED REPORTS');?></td>
					<td class="cWindowFormVal">
						<select id="report-predefined" onchange="if(this.value!=0) jQuery('#report-message').val( this.value ); else jQuery('#report-message').val('');">
							<option selected="selected" value="0"><?php echo JText::_('CC SELECT PREDEFINED REPORTS'); ?></option>
							<?php
							if( $reports )
							{
								foreach( $reports as $report )
								{
							?>
								<option value="<?php echo $report;?>"><?php echo $report; ?></option>
							<?php
								}
							}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td class="cWindowFormKey"><?php echo JText::_('CC REPORT MESSAGE');?><span id="report-message-error"></span></td>
					<td class="cWindowFormVal"><textarea id="report-message" rows="3"></textarea></td>
				</tr>
				<tr class="hidden">
					<td class="cWindowFormKey"></td>
					<td class="cWindowFormVal"><input type="hidden" name="reportFunc" value="<?php echo $reportFunc; ?>" /></td>
				</tr>
			</div>
		</form>
<?php
		$html	.= ob_get_contents();
		ob_end_clean();
		
		ob_start();
?>
		<button class="button" onclick="joms.report.submit('<?php echo $reportFunc;?>','<?php echo $pageLink;?>','<?php echo $argsData;?>');" name="submit">
		<?php echo JText::_('CC BUTTON SEND');?>
		</button>
		<button class="button" onclick="javascript:cWindowHide();" name="cancel">
		<?php echo JText::_('CC BUTTON CANCEL');?>
		</button>
<?php
		$action	= ob_get_contents();
		ob_end_clean();

		
		if( !COMMUNITY_FREE_VERSION ) {
			// Change cWindow title
			$objResponse->addAssign('cwin_logo', 'innerHTML', JText::_('CC REPORT THIS'));
			$objResponse->addAssign('cWindowContent', 'innerHTML', $html );
			$objResponse->addScriptCall('cWindowActions', $action);
			$objResponse->addScriptCall('cWindowResize', 200);
		}else{
			$tmpl		= new CTemplate();
			$html		= $tmpl->fetch( 'freeversion.ajax' );
			$height		= 250;
			$buttons    = '<input type="button" class="button" onclick="cWindowHide();" value="' . JText::_('CC BUTTON CANCEL') . '"/>';
	
			$objResponse->addAssign('cwin_logo', 'innerHTML', JText::_('CC REPORT THIS'));
			$objResponse->addAssign('cWindowContent', 'innerHTML', $html );
			$objResponse->addScriptCall('cWindowActions', $buttons);
			$objResponse->addScriptCall('cWindowResize', $height + 220);
		}
		
		return $objResponse->sendResponse();
	}
	
	function ajaxSendReport()
	{
		$objResponse	= new JAXResponse();

		$reportFunc		= func_get_arg( 0 );
		$pageLink		= func_get_arg( 1 );
		$message		= func_get_arg( 2 );

		$argsCount		= func_num_args();
		$method			= explode( ',' , $reportFunc );

		$args			= array();
		$args[]			= $pageLink;
		$args[]			= $message;
		for($i = 3; $i < $argsCount; $i++ )
		{
			$args[]		= func_get_arg( $i );
		}

		if( is_array( $method ) && $method[0] != 'plugins' )
		{
			$controller	= JString::strtolower( $method[0] );
			
 			require_once( JPATH_ROOT . DS . 'components' . DS . 'com_community' . DS . 'controllers' . DS . 'controller.php' );
 			require_once( JPATH_ROOT . DS . 'components' . DS . 'com_community' . DS . 'controllers' . DS . $controller . '.php' );

			$controller	= JString::ucfirst( $controller );
 			$controller	= 'Community' . $controller . 'Controller';
 			$controller	= new $controller();
 
 			$output		= call_user_func_array( array( &$controller , $method[1] ) , $args );
		}
		else if( is_array( $method ) && $method[0] == 'plugins' )
		{
			// Application method calls
			$element	= JString::strtolower( $method[1] );
			
			require_once( JPATH_PLUGINS . DS . 'community' . DS . $element . '.php' );
			
			$className	= 'plgCommunity' . JString::ucfirst( $element );

			$output		= call_user_func_array( array( $className , $method[2] ) , $args );
		}
		ob_start();
?>
		<button class="button" onclick="javascript:cWindowHide();" name="cancel">
		<?php echo JText::_('CC BUTTON CLOSE');?>
		</button>
<?php
		$action	= ob_get_contents();
		ob_end_clean();
		
		// Change cWindow title
		$objResponse->addAssign('cwin_logo', 'innerHTML', JText::_('CC REPORT SENT'));
		$objResponse->addAssign('cWindowContent', 'innerHTML', $output);
		$objResponse->addScriptCall('cWindowActions', $action);
		$objResponse->addScriptCall('cWindowResize', 100);
		
		return $objResponse->sendResponse();
	}
}
