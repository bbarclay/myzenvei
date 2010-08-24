<?php
/**
* @version $Id: french.php
* @package AEC - Account Control Expiration - Membership Manager
* @subpackage Language - Backend - French
* @copyright 2006-2008 Copyright (C) David Deutsch
* @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
* @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
*/

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

define( '_AEC_LANGUAGE',                        'fr' ); // DO NOT CHANGE!!
define( '_CFG_GENERAL_ACTIVATE_PAID_NAME',        'Souscription payante activ&eacute;' );
define( '_CFG_GENERAL_ACTIVATE_PAID_DESC',        'Toujours activer les souscriptions qui sont pay&eacute;es au lieu d&amp;acute;exiger un code d&amp;acute;activation automatique' );

// hacks/install &gt;&gt; ATTENTION: MUST BE HERE AT THIS POSITION, needed later!
define( '_AEC_SPEC_MENU_ENTRY',                    'Mes souscriptions' );

// common
define( '_DESCRIPTION_PAYSIGNET',                'mic: Description Paysignnet - CHECK! -');
define( '_AEC_CONFIG_SAVED',                    'Configuration enregistr&eacute;e' );
define( '_AEC_CONFIG_CANCELLED',                'Configuration annul&eacute;e' );
define( '_AEC_TIP_NO_GROUP_PF_PB',                'Public Frontend &quot;n\'est PAS un groupe d\'utilisateurs - et non plus&quot; Public Backend' );
define( '_AEC_CGF_LINK_ABO_FRONTEND',            'Lien direct avec l\'application' );
define( '_AEC_CGF_LINK_CART_FRONTEND',			'Direct Add To Cart link' );
define( '_AEC_NOT_SET',                            'Non d&eacute;fini' );
define( '_AEC_COUPON',                            'Coupon' );
define( '_AEC_CMN_NEW',                            'Nouveau' );
define( '_AEC_CMN_CLICK_TO_EDIT',                'Cliquer pour modifier' );
define( '_AEC_CMN_LIFETIME',                    'Illimit&eacute;' );
define( '_AEC_CMN_UNKOWN',                        'Inconnu' );
define( '_AEC_CMN_EDIT_CANCELLED',                'Modification annul&eacute;e' );
define( '_AEC_CMN_PUBLISHED',                    'Publi&eacute;' );
define( '_AEC_CMN_NOT_PUBLISHED',                'Non Publi&eacute;' );
define( '_AEC_CMN_CLICK_TO_CHANGE',                'Cliquez sur l\'icone pour activer / d&eacute;sactiver l\'&eacute;tat' );
define( '_AEC_CMN_NONE_SELECTED',                'Aucun s&eacute;lectionn&eacute;' );
define( '_AEC_CMN_MADE_VISIBLE',                'rendre visible' );
define( '_AEC_CMN_MADE_INVISIBLE',                'rendre invisible' );
define( '_AEC_CMN_TOPUBLISH',                    'publier' ); // to ...
define( '_AEC_CMN_TOUNPUBLISH',                    'ne pas publier' ); // to ...
define( '_AEC_CMN_FILE_SAVED',                    'Fichier enregistr&eacute;' );
define( '_AEC_CMN_ID',                            'ID' );
define( '_AEC_CMN_DATE',                        'Date' );
define( '_AEC_CMN_EVENT',                        'Ev&eacute;nement' );
define( '_AEC_CMN_TAGS',                        'Tags' );
define( '_AEC_CMN_ACTION',                        'Action' );
define( '_AEC_CMN_PARAMETER',                    'Param&egrave;tre' );
define( '_AEC_CMN_NONE',                        'Aucun' );
define( '_AEC_CMN_WRITEABLE',                    'Modifiable' );
define( '_AEC_CMN_UNWRITEABLE',                 'Non-modifiable!' );
define( '_AEC_CMN_UNWRITE_AFTER_SAVE',            'Rendre non-modifiable apr&egrave;s la sauvegarde' );
define( '_AEC_CMN_OVERRIDE_WRITE_PROT',            'Red&eacute;finir la protection en &eacute;criture en sauvant' );
define( '_AEC_CMN_NOT_SET',                        'Non d&eacute;fini' );
define( '_AEC_CMN_SEARCH',                        'Recherche' );
define( '_AEC_CMN_APPLY',                      'Appliquer' );
define( '_AEC_CMN_STATUS',                        'Etat' );
define( '_AEC_FEATURE_NOT_ACTIVE',                'Cette fonctionnalit&eacute; n\'est pas encore active' );
define( '_AEC_CMN_YES',                            'Oui' );
define( '_AEC_CMN_NO',                            'Non' );
define( '_AEC_CMN_INHERIT',						'Inherit' );
define( '_AEC_CMN_LANG_CONSTANT_IS_MISSING',    'Langue constante &lt;strong&gt;%s&lt;/strong&gt; est manquante' );
define( '_AEC_CMN_VISIBLE',						'Visible' );
define( '_AEC_CMN_INVISIBLE',                    'Invisible' );
define( '_AEC_CMN_EXCLUDED',                    'Exclus' );
define( '_AEC_CMN_PENDING',                        'En attente' );
define( '_AEC_CMN_ACTIVE',                        'Actif' );
define( '_AEC_CMN_TRIAL',                        'P&eacute;riode d\'essai' );
define( '_AEC_CMN_CANCEL',                        'Annul&eacute;' );
define( '_AEC_CMN_HOLD',						'Hold' );
define( '_AEC_CMN_EXPIRED',                        'Expir&eacute;' );
define( '_AEC_CMN_CLOSED',                        'Ferm&eacute;' );

// user(info)
define( '_AEC_USER_USER_INFO',                    'Info utilisateur' );
define( '_AEC_USER_USERID',                        'ID utilisateur' );
define( '_AEC_USER_STATUS',                        'Etat' );
define( '_AEC_USER_ACTIVE',                        'Active' );
define( '_AEC_USER_BLOCKED',                    'Bloqu&eacute;' );
define( '_AEC_USER_ACTIVE_LINK',                'Lien d\'activation' );
define( '_AEC_USER_PROFILE',                    'Profile' );
define( '_AEC_USER_PROFILE_LINK',                'Voir le profile' );
define( '_AEC_USER_USERNAME',                    'Nom d\'utilisateur' );
define( '_AEC_USER_NAME',                        'Nom' );
define( '_AEC_USER_EMAIL',                        'E-Mail' );
define( '_AEC_USER_SEND_MAIL',                    'Envoie email' );
define( '_AEC_USER_TYPE',                        'Type utilisateur' );
define( '_AEC_USER_REGISTERED',                    'Enregistr&eacute;' );
define( '_AEC_USER_LAST_VISIT',                    'Derni&egrave;re visite' );
define( '_AEC_USER_EXPIRATION',                    'Expiration' );
define( '_AEC_USER_CURR_EXPIRE_DATE',            'Date d\'expiration courante' );
define( '_AEC_USER_LIFETIME',                    'Illimit&eacute;' );
define( '_AEC_USER_RESET_EXP_DATE',                'R&eacute;initialisez la date d\'expiration' );
define( '_AEC_USER_RESET_STATUS',                'R&eacute;initialisez le status' );
define( '_AEC_USER_SUBSCRIPTION',                'Souscription' );
define( '_AEC_USER_PAYMENT_PROC',                'Processus de paiement' );
define( '_AEC_USER_CURR_SUBSCR_PLAN',            'Plan de souscription courant' );
define( '_AEC_USER_PREV_SUBSCR_PLAN',            'Plan de souscription ant&eacute;rieur' );
define( '_AEC_USER_USED_PLANS',                    'Plans de souscription expir&eacute;' );
define( '_AEC_USER_NO_PREV_PLANS',                'Actuellement aucunes souscriptions' );
define( '_AEC_USER_ASSIGN_TO_PLAN',              'Attribuer au Plan' );
define( '_AEC_USER_TIME',                        'temps' );
define( '_AEC_USER_TIMES',                        'temps' );
define( '_AEC_USER_INVOICES',                    'Factures' );
define( '_AEC_USER_NO_INVOICES',                'Actuellement aucune facture' );
define( '_AEC_USER_INVOICE_FACTORY',            'Facturez &agrave; l\'entreprise' );
define( '_AEC_USER_ALL_SUBSCRIPTIONS',            'Tous les abonnements de cet utilisateur' );
define( '_AEC_USER_ALL_SUBSCRIPTIONS_NOPE',    'C\'est le seul abonnement de cet utilisateur actuellement.' );
define( '_AEC_USER_SUBSCRIPTIONS_ID',            'ID' );
define( '_AEC_USER_SUBSCRIPTIONS_STATUS',        'Etat' );
define( '_AEC_USER_SUBSCRIPTIONS_PROCESSOR',    'Processeur' );
define( '_AEC_USER_SUBSCRIPTIONS_SINGUP',        'Inscription' );
define( '_AEC_USER_SUBSCRIPTIONS_EXPIRATION',    'Expiration' );
define( '_AEC_USER_SUBSCRIPTIONS_PRIMARY',     'primaire' );
define( '_AEC_USER_CURR_SUBSCR_PLAN_PRIMARY',    'Primaire' );
define( '_AEC_USER_COUPONS',					'Coupons' );
define( '_HISTORY_COL_COUPON_CODE',				'Coupon Code' );
define( '_AEC_USER_NO_COUPONS',					'No coupon use recorded' );
define( '_AEC_USER_MICRO_INTEGRATION',			'Micro Integration Info' );
define( '_AEC_USER_MICRO_INTEGRATION_USER',		'Frontend' );
define( '_AEC_USER_MICRO_INTEGRATION_ADMIN',	'Backend' );
define( '_AEC_USER_MICRO_INTEGRATION_DB',		'Database Readout' );

// new (additional)
define( '_AEC_MSG_MIS_NOT_DEFINED',                'Aucune int&eacute;grations n\'a &eacute;t&eacute; d&eacute;fini jusqu\'&agrave; pr&eacute;sent - voir config' );

// headers
define( '_AEC_HEAD_SETTINGS',                    'Param&egrave;tres' );
define( '_AEC_HEAD_HACKS',                        'Hacks' );
define( '_AEC_HEAD_PLAN_INFO',                    'Abonnements' );
define( '_AEC_HEAD_LOG',                        'Journal des &eacute;v&eacute;nements' );
define( '_AEC_HEAD_CSS_EDITOR',                    'Editeur CSS' );
define( '_AEC_HEAD_MICRO_INTEGRATION',            'Info micro int&eacute;gration' );
define( '_AEC_HEAD_ACTIVE_SUBS',                'Abonn&eacute; actif' );
define( '_AEC_HEAD_EXCLUDED_SUBS',                'Abonn&eacute; exclu' );
define( '_AEC_HEAD_EXPIRED_SUBS',                'Abonn&eacute; expir&eacute;' );
define( '_AEC_HEAD_PENDING_SUBS',                'Abonn&eacute; en attente' );
define( '_AEC_HEAD_CANCELLED_SUBS',                'Abonn&eacute; annul&eacute;' );
define( '_AEC_HEAD_HOLD_SUBS',					'Subscriber on Hold' );
define( '_AEC_HEAD_CLOSED_SUBS',                'Abonn&eacute; ferm&eacute;' );
define( '_AEC_HEAD_MANUAL_SUBS',                'Abonn&eacute; manuel' );
define( '_AEC_HEAD_SUBCRIBER',                    'Abonn&eacute;' );

// hacks (special)
define( '_AEC_HACK_HACK',                        'Hack' );
define( '_AEC_HACKS_ISHACKED',                    'est hack&eacute;' );
define( '_AEC_HACKS_NOTHACKED',                    'n\'est pas hack&eacute;!' );
define( '_AEC_HACKS_UNDO',                        'annul&eacute; maintenant' );
define( '_AEC_HACKS_COMMIT',                    'fusionner' );
define( '_AEC_HACKS_FILE',                        'Fichier' );
define( '_AEC_HACKS_LOOKS_FOR',                    'Le hack va rechercher cet' );
define( '_AEC_HACKS_REPLACE_WITH',                '... et le remplace par' );

define( '_AEC_HACKS_NOTICE',                    'AVIS IMPORTANT' );
define( '_AEC_HACKS_NOTICE_DESC',                'Pour des raisons de s&eacute;curit&eacute;, vous devez appliquer les hacks aux fichiers core de Joomla. Pour ce faire, il suffit de cliquer sur le lien &quot;hacker le fichier maintenant&quot; correspondant aux fichiers. Vous pouvez aussi ajouter un lien &agrave; votre menu utilisateur, afin qu&amp;acute;ils puissent afficher l&amp;acute;&eacute;tat de leur abonnement.' );
define( '_AEC_HACKS_NOTICE_DESC2',                '&lt;strong&gt;Tous les hacks fonctionnellement importants sont marqu&eacute;s d&amp;acute;une fl&egrave;che et d&amp;acute;un point d&amp;acute;exclamation.&lt;/strong&gt;' );
define( '_AEC_HACKS_NOTICE_DESC3',                '&lt;strong&gt;Il n&amp;acute;est pas n&eacute;cessaire&lt;/strong&gt; d&amp;acute;appliquer les hacks dans l&amp;acute;ordre - Il ne faut donc pas s&amp;acute;&eacute;tonner si elles vont #1, #3, #6 - les nombres manquants sont des hacks h&eacute;rit&eacute;s que vous verriez seulement tr&egrave;s probablement si vous les aviez (incorrectement) appliqu&eacute;es.' );
define( '_AEC_HACKS_NOTICE_JACL',                'JACL NOTICE' );
define( '_AEC_HACKS_NOTICE_JACL_DESC',            'Dans le cas o&ugrave; vous pr&eacute;voyez d&amp;acute;installer le composant JACLplus, s&amp;acute;il vous pla&#238;t assurez-vous que les hacks &lt;strong&gt;ne sont pas fusionn&eacute;s&lt;/strong&gt; lors de l&amp;acute;installation. Des hacks JACL fusionnent &eacute;galement aux fichiers de bases de Joomla et il est important que nos hacks soit fusionn&eacute;s apr&egrave;s ceux de JACL.' );

define( '_AEC_HACKS_MENU_ENTRY',         'Entr&eacute;e menu' );
define( '_AEC_HACKS_MENU_ENTRY_DESC',            'Ajoute un &lt;strong&gt;' . _AEC_SPEC_MENU_ENTRY . '&lt;/strong&gt; &agrave; l&amp;acute;entr&eacute;e du menu utilisateur. De cette fa&ccedil;on, un utilisateur peut g&eacute;rer ses factures et la mise &agrave; niveau ou renouveler son abonnement.' );
define( '_AEC_HACKS_LEGACY',                    '&lt;strong&gt;Il s\'agit d\'un hack h&eacute;rit&eacute;, annuler s\'il vous pla&#238;t!&lt;/strong&gt;' );
define( '_AEC_HACKS_LEGACY_MAMBOT',				'<strong>This is a Legacy Hack which is superceded by the Joomla 1.0 Mambot, please undo and use the "Hacks Mambot" instead!</strong>' );
define( '_AEC_HACKS_LEGACY_PLUGIN',				'<strong>This is a Legacy Hack which is superceded by the Joomla 1.5 Plugin, please undo and use the Plugin instead!</strong>' );
define( '_AEC_HACKS_LEGACY_PLUGIN_ERROR',		'<strong>This is a Legacy Hack which is superceded by the Joomla 1.5 Error Plugin, please undo and use the AEC Error Plugin instead!</strong>' );
define( '_AEC_HACKS_LEGACY_PLUGIN_USER',		'<strong>This is a Legacy Hack which is superceded by the Joomla 1.5 User Plugin, please undo and use the AEC User Plugin instead!</strong>' );
define( '_AEC_HACKS_LEGACY_PLUGIN_ACCESS',		'<strong>This is a Legacy Hack which is superceded by the Joomla 1.5 Access Plugin, please undo and use the AEC Access Plugin instead!</strong>' );
define( '_AEC_HACKS_NOTAUTH',                    'Cela redirigera vos utilisateurs &agrave; la page [Acc&egrave;s non autoris&eacute;] avec les informations sur vos abonnements' );
define( '_AEC_HACKS_SUB_REQUIRED',                'Cela fera en sorte qu\'un utilisateur dispose d\'un abonnement afin de ce connecter.&lt;br /&gt;&lt;strong&gt;N\'oubliez pas de fixer aussi [Exigent Abonnement] dans les param&egrave;tres AEC!&lt;/strong&gt;' );
define( '_AEC_HACKS_REG2',                        'Cela va rediriger un utilisateur &agrave; l\'enregistrement des plans de paiement apr&egrave;s avoir rempli le formulaire d\'inscription. Laissez uniquement ce plan en s&eacute;lection pour la connexion (si \'Exiger un abonnement\' est actif), ou compl&egrave;tement volontaire (sans exiger d\'abonnement). &lt;strong&gt;Noter qu\'il existe deux hacks suivant, une fois que vous avez les avez fusionn&eacute;! ceux-ci sont requis, si vous voulez avoir les plans avant les d&eacute;tails utilisateur.&lt;/strong&gt;' );
define( '_AEC_HACKS_REG3',                        'Ceci redirige l\'utilisateur vers la page des plans de paiement s\'il n\'a pas fait n\'a pas d&eacute;j&agrave; de s&eacute;l&eacute;ction.' );
define( '_AEC_HACKS_REG4',                        'Ce Hack transmet les variables &agrave; AEC de l\'utilisateur depuis ces d&eacute;tails.' );
define( '_AEC_HACKS_REG5',                        'Ce Hack rendra le premier plans accessible - Dans les param&egrave;tres, vous devez configurer le commutateur &agrave; cet effet.!' );
define( '_AEC_HACKS_MI1',                        'Certaines micro int&eacute;grations on besoin que le mot passe de chaque utilisateur soit en texte clair. Ce hack veille &agrave; ce que la micro int&eacute;grations soit averti lorsqu\'un utilisateur modifie son compte.' );
define( '_AEC_HACKS_MI2',                        'Certaines micro int&eacute;grations on besoin que le mot passe de chaque utilisateur soit en texte clair Ce hack veille &agrave; ce que la micro int&eacute;grations soit averti lorsque l\'utilisateur enregistre un compte.' );
define( '_AEC_HACKS_MI3',                        'Certaines micro int&eacute;grations on besoin que le mot passe de chaque utilisateur soit en texte clair. Ce hack veille &agrave; ce que la micro int&eacute;grations soit notifi&eacute;e lorsque qu\'un admin change un compte utilisateur.' );
define( '_AEC_HACKS_CB2',                        'Cela va rediriger un utilisateur qui s\'enregistre aux plans de paiement apr&egrave;s avoir rempli le formulaire d\'inscription de CB. Laissez uniquement ce plan &agrave; la s&eacute;lection pour connexion (si \'Exiger Abonnement\' est actif), ou compl&egrave;ter volontairement (Sans n&eacute;cessiter un abonnement). &lt;strong&gt;Attention aux deux hacks suivent, une fois vous l\'avez fusionner! Ils sont exig&eacute;s, si vous voulez avoir les plans avant le d&eacute;tail de l\'utilisateur.&lt;/strong&gt;' );
define( '_AEC_HACKS_CB6',                        'Ceci redirige l\'utilisateur vers la page des plans de paiement quand il ou elle n\'a pas encore fait de s&eacute;lection.' );
define( '_AEC_HACKS_CB_HTML2',                    'Ce Hack transmet les variables &agrave; AEC de l\'utilisateur depuis le formulaire de d&eacute;tails. &lt;strong&gt;Pour faire ce travail, d&eacute;finir le &quot;Premier Plans&quot; dans les param&egrave;tres d\'AEC.&lt;/strong&gt;' );
define( '_AEC_HACKS_UHP2',                        'UHP2 Entr&eacute; menu' );
define( '_AEC_HACKS_UHP2_DESC',                    'Ajoute un &lt;strong&gt;' . _AEC_SPEC_MENU_ENTRY . '&lt;/strong&gt; &agrave; l&amp;acute;entr&eacute;e du menu utilisateur UHP2. De cette fa&ccedil;on, un utilisateur peut g&eacute;rer ses factures et la mise &agrave; niveau ou renouveler son abonnement.' );
define( '_AEC_HACKS_CBM',                        'Si vous utilisez le Comprofiler Moderator Module, vous devez le hacker pour &eacute;viter le probl&egrave;me de la boucle sans fin.' );

define( '_AEC_HACKS_JUSER_HTML1',				'This will redirect a registering user to the payment plans after filling out the registration form in JUser. Leave this alone to have plan selection only on login (if \'Require Subscription\' is active), or completely voluntary (without requiring a subscription). <strong>Please note that there are two hacks following this, once you have committed it! If you want to have the plans before the user details, these are required as well.</strong>' );
define( '_AEC_HACKS_JUSER_PHP1',				'This will redirect the user to the payment plans page when he or she has not made that selection yet.' );
define( '_AEC_HACKS_JUSER_PHP2',				'This is a bugfix which allows the AEC to load the JUser functions without forcing it to react to the POST data.' );

// log
		// settings
define( '_AEC_LOG_SH_SETT_SAVED',                'Changement param&egrave;tres' );
define( '_AEC_LOG_LO_SETT_SAVED',                'Param&egrave;tres AEC sauvegard&eacute;s' );
		// heartbeat
define( '_AEC_LOG_SH_HEARTBEAT',                'Fr&eacute;quence d\'ex&eacute;cution' );
define( '_AEC_LOG_LO_HEARTBEAT',                'Ex&eacute;cution r&eacute;alis&eacute;e:' );
define( '_AEC_LOG_AD_HEARTBEAT_DO_NOTHING',        'Ne rien faire' );
		// install
define( '_AEC_LOG_SH_INST',                        'Installation AEC' );
define( '_AEC_LOG_LO_INST',                        'La version %s de AEC est intall&eacute;e' );

// install texts
define( '_AEC_INST_NOTE_IMPORTANT',                'Avis important' );
define( '_AEC_INST_NOTE_SECURITY',				'For certain features, you may need to apply hacks to other components. For your convenience, we have included an autohacking feature that does just that with the click of a link' );
define( '_AEC_INST_APPLY_HACKS',				'In order to commit these hacks right now, go to the %s. (You can also access this page later on from the AEC central view or menu)' );
define( '_AEC_INST_APPLY_HACKS_LTEXT',			'hacks page' );
define( '_AEC_INST_NOTE_UPGRADE',				'<strong>If you are upgrading, make sure to check the hacks page anyways, since there are changes from time to time!!!</strong>' );
define( '_AEC_INST_NOTE_HELP',					'To help you along with frequently encountered problems, we have created a %s that will help you ship around the most common setup problems (access is also available from the AEC central).' );
define( '_AEC_INST_NOTE_HELP_LTEXT',			'help function' );
define( '_AEC_INST_HINTS',						'Hints' );
define( '_AEC_INST_HINT1',						'We encourage you to visit the <a href="%s" target="_blank">valanx.org forums</a> and to <strong>participate in the discussion there</strong>. Chances are, that other users have found the same bugs and it is equally likely that there is at least a fix to hack in or even a new version.' );
define( '_AEC_INST_HINT2',                        'Dans tous les cas (et sp&eacute;cialement si vous utilisez AEC sur un site de production): allez sur la page de param&eacute;trage et faite un test de souscription pour v&eacute;rifer que tout fonctionne de fa&ccedil;on satisfaisante! Although we try our best to make upgrading as flawless as possible, some fundamental changes to our program may not be possible to cushion for all users.' );
define( '_AEC_INST_ATTENTION',                    'Pas besoin d\'utiliser les vieux logins!' );
define( '_AEC_INST_ATTENTION1',                    'Si vous avez encore les vieux modules de login d\'AEC, d&eacute;sinstallez les (peu importe qu\'il s\'agisse de CB ou Joomla) et utilisez les modules de Joomla ou CB actuels. Il n\'y a plus besoin d\'utiliser ces vieux modules.' );
define( '_AEC_INST_MAIN_COMP_ENTRY',            'Abonnements AEC' );
define( '_AEC_INST_ERRORS',                        '&lt;strong&gt;Attention&lt;/strong&gt;&lt;br /&gt;AEC n\'a pas pu &ecirc;tre compl&egrave;tement install&eacute;, &agrave; la suite d\'erreurs commises lors du processus d\'installation:&lt;br /&gt;' );

define( '_AEC_INST_ROOT_GROUP_NAME',			'Root' );
define( '_AEC_INST_ROOT_GROUP_DESC',			'Root Group. This entry cannot be deleted, modification is limited.' );

// help
define( '_AEC_CMN_HELP',                        'Aide' );
define( '_AEC_HELP_DESC',                        'Sur cette page, AEC se penche sur sa propre configuration et vous indique chaque fois qu&amp;acute;il trouve des erreurs qui doivent &ecirc;tre trait&eacute;es.' );
define( '_AEC_HELP_GREEN',                        'Vert&lt;/strong&gt; &Eacute;l&eacute;ments indiquant des probl&egrave;mes insignifiants ou des notifications, ou des probl&egrave;mes qui ont d&eacute;j&agrave; &eacute;t&eacute; r&eacute;solus.' );
define( '_AEC_HELP_YELLOW',                        'Jaune&lt;/strong&gt; Sont pour la plupart des &eacute;l&eacute;ments de cosm&eacute;tique important (comme ajouts &agrave; l\'utilisateur frontend), mais aussi des questions qui sont le plus susceptibles un choix d&eacute;lib&eacute;r&eacute; de l\'administrateur.' );
define( '_AEC_HELP_RED',                        'Rouge&lt;/strong&gt; &Eacute;l&eacute;ments d\'une grande importance par rapport &agrave; la mani&egrave;re dont AEC travaille ou par rapport &agrave; la s&eacute;curit&eacute; de votre syst&egrave;me.' );
define( '_AEC_HELP_GEN',                        'S\'il vous pla&#238;t notez que, m&ecirc;me si nous essayons de couvrir le plus grand nombre d\'erreurs et de probl&egrave;mes possibles, cette page peut uniquement pointer les plus &eacute;vidents et tout n\'est pas trait&eacute; (beta&amp;trade;)' );
define( '_AEC_HELP_QS_HEADER',                    'AEC prise en main rapide' );
define( '_AEC_HELP_QS_DESC',                    'Avant de faire quoi que ce soit sur les questions ci-dessous, s\il vous pla&#238;t, lisez notre  %s!' );
define( '_AEC_HELP_QS_DESC_LTEXT',                'Prise en main rapide' );
define( '_AEC_HELP_SER_SW_DIAG1',                'Probl&egrave;me de droits sur les fichiers' );
define( '_AEC_HELP_SER_SW_DIAG1_DESC',            'AEC a d&eacute;tect&eacute; que vous utilisez un serveur Web Apache - Pour &ecirc;tre en mesure de ne pas pirater des fichiers sur ce type de serveur, les fichiers doivent &ecirc;tre propri&eacute;t&eacute; d&amp;acute;un utilisateur du serveur Web, ce qui apparemment n&amp;acute;est pas le cas pour au moins un des fichiers n&eacute;cessaires.' );
define( '_AEC_HELP_SER_SW_DIAG1_DESC2',            'Nous vous recommandons de modifier temporairement les permissions du fichier &agrave; 777, puis fusionner les hacks et remettre les permission apr&egrave;s. &lt;strong&gt;Si vous constatez le probl&egrave;me, contactez votre h&eacute;bergeur ou, &eacute;ventuellement, l&amp;acute;administrateur pour une r&eacute;ponse rapide.&lt;/strong&gt; C&amp;acute;est la m&ecirc;me chose pour les autorisations d&amp;acute;acc&egrave;s aux fichiers li&eacute;s suggestion (s) ci-dessous.' );
define( '_AEC_HELP_SER_SW_DIAG2',                'joomla.php/mambo.php permissions de fichiers' );
define( '_AEC_HELP_SER_SW_DIAG2_DESC',            'AEC a d&eacute;tect&eacute; que le serveur Web n&amp;acute;est pas propri&eacute;taire de votre fichier joomla.php.' );
define( '_AEC_HELP_SER_SW_DIAG2_DESC2',            'Acc&eacute;der &agrave; votre serveur web via SSH et aller dans le r&eacute;pertoire \&quot;&lt;racine de votre site&gt;/includes\&quot;. L&agrave;, tapez cette commande: \&quot;chown wwwrun joomla.php\&quot; (ou \&quot;chown wwwrun mambo.php\&quot; dans le cas o&ugrave; vous utilisez mambo).' );
define( '_AEC_HELP_SER_SW_DIAG3',                'Legacy Hacks Detected!' );
define( '_AEC_HELP_SER_SW_DIAG3_DESC',            'Il semblerait qu&amp;acute;il y est des anciens hacks fusionn&eacute;s &agrave; votre syst&egrave;me.' );
define( '_AEC_HELP_SER_SW_DIAG3_DESC2',            'Pour AEC tout est correct et pr&ecirc;t &agrave; fonctionner, s&amp;acute;il vous pla&#238;t r&eacute;examiner la page des hacks et suivez y les &eacute;tapes.' );
define( '_AEC_HELP_SER_SW_DIAG4',                'Probl&egrave;me de droits sur les fichiers' );
define( '_AEC_HELP_SER_SW_DIAG4_DESC',            'AEC AEC ne d&eacute;tecte pas l&amp;acute;&eacute;tat des droits sur le fichier dont il veut hack&eacute;, car il semble que votre installation de PHP a &eacute;t&eacute; compil&eacute; avec l&amp;acute;option \&quot;--disable-posix\&quot;. &lt;strong&gt;Vous pouvez toujours tenter de fusionner les hacks - Si cela ne fonctionne pas, c&amp;acute;est probablement d&ucirc; &agrave; un probl&egrave;me de permission de fichier&lt;/strong&gt;.' );
define( '_AEC_HELP_SER_SW_DIAG4_DESC2',            'Nous vous recommandons de recompiler votre version de php avec l&amp;acute;option dit &amp;acute;left&amp;acute; ou contactez votre administrateur de votre serveur Web sur la question.' );
define( '_AEC_HELP_DIAG_CMN1',                    'joomla.php/mambo.php Hack' );
define( '_AEC_HELP_DIAG_CMN1_DESC',                'Pour qu&amp;acute;AEC fonctionne, Ce hack est n&eacute;cessaire pour rediriger les utilisateurs AEC vers les routines de v&eacute;rification sur Login.' );
define( '_AEC_HELP_DIAG_CMN1_DESC2',            'Allez &agrave; la page des hacks et fusionnez le hack' );
define( '_AEC_HELP_DIAG_CMN2',                    '&quot;Mes abonnements&quot; Ent&eacute;e menu' );
define( '_AEC_HELP_DIAG_CMN2_DESC',                'Un lien vers une page les abonnements de l&amp;acute;utilisateur, ainsi, il lui sera plus facile de suivre ces abonnements.' );
define( '_AEC_HELP_DIAG_CMN2_DESC2',            'Allez &agrave; la page Hacks et cr&eacute;er le lien.' );
define( '_AEC_HELP_DIAG_CMN3',                    'JACL n&amp;acute;est pas install&eacute;' );
define( '_AEC_HELP_DIAG_CMN3_DESC',                'Si vous pr&eacute;voyez d&amp;acute;installer JACLplus sur votre syst&egrave;me joomla!/mambo, assurez-vous que les hacks AEC ne sont pas encore fusionn&eacute;. Si vous l&amp;acute;avez d&eacute;j&agrave; fait, Il vous faudra les enlever. C&amp;acute;est facile depuis la page des hacks AEC.' );
define( '_AEC_HELP_DIAG_NO_PAY_PLAN',            'Aucun plan de paiement actif!' );
define( '_AEC_HELP_DIAG_NO_PAY_PLAN_DESC',        'Il semble qu&amp;acute;aucun Plan de Paiement ne soit encore publi&eacute; - AEC requiert au moins un plan pour fonctionner.' );
define( '_AEC_HELP_DIAG_GLOBAL_PLAN',            'Entr&eacute;e du plan global' );
define( '_AEC_HELP_DIAG_GLOBAL_PLAN_DESC',        'Il ya une entr&eacute;e de plan global actif dans votre configuration. Si vous ne savez pas de quoi il s&amp;acute;agit, vous devriez probablement le d&eacute;sactiver - C&amp;acute;est un plan global qui sera affect&eacute; &agrave; chaque nouvel utilisateur sans avoir fait de choix.' );
define( '_AEC_HELP_DIAG_SERVER_NOT_REACHABLE',    'Serveur apparemment pas joignable' );
define( '_AEC_HELP_DIAG_SERVER_NOT_REACHABLE_DESC',    'C&amp;acute;est la m&ecirc;me chose que si vous avez install&eacute; AEC en local. Pour r&eacute;cup&eacute;rer les notifications (Et donc d&amp;acute;avoir les composants fonctionnent correctement), Vous devez l&amp;acute;installer sur un serveur qui est accessible par une adresse IP fixe ou domaine!' );
define( '_AEC_HELP_DIAG_SITE_OFFLINE',            'Site hors ligne' );
define( '_AEC_HELP_DIAG_SITE_OFFLINE_DESC',        'Vous avez d&eacute;cid&eacute; de mettre votre site hors ligne - please note that this can have an effect on notification processes and thus on your payment workflow.' );
define( '_AEC_HELP_DIAG_REG_DISABLED',            'Enregistrement d\'utilisateur d&eacute;sactiv&eacute;' );
define( '_AEC_HELP_DIAG_REG_DISABLED_DESC',        'L&amp;acute;enregistrement des utilisateurs est d&eacute;sactiv&eacute;. Aucun utilisateur ne peut s&amp;acute;abonner &agrave; votre site.' );
define( '_AEC_HELP_DIAG_LOGIN_DISABLED',        'Identification d\'utilisateur d&eacute;sactiv&eacute;' );
define( '_AEC_HELP_DIAG_LOGIN_DISABLED_DESC',    'Vous avez d&eacute;sactiv&eacute; la fonctionnelit&eacute; de login via le front end. Aucun de vos abonn&eacute;s ne pourra utiliser votre site Web.' );
define( '_AEC_HELP_DIAG_PAYPAL_BUSS_ID',        'Paypal Check Business ID' );
define( '_AEC_HELP_DIAG_PAYPAL_BUSS_ID_DESC',    'Cette routine teste l&amp;acute;existence d&amp;acute;un Paypal Business ID pour am&eacute;liorer la s&eacute;curit&eacute; des transactions Paypal. ' );
define( '_AEC_HELP_DIAG_PAYPAL_BUSS_ID_DESC1',    'Retirez ce r&eacute;glage si vous rencontrez des difficult&eacute;s dans la r&eacute;ception des payements, but without users being enabled. Disable the Setting in general in case you are using multiple e-mail adresses with your Paypal account.' );

// micro integration
		// general
define( '_AEC_MI_REWRITING_INFO',                'Info Rewriting' );
define( '_AEC_MI_SET1_INAME',                    'Abonnement &agrave; %s - Utilisateur: %s (%s)' );
		// htaccess
define( '_AEC_MI_HTACCESS_INFO_DESC',            'Prot&eacute;ger un dossier avec un .htaccess file et autorisez seulement les utilisateurs de cet abonnement &agrave; y acc&eacute;der avec leur compte Joomla .' );
		// email
define( '_AEC_MI_EMAIL_INFO_DESC',                'Envoyez un mail &agrave; une ou plusieurs adresses &agrave; l&amp;acute;expiration de l&amp;acute;abonnement' );
		// idev
define( '_AEC_MI_IDEV_DESC',                    'Connect your sales to iDevAffiliate' );
		// mosetstree
define( '_AEC_MI_MOSETSTREE_DESC',                'Restrict the amount of listings a user can publish' );
		// mysql-query
define( '_AEC_MI_MYSQL_DESC',                    'Specify a mySQL query that should be carried out with this subscription or on its expiration' );
		// remository
define( '_AEC_MI_REMOSITORY_DESC',                'Choose the amount of files a user can download and what reMOSitory group should be assigned to the user account' );
		// VirtueMart
define( '_AEC_MI_VIRTUEMART_DESC',                'Choisissez le groupe utilisateur VirtueMart auquel cet utilisateur doit appartenir' );

// central
define( '_AEC_CENTR_CENTRAL',                    'Centrale AEC' );
define( '_AEC_CENTR_EXCLUDED',                    'Exclus' );
define( '_AEC_CENTR_PLANS',                        'Plans' );
define( '_AEC_CENTR_PENDING',                    'En attente' );
define( '_AEC_CENTR_ACTIVE',                    'Active' );
define( '_AEC_CENTR_EXPIRED',                    'Expir&eacute;' );
define( '_AEC_CENTR_CANCELLED',                    'Annul&eacute;' );
define( '_AEC_CENTR_HOLD',						'On Hold' );
define( '_AEC_CENTR_CLOSED',                    'Ferm&eacute;' );
define( '_AEC_CENTR_PROCESSORS',				'Processors' );
define( '_AEC_CENTR_SETTINGS',                    'Param&egrave;tres' );
define( '_AEC_CENTR_EDIT_CSS',                    'Editeur CSS' );
define( '_AEC_CENTR_V_INVOICES',                'Voir factures' );
define( '_AEC_CENTR_COUPONS',                    'Coupons' );
define( '_AEC_CENTR_COUPONS_STATIC',            'Coupons statique' );
define( '_AEC_CENTR_VIEW_HISTORY',                'Afficher historique' );
define( '_AEC_CENTR_HACKS',                        'Hacks' );
define( '_AEC_CENTR_M_INTEGRATION',                'Micro Integr.' );
define( '_AEC_CENTR_HELP',                        'Aide' );
define( '_AEC_CENTR_LOG',                        'Journal' );
define( '_AEC_CENTR_MANUAL',                    'Manuel' );
define( '_AEC_CENTR_EXPORT',                        'Export' );
define( '_AEC_CENTR_IMPORT',                        'Import' );
define( '_AEC_CENTR_GROUPS',					'Groups' );
define( '_AEC_CENTR_AREA_MEMBERSHIPS',			'Memberships' );
define( '_AEC_CENTR_AREA_PAYMENT',				'Payment Plans &amp; related functionality' );
define( '_AEC_CENTR_AREA_SETTINGS',				'Settings, Logs &amp; special functionality' );
define( '_AEC_QUICKSEARCH',                        'Recherche rapide' );
define( '_AEC_QUICKSEARCH_DESC',                'Saisissez un nom d&amp;acute;utilisateur, un ID utilisateur ou num&eacute;ro de facture pour acc&egrave;der directement a l&amp;acute;enregistrement souhait&eacute;. Si il y a plusieurs r&eacute;sultats, ils seront tous affich&eacute;s.' );
define( '_AEC_QUICKSEARCH_MULTIRES',            'R&eacute;sultat multiple!' );
define( '_AEC_QUICKSEARCH_MULTIRES_DESC',        'S&eacute;lectionnez l&amp;acute;un des utilisateurs suivants :' );
define( '_AEC_QUICKSEARCH_THANKS',                'Thank you for making a simple function very happy.' );
define( '_AEC_QUICKSEARCH_NOTFOUND',            'Utilisateur n\'a pas &eacute;t&eacute; trouv&eacute;' );

define( '_AEC_NOTICES_FOUND',                    'Eventlog Notices' );
define( '_AEC_NOTICES_FOUND_DESC',                'Les entr&eacute;es suivantes de l&amp;acute;Eventlog sont ici pour attirer votre attention. Pour ne plus les voir marquez les comme lues. Vous pouvez aussi changer les informations &agrave; afficher dans Settings.' );
define( '_AEC_NOTICE_MARK_READ',                'Marqu&eacute; lu' );
define( '_AEC_NOTICE_MARK_ALL_READ',            'Marquer tous avis lu' );
define( '_AEC_NOTICE_NUMBER_1',                    'Ev&eacute;nement' );
define( '_AEC_NOTICE_NUMBER_2',                    'Ev&eacute;nement' );
define( '_AEC_NOTICE_NUMBER_8',                    'Notice' );
define( '_AEC_NOTICE_NUMBER_32',                'Attention' );
define( '_AEC_NOTICE_NUMBER_128',                'Erreur' );
define( '_AEC_NOTICE_NUMBER_512',                'Aucun' );

// select lists
define( '_AEC_SEL_EXCLUDED',                    'Exclus' );
define( '_AEC_SEL_PENDING',                        'En attente' );
define( '_AEC_SEL_TRIAL',						'Trial' );
define( '_AEC_SEL_ACTIVE',                      'Active' );
define( '_AEC_SEL_EXPIRED',                        'Expir&eacute;' );
define( '_AEC_SEL_CLOSED',                        'Ferm&eacute;' );
define( '_AEC_SEL_CANCELLED',                    'Annul&eacute;' );
define( '_AEC_SEL_HOLD',						'Hold' );
define( '_AEC_SEL_NOT_CONFIGURED',                'Non configurer' );

// footer
define( '_AEC_FOOT_TX_CHOOSING',                'Merci d\'avoir choisi le composant AEC de contr&ocirc;le d\'expiration des comptes!' );
define( '_AEC_FOOT_TX_GPL',						'This Joomla component was developed and released under the <a href="http://www.gnu.org/copyleft/gpl.html" target="_blank">GNU/GPL</a> license by David Deutsch & Team AEC from <a href="http://www.valanx.org" target="_blank">valanx.org</a>' );
define( '_AEC_FOOT_TX_SUBSCRIBE',                'Si vous voulez plus de fonctionnalit&eacute;s, services professionnels, mises &agrave; jour, les manuels et l\'aide en ligne pour ce composant, vous pouvez vous abonner &agrave; nos services sur le lien ci-dessus. Il nous aide beaucoup dans notre d&eacute;veloppement!' );
define( '_AEC_FOOT_CREDIT',                        'S\'il vous pla&#238;t lisez notre %s' );
define( '_AEC_FOOT_CREDIT_LTEXT',                'liste de remerciements' );
define( '_AEC_FOOT_VERSION_CHECK',                'Contr&ocirc;le de version' );
define( '_AEC_FOOT_MEMBERSHIP',                    'Devenez membre avec documentation et support' );

// alerts
define( '_AEC_ALERT_SELECT_FIRST',                'S&eacute;lectionnez un &eacute;l&eacute;ment &agrave; configurer' );
define( '_AEC_ALERT_SELECT_FIRST_TO',            'S\'il vous pla&#238;t s&eacute;lectionnez d\'abord un &eacute;l&eacute;ment pour' );

// messages
define( '_AEC_MSG_NODELETE_SUPERADMIN',            'Vous ne pouvez pas supprimer un Super Administrateur' );
define( '_AEC_MSG_NODELETE_YOURSELF',            'Vous ne pouvez pas supprimer votre propre compte !' );
define( '_AEC_MSG_NODELETE_EXCEPT_SUPERADMIN',    'Seul les  Super Administrateur peuvent ex&eacute;cuter cette action !' );
define( '_AEC_MSG_SUBS_RENEWED',                'abonnement(s) renouvel&eacute;(s)' );
define( '_AEC_MSG_SUBS_ACTIVATED',                'abonnement(s) activ&eacute;(s)' );
define( '_AEC_MSG_NO_ITEMS_TO_DELETE',            'Aucuns &eacute;l&eacute;ment trouv&eacute; a effacer' );
define( '_AEC_MSG_NO_DEL_W_ACTIVE_SUBSCRIBER',    'Vous ne pouvez pas supprimer des plans contenant des souscripteurs actifs' );
define( '_AEC_MSG_ITEMS_DELETED',                'El&eacute;ment(s) effac&eacute;(s)' );
define( '_AEC_MSG_ITEMS_SUCESSFULLY',            '%s &eacute;l&eacute;ment(s) avec succ&egrave;s' );
define( '_AEC_MSG_SUCESSFULLY_SAVED',            'Modifications enregistr&eacute;es avec succ&eacute;s' );
define( '_AEC_MSG_ITEMS_SUCC_PUBLISHED',        'El&eacute;ment(s) publi&eacute;(s) avec succ&egrave;s' );
define( '_AEC_MSG_ITEMS_SUCC_UNPUBLISHED',        'El&eacute;ment(s) d&eacute;publi&eacute;(s) avec succ&egrave;s' );
define( '_AEC_MSG_NO_COUPON_CODE',                'Vous devez sp&eacute;cifier un code de coupon!' );
define( '_AEC_MSG_OP_FAILED',                    'Op&eacute;ration en &eacute;chec: Ne peux pas ouvrir %s' );
define( '_AEC_MSG_OP_FAILED_EMPTY',                'Op&eacute;ration en &eacute;chec: Contenu vide' );
define( '_AEC_MSG_OP_FAILED_NOT_WRITEABLE',        'Op&eacute;ration en &eacute;chec: le fichier n\'est pas modifiable.' );
define( '_AEC_MSG_OP_FAILED_NO_WRITE',            'Op&eacute;ration en &eacute;chec: Impossible d\'ouvrir le fichier en &eacute;criture' );
define( '_AEC_MSG_INVOICE_CLEARED',                'Facture termin&eacute;e' );

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

// --== BARRE OUTIL BACKEND ==--
define( '_EXPIRE_SET','D&eacute;finir Expiration:');
define( '_EXPIRE_NOW','Expire');
define( '_EXPIRE_EXCLUDE','Exclure');
define( '_EXPIRE_INCLUDE','Inclure');
define( '_EXPIRE_CLOSE','Ferm&eacute;');
define( '_EXPIRE_HOLD','Hold');
define( '_EXPIRE_01MONTH','D&eacute;finir 1 mois');
define( '_EXPIRE_03MONTH','D&eacute;finir 3 mois');
define( '_EXPIRE_12MONTH','D&eacute;finir 12 mois');
define( '_EXPIRE_ADD01MONTH','Ajouter 1 mois');
define( '_EXPIRE_ADD03MONTH','Ajouter 3 mois');
define( '_EXPIRE_ADD12MONTH','Ajouter 12 mois');
define( '_CONFIGURE','Configurer');
define( '_REMOVE','D&eacute;placer vers la liste d&amp;acute;exclusion');
define( '_CNAME','Nom');
define( '_USERLOGIN','Nom d&amp;acute;utilisateur');
define( '_EXPIRATION','Date d&amp;acute;expiration');
define( '_USERS','Utilisateurs');
define( '_DISPLAY','Afficher');
define( '_NOTSET','Exclu');
define( '_SAVE','Enregistrer');
define( '_CANCEL','Annuler');
define( '_EXP_ASC','Expiration ordre Croissant');
define( '_EXP_DESC','Expiration ordre D&eacute;croissant');
define( '_NAME_ASC','Nom ordre Croissant');
define( '_NAME_DESC','Nom ordre D&eacute;croissant');
define( '_LASTNAME_ASC','Last Name Asc');
define( '_LASTNAME_DESC','Last Name Desc');
define( '_LOGIN_ASC','Utilisateur ordre Croissant');
define( '_LOGIN_DESC','Utilisateur ordre D&eacute;croissant');
define( '_SIGNUP_ASC','Inscription date asc.');
define( '_SIGNUP_DESC','Inscription date desc.');
define( '_LASTPAY_ASC','Dernier payement asc');
define( '_LASTPAY_DESC','Dernier payement desc');
define( '_PLAN_ASC','Plan asc.');
define( '_PLAN_DESC','Plan desc.');
define( '_STATUS_ASC','Etat asc.');
define( '_STATUS_DESC','Etat desc.');
define( '_TYPE_ASC','Type de payement asc.');
define( '_TYPE_DESC','Type de payement desc.');
define( '_ORDERING_ASC','Ordering Asc');
define( '_ORDERING_DESC','Ordering Desc');
define( '_ID_ASC','ID Asc');
define( '_ID_DESC','ID Desc');
define( '_CLASSNAME_ASC','Function Name Asc');
define( '_CLASSNAME_DESC','Function Desc');
define( '_ORDER_BY','Class&eacute; par :');
define( '_SAVED', 'Enregistr&eacute;');
define( '_CANCELED', 'Annul&eacute;');
define( '_CONFIGURED', 'Objet configur&eacute;');
define( '_REMOVED', 'Objet retir&eacute; de la liste.');
define( '_EOT_TITLE', 'Comptes ferm&eacute;s');
define( '_EOT_DESC', 'Cette liste n&amp;acute;inclut pas les comptes g&eacute;r&eacute;s manuellement, mais uniquement ceux g&eacute;r&eacute;s avec PayPal. Quand vous effacez une entr&eacute;e, l&amp;acute;utilisateur est retir&eacute; de la base de donn&eacute;es et tous les mouvements li&eacute;s &agrave; son activit&eacute; sont retir&eacute;s de la table locale historique Paypal.');
define( '_EOT_DATE', 'Date de fin de terme');
define( '_EOT_CAUSE', 'Cause');
define( '_EOT_CAUSE_FAIL', '&Eacute;chec de paiement');
define( '_EOT_CAUSE_BUYER', 'Annul&eacute; par l&amp;acute;utilisateur');
define( '_EOT_CAUSE_FORCED', 'Annul&eacute; par l&amp;acute;administrateur');
define( '_REMOVE_CLOSED', 'Effacer l&amp;acute;utilisateur');
define( '_FORCE_CLOSE', 'Forcer la fermeture');
define( '_PUBLISH_PAYPLAN', 'Publier');
define( '_UNPUBLISH_PAYPLAN', 'D&eacute;publier');
define( '_NEW_PAYPLAN', 'Nouveau');
define( '_COPY_PAYPLAN', 'Copie');
define( '_APPLY_PAYPLAN', 'Appliquer');
define( '_EDIT_PAYPLAN', '&Eacute;diter');
define( '_REMOVE_PAYPLAN', 'Effacer');
define( '_SAVE_PAYPLAN', 'Enregistrer');
define( '_CANCEL_PAYPLAN', 'Annuler');
define( '_PAYPLANS_TITLE', 'Gestionnaire des plans');
define( '_PAYPLANS_MAINDESC', 'Les plans Publi&eacute;s seront des options pour l&amp;acute;utilisateur sur le frontend du site. Ces plans sont valides uniquement pour les paiements Paypal.');
define( '_PAYPLAN_GROUP', 'Group');
define( '_PAYPLAN_NOGROUP', 'No Group');
define( '_PAYPLAN_NAME', 'Nom');
define( '_PAYPLAN_DESC', 'Description (premiers 50 caract&egrave;res)');
define( '_PAYPLAN_ACTIVE', 'Publi&eacute;');
define( '_PAYPLAN_VISIBLE', 'Visible');
define( '_PAYPLAN_A3', 'Taux');
define( '_PAYPLAN_P3', 'P&eacute;riode');
define( '_PAYPLAN_T3', 'Unit&eacute; de temps');
define( '_PAYPLAN_USERCOUNT', 'Abonn&eacute;');
define( '_PAYPLAN_EXPIREDCOUNT', 'Expir&eacute;');
define( '_PAYPLAN_TOTALCOUNT', 'Total');
define( '_PAYPLAN_REORDER', 'R&eacute;ordonner');
define( '_PAYPLAN_DETAIL', 'R&eacute;gulier');
define( '_ALTERNATIVE_PAYMENT', 'Virement bancaire');
define( '_SUBSCR_DATE', 'Date d&amp;acute;abonnement');
define( '_ACTIVE_TITLE', 'Abonnements Activ&eacute;s');
define( '_ACTIVE_DESC', 'Cette liste n&amp;acute;inclut pas les comptes g&eacute;r&eacute;s manuellement, mais uniquement ceux g&eacute;r&eacute;s avec PayPal.');
define( '_LASTPAY_DATE', 'Date du dernier paiement');
define( '_USERPLAN', 'Plan');
define( '_CANCELLED_TITLE', 'Abonnements annul&eacute;s');
define( '_CANCELLED_DESC', 'Cette liste n&amp;acute;inclut pas les comptes g&eacute;r&eacute;s manuellement, mais uniquement ceux g&eacute;r&eacute;s avec PayPal. Ce sont les abonnements annul&eacute;s par l&amp;acute;utilisateur et n&amp;acute;ayant pas atteint leurs termes.');
define( '_CANCEL_DATE', 'Date d&amp;acute;annulation');
define( '_MANUAL_DESC', 'Lorsque vous effacez un utilisateur, il sera compl&egrave;tement effac&eacute; de la base de donn&eacute;es.');
define( '_REPEND_ACTIVE', 'En attente de nouveau');
define( '_FILTER_PLAN', '- S&eacute;lectionner le Plan -');
define( '_BIND_USER', 'Assign&eacute; &agrave;:');
define( '_PLAN_FILTER','Filtre Plan:');
define( '_CENTRAL_PAGE','Central');

// --== USER FORM ==--
define( '_HISTORY_COL_INVOICE', 'Facture');
define( '_HISTORY_COL_AMOUNT', 'Montant');
define( '_HISTORY_COL_DATE', 'Date de payement');
define( '_HISTORY_COL_METHOD', 'M&eacute;thode');
define( '_HISTORY_COL_ACTION', 'Action');
define( '_HISTORY_COL_PLAN', 'Plan');
define( '_USERINVOICE_ACTION_REPEAT','Lien r&eacute;p&egrave;te');
define( '_USERINVOICE_ACTION_CANCEL','Annuler');
define( '_USERINVOICE_ACTION_CLEAR','marqu&eacute; OK');
define( '_USERINVOICE_ACTION_CLEAR_APPLY','OK &amp; applique Plan');

// --== PARAMETRES BACKEND ==--

// TAB 1 - Parametres de AEC
define( '_CFG_TAB1_TITLE', ' Configuration');
define( '_CFG_TAB1_SUBTITLE', 'Options utilisateur');

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

define( '_CFG_GENERAL_ALERTLEVEL2_NAME', 'Alerte niveau 2:');
define( '_CFG_GENERAL_ALERTLEVEL2_DESC', 'En jours. C&amp;acute;est le premier seuil pour informer l&amp;acute;utilisateur que son inscription est sur le point d&amp;acute;expirer. &lt;strong&gt;Pas d&amp;acute;email envoy&eacute; !&lt;/strong&gt;');
define( '_CFG_GENERAL_ALERTLEVEL1_NAME', 'Alerte niveau 1:');
define( '_CFG_GENERAL_ALERTLEVEL1_DESC', 'En jours. C&amp;acute;est le seuil final pour informer l&amp;acute;utilisateur que son inscription est sur le point d&amp;acute;expirer. Cela doit &ecirc;tre l&amp;acute;intervalle le plus pr&egrave;s de l&amp;acute;expiration. &lt;strong&gt;Pas d&amp;acute;email envoy&eacute; !&lt;/strong&gt;');
define( '_CFG_GENERAL_ENTRY_PLAN_NAME', 'Plan initial:');
define( '_CFG_GENERAL_ENTRY_PLAN_DESC', 'Chaque utilisateur sera inscrit a ce plan (pas de paiement!) Lorsque l&amp;acute;utilisateur ne dispose pas encore d abonnement');
define( '_CFG_GENERAL_REQUIRE_SUBSCRIPTION_NAME', 'Abonnement exig&eacute;:');
define( '_CFG_GENERAL_REQUIRE_SUBSCRIPTION_DESC', 'Lorsque cette option est activ&eacute;e, l&amp;acute;utilisateur DOIT avoir un abonnement. Si d&eacute;sactiv&eacute;e, les utilisateurs pourront se connecter sans en avoir un.');

define( '_CFG_GENERAL_GWLIST_NAME', 'Description de la Passerelle:');
define( '_CFG_GENERAL_GWLIST_DESC', 'Liste des Passerelles que vous d&eacute;sirez expliquer sur les pages interdites (page que les utilisateurs voient lorsqu&amp;acute;ils essaient d&amp;acute;acc&eacute;der une page qui n&amp;acute;est pas autoris&eacute;e par leur abonnement).');
define( '_CFG_GENERAL_GWLIST_ENABLED_NAME', 'Passerelles de paiement activ&eacute;es:');
define( '_CFG_GENERAL_GWLIST_ENABLED_DESC', 'Choisissez les passerelles de paiement que vous souhaitez activer (utilisez la touche CTRL pour en s&eacute;lectionner plusieurs). Apr&egrave;s sauvegarde, les onglets pour ces passerelles seront affich&eacute;s. D&eacute;sactiver une passerelle n&amp;acute;&eacute;crase pas ses param&egrave;tres.');

define( '_CFG_GENERAL_BYPASSINTEGRATION_NAME', 'D&eacute;sactiver Int&eacute;gration:');
define( '_CFG_GENERAL_BYPASSINTEGRATION_DESC', 'Entrer un nom ou une liste de noms (s&eacute;par&eacute;e par un espace) de l&amp;acute;int&eacute;gration que vous voulez d&eacute;sactiver. Actuellement sont support&eacute;s: &lt;strong&gt;CB,CBE,CBM,JACL,SMF,UE,UHP2,VM&lt;/strong&gt;. Cela peut &ecirc;tre utile quand vous avez d&eacute;sinstall&eacute; CB mais n&amp;acute;avez pas supprim&eacute; les tables de la BD (dans le cas o&ugrave; AEC pourrait encore reconna&amp;icirc;tre ce qui a d&eacute;j&agrave; &eacute;t&eacute; install&eacute;).');
define( '_CFG_GENERAL_SIMPLEURLS_NAME', 'URLs simples:');
define( '_CFG_GENERAL_SIMPLEURLS_DESC', 'D&eacute;sactiver l&amp;acute;utilisation des routines SEF de Joomla/Mambo pour les Urls. Avec certaines installations utiliser cette option va donner un message d&amp;acute;erreur 404 &agrave; cause d&amp;acute;une mauvaise r&eacute;&eacute;criture. Essayer cette option si vous rencontrez des probl&egrave;mes avec les redirections.');
define( '_CFG_GENERAL_EXPIRATION_CUSHION_NAME', 'Coussin d&amp;acute;Expiration:');
define( '_CFG_GENERAL_EXPIRATION_CUSHION_DESC', 'Entrer une valeur de coussin pour d&eacute;terminer l&amp;acute;expiration. Utiliser une valeur assez grande, car les paiements arrivent plus tard que l&amp;acute;expiration (avec Paypal environ 6-8 heures plus tard).');
define( '_CFG_GENERAL_HEARTBEAT_CYCLE_NAME', 'Fr&eacute;quence d&amp;acute;ex&eacute;cution Front:');
define( '_CFG_GENERAL_HEARTBEAT_CYCLE_DESC', 'Nombre d&amp;acute;heures que la AEC attend jusqu&amp;acute;a ce qu&amp;acute;un login soit compris comme un d&eacute;clencheur pour envoyer des e-mails ou &agrave; faire d&amp;acute;autres actions que vous avez choisi d&amp;acute;etre effectu&eacute; p&eacute;riodiquement.');
define( '_CFG_GENERAL_ROOT_GROUP_NAME', 'Root Group:');
define( '_CFG_GENERAL_ROOT_GROUP_DESC', 'Choose the Root Group that the user is displayed when accessing the plans page without any preset variable.');
define( '_CFG_GENERAL_ROOT_GROUP_RW_NAME', 'Root Group ReWrite:');
define( '_CFG_GENERAL_ROOT_GROUP_RW_DESC', 'Choose the Root Group that the user is displayed when accessing the plans page by returning a group number or an array of groups with the ReWriteEngine functionality. This will fall back to the general option (above) if the results are empty.');
define( '_CFG_GENERAL_PLANS_FIRST_NAME', 'Premier plan:');
define( '_CFG_GENERAL_PLANS_FIRST_DESC', 'If you have commited all three hacks to have an integrated Registration with direct Subscription, this switch will activate this behavior. Don&amp;acute;t use it if you don&amp;acute;t want that behavior or only commited the first hack (which means that the plans come after the user has put in his or her details) .');
define( '_CFG_GENERAL_INTEGRATE_REGISTRATION_NAME', 'Integrate Registration');
define( '_CFG_GENERAL_INTEGRATE_REGISTRATION_DESC', 'With this switch, you can make the AEC Mambot/Plugin intercept registration calls and redirect them into the AEC subscription system. Having this option disabled means that the users would freely register and, if a subscription is required, subscribe on their first login. If both this option and "require subscription" are disabled, subscription is completely voluntary.');

define( '_CFG_TAB_CUSTOMIZATION_TITLE', 'Personnaliser');
define( '_CFG_TAB_CUSTOMIZATION_SUBTITLE', 'Personnalisation');

define( '_CFG_CUSTOMIZATION_SUB_CREDIRECT', 'Custom Redirects');
define( '_CFG_CUSTOMIZATION_SUB_PROXY', 'Proxy');
define( '_CFG_CUSTOMIZATION_SUB_BUTTONS_SUB', 'Subscribed Member Buttons');
define( '_CFG_CUSTOMIZATION_SUB_FORMAT_DATE', 'Date Formatting');
define( '_CFG_CUSTOMIZATION_SUB_FORMAT_PRICE', 'Price Formatting');
define( '_CFG_CUSTOMIZATION_SUB_FORMAT_INUM', 'Invoice Number Format');
define( '_CFG_CUSTOMIZATION_SUB_CAPTCHA', 'ReCAPTACHA');

define( '_CFG_GENERAL_CUSTOMINTRO_NAME', 'Lien personnalis&eacute; de la page d\'introduction:');
define( '_CFG_GENERAL_CUSTOMINTRO_DESC', 'Provide a full link (including http://) that leads to your custom intro page. That page has to contain a link like this: http://www.yourdomain.com/index.php?option=com_acctexp&amp;task=subscribe&amp;intro=1 which bypasses the intro and correctly forwards the user to the payment plans or registration details page. Leave this field blank if you don&amp;acute;t want this at all.');
define( '_CFG_GENERAL_CUSTOMINTRO_USERID_NAME', 'Pass Userid');
define( '_CFG_GENERAL_CUSTOMINTRO_USERID_DESC', 'Pass Userid via a Joomla notification. This can be helpful for flexible custom signup pages that need to function even if the user is not logged in. You can use Javascript to modify your signup links according to the passed userid.');
define( '_CFG_GENERAL_CUSTOMINTRO_ALWAYS_NAME', 'Always Show Intro');
define( '_CFG_GENERAL_CUSTOMINTRO_ALWAYS_DESC', 'Display the Intro regardless of whether the user is already registered.');
define( '_CFG_GENERAL_CUSTOMTHANKS_NAME', 'Lien personnalis&eacute; de la page de remerciement:');
define( '_CFG_GENERAL_CUSTOMTHANKS_DESC', 'Fournir un lien complet (avec http://) qui dirige &agrave; votre page de remerciement personnalis&eacute;e. Laissez ce champ vide si vous n&amp;acute;en voulez.');
define( '_CFG_GENERAL_CUSTOMCANCEL_NAME', 'Lien personnalis&eacute; de la page d\'annulation:');
define( '_CFG_GENERAL_CUSTOMCANCEL_DESC', 'Fournir un lien complet (avec http://) qui dirige &agrave; votre page d&amp;acute;annulation personnalis&eacute;e. Laissez ce champ vide si vous n&amp;acute;en voulez.');
define( '_CFG_GENERAL_TOS_NAME', 'Conditions d\'utilisation:');
define( '_CFG_GENERAL_TOS_DESC', 'Entrez l&amp;acute;URL de conditions d&amp;acute;utilisation. L&amp;acute;utilisateur devra s&eacute;lectionner une case &agrave; cocher lors de la confirmation de son compte. Si laiss&eacute; vide, rien ne sera affich&eacute;.');
define( '_CFG_GENERAL_CUSTOMNOTALLOWED_NAME', 'Lien personnalis&eacute; de la page Non-autoris&eacute;:');
define( '_CFG_GENERAL_CUSTOMNOTALLOWED_DESC', 'Fournir un lien complet (avec http://) qui dirige &agrave; votre page de non autoris&eacute;s personnalis&eacute;e. Laissez ce champ vide si vous n&amp;acute;en voulez.');

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

define( '_CFG_GENERAL_DISPLAY_DATE_FRONTEND_NAME', 'Format de date frontend');
define( '_CFG_GENERAL_DISPLAY_DATE_FRONTEND_DESC', 'Pr&eacute;ciser la fa&ccedil;on dont la date est affich&eacute;e sur le frontend. Reportez-vous au &lt;a href=&quot;http://www.php.net/manual/en/function.strftime.php&quot;&gt;manuel PHP&lt;/a&gt; pour une syntax correct.');
define( '_CFG_GENERAL_DISPLAY_DATE_BACKEND_NAME', 'Format de date Backend');
define( '_CFG_GENERAL_DISPLAY_DATE_BACKEND_DESC', 'Pr&eacute;ciser la fa&ccedil;on dont la date est affich&eacute;e sur le frontend. Reportez-vous au &lt;a href=&quot;http://www.php.net/manual/en/function.strftime.php&quot;&gt;manuel PHP&lt;/a&gt; pour une syntax correct.');

define( '_CFG_GENERAL_INVOICENUM_DOFORMAT_NAME', 'Format du num&eacute;ro de facture');
define( '_CFG_GENERAL_INVOICENUM_DOFORMAT_DESC', 'Display a formatted string instead of the original InvoiceNumber to the user. Must provide a formatting rule below.');
define( '_CFG_GENERAL_INVOICENUM_FORMATTING_NAME', 'Formatting');
define( '_CFG_GENERAL_INVOICENUM_FORMATTING_DESC', 'The Formatting - You can use the RewriteEngine as specified below');

define( '_CFG_GENERAL_CUSTOMTEXT_PLANS_NAME', 'Page de personnalisation des libell&eacute;s de Plan');
define( '_CFG_GENERAL_CUSTOMTEXT_PLANS_DESC', 'Ce texte sera affich&eacute; sur la page du Plan');
define( '_CFG_GENERAL_CUSTOMTEXT_CONFIRM_NAME', 'Texte personnalis&eacute; de la page de confirmation');
define( '_CFG_GENERAL_CUSTOMTEXT_CONFIRM_DESC', 'Texte qui sera affich&eacute; sur la page de confirmation');
define( '_CFG_GENERAL_CUSTOM_CONFIRM_USERDETAILS_NAME', 'Custom Text Confirm Userdetails');
define( '_CFG_GENERAL_CUSTOM_CONFIRM_USERDETAILS_DESC', 'Customize what the Userdetails field will show on Confirmation');
define( '_CFG_GENERAL_CUSTOMTEXT_CHECKOUT_NAME', 'Texte personnalis&eacute; pour la page de Checkout');
define( '_CFG_GENERAL_CUSTOMTEXT_CHECKOUT_DESC', 'Texte qui sera affich&eacute; sur la page de Checkout ');
define( '_CFG_GENERAL_CUSTOMTEXT_NOTALLOWED_NAME', 'Texte personnalis&eacute; de la page NotAllowed');
define( '_CFG_GENERAL_CUSTOMTEXT_NOTALLOWED_DESC', 'Texte qui sera affich&eacute; sur la page NotAllowed ');
define( '_CFG_GENERAL_CUSTOMTEXT_PENDING_NAME', 'Texte personnalis&eacute; de la page Pending (en attente) ');
define( '_CFG_GENERAL_CUSTOMTEXT_PENDING_DESC', 'Texte qui sera affich&eacute; sur la page Pending');
define( '_CFG_GENERAL_CUSTOMTEXT_EXPIRED_NAME', 'Texte personnalis&eacute; de la page Expired');
define( '_CFG_GENERAL_CUSTOMTEXT_EXPIRED_DESC', 'Texte qui sera affich&eacute; sur la page Expired ');

define( '_CFG_GENERAL_CUSTOMTEXT_CONFIRM_KEEPORIGINAL_NAME', 'Keep Original Text');
define( '_CFG_GENERAL_CUSTOMTEXT_CONFIRM_KEEPORIGINAL_DESC', 'Choisissez cette option si vous souhaitez conserver le texte original de la page de Confirmation');
define( '_CFG_GENERAL_CUSTOMTEXT_CHECKOUT_KEEPORIGINAL_NAME', 'Keep Original Text');
define( '_CFG_GENERAL_CUSTOMTEXT_CHECKOUT_KEEPORIGINAL_DESC', 'Choisissez cette option si vous souhaitez conserver le texte original de la page Checkout');
define( '_CFG_GENERAL_CUSTOMTEXT_NOTALLOWED_KEEPORIGINAL_NAME', 'Keep Original Text');
define( '_CFG_GENERAL_CUSTOMTEXT_NOTALLOWED_KEEPORIGINAL_DESC', 'Choisissez cette option si vous souhaitez conserver le texte original de la page NotAllowed');
define( '_CFG_GENERAL_CUSTOMTEXT_PENDING_KEEPORIGINAL_NAME', 'Keep Original Text');
define( '_CFG_GENERAL_CUSTOMTEXT_PENDING_KEEPORIGINAL_DESC', 'Choisissez cette option si vous souhaitez conserver le texte original de la page Pending ');
define( '_CFG_GENERAL_CUSTOMTEXT_EXPIRED_KEEPORIGINAL_NAME', 'Keep Original Text');
define( '_CFG_GENERAL_CUSTOMTEXT_EXPIRED_KEEPORIGINAL_DESC', 'Choisissez cette option si vous souhaitez conserver le texte original de la page Expired');

define( '_CFG_GENERAL_CUSTOMTEXT_THANKS_KEEPORIGINAL_NAME', 'Keep Original Text');
define( '_CFG_GENERAL_CUSTOMTEXT_THANKS_KEEPORIGINAL_DESC', 'Select this option if you want to keep the original text on the ThankYou Page');
define( '_CFG_GENERAL_CUSTOMTEXT_THANKS_NAME', 'Custom Text ThankYou Page');
define( '_CFG_GENERAL_CUSTOMTEXT_THANKS_DESC', 'Text that will be displayed on the ThankYou Page');
define( '_CFG_GENERAL_CUSTOMTEXT_CANCEL_KEEPORIGINAL_NAME', 'Keep Original Text');
define( '_CFG_GENERAL_CUSTOMTEXT_CANCEL_KEEPORIGINAL_DESC', 'Select this option if you want to keep the original text on the Cancel Page');
define( '_CFG_GENERAL_CUSTOMTEXT_CANCEL_NAME', 'Custom Text Cancel Page');
define( '_CFG_GENERAL_CUSTOMTEXT_CANCEL_DESC', 'Text that will be displayed on the Cancel Page');

define( '_CFG_GENERAL_CUSTOMTEXT_HOLD_KEEPORIGINAL_NAME', 'Keep Original Text');
define( '_CFG_GENERAL_CUSTOMTEXT_HOLD_KEEPORIGINAL_DESC', 'Select this option if you want to keep the original text on the Hold Page');
define( '_CFG_GENERAL_CUSTOMTEXT_HOLD_NAME', 'Custom Text Hold Page');
define( '_CFG_GENERAL_CUSTOMTEXT_HOLD_DESC', 'Text that will be displayed on the Hold Page');

define( '_CFG_GENERAL_CUSTOMTEXT_EXCEPTION_KEEPORIGINAL_NAME', 'Keep Original Text');
define( '_CFG_GENERAL_CUSTOMTEXT_EXCEPTION_KEEPORIGINAL_DESC', 'Select this option if you want to keep the original text on the Exception Page');
define( '_CFG_GENERAL_CUSTOMTEXT_EXCEPTION_NAME', 'Custom Text Exception Page');
define( '_CFG_GENERAL_CUSTOMTEXT_EXCEPTION_DESC', 'Text that will be displayed on the Exception Page (typically showing up when a user has to specify which payment processor to use for a shopping cart, or what item a coupon should be applied to).');

define( '_CFG_GENERAL_USE_RECAPTCHA_NAME', 'Utilisation de ReCAPTCHA');
define( '_CFG_GENERAL_USE_RECAPTCHA_DESC', 'Si vous avez un compte pour &lt;a href=&quot;http://recaptcha.net/&quot;&gt;ReCAPTCHA&lt;/a&gt;, vous pouvez activer cette option. N&amp;acute;oubliez pas de mettre la cl&eacute; en dessous.');
define( '_CFG_GENERAL_RECAPTCHA_PRIVATEKEY_NAME', 'Cl&eacute; priv&eacute;e ReCAPTCHA');
define( '_CFG_GENERAL_RECAPTCHA_PRIVATEKEY_DESC', 'Votre cl&eacute; priv&eacute;e ReCAPTCHA .');
define( '_CFG_GENERAL_RECAPTCHA_PUBLICKEY_NAME', 'Cl&eacute; Publique ReCAPTCHA');
define( '_CFG_GENERAL_RECAPTCHA_PUBLICKEY_DESC', 'Votre cl&eacute; publique ReCAPTCHA.');

define( '_CFG_GENERAL_TEMP_AUTH_EXP_NAME', 'Logged-out Invoice Access');
define( '_CFG_GENERAL_TEMP_AUTH_EXP_DESC', 'La dur&eacute;e en minutes pendant laquelle un utilisateur est en mesure d&amp;acute;acc&eacute;der &agrave; une facture en utilisant seulement son userid. A la fin de cette dur&eacute;e, un mot de passe sera demand&eacute; pour acc&eacute;der pendant la m&ecirc;me dur&eacute;e.');

define( '_CFG_GENERAL_HEARTBEAT_CYCLE_BACKEND_NAME', 'Fr&eacute;quence d&amp;acute;ex&eacute;cution Back:');
define( '_CFG_GENERAL_HEARTBEAT_CYCLE_BACKEND_DESC', 'Nombre d&amp;acute;heures que la AEC attend jusqu&amp;acute;a ce qu&amp;acute;un Backend login soit compris comme un d&eacute;clencheur pour envoyer des e-mails ou &agrave; faire d&amp;acute;autres actions que vous avez choisi d&amp;acute;etre effectu&eacute; p&eacute;riodiquement.');
define( '_CFG_GENERAL_ENABLE_COUPONS_NAME', 'Enable Coupons:');
define( '_CFG_GENERAL_ENABLE_COUPONS_DESC', 'Enable the usage of coupons for your subscriptions.');
define( '_CFG_GENERAL_DISPLAYCCINFO_NAME', 'Enable CC Display:');
define( '_CFG_GENERAL_DISPLAYCCINFO_DESC', 'Enable the display of CreditCard icons for each payment processor.');
define( '_CFG_GENERAL_ADMINACCESS_NAME', 'Acc&egrave;s aux Administrateurs:');
define( '_CFG_GENERAL_ADMINACCESS_DESC', 'Grant Access to the AEC not only to Super Administrators, but regular Administrators as well.');
define( '_CFG_GENERAL_NOEMAILS_NAME', 'Pas d&amp;acute;e-mails');
define( '_CFG_GENERAL_NOEMAILS_DESC', 'Activez pour empecher le systeme d&amp;acute;envoi d&amp;acute;email par AEC (to the user in events of invoices paid or alike). Ceci n&amp;acute;affecte pas les emails envoy&eacute;s depuis les MicroIntegrations.');
define( '_CFG_GENERAL_NOJOOMLAREGEMAILS_NAME', 'Pas d&amp;acute;e-mails Joomla');
define( '_CFG_GENERAL_NOJOOMLAREGEMAILS_DESC', 'Ceci empeche l&amp;acute;envoi des emails de confirmation d&amp;acute;enregistrement par Joomla.');
define( '_CFG_GENERAL_DEBUGMODE_NAME', 'Mode Debug');
define( '_CFG_GENERAL_DEBUGMODE_DESC', 'Activates the display of debug information.');
define( '_CFG_GENERAL_OVERRIDE_REQSSL_NAME', 'Override SSL Requirement');
define( '_CFG_GENERAL_OVERRIDE_REQSSL_DESC', 'Some payment processors require an SSL secured connection to the user - for example when sensitive information (like CreditCard data) is required on the frontend.');
define( '_CFG_GENERAL_ALTSSLURL_NAME', 'Alternative SSL Url');
define( '_CFG_GENERAL_ALTSSLURL_DESC', 'Use this URL instead of the base url that is configured in Joomla! when routing through SSL.');
define( '_CFG_GENERAL_OVERRIDEJ15_NAME', 'Override Joomla 1.5 Integration');
define( '_CFG_GENERAL_OVERRIDEJ15_DESC', 'Some Addons trick a 1.0 Joomla into believing it really is 1.5 (you know who you are! stop it!) - which AEC follows and fails. This makes a permanent switch forcing 1.0 mode.');
define( '_CFG_GENERAL_SSL_SIGNUP_NAME', 'SSL Signup');
define( '_CFG_GENERAL_SSL_SIGNUP_DESC', 'Use SSL Encryption on all links that have to do with the user singing up within the AEC.');
define( '_CFG_GENERAL_SSL_PROFILE_NAME', 'SSL Profile');
define( '_CFG_GENERAL_SSL_PROFILE_DESC', 'Use SSL Encryption on all links that have to do with the user accessing the profile (MySubscription page).');
define( '_CFG_GENERAL_SSL_VERIFYPEER_NAME', 'SSL Peer Verification');
define( '_CFG_GENERAL_SSL_VERIFYPEER_DESC', 'When using cURL, make it verify the peer\'s certificate. Alternate certificates to verify against can be specified with the options below');
define( '_CFG_GENERAL_SSL_VERIFYHOST_NAME', 'SSL Host Verification');
define( '_CFG_GENERAL_SSL_VERIFYHOST_DESC', 'Defines what kind of verification against the peer\'s certificate you want.');
define( '_CFG_GENERAL_SSL_CAINFO_NAME', 'Certificate File');
define( '_CFG_GENERAL_SSL_CAINFO_DESC', 'The name of a file holding one or more certificates to verify the peer with. This only makes sense when used in combination with Peer Verification.');
define( '_CFG_GENERAL_SSL_CAPATH_NAME', 'Certificate Directory');
define( '_CFG_GENERAL_SSL_CAPATH_DESC', 'A directory that holds multiple CA certificates. Use this option alongside Peer Verification.');
define( '_CFG_GENERAL_USE_PROXY_NAME', 'Use Proxy');
define( '_CFG_GENERAL_USE_PROXY_DESC', 'Use a proxy server for all outgoing requests.');
define( '_CFG_GENERAL_PROXY_NAME', 'Proxy Address');
define( '_CFG_GENERAL_PROXY_DESC', 'Specify the proxy server that you want to connect to.');
define( '_CFG_GENERAL_PROXY_PORT_NAME', 'Proxy Port');
define( '_CFG_GENERAL_PROXY_PORT_DESC', 'Specify the proxy server port that you want to connect to.');
define( '_CFG_GENERAL_PROXY_USERNAME_NAME', 'Proxy Username');
define( '_CFG_GENERAL_PROXY_USERNAME_DESC', 'If your proxy needs a custom login, put the username here.');
define( '_CFG_GENERAL_PROXY_PASSWORD_NAME', 'Proxy Password');
define( '_CFG_GENERAL_PROXY_PASSWORD_DESC', 'If your proxy needs a custom login, put the password here.');
define( '_CFG_GENERAL_GETHOSTBYADDR_NAME', 'Log Host with IP');
define( '_CFG_GENERAL_GETHOSTBYADDR_DESC', 'On logging Events that store an IP address, this option will also store the internet host name as well. In some hosting situations, this can take over a minute and thus should be disabled.');
define( '_CFG_GENERAL_RENEW_BUTTON_NEVER_NAME', 'No Renew Button');
define( '_CFG_GENERAL_RENEW_BUTTON_NEVER_DESC', 'Select "Yes" to never show the renew/upgrade button on the MySubscription page.');
define( '_CFG_GENERAL_RENEW_BUTTON_NOLIFETIMERECURRING_NAME', 'Restricted Renew Button');
define( '_CFG_GENERAL_RENEW_BUTTON_NOLIFETIMERECURRING_DESC', 'Only show the renew button if it makes sense in a one-subscription setup (recurring payments or a lifetime make the button disappear).');
define( '_CFG_GENERAL_CONTINUE_BUTTON_NAME', 'Continue Button');
define( '_CFG_GENERAL_CONTINUE_BUTTON_DESC', 'If the user has had a membership before, this button will show up on the expiration screen and link directly to the previous plan, so that the user is quicker to continue the membership as it was before');

define( '_CFG_GENERAL_ERROR_NOTIFICATION_LEVEL_NAME', 'Niveau de Log');
define( '_CFG_GENERAL_ERROR_NOTIFICATION_LEVEL_DESC', 'Select which level of entries to the EventLog is required to make it appear on the central page for your convenience.');
define( '_CFG_GENERAL_EMAIL_NOTIFICATION_LEVEL_NAME', 'Niveau alerte e-mail');
define( '_CFG_GENERAL_EMAIL_NOTIFICATION_LEVEL_DESC', 'Select which level of entries to the EventLog is required to make the AEC send them as an E-Mail to all Administrators.');

define( '_CFG_GENERAL_SKIP_CONFIRMATION_NAME', 'Skip Confirmation');
define( '_CFG_GENERAL_SKIP_CONFIRMATION_DESC', 'Do not display a Confirmation screen before checkout (which lets the user revisit the current decision).');
define( '_CFG_GENERAL_SHOW_FIXEDDECISION_NAME', 'Show Fixed Decisions');
define( '_CFG_GENERAL_SHOW_FIXEDDECISION_DESC', 'The AEC normally skips the payment plans page if there is no decision to be made (one payment plan with only one processor). With this option, you can force it to display the page.');
define( '_CFG_GENERAL_CONFIRMATION_COUPONS_NAME', 'Coupons on Confirmation');
define( '_CFG_GENERAL_CONFIRMATION_COUPONS_DESC', 'Offer to provide coupon codes when clicking the Confirm Button on the Confirmation page');
define( '_CFG_GENERAL_BREAKON_MI_ERROR_NAME', 'Break on MI Error');
define( '_CFG_GENERAL_BREAKON_MI_ERROR_DESC', 'Stop plan application if one of its attached MIs encounters an error (there will be trace in the eventlog either way)');

define( '_CFG_GENERAL_ENABLE_SHOPPINGCART_NAME', 'Enable Shopping Cart');
define( '_CFG_GENERAL_ENABLE_SHOPPINGCART_DESC', 'Handle purchases via shopping cart. Available only for logged-in users.');
define( '_CFG_GENERAL_CUSTOMLINK_CONTINUESHOPPING_NAME', 'Custom Continue Shopping Link');
define( '_CFG_GENERAL_CUSTOMLINK_CONTINUESHOPPING_DESC', 'Instead of routing a user to the standard subscription page, route here.');
define( '_CFG_GENERAL_ADDITEM_STAYONPAGE_NAME', 'Stay on Page');
define( '_CFG_GENERAL_ADDITEM_STAYONPAGE_DESC', 'Instead of moving to the shopping cart after selecting an item, stay on the same page.');

define( '_CFG_GENERAL_CURL_DEFAULT_NAME', 'Use cURL');
define( '_CFG_GENERAL_CURL_DEFAULT_DESC', 'Use cURL instead of fsockopen as default (will fall back to the other one if the first choice fails)');
define( '_CFG_GENERAL_AMOUNT_CURRENCY_SYMBOL_NAME', 'Currency Symbol');
define( '_CFG_GENERAL_AMOUNT_CURRENCY_SYMBOL_DESC', 'Display a currency symbol (if one exists) instead of the ISO abbreviation');
define( '_CFG_GENERAL_AMOUNT_CURRENCY_SYMBOLFIRST_NAME', 'Currency first');
define( '_CFG_GENERAL_AMOUNT_CURRENCY_SYMBOLFIRST_DESC', 'Display the currency in front of the amount');
define( '_CFG_GENERAL_AMOUNT_USE_COMMA_NAME', 'Use Comma');
define( '_CFG_GENERAL_AMOUNT_USE_COMMA_DESC', 'Use a comma instead of a dot in amounts');
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
define( '_CFG_GENERAL_SENDINVOICE_NAME', 'Send an invoice email');
define( '_CFG_GENERAL_SENDINVOICE_DESC', 'Send and invoice/purchase order email (for tax reasons)');
define( '_CFG_GENERAL_INVOICETMPL_NAME', 'Invoice Template');
define( '_CFG_GENERAL_INVOICETMPL_DESC', 'Template for invoices/purchase orders');

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

define( '_PAYPLAN_PERUNIT1', 'Jours');
define( '_PAYPLAN_PERUNIT2', 'Semaines');
define( '_PAYPLAN_PERUNIT3', 'Mois');
define( '_PAYPLAN_PERUNIT4', 'Ann&eacute;es');

// General Params

define( '_PAYPLAN_DETAIL_TITLE', 'Plan');
define( '_PAYPLAN_GENERAL_NAME_NAME', 'Nom:');
define( '_PAYPLAN_GENERAL_NAME_DESC', 'Nom ou titre pour ce Plan. Max.: 40 caracteres.');
define( '_PAYPLAN_GENERAL_DESC_NAME', 'Description:');
define( '_PAYPLAN_GENERAL_DESC_DESC', 'Full description of plan as you want to be presented to user. Max.: 255 characters.');
define( '_PAYPLAN_GENERAL_ACTIVE_NAME', 'Publi&eacute;:');
define( '_PAYPLAN_GENERAL_ACTIVE_DESC', 'Un Plan publi&eacute; sera accessible aux utilisateurs sur le Frontend.');
define( '_PAYPLAN_GENERAL_VISIBLE_NAME', 'Visible:');
define( '_PAYPLAN_GENERAL_VISIBLE_DESC', 'Seuls les Plans Visibles seront montr&eacute;s sur le frontend. Les plans invisibles ne seront pas montr&eacute;s et seront seulement accessibles par les applications automatiques (like Fallbacks or Entry Plans).');

define( '_PAYPLAN_GENERAL_CUSTOMAMOUNTFORMAT_NAME', 'Custom amount formatting:');
define( '_PAYPLAN_GENERAL_CUSTOMAMOUNTFORMAT_DESC', 'Please use a aecJSON string like the one already filled in to modify how the cost of this plan are displayed.');
define( '_PAYPLAN_GENERAL_CUSTOMTHANKS_NAME', 'Custom thanks page link:');
define( '_PAYPLAN_GENERAL_CUSTOMTHANKS_DESC', 'Provide a full link (including http://) that leads to your custom thanks page. Leave this field blank if you don\'t want this at all.');
define( '_PAYPLAN_GENERAL_CUSTOMTEXT_THANKS_KEEPORIGINAL_NAME', 'Keep Original Text');
define( '_PAYPLAN_GENERAL_CUSTOMTEXT_THANKS_KEEPORIGINAL_DESC', 'Select this option if you want to keep the original text on the ThankYou Page');
define( '_PAYPLAN_GENERAL_CUSTOMTEXT_THANKS_NAME', 'Custom Text ThankYou Page');
define( '_PAYPLAN_GENERAL_CUSTOMTEXT_THANKS_DESC', 'Text that will be displayed on the ThankYou Page');

define( '_PAYPLAN_PARAMS_OVERRIDE_ACTIVATION_NAME', 'Override Activation');
define( '_PAYPLAN_PARAMS_OVERRIDE_ACTIVATION_DESC', 'Override the requirement for a user to activate the account (via email activation code) in case this payment plan is used with a registration.');
define( '_PAYPLAN_PARAMS_OVERRIDE_REGMAIL_NAME', 'Override Registration Email');
define( '_PAYPLAN_PARAMS_OVERRIDE_REGMAIL_DESC', 'Do not send out any Registration Email (makes sense for paid plans which do not need activation and where an email would be sent out when the payment arrives - with the email MI).');

define( '_PAYPLAN_PARAMS_GID_ENABLED_NAME', 'Activer les groupes');
define( '_PAYPLAN_PARAMS_GID_ENABLED_DESC', 'Positionnez &agrave;  Yes si vous voulez affecter les utilisateurs au groupe choisi.');
define( '_PAYPLAN_PARAMS_GID_NAME', 'Ajouter au groupe:');
define( '_PAYPLAN_PARAMS_GID_DESC', 'Les utilisateurs seront affect&eacute;s au groupe correspondant quand le plan sera appliqu&eacute;.');
define( '_PAYPLAN_PARAMS_MAKE_ACTIVE_NAME', 'Activation auto:');
define( '_PAYPLAN_PARAMS_MAKE_ACTIVE_DESC', 'Positionnez &agrave; &gt;No&lt; si vous voulez activer manuellement un utilisateur apr&egrave;s son paiement.');
define( '_PAYPLAN_PARAMS_MAKE_PRIMARY_NAME', 'Plan initial:');
define( '_PAYPLAN_PARAMS_MAKE_PRIMARY_DESC', 'Positionnez &agrave;  &quot;Yes&quot; pour que ce plan soit le plan primaire de l&amp;acute;utilisateur. Le plan primaire est celui qui pilote le processus d&amp;acute;expiration.');
define( '_PAYPLAN_PARAMS_UPDATE_EXISTING_NAME', 'Modifie les Plans existants:');
define( '_PAYPLAN_PARAMS_UPDATE_EXISTING_DESC', 'If not a primary plan, should this plan update other existing non-primary subscriptions of the user? This can be helpful for secondary subscriptions of which the user should have only one at a time.');

define( '_PAYPLAN_TEXT_TITLE', 'Plan Text');
define( '_PAYPLAN_GENERAL_EMAIL_DESC_NAME', 'Email Description:');
define( '_PAYPLAN_GENERAL_EMAIL_DESC_DESC', 'Texte qui sera ajout&eacute; dans l&amp;acute;email que l&amp;acute;utilisateur recevra pour l&amp;acute;activation de son plan');
define( '_PAYPLAN_GENERAL_FALLBACK_NAME', 'Plan d&amp;acute;expiration:');
define( '_PAYPLAN_GENERAL_FALLBACK_DESC', 'Quand l&amp;acute;abonnement d&amp;acute;un utilisateur se termine - l&amp;acute;affecter a ce plan');
define( '_PAYPLAN_GENERAL_STANDARD_PARENT_NAME', 'Standard Parent Plan');
define( '_PAYPLAN_GENERAL_STANDARD_PARENT_DESC', 'Currently assigns this plan as the users root membership in case he or she signs up only for a secondary plan.');

define( '_PAYPLAN_GENERAL_PROCESSORS_NAME', 'Payment Gateways:');
define( '_PAYPLAN_NOPLAN', 'Pas de Plan');
define( '_PAYPLAN_NOGW', 'No Gateway');
define( '_PAYPLAN_GENERAL_PROCESSORS_DESC', 'Select the payment gateways you want to be available to this plan. Hold Control or Shift key to select multiple options. Selecting ' . _PAYPLAN_NOPLAN . ' all other selected options will be ignored. If you see only ' . _PAYPLAN_NOPLAN . ' here this means you have no payment processor enabled on your config settings.');
define( '_PAYPLAN_PARAMS_LIFETIME_NAME', 'Illimit&eacute;:');
define( '_PAYPLAN_PARAMS_LIFETIME_DESC', 'Rend cet abonnement illimit&eacute; dans le temps. Il n&amp;acute;expirera jamais.');

define( '_PAYPLAN_AMOUNT_NOTICE', 'Notice on Periods');
define( '_PAYPLAN_AMOUNT_NOTICE_TEXT', 'Pour les souscriptions Paypal, il y a une limite sur le montant maximum pour une p&eacute;riode donn&eacute;e. Si vous souhaitez utiliser Paypal, &lt;strong&gt;limitez le nombre de jours &agrave; 90, de semaines &agrave; 52, de mois &agrave; 24 et d\'ann&eacute;es &agrave; 5 au maximum&lt;/strong&gt;.');
define( '_PAYPLAN_AMOUNT_EDITABLE_NOTICE', 'There is one or more users using recurring payments for this plan, so it would be wise not to change the terms until these are cancelled.');

define( '_PAYPLAN_REGULAR_TITLE', 'Abonnement normal');
define( '_PAYPLAN_PARAMS_FULL_FREE_NAME', 'Gratuit:');
define( '_PAYPLAN_PARAMS_FULL_FREE_DESC', 'S&eacute;lectionnez OUI si vous souhaitez offrir ce plan gratuitement');
define( '_PAYPLAN_PARAMS_FULL_AMOUNT_NAME', 'Taux normal:');
define( '_PAYPLAN_PARAMS_FULL_AMOUNT_DESC', 'Le prix de l&amp;acute;abonnement. S&amp;acute;il y a deja des souscripteurs &agrave; ce Plan, alors ce champ ne pourra &ecirc;tre chang&eacute;. Si vous souhaitez remplacer ce Plan, d&eacute;publiez-le et cr&eacute;ez en un nouveau.');
define( '_PAYPLAN_PARAMS_FULL_PERIOD_NAME', 'Periodicit&eacute;:');
define( '_PAYPLAN_PARAMS_FULL_PERIOD_DESC', 'La dur&eacute;e du cycle de paiement. En liaison avec l&amp;acute;Unit&eacute; (ci-apr&egrave;s).  S&amp;acute;il y a deja des souscripteurs &agrave; ce Plan, alors ce champ ne pourra &ecirc;tre chang&eacute;. Si vous souhaitez remplacer ce Plan, d&eacute;publiez-le et cr&eacute;ez en un nouveau.');
define( '_PAYPLAN_PARAMS_FULL_PERIODUNIT_NAME', 'Unit&eacute;:');
define( '_PAYPLAN_PARAMS_FULL_PERIODUNIT_DESC', 'Unit&eacute; du cycle de paiement r&eacute;gulier. S&amp;acute;il y a deja des souscripteurs &agrave; ce Plan, alors ce champ ne pourra &ecirc;tre chang&eacute;. Si vous souhaitez remplacer ce Plan, d&eacute;publiez-le et cr&eacute;ez en un nouveau.');

define( '_PAYPLAN_TRIAL_TITLE', 'Periode d\'essai');
define( '_PAYPLAN_TRIAL', '(Optionnel)');
define( '_PAYPLAN_TRIAL_DESC', 'Sautez cette section si vous ne voulez pas d&amp;acute;offre avec des p&eacute;riodes d&amp;acute;essai avec vos abonnements. &lt;strong&gt;Les essais fonctionnent uniquement automatiquement avec abonnements PayPal!&lt;/strong&gt;');
define( '_PAYPLAN_PARAMS_TRIAL_FREE_NAME', 'Gratuit:');
define( '_PAYPLAN_PARAMS_TRIAL_FREE_DESC', 'S&eacute;lectionnez OUI si vous souhaitez offrir ce plan d&amp;acute;essai gratuitement');
define( '_PAYPLAN_PARAMS_TRIAL_AMOUNT_NAME', 'Montant d&amp;acute;essai:');
define( '_PAYPLAN_PARAMS_TRIAL_AMOUNT_DESC', 'Indiquez le montant a facturer directement a l&amp;acute;abonn&eacute;.');
define( '_PAYPLAN_PARAMS_TRIAL_PERIOD_NAME', 'P&eacute;riode:');
define( '_PAYPLAN_PARAMS_TRIAL_PERIOD_DESC', 'C&amp;acute;est la dur&eacute;e de la p&eacute;riode d&amp;acute;essai. Le nombre est modifi&eacute; par le cycle r&eacute;gulier d&amp;acute;unit&eacute; de facturation (en dessous).  S&amp;acute;il y a des abonn&eacute;s &agrave; ce plan, ce champ ne peut pas &ecirc;tre chang&eacute;. Si vous souhaitez remplacer ce plan, d&eacute;publiez-le et cr&eacute;ez un nouveau.');
define( '_PAYPLAN_PARAMS_TRIAL_PERIODUNIT_NAME', 'Unit&eacute;:');
define( '_PAYPLAN_PARAMS_TRIAL_PERIODUNIT_DESC', 'Il s&amp;acute;agit d&amp;acute;unit&eacute;s de la p&eacute;riode d&amp;acute;essai (au-dessus). S&amp;acute;il y a des abonn&eacute;s &agrave; ce plan ce champ ne peut pas &ecirc;tre chang&eacute;. Si vous souhaitez remplacer ce plan, d&eacute;publiez-le et cr&eacute;ez un nouveau.');

define( '_PAYPLAN_PARAMS_NOTAUTH_REDIRECT_NAME', 'Denied Access Redirect');
define( '_PAYPLAN_PARAMS_NOTAUTH_REDIRECT_DESC', 'Redirect to a different URL should the user follow a direct link to this item without having the right authorization.');

// Payplan Relations

define( '_PAYPLAN_RELATIONS_TITLE', 'Relations');
define( '_PAYPLAN_PARAMS_SIMILARPLANS_NAME', 'Plans similaires:');
define( '_PAYPLAN_PARAMS_SIMILARPLANS_DESC', 'S&eacute;lectionnez les plans qui sont similaires &agrave; celui-ci. Un utilisateur n est pas autoris&eacute; &agrave; utiliser une p&eacute;riode d essai lors de l achat d un plan qu il ou elle a d&eacute;j&agrave; achet&eacute; et ce sera &eacute;galement le m&ecirc;me pour des plans similaires.');
define( '_PAYPLAN_PARAMS_EQUALPLANS_NAME', 'Plans identiques:');
define( '_PAYPLAN_PARAMS_EQUALPLANS_DESC', 'S&eacute;lectionnez les plans identique &agrave; celui-ci. Un utilisateur qui change entre plans identiques dispose de sa p&eacute;riode prolong&eacute;e au lieu de r&eacute;initialisation. Les essais ne sont &eacute;galement pas autoris&eacute;s (voir les informations des plans similaires).');

// Payplan Restrictions

define( '_PAYPLAN_RESTRICTIONS_TITLE', 'Restrictions');

define( '_PAYPLAN_RESTRICTIONS_MINGID_ENABLED_NAME', 'Activer Min GID:');
define( '_PAYPLAN_RESTRICTIONS_MINGID_ENABLED_DESC', 'Activez ce param&egrave;tre si vous souhaitez restreindre l affichage de ce plan &agrave; des utilisateurs en utilisant un groupe d utilisateur minimum.');
define( '_PAYPLAN_RESTRICTIONS_MINGID_NAME', 'Visible au groupe:');
define( '_PAYPLAN_RESTRICTIONS_MINGID_DESC', 'Le niveau minimum requis de l utilisateur pour voir ce plan lors de l affichage des plans de paiement. Les nouveaux utilisateurs verront toujours les plans avec le plus bas GID disponible.');
define( '_PAYPLAN_RESTRICTIONS_FIXGID_ENABLED_NAME', 'Activer fixe GID:');
define( '_PAYPLAN_RESTRICTIONS_FIXGID_ENABLED_DESC', 'Activez ce param&egrave;tre si vous souhaitez restreindre ce plan &agrave; un groupe d utilisateur.');
define( '_PAYPLAN_RESTRICTIONS_FIXGID_NAME', 'D&eacute;finir le groupe:');
define( '_PAYPLAN_RESTRICTIONS_FIXGID_DESC', 'Seuls les utilisateurs de ce groupe peuvent consulter ce plan.');
define( '_PAYPLAN_RESTRICTIONS_MAXGID_ENABLED_NAME', 'Activer Max GID:');
define( '_PAYPLAN_RESTRICTIONS_MAXGID_ENABLED_DESC', 'Activez ce param&egrave;tre si vous souhaitez restreindre l affichage de ce plan &agrave; des utilisateurs en utilisant un groupe d utilisateur maximum.');
define( '_PAYPLAN_RESTRICTIONS_MAXGID_NAME', 'Maximum groupe:');
define( '_PAYPLAN_RESTRICTIONS_MAXGID_DESC', 'Le niveau maximum requis de l utilisateur pour voir ce plan lors de l affichage des plans de paiement.');

define( '_PAYPLAN_RESTRICTIONS_PREVIOUSPLAN_REQ_ENABLED_NAME', 'Plan pr&eacute;c. requis:');
define( '_PAYPLAN_RESTRICTIONS_PREVIOUSPLAN_REQ_ENABLED_DESC', 'Enable checking for previous payment plan');
define( '_PAYPLAN_RESTRICTIONS_PREVIOUSPLAN_REQ_NAME', 'Plan:');
define( '_PAYPLAN_RESTRICTIONS_PREVIOUSPLAN_REQ_DESC', 'A user will only see this plan if he or she used the selected plan before the one currently in use');
define( '_PAYPLAN_RESTRICTIONS_CURRENTPLAN_REQ_ENABLED_NAME', 'Required Curr. Plan:');
define( '_PAYPLAN_RESTRICTIONS_CURRENTPLAN_REQ_ENABLED_DESC', 'Enable checking for currently present payment plan');
define( '_PAYPLAN_RESTRICTIONS_CURRENTPLAN_REQ_NAME', 'Plan:');
define( '_PAYPLAN_RESTRICTIONS_CURRENTPLAN_REQ_DESC', 'A user will only see this plan if he or she is currently assigned to, or has expired from the plan selected here');
define( '_PAYPLAN_RESTRICTIONS_OVERALLPLAN_REQ_ENABLED_NAME', 'Required Used Plan:');
define( '_PAYPLAN_RESTRICTIONS_OVERALLPLAN_REQ_ENABLED_DESC', 'Enable checking for overall used payment plan');
define( '_PAYPLAN_RESTRICTIONS_OVERALLPLAN_REQ_NAME', 'Plan:');
define( '_PAYPLAN_RESTRICTIONS_OVERALLPLAN_REQ_DESC', 'A user will only see this plan if he or she has used the selected plan once, no matter when');

define( '_PAYPLAN_RESTRICTIONS_PREVIOUSPLAN_REQ_ENABLED_EXCLUDED_NAME', 'Excluded Prev. Plan:');
define( '_PAYPLAN_RESTRICTIONS_PREVIOUSPLAN_REQ_ENABLED_EXCLUDED_DESC', 'Do NOT show this plan to users who had the selected plan as their previous payment plan');
define( '_PAYPLAN_RESTRICTIONS_PREVIOUSPLAN_REQ_EXCLUDED_NAME', 'Plan:');
define( '_PAYPLAN_RESTRICTIONS_PREVIOUSPLAN_REQ_EXCLUDED_DESC', 'A user will not see this plan if he or she used the selected plan before the one currently in use');
define( '_PAYPLAN_RESTRICTIONS_CURRENTPLAN_REQ_ENABLED_EXCLUDED_NAME', 'Excluded Curr. Plan:');
define( '_PAYPLAN_RESTRICTIONS_CURRENTPLAN_REQ_ENABLED_EXCLUDED_DESC', 'Do NOT show this plan to users who have the selected plan as their currently present payment plan');
define( '_PAYPLAN_RESTRICTIONS_CURRENTPLAN_REQ_EXCLUDED_NAME', 'Plan:');
define( '_PAYPLAN_RESTRICTIONS_CURRENTPLAN_REQ_EXCLUDED_DESC', 'A user will not see this plan if he or she is currently assigned to, or has just expired from the plan selected here');
define( '_PAYPLAN_RESTRICTIONS_OVERALLPLAN_REQ_ENABLED_EXCLUDED_NAME', 'Excluded Used Plan:');
define( '_PAYPLAN_RESTRICTIONS_OVERALLPLAN_REQ_ENABLED_EXCLUDED_DESC', 'Do NOT show this plan to users who have used the selected plan before');
define( '_PAYPLAN_RESTRICTIONS_OVERALLPLAN_REQ_EXCLUDED_NAME', 'Plan:');
define( '_PAYPLAN_RESTRICTIONS_OVERALLPLAN_REQ_EXCLUDED_DESC', 'A user will not see this plan if he or she has used the selected plan once, no matter when');

define( '_PAYPLAN_RESTRICTIONS_USED_PLAN_MIN_ENABLED_NAME', 'Min Used Plan:');
define( '_PAYPLAN_RESTRICTIONS_USED_PLAN_MIN_ENABLED_DESC', 'Enable checking for the minimum number of times your consumers have subscribed to a specified payment plan in order to see THIS plan');
define( '_PAYPLAN_RESTRICTIONS_USED_PLAN_MIN_AMOUNT_NAME', 'Used Amount:');
define( '_PAYPLAN_RESTRICTIONS_USED_PLAN_MIN_AMOUNT_DESC', 'The minimum amount a user has to have used the selected plan');
define( '_PAYPLAN_RESTRICTIONS_USED_PLAN_MIN_NAME', 'Plan:');
define( '_PAYPLAN_RESTRICTIONS_USED_PLAN_MIN_DESC', 'The payment plan that the user has to have used the specified number of times at least');
define( '_PAYPLAN_RESTRICTIONS_USED_PLAN_MAX_ENABLED_NAME', 'Max Used Plan:');
define( '_PAYPLAN_RESTRICTIONS_USED_PLAN_MAX_ENABLED_DESC', 'Enable checking for the maximum number of times your consumers have subscribed to a specified payment plan in order to see THIS plan');
define( '_PAYPLAN_RESTRICTIONS_USED_PLAN_MAX_AMOUNT_NAME', 'Used Amount:');
define( '_PAYPLAN_RESTRICTIONS_USED_PLAN_MAX_AMOUNT_DESC', 'The maximum amount a user can have used the selected plan');
define( '_PAYPLAN_RESTRICTIONS_USED_PLAN_MAX_NAME', 'Plan:');
define( '_PAYPLAN_RESTRICTIONS_USED_PLAN_MAX_DESC', 'The payment plan that the user has to have used the specified number of times at most');

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

define( '_PAYPLAN_RESTRICTIONS_CUSTOM_RESTRICTIONS_ENABLED_NAME', 'Use Custom Restrictions:');
define( '_PAYPLAN_RESTRICTIONS_CUSTOM_RESTRICTIONS_ENABLED_DESC', 'Enable the use of the below specified restrictions');
define( '_PAYPLAN_RESTRICTIONS_CUSTOM_RESTRICTIONS_NAME', 'Custom Restrictions:');
define( '_PAYPLAN_RESTRICTIONS_CUSTOM_RESTRICTIONS_DESC', 'Use RewriteEngine fields to check for specific strings in this form:&lt;br /&gt;[[user_id]] &gt;= 1500&lt;br /&gt;[[parametername]] = value&lt;br /&gt;(Create separate rules by entering a new line).&lt;br /&gt;You can use =, &lt;=, &gt;=, &lt;, &gt;, &lt;&gt; as comparing elements. You MUST use spaces between parameters, values and comparators!');

define( '_PAYPLAN_PROCESSORS_TITLE', 'Processus');
define( '_PAYPLAN_PROCESSORS_TITLE_LONG', 'Processus de Payment');

define( '_PAYPLAN_PROCESSORS_ACTIVATE_NAME', 'Actif');
define( '_PAYPLAN_PROCESSORS_ACTIVATE_DESC', 'Proposer ce processus de paiement pour ce plan de paiement.');
define( '_PAYPLAN_PROCESSORS_OVERWRITE_SETTINGS_NAME', 'Ecraser param&egrave;tres globaux');
define( '_PAYPLAN_PROCESSORS_OVERWRITE_SETTINGS_DESC', 'Si vous voulez, vous pouvez cocher la case et apr&egrave;s avoir sauvegard&eacute; le plan, modifier tous les param&egrave;tres dans la configuration globale &agrave; l&amp;acute;exception pour ce plan.');

define( '_PAYPLAN_MI', 'Micro Integr.');
define( '_PAYPLAN_GENERAL_MICRO_INTEGRATIONS_NAME', 'Micro Int&eacute;grations:');
define( '_PAYPLAN_GENERAL_MICRO_INTEGRATIONS_DESC', 'S&eacute;lectionner les Micro Int&eacute;grations que vous voulez appliquer &agrave; l&amp;acute;utilisateur avec le plan.');
define( '_PAYPLAN_GENERAL_MICRO_INTEGRATIONS_PLAN_NAME', 'Local Micro Integrations:');
define( '_PAYPLAN_GENERAL_MICRO_INTEGRATIONS_PLAN_DESC', 'Select the Micro Integrations that you want to apply to the user with the plan. Instead of global instances, these MIs will be specific only to this payment plan.');
define( '_PAYPLAN_GENERAL_MICRO_INTEGRATIONS_INHERITED_NAME', 'Inherited:');
define( '_PAYPLAN_GENERAL_MICRO_INTEGRATIONS_INHERITED_DESC', 'Shows which Micro Integrations are inherited from parent groups that this plan is a member of.');

define( '_PAYPLAN_CURRENCY', 'Devises');

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

define( '_CURRENCY_AFA', 'Afghani');
define( '_CURRENCY_ALL', 'Lek');
define( '_CURRENCY_DZD', 'Algerian Dinar');
define( '_CURRENCY_ADP', 'Andorran Peseta');
define( '_CURRENCY_AON', 'New Kwanza');
define( '_CURRENCY_ARS', 'Argentine Peso');
define( '_CURRENCY_AMD', 'Armenian Dram');
define( '_CURRENCY_AWG', 'Aruban Guilder');
define( '_CURRENCY_AUD', 'Australian Dollar');
define( '_CURRENCY_AZM', 'Azerbaijanian Manat ');
define( '_CURRENCY_EUR', 'Euro');
define( '_CURRENCY_BSD', 'Bahamian Dollar');
define( '_CURRENCY_BHD', 'Bahraini Dinar');
define( '_CURRENCY_BDT', 'Taka');
define( '_CURRENCY_BBD', 'Barbados Dollar');
define( '_CURRENCY_BYB', 'Belarussian Ruble');
define( '_CURRENCY_BEF', 'Belgian Franc');
define( '_CURRENCY_BZD', 'Belize Dollar');
define( '_CURRENCY_BMD', 'Bermudian Dollar');
define( '_CURRENCY_BOB', 'Boliviano');
define( '_CURRENCY_BAD', 'Bosnian Dinar');
define( '_CURRENCY_BWP', 'Pula');
define( '_CURRENCY_BRL', 'Real');
define( '_CURRENCY_BND', 'Brunei Dollar');
define( '_CURRENCY_BGL', 'Lev');
define( '_CURRENCY_BGN', 'Lev');
define( '_CURRENCY_XOF', 'CFA Franc BCEAO');
define( '_CURRENCY_BIF', 'Burundi Franc');
define( '_CURRENCY_KHR', 'Cambodia Riel');
define( '_CURRENCY_XAF', 'CFA Franc BEAC');
define( '_CURRENCY_CAD', 'Dollar Canadien');
define( '_CURRENCY_CVE', 'Cape Verde Escudo');
define( '_CURRENCY_KYD', 'Cayman Islands Dollar');
define( '_CURRENCY_CLP', 'Chilean Peso');
define( '_CURRENCY_CNY', 'Yuan Renminbi');
define( '_CURRENCY_COP', 'Colombian Peso');
define( '_CURRENCY_KMF', 'Comoro Franc');
define( '_CURRENCY_BAM', 'Convertible Marks');
define( '_CURRENCY_CRC', 'Costa Rican Colon');
define( '_CURRENCY_HRK', 'Croatian Kuna');
define( '_CURRENCY_CUP', 'Cuban Peso');
define( '_CURRENCY_CYP', 'Cyprus Pound');
define( '_CURRENCY_CZK', 'Czech Koruna');
define( '_CURRENCY_DKK', 'Danish Krone');
define( '_CURRENCY_DEM', 'Deutsche Mark');
define( '_CURRENCY_DJF', 'Djibouti Franc');
define( '_CURRENCY_XCD', 'East Caribbean Dollar');
define( '_CURRENCY_DOP', 'Dominican Peso');
define( '_CURRENCY_GRD', 'Drachma');
define( '_CURRENCY_TPE', 'Timor Escudo');
define( '_CURRENCY_ECS', 'Ecuador Sucre');
define( '_CURRENCY_EGP', 'Egyptian Pound');
define( '_CURRENCY_SVC', 'El Salvador Colon');
define( '_CURRENCY_EEK', 'Kroon');
define( '_CURRENCY_ETB', 'Ethiopian Birr');
define( '_CURRENCY_FKP', 'Falkland Islands Pound');
define( '_CURRENCY_FJD', 'Fiji Dollar');
define( '_CURRENCY_XPF', 'CFP Franc');
define( '_CURRENCY_FRF', 'Franc');
define( '_CURRENCY_CDF', 'Franc Congolais');
define( '_CURRENCY_GMD', 'Dalasi');
define( '_CURRENCY_GHC', 'Cedi');
define( '_CURRENCY_GIP', 'Gibraltar Pound');
define( '_CURRENCY_GTQ', 'Quetzal');
define( '_CURRENCY_GNF', 'Guinea Franc');
define( '_CURRENCY_GWP', 'Guinea - Bissau Peso');
define( '_CURRENCY_GYD', 'Guyana Dollar');
define( '_CURRENCY_HTG', 'Gourde');
define( '_CURRENCY_XAU', 'Gold');
define( '_CURRENCY_HNL', 'Lempira');
define( '_CURRENCY_HKD', 'Hong Kong Dollar');
define( '_CURRENCY_HUF', 'Forint');
define( '_CURRENCY_ISK', 'Iceland Krona');
define( '_CURRENCY_INR', 'Indian Rupee');
define( '_CURRENCY_IDR', 'Rupiah');
define( '_CURRENCY_IRR', 'Iranian Rial');
define( '_CURRENCY_IQD', 'Iraqi Dinar');
define( '_CURRENCY_IEP', 'Irish Pound');
define( '_CURRENCY_ITL', 'Italian Lira');
define( '_CURRENCY_ILS', 'Shekel');
define( '_CURRENCY_JMD', 'Jamaican Dollar');
define( '_CURRENCY_JPY', 'Japan Yen');
define( '_CURRENCY_JOD', 'Jordanian Dinar');
define( '_CURRENCY_KZT', 'Tenge');
define( '_CURRENCY_KES', 'Kenyan Shilling');
define( '_CURRENCY_KRW', 'Won');
define( '_CURRENCY_KPW', 'North Korean Won');
define( '_CURRENCY_KWD', 'Kuwaiti Dinar');
define( '_CURRENCY_KGS', 'Som');
define( '_CURRENCY_LAK', 'Kip');
define( '_CURRENCY_GEL', 'Lari');
define( '_CURRENCY_LVL', 'Latvian Lats');
define( '_CURRENCY_LBP', 'Lebanese Pound');
define( '_CURRENCY_LSL', 'Loti');
define( '_CURRENCY_LRD', 'Liberian Dollar');
define( '_CURRENCY_LYD', 'Libyan Dinar');
define( '_CURRENCY_LTL', 'Lithuanian Litas');
define( '_CURRENCY_LUF', 'Luxembourg Franc');
define( '_CURRENCY_AOR', 'Kwanza Reajustado');
define( '_CURRENCY_MOP', 'Pataca');
define( '_CURRENCY_MKD', 'Denar');
define( '_CURRENCY_MGF', 'Malagasy Franc');
define( '_CURRENCY_MWK', 'Kwacha');
define( '_CURRENCY_MYR', 'Malaysian Ringitt');
define( '_CURRENCY_MVR', 'Rufiyaa');
define( '_CURRENCY_MTL', 'Maltese Lira');
define( '_CURRENCY_MRO', 'Ouguiya');
define( '_CURRENCY_TMM', 'Manat');
define( '_CURRENCY_FIM', 'Markka');
define( '_CURRENCY_MUR', 'Mauritius Rupee');
define( '_CURRENCY_MXN', 'Mexico Peso');
define( '_CURRENCY_MXV', 'Mexican Unidad de Inversion');
define( '_CURRENCY_MNT', 'Mongolia Tugrik');
define( '_CURRENCY_MAD', 'Moroccan Dirham');
define( '_CURRENCY_MDL', 'Moldovan Leu');
define( '_CURRENCY_MZM', 'Metical');
define( '_CURRENCY_BOV', 'Mvdol');
define( '_CURRENCY_MMK', 'Myanmar Kyat');
define( '_CURRENCY_ERN', 'Nakfa');
define( '_CURRENCY_NAD', 'Namibian Dollar');
define( '_CURRENCY_NPR', 'Nepalese Rupee');
define( '_CURRENCY_ANG', 'Netherlands Antilles Guilder');
define( '_CURRENCY_NLG', 'Netherlands Guilder');
define( '_CURRENCY_NZD', 'New Zealand Dollar');
define( '_CURRENCY_NIO', 'Cordoba Oro');
define( '_CURRENCY_NGN', 'Naira');
define( '_CURRENCY_BTN', 'Ngultrum');
define( '_CURRENCY_NOK', 'Norwegian Krone');
define( '_CURRENCY_OMR', 'Rial Omani');
define( '_CURRENCY_PKR', 'Pakistan Rupee');
define( '_CURRENCY_PAB', 'Balboa');
define( '_CURRENCY_PGK', 'New Guinea Kina');
define( '_CURRENCY_PYG', 'Guarani');
define( '_CURRENCY_PEN', 'Nuevo Sol');
define( '_CURRENCY_XPD', 'Palladium');
define( '_CURRENCY_PHP', 'Philippine Peso');
define( '_CURRENCY_XPT', 'Platinum');
define( '_CURRENCY_PTE', 'Portuguese Escudo');
define( '_CURRENCY_PLN', 'New Zloty');
define( '_CURRENCY_QAR', 'Qatari Rial');
define( '_CURRENCY_ROL', 'Romanian Leu');
define( '_CURRENCY_RON', 'New Romanian Leu');
define( '_CURRENCY_RSD', 'Serbian dinar');
define( '_CURRENCY_RUB', 'Russian Ruble');
define( '_CURRENCY_RWF', 'Rwanda Franc');
define( '_CURRENCY_WST', 'Tala');
define( '_CURRENCY_STD', 'Dobra');
define( '_CURRENCY_SAR', 'Saudi Riyal');
define( '_CURRENCY_SCR', 'Seychelles Rupee');
define( '_CURRENCY_SLL', 'Leone');
define( '_CURRENCY_SGD', 'Singapore Dollar');
define( '_CURRENCY_SKK', 'Slovak Koruna');
define( '_CURRENCY_SIT', 'Tolar');
define( '_CURRENCY_SBD', 'Solomon Islands Dollar');
define( '_CURRENCY_SOS', 'Somalia Shilling');
define( '_CURRENCY_ZAL', 'Rand (Financial)');
define( '_CURRENCY_ZAR', 'Rand (South Africa)');
define( '_CURRENCY_RUR', 'Russian Ruble');
define( '_CURRENCY_ATS', 'Schilling');
define( '_CURRENCY_XAG', 'Silver');
define( '_CURRENCY_ESP', 'Spanish Peseta');
define( '_CURRENCY_LKR', 'Sri Lanka Rupee');
define( '_CURRENCY_SHP', 'St Helena Pound');
define( '_CURRENCY_SDP', 'Sudanese Pound');
define( '_CURRENCY_SDD', 'Sudanese Dinar');
define( '_CURRENCY_SRG', 'Suriname Guilder');
define( '_CURRENCY_SZL', 'Swaziland Lilangeni');
define( '_CURRENCY_SEK', 'Sweden Krona');
define( '_CURRENCY_CHF', 'Swiss Franc');
define( '_CURRENCY_SYP', 'Syrian Pound');
define( '_CURRENCY_TWD', 'New Taiwan Dollar');
define( '_CURRENCY_TJR', 'Tajik Ruble');
define( '_CURRENCY_TZS', 'Tanzanian Shilling');
define( '_CURRENCY_TRL', 'Turkish Lira');
define( '_CURRENCY_THB', 'Baht');
define( '_CURRENCY_TOP', 'Tonga Pa\'anga');
define( '_CURRENCY_TTD', 'Trinidad &amp; Tobago Dollar');
define( '_CURRENCY_TND', 'Tunisian Dinar');
define( '_CURRENCY_TRY', 'Turkish Lira');
define( '_CURRENCY_UGX', 'Uganda Shilling');
define( '_CURRENCY_UAH', 'Ukrainian Hryvnia');
define( '_CURRENCY_ECV', 'Unidad de Valor Constante');
define( '_CURRENCY_CLF', 'Unidades de fomento');
define( '_CURRENCY_AED', 'United Arab Emirates Dirham');
define( '_CURRENCY_GBP', 'Pounds Sterling');
define( '_CURRENCY_USD', 'US Dollar');
define( '_CURRENCY_UYU', 'Uruguayan Peso');
define( '_CURRENCY_UZS', 'Uzbekistan Sum');
define( '_CURRENCY_VUV', 'Vanuatu Vatu');
define( '_CURRENCY_VEB', 'Venezuela Bolivar');
define( '_CURRENCY_VND', 'Viet Nam Dong');
define( '_CURRENCY_YER', 'Yemeni Rial');
define( '_CURRENCY_YUM', 'Yugoslavian New Dinar');
define( '_CURRENCY_ZRN', 'New Zaire');
define( '_CURRENCY_ZMK', 'Zambian Kwacha');
define( '_CURRENCY_ZWD', 'Zimbabwe Dollar');
define( '_CURRENCY_USN', 'US Dollar (Next day)');
define( '_CURRENCY_USS', 'US Dollar (Same day)');

// --== MICRO INTEGRATION OVERVIEW ==--
define( '_MI_TITLE', 'Micro int&eacute;grations');
define( '_MI_NAME', 'Nom');
define( '_MI_DESC', 'Description');
define( '_MI_ACTIVE', 'Active');
define( '_MI_REORDER', 'Ordre');
define( '_MI_FUNCTION', 'Nom de la fonction');

// --== MICRO INTEGRATION EDIT ==--
define( '_MI_E_TITLE', 'MI');
define( '_MI_E_TITLE_LONG', 'Micro int&eacute;gration');
define( '_MI_E_SETTINGS', 'Param&egrave;tre');
define( '_MI_E_NAME_NAME', 'Nom');
define( '_MI_E_NAME_DESC', 'D&eacute;finir un nom pour cette Micro int&eacute;gration');
define( '_MI_E_DESC_NAME', 'Description');
define( '_MI_E_DESC_DESC', 'Br&egrave;ve description de l&amp;acute;int&eacute;gration');
define( '_MI_E_ACTIVE_NAME', 'Active');
define( '_MI_E_ACTIVE_DESC', 'Rendre disponible ou pas cette micro int&eacute;gration');
define( '_MI_E_AUTO_CHECK_NAME', 'Expiration actions');
define( '_MI_E_AUTO_CHECK_DESC', 'Si la fonction est active, vous pouvez activer les fonctionnalit&eacute;s d&amp;acute;expiration: actions qui devront &ecirc;tre men&eacute;es &agrave; terme jusqu&amp;acute;&agrave; ce que l&amp;acute;utilisateur expire (Si elle est supporter par la MI).');
define( '_MI_E_ON_USERCHANGE_NAME', 'Action de mise &agrave; jour du compte utilisateur');
define( '_MI_E_ON_USERCHANGE_DESC', 'Si la fonction est active, vous pouvez activer des actions qui se produisent quand un compte d&amp;acute;utilisateur est mis &agrave; jour (Si elle est support&eacute;e par la MI).');
define( '_MI_E_PRE_EXP_CHECK_NAME', 'Pr&eacute;-expiration');
define( '_MI_E_PRE_EXP_CHECK_DESC', 'R&eacute;glez le volume de jours avant l&amp;acute;expiration quand une pr&eacute;-expiration action devrait &ecirc;tre d&eacute;clench&eacute; (Si elle est support&eacute;e par la MI).');
define( '_MI_E__AEC_GLOBAL_EXP_ALL_NAME', 'Expire all instances');
define( '_MI_E__AEC_GLOBAL_EXP_ALL_DESC', 'Trigger the expiration action even if the user has another payment plan with this MI attached. The standard behavior is to call the expiration action on an MI only when it really is the last MI instance that this user has in all payment plans.');
define( '_MI_E_FUNCTION_NAME', 'Nom de la fonction');
define( '_MI_E_FUNCTION_DESC', 'S&amp;acute;il vous pla&#238;t d&eacute;finissez laquelle de ces int&eacute;grations doit &ecirc;tre utilis&eacute;e');
define( '_MI_E_FUNCTION_EXPLANATION', 'Avant de pouvoir configurer la Micro int&eacute;gration, vous devez s&eacute;lectionner la MI de fichier qui sera utilis&eacute;. Faites une s&eacute;lection et enregistr&eacute; la micro int&eacute;gration. Lorsque vous modifiez &agrave; nouveau, vous serez en mesure d&amp;acute;&eacute;tablir les param&egrave;tres. Notez &eacute;galement que le nom de la fonction ne peut pas &ecirc;tre chang&eacute; une fois int&eacute;gr&eacute;.');

// --== REWRITE EXPLANATION ==--
define( '_REWRITE_AREA_USER', 'User Account Related');
define( '_REWRITE_KEY_USER_ID', 'User Account ID');
define( '_REWRITE_KEY_USER_USERNAME', 'Username');
define( '_REWRITE_KEY_USER_NAME', 'Name');
define( '_REWRITE_KEY_USER_FIRST_NAME', 'First Name');
define( '_REWRITE_KEY_USER_FIRST_FIRST_NAME', 'First First Name');
define( '_REWRITE_KEY_USER_LAST_NAME', 'Last Name');
define( '_REWRITE_KEY_USER_EMAIL', 'E-Mail Address');
define( '_REWRITE_KEY_USER_ACTIVATIONCODE', 'Activation Code');
define( '_REWRITE_KEY_USER_ACTIVATIONLINK', 'Activation Link');

define( '_REWRITE_AREA_SUBSCRIPTION', 'User Subscription Related');
define( '_REWRITE_KEY_SUBSCRIPTION_TYPE', 'Payment Processor');
define( '_REWRITE_KEY_SUBSCRIPTION_STATUS', 'Subscription Status');
define( '_REWRITE_KEY_SUBSCRIPTION_SIGNUP_DATE', 'Date this Subscription was established');
define( '_REWRITE_KEY_SUBSCRIPTION_LASTPAY_DATE', 'Last Payment Date');
define( '_REWRITE_KEY_SUBSCRIPTION_PLAN', 'Payment Plan ID');
define( '_REWRITE_KEY_SUBSCRIPTION_PREVIOUS_PLAN', 'Previous Payment Plan ID');
define( '_REWRITE_KEY_SUBSCRIPTION_RECURRING', 'Recurring Payment Flag');
define( '_REWRITE_KEY_SUBSCRIPTION_LIFETIME', 'Lifetime Subscription Flag');
define( '_REWRITE_KEY_SUBSCRIPTION_EXPIRATION_DATE', 'Expiration Date (Frontend Formatting)');
define( '_REWRITE_KEY_SUBSCRIPTION_EXPIRATION_DATE_BACKEND', 'Expiration Date (Backend Formatting)');

define( '_REWRITE_AREA_PLAN', 'Payment Plan Related');
define( '_REWRITE_KEY_PLAN_NAME', 'Name');
define( '_REWRITE_KEY_PLAN_DESC', 'Description');

define( '_REWRITE_AREA_CMS', 'CMS Related');
define( '_REWRITE_KEY_CMS_ABSOLUTE_PATH', 'Absolute path to cms directory');
define( '_REWRITE_KEY_CMS_LIVE_SITE', 'Your Site URL');

define( '_REWRITE_AREA_SYSTEM', 'System Related');
define( '_REWRITE_KEY_SYSTEM_TIMESTAMP', 'Timestamp (Frontend Formatting)');
define( '_REWRITE_KEY_SYSTEM_TIMESTAMP_BACKEND', 'Timestamp (Backend Formatting)');
define( '_REWRITE_KEY_SYSTEM_SERVER_TIMESTAMP', 'Server Timestamp (Frontend Formatting)');
define( '_REWRITE_KEY_SYSTEM_SERVER_TIMESTAMP_BACKEND', 'Server Timestamp (Backend Formatting)');

define( '_REWRITE_AREA_INVOICE', 'Invoice Related');
define( '_REWRITE_KEY_INVOICE_ID', 'Invoice ID');
define( '_REWRITE_KEY_INVOICE_NUMBER', 'Invoice Number');
define( '_REWRITE_KEY_INVOICE_NUMBER_FORMAT', 'Invoice Number (formatted)');
define( '_REWRITE_KEY_INVOICE_CREATED_DATE', 'Date of Creation');
define( '_REWRITE_KEY_INVOICE_TRANSACTION_DATE', 'Date of Transaction');
define( '_REWRITE_KEY_INVOICE_METHOD', 'Payment Method');
define( '_REWRITE_KEY_INVOICE_AMOUNT', 'Amount Paid');
define( '_REWRITE_KEY_INVOICE_CURRENCY', 'Currency');
define( '_REWRITE_KEY_INVOICE_COUPONS', 'List of Coupons');

define( '_REWRITE_ENGINE_TITLE', 'Rewrite Engine');
define( '_REWRITE_ENGINE_DESC', 'To create dynamic text, you can add these wiki-style tags in RWengine-enabled fields. Flick through the togglers below to see which tags are available');
define( '_REWRITE_ENGINE_AECJSON_TITLE', 'aecJSON');
define( '_REWRITE_ENGINE_AECJSON_DESC', 'You can also use functions encoded in JSON markup, like this:&lt;br /&gt;{aecjson} { &quot;cmd&quot;:&quot;date&quot;, &quot;vars&quot;: [ &quot;Y&quot;, { &quot;cmd&quot;:&quot;rw_constant&quot;, &quot;vars&quot;:&quot;invoice_created_date&quot; } ] } {/aecjson}&lt;br /&gt;It returns only the Year of a date. Refer to the manual and forums for further instructions!');

// --== COUPONS OVERVIEW ==--
define( '_COUPON_TITLE', 'Coupons');
define( '_COUPON_TITLE_STATIC', 'Static Coupons');
define( '_COUPON_NAME', 'Name');
define( '_COUPON_DESC', 'Description (first 50 chars)');
define( '_COUPON_CODE', 'Code Coupon');
define( '_COUPON_ACTIVE', 'Published');
define( '_COUPON_REORDER', 'Reorder');
define( '_COUPON_USECOUNT', 'Use Count');

// --== COUPON EDIT ==--
define( '_COUPON_DETAIL_TITLE', 'Coupon');
define( '_COUPON_RESTRICTIONS_TITLE', 'Restrict.');
define( '_COUPON_RESTRICTIONS_TITLE_FULL', 'Restrictions');
define( '_COUPON_MI', 'Micro Int.');
define( '_COUPON_MI_FULL', 'Micro int&eacute;grations');

define( '_COUPON_GENERAL_NAME_NAME', 'Nom');
define( '_COUPON_GENERAL_NAME_DESC', 'Enter the (internal&amp;external) name for this coupon');
define( '_COUPON_GENERAL_COUPON_CODE_NAME', 'Coupon Code');
define( '_COUPON_GENERAL_COUPON_CODE_DESC', 'Enter the Coupon Code for this coupon - the randomly generated coupon code is checked to be unique within the system');
define( '_COUPON_GENERAL_DESC_NAME', 'Description');
define( '_COUPON_GENERAL_DESC_DESC', 'Enter the (internal) description for this coupon');
define( '_COUPON_GENERAL_ACTIVE_NAME', 'Active');
define( '_COUPON_GENERAL_ACTIVE_DESC', 'Set whether this coupon is active (can be used)');
define( '_COUPON_GENERAL_TYPE_NAME', 'Static');
define( '_COUPON_GENERAL_TYPE_DESC', 'Select whether you want this to be a static coupon. These are stored in a separate table for quicker access, the general distinction being that static coupons are coupons that are used by a lot of users while non-static coupons are for one user.');

define( '_COUPON_GENERAL_MICRO_INTEGRATIONS_NAME', 'Micro int&eacute;grations');
define( '_COUPON_GENERAL_MICRO_INTEGRATIONS_DESC', 'Choisissez la microint&eacute;gration que vous voulez appeler quand vous utilisez ce coupon');

define( '_COUPON_PARAMS_AMOUNT_USE_NAME', 'Use Amount');
define( '_COUPON_PARAMS_AMOUNT_USE_DESC', 'Select whether you want to use a direct discount amount');
define( '_COUPON_PARAMS_AMOUNT_NAME', 'Discount Amount');
define( '_COUPON_PARAMS_AMOUNT_DESC', 'Enter the Amount that you want to deduct from the next amount');
define( '_COUPON_PARAMS_AMOUNT_PERCENT_USE_NAME', 'Use Percentage');
define( '_COUPON_PARAMS_AMOUNT_PERCENT_USE_DESC', 'Select whether you want a percentage deducted from the actual amount');
define( '_COUPON_PARAMS_AMOUNT_PERCENT_NAME', 'Discount Percentage');
define( '_COUPON_PARAMS_AMOUNT_PERCENT_DESC', 'Enter the percentage that you want deducted from the amount');
define( '_COUPON_PARAMS_PERCENT_FIRST_NAME', 'Percent First');
define( '_COUPON_PARAMS_PERCENT_FIRST_DESC', 'If you combine percentage and amount, do you want the percentage to be deducted first?');
define( '_COUPON_PARAMS_USEON_TRIAL_NAME', 'Use On Trial?');
define( '_COUPON_PARAMS_USEON_TRIAL_DESC', 'Do you want to let the user apply this discount to a trial amount?');
define( '_COUPON_PARAMS_USEON_FULL_NAME', 'Use On Full?');
define( '_COUPON_PARAMS_USEON_FULL_DESC', 'Do you want to let the user apply this discount to the actual amount? (With recurring billing: to the first regular payment)');
define( '_COUPON_PARAMS_USEON_FULL_ALL_NAME', 'Every Full?');
define( '_COUPON_PARAMS_USEON_FULL_ALL_DESC', 'If the user is using recurring payments, do you want to grant this discount for each subsequent payment? (Or just for the first, if that applies - then select no)');

define( '_COUPON_PARAMS_HAS_START_DATE_NAME', 'Use Start Date');
define( '_COUPON_PARAMS_HAS_START_DATE_DESC', 'Do you want to allow your users to use this coupon from a certain date on?');
define( '_COUPON_PARAMS_START_DATE_NAME', 'Start Date');
define( '_COUPON_PARAMS_START_DATE_DESC', 'Select the date at which you want to start allowing the usage of this coupon');
define( '_COUPON_PARAMS_HAS_EXPIRATION_NAME', 'Use Expiration Date');
define( '_COUPON_PARAMS_HAS_EXPIRATION_DESC', 'Souhaitez vous restreindre l&amp;acute;utilisation de ce coupon a une certaine date ?');
define( '_COUPON_PARAMS_EXPIRATION_NAME', 'Date d\'expiration');
define( '_COUPON_PARAMS_EXPIRATION_DESC', 'Select the date at which you want to stop allowing the usage of this coupon');
define( '_COUPON_PARAMS_HAS_MAX_REUSE_NAME', 'Restreindre la r&eacute;utilisation ?');
define( '_COUPON_PARAMS_HAS_MAX_REUSE_DESC', 'Souhaitez vous restreindre le nombre d&amp;acute;utilisation de ce coupon ?');
define( '_COUPON_PARAMS_MAX_REUSE_NAME', 'Max Uses');
define( '_COUPON_PARAMS_MAX_REUSE_DESC', 'Choose the number of times this coupon can be used');
define( '_COUPON_PARAMS_HAS_MAX_PERUSER_REUSE_NAME', 'Restrict Reuse per User?');
define( '_COUPON_PARAMS_HAS_MAX_PERUSER_REUSE_DESC', 'Do you want to restrict the number of times every user is allowed to use this coupon?');
define( '_COUPON_PARAMS_MAX_PERUSER_REUSE_NAME', 'Max Uses per User');
define( '_COUPON_PARAMS_MAX_PERUSER_REUSE_DESC', 'Choose the number of times this coupon can be used by each user');

define( '_COUPON_PARAMS_USECOUNT_NAME', 'Use Count');
define( '_COUPON_PARAMS_USECOUNT_DESC', 'Reset the number of times this Coupon has been used');

define( '_COUPON_PARAMS_USAGE_PLANS_ENABLED_NAME', 'Set Plan');
define( '_COUPON_PARAMS_USAGE_PLANS_ENABLED_DESC', 'Do you want to allow this coupon only for certain plans?');
define( '_COUPON_PARAMS_USAGE_PLANS_NAME', 'Plans');
define( '_COUPON_PARAMS_USAGE_PLANS_DESC', 'Choose which plans this coupon can be used for');
define( '_COUPON_PARAMS_USAGE_CART_FULL_NAME', 'Use on Cart');
define( '_COUPON_PARAMS_USAGE_CART_FULL_DESC', 'Allow Application to a full shopping card');
define( '_COUPON_PARAMS_CART_MULTIPLE_ITEMS_NAME', 'Multiple Items');
define( '_COUPON_PARAMS_CART_MULTIPLE_ITEMS_DESC', 'Let the user apply the coupon to multiple items of a shopping cart, if overall restrictions permit it');
define( '_COUPON_PARAMS_CART_MULTIPLE_ITEMS_AMOUNT_NAME', 'Multiple Items Amount');
define( '_COUPON_PARAMS_CART_MULTIPLE_ITEMS_AMOUNT_DESC', 'Set a limit for application to multiple items of one shopping cart');

define( '_COUPON_RESTRICTIONS_MINGID_ENABLED_NAME', 'Enable Min GID:');
define( '_COUPON_RESTRICTIONS_MINGID_ENABLED_DESC', 'Enable this setting if you want to restrict whether a user can use this coupon by a minimum usergroup.');
define( '_COUPON_RESTRICTIONS_MINGID_NAME', 'Visibility Group:');
define( '_COUPON_RESTRICTIONS_MINGID_DESC', 'The minimum user level required to use this coupon.');
define( '_COUPON_RESTRICTIONS_FIXGID_ENABLED_NAME', 'Enable Fixed GID:');
define( '_COUPON_RESTRICTIONS_FIXGID_ENABLED_DESC', 'Enable this setting if you want to restrict this coupon to one usergroup.');
define( '_COUPON_RESTRICTIONS_FIXGID_NAME', 'Set Group:');
define( '_COUPON_RESTRICTIONS_FIXGID_DESC', 'Only users with this usergroup can use this coupon.');
define( '_COUPON_RESTRICTIONS_MAXGID_ENABLED_NAME', 'Enable Max GID:');
define( '_COUPON_RESTRICTIONS_MAXGID_ENABLED_DESC', 'Enable this setting if you want to restrict whether a user use this coupon by a maximum usergroup.');
define( '_COUPON_RESTRICTIONS_MAXGID_NAME', 'Maximum Group:');
define( '_COUPON_RESTRICTIONS_MAXGID_DESC', 'The maximum user level a user can have to use this coupon.');

define( '_COUPON_RESTRICTIONS_PREVIOUSPLAN_REQ_ENABLED_NAME', 'Required Prev. Plan:');
define( '_COUPON_RESTRICTIONS_PREVIOUSPLAN_REQ_ENABLED_DESC', 'Enable checking for previous payment plan');
define( '_COUPON_RESTRICTIONS_PREVIOUSPLAN_REQ_NAME', 'Plan:');
define( '_COUPON_RESTRICTIONS_PREVIOUSPLAN_REQ_DESC', 'A user will only be able to use this coupon if he or she used the selected plan before the one currently in use');
define( '_COUPON_RESTRICTIONS_CURRENTPLAN_REQ_ENABLED_NAME', 'Required Curr. Plan:');
define( '_COUPON_RESTRICTIONS_CURRENTPLAN_REQ_ENABLED_DESC', 'Enable checking for currently present payment plan');
define( '_COUPON_RESTRICTIONS_CURRENTPLAN_REQ_NAME', 'Plan:');
define( '_COUPON_RESTRICTIONS_CURRENTPLAN_REQ_DESC', 'A user will only be able to use this coupon if he or she is currently assigned to, or has expired from the plan selected here');
define( '_COUPON_RESTRICTIONS_OVERALLPLAN_REQ_ENABLED_NAME', 'Required Used Plan:');
define( '_COUPON_RESTRICTIONS_OVERALLPLAN_REQ_ENABLED_DESC', 'Enable checking for overall used payment plan');
define( '_COUPON_RESTRICTIONS_OVERALLPLAN_REQ_NAME', 'Plan:');
define( '_COUPON_RESTRICTIONS_OVERALLPLAN_REQ_DESC', 'A user will only be able to use this coupon if he or she has used the selected plan once, no matter when');

define( '_COUPON_RESTRICTIONS_USED_PLAN_MIN_ENABLED_NAME', 'Min Used Plan:');
define( '_COUPON_RESTRICTIONS_USED_PLAN_MIN_ENABLED_DESC', 'Enable checking for the minimum number of times your consumers have subscribed to a specified payment plan in order to be able to use this coupon');
define( '_COUPON_RESTRICTIONS_USED_PLAN_MIN_AMOUNT_NAME', 'Used Amount:');
define( '_COUPON_RESTRICTIONS_USED_PLAN_MIN_AMOUNT_DESC', 'The minimum amount a user has to have used the selected plan');
define( '_COUPON_RESTRICTIONS_USED_PLAN_MIN_NAME', 'Plan:');
define( '_COUPON_RESTRICTIONS_USED_PLAN_MIN_DESC', 'The payment plan that the user has to have used the specified number of times at least');
define( '_COUPON_RESTRICTIONS_USED_PLAN_MAX_ENABLED_NAME', 'Max Used Plan:');
define( '_COUPON_RESTRICTIONS_USED_PLAN_MAX_ENABLED_DESC', 'Enable checking for the maximum number of times your consumers have subscribed to a specified payment plan in order to be able to use this coupon');
define( '_COUPON_RESTRICTIONS_USED_PLAN_MAX_AMOUNT_NAME', 'Used Amount:');
define( '_COUPON_RESTRICTIONS_USED_PLAN_MAX_AMOUNT_DESC', 'The maximum amount a user can have used the selected plan');
define( '_COUPON_RESTRICTIONS_USED_PLAN_MAX_NAME', 'Plan:');
define( '_COUPON_RESTRICTIONS_USED_PLAN_MAX_DESC', 'The payment plan that the user has to have used the specified number of times at most');

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

define( '_COUPON_RESTRICTIONS_RESTRICT_COMBINATION_NAME', 'Restrict Combination:');
define( '_COUPON_RESTRICTIONS_RESTRICT_COMBINATION_DESC', 'Choose to not let your users combine this coupon with one of the following');
define( '_COUPON_RESTRICTIONS_BAD_COMBINATIONS_NAME', 'Coupons:');
define( '_COUPON_RESTRICTIONS_BAD_COMBINATIONS_DESC', 'Make a selection which coupons this one is not to be used with');
define( '_COUPON_RESTRICTIONS_DEPEND_ON_SUBSCR_ID_NAME', 'Depend on Subscription:');
define( '_COUPON_RESTRICTIONS_DEPEND_ON_SUBSCR_ID_DESC', 'Make the coupon depend on a certain subscription to be functional.');
define( '_COUPON_RESTRICTIONS_SUBSCR_ID_DEPENDENCY_NAME', 'Subscription ID');
define( '_COUPON_RESTRICTIONS_SUBSCR_ID_DEPENDENCY_DESC', 'The Subscription ID that the coupon will depend on.');
define( '_COUPON_RESTRICTIONS_ALLOW_TRIAL_DEPEND_SUBSCR_NAME', 'Allow Trial Subscriptions:');
define( '_COUPON_RESTRICTIONS_ALLOW_TRIAL_DEPEND_SUBSCR_DESC', 'Allow the use of the coupon when depending on a subscription that is still a trial.');
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

// --== FACTURATION ==--
define( '_INVOICE_TITLE', 'Factures');
define( '_INVOICE_SEARCH', 'Rechercher');
define( '_INVOICE_USERID', 'Nom Utilisateur');
define( '_INVOICE_INVOICE_NUMBER', 'Num&eacute;ro de Facture');
define( '_INVOICE_SECONDARY_IDENT', 'Secondary Identification');
define( '_INVOICE_TRANSACTION_DATE', 'Date de Transaction');
define( '_INVOICE_CREATED_DATE', 'Date de cr&eacute;tion');
define( '_INVOICE_METHOD', 'M&eacute;thode');
define( '_INVOICE_AMOUNT', 'Montant');
define( '_INVOICE_CURRENCY', 'Devise');
define( '_INVOICE_COUPONS', 'Coupons');

// --== HISTORIQUE DES PAIEMENTS ==--
define( '_HISTORY_TITLE2', 'Votre Historique de Facturation');
define( '_HISTORY_SEARCH', 'Rechercher');
define( '_HISTORY_USERID', 'Nom Utilisateur');
define( '_HISTORY_INVOICE_NUMBER', 'Num&eacute;ro de Facture');
define( '_HISTORY_PLAN_NAME', 'Plan abonn&eacute; &agrave;');
define( '_HISTORY_TRANSACTION_DATE', 'Date de Transaction');
define( '_HISTORY_METHOD', 'M&eacute;thode de Facturation');
define( '_HISTORY_AMOUNT', 'Montant de la Facture');
define( '_HISTORY_RESPONSE', 'R&eacute;ponse du serveur');

// --== PAGE POUR TOUS LES UTILISATEURS ==--
define( '_METHOD', 'M&eacute;thode');

// --== PAGE EN ATTENTE ==--
define( '_PEND_DATE', 'En attente depuis');
define( '_PEND_TITLE', 'Abonnements en attente');
define( '_PEND_DESC', 'Abonnement qui n a pas compl&eacute;t&eacute; le processus. Ce statut est commun le temps que le syst&egrave;me attend le paiement.');
define( '_ACTIVATE', 'Activ&eacute;');
define( '_ACTIVATED', 'Utilisateur activ&eacute;.');

// --== EXPORT ==--
define( '_AEC_HEAD_EXPORT', 'Export');
define( '_EXPORT_LOAD', 'Charger');
define( '_EXPORT_APPLY', 'Appliquer');
define( '_EXPORT_GENERAL_SELECTED_EXPORT_NAME', 'Pr&eacute;r&eacute;glage d\'export');
define( '_EXPORT_GENERAL_SELECTED_EXPORT_DESC', 'S&eacute;lectionnez un pr&eacute;r&eacute;glage (ou une exportation pr&eacute;c&eacute;dente automatiquement sauv&eacute;e) au lieu de faire les s&eacute;lections ci-dessous. Vous pouvez &eacute;galement cliquer sur appliquer dans le coin sup&eacute;rieur droit et de pr&eacute;visualiser le pr&eacute;r&eacute;glage.');
define( '_EXPORT_GENERAL_DELETE_NAME', 'Delete');
define( '_EXPORT_GENERAL_DELETE_DESC', 'Delete this Preset (on apply)');
define( '_EXPORT_PARAMS_PLANID_NAME', 'Payment Plan');
define( '_EXPORT_PARAMS_PLANID_DESC', 'Filter out subscriptions with this Payment Plan');
define( '_EXPORT_PARAMS_STATUS_NAME', 'Status');
define( '_EXPORT_PARAMS_STATUS_DESC', 'Only export subscriptions with this status');
define( '_EXPORT_PARAMS_ORDERBY_NAME', 'Order by');
define( '_EXPORT_PARAMS_ORDERBY_DESC', 'Order by one of the following');
define( '_EXPORT_PARAMS_REWRITE_RULE_NAME', 'Fields');
define( '_EXPORT_PARAMS_REWRITE_RULE_DESC', 'Put in the ReWrite Engine fields, separated by semicolons, that you want each exported item to hold.');
define( '_EXPORT_PARAMS_SAVE_NAME', 'Save as New?');
define( '_EXPORT_PARAMS_SAVE_DESC', 'Check this box to save your settings as a new preset');
define( '_EXPORT_PARAMS_SAVE_NAME_NAME', 'Save Name');
define( '_EXPORT_PARAMS_SAVE_NAME_DESC', 'Save new preset under this name');
define( '_EXPORT_PARAMS_EXPORT_METHOD_NAME', 'Exporting Method');
define( '_EXPORT_PARAMS_EXPORT_METHOD_DESC', 'The filetype you want to export to');

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
