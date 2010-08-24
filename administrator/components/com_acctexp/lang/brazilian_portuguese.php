<?php
/**
* @version $Id: brazilian_portuguese.php
* @package AEC - Account Control Expiration - Membership Manager
* @subpackage Language - Backend - Portuguese
* @copyright 2006-2008 Copyright (C) David Deutsch
* @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
* @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
*/

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

define( '_AEC_LANGUAGE',						'br' ); // DO NOT CHANGE!!
define( '_CFG_GENERAL_ACTIVATE_PAID_NAME',		'Activate Paid Subscriptions' );
define( '_CFG_GENERAL_ACTIVATE_PAID_DESC',		'Always activate Subscriptions that are paid for automatically instead of requiring an activation code' );

// hacks/install >> ATTENTION: MUST BE HERE AT THIS POSITION, needed later!
define( '_AEC_SPEC_MENU_ENTRY',					'My Subscription' );

// common
define( '_DESCRIPTION_PAYSIGNET',				'mic: Descri&ccedil;&atilde;o Paysignnet - VERIFICADO! -');
define( '_AEC_CONFIG_SAVED',					'Configrua&ccedil;&atilde;o Guardada' );
define( '_AEC_CONFIG_CANCELLED',				'Configura&ccedil;&atilde;o cancelada' );
define( '_AEC_TIP_NO_GROUP_PF_PB',				'Public Frontend&quot; n&atilde;o &eacute; um grupo de utilizadores - e nem &eacute; um &quot;Public Backend' );
define( '_AEC_CGF_LINK_ABO_FRONTEND',			'Link Directo Pagina Principal' );
define( '_AEC_CGF_LINK_CART_FRONTEND',			'Direct Add To Cart link' );
define( '_AEC_NOT_SET',							'N&atilde;o definido' );
define( '_AEC_COUPON',							'Cup&atilde;o' );
define( '_AEC_CMN_NEW',							'Novo' );
define( '_AEC_CMN_CLICK_TO_EDIT',				'Clique para editar' );
define( '_AEC_CMN_LIFETIME',					'Dura&ccedil;&atilde;o' );
define( '_AEC_CMN_UNKOWN',						'Desconhecido' );
define( '_AEC_CMN_EDIT_CANCELLED',				'Altera&ccedil;&otilde;es Canceladas' );
define( '_AEC_CMN_PUBLISHED',					'Publicado' );
define( '_AEC_CMN_NOT_PUBLISHED',				'N&atilde;o Publicado' );
define( '_AEC_CMN_CLICK_TO_CHANGE',				'Clique no icone para alterar o estado' );
define( '_AEC_CMN_NONE_SELECTED',				'Nennhum selecionado' );
define( '_AEC_CMN_MADE_VISIBLE',				'tornar visivel' );
define( '_AEC_CMN_MADE_INVISIBLE',				'tornar invis&iacute;vel' );
define( '_AEC_CMN_TOPUBLISH',					'publicar' ); // to ...
define( '_AEC_CMN_TOUNPUBLISH',					'despublicar' ); // to ...
define( '_AEC_CMN_FILE_SAVED',					'Ficheiro guardado' );
define( '_AEC_CMN_ID',							'ID' );
define( '_AEC_CMN_DATE',						'Data' );
define( '_AEC_CMN_EVENT',						'Evento' );
define( '_AEC_CMN_TAGS',						'Tags' );
define( '_AEC_CMN_ACTION',						'Ac&ccedil;&atilde;o' );
define( '_AEC_CMN_PARAMETER',					'Parametros' );
define( '_AEC_CMN_NONE',						'Nenhum' );
define( '_AEC_CMN_WRITEABLE',					'Grav&aacute;vel' );
define( '_AEC_CMN_UNWRITEABLE',					'N&atilde;o Grav&aacute;vel!' );
define( '_AEC_CMN_UNWRITE_AFTER_SAVE',			'Tornar n&atilde;o grav&aacute;vel ap&oacute;s guardar' );
define( '_AEC_CMN_OVERRIDE_WRITE_PROT',			'Sobrepor protec&ccedil;&atilde;o de escrita ao guardar' );
define( '_AEC_CMN_NOT_SET',						'N&atilde;o definido' );
define( '_AEC_CMN_SEARCH',						'Pesquisa' );
define( '_AEC_CMN_APPLY',						'Aplicar' );
define( '_AEC_CMN_STATUS',						'Estado' );
define( '_AEC_FEATURE_NOT_ACTIVE',				'Esta funcionalidade n&atilde;o se encontra ainda activa' );
define( '_AEC_CMN_YES',							'Sim' );
define( '_AEC_CMN_NO',							'N&atilde;o' );
define( '_AEC_CMN_INHERIT',						'Inherit' );
define( '_AEC_CMN_LANG_CONSTANT_IS_MISSING',	'Constante do Idioma <strong>%s</strong> em falta' );
define( '_AEC_CMN_VISIBLE',						'Vis&iacute;vel' );
define( '_AEC_CMN_INVISIBLE',					'Invis&iacute;vel' );
define( '_AEC_CMN_EXCLUDED',					'Exclu&iacute;do' );
define( '_AEC_CMN_PENDING',						'Pendente' );
define( '_AEC_CMN_ACTIVE',						'Activo' );
define( '_AEC_CMN_TRIAL',						'Demonstra&ccedil;&atilde;o' );
define( '_AEC_CMN_CANCEL',						'Cancelado' );
define( '_AEC_CMN_HOLD',						'Em Espera' );
define( '_AEC_CMN_EXPIRED',						'Expirou' );
define( '_AEC_CMN_CLOSED',						'Fechado' );

// user(info)
define( '_AEC_USER_USER_INFO',					'Informa&ccedil;&atilde;o do Utilizador' );
define( '_AEC_USER_USERID',						'ID do Utilizador' );
define( '_AEC_USER_STATUS',						'Estado' );
define( '_AEC_USER_ACTIVE',						'Activo' );
define( '_AEC_USER_BLOCKED',					'Bloqueado' );
define( '_AEC_USER_ACTIVE_LINK',				'Link de Activa&ccedil;&atilde;o' );
define( '_AEC_USER_PROFILE',					'Perfil' );
define( '_AEC_USER_PROFILE_LINK',				'Ver Perfil' );
define( '_AEC_USER_USERNAME',					'Nome de Utilizador' );
define( '_AEC_USER_NAME',						'Nome' );
define( '_AEC_USER_EMAIL',						'E-Mail' );
define( '_AEC_USER_SEND_MAIL',					'enviar email' );
define( '_AEC_USER_TYPE',						'Tipo de Utilizador' );
define( '_AEC_USER_REGISTERED',					'Registado' );
define( '_AEC_USER_LAST_VISIT',					'&Uacute;ltima Visita' );
define( '_AEC_USER_EXPIRATION',					'Validade' );
define( '_AEC_USER_CURR_EXPIRE_DATE',			'Data de Validade Actual' );
define( '_AEC_USER_LIFETIME',					'Dura&ccedil;&atilde;o' );
define( '_AEC_USER_RESET_EXP_DATE',				'Redefinir Data de Validade' );
define( '_AEC_USER_RESET_STATUS',				'Redefinir Estado' );
define( '_AEC_USER_SUBSCRIPTION',				'Inscri&ccedil;&atilde;o' );
define( '_AEC_USER_PAYMENT_PROC',				'Processador de Pagamento' );
define( '_AEC_USER_CURR_SUBSCR_PLAN',			'Plano de Inscri&ccedil;&atilde;o Actual' );
define( '_AEC_USER_PREV_SUBSCR_PLAN',			'Plano de Inscri&ccedil;&atilde;o Anterior' );
define( '_AEC_USER_USED_PLANS',					'Planos de Inscri&ccedil;&atilde;o Usados' );
define( '_AEC_USER_NO_PREV_PLANS',				'Nenuma Inscri&ccedil;&atilde;o at&eacute; agora' );
define( '_AEC_USER_ASSIGN_TO_PLAN',				'Atribuir a Plano' );
define( '_AEC_USER_TIME',						'tempo' );
define( '_AEC_USER_TIMES',						'tempos' );
define( '_AEC_USER_INVOICES',					'Facturas' );
define( '_AEC_USER_NO_INVOICES',				'Nenhuma Factura at&eacute; agora' );
define( '_AEC_USER_INVOICE_FACTORY',			'Factura de F&aacute;brica' );
define( '_AEC_USER_ALL_SUBSCRIPTIONS',			'Todas as inscir&ccedil;&otilde;es deste utilizador' );
define( '_AEC_USER_ALL_SUBSCRIPTIONS_NOPE',		'Esta &eacute; apenas a &uacute;nica inscri&ccedil;&atilde;oactualmente deste utilizador.' );
define( '_AEC_USER_SUBSCRIPTIONS_ID',			'ID' );
define( '_AEC_USER_SUBSCRIPTIONS_STATUS',		'Estado' );
define( '_AEC_USER_SUBSCRIPTIONS_PROCESSOR',	'Processador' );
define( '_AEC_USER_SUBSCRIPTIONS_SINGUP',		'Inscreva-se' );
define( '_AEC_USER_SUBSCRIPTIONS_EXPIRATION',	'Expira&ccedil;&atilde;o' );
define( '_AEC_USER_SUBSCRIPTIONS_PRIMARY',		'prim&aacute;rio' );
define( '_AEC_USER_CURR_SUBSCR_PLAN_PRIMARY',	'Prim&aacute;rio' );
define( '_AEC_USER_COUPONS',					'Coupons' );
define( '_HISTORY_COL_COUPON_CODE',				'Coupon Code' );
define( '_AEC_USER_NO_COUPONS',					'No coupon use recorded' );
define( '_AEC_USER_MICRO_INTEGRATION',			'Micro Integration Info' );
define( '_AEC_USER_MICRO_INTEGRATION_USER',		'Frontend' );
define( '_AEC_USER_MICRO_INTEGRATION_ADMIN',	'Backend' );
define( '_AEC_USER_MICRO_INTEGRATION_DB',		'Database Readout' );

// new (additional)
define( '_AEC_MSG_MIS_NOT_DEFINED',				'N&atilde;o definiu nenhuma integra&ccedil;&atilde;o at&eacute; agora - ver configura&ccedil;&atilde;o' );

// headers
define( '_AEC_HEAD_SETTINGS',					'Configura&ccedil;&otilde;es' );
define( '_AEC_HEAD_HACKS',						'Modifica&ccedil;&otilde;es' );
define( '_AEC_HEAD_PLAN_INFO',					'Inscri&ccedil;&otilde;es' );
define( '_AEC_HEAD_LOG',						'Log de Eventos' );
define( '_AEC_HEAD_CSS_EDITOR',					'Editor CSS' );
define( '_AEC_HEAD_MICRO_INTEGRATION',			'Informa&ccedil;&atilde;o Micro Integra&ccedil;&atilde;o' );
define( '_AEC_HEAD_ACTIVE_SUBS',				'Subscritor Activo' );
define( '_AEC_HEAD_EXCLUDED_SUBS',				'Subscritor Exclu&iacute;do' );
define( '_AEC_HEAD_EXPIRED_SUBS',				'Subscritor Espirado' );
define( '_AEC_HEAD_PENDING_SUBS',				'Subscritor Pendente' );
define( '_AEC_HEAD_CANCELLED_SUBS',				'Subscritor Cancelado' );
define( '_AEC_HEAD_HOLD_SUBS',					'Subscritor em Espera' );
define( '_AEC_HEAD_CLOSED_SUBS',				'Subscritor Fechado' );
define( '_AEC_HEAD_MANUAL_SUBS',				'Subscritor Manual' );
define( '_AEC_HEAD_SUBCRIBER',					'Subscritor' );

// hacks (special)
define( '_AEC_HACK_HACK',						'Modifica&ccedil;&otilde;es' );
define( '_AEC_HACKS_ISHACKED',					'foi modificado' );
define( '_AEC_HACKS_NOTHACKED',					'n&atilde;o foi modificado!' );
define( '_AEC_HACKS_UNDO',						'desfazer agora' );
define( '_AEC_HACKS_COMMIT',					'realizar' );
define( '_AEC_HACKS_FILE',						'Ficheiro' );
define( '_AEC_HACKS_LOOKS_FOR',					'A modifica&ccedil;&atilde;o ira ter esta visualiza&ccedil;&atilde;o' );
define( '_AEC_HACKS_REPLACE_WITH',				'... e substitui-la por isto' );

define( '_AEC_HACKS_NOTICE',					'NOT&Iacute;CIA IMPORTANTE' );
define( '_AEC_HACKS_NOTICE_DESC',				'Por raz&otilde;es de seguran&ccedil;a precisa de aplicar as modifica&ccedil;&otilde;es aos ficheiros principais do Joomla. Para fazer isso, por favor, clique no link&quot;Modificar Ficheiro Agora&quot; para esses ficheiros. pode tamb&eacute;m adicionar um link ao seu Menu de Utilizador, para os seus utilizadors poderem aceder as suas respectivas Subscri&ccedil;&otilde;es.' );
define( '_AEC_HACKS_NOTICE_DESC2',				'<strong>Todas as funcionalidades importantes modificadas s&atilde;o assinaladas com uma seta e um ponto de exclama&ccedil;&atilde;o.</strong>' );
define( '_AEC_HACKS_NOTICE_DESC3',				'Essas modifica&ccedil;&otilde;es <strong>podem n&atilde;o se encontrar numa ordem num&eacute;rica correcta</strong> - portanto n&atilde;o se preocupe se se apresentarem desta forma #1, #3, #6 - os n&uacute;meros em falta s&atilde;o modifica&ccedil;&otilde;es que voc&ecirc; apenas visualizaria caso tivem sido alteradas de forma incorrecta.' );
define( '_AEC_HACKS_NOTICE_JACL',				'NOT&Iacute;CIA JACL' );
define( '_AEC_HACKS_NOTICE_JACL_DESC',			'No caso de pretender instalar o componente JACLplus, por favor confirme que n&atilde;o realizou qualquer modifica&ccedil;&atilde;o. A instala&ccedil;&atilde;o do JACL realiza, tamb&eacute;m ela, modifica&ccedil;&otilde;es aos ficheiros principais, &eacute; por isso importante que as suas modifica&ccedil;&otilde;es , so sejam realizadas ap&oacute;s a sua instala&ccedil;&atilde;o.' );

define( '_AEC_HACKS_MENU_ENTRY',				'Entrada para Menu' );
define( '_AEC_HACKS_MENU_ENTRY_DESC',			'Adicione uma entrada ao menu<strong> ' . _AEC_SPEC_MENU_ENTRY . '</strong> ao Menu de Utilizador. Com isso, um utilizador pode gerir as suas facturas e renovar/upgrade a sua pr&oacute;pria inscri&ccedil;&atilde;o.' );
define( '_AEC_HACKS_LEGACY',					'<strong>Isto &eacute; uma Modifica&ccedil;&atilde;o Original, por faor volte atr&aacute;s!</strong>' );
define( '_AEC_HACKS_LEGACY_MAMBOT',				'<strong>This is a Legacy Hack which is superceded by the Joomla 1.0 Mambot, please undo and use the "Hacks Mambot" instead!</strong>' );
define( '_AEC_HACKS_LEGACY_PLUGIN',				'<strong>Isto &eacute; uma Modifica&ccedil;&atilde;o Original que &eacute; substitu&iacute;da pelo Plugin do Joomla 1.5, por favor volte atr&aacute;s e use o Plugin em vez de realizar esta modifica&ccedil;&atilde;o!</strong>' );
define( '_AEC_HACKS_LEGACY_PLUGIN_ERROR',		'<strong>This is a Legacy Hack which is superceded by the Joomla 1.5 Error Plugin, please undo and use the AEC Error Plugin instead!</strong>' );
define( '_AEC_HACKS_LEGACY_PLUGIN_USER',		'<strong>This is a Legacy Hack which is superceded by the Joomla 1.5 User Plugin, please undo and use the AEC User Plugin instead!</strong>' );
define( '_AEC_HACKS_LEGACY_PLUGIN_ACCESS',		'<strong>This is a Legacy Hack which is superceded by the Joomla 1.5 Access Plugin, please undo and use the AEC Access Plugin instead!</strong>' );
define( '_AEC_HACKS_NOTAUTH',					'Isto vai redirecionar correctamente os seus utilizadores para a p&aacute;gina N&atilde;o Permitido com a informa&ccedil;&atilde;o sobre a sua inscri&ccedil;&atilde;o' );
define( '_AEC_HACKS_SUB_REQUIRED',				'Isto confirmar&aacute; que o utilizador possu&iacute; uma correcta inscri&ccedil;&atilde;o, e pode realizr o seu acesso(login).<strong>Lembre-se tamb&eacute;m para definir [ Inscri&ccedil;&atilde;o Necess&aacute;ria ] nas configua&ccedil;&otilde;es do AEC!</strong>' );
define( '_AEC_HACKS_REG2',						'Op&ccedil;&atilde;o para redirecionar um utilizador registado para os planos de pagamento ap&oacute;s preencher o formul&aacute;rio de registo. Deixe em branco se pretende que a sele&ccedil;&atilde;o dos planos seja feita apenas ap&oacute;s o acesso(login) (se \'Inscri&ccedil;&atilde;o Necess&aacute;ria\' estiver activa), ou totalmente volunt&aacute;ria (sem requerer uma inscri&ccedil;&atilde;o). <strong>Tenha em considera&ccedil;&atilde;o que existem duas modifica&ccedil;&otilde;es ap&oacute;s ter realizado esta! Se pretende ter os planos antes dos detalhes do utilizdor, esses tamb&eacute;m s&atilde;o necess&aacute;rios.</strong>' );
define( '_AEC_HACKS_REG3',						'Op&ccedil;&atilde;o para redirecionar o utilizador para a pagina de pagamento do plano ainda que o utiliador n&atilde;o tenha realizado essa sele&ccedil;&atilde;o.' );
define( '_AEC_HACKS_REG4',						'Esta modifica&ccedil;&atilde;o ira processar variaveis do AEC, do formul&aacute;rio do utilizador.' );
define( '_AEC_HACKS_REG5',						'Esta modifica&ccedil;&atilde;o tornar&aacute; os Planos a primeira funcionalidade - voc&ecirc; precisa de definir o par&atilde;metro para este nas defini&ccedil;&otilde;es tamb&eacute;m!' );
define( '_AEC_HACKS_MI1',						'Algumas Micro Integra&ccedil;&otilde;es precisam de receber uma senha para cada utilizador. Esta modifica&ccedil;&atilde;o ir&aacute; confirmar que asMicro Integra&ccedil;&otilde;es ser&atilde;o notificadas quando um utilizador realizar modifica&ccedil;&otilde;es a sua conta.' );
define( '_AEC_HACKS_MI2',						'Algumas Micro Integra&ccedil;&otilde;es precisam de receber uma senha para cada utilizador. Esta modifica&ccedil;&atilde;o ir&aacute; confirmar que asMicro Integra&ccedil;&otilde;es ser&atilde;o notificadas quando um utilizador registar uma conta.' );
define( '_AEC_HACKS_MI3',						'Algumas Micro Integra&ccedil;&otilde;es precisam de receber uma senha para cada utilizador. Esta modifica&ccedil;&atilde;o ir&aacute; confirmar que asMicro Integra&ccedil;&otilde;es ser&atilde;o notificadas quando um administrador modificar uma conta de utilizador.' );
define( '_AEC_HACKS_CB2',						'Isto redireciona um utilizador registado para os Planos de Pagamento ap&oacute;s ter preenchido o formul&aacute;rio de registo no CB. Deixe em branco para ter a sele&ccedil;&atilde;o do plano apenas no acesso(login) (se \'Inscri&ccedil;&atilde;o Necess&aacute;ria\' estiver activa), ou completamente volunt&aacute;ria (sem requere uma inscri&ccedil;&atilde;o). <strong>Tenha em considera&ccedil;&atilde;o que existem duas modifica&ccedil;&otilde;es ap&oacute;s ter realizado esta! Se pretende ter os planos antes dos detalhes do utilizdor, esses tamb&eacute;m s&atilde;o necess&aacute;rios.</strong>' );
define( '_AEC_HACKS_CB6',						'Op&ccedil;&atilde;o para redirecionar o utilizador para a pagina de Planos de Pagamento ainda que o utiliador n&atilde;o tenha realizado essa sele&ccedil;&atilde;o.' );
define( '_AEC_HACKS_CB_HTML2',					'Esta modifica&ccedil;&atilde;o ira processar variaveis do AEC, do formul&aacute;rio do utilizador. <strong>De forma a que isto funcione, defina \'Planos Primeiro\' nas defini&ccedil;&otilde;es do AEC.</strong>' );
define( '_AEC_HACKS_UHP2',						'Entrada do Menu UHP2' );
define( '_AEC_HACKS_UHP2_DESC',					'Adicione uma entrada de menu <strong>' . _AEC_SPEC_MENU_ENTRY . '</strong> ao Menu de utilizador UHP2. Com isso, um utilizador pode gerir as suas facturas e renovar/upgrade a sua inscri&ccedil;&atilde;o.' );
define( '_AEC_HACKS_CBM',						'Se estiver a utilizar o Modulo Comprofiler Moderator, dever&aacute; modifica-lo de forma a prevenir falhas intermin&aacute;veis.' );

define( '_AEC_HACKS_JUSER_HTML1',				'Op&ccedil;&atilde;o para redirecionar um utilizador registado para os Planos de Pagamento ap&oacute;s preencher o formul&aacute;rio de registo noJUser. Deixe isto em branco para ter a sele&ccedil;&atilde;o de plano apenas no acesso(login) (se \'Inscri&ccedil;&atilde;o Necess&aacute;ria\' estiver activa), ou completamente volunt&aacute;ria (sem requerer uma inscri&ccedil;&atilde;o).<strong>Tenha em considera&ccedil;&atilde;o que existem duas modifica&ccedil;&otilde;es ap&oacute;s ter realizado esta! Se pretende ter os planos antes dos detalhes do utilizador, esses tamb&eacute;m s&atilde;o necess&aacute;rios.</strong>' );
define( '_AEC_HACKS_JUSER_PHP1',				'Op&ccedil;&atilde;o para Isto ir&aacute; redirecionar um utilizador registado para a pagina de Planos de Pagamento quando o utilizador n&atilde;o tiver selecionado essa op&ccedil;&atilde;o.' );
define( '_AEC_HACKS_JUSER_PHP2',				'Altera&ccedil;&atilde;o que permite ao AEC carregar as fun&ccedil;&otilde;es do utilizador sem for&ccedil;a-lo a reagir a informa&ccedil;&atilde;o do Post.' );

// log
	// settings
define( '_AEC_LOG_SH_SETT_SAVED',				'defini&ccedil;&otilde;es alteradas' );
define( '_AEC_LOG_LO_SETT_SAVED',				'As defini&ccedil;&otilde;es para o AEC foram guardadas' );
	// heartbeat
define( '_AEC_LOG_SH_HEARTBEAT',				'Heartbeat' );
define( '_AEC_LOG_LO_HEARTBEAT',				'Heartbeat realizado:' );
define( '_AEC_LOG_AD_HEARTBEAT_DO_NOTHING',		'n&atilde;o faz nada' );
	// install
define( '_AEC_LOG_SH_INST',						'instalar AEC' );
define( '_AEC_LOG_LO_INST',						'A vers&atilde;o%s do AEC foi instalada' );

// install texts
define( '_AEC_INST_NOTE_IMPORTANT',				'Not&iacute;cia Importante' );
define( '_AEC_INST_NOTE_SECURITY',				'For certain features, you may need to apply hacks to other components. For your convenience, we have included an autohacking feature that does just that with the click of a link' );
define( '_AEC_INST_APPLY_HACKS',				'In order to commit these hacks right now, go to the %s. (You can also access this page later on from the AEC central view or menu)' );
define( '_AEC_INST_APPLY_HACKS_LTEXT',			'hacks page' );
define( '_AEC_INST_NOTE_UPGRADE',				'<strong>If you are upgrading, make sure to check the hacks page anyways, since there are changes from time to time!!!</strong>' );
define( '_AEC_INST_NOTE_HELP',					'To help you along with frequently encountered problems, we have created a %s that will help you ship around the most common setup problems (access is also available from the AEC central).' );
define( '_AEC_INST_NOTE_HELP_LTEXT',			'help function' );
define( '_AEC_INST_HINTS',						'Hints' );
define( '_AEC_INST_HINT1',						'We encourage you to visit the <a href="%s" target="_blank">valanx.org forums</a> and to <strong>participate in the discussion there</strong>. Chances are, that other users have found the same bugs and it is equally likely that there is at least a fix to hack in or even a new version.' );
define( '_AEC_INST_HINT2',						'De qualque maneira (e especialmente se usa esta ferramenta em sites on-line): <strong>v&aacute; as suas defini&ccedil;&otilde;es e fa&ccedil;a um teste de inscri&ccedil;&atilde;o</strong> para verificar se tudo esta a funcionar da forma que pretende! Vamos tentar fazer o nosso melhor poss&iacute;vel, algumas mudan&ccedil;as fundamentais ao nosso programa podem n&atilde;o ser poss&iacute;veis de utilizar por todo os utilizadores.</p><p><strong>Obrigado por ter escolhido o Componente AEC!</strong></p>' );
define( '_AEC_INST_ATTENTION',					'N&atilde;o precisa de utilizar o acesso(login) antigo!' );
define( '_AEC_INST_ATTENTION1',					'Se tiver instalados modulos de login anteriores do AEC, por favor remova-os (n&atilde;o importa qual, geral ou CB) e use o modulo de login normal do joomla ou CB. N&atilde;o &eacute; mais necess&aacute;rio utilizar esses modulos antigos.' );
define( '_AEC_INST_MAIN_COMP_ENTRY',			'Gerir Inscri&ccedil;&otilde;es AEC' );
define( '_AEC_INST_ERRORS',						'<strong>Aten&ccedil;&atilde;o</strong><br />n&atilde;o foi poss&iacute;vel instalar totalmente o AEC, ocorreram os seguinte erros durante a insta&ccedil;&atilde;o:<br />' );

define( '_AEC_INST_ROOT_GROUP_NAME',			'Root' );
define( '_AEC_INST_ROOT_GROUP_DESC',			'Root Group. This entry cannot be deleted, modification is limited.' );

// help
define( '_AEC_CMN_HELP',						'Ajuda' );
define( '_AEC_HELP_DESC',						'Nesta pagina, oAEC lan&ccedil;a um olhar sobre a sua pr&oacute;pria configura&ccedil;&atilde;o e diz-lhe quando ele encontra erros que precisam ser corrigidos.' );
define( '_AEC_HELP_GREEN',						'Os itens a Verde indicam problemas triviais ou notifica&ccedil;&otilde;es, ou problemas que j&aacute; foram solucionados.' );
define( '_AEC_HELP_YELLOW',						'Os itens a Amarelos s&atilde;o na sua maioria relacionados com aspectos de visualiza&ccedil;&atilde;o (tal como adic&ccedil;&otilde;es a pagina principal do utilizador), mas tamb&eacute;m quest&otilde;es que s&atilde;o muito provavelmente uma op&ccedil;&atilde;o do administrador.' );
define( '_AEC_HELP_RED',						'Os itens a Vermelho s&atilde;o de extrema import&acirc;ncia para o funcionamento do AEC ou para reguran&ccedil;a do seu Sistema.' );
define( '_AEC_HELP_GEN',						'Tenha em aten&ccedil;&atilde;o que, apesar de tentarmos abranger o maior n&uacute;mero de erros e problemas possiveis, esta pagina s&oacute; apresenta os mais &oacute;bvios e usuais, e ainda n&atilde;o se encontra totalmente conclu&iacute;da (beta&trade;)' );
define( '_AEC_HELP_QS_HEADER',					'Manual de In&iacute;cio R&aacute;pido do AEC' );
define( '_AEC_HELP_QS_DESC',					'Antes de realizar alugma coisa relativas as quest&otilde;es seguintes, por favor leia-a o nosso %s!' );
define( '_AEC_HELP_QS_DESC_LTEXT',				'Manual de In&iacute;cio R&aacute;pido' );
define( '_AEC_HELP_SER_SW_DIAG1',				'Problema de Permiss&atilde;o de Ficheiros' );;
define( '_AEC_HELP_SER_SW_DIAG1_DESC',			'AEC detectou que voc&ecirc; esta a usar um Servidor Web Apache - Para estar apto a alterarficheiros em tal servidor, os ficheiros t&ecirc;m de ser propriedade do utilizador do servidor web, o que aparentemente n&atilde;o &eacute; o caso, pelo menos em um dos ficheiros necess&aacute;rios.' );
define( '_AEC_HELP_SER_SW_DIAG1_DESC2',			'Recomendamos que mude tempor&aacute;riamente as permiss&otilde;es do ficheiros para 777, fa&ccedil;a as altera&ccedil;&otilde;es necess&aacute;rias e reponha as permiss&otilde;es iniciais. <strong>Contacte o seu servidor de alojamento ou administrador para uma r&aacute;apida resposta quando se depare com problemas.</strong> O mesmo se aplica para as permiss&otilde;es dos ficheiros a seguir indicados.' );
define( '_AEC_HELP_SER_SW_DIAG2',				'Permiss&atilde;o de Ficheiros joomla.php/mambo.php ' );
define( '_AEC_HELP_SER_SW_DIAG2_DESC',			'OAEC detectou que o ficheiro joomla.php n&atilde;o &eacute; propriedade do servidor web.' );
define( '_AEC_HELP_SER_SW_DIAG2_DESC2',			'Acesse o seu servidor web via ssh e v&aacute; a directoria \&quot;<yoursiteroot><p>/includes\&quot;. Ai, digite o seguinte commando: \&quot;chown wwwrun joomla.php\&quot; (ou \&quot;chown wwwrun mambo.php\&quot; no caso de estar a utilizar o mambo).' );
define( '_AEC_HELP_SER_SW_DIAG3',				'Altera&ccedil;&otilde;es Detectadas!' );
define( '_AEC_HELP_SER_SW_DIAG3_DESC',			'Parece que realizou altera&ccedil;&otilde;es antigas ao seu Sistema.' );
define( '_AEC_HELP_SER_SW_DIAG3_DESC2',			'De forma ao AEC funcionar de forma correcta, por favor reveja a pagina de Altera&ccedil;&otilde;es e siga o passos ai apresentados.' );
define( '_AEC_HELP_SER_SW_DIAG4',				'Problemas Permiss&atilde;o de Ficheiros' );
define( '_AEC_HELP_SER_SW_DIAG4_DESC',			'AEC n&atilde;o consegue detectar permiss&atilde;o de escrita nos ficheiros que pretende alterar, parece que a vers&atilde;o do php instalado foi compliada com a op&ccedil;&atilde;o \&quot;--disable-posix\&quot;. <strong>Pode continuar a tentar realizar as altera&ccedil;&otilde;es - se n&atilde;o funcionar, deve-se a um problema de permiss&atilde;o dos ficheiros</strong>.' );
define( '_AEC_HELP_SER_SW_DIAG4_DESC2',			'Recomenda-mos que volte a compilar a sua vers&atilde;o do php com a op&ccedil;&atilde;o referida ou contacte o seu administrador do servidor web sobre este assunto.' );
define( '_AEC_HELP_DIAG_CMN1',					'Modifica&ccedil;&otilde;es joomla.php/mambo.php' );
define( '_AEC_HELP_DIAG_CMN1_DESC',				'De forma ao AEC funcionar, esta modifica&ccedil;&atilde;o &eacute; necess&aacute;ria para redirecionar os utilizadores para as Verifica&ccedil;&otilde;es de Rotina do AEC ou Login.' );
define( '_AEC_HELP_DIAG_CMN1_DESC2',			'V&aacute; para a pagina de Modifica&ccedil;&otilde;es e fa&ccedil;a a altera&ccedil;&atilde;o' );
define( '_AEC_HELP_DIAG_CMN2',					'Entrae de Menu &quot;As Minhas Inscri&ccedil;&otilde;es&quot;' );
define( '_AEC_HELP_DIAG_CMN2_DESC',				'Link para a pagina As Minhas Inscri&ccedil;&otilde;es para facilitar a terafa dos utilizadores de realizar a sua Inscri&ccedil;&atilde;o.' );
define( '_AEC_HELP_DIAG_CMN2_DESC2',			'V&aacute; a pagina de Modifica&ccedil;&otilde;es e crie o link.' );
define( '_AEC_HELP_DIAG_CMN3',					'JACL n&atilde;o est&aacute; instalado' );
define( '_AEC_HELP_DIAG_CMN3_DESC',				'Se planeia instalar oJACLplus no seu joomla!/mambo, certoifique-se que n&atilde;o foram realidas nenhumas altera&ccedil;&otilde;es ao AEC. Se j&aacute; realizou alguma altera&ccedil;&atilde;o, pode facilmente anula-la na pagina de Modifica&ccedil;&otilde;es.' );
define( '_AEC_HELP_DIAG_NO_PAY_PLAN',			'Nenhum Plano de Pagamento Activo!' );
define( '_AEC_HELP_DIAG_NO_PAY_PLAN_DESC',		'Parece que n&atilde;o exitem ainda nenhum Plano de Pagamento publicado - OAEC precisa de pelo menos um plano activo para funcionar' );
define( '_AEC_HELP_DIAG_GLOBAL_PLAN',			'Plano Geral' );
define( '_AEC_HELP_DIAG_GLOBAL_PLAN_DESC',		'Existe um Plano Global activo na sua configura&ccedil;&atilde;o. Se n&atilde;o tiver a certeza do que isso &eacute;, deve desactiva-lo - &Eacute; um Plano Geral que ser&aacute; atribu&iacute;do a cada novo utilizador, sem ser necess&aacute;rio a sua sele&ccedil;&atilde;o.' );
define( '_AEC_HELP_DIAG_SERVER_NOT_REACHABLE',	'Servidor aparentemente Inacess&iacute;vel' );
define( '_AEC_HELP_DIAG_SERVER_NOT_REACHABLE_DESC',	'Parece que voc~e instalou o AEC numa maquina local. De forma a obter notifica&ccedil;&otilde;es (e, portanto, ter o componente a funcionar correctamente) precisa de instala-lo num servidor que seja acess&iacute;vel por IP fixo ou Dominio!' );
define( '_AEC_HELP_DIAG_SITE_OFFLINE',			'Site Offline' );
define( '_AEC_HELP_DIAG_SITE_OFFLINE_DESC',		'Decidiu colocar o seusite offline - por favor, tenha em aten&ccedil;&atilde;o que isso pode ter reflexos no funcionamento do processo de notifica&ccedil;&otilde;es e portanto no workflow de pagamentos.' );
define( '_AEC_HELP_DIAG_REG_DISABLED',			'Registo de utilizadores Desactivado' );
define( '_AEC_HELP_DIAG_REG_DISABLED_DESC',		'O seu Registo de Utilizadores encontra-se desactivado. Dessa forma, novos clientes ficam impossibilitados de se inscrever no seu site.' );
define( '_AEC_HELP_DIAG_LOGIN_DISABLED',		'Login de utilizador Desactivado' );
define( '_AEC_HELP_DIAG_LOGIN_DISABLED_DESC',	'Desactivou a funcionalidade de Login na Pagina Principal. Por esse motivo, nenhum dos seus novos clientes pode utilizar o site.' );
define( '_AEC_HELP_DIAG_PAYPAL_BUSS_ID',		'Finaliza&ccedil;&atilde;o de ID Paypal' );
define( '_AEC_HELP_DIAG_PAYPAL_BUSS_ID_DESC',	'Esta tarefa verifica o seu ID no Paypal de forma a garantir a seguranl&ccedil;a das suas transa&ccedil;&otilde;es no Paypal.' );
define( '_AEC_HELP_DIAG_PAYPAL_BUSS_ID_DESC1',	'Por favor desactive esta op&ccedil;&atilde;o no caso de encontrar problemas mesmo quando recebe correctamente os pagamentos, mas sem os utilizadores estarem activos. Desactive a op&ccedil;&atilde;o no caso de estara utilizar multiplos endere&ccedil;os de emails com a sua Conta Paypal.' );

// micro integration
// general
define( '_AEC_MI_REWRITING_INFO',				'Reescrevendo Informa&ccedil;&atilde;o' );
define( '_AEC_MI_SET1_INAME',					'Inscri&ccedil;&atilde;o em %s - Utilizador: %s (%s)' );
// htaccess
define( '_AEC_MI_HTACCESS_INFO_DESC',			'proteger uma pasta com o ficheiro .htaccess e apenas permitir o acesso a utilizadores dessa inscri&ccedil;&atilde;o com as informa&ccedil;&otilde;es da sua conta Joomla.' );
// email
define( '_AEC_MI_EMAIL_INFO_DESC',				'Enviar um Email para um ou mais endere&ccedil;os de email to one or more addresses na aplica&ccedil;&atilde;o ou na expira&ccedil;&atilde;o da inscri&ccedil;&atilde;o' );
// idev
define( '_AEC_MI_IDEV_DESC',					'Conectar as suas vendas ao iDevAffiliate' );
// mosetstree
define( '_AEC_MI_MOSETSTREE_DESC',				'Restringir a quantidade de listas que um utilizador pode publicar' );
// mysql-query
define( '_AEC_MI_MYSQL_DESC',					'Especificar uma consulta mySQL que dever&aacute; ser realizado com esta inscri&ccedil;&atilde;o ou sobre a sua expira&ccedil;&atilde;o' );
// remository
define( '_AEC_MI_REMOSITORY_DESC',				'Escolher a quantidade de ficheiros que um utilizador pode descarregar e qaul grupo de reMOSitory deve ser associado a conta do utilizador' );
// VirtueMart
define( '_AEC_MI_VIRTUEMART_DESC',				'Escolher o grupo de utilizador do VirtueMart ao qual se deve associar o utilizador' );

// central
define( '_AEC_CENTR_CENTRAL',					'AEC Central' );
define( '_AEC_CENTR_EXCLUDED',					'Exclu&iacute;do' );
define( '_AEC_CENTR_PLANS',						'Planos' );
define( '_AEC_CENTR_PENDING',					'Pendente' );
define( '_AEC_CENTR_ACTIVE',					'Activo' );
define( '_AEC_CENTR_EXPIRED',					'Expirou' );
define( '_AEC_CENTR_CANCELLED',					'Cancelado' );
define( '_AEC_CENTR_HOLD',						'Em Espera' );
define( '_AEC_CENTR_CLOSED',					'Fechado' );
define( '_AEC_CENTR_PROCESSORS',				'Processors' );
define( '_AEC_CENTR_SETTINGS',					'Defini&ccedil;&otilde;es' );
define( '_AEC_CENTR_EDIT_CSS',					'Editar CSS' );
define( '_AEC_CENTR_V_INVOICES',				'Ver Facturas' );
define( '_AEC_CENTR_COUPONS',					'Cup&otilde;es' );
define( '_AEC_CENTR_COUPONS_STATIC',			'Cup&otilde;es Est&aacute;ticos' );
define( '_AEC_CENTR_VIEW_HISTORY',				'Ver Hist&oacute;rico' );
define( '_AEC_CENTR_HACKS',						'Modifica&ccedil;&otilde;es' );
define( '_AEC_CENTR_M_INTEGRATION',				'Micro Integra&ccedil;&atilde;o' );
define( '_AEC_CENTR_HELP',						'Ajuda' );
define( '_AEC_CENTR_LOG',						'Log de Eventos' );
define( '_AEC_CENTR_MANUAL',					'Manual' );
define( '_AEC_CENTR_EXPORT',						'Exportar' );
define( '_AEC_CENTR_IMPORT',						'Importar' );
define( '_AEC_CENTR_GROUPS',					'Grupos' );
define( '_AEC_CENTR_AREA_MEMBERSHIPS',			'Area de Membros' );
define( '_AEC_CENTR_AREA_PAYMENT',				'Planos de Pagamento &amp; funcionalidades relacionadas' );
define( '_AEC_CENTR_AREA_SETTINGS',				'Defini&ccedil;&otilde;es, Logs &amp; funcionalidades especiais' );
define( '_AEC_QUICKSEARCH',						'Pesquisa R&aacute;pida' );
define( '_AEC_QUICKSEARCH_DESC',				'Coloque um nome de utilizador, id do utilizador ou um n&uacute;mero de factura para obter um link directo do perfil do utilizador. Se obter mais de um resultado, eles ser&atilde;o mostrados abaixo.' );
define( '_AEC_QUICKSEARCH_MULTIRES',			'M&uacute;ltiplos Resultados!' );
define( '_AEC_QUICKSEARCH_MULTIRES_DESC',		'Por favor selecione um dos seguintes utilizadores:' );
define( '_AEC_QUICKSEARCH_THANKS',				'Obrigado.' );
define( '_AEC_QUICKSEARCH_NOTFOUND',			'Utilizador n&atilde;o encontrado' );

define( '_AEC_NOTICES_FOUND',					'Noticias do Log de Eventos' );
define( '_AEC_NOTICES_FOUND_DESC',				'As seguintes entradasno Log de Eventos merece a sua aten&ccedil;&atilde;o. Pode assinala-las como lidas se pretende que elas desaparecam. Pode igualamente modificar o tipo de not&iacute;cias que aparecem em Defini&ccedil;&otilde;es.' );
define( '_AEC_NOTICE_MARK_READ',				'Assinalar como lida' );
define( '_AEC_NOTICE_MARK_ALL_READ',			'Assinalar Todas como Lidas' );
define( '_AEC_NOTICE_NUMBER_1',					'Evento' );
define( '_AEC_NOTICE_NUMBER_2',					'Evento' );
define( '_AEC_NOTICE_NUMBER_8',					'Not&iacute;cia' );
define( '_AEC_NOTICE_NUMBER_32',				'Aviso' );
define( '_AEC_NOTICE_NUMBER_128',				'Erro' );
define( '_AEC_NOTICE_NUMBER_512',				'Nenhum' );

// select lists
define( '_AEC_SEL_EXCLUDED',					'Exclu&iacute;do' );
define( '_AEC_SEL_PENDING',						'Pendente' );
define( '_AEC_SEL_TRIAL',						'Demonstra&ccedil;&atilde;o' );
define( '_AEC_SEL_ACTIVE',						'Activo' );
define( '_AEC_SEL_EXPIRED',						'Expirou' );
define( '_AEC_SEL_CLOSED',						'Fechado' );
define( '_AEC_SEL_CANCELLED',					'Cancelado' );
define( '_AEC_SEL_HOLD',						'Espera' );
define( '_AEC_SEL_NOT_CONFIGURED',				'N&atilde;o Configurado' );

// footer
define( '_AEC_FOOT_TX_CHOOSING',				'Obrigado por ter escolhido o Componente de Controlo de Espira&ccedil;&atilde;o de Contas!' );
define( '_AEC_FOOT_TX_GPL',						'This Joomla component was developed and released under the <a href="http://www.gnu.org/copyleft/gpl.html" target="_blank">GNU/GPL</a> license by David Deutsch & Team AEC from <a href="http://www.valanx.org" target="_blank">valanx.org</a>' );
define( '_AEC_FOOT_TX_SUBSCRIBE',				'Se desejar mais funcionalidade, servi&ccedil;os profissionais, updates, manuais e ajuda online para este componente, pode subscrever os nossos servi&ccedil;os no link abaixo. Isso ahuda-nos bastante nos nossos deenvolvimentos!' );
define( '_AEC_FOOT_CREDIT',						'Por leia os nossos %s' );
define( '_AEC_FOOT_CREDIT_LTEXT',				'cr&eacute;ditos completos' );
define( '_AEC_FOOT_VERSION_CHECK',				'Veriricar se existem vers&otilde;es mais recentes' );
define( '_AEC_FOOT_MEMBERSHIP',					'Obter uma Ades&atilde;o com documeta&ccedil;&atilde;o e suporte' );

// alerts
define( '_AEC_ALERT_SELECT_FIRST',				'Selecione um item para configurar' );
define( '_AEC_ALERT_SELECT_FIRST_TO',			'Por favor selecione primeiro um item para' );

// messages
define( '_AEC_MSG_NODELETE_SUPERADMIN',			'N&atilde;o pode eliminar um Super Administrador' );
define( '_AEC_MSG_NODELETE_YOURSELF',			'N&atilde;o pode eliminar-se a si propio!' );
define( '_AEC_MSG_NODELETE_EXCEPT_SUPERADMIN',	'Apenas Super Administradores podem realizar essa opera&ccedil;&atilde;o!' );
define( '_AEC_MSG_SUBS_RENEWED',				'inscri&ccedil;&atilde;o renovada' );
define( '_AEC_MSG_SUBS_ACTIVATED',				'inscri&ccedil;&atilde;o activada' );
define( '_AEC_MSG_NO_ITEMS_TO_DELETE',			'N&atilde;o foram encontrados nenhum item para eliminar' );
define( '_AEC_MSG_NO_DEL_W_ACTIVE_SUBSCRIBER',	'N&atilde;o pode eliminar Planos com subscritores activos' );
define( '_AEC_MSG_ITEMS_DELETED',				'Iten(s) eliminados' );
define( '_AEC_MSG_ITEMS_SUCESSFULLY',			'Elimina&ccedil;&atilde;o do Item(s) %sbem sucedida' );
define( '_AEC_MSG_SUCESSFULLY_SAVED',			'Altera&ccedil;&otilde;es guardas com sucesso' );
define( '_AEC_MSG_ITEMS_SUCC_PUBLISHED',		'Item(s) Publicado com sucesso' );
define( '_AEC_MSG_ITEMS_SUCC_UNPUBLISHED',		'Item(s) N&atilde;o Publicado com sucesso' );
define( '_AEC_MSG_NO_COUPON_CODE',				'Deve especificar um c&oacute;digo de Cup&atilde;o!' );
define( '_AEC_MSG_OP_FAILED',					'Falhou a Opera&ccedil;&atilde;o: N&atilde;o foi poss&iacute;vel abrir %s' );
define( '_AEC_MSG_OP_FAILED_EMPTY',				'Falhou a Opera&ccedil;&atilde;o: Conte&uacute;do v&aacute;zio' );
define( '_AEC_MSG_OP_FAILED_NOT_WRITEABLE',		'Falhou a Opera&ccedil;&atilde;o: Este ficheiro n&atilde;o tem permiss&otilde;es de escrita.' );
define( '_AEC_MSG_OP_FAILED_NO_WRITE',			'Falhou a Opera&ccedil;&atilde;o: Falhou a abertura do ficheiro para a sua escrita' );
define( '_AEC_MSG_INVOICE_CLEARED',				'Factura Limpa' );

// ISO 3166 Two-Character Country Codes
define( '_AEC_LANG_AD', 'Andorra' );
define( '_AEC_LANG_AE', 'United Arab Emirates' );
define( '_AEC_LANG_AF', 'Afghanistan' );
define( '_AEC_LANG_AG', 'Antigua and Barbuda' );
define( '_AEC_LANG_AI', 'Anguilla' );
define( '_AEC_LANG_AL', 'Albania' );
define( '_AEC_LANG_AM', 'Armenia' );
define( '_AEC_LANG_AN', 'Netherlands Antilles' );
define( '_AEC_LANG_AO', 'Angola' );
define( '_AEC_LANG_AQ', 'Antarctica' );
define( '_AEC_LANG_AR', 'Argentina' );
define( '_AEC_LANG_AS', 'American Samoa' );
define( '_AEC_LANG_AT', 'Austria' );
define( '_AEC_LANG_AU', 'Australia' );
define( '_AEC_LANG_AW', 'Aruba' );
define( '_AEC_LANG_AX', 'Aland Islands &#65279;land Island\'s' );
define( '_AEC_LANG_AZ', 'Azerbaijan' );
define( '_AEC_LANG_BA', 'Bosnia and Herzegovina' );
define( '_AEC_LANG_BB', 'Barbados' );
define( '_AEC_LANG_BD', 'Bangladesh' );
define( '_AEC_LANG_BE', 'Belgium' );
define( '_AEC_LANG_BF', 'Burkina Faso' );
define( '_AEC_LANG_BG', 'Bulgaria' );
define( '_AEC_LANG_BH', 'Bahrain' );
define( '_AEC_LANG_BI', 'Burundi' );
define( '_AEC_LANG_BJ', 'Benin' );
define( '_AEC_LANG_BL', 'Saint Barth&eacute;lemy' );
define( '_AEC_LANG_BM', 'Bermuda' );
define( '_AEC_LANG_BN', 'Brunei Darussalam' );
define( '_AEC_LANG_BO', 'Bolivia, Plurinational State of' );
define( '_AEC_LANG_BR', 'Brazil' );
define( '_AEC_LANG_BS', 'Bahamas' );
define( '_AEC_LANG_BT', 'Bhutan' );
define( '_AEC_LANG_BV', 'Bouvet Island' );
define( '_AEC_LANG_BW', 'Botswana' );
define( '_AEC_LANG_BY', 'Belarus' );
define( '_AEC_LANG_BZ', 'Belize' );
define( '_AEC_LANG_CA', 'Canada' );
define( '_AEC_LANG_CC', 'Cocos (Keeling) Islands' );
define( '_AEC_LANG_CD', 'Congo, the Democratic Republic of the' );
define( '_AEC_LANG_CF', 'Central African Republic' );
define( '_AEC_LANG_CG', 'Congo' );
define( '_AEC_LANG_CH', 'Switzerland' );
define( '_AEC_LANG_CI', 'Cote d\'Ivoire' );
define( '_AEC_LANG_CK', 'Cook Islands' );
define( '_AEC_LANG_CL', 'Chile' );
define( '_AEC_LANG_CM', 'Cameroon' );
define( '_AEC_LANG_CN', 'China' );
define( '_AEC_LANG_CO', 'Colombia' );
define( '_AEC_LANG_CR', 'Costa Rica' );
define( '_AEC_LANG_CU', 'Cuba' );
define( '_AEC_LANG_CV', 'Cape Verde' );
define( '_AEC_LANG_CX', 'Christmas Island' );
define( '_AEC_LANG_CY', 'Cyprus' );
define( '_AEC_LANG_CZ', 'Czech Republic' );
define( '_AEC_LANG_DE', 'Germany' );
define( '_AEC_LANG_DJ', 'Djibouti' );
define( '_AEC_LANG_DK', 'Denmark' );
define( '_AEC_LANG_DM', 'Dominica' );
define( '_AEC_LANG_DO', 'Dominican Republic' );
define( '_AEC_LANG_DZ', 'Algeria' );
define( '_AEC_LANG_EC', 'Ecuador' );
define( '_AEC_LANG_EE', 'Estonia' );
define( '_AEC_LANG_EG', 'Egypt' );
define( '_AEC_LANG_EH', 'Western Sahara' );
define( '_AEC_LANG_ER', 'Eritrea' );
define( '_AEC_LANG_ES', 'Spain' );
define( '_AEC_LANG_ET', 'Ethiopia' );
define( '_AEC_LANG_FI', 'Finland' );
define( '_AEC_LANG_FJ', 'Fiji' );
define( '_AEC_LANG_FK', 'Falkland Islands (Malvinas)' );
define( '_AEC_LANG_FM', 'Micronesia, Federated States of' );
define( '_AEC_LANG_FO', 'Faroe Islands' );
define( '_AEC_LANG_FR', 'France' );
define( '_AEC_LANG_GA', 'Gabon' );
define( '_AEC_LANG_GB', 'United Kingdom' );
define( '_AEC_LANG_GD', 'Grenada' );
define( '_AEC_LANG_GE', 'Georgia' );
define( '_AEC_LANG_GF', 'French Guiana' );
define( '_AEC_LANG_GG', 'Guernsey' );
define( '_AEC_LANG_GH', 'Ghana' );
define( '_AEC_LANG_GI', 'Gibraltar' );
define( '_AEC_LANG_GL', 'Greenland' );
define( '_AEC_LANG_GM', 'Gambia' );
define( '_AEC_LANG_GN', 'Guinea' );
define( '_AEC_LANG_GP', 'Guadeloupe' );
define( '_AEC_LANG_GQ', 'Equatorial Guinea' );
define( '_AEC_LANG_GR', 'Greece' );
define( '_AEC_LANG_GS', 'South Georgia and the South Sandwich Islands' );
define( '_AEC_LANG_GT', 'Guatemala' );
define( '_AEC_LANG_GU', 'Guam' );
define( '_AEC_LANG_GW', 'Guinea-Bissau' );
define( '_AEC_LANG_GY', 'Guyana' );
define( '_AEC_LANG_HK', 'Hong Kong' );
define( '_AEC_LANG_HM', 'Heard Island and McDonald Islands' );
define( '_AEC_LANG_HN', 'Honduras' );
define( '_AEC_LANG_HR', 'Croatia' );
define( '_AEC_LANG_HT', 'Haiti' );
define( '_AEC_LANG_HU', 'Hungary' );
define( '_AEC_LANG_ID', 'Indonesia' );
define( '_AEC_LANG_IE', 'Ireland' );
define( '_AEC_LANG_IL', 'Israel' );
define( '_AEC_LANG_IM', 'Isle of Man' );
define( '_AEC_LANG_IN', 'India' );
define( '_AEC_LANG_IO', 'British Indian Ocean Territory' );
define( '_AEC_LANG_IQ', 'Iraq' );
define( '_AEC_LANG_IR', 'Iran, Islamic Republic of' );
define( '_AEC_LANG_IS', 'Iceland' );
define( '_AEC_LANG_IT', 'Italy' );
define( '_AEC_LANG_JE', 'Jersey' );
define( '_AEC_LANG_JM', 'Jamaica' );
define( '_AEC_LANG_JO', 'Jordan' );
define( '_AEC_LANG_JP', 'Japan' );
define( '_AEC_LANG_KE', 'Kenya' );
define( '_AEC_LANG_KG', 'Kyrgyzstan' );
define( '_AEC_LANG_KH', 'Cambodia' );
define( '_AEC_LANG_KI', 'Kiribati' );
define( '_AEC_LANG_KM', 'Comoros' );
define( '_AEC_LANG_KN', 'Saint Kitts and Nevis' );
define( '_AEC_LANG_KP', 'Korea, Democratic People\'s Republic of' );
define( '_AEC_LANG_KR', 'Korea, Republic of' );
define( '_AEC_LANG_KW', 'Kuwait' );
define( '_AEC_LANG_KY', 'Cayman Islands' );
define( '_AEC_LANG_KZ', 'Kazakhstan' );
define( '_AEC_LANG_LA', 'Lao People\'s Democratic Republic' );
define( '_AEC_LANG_LB', 'Lebanon' );
define( '_AEC_LANG_LC', 'Saint Lucia' );
define( '_AEC_LANG_LI', 'Liechtenstein' );
define( '_AEC_LANG_LK', 'Sri Lanka' );
define( '_AEC_LANG_LR', 'Liberia' );
define( '_AEC_LANG_LS', 'Lesotho' );
define( '_AEC_LANG_LT', 'Lithuania' );
define( '_AEC_LANG_LU', 'Luxembourg' );
define( '_AEC_LANG_LV', 'Latvia' );
define( '_AEC_LANG_LY', 'Libyan Arab Jamahiriya' );
define( '_AEC_LANG_MA', 'Morocco' );
define( '_AEC_LANG_MC', 'Monaco' );
define( '_AEC_LANG_MD', 'Moldova, Republic of' );
define( '_AEC_LANG_ME', 'Montenegro' );
define( '_AEC_LANG_MF', 'Saint Martin (French part)' );
define( '_AEC_LANG_MG', 'Madagascar' );
define( '_AEC_LANG_MH', 'Marshall Islands' );
define( '_AEC_LANG_MK', 'Macedonia, the former Yugoslav Republic of' );
define( '_AEC_LANG_ML', 'Mali' );
define( '_AEC_LANG_MM', 'Myanmar' );
define( '_AEC_LANG_MN', 'Mongolia' );
define( '_AEC_LANG_MO', 'Macao' );
define( '_AEC_LANG_MP', 'Northern Mariana Islands' );
define( '_AEC_LANG_MQ', 'Martinique' );
define( '_AEC_LANG_MR', 'Mauritania' );
define( '_AEC_LANG_MS', 'Montserrat' );
define( '_AEC_LANG_MT', 'Malta' );
define( '_AEC_LANG_MU', 'Mauritius' );
define( '_AEC_LANG_MV', 'Maldives' );
define( '_AEC_LANG_MW', 'Malawi' );
define( '_AEC_LANG_MX', 'Mexico' );
define( '_AEC_LANG_MY', 'Malaysia' );
define( '_AEC_LANG_MZ', 'Mozambique' );
define( '_AEC_LANG_NA', 'Namibia' );
define( '_AEC_LANG_NC', 'New Caledonia' );
define( '_AEC_LANG_NE', 'Niger' );
define( '_AEC_LANG_NF', 'Norfolk Island' );
define( '_AEC_LANG_NG', 'Nigeria' );
define( '_AEC_LANG_NI', 'Nicaragua' );
define( '_AEC_LANG_NL', 'Netherlands' );
define( '_AEC_LANG_NO', 'Norway' );
define( '_AEC_LANG_NP', 'Nepal' );
define( '_AEC_LANG_NR', 'Nauru' );
define( '_AEC_LANG_NU', 'Niue' );
define( '_AEC_LANG_NZ', 'New Zealand' );
define( '_AEC_LANG_OM', 'Oman' );
define( '_AEC_LANG_PA', 'Panama' );
define( '_AEC_LANG_PE', 'Peru' );
define( '_AEC_LANG_PF', 'French Polynesia' );
define( '_AEC_LANG_PG', 'Papua New Guinea' );
define( '_AEC_LANG_PH', 'Philippines' );
define( '_AEC_LANG_PK', 'Pakistan' );
define( '_AEC_LANG_PL', 'Poland' );
define( '_AEC_LANG_PM', 'Saint Pierre and Miquelon' );
define( '_AEC_LANG_PN', 'Pitcairn' );
define( '_AEC_LANG_PR', 'Puerto Rico' );
define( '_AEC_LANG_PS', 'Palestinian Territory, Occupied' );
define( '_AEC_LANG_PT', 'Portugal' );
define( '_AEC_LANG_PW', 'Palau' );
define( '_AEC_LANG_PY', 'Paraguay' );
define( '_AEC_LANG_QA', 'Qatar' );
define( '_AEC_LANG_RE', 'Reunion' );
define( '_AEC_LANG_RO', 'Romania' );
define( '_AEC_LANG_RS', 'Serbia' );
define( '_AEC_LANG_RU', 'Russian Federation' );
define( '_AEC_LANG_RW', 'Rwanda' );
define( '_AEC_LANG_SA', 'Saudi Arabia' );
define( '_AEC_LANG_SB', 'Solomon Islands' );
define( '_AEC_LANG_SC', 'Seychelles' );
define( '_AEC_LANG_SD', 'Sudan' );
define( '_AEC_LANG_SE', 'Sweden' );
define( '_AEC_LANG_SG', 'Singapore' );
define( '_AEC_LANG_SH', 'Saint Helena' );
define( '_AEC_LANG_SI', 'Slovenia' );
define( '_AEC_LANG_SJ', 'Svalbard and Jan Mayen' );
define( '_AEC_LANG_SK', 'Slovakia' );
define( '_AEC_LANG_SL', 'Sierra Leone' );
define( '_AEC_LANG_SM', 'San Marino' );
define( '_AEC_LANG_SN', 'Senegal' );
define( '_AEC_LANG_SO', 'Somalia' );
define( '_AEC_LANG_SR', 'Suriname' );
define( '_AEC_LANG_ST', 'Sao Tome and Principe' );
define( '_AEC_LANG_SV', 'El Salvador' );
define( '_AEC_LANG_SY', 'Syrian Arab Republic' );
define( '_AEC_LANG_SZ', 'Swaziland' );
define( '_AEC_LANG_TC', 'Turks and Caicos Islands' );
define( '_AEC_LANG_TD', 'Chad' );
define( '_AEC_LANG_TF', 'French Southern Territories' );
define( '_AEC_LANG_TG', 'Togo' );
define( '_AEC_LANG_TH', 'Thailand' );
define( '_AEC_LANG_TJ', 'Tajikistan' );
define( '_AEC_LANG_TK', 'Tokelau' );
define( '_AEC_LANG_TL', 'Timor-Leste' );
define( '_AEC_LANG_TM', 'Turkmenistan' );
define( '_AEC_LANG_TN', 'Tunisia' );
define( '_AEC_LANG_TO', 'Tonga' );
define( '_AEC_LANG_TR', 'Turkey' );
define( '_AEC_LANG_TT', 'Trinidad and Tobago' );
define( '_AEC_LANG_TV', 'Tuvalu' );
define( '_AEC_LANG_TW', 'Taiwan, Province of Republic of China' );
define( '_AEC_LANG_TZ', 'Tanzania, United Republic of' );
define( '_AEC_LANG_UA', 'Ukraine' );
define( '_AEC_LANG_UG', 'Uganda' );
define( '_AEC_LANG_UM', 'United States Minor Outlying Islands' );
define( '_AEC_LANG_US', 'United States' );
define( '_AEC_LANG_UY', 'Uruguay' );
define( '_AEC_LANG_UZ', 'Uzbekistan' );
define( '_AEC_LANG_VA', 'Holy See (Vatican City State)' );
define( '_AEC_LANG_VC', 'Saint Vincent and the Grenadines' );
define( '_AEC_LANG_VE', 'Venezuela, Bolivarian Republic of' );
define( '_AEC_LANG_VG', 'Virgin Islands, British' );
define( '_AEC_LANG_VI', 'Virgin Islands, U.S.' );
define( '_AEC_LANG_VN', 'Viet Nam' );
define( '_AEC_LANG_VU', 'Vanuatu' );
define( '_AEC_LANG_WF', 'Wallis and Futuna' );
define( '_AEC_LANG_WS', 'Samoa' );
define( '_AEC_LANG_YE', 'Yemen' );
define( '_AEC_LANG_YT', 'Mayotte' );
define( '_AEC_LANG_ZA', 'South Africa' );
define( '_AEC_LANG_ZM', 'Zambia' );
define( '_AEC_LANG_ZW', 'Zimbabwe' );

// --== COUPON EDIT ==--
define( '_COUPON_DETAIL_TITLE', 'Cup&atilde;o');
define( '_COUPON_RESTRICTIONS_TITLE', 'Restrito.');
define( '_COUPON_RESTRICTIONS_TITLE_FULL', 'Restri&ccedil;&otilde;es');
define( '_COUPON_MI', 'Micro Integra&ccedil;&atilde;o.');
define( '_COUPON_MI_FULL', 'Micro Integra&ccedil;&otilde;es');

define( '_COUPON_GENERAL_NAME_NAME', 'Nome');
define( '_COUPON_GENERAL_NAME_DESC', 'Introduza onome (interno&amp;externo) para este cup&atilde;o');
define( '_COUPON_GENERAL_COUPON_CODE_NAME', 'C&oacute;digo Cup&atilde;o');
define( '_COUPON_GENERAL_COUPON_CODE_DESC', 'Introduza o c&oacute;digo para este cup&atilde;o - o c&oacute;digo gerado aleatoriamente est&aacute; configurado para ser &uacute;nico e exclusivo no sistema');
define( '_COUPON_GENERAL_DESC_NAME', 'Descri&ccedil;&atilde;o');
define( '_COUPON_GENERAL_DESC_DESC', 'Introduza a descri&ccedil;&atilde;o (interna) para este cup&atilde;o');
define( '_COUPON_GENERAL_ACTIVE_NAME', 'Activo');
define( '_COUPON_GENERAL_ACTIVE_DESC', 'Definir se este cup&atilde;o est&aacute; activo (pode ser usado)');
define( '_COUPON_GENERAL_TYPE_NAME', 'Est&aacute;tico');
define( '_COUPON_GENERAL_TYPE_DESC', 'Selecione se pretende que este cup&atilde;o sej&aacute; est&aacute;tico. Esses cup&otilde;es s&atilde;o guardados numa tabela separada para um acesso mais r&aacute;pido, os cup&otilde;es est&aacute;ticos s&atilde;o utilizados por v&aacute;rios utilizadores enquanto os cup&otilde;es din&aacute;micos s&atilde;o atribu&iacute;dos a um utilizador especifico.');

define( '_COUPON_GENERAL_MICRO_INTEGRATIONS_NAME', 'Micro Integra&ccedil;&otilde;es');
define( '_COUPON_GENERAL_MICRO_INTEGRATIONS_DESC', 'Selecione as Micro Integra&ccedil;&otilde;es que voc&ecirc; pretende que sejam usadas qaundo este cup&atilde;o for usado');

define( '_COUPON_PARAMS_AMOUNT_USE_NAME', 'Usar Valor');
define( '_COUPON_PARAMS_AMOUNT_USE_DESC', 'Selecione se pretende usar um valor de desconto directo');
define( '_COUPON_PARAMS_AMOUNT_NAME', 'Valor Desconto');
define( '_COUPON_PARAMS_AMOUNT_DESC', 'Introduza o valor que pretende deduzir do pr&oacute;ximo montante');
define( '_COUPON_PARAMS_AMOUNT_PERCENT_USE_NAME', 'Usar Percentagem');
define( '_COUPON_PARAMS_AMOUNT_PERCENT_USE_DESC', 'Selecione se pretende uma percentagem deduzida do actual valor');
define( '_COUPON_PARAMS_AMOUNT_PERCENT_NAME', 'Percentagem de Desconto');
define( '_COUPON_PARAMS_AMOUNT_PERCENT_DESC', 'Introduza apercentagem que pretende deduzir do valor');
define( '_COUPON_PARAMS_PERCENT_FIRST_NAME', 'Primeiro Percentagem');
define( '_COUPON_PARAMS_PERCENT_FIRST_DESC', 'Se voc~e combinar percentagem e valor, pretende que a percentagem seja deduzida primeiro?');
define( '_COUPON_PARAMS_USEON_TRIAL_NAME', 'Usar na Demostra&ccedil;&atilde;o?');
define( '_COUPON_PARAMS_USEON_TRIAL_DESC', 'Quer que o utilizador utilize este desconto num valor experimental?');
define( '_COUPON_PARAMS_USEON_FULL_NAME', 'Usar na Totalidade?');
define( '_COUPON_PARAMS_USEON_FULL_DESC', 'Quer que o utilizador utilize este desconto ao valor actual? (With recurring billing: to the first regular payment)');
define( '_COUPON_PARAMS_USEON_FULL_ALL_NAME', 'Tudo Completo?');
define( '_COUPON_PARAMS_USEON_FULL_ALL_DESC', 'Se o utilizador estiver a utilizar pagamentos recurrentes, pretende conceder este desconto para cada pagamento subsequente? (Ou simplesmente para o primeiro, se isso se aplica - ent&atilde;o selecione N&atilde;o)');

define( '_COUPON_PARAMS_HAS_START_DATE_NAME', 'Usar Data de In&iacute;cio');
define( '_COUPON_PARAMS_HAS_START_DATE_DESC', 'Permitir que os utilizadoresusem este cup&atilde;o apenas apartir de uma data definida?');
define( '_COUPON_PARAMS_START_DATE_NAME', 'Data de In&iacute;cio');
define( '_COUPON_PARAMS_START_DATE_DESC', 'Selecione a data apartir da qual pretende que o cup&atilde;o esteja dispon&iacute;vel para uso');
define( '_COUPON_PARAMS_HAS_EXPIRATION_NAME', 'Data Final');
define( '_COUPON_PARAMS_HAS_EXPIRATION_DESC', 'Pretende definir uma data final, at&eacute; a qual &eacute; poss&iacute;vel utilizar o cup&atilde;o?');
define( '_COUPON_PARAMS_EXPIRATION_NAME', 'Data Final');
define( '_COUPON_PARAMS_EXPIRATION_DESC', 'Selecione a data at&eacute; a qual &eacute; possivel utilizar este cup&atilde;o');
define( '_COUPON_PARAMS_HAS_MAX_REUSE_NAME', 'Restringir Re-utiliza&ccedil;&atilde;o?');
define( '_COUPON_PARAMS_HAS_MAX_REUSE_DESC', 'Deseja definir i n&uacute;mero de vezes que este cup&atilde;o pode ser utilizado?');
define( '_COUPON_PARAMS_MAX_REUSE_NAME', 'N&uacute;mero de Utiliza&ccedil;&otilde;es');
define( '_COUPON_PARAMS_MAX_REUSE_DESC', 'Escolha o n&uacute;mero de utiliza&ccedil;&otilde;es que este cup&atilde;o pode ter');
define( '_COUPON_PARAMS_HAS_MAX_PERUSER_REUSE_NAME', 'Restringir Re-utiliza&ccedil;&atilde;o por utilizador?');
define( '_COUPON_PARAMS_HAS_MAX_PERUSER_REUSE_DESC', 'Deseja restringir o n&uacute;mero de vezes que cada utilizador pode utilizar este cup&atilde;o?');
define( '_COUPON_PARAMS_MAX_PERUSER_REUSE_NAME', 'N&uacute;mero de Utiliza&ccedil;&atilde;o Maxima por Utilizador');
define( '_COUPON_PARAMS_MAX_PERUSER_REUSE_DESC', 'Escolha o n&uacute;mero de vezes que este cup&atilde;o pode ser utilizado por cada utilizador');

define( '_COUPON_PARAMS_USECOUNT_NAME', 'Usar Contador');
define( '_COUPON_PARAMS_USECOUNT_DESC', 'Limpar o n&uacute;mero de vezes que este Cup&atilde;o foi utilizado');

define( '_COUPON_PARAMS_USAGE_PLANS_ENABLED_NAME', 'Definir Plano');
define( '_COUPON_PARAMS_USAGE_PLANS_ENABLED_DESC', 'Pretende utilizar este cup&atilde;o paenas para determinados planos?');
define( '_COUPON_PARAMS_USAGE_PLANS_NAME', 'Planos');
define( '_COUPON_PARAMS_USAGE_PLANS_DESC', 'Escolha quais os planos que pretende associar a este cup&atilde;o');
define( '_COUPON_PARAMS_USAGE_CART_FULL_NAME', 'Use on Cart');
define( '_COUPON_PARAMS_USAGE_CART_FULL_DESC', 'Allow Application to a full shopping card');
define( '_COUPON_PARAMS_CART_MULTIPLE_ITEMS_NAME', 'Multiple Items');
define( '_COUPON_PARAMS_CART_MULTIPLE_ITEMS_DESC', 'Let the user apply the coupon to multiple items of a shopping cart, if overall restrictions permit it');
define( '_COUPON_PARAMS_CART_MULTIPLE_ITEMS_AMOUNT_NAME', 'Multiple Items Amount');
define( '_COUPON_PARAMS_CART_MULTIPLE_ITEMS_AMOUNT_DESC', 'Set a limit for application to multiple items of one shopping cart');

define( '_COUPON_RESTRICTIONS_MINGID_ENABLED_NAME', 'ActivarGID Minimo:');
define( '_COUPON_RESTRICTIONS_MINGID_ENABLED_DESC', 'Activar esta op&ccedil;&atilde;o se voce pretende definir um n&uacute;mero m&iacute;nimo de grupo de utilizadores onde o utilizador pde uar este cup&atilde;o.');
define( '_COUPON_RESTRICTIONS_MINGID_NAME', 'Visibilidade do Grupo:');
define( '_COUPON_RESTRICTIONS_MINGID_DESC', 'Nivel minimo de utilizador necess&aacute;rio para este cup&atilde;o.');
define( '_COUPON_RESTRICTIONS_FIXGID_ENABLED_NAME', 'ActivarGID Fixo:');
define( '_COUPON_RESTRICTIONS_FIXGID_ENABLED_DESC', 'Activar esta op&ccedil;&atilde;o se pretender restringir este cup&atilde;o apenas a um grupo de utilizadores.');
define( '_COUPON_RESTRICTIONS_FIXGID_NAME', 'Definir Grupo:');
define( '_COUPON_RESTRICTIONS_FIXGID_DESC', 'Apenas utilizadores deste grupo de utilizadores podem usar este cup&atilde;o.');
define( '_COUPON_RESTRICTIONS_MAXGID_ENABLED_NAME', 'Activar GID M&aacute;ximo:');
define( '_COUPON_RESTRICTIONS_MAXGID_ENABLED_DESC', 'Activar esta op&ccedil;&atilde;o se pretende definir um n&uacute;mero m&aacute;ximo de grupo de utilizadores onde o utilizador pode usar este cup&atilde;o.');
define( '_COUPON_RESTRICTIONS_MAXGID_NAME', 'Grupo M&aacute;ximo:');
define( '_COUPON_RESTRICTIONS_MAXGID_DESC', 'O nivel m&aacute;ximo de utilizador que o utilizador pode ter para utilizar este cup&atilde;o.');

define( '_COUPON_RESTRICTIONS_PREVIOUSPLAN_REQ_ENABLED_NAME', 'Plano Anterior Requerido:');
define( '_COUPON_RESTRICTIONS_PREVIOUSPLAN_REQ_ENABLED_DESC', 'Activa verifica&ccedil;&atilde;o para plano de pagamentos anterior');
define( '_COUPON_RESTRICTIONS_PREVIOUSPLAN_REQ_NAME', 'Plano:');
define( '_COUPON_RESTRICTIONS_PREVIOUSPLAN_REQ_DESC', 'Um utilizador apenas esta autorizado a utilizar este cup&atilde;o se j&aacute; tiver usado o plano anterior antes do actual em uso');
define( '_COUPON_RESTRICTIONS_CURRENTPLAN_REQ_ENABLED_NAME', 'Actual Plano Necess&aacute;rio:');
define( '_COUPON_RESTRICTIONS_CURRENTPLAN_REQ_ENABLED_DESC', 'Activar verifica&ccedil;&atilde;o para o actual plano de pagamento');
define( '_COUPON_RESTRICTIONS_CURRENTPLAN_REQ_NAME', 'Plano:');
define( '_COUPON_RESTRICTIONS_CURRENTPLAN_REQ_DESC', 'Um utilizador apenas est&aacute; autorizado a usar este cup&atilde;o se tiver actualmente associado, ou ja tiver expirado o plano definido,');
define( '_COUPON_RESTRICTIONS_OVERALLPLAN_REQ_ENABLED_NAME', 'Plano Usado Necess&aacute;rio:');
define( '_COUPON_RESTRICTIONS_OVERALLPLAN_REQ_ENABLED_DESC', 'Activar verifica&ccedil;&atilde;o para plano de pagamento global usados');
define( '_COUPON_RESTRICTIONS_OVERALLPLAN_REQ_NAME', 'Plano:');
define( '_COUPON_RESTRICTIONS_OVERALLPLAN_REQ_DESC', 'um utilizador apenas est&aacute; autorizado a utilizar este cup&atilde;o se ja utilizou o plano uma vez, n&atilde;o importa qando');

define( '_COUPON_RESTRICTIONS_USED_PLAN_MIN_ENABLED_NAME', 'Plano UsadoMinimo:');
define( '_COUPON_RESTRICTIONS_USED_PLAN_MIN_ENABLED_DESC', 'Activar verifica&ccedil;&atilde;o para o minimo n&uacute;mero de vezes que o cliente subscreveu um plano de pagamento espec&iacute;fico de forma a poder usar este cup&atilde;o');
define( '_COUPON_RESTRICTIONS_USED_PLAN_MIN_AMOUNT_NAME', 'Used Amount:');
define( '_COUPON_RESTRICTIONS_USED_PLAN_MIN_AMOUNT_DESC', 'Valor minimo que o utilizador deve ter usado no plano selecionado');
define( '_COUPON_RESTRICTIONS_USED_PLAN_MIN_NAME', 'Plano:');
define( '_COUPON_RESTRICTIONS_USED_PLAN_MIN_DESC', 'O plano de pagamento que o utilizador deve ter usado pelo menos o n&uacute;mero de vezes especificado');
define( '_COUPON_RESTRICTIONS_USED_PLAN_MAX_ENABLED_NAME', 'Plano Usado M&aacute;ximo:');
define( '_COUPON_RESTRICTIONS_USED_PLAN_MAX_ENABLED_DESC', 'Activar a verifica&ccedil;&atilde;o para o n&uacute;mero m&aacute;ximo de vezes qeu os clientes tiveram de subscrever um plano de pagamento espec&iacute;fico para poderem utilizar este cup&atilde;o');
define( '_COUPON_RESTRICTIONS_USED_PLAN_MAX_AMOUNT_NAME', 'Valor usado:');
define( '_COUPON_RESTRICTIONS_USED_PLAN_MAX_AMOUNT_DESC', 'O vaor m&aacute;ximo que o utilizador pode ter utilizado o plano selecionado');
define( '_COUPON_RESTRICTIONS_USED_PLAN_MAX_NAME', 'Plano:');
define( '_COUPON_RESTRICTIONS_USED_PLAN_MAX_DESC', 'o plano de pagamento que o utilizador teve de utilizar no m&aacute;ximo o n&uacute;mero de vezes espec&iacute;ficado');

define( '_COUPON_RESTRICTIONS_PREVIOUSGROUP_REQ_ENABLED_NAME', 'Required Prev. Group:');
define( '_COUPON_RESTRICTIONS_PREVIOUSGROUP_REQ_ENABLED_DESC', 'Enable checking for previous payment plan in this group');
define( '_COUPON_RESTRICTIONS_PREVIOUSGROUP_REQ_NAME', 'Group:');
define( '_COUPON_RESTRICTIONS_PREVIOUSGROUP_REQ_DESC', 'A user will only be able to use the coupon if he or she used a plan in this group before the one currently in use');
define( '_COUPON_RESTRICTIONS_CURRENTGROUP_REQ_ENABLED_NAME', 'Required Curr. Group:');
define( '_COUPON_RESTRICTIONS_CURRENTGROUP_REQ_ENABLED_DESC', 'Enable checking for currently present payment plan in this group');
define( '_COUPON_RESTRICTIONS_CURRENTGROUP_REQ_NAME', 'Group:');
define( '_COUPON_RESTRICTIONS_CURRENTGROUP_REQ_DESC', 'A user will only be able to use the coupon if he or she is currently assigned to, or has just expired from a plan in this group selected here');
define( '_COUPON_RESTRICTIONS_OVERALLGROUP_REQ_ENABLED_NAME', 'Required Used Group:');
define( '_COUPON_RESTRICTIONS_OVERALLGROUP_REQ_ENABLED_DESC', 'Enable checking for overall used payment plan in this group');
define( '_COUPON_RESTRICTIONS_OVERALLGROUP_REQ_NAME', 'Group:');
define( '_COUPON_RESTRICTIONS_OVERALLGROUP_REQ_DESC', 'A user will only be able to use the coupon if he or she has used the selected plan in this group once, no matter when');

define( '_COUPON_RESTRICTIONS_PREVIOUSGROUP_REQ_ENABLED_EXCLUDED_NAME', 'Excluded Prev. Group:');
define( '_COUPON_RESTRICTIONS_PREVIOUSGROUP_REQ_ENABLED_EXCLUDED_DESC', 'Do NOT allow using this coupon to users who had a plan in this group as their previous payment plan');
define( '_COUPON_RESTRICTIONS_PREVIOUSGROUP_REQ_EXCLUDED_NAME', 'Group:');
define( '_COUPON_RESTRICTIONS_PREVIOUSGROUP_REQ_EXCLUDED_DESC', 'A user will not be able to use the coupon if he or she used a plan in this group before the one currently in use');
define( '_COUPON_RESTRICTIONS_CURRENTGROUP_REQ_ENABLED_EXCLUDED_NAME', 'Excluded Curr. Group:');
define( '_COUPON_RESTRICTIONS_CURRENTGROUP_REQ_ENABLED_EXCLUDED_DESC', 'Do NOT allow using this coupon to users who have a plan in this group as their currently present payment plan');
define( '_COUPON_RESTRICTIONS_CURRENTGROUP_REQ_EXCLUDED_NAME', 'Group:');
define( '_COUPON_RESTRICTIONS_CURRENTGROUP_REQ_EXCLUDED_DESC', 'A user will not be able to use the coupon if he or she is currently assigned to, or has just expired from a plan in this group');
define( '_COUPON_RESTRICTIONS_OVERALLGROUP_REQ_ENABLED_EXCLUDED_NAME', 'Excluded Used Group:');
define( '_COUPON_RESTRICTIONS_OVERALLGROUP_REQ_ENABLED_EXCLUDED_DESC', 'Do NOT allow using this coupon to users who have used the a plan in this group before');
define( '_COUPON_RESTRICTIONS_OVERALLGROUP_REQ_EXCLUDED_NAME', 'Group:');
define( '_COUPON_RESTRICTIONS_OVERALLGROUP_REQ_EXCLUDED_DESC', 'A user will not be able to use the coupon if he or she has used a plan in this group once, no matter when');

define( '_COUPON_RESTRICTIONS_USED_GROUP_MIN_ENABLED_NAME', 'Min Used Group:');
define( '_COUPON_RESTRICTIONS_USED_GROUP_MIN_ENABLED_DESC', 'Enable checking for the minimum number of times your consumers have subscribed to a payment plan in this group in order to be able to use the coupon');
define( '_COUPON_RESTRICTIONS_USED_GROUP_MIN_AMOUNT_NAME', 'Used Amount:');
define( '_COUPON_RESTRICTIONS_USED_GROUP_MIN_AMOUNT_DESC', 'The minimum amount a user has to have used the a plan in this group');
define( '_COUPON_RESTRICTIONS_USED_GROUP_MIN_NAME', 'Group:');
define( '_COUPON_RESTRICTIONS_USED_GROUP_MIN_DESC', 'The group that the user has to have used a plan from - the specified number of times at least');
define( '_COUPON_RESTRICTIONS_USED_GROUP_MAX_ENABLED_NAME', 'Max Used Group:');
define( '_COUPON_RESTRICTIONS_USED_GROUP_MAX_ENABLED_DESC', 'Enable checking for the maximum number of times your users have subscribed to a payment plan in this group in order to be able to use the coupon');
define( '_COUPON_RESTRICTIONS_USED_GROUP_MAX_AMOUNT_NAME', 'Used Amount:');
define( '_COUPON_RESTRICTIONS_USED_GROUP_MAX_AMOUNT_DESC', 'The maximum amount a user can have used a plan in this group');
define( '_COUPON_RESTRICTIONS_USED_GROUP_MAX_NAME', 'Group:');
define( '_COUPON_RESTRICTIONS_USED_GROUP_MAX_DESC', 'The group that the user has to have used a plan from - the specified number of times at most');

define( '_COUPON_RESTRICTIONS_RESTRICT_COMBINATION_NAME', 'Restringir Combina&ccedil;&atilde;o:');
define( '_COUPON_RESTRICTIONS_RESTRICT_COMBINATION_DESC', 'Escolha para n&atilde;o permitir o utilizador combinar este cup&atilde;o com o seguinte');
define( '_COUPON_RESTRICTIONS_BAD_COMBINATIONS_NAME', 'Cup&otilde;es:');
define( '_COUPON_RESTRICTIONS_BAD_COMBINATIONS_DESC', 'Fa&ccedil;a uma selec&ccedil;&atilde;o dos cup&otilde;es com os quais este n&atilde;o pode ser utilizado');
define( '_COUPON_RESTRICTIONS_DEPEND_ON_SUBSCR_ID_NAME', 'Dependem da Subscri&ccedil;&atilde;o:');
define( '_COUPON_RESTRICTIONS_DEPEND_ON_SUBSCR_ID_DESC', 'Fa&ccedil;a este cup&atilde;o depender de uma certa subscri&ccedil;&atilde;o para ser funcional.');
define( '_COUPON_RESTRICTIONS_SUBSCR_ID_DEPENDENCY_NAME', 'ID Subscri&ccedil;&atilde;o');
define( '_COUPON_RESTRICTIONS_SUBSCR_ID_DEPENDENCY_DESC', 'A ID da subscri&ccedil;&atilde;o da qualo cup&atilde;o depende.');
define( '_COUPON_RESTRICTIONS_ALLOW_TRIAL_DEPEND_SUBSCR_NAME', 'Permitir Subscri&ccedil;&otilde;es de Demonstra&ccedil;&atilde;o:');
define( '_COUPON_RESTRICTIONS_ALLOW_TRIAL_DEPEND_SUBSCR_DESC', 'Permitiro uso do cup&atilde;o quando o utilizador depende de uma subscri&ccedil;&atilde;o que ainda se encontra em demonstra&ccedil;&atilde;o.');
define( '_COUPON_RESTRICTIONS_RESTRICT_COMBINATION_CART_NAME', 'Restrict Combination Cart:');
define( '_COUPON_RESTRICTIONS_RESTRICT_COMBINATION_CART_DESC', 'Choose to not let your users combine this coupon with one of the following when applied to a cart');
define( '_COUPON_RESTRICTIONS_BAD_COMBINATIONS_CART_NAME', 'Coupons:');
define( '_COUPON_RESTRICTIONS_BAD_COMBINATIONS_CART_DESC', 'Make a selection which coupons this one is not to be used with');
define( '_COUPON_RESTRICTIONS_ALLOW_COMBINATION_NAME', 'Allow Combination:');
define( '_COUPON_RESTRICTIONS_ALLOW_COMBINATION_DESC', 'Choose to let your users combine this coupon with only with the following. Select none to disallow any combination.');
define( '_COUPON_RESTRICTIONS_GOOD_COMBINATIONS_NAME', 'Coupons:');
define( '_COUPON_RESTRICTIONS_GOOD_COMBINATIONS_DESC', 'Make a selection which coupons this one can to be used with');
define( '_COUPON_RESTRICTIONS_ALLOW_COMBINATION_CART_NAME', 'Allow Combination Cart:');
define( '_COUPON_RESTRICTIONS_ALLOW_COMBINATION_CART_DESC', 'Choose to let your users combine this coupon with only with the following in a cart. Select none to disallow any combination.');
define( '_COUPON_RESTRICTIONS_GOOD_COMBINATIONS_CART_NAME', 'Coupons:');
define( '_COUPON_RESTRICTIONS_GOOD_COMBINATIONS_CART_DESC', 'Make a selection which coupons this one can to be used with in a cart');

// end new 0.12.4 (mic)

// --== BACKEND TOOLBAR ==--
define( '_EXPIRE_SET','Definir Expira&ccedil;&atilde;o:');
define( '_EXPIRE_NOW','Expira');
define( '_EXPIRE_EXCLUDE','Excluir');
define( '_EXPIRE_INCLUDE','Incluir');
define( '_EXPIRE_CLOSE','Fechar');
define( '_EXPIRE_HOLD','Espera');
define( '_EXPIRE_01MONTH','definir1 M&ecirc;s');
define( '_EXPIRE_03MONTH','definir 3 Meses');
define( '_EXPIRE_12MONTH','definir 12 Meses');
define( '_EXPIRE_ADD01MONTH','adicionar 1 M&ecirc;s');
define( '_EXPIRE_ADD03MONTH','adicionar 3 Meses');
define( '_EXPIRE_ADD12MONTH','adicionar 12 Meses');
define( '_CONFIGURE','Configurar');
define( '_REMOVE','Mover para Excluidos');
define( '_CNAME','Nome');
define( '_USERLOGIN','Login de utilizador');
define( '_EXPIRATION','Expira&ccedil;&atilde;o');
define( '_USERS','Utilizadores');
define( '_DISPLAY','Mostrar');
define( '_NOTSET','Exclu&iacute;do');
define( '_SAVE','Guardar');
define( '_CANCEL','Cancelar');
define( '_EXP_ASC','Expira&ccedil;&atilde;o Asc');
define( '_EXP_DESC','Expirac&atilde;o Desc');
define( '_NAME_ASC','Nome Asc');
define( '_NAME_DESC','Nome Desc');
define( '_LASTNAME_ASC','Last Name Asc');
define( '_LASTNAME_DESC','Last Name Desc');
define( '_LOGIN_ASC','Login Asc');
define( '_LOGIN_DESC','Login Desc');
define( '_SIGNUP_ASC','Data de Inscri&ccedil;&atilde;o Asc');
define( '_SIGNUP_DESC','Data de inscri&ccedil;&atilde;o Desc');
define( '_LASTPAY_ASC','&Uacute;ltimo Pagamento Asc');
define( '_LASTPAY_DESC','&Uacute;ltimo Pagamento Desc');
define( '_PLAN_ASC','Plano Asc');
define( '_PLAN_DESC','Plano Desc');
define( '_STATUS_ASC','Estado Asc');
define( '_STATUS_DESC','Estado Desc');
define( '_TYPE_ASC','Tipo de Pagamento Asc');
define( '_TYPE_DESC','Tipo de Pagamento Desc');
define( '_ORDERING_ASC','Ordering Asc');
define( '_ORDERING_DESC','Ordering Desc');
define( '_ID_ASC','ID Asc');
define( '_ID_DESC','ID Desc');
define( '_CLASSNAME_ASC','Function Name Asc');
define( '_CLASSNAME_DESC','Function Desc');
define( '_ORDER_BY','Ordenar por:');
define( '_SAVED', 'Guradado.');
define( '_CANCELED', 'Cancelado.');
define( '_CONFIGURED', 'Item configurado.');
define( '_REMOVED', 'Item removido da lista.');
define( '_EOT_TITLE', 'Assinaturas Encerradas');
define( '_EOT_DESC', 'Esta lista nao inclu&iacute; inscri&ccedil;&otilde;es configuradas manualmente, apenas as processadas pelo PayPal. Ao remover uma entrada, o utilizadorremovido da base de dados, assim como todas as suas entradas na tabela local de hist&oacute;rico de actividades do PayPal.');
define( '_EOT_DATE', 'Encerramento da Inscri&ccedil;&atilde;o');
define( '_EOT_CAUSE', 'Causa');
define( '_EOT_CAUSE_FAIL', 'Falha no Pagamento');
define( '_EOT_CAUSE_BUYER', 'Cancelado pelo utilizador');
define( '_EOT_CAUSE_FORCED', 'Cancelado pelo administrador');
define( '_REMOVE_CLOSED', 'Remover Utilizador');
define( '_FORCE_CLOSE', 'Encerrar Inscri&ccedil;&atilde;o');
define( '_PUBLISH_PAYPLAN', 'Publicar');
define( '_UNPUBLISH_PAYPLAN', 'N&atilde;o Publicar');
define( '_NEW_PAYPLAN', 'Novo');
define( '_COPY_PAYPLAN', 'Copiar');
define( '_APPLY_PAYPLAN', 'Aplicar');
define( '_EDIT_PAYPLAN', 'Editar');
define( '_REMOVE_PAYPLAN', 'Remover');
define( '_SAVE_PAYPLAN', 'Guardar');
define( '_CANCEL_PAYPLAN', 'Cancelar');
define( '_PAYPLANS_TITLE', 'Gestor de Planos de Pagamento');
define( '_PAYPLANS_MAINDESC', 'Os planos publicados aparecem como op&ccedil;&otilde;es para o utilizador. Estes planos s&atilde;o v&aacute;lidos apenas para pagamento via PayPal.');
define( '_PAYPLAN_GROUP', 'Group');
define( '_PAYPLAN_NOGROUP', 'No Group');
define( '_PAYPLAN_NAME', 'Nome');
define( '_PAYPLAN_DESC', 'Descric&atilde;o (primeiros 50 caracteres)');
define( '_PAYPLAN_ACTIVE', 'Publicado');
define( '_PAYPLAN_VISIBLE', 'Vis&iacute;vel');
define( '_PAYPLAN_A3', 'Valor');
define( '_PAYPLAN_P3', 'Per&iacute;odo');
define( '_PAYPLAN_T3', 'Unidade');
define( '_PAYPLAN_USERCOUNT', 'Subscritores');
define( '_PAYPLAN_EXPIREDCOUNT', 'Expirou');
define( '_PAYPLAN_TOTALCOUNT', 'Total');
define( '_PAYPLAN_REORDER', 'Reordenar');
define( '_PAYPLAN_DETAIL', 'Defini&ccedil;&otilde;es');
define( '_ALTERNATIVE_PAYMENT', 'Transfer&ecirc;ncia Banc&aacute;ria');
define( '_SUBSCR_DATE', 'Data de Inscri&ccedil;&atilde;o');
define( '_ACTIVE_TITLE', 'Inscri&ccedil;&otilde;es Activas');
define( '_ACTIVE_DESC','Esta lista n&atilde;o inclu&iacute; inscri&ccedil;&otilde;es configuradas manualmente, apenas as processadas pelo PayPal.');
define( '_LASTPAY_DATE', 'Data &Uacute;ltimo Pagamento');
define( '_USERPLAN', 'Plano');
define( '_CANCELLED_TITLE', 'Inscri&ccedil;&otilde;es Canceladas');
define( '_CANCELLED_DESC', 'Esta lista n&atilde;o inclu&iacute; inscri&ccedil;&otilde;es confirmadas manualmente, apenas as processadas pelo PayPal. S&oacute; as assinaturas canceladas pelo utilizador mas que ainda n&atilde;o expiraram.');
define( '_CANCEL_DATE', 'Data de Cancelamento');
define( '_MANUAL_DESC', 'Ao remover uma entrada, o utilizador&eacute; removido totalmente da base de dados.');
define( '_REPEND_ACTIVE', 'Re-Activa&ccedil;&atilde;o Pendente');
define( '_FILTER_PLAN', '- Selecione Plano -');
define( '_BIND_USER', 'Associar a:');
define( '_PLAN_FILTER','Filtrar Plano:');
define( '_CENTRAL_PAGE','Central');

// --== USER FORM ==--
define( '_HISTORY_COL_INVOICE', 'Facturas');
define( '_HISTORY_COL_AMOUNT', 'Valor');
define( '_HISTORY_COL_DATE', 'Data de Pagamento');
define( '_HISTORY_COL_METHOD', 'Metodo');
define( '_HISTORY_COL_ACTION', 'Ac&ccedil;&atilde;o');
define( '_HISTORY_COL_PLAN', 'Plano');
define( '_USERINVOICE_ACTION_REPEAT','repetir Link');
define( '_USERINVOICE_ACTION_CANCEL','cancelar');
define( '_USERINVOICE_ACTION_CLEAR','marcar apuradas');
define( '_USERINVOICE_ACTION_CLEAR_APPLY','limpar&nbsp;&amp;&nbsp;aplicar&nbsp;Plano');

// --== BACKEND SETTINGS ==--

// TAB 1 - Global AEC Settings
define( '_CFG_TAB1_TITLE', 'Configurac&atilde;o');
define( '_CFG_TAB1_SUBTITLE', 'Intera&ccedil;&atilde;o com Utilizador');

define( '_CFG_GENERAL_SUB_ACCESS', 'Access');
define( '_CFG_GENERAL_SUB_SYSTEM', 'System');
define( '_CFG_GENERAL_SUB_EMAIL', 'Email');
define( '_CFG_GENERAL_SUB_DEBUG', 'Debug');
define( '_CFG_GENERAL_SUB_REGFLOW', 'Registration Flow');
define( '_CFG_GENERAL_SUB_PLANS', 'Subscription Plans');
define( '_CFG_GENERAL_SUB_CONFIRMATION', 'Confirmation Page');
define( '_CFG_GENERAL_SUB_CHECKOUT', 'Checkout Page');
define( '_CFG_GENERAL_SUB_PROCESSORS', 'Payment Processors');
define( '_CFG_GENERAL_SUB_SECURITY', 'Security');

define( '_CFG_GENERAL_ALERTLEVEL2_NAME', 'N&iacute;vel de Alerta 2:');
define( '_CFG_GENERAL_ALERTLEVEL2_DESC', 'Em dias. Esta &eacute; a primeira forma para come&ccedil;ar a advert&ecirc;ncia ao utilizador que a sua inscri&ccedil;&atilde;o esta prestes a expirar.');
define( '_CFG_GENERAL_ALERTLEVEL1_NAME', 'N&iacute;vel da Alerta 1:');
define( '_CFG_GENERAL_ALERTLEVEL1_DESC', 'Em Diaz. Esta &eacute; a forma final de advert&ecirc;ncia do utilizdor que a sua inscri&ccedil;&atilde;o esta preste a expirar. Deve ser perto do per&iacute;do de expira&ccedil;&atilde;o.');
define( '_CFG_GENERAL_ENTRY_PLAN_NAME', 'Plano de Entrada:');
define( '_CFG_GENERAL_ENTRY_PLAN_DESC', 'Cada utilizador ser&aacute; inscrito neste plano(sem pagamento) quando o utilizador ainda n&atilde;o tiver nenhuma subscri&ccedil;&atilde;o');
define( '_CFG_GENERAL_REQUIRE_SUBSCRIPTION_NAME', 'Necess&aacute;rio Inscri&ccedil;&atilde;o:');
define( '_CFG_GENERAL_REQUIRE_SUBSCRIPTION_DESC', 'Quando activada, o utilizador DEVE ter uma subscri&ccedil;&atilde;o. Se estiver desactivada, os utilizadores poder&atilde;o realizar o login sem nenhuma.');

define( '_CFG_GENERAL_GWLIST_NAME', 'Descri&ccedil;&atilde;o Gateway:');
define( '_CFG_GENERAL_GWLIST_DESC', 'Listar os Gateways que pretende explicar na pagina N&atilde;o Permitido (os quais os seus clientes visualizaram quando tentarem aceder a pagina a qual eles n&atilde;o possuem permiss&atilde;o devido ao plano de pagamento escolhido).');
define( '_CFG_GENERAL_GWLIST_ENABLED_NAME', 'Gateways Activados:');
define( '_CFG_GENERAL_GWLIST_ENABLED_DESC', 'Selecione os gateways que voc&ecirc; pretende que estejam activos (usar a tecla CTRL para m&uacute;ltiplas selec&ccedil;&otilde;es). Ap&oacute;s guardar, a aba Defini&ccedil;&otilde;es para essesgateways ficar&aacute; dispon&iacute;vel. Desactivando um gateway n&atilde;o apagar&aacute; as suas defini&ccedil;&otilde;es.');

define( '_CFG_GENERAL_BYPASSINTEGRATION_NAME', 'Desactivar Integra&ccedil;&otilde;es:');
define( '_CFG_GENERAL_BYPASSINTEGRATION_DESC', 'fornecer um nome ou uma lista de nomes ( separados por espa&ccedil;o) de integra&ccedil;&otilde;es que pretende desactivar. Actualmente suporta as strings: <strong>CB,CBE,CBM,JACL,SMF,UE,UHP2,VM</strong>. Isto poder&aacute; ser uma ajuda preciosa quando tiver desinstalado o CB mas n&atilde;o eliminado as suas tabelas ( nesse caso o AEC iria continuar a reconhecer como foram instaladas no in&iacute;cio).');
define( '_CFG_GENERAL_SIMPLEURLS_NAME', 'URLs Simples:');
define( '_CFG_GENERAL_SIMPLEURLS_DESC', 'Desactivar o uso das Rotinas SEF do Joomla/Mambo para os Urls. Com alguns ajustes usando estas rotinas resultar&aacute; em Erros 404 causados por reescrita errada. Experimente esta op&ccedil;&atilde;o se encontrar algum problema com redirecionamentos.');
define( '_CFG_GENERAL_EXPIRATION_CUSHION_NAME', 'Teste de Expira&ccedil;&atilde;o:');
define( '_CFG_GENERAL_EXPIRATION_CUSHION_DESC', 'N&uacute;mero de horas que o AEC leva a testar quando determina a expira&ccedil;&atilde;o. Coloque um valor generoso, uma vez que o pagamento pode levar algumas horas, mais do que o actual tempo de expira&ccedil;&atilde;o (com oPaypal cercat 6-8 horas depois).');
define( '_CFG_GENERAL_HEARTBEAT_CYCLE_NAME', 'Ciclo de Quebra:');
define( '_CFG_GENERAL_HEARTBEAT_CYCLE_DESC', 'N&uacute;mero de horas que o AEC aguarda at&eacute; receber um login e proceder ao envio de emails ou fazer outras ac&ccedil;&otilde;es que voc&ecirc; escolher para serem realizadas periodicamente.');
define( '_CFG_GENERAL_TOS_NAME', 'Termos do Servi&ccedil;o:');
define( '_CFG_GENERAL_TOS_DESC', 'Introduza umaURL para os seusTermos do Servi&ccedil;o. O utilizador ter&aacute; de selecionar uma caixa de confirma&ccedil;&atilde;o quando confirma a sua conta. Se ficar em branco, n&atilde;o ser&aacute; mostrado nada.');
define( '_CFG_GENERAL_ROOT_GROUP_NAME', 'Root Group:');
define( '_CFG_GENERAL_ROOT_GROUP_DESC', 'Choose the Root Group that the user is displayed when accessing the plans page without any preset variable.');
define( '_CFG_GENERAL_ROOT_GROUP_RW_NAME', 'Root Group ReWrite:');
define( '_CFG_GENERAL_ROOT_GROUP_RW_DESC', 'Choose the Root Group that the user is displayed when accessing the plans page by returning a group number or an array of groups with the ReWriteEngine functionality. This will fall back to the general option (above) if the results are empty.');
define( '_CFG_GENERAL_PLANS_FIRST_NAME', 'Primeiro Plano:');
define( '_CFG_GENERAL_PLANS_FIRST_DESC', 'Se realizou todas as 3 altera&ccedil;&otilde;es para ter um Registo integrado com uma inscri&ccedil;&atilde;o directa, esta op&ccedil;&atilde;o ira activar a seguinte ac&ccedil;&atilde;o. n&atilde;o utilizar se n&atilde;o pretenderesta opera&ccedil;&atilde;o ou se apenas realizou a primeira altera&ccedil;&atilde;o ( o que significa que a escolha do plano aparece ap&oacute;s o utilizador colocar os seus detalhes) .');
define( '_CFG_GENERAL_INTEGRATE_REGISTRATION_NAME', 'Integrate Registration');
define( '_CFG_GENERAL_INTEGRATE_REGISTRATION_DESC', 'With this switch, you can make the AEC Mambot/Plugin intercept registration calls and redirect them into the AEC subscription system. Having this option disabled means that the users would freely register and, if a subscription is required, subscribe on their first login. If both this option and "require subscription" are disabled, subscription is completely voluntary.');

define( '_CFG_TAB_CUSTOMIZATION_TITLE', 'Personalizar');
define( '_CFG_TAB_CUSTOMIZATION_SUBTITLE', 'Personaliza&ccedil;&atilde;o');

define( '_CFG_CUSTOMIZATION_SUB_CREDIRECT', 'Custom Redirects');
define( '_CFG_CUSTOMIZATION_SUB_PROXY', 'Proxy');
define( '_CFG_CUSTOMIZATION_SUB_BUTTONS_SUB', 'Subscribed Member Buttons');
define( '_CFG_CUSTOMIZATION_SUB_FORMAT_DATE', 'Date Formatting');
define( '_CFG_CUSTOMIZATION_SUB_FORMAT_PRICE', 'Price Formatting');
define( '_CFG_CUSTOMIZATION_SUB_FORMAT_INUM', 'Invoice Number Format');
define( '_CFG_CUSTOMIZATION_SUB_CAPTCHA', 'ReCAPTACHA');

define( '_CFG_GENERAL_CUSTOMINTRO_NAME', 'Link para a pagina de introdu&ccedil;&atilde;o personalida:');
define( '_CFG_GENERAL_CUSTOMINTRO_DESC', 'Forne&ccedil;a um link completo (inclu&iacute;ndo http://) que conduza &agrave; sua p&aacute;gina de introdu&ccedil;&atilde;o Padr&atilde;o. Est&aacute; pagina deve conter um link como por exemplo:: http://www.oseudominio.com/index.php?option=com_acctexp&amp;task=subscribe&amp;intro=1 o que ignora a intordu&ccedil;&atilde;o e encaminha correctamente o utilizador para a pagina de planos de pagamento ou detalhes do registo. Deixe o campo em branco se n&atilde;o pretender isto.');
define( '_CFG_GENERAL_CUSTOMINTRO_USERID_NAME', 'Pass Userid');
define( '_CFG_GENERAL_CUSTOMINTRO_USERID_DESC', 'Pass Userid via a Joomla notification. This can be helpful for flexible custom signup pages that need to function even if the user is not logged in. You can use Javascript to modify your signup links according to the passed userid.');
define( '_CFG_GENERAL_CUSTOMINTRO_ALWAYS_NAME', 'Always Show Intro');
define( '_CFG_GENERAL_CUSTOMINTRO_ALWAYS_DESC', 'Display the Intro regardless of whether the user is already registered.');
define( '_CFG_GENERAL_CUSTOMTHANKS_NAME', 'Link pagina de agradecimento Padr&atilde;o:');
define( '_CFG_GENERAL_CUSTOMTHANKS_DESC', 'Forne&ccedil;a um link completo (inclu&iacute;ndo http://) este encaminha para a sua pagina de agradecimento Padr&atilde;o. Deixe o campo em branco se n&atilde;o pretender isso.');
define( '_CFG_GENERAL_CUSTOMCANCEL_NAME', 'Link pagina Cancelamento Padr&atilde;o:');
define( '_CFG_GENERAL_CUSTOMCANCEL_DESC', 'Forne&ccedil;a um link completo (inclu&iacute;ndo http://) este encaminha para a sua pagina de cancelamento Padr&atilde;o. Deixe o campo em branco se n&atilde;o pretender isso.');
define( '_CFG_GENERAL_TOS_NAME', 'Termos do Servi&ccedil;o:');
define( '_CFG_GENERAL_TOS_DESC', 'Introduza a a URL para o seus Termos so Servi&ccedil;o. os utilizadores ter&atilde;o de seleciona uma caixa de confirma&ccedil;&atilde;o quando confirma&ccedil;&atilde;o a sua conta. Se ficar em branco, n&atilde;o acontecera nada.');
define( '_CFG_GENERAL_TOS_IFRAME_NAME', 'ToS Iframe:');
define( '_CFG_GENERAL_TOS_IFRAME_DESC', 'Mostra os Termos do Servi&ccedil;o (tal como espec&iacute;ficado acima) numa iframe na confirma&ccedil;&atilde;o');
define( '_CFG_GENERAL_CUSTOMNOTALLOWED_NAME', 'Link N&atilde;o Permitido personalizado:');
define( '_CFG_GENERAL_CUSTOMNOTALLOWED_DESC', 'Forne&ccedil;a um link completo (inclu&iacute;ndo http://) este encaminha para a sua pagina de N&atilde;o Permitido Padr&atilde;o. Deixe o campo em branco se n&atilde;o pretender isso.');

define( '_CFG_CUSTOMIZATION_INVOICE_PRINTOUT', 'Invoice Printout');
define( '_CFG_CUSTOMIZATION_INVOICE_PRINTOUT_DETAILS', 'Invoice Printout Details');

define( '_CFG_TAB_CUSTOMINVOICE_TITLE', 'Invoice Customization');
define( '_CFG_TAB_CUSTOMINVOICE_SUBTITLE', 'Invoice Customization');
define( '_CFG_TAB_CUSTOMPAGES_TITLE', 'Page Customization');
define( '_CFG_TAB_CUSTOMPAGES_SUBTITLE', 'Page Customization');
define( '_CFG_TAB_EXPERT_TITLE', 'Expert');
define( '_CFG_TAB_EXPERT_SUBTITLE', 'Expert Settings');

define( '_AEC_CUSTOM_INVOICE_PAGE_TITLE', 'Invoice');
define( '_AEC_CUSTOM_INVOICE_HEADER', 'Invoice');
define( '_AEC_CUSTOM_INVOICE_BEFORE_CONTENT', 'Invoice/Receipt for:');
define( '_AEC_CUSTOM_INVOICE_AFTER_CONTENT', 'Thank you very much for choosing our service!');
define( '_AEC_CUSTOM_INVOICE_FOOTER', ' - Add your company information here - ');

define( '_CFG_GENERAL_INVOICE_PAGE_TITLE', 'Invoice');
define( '_CFG_GENERAL_INVOICE_PAGE_TITLE_NAME', 'Page Title');
define( '_CFG_GENERAL_INVOICE_PAGE_TITLE_DESC', 'Page Title for the Invoice Printout');
define( '_CFG_GENERAL_INVOICE_HEADER_NAME', 'Invoice Header');
define( '_CFG_GENERAL_INVOICE_HEADER_DESC', 'Header Text for the Invoice Printout');
define( '_CFG_GENERAL_INVOICE_AFTER_HEADER_NAME', 'Invoice After Header');
define( '_CFG_GENERAL_INVOICE_AFTER_HEADER_DESC', 'Text after Header for the Invoice Printout');
define( '_CFG_GENERAL_INVOICE_ADDRESS_NAME', 'Invoice Address Field');
define( '_CFG_GENERAL_INVOICE_ADDRESS_DESC', 'Text in the Address Field of the Invoice Printout');
define( '_CFG_GENERAL_INVOICE_ADDRESS_ALLOW_EDIT_NAME', 'Allow User Editing');
define( '_CFG_GENERAL_INVOICE_ADDRESS_ALLOW_EDIT_DESC', 'This gives your users the opportunity to edit the address field right on the printout.');
define( '_CFG_GENERAL_INVOICE_BEFORE_CONTENT_NAME', 'Invoice Before Content');
define( '_CFG_GENERAL_INVOICE_BEFORE_CONTENT_DESC', 'Text before Invoice Content for the Invoice Printout');
define( '_CFG_GENERAL_INVOICE_AFTER_CONTENT_NAME', 'Invoice After Content');
define( '_CFG_GENERAL_INVOICE_AFTER_CONTENT_DESC', 'Text after Invoice Content for the Invoice Printout');
define( '_CFG_GENERAL_INVOICE_BEFORE_FOOTER_NAME', 'Invoice Before Footer');
define( '_CFG_GENERAL_INVOICE_BEFORE_FOOTER_DESC', 'Text before Footer for the Invoice Printout');
define( '_CFG_GENERAL_INVOICE_FOOTER_NAME', 'Invoice Footer');
define( '_CFG_GENERAL_INVOICE_FOOTER_DESC', 'Footer Text for the Invoice Printout');
define( '_CFG_GENERAL_INVOICE_AFTER_FOOTER_NAME', 'Invoice After Footer');
define( '_CFG_GENERAL_INVOICE_AFTER_FOOTER_DESC', 'Text after Footer for the Invoice Printout');

define( '_CFG_GENERAL_CHECKOUT_DISPLAY_DESCRIPTIONS_NAME', 'Display Descriptions:');
define( '_CFG_GENERAL_CHECKOUT_DISPLAY_DESCRIPTIONS_DESC', 'If you have multiple plans on checkout, or skipped the confirmation, it might be helpful to show the plan description again. This switch does just that.');
define( '_CFG_GENERAL_CHECKOUT_AS_GIFT_NAME', 'Allow Gift Checkout:');
define( '_CFG_GENERAL_CHECKOUT_AS_GIFT_DESC', 'With this option, users can gift a checkout to another user - all the plans and attached functionality is then carried out on the recipients user account.');
define( '_CFG_GENERAL_CHECKOUT_AS_GIFT_ACCESS_NAME', 'Gifts Access:');
define( '_CFG_GENERAL_CHECKOUT_AS_GIFT_ACCESS_DESC', 'What user group is required (minimum) to can make a checkout into a gift?');
define( '_CFG_GENERAL_CONFIRM_AS_GIFT_NAME', 'Allow Gift on Confirmation:');
define( '_CFG_GENERAL_CONFIRM_AS_GIFT_DESC', 'Offer the same gift option on the confirmation page as well.');

define( '_CFG_GENERAL_DISPLAY_DATE_FRONTEND_NAME', 'Frontend Date Format');
define( '_CFG_GENERAL_DISPLAY_DATE_FRONTEND_DESC', 'Especificar a forma que a data &eacute; mostrada na pagina principal. Veja o <a href="http://www.php.net/manual/en/function.strftime.php">Manual de PHP</a> para uma sintax correcta.');
define( '_CFG_GENERAL_DISPLAY_DATE_BACKEND_NAME', 'Formato da Data no no Backend');
define( '_CFG_GENERAL_DISPLAY_DATE_BACKEND_DESC', 'Especificar a forma que a data &eacute; mostrada no Backend. Veja o <a href="http://www.php.net/manual/en/function.strftime.php">Manual de PHP</a> para uma sintax correcta.');

define( '_CFG_GENERAL_INVOICENUM_DOFORMAT_NAME', 'Formato do N&uacute;mero de Factura');
define( '_CFG_GENERAL_INVOICENUM_DOFORMAT_DESC', 'Mostra uma string formatada, em vez do n&uacute;mero de factura original. Deve fornecer um regra de formata&ccedil;&atilde;o abaixo.');
define( '_CFG_GENERAL_INVOICENUM_FORMATTING_NAME', 'Forma&ccedil;&atilde;o');
define( '_CFG_GENERAL_INVOICENUM_FORMATTING_DESC', 'Formato - pode usar RewriteEngine como espec&iacute;ficado abaixo');

define( '_CFG_GENERAL_CUSTOMTEXT_PLANS_NAME', 'Texto Pagina dos Planos Padr&atilde;o');
define( '_CFG_GENERAL_CUSTOMTEXT_PLANS_DESC', 'Texto que ser&aacute; mostrado na Pagina de Plalnos');
define( '_CFG_GENERAL_CUSTOMTEXT_CONFIRM_NAME', 'Texto Pagina de Confirma&ccedil;&atilde;o Padr&atilde;o');
define( '_CFG_GENERAL_CUSTOMTEXT_CONFIRM_DESC', 'Texto que ser&aacute; mostrado na pagina de Confirma&ccedil;&atilde;o');
define( '_CFG_GENERAL_CUSTOM_CONFIRM_USERDETAILS_NAME', 'Custom Text Confirm Userdetails');
define( '_CFG_GENERAL_CUSTOM_CONFIRM_USERDETAILS_DESC', 'Customize what the Userdetails field will show on Confirmation');
define( '_CFG_GENERAL_CUSTOMTEXT_CHECKOUT_NAME', 'Texto Pagina de Finaliza&ccedil;&atilde;o padr&atilde;o Finaliza&ccedil;&atilde;o');
define( '_CFG_GENERAL_CUSTOMTEXT_CHECKOUT_DESC', 'Texto que ser&aacute; mostrado na pagina de Conclus&atilde;o');
define( '_CFG_GENERAL_CUSTOMTEXT_NOTALLOWED_NAME', 'Texto Pagina N&atilde;o Permitido Padr&atilde;o');
define( '_CFG_GENERAL_CUSTOMTEXT_NOTALLOWED_DESC', 'Texto que ser&aacute; mostado na pagina N&atilde;o Permitido');
define( '_CFG_GENERAL_CUSTOMTEXT_PENDING_NAME', 'Texto Pagina Pendente Padr&atilde;o');
define( '_CFG_GENERAL_CUSTOMTEXT_PENDING_DESC', 'Texto que ser&aacute; mostrado na pagina Pendente');
define( '_CFG_GENERAL_CUSTOMTEXT_EXPIRED_NAME', 'Texto Pagina Expira&ccedil;&atilde;o Pad&atilde;o');
define( '_CFG_GENERAL_CUSTOMTEXT_EXPIRED_DESC', 'Texto que ser&aacute; mostrado na pagina de Expira&ccedil;&atilde;o');

define( '_CFG_GENERAL_CUSTOMTEXT_CONFIRM_KEEPORIGINAL_NAME', 'Manter Texto Original');
define( '_CFG_GENERAL_CUSTOMTEXT_CONFIRM_KEEPORIGINAL_DESC', 'Selecione esta op&ccedil;&atilde;o se pretende manter o texto original na pagina de Confirma&ccedil;&atilde;o');
define( '_CFG_GENERAL_CUSTOMTEXT_CHECKOUT_KEEPORIGINAL_NAME', 'Manter Texto Original');
define( '_CFG_GENERAL_CUSTOMTEXT_CHECKOUT_KEEPORIGINAL_DESC', 'Selecione esta op&ccedil;&atilde;o se pretende manter o texto original na pagina de Conclus&atilde;o ');
define( '_CFG_GENERAL_CUSTOMTEXT_NOTALLOWED_KEEPORIGINAL_NAME', 'Manter Texto Original');
define( '_CFG_GENERAL_CUSTOMTEXT_NOTALLOWED_KEEPORIGINAL_DESC', 'Selecione esta op&ccedil;&atilde;o se pretende manter o texto original na pagina de N&atilde;o Permitido');
define( '_CFG_GENERAL_CUSTOMTEXT_PENDING_KEEPORIGINAL_NAME', 'Manter Texto Original');
define( '_CFG_GENERAL_CUSTOMTEXT_PENDING_KEEPORIGINAL_DESC', 'Selecione esta op&ccedil;&atilde;o se pretende manter o texto original na pagina de Pendente ');
define( '_CFG_GENERAL_CUSTOMTEXT_EXPIRED_KEEPORIGINAL_NAME', 'Manter Texto Original');
define( '_CFG_GENERAL_CUSTOMTEXT_EXPIRED_KEEPORIGINAL_DESC', 'Selecione esta op&ccedil;&atilde;o se pretende manter o texto original na pagina de Expira&ccedil;&atilde;o');

define( '_CFG_GENERAL_CUSTOMTEXT_THANKS_KEEPORIGINAL_NAME', 'Manter Texto Original');
define( '_CFG_GENERAL_CUSTOMTEXT_THANKS_KEEPORIGINAL_DESC', 'Selecione esta op&ccedil;&atilde;o se pretende manter o texto original na pagina de Agradecimento ');
define( '_CFG_GENERAL_CUSTOMTEXT_THANKS_NAME', 'Texto Pagina de Agradecimento Padr&atilde;o');
define( '_CFG_GENERAL_CUSTOMTEXT_THANKS_DESC', 'Texto que ser&aacute; mostrado na pagina de Agradecimento');
define( '_CFG_GENERAL_CUSTOMTEXT_CANCEL_KEEPORIGINAL_NAME', 'Manter Texto Original');
define( '_CFG_GENERAL_CUSTOMTEXT_CANCEL_KEEPORIGINAL_DESC', 'Selecione esta op&ccedil;&atilde;o se pretende manter o texto original na pagina de Cancelamento');
define( '_CFG_GENERAL_CUSTOMTEXT_CANCEL_NAME', 'Texto Pagina de Cancelamento Padr&atilde;o');
define( '_CFG_GENERAL_CUSTOMTEXT_CANCEL_DESC', 'Texto que ser&aacute; mostrado na pagina de Cancelamento ');

define( '_CFG_GENERAL_CUSTOMTEXT_HOLD_KEEPORIGINAL_NAME', 'Manter Texto Original');
define( '_CFG_GENERAL_CUSTOMTEXT_HOLD_KEEPORIGINAL_DESC', 'Selecione esta op&ccedil;&atilde;o se pretende manter o texto original na pagina de Espera ');
define( '_CFG_GENERAL_CUSTOMTEXT_HOLD_NAME', 'Texto Pagina Em Espera Padr&atilde;o');
define( '_CFG_GENERAL_CUSTOMTEXT_HOLD_DESC', 'Texto que ser&aacute; mostrado na pagina de espera');

define( '_CFG_GENERAL_CUSTOMTEXT_EXCEPTION_KEEPORIGINAL_NAME', 'Keep Original Text');
define( '_CFG_GENERAL_CUSTOMTEXT_EXCEPTION_KEEPORIGINAL_DESC', 'Select this option if you want to keep the original text on the Exception Page');
define( '_CFG_GENERAL_CUSTOMTEXT_EXCEPTION_NAME', 'Custom Text Exception Page');
define( '_CFG_GENERAL_CUSTOMTEXT_EXCEPTION_DESC', 'Text that will be displayed on the Exception Page (typically showing up when a user has to specify which payment processor to use for a shopping cart, or what item a coupon should be applied to).');

define( '_CFG_GENERAL_USE_RECAPTCHA_NAME', 'Usar ReCAPTCHA');
define( '_CFG_GENERAL_USE_RECAPTCHA_DESC', 'Se possuir uma conta para <a href="http://recaptcha.net/">ReCAPTCHA</a>, pode activar esta op&ccedil;&atilde;o. N&Atilde;O se esque&ccedil;a de colocar as chaves em baixo.');
define( '_CFG_GENERAL_RECAPTCHA_PRIVATEKEY_NAME', 'Chave Privada ReCAPTCHA');
define( '_CFG_GENERAL_RECAPTCHA_PRIVATEKEY_DESC', 'A sua Chave Privada ReCAPTCHA.');
define( '_CFG_GENERAL_RECAPTCHA_PUBLICKEY_NAME', 'Chave P&uacute;blica ReCAPTCHA');
define( '_CFG_GENERAL_RECAPTCHA_PUBLICKEY_DESC', 'A sua Chave P&uacute;blica ReCAPTCHA.');

define( '_CFG_GENERAL_TEMP_AUTH_EXP_NAME', 'Login tempor&aacute;rio de Acesso a Facturas');
define( '_CFG_GENERAL_TEMP_AUTH_EXP_DESC', 'O tempo(em minutos) que um utilizador pode aceder a uma factura apenas indicando o id de utilizador. Quando esse per&iacute;odo termina, uma senha &eacute; solicitada antes de permitir novo acesso pelo mesmo per&iacute;do.');

define( '_CFG_GENERAL_HEARTBEAT_CYCLE_BACKEND_NAME', 'Ciclo de Quebra do Backend:');
define( '_CFG_GENERAL_HEARTBEAT_CYCLE_BACKEND_DESC', 'N&uacute;mero de horas que o AEC espera at&eacute; comprrender um acesso ao backend como quebra do dissipador.');
define( '_CFG_GENERAL_ENABLE_COUPONS_NAME', 'Activar Cup&otilde;es:');
define( '_CFG_GENERAL_ENABLE_COUPONS_DESC', 'Activar o uso de cup&otilde;es para as suas inscri&ccedil;&otilde;es.');
define( '_CFG_GENERAL_DISPLAYCCINFO_NAME', 'Activar a Visualiza&ccedil;&atilde;o de CC:');
define( '_CFG_GENERAL_DISPLAYCCINFO_DESC', 'Activar a visualiza&ccedil;&atilde;o dos icones do Cart&atilde;o de Cr&eacute;dito para cada processo de pagamento.');
define( '_CFG_GENERAL_ADMINACCESS_NAME', 'Acesso Administrador:');
define( '_CFG_GENERAL_ADMINACCESS_DESC', 'Conceder Acesso ao AEC n&atilde;o apenas para Super Administradores, masAdministradores gerai igualmente.');
define( '_CFG_GENERAL_NOEMAILS_NAME', 'SemEmails');
define( '_CFG_GENERAL_NOEMAILS_DESC', 'Definir isso para prevenir o Sistema de Email AEC ( para os utilizadores em eventos de facturas pagas ou similares) de enviar emails para fora do Sistema. Esta op&ccedil;&atilde;o n&atilde;o afecta emails enviados pelo Micro Integra&ccedil;&otilde;es.');
define( '_CFG_GENERAL_NOJOOMLAREGEMAILS_NAME', 'Sem Emails Joomla');
define( '_CFG_GENERAL_NOJOOMLAREGEMAILS_DESC', 'Definir isso para prevenir que emails de Confirma&ccedil;&atilde;o de Registo Joomla sejam enviados para fora do sistema.');
define( '_CFG_GENERAL_DEBUGMODE_NAME', 'Modo de Analide de Erros');
define( '_CFG_GENERAL_DEBUGMODE_DESC', 'Activar a visualiza&ccedil;&atilde;o de informa&ccedil;&atilde;o de analise de erros.');
define( '_CFG_GENERAL_OVERRIDE_REQSSL_NAME', 'Sobrepor Requirimento SSL');
define( '_CFG_GENERAL_OVERRIDE_REQSSL_DESC', 'Alguns processos de pagamentos requerem uma conex&atilde;o segura SSL para o utilizador - por examplo quando informa&ccedil;&atilde;o sens&iacute;vel ( informa&ccedil;&atilde;o de Cart&atilde;o de Cr&eacute;dito) &eacute; solicitada na Pagia Principal');
define( '_CFG_GENERAL_ALTSSLURL_NAME', 'Alternative SSL Url');
define( '_CFG_GENERAL_ALTSSLURL_DESC', 'Use this URL instead of the base url that is configured in Joomla! when routing through SSL.');
define( '_CFG_GENERAL_OVERRIDEJ15_NAME', 'Sobrepor integra&ccedil;&atilde;o Joomla 1.5');
define( '_CFG_GENERAL_OVERRIDEJ15_DESC', 'Alguns adi&ccedil;&otilde;es do Joomla 1.0 levam o sistema a pensar que se tratam realmentede adic&ccedil;&otilde;es do Joomla 1.5(se n&atilde;o sabe o que esta a fazer, n&atilde;o altere nada!) - com o AEC segue e falha. Isto obriga a uma permanente forcing para alterar para o modo 1.0.');
define( '_CFG_GENERAL_SSL_SIGNUP_NAME', 'Inscrever SSL');
define( '_CFG_GENERAL_SSL_SIGNUP_DESC', 'Usar encripta&ccedil;&atilde;o SSL em todos os links relacionados com a inscri&ccedil;&atilde;o do utilizador no AEC.');
define( '_CFG_GENERAL_SSL_PROFILE_NAME', 'Perfil SSL');
define( '_CFG_GENERAL_SSL_PROFILE_DESC', 'Usar encripta&ccedil;&atilde;o SSL em todos os links relacionados com o acesso ao perfil do utilizador (pagina As minhas Inscri&ccedil;&otilde;es).');
define( '_CFG_GENERAL_SSL_VERIFYPEER_NAME', 'SSL Peer Verification');
define( '_CFG_GENERAL_SSL_VERIFYPEER_DESC', 'When using cURL, make it verify the peer\'s certificate. Alternate certificates to verify against can be specified with the options below');
define( '_CFG_GENERAL_SSL_VERIFYHOST_NAME', 'SSL Host Verification');
define( '_CFG_GENERAL_SSL_VERIFYHOST_DESC', 'Defines what kind of verification against the peer\'s certificate you want.');
define( '_CFG_GENERAL_SSL_CAINFO_NAME', 'Certificate File');
define( '_CFG_GENERAL_SSL_CAINFO_DESC', 'The name of a file holding one or more certificates to verify the peer with. This only makes sense when used in combination with Peer Verification.');
define( '_CFG_GENERAL_SSL_CAPATH_NAME', 'Certificate Directory');
define( '_CFG_GENERAL_SSL_CAPATH_DESC', 'A directory that holds multiple CA certificates. Use this option alongside Peer Verification.');
define( '_CFG_GENERAL_USE_PROXY_NAME', 'Usar Proxy');
define( '_CFG_GENERAL_USE_PROXY_DESC', 'Usar um servidor de proxy para todas as sa&iacute;das de pedido.');
define( '_CFG_GENERAL_PROXY_NAME', 'Endere&ccedil;o Proxy');
define( '_CFG_GENERAL_PROXY_DESC', 'Especifique um servidor de proxy ao qual deseja conectar-se');
define( '_CFG_GENERAL_PROXY_PORT_NAME', 'Porta Proxy');
define( '_CFG_GENERAL_PROXY_PORT_DESC', 'Especifique a porta do servidor de proxy a qual deseja conectar-se.');
define( '_CFG_GENERAL_PROXY_USERNAME_NAME', 'Nome de Utilizador Proxy');
define( '_CFG_GENERAL_PROXY_USERNAME_DESC', 'Se o seu proxy necessita de login, coloque aqui o nome de utilizador.');
define( '_CFG_GENERAL_PROXY_PASSWORD_NAME', 'Senha Proxy');
define( '_CFG_GENERAL_PROXY_PASSWORD_DESC', 'Se o seu proxy necessita de login, coloque a sua senha aqui.');
define( '_CFG_GENERAL_GETHOSTBYADDR_NAME', 'Log Host with IP');
define( '_CFG_GENERAL_GETHOSTBYADDR_DESC', 'On logging Events that store an IP address, this option will also store the internet host name as well. In some hosting situations, this can take over a minute and thus should be disabled.');
define( '_CFG_GENERAL_RENEW_BUTTON_NEVER_NAME', 'Sem Bot&atilde;o de Renovar');
define( '_CFG_GENERAL_RENEW_BUTTON_NEVER_DESC', 'Selecione&quot;Sim&quot; para nunca mostrar o bot&atilde;o de renovar/upgrade na pagina As Minhas Inscri&ccedil;&otilde;es.');
define( '_CFG_GENERAL_RENEW_BUTTON_NOLIFETIMERECURRING_NAME', 'But&atilde;o Renovar Restricto');
define( '_CFG_GENERAL_RENEW_BUTTON_NOLIFETIMERECURRING_DESC', 'Apenas mostra o bot&atilde;o de Renovar se fizer sentido (pagamentos o valida&ccedil;&otilde;es o bot&atilde;o n&atilde;o &eacute; mostrado).');
define( '_CFG_GENERAL_CONTINUE_BUTTON_NAME', 'Bot&atilde;o Continuar');
define( '_CFG_GENERAL_CONTINUE_BUTTON_DESC', 'Se o utilizador j&aacute; foi um membro anteriormente, este but&atilde;o ser&aacute; mostrado na pagina de expira&ccedil;&atilde;o e ligar&aacute; directamente ao plano anterior, dessaforma o utilizador ser&aacute; redirecionado rapidamente para continuar como Membro');

define( '_CFG_GENERAL_ERROR_NOTIFICATION_LEVEL_NAME', 'N&iacute;vel de Notifica&ccedil;&atilde;o');
define( '_CFG_GENERAL_ERROR_NOTIFICATION_LEVEL_DESC', 'Selecione qual n&iacute;vel de entradas no Log de Eventos que &eacute; necess&aacute;rio para serem visualizadas na pagina central para sua conveni&ecirc;ncia.');
define( '_CFG_GENERAL_EMAIL_NOTIFICATION_LEVEL_NAME', 'N&iacute;vel de Notifica&ccedil;&atilde;o Email');
define( '_CFG_GENERAL_EMAIL_NOTIFICATION_LEVEL_DESC', 'Selecione qual o n&iacute;vel de entradas no Log de Eventos que &eacute; necess&aacute;rio para o AEC enviar um Email a todos os Administradores.');

define( '_CFG_GENERAL_SKIP_CONFIRMATION_NAME', 'Pular Confirma&ccedil;&atilde;o');
define( '_CFG_GENERAL_SKIP_CONFIRMATION_DESC', 'N&atilde;o mostrar a pagina de Confirma&ccedil;&atilde;o antes da Conclus&atilde;o (o que permite o utilizador voltar a visitar a decis&atilde;o actual).');
define( '_CFG_GENERAL_SHOW_FIXEDDECISION_NAME', 'Mostrar Decis&atilde;o Fixas');
define( '_CFG_GENERAL_SHOW_FIXEDDECISION_DESC', 'OAEC normalmente pula a pagina de Planos de Pagamento se n&atilde;o ouver nenhuma decis&atilde;o a ser tomada (um plano de pagamento com apenas um processamento). Com esta op&ccedil;&atilde;o, pode for&ccedil;ar a mostrar a pagina.');
define( '_CFG_GENERAL_CONFIRMATION_COUPONS_NAME', 'Cup&otilde;es na Confirma&ccedil;&atilde;o');
define( '_CFG_GENERAL_CONFIRMATION_COUPONS_DESC', 'Oferta para fornecer c&oacute;digos de cup&oacute;es quano cliquem no bot&atilde;o de Confirma&ccedil;&atilde;o na pagina de Confirma&ccedil;&atilde;o');
define( '_CFG_GENERAL_BREAKON_MI_ERROR_NAME', 'Quebra no Erro MI');
define( '_CFG_GENERAL_BREAKON_MI_ERROR_DESC', 'Para aplica&ccedil;&atilde;o dos planos se um dos MI encontrar erros (ser&aacute; tra&ccedil;ado um log do evento de qualquer forma)');

define( '_CFG_GENERAL_ENABLE_SHOPPINGCART_NAME', 'Enable Shopping Cart');
define( '_CFG_GENERAL_ENABLE_SHOPPINGCART_DESC', 'Handle purchases via shopping cart. Available only for logged-in users.');
define( '_CFG_GENERAL_CUSTOMLINK_CONTINUESHOPPING_NAME', 'Custom Continue Shopping Link');
define( '_CFG_GENERAL_CUSTOMLINK_CONTINUESHOPPING_DESC', 'Instead of routing a user to the standard subscription page, route here.');
define( '_CFG_GENERAL_ADDITEM_STAYONPAGE_NAME', 'Stay on Page');
define( '_CFG_GENERAL_ADDITEM_STAYONPAGE_DESC', 'Instead of moving to the shopping cart after selecting an item, stay on the same page.');

define( '_CFG_GENERAL_CURL_DEFAULT_NAME', 'Usar cURL');
define( '_CFG_GENERAL_CURL_DEFAULT_DESC', 'Usar cURL em vez de fsockopen por padr&atilde;o (falhar&aacute; o outro, se a primeira escolha falhar)');
define( '_CFG_GENERAL_AMOUNT_CURRENCY_SYMBOL_NAME', 'Simbolo Moeda');
define( '_CFG_GENERAL_AMOUNT_CURRENCY_SYMBOL_DESC', 'Mostrar o simbolo da moeda (se existir) em vez da abrevia&ccedil;&atilde;o ISO');
define( '_CFG_GENERAL_AMOUNT_CURRENCY_SYMBOLFIRST_NAME', 'Primeiro a Moeda');
define( '_CFG_GENERAL_AMOUNT_CURRENCY_SYMBOLFIRST_DESC', 'Mostra a moeda a frente do valor');
define( '_CFG_GENERAL_AMOUNT_USE_COMMA_NAME', 'Usar Vi&iacute;rgula');
define( '_CFG_GENERAL_AMOUNT_USE_COMMA_DESC', 'Usar uma v&iacute;rgula em vez de ponto no valor');
define( '_CFG_GENERAL_ALLOW_FRONTEND_HEARTBEAT_NAME', 'Allow Custom Frontend Heartbeat');
define( '_CFG_GENERAL_ALLOW_FRONTEND_HEARTBEAT_DESC', 'Trigger a custom heartbeat from the frontend (via the link index.php?option=com_acctexp&task=heartbeat) - for example with a Cronjob');
define( '_CFG_GENERAL_DISABLE_REGULAR_HEARTBEAT_NAME', 'Disable Automatic Heartbeat');
define( '_CFG_GENERAL_DISABLE_REGULAR_HEARTBEAT_DESC', 'If you only want to trigger custom heartbeats, you can disable the automatic ones here.');
define( '_CFG_GENERAL_CUSTOM_HEARTBEAT_SECUREHASH_NAME', 'Custom Frontend Heartbeat Securehash');
define( '_CFG_GENERAL_CUSTOM_HEARTBEAT_SECUREHASH_DESC', 'A code that has to be passed on custom Frontend Heartbeat (with the option &hash=YOURHASHCODE) - if one is set, but not passed, the AEC will not trigger the heartbeat.');
define( '_CFG_GENERAL_QUICKSEARCH_TOP_NAME', 'Quicksearch on top');
define( '_CFG_GENERAL_QUICKSEARCH_TOP_DESC', 'This is the setting for all you quicksearch junkies - it will switch it to be above the main icons on the central page');

define( '_CFG_GENERAL_SUB_UNINSTALL', 'Uninstall');
define( '_CFG_GENERAL_DELETE_TABLES_NAME', 'Delete Tables');
define( '_CFG_GENERAL_DELETE_TABLES_DESC', 'Do you want to delete the AEC tables when uninstalling the software?');
define( '_CFG_GENERAL_DELETE_TABLES_SURE_NAME', 'Really?');
define( '_CFG_GENERAL_DELETE_TABLES_SURE_DESC', 'Security switch - when deleting the AEC tables, ALL YOUR MEMBERSHIP DATA WILL BE GONE!');
define( '_CFG_GENERAL_STANDARD_CURRENCY_NAME', 'Standard Currency');
define( '_CFG_GENERAL_STANDARD_CURRENCY_DESC', 'Which currency should the AEC use if no information is available (for example, if a plan is free, it will have no processor attached to it and get its currency information from here)');

define( '_CFG_GENERAL_CONFIRMATION_CHANGEUSERNAME_NAME', 'Option: Change Username');
define( '_CFG_GENERAL_CONFIRMATION_CHANGEUSERNAME_DESC', 'Give new users the possibility to go back to the registration screen from confirmation (in case they made an error)');
define( '_CFG_GENERAL_CONFIRMATION_CHANGEUSAGE_NAME', 'Option: Change Item');
define( '_CFG_GENERAL_CONFIRMATION_CHANGEUSAGE_DESC', 'Give new users the possibility to go back to the plan selection screen from confirmation (in case they made an error)');

define( '_CFG_GENERAL_MANAGERACCESS_NAME', 'Manager Access:');
define( '_CFG_GENERAL_MANAGERACCESS_DESC', 'Grant Access to the AEC not only to Administrators, but to Managers as well.');
define( '_CFG_GENERAL_PER_PLAN_MIS_NAME', 'Per Plan MIs:');
define( '_CFG_GENERAL_PER_PLAN_MIS_DESC', 'Shows per-plan MIs that are only editable from within payment plans and are only attached to the one plan they were created in.');
define( '_CFG_GENERAL_INTRO_EXPIRED_NAME', 'Intro for Expired');
define( '_CFG_GENERAL_INTRO_EXPIRED_DESC', 'AEC normally does not show the intro page (which you may or may not have set) when users whose subscriptions have expired want to sign up for a new one. This setting overrides the behavior.');

define( '_CFG_GENERAL_INVOICE_CUSHION_NAME', 'Invoice Cushion');
define( '_CFG_GENERAL_INVOICE_CUSHION_DESC', 'The cushion period in which AEC does not accept new notifications for an invoice that was already paid.');

// Global Authentication Settins
define( '_CFG_TAB_AUTHENTICATION_TITLE', 'Authentication');
define( '_CFG_TAB_AUTHENTICATION_SUBTITLE', 'Authentication Plugins');
define( '_CFG_AUTH_AUTHLIST_NAME', 'Active Authentication Plugins');
define( '_CFG_AUTH_AUTHLIST_DESC', 'Select which Authentication (as in: at least one of them has to be successful for the login to pass) Plugins will be used. AECaeccss Plugin must be the only Authentication Plugin enabled in the Joomla Plugin Manager.');
define( '_CFG_AUTH_AUTHORIZATION_LIST_NAME', 'Active Authorization Plugins');
define( '_CFG_AUTH_AUTHORIZATION_LIST_DESC', 'Select which Authorization (as in: all of them have to be successful for the login to pass) Plugins will be used. AECaeccss Plugin must be the only Authentication Plugin enabled in the Joomla Plugin Manager.');

//Invoice settings
define( '_CFG_GENERAL_SENDINVOICE_NAME', 'Enviar Factura Email');
define( '_CFG_GENERAL_SENDINVOICE_DESC', 'Enviar um Email factura/ordem de compra ( por motivos de taxas)');
define( '_CFG_GENERAL_INVOICETMPL_NAME', 'Template Factura');
define( '_CFG_GENERAL_INVOICETMPL_DESC', 'Template de uma factura/ ordem de compra');

// --== Processors PAGE ==--

define( '_PROCESSORS_TITLE', 'Processors');
define( '_PROCESSOR_NAME', 'Name');
define( '_PROCESSOR_DESC', 'Description (first 50 chars)');
define( '_PROCESSOR_ACTIVE', 'Published');
define( '_PROCESSOR_VISIBLE', 'Visible');
define( '_PROCESSOR_REORDER', 'Reorder');
define( '_PROCESSOR_INFO', 'Information');

define( '_PUBLISH_PROCESSOR', 'Publish');
define( '_UNPUBLISH_PROCESSOR', 'Unpublish');
define( '_NEW_PROCESSOR', 'New');
define( '_COPY_PROCESSOR', 'Copy');
define( '_APPLY_PROCESSOR', 'Apply');
define( '_EDIT_PROCESSOR', 'Edit');
define( '_REMOVE_PROCESSOR', 'Delete');
define( '_SAVE_PROCESSOR', 'Save');
define( '_CANCEL_PROCESSOR', 'Cancel');

define( '_PP_GENERAL_PROCESSOR_NAME', 'Payment Processor');
define( '_PP_GENERAL_PROCESSOR_DESC', 'Select which payment processor you want to use.');
define( '_PP_GENERAL_ACTIVE_NAME', 'Active');
define( '_PP_GENERAL_ACTIVE_DESC', 'Select whether this processor is currently active (and thus can carry out its function and be available to your users)');
define( '_PP_GENERAL_PLEASE_NOTE', 'Please note');
define( '_PP_GENERAL_EXPERIMENTAL', 'This payment processor is still not 100% complete - it has either been added to the codebase very recently (and is thus not fully tested) or was partly abandoned due to a customer suddenly not being interested in having us finish it anymore. If you want to use it, we would be very thankful for any kind of helping hand you can give us - either with further information on the integration, with bugreports or fixes, or with sponsorship.');

// --== PAYMENT PLAN PAGE ==--
// Additions of variables for free trial periods by Michael Spredemann (scubaguy)

define( '_PAYPLAN_PERUNIT1', 'Dias');
define( '_PAYPLAN_PERUNIT2', 'Semanas');
define( '_PAYPLAN_PERUNIT3', 'Meses');
define( '_PAYPLAN_PERUNIT4', 'Anos');

// General Params

define( '_PAYPLAN_DETAIL_TITLE', 'Plano');
define( '_PAYPLAN_GENERAL_NAME_NAME', 'Nome:');
define( '_PAYPLAN_GENERAL_NAME_DESC', 'Nome ou t&iacute;tulo para este Plano. Max.: 40 caracteres.');
define( '_PAYPLAN_GENERAL_DESC_NAME', 'Descri&ccedil;&atilde;o:');
define( '_PAYPLAN_GENERAL_DESC_DESC', 'Descri&ccedil;&atilde;o completa do plano tal como pretende que seja apresentada ao utilizador. Max.: 255 caracteres.');
define( '_PAYPLAN_GENERAL_ACTIVE_NAME', 'Publicado:');
define( '_PAYPLAN_GENERAL_ACTIVE_DESC', 'Um plano publicado estar&aacute; dispon&iacute;vel na pagina principal para os utilizadores.');
define( '_PAYPLAN_GENERAL_VISIBLE_NAME', 'Vis&iacute;vel:');
define( '_PAYPLAN_GENERAL_VISIBLE_DESC', 'Os Planos vis&iacute;veis ser&atilde;o dispon&iacute;veis na pagina principal. Planos invis&iacute;veis n&atilde;o ser&atilde; omostrados, apenas estar&atilde;o dispon&iacute;veis para aplica&ccedil;&otilde;es automaticas ( tais como Fallbacks ou Planos de Entrada).');

define( '_PAYPLAN_GENERAL_CUSTOMAMOUNTFORMAT_NAME', 'Custom amount formatting:');
define( '_PAYPLAN_GENERAL_CUSTOMAMOUNTFORMAT_DESC', 'Please use a aecJSON string like the one already filled in to modify how the cost of this plan are displayed.');
define( '_PAYPLAN_GENERAL_CUSTOMTHANKS_NAME', 'Link Pagina de Agradecimento Padr&atilde;o:');
define( '_PAYPLAN_GENERAL_CUSTOMTHANKS_DESC', 'Forne&ccedil;a um link completo (inclu&iacute;ndo http://) este encaminha para a sua pagina de Agradecimento Padr&atilde;o. Deixe o campo em branco se n&atilde;o pretender isso..');
define( '_PAYPLAN_GENERAL_CUSTOMTEXT_THANKS_KEEPORIGINAL_NAME', 'Manter Texto Original');
define( '_PAYPLAN_GENERAL_CUSTOMTEXT_THANKS_KEEPORIGINAL_DESC', 'Selecione esta op&ccedil;&atilde;o se pretender manter o texto orignal da pagina de Agradecimento');
define( '_PAYPLAN_GENERAL_CUSTOMTEXT_THANKS_NAME', 'Texto Pagina de Agradecimento Padr&atilde;o');
define( '_PAYPLAN_GENERAL_CUSTOMTEXT_THANKS_DESC', 'Texto que ser&aacute; mostrado na pagina de Agradecimento');

define( '_PAYPLAN_PARAMS_OVERRIDE_ACTIVATION_NAME', 'Sobrepor Activa&ccedil;&atilde;o');
define( '_PAYPLAN_PARAMS_OVERRIDE_ACTIVATION_DESC', 'Sobrepor a necesidade de um utilizador para activar a sua conta (via email c&oacute;digo de activa&ccedil;&atilde;o) no caso deste plano de pagamento &eacute; utilizado com um registo.');
define( '_PAYPLAN_PARAMS_OVERRIDE_REGMAIL_NAME', 'Sobrepor Email de Registo');
define( '_PAYPLAN_PARAMS_OVERRIDE_REGMAIL_DESC', 'N&atilde;o enviar nenhum Email de Registo (faz sentido para planos pagos que n&atilde;o necessitam de activa&ccedil;&atilde;o e o email ser&aacute; enviado quando o pagamento chega - com o ID do Email).');

define( '_PAYPLAN_PARAMS_GID_ENABLED_NAME', 'Activar grupo de utilizador');
define( '_PAYPLAN_PARAMS_GID_ENABLED_DESC', 'Mudar para Sim se pretende que os utilizadores sejam associados ao grupo selecionado.');
define( '_PAYPLAN_PARAMS_GID_NAME', 'Adicionar utilizador ao Grupo:');
define( '_PAYPLAN_PARAMS_GID_DESC', 'Utilizadores ser&atilde;o associados ao seu grupo de utilizadores quando o plano &eacute; aplicado.');
define( '_PAYPLAN_PARAMS_MAKE_ACTIVE_NAME', 'Tornar Activo:');
define( '_PAYPLAN_PARAMS_MAKE_ACTIVE_DESC', 'Definir para &gt;N&atilde;o&lt; se pretender activar manualmente o utilizadore ap&oacute;s ele efectuar o pagamento.');
define( '_PAYPLAN_PARAMS_MAKE_PRIMARY_NAME', 'Prim&aacute;rio:');
define( '_PAYPLAN_PARAMS_MAKE_PRIMARY_DESC', 'Definir para &quot;Sim&quot; para tornar este o plano de subscri&ccedil;&atilde;o prim&aacute;rio para o utilizador. A Subscri&ccedil;&atilde;o prim&aacute;ria &eacute; a que controla as expira&ccedil;&otilde;es globais do sistema.');
define( '_PAYPLAN_PARAMS_UPDATE_EXISTING_NAME', 'Actualiza&ccedil;&otilde;es Existentes:');
define( '_PAYPLAN_PARAMS_UPDATE_EXISTING_DESC', 'Se n&atilde;o or um plano prim&aacute;rio, deve este plano actualizar outras subscri&ccedil;&otilde;es n&atilde;o prim&aacute;rias existente do utilizador? isto pode ser extremamente &uacute;til para subscri&ccedil;&otilde;es secund&aacute;rias onde o utilizador deve ter apenas uma de cada vez.');

define( '_PAYPLAN_TEXT_TITLE', 'Texto Plano');
define( '_PAYPLAN_GENERAL_EMAIL_DESC_NAME', 'Descri&ccedil;&atilde;o Email:');
define( '_PAYPLAN_GENERAL_EMAIL_DESC_DESC', 'Texto que ser&aacute; adicionado ao email que o utilizador receber&aacute; quando um plano for activado para ele');
define( '_PAYPLAN_GENERAL_FALLBACK_NAME', 'Plano Fallback:');
define( '_PAYPLAN_GENERAL_FALLBACK_DESC', 'Quando a subscri&ccedil;&atilde;o de um utilizadore expira - torna o membro do seguinte plano');
define( '_PAYPLAN_GENERAL_STANDARD_PARENT_NAME', 'Plano Principal Standard');
define( '_PAYPLAN_GENERAL_STANDARD_PARENT_DESC', 'Atualmente atribui este plano como plano principal no caso do utilizador se increver apenas para um plano secund&aacute;rio.');

define( '_PAYPLAN_GENERAL_PROCESSORS_NAME', 'Gateways de Pagamento:');
define( '_PAYPLAN_NOPLAN', 'Sem Plano');
define( '_PAYPLAN_NOGW', 'Sem Gateway');
define( '_PAYPLAN_GENERAL_PROCESSORS_DESC', 'Selecione o gateways do magamento que pretende que esteja dispon&iacute;vel para este plano. Premirtecla Control ou Shift para selecionar m&uacute;ltiplas op&ccedil;&otilde;es ' . _PAYPLAN_NOPLAN . ' todas as outras op&ccedil;&otilde;es selecionadas ser&atilde;o ignoradas. Se voc&ecirc; visualizar apenas ' . _PAYPLAN_NOPLAN . ' aqui significa que n&atilde;o existem processos de pagamento activos na suas Configura&ccedil;&otilde;es.');
define( '_PAYPLAN_PARAMS_LIFETIME_NAME', 'Validade:');
define( '_PAYPLAN_PARAMS_LIFETIME_DESC', 'Tornar esta subscri&ccedil;&atilde;o com validade ilimitada, que nunca expira.');

define( '_PAYPLAN_AMOUNT_NOTICE', 'Not&iacute;cia ou Per&iacute;odo');
define( '_PAYPLAN_AMOUNT_NOTICE_TEXT', 'para Subscri&ccedil;&atilde;o Paypal, existe um limite maximo de valor que voc&ecirc; pode introduzir para o per&iacute;odo, <strong>por favor defina limite de dias para 90, semanas para 52, meses para 24 e anos para 5 no m&aacute;ximo</strong>.');
define( '_PAYPLAN_AMOUNT_EDITABLE_NOTICE', 'Existem um ou mais utilizadores a usar pagamentos recorrentes para este plano, &eacute; aconselh&aacute;vel n&atilde;o modificar os termos enquanto n&atilde;o forem cancelados.');

define( '_PAYPLAN_REGULAR_TITLE', 'Normal Subscri&ccedil;&atilde;o');
define( '_PAYPLAN_PARAMS_FULL_FREE_NAME', 'Gr&aacute;tis:');
define( '_PAYPLAN_PARAMS_FULL_FREE_DESC', 'Defina para Sim se desejar oferecer este plano gratuito');
define( '_PAYPLAN_PARAMS_FULL_AMOUNT_NAME', 'Taxa Regular:');
define( '_PAYPLAN_PARAMS_FULL_AMOUNT_DESC', 'O pre&ccedil;o da subscri&ccedil;&atilde;o. Se houver subscritores para este plano este campo n&atilde;o poder&aacute; ser modificado. Se pretender substituir este plano, despublique-o e crie um novo.');
define( '_PAYPLAN_PARAMS_FULL_PERIOD_NAME', 'Per&iacute;odo:');
define( '_PAYPLAN_PARAMS_FULL_PERIOD_DESC', 'Este &eacute; a dura&ccedil;&atilde;o do ciclo de factura&ccedil;&atilde;o. Este n&uacute;mero &eacute; modificado pela unidade regular do ciclo de factura&ccedil;&atilde;o (abaixo).Se existirem subscritores para este plano este campo n&atilde;o pode ser modificado.Se desejar substituir este plano, despublique-o e crie um novo.');
define( '_PAYPLAN_PARAMS_FULL_PERIODUNIT_NAME', 'Unidade do Per&iacute;odo:');
define( '_PAYPLAN_PARAMS_FULL_PERIODUNIT_DESC', 'Esta &eacute; a unidade do ciclo regural de factura&ccedil;&atilde;o (abaixo). Se existirem subscritores para este plano este campo n&atilde;o pode ser modificado.Se desejar substituir este plano, despublique-o e crie um novo.');

define( '_PAYPLAN_TRIAL_TITLE', 'Per&iacute;odo de Demonstra&ccedil;&atilde;o');
define( '_PAYPLAN_TRIAL', '(Opcional)');
define( '_PAYPLAN_TRIAL_DESC', 'Pule esta sec&ccedil;&atilde;o se pretender oferecer Per&iacute;odos de Demonstra&ccedil;&atilde;o com as suas inscri&ccedil;&otilde;es. <strong>Demonstra&ccedil;&otilde;es apenas funcionam com subscri&ccedil;&otilde;es PayPal!</strong>');
define( '_PAYPLAN_PARAMS_TRIAL_FREE_NAME', 'Gr&aacute;tis:');
define( '_PAYPLAN_PARAMS_TRIAL_FREE_DESC', 'Definir isto para Sim se pretender oferecer esta demonstra&ccedil;&atilde;o gr&aacute;tis');
define( '_PAYPLAN_PARAMS_TRIAL_AMOUNT_NAME', 'Taxa Demonstra&ccedil;&atilde;o:');
define( '_PAYPLAN_PARAMS_TRIAL_AMOUNT_DESC', 'Introduza o valor para imediatamente facturar o subscritor.');
define( '_PAYPLAN_PARAMS_TRIAL_PERIOD_NAME', 'Periodo de Demonstra&ccedil;&atilde;o:');
define( '_PAYPLAN_PARAMS_TRIAL_PERIOD_DESC', 'Esta &eacute; a dura&ccedil;&atilde;o do prer&iacute;odo de demonstra&ccedil;&atilde;o.O n&uacute;mero &eacute; modificado pela unidade do ciclo regular de factura&ccedil;&atilde;o (abaixo).Se existirem subscritores para este plano este campo n&atilde;o pode ser modificado.Se desejar substituir este plano, despublique-o e crie um novo.');
define( '_PAYPLAN_PARAMS_TRIAL_PERIODUNIT_NAME', 'Unidade de Per&iacute;odo de Demonstra&ccedil;&atilde;o:');
define( '_PAYPLAN_PARAMS_TRIAL_PERIODUNIT_DESC', 'Esta &eacute; a unidade do per&iacute;odo de demonstra&ccedil;&atilde;o (acima). Se existirem subscritores para este plano este campo n&atilde;o pode ser modificado.Se desejar substituir este plano, despublique-o e crie um novo.');

define( '_PAYPLAN_PARAMS_NOTAUTH_REDIRECT_NAME', 'Denied Access Redirect');
define( '_PAYPLAN_PARAMS_NOTAUTH_REDIRECT_DESC', 'Redirect to a different URL should the user follow a direct link to this item without having the right authorization.');

// Payplan Relations

define( '_PAYPLAN_RELATIONS_TITLE', 'Rela&ccedil;&otilde;es');
define( '_PAYPLAN_PARAMS_SIMILARPLANS_NAME', 'Planos Similares:');
define( '_PAYPLAN_PARAMS_SIMILARPLANS_DESC', 'Selecione quais os planos similares a este. Um utilizador n&atilde;o fica abilidado a usar um Per&iacute;do de Demonstra&ccedil;&atilde;o quando compra um plano que j&aacute; tinha comprado anteriormente isto aplica igualmente para planos similares.');
define( '_PAYPLAN_PARAMS_EQUALPLANS_NAME', 'Planos Iguais:');
define( '_PAYPLAN_PARAMS_EQUALPLANS_DESC', 'Selecione quais os planos que s&atilde;o iguais a este. Um utilizador que mude entre planos iguais ter&aacute; o seu per&iacute;do alargado. Demonsta&ccedil;&otilde;es n&atilde;o s&atilde;o permitidas (ver informa&ccedil;&atilde;o dos planos similares).');

// Payplan Restrictions

define( '_PAYPLAN_RESTRICTIONS_TITLE', 'Restri&ccedil;&otilde;es');
define( '_PAYPLAN_RESTRICTIONS_MINGID_ENABLED_NAME', 'ActivarGID Minimo:');
define( '_PAYPLAN_RESTRICTIONS_MINGID_ENABLED_DESC', 'Active esta op&ccedil;&atilde;o se pretende restringir que um plano esteja dispon&iacute;vel a um utilizador pertencente a um grupo de utilizadores definido.');
define( '_PAYPLAN_RESTRICTIONS_MINGID_NAME', 'Visibilidade do Grupo:');
define( '_PAYPLAN_RESTRICTIONS_MINGID_DESC', 'O n&iacute;vel minimo requerido do utilizador para ver este plano, quando controi a pagina de Planos de pagamento. novos utilizadores ter&atilde;o sempre acesso a ver o plano com o gid mais inferior dispon&iacute;vel.');
define( '_PAYPLAN_RESTRICTIONS_FIXGID_ENABLED_NAME', 'Activar GID Fixo:');
define( '_PAYPLAN_RESTRICTIONS_FIXGID_ENABLED_DESC', 'Activar esta op&ccedil;&atilde;o se pretende restringir este plano para um grupo de utilizadores.');
define( '_PAYPLAN_RESTRICTIONS_FIXGID_NAME', 'Definir Grupo:');
define( '_PAYPLAN_RESTRICTIONS_FIXGID_DESC', 'Apenas utilizadores deste grupo podem ver este plano.');
define( '_PAYPLAN_RESTRICTIONS_MAXGID_ENABLED_NAME', 'Activar GID M&aacute;ximo:');
define( '_PAYPLAN_RESTRICTIONS_MAXGID_ENABLED_DESC', 'Activar esta op&ccedil;&atilde;o se pretende restingir este plano a um utilizador por um grupo de utilizadores m&aacute;ximo.');
define( '_PAYPLAN_RESTRICTIONS_MAXGID_NAME', 'Grupo M&aacute;ximo:');
define( '_PAYPLAN_RESTRICTIONS_MAXGID_DESC', 'O nivel m&aacute;ximo que outilizador pode ter para poder ver este plano, quando controi a pagina de planos de pagamento.');

define( '_PAYPLAN_RESTRICTIONS_PREVIOUSPLAN_REQ_ENABLED_NAME', 'Plano Anterior Necess&aacute;rio:');
define( '_PAYPLAN_RESTRICTIONS_PREVIOUSPLAN_REQ_ENABLED_DESC', 'Activar a verifica&ccedil;&atilde;o para o plano de pagamentos anterior');
define( '_PAYPLAN_RESTRICTIONS_PREVIOUSPLAN_REQ_NAME', 'Plano:');
define( '_PAYPLAN_RESTRICTIONS_PREVIOUSPLAN_REQ_DESC', 'O utilizador apenas ir&aacute; visualizar este plano, se ja tiver utilizado o plano selecionado anterioremente do actual em uso');
define( '_PAYPLAN_RESTRICTIONS_CURRENTPLAN_REQ_ENABLED_NAME', 'Plano Actual Necess&aacute;rio:');
define( '_PAYPLAN_RESTRICTIONS_CURRENTPLAN_REQ_ENABLED_DESC', 'Activar verifica&ccedil;&atilde;o para o actual plano de pagamentos');
define( '_PAYPLAN_RESTRICTIONS_CURRENTPLAN_REQ_NAME', 'Plano:');
define( '_PAYPLAN_RESTRICTIONS_CURRENTPLAN_REQ_DESC', 'O utilizador apenas visualizar&aacute; este plano, se actualmente estiver associado ou expirou do plano selecionado');
define( '_PAYPLAN_RESTRICTIONS_OVERALLPLAN_REQ_ENABLED_NAME', 'Plano Usado Necess&aacute;rio:');
define( '_PAYPLAN_RESTRICTIONS_OVERALLPLAN_REQ_ENABLED_DESC', 'Activar verifica&ccedil;&atilde;o para o plano de pagamentos usado');
define( '_PAYPLAN_RESTRICTIONS_OVERALLPLAN_REQ_NAME', 'Plano:');
define( '_PAYPLAN_RESTRICTIONS_OVERALLPLAN_REQ_DESC', 'O utilizador apenas visualizara este plano, se ja tiver utilizado o plano selecionado, n&atilde;o importa quando');

define( '_PAYPLAN_RESTRICTIONS_PREVIOUSPLAN_REQ_ENABLED_EXCLUDED_NAME', 'Plano Anterior Exclu&iacute;do:');
define( '_PAYPLAN_RESTRICTIONS_PREVIOUSPLAN_REQ_ENABLED_EXCLUDED_DESC', 'N&Atilde;O mostrar este plano ao utilizador que possu&iacute; o plano selecionado como planos de pagamentos anterior');
define( '_PAYPLAN_RESTRICTIONS_PREVIOUSPLAN_REQ_EXCLUDED_NAME', 'Plano:');
define( '_PAYPLAN_RESTRICTIONS_PREVIOUSPLAN_REQ_EXCLUDED_DESC', 'O utilizador n&atilde;o visualizar&aacute; este plano se ja tiver utilizado o planos actual antes do actual em uso');
define( '_PAYPLAN_RESTRICTIONS_CURRENTPLAN_REQ_ENABLED_EXCLUDED_NAME', 'Plano Actual Exclu&iacute;do:');
define( '_PAYPLAN_RESTRICTIONS_CURRENTPLAN_REQ_ENABLED_EXCLUDED_DESC', 'N&Atilde;O mostrar este plano ao utilizador que possu&iacute; o plano selecionado como planos de pagamentos actual');
define( '_PAYPLAN_RESTRICTIONS_CURRENTPLAN_REQ_EXCLUDED_NAME', 'Plano:');
define( '_PAYPLAN_RESTRICTIONS_CURRENTPLAN_REQ_EXCLUDED_DESC', 'O utilizador n&atilde;o visualizar&aacute; este plano, se estiver actualmente associado a ele, ou tiver expirado recentemente do plano selecionado');
define( '_PAYPLAN_RESTRICTIONS_OVERALLPLAN_REQ_ENABLED_EXCLUDED_NAME', 'Plano usado Exclu&iacute;do:');
define( '_PAYPLAN_RESTRICTIONS_OVERALLPLAN_REQ_ENABLED_EXCLUDED_DESC', 'N&Atilde;O mostrar este plano ao utilizador que possu&iacute; o plano selecionado como planos de pagamentos anterior');
define( '_PAYPLAN_RESTRICTIONS_OVERALLPLAN_REQ_EXCLUDED_NAME', 'Plano:');
define( '_PAYPLAN_RESTRICTIONS_OVERALLPLAN_REQ_EXCLUDED_DESC', 'O utilizador n&atilde;o visualizar&aacute; este plano, se ja tiver utilizado o plano selecionado uma vez, n&atilde;o importa quando');

define( '_PAYPLAN_RESTRICTIONS_USED_PLAN_MIN_ENABLED_NAME', 'Plano Usado Minimo:');
define( '_PAYPLAN_RESTRICTIONS_USED_PLAN_MIN_ENABLED_DESC', 'Activar a verifica&ccedil;&atilde;o para o minimo n&uacute;mero de vezes que um cliente subscreveu um determinado plano de pagamento de forma a ver este');
define( '_PAYPLAN_RESTRICTIONS_USED_PLAN_MIN_AMOUNT_NAME', 'Valor Usado:');
define( '_PAYPLAN_RESTRICTIONS_USED_PLAN_MIN_AMOUNT_DESC', 'O valor minimo que um utilizador deve ter usado o plano selecionado');
define( '_PAYPLAN_RESTRICTIONS_USED_PLAN_MIN_NAME', 'Plano:');
define( '_PAYPLAN_RESTRICTIONS_USED_PLAN_MIN_DESC', 'O plano de pagamentos que o utilizador deve ter usado no minimo o numero de vezes especificado');
define( '_PAYPLAN_RESTRICTIONS_USED_PLAN_MAX_ENABLED_NAME', 'Plano Usado M&aacute;ximo:');
define( '_PAYPLAN_RESTRICTIONS_USED_PLAN_MAX_ENABLED_DESC', 'Activa a verifica&ccedil;&atilde;o para o m&aacute;ximo n&uacute;mero de vezes que o cliente subscreveu um plano de pagamentos especifico de forma a ver este');
define( '_PAYPLAN_RESTRICTIONS_USED_PLAN_MAX_AMOUNT_NAME', 'Valor Usado');
define( '_PAYPLAN_RESTRICTIONS_USED_PLAN_MAX_AMOUNT_DESC', 'O vaor m&aacute;ximo que o utilizador pode ter usado o plano selecionado');
define( '_PAYPLAN_RESTRICTIONS_USED_PLAN_MAX_NAME', 'Plano:');
define( '_PAYPLAN_RESTRICTIONS_USED_PLAN_MAX_DESC', 'O plano de pagamento que o utlizador deve ter usado no m&aacute;ximo o n&uacute;mero de vezes especificado');

define( '_PAYPLAN_RESTRICTIONS_PREVIOUSGROUP_REQ_ENABLED_NAME', 'Required Prev. Group:');
define( '_PAYPLAN_RESTRICTIONS_PREVIOUSGROUP_REQ_ENABLED_DESC', 'Enable checking for previous payment plan in this group');
define( '_PAYPLAN_RESTRICTIONS_PREVIOUSGROUP_REQ_NAME', 'Group:');
define( '_PAYPLAN_RESTRICTIONS_PREVIOUSGROUP_REQ_DESC', 'A user will only see this plan if he or she used a plan in this group before the one currently in use');
define( '_PAYPLAN_RESTRICTIONS_CURRENTGROUP_REQ_ENABLED_NAME', 'Required Curr. Group:');
define( '_PAYPLAN_RESTRICTIONS_CURRENTGROUP_REQ_ENABLED_DESC', 'Enable checking for currently present payment plan in this group');
define( '_PAYPLAN_RESTRICTIONS_CURRENTGROUP_REQ_NAME', 'Group:');
define( '_PAYPLAN_RESTRICTIONS_CURRENTGROUP_REQ_DESC', 'A user will only see this plan if he or she is currently assigned to, or has just expired from a plan in this group selected here');
define( '_PAYPLAN_RESTRICTIONS_OVERALLGROUP_REQ_ENABLED_NAME', 'Required Used Group:');
define( '_PAYPLAN_RESTRICTIONS_OVERALLGROUP_REQ_ENABLED_DESC', 'Enable checking for overall used payment plan in this group');
define( '_PAYPLAN_RESTRICTIONS_OVERALLGROUP_REQ_NAME', 'Group:');
define( '_PAYPLAN_RESTRICTIONS_OVERALLGROUP_REQ_DESC', 'A user will only see this plan if he or she has used the selected plan in this group once, no matter when');

define( '_PAYPLAN_RESTRICTIONS_PREVIOUSGROUP_REQ_ENABLED_EXCLUDED_NAME', 'Excluded Prev. Group:');
define( '_PAYPLAN_RESTRICTIONS_PREVIOUSGROUP_REQ_ENABLED_EXCLUDED_DESC', 'Do NOT show this plan to users who had a plan in this group as their previous payment plan');
define( '_PAYPLAN_RESTRICTIONS_PREVIOUSGROUP_REQ_EXCLUDED_NAME', 'Group:');
define( '_PAYPLAN_RESTRICTIONS_PREVIOUSGROUP_REQ_EXCLUDED_DESC', 'A user will not see this plan if he or she used a plan in this group before the one currently in use');
define( '_PAYPLAN_RESTRICTIONS_CURRENTGROUP_REQ_ENABLED_EXCLUDED_NAME', 'Excluded Curr. Group:');
define( '_PAYPLAN_RESTRICTIONS_CURRENTGROUP_REQ_ENABLED_EXCLUDED_DESC', 'Do NOT show this plan to users who have a plan in this group as their currently present payment plan');
define( '_PAYPLAN_RESTRICTIONS_CURRENTGROUP_REQ_EXCLUDED_NAME', 'Group:');
define( '_PAYPLAN_RESTRICTIONS_CURRENTGROUP_REQ_EXCLUDED_DESC', 'A user will not see this plan if he or she is currently assigned to, or has just expired from a plan in this group');
define( '_PAYPLAN_RESTRICTIONS_OVERALLGROUP_REQ_ENABLED_EXCLUDED_NAME', 'Excluded Used Group:');
define( '_PAYPLAN_RESTRICTIONS_OVERALLGROUP_REQ_ENABLED_EXCLUDED_DESC', 'Do NOT show this plan to users who have used the a plan in this group before');
define( '_PAYPLAN_RESTRICTIONS_OVERALLGROUP_REQ_EXCLUDED_NAME', 'Group:');
define( '_PAYPLAN_RESTRICTIONS_OVERALLGROUP_REQ_EXCLUDED_DESC', 'A user will not see this plan if he or she has used a plan in this group once, no matter when');

define( '_PAYPLAN_RESTRICTIONS_USED_GROUP_MIN_ENABLED_NAME', 'Min Used Group:');
define( '_PAYPLAN_RESTRICTIONS_USED_GROUP_MIN_ENABLED_DESC', 'Enable checking for the minimum number of times your consumers have subscribed to a payment plan in this group in order to see THIS plan');
define( '_PAYPLAN_RESTRICTIONS_USED_GROUP_MIN_AMOUNT_NAME', 'Used Amount:');
define( '_PAYPLAN_RESTRICTIONS_USED_GROUP_MIN_AMOUNT_DESC', 'The minimum amount a user has to have used the a plan in this group');
define( '_PAYPLAN_RESTRICTIONS_USED_GROUP_MIN_NAME', 'Group:');
define( '_PAYPLAN_RESTRICTIONS_USED_GROUP_MIN_DESC', 'The group that the user has to have used a plan from - the specified number of times at least');
define( '_PAYPLAN_RESTRICTIONS_USED_GROUP_MAX_ENABLED_NAME', 'Max Used Group:');
define( '_PAYPLAN_RESTRICTIONS_USED_GROUP_MAX_ENABLED_DESC', 'Enable checking for the maximum number of times your users have subscribed to a payment plan in this group in order to see THIS plan');
define( '_PAYPLAN_RESTRICTIONS_USED_GROUP_MAX_AMOUNT_NAME', 'Used Amount:');
define( '_PAYPLAN_RESTRICTIONS_USED_GROUP_MAX_AMOUNT_DESC', 'The maximum amount a user can have used a plan in this group');
define( '_PAYPLAN_RESTRICTIONS_USED_GROUP_MAX_NAME', 'Group:');
define( '_PAYPLAN_RESTRICTIONS_USED_GROUP_MAX_DESC', 'The group that the user has to have used a plan from - the specified number of times at most');

define( '_PAYPLAN_RESTRICTIONS_CUSTOM_RESTRICTIONS_ENABLED_NAME', 'Usar Restri&ccedil;&otilde;es Padr&atilde;o:');
define( '_PAYPLAN_RESTRICTIONS_CUSTOM_RESTRICTIONS_ENABLED_DESC', 'Activar o uso das restri&ccedil;&otilde;es especificadas abaixo');
define( '_PAYPLAN_RESTRICTIONS_CUSTOM_RESTRICTIONS_NAME', 'Restri&ccedil;&otilde;es Padr&atilde;o:');
define( '_PAYPLAN_RESTRICTIONS_CUSTOM_RESTRICTIONS_DESC', 'Utilizar os campos do Motor de Reescrita para verificar por string especificas neste formul&aacute;rio:<br />[[user_id]] &gt;= 1500<br />[[parametername]] = value<br />(Criar regras separadas introduzindo uma nova linha).<br />Pode utilizar =, &lt;=, &gt;=, &lt;, &gt;, &lt;&gt; como elementosde compara&ccedil;&atilde;o. DEVE utilizar espa&ccedil;os entre os parametros, valores e elementos de compra&ccedil;&atilde;o!');

define( '_PAYPLAN_PROCESSORS_TITLE', 'Processos');
define( '_PAYPLAN_PROCESSORS_TITLE_LONG', 'Processos de Pagamentos');

define( '_PAYPLAN_PROCESSORS_ACTIVATE_NAME', 'Activa');
define( '_PAYPLAN_PROCESSORS_ACTIVATE_DESC', 'Oferecer este Processo de Pagamento ppara este plano de Pagamentos.');
define( '_PAYPLAN_PROCESSORS_OVERWRITE_SETTINGS_NAME', 'Sobrepor Defini&ccedil;&otilde;es Gerais');
define( '_PAYPLAN_PROCESSORS_OVERWRITE_SETTINGS_DESC', 'Se desejar, poder selecionar esta caixa e antes de guardar o plano, editar todas as configura&ccedil;&otilde;es das Defini&ccedil;&otilde;es Gerais para ter um plano individual diferente.');

define( '_PAYPLAN_MI', 'Micro Integr.');
define( '_PAYPLAN_GENERAL_MICRO_INTEGRATIONS_NAME', 'Micro Integra&ccedil;&otilde;es:');
define( '_PAYPLAN_GENERAL_MICRO_INTEGRATIONS_DESC', 'Selecionar as Micro Integra&ccedil;&otilde;es que pretende associar utilizador com o plano.');
define( '_PAYPLAN_GENERAL_MICRO_INTEGRATIONS_PLAN_NAME', 'Local Micro Integrations:');
define( '_PAYPLAN_GENERAL_MICRO_INTEGRATIONS_PLAN_DESC', 'Select the Micro Integrations that you want to apply to the user with the plan. Instead of global instances, these MIs will be specific only to this payment plan.');
define( '_PAYPLAN_GENERAL_MICRO_INTEGRATIONS_INHERITED_NAME', 'Inherited:');
define( '_PAYPLAN_GENERAL_MICRO_INTEGRATIONS_INHERITED_DESC', 'Shows which Micro Integrations are inherited from parent groups that this plan is a member of.');

define( '_PAYPLAN_CURRENCY', 'Moeda');

// --== Group PAGE ==--

define( '_ITEMGROUPS_TITLE', 'Groups');
define( '_ITEMGROUP_NAME', 'Name');
define( '_ITEMGROUP_DESC', 'Description (first 50 chars)');
define( '_ITEMGROUP_ACTIVE', 'Published');
define( '_ITEMGROUP_VISIBLE', 'Visible');
define( '_ITEMGROUP_REORDER', 'Reorder');

define( '_PUBLISH_ITEMGROUP', 'Publish');
define( '_UNPUBLISH_ITEMGROUP', 'Unpublish');
define( '_NEW_ITEMGROUP', 'New');
define( '_COPY_ITEMGROUP', 'Copy');
define( '_APPLY_ITEMGROUP', 'Apply');
define( '_EDIT_ITEMGROUP', 'Edit');
define( '_REMOVE_ITEMGROUP', 'Delete');
define( '_SAVE_ITEMGROUP', 'Save');
define( '_CANCEL_ITEMGROUP', 'Cancel');

define( '_ITEMGROUP_DETAIL_TITLE', 'Group');
define( '_AEC_HEAD_ITEMGROUP_INFO', 'Group' );
define( '_ITEMGROUP_GENERAL_NAME_NAME', 'Name:');
define( '_ITEMGROUP_GENERAL_NAME_DESC', 'Name or title for this group. Max.: 40 characters.');
define( '_ITEMGROUP_GENERAL_DESC_NAME', 'Description:');
define( '_ITEMGROUP_GENERAL_DESC_DESC', 'Full description of group. Max.: 255 characters.');
define( '_ITEMGROUP_GENERAL_ACTIVE_NAME', 'Published:');
define( '_ITEMGROUP_GENERAL_ACTIVE_DESC', 'A published group will be available to the user on frontend.');
define( '_ITEMGROUP_GENERAL_VISIBLE_NAME', 'Visible:');
define( '_ITEMGROUP_GENERAL_VISIBLE_DESC', 'Visible Groups will show on the frontend.');
define( '_ITEMGROUP_GENERAL_COLOR_NAME', 'Color:');
define( '_ITEMGROUP_GENERAL_COLOR_DESC', 'The color marking of this group.');
define( '_ITEMGROUP_GENERAL_ICON_NAME', 'Icon:');
define( '_ITEMGROUP_GENERAL_ICON_DESC', 'The icon marking of this group.');

define( '_ITEMGROUP_GENERAL_REVEAL_CHILD_ITEMS_NAME', 'Reveal Child Items');
define( '_ITEMGROUP_GENERAL_REVEAL_CHILD_ITEMS_DESC', 'If you set this switch to "yes", the AEC will not show a group button (linking the user on to this contents of the group), but directly display the contents of this group in any parent group.');
define( '_ITEMGROUP_GENERAL_SYMLINK_NAME', 'Group Symlink');
define( '_ITEMGROUP_GENERAL_SYMLINK_DESC', 'Entering a link here will redirect a user to this link when selecting this group in the plans selection page. Overrides any linking to contents of this group!');

define( '_ITEMGROUP_GENERAL_NOTAUTH_REDIRECT_NAME', 'Denied Access Redirect');
define( '_ITEMGROUP_GENERAL_NOTAUTH_REDIRECT_DESC', 'Redirect to a different URL should the user follow a direct link to this item without having the right authorization.');
define( '_ITEMGROUP_GENERAL_MICRO_INTEGRATIONS_NAME', 'Micro Integrations');
define( '_ITEMGROUP_GENERAL_MICRO_INTEGRATIONS_DESC', 'Select which Micro Integrations you want to be attached to all child elements of this group.');

// Group Restrictions

define( '_ITEMGROUP_RESTRICTIONS_TITLE', 'Restrictions');

define( '_ITEMGROUP_RESTRICTIONS_MINGID_ENABLED_NAME', 'Enable Min GID:');
define( '_ITEMGROUP_RESTRICTIONS_MINGID_ENABLED_DESC', 'Enable this setting if you want to restrict whether a user is shown this group by a minimum usergroup.');
define( '_ITEMGROUP_RESTRICTIONS_MINGID_NAME', 'Visibility Group:');
define( '_ITEMGROUP_RESTRICTIONS_MINGID_DESC', 'The minimum user level required to see this group when building the payment plans page. New users will always see the group with the lowest gid available.');
define( '_ITEMGROUP_RESTRICTIONS_FIXGID_ENABLED_NAME', 'Enable Fixed GID:');
define( '_ITEMGROUP_RESTRICTIONS_FIXGID_ENABLED_DESC', 'Enable this setting if you want to restrict this group to one usergroup.');
define( '_ITEMGROUP_RESTRICTIONS_FIXGID_NAME', 'Set Group:');
define( '_ITEMGROUP_RESTRICTIONS_FIXGID_DESC', 'Only users with this usergroup can view this group.');
define( '_ITEMGROUP_RESTRICTIONS_MAXGID_ENABLED_NAME', 'Enable Max GID:');
define( '_ITEMGROUP_RESTRICTIONS_MAXGID_ENABLED_DESC', 'Enable this setting if you want to restrict whether a user is shown this grroup by a maximum usergroup.');
define( '_ITEMGROUP_RESTRICTIONS_MAXGID_NAME', 'Maximum Group:');
define( '_ITEMGROUP_RESTRICTIONS_MAXGID_DESC', 'The maximum user level a user can have to see this group when building the payment plans page.');

define( '_ITEMGROUP_RESTRICTIONS_PREVIOUSPLAN_REQ_ENABLED_NAME', 'Required Prev. Plan:');
define( '_ITEMGROUP_RESTRICTIONS_PREVIOUSPLAN_REQ_ENABLED_DESC', 'Enable checking for previous payment plan');
define( '_ITEMGROUP_RESTRICTIONS_PREVIOUSPLAN_REQ_NAME', 'Plan:');
define( '_ITEMGROUP_RESTRICTIONS_PREVIOUSPLAN_REQ_DESC', 'A user will only see this group if he or she used the selected plan before the one currently in use');
define( '_ITEMGROUP_RESTRICTIONS_CURRENTPLAN_REQ_ENABLED_NAME', 'Required Curr. Plan:');
define( '_ITEMGROUP_RESTRICTIONS_CURRENTPLAN_REQ_ENABLED_DESC', 'Enable checking for currently present payment plan');
define( '_ITEMGROUP_RESTRICTIONS_CURRENTPLAN_REQ_NAME', 'Plan:');
define( '_ITEMGROUP_RESTRICTIONS_CURRENTPLAN_REQ_DESC', 'A user will only see this group if he or she is currently assigned to, or has just expired from the plan selected here');
define( '_ITEMGROUP_RESTRICTIONS_OVERALLPLAN_REQ_ENABLED_NAME', 'Required Used Plan:');
define( '_ITEMGROUP_RESTRICTIONS_OVERALLPLAN_REQ_ENABLED_DESC', 'Enable checking for overall used payment plan');
define( '_ITEMGROUP_RESTRICTIONS_OVERALLPLAN_REQ_NAME', 'Plan:');
define( '_ITEMGROUP_RESTRICTIONS_OVERALLPLAN_REQ_DESC', 'A user will only see this plan if he or she has used the selected plan once, no matter when');

define( '_ITEMGROUP_RESTRICTIONS_PREVIOUSPLAN_REQ_ENABLED_EXCLUDED_NAME', 'Excluded Prev. Plan:');
define( '_ITEMGROUP_RESTRICTIONS_PREVIOUSPLAN_REQ_ENABLED_EXCLUDED_DESC', 'Do NOT show this group to users who had the selected plan as their previous payment plan');
define( '_ITEMGROUP_RESTRICTIONS_PREVIOUSPLAN_REQ_EXCLUDED_NAME', 'Plan:');
define( '_ITEMGROUP_RESTRICTIONS_PREVIOUSPLAN_REQ_EXCLUDED_DESC', 'A user will not see this group if he or she used the selected plan before the one currently in use');
define( '_ITEMGROUP_RESTRICTIONS_CURRENTPLAN_REQ_ENABLED_EXCLUDED_NAME', 'Excluded Curr. Plan:');
define( '_ITEMGROUP_RESTRICTIONS_CURRENTPLAN_REQ_ENABLED_EXCLUDED_DESC', 'Do NOT show this group to users who have the selected plan as their currently present payment plan');
define( '_ITEMGROUP_RESTRICTIONS_CURRENTPLAN_REQ_EXCLUDED_NAME', 'Plan:');
define( '_ITEMGROUP_RESTRICTIONS_CURRENTPLAN_REQ_EXCLUDED_DESC', 'A user will not see this group if he or she is currently assigned to, or has just expired from the plan selected here');
define( '_ITEMGROUP_RESTRICTIONS_OVERALLPLAN_REQ_ENABLED_EXCLUDED_NAME', 'Excluded Used Plan:');
define( '_ITEMGROUP_RESTRICTIONS_OVERALLPLAN_REQ_ENABLED_EXCLUDED_DESC', 'Do NOT show this group to users who have used the selected plan before');
define( '_ITEMGROUP_RESTRICTIONS_OVERALLPLAN_REQ_EXCLUDED_NAME', 'Plan:');
define( '_ITEMGROUP_RESTRICTIONS_OVERALLPLAN_REQ_EXCLUDED_DESC', 'A user will not see this group if he or she has used the selected plan once, no matter when');

define( '_ITEMGROUP_RESTRICTIONS_USED_PLAN_MIN_ENABLED_NAME', 'Min Used Plan:');
define( '_ITEMGROUP_RESTRICTIONS_USED_PLAN_MIN_ENABLED_DESC', 'Enable checking for the minimum number of times your consumers have subscribed to a specified payment plan in order to see this group');
define( '_ITEMGROUP_RESTRICTIONS_USED_PLAN_MIN_AMOUNT_NAME', 'Used Amount:');
define( '_ITEMGROUP_RESTRICTIONS_USED_PLAN_MIN_AMOUNT_DESC', 'The minimum amount a user has to have used the selected plan');
define( '_ITEMGROUP_RESTRICTIONS_USED_PLAN_MIN_NAME', 'Plan:');
define( '_ITEMGROUP_RESTRICTIONS_USED_PLAN_MIN_DESC', 'The payment plan that the user has to have used the specified number of times at least');
define( '_ITEMGROUP_RESTRICTIONS_USED_PLAN_MAX_ENABLED_NAME', 'Max Used Plan:');
define( '_ITEMGROUP_RESTRICTIONS_USED_PLAN_MAX_ENABLED_DESC', 'Enable checking for the maximum number of times your consumers have subscribed to a specified payment plan in order to see this group');
define( '_ITEMGROUP_RESTRICTIONS_USED_PLAN_MAX_AMOUNT_NAME', 'Used Amount:');
define( '_ITEMGROUP_RESTRICTIONS_USED_PLAN_MAX_AMOUNT_DESC', 'The maximum amount a user can have used the selected plan');
define( '_ITEMGROUP_RESTRICTIONS_USED_PLAN_MAX_NAME', 'Plan:');
define( '_ITEMGROUP_RESTRICTIONS_USED_PLAN_MAX_DESC', 'The payment plan that the user has to have used the specified number of times at most');

define( '_ITEMGROUP_RESTRICTIONS_PREVIOUSGROUP_REQ_ENABLED_NAME', 'Required Prev. Group:');
define( '_ITEMGROUP_RESTRICTIONS_PREVIOUSGROUP_REQ_ENABLED_DESC', 'Enable checking for a previous payment plan in this group');
define( '_ITEMGROUP_RESTRICTIONS_PREVIOUSGROUP_REQ_NAME', 'Group:');
define( '_ITEMGROUP_RESTRICTIONS_PREVIOUSGROUP_REQ_DESC', 'A user will only see this group if he or she used a plan in the selected group before the plan currently in use');
define( '_ITEMGROUP_RESTRICTIONS_CURRENTGROUP_REQ_ENABLED_NAME', 'Required Curr. Group:');
define( '_ITEMGROUP_RESTRICTIONS_CURRENTGROUP_REQ_ENABLED_DESC', 'Enable checking for currently present payment plan in this group');
define( '_ITEMGROUP_RESTRICTIONS_CURRENTGROUP_REQ_NAME', 'Group:');
define( '_ITEMGROUP_RESTRICTIONS_CURRENTGROUP_REQ_DESC', 'A user will only see this group if he or she is currently assigned to, or has just expired from a plan in the group selected here');
define( '_ITEMGROUP_RESTRICTIONS_OVERALLGROUP_REQ_ENABLED_NAME', 'Required Used Group:');
define( '_ITEMGROUP_RESTRICTIONS_OVERALLGROUP_REQ_ENABLED_DESC', 'Enable checking for overall used payment plan in this group');
define( '_ITEMGROUP_RESTRICTIONS_OVERALLGROUP_REQ_NAME', 'Group:');
define( '_ITEMGROUP_RESTRICTIONS_OVERALLGROUP_REQ_DESC', 'A user will only see this group if he or she has used a plan in the selected group once, no matter when');

define( '_ITEMGROUP_RESTRICTIONS_PREVIOUSGROUP_REQ_ENABLED_EXCLUDED_NAME', 'Excluded Prev. Group:');
define( '_ITEMGROUP_RESTRICTIONS_PREVIOUSGROUP_REQ_ENABLED_EXCLUDED_DESC', 'Do NOT show this group to users who had a plan in the selected group as their previous payment plan');
define( '_ITEMGROUP_RESTRICTIONS_PREVIOUSGROUP_REQ_EXCLUDED_NAME', 'Group:');
define( '_ITEMGROUP_RESTRICTIONS_PREVIOUSGROUP_REQ_EXCLUDED_DESC', 'A user will not see this group if he or she used a plan in the selected group before the one currently in use');
define( '_ITEMGROUP_RESTRICTIONS_CURRENTGROUP_REQ_ENABLED_EXCLUDED_NAME', 'Excluded Curr. Group:');
define( '_ITEMGROUP_RESTRICTIONS_CURRENTGROUP_REQ_ENABLED_EXCLUDED_DESC', 'Do NOT show this group to users who have a plan in the selected group as their currently present payment plan');
define( '_ITEMGROUP_RESTRICTIONS_CURRENTGROUP_REQ_EXCLUDED_NAME', 'Group:');
define( '_ITEMGROUP_RESTRICTIONS_CURRENTGROUP_REQ_EXCLUDED_DESC', 'A user will not see this group if he or she is currently assigned to, or has just expired from a plan in the selected group');
define( '_ITEMGROUP_RESTRICTIONS_OVERALLGROUP_REQ_ENABLED_EXCLUDED_NAME', 'Excluded Used Group:');
define( '_ITEMGROUP_RESTRICTIONS_OVERALLGROUP_REQ_ENABLED_EXCLUDED_DESC', 'Do NOT show this group to users who have used the a plan in the selected group before');
define( '_ITEMGROUP_RESTRICTIONS_OVERALLGROUP_REQ_EXCLUDED_NAME', 'Group:');
define( '_ITEMGROUP_RESTRICTIONS_OVERALLGROUP_REQ_EXCLUDED_DESC', 'A user will not see this group if he or she has used a plan in the selected group once, no matter when');

define( '_ITEMGROUP_RESTRICTIONS_USED_GROUP_MIN_ENABLED_NAME', 'Min Used Group:');
define( '_ITEMGROUP_RESTRICTIONS_USED_GROUP_MIN_ENABLED_DESC', 'Enable checking for the minimum number of times your users have subscribed to a payment plan in the selected group in order to see THIS group');
define( '_ITEMGROUP_RESTRICTIONS_USED_GROUP_MIN_AMOUNT_NAME', 'Used Amount:');
define( '_ITEMGROUP_RESTRICTIONS_USED_GROUP_MIN_AMOUNT_DESC', 'The minimum amount a user has to have used the a plan in the selected group');
define( '_ITEMGROUP_RESTRICTIONS_USED_GROUP_MIN_NAME', 'Group:');
define( '_ITEMGROUP_RESTRICTIONS_USED_GROUP_MIN_DESC', 'The group that the user has to have used a plan from - the specified number of times at least');
define( '_ITEMGROUP_RESTRICTIONS_USED_GROUP_MAX_ENABLED_NAME', 'Max Used Group:');
define( '_ITEMGROUP_RESTRICTIONS_USED_GROUP_MAX_ENABLED_DESC', 'Enable checking for the maximum number of times your users may have subscribed to a payment plan in the selected group in order to see THIS group');
define( '_ITEMGROUP_RESTRICTIONS_USED_GROUP_MAX_AMOUNT_NAME', 'Used Amount:');
define( '_ITEMGROUP_RESTRICTIONS_USED_GROUP_MAX_AMOUNT_DESC', 'The maximum amount a user can have used a plan in the selected group');
define( '_ITEMGROUP_RESTRICTIONS_USED_GROUP_MAX_NAME', 'Group:');
define( '_ITEMGROUP_RESTRICTIONS_USED_GROUP_MAX_DESC', 'The group that the user has to have used a plan from - the specified number of times at most');

define( '_ITEMGROUP_RESTRICTIONS_CUSTOM_RESTRICTIONS_ENABLED_NAME', 'Use Custom Restrictions:');
define( '_ITEMGROUP_RESTRICTIONS_CUSTOM_RESTRICTIONS_ENABLED_DESC', 'Enable the use of the below specified restrictions');
define( '_ITEMGROUP_RESTRICTIONS_CUSTOM_RESTRICTIONS_NAME', 'Custom Restrictions:');
define( '_ITEMGROUP_RESTRICTIONS_CUSTOM_RESTRICTIONS_DESC', 'Use RewriteEngine fields to check for specific strings in this form:<br />[[user_id]] >= 1500<br />[[parametername]] = value<br />(Create separate rules by entering a new line).<br />You can use =, <=, >=, <, >, <> as comparing elements. You MUST use spaces between parameters, values and comparators!');

// Group Relations

define( '_ITEMGROUP_RELATIONS_TITLE', 'Relations');
define( '_ITEMGROUP_PARAMS_SIMILARITEMGROUPS_NAME', 'Similar Groups:');
define( '_ITEMGROUP_PARAMS_SIMILARITEMGROUPS_DESC', 'Select which groups are similar to this one. A user is not allowed to use a Trial period when buying a plan that he or she has purchased before and this will also be the same for similar plans (or plans in similar groups).');
define( '_ITEMGROUP_PARAMS_EQUALITEMGROUPS_NAME', 'Equal Groups:');
define( '_ITEMGROUP_PARAMS_EQUALITEMGROUPS_DESC', 'Select which groups are equal to this one. A user switching between equal plans (or plans in equal groups) will have his or her period extended instead of reset. Trials are also not permitted (see similar groups info).');

// Currencies

define( '_CURRENCY_AFA', 'Afeg&atilde;');
define( '_CURRENCY_ALL', 'Lek');
define( '_CURRENCY_DZD', 'Dinar Argelino');
define( '_CURRENCY_ADP', 'Peseta');
define( '_CURRENCY_AON', 'Novo Kwanza');
define( '_CURRENCY_ARS', 'Peso Argentina');
define( '_CURRENCY_AMD', 'Dram Arm&ecirc;nio');
define( '_CURRENCY_AWG', 'Aruban Guilder');
define( '_CURRENCY_AUD', 'D&oacute;lar Australiano');
define( '_CURRENCY_AZM', 'Mant Azerbeij&atilde;o ');
define( '_CURRENCY_EUR', 'Euro');
define( '_CURRENCY_BSD', 'D&oacute;lar Bahamas');
define( '_CURRENCY_BHD', 'Dinar Bahraini');
define( '_CURRENCY_BDT', 'Taka');
define( '_CURRENCY_BBD', 'D&oacute;lar Barbados');
define( '_CURRENCY_BYB', 'Ruble Bielorussia');
define( '_CURRENCY_BEF', 'Belgian Franc');
define( '_CURRENCY_BZD', 'D&oacute;lar Belize');
define( '_CURRENCY_BMD', 'D&oacute;lar Bermudas');
define( '_CURRENCY_BOB', 'Boliviano');
define( '_CURRENCY_BAD', 'Dinar Bosnio');
define( '_CURRENCY_BWP', 'Pula');
define( '_CURRENCY_BRL', 'Real');
define( '_CURRENCY_BND', 'D&oacute;lar Brunei');
define( '_CURRENCY_BGL', 'Lev');
define( '_CURRENCY_BGN', 'Lev');
define( '_CURRENCY_XOF', 'Africano Ocidental CFA');
define( '_CURRENCY_BIF', 'Franco Burundi');
define( '_CURRENCY_KHR', 'Riel Camboja');
define( '_CURRENCY_XAF', 'Africano Central CFA');
define( '_CURRENCY_CAD', 'D&oacute;lar Canadiano');
define( '_CURRENCY_CVE', 'Escudo Cavo Verde');
define( '_CURRENCY_KYD', 'Dollar Ilhas Caim&atilde;o');
define( '_CURRENCY_CLP', 'Peso Chileno');
define( '_CURRENCY_CNY', 'Yuan Renminbi');
define( '_CURRENCY_COP', 'Peso Colombiano');
define( '_CURRENCY_KMF', 'Franco Comoro');
define( '_CURRENCY_BAM', 'Convertible Marks');
define( '_CURRENCY_CRC', 'Colon Costa Rica');
define( '_CURRENCY_HRK', 'Kuna Croacia');
define( '_CURRENCY_CUP', 'Peso Cubano');
define( '_CURRENCY_CYP', 'Libra Chipre');
define( '_CURRENCY_CZK', 'Koruna Checa');
define( '_CURRENCY_DKK', 'Krone Dinamarqu&ecirc;s');
define( '_CURRENCY_DEM', 'Deutsche Mark');
define( '_CURRENCY_DJF', 'Franco Djibouti');
define( '_CURRENCY_XCD', 'D&oacute;lar Caraibas Oriente');
define( '_CURRENCY_DOP', 'Peso Dominicano');
define( '_CURRENCY_GRD', 'Drachma');
define( '_CURRENCY_TPE', 'Escudo Timor');
define( '_CURRENCY_ECS', 'Sucre Equador');
define( '_CURRENCY_EGP', 'Libra Egipcio');
define( '_CURRENCY_SVC', 'Colon El Salvador');
define( '_CURRENCY_EEK', 'Kroon');
define( '_CURRENCY_ETB', 'Birr Etiope');
define( '_CURRENCY_FKP', 'Libra Ilhas Falkland');
define( '_CURRENCY_FJD', 'D&oacute;lar Fiji');
define( '_CURRENCY_XPF', 'Franco CFP');
define( '_CURRENCY_FRF', 'Franco');
define( '_CURRENCY_CDF', 'Franco Congol&ecirc;s');
define( '_CURRENCY_GMD', 'Dalasi');
define( '_CURRENCY_GHC', 'Cedi');
define( '_CURRENCY_GIP', 'Libra Gibraltar');
define( '_CURRENCY_GTQ', 'Quetzal');
define( '_CURRENCY_GNF', 'Franco Guinense');
define( '_CURRENCY_GWP', 'Peso Guinea - Bissau');
define( '_CURRENCY_GYD', 'D&oacute;lar Guiana');
define( '_CURRENCY_HTG', 'Gourde');
define( '_CURRENCY_XAU', 'Gold');
define( '_CURRENCY_HNL', 'Lempira');
define( '_CURRENCY_HKD', 'D&oacute;lar Hong Kong');
define( '_CURRENCY_HUF', 'Forint');
define( '_CURRENCY_ISK', 'Krona Islandia');
define( '_CURRENCY_INR', 'R&uacute;pia Indiana');
define( '_CURRENCY_IDR', 'Rupia');
define( '_CURRENCY_IRR', 'Rial Iraniano');
define( '_CURRENCY_IQD', 'Dinar Iraquiano');
define( '_CURRENCY_IEP', 'Libra Ga&eacute;lico');
define( '_CURRENCY_ITL', 'Lira Italiana');
define( '_CURRENCY_ILS', 'Shekel');
define( '_CURRENCY_JMD', 'D&oacute;lar Jamaicano');
define( '_CURRENCY_JPY', 'Iene Jap&atilde;o');
define( '_CURRENCY_JOD', 'Dinar Jordana');
define( '_CURRENCY_KZT', 'Tenge');
define( '_CURRENCY_KES', 'Xelim Queniano');
define( '_CURRENCY_KRW', 'Won');
define( '_CURRENCY_KPW', 'Won Norte Coreano');
define( '_CURRENCY_KWD', 'Dinar Kuwati');
define( '_CURRENCY_KGS', 'Som');
define( '_CURRENCY_LAK', 'Kip');
define( '_CURRENCY_GEL', 'Lari');
define( '_CURRENCY_LVL', 'Lats Let&atilde;o');
define( '_CURRENCY_LBP', 'Libra Libanesa');
define( '_CURRENCY_LSL', 'Loti');
define( '_CURRENCY_LRD', 'D&oacute;lar Liberiano');
define( '_CURRENCY_LYD', 'Dinar L&iacute;bio');
define( '_CURRENCY_LTL', 'Litas Lituano');
define( '_CURRENCY_LUF', 'Luxembourg Franc');
define( '_CURRENCY_AOR', 'Kwanza Reajustado');
define( '_CURRENCY_MOP', 'Pataca');
define( '_CURRENCY_MKD', 'Dinar');
define( '_CURRENCY_MGF', 'Franco Malgaxe');
define( '_CURRENCY_MWK', 'Kwacha');
define( '_CURRENCY_MYR', 'Ringitt Malaio');
define( '_CURRENCY_MVR', 'Rufiyaa');
define( '_CURRENCY_MTL', 'Lira Maltesa');
define( '_CURRENCY_MRO', 'Ouguiya');
define( '_CURRENCY_TMM', 'Manat');
define( '_CURRENCY_FIM', 'Markka');
define( '_CURRENCY_MUR', 'Rupias Maur&iacute;cio');
define( '_CURRENCY_MXN', 'Peso M&eacute;xico');
define( '_CURRENCY_MXV', 'unidade de Invers&atilde;o Mexicana');
define( '_CURRENCY_MNT', 'Tugrik Mong&oacute;lia');
define( '_CURRENCY_MAD', 'Dirham Marroquino');
define( '_CURRENCY_MDL', 'Leu Moldavo');
define( '_CURRENCY_MZM', 'Metical');
define( '_CURRENCY_BOV', 'Mvdol');
define( '_CURRENCY_MMK', 'Myanmar Kyat');
define( '_CURRENCY_ERN', 'Nakfa');
define( '_CURRENCY_NAD', 'D&oacute;lar Nam&iacute;bia');
define( '_CURRENCY_NPR', 'Rupia Nepalesa');
define( '_CURRENCY_ANG', 'Netherlands Antilles Guilder');
define( '_CURRENCY_NLG', 'Netherlands Guilder');
define( '_CURRENCY_NZD', 'D&oacute;lar Neozeland&ecirc;s');
define( '_CURRENCY_NIO', 'Cordoba Oro');
define( '_CURRENCY_NGN', 'Naira');
define( '_CURRENCY_BTN', 'Ngultrum');
define( '_CURRENCY_NOK', 'Norwegian Krone');
define( '_CURRENCY_OMR', 'Rial Om&atilde;');
define( '_CURRENCY_PKR', 'Rupia Paquistanesa');
define( '_CURRENCY_PAB', 'Balboa');
define( '_CURRENCY_PGK', 'kina Nova Guine');
define( '_CURRENCY_PYG', 'Guarani');
define( '_CURRENCY_PEN', 'Novo Sol');
define( '_CURRENCY_XPD', 'Palladium');
define( '_CURRENCY_PHP', 'Peso Filipino');
define( '_CURRENCY_XPT', 'Platina');
define( '_CURRENCY_PTE', 'Portuguese Escudo');
define( '_CURRENCY_PLN', 'New Zloty');
define( '_CURRENCY_QAR', 'Qatari Rial');
define( '_CURRENCY_ROL', 'Leu Romeno');
define( '_CURRENCY_RON', 'Leu Nova Romenia');
define( '_CURRENCY_RSD', 'Serbian dinar');
define( '_CURRENCY_RUB', 'Rublo Russo');
define( '_CURRENCY_RWF', 'Franco Ruanda');
define( '_CURRENCY_WST', 'Tala');
define( '_CURRENCY_STD', 'Dobra');
define( '_CURRENCY_SAR', 'Riyal Saudi');
define( '_CURRENCY_SCR', 'Rupias Seychelles');
define( '_CURRENCY_SLL', 'Leone');
define( '_CURRENCY_SGD', 'D&oacute;ar Singapura');
define( '_CURRENCY_SKK', 'Coroa Eslovaca');
define( '_CURRENCY_SIT', 'Tolar');
define( '_CURRENCY_SBD', 'D&oacute;lar Ilhas Salom&atilde;o');
define( '_CURRENCY_SOS', 'Xelim Som&aacute;lia');
define( '_CURRENCY_ZAL', 'Rand (Financeiro)');
define( '_CURRENCY_ZAR', 'Rand Africa do Sul');
define( '_CURRENCY_ATS', 'Xelim');
define( '_CURRENCY_XAG', 'Prata');
define( '_CURRENCY_ESP', 'Spanish Peseta');
define( '_CURRENCY_LKR', 'Rupia Sri Lanka');
define( '_CURRENCY_SHP', 'Libra St Helena');
define( '_CURRENCY_SDP', 'Libra Sudanesa');
define( '_CURRENCY_SDD', 'Dinar Sudanes');
define( '_CURRENCY_SRG', 'Suriname Guilder');
define( '_CURRENCY_SZL', 'Lilangeni Suazil&acirc;ndia');
define( '_CURRENCY_SEK', 'Sweden Krona');
define( '_CURRENCY_CHF', 'Franco Sui&ccedil;o');
define( '_CURRENCY_SYP', 'Libra Siria');
define( '_CURRENCY_TWD', 'D&oacute;lar nova Tail&atilde;ndia');
define( '_CURRENCY_TJR', 'Rublo Tajik');
define( '_CURRENCY_TZS', 'Xelim Tanzania');
define( '_CURRENCY_TRL', 'Lira Turca');
define( '_CURRENCY_THB', 'Baht');
define( '_CURRENCY_TOP', 'Tonga Pa\'anga');
define( '_CURRENCY_TTD', 'D&oacute;lar Trinidade &amp; Tobago');
define( '_CURRENCY_TND', 'Dinar Tunisino');
define( '_CURRENCY_UGX', 'Xelim Uganda');
define( '_CURRENCY_UAH', 'Hryvnia da Ucr&acirc;nia');
define( '_CURRENCY_ECV', 'Unidade de Valor Constante');
define( '_CURRENCY_CLF', 'Unidades de fomento');
define( '_CURRENCY_AED', 'Dinar Emirados Arabes Unidos');
define( '_CURRENCY_GBP', 'Libras Sterling');
define( '_CURRENCY_USD', 'D&oacute;lar Americano');
define( '_CURRENCY_UYU', 'Peso Uraguai');
define( '_CURRENCY_UZS', 'Soma Uzbequist&atilde;o');
define( '_CURRENCY_VUV', 'Vatu Vanuatu');
define( '_CURRENCY_VND', 'Dong Vietnamita');
define( '_CURRENCY_YER', 'Rial Iemenita');
define( '_CURRENCY_YUM', 'Novo Dinar Yugoslavian');
define( '_CURRENCY_ZRN', 'Novo Zaire');
define( '_CURRENCY_ZMK', 'Kwacha Zambiano');
define( '_CURRENCY_ZWD', 'D&oacute;lar Zimbabue');
define( '_CURRENCY_USN', 'D&oacute;lar Americano (Dia seguinte)');
define( '_CURRENCY_USS', 'D&oacute;lar Americano (Mesmo Dia)');

// --== MICRO INTEGRATION OVERVIEW ==--
define( '_MI_TITLE', 'Micro Integra&ccedil;&otilde;es');
define( '_MI_NAME', 'Nome');
define( '_MI_DESC', 'Descri&ccedil;&atilde;o');
define( '_MI_ACTIVE', 'Activo');
define( '_MI_REORDER', 'Pedido');
define( '_MI_FUNCTION', 'Nome da Fun&ccedil;&atilde;o');

// --== MICRO INTEGRATION EDIT ==--
define( '_MI_E_TITLE', 'MI');
define( '_MI_E_TITLE_LONG', 'Micro Integra&ccedil;&atilde;o');
define( '_MI_E_SETTINGS', 'Defini&ccedil;&otilde;es');
define( '_MI_E_NAME_NAME', 'Nome');
define( '_MI_E_NAME_DESC', 'Escolha um nome para esta Micro Integra&ccedil;&atilde;o');
define( '_MI_E_DESC_NAME', 'Descri&ccedil;&atilde;o');
define( '_MI_E_DESC_DESC', 'Breve Descri&ccedil;&atilde;o da Integra&ccedil;&atilde;o');
define( '_MI_E_ACTIVE_NAME', 'Activar');
define( '_MI_E_ACTIVE_DESC', 'Definir a integra&ccedil;&atilde;o a activar');
define( '_MI_E_AUTO_CHECK_NAME', 'Ac&ccedil;&atilde;o de Expira&ccedil;&atilde;o');
define( '_MI_E_AUTO_CHECK_DESC', 'Se a fun&ccedil;&atilde;o o permitir, pode activar a op&ccedil;&atilde;o de expira&ccedil;&atilde;o: ac&ccedil;&otilde;es que devem ser tomadas quando um utilizador expira (se suportado pelo MI).');
define( '_MI_E_ON_USERCHANGE_NAME', 'User Account Update Action');
define( '_MI_E_ON_USERCHANGE_DESC', 'If the function allows this, you can enable actions that happen when a user account is being changed (if supported by the MI).');
define( '_MI_E_PRE_EXP_CHECK_NAME', 'Pre Expira&ccedil;&atilde;o');
define( '_MI_E_PRE_EXP_CHECK_DESC', 'Definir n&uacute;mero de dias antes da expira&ccedil;&atilde;o quando uma ac&ccedil;&atilde;o pre-expira&ccedil;&atilde;o deve ser tomada (se suportada pelo MI).');
define( '_MI_E__AEC_GLOBAL_EXP_ALL_NAME', 'Expire all instances');
define( '_MI_E__AEC_GLOBAL_EXP_ALL_DESC', 'Trigger the expiration action even if the user has another payment plan with this MI attached. The standard behavior is to call the expiration action on an MI only when it really is the last MI instance that this user has in all payment plans.');
define( '_MI_E_FUNCTION_NAME', 'Nome da Fun&ccedil;&atilde;o');
define( '_MI_E_FUNCTION_DESC', 'Please choose which of these integrations should be used');
define( '_MI_E_FUNCTION_EXPLANATION', 'Before you can setup the Micro Integration, you have to select which of the integration files we should use for this. Make a selection and save the Micro Integration. When you edit it again, you will be able to set the parameters. Note also, that the function name cannot be changed once its set.');

// --== REWRITE EXPLANATION ==--
define( '_REWRITE_AREA_USER', 'User Account Related');
define( '_REWRITE_KEY_USER_ID', 'User Account ID');
define( '_REWRITE_KEY_USER_USERNAME', 'Username');
define( '_REWRITE_KEY_USER_NAME', 'Nome');
define( '_REWRITE_KEY_USER_FIRST_NAME', 'Primeiro Nome');
define( '_REWRITE_KEY_USER_FIRST_FIRST_NAME', 'Primeiro Primeiro Nome');
define( '_REWRITE_KEY_USER_LAST_NAME', '&Uacute;ltimo Nome');
define( '_REWRITE_KEY_USER_EMAIL', 'Endere&ccedil;o de E-Mail');
define( '_REWRITE_KEY_USER_ACTIVATIONCODE', 'C&oacute;digo de Activa&ccedil;&atilde;o');
define( '_REWRITE_KEY_USER_ACTIVATIONLINK', 'Link de Activa&ccedil;&atilde;o');

define( '_REWRITE_AREA_SUBSCRIPTION', 'Subscri&ccedil;&otilde;es de Utilizador Relacionadas');
define( '_REWRITE_KEY_SUBSCRIPTION_TYPE', 'Processador de Pagamento');
define( '_REWRITE_KEY_SUBSCRIPTION_STATUS', 'Estado da Inscri&ccedil;&atilde;o');
define( '_REWRITE_KEY_SUBSCRIPTION_SIGNUP_DATE', 'Data de realiza&ccedil;&atilde;o da Inscri&ccedil;&atilde;o');
define( '_REWRITE_KEY_SUBSCRIPTION_LASTPAY_DATE', 'Data &Uacute;ltimo pagamento');
define( '_REWRITE_KEY_SUBSCRIPTION_PLAN', 'ID Planos de Pagamento');
define( '_REWRITE_KEY_SUBSCRIPTION_PREVIOUS_PLAN', 'ID Planos de Pagamentos Anteriores');
define( '_REWRITE_KEY_SUBSCRIPTION_RECURRING', 'Bandeira Pagamentos Recurrentes');
define( '_REWRITE_KEY_SUBSCRIPTION_LIFETIME', 'Bandeira Validade Subscri&ccedil;&atilde;o');
define( '_REWRITE_KEY_SUBSCRIPTION_EXPIRATION_DATE', 'Data de Expira&ccedil;&atilde;o (Formato Pagina Principal)');
define( '_REWRITE_KEY_SUBSCRIPTION_EXPIRATION_DATE_BACKEND', 'Data de Expira&ccedil;&atilde;o (Formato Backend)');

define( '_REWRITE_AREA_PLAN', 'Planos de Pagamento Relacionados');
define( '_REWRITE_KEY_PLAN_NAME', 'Nome');
define( '_REWRITE_KEY_PLAN_DESC', 'Descri&ccedil;&atilde;o');

define( '_REWRITE_AREA_CMS', 'CMS Relacionados');
define( '_REWRITE_KEY_CMS_ABSOLUTE_PATH', 'Caminho Absoluto para a directoria do CMS');
define( '_REWRITE_KEY_CMS_LIVE_SITE', 'URL do seu Site');

define( '_REWRITE_AREA_SYSTEM', 'Sistemas Relacionados');
define( '_REWRITE_KEY_SYSTEM_TIMESTAMP', 'Tempo (Formato Pagina Principal)');
define( '_REWRITE_KEY_SYSTEM_TIMESTAMP_BACKEND', 'Tempo (Formato Backend)');
define( '_REWRITE_KEY_SYSTEM_SERVER_TIMESTAMP', 'Tempo do Servidor (Formato Pagina Principal)');
define( '_REWRITE_KEY_SYSTEM_SERVER_TIMESTAMP_BACKEND', 'Tempo do Servidor (Formato Backend)');

define( '_REWRITE_AREA_INVOICE', 'Facturas Relacionadas');
define( '_REWRITE_KEY_INVOICE_ID', 'ID Factura');
define( '_REWRITE_KEY_INVOICE_NUMBER', 'N&uacute;mero de Factura');
define( '_REWRITE_KEY_INVOICE_NUMBER_FORMAT', 'N&uacute;mero de Factura (formatado)');
define( '_REWRITE_KEY_INVOICE_CREATED_DATE', 'Data de Cria&ccedil;&atilde;o');
define( '_REWRITE_KEY_INVOICE_TRANSACTION_DATE', 'Data da Transa&ccedil;&atilde;o');
define( '_REWRITE_KEY_INVOICE_METHOD', 'Metedo de Pagamento');
define( '_REWRITE_KEY_INVOICE_AMOUNT', 'Valor Pago');
define( '_REWRITE_KEY_INVOICE_CURRENCY', 'Moeda');
define( '_REWRITE_KEY_INVOICE_COUPONS', 'Lista de Cup&otilde;es');

define( '_REWRITE_ENGINE_TITLE', 'Motor Rewrite');
define( '_REWRITE_ENGINE_DESC', 'Para criar textos din&aacute;micos, voc&ecirc; pode adicoar este abas estilo wiki noRWengine-activar campos. Atr&aacute;ves das op&ccedil;&otilde;es seguintes para verificar quais tags est&atilde;o dispon&iacute;veis');
define( '_REWRITE_ENGINE_AECJSON_TITLE', 'aecJSON');
define( '_REWRITE_ENGINE_AECJSON_DESC', 'Voc&ecirc; tamb&eacute;m pode usar estas fun&ccedil;&otilde;es para codificar no JSON, tal como:<br />{aecjson} { &quot;cmd&quot;:&quot;date&quot;, &quot;vars&quot;: [ &quot;Y&quot;, { &quot;cmd&quot;:&quot;rw_constant&quot;, &quot;vars&quot;:&quot;invoice_created_date&quot; } ] } {/aecjson}Retorna apenas o ano de uma data. Veja o manual e o f&oacute;runs para mias instru&ccedil;&otilde;esI!');

// --== COUPONS OVERVIEW ==--
define( '_COUPON_TITLE', 'Cup&otilde;es');
define( '_COUPON_TITLE_STATIC', 'Cup&otilde;es Est&aacute;ticos');
define( '_COUPON_NAME', 'Nome');
define( '_COUPON_DESC', 'Descri&ccedil;&atilde;o (primeiros 50 caracteres)');
define( '_COUPON_ACTIVE', 'Publicado');
define( '_COUPON_REORDER', 'Reordenar');
define( '_COUPON_USECOUNT', 'Contador');

// --== INVOICE OVERVIEW ==--
define( '_INVOICE_TITLE', 'Facturas');
define( '_INVOICE_SEARCH', 'Pesquisa');
define( '_INVOICE_USERID', 'Nome de Utilizador');
define( '_INVOICE_INVOICE_NUMBER', 'Invoice Number');
define( '_INVOICE_SECONDARY_IDENT', 'identifica&ccedil;&atilde;o Secund&aacute;ria');
define( '_INVOICE_TRANSACTION_DATE', 'Data de Transa&ccedil;&atilde;o');
define( '_INVOICE_METHOD', 'Metedo');
define( '_INVOICE_AMOUNT', 'Valor');
define( '_INVOICE_CURRENCY', 'Moeda');
define( '_INVOICE_COUPONS', 'Coupons');

// --== PAYMENT HISTORY OVERVIEW ==--
define( '_HISTORY_TITLE2', 'Hist&oacute;rico Curente de Transa&ccedil;&otilde;es');
define( '_HISTORY_SEARCH', 'Pesquisa');
define( '_HISTORY_USERID', 'Nome de Utilizador');
define( '_HISTORY_INVOICE_NUMBER', 'N&uacute;mero de Factura');
define( '_HISTORY_PLAN_NAME', 'Plano Subscrito para');
define( '_HISTORY_TRANSACTION_DATE', 'Data de Transa&ccedil;&atilde;o');
define( '_INVOICE_CREATED_DATE', 'Data de Cria&ccedil;&atilde;o');
define( '_HISTORY_METHOD', 'Metedo Factura');
define( '_HISTORY_AMOUNT', 'Valor da Factura');
define( '_HISTORY_RESPONSE', 'Resposta do Servidor');

// --== ALL USER RELATED PAGES ==--
define( '_METHOD', 'Metodo');

// --== PENDING PAGE ==--
define( '_PEND_DATE', 'Pendente Desde');
define( '_PEND_TITLE', 'Inscri&ccedil;&otilde;es Pendentes');
define( '_PEND_DESC', 'Inscri&ccedil;&otilde;es que ainda n&atilde;o completaram o processo. Isso&eacute; comum por um curto per&iacute;odo de tempo enquanto o sistema aguarda a notificac&atilde;o do PayPal (IPN).');
define( '_ACTIVATE', 'Activar');
define( '_ACTIVATED', 'Utilizador Activado.');

// --== EXPORT ==--
define( '_AEC_HEAD_EXPORT', 'Exportar');
define( '_EXPORT_LOAD', 'Carregar');
define( '_EXPORT_APPLY', 'Aplicar');
define( '_EXPORT_GENERAL_SELECTED_EXPORT_NAME', 'Exportar predefini&ccedil;&atilde;o');
define( '_EXPORT_GENERAL_SELECTED_EXPORT_DESC', 'Selecione uma predefini&ccedil;&atilde;o ( ou umas guardada anteriormente)em vez de realizar a selec&ccedil;&otilde;es seguintes. Pode tamb&eacute;m clicar em Aplicar no canto superior direito e visualizar a predefini&ccedil;&atilde;o.');
define( '_EXPORT_GENERAL_DELETE_NAME', 'Apagar');
define( '_EXPORT_GENERAL_DELETE_DESC', 'Eliminar (quando aplicar)');
define( '_EXPORT_PARAMS_PLANID_NAME', 'Plano de Pagamentos');
define( '_EXPORT_PARAMS_PLANID_DESC', 'Filtrar subscri&ccedil;&otilde;es com este plano de Pagamentos');
define( '_EXPORT_PARAMS_STATUS_NAME', 'Estado');
define( '_EXPORT_PARAMS_STATUS_DESC', 'Exportar apenas subscri&ccedil;&otilde;es com este estado');
define( '_EXPORT_PARAMS_ORDERBY_NAME', 'Ordenar por');
define( '_EXPORT_PARAMS_ORDERBY_DESC', 'Ordenar por um dos seguintes');
define( '_EXPORT_PARAMS_REWRITE_RULE_NAME', 'Campos');
define( '_EXPORT_PARAMS_REWRITE_RULE_DESC', 'Coloque nos campos ReWrite Engine, separados por ponto e v&iacute;rgula.');
define( '_EXPORT_PARAMS_SAVE_NAME', 'Guardar como Novo?');
define( '_EXPORT_PARAMS_SAVE_DESC', 'Selecione esta caixa para guardar as suas configura&ccedil;&otilde;es como uma nova configura&ccedil;&atilde;o');
define( '_EXPORT_PARAMS_SAVE_NAME_NAME', 'Guardar Nome');
define( '_EXPORT_PARAMS_SAVE_NAME_DESC', 'Guardar novo neste nome');
define( '_EXPORT_PARAMS_EXPORT_METHOD_NAME', 'Metodo de Exportac&atilde;o');
define( '_EXPORT_PARAMS_EXPORT_METHOD_DESC', 'O tipo de ficheiro que pretende exportar');

// --== READOUT ==--
define( '_AEC_READOUT', 'AEC Readout');
define( '_READOUT_GENERAL_SHOW_SETTINGS_NAME', 'Settings');
define( '_READOUT_GENERAL_SHOW_SETTINGS_DESC', 'Display AEC System Settings on the Readout');
define( '_READOUT_GENERAL_SHOW_EXTSETTINGS_NAME', 'Extended Settings');
define( '_READOUT_GENERAL_SHOW_EXTSETTINGS_DESC', 'Display extended AEC System Settings on the Readout');
define( '_READOUT_GENERAL_SHOW_PROCESSORS_NAME', 'Processor Settings');
define( '_READOUT_GENERAL_SHOW_PROCESSORS_DESC', 'Display Processor Settings on the Readout');
define( '_READOUT_GENERAL_SHOW_PLANS_NAME', 'Plans');
define( '_READOUT_GENERAL_SHOW_PLANS_DESC', 'Display Plans on the Readout');
define( '_READOUT_GENERAL_SHOW_MI_RELATIONS_NAME', 'Plan -> MI Relations');
define( '_READOUT_GENERAL_SHOW_MI_RELATIONS_DESC', 'Display Plan -> MI Relations on the Readout');
define( '_READOUT_GENERAL_SHOW_MIS_NAME', 'Micro Integrations');
define( '_READOUT_GENERAL_SHOW_MIS_DESC', 'Display Micro Integrations and their Settings on the Readout');
define( '_READOUT_GENERAL_STORE_SETTINGS_NAME', 'Remember Settings');
define( '_READOUT_GENERAL_STORE_SETTINGS_DESC', 'Remember Settings on this page for your admin account');
define( '_READOUT_GENERAL_TRUNCATION_LENGTH_NAME', 'Truncation Length');
define( '_READOUT_GENERAL_TRUNCATION_LENGTH_DESC', 'Reduce content of fields to this length where appropriate');
define( '_READOUT_GENERAL_USE_ORDERING_NAME', 'Use Ordering');
define( '_READOUT_GENERAL_USE_ORDERING_DESC', 'Instead of showing entries by their database order, show them by their set ordering - if applicable');
define( '_READOUT_GENERAL_COLUMN_HEADERS_NAME', 'Column Headers');
define( '_READOUT_GENERAL_COLUMN_HEADERS_DESC', 'Show Column Headers every X rows');
define( '_READOUT_GENERAL_NOFORMAT_NEWLINES_NAME', 'Format: no linebreaks');
define( '_READOUT_GENERAL_NOFORMAT_NEWLINES_DESC', 'Multiple entries for a table cell are normally displayed in separate lines, with this option, these entries are just displayed in a single block of text.');
define( '_READOUT_GENERAL_EXPORT_CSV_NAME', 'Export as .csv');
define( '_READOUT_GENERAL_EXPORT_CSV_DESC', 'Export data as a comma separated file that can be loaded in a spreadsheet application.');

?>
