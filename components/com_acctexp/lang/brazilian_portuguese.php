<?php
/**
 * @version $Id: brazilian_portuguese.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Language - Frontend - English
 * @copyright 2006-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

if( defined( '_AEC_LANG' ) ) {
	return;
}

define( '_AEC_EXPIRE_TODAY',	'Esta conta est&aacute; activa at&eacute; o dia de hoje' );
define( '_AEC_EXPIRE_FUTURE',	'Esta conta est&aacute; activa at&eacute;' );
define( '_AEC_EXPIRE_PAST',	'Esta conta &eacute; v&aacute;lida at&eacute;' );
define( '_AEC_DAYS_ELAPSED',	'dia(s) decorridos');
define( '_AEC_EXPIRE_TRIAL_TODAY',	'Est&aacute; demontra&ccedil;&atilde;o est&aacute; activa at&eacute; hoje' );
define( '_AEC_EXPIRE_TRIAL_FUTURE',	'Est&aacute; demontra&ccedil;&atilde;o est&aacute; activa at&eacute;' );
define( '_AEC_EXPIRE_TRIAL_PAST',	'Est&aacute; demonstra&ccedil;&atilde;o est&aacute; v&aacute;lida at&eacute;' );

define( '_AEC_EXPIRE_NOT_SET',	'N&atilde;o Definido' );
define( '_AEC_GEN_ERROR',	' Erro Geral: Houve um problema com o processamento do seu pedido. Por favor contacte o Administrador do Site.' );

// payments
define( '_AEC_PAYM_METHOD_FREE',	'Gr&aacute;tis' );
define( '_AEC_PAYM_METHOD_NONE',	'Nenhum' );
define( '_AEC_PAYM_METHOD_TRANSFER',	'Transfer&ecirc;ncia' );

// processor errors
define( '_AEC_MSG_PROC_INVOICE_FAILED_SH',	'Falha no processamento da Factura' );
define( '_AEC_MSG_PROC_INVOICE_FAILED_EV',	'Processamento de notifica&ccedil;&atilde;o %s para %s falhou - o n&uacute;mero do recibo n&atilde;o existe:' );
define( '_AEC_MSG_PROC_INVOICE_ACTION_SH',	'Ac&ccedil;&atilde;o Factura do Pagamento' );
define( '_AEC_MSG_PROC_INVOICE_ACTION_EV',	'Resposta a Notifica&ccedil;&atilde;o de Pagamento:' );
define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_STATUS',	'Estado da Factura' );
define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_FRAUD',	'Falhou a verifica&ccedil;&atilde;o do valor, pago: %s, factura: %s - pagamento abortado' );
define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_CURR',	'Falou a verifica&ccedil;&atilde;o da moeda, pago %s, factura: %s - pagamento abortado' );
define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_VALID',	'Pagamento v&aacute;lido, ac&ccedil;&atilde;o realizada' );
define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_VALID_APPFAIL',	'Pagamento v&aacute;lido, ac&ccedil;&atilde;o falhou!' );
define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_TRIAL',	'Pagamento v&aacute;lido - demonstra&ccedil;&atilde;o gratuita' );
define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_PEND',	'Pagamento invalido - est&aacute; pendente, raz&atilde;o: %s' );
define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_CANCEL',	'Sem pagamento - inscri&ccedil;&atilde;o Cancelada' );
define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_CHARGEBACK',	'Sem Pagamento - Estorno' );
define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_CHARGEBACK_SETTLE',	'Sem Pagamento - Estorno da Liquida&ccedil;&atilde;o' );
define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_USTATUS',	', O estado do utilizador foi actualizado para \'Cancelado\'' );
define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_USTATUS_HOLD',	', O estado do utilizador foi actualizado para \'Em Espera\'' );
define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_USTATUS_ACTIVE',	', O estado do utilizador foi actualizado para \'Activo\'' );
define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_EOT',	'Sem Pagamento - Fim da inscri&ccedil;&atilde;o' );
define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_DUPLICATE','Sem pagamento - Duplicado' );
define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_NULL','Sem Pagamento - Nulo' );
define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_U_ERROR',	'Erro Desconhecido' );
define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_REFUND',	'Sem Pagamento - inscri&ccedil;&atilde;o Eliminada (retorno)' );
define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_EXPIRED',	', Utilizador expirou' );

// --== COUPON INFO ==--
define( '_COUPON_INFO',	'Cup&otilde;es:' );
define( '_COUPON_INFO_CONFIRM',	'Se desejar utilizar um ou mais cup&otilde;es para este pagamento, poder&aacute; realiza-lo na p&aacute;gina de verifica&ccedil;&atilde;o.' );
define( '_COUPON_INFO_CHECKOUT',	'Por favor introduza o c&oacute;digo do cup&atilde;o aqui e clique no but&atilde;o para adiciona-lo a este pagamento.' );

// end mic ########################################################

// --== PAYMENT PLANS PAGE ==--

define( '_PAYPLANS_HEADER', 'Planos de Pagamento');
define( '_NOPLANS_ERROR', 'N&atilde;o existem planos de pagamento dispon&iacute;veis. Por favor contacte o administrador.');
define( '_NOPLANS_AUTHERROR', 'You are not authorized to access this option. Please contact administrator if you have any further questions.');
define( '_PLANGROUP_BACK', '&lt; Go back');

// --== ACCOUNT DETAILS PAGE ==--
define( '_CHK_USERNAME_AVAIL', 'O Nome de Utilizador %s n&atilde;o dispon&iacute;vel');
define( '_CHK_USERNAME_NOTAVAIL', 'O Nome de Utilizador %s j&aacute; se encontra atribuido!');

// --== MY SUBSCRIPTION PAGE ==--
define( '_MYSUBSCRIPTION_TITLE', 'Minha Conta');
define( '_MEMBER_SINCE', 'Membro desde');
define( '_HISTORY_COL1_TITLE', 'Factura');
define( '_HISTORY_COL2_TITLE', 'Valor');
define( '_HISTORY_COL3_TITLE', 'Data de Pagamento');
define( '_HISTORY_COL4_TITLE', 'Metodo');
define( '_HISTORY_COL5_TITLE', 'Ac&ccedil;&atilde;o');
define( '_HISTORY_COL6_TITLE', 'Plano');
define( '_HISTORY_ACTION_REPEAT', 'pagar');
define( '_HISTORY_ACTION_CONFIRM', 'confirmar');
define( '_HISTORY_ACTION_CANCEL', 'cancelar');
define( '_RENEW_LIFETIME', 'Voc&ecirc; tem um tempo &uacute;til de inscri&ccedil;&atilde;o.');
define( '_RENEW_DAYSLEFT', 'Dias em Falta');
define( '_RENEW_DAYSLEFT_TRIAL', 'Dias em Falta da Demonstra&ccedil;&atilde;o');
define( '_RENEW_DAYSLEFT_EXCLUDED', 'Est&aacute; exclu&iacute;do por expira&ccedil;&atilde;o');
define( '_RENEW_DAYSLEFT_INFINITE', '&infin;');
define( '_RENEW_INFO', 'Est&aacute; a utilizar pagamentos recorrentes.');
define( '_RENEW_OFFLINE', 'Renovar');
define( '_RENEW_BUTTON_UPGRADE', 'Upgrade');
define( '_PAYMENT_PENDING_REASON_ECHECK', 'Confirma&ccedil;&atilde;o n&atilde;o esclarecida (1-4 dias uteis)');
define( '_PAYMENT_PENDING_REASON_TRANSFER', 'aguardando pagamento por transfer&ecirc;ncia');
define( '_YOUR_SUBSCRIPTION', 'A sua inscri&ccedil;&atilde;o');
define( '_YOUR_FURTHER_SUBSCRIPTIONS', 'Outras Inscri&ccedil;&otilde;es');
define( '_PLAN_PROCESSOR_ACTIONS', 'Para isto, tem as seguintes op&ccedil;&otilde;es:');
define( '_AEC_SUBDETAILS_TAB_OVERVIEW', 'Vis&atilde;o Geral');
define( '_AEC_SUBDETAILS_TAB_INVOICES', 'Facturas');
define( '_AEC_SUBDETAILS_TAB_DETAILS', 'Detalhes');

define( '_HISTORY_ACTION_PRINT', 'print');
define( '_INVOICEPRINT_DATE', 'Date');
define( '_INVOICEPRINT_ID', 'ID');
define( '_INVOICEPRINT_REFERENCE_NUMBER', 'Reference Number');
define( '_INVOICEPRINT_ITEM_NAME', 'Item Name');
define( '_INVOICEPRINT_UNIT_PRICE', 'Unit Price');
define( '_INVOICEPRINT_QUANTITY', 'Quantity');
define( '_INVOICEPRINT_TOTAL', 'Total');
define( '_INVOICEPRINT_GRAND_TOTAL', 'Grand Total');

define( '_INVOICEPRINT_ADDRESSFIELD', 'Enter your Address here - it will then show on the printout.');
define( '_INVOICEPRINT_PRINT', 'Print');
define( '_INVOICEPRINT_BLOCKNOTICE', 'This block (including the text field and print button) will not show on your printout.');
define( '_INVOICEPRINT_PRINT_TYPEABOVE', 'Please type your address into the field above.');
define( '_INVOICEPRINT_PAIDSTATUS_UNPAID', '<strong>This invoice has not been paid yet.</strong>');
define( '_INVOICEPRINT_PAIDSTATUS_PAID', 'This invoice has been paid on: %s');

define( '_AEC_YOUSURE', 'Are you sure?');

// --== EXPIRATION PAGE ==--
define( '_EXPIRE_INFO', 'A sua Conta est&aacute; activa at&eacute;');
define( '_RENEW_BUTTON', 'Renovar Agora');
define( '_RENEW_BUTTON_CONTINUE', 'Estenda anterior Conta de Membro');
define( '_ACCT_DATE_FORMAT', '%d-%m-%Y');
define( '_EXPIRED', 'A sua conta est&aacute; desactivada; Obrigado por nos contactar para a renova&ccedil;&atilde;o da sua inscri&ccedil;&atilde;o. Data de Expira&ccedil;&atilde;o :');
define( '_EXPIRED_TRIAL', 'O seu per&iacute;odo de demonstra&ccedil;&atilde;o expira em: ');
define( '_ERRTIMESTAMP', 'Impossivel de converter Data/Hora.');
define( '_EXPIRED_TITLE', 'Conta Expirada !');
define( '_DEAR', 'Caro(a) %s');

// --== CONFIRMATION FORM ==--
define( '_CONFIRM_TITLE', 'Formul&aacute;rio de Confirma&ccedil;&atilde;o');
define( '_CONFIRM_COL1_TITLE', 'Conta');
define( '_CONFIRM_COL2_TITLE', 'Detalhe');
define( '_CONFIRM_COL3_TITLE', 'Valor');
define( '_CONFIRM_ROW_NAME', 'Nome: ');
define( '_CONFIRM_ROW_USERNAME', 'Nome de Utilizador: ');
define( '_CONFIRM_ROW_EMAIL', 'E-mail:');
define( '_CONFIRM_INFO', 'Por favor clique no bot&atilde;o Continuar para completar a sua inscri&ccedil;&atilde;o.');
define( '_BUTTON_CONFIRM', 'Continua');
define( '_CONFIRM_TOS', 'Eu li e concordo com os Termos do Servi&ccedil;o');
define( '_CONFIRM_TOS_IFRAME', 'Eu li e concordo com os Termos do Servi&ccedil;o (acima)');
define( '_CONFIRM_TOS_ERROR', 'Por favor leia e concorde com os nossos Termos do Servi&ccedil;o');
define( '_CONFIRM_COUPON_INFO', 'Se tiver um cup&atilde;o promocional, pode inserir o seu codigo na Pagina de Verifica&ccedil;&atilde;o para obter um desconto sobre o seu pagamento');
define( '_CONFIRM_COUPON_INFO_BOTH', 'Se tiver um cup&atilde;o promocional, pode inserir o seu c&oacute;digo aqui, ou na Pagina de Verifica&ccedil;&atilde;o para obter um desconto sobre o seu pagamento');
define( '_CONFIRM_FREETRIAL', 'Demonstra&ccedil;&atilde;o Gr&aacute;tis');

// --== SHOPPING CART FORM ==--
define( '_CART_TITLE', 'Shopping Cart');
define( '_CART_ROW_TOTAL', 'Total');
define( '_CART_INFO', 'Please use the Continue-Button below to complete your purchase.');

// --== EXCEPTION FORM ==--
define( '_EXCEPTION_TITLE', 'Additional Information Required');
define( '_EXCEPTION_TITLE_NOFORM', 'Please note:');
define( '_EXCEPTION_INFO', 'To proceed with your checkout, we need you to provide additional information as specified below:');

// --== PROMPT PASSWORD FORM ==--
define( '_AEC_PROMPT_PASSWORD', 'por raz&otilde;es de seguran&ccedil;a, precisa inserir a sua senha para continuar.');
define( '_AEC_PROMPT_PASSWORD_WRONG', 'A Senha inserida n&atilde;o corresponde com a sua senha indicada na inscri&ccedil;&atilde;o. Por favor tente novamente.');
define( '_AEC_PROMPT_PASSWORD_BUTTON', 'Continua');

// --== CHECKOUT FORM ==--
define( '_CHECKOUT_TITLE', 'Verifica&ccedil;&atilde;o');
define( '_CHECKOUT_INFO', 'A sua inscri&ccedil;&atilde;o foi guardada, Nesta p&aacute;gina pode completar o seu pagamento - %s. Se acorrer algum erro, pode sempre voltar atr&aacute;s e retomar este processo, fazendo o acesso no nosso site com o seu Nome de utilizador e Senha - O nosso Sistema fornecer&aacute; uma op&ccedil;&atilde;o para repetir o seu pagamento novamente..');
define( '_CHECKOUT_INFO_REPEAT', 'Obrigado por voltar. Nesta p&aacute;gina, poder&aacute; completar o seu pagamento - %s. Se acorrer algum erro, pode sempre voltar atr&aacute;s e retomar este processo, fazendo o login no nosso site com o seu Nome de utilizador e Senha - O nosso Sistema fornecer&aacute; uma op&ccedil;&atilde;o para repetir o seu pagamento novamente.');
define( '_BUTTON_CHECKOUT', 'Verifica&ccedil;&atilde;o');
define( '_BUTTON_APPEND', 'Anexar');
define( '_BUTTON_APPLY', 'Aplicar');
define( '_BUTTON_EDIT', 'Editar');
define( '_BUTTON_SELECT', 'Selecionar');
define( '_CHECKOUT_COUPON_CODE', 'C&oacute;digo Cup&atilde;o');
define( '_CHECKOUT_INVOICE_AMOUNT', 'Valor da Factura');
define( '_CHECKOUT_INVOICE_COUPON', 'Cup&atilde;o');
define( '_CHECKOUT_INVOICE_COUPON_REMOVE', 'remover');
define( '_CHECKOUT_INVOICE_TOTAL_AMOUNT', 'Valor Total');
define( '_CHECKOUT_COUPON_INFO', 'Se tiver um cup&atilde;o promocional, pode inserir aqui o eu c&oacute;digo para obter um desconto no seu pagamento');
define( '_CHECKOUT_GIFT_HEAD', 'Gift to another user');
define( '_CHECKOUT_GIFT_INFO', 'Enter details for another user of this site to give the item(s) you are about to purchase to that account.');

define( '_AEC_TERMTYPE_TRIAL', 'Factura&ccedil;&atilde;o Inicial');
define( '_AEC_TERMTYPE_TERM', 'Termo Regular de Factura&ccedil;&atilde;o');
define( '_AEC_CHECKOUT_TERM', 'Termo de Factura&ccedil;&atilde;o');
define( '_AEC_CHECKOUT_NOTAPPLICABLE', 'n&atilde;o aplic&aacute;vel');
define( '_AEC_CHECKOUT_FUTURETERM', 'termo futuro');
define( '_AEC_CHECKOUT_COST', 'Custo');
define( '_AEC_CHECKOUT_TAX', 'Tax');
define( '_AEC_CHECKOUT_DISCOUNT', 'Desconto');
define( '_AEC_CHECKOUT_TOTAL', 'Total');
define( '_AEC_CHECKOUT_DURATION', 'Dura&ccedil;&atilde;o');

define( '_AEC_CHECKOUT_DUR_LIFETIME', 'Dura&ccedil;&atilde;o');

define( '_AEC_CHECKOUT_DUR_DAY', 'Dia');
define( '_AEC_CHECKOUT_DUR_DAYS', 'Dias');
define( '_AEC_CHECKOUT_DUR_WEEK', 'Semana');
define( '_AEC_CHECKOUT_DUR_WEEKS', 'Semanas');
define( '_AEC_CHECKOUT_DUR_MONTH', 'M&ecirc;s');
define( '_AEC_CHECKOUT_DUR_MONTHS', 'Meses');
define( '_AEC_CHECKOUT_DUR_YEAR', 'Ano');
define( '_AEC_CHECKOUT_DUR_YEARS', 'Anos');

// --== ALLOPASS SPECIFIC ==--
define( '_REGTITLE','INSCRI&Ccedil;&Atilde;O');
define( '_ERRORCODE','Erro de C&oacute;digo');
define( '_FTEXTA','O c&oacute;digo utilizado n&atilde;o &eacute; v&aacute;lido! Para obter um c&oacute;digo v&aacute;lido, disque o n&uacute;mero de telefone, indicado na janela pop-up, ap&oacute;s ter clicado no &iacute;cone relativo ao seu pa&iacute;s. O seu browser dever&aacute; permitir o uso de cookies. Se voc&ecirc; tiver a certeza de que o seu c&oacute;digo est&aacute; correto, aguarde alguns segundos e tente novamente! Se n&atilde;o, tome nota da data e hora deste aviso de erro e informe o Webmaster deste problema, indicando o c&oacute;digo utilizado.');
define( '_RECODE','Introduza o c&oacute;digo novamente!');

// --== REGISTRATION STEPS ==--
define( '_STEP_DATA', 'Os seus Dados');
define( '_STEP_CONFIRM', 'Confirmar');
define( '_STEP_PLAN', 'Selecionar Plano');
define( '_STEP_EXPIRED', 'Expirou!');

// --== NOT ALLOWED PAGE ==--
define( '_NOT_ALLOWED_HEADLINE', '&Eacute; necess&aacute;rio ser Membro!');
define( '_NOT_ALLOWED_FIRSTPAR', 'O conte&uacute;do que pretende visualizar apenas se encontra dispon&iacute;vel para os membros do Site. Se j&aacute; &eacute; Membro, processa ao seu login para poder visualizar o conte&uacute;do. Por favor clique no link se pretender registar-se: ');
define( '_NOT_ALLOWED_REGISTERLINK', 'P&aacute;gina de Inscri&ccedil;&atilde;o');
define( '_NOT_ALLOWED_FIRSTPAR_LOGGED', 'O conte&uacute;do que pretende visualizar apenas est&aacute; dispon&iacute;vel para membros do Site com determinada Inscri&ccedil;&atilde;o. Por favor clique no seguinte link se pretende modificar a sua inscri&ccedil;&atilde;o: ');
define( '_NOT_ALLOWED_REGISTERLINK_LOGGED', 'P&aacute;gina de Inscri&ccedil;&atilde;o');
define( '_NOT_ALLOWED_SECONDPAR', 'Registar-se apenas demorar&aacute; alguns minutos - n&oacute;s usamos o servi&ccedil;o de:');

// --== CANCELLED PAGE ==--
define( '_CANCEL_TITLE', 'Resultado da Inscri&ccedil;&atilde;o: Cancelada!');
define( '_CANCEL_MSG', 'O nosso Sistema recebeu a informa&ccedil;&atilde;o, que voc&ecirc; escolheu cancelar o seu pagamento. Se isto aconteceu devido a um problema encontrado no nosso site, por favor n&atilde;o hesite em nos contactar!');

// --== PENDING PAGE ==--
define( '_WARN_PENDING', 'A sua conta encontra-se pendente. Se continuar neste estado durante algumas horas e o sue pagamento for confirmado, por favor contacte o administrador do Site.');
define( '_WARN_PENDING', 'A sua Conta continua pendente. Se continuar neste estado durante algumas horas e o sue pagamento for confirmado, por favor contacte o administrador do Site.');
define( '_PENDING_OPENINVOICE', 'Aparentemente voc&ecirc; tem um factura por liquidar nos nossos registos - Se existe algo de errado com esta situa&ccedil;&atilde;o, voc&ecirc; pode ir a Pagina de Verifica&ccedil;&atilde;o novamente para repetir o processo:');
define( '_GOTO_CHECKOUT', 'Ir para a Pagina de Verifica&ccedil;&atilde;o');
define( '_GOTO_CHECKOUT_CANCEL', 'voc&ecirc; tamb&eacute;m pode cancelar o pagamento (voc&ecirc; ter&aacute; a possibilidade de ir a p&aacute;gina Selec&ccedil;&atilde;o de Plano uma vez mais):');
define( '_PENDING_NOINVOICE', 'Aparentemente cancelou a &uacute;nica factura que possu&iacute;a na sua conta. Por favor use o bot&atilde;o abaixo para ir para a p&aacute;gina de Selec&ccedil;&atilde;o de Plano novamente:');
define( '_PENDING_NOINVOICE_BUTTON', 'Selec&ccedil;&atilde;o de Plano');
define( '_PENDING_REASON_ECHECK', '(De acordo com as nossas informa&ccedil;&otilde;es, voc&ecirc; decidiu pagar por echeck(ou similar), assim sendo ter&aacute; de esperar at&eacute; que o seu pagamento seja liberado - normalmente demora 1-4 dias.)');
define( '_PENDING_REASON_WAITING_RESPONSE', '(De acordo com as nossas informa&ccedil;&otilde;es, estamos &agrave; espera de uma resposta da entidade que realiza o processamento dos pagamentos. Ser&aacute; notificado quando o seu pagamento for confirmado. Pedimos desculpa pela demora.)');
define( '_PENDING_REASON_TRANSFER', '(De acordo com as nossas informa&ccedil;&otilde;es, decidiu realizar o pagamento de forma offline, deste modo ter&aacute; de esperar at&eacute; confirmar-mos o seu pagamento - o que poder&aacute; demorar alguns dias.)');

// --== HOLD PAGE ==--
define( '_HOLD_TITLE', 'Conta em Espera');
define( '_HOLD_EXPLANATION', 'A sua conta continua em espera. A causa mais prov&aacute;vel para esta situa&ccedil;&atilde;o &eacute; que poder&aacute; existir algum problema com o seu pagamento realizado recentemente. Se n&atilde;o receber um email nas pr&oacute;ximas 24 Horas, por favor contacte o administrador do Site.');

// --== THANK YOU PAGE ==--
define( '_THANKYOU_TITLE', 'Obrigado!');
define( '_SUB_FEPARTICLE_HEAD', 'Inscri&ccedil;&atilde;o Completa!');
define( '_SUB_FEPARTICLE_HEAD_RENEW', 'Renova&ccedil;&atilde;o da Inscri&ccedil;&atilde;o Completa!');
define( '_SUB_FEPARTICLE_LOGIN', 'J&aacute; pode efectuar o seu acesso.');
define( '_SUB_FEPARTICLE_THANKS', 'Obrigado pela sua Inscri&ccedil;&atilde;o. ');
define( '_SUB_FEPARTICLE_THANKSRENEW', 'Obrigado pela renova&ccedil;&atilde;o da sua inscri&ccedil;&atilde;o. ');
define( '_SUB_FEPARTICLE_PROCESS', 'O nosso Sistema ir&aacute; agora processar o seu pedido. ');
define( '_SUB_FEPARTICLE_PROCESSPAY', 'O nosso Sistema ir&aacute; agora aguardar o seu pagamento. ');
define( '_SUB_FEPARTICLE_ACTMAIL', 'Voc&ecirc; ir&aacute; receber um email com um link de activa&ccedil;&atilde;o, ap&oacute;s o nosso sistema ter processado o seu pedido. ');
define( '_SUB_FEPARTICLE_MAIL', 'Voc&ecirc; ir&aacute; receber um email, ap&oacute;s o nosso sistema ter processado o seu pedido. ');

// --== CHECKOUT ERROR PAGE ==--
define( '_CHECKOUT_ERROR_TITLE', 'Erro enquanto se processava o pagamento!');
define( '_CHECKOUT_ERROR_EXPLANATION', 'Ocorreu um erro no processamento do seu pagamento');
define( '_CHECKOUT_ERROR_OPENINVOICE', 'Isto deixa a sua factura por liquidar. Para repetir o pagamento, poder&aacute; ir a p&aacute;gina de Verifica&ccedil;&atilde;o novamente, e tentar uma vez mais:');

// --== COUPON ERROR MESSAGES ==--
define( '_COUPON_WARNING_AMOUNT', 'Um Cup&atilde;o que adicionou a esta factura n&atilde;o afectar&aacute; o pr&oacute;ximo pagamento, embora ele n&atilde;o afecta esta factura, ir&aacute; afectar um pagamento posterior.');
define( '_COUPON_ERROR_PRETEXT', 'Estamos muito tristes:');
define( '_COUPON_ERROR_EXPIRED', 'Este cup&atilde;o expirou.');
define( '_COUPON_ERROR_NOTSTARTED', 'O uso deste cup&atilde;o n&atilde;o &eacute; permitido neste momento.');
define( '_COUPON_ERROR_NOTFOUND', 'N&atilde;o &eacute; poss&iacute;vel encontrar o c&oacute;digo do cup&atilde;o introduzido.');
define( '_COUPON_ERROR_MAX_REUSE', 'Excedeu o limite m&aacute;ximo de uso deste cup&atilde;o.');
define( '_COUPON_ERROR_PERMISSION', 'n&atilde;o possui permiss&atilde;o para utilizar este cup&atilde;o.');
define( '_COUPON_ERROR_WRONG_USAGE', 'n&atilde;o pode utilizar este cup&atilde;o para esta opera&ccedil;&atilde;o.');
define( '_COUPON_ERROR_WRONG_PLAN', 'N&atilde;o se encontra no Plano de Inscri&ccedil;&atilde;o correcto para este cup&atilde;o.');
define( '_COUPON_ERROR_WRONG_PLAN_PREVIOUS', 'Para utilizar este cup&atilde;o, o seu &uacute;ltimo Plano de Inscri&ccedil;&atilde;o deve ser diferente.');
define( '_COUPON_ERROR_WRONG_PLANS_OVERALL', 'N&atilde;o tem no seu hist&oacute;rico o Plano de Inscri&ccedil;&atilde;o correcto para utilizar este cup&atilde;o.');
define( '_COUPON_ERROR_TRIAL_ONLY', 'Apenas poder&aacute; utiliar este cup&atilde;o por um per&iacute;odo experimental.');
define( '_COUPON_ERROR_COMBINATION', 'N&atilde;o pode utilizar este cup&atilde;o com um dos outros.');
define( '_COUPON_ERROR_SPONSORSHIP_ENDED', 'Patroc&iacute;nio para este Cup&atilde;o terminou ou est&aacute; actualmente inactivo.');

// ----======== EMAIL TEXT ========----

define( '_AEC_SEND_SUB',	'Detalhe da Conta para %s em %s' );
define( '_AEC_USEND_MSG',	'Ol&aacute; %s,\n\nObrigado pelo registo em %s.\n\nPode agora aceder a %s utilizando o seu Nome de Utilizador e Senha definidos no seu registo.' );
define( '_AEC_USEND_MSG_ACTIVATE',	'Ol&aacute; %s,\n\nObrigado pelo seu registo em %s. A sua conta foi criada e deve ser activada antes de poder utiliza-la.\nPara activar a conta clique no seguinte link ou copie para o seu browser:\n%s\n\nAp&oacute;s activar a sua conta pode aceder a %s utilizando o seu Nome de Utilizador e Senha:\n\nNome de Utilizador - %s\nSenha - %s' );
define( '_ACCTEXP_SEND_MSG','Inscri&ccedil;&atilde;o para %s em %s');
define( '_ACCTEXP_SEND_MSG_RENEW','Renova&ccedil;&atilde;o de inscri&ccedil;&atilde;o para %s em %s');
define( '_ACCTEXP_MAILPARTICLE_GREETING', 'Ol&aacute; %s, \n\n');
define( '_ACCTEXP_MAILPARTICLE_THANKSREG', 'Obrigado pelo seu registo em %s.');
define( '_ACCTEXP_MAILPARTICLE_THANKSREN', 'Obrigado pela renova&ccedil;&atilde;o da inscri&ccedil;&atilde;o em %s.');
define( '_ACCTEXP_MAILPARTICLE_PAYREC', 'O seu pagamento para a Inscri&ccedil;&atilde;o foi recebido.');
define( '_ACCTEXP_MAILPARTICLE_LOGIN', 'Pode agora aceder a %s com o seu Nome de Utilizdor e Senha.');
define( '_ACCTEXP_MAILPARTICLE_FOOTER','\n\nPor favor, n&atilde;o responda a esta mensagem, &eacute; uma resposta autom&aacute;tica gerada pelo Sistema e &eacute; apenas para fins informativos.');
define( '_ACCTEXP_ASEND_MSG',	'Ol&aacute; %s,\n\na um novo utilizador criou uma Inscri&ccedil;&atilde;o em [ %s ].\n\nMais detalhes:\n\nNome.........: %s\nE-mail........: %s\nNome de Utilizador.....: %s\nRef. Inscri&ccedil;&atilde;o....: %s\nInscri&ccedil;&atilde;o.: %s\nIP...........: %s\nISP..........: %s\n\nPor favor n&atilde;o responda a esta mensagem, &eacute; um resposta autom&aacute;tica gerada pelo sistema e &eacute; apenas para fins informativos.' );
define( '_ACCTEXP_ASEND_MSG_RENEW',	'Ol&aacute; %s,\n\num utilizador renovou a inscri&ccedil;&atilde;o em [ %s ].\n\nMais Detalhes:\n\nNome.........: %s\nE-mail........: %s\nNome de Utilizador.....: %s\nRef. Inscri&ccedil;&atilde;o....: %s\nInscri&ccedil;&atilde;o.: %s\nIP...........: %s\nISP..........: %s\n\nPor favor, n&atilde;o responda a esta mensagem, &eacute; uma resposta autom&aacute;tica gerada pelo Sistema e &eacute; apenas para fins informativos.' );
define( '_AEC_ASEND_MSG_NEW_REG',	'Ol&aacute; %s,\n\n novo registo em [ %s ].\n\nMais Detalhes:\n\nNome.....: %s\nE-mail.: %s\nNome de Utilizador....: %s\nIP.......: %s\nISP......: %s\n\nPor favor, n&atilde;o responda a esta mensagem, &eacute; uma resposta autom&aacute;tica gerada pelo Sistema e &eacute; apenas para fins informativos.' );
define( '_AEC_ASEND_NOTICE',	'AEC %s: %s em %s' );
define( '_AEC_ASEND_NOTICE_MSG',	'Segundo o n&iacute;vel de relat&oacute;rio de E-Mail selecionado, esta &eacute; uma notifica&ccedil;&atilde;o autom&aacute;tica sobre um entrada no EventLog.\n\nOs detalhes desta mensagem s&atilde;o:\n\n--- --- --- ---\n\n%s\n\n--- --- --- ---\n\nPor favor, n&atilde;o responda a esta mensagem, &eacute; uma resposta autom&aacute;tica gerada pelo Sistema e &eacute; apenas para fins informativos. Pode alterar o n&iacute;vel de entradas reportadas nas suas configura&ccedil;&otilde;es do AEC.' );

// ----======== COUNTRY CODES ========----

define( 'COUNTRYCODE_SELECT', 'Selecione Pa&iacute;s' );
define( 'COUNTRYCODE_US', 'Estados Unidos' );
define( 'COUNTRYCODE_AL', 'Alb&acirc;nia' );
define( 'COUNTRYCODE_DZ', 'Algeria' );
define( 'COUNTRYCODE_AD', 'Andorra' );
define( 'COUNTRYCODE_AO', 'Angola' );
define( 'COUNTRYCODE_AI', 'Anguilla' );
define( 'COUNTRYCODE_AG', 'Antiqua e Barbuda' );
define( 'COUNTRYCODE_AR', 'Argentina' );
define( 'COUNTRYCODE_AM', 'Arm&eacute;nia' );
define( 'COUNTRYCODE_AW', 'Aruba' );
define( 'COUNTRYCODE_AU', 'Austr&aacute;lia' );
define( 'COUNTRYCODE_AT', '&Aacute;ustria' );
define( 'COUNTRYCODE_AZ', 'Republica do Azerbaij&atilde;o' );
define( 'COUNTRYCODE_BS', 'Bahamas' );
define( 'COUNTRYCODE_BH', 'Bahrain' );
define( 'COUNTRYCODE_BB', 'Barbados' );
define( 'COUNTRYCODE_BE', 'B&eacute;lgica' );
define( 'COUNTRYCODE_BZ', 'Belize' );
define( 'COUNTRYCODE_BJ', 'Benin' );
define( 'COUNTRYCODE_BM', 'Bermudas' );
define( 'COUNTRYCODE_BT', 'Bot&atilde;o' );
define( 'COUNTRYCODE_BO', 'Bol&iacute;via' );
define( 'COUNTRYCODE_BA', 'B&oacute;snia e Herzegovina' );
define( 'COUNTRYCODE_BW', 'Botsuana' );
define( 'COUNTRYCODE_BR', 'Brasil' );
define( 'COUNTRYCODE_VG', 'Ilhas Virgens Brit&acirc;nicas' );
define( 'COUNTRYCODE_BN', 'Brunei' );
define( 'COUNTRYCODE_BG', 'Bulg&aacute;ria' );
define( 'COUNTRYCODE_BF', 'Burkina Faso' );
define( 'COUNTRYCODE_BI', 'Burundi' );
define( 'COUNTRYCODE_KH', 'Camboja' );
define( 'COUNTRYCODE_CA', 'Canad&aacute;' );
define( 'COUNTRYCODE_CV', 'Cabo Verde' );
define( 'COUNTRYCODE_KY', 'Ilhas Caim&atilde;o' );
define( 'COUNTRYCODE_TD', 'Chad' );
define( 'COUNTRYCODE_CL', 'Chile' );
define( 'COUNTRYCODE_C2', 'China' );
define( 'COUNTRYCODE_CO', 'Col&ocirc;mbia' );
define( 'COUNTRYCODE_KM', 'Comoros' );
define( 'COUNTRYCODE_CK', 'Ilhas Cook' );
define( 'COUNTRYCODE_CR', 'Costa Rica' );
define( 'COUNTRYCODE_HR', 'Cro&aacute;cia' );
define( 'COUNTRYCODE_CY', 'Chipre' );
define( 'COUNTRYCODE_CZ', 'Rep&uacute;blica Checa' );
define( 'COUNTRYCODE_CD', 'Rep&uacute;blica Democr&aacute;tica do Congo' );
define( 'COUNTRYCODE_DK', 'Dinamarca' );
define( 'COUNTRYCODE_DJ', 'Djibuti' );
define( 'COUNTRYCODE_DM', 'Dominica' );
define( 'COUNTRYCODE_DO', 'Rep&uacute;blica Dominicana' );
define( 'COUNTRYCODE_EC', 'Equador' );
define( 'COUNTRYCODE_SV', 'El Salvador' );
define( 'COUNTRYCODE_ER', 'Eritrea' );
define( 'COUNTRYCODE_EE', 'Est&oacute;nia' );
define( 'COUNTRYCODE_ET', 'Eti&oacute;pia' );
define( 'COUNTRYCODE_FK', 'Ilhas Falkland' );
define( 'COUNTRYCODE_FO', 'Ilhas Faroe' );
define( 'COUNTRYCODE_FM', 'Estados Federados da Micron&eacute;sia' );
define( 'COUNTRYCODE_FJ', 'Fiji' );
define( 'COUNTRYCODE_FI', 'Filandia' );
define( 'COUNTRYCODE_FR', 'Fran&ccedil;a' );
define( 'COUNTRYCODE_GF', 'Guiana Francesa' );
define( 'COUNTRYCODE_PF', 'Polin&eacute;sia Francesa' );
define( 'COUNTRYCODE_GA', 'Rep&uacute;blica do Gab&atilde;o' );
define( 'COUNTRYCODE_GM', 'Gambia' );
define( 'COUNTRYCODE_DE', 'Alemanha' );
define( 'COUNTRYCODE_GI', 'Gibraltar' );
define( 'COUNTRYCODE_GR', 'Gr&eacute;cia' );
define( 'COUNTRYCODE_GL', 'Gronel&acirc;ndia' );
define( 'COUNTRYCODE_GD', 'Granada' );
define( 'COUNTRYCODE_GP', 'Guadalupe' );
define( 'COUNTRYCODE_GT', 'Guatemala' );
define( 'COUNTRYCODE_GN', 'Guine' );
define( 'COUNTRYCODE_GW', 'Guine Bissau' );
define( 'COUNTRYCODE_GY', 'Guiana' );
define( 'COUNTRYCODE_HN', 'Honduras' );
define( 'COUNTRYCODE_HK', 'Hong Kong' );
define( 'COUNTRYCODE_HU', 'Hungria' );
define( 'COUNTRYCODE_IS', 'Isl&acirc;ndia' );
define( 'COUNTRYCODE_IN', '&Iacute;ndia' );
define( 'COUNTRYCODE_ID', 'Indon&eacute;sia' );
define( 'COUNTRYCODE_IE', 'Irlanda' );
define( 'COUNTRYCODE_IL', 'Israel' );
define( 'COUNTRYCODE_IT', 'It&aacute;lia' );
define( 'COUNTRYCODE_JM', 'Jamaica' );
define( 'COUNTRYCODE_JP', 'Jap&atilde;o' );
define( 'COUNTRYCODE_JO', 'Jord&acirc;nia' );
define( 'COUNTRYCODE_KZ', 'Cazaquist&atilde;o' );
define( 'COUNTRYCODE_KE', 'Qu&eacute;nia' );
define( 'COUNTRYCODE_KI', 'Kiribati' );
define( 'COUNTRYCODE_KW', 'Kuwait' );
define( 'COUNTRYCODE_KG', 'Quirguist&atilde;o' );
define( 'COUNTRYCODE_LA', 'Laos' );
define( 'COUNTRYCODE_LV', 'Let&oacute;nia' );
define( 'COUNTRYCODE_LS', 'Lesoto' );
define( 'COUNTRYCODE_LI', 'Liechtenstein' );
define( 'COUNTRYCODE_LT', 'Litu&acirc;nia' );
define( 'COUNTRYCODE_LU', 'Luxemburgo' );
define( 'COUNTRYCODE_MG', 'Madag&aacute;scar' );
define( 'COUNTRYCODE_MW', 'Malawi' );
define( 'COUNTRYCODE_MY', 'Mal&aacute;sia' );
define( 'COUNTRYCODE_MV', 'Maldivas' );
define( 'COUNTRYCODE_ML', 'Mali' );
define( 'COUNTRYCODE_MT', 'Malta' );
define( 'COUNTRYCODE_MH', 'Ilhas Marshall' );
define( 'COUNTRYCODE_MQ', 'Martinica' );
define( 'COUNTRYCODE_MR', 'Maurit&acirc;nia' );
define( 'COUNTRYCODE_MU', 'Maur&iacute;cio' );
define( 'COUNTRYCODE_YT', 'Mayotte' );
define( 'COUNTRYCODE_MX', 'M&eacute;xico' );
define( 'COUNTRYCODE_MN', 'Mong&oacute;lia' );
define( 'COUNTRYCODE_MS', 'Montserrat' );
define( 'COUNTRYCODE_MA', 'Marrocos' );
define( 'COUNTRYCODE_MZ', 'Mo&ccedil;ambique' );
define( 'COUNTRYCODE_NA', 'Nam&iacute;bia' );
define( 'COUNTRYCODE_NR', 'Nauru' );
define( 'COUNTRYCODE_NP', 'Nepal' );
define( 'COUNTRYCODE_NL', 'Holanda' );
define( 'COUNTRYCODE_AN', 'Antilhas Holandesas' );
define( 'COUNTRYCODE_NC', 'Nova Calced&oacute;nia' );
define( 'COUNTRYCODE_NZ', 'Nova Zel&acirc;ndia' );
define( 'COUNTRYCODE_NI', 'Nicar&aacute;gua' );
define( 'COUNTRYCODE_NE', 'N&iacute;ger' );
define( 'COUNTRYCODE_NU', 'Niue' );
define( 'COUNTRYCODE_NF', 'Ilha Norfolk' );
define( 'COUNTRYCODE_NO', 'Noruega' );
define( 'COUNTRYCODE_OM', 'Oman' );
define( 'COUNTRYCODE_PW', 'Palau' );
define( 'COUNTRYCODE_PA', 'Panam&aacute;' );
define( 'COUNTRYCODE_PG', 'Papua Nova Guin&eacute;' );
define( 'COUNTRYCODE_PE', 'Peru' );
define( 'COUNTRYCODE_PH', 'Filipinas' );
define( 'COUNTRYCODE_PN', 'Ilhas Pitcairn' );
define( 'COUNTRYCODE_PL', 'Pol&oacute;nia' );
define( 'COUNTRYCODE_PT', 'Portugal' );
define( 'COUNTRYCODE_QA', 'Catar' );
define( 'COUNTRYCODE_RE', 'Reunion' );
define( 'COUNTRYCODE_RO', 'Rom&eacute;nia' );
define( 'COUNTRYCODE_RU', 'R&uacute;ssia' );
define( 'COUNTRYCODE_RW', 'Ruanda' );
define( 'COUNTRYCODE_VC', 'S&atilde;o Vicente e Granadinas' );
define( 'COUNTRYCODE_WS', 'Samoa' );
define( 'COUNTRYCODE_SM', 'S&atilde;o Marino' );
define( 'COUNTRYCODE_ST', 'S&atilde;o Tom&eacute; e Pr&iacute;ncipe' );
define( 'COUNTRYCODE_SA', 'Ar&aacute;bia Saudita' );
define( 'COUNTRYCODE_SN', 'Senegal' );
define( 'COUNTRYCODE_SC', 'Seychelles' );
define( 'COUNTRYCODE_SL', 'Serra Leoa' );
define( 'COUNTRYCODE_SG', 'Singapura' );
define( 'COUNTRYCODE_SK', 'Eslov&aacute;quia' );
define( 'COUNTRYCODE_SI', 'Eslov&eacute;nia' );
define( 'COUNTRYCODE_SB', 'Ilhas Salom&atilde;o' );
define( 'COUNTRYCODE_SO', 'Som&aacute;lia' );
define( 'COUNTRYCODE_ZA', '&Aacute;frica do Sul' );
define( 'COUNTRYCODE_KR', 'Coreia do Sul' );
define( 'COUNTRYCODE_ES', 'Espanha' );
define( 'COUNTRYCODE_LK', 'Sri Lanka' );
define( 'COUNTRYCODE_SH', 'St. Helena' );
define( 'COUNTRYCODE_KN', 'St. Kitts e Nevis' );
define( 'COUNTRYCODE_LC', 'St. Lucia' );
define( 'COUNTRYCODE_PM', 'St. Pierre e Miquelon' );
define( 'COUNTRYCODE_SR', 'Suriname' );
define( 'COUNTRYCODE_SJ', 'Ilhas Svalbard e Jan Mayen' );
define( 'COUNTRYCODE_SZ', 'Suazil&acirc;ndia' );
define( 'COUNTRYCODE_SE', 'Su&eacute;cia' );
define( 'COUNTRYCODE_CH', 'Su&iacute;&ccedil;a' );
define( 'COUNTRYCODE_TW', 'Taiwan' );
define( 'COUNTRYCODE_TJ', 'Tajiquist&atilde;o' );
define( 'COUNTRYCODE_TZ', 'Tanzania' );
define( 'COUNTRYCODE_TH', 'Tail&acirc;ndia' );
define( 'COUNTRYCODE_TG', 'Togo' );
define( 'COUNTRYCODE_TO', 'Tonga' );
define( 'COUNTRYCODE_TT', 'Trinida e Tobago' );
define( 'COUNTRYCODE_TN', 'Tun&iacute;sia' );
define( 'COUNTRYCODE_TR', 'Turquia' );
define( 'COUNTRYCODE_TM', 'Turcomenist&atilde;o' );
define( 'COUNTRYCODE_TC', 'Ilhas Turcas e Caicos' );
define( 'COUNTRYCODE_TV', 'Tuvalu' );
define( 'COUNTRYCODE_UG', 'Uganda' );
define( 'COUNTRYCODE_UA', 'Ucrania' );
define( 'COUNTRYCODE_AE', 'Emirados &Aacute;rabes Unidos' );
define( 'COUNTRYCODE_GB', 'Reino Unido' );
define( 'COUNTRYCODE_UY', 'Uruguai' );
define( 'COUNTRYCODE_VU', 'Vanuatu' );
define( 'COUNTRYCODE_VA', 'Vaticano' );
define( 'COUNTRYCODE_VE', 'Venezuela' );
define( 'COUNTRYCODE_VN', 'Vietname' );
define( 'COUNTRYCODE_WF', 'Ilhas Wallis e Futuna' );
define( 'COUNTRYCODE_YE', 'I&ecirc;men' );
define( 'COUNTRYCODE_ZM', 'Z&acirc;mbia' );

?>
