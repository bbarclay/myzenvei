<?php
/**
 * @version $Id: french.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Processor languages
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @copyright 2006-2008 Copyright (C) David Deutsch
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

define( '_AEC_LANG_PROCESSOR', 1 );

// ################## new 0.12.4
    // paypal
define( '_AEC_PROC_INFO_PP_LNAME',            'PayPal' );
define( '_AEC_PROC_INFO_PP_STMNT',            'Faites vos paiements avec Paypal - C\'est facile, gratuit et s&ucirc;r!' );
    // paypal subscription
define( '_AEC_PROC_INFO_PPS_LNAME',            ' Abonnement PayPal ' );
define( '_AEC_PROC_INFO_PPS_STMNT',            'Faites vos paiements avec Paypal - C\'est facile, gratuit et s&ucirc;r!' );
    // 2CheckOut
define( '_AEC_PROC_INFO_2CO_LNAME',            '2CheckOut' );
define( '_AEC_PROC_INFO_2CO_STMNT',            'Faites vos paiements avec 2Checkout!' );
    // alertpay
define( '_AEC_PROC_INFO_AP_LNAME',            'AlertPay' );
define( '_AEC_PROC_INFO_AP_STMNT',            ' Paiements avec AlertPay' );

define( '_DESCRIPTION_PAYPAL', 'PayPal permet d&amp;acute;envoyer de l&amp;acute;argent via courriel. PayPal est gratuit pour les consommateurs et fonctionne avec votre carte de cr&eacute;dit et compte ch&egrave;que.');
define( '_DESCRIPTION_PAYPAL_SUBSCRIPTION', 'PayPal Abonnement est le service d\'abonnement qui vous &lt;strong&gt;d&eacute;bitera votre compte de mani&egrave;re r&eacute;currente &agrave; chaque &eacute;ch&eacute;ance&lt;/strong&gt;. Vous pourrez annuler un abonnement &agrave; tout moment dans votre compte PayPal. PayPal est gratuit pour l\'acheteur et est adoss&eacute; &agrave; votre carte de cr&eacute;dit valide et &agrave; votre compte bancaire.');
define( '_DESCRIPTION_AUTHORIZE', 'La passerelle de paiement permet aux entreprises sur Internet d&amp;acute;accepter des paiements en ligne via carte de cr&eacute;dit et e-ch&egrave;que.');
define( '_DESCRIPTION_VIAKLIX', 'Procure un mode de paiement int&eacute;gr&eacute; via carte de cr&eacute;dit et carte de d&eacute;bit, conversion de ch&egrave;que &eacute;lectronique et applications reli&eacute;es..');
define( '_DESCRIPTION_ALLOPASS', 'AlloPass, est un leader Europ&eacute;en dans son domaine le syst&egrave;me de micropaiement et permet la facturation par t&eacute;l&eacute;phone, SMS et carte de cr&eacute;dit.');
define( '_DESCRIPTION_2CHECKOUT', 'Services instantan&eacute;s de traitement de carte de cr&eacute;dit pour les comptes marchand qui ont un commerce &eacute;lectronique.');
define( '_DESCRIPTION_EPSNETPAY', 'Les syst&egrave;mes de paiement eps est simple et s&eacute;curitaire.');
define( '_DESCRIPTION_ALERTPAY', 'Votre argent est prot&eacute;g&eacute; avec la politique de s&eacute;curit&eacute; des comptes AlertPay. AlertPay est ouvert &agrave; tous les commerces.');
define( '_DESCRIPTION_LOCAWEB_PGCERTO', 'Brazilian payment gateway, Pagamento Certo Locaweb allows you to easily receive money from your subscribers.');

// Generic Processor Names&amp;Descs
define( '_CFG_PROCESSOR_TESTMODE_NAME', ' Mode Test ?');
define( '_CFG_PROCESSOR_TESTMODE_DESC', 'Choisissez Oui si vous voulez fonctionner en mode test. Les transactions ne seront pas envoy&eacute;es au processeur r&eacute;el, mais seront redirig&eacute;es vers un environnement de test ou bien seront toujours approuv&eacute;es. Si vous ne comprenez pas, laissez Non.');
define( '_CFG_PROCESSOR_CURRENCY_NAME', 'Choix de la devise');
define( '_CFG_PROCESSOR_CURRENCY_DESC', 'Choisissez la devise que vous voulez utiliser pour ce Processeur.');
define( '_CFG_PROCESSOR_NAME_NAME', 'Nom affich&eacute;');
define( '_CFG_PROCESSOR_NAME_DESC', 'Change la fa&ccedil;on de nommer ce Processeur.');
define( '_CFG_PROCESSOR_DESC_NAME', 'Description affich&eacute;e ');
define( '_CFG_PROCESSOR_DESC_DESC', 'Change la description du processeur qui est par exemple montr&eacute;e sur NotAllowed page, Confirmation and Checkout.');
define( '_CFG_PROCESSOR_ITEM_NAME_NAME', 'Description de l\'article');
define( '_CFG_PROCESSOR_ITEM_NAME_DESC', 'Description de l\'article transmise au processeur.');
define( '_CFG_PROCESSOR_ITEM_NAME_DEFAULT',    'Abonnement &agrave; %s - Utilisateur: %s (%s)' );
define( '_CFG_PROCESSOR_CUSTOMPARAMS_NAME', 'Param&egrave;tres de personnalisation');
define( '_CFG_PROCESSOR_CUSTOMPARAMS_DESC', 'Param&egrave;tres de personnelisation qu\'AEC devra transmettre au Processeur de paiement au Checkout. S&eacute;par&eacute;s par un saut de ligne de la forme &quot;parameter_name=parameter_value&quot;. Le RewriteEngine travaille comme sp&eacute;cifi&eacute; ci-dessous.');
define( '_CFG_PROCESSOR_PLAN_PARAMS_RECURRING_NAME', ' Paiement r&eacute;current');
define( '_CFG_PROCESSOR_PLAN_PARAMS_RECURRING_DESC', 'Choisissez quel type de facturation &agrave; utiliser.');
define( '_CFG_PROCESSOR_LANGUAGE_NAME', 'Langue');
define( '_CFG_PROCESSOR_LANGUAGE_DESC', 'S&eacute;lectionner une des langues possibles pour votre site, visible par votre utilisateur lorsqu\'il effectuera un paiement.');
define( '_CFG_PROCESSOR_COUNTRY_NAME', 'Country');
define( '_CFG_PROCESSOR_COUNTRY_DESC', 'Select a country.');
define( '_CFG_PROCESSOR_RECURRING_NAME', 'Paiement r&eacute;current');
define( '_CFG_PROCESSOR_RECURRING_DESC', 'Choisissez le type de facturation &agrave; utiliser.');
define( '_CFG_PROCESSOR_TAX_NAME', 'Tax:');
define( '_CFG_PROCESSOR_TAX_DESC', 'Set the percentage that should be split to taxes. For example if you want 10% of 10$ to be tax - put in a 10. This will result in an amount of 9.09 and a tax amount of additional 0.91.');
define( '_CFG_PROCESSOR_GENERIC_BUTTONS_NAME', 'Generic Buttons:');
define( '_CFG_PROCESSOR_GENERIC_BUTTONS_DESC', 'Do not show buttons with the processor logo, but plan "Buy Now" and "Subscribe" buttons instead.');
define( '_CFG_PROCESSOR_CC_ICONS_NAME', 'CC Icons:');
define( '_CFG_PROCESSOR_CC_ICONS_DESC', 'Show the selected CreditCard (or similar) icons to the user as being supported by this processor.');

define( '_AEC_SELECT_RECURRING_NO', 'Non-R&eacute;current');
define( '_AEC_SELECT_RECURRING_YES', 'R&eacute;current');
define( '_AEC_SELECT_RECURRING_BOTH', 'Les deux');

// Generic User Account Form
define( '_AEC_USERFORM_BILLING_DETAILS_NAME', 'Billing Details');
define( '_AEC_USERFORM_SHIPPING_DETAILS_NAME', 'Shipping Details');
define( '_AEC_USERFORM_BILLFIRSTNAME_NAME', 'First Name');
define( '_AEC_USERFORM_BILLLASTNAME_NAME', 'Last Name');
define( '_AEC_USERFORM_BILLADDRESS_NAME', 'Address');
define( '_AEC_USERFORM_BILLADDRESS2_NAME', 'Address (continued)');
define( '_AEC_USERFORM_BILLCITY_NAME', 'City');
define( '_AEC_USERFORM_BILLNONUS_NAME', '&larr; check if Non-U.S. (State &amp; Zip not required)');
define( '_AEC_USERFORM_BILLSTATE_NAME', 'State');
define( '_AEC_USERFORM_BILLSTATEPROV_NAME', 'State/Prov');
define( '_AEC_USERFORM_BILLZIP_NAME', 'Zip');
define( '_AEC_USERFORM_BILLCOUNTRY_NAME', 'Country');
define( '_AEC_USERFORM_BILLPHONE_NAME', 'Phone');
define( '_AEC_USERFORM_BILLFAX_NAME', 'Fax');
define( '_AEC_USERFORM_BILLCOMPANY_NAME', 'Company');

// Generic Credit Card Form
define( '_AEC_CCFORM_TABNAME', 'Credit Card');
define( '_AEC_CCFORM_CARDHOLDER_NAME', 'Propri&eacute;taire de la carte');
define( '_AEC_CCFORM_CARDHOLDER_DESC', 'Le nom du propri&eacute;taire de la carte de cr&eacute;dit');
define( '_AEC_CCFORM_CARDNUMBER_NAME', 'Num&eacute;ro de la carte');
define( '_AEC_CCFORM_CARDNUMBER_DESC', 'Le num&eacute;ro de la carte de cr&eacute;dit');
define( '_AEC_CCFORM_EXPIRATIONYEAR_NAME', 'Ann&eacute;e d&amp;acute;expiration');
define( '_AEC_CCFORM_EXPIRATIONYEAR_DESC', 'L&amp;acute;ann&eacute;e lors de laquelle votre carte de cr&eacute;dit va expirer');
define( '_AEC_CCFORM_EXPIRATIONMONTH_NAME', 'Mois d&amp;acute;expiration');
define( '_AEC_CCFORM_EXPIRATIONMONTH_DESC', 'Le mois lors duquel votre carte de cr&eacute;dit va expirer');
define( '_AEC_CCFORM_CARDTYPE_NAME', 'Type de carte');
define( '_AEC_CCFORM_CARDTYPE_DESC', 'Le type de carte de cr&eacute;dit');
define( '_AEC_CCFORM_CARDVV2_NAME', 'Cryptogramme visuel de la carte');
define( '_AEC_CCFORM_CARDVV2_DESC', 'Cryptogramme visuel de la carte');
define( '_AEC_CCFORM_UPDATE_NAME', 'Update Notice');
define( '_AEC_CCFORM_UPDATE_DESC', 'To update your billing details, we need you to enter your CreditCard details again.<br />Leave fields as they are if you want to use all your previous details.<br /><br /><strong>You must always put in your CSV number!</strong>');
define( '_AEC_CCFORM_UPDATE2_DESC', 'Updated! Thank you for keeping us up to date.');

// Generic eCheck Form
define( '_AEC_ECHECKFORM_TABNAME', 'eCheck');
define( '_AEC_ECHECKFORM_ROUTING_NO_NAME', 'Routing Number');
define( '_AEC_ECHECKFORM_ROUTING_NO_DESC', 'Your Routing Number');
define( '_AEC_ECHECKFORM_ACCOUNT_NO_NAME', 'Account Number');
define( '_AEC_ECHECKFORM_ACCOUNT_NO_DESC', 'Your Account Number');
define( '_AEC_ECHECKFORM_ACCOUNT_NAME_NAME', 'Account Name');
define( '_AEC_ECHECKFORM_ACCOUNT_NAME_DESC', 'Your Name for this Account');
define( '_AEC_ECHECKFORM_BANK_NAME_NAME', 'Bank Name');
define( '_AEC_ECHECKFORM_BANK_NAME_DESC', 'The Bank Name');

// Generic Wire Transfer Form
define( '_AEC_WTFORM_TABNAME', 'Wire Transfer');
define( '_AEC_WTFORM_ACCOUNTNAME_NAME', 'Nom du titulaire du compte');
define( '_AEC_WTFORM_ACCOUNTNAME_DESC', 'Le nom de la personne qui tient ce compte');
define( '_AEC_WTFORM_ACCOUNTNUMBER_NAME', 'Num&eacute;ro de compte');
define( '_AEC_WTFORM_ACCOUNTNUMBER_DESC', 'Le num&eacute;ro du compte');
define( '_AEC_WTFORM_BANKNUMBER_NAME', 'Code banque');
define( '_AEC_WTFORM_BANKNUMBER_DESC', 'Le code banque');
define( '_AEC_WTFORM_BANKNAME_NAME', 'Nom de la banque');
define( '_AEC_WTFORM_BANKNAME_DESC', 'Le nom de la banque');

// Parametres pour Paypal
define( '_CFG_PAYPAL_BUSINESS_NAME', 'Identifiant marchand :');
define( '_CFG_PAYPAL_BUSINESS_DESC', 'Votre identifiant marchand (courriel) sur PayPal.');
define( '_CFG_PAYPAL_BROKENIPNMODE_NAME', 'Broken IPN Mode');
define( '_CFG_PAYPAL_BROKENIPNMODE_DESC', 'If the PayPal Servers fail to get back a proper response, you can manually override IPN authentication with this switch - JUST MAKE SURE TO PUT IT BACK ON AGAIN! These Problems usually go away within 24 hours.');
define( '_CFG_PAYPAL_CHECKBUSINESS_NAME', 'V&eacute;rifier ID Marchand:');
define( '_CFG_PAYPAL_CHECKBUSINESS_DESC', 'S&eacute;lectionner Oui pour activer la proc&eacute;dure de v&eacute;rification de s&eacute;curit&eacute; lors de la r&eacute;ception de la confirmation de paiement. Le champ ID receveur doit &ecirc;tre &eacute;gal &agrave; ID marchand de PayPal pour que le paiement soit accept&eacute;, si la v&eacute;rification est activ&eacute;e.');
define( '_CFG_PAYPAL_NO_SHIPPING_NAME', 'Sans livraison:');
define( '_CFG_PAYPAL_NO_SHIPPING_DESC', 'Positionnez &agrave; NON si vous voulez que vos clients indiquent une adresse de livraison - dans le cas ou il s\'agit d\'un produit qui doit &ecirc;tre physiquement livr&eacute;');
define( '_CFG_PAYPAL_ALTIPNURL_NAME', 'Domaine Alernatif pour l&amp;acute;avis IPN:');
define( '_CFG_PAYPAL_ALTIPNURL_DESC', 'Si vous utilisez un &eacute;quilibre de charge sur le serveur (changement entre les addresses IP), il se peut que Paypal n&amp;acute;aime pas cela et coupe la connexion lors de l&amp;acute;envoi de l&amp;acute;IPN. Pour contourner ce probl&egrave;me, vous pouvez par exemple cr&eacute;er un nouveau sousdomaine sur ce serveur et d&eacute;sactiver l&amp;acute;&eacute;quilibre de charge. Entrer l&amp;acute;adresse ici (Dans ce format &quot;http://sousdomaine.domaine.com&quot; - sans barre oblique &agrave; la fin) pour &ecirc;tre certain que Paypal envoie seulement le IPN &agrave; cette adresse. &lt;strong&gt;Si vous n&amp;acute;&ecirc;tes pas certain de ce que cela signifie, laisser ce champ vide!&lt;/strong&gt;');
define( '_CFG_PAYPAL_LC_NAME', 'Langue:');
define( '_CFG_PAYPAL_LC_DESC', 'S&eacute;lectionner une des langues disponibles pour le site de Paypal que les utilisateurs vont voir lors de leur paiement.');
define( '_CFG_PAYPAL_TAX_NAME', 'Taxe:');
define( '_CFG_PAYPAL_TAX_DESC', 'Fixez le taux qui doit &ecirc;tre appliqu&eacute; pour les taxes. Par exemple si vous voulez 10% de 10 comme taxe - mettez 10. Le r&eacute;sultat sera un montant hors taxe de 9,09 et un montant de taxe &agrave; additionner de 0,91.');
define( '_CFG_PAYPAL_ACCEPTPENDINGECHECK_NAME', 'Acceptation de eCheck en attente:');
define( '_CFG_PAYPAL_ACCEPTPENDINGECHECK_DESC', 'Acceptation de eChecks en attente prend habituellement 4 jours pour s\'&eacute;xecuter. Positionnez &agrave; Non pour &eacute;viter la fraude aux eCheck.');

define( '_CFG_PAYPAL_CBT_NAME', 'Bouton suite');
define( '_CFG_PAYPAL_CBT_DESC', 'Fixe le texte du bouton Suite sur la page PayPal &quot;Payment Complete&quot; .');
define( '_CFG_PAYPAL_CN_NAME', 'Note Label');
define( '_CFG_PAYPAL_CN_DESC', 'Le libell&eacute; au dessus du champ note.');
define( '_CFG_PAYPAL_CPP_HEADER_IMAGE_NAME', 'Image d\'ent&ecirc;te');
define( '_CFG_PAYPAL_CPP_HEADER_IMAGE_DESC', 'URL pour l\'image en haut &agrave; gauche de la page paiement (la taille maximum de l\'image est 750x90 pixels)');
define( '_CFG_PAYPAL_CPP_HEADERBACK_COLOR_NAME', 'Couleur de fond de l\'ent&ecirc;te');
define( '_CFG_PAYPAL_CPP_HEADERBACK_COLOR_DESC', 'Couleur de fond pour l\'ent&ecirc;te de la page de paiement (6 caract&egrave;res HTML hexadecimal code couleur ASCII)');
define( '_CFG_PAYPAL_CPP_HEADERBORDER_COLOR_NAME', 'Headerborder Color');
define( '_CFG_PAYPAL_CPP_HEADERBORDER_COLOR_DESC', 'Couleur des bordures de l\'ent&ecirc;te de la page de paiement (6 caract&egrave;res HTML hexadecimal code couleur ASCII)');
define( '_CFG_PAYPAL_CPP_PAYFLOW_COLOR_NAME', 'Couleur du Payflow ');
define( '_CFG_PAYPAL_CPP_PAYFLOW_COLOR_DESC', 'Couleur de fond de la page de paiement sous l\'en t&ecirc;te (6 caract&egrave;res HTML hexadecimal code couleur ASCII)');
define( '_CFG_PAYPAL_CS_NAME', 'Nuance du fond');
define( '_CFG_PAYPAL_CS_DESC', 'Par d&eacute;faut  - &quot;Non&quot; - laisse la couleur de fond &agrave; blanc, si vous mettez &quot;Oui&quot; la couleur de fond passe &agrave; noir');
define( '_CFG_PAYPAL_IMAGE_URL_NAME', 'Logo');
define( '_CFG_PAYPAL_IMAGE_URL_DESC', 'URL de l\'image affich&amp;ecute;e comme votre logo dans le coin en haut &agrave; gauche des pages PayPal (150x50 pixels)');
define( '_CFG_PAYPAL_PAGE_STYLE_NAME', 'Style de la page');
define( '_CFG_PAYPAL_PAGE_STYLE_DESC', 'Fixe le style de la page de paiement en personnalisation des pages de paiement. R&eacute;serv&eacute;: &quot;primary&quot; - Toujours utiliser le style de la page fix&eacute; en premier, &quot;paypal&quot; - Utilisez le style par d&eacute;faut PayPal. Tout autre nom doit se r&eacute;f&eacute;rer au style de la page que vous avez d&eacute;fini dans le PayPal Backend (alphanum&eacute;rique ASCII lower 7-bit caract&egrave;res seulement, ni soulignement ni espace)');

// Parametres pour Paypal Subscriptions
define( '_CFG_PAYPAL_SUBSCRIPTION_BUSINESS_NAME', _CFG_PAYPAL_BUSINESS_NAME);
define( '_CFG_PAYPAL_SUBSCRIPTION_BUSINESS_DESC', _CFG_PAYPAL_BUSINESS_DESC);
define( '_CFG_PAYPAL_SUBSCRIPTION_BROKENIPNMODE_NAME', _CFG_PAYPAL_BROKENIPNMODE_NAME);
define( '_CFG_PAYPAL_SUBSCRIPTION_BROKENIPNMODE_DESC', _CFG_PAYPAL_BROKENIPNMODE_DESC);
define( '_CFG_PAYPAL_SUBSCRIPTION_CHECKBUSINESS_NAME', _CFG_PAYPAL_CHECKBUSINESS_NAME);
define( '_CFG_PAYPAL_SUBSCRIPTION_CHECKBUSINESS_DESC', _CFG_PAYPAL_CHECKBUSINESS_DESC);
define( '_CFG_PAYPAL_SUBSCRIPTION_NO_SHIPPING_NAME', _CFG_PAYPAL_NO_SHIPPING_NAME);
define( '_CFG_PAYPAL_SUBSCRIPTION_NO_SHIPPING_DESC', _CFG_PAYPAL_NO_SHIPPING_DESC);
define( '_CFG_PAYPAL_SUBSCRIPTION_ALTIPNURL_NAME', _CFG_PAYPAL_ALTIPNURL_NAME);
define( '_CFG_PAYPAL_SUBSCRIPTION_ALTIPNURL_DESC', _CFG_PAYPAL_ALTIPNURL_DESC);
define( '_CFG_PAYPAL_SUBSCRIPTION_LC_NAME', _CFG_PAYPAL_LC_NAME);
define( '_CFG_PAYPAL_SUBSCRIPTION_LC_DESC', _CFG_PAYPAL_LC_DESC);
define( '_CFG_PAYPAL_SUBSCRIPTION_TAX_NAME', _CFG_PAYPAL_TAX_NAME);
define( '_CFG_PAYPAL_SUBSCRIPTION_TAX_DESC', _CFG_PAYPAL_TAX_DESC);
define( '_PAYPAL_SUBSCRIPTION_CANCEL_INFO', 'Si vous voulez changer votre abonnement, vous devez d\'abord annuler votre abonnement actuel dans votre compte PayPal!');
define( '_CFG_PAYPAL_SUBSCRIPTION_ACCEPTPENDINGECHECK_NAME', _CFG_PAYPAL_ACCEPTPENDINGECHECK_NAME);
define( '_CFG_PAYPAL_SUBSCRIPTION_ACCEPTPENDINGECHECK_DESC', _CFG_PAYPAL_ACCEPTPENDINGECHECK_DESC);
define( '_CFG_PAYPAL_SUBSCRIPTION_SRT_NAME', 'Nombre total d\'occurences');
define( '_CFG_PAYPAL_SUBSCRIPTION_SRT_DESC', 'If you want to limit the number of total subscription payments, you can do so with this field.');

define( '_CFG_PAYPAL_SUBSCRIPTION_CBT_NAME', _CFG_PAYPAL_CBT_NAME);
define( '_CFG_PAYPAL_SUBSCRIPTION_CBT_DESC', _CFG_PAYPAL_CBT_DESC);
define( '_CFG_PAYPAL_SUBSCRIPTION_CN_NAME', _CFG_PAYPAL_CN_NAME);
define( '_CFG_PAYPAL_SUBSCRIPTION_CN_DESC', _CFG_PAYPAL_CN_DESC);
define( '_CFG_PAYPAL_SUBSCRIPTION_CPP_HEADER_IMAGE_NAME', _CFG_PAYPAL_CPP_HEADER_IMAGE_NAME);
define( '_CFG_PAYPAL_SUBSCRIPTION_CPP_HEADER_IMAGE_DESC', _CFG_PAYPAL_CPP_HEADER_IMAGE_DESC);
define( '_CFG_PAYPAL_SUBSCRIPTION_CPP_HEADERBACK_COLOR_NAME', _CFG_PAYPAL_CPP_HEADERBACK_COLOR_NAME);
define( '_CFG_PAYPAL_SUBSCRIPTION_CPP_HEADERBACK_COLOR_DESC', _CFG_PAYPAL_CPP_HEADERBACK_COLOR_DESC);
define( '_CFG_PAYPAL_SUBSCRIPTION_CPP_HEADERBORDER_COLOR_NAME', _CFG_PAYPAL_CPP_HEADERBORDER_COLOR_NAME);
define( '_CFG_PAYPAL_SUBSCRIPTION_CPP_HEADERBORDER_COLOR_DESC', _CFG_PAYPAL_CPP_HEADERBORDER_COLOR_DESC);
define( '_CFG_PAYPAL_SUBSCRIPTION_CPP_PAYFLOW_COLOR_NAME', _CFG_PAYPAL_CPP_PAYFLOW_COLOR_NAME);
define( '_CFG_PAYPAL_SUBSCRIPTION_CPP_PAYFLOW_COLOR_DESC', _CFG_PAYPAL_CPP_PAYFLOW_COLOR_DESC);
define( '_CFG_PAYPAL_SUBSCRIPTION_CS_NAME', _CFG_PAYPAL_CS_NAME);
define( '_CFG_PAYPAL_SUBSCRIPTION_CS_DESC', _CFG_PAYPAL_CS_DESC);
define( '_CFG_PAYPAL_SUBSCRIPTION_IMAGE_URL_NAME', _CFG_PAYPAL_IMAGE_URL_NAME);
define( '_CFG_PAYPAL_SUBSCRIPTION_IMAGE_URL_DESC', _CFG_PAYPAL_IMAGE_URL_DESC);
define( '_CFG_PAYPAL_SUBSCRIPTION_PAGE_STYLE_NAME', _CFG_PAYPAL_PAGE_STYLE_NAME);
define( '_CFG_PAYPAL_SUBSCRIPTION_PAGE_STYLE_DESC', _CFG_PAYPAL_PAGE_STYLE_DESC);

// Parametres de Transfert
define( '_CFG_TRANSFER_TITLE', 'Transfert');
define( '_CFG_TRANSFER_SUBTITLE', 'Paiements Non-Automatiques.');
define( '_CFG_TRANSFER_ENABLE_NAME', 'Autoriser les paiements non automatique?');
define( '_CFG_TRANSFER_ENABLE_DESC', 'S&eacute;lectionner Oui si vous voulez fournir une option pour le paiement non automatique, comme un virement bancaire par exemple. Les utilisateurs qui s&amp;acute;inscriront verront les instructions fournies par vous (champ ci-contre) leur expliquant comment payer leur abonnement. Cette option requiert une gestion non automatique, vous aurez donc &agrave; configurer la date d&amp;acute;expiration manuellement depuis l&amp;acute;interface d&amp;acute;administration.');
define( '_CFG_TRANSFER_INFO_NAME', 'Information pour le paiement manuel :');
define( '_CFG_TRANSFER_INFO_DESC', 'Texte pr&eacute;sent&eacute; &agrave; l&amp;acute;utilisateur apr&egrave;s son inscription initiale (utiliser les marqueurs HTML). Apr&egrave;s l&amp;acute;inscription et &agrave; sa premi&egrave;re connexion, une expiration automatique est mise en place sur son compte (premier onglet Configuration). L\'utilisateur doit suivre vos instructions pour payer son abonnement. Vous devrez confirmer vous-m&ecirc;me son paiement et la nouvelle date d&amp;acute;expiration de son compte.');

// Parametres Viaklix
define( '_CFG_VIAKLIX_ACCOUNTID_NAME', 'ID du Compte');
define( '_CFG_VIAKLIX_ACCOUNTID_DESC', 'Votre ID de compte chez viaKLIX.');
define( '_CFG_VIAKLIX_USERID_NAME', 'ID Utilisateur');
define( '_CFG_VIAKLIX_USERID_DESC', 'Votre ID Utilisateur chez viaKLIX.');
define( '_CFG_VIAKLIX_PIN_NAME', 'NIP');
define( '_CFG_VIAKLIX_PIN_DESC', 'NIP sur le terminal.');

// VirtualMerchant (successor of Viaklix) Settings
define( '_CFG_VIRTUALMERCHANT_ACCOUNTID_NAME', 'Account ID');
define( '_CFG_VIRTUALMERCHANT_ACCOUNTID_DESC', 'Your Account ID on viaKLIX.');
define( '_CFG_VIRTUALMERCHANT_USERID_NAME', 'User ID');
define( '_CFG_VIRTUALMERCHANT_USERID_DESC', 'Your User ID on viaKLIX.');
define( '_CFG_VIRTUALMERCHANT_PIN_NAME', 'PIN');
define( '_CFG_VIRTUALMERCHANT_PIN_DESC', 'PIN of the terminal.');

// Parametres Authorize.net
define( '_CFG_AUTHORIZE_LOGIN_NAME', 'API ID de connexion');
define( '_CFG_AUTHORIZE_LOGIN_DESC', 'Votre API ID de connexion sur Authorize.net.');
define( '_CFG_AUTHORIZE_TRANSACTION_KEY_NAME', 'Cl&eacute; de transaction');
define( '_CFG_AUTHORIZE_TRANSACTION_KEY_DESC', 'Votre cl&eacute; de transaction sur Authorize.net.');
define( '_CFG_AUTHORIZE_TIMESTAMP_OFFSET_NAME', 'Horodatage');
define( '_CFG_AUTHORIZE_TIMESTAMP_OFFSET_DESC', 'Si vous obtenez une erreur 97 en cr&eacute;ant une transaction svp &lt;a href=&quot;http://developer.authorize.net/tools/responsecode97/&quot;&gt;regardez ceci&lt;/a&gt;. Vous avez peut &ecirc;tre besoin de poser un horodatage ici.');
define( '_CFG_AUTHORIZE_X_LOGO_URL_NAME', 'Logo URL');
define( '_CFG_AUTHORIZE_X_LOGO_URL_DESC', 'Ce champ sert &agrave; afficher un logo marchand sur la page. La cible de cet URL sera affich&eacute;e sur l\'en t&ecirc;te de la Payment Form et de la Receipt Page.');
define( '_CFG_AUTHORIZE_X_BACKGROUND_URL_NAME', 'Background URL');
define( '_CFG_AUTHORIZE_X_BACKGROUND_URL_DESC', 'Ce champ permet au marchand de personnaliser l\'image de fond de la Payment Form et de la Receipt Page. La cible de l\'URL sp&eacute;cifi&eacute;e sera affich&eacute;e en arri&egrave;re plan.');
define( '_CFG_AUTHORIZE_X_COLOR_BACKGROUND_NAME', 'Couleur de fond');
define( '_CFG_AUTHORIZE_X_COLOR_BACKGROUND_DESC', 'La valeur dans ce champ fixera la couleur de fond pour la Payment Form et la Receipt Page.');
define( '_CFG_AUTHORIZE_X_COLOR_LINK_NAME', 'Lien couleur');
define( '_CFG_AUTHORIZE_X_COLOR_LINK_DESC', ' Ce champ permet de fixer la couleur des liens HTML pour la  Payment Form et la Receipt Page .');
define( '_CFG_AUTHORIZE_X_COLOR_TEXT_NAME', 'Couleur du texte');
define( '_CFG_AUTHORIZE_X_COLOR_TEXT_DESC', 'Ce champ permet de fixer la couleur du texte sur la Payment Form et la Receipt Page.');
define( '_CFG_AUTHORIZE_X_HEADER_HTML_RECEIPT_NAME', 'En t&ecirc;te Receipt Page');
define( '_CFG_AUTHORIZE_X_HEADER_HTML_RECEIPT_DESC', 'Le texte contenu dans ce champ sera affich&eacute; en haut de la Receipt Page.');
define( '_CFG_AUTHORIZE_X_FOOTER_HTML_RECEIPT_NAME', 'Pied de la Receipt Page');
define( '_CFG_AUTHORIZE_X_FOOTER_HTML_RECEIPT_DESC', 'Le texte contenu dans ce champ sera affich&eacute; en bas de la Receipt Page.');

// Parametres Allopass
define( '_CFG_ALLOPASS_SITEID_NAME', 'SITE_ID');
define( '_CFG_ALLOPASS_SITEID_DESC', 'Votre SITE_ID sur AlloPass.');
define( '_CFG_ALLOPASS_DOCID_NAME', 'DOC_ID');
define( '_CFG_ALLOPASS_DOCID_DESC', 'Your DOC_ID sur AlloPass.');
define( '_CFG_ALLOPASS_AUTH_NAME', 'AUTH');
define( '_CFG_ALLOPASS_AUTH_DESC', 'AUTH sur AlloPass.');
define( '_CFG_ALLOPASS_PLAN_PARAMS_DOCID_NAME', 'DOC_ID');
define( '_CFG_ALLOPASS_PLAN_PARAMS_DOCID_DESC', 'Your DOC_ID on AlloPass.');

// Parametres 2Checkout
define( '_CFG_2CHECKOUT_SID_NAME', 'SID');
define( '_CFG_2CHECKOUT_SID_DESC', 'Votre num&eacute;ro de compte 2checkout.');
define( '_CFG_2CHECKOUT_SECRET_WORD_NAME', 'Mot Secret');
define( '_CFG_2CHECKOUT_SECRET_WORD_DESC', 'M&ecirc;me mot secret configur&eacute; par vous m&ecirc;me sur la page Look and Feel.');
define( '_CFG_2CHECKOUT_INFO_NAME', 'NOTE IMPORTANTE!');
define( '_CFG_2CHECKOUT_INFO_DESC', 'Sur la page d&amp;acute;accueil de votre compte 2Checkout, trouver la section &quot;Helpful Links&quot;, cliquer sur le lien &quot;Look and Feel&quot;. Configurer le champ &quot;Approved URL&quot; avec l&amp;acute;URL &quot;http://votresite.com/index.php?option=com_acctexp&amp;task=2conotification&quot;. ' . 'Remplacer &quot;votresite.com&quot; avec votre propre nom de domaine.');
define( '_CFG_2CHECKOUT_ALT2COURL_NAME', 'Url Alternative');
define( '_CFG_2CHECKOUT_ALT2COURL_DESC', '&Agrave; essayer si vous rencontrez des erreurs de param&egrave;tres.');

// WorldPay Settings
define( '_CFG_WORLDPAY_LONGNAME',        'WorldPay' );
define( '_CFG_WORLDPAY_STATEMENT',        'Paiements avec WorldPay' );
define( '_CFG_WORLDPAY_DESCRIPTION',    'Accepte les paiements sur internet, par t&eacute;l&eacute;phone, fax ou mail. Cartes de Cr&eacute;dit et de D&eacute;bit, transferts bancaires et acomptes. Dans n\'importe quelle langue et la plupart des devises' );
define( '_CFG_WORLDPAY_INSTID_NAME',     'instId');
define( '_CFG_WORLDPAY_INSTID_DESC',     'Your WorldPay Installation Id.');
define( '_CFG_WORLDPAY_INFO_NAME',     'Postback URL');
define( '_CFG_WORLDPAY_INFO_DESC',     'Vous devez fixer la Callback URL  dans Configuration Options de votre installation de Customer Management System in your Worldpay Account... the url is:&lt;br /&gt;http://[YOUR JOOMLA LOCATION]/index.php?option=com_acctexp&amp;task=worldpaynotification&lt;br /&gt;Thats it. More detailed information &lt;a href=&quot;http://support.worldpay.com/kb/integration_guides/junior/integration/help/payment_response/sjig_5127.html&quot;&gt;here&lt;/a&gt;');
define( '_CFG_WORLDPAY_CALLBACKPW_NAME',     'Callback Password');
define( '_CFG_WORLDPAY_CALLBACKPW_DESC',     'Svp choisissez un Callback Password pour Worldpay Account et entrez le ici une seconde fois. Vous aurez ainsi vos notifications de paiement.');

// WorldPay Futurepay Settings
define( '_CFG_WORLDPAY_FUTUREPAY_LONGNAME',        'WorldPay Futurepay' );
define( '_CFG_WORLDPAY_FUTUREPAY_STATEMENT',    'Paiements r&eacute;currents avec WorldPay' );
define( '_CFG_WORLDPAY_FUTUREPAY_DESCRIPTION',    'Accepte les paiements sur internet, par t&eacute;l&eacute;phone, fax ou mail. Cartes de cr&eacute;dit et de d&eacute;bit, transferts bancaires et acomptes. Dans n\'importe quelle langue et la plupart des devises' );
define( '_CFG_WORLDPAY_FUTUREPAY_INSTID_NAME',     'instId');
define( '_CFG_WORLDPAY_FUTUREPAY_INSTID_DESC',     'Your WorldPay Installation Id.');
define( '_CFG_WORLDPAY_FUTUREPAY_INFO_NAME',     'Callback URL');
define( '_CFG_WORLDPAY_FUTUREPAY_INFO_DESC',     'You need to set the Callback URL in the Configuration Options of your installation on the Customer Management System in your Worldpay Account... the url is:&lt;br /&gt;http://[YOUR JOOMLA LOCATION]/index.php?option=com_acctexp&amp;task=worldpay_futurepaynotification&lt;br /&gt;Thats it. More detailed information &lt;a href=&quot;http://support.worldpay.com/kb/integration_guides/junior/integration/help/payment_response/sjig_5127.html&quot;&gt;here&lt;/a&gt;');
define( '_CFG_WORLDPAY_FUTUREPAY_CALLBACKPW_NAME',     'Callback Password');
define( '_CFG_WORLDPAY_FUTUREPAY_CALLBACKPW_DESC',     'Svp choisissez un Callback Password pour Worldpay Account et entrez le ici une seconde fois. Vous aurez ainsi vos notifications de paiement.');

// Parametres epsNetpay
define( '_CFG_EPSNETPAY_MERCHANTID_NAME', 'ID Marchand');
define( '_CFG_EPSNETPAY_MERCHANTID_DESC', 'Votre num&eacute;ro de compte epsNetpay.');
define( '_CFG_EPSNETPAY_MERCHANTPIN_NAME', 'NIP Marchand');
define( '_CFG_EPSNETPAY_MERCHANTPIN_DESC', 'Votre NIP Marchand.');
define( '_CFG_EPSNETPAY_ACTIVATE_NAME', 'Activez');
define( '_CFG_EPSNETPAY_ACTIVATE_DESC', 'Proposez cette banque.');
define( '_CFG_EPSNETPAY_ACCEPTVOK_NAME', 'Accept VOK');
define( '_CFG_EPSNETPAY_ACCEPTVOK_DESC', 'Il est possible que d&ucirc; au type de compte que vous avez, vous n\'obteniez jamais une r&eacute;ponse  &quot;OK&quot;, mais toujours &quot;VOK&quot;. Dans ce cas positionnez sur On');

// Parametre Paysignet
define( '_CFG_PAYSIGNET_MERCHANT_NAME', 'Marchand');
define( '_CFG_PAYSIGNET_MERCHANT_DESC', 'Votre nom Marchand.');

// AlertPay Settings
define( '_CFG_ALERTPAY_MERCHANT_NAME', 'Merchant');
define( '_CFG_ALERTPAY_MERCHANT_DESC', 'Your Merchant Name.');
define( '_CFG_ALERTPAY_SECURITYCODE_NAME', 'Security Code');
define( '_CFG_ALERTPAY_SECURITYCODE_DESC', 'Your Security Code.');

// eWay Settings
define( '_CFG_EWAY_LONGNAME', 'eWay');
define( '_CFG_EWAY_STATEMENT', 'R&eacute;glez vos paiements avec eWAY Shared Payment Solution!');
define( '_CFG_EWAY_DESCRIPTION', 'eWAY est la passerelle de paiement la plus facile d\'utilisation et la moins ch&egrave;re d\'Australie. Process credit card payments via eWAY\'s own secure Shared Payment Page in real-time.');
define( '_CFG_EWAY_CUSTID_NAME', 'Client ID');
define( '_CFG_EWAY_CUSTID_DESC', 'Votre code client.');
define( '_CFG_EWAY_AUTOREDIRECT_NAME', 'Autoredirect');
define( '_CFG_EWAY_AUTOREDIRECT_DESC', 'Automatic Redirect for eWay Transaction');
define( '_CFG_EWAY_SITETITLE_NAME', 'Titre du site');
define( '_CFG_EWAY_SITETITLE_DESC', 'Le titre du site de la transaction eWay ');

// eWayXML Settings
define( '_CFG_EWAYXML_LONGNAME', 'eWayXML');
define( '_CFG_EWAYXML_STATEMENT', 'R&eacute;glez vos paiements avec eWAY Shared Payment Solution!');
define( '_CFG_EWAYXML_DESCRIPTION', 'eWAY est la passerelle de paiement la plus facile d\'utilisation et la moins ch&egrave;re d\'Australie. Process credit card payments via eWAY\'s own secure Shared Payment Page in real-time.');
define( '_CFG_EWAYXML_CUSTID_NAME', 'Client ID');
define( '_CFG_EWAYXML_CUSTID_DESC', 'Votre code client.');
define( '_CFG_EWAYXML_AUTOREDIRECT_NAME', 'Autoredirect');
define( '_CFG_EWAYXML_AUTOREDIRECT_DESC', 'Automatic Redirect for eWay Transaction');
define( '_CFG_EWAYXML_SITETITLE_NAME', 'Titre du site');
define( '_CFG_EWAYXML_SITETITLE_DESC', 'Le titre du site de la transaction eWay ');

// MoneyProxy Settings
define( '_CFG_MONEYPROXY_LONGNAME', 'MoneyProxy');
define( '_CFG_MONEYPROXY_STATEMENT', 'R&eacute;glez vos paiements en diff&eacute;rentes devises &eacute;lectroniques avec Money Proxy!');
define( '_CFG_MONEYPROXY_DESCRIPTION', 'Acceptez des paiements sur un site Web en plusieurs devises &eacute;lectroniques avec un seul compte marchand.');
define( '_CFG_MONEYPROXY_MERCHANT_ID_NAME', 'Identifiant Marchand');
define( '_CFG_MONEYPROXY_MERCHANT_ID_DESC', 'Votre identifiant marchand chez MoneyProxy.');
define( '_CFG_MONEYPROXY_FORCE_CLIENT_RECEIPT_NAME', 'For&ccedil;age du re&ccedil;u');
define( '_CFG_MONEYPROXY_FORCE_CLIENT_RECEIPT_DESC', 'En positionnant ce param&egrave;tre &agrave; &quot;Oui&quot;, vous forcez Money Proxy &agrave; demander une adresse email o&ugrave; envoyer le re&ccedil;u de paiement. Par d&eacute;faut, le client peut sauter cette &eacute;tape de re&ccedil;u en laissant l\'adresse email &agrave; blanc.');
define( '_CFG_MONEYPROXY_SECRET_KEY_NAME', 'Titre du site');
define( '_CFG_MONEYPROXY_SECRET_KEY_DESC', 'Votre cl&eacute; secr&egrave;te chez MoneyProxy.');
define( '_CFG_MONEYPROXY_SUGGESTED_MEMO_NAME', 'Suggested Memo');
define( '_CFG_MONEYPROXY_SUGGESTED_MEMO_DESC', 'Ce param&egrave;tre est utilis&eacute; pour pr&eacute;-remplir le champ m&eacute;mo pour de nombreux syst&egrave;mes de paiement. Malheureusement il est possible que certains syst&egrave;mes depaiement ne supportent pas cette fonctionnalit&eacute;. Maximum de 40 caract&egrave;res.');
define( '_CFG_MONEYPROXY_PAYMENT_ID_NAME', 'Identifiant de paiement ID');
define( '_CFG_MONEYPROXY_PAYMENT_ID_DESC', 'Le marchand peut utiliser ce champ pour suivre le paiement quand l\'&eacute;tat de l\'URL est appel&eacute;. On peut aller jusqu\'&agrave; 10 positions avec seulement des lettres et des chiffres (0-9a-zA-Z). You can use Rewrite tags here.');

// Offline Payment
define( '_CFG_OFFLINE_PAYMENT_LONGNAME', 'Paiement manuel');
define( '_CFG_OFFLINE_PAYMENT_STATEMENT', 'Vous pouvez utiliser cette option si vous ne voulez pas payer par Internet');
define( '_CFG_OFFLINE_PAYMENT_DESCRIPTION', 'Vous pouvez utiliser cette option si vous ne voulez pas payer par Internet');
define( '_CFG_OFFLINE_PAYMENT_INFO_NAME', 'Info');
define( '_CFG_OFFLINE_PAYMENT_INFO_DESC', 'L\'information qui sera affich&eacute;e &agrave; l\'utilisateur au checkout');
define( '_CFG_OFFLINE_PAYMENT_WAITINGPLAN_NAME', 'Plan d\'attente');
define( '_CFG_OFFLINE_PAYMENT_WAITINGPLAN_DESC', 'Vous pouvez assigner ce plan &agrave; un utilisateur pendant qu\'il attend son paiement');

define( '_CFG_OFFLINE_PAYMENT_EMAIL_INFO_NAME',		'E-Mail Info' );
define( '_CFG_OFFLINE_PAYMENT_EMAIL_INFO_DESC',		'Do you want to mail out any information similar to the one displayed on the checkout page to the user when the Invoice is created?' );
define( '_CFG_OFFLINE_PAYMENT_EMAIL_LINK_NAME',		'E-Mail Link' );
define( '_CFG_OFFLINE_PAYMENT_EMAIL_LINK_DESC',		'This provides a link on the Invoice List in the users MySubscription page to send the Payment Details via E-Mail' );
define( '_CFG_OFFLINE_PAYMENT_SENDER_NAME',		'Sender E-Mail' );
define( '_CFG_OFFLINE_PAYMENT_SENDER_DESC',		'Sender E-Mail Address' );
define( '_CFG_OFFLINE_PAYMENT_SENDER_NAME_NAME',	'Sender Name' );
define( '_CFG_OFFLINE_PAYMENT_SENDER_NAME_DESC',	'The displayed name of the Sender' );
define( '_CFG_OFFLINE_PAYMENT_RECIPIENT_NAME',	'Recipient(s)' );
define( '_CFG_OFFLINE_PAYMENT_RECIPIENT_DESC',	'Who is to receive this E-Mail? Separate with comma. The rewriting routines explained below will work for this field.' );
define( '_CFG_OFFLINE_PAYMENT_BCC_NAME',	'BCC' );
define( '_CFG_OFFLINE_PAYMENT_BCC_DESC',	'Who should receive blind carbon copies E-Mail? Separate with comma. The rewriting routines explained below will work for this field.' );
define( '_CFG_OFFLINE_PAYMENT_SUBJECT_NAME',		'Subject' );
define( '_CFG_OFFLINE_PAYMENT_SUBJECT_DESC',		'Subject of this email (Uses RewriteEngine explained below as well)' );
define( '_CFG_OFFLINE_PAYMENT_TEXT_HTML_NAME',	'HTML Encoding' );
define( '_CFG_OFFLINE_PAYMENT_TEXT_HTML_DESC',	'Do you want this email to be HTML encoded? (Make sure that there are not tags in it if you do not want this)' );
define( '_CFG_OFFLINE_PAYMENT_TEXT_NAME',			'Text' );
define( '_CFG_OFFLINE_PAYMENT_TEXT_DESC',			'Text to be sent when the plan is purchased. The rewriting routines explained below will work for this field.' );

// Verotel
define( '_CFG_VEROTEL_LONGNAME', 'Verotel');
define( '_CFG_VEROTEL_STATEMENT', 'Utilisez Verotel: Ayez confiance dans Global Payments');
define( '_CFG_VEROTEL_DESCRIPTION', 'Verotel propose un ensemble de m&eacute;thodes de facturation pour votre site Web incluant VISA/MasterCard/JCB, debit chinois, d&eacute;bit direct dans les pays europ&eacute;ens, paiement t&eacute;l&eacute;phonique, paiement &agrave; la minute, facturation SMS et bien plus encore!');
define( '_CFG_VEROTEL_MERCHANTID_NAME', 'ID marchand');
define( '_CFG_VEROTEL_MERCHANTID_DESC', 'Votre identifiant marchand chez Verotel.');
define( '_CFG_VEROTEL_SITEID_NAME', 'ID Site');
define( '_CFG_VEROTEL_SITEID_DESC', 'Identifiant de votre site pour ce site web.');
define( '_CFG_VEROTEL_RESELLERID_NAME', 'Identifiant revendeur ID');
define( '_CFG_VEROTEL_RESELLERID_DESC', 'Votre identifiant revendeur (s\'il existe).');
define( '_CFG_VEROTEL_SECRETCODE_NAME', 'Code Secret');
define( '_CFG_VEROTEL_SECRETCODE_DESC', 'Votre code secret Verotel.');
define( '_CFG_VEROTEL_USE_TICKETSCLUB_NAME', 'Tickets Club');
define( '_CFG_VEROTEL_USE_TICKETSCLUB_DESC', 'Utilisez vous des Tickets Club?');
define( '_CFG_VEROTEL_PLAN_PARAMS_VEROTEL_PRODUCT_NAME', 'Nom du produit');
define( '_CFG_VEROTEL_PLAN_PARAMS_VEROTEL_PRODUCT_DESC', 'Nom du produit identifiant le plan chez Verotel');
define( '_CFG_VEROTEL_INFO_NAME', 'Notification URL');
define( '_CFG_VEROTEL_INFO_DESC', 'You need to remember to set the \'Notification URL\' url in your Verotel control panel... for both approves and declines this should be...<br />http://[YOUR JOOMLA LOCATION]/index.php?option=com_acctexp&task=verotelnotification<br />Thats it!');

// Cybermut
define( '_CFG_CYBERMUT_LONGNAME', 'Cybermut');
define( '_CFG_CYBERMUT_STATEMENT', 'Cybermut - Le groupe Cr&eacute;dit Mutuel');
define( '_CFG_CYBERMUT_DESCRIPTION', 'Cybermut - Le groupe Cr&eacute;dit Mutuel');
define( '_CFG_CYBERMUT_TPE_NAME', 'TPE');
define( '_CFG_CYBERMUT_TPE_DESC', 'Pas de TPE &amp;racute; 7 chiffres, fourni par la banque');
define( '_CFG_CYBERMUT_VER_NAME', 'Version');
define( '_CFG_CYBERMUT_VER_DESC', 'The Protocol Version - leave at &quot;1.2open&quot; if you don\'t know what this is');
define( '_CFG_CYBERMUT_SOC_NAME', 'Code Soci&eacute;t&eacute;');
define( '_CFG_CYBERMUT_SOC_DESC', 'Code Soci&eacute;t&eacute;, fourni par la banque');
define( '_CFG_CYBERMUT_PASS_NAME', 'pass');
define( '_CFG_CYBERMUT_PASS_DESC', 'Valeur de la variable pass');
define( '_CFG_CYBERMUT_KEY_NAME', 'Cl&eacute;');
define( '_CFG_CYBERMUT_KEY_DESC', 'cl&eacute; info');
define( '_CFG_CYBERMUT_SERVER_NAME', 'Serveur bancaire');
define( '_CFG_CYBERMUT_SERVER_DESC', 'Choissisez votre banque');
define( '_CFG_CYBERMUT_LANGUAGE_NAME', 'Langue:');
define( '_CFG_CYBERMUT_LANGUAGE_DESC', 'Choisissez la langue que votre utilisateur verra lorsqu\'il fera son r&eacute;glement.');

// Authorize.net ARB
define( '_CFG_AUTHORIZE_ARB_LONGNAME', 'Authorize.net ARB');
define( '_CFG_AUTHORIZE_ARB_STATEMENT', 'Make recurring payments with Authorize.net');
define( '_CFG_AUTHORIZE_ARB_DESCRIPTION', 'Make recurring payments with Authorize.net');
define( '_CFG_AUTHORIZE_ARB_LOGIN_NAME', 'API Login ID');
define( '_CFG_AUTHORIZE_ARB_LOGIN_DESC', 'Your API Login ID on Authorize.net.');
define( '_CFG_AUTHORIZE_ARB_TRANSACTION_KEY_NAME', 'Transaction Key');
define( '_CFG_AUTHORIZE_ARB_TRANSACTION_KEY_DESC', 'Your Transaction Key on Authorize.net.');
define( '_CFG_AUTHORIZE_ARB_PROMPTADDRESS_NAME', 'Prompt for Address');
define( '_CFG_AUTHORIZE_ARB_PROMPTADDRESS_DESC', 'Ask the user to put in an Address with the Billing Name.');
define( '_CFG_AUTHORIZE_ARB_TOTALOCCURRENCES_NAME', 'Total Occurances');
define( '_CFG_AUTHORIZE_ARB_TOTALOCCURRENCES_DESC', 'Authorize.net requires that you set the total amount of occurances of a payment. Make sure the total lifespan of a subscription does not exceed three years');
define( '_CFG_AUTHORIZE_ARB_TRIALOCCURRENCES_NAME', 'Trial Occurances');
define( '_CFG_AUTHORIZE_ARB_TRIALOCCURRENCES_DESC', 'Specify the amount of trial periods that are granted to the user. This amount will be substracted from the total occurances.');
define( '_AEC_AUTHORIZE_ARB_PARAMS_BILLFIRSTNAME_NAME', 'Pr&eacute;nom');
define( '_AEC_AUTHORIZE_ARB_PARAMS_BILLLASTNAME_NAME', 'Nom de famille');
define( '_AEC_AUTHORIZE_ARB_PARAMS_BILLADDRESS_NAME', 'Adresse');
define( '_AEC_AUTHORIZE_ARB_PARAMS_BILLCITY_NAME', 'Ville');
define( '_AEC_AUTHORIZE_ARB_PARAMS_BILLSTATE_NAME', 'Etat');
define( '_AEC_AUTHORIZE_ARB_PARAMS_BILLZIP_NAME', 'Code Postal');
define( '_AEC_AUTHORIZE_ARB_PARAMS_BILLCOUNTRY_NAME', 'Pays');
define( '_CFG_AUTHORIZE_ARB_USESILENTPOSTRESPONSE_NAME', 'Use Silent Post Response');
define( '_CFG_AUTHORIZE_ARB_USESILENTPOSTRESPONSE_DESC', 'Please read explanation below');
define( '_CFG_AUTHORIZE_ARB_SILENTPOST_INFO_NAME', 'Silent Postback');
define( '_CFG_AUTHORIZE_ARB_SILENTPOST_INFO_DESC', 'When a recurring payment is set up with ARB, the AEC normally applies a multiplicated subscription period accordig to the Total Occurances. This way, the user will stay active throughout the subscription until it runs out or is cancelled. However, this also means that you would have to check for unpaid bills and manually deactivate the subscriptions if such a thing occurs. The other option is to use the Silent Postback which sends notifications for each subsequent payment that was successful. This in turn triggers the AEC to activate the user for another term. Please consult &lt;a href=&quot;http://www.authorize.net/support/Merchant/Integration_Settings/Receipt_Page_Options.htm&quot;&gt;this page&lt;/a&gt; to find out how to set up the Silent Post Url. Enter http://[YOUR JOOMLA LOCATION]/index.php?option=com_acctexp&amp;task=authorize_arbnotification as the Url.');
define( '_CFG_AUTHORIZE_ARB_IGNORE_EMPTY_INVOICES_NAME', 'Ignore Empty Invoices');
define( '_CFG_AUTHORIZE_ARB_IGNORE_EMPTY_INVOICES_DESC', 'In some situations, the midnight clearing of ARB Credit Card payments can produce notifications that carry no invoice information. This produces somewhat annoying Eventlog Warnings. With this switch, you can turn them off.');

// CCBill
define( '_CFG_CCBILL_LONGNAME', 'CCBill');
define( '_CFG_CCBILL_STATEMENT', 'Make payments with CCBill!');
define( '_CFG_CCBILL_DESCRIPTION', 'CCBill');
define( '_CFG_CCBILL_CLIENTACCNUM_NAME', 'Compte client');
define( '_CFG_CCBILL_CLIENTACCNUM_DESC', 'Your CCBill Client Account Number');
define( '_CFG_CCBILL_CLIENTSUBACC_NAME', 'Client SubAccount');
define( '_CFG_CCBILL_CLIENTSUBACC_DESC', 'Your CCBill Client Sub Account Number');
define( '_CFG_CCBILL_SECRETWORD_NAME', 'Secret Word');
define( '_CFG_CCBILL_SECRETWORD_DESC', 'Your secret word used to encrypt and protect transactions');
define( '_CFG_CCBILL_FORMNAME_NAME', 'Form ID');
define( '_CFG_CCBILL_FORMNAME_DESC', 'The CCBill layout you wish to use (look at the HTML form downloaded from CCBILL)');
define( '_CFG_CCBILL_INFO_NAME', 'Postback URL');
define( '_CFG_CCBILL_INFO_DESC', 'You need to remember to set the \'postback\' url in the CCBILL control panel... for both approves and declines this should be...&lt;br /&gt;http://[YOUR JOOMLA LOCATION]/index.php?option=com_acctexp&amp;task=ccbillnotification&lt;br /&gt;Thats it.');
define( '_CFG_CCBILL_PLAN_PARAMS_ALLOWEDTYPES_NAME', 'Allowed types');
define( '_CFG_CCBILL_PLAN_PARAMS_ALLOWEDTYPES_DESC', 'insert the payment options that the user is supposed to have after being led on to CCBill (refer to your CCBill account for the product IDs you have set up)');
define( '_CFG_CCBILL_DATALINK_USERNAME_NAME', 'Datalink Username');
define( '_CFG_CCBILL_DATALINK_USERNAME_DESC', 'If you want to use Recurring Billing, you need to supply a Datalink Username here. Also remember to set the &quot;recurring&quot; switch in the payment plans that are supposed to have this functionality.');

// iDeal Basic
define( '_CFG_IDEAL_BASIC_LONGNAME', 'iDeal');
define( '_CFG_IDEAL_BASIC_STATEMENT', 'Make payments with iDeal');
define( '_CFG_IDEAL_BASIC_DESCRIPTION', 'De veilige manier van betalen op internet.');
define( '_CFG_IDEAL_BASIC_MERCHANTID_NAME', 'Merchant ID');
define( '_CFG_IDEAL_BASIC_MERCHANTID_DESC', 'Your Merchant ID');
define( '_CFG_IDEAL_BASIC_TESTMODESTAGE_NAME', 'Testmode Stage');
define( '_CFG_IDEAL_BASIC_TESTMODESTAGE_DESC', 'Which of the tests (1-7) do you want to conduct?');
define( '_CFG_IDEAL_BASIC_SUBID_NAME', 'Testmode Stage');
define( '_CFG_IDEAL_BASIC_SUBID_DESC', 'Set to 0 unless you have specific reasons not to');
define( '_CFG_IDEAL_BASIC_KEY_NAME', 'Key');
define( '_CFG_IDEAL_BASIC_KEY_DESC', 'Your secret key');
define( '_CFG_IDEAL_BASIC_DESCRIPTION_NAME', 'Item Description');
define( '_CFG_IDEAL_BASIC_DESCRIPTION_DESC', 'The Item description that is shown on the invoice - max 32 characters!');

// iDeal Advanced
define( '_CFG_IDEAL_ADVANCED_LONGNAME', 'iDeal');
define( '_CFG_IDEAL_ADVANCED_STATEMENT', 'Make payments with iDeal');
define( '_CFG_IDEAL_ADVANCED_DESCRIPTION', 'De veilige manier van betalen op internet.');
define( '_CFG_IDEAL_ADVANCED_MERCHANTID_NAME', 'Merchant ID');
define( '_CFG_IDEAL_ADVANCED_MERCHANTID_DESC', 'Your Merchant ID');
define( '_CFG_IDEAL_ADVANCED_BANK_NAME', 'Bank');
define( '_CFG_IDEAL_ADVANCED_BANK_DESC', 'The Bank Name');
define( '_CFG_IDEAL_ADVANCED_TESTMODESTAGE_NAME', 'Testmode Stage');
define( '_CFG_IDEAL_ADVANCED_TESTMODESTAGE_DESC', 'Which of the tests (1-7) do you want to conduct?');
define( '_CFG_IDEAL_ADVANCED_SUBID_NAME', 'Testmode Stage');
define( '_CFG_IDEAL_ADVANCED_SUBID_DESC', 'Set to 0 unless you have specific reasons not to');
define( '_CFG_IDEAL_ADVANCED_KEY_NAME', 'Key');
define( '_CFG_IDEAL_ADVANCED_KEY_DESC', 'Your secret key');
define( '_CFG_IDEAL_ADVANCED_DESCRIPTION_NAME', 'Item Description');
define( '_CFG_IDEAL_ADVANCED_DESCRIPTION_DESC', 'The Item description that is shown on the invoice - max 32 characters!');

// Authorize.net AIM
define( '_CFG_AUTHORIZE_AIM_LONGNAME', 'Authorize.net AIM');
define( '_CFG_AUTHORIZE_AIM_STATEMENT', 'Make on-site CreditCard payments with Authorize.net');
define( '_CFG_AUTHORIZE_AIM_DESCRIPTION', 'Make on-site CreditCard payments with Authorize.net');
define( '_CFG_AUTHORIZE_AIM_DUMPMODE_NAME', 'Dumpmode');
define( '_CFG_AUTHORIZE_AIM_DUMPMODE_DESC', 'Do not post to live or testmode server, but only let Authorize.net display the data that was sent over.');
define( '_CFG_AUTHORIZE_AIM_LOGIN_NAME', 'API Login ID');
define( '_CFG_AUTHORIZE_AIM_LOGIN_DESC', 'Your API Login ID on Authorize.net.');
define( '_CFG_AUTHORIZE_AIM_TRANSACTION_KEY_NAME', 'Transaction Key');
define( '_CFG_AUTHORIZE_AIM_TRANSACTION_KEY_DESC', 'Your Transaction Key on Authorize.net.');
define( '_CFG_AUTHORIZE_AIM_PROMPTADDRESS_NAME', 'Prompt for Address');
define( '_CFG_AUTHORIZE_AIM_PROMPTADDRESS_DESC', 'Ask the user to put in an Address with the Billing Name.');
define( '_CFG_AUTHORIZE_AIM_PROMPTZIPONLY_NAME', 'Prompt for Zip only');
define( '_CFG_AUTHORIZE_AIM_PROMPTZIPONLY_DESC', 'Ask the user to put in a Zip code only.');
define( '_AEC_AUTHORIZE_AIM_PARAMS_BILLFIRSTNAME_NAME', 'First Name');
define( '_AEC_AUTHORIZE_AIM_PARAMS_BILLLASTNAME_NAME', 'Last Name');
define( '_AEC_AUTHORIZE_AIM_PARAMS_BILLADDRESS_NAME', 'Address');
define( '_AEC_AUTHORIZE_AIM_PARAMS_BILLCITY_NAME', 'City');
define( '_AEC_AUTHORIZE_AIM_PARAMS_BILLSTATE_NAME', 'State');
define( '_AEC_AUTHORIZE_AIM_PARAMS_BILLZIP_NAME', 'Zip');
define( '_AEC_AUTHORIZE_AIM_PARAMS_BILLCOUNTRY_NAME', 'Country');

// iPayment Silent
define( '_CFG_IPAYMENT_SILENT_LONGNAME', 'iPayment');
define( '_CFG_IPAYMENT_SILENT_STATEMENT', 'Make on-site CreditCard payments with iPayment');
define( '_CFG_IPAYMENT_SILENT_DESCRIPTION', 'Make on-site CreditCard payments with iPayment');
define( '_CFG_IPAYMENT_SILENT_FAKE_ACCOUNT_NAME', 'Fake Account');
define( '_CFG_IPAYMENT_SILENT_FAKE_ACCOUNT_DESC', 'Use a fake account (99999) for testing purposes.');
define( '_CFG_IPAYMENT_SILENT_USER_ID_NAME', 'User Id');
define( '_CFG_IPAYMENT_SILENT_USER_ID_DESC', 'The User Id of your iPayment Account.');
define( '_CFG_IPAYMENT_SILENT_ACCOUNT_ID_NAME', 'Account Id');
define( '_CFG_IPAYMENT_SILENT_ACCOUNT_ID_DESC', 'The Account Id of your iPayment Account.');
define( '_CFG_IPAYMENT_SILENT_PASSWORD_NAME', 'Password');
define( '_CFG_IPAYMENT_SILENT_PASSWORD_DESC', 'The Password of your iPayment Account.');
define( '_CFG_IPAYMENT_SILENT_PROMPTADDRESS_NAME', 'Prompt for Address');
define( '_CFG_IPAYMENT_SILENT_PROMPTADDRESS_DESC', 'Ask the user to put in an Address with the Billing Name.');
define( '_AEC_IPAYMENT_SILENT_PARAMS_BILLINFO_NAME', 'Billing Details');
define( '_AEC_IPAYMENT_SILENT_PARAMS_BILLINFO_DESC', '');
define( '_AEC_IPAYMENT_SILENT_PARAMS_BILLINFO_ELV_NAME', 'Wire Transfer');
define( '_AEC_IPAYMENT_SILENT_PARAMS_BILLINFO_ELV_DESC', 'Your Account details for wire transfer');
define( '_AEC_IPAYMENT_SILENT_PARAMS_BILLINFO_CC_NAME', 'Credit Card');
define( '_AEC_IPAYMENT_SILENT_PARAMS_BILLINFO_CC_DESC', 'Your Credit Card details');
define( '_AEC_IPAYMENT_SILENT_PARAMS_BILLFIRSTNAME_NAME', 'First Name');
define( '_AEC_IPAYMENT_SILENT_PARAMS_BILLLASTNAME_NAME', 'Last Name');
define( '_AEC_IPAYMENT_SILENT_PARAMS_BILLADDRESS_NAME', 'Address');
define( '_AEC_IPAYMENT_SILENT_PARAMS_BILLCITY_NAME', 'City');
define( '_AEC_IPAYMENT_SILENT_PARAMS_BILLSTATE_NAME', 'State');
define( '_AEC_IPAYMENT_SILENT_PARAMS_BILLZIP_NAME', 'Zip');
define( '_AEC_IPAYMENT_SILENT_PARAMS_BILLCOUNTRY_NAME', 'Country');
define( '_AEC_IPAYMENT_SILENT_PARAMS_BILLTELEPHONE_NAME', 'Telephone');

// Paysite Cash
define( '_CFG_PAYSITE_CASH_LONGNAME', 'Paysite Cash');
define( '_CFG_PAYSITE_CASH_STATEMENT', 'Make payments with Paysite Cash');
define( '_CFG_PAYSITE_CASH_DESCRIPTION', 'Make payments with Paysite Cash');
define( '_CFG_PAYSITE_CASH_SITEID_NAME', 'Site ID');
define( '_CFG_PAYSITE_CASH_SITEID_DESC', 'Site number in Editor interface Pbiz');
define( '_CFG_PAYSITE_CASH_SECRET_NAME', 'Secret Word');
define( '_CFG_PAYSITE_CASH_SECRET_DESC', 'Choose a secret word or string that will internally secure the data transmitted and received from fraud.');

// Paybox France
define( '_CFG_PAYBOXFR_LONGNAME', 'Paybox');
define( '_CFG_PAYBOXFR_STATEMENT', 'Paybox Services: solutions de paiement sur Internet; Terminal de paiement virtuel');
define( '_CFG_PAYBOXFR_DESCRIPTION', 'Paybox Services: solutions de paiement sur Internet; Terminal de paiement virtuel');
define( '_CFG_PAYBOXFR_SITE_NAME', 'Site number');
define( '_CFG_PAYBOXFR_SITE_DESC', 'Site number (TPE) given by the bank.');
define( '_CFG_PAYBOXFR_RANK_NAME', 'Rank number');
define( '_CFG_PAYBOXFR_RANK_DESC', 'Rank number (&quot;machine&quot;) given by the bank.');
define( '_CFG_PAYBOXFR_IDENTIFIANT_NAME', 'Paybox Identifiant');
define( '_CFG_PAYBOXFR_IDENTIFIANT_DESC', 'PAYBOX identifier, supplied by PAYBOX SERVICES at the time of registration.');
define( '_CFG_PAYBOXFR_PUBLICKEY_NAME', 'Public Key');
define( '_CFG_PAYBOXFR_PUBLICKEY_DESC', 'The public key to verify Paybox notifications (required!!).');
define( '_CFG_PAYBOXFR_PATH_NAME', 'Paybox Script Path');
define( '_CFG_PAYBOXFR_PATH_DESC', 'The path where your paybox script is located.');
define( '_CFG_PAYBOXFR_INFO_NAME', 'url http');
define( '_CFG_PAYBOXFR_INFO_DESC', 'You need to set the &quot;url http&quot; in your Paybox settings. This is required so that Paybox will notify the AEC about transactions. The URL you have to put in there is: &quot;http://yoursite.com/index.php&quot;');

// Airtoy
define( '_CFG_AIRTOY_LONGNAME', 'Airtoy');
define( '_CFG_AIRTOY_STATEMENT', 'Pay with Airtoy');
define( '_CFG_AIRTOY_DESCRIPTION', 'Pay with Airtoy');
define( '_CFG_AIRTOY_PHONE_NUMBER_NAME', 'Phone Number');
define( '_CFG_AIRTOY_PHONE_NUMBER_DESC', 'The phone number which the customer should send the SMS to.');
define( '_CFG_AIRTOY_RESPONSE_NAME', 'Response');
define( '_CFG_AIRTOY_RESPONSE_DESC', 'The response SMS the customer will receive (use ReWrite Engine as specified below)');
define( '_CFG_AIRTOY_SECRET_NAME', 'Secret Word');
define( '_CFG_AIRTOY_SECRET_DESC', 'Choose a secret word to make notifications a tad more secure against fraud.');
define( '_CFG_AIRTOY_PLAN_PARAMS_SMSCODE_PREFIX_NAME', 'SMS Code Prefix');
define( '_CFG_AIRTOY_PLAN_PARAMS_SMSCODE_PREFIX_DESC', 'The Prefix for the SMS code the user has to send to Airtoy. The Code will always come out as &quot;Prefix-XXX&quot;, where XXX is the invoice id');
define( '_AEC_AIRTOY_PARAMS_EXPLAIN_NAME', 'Send SMS');
define( '_AEC_AIRTOY_PARAMS_EXPLAIN_DESC', 'Send an SMS with the text \&quot;%s\&quot; (no quotation marks) to %s. You will then receive a code that you can enter below to clear the payment.');
define( '_AEC_AIRTOY_PARAMS_SMSCODE_NAME', 'SMS Code');
define( '_AEC_AIRTOY_PARAMS_SMSCODE_DESC', 'Enter the SMS Code you have received after sending the above message.');
define( '_AEC_AIRTOY_ERROR_NOCODE', 'You did not put in any code!');
define( '_AEC_AIRTOY_CODE_WRONG', 'The code you have put in was wrong.');

// PayPal WPP
define( '_CFG_PAYPAL_WPP_LONGNAME', 'PayPal WPP');
define( '_CFG_PAYPAL_WPP_STATEMENT', 'Make payments with PayPal - it\'s fast, free and secure!');
define( '_CFG_PAYPAL_WPP_DESCRIPTION', 'PayPal lets you send money to anyone with email. PayPal is free for consumers and works seamlessly with your existing credit card and checking account.');

define( '_CFG_PAYPAL_WPP_BROKENIPNMODE_NAME', 'Broken IPN Mode');
define( '_CFG_PAYPAL_WPP_BROKENIPNMODE_DESC', 'If the PayPal Servers fail to get back a proper response, you can manually override IPN authentication with this switch - JUST MAKE SURE TO PUT IT BACK ON AGAIN! These Problems usually go away within 24 hours.');
define( '_CFG_PAYPAL_WPP_ALLOW_EXPRESS_CHECKOUT_NAME', 'Express Checkout');
define( '_CFG_PAYPAL_WPP_ALLOW_EXPRESS_CHECKOUT_DESC', 'Offer Express Checkout option (PayPal requirement).');
define( '_CFG_PAYPAL_WPP_API_USER_NAME', 'API Username');
define( '_CFG_PAYPAL_WPP_API_USER_DESC', 'Your PayPal API Username');
define( '_CFG_PAYPAL_WPP_API_PASSWORD_NAME', 'API Password');
define( '_CFG_PAYPAL_WPP_API_PASSWORD_DESC', 'Your PayPal API Password');
define( '_CFG_PAYPAL_WPP_USE_CERTIFICATE_NAME', 'Use Certificate');
define( '_CFG_PAYPAL_WPP_USE_CERTIFICATE_DESC', 'Use Certificate Authentication instead of the standard signature');
define( '_CFG_PAYPAL_WPP_CERTIFICATE_PATH_NAME', 'Certificate Path');
define( '_CFG_PAYPAL_WPP_CERTIFICATE_PATH_DESC', 'The path to your PayPal Certificate');
define( '_CFG_PAYPAL_WPP_SIGNATURE_NAME', 'Signature');
define( '_CFG_PAYPAL_WPP_SIGNATURE_DESC', 'Your PayPal Signature');
define( '_CFG_PAYPAL_WPP_COUNTRY_NAME', 'Country');
define( '_CFG_PAYPAL_WPP_COUNTRY_DESC', 'Choose the country of your business');
define( '_CFG_PAYPAL_WPP_CANCEL_NOTE_NAME', 'Cancel Note');
define( '_CFG_PAYPAL_WPP_CANCEL_NOTE_DESC', 'The Cancel Note the user gets displayed when a subscription via PayPal WPP is cancelled');

define( '_CFG_PAYPAL_WPP_CHECKOUT_NOTE_HEADLINE', 'Check out faster with PayPal Express Checkout!');
define( '_CFG_PAYPAL_WPP_CHECKOUT_NOTE_NOTE', 'Click the button on the right to use PayPal Express Checkout instead of filling in your Credit Card details below. You will be redirected to the PayPal Website and sign in there. After you have confirmed your details with PayPal, you will be returned here and complete your Checkout.');
define( '_CFG_PAYPAL_WPP_CHECKOUT_NOTE_RETURN', 'Complete your Checkout by clicking the button on the right:');

// Moneybookers
define( '_CFG_MONEYBOOKERS_LONGNAME', 'Moneybookers');
define( '_CFG_MONEYBOOKERS_STATEMENT', 'Your wallet for the internet... to shop and send money worldwide');
define( '_CFG_MONEYBOOKERS_DESCRIPTION', 'Moneybookers enables any business or consumer with an email address to securely and cost-effectively send and receive payments online - in real-time!');

define( '_CFG_MONEYBOOKERS_PAY_TO_EMAIL_NAME', 'Merchant email');
define( '_CFG_MONEYBOOKERS_PAY_TO_EMAIL_DESC', 'Email address of the merchant\'s moneybookers.com account.');
define( '_CFG_MONEYBOOKERS_SECRET_WORD_NAME', 'Secret Word');
define( '_CFG_MONEYBOOKERS_SECRET_WORD_DESC', '&lt;p&gt;The uppercase MD5 value of the secret word submitted in the &quot;Merchant Tools&quot; section of the merchant\'s online Moneybookers account.&lt;/p&gt;&lt;strong&gt;Note: The secret word MUST be submitted in the &quot;Merchant Tools&quot; section in lowercase before the md5sig can be used. If you insert any uppercase symbols, they will automatically be converted to lower case. The only restriction on your secret word is the length which must not exceed 10 characters. Non-alphanumeric symbols can be used. If the &quot;Merchant Tools&quot; section is not shown in your account, please contact merchantservices@moneybookers.com&lt;/strong&gt;');
define( '_CFG_MONEYBOOKERS_RECIPIENT_DESCRIPTION_NAME', 'Company Name');
define( '_CFG_MONEYBOOKERS_RECIPIENT_DESCRIPTION_DESC', 'A description of the recipient, which will be shown on the merchant gateway. If no value is submitted, the pay_to_email value will be as the recipient of the payment.');
define( '_CFG_MONEYBOOKERS_LOGO_URL_NAME', 'Logo URL');
define( '_CFG_MONEYBOOKERS_LOGO_URL_DESC', 'The URL of the logo which you would like to appear at the top of the merchant gateway. The logo must be accessible via HTTPS otherwise it will not be shown.');
define( '_CFG_MONEYBOOKERS_HIDE_LOGIN_NAME', 'Hide Login');
define( '_CFG_MONEYBOOKERS_HIDE_LOGIN_DESC', 'Merchants can show their customers the gateway page without the prominent login');
define( '_CFG_MONEYBOOKERS_CONFIRMATION_NOTE_NAME', 'Confirmation Note');
define( '_CFG_MONEYBOOKERS_CONFIRMATION_NOTE_DESC', 'Merchant may show to the customer on the confirmation screen - the end step of the process - a note, confirmation number, PIN or any other message. Line breaks (&lt;br /&gt;) may be used for longer messages.');

// Nochex
define( '_CFG_NOCHEX_LONGNAME', 'Nochex');
define( '_CFG_NOCHEX_STATEMENT', 'Nochex Online Payment Services');
define( '_CFG_NOCHEX_DESCRIPTION', 'Leading independent UK based online payment company, specialising in providing smaller online businesses with simple, accessible, easy to use, online payment services.');

define( '_CFG_NOCHEX_MERCHANT_ID_NAME', 'Merchant ID');
define( '_CFG_NOCHEX_MERCHANT_ID_DESC', 'Your Merchant ID');

// Payer.se
define( '_CFG_PAYER_LONGNAME', 'Payer');
define( '_CFG_PAYER_STATEMENT', 'Make payments with Payer!');
define( '_CFG_PAYER_DESCRIPTION', 'Payer payment provider.');

define( '_CFG_PAYER_DEBUGMODE_NAME', 'Debugmode');
define( '_CFG_PAYER_DEBUGMODE_DESC', 'Specify the Debug mode. Choose &quot;silent&quot; for no debugging information.');
define( '_CFG_PAYER_AGENTID_NAME', 'Agent ID');
define( '_CFG_PAYER_AGENTID_DESC', 'Your Agent ID');
define( '_CFG_PAYER_KEY1_NAME', 'Key 1 (A)');
define( '_CFG_PAYER_KEY1_DESC', 'Your First Key (Key A)');
define( '_CFG_PAYER_KEY2_NAME', 'Key 2 (B)');
define( '_CFG_PAYER_KEY2_DESC', 'Your Second Key (Key B)');
define( '_CFG_PAYER_PAYMENT_METHOD_NAME', 'Payment Methods');
define( '_CFG_PAYER_PAYMENT_METHOD_DESC', 'Choose which payment methods you want to allow for the transaction');

// Authorize.net CIM
define( '_CFG_AUTHORIZE_CIM_LONGNAME', 'Authorize.net CIM');
define( '_CFG_AUTHORIZE_CIM_STATEMENT', 'Make payments with Authorize.net');
define( '_CFG_AUTHORIZE_CIM_DESCRIPTION', 'Make payments with Authorize.net');
define( '_CFG_AUTHORIZE_CIM_LOGIN_NAME', 'API Login ID');
define( '_CFG_AUTHORIZE_CIM_LOGIN_DESC', 'Your API Login ID on Authorize.net.');
define( '_CFG_AUTHORIZE_CIM_TRANSACTION_KEY_NAME', 'Transaction Key');
define( '_CFG_AUTHORIZE_CIM_TRANSACTION_KEY_DESC', 'Your Transaction Key on Authorize.net.');
define( '_CFG_AUTHORIZE_CIM_PROMPTADDRESS_NAME', 'Prompt for Address');
define( '_CFG_AUTHORIZE_CIM_PROMPTADDRESS_DESC', 'Ask the user to put in an Address with the Billing Name.');
define( '_CFG_AUTHORIZE_CIM_MINIMALADDRESS_NAME', 'Minimal Address');
define( '_CFG_AUTHORIZE_CIM_MINIMALADDRESS_DESC', 'Ask the user for minimal details only (no Zip or State).');
define( '_CFG_AUTHORIZE_CIM_EXTENDEDADDRESS_NAME', 'Extended Address');
define( '_CFG_AUTHORIZE_CIM_EXTENDEDADDRESS_DESC', 'Ask the user for extended details (Country, Company and Telephone).');
define( '_CFG_AUTHORIZE_CIM_DEDICATEDSHIPPING_NAME', 'Dedicated Shipping Details');
define( '_CFG_AUTHORIZE_CIM_DEDICATEDSHIPPING_DESC', 'Offer the user a dedicated shipping details form.');
define( '_CFG_AUTHORIZE_CIM_NOECHECKS_NAME', 'Disable eChecks');
define( '_CFG_AUTHORIZE_CIM_NOECHECKS_DESC', 'Authorize.net CIM allows you to process eChecks. Set this option to Yes, if you don\'t want to accept eChecks.');
define( '_CFG_AUTHORIZE_CIM_TOTALOCCURRENCES_NAME', 'Total Occurances');
define( '_CFG_AUTHORIZE_CIM_TOTALOCCURRENCES_DESC', 'If you want to, you can set a maximum number of rebills - the user will be automatically billed and renewed the number of times you set.');

// ClickBank
define( '_CFG_CLICKBANK_LONGNAME',			'ClickBank' );
define( '_CFG_CLICKBANK_STATEMENT',			'Make payments with ClickBank!' );
define( '_CFG_CLICKBANK_DESCRIPTION', 'Make payments with ClickBank');
define( '_CFG_CLICKBANK_PUBLISHER_NAME', 'PUBLISHER');
define( '_CFG_CLICKBANK_PUBLISHER_DESC', 'Your ClickBank PUBLISHER account number.');
define( '_CFG_CLICKBANK_SECRET_KEY_NAME', 'Secret key');
define( '_CFG_CLICKBANK_SECRET_KEY_DESC', 'Your secret key is an essential element to the process because it is used for both encryption and decryption and is only known by you and ClickBank');
define( '_CFG_CLICKBANK_INFO_NAME', 'IMPORTANT NOTE! Thank You Page');
define( '_CFG_CLICKBANK_INFO_DESC', 'On your ClickBank Account Homepage, >>Accounts Settings<< tab, locate and click the >>My Products<< link. Set up the field >>Thank You Page URL<< with the URL "http://www.yoursite.com/index.php?option=com_acctexp&task=clickbanknotification". Replace "www.yoursite.com" with your own domain.');
define( '_CFG_CLICKBANK_PLAN_PARAMS_ITEM_NUMBER_NAME', 'Your Clickbank Item Number');
define( '_CFG_CLICKBANK_PLAN_PARAMS_ITEM_NUMBER_DESC', 'Put your item number of product/service you sell here.');

// NetDebit
define( '_CFG_NETDEBIT_LONGNAME',			'NetDebit' );
define( '_CFG_NETDEBIT_STATEMENT',			'Make payments with NetDebit!' );
define( '_CFG_NETDEBIT_DESCRIPTION', 'Make payments with NetDebit');
define( '_CFG_NETDEBIT_CONTENT_ID_NAME', 'Content ID');
define( '_CFG_NETDEBIT_CONTENT_ID_DESC', 'Your NetDebit Content ID.');
define( '_CFG_NETDEBIT_SID_NAME', 'SID');
define( '_CFG_NETDEBIT_SID_DESC', 'Your NetDebit SID.');
define( '_CFG_NETDEBIT_PID_NAME', 'PID');
define( '_CFG_NETDEBIT_PID_DESC', 'Your NetDebit PID.');
define( '_CFG_NETDEBIT_SECRET_NAME', 'Secret');
define( '_CFG_NETDEBIT_SECRET_DESC', 'Your Secret word to make communication with NetDebit secure.');
define( '_CFG_NETDEBIT_JAVASCRIPT_CHECKOUT_NAME', 'Javascript Checkout');
define( '_CFG_NETDEBIT_JAVASCRIPT_CHECKOUT_DESC', 'User Javascript Checkout instead of a HTML Button. This somewhat obsfuscates the button but might not have all the features when switched on. Will be automatically overwritten if more features are needed.');
define( '_CFG_NETDEBIT_TYPE_NAME', 'preselect Payment Type');
define( '_CFG_NETDEBIT_TYPE_DESC', 'Choose the preferrably selected payment option');
define( '_CFG_NETDEBIT_TYPE_LISTITEM_ELV', 'Debit');
define( '_CFG_NETDEBIT_TYPE_LISTITEM_CC', 'Credit Card');
define( '_CFG_NETDEBIT_PLAN_PARAMS_POSITION_NAME', 'Position');
define( '_CFG_NETDEBIT_PLAN_PARAMS_POSITION_DESC', 'Tarifposition');

// payOS
define( '_CFG_PAYOS_LONGNAME',			'payOS' );
define( '_CFG_PAYOS_STATEMENT',			'Make payments with payOS!' );
define( '_CFG_PAYOS_DESCRIPTION', 'Make payments with payOS');
define( '_CFG_PAYOS_WEBMASTER_ID_NAME', 'Webmaster ID');
define( '_CFG_PAYOS_WEBMASTER_ID_DESC', 'Your payOS Webmaster ID.');
define( '_CFG_PAYOS_CONTENT_ID_NAME', 'Content ID');
define( '_CFG_PAYOS_CONTENT_ID_DESC', 'Your payOS Content ID.');
define( '_CFG_PAYOS_SECRET_NAME', 'Secret');
define( '_CFG_PAYOS_SECRET_DESC', 'Your Secret word to make communication with payOS secure.');
define( '_CFG_PAYOS_TYPE_NAME', 'preselect Payment Type');
define( '_CFG_PAYOS_TYPE_DESC', 'Choose the preferrably selected payment option');
define( '_CFG_PAYOS_TYPE_LISTITEM_ELV', 'Debit');
define( '_CFG_PAYOS_TYPE_LISTITEM_CC', 'Credit Card');

// iATS
define( '_CFG_IATS_LONGNAME',			'iATS Ticketmaster' );
define( '_CFG_IATS_STATEMENT',			'Make payments with Ticketmaster!' );
define( '_CFG_IATS_DESCRIPTION', 'Make payments with Ticketmaster');
define( '_CFG_IATS_AGENT_CODE_NAME', 'Agent Code');
define( '_CFG_IATS_AGENT_CODE_DESC', 'Your Ticketmaster Agent Code.');
define( '_CFG_IATS_PASSWORD_NAME', 'Password');
define( '_CFG_IATS_PASSWORD_DESC', 'Your Ticketmaster Password.');
define( '_CFG_IATS_EXP_AMOUNT_NAME', 'Term Length - Amount');
define( '_CFG_IATS_EXP_AMOUNT_DESC', 'Overall length of a billing cycle in which individual billing periods take place. Amount of Units.');
define( '_CFG_IATS_EXP_UNIT_NAME', 'Term Length - Units');
define( '_CFG_IATS_EXP_UNIT_DESC', 'Overall length of a billing cycle in which individual billing periods take place. Select Unit.');
define( '_CFG_IATS_SERVER_TYPE_NAME', 'Server Type');
define( '_CFG_IATS_SERVER_TYPE_DESC', 'Select which type of iATS Server you want to use - US or UK.');

// Chase Paymentech Orbital XML
define( '_CFG_CHASE_PAYMENTECH_LONGNAME',			'Chase Paymentech' );
define( '_CFG_CHASE_PAYMENTECH_STATEMENT',			'Make payments with Chase Paymentech!' );
define( '_CFG_CHASE_PAYMENTECH_DESCRIPTION', 'Make payments with Chase Paymentech');
define( '_CFG_CHASE_PAYMENTECH_MERCHANT_ID_NAME', 'Merchant ID');
define( '_CFG_CHASE_PAYMENTECH_MERCHANT_ID_DESC', 'Your Chase Paymentech Merchant ID.');
define( '_CFG_CHASE_PAYMENTECH_TERMINAL_ID_NAME', 'Terminal ID');
define( '_CFG_CHASE_PAYMENTECH_TERMINAL_ID_DESC', 'Your Terminal ID.');
define( '_CFG_CHASE_PAYMENTECH_PROMPTADDRESS_NAME', 'Prompt for Address');
define( '_CFG_CHASE_PAYMENTECH_PROMPTADDRESS_DESC', 'Ask the user to put in an Address with the Billing Name.');
define( '_CFG_CHASE_PAYMENTECH_PROMPTZIPONLY_NAME', 'Prompt for Zip only');
define( '_CFG_CHASE_PAYMENTECH_PROMPTZIPONLY_DESC', 'Ask the user to put in a Zip code only.');
// Locaweb - Pagamento Certo
define( '_CFG_LOCAWEB_PGCERTO_LONGNAME',							'Pagamento Certo Locaweb');
define( '_CFG_LOCAWEB_PGCERTO_STATEMENT',							'Pague de forma segura pelo Pagamento Certo Locaweb!');
define( '_CFG_LOCAWEB_PGCERTO_DESCRIPTION',							'Pague de forma segura pelo Pagamento Certo Locaweb!');
define( '_CFG_LOCAWEB_PGCERTO_CHAVEVENDEDOR_NAME',		'Chave de Vendedor');
define( '_CFG_LOCAWEB_PGCERTO_CHAVEVENDEDOR_DESC',		'Fornecida pela Locaweb depois do registro no PagamentoCerto');
define( '_CFG_LOCAWEB_PGCERTO_MODULE_NAME', 					'Forma de Pagamento');
define( '_CFG_LOCAWEB_PGCERTO_MODULO_DESC', 					'Cartão de Crédito VISA ou Boleto Bancário.');
define( '_CFG_LOCAWEB_PGCERTO_TIPOPESSOA_NAME', 				'Tipo de Comprador cadastrado na LocaWeb');
define( '_CFG_LOCAWEB_PGCERTO_TIPOPESSOA_DESC', 				'Tipo de Comprador.');
define( '_CFG_LOCAWEB_PGCERTO_CPF_NAME', 							'CPF');
define( '_CFG_LOCAWEB_PGCERTO_CPF_DESC', 							'Número do CPF.');
define( '_CFG_LOCAWEB_PGCERTO_CNPJ_NAME', 							'CNPJ (se Comprador Empresa na LocaWeb)');
define( '_CFG_LOCAWEB_PGCERTO_CNPJ_DESC', 							'Número do CNPJ.');
define( '_CFG_LOCAWEB_PGCERTO_RAZAOSOCIAL_NAME', 			'Razão Social (se Comprador Empresa na LocaWeb)');
define( '_CFG_LOCAWEB_PGCERTO_RAZAOSOCIAL_DESC', 			'Razão Social.');
define( '_CFG_LOCAWEB_PGCERTO_EMAIL_NAME', 						'Email de Comprador Locaweb se já possuir');
define( '_CFG_LOCAWEB_PGCERTO_EMAIL_DESC', 							'Email de cadastro na Locaweb se houver.');

// VCS
define( '_CFG_VCS_LONGNAME', 'Virtual Card Services');
define( '_CFG_VCS_STATEMENT', 'Betaal met krediet kaart!');
define( '_CFG_VCS_DESCRIPTION', 'Card processing systems for South African merchants.');
define( '_CFG_VCS_MERCHANT_ID_NAME', 'Merchant ID');
define( '_CFG_VCS_MERCHANT_ID_DESC', 'Your VCS Merchant ID');
define( '_CFG_VCS_PAM_NAME', 'PAM');
define( '_CFG_VCS_PAM_DESC', 'Personal Authentication Message, a security feature to confirm that the response is from VCS. The merchant enters the Merchant PAM in his merchant settings and VCS returns that PAM with the response.');

// Netcash
define( '_CFG_NETCASH_LONGNAME', 'Netcash.co.za');
define( '_CFG_NETCASH_STATEMENT', 'Debit orders | Online payment gateway South Africa | Ecommerce web provider');
define( '_CFG_NETCASH_DESCRIPTION', 'Access all the services via the internet from anywhere, at any time, using any device with a browser');
define( '_CFG_NETCASH_USER_NAME_NAME', 'Netcash Username');
define( '_CFG_NETCASH_USER_NAME_DESC', 'Your electronic username assigned to you by Netcash');
define( '_CFG_NETCASH_PIN_NAME', 'Netcash PIN');
define( '_CFG_NETCASH_PIN_DESC', 'Your electronic PIN assigned to you by Netcash');
define( '_CFG_NETCASH_TERMINAL_ID_NAME', 'Netcash Terminal Number');
define( '_CFG_NETCASH_TERMINAL_ID_DESC', 'Your electronic Termininal Number assigned to you by Netcash');
define( '_CFG_NETCASH_PASSWORD_NAME', 'Netcash Password');
define( '_CFG_NETCASH_PASSWORD_DESC', 'Your electronic password assigned to you by Netcash');
define( '_CFG_NETCASH_RECIPIENT_DESCRIPTION_NAME', 'Company Name');
define( '_CFG_NETCASH_RECIPIENT_DESCRIPTION_DESC', 'The Company Name appearing on invoices');
define( '_CFG_NETCASH_CONFIRMATION_NOTE_NAME', 'Confirmation Note');
define( '_CFG_AUTH_NETCASH_CONFIRMATION_NOTE_NAME', 'Success confirmation message');
define( '_CFG_AUTH_NETCASH_CONFIRMATION_NOTE_DESC', 'Message to show succesful payments');
define( '_CFG_AUTH_NETCASH_HIDE_LOGIN_NAME', 'Hide Login');
define( '_CFG_PROCESSOR_CONFIRMATION_NOTE_DESC', '??' );

// Paybox.at
define( '_CFG_PAYBOXAT_LONGNAME', 'Paybox.at');
define( '_CFG_PAYBOXAT_STATEMENT', 'paybox macht dein Handy zur Geldbörse!');
define( '_CFG_PAYBOXAT_DESCRIPTION', 'paybox macht dein Handy zur Geldbörse: das weltweit erste massenfähige System zur einfachen und sicheren Zahlungsabwicklung über das Mobiltelefon.');
define( '_CFG_PAYBOXAT_USERNAME_NAME', 'Paybox Username');
define( '_CFG_PAYBOXAT_USERNAME_DESC', 'Your electronic username assigned to you by Paybox');
define( '_CFG_PAYBOXAT_PASSWORD_NAME', 'Paybox Password');
define( '_CFG_PAYBOXAT_PASSWORD_DESC', 'Your Paybox password');
define( '_CFG_PAYBOXAT_MERCHANT_PHONE_NAME', 'Merchant Phone');
define( '_CFG_PAYBOXAT_MERCHANT_PHONE_DESC', 'The full phone number registered with Paybox.at');

// Epay
define( '_CFG_EPAY_LONGNAME', 'ePay - Dit Online Betalingssystem');
define( '_CFG_EPAY_STATEMENT', 'Secure Internet payments by use of ePay (www.epay.dk). ePay is PCI certified by VISA/MasterCard.');
define( '_CFG_EPAY_DESCRIPTION', 'ePay | Dit Online Betalingssystem is the most leading payment gateway in Denmark and the rest of Scandinavia, which provides payments over the internet for both small, medium and large companies.<br><br>ePay is a payment system with focus on security and stability and therefore ePay is developed by use of the most recent web technologies and security standards defined.<br><br>ePay is PCI certified by Visa/MasterCVard according to the PCI standard (Payment Card Industry Data Security Standard). The PCI standard is developed with focus on raise the security to online payments. As the leading payment gateway in Denmark and Scandinavia it is important to maintain as high security level as possible concerning the payments.');
define( '_CFG_EPAY_MERCHANTNUMBER_NAME', 'Merchant Number');
define( '_CFG_EPAY_MERCHANTNUMBER_DESC', 'Your Merchant Number');
define( '_CFG_EPAY_MD5TYPE_NAME', 'MD5 Type');
define( '_CFG_EPAY_MD5TYPE_DESC', 'MD5 Type');
define( '_CFG_EPAY_MD5KEY_NAME', 'MD5 Key');
define( '_CFG_EPAY_MD5KEY_DESC', 'MD5 Key');
define( '_CFG_EPAY_WINDOWSTATE_NAME', 'Window State');
define( '_CFG_EPAY_WINDOWSTATE_DESC', 'Window State');
define( '_CFG_EPAY_INSTANTCAPTURE_NAME', 'Instant Capture');
define( '_CFG_EPAY_INSTANTCAPTURE_DESC', 'Instant Capture');
define( '_CFG_EPAY_GROUP_NAME', 'Group');
define( '_CFG_EPAY_GROUP_DESC', 'Group');
define( '_CFG_EPAY_DESCRIPTION_NAME', 'Description');
define( '_CFG_EPAY_DESCRIPTION_DESC', 'Your Item Description');
define( '_CFG_EPAY_AUTHSMS_NAME', 'Auth SMS');
define( '_CFG_EPAY_AUTHSMS_DESC', 'Auth SMS');
define( '_CFG_EPAY_AUTHMAIL_NAME', 'Auth Mail');
define( '_CFG_EPAY_AUTHMAIL_DESC', 'Auth Mail');
define( '_CFG_EPAY_USE3D_NAME', 'Use 3D');
define( '_CFG_EPAY_USE3D_DESC', 'Use 3D?');
define( '_CFG_EPAY_ADDFEE_NAME', 'Add Fee');
define( '_CFG_EPAY_ADDFEE_DESC', 'Add Fee?');

// Suncorp MiGS
define( '_CFG_SUNCORP_MIGS_LONGNAME', 'Suncorp VPC MIGS');
define( '_CFG_SUNCORP_MIGS_STATEMENT', 'Suncorp VPC MIGS');
define( '_CFG_SUNCORP_MIGS_DESCRIPTION', 'Suncorp VPC MIGS');
define( '_CFG_SUNCORP_MIGS_VPC_VERSION_NAME', 'Protocol Version');
define( '_CFG_SUNCORP_MIGS_VPC_VERSION_DESC', 'Protocol version');
define( '_CFG_SUNCORP_MIGS_VPC_COMMAND_NAME', 'VPC Command');
define( '_CFG_SUNCORP_MIGS_VPC_COMMAND_DESC', 'VPC Command');
define( '_CFG_SUNCORP_MIGS_VPC_ACCESSCODE_NAME', 'Access Code');
define( '_CFG_SUNCORP_MIGS_VPC_ACCESSCODE_DESC', 'Your Access Code');
define( '_CFG_SUNCORP_MIGS_VPC_MERCHANT_NAME', 'Merchant Code');
define( '_CFG_SUNCORP_MIGS_VPC_MERCHANT_DESC', 'Your Merchant Code');
define( '_CFG_SUNCORP_MIGS_VPC_LOCALE_NAME', 'Locale');
define( '_CFG_SUNCORP_MIGS_VPC_LOCALE_DESC', 'Locale, or language setting');
define( '_CFG_SUNCORP_MIGS_VPC_SECURESECRET_NAME', 'Secure Secret');
define( '_CFG_SUNCORP_MIGS_VPC_SECURESECRET_DESC', 'Your secret word that is required to verify the authentication of the transaction notification.');
define( '_CFG_SUNCORP_MIGS_VPC_ORDERINFO_NAME', 'Order Info');
define( '_CFG_SUNCORP_MIGS_VPC_ORDERINFO_DESC', 'The order description as it will show up with the payment provider.');
define( '_CFG_SUNCORP_MIGS_VPC_TICKETNO_NAME', 'Ticket No');
define( '_CFG_SUNCORP_MIGS_VPC_TICKETNO_DESC', 'Ticket No');

// OneBip
define( '_CFG_ONEBIP_LONGNAME', 'OneBip');
define( '_CFG_ONEBIP_STATEMENT', 'OneBip Mobile Phone Payment');
define( '_CFG_ONEBIP_DESCRIPTION', 'OneBip Mobile Phone Payment');
define( '_CFG_ONEBIP_USERNAME_NAME', 'Username');
define( '_CFG_ONEBIP_USERNAME_DESC', 'Your Onebip.com username');
define( '_CFG_ONEBIP_SITE_ID_NAME', 'Site ID');
define( '_CFG_ONEBIP_SITE_ID_DESC', 'Your Onebip.com Site ID');
define( '_CFG_ONEBIP_SECRET_NAME', 'Secret');
define( '_CFG_ONEBIP_SECRET_DESC', 'Your Onebip.com Secret Word for creating a hash');

// PayPal Payflow
define( '_CFG_PAYPAL_PAYFLOW_LONGNAME', 'PayPal Payflow');
define( '_CFG_PAYPAL_PAYFLOW_STATEMENT', 'Make payments with PayPal - it\'s fast, free and secure!');
define( '_CFG_PAYPAL_PAYFLOW_DESCRIPTION', 'PayPal lets you send money to anyone with email. PayPal is free for consumers and works seamlessly with your existing credit card and checking account.');

define( '_CFG_PAYPAL_PAYFLOW_API_USER_NAME', 'API Username');
define( '_CFG_PAYPAL_PAYFLOW_API_USER_DESC', 'Your PayPal API Username');
define( '_CFG_PAYPAL_PAYFLOW_API_PASSWORD_NAME', 'API Password');
define( '_CFG_PAYPAL_PAYFLOW_API_PASSWORD_DESC', 'Your PayPal API Password');
define( '_CFG_PAYPAL_PAYFLOW_SIGNATURE_NAME', 'Signature');
define( '_CFG_PAYPAL_PAYFLOW_SIGNATURE_DESC', 'Your PayPal Signature');
define( '_CFG_PAYPAL_PAYFLOW_COUNTRY_NAME', 'Country');
define( '_CFG_PAYPAL_PAYFLOW_COUNTRY_DESC', 'Choose the country of your business');
define( '_CFG_PAYPAL_PAYFLOW_CANCEL_NOTE_NAME', 'Cancel Note');
define( '_CFG_PAYPAL_PAYFLOW_CANCEL_NOTE_DESC', 'The Cancel Note the user gets displayed when a subscription via PayPal PAYFLOW is cancelled');

// PayPal Payflow Link
define( '_CFG_PAYPAL_PAYFLOW_LINK_LONGNAME', 'PayPal Payflow Link');
define( '_CFG_PAYPAL_PAYFLOW_LINK_STATEMENT', 'Make payments with PayPal - it\'s fast, free and secure!');
define( '_CFG_PAYPAL_PAYFLOW_LINK_DESCRIPTION', 'PayPal lets you send money to anyone with email. PayPal is free for consumers and works seamlessly with your existing credit card and checking account.');
define( '_CFG_PAYPAL_PAYFLOW_LINK_LOGIN_NAME', 'Payflow Login');
define( '_CFG_PAYPAL_PAYFLOW_LINK_LOGIN_DESC', 'Your Payflow Login');
define( '_CFG_PAYPAL_PAYFLOW_LINK_PARTNER_NAME', 'Payflow Partner');
define( '_CFG_PAYPAL_PAYFLOW_LINK_PARTNER_DESC', 'The name of your Partner was provided to you by your Reseller.');

// Net Builder NetPay
define( '_CFG_NETPAY_LONGNAME', 'NetPay');
define( '_CFG_NETPAY_STATEMENT', 'Net Builder NetPay');
define( '_CFG_NETPAY_DESCRIPTION', 'Net Builder NetPay');
define( '_CFG_NETPAY_CUSTID_NAME', 'Customer ID');
define( '_CFG_NETPAY_CUSTID_DESC', 'Your NetPay Customer ID');
define( '_CFG_NETPAY_PASSWORD_NAME', 'Password');
define( '_CFG_NETPAY_PASSWORD_DESC', 'Your NetPay Password');

?>