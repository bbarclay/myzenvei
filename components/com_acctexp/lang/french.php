<?php
/**
 * @version $Id: german.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Language - Frontend
 * @copyright 2006-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.globalnerd.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

if( defined( '_AEC_LANG' ) ) {
	return;
}

// new 12.0.4 (mic)

define( '_AEC_EXPIRE_TODAY',				'Ce compte est actif jusqu\'&agrave; aujourd\'hui' );
define( '_AEC_EXPIRE_FUTURE',				'Ce compte est actif jusqu\'au' );
define( '_AEC_EXPIRE_PAST',				'Ce compte &eacute;tait actif jusqu\'au' );
define( '_AEC_DAYS_ELAPSED',				'jour(s) &eacute;coul&eacute;s');
define( '_AEC_EXPIRE_TRIAL_TODAY',			'Cette p&eacute;riode d\'essai est valable jusqu\'&agrave; aujourd\'hui ' );
define( '_AEC_EXPIRE_TRIAL_FUTURE',			'Cette p&eacute;riode d\'essai est valable jusqu\'au' );
define( '_AEC_EXPIRE_TRIAL_PAST',			'Cette p&eacute;riode d\'essai &eacute;tait valable jusqu\'au' );

define( '_AEC_EXPIRE_NOT_SET',				'Non d&eacute;termin&eacute;' );
define( '_AEC_GEN_ERROR',					'&lt;h1&gt;Erreur g&eacute;n&eacute;rale&lt;/h1&gt;&lt;p&gt;Nous avons rencontr&eacute; des probl&egrave;mes pour traiter votre demande. Veuillez contacter l\'administrateur du site Web.&lt;/p&gt;' );

// payments
define( '_AEC_PAYM_METHOD_FREE',			'Gratuit' );
define( '_AEC_PAYM_METHOD_NONE',			'Aucun' );
define( '_AEC_PAYM_METHOD_TRANSFER',		'Transfert' );

// processor errors
define( '_AEC_MSG_PROC_INVOICE_FAILED_SH',			'Le paiement de la facture &agrave; &eacute;chou&eacute;' );
define( '_AEC_MSG_PROC_INVOICE_FAILED_EV',			'La notification du processeur %s pour %s a &eacute;chou&eacute; - ce num&eacute;ro de facture n\'existe pas :' );
define( '_AEC_MSG_PROC_INVOICE_ACTION_SH',			'Action de paiement de la facture' );
define( '_AEC_MSG_PROC_INVOICE_ACTION_EV',			'Le parseur de notification de paiement r&eacute;pond :' );
define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_STATUS',	'Etat de la facture :' );
define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_FRAUD',	'La v&eacute;rification du montant a &eacute;chou&eacute;, r&eacute;gl&eacute;: %s, facture: %s - paiement annul&eacute;' );
define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_CURR',		'La v&eacute;rification de la monnaie a &eacute;chou&eacute;, r&eacute;gl&eacute;: %s, facture: %s - paiement annul&eacute;' );
define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_VALID',	'Paiement valid&eacute;, l\'action est engag&eacute;e' );
define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_VALID_APPFAIL',	'Paiement valid&eacute;, &eacute;chec de l\'application !' );
define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_TRIAL',	'Paiement valid&eacute; - p&eacute;riode d\'essai gratuite' );
define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_PEND',		'Paiement non valid&eacute; - compte en suspens ; raison : %s' );
define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_CANCEL',	'Pas de paiement - Abonnement annul&eacute;' );
define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_CHARGEBACK',	'Pas de paiement - Chargeback' );
define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_CHARGEBACK_SETTLE',	'Pas de paiement - Chargeback Settlement' );
define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_USTATUS',	', le compte utilisateur a &eacute;t&eacute; mis &agrave; jour &agrave; \'Annul&eacute;\'' );
define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_USTATUS_HOLD',	', le statut de l\'utilisateur est pass&eacute; &agrave; \'En attente\'' );
define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_USTATUS_ACTIVE',	', le statut de l\'utilisateur est pass&eacute; &agrave; \'Actif\'' );
define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_EOT',		'Pas de paiment - Fin de la p&eacute;riode d\'abonnement' );
define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_DUPLICATE','Pas de paiement - Doublon' );
define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_NULL','Pas de paiement - Vide' );
define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_U_ERROR',	'Erreur inconnue' );
define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_REFUND',	'Pas de paiement - Abonnement supprim&eacute; (rembours&eacute;)' );
define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_EXPIRED',	', L\'utilisateur a expir&eacute;' );

// --== COUPON INFO ==--
define( '_COUPON_INFO',						'Bons de r&eacute;duction :' );
define( '_COUPON_INFO_CONFIRM',				'Si vous voulez utiliser un ou plusieurs bons de r&eacute;duction pour ce paiement, vous pouvez le faire &agrave; partir de la page de r&egrave;glement.' );
define( '_COUPON_INFO_CHECKOUT',			'Veuillez saisir ici le code de votre bon de r&eacute;duction et cliquer sur le bouton pour qu\'il soit pris en compte.' );

// end mic ########################################################

// --== PAGE PLANS ==--
define( '_PAYPLANS_HEADER', ' Plans');
define( '_NOPLANS_ERROR', 'Aucun plan disponible pour le moment.');
define( '_NOPLANS_AUTHERROR', 'Vous n\'&ecirc;tes pas autoris&eacute; &agrave; acc&eacute;der &agrave; cette option.: Veuillez contacter l\'administrateur si vous avez des questions.');
define( '_PLANGROUP_BACK', '&lt; Revenir');

// --== PAGE INFORMATIONS DU COMPTE ==--
define( '_CHK_USERNAME_AVAIL', 'L\'identifiant %s est disponible');
define( '_CHK_USERNAME_NOTAVAIL', 'L\'identifiant %s est d&eacute;j&agrave; pris !');

// --== PAGE ABONNEMENT ==--
define( '_MYSUBSCRIPTION_TITLE', 'Mon abonnement');
define( '_HISTORY_SUBTITLE', 'Membre depuis ');
define( '_HISTORY_COL1_TITLE', 'Facture');
define( '_HISTORY_COL2_TITLE', 'Montant');
define( '_HISTORY_COL3_TITLE', 'Date de Paiement');
define( '_HISTORY_COL4_TITLE', 'M&eacute;thode');
define( '_HISTORY_COL5_TITLE', 'Action');
define( '_HISTORY_COL6_TITLE', 'Plan');
define( '_HISTORY_ACTION_REPEAT', 'Payeur');
define( '_HISTORY_ACTION_CANCEL', 'Annuler');
define( '_RENEW_LIFETIME', 'Vous avez un abonnement &agrave; vie.');
define( '_RENEW_DAYSLEFT', 'jours restants');
define( '_RENEW_DAYSLEFT_EXCLUDED', 'Vous n\'&ecirc;tes pas concern&eacute; par l\'expiration');
define( '_RENEW_DAYSLEFT_INFINITE', '&amp;#8734');
define( '_RENEW_DAYSLEFT_TRIAL', 'jours restant pour la p&eacute;riode d\'essai');
define( '_RENEW_INFO', 'Vous utilisez les paiements r&eacute;currents.');
define( '_RENEW_OFFLINE', 'Renouveler');
define( '_RENEW_BUTTON_UPGRADE', 'Mettre &agrave; jour');
define( '_PAYMENT_PENDING_REASON_ECHECK', '&eacute;chec non r&eacute;solu (1-4 jours ouvr&eacute;s)');
define( '_PAYMENT_PENDING_REASON_TRANSFER', 'en attente de transfert du paiement');
define( '_YOUR_SUBSCRIPTION', 'Votre abonnement');
define( '_YOUR_FURTHER_SUBSCRIPTIONS', 'Abonnements suppl&eacute;mentaires');
define( '_PLAN_PROCESSOR_ACTIONS', 'Pour cela, vous disposez des options suivantes:');
define( '_AEC_SUBDETAILS_TAB_OVERVIEW', 'Vue g&eacute;n&eacute;rale');
define( '_AEC_SUBDETAILS_TAB_INVOICES', 'Factures');
define( '_AEC_SUBDETAILS_TAB_DETAILS', 'D&eacute;tails');

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

// --== PAGE EXPIRATION ==--
define( '_EXPIRE_INFO', 'Votre compte est actif jusqu\'au');
define( '_RENEW_BUTTON', 'Renouveler Maintenant');
define( '_RENEW_BUTTON_CONTINUE', 'Prolonger l\'abonnement pr&eacute;c&eacute;dent');
define( '_ACCT_DATE_FORMAT', '%d-%m-%Y');
define( '_EXPIRED', 'Votre compte est d&eacute;sactiv&eacute;&lt;br&gt; Merci de nous contacter pour renouveler votre inscription.&lt;br&gt;Date d\'expiration :');
define( '_EXPIRED_TRIAL', 'Votre p&eacute;riode d\'essai a expir&eacute; le : ');
define( '_ERRTIMESTAMP', 'Impossible de convertir l\'horodatage.');
define( '_EXPIRED_TITLE', 'Compte expir&eacute; !');
define( '_DEAR', 'Cher(e) %s');

// --== FORMULAIRE DE CONFIRMATION ==--
define( '_CONFIRM_TITLE', 'Formulaire de confirmation');
define( '_CONFIRM_COL1_TITLE', 'Compte');
define( '_CONFIRM_COL2_TITLE', 'Informations');
define( '_CONFIRM_COL3_TITLE', 'Montant');
define( '_CONFIRM_ROW_NAME', 'Nom: ');
define( '_CONFIRM_ROW_USERNAME', 'Identifiant : ');
define( '_CONFIRM_ROW_EMAIL', 'mail:');
define( '_CONFIRM_INFO', 'Veuillez utiliser le bouton Continuer pour compl&eacute;ter votre enregistrement.');
define( '_BUTTON_CONFIRM', 'Continuer');
define( '_CONFIRM_TOS', 'J\'ai lu et j\'accepte les &lt;a href=\&quot;%s\&quot; target=\&quot;_blank\&quot; title=\&quot;CdU\&quot;&gt;conditions d\'utilisation&lt;/a&gt;');
define( '_CONFIRM_TOS_IFRAME', "J\'ai lu et j\'accepte les conditions d\'utilisation (ci-dessus)");
define( '_CONFIRM_TOS_ERROR', 'Veuillez lire et accepter nos conditions d\'utilisation');
define( '_CONFIRM_COUPON_INFO', 'Si vous avez un code de bon de r&eacute;duction, vous pourrez le saisir sur la page du r&egrave;glement pour qu\'il soit pris en compte.');
define( '_CONFIRM_COUPON_INFO_BOTH', 'Si vous avez un bon de r&eacute;duction, vous pouvez le saisir ici ou sur la page de confirmation pour b&eacute;n&eacute;ficier de la remise');
define( '_CONFIRM_FREETRIAL', 'P&eacute;riode d\'essai gratuite');

// --== SHOPPING CART FORM ==--
define( '_CART_TITLE', 'Panier');
define( '_CART_ROW_TOTAL', 'Total');
define( '_CART_INFO', 'Veuillez cliquer sur le bouton Continuer ci-dessous pour finaliser votre achat.');

// --== EXCEPTION FORM ==--
define( '_EXCEPTION_TITLE', 'Informations compl&eacute;mentaires requises');
define( '_EXCEPTION_TITLE_NOFORM', 'Please note:');
define( '_EXCEPTION_INFO', 'Pour finaliser votre achat, vous devez fournir les informations compl&eacute;mentaires indiqu&eacute;es ci-dessous :');
// --== PROMPT PASSWORD FORM ==--
define( '_AEC_PROMPT_PASSWORD', 'Pour des raisons de s&eacute;curit&eacute;, vous devez entrer votre mot de passe pour continuer.');
define( '_AEC_PROMPT_PASSWORD_WRONG', 'Le mot de passe que vous avez entr&eacute; ne correspond pas &agrave; celui enregistr&eacute; dans notre base. Veuillez r&eacute;essayer s\'il vous plait.');
define( '_AEC_PROMPT_PASSWORD_BUTTON', 'Continuer');

// --== FORMULAIRE DE PAIEMENT ==--
define( '_CHECKOUT_TITLE', 'Effectuer votre r&egrave;glement');
define( '_CHECKOUT_INFO', 'Votre enregistrement a &eacute;t&eacute; pris en compte. Sur cette page, vous pouvez terminer votre r&egrave;glement - %s. &lt;br&gt; Si vous rencontrez des probl&egrave;mes en cours de route, vous pouvez revenir &agrave; cette &eacute;tape en vous authentifiant avec vos nouveaux identifiant et mot de passe - Notre syst&egrave;me vous autorisera une nouvelle tentative de r&egrave;glement.');
define( '_CHECKOUT_INFO_REPEAT', 'Merci de votre fid&eacute;lit&eacute;. Sur cette page, vous pouvez terminer votre r&egrave;glement - %s. &lt;br /&gt; Si vous rencontrez des probl&egrave;mes en cours de route, vous pouvez revenir &agrave; cette &eacute;tape en vous authentifiant avec vos nouveaux identifiant et mot de passe - Notre syst&egrave;me vous autorisera une nouvelle tentative de r&egrave;glement.');
define( '_BUTTON_CHECKOUT', 'Effectuer votre r&egrave;glement');
define( '_BUTTON_APPEND', 'Ajouter');
define( '_BUTTON_APPLY', 'Appliquer');
define( '_BUTTON_EDIT', 'Editer');
define( '_BUTTON_SELECT', 'S&eacute;lectionner');
define( '_CHECKOUT_COUPON_CODE', 'Code du bon de r&eacute;duction');
define( '_CHECKOUT_INVOICE_AMOUNT', 'Montant de la facture');
define( '_CHECKOUT_INVOICE_COUPON', 'Bon de r&amp;eactue;duction');
define( '_CHECKOUT_INVOICE_COUPON_REMOVE', 'supprimer');
define( '_CHECKOUT_INVOICE_TOTAL_AMOUNT', 'Montant total');
define( '_CHECKOUT_COUPON_INFO', 'Si vous avez un code de bon de r&eacute;duction, vous pouvez le saisir ici pour qu\'il soit pris en compte.');
define( '_CHECKOUT_GIFT_HEAD', 'Cadeau &agrave; un autre utilisateur');
define( '_CHECKOUT_GIFT_INFO', 'Veuillez saisir les d&eacute;tails d\'un autre utilisateur de ce site pour lui faire don de l\'achat que vous &ecirc;tes sur le point de faire.');
define( '_AEC_TERMTYPE_TRIAL', 'Facturation initiale');
define( '_AEC_TERMTYPE_TERM', 'Mode de facturation');
define( '_AEC_CHECKOUT_TERM', 'Mode de facturation');
define( '_AEC_CHECKOUT_NOTAPPLICABLE', 'non applicable');
define( '_AEC_CHECKOUT_FUTURETERM', 'future limite');
define( '_AEC_CHECKOUT_COST', 'Co&ucirc;t');
define( '_AEC_CHECKOUT_TAX', 'Tax');
define( '_AEC_CHECKOUT_DISCOUNT', 'Remise');
define( '_AEC_CHECKOUT_TOTAL', 'Total');
define( '_AEC_CHECKOUT_DURATION', 'Dur&eacute;e');

define( '_AEC_CHECKOUT_DUR_LIFETIME', 'Illimit&eacute;');

define( '_AEC_CHECKOUT_DUR_DAY', 'Jour');
define( '_AEC_CHECKOUT_DUR_DAYS', 'Jours');
define( '_AEC_CHECKOUT_DUR_WEEK', 'Semaine');
define( '_AEC_CHECKOUT_DUR_WEEKS', 'Semaines');
define( '_AEC_CHECKOUT_DUR_MONTH', 'Mois');
define( '_AEC_CHECKOUT_DUR_MONTHS', 'Mois');
define( '_AEC_CHECKOUT_DUR_YEAR', 'Ann&eacute;e');
define( '_AEC_CHECKOUT_DUR_YEARS', 'Ann&eacute;es');

// --== ALLOPASS ==--
define( '_REGTITLE','INSCRIPTION');
define( '_ERRORCODE','Erreur de code Allopass');
define( '_FTEXTA','Le code que vous avez utilis&eacute; n\'est pas valide! Pour obtenir un code valide, composez le num&eacute;ro de t&eacute;l&eacute;phone, indiqu&eacute; dans une fen&ecirc;tre pop-up, apr&egrave;s avoir cliqu&eacute; sur le drapeau de votre pays. Votre navigateur doit accepter les cookies.&lt;br&gt;&lt;br&gt;Si vous &ecirc;tes certain, que vous avez le bon code, attendez quelques secondes et r&eacute;essayez encore une fois!&lt;br&gt;&lt;br&gt;Sinon prenez note de la date et de l\'heure de cet avertissement d\'erreur et informez le Webmaster de ce probl&egrave;me en indiquant le code utilis&eacute;.');
define( '_RECODE','Saisir de nouveau le code Allopass');

// --== ETAPES D'ENREGISTREMENT ==--
define( '_STEP_DATA', 'Vos informations');
define( '_STEP_CONFIRM', 'Confirmer');
define( '_STEP_PLAN', 'S&eacute;lectionner le plan');
define( '_STEP_EXPIRED', 'Expir&eacute;!');

// --== PAGE NON DISPONIBLE ==--
define( '_NOT_ALLOWED_HEADLINE', 'Abonnement requis!');
define( '_NOT_ALLOWED_FIRSTPAR', 'Le Contenu que vous tentez d\'acc&eacute;der est uniquement accessible aux abonn&eacute;es de notre site. Si vous &ecirc;tes d&eacute;j&agrave; abonn&eacute; vous devez d\'abord vous connecter. Veuillez suivre ce lien si vous d&eacute;sirez vous abonner:');
define( '_NOT_ALLOWED_REGISTERLINK', 'Page d\'enregistrement');
define( '_NOT_ALLOWED_FIRSTPAR_LOGGED', 'Le contenu que vous essayez de consulter n\'est accessible qu\'&agrave; nos membres ayant souscrit &agrave; un abonnement sp&eacute;cifique. Veuillez suivre ce lien si vous souhaitez vous abonner : ');
define( '_NOT_ALLOWED_REGISTERLINK_LOGGED', 'Page d\'abonnement');
define( '_NOT_ALLOWED_SECONDPAR', 'Vous abonner ne prendra que quelques minutes - nous utilisons les services de :');

// --== PAGE ANNULATION ==--
define( '_CANCEL_TITLE', 'R&eacute;sultat d\'abonnement: Annul&eacute;!');
define( '_CANCEL_MSG', 'Notre syst&egrave;me &agrave; re&ccedil;u un message indiquant que vous avez choisi d\'annuler votre paiement. Si cela est du &agrave; un probl&egrave;me rencontr&eacute; sur notre site, n\'h&eacute;sitez pas &agrave; nous contacter !');

// --== PAGE EN ATTENTE ==--
define( '_WARN_PENDING', 'Votre compte est toujours en attente. Si vous avez ce statut depuis plusieurs heures et que votre paiement a &eacute;t&eacute; confirm&eacute;, veuillez contacter l\'administrateur du site Internet.');
define( '_PENDING_OPENINVOICE', 'Il semble que vous ayez une facture non pay&eacute;e dans notre syst&egrave;me - Si jamais vous rencontrez un probl&egrave;me lors de la proc&eacute;dure, vous pourrez revenir &agrave; la page de paiement et r&eacute;essayer :');
define( '_GOTO_CHECKOUT', 'Retourner &agrave; la page de paiement &agrave; nouveau');
define( '_GOTO_CHECKOUT_CANCEL', 'vous avez &eacute;galement la possibilibt&eacute; d\'annuler votre r&egrave;glement (vous pourrez alors retourner &agrave; l\'&eacute;cran de s&eacute;lection du plan) :');
define( '_PENDING_NOINVOICE', 'Il apparait que vous avez annul&eacute; la seule facture restante de votre compte. Veuillez cliquer sur le bouton ci-dessous pour retourner &agrave; l\'&eacute;cran de s&eacute;lection du plan :');
define( '_PENDING_NOINVOICE_BUTTON', 'S&eacute;lection du plan');
define( '_PENDING_REASON_ECHECK', 'Il apparait que vous avez d&eacute;cid&eacute; de payer par ch&egrave;que electronique, veuillez patienter jusqu\'&agrave; la validation du paiement - cela peut prendre entre 1 et 4 jours.)');
define( '_PENDING_REASON_WAITING_RESPONSE', '(D\'apr&egrave;s nos informations, nous attendons juste la r&eacute;ponse du processeur de paiement. Vous serez notifi&eacute; d&egrave;s que la r&eacute;ponse sera arriv&eacute;e. D&eacute;sol&eacute; pour le d&eacute;lai.)');
define( '_PENDING_REASON_TRANSFER', 'Il apparait que vous avez d&eacute;cid&eacute; de payer par courrier postal, veuillez patienter jusqu\'&agrave; la validation du paiement - cela peut prendre plusieurs jours.)');

// --== HOLD PAGE ==--
define( '_HOLD_TITLE', 'Compte suspendu');
define( '_HOLD_EXPLANATION', 'Votre compte est actuellement suspendu. La raison la plus probable est qu\'il y ait eu un probl&egrave;me avec votre dernier paiement. Si vous ne recevez pas de mail dans les prochaines 24 heures, veuillez contacter l\'administrateur du site.');

// --== PAGE REMERCIEMENT ==--
define( '_THANKYOU_TITLE', 'Merci !');
define( '_SUB_FEPARTICLE_HEAD', 'Abonnement compl&eacute;t&eacute;!');
define( '_SUB_FEPARTICLE_HEAD_RENEW', 'Renouvellement d\'abonnement compl&eacute;t&eacute;!');
define( '_SUB_FEPARTICLE_LOGIN', 'Vous pouvez vous connecter maintenant.');
define( '_SUB_FEPARTICLE_THANKS', 'Merci de vous &ecirc;tre abonn&eacute;. ');
define( '_SUB_FEPARTICLE_THANKSRENEW', 'Merci d\'avoir renouvel&eacute; votre abonnement. ');
define( '_SUB_FEPARTICLE_PROCESS', 'Notre syst&egrave;me va maintenant traiter votre demande. ');
define( '_SUB_FEPARTICLE_PROCESSPAY', 'Notre syst&egrave;me est en attente de votre paiement. ');
define( '_SUB_FEPARTICLE_ACTMAIL', 'Vous allez recevoir un message par mail qui contiendra un lien d\'activation quand notre syst&egrave;me aura trait&eacute; votre demande. ');
define( '_SUB_FEPARTICLE_MAIL', 'Vous allez recevoir un mail une fois que notre syst&egrave;me. ');

// --== CHECKOUT ERROR PAGE ==--
define( '_CHECKOUT_ERROR_TITLE', 'Erreur pendant le traitement de votre paiement!');
define( '_CHECKOUT_ERROR_EXPLANATION', 'Une erreur est survenue pendant le traitement de votre paiement');
define( '_CHECKOUT_ERROR_OPENINVOICE', 'Votre facture reste invalid&eacute;. Pour refaire une tentative de paiement, vous pouvez retourner sur la page de validation:');

// --== COUPON ERROR MESSAGES ==--
define( '_COUPON_WARNING_AMOUNT', 'Un des bons de r&eacute;duction que vous avez ajout&eacute; &agrave; cette facture ne modifie pas le montant du prochain paiement. Bien qu\'il semble ne pas affecter cette facture, il modifie en r&eacute;alit&eacute; un paiement ult&eacute;rieur.');
define( '_COUPON_ERROR_PRETEXT', 'Nous sommes d&eacute;sol&eacute;s :');
define( '_COUPON_ERROR_EXPIRED', 'Ce bon de r&eacute;duction est expir&eacute;.');
define( '_COUPON_ERROR_NOTSTARTED', 'vous ne pouvez pas encore utiliser ce bon de r&eacute;duction.');
define( '_COUPON_ERROR_NOTFOUND', 'Ce bon de r&eacute;duction n\'existe pas.');
define( '_COUPON_ERROR_MAX_REUSE', 'Ce bon de r&eacute;duction a d&eacute;j&agrave; &eacute;t&eacute; utilis&eacute; le nombre de fois pr&eacute;.');
define( '_COUPON_ERROR_PERMISSION', 'Vous n\'avez pas l\'autorisation d\'utiliser ce bon de r&eacute;duction.');
define( '_COUPON_ERROR_WRONG_USAGE', 'Vous ne pouvez pas utiliser ce bon de r&eacute;duction dans ce cas-ci.');
define( '_COUPON_ERROR_WRONG_PLAN', 'Vous n\'&ecirc;tes pas dans le bon plan d\'abonnement pour ce bon de r&eacute;duction.');
define( '_COUPON_ERROR_WRONG_PLAN_PREVIOUS', 'Pour pouvoir utiliser ce bon de r&eacute;duction, votre dernier plan d\'abonnement doit &ecirc;tre diff&eacute;rent.');
define( '_COUPON_ERROR_WRONG_PLANS_OVERALL', 'Vous n\'avez pas dans le bon plan d\'abonnement dans votre historique pour ce bon de r&eacute;duction.');
define( '_COUPON_ERROR_TRIAL_ONLY', 'Vous ne pouvez utiliser ce bon de r&eacute;duction que pour une p&eacute;riode d\'essai.');
define( '_COUPON_ERROR_COMBINATION', 'Ce bon n\'est pas cumulable avec d\'autres bons.');
define( '_COUPON_ERROR_SPONSORSHIP_ENDED', 'Ce bon n\'est plus valide ou bien inactif.');

// ----======== TEXTE POUR MESSAGES mailS ========----

define( '_AEC_SEND_SUB',				"D&eacute;tails du compte de %s &agrave; %s" );
define( '_AEC_USEND_MSG',				"Bonjour %s,\n\nMerci de vous &ecirc;tre inscrit &agrave; %s.\n\nVous pouvez maintenant vous connecter &agrave; %s avec l\'identifiant et le mot de passe avec lesquels vous vous &ecirc;tes inscrit." );
define( '_AEC_USEND_MSG_ACTIVATE',				"Bonjour %s,\n\nMerci de vous &ecirc;tre inscrit &agrave; %s. Votre compte est cr&eacute;&eacute; et doit &ecirc;tre activ&eacute; avant de pouvoir &ecirc;tre utilis&eacute;.\nPour activer votre compte, cliquer sur le lien suivant ou faites)en un copier/coller dans votre navigateur :\n%s\n\nApr&egrave;s l\'activation vous pourrez vous connecter &agrave; %s avec l\'identifiant et le mot de passe suivants :\n\nIdentifiant - %s\nMot de passe - %s" );
define( '_ACCTEXP_SEND_MSG','Abonnement de %s &agrave; %s');
define( '_ACCTEXP_SEND_MSG_RENEW','Renouvellement de l\'abonnement de %s &agrave; %s');
define( '_ACCTEXP_MAILPARTICLE_GREETING', 'Bonjour %s,\n\n');
define( '_ACCTEXP_MAILPARTICLE_THANKSREG', 'Merci de vous &ecirc;tre abonn&eacute; &agrave; %s.\n');
define( '_ACCTEXP_MAILPARTICLE_THANKSREN', 'Merci d\'avoir renouvel&eacute; votre abonnement &agrave; %s.');
define( '_ACCTEXP_MAILPARTICLE_PAYREC', ';Votre paiement pour votre abonnement a &eacute;t&eacute; re&ccedil;u.');
define( '_ACCTEXP_MAILPARTICLE_LOGIN', ';Vous pouvez maintenant vous connecter &agrave; %s avec votre identifiant et mot de passe.');
define( '_ACCTEXP_MAILPARTICLE_FOOTER',';\n\nNe pas r&eacute;pondre &agrave; ce message, il a &eacute;t&eacute; g&eacute;n&eacute;r&eacute; automatiquement et seulement pour votre information.');

define( '_ACCTEXP_ASEND_MSG',				'Bonjour %s,\n\nun nouvel utilisateur a cr&eacute;&eacute; un abonnement &agrave; [ %s ].\n\nLes informations pour cet utilisateur sont:\n\nNom..............: %s\nmail.........: %s\nIdentifiant : %s\nSubscr.-ID.......: %s\nAbonnement.....: %s\nIP...............: %s\nISP..............: %s\n\nNe pas r&eacute;pondre &agrave; ce message il a &eacute;t&eacute; g&eacute;n&eacute;r&eacute; automatiquement et seulement pour votre information.' );
define( '_ACCTEXP_ASEND_MSG_RENEW',			'Bonjour %s,\n\nun abonn&amp;eacte;bonn&eacute; a renouvell&eacute; son abonnement &agrave; [ %s ].\n\nLes informations pour cet utilisateur sont:\n\nNom..............: %s\nmail.........: %s\nIdentifiant : %s\nSubscr.-ID.......: %s\nAbonnement.....: %s\nIP...............: %s\nISP..............: %s\n\nNe pas r&eacute;pondre &agrave; ce message, il a &eacute;t&eacute; g&eacute;n&eacute;r&eacute; automatiquement et seulement pour votre information.' );
define( '_AEC_ASEND_MSG_NEW_REG',			'Bonjour %s,\n\nvoici un nouvel inscrit &agrave; [ %s ].\n\nVoici les d&eacute;tails :\n\nNom.....: %s\nIdentifiant : %s\nEmail....: %s\nIP.......: %s\nFAI......: %s\n\nNe pas r&eacute;pondre &agrave; ce message, il a &eacute;t&eacute; g&eacute;n&eacute;r&eacute; automatiquement et seulement pour votre information.' );
define( '_AEC_ASEND_NOTICE',				'AEC %s: %s at %s' );
define( '_AEC_ASEND_NOTICE_MSG',		'Suivant le niveau de reporting par courrier &eacute;lectronique que vous avez choisi, voici une notification automatique &agrave; propos du rapport d\'&eacute;v&egrave;nements .\n\nLes d&eacute;tails du message sont:\n\n--- --- --- ---\n\n%s\n\n--- --- --- ---\n\nNe pas r&eacute;pondre &agrave; ce message, il a &eacute;t&eacute; g&eacute;n&eacute;r&eacute; automatiquement et seulement pour votre information. Vous pouvez changer le niveau de reporting dans vos param&egrave;tres de configuration AEC.' );

// ----======== COUNTRY CODES ========----

define( 'COUNTRYCODE_SELECT', 'S&eacute;lectionner le pays' );
define( 'COUNTRYCODE_US', 'United States' );
define( 'COUNTRYCODE_AL', 'Albania' );
define( 'COUNTRYCODE_DZ', 'Algeria' );
define( 'COUNTRYCODE_AD', 'Andorra' );
define( 'COUNTRYCODE_AO', 'Angola' );
define( 'COUNTRYCODE_AI', 'Anguilla' );
define( 'COUNTRYCODE_AG', 'Antigua and Barbuda' );
define( 'COUNTRYCODE_AR', 'Argentina' );
define( 'COUNTRYCODE_AM', 'Armenia' );
define( 'COUNTRYCODE_AW', 'Aruba' );
define( 'COUNTRYCODE_AU', 'Australia' );
define( 'COUNTRYCODE_AT', 'Austria' );
define( 'COUNTRYCODE_AZ', 'Azerbaijan Republic' );
define( 'COUNTRYCODE_BS', 'Bahamas' );
define( 'COUNTRYCODE_BH', 'Bahrain' );
define( 'COUNTRYCODE_BB', 'Barbados' );
define( 'COUNTRYCODE_BE', 'Belgium' );
define( 'COUNTRYCODE_BZ', 'Belize' );
define( 'COUNTRYCODE_BJ', 'Benin' );
define( 'COUNTRYCODE_BM', 'Bermuda' );
define( 'COUNTRYCODE_BT', 'Bhutan' );
define( 'COUNTRYCODE_BO', 'Bolivia' );
define( 'COUNTRYCODE_BA', 'Bosnia and Herzegovina' );
define( 'COUNTRYCODE_BW', 'Botswana' );
define( 'COUNTRYCODE_BR', 'Brazil' );
define( 'COUNTRYCODE_VG', 'British Virgin Islands' );
define( 'COUNTRYCODE_BN', 'Brunei' );
define( 'COUNTRYCODE_BG', 'Bulgaria' );
define( 'COUNTRYCODE_BF', 'Burkina Faso' );
define( 'COUNTRYCODE_BI', 'Burundi' );
define( 'COUNTRYCODE_KH', 'Cambodia' );
define( 'COUNTRYCODE_CA', 'Canada' );
define( 'COUNTRYCODE_CV', 'Cape Verde' );
define( 'COUNTRYCODE_KY', 'Cayman Islands' );
define( 'COUNTRYCODE_TD', 'Chad' );
define( 'COUNTRYCODE_CL', 'Chile' );
define( 'COUNTRYCODE_C2', 'China' );
define( 'COUNTRYCODE_CO', 'Colombia' );
define( 'COUNTRYCODE_KM', 'Comoros' );
define( 'COUNTRYCODE_CK', 'Cook Islands' );
define( 'COUNTRYCODE_CR', 'Costa Rica' );
define( 'COUNTRYCODE_HR', 'Croatia' );
define( 'COUNTRYCODE_CY', 'Cyprus' );
define( 'COUNTRYCODE_CZ', 'Czech Republic' );
define( 'COUNTRYCODE_CD', 'Democratic Republic of the Congo' );
define( 'COUNTRYCODE_DK', 'Denmark' );
define( 'COUNTRYCODE_DJ', 'Djibouti' );
define( 'COUNTRYCODE_DM', 'Dominica' );
define( 'COUNTRYCODE_DO', 'Dominican Republic' );
define( 'COUNTRYCODE_EC', 'Ecuador' );
define( 'COUNTRYCODE_SV', 'El Salvador' );
define( 'COUNTRYCODE_ER', 'Eritrea' );
define( 'COUNTRYCODE_EE', 'Estonia' );
define( 'COUNTRYCODE_ET', 'Ethiopia' );
define( 'COUNTRYCODE_FK', 'Falkland Islands' );
define( 'COUNTRYCODE_FO', 'Faroe Islands' );
define( 'COUNTRYCODE_FM', 'Federated States of Micronesia' );
define( 'COUNTRYCODE_FJ', 'Fiji' );
define( 'COUNTRYCODE_FI', 'Finland' );
define( 'COUNTRYCODE_FR', 'France' );
define( 'COUNTRYCODE_GF', 'French Guiana' );
define( 'COUNTRYCODE_PF', 'French Polynesia' );
define( 'COUNTRYCODE_GA', 'Gabon Republic' );
define( 'COUNTRYCODE_GM', 'Gambia' );
define( 'COUNTRYCODE_DE', 'Germany' );
define( 'COUNTRYCODE_GI', 'Gibraltar' );
define( 'COUNTRYCODE_GR', 'Greece' );
define( 'COUNTRYCODE_GL', 'Greenland' );
define( 'COUNTRYCODE_GD', 'Grenada' );
define( 'COUNTRYCODE_GP', 'Guadeloupe' );
define( 'COUNTRYCODE_GT', 'Guatemala' );
define( 'COUNTRYCODE_GN', 'Guinea' );
define( 'COUNTRYCODE_GW', 'Guinea Bissau' );
define( 'COUNTRYCODE_GY', 'Guyana' );
define( 'COUNTRYCODE_HN', 'Honduras' );
define( 'COUNTRYCODE_HK', 'Hong Kong' );
define( 'COUNTRYCODE_HU', 'Hungary' );
define( 'COUNTRYCODE_IS', 'Iceland' );
define( 'COUNTRYCODE_IN', 'India' );
define( 'COUNTRYCODE_ID', 'Indonesia' );
define( 'COUNTRYCODE_IE', 'Ireland' );
define( 'COUNTRYCODE_IL', 'Israel' );
define( 'COUNTRYCODE_IT', 'Italy' );
define( 'COUNTRYCODE_JM', 'Jamaica' );
define( 'COUNTRYCODE_JP', 'Japan' );
define( 'COUNTRYCODE_JO', 'Jordan' );
define( 'COUNTRYCODE_KZ', 'Kazakhstan' );
define( 'COUNTRYCODE_KE', 'Kenya' );
define( 'COUNTRYCODE_KI', 'Kiribati' );
define( 'COUNTRYCODE_KW', 'Kuwait' );
define( 'COUNTRYCODE_KG', 'Kyrgyzstan' );
define( 'COUNTRYCODE_LA', 'Laos' );
define( 'COUNTRYCODE_LV', 'Latvia' );
define( 'COUNTRYCODE_LS', 'Lesotho' );
define( 'COUNTRYCODE_LI', 'Liechtenstein' );
define( 'COUNTRYCODE_LT', 'Lithuania' );
define( 'COUNTRYCODE_LU', 'Luxembourg' );
define( 'COUNTRYCODE_MG', 'Madagascar' );
define( 'COUNTRYCODE_MW', 'Malawi' );
define( 'COUNTRYCODE_MY', 'Malaysia' );
define( 'COUNTRYCODE_MV', 'Maldives' );
define( 'COUNTRYCODE_ML', 'Mali' );
define( 'COUNTRYCODE_MT', 'Malta' );
define( 'COUNTRYCODE_MH', 'Marshall Islands' );
define( 'COUNTRYCODE_MQ', 'Martinique' );
define( 'COUNTRYCODE_MR', 'Mauritania' );
define( 'COUNTRYCODE_MU', 'Mauritius' );
define( 'COUNTRYCODE_YT', 'Mayotte' );
define( 'COUNTRYCODE_MX', 'Mexico' );
define( 'COUNTRYCODE_MN', 'Mongolia' );
define( 'COUNTRYCODE_MS', 'Montserrat' );
define( 'COUNTRYCODE_MA', 'Morocco' );
define( 'COUNTRYCODE_MZ', 'Mozambique' );
define( 'COUNTRYCODE_NA', 'Namibia' );
define( 'COUNTRYCODE_NR', 'Nauru' );
define( 'COUNTRYCODE_NP', 'Nepal' );
define( 'COUNTRYCODE_NL', 'Netherlands' );
define( 'COUNTRYCODE_AN', 'Netherlands Antilles' );
define( 'COUNTRYCODE_NC', 'New Caledonia' );
define( 'COUNTRYCODE_NZ', 'New Zealand' );
define( 'COUNTRYCODE_NI', 'Nicaragua' );
define( 'COUNTRYCODE_NE', 'Niger' );
define( 'COUNTRYCODE_NU', 'Niue' );
define( 'COUNTRYCODE_NF', 'Norfolk Island' );
define( 'COUNTRYCODE_NO', 'Norway' );
define( 'COUNTRYCODE_OM', 'Oman' );
define( 'COUNTRYCODE_PW', 'Palau' );
define( 'COUNTRYCODE_PA', 'Panama' );
define( 'COUNTRYCODE_PG', 'Papua New Guinea' );
define( 'COUNTRYCODE_PE', 'Peru' );
define( 'COUNTRYCODE_PH', 'Philippines' );
define( 'COUNTRYCODE_PN', 'Pitcairn Islands' );
define( 'COUNTRYCODE_PL', 'Poland' );
define( 'COUNTRYCODE_PT', 'Portugal' );
define( 'COUNTRYCODE_QA', 'Qatar' );
define( 'COUNTRYCODE_CG', 'Republic of the Congo' );
define( 'COUNTRYCODE_RE', 'Reunion' );
define( 'COUNTRYCODE_RO', 'Romania' );
define( 'COUNTRYCODE_RU', 'Russia' );
define( 'COUNTRYCODE_RW', 'Rwanda' );
define( 'COUNTRYCODE_VC', 'Saint Vincent and the Grenadines' );
define( 'COUNTRYCODE_WS', 'Samoa' );
define( 'COUNTRYCODE_SM', 'San Marino' );
define( 'COUNTRYCODE_ST', 'S&atilde;o Tom&eacute; and Pr&iacute;ncipe' );
define( 'COUNTRYCODE_SA', 'Saudi Arabia' );
define( 'COUNTRYCODE_SN', 'Senegal' );
define( 'COUNTRYCODE_SC', 'Seychelles' );
define( 'COUNTRYCODE_SL', 'Sierra Leone' );
define( 'COUNTRYCODE_SG', 'Singapore' );
define( 'COUNTRYCODE_SK', 'Slovakia' );
define( 'COUNTRYCODE_SI', 'Slovenia' );
define( 'COUNTRYCODE_SB', 'Solomon Islands' );
define( 'COUNTRYCODE_SO', 'Somalia' );
define( 'COUNTRYCODE_ZA', 'South Africa' );
define( 'COUNTRYCODE_KR', 'South Korea' );
define( 'COUNTRYCODE_ES', 'Spain' );
define( 'COUNTRYCODE_LK', 'Sri Lanka' );
define( 'COUNTRYCODE_SH', 'St. Helena' );
define( 'COUNTRYCODE_KN', 'St. Kitts and Nevis' );
define( 'COUNTRYCODE_LC', 'St. Lucia' );
define( 'COUNTRYCODE_PM', 'St. Pierre and Miquelon' );
define( 'COUNTRYCODE_SR', 'Suriname' );
define( 'COUNTRYCODE_SJ', 'Svalbard and Jan Mayen Islands' );
define( 'COUNTRYCODE_SZ', 'Swaziland' );
define( 'COUNTRYCODE_SE', 'Sweden' );
define( 'COUNTRYCODE_CH', 'Switzerland' );
define( 'COUNTRYCODE_TW', 'Taiwan' );
define( 'COUNTRYCODE_TJ', 'Tajikistan' );
define( 'COUNTRYCODE_TZ', 'Tanzania' );
define( 'COUNTRYCODE_TH', 'Thailand' );
define( 'COUNTRYCODE_TG', 'Togo' );
define( 'COUNTRYCODE_TO', 'Tonga' );
define( 'COUNTRYCODE_TT', 'Trinidad and Tobago' );
define( 'COUNTRYCODE_TN', 'Tunisia' );
define( 'COUNTRYCODE_TR', 'Turkey' );
define( 'COUNTRYCODE_TM', 'Turkmenistan' );
define( 'COUNTRYCODE_TC', 'Turks and Caicos Islands' );
define( 'COUNTRYCODE_TV', 'Tuvalu' );
define( 'COUNTRYCODE_UG', 'Uganda' );
define( 'COUNTRYCODE_UA', 'Ukraine' );
define( 'COUNTRYCODE_AE', 'United Arab Emirates' );
define( 'COUNTRYCODE_GB', 'United Kingdom' );
define( 'COUNTRYCODE_UY', 'Uruguay' );
define( 'COUNTRYCODE_VU', 'Vanuatu' );
define( 'COUNTRYCODE_VA', 'Vatican City State' );
define( 'COUNTRYCODE_VE', 'Venezuela' );
define( 'COUNTRYCODE_VN', 'Vietnam' );
define( 'COUNTRYCODE_WF', 'Wallis and Futuna Islands' );
define( 'COUNTRYCODE_YE', 'Yemen' );
define( 'COUNTRYCODE_ZM', 'Zambia' );

?>