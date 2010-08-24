<?php
/**
 * @version $Id: locaweb_pgcerto.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Processors - Pagamento Certo Locaweb - http://www.pagamentocerto.com.br
 * @copyright 2008 Copyright (C) Helder Garcia - http://sounerd.com.br - http://investidorlegal.com.br
 * @author Helder Garcia <helder.garcia@gmail.com> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

class processor_locaweb_pgcerto extends XMLprocessor
{
	function info()
	{
		$info = array();
		$info['name']									= 'locaweb_pgcerto';
		$info['longname']								= _CFG_LOCAWEB_PGCERTO_LONGNAME;
		$info['statement']							= _CFG_LOCAWEB_PGCERTO_STATEMENT;
		$info['description'] 							= _CFG_LOCAWEB_PGCERTO_DESCRIPTION;
		$info['cc_list']									= 'visa,boleto';
		$info['notify_trail_thanks'] 				= true;

		return $info;
	}

	function settings()
	{
		$settings = array();
		$settings['chaveVendedor']				= 'Sua Chave de Vendedor';
		$settings['item_name']					= sprintf( _CFG_PROCESSOR_ITEM_NAME_DEFAULT, '[[cms_live_site]]', '[[user_name]]', '[[user_username]]' );
		$settings['customparams']				= "";

		return $settings;
	}

	function backend_settings()
	{
		$settings = array();
		$settings['aec_experimental']	= array( "p" );

		$settings['chaveVendedor']				= array( 'inputC' );
		$settings['item_name']					= array( 'inputE' );
		$settings['customparams']				= array( 'inputD' );

		$settings = AECToolbox::rewriteEngineInfo( null, $settings );

		return $settings;
	}

	function checkoutform( $request )
	{
		$name												= $request->metaUser->cmsUser->name;
		$email												= $request->metaUser->cmsUser->email;

		$var['params']['nome']					= array( 'inputC', _AEC_USERFORM_BILLFIRSTNAME_NAME, _AEC_USERFORM_BILLFIRSTNAME_NAME, $name);
		$var['params']['cpf']						= array( 'inputC', _CFG_LOCAWEB_PGCERTO_CPF_NAME, _CFG_LOCAWEB_PGCERTO_CPF_NAME, '');
		$var['params']['email']					= array( 'inputC', _CFG_LOCAWEB_PGCERTO_EMAIL_NAME, _CFG_LOCAWEB_PGCERTO_EMAIL_NAME, $email);

		$var['params']['endereco']				= array( 'inputC', _AEC_USERFORM_BILLADDRESS_NAME, _AEC_USERFORM_BILLADDRESS_NAME, '');
		$var['params']['complemento']		= array( 'inputC', _AEC_USERFORM_BILLADDRESS2_NAME, _AEC_USERFORM_BILLADDRESS2_NAME, '');
		$var['params']['bairro']					= array( 'inputC', _AEC_USERFORM_BILLSTATEPROV_NAME, _AEC_USERFORM_BILLSTATEPROV_NAME, '');
		$var['params']['cidade']					= array( 'inputC', _AEC_USERFORM_BILLCITY_NAME, _AEC_USERFORM_BILLCITY_NAME, '');
		$var['params']['estado']					= array( 'inputC', _AEC_USERFORM_BILLSTATE_NAME, _AEC_USERFORM_BILLSTATE_NAME, '');
		$var['params']['cep']						= array( 'inputC', _AEC_USERFORM_BILLZIP_NAME, _AEC_USERFORM_BILLZIP_NAME, '');

		// Create a selection box with payment options
		$paymentOptions							= array();
		$paymentOptions[]							= mosHTML::makeOption( 'CartaoCredito', 'Cartão de Crédito VISA' );
		$paymentOptions[]							= mosHTML::makeOption( 'Boleto', 'Boleto Bancário' );

		$var['params']['lists']['modulo']		= mosHTML::selectList($paymentOptions, 'modulo', 'size="2"', 'value', 'text', 0);
		$var['params']['modulo']					= array( 'list', _CFG_LOCAWEB_PGCERTO_MODULE_NAME, _CFG_LOCAWEB_PGCERTO_MODULE_DESC);

		// Create a selection box with type of buyer
		$tipoPessoa										= array();
		$tipoPessoa[]									= mosHTML::makeOption( 'Fisica', 'Pessoa Física' );
		$tipoPessoa[]									= mosHTML::makeOption( 'Juridica', 'Pessoa Jurídica' );

		$var['params']['lists']['tipoPessoa']	= mosHTML::selectList($tipoPessoa, 'tipoPessoa', 'size="2"', 'value', 'text', 0);
		$var['params']['tipoPessoa']			= array( 'list', _CFG_LOCAWEB_PGCERTO_TIPOPESSOA_NAME, _CFG_LOCAWEB_PGCERTO_TIPOPESSOA_DESC);

		$var['params']['cnpj']						= array( 'inputC', _CFG_LOCAWEB_PGCERTO_CNPJ_NAME, _CFG_LOCAWEB_PGCERTO_CNPJ_NAME, '');
		$var['params']['razaoSocial']			= array( 'inputC', _CFG_LOCAWEB_PGCERTO_RAZAOSOCIAL_NAME, _CFG_LOCAWEB_PGCERTO_RAZAOSOCIAL_NAME, '');

		return $var;
	}

	function createRequestXML( $request )
	{
		$subDesc											= AECToolbox::rewriteEngineRQ( $this->settings['item_name'], $request );
		$separators										= array(",", ".");			// We want them removed
		$valorTotal										= str_replace($separators, "", trim( $request->int_var['amount'] ));
		$separators										= array("-", "/");			// We want them removed
		$cep													= str_replace($separators, "", trim( $request->int_var['params']['cep'] ));
		$cnpj												= str_replace($separators, "", trim( $request->int_var['params']['cnpj'] ));
		$cpf													= str_replace($separators, "", trim( $request->int_var['params']['cpf'] ));

		// Start xml, add login and transaction key, as well as invoice number
		$content =	'<?xml version="1.0" encoding="utf-8"?>'
					. '<LocaWeb>'
					. '<Comprador>'
					. '<Nome>'					. trim( $request->int_var['params']['nome'] )						. '</Nome>'
					. '<Email>'					. trim( $request->int_var['params']['email'] )						. '</Email>'
					. '<Cpf>'						. $cpf																					. '</Cpf>';

		if (trim( $request->int_var['params']['tipoPessoa']) == 'Juridica') {
					$content .= '<TipoPessoa>Juridica</TipoPessoa>'
					. '<RazaoSocial>'		. trim( $request->int_var['params']['razaoSocial'] )			. '</RazaoSocial>'
					. '<Cnpj>'					. $cnpj																					. '</Cnpj>';
		} else {
					$content .= '<TipoPessoa>Fisica</TipoPessoa>';
		}

		$content .= '</Comprador>'
					. '<Pagamento>'
					. '<Modulo>'				. trim( $request->int_var['params']['modulo'] )					. '</Modulo>';

		if (trim( $request->int_var['params']['modulo']) == 'CartaoCredito') {
					$content .= '<Tipo>Visa</Tipo>';
		}

		$content .= '</Pagamento>'
					. '<Pedido>'
					. '<Numero>'				. trim( $request->invoice->invoice_number )									. '</Numero>'
					. '<ValorSubTotal>'		. $valorTotal																			. '</ValorSubTotal>'
					. '<ValorFrete>000</ValorFrete>'
					. '<ValorAcrescimo>000</ValorAcrescimo>'
					. '<ValorDesconto>000</ValorDesconto>'
					. '<ValorTotal>'			. $valorTotal																			. '</ValorTotal>'
					. '<Itens>'
					. '<Item>'
					. '<CodProduto>1</CodProduto>'
					. '<DescProduto>'		.  $subDesc																			. '</DescProduto>'
					. '<Quantidade>1</Quantidade>'
					. '<ValorUnitario>'		. $valorTotal																			. '</ValorUnitario>'
					. '<ValorTotal>'			. $valorTotal																			. '</ValorTotal>'
					. '</Item>'
					. '</Itens>'
					. '<Cobranca>'
					. '<Endereco>'			. trim( $request->int_var['params']['endereco'] )				. '</Endereco>'
					. '<Numero>'				. trim( $request->int_var['params']['complemento'] )		. '</Numero>'
					. '<Bairro>'					. trim( $request->int_var['params']['bairro'] )						. '</Bairro>'
					. '<Cidade>'				. trim( $request->int_var['params']['cidade'] )					. '</Cidade>'
					. '<Cep>'						. $cep																					. '</Cep>'
					. '<Estado>'				. trim( $request->int_var['params']['estado'] )					. '</Estado>'
					. '</Cobranca>'
					. '</Pedido>'
					. '</LocaWeb>';

		return $content;
	}

	function transmitRequestXML( $xmlTransacao, $request )
	{

		//$this->addParams( array( 'free_trial' => $response['pending_reason'] ), 'params', true );
		// ############# Inicio do registro da transação #############
		$wsPagamentoCertoLocaweb								= 'https://www.pagamentocerto.com.br/vendedor/vendedor.asmx?WSDL';			// Web Service para registro da transação
		$urlPagamentoCertoLocaweb								= 'https://www.pagamentocerto.com.br/pagamento/pagamento.aspx';					// URL para inicio da transação

		// Montagem dos dados da transação

		// Define os valores inicias de postagem
		$chaveVendedor													= $this->settings['chaveVendedor'];																														// Chave do vendedor
		$urlRetornoLoja													= AECToolbox::deadsureURL( 'index.php?option=com_acctexp&amp;task=locaweb_pgcertonotification' );		// URL de retorno


		$parms = new stdClass();

		// Inicializa o cliente SOAP
		$soap = @new SoapClient($wsPagamentoCertoLocaweb, array(
		        'trace' => true,
		        'exceptions' => true,
		        'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP,
		        'connection_timeout' => 1000
		));

		// Postagem dos parâmetros
		$parms->chaveVendedor									= utf8_encode($chaveVendedor);
		$parms->urlRetorno											= utf8_encode($urlRetornoLoja);
		$parms->xml														= utf8_encode($xmlTransacao);


		// Resgata o XML de retorno do processo
		$XMLresposta														= $soap->IniciaTransacao($parms);
		$XMLresposta 														= $XMLresposta->IniciaTransacaoResult;

		// Carrega o XML
		$objDom																= new DomDocument();
		$loadDom															= $objDom->loadXML($XMLresposta);

		// Resgata os dados iniciais do retorno da transação
		$nodeCodRetornoInicioTemp										= $objDom->getElementsByTagName('CodRetorno');
		$nodeCodRetornoInicio											= $nodeCodRetornoInicioTemp->item(0);
		$CodRetornoInicio												= $nodeCodRetornoInicio->nodeValue;

		$nodeMensagemRetornoInicioTemp							= $objDom->getElementsByTagName('MensagemRetorno');
		$nodeMensagemRetornoInicio							= $nodeMensagemRetornoInicioTemp->item(0);
		$MensagemRetorno											= $nodeMensagemRetornoInicio->nodeValue;

		// Verifica se o registro da transação foi feito com sucesso
		if ($CodRetornoInicio == '0') {

			// Resgata o id e a mensagem da transação
			$nodeIdTransacaoTemp											= $objDom->getElementsByTagName('IdTransacao');
			$nodeIdTransacao												= $nodeIdTransacaoTemp->item(0);
			$IdTransacao													= $nodeIdTransacao->nodeValue;

			$nodeCodigoRefTemp												= $objDom->getElementsByTagName('Codigo');
			$nodeCodigoRef												= $nodeCodigoRefTemp->item(0);
			$Codigo															= $nodeCodigoRef->nodeValue;

			// Inicia a transação
			header('location: ' . $urlPagamentoCertoLocaweb . '?tdi=' . $IdTransacao);
			exit();

			// Em caso de erro no proceesso
		} else {

		    // Exibe a mensagem de erro
		    $return['error']													=	'<b>Erro: (' . utf8_decode($CodRetornoInicio) . ') ' . utf8_decode($MensagemRetorno) . '</b>';

		}

		// ############# Fim do registro da transação #############

		return $return;

	}

	function parseNotification( $post )
	{

		$response = array();
		$response['invoice']												= '';

		// Endereços do Pagamento Certo
		$wsPagamentoCertoLocaweb								= "https://www.pagamentocerto.com.br/vendedor/vendedor.asmx?WSDL";		// Web Service para consulta da transação

		// Define os valores de retorno
		$chaveVendedor													= $this->settings['chaveVendedor'];																	// Chave do vendedor
		$idTransacao														= $post['tdi'];																										// ID da transação

		// Verifica se o ID da transação foi postado
		if (trim($idTransacao) != '') {

			// Inicializa o cliente SOAP
			$soap = @new SoapClient($wsPagamentoCertoLocaweb, array(
					'trace' => true,
					'exceptions' => true,
					'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP,
					'connection_timeout' => 1000
			));

			// Postagem dos parâmetros
			$parms 															= new stdClass();
			$parms->chaveVendedor 								= utf8_encode($chaveVendedor);
			$parms->idTransacao 									= utf8_encode($idTransacao);

			// Resgata o XML de retorno do processo

			$XMLresposta													= $soap->ConsultaTransacao($parms);
			$XMLresposta													= $XMLresposta->ConsultaTransacaoResult;

			$XMLresposta													= $soap->ConsultaTransacao($parms);
			$XMLresposta													= $XMLresposta->ConsultaTransacaoResult;

			// Carrega o XML
			$objDom 															= new DomDocument();
			$loadDom 														= $objDom->loadXML($XMLresposta);

			// Resgata os dados iniciais do retorno da transação
			$nodeCodRetornoConsultaTemp								= $objDom->getElementsByTagName('CodRetorno');
			$nodeCodRetornoConsulta								= $nodeCodRetornoConsultaTemp->item(0);
			$CodRetornoConsulta										= $nodeCodRetornoConsulta->nodeValue;

			$nodeMensagemRetornoConsultaTemp					= $objDom->getElementsByTagName('MensagemRetorno');
			$nodeMensagemRetornoConsulta					= $nodeMensagemRetornoConsultaTemp->item(0);
			$MensagemRetornoConsulta							= $nodeMensagemRetornoConsulta->nodeValue;

			if ($CodRetornoConsulta == '15') {
				// 15 -> Transacao processada
				// Resgata os dados da transação
				$nodeIdTransacaoTemp										= $objDom->getElementsByTagName('IdTransacao');
				$nodeIdTransacao										= $nodeIdTransacaoTemp->item(0);
				$IdTransacao												= $nodeIdTransacao->nodeValue;

				$nodeCodigoTransacaoTemp								= $objDom->getElementsByTagName('Codigo');
				$nodeCodigoTransacao								= $nodeCodigoTransacaoTemp->item(0);
				$Codigo														= $nodeCodigoTransacao->nodeValue;

				$nodeDataTransacaoTemp									= $objDom->getElementsByTagName('Data');
				$nodeDataTransacao									= $nodeDataTransacaoTemp->item(0);
				$Data															= $nodeDataTransacao->nodeValue;

				// Resgata os dados do comprador no Pagamento Certo
				$nodeCompradorNomeTemp								= $objDom->getElementsByTagName('Nome');
				$nodeCompradorNome								= $nodeCompradorNomeTemp->item(0);
				$Nome															= $nodeCompradorNome->nodeValue;

				$nodeCompradorEmailTemp								= $objDom->getElementsByTagName('Email');
				$nodeCompradorEmail								= $nodeCompradorEmailTemp->item(0);
				$Email															= $nodeCompradorEmail->nodeValue;

				$nodeCompradorCpfTemp									= $objDom->getElementsByTagName('Cpf');
				$nodeCompradorCpf									= $nodeCompradorCpfTemp->item(0);
				$Cpf																= $nodeCompradorCpf->nodeValue;

				$nodeCompradorTipoPessoaTemp						= $objDom->getElementsByTagName('TipoPessoa');
				$nodeCompradorTipoPessoa						= $nodeCompradorTipoPessoaTemp->item(0);
				$TipoPessoa												= $nodeCompradorTipoPessoa->nodeValue;

				$nodeCompradorRazaoSocialTemp						= $objDom->getElementsByTagName('RazaoSocial');
				$nodeCompradorRazaoSocial						= $nodeCompradorRazaoSocialTemp->item(0);
				$RazaoSocial												= $nodeCompradorRazaoSocial->nodeValue;

				$nodeCompradorCNPJTemp									= $objDom->getElementsByTagName('Cnpj');
				$nodeCompradorCNPJ									= $nodeCompradorCNPJTemp->item(0);
				$Cnpj															= $nodeCompradorCNPJ->nodeValue;


				// Resgata os dados do pagamento
				$nodeMensagemModuloPagamentoTemp			= $objDom->getElementsByTagName('Modulo');
				$nodeMensagemModuloPagamento			= $nodeMensagemModuloPagamentoTemp->item(0);
				$Modulo														= $nodeMensagemModuloPagamento->nodeValue;

				$nodeMensagemTipoModuloPagamentoTemp	= $objDom->getElementsByTagName('Tipo');
				$nodeMensagemTipoModuloPagamento	= $nodeMensagemTipoModuloPagamentoTemp->item(0);
				$Tipo															= $nodeMensagemTipoModuloPagamento->nodeValue;

				$nodeProcessadoPagamentoTemp						= $objDom->getElementsByTagName('Processado');
				$nodeProcessadoPagamento						= $nodeProcessadoPagamentoTemp->item(0);
				$Processado												= $nodeProcessadoPagamento->nodeValue;

				$nodeMensagemRetornoPagamentoTemp			= $objDom->getElementsByTagName('MensagemRetorno');
				$nodeMensagemRetornoPagamento			= $nodeMensagemRetornoPagamentoTemp->item(1);
				$MensagemRetornoPagamento					= $nodeMensagemRetornoPagamento->nodeValue;

				$nodeMensagemRetornoPagamentoTemp			= $objDom->getElementsByTagName('MensagemRetorno');
				$nodeMensagemRetornoPagamento			= $nodeMensagemRetornoPagamentoTemp->item(0);
				$MensagemRetorno									= $nodeMensagemRetornoPagamento->nodeValue;

				// Resgata os dados do pedido
				$nodeCodigoPedidoTemp										= $objDom->getElementsByTagName('Numero');
				$nodeCodigoPedido										= $nodeCodigoPedidoTemp->item(0);
				$Numero														= $nodeCodigoPedido->nodeValue;

				$nodeValorTotalTemp 											= $objDom->getElementsByTagName('ValorTotal');
				$nodeValorTotal 											= $nodeValorTotalTemp ->item(0);
				$ValorTotal													= $nodeValorTotal->nodeValue;

				// Monta os dados de resposta para o componente AEC
				// Se foi usado cartao de credito a resposta eh definitiva
				$response													= array();
				$response['invoice']										= utf8_decode($Numero);

				if (strcmp($Modulo, 'CartaoCredito') == 0 && strcmp($Processado, 'true') == 0) {
						$response['valid']								= true;
						$response['fullresponse']['processado'] = utf8_decode($Processado) .  'Mensagem de retorno: ' . utf8_decode($MensagemRetornoPagamento);
						$response['amount_paid'] 					= $ValorTotal;
				} elseif (strcmp($Modulo, 'Boleto') == 0 && strcmp($Processado, 'true') == 0 && strcmp($MensagemRetornoPagamento, 'Boleto emitido.') == 0) {
						// Se foi boleto devemos esperar a compensacao
						$response['fullresponse']['warning'] = '(' . utf8_decode($CodRetornoConsulta) . ') ' . utf8_decode($MensagemRetornoPagamento);
						$response['valid']								= false;
						$response['pending']							= true;
						$response['pending_reason']				= utf8_decode(_PENDING_REASON_WAITING_RESPONSE);
						/* Troubleshooting purpose
						$myFile = "/var/www/hlbog/desenvolvimento/logs/consulta.xml";
						$fh = fopen($myFile, 'w') or die("can't open file");
						fwrite($fh, $XMLresposta);
						fclose($fh);
						*/
				} elseif (strcmp($Modulo, 'Boleto') == 0 && strcmp($Processado, 'true') == 0 && strcmp($MensagemRetornoPagamento, 'Boleto emitido.') != 0) {
						// Boleto compensado - cleared
						$response['valid']								= true;
						$response['fullresponse']['processado'] = utf8_decode($Processado) .  'Mensagem de retorno: ' . utf8_decode($MensagemRetornoPagamento);
						$response['amount_paid'] 					= $ValorTotal;
				}
				// We will need this info later to provide the option to reissue boleto
				$request->invoice->addParams( array( 'IdTransacao' => $IdTransacao ) );
				$request->invoice->check();
				$request->invoice->store();
			} else {
				// Monta os dados de resposta para o componente AEC
				$response['fullresponse']['erro'] = '(' . utf8_decode($CodRetornoConsulta) . ') ' . utf8_decode($MensagemRetornoConsulta);
				$response['valid']												= false;
				$response['pending']											= true;
				if ($CodRetornoConsulta == '12' || $CodRetornoConsulta == '13') {
						// 12 -> Transacao ainda nao processada
						// 13 -> Transacao em processamento
						$response['pending_reason']						= utf8_decode(_PENDING_REASON_WAITING_RESPONSE);
				}
			}
		} else {
		    // Monta os dados de resposta para o componente AEC
		    $response['responsestring']							= 	'Erro: ID da transação não informado.';
			$response['valid']											= false;
			$response['pending']										= true;
			$response['pending_reason']							= $response['responsestring'];
		}
		return $response;
	}

	function invoiceCreationAction( $objInvoice )
	{
	/* para usar depois
		$this->addParams( array( 'creator_ip' => $_SERVER['REMOTE_ADDR'] ), 'params', false );

		$this->storeload();
	*/
	}
}

?>
