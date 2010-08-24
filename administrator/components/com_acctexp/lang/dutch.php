<?php
/**
* @version $Id: dutch.php
* @package AEC - Account Control Expiration - Membership Manager
* @subpackage Language - Backend - Dutch
* @copyright 2006-2008 Copyright (C) David Deutsch
* @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org & Jarno en Mark Baselier from Q5 Grafisch Webdesign
* @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
*/

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );

define( '_AEC_LANGUAGE',						'nl' ); // NIET VERANDEREN!!
define( '_CFG_GENERAL_ACTIVATE_PAID_NAME',		'Activeer betaalde abonnementen' );
define( '_CFG_GENERAL_ACTIVATE_PAID_DESC',		'Deze optie zorgt ervoor dat abonnementen altijd betalend zijn, en niet werken met een activatiecode' );

// hacks/install >> ATTENTION: MUST BE HERE AT THIS POSITION, needed later!
define( '_AEC_SPEC_MENU_ENTRY',					'Mijn omschrijving' );

// common
define( '_DESCRIPTION_PAYSIGNET',				'mic: Omschrijving Paysignet - CHECK! -');
define( '_AEC_CONFIG_SAVED',					'Configuratie opgeslagen' );
define( '_AEC_CONFIG_CANCELLED',				'Configuratie cancelled' );
define( '_AEC_TIP_NO_GROUP_PF_PB',				'Public Frontend en public Backend zijn geen gebruikersgroepen!' );
define( '_AEC_CGF_LINK_ABO_FRONTEND',			'Link naar de FrontEnd' );
define( '_AEC_CGF_LINK_CART_FRONTEND',			'Direct Add To Cart link' );
define( '_AEC_NOT_SET',							'Net gespecificeerd' );
define( '_AEC_COUPON',							'Coupon' );
define( '_AEC_CMN_NEW',							'Nieuw' );
define( '_AEC_CMN_CLICK_TO_EDIT',				'Klik om te bewerken' );
define( '_AEC_CMN_LIFETIME',					'Onbeperkt' );
define( '_AEC_CMN_UNKOWN',						'Onbekend' );
define( '_AEC_CMN_EDIT_CANCELLED',				'Veranderingen opgeslagen' );
define( '_AEC_CMN_PUBLISHED',					'Gepubliceerd' );
define( '_AEC_CMN_NOT_PUBLISHED',				'Nieut gepubliceerd' );
define( '_AEC_CMN_CLICK_TO_CHANGE',				'Klik op het icoon om de status te veranderen' );
define( '_AEC_CMN_NONE_SELECTED',				'Geen geselecteerd' );
define( '_AEC_CMN_MADE_VISIBLE',				'maak zichtbaar' );
define( '_AEC_CMN_MADE_INVISIBLE',				'maak onzichtbaar' );
define( '_AEC_CMN_TOPUBLISH',					'publiceer' ); // naar ...
define( '_AEC_CMN_TOUNPUBLISH',					'on-publiceerd' ); // naar ...
define( '_AEC_CMN_FILE_SAVED',					'Bestand opgeslagen' );
define( '_AEC_CMN_ID',							'ID' );
define( '_AEC_CMN_DATE',						'Datum' );
define( '_AEC_CMN_EVENT',						'Gebeurtenis' );
define( '_AEC_CMN_TAGS',						'Tags' );
define( '_AEC_CMN_ACTION',						'Actie' );
define( '_AEC_CMN_PARAMETER',					'Parameter' );
define( '_AEC_CMN_NONE',						'Geen' );
define( '_AEC_CMN_WRITEABLE',					'Beschrijfbaar' );
define( '_AEC_CMN_UNWRITEABLE',					'Onbeschrijfbaar!' );
define( '_AEC_CMN_UNWRITE_AFTER_SAVE',			'Maak onschrijfbaar na opslaan' );
define( '_AEC_CMN_OVERRIDE_WRITE_PROT',			'Overschrijf schrijf beveiliging na het opslaan' );
define( '_AEC_CMN_NOT_SET',						'Niet gespecificeerd' );
define( '_AEC_CMN_SEARCH',						'Zoeken' );
define( '_AEC_CMN_APPLY',						'Toepassen' );
define( '_AEC_CMN_STATUS',						'Status' );
define( '_AEC_FEATURE_NOT_ACTIVE',				'Deze optie is niet actief' );
define( '_AEC_CMN_YES',							'Ja' );
define( '_AEC_CMN_NO',							'Nee' );
define( '_AEC_CMN_INHERIT',						'Inherit' );
define( '_AEC_CMN_LANG_CONSTANT_IS_MISSING',	'Taal <strong>%s</strong> is niet aanwezig' );
define( '_AEC_CMN_VISIBLE',						'Zichtbaar' );
define( '_AEC_CMN_INVISIBLE',					'Onzichtbaar' );
define( '_AEC_CMN_EXCLUDED',					'Uitgezonderd' );
define( '_AEC_CMN_PENDING',						'In de wachtrij' );
define( '_AEC_CMN_ACTIVE',						'Actief' );
define( '_AEC_CMN_TRIAL',						'Trial' );
define( '_AEC_CMN_CANCEL',						'Geannuleerd' );
define( '_AEC_CMN_HOLD',						'Hold' );
define( '_AEC_CMN_EXPIRED',						'Verlopen' );
define( '_AEC_CMN_CLOSED',						'Gespoten' );

// Gebruikers(informatie)
define( '_AEC_USER_USER_INFO',					'Gebruikers info' );
define( '_AEC_USER_USERID',						'GebruikersID' );
define( '_AEC_USER_STATUS',						'Status' );
define( '_AEC_USER_ACTIVE',						'Actief' );
define( '_AEC_USER_BLOCKED',					'Geblokkeerd' );
define( '_AEC_USER_ACTIVE_LINK',				'Activiatie link' );
define( '_AEC_USER_PROFILE',					'Profiel' );
define( '_AEC_USER_PROFILE_LINK',				'Bekijk Profiel' );
define( '_AEC_USER_USERNAME',					'Gebruikersnaam' );
define( '_AEC_USER_NAME',						'Naam' );
define( '_AEC_USER_EMAIL',						'E-Mail' );
define( '_AEC_USER_SEND_MAIL',					'zend e-mail' );
define( '_AEC_USER_TYPE',						'Gebruikers type' );
define( '_AEC_USER_REGISTERED',					'Geregistreerd' );
define( '_AEC_USER_LAST_VISIT',					'Laatste bezoek' );
define( '_AEC_USER_EXPIRATION',					'Loopt af op' );
define( '_AEC_USER_CURR_EXPIRE_DATE',			'Huidige afloop datum' );
define( '_AEC_USER_LIFETIME',					'Onbe' );
define( '_AEC_USER_RESET_EXP_DATE',				'Reset afloop datum' );
define( '_AEC_USER_RESET_STATUS',				'Reset Status' );
define( '_AEC_USER_SUBSCRIPTION',				'Abonnement' );
define( '_AEC_USER_PAYMENT_PROC',				'Betalings Processor' );
define( '_AEC_USER_CURR_SUBSCR_PLAN',			'Huidige abonneer plan' );
define( '_AEC_USER_PREV_SUBSCR_PLAN',			'Vorige abonneer plan' );
define( '_AEC_USER_USED_PLANS',					'Gebruikte abonneer plannen' );
define( '_AEC_USER_NO_PREV_PLANS',				'Nog geen registraties' );
define( '_AEC_USER_ASSIGN_TO_PLAN',				'Toepassen op plan' );
define( '_AEC_USER_TIME',						'Tijd' );
define( '_AEC_USER_TIMES',						'Tijden' );
define( '_AEC_USER_INVOICES',					'Facturen' );
define( '_AEC_USER_NO_INVOICES',				'Nog geen facturen' );
define( '_AEC_USER_INVOICE_FACTORY',			'Factuur Factory' );
define( '_AEC_USER_ALL_SUBSCRIPTIONS',			'All Subscriptions by this User' );
define( '_AEC_USER_ALL_SUBSCRIPTIONS_NOPE',	'This is the only subscription this user currently holds.' );
define( '_AEC_USER_SUBSCRIPTIONS_ID',			'ID' );
define( '_AEC_USER_SUBSCRIPTIONS_STATUS',		'Status' );
define( '_AEC_USER_SUBSCRIPTIONS_PROCESSOR',	'Processor' );
define( '_AEC_USER_SUBSCRIPTIONS_SINGUP',		'Signup' );
define( '_AEC_USER_SUBSCRIPTIONS_EXPIRATION',	'Expiration' );
define( '_AEC_USER_SUBSCRIPTIONS_PRIMARY',		'primary' );
define( '_AEC_USER_CURR_SUBSCR_PLAN_PRIMARY',	'Primary' );
define( '_AEC_USER_COUPONS',					'Coupons' );
define( '_HISTORY_COL_COUPON_CODE',				'Coupon Code' );
define( '_AEC_USER_NO_COUPONS',					'No coupon use recorded' );
define( '_AEC_USER_MICRO_INTEGRATION',			'Micro Integration Info' );
define( '_AEC_USER_MICRO_INTEGRATION_USER',		'Frontend' );
define( '_AEC_USER_MICRO_INTEGRATION_ADMIN',	'Backend' );
define( '_AEC_USER_MICRO_INTEGRATION_DB',		'Database Readout' );

// Nieuw (optioneel)
define( '_AEC_MSG_MIS_NOT_DEFINED',				'U heeft nog geen integraties toegevoegd - zie de config file' );

// headers
define( '_AEC_HEAD_SETTINGS',					'Instellingen' );
define( '_AEC_HEAD_HACKS',						'Hacks' );
define( '_AEC_HEAD_PLAN_INFO',					'Aanmeldingen / Leden' );
define( '_AEC_HEAD_LOG',						'Events Log' );
define( '_AEC_HEAD_CSS_EDITOR',					'CSS Editor' );
define( '_AEC_HEAD_MICRO_INTEGRATION',			'Micro Integration Info' );
define( '_AEC_HEAD_ACTIVE_SUBS',				'Actieve registrant(en)' );
define( '_AEC_HEAD_EXCLUDED_SUBS',				'Uitgezonderde registrant(en)' );
define( '_AEC_HEAD_EXPIRED_SUBS',				'Verlopen registrant(en)' );
define( '_AEC_HEAD_PENDING_SUBS',				'Registrant(en) in de wachtrij' );
define( '_AEC_HEAD_CANCELLED_SUBS',				'Geannuleerde registrant(en)' );
define( '_AEC_HEAD_HOLD_SUBS',					'Subscriber on Hold' );
define( '_AEC_HEAD_CLOSED_SUBS',				'Gesloten registrant(en)' );
define( '_AEC_HEAD_MANUAL_SUBS',				'Handmatige registrant(en)' );
define( '_AEC_HEAD_SUBCRIBER',					'Registrant(en)' );

// hacks
define( '_AEC_HACK_HACK',						'Hack' );
define( '_AEC_HACKS_ISHACKED',					'is gehacked' );
define( '_AEC_HACKS_NOTHACKED',					'is niet gehacked!' );
define( '_AEC_HACKS_UNDO',						'Undo hack now' );
define( '_AEC_HACKS_COMMIT',					'toepassen' );
define( '_AEC_HACKS_FILE',						'Bestand' );
define( '_AEC_HACKS_LOOKS_FOR',					'De hack zal zoeken naar' );
define( '_AEC_HACKS_REPLACE_WITH',				'... en het vervangen met dit' );

define( '_AEC_HACKS_NOTICE',					'BELANGRIJKE MELDING' );
define( '_AEC_HACKS_NOTICE_DESC',				'Voor veiligheidsreden moet u de hacks toepassen op de Joomla core files. Om dit te doen kunt u klikken op "hack bestand nu" links voor deze bestanden. U kunt ook een link toevoegen aan uw gebruikers menu zodat uw gebruikers de persoonlijke registratie info kunnen bekijken.' );
define( '_AEC_HACKS_NOTICE_DESC2',				'<strong>Alle belangrijke hacks voor de functionaliteit zijn gemarkeerd met een pijl en een uitroepteken.</strong>' );
define( '_AEC_HACKS_NOTICE_DESC3',				'Deze hacks hoeven niet toegepast te worden <strong>in nummerieke volgorde</strong> - dus maakt u zich geen zorgen om ze toe te passen als / of weergegven worden als #1, #3, #6.' );
define( '_AEC_HACKS_NOTICE_JACL',				'JACL MELDING' );
define( '_AEC_HACKS_NOTICE_JACL_DESC',			'Als u het JACLplus component wilt installeren zorg dan dat u zeker weet dat de hacks <strong>niet toegepast</strong> zijn tijdens installatie. JACL voert ook hacks uit op de core files. Het is belangrijk om deze eerst te doen, en om daarna de AEC hacks toe te passen.' );

define( '_AEC_HACKS_MENU_ENTRY',				'Menu Item' );
define( '_AEC_HACKS_MENU_ENTRY_DESC',			'Voegt een <strong>' . _AEC_SPEC_MENU_ENTRY . '</strong> menu item toe aan het user menu, Hier kan de gebruiker zijn of haar facturen managen.' );
define( '_AEC_HACKS_LEGACY',					'<strong>Dit is een lagacy hack, Undo deze s.v.p.</strong>' );
define( '_AEC_HACKS_LEGACY_MAMBOT',				'<strong>This is a Legacy Hack which is superceded by the Joomla 1.0 Mambot, please undo and use the "Hacks Mambot" instead!</strong>' );
define( '_AEC_HACKS_LEGACY_PLUGIN',				'<strong>This is a Legacy Hack which is superceded by the Joomla 1.5 Plugin, please undo and use the Plugin instead!</strong>' );
define( '_AEC_HACKS_LEGACY_PLUGIN_ERROR',		'<strong>This is a Legacy Hack which is superceded by the Joomla 1.5 Error Plugin, please undo and use the AEC Error Plugin instead!</strong>' );
define( '_AEC_HACKS_LEGACY_PLUGIN_USER',		'<strong>This is a Legacy Hack which is superceded by the Joomla 1.5 User Plugin, please undo and use the AEC User Plugin instead!</strong>' );
define( '_AEC_HACKS_LEGACY_PLUGIN_ACCESS',		'<strong>This is a Legacy Hack which is superceded by the Joomla 1.5 Access Plugin, please undo and use the AEC Access Plugin instead!</strong>' );
define( '_AEC_HACKS_NOTAUTH',					'Dit zal uw gebruikers linken naar de juiste NotAllowed page' );
define( '_AEC_HACKS_SUB_REQUIRED',				'Deze zorgt ervoor dat de gebruiker een abonnement moet hebben om in te loggen.<br /><strong>U moet niet vergeten om [ Require Subscription ] in te stellen in de AEC instellingen!</strong>' );
define( '_AEC_HACKS_REG2',						'Deze hack zan een geregistreerde gebruiker redirecten naar de betaalplannen pagina na het invullen van een nieuw registratieformulier. Deze hack niet toepassen om betaalplanselectie te regelen alleen tijdens het inloggen (als \'Require Subscription\' actief is). <strong>LET OP: Er zijn 2 hacks die toegepast moeten worden na het toepassen van deze hack. Als je van plan bent om de betaalplannen te laten zien voor de gebruikersgegevens moet u deze hack ook toepassen.</strong>' );
define( '_AEC_HACKS_REG3',						'Deze hack zal de gebruiker redirecten naar de betaalplannen wanneer er nog geen selectie gemaakt is.' );
define( '_AEC_HACKS_REG4',						'Deze hack zal de details uit de gebruikers details redirecten naar AEC.' );
define( '_AEC_HACKS_REG5',						'Deze hack zorgt ervoor dat de plannen eerst gezien worden - U moet dit ook instellen in de algemene instellingen van AEC!' );
define( '_AEC_HACKS_MI1',						'Sommige Micro Integraties werken alleen met een cleartext wachtwoord voor elke gebruiker. Deze hack zorgt ervoor dat Micor Integratie geraadpleegd wordt wanneer een gebruiker van account veranderd.' );
define( '_AEC_HACKS_MI2',						'Sommige Micro Integraties werken alleen met een cleartext wachtwoord voor elke gebruiker. Deze hack zorgt ervoor dat Micor Integratie geraadpleegd wordt wanneer a gebruiker een account registreerd.' );
define( '_AEC_HACKS_MI3',						'Sommige Micro Integraties werken alleen met een cleartext wachtwoord voor elke gebruiker. Deze hack zorgt ervoor dat Micor Integratie geraadpleegd wordt wanneer admin van gebruikers account wisseld.' );
define( '_AEC_HACKS_CB2',						'Dit zal een gebruiker tijdens de registratie van CB (Community Builder) doorvoeren naar de betaalplannen. Deze niet activeren als er plan selectie plaats moet vinden tijdens login (als \'Require Subscription\' actief is), of vrijwillig (zonder dat er registratie nodig is). <strong>LET OP. Er zijn nog 2 andere hacks nodig om deze optie te activeren. Als de betaalplannen zichtbaar moeten zijn na het inloggen moet deze hack ook toegepast worden.</strong>' );
define( '_AEC_HACKS_CB6',						'Deze hack redirect de gebruiker naar de betaalplannen als hij of zij nog geen selectie gemaakt heeft.' );
define( '_AEC_HACKS_CB_HTML2',					'Deze hack redirect AEC variabele van de het registratieformulier naar AEC. <strong>Om dit werkende te maken moet u eerst \'Plans First\' instellen in de AEC instellingen.</strong>' );
define( '_AEC_HACKS_UHP2',						'UHP2 Menu Item' );
define( '_AEC_HACKS_UHP2_DESC',					'Voeg een <strong>' . _AEC_SPEC_MENU_ENTRY . '</strong> menu item toe aan het UHP2 Gebruikersmenu. Met deze instelling kan een gebruiker zijn facturen managen / upgraden en vernieuwen.' );
define( '_AEC_HACKS_CBM',						'Als u de module: Comprofiler Moderator Module, gebruikt moet u deze hack toepassen om te voorkomen dat de module in een loop terrecht komt.' );

define( '_AEC_HACKS_JUSER_HTML1',				'This will redirect a registering user to the payment plans after filling out the registration form in JUser. Leave this alone to have plan selection only on login (if \'Require Subscription\' is active), or completely voluntary (without requiring a subscription). <strong>Please note that there are two hacks following this, once you have committed it! If you want to have the plans before the user details, these are required as well.</strong>' );
define( '_AEC_HACKS_JUSER_PHP1',				'This will redirect the user to the payment plans page when he or she has not made that selection yet.' );
define( '_AEC_HACKS_JUSER_PHP2',				'This is a bugfix which allows the AEC to load the JUser functions without forcing it to react to the POST data.' );

// log
	// settings
define( '_AEC_LOG_SH_SETT_SAVED',				'Instellingen veranderen' );
define( '_AEC_LOG_LO_SETT_SAVED',				'De AEC instellingen zijn opgeslagen. Veranderingen zijn:' );
	// heartbeat
define( '_AEC_LOG_SH_HEARTBEAT',				'Heartbeat' );
define( '_AEC_LOG_LO_HEARTBEAT',				'Heartbeat uitgevoerd:' );
define( '_AEC_LOG_AD_HEARTBEAT_DO_NOTHING',		'doet niets' );
	// install
define( '_AEC_LOG_SH_INST',						'AEC installatie' );
define( '_AEC_LOG_LO_INST',						'The AEC Versie %s is geinstalleerd' );

// installatie teksten
define( '_AEC_INST_NOTE_IMPORTANT',				'Belangrijke melding' );
define( '_AEC_INST_NOTE_SECURITY',				'For certain features, you may need to apply hacks to other components. For your convenience, we have included an autohacking feature that does just that with the click of a link' );
define( '_AEC_INST_APPLY_HACKS',				'In order to commit these hacks right now, go to the %s. (You can also access this page later on from the AEC central view or menu)' );
define( '_AEC_INST_APPLY_HACKS_LTEXT',			'hacks page' );
define( '_AEC_INST_NOTE_UPGRADE',				'<strong>If you are upgrading, make sure to check the hacks page anyways, since there are changes from time to time!!!</strong>' );
define( '_AEC_INST_NOTE_HELP',					'To help you along with frequently encountered problems, we have created a %s that will help you ship around the most common setup problems (access is also available from the AEC central).' );
define( '_AEC_INST_NOTE_HELP_LTEXT',			'help function' );
define( '_AEC_INST_HINTS',						'Hints' );
define( '_AEC_INST_HINT1',						'We encourage you to visit the <a href="%s" target="_blank">valanx.org forums</a> and to <strong>participate in the discussion there</strong>. Chances are, that other users have found the same bugs and it is equally likely that there is at least a fix to hack in or even a new version.' );
define( '_AEC_INST_HINT2',						'zorg altijd dat u uw instellingen goed nakijkt, en maak altijd een test betaalopdracht! Zij doen er uiteraard ons best voor om upgrades zo soepel mogelijk te laten verlopen, helaas is het technisch onmogelijk om dit altijd 100% vlekkenloos te laten verlopen.' );
define( '_AEC_INST_ATTENTION',					'Geen reden om de oude logins te gebruiken!' );
define( '_AEC_INST_ATTENTION1',					'Als u nog steeds oude AEC modules geinstalleerd heeft, verwijder deze dan.' );
define( '_AEC_INST_MAIN_COMP_ENTRY',			'AEC Abonnementen Manager' );
define( '_AEC_INST_ERRORS',						'<strong>Belangrijk</strong><br />AEC is niet volledig geinstalleerd. De volgende fouten zijn gegenereerd tijdens de installatie:<br />' );

define( '_AEC_INST_ROOT_GROUP_NAME',			'Root' );
define( '_AEC_INST_ROOT_GROUP_DESC',			'Root Group. This entry cannot be deleted, modification is limited.' );

// help
define( '_AEC_CMN_HELP',						'Help' );
define( '_AEC_HELP_DESC',						'Op deze pagina controleert AEC zijn eigen instellingen en geeft fouten weer wanneer dit het geval is, en deze opgelost moeten worden.' );
define( '_AEC_HELP_GREEN',						'Groen</strong> Items bevatten kleine problemen of meldingen, of problemen die al zijn opgelost.' );
define( '_AEC_HELP_YELLOW',						'Geel</strong> Items die niet correct zijn. Dit zijn items van cosmetische aard (layout) of slechte instellingen die gemaakt zijn door de administrator.' );
define( '_AEC_HELP_RED',						'Rood</strong> Items die zware fouten bevatten over hoe AEC werkt en veiligheidseisen.' );
define( '_AEC_HELP_GEN',						'LET OP: Uiteraard proberen we alle items weer te geven die niet correct zijn. Daar deze optie nog in ontwikkeling is kan het zijn dat we soms iets over het hoofd gezien hebben. Onze excusses daarvoor. (beta&trade;)' );
define( '_AEC_HELP_QS_HEADER',					'AEC snelstart handleiding' );
define( '_AEC_HELP_QS_DESC',					'Voordat u iets aan de meldingen doet die hier beneden worden weergegeven zorg dan altijd dat u onze %s gelezen heeft!' );
define( '_AEC_HELP_QS_DESC_LTEXT',				'Snelstart handleiding' );
define( '_AEC_HELP_SER_SW_DIAG1',				'Bestands toegangsrechten probleem' );
define( '_AEC_HELP_SER_SW_DIAG1_DESC',			'AEC heeft gedetecteerd dat u een Apache webserver gebruikt - Om de bestanden op een Apache server te hacken, moeten deze bestanden het 777 toegangsrecht hebben. Minimaal 1 van de essentiele bestanden heeft geen 777 toegangsrecht' );
define( '_AEC_HELP_SER_SW_DIAG1_DESC2',			'Wij raden u aan om tijdelijk de bestandsrechten te veranderen naar 777, en om daarna de hacks toe te passen. Daarna mag u de toegangsrechten weer terug veranderen. <strong>Bij problemen dient u altijd contact op de nemen met uw website administrator.</strong> Dit geldt ook voor de problemen in de toegangsrechten problemen die hieronder aangegeven worden.' );
define( '_AEC_HELP_SER_SW_DIAG2',				'joomla.php/mambo.php Bestands Toegangsrechten' );
define( '_AEC_HELP_SER_SW_DIAG2_DESC',			'AEC heeft gedetecteerd dat uw joomla.php bestand niet beheerd wordt door deze webserver.' );
define( '_AEC_HELP_SER_SW_DIAG2_DESC2',			'Neem via SSH toegang tot uw webserver, en ga naar het pad: \"<yoursiteroot>/includes\". Type daar het volgende commando in: \"chown wwwrun joomla.php\" (of \"chown wwwrun mambo.php\" als u Mambo gebruikt).' );
define( '_AEC_HELP_SER_SW_DIAG3',				'Overgenomen / Oude hacks ontdekt!' );
define( '_AEC_HELP_SER_SW_DIAG3_DESC',			'Het lijkt erop alsof u oude hacks gebruikt.' );
define( '_AEC_HELP_SER_SW_DIAG3_DESC2',			'Om AEC goed te laten functioneeren, gaat u naar de pagina Hacks en volg u de stappen die er weergegeven worden.' );
define( '_AEC_HELP_SER_SW_DIAG4',				'Bestands toegangsrechten problemen' );
define( '_AEC_HELP_SER_SW_DIAG4_DESC',			'AEC kan niet verrifieren welke bestandsrechten (toegangsrechten) de bestanden hebben die gehacked moeten worden. Uw PHP configuratie heeft waarschijnlijk de optie  \"--disable-posix\" aan staan. <strong>U kunt de hack proberen toe te passen - en als deze niet werkt is het waarschijnlijk een bestands toegangsrecht probleem</strong>.' );
define( '_AEC_HELP_SER_SW_DIAG4_DESC2',			'Wij raden u aan op uw PHP configuratie opnieuw te compilen met de SAID optie UIT. U kunt ook uw website administrator raadplegen om dit te doen.' );
define( '_AEC_HELP_DIAG_CMN1',					'joomla.php/mambo.php Hack' );
define( '_AEC_HELP_DIAG_CMN1_DESC',				'Om AEC goed te laten functioneren is deze hack verplicht. Deze hack redirect gebruikers naar AEC Verrificatie routines tijdens login.' );
define( '_AEC_HELP_DIAG_CMN1_DESC2',			'Ga naar de hacks pagina en pas de hack toe' );
define( '_AEC_HELP_DIAG_CMN2',					'"Mijn Abonnementen menu iten' );
define( '_AEC_HELP_DIAG_CMN2_DESC',				'Een link naar de "Mijn Abonnementen" pagina maakt het voor uw gebruikers makkelijk om een abonnement na te kijken.' );
define( '_AEC_HELP_DIAG_CMN2_DESC2',			'Ga naar de hacks pagina en maak de link.' );
define( '_AEC_HELP_DIAG_CMN3',					'JACL is niet geinstalleerd' );
define( '_AEC_HELP_DIAG_CMN3_DESC',				'Als u van plan bent om JACLplus te installeren op uw Joomla!/Mambo system, zorg dan dat de AEC hacks niet zijn toegepast tijdens deze installatie. Als u ze al heeft toegepast kunt u ze ongedaan maken op de hacks pagina.' );
define( '_AEC_HELP_DIAG_NO_PAY_PLAN',			'Geen actief betalingsplan!' );
define( '_AEC_HELP_DIAG_NO_PAY_PLAN_DESC',		'Er is nog geen betaalplan gepubliceerd - AEC heeft minimaal 1 plan nodig om te functioneren' );
define( '_AEC_HELP_DIAG_GLOBAL_PLAN',			'Algemeen Instap Plan' );
define( '_AEC_HELP_DIAG_GLOBAL_PLAN_DESC',		'Er is geen Algemeen Instap Plan in uw configuratie. Dit is een plan waar iedere gebruiker (na registratie) standaard lid van wordt. Als u dit niet wenst, laat het dan uit staan - ' );
define( '_AEC_HELP_DIAG_SERVER_NOT_REACHABLE',	'Server is niet bereikbaar' );
define( '_AEC_HELP_DIAG_SERVER_NOT_REACHABLE_DESC',	'Het lijkt erop dat u AEC heeft geinstalleerd op een locale machine. Om notificatie(s) te ontvangen (en dus om het component succesvol te laten werken), moet u het installeren op een webserver met een eigen domeinnaam of IP adres!' );
define( '_AEC_HELP_DIAG_SITE_OFFLINE',			'Website is Offline' );
define( '_AEC_HELP_DIAG_SITE_OFFLINE_DESC',		'U heeft ervoor gekozen om uw site op offline te zetten - dit heeft effect op de stroom van notificaties en dus op uw betalingsprocessen.' );
define( '_AEC_HELP_DIAG_REG_DISABLED',			'Gebruikersregistratie staat uit' );
define( '_AEC_HELP_DIAG_REG_DISABLED_DESC',		'Uw gebruikersregistratie staat uit. Om deze reden kan geen enkele (nieuwe) gebruiker zich registreren op uw website.' );
define( '_AEC_HELP_DIAG_LOGIN_DISABLED',		'Gebruikers login staat uit' );
define( '_AEC_HELP_DIAG_LOGIN_DISABLED_DESC',	'U heeft uw frontend gebruikers login functionaliteit uitgezet. Hierdoor kan geen enkele gebruiker inloggen op uw website.' );
define( '_AEC_HELP_DIAG_PAYPAL_BUSS_ID',		'Paypal Check Business ID' );
define( '_AEC_HELP_DIAG_PAYPAL_BUSS_ID_DESC',	'Deze route checkt op een correct geconfigureerd PayPal ID.' );
define( '_AEC_HELP_DIAG_PAYPAL_BUSS_ID_DESC1',	'Zet deze instelling uit als u problemen ondervindt zoals het correct ontvangen van betalingen, maar zonder dat gebruikers enabled worden. Zet deze instelling altijd uit als uw Paypal account geconfigureerd is met meerdere e-mail adressen.' );

// micro integraties
	// general
define( '_AEC_MI_REWRITING_INFO',				'Herschrijf Info' );
define( '_AEC_MI_SET1_INAME',					'Abonnement op %s - Gebruiker: %s (%s)' );
	// htaccess
define( '_AEC_MI_HTACCESS_INFO_DESC',			'Beveilig de folder met een .htaccess en zorg ervoor dat alleen gebruikers met dit abonnement er toegang hebben hierto met hun Joomla Account.' );
	// email
define( '_AEC_MI_EMAIL_INFO_DESC',				'Zend een of meerder emails naar gebruikers bij ingebruikname of na het verlopen van het account.' );
	// idev
define( '_AEC_MI_IDEV_DESC',					'Verbind met uw verkopen op iDevAffiliate' );
	// mosetstree
define( '_AEC_MI_MOSETSTREE_DESC',				'Beperk het aantal vermeldingen dat een gebruiker kan weergeven.' );
	// mysql-query
define( '_AEC_MI_MYSQL_DESC',					'Maak een MySQL Query die uitgevoerd moet worden met deze aanmelding, of tijdens het verlopen van deze aanmelding.' );
	// remository
define( '_AEC_MI_REMOSITORY_DESC',				'Kies het aantal bestanden dat een gebruiker kan downloaden. Hiervoor moet de reMOSitory groep moet toegepast worden op het account' );
	// VirtueMart
define( '_AEC_MI_VIRTUEMART_DESC',				'Kies de VirtueMart gebruikersgroep waar deze gebruiker aan gekoppeld wordt.' );

// centrale
define( '_AEC_CENTR_CENTRAL',					'AEC Centrale' );
define( '_AEC_CENTR_EXCLUDED',					'Uitgezonderd' );
define( '_AEC_CENTR_PLANS',						'Betaalplannen' );
define( '_AEC_CENTR_PENDING',					'In de wachtrij' );
define( '_AEC_CENTR_ACTIVE',					'Actief' );
define( '_AEC_CENTR_EXPIRED',					'Verlopen' );
define( '_AEC_CENTR_CANCELLED',					'Geannuleerd' );
define( '_AEC_CENTR_HOLD',						'On Hold' );
define( '_AEC_CENTR_CLOSED',					'Gesloten' );
define( '_AEC_CENTR_PROCESSORS',				'Processors' );
define( '_AEC_CENTR_SETTINGS',					'Instellingen' );
define( '_AEC_CENTR_EDIT_CSS',					'Bewerk CSS' );
define( '_AEC_CENTR_V_INVOICES',				'Bekijk facturen' );
define( '_AEC_CENTR_COUPONS',					'Coupons' );
define( '_AEC_CENTR_COUPONS_STATIC',			'Statische Coupons' );
define( '_AEC_CENTR_VIEW_HISTORY',				'Bekijk geschiedenis' );
define( '_AEC_CENTR_HACKS',						'Hacks' );
define( '_AEC_CENTR_M_INTEGRATION',				'Micro Integr.' );
define( '_AEC_CENTR_HELP',						'Help' );
define( '_AEC_CENTR_LOG',						'EventLog' );
define( '_AEC_CENTR_MANUAL',					'Handleiding' );
define( '_AEC_CENTR_EXPORT',						'Export' );
define( '_AEC_CENTR_IMPORT',						'Import' );
define( '_AEC_CENTR_GROUPS',					'Groups' );
define( '_AEC_CENTR_AREA_MEMBERSHIPS',			'Memberships' );
define( '_AEC_CENTR_AREA_PAYMENT',				'Payment Plans &amp; related functionality' );
define( '_AEC_CENTR_AREA_SETTINGS',				'Settings, Logs &amp; special functionality' );
define( '_AEC_QUICKSEARCH',						'Snel zoeken' );
define( '_AEC_QUICKSEARCH_DESC',				'Vul in een naam, gebruikersnaam, gebruikersid of een factuurnummer om een directe link te krijgen naar het gebruikers profiel. Als er meer dan een resultaat gevonden wordt, dan worden deze hieronder weergegeven.' );
define( '_AEC_QUICKSEARCH_MULTIRES',			'Meerdere resultaten!' );
define( '_AEC_QUICKSEARCH_MULTIRES_DESC',		'Klik s.v.p. op een van onderstaande gebruikers:' );
define( '_AEC_QUICKSEARCH_THANKS',				'Dank u voor het gelukkig maken van een simpele functie.' );
define( '_AEC_QUICKSEARCH_NOTFOUND',			'Gebruiker niet gevonden' );

define( '_AEC_NOTICES_FOUND',					'Eventlog Notices' );
define( '_AEC_NOTICES_FOUND_DESC',				'The following entries in the Eventlog deserve your attention. You can mark them read if you want them to disappear. You can also change the types of notices that show up here in the Settings.' );
define( '_AEC_NOTICE_MARK_READ',				'mark read' );
define( '_AEC_NOTICE_MARK_ALL_READ',			'Mark all Notices read' );
define( '_AEC_NOTICE_NUMBER_1',					'Event' );
define( '_AEC_NOTICE_NUMBER_2',					'Event' );
define( '_AEC_NOTICE_NUMBER_8',					'Notice' );
define( '_AEC_NOTICE_NUMBER_32',				'Warning' );
define( '_AEC_NOTICE_NUMBER_128',				'Error' );
define( '_AEC_NOTICE_NUMBER_512',				'None' );

// selecteer lijsten
define( '_AEC_SEL_EXCLUDED',					'Uitgezonderd' );
define( '_AEC_SEL_PENDING',						'In de wachtrij' );
define( '_AEC_SEL_TRIAL',						'Trial' );
define( '_AEC_SEL_ACTIVE',						'Actief' );
define( '_AEC_SEL_EXPIRED',						'Verlopen' );
define( '_AEC_SEL_CLOSED',						'Gesloten' );
define( '_AEC_SEL_CANCELLED',					'Geannuleerd' );
define( '_AEC_SEL_HOLD',						'Hold' );
define( '_AEC_SEL_NOT_CONFIGURED',				'Niet geconfigureerd' );

// footer
define( '_AEC_FOOT_TX_CHOOSING',				'Dank u voor het kiezen van het AEC component!' );
define( '_AEC_FOOT_TX_GPL',						'This Joomla component was developed and released under the <a href="http://www.gnu.org/copyleft/gpl.html" target="_blank">GNU/GPL</a> license by David Deutsch & Team AEC from <a href="http://www.valanx.org" target="_blank">valanx.org</a>' );
define( '_AEC_FOOT_TX_SUBSCRIBE',				'Als u meer opties / professioneel advies / updates / handleidingen en online hulp wilt voor dit component kunt u zich aanmelden voor deze services op onze website!' );
define( '_AEC_FOOT_CREDIT',						'Lees s.v.p. onze %s' );
define( '_AEC_FOOT_CREDIT_LTEXT',				'Volledige credits' );
define( '_AEC_FOOT_VERSION_CHECK',				'Controleer op de laatste versie' );
define( '_AEC_FOOT_MEMBERSHIP',					'Neem een abonnement met documentatie en hulp' );

// foutmeldingen
define( '_AEC_ALERT_SELECT_FIRST',				'Selecteer een item om te confugureren' );
define( '_AEC_ALERT_SELECT_FIRST_TO',			'Selecteer eerst een item om' );

// berichten
define( '_AEC_MSG_NODELETE_SUPERADMIN',			'U kunt een Super Administrator niet verwijderen' );
define( '_AEC_MSG_NODELETE_YOURSELF',			'U kunt u zelf niet verwijderen!' );
define( '_AEC_MSG_NODELETE_EXCEPT_SUPERADMIN',	'Alleen super administrators kunnen deze actie uitvoeren!' );
define( '_AEC_MSG_SUBS_RENEWED',				'abonnement(en) / aanmelding(en) vernieuwd' );
define( '_AEC_MSG_SUBS_ACTIVATED',				'abonnement(en) / aanmelding(en) geactiveerd' );
define( '_AEC_MSG_NO_ITEMS_TO_DELETE',			'Geen item gevonden om te verwijderen' );
define( '_AEC_MSG_NO_DEL_W_ACTIVE_SUBSCRIBER',	'U kunt geen plannen verwijderen waar nog gebruikers lid van zijn.' );
define( '_AEC_MSG_ITEMS_DELETED',				'Item(s) verwijderd' );
define( '_AEC_MSG_ITEMS_SUCESSFULLY',			'%s Item(s) succesvol' );
define( '_AEC_MSG_SUCESSFULLY_SAVED',			'Veranderingen opgeslagen' );
define( '_AEC_MSG_ITEMS_SUCC_PUBLISHED',		'Items opgeslagen' );
define( '_AEC_MSG_ITEMS_SUCC_UNPUBLISHED',		'Item(s) on-gepubliceerd' );
define( '_AEC_MSG_NO_COUPON_CODE',				'U moet een coupon code specificeren!' );
define( '_AEC_MSG_OP_FAILED',					'Actie mislukt: Kon niet openen %s' );
define( '_AEC_MSG_OP_FAILED_EMPTY',				'Actie mislukt: Content is leeg' );
define( '_AEC_MSG_OP_FAILED_NOT_WRITEABLE',		'Actie mislukt: Het bestand is niet schrijfbaar.' );
define( '_AEC_MSG_OP_FAILED_NO_WRITE',			'Actie mislukt: Kon bestand niet openen om te beschrijven' );
define( '_AEC_MSG_INVOICE_CLEARED',				'Factuur voldaan' );

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

// --== BACKEND TOOLBAR ==--
define( '_EXPIRE_SET','Zet vervaldatum:');
define( '_EXPIRE_NOW','Verloopt');
define( '_EXPIRE_EXCLUDE','Uitzonderen');
define( '_EXPIRE_INCLUDE','Toevoegen');
define( '_EXPIRE_CLOSE','Sluiten');
define( '_EXPIRE_HOLD','Hold');
define( '_EXPIRE_01MONTH','zet 1 maand');
define( '_EXPIRE_03MONTH','zet 3 maanden');
define( '_EXPIRE_12MONTH','zet 12 maanden');
define( '_EXPIRE_ADD01MONTH','voeg 1 maand toe');
define( '_EXPIRE_ADD03MONTH','voeg 3 maand toe');
define( '_EXPIRE_ADD12MONTH','voeg 12 maand toe');
define( '_CONFIGURE','Configureer');
define( '_REMOVE','Uitzonderen');
define( '_CNAME','Naam');
define( '_USERLOGIN','Login');
define( '_EXPIRATION','Verloop');
define( '_USERS','Gebruikers');
define( '_DISPLAY','Weergeven');
define( '_NOTSET','Uitgezonderd');
define( '_SAVE','Opslaan');
define( '_CANCEL','Cancel');
define( '_EXP_ASC','Verlopen oplopend');
define( '_EXP_DESC','Verlopen aflopend');
define( '_NAME_ASC','Naam oplopend');
define( '_NAME_DESC','Naam aflopend');
define( '_LASTNAME_ASC','Last Name Asc');
define( '_LASTNAME_DESC','Last Name Desc');
define( '_LOGIN_ASC','Login oplopend');
define( '_LOGIN_DESC','Login aflopend');
define( '_SIGNUP_ASC','Aanmelddatum oplopend');
define( '_SIGNUP_DESC','Aanmelddatum aflopend');
define( '_LASTPAY_ASC','Laatste betaling oplopend');
define( '_LASTPAY_DESC','Laatste betaling aflopend');
define( '_PLAN_ASC','Plannen oplopend');
define( '_PLAN_DESC','Plannen aflopend');
define( '_STATUS_ASC','Status oplopend');
define( '_STATUS_DESC','Status aflopend');
define( '_TYPE_ASC','Betaal Type oplopend');
define( '_TYPE_DESC','Betaal Type aflopend');
define( '_ORDERING_ASC','Ordering Asc');
define( '_ORDERING_DESC','Ordering Desc');
define( '_ID_ASC','ID Asc');
define( '_ID_DESC','ID Desc');
define( '_CLASSNAME_ASC','Function Name Asc');
define( '_CLASSNAME_DESC','Function Desc');
define( '_ORDER_BY','Sorteren op:');
define( '_SAVED', 'Opgeslagen.');
define( '_CANCELED', 'Geannuleerd.');
define( '_CONFIGURED', 'Item geconfigureerd.');
define( '_REMOVED', 'Item uit de lijst verwijderd.');
define( '_EOT_TITLE', 'Gesloten aanmeldingen');
define( '_EOT_DESC', 'Deze lijst bevat geen handmatig ingevoerde aanmeldingen. Als u een item verwijderd dan wordt de gebruiker uit de database verwijderd evenals alle history van die gebruiker.');
define( '_EOT_DATE', 'Einddatum van de voorwaarde');
define( '_EOT_CAUSE', 'Omdat');
define( '_EOT_CAUSE_FAIL', 'Betalingsfout');
define( '_EOT_CAUSE_BUYER', 'Geannuleerd door de gebruiker');
define( '_EOT_CAUSE_FORCED', 'Geannuleerd door de administrator');
define( '_REMOVE_CLOSED', 'Verwijderen');
define( '_FORCE_CLOSE', 'Nu sluiten');
define( '_PUBLISH_PAYPLAN', 'Publiseren');
define( '_UNPUBLISH_PAYPLAN', 'On-publiceren');
define( '_NEW_PAYPLAN', 'Nieuw');
define( '_COPY_PAYPLAN', 'Copy');
define( '_APPLY_PAYPLAN', 'Apply');
define( '_EDIT_PAYPLAN', 'Bewerken');
define( '_REMOVE_PAYPLAN', 'Verwijderen');
define( '_SAVE_PAYPLAN', 'Opslaan');
define( '_CANCEL_PAYPLAN', 'Annuleren');
define( '_PAYPLANS_TITLE', 'Betalingsplannen manager');
define( '_PAYPLANS_MAINDESC', 'Gepubliceerde plannen zijn plan opties in de gebruikers front-end. Deze plannen zijn alleen geldig op gateway betalingen (dus niet handmatige aanmeldingen).');
define( '_PAYPLAN_GROUP', 'Group');
define( '_PAYPLAN_NOGROUP', 'No Group');
define( '_PAYPLAN_NAME', 'Naam');
define( '_PAYPLAN_DESC', 'Omschrijving (eerste 50 caracters)');
define( '_PAYPLAN_ACTIVE', 'Gepubliceerd');
define( '_PAYPLAN_VISIBLE', 'Zichtbaar');
define( '_PAYPLAN_A3', 'Score');
define( '_PAYPLAN_P3', 'Periode');
define( '_PAYPLAN_T3', 'Periode Groep');
define( '_PAYPLAN_USERCOUNT', 'Registranten');
define( '_PAYPLAN_EXPIREDCOUNT', 'Verlopen');
define( '_PAYPLAN_TOTALCOUNT', 'Totaal');
define( '_PAYPLAN_REORDER', 'Herordenen');
define( '_PAYPLAN_DETAIL', 'Instellingen');
define( '_ALTERNATIVE_PAYMENT', 'Bank Transfer');
define( '_SUBSCR_DATE', 'Ondertekenen op datum');
define( '_ACTIVE_TITLE', 'Actieve Aanmeldingen');
define( '_ACTIVE_DESC', 'Deze lijst bevat geen handmatig ingevoerde aanmeldingen.');
define( '_LASTPAY_DATE', 'Laatste betaal datum');
define( '_USERPLAN', 'Plan');
define( '_CANCELLED_TITLE', 'Geannuleerde aanmeldingen');
define( '_CANCELLED_DESC', 'Deze lijst bevat geen handmatig ingevoerde aanmeldingen. Dit zijn de abonnementen die geannuleerd zijn door de gebruiker.');
define( '_CANCEL_DATE', 'Annuleer datum');
define( '_MANUAL_DESC', 'Als u dit item verwijderd dan wordt ook de gebruiker uit de database verwijderd.');
define( '_REPEND_ACTIVE', 'Re-Pend');
define( '_FILTER_PLAN', '- Selecteer Plan -');
define( '_BIND_USER', 'Toepassen op:');
define( '_PLAN_FILTER','Filter op plan:');
define( '_CENTRAL_PAGE','Centrale');

// --== GEBRUIKERS FORMULIER ==--
define( '_HISTORY_COL1_TITLE', 'Factuur');
define( '_HISTORY_COL2_TITLE', 'Bedrag');
define( '_HISTORY_COL3_TITLE', 'Betalingsdatum');
define( '_HISTORY_COL4_TITLE', 'Methode');
define( '_HISTORY_COL5_TITLE', 'Actie');
define( '_HISTORY_COL6_TITLE', 'Plan');
define( '_USERINVOICE_ACTION_REPEAT','herhaal&nbsp;Link');
define( '_USERINVOICE_ACTION_CANCEL','Annuleer');
define( '_USERINVOICE_ACTION_CLEAR','Markeer als&nbsp;opgeschoond');
define( '_USERINVOICE_ACTION_CLEAR_APPLY','Schoon op&nbsp;&amp;&nbsp;toepassen&nbsp;Plan');

// --== BACKEND INSTELLINGEN ==--

// TAB 1 - Global AEC Settings
define( '_CFG_TAB1_TITLE', 'Algemeen');
define( '_CFG_TAB1_SUBTITLE', 'Algemene installatie');

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

define( '_CFG_GENERAL_ALERTLEVEL2_NAME', 'Alarm level 2:');
define( '_CFG_GENERAL_ALERTLEVEL2_DESC', 'In dagen is dit de eerste actie die gebeurd om een gebruiker op de hoogte te stellen dat een account gaat verlopen. <strong>Deze verzend geen email!</strong>');
define( '_CFG_GENERAL_ALERTLEVEL1_NAME', 'Alarm level 1:');
define( '_CFG_GENERAL_ALERTLEVEL1_DESC', 'In dagen is dit de laatste actie die gebeurd om een gebruiker op de hoogte te stellen dat een account gaat verlopen. <strong>Deze verzend geen email!</strong>');
define( '_CFG_GENERAL_ENTRY_PLAN_DESC', 'Instapplan:');
define( '_CFG_GENERAL_ENTRY_PLAN_DESC', 'Elke gebruiker wordt standaard lid van dit plan (gratis!) als een gebruiker niet geregistreerd is.');
define( '_CFG_GENERAL_REQUIRE_SUBSCRIPTION_NAME', 'Registratie vereist:');
define( '_CFG_GENERAL_REQUIRE_SUBSCRIPTION_DESC', 'Als deze optie aanstaat kan een gebruiker NIET inloggen zonder abonnement. Als deze uit staat kan een gebruiker ook zonder account inloggen.');

define( '_CFG_GENERAL_GWLIST_NAME', 'Gateway Omschrijvingen:');
define( '_CFG_GENERAL_GWLIST_DESC', 'Som hier de gateways op die moeten komen te staan op de NotAllowed pagina (de pagina die gebruikers te zien krijgen als ze een betaalmethode selecteren die niet gebruikt mag worden.).');
define( '_CFG_GENERAL_GWLIST_ENABLED_NAME', 'Geactiveerde Gateways:');
define( '_CFG_GENERAL_GWLIST_ENABLED_DESC', 'Selecteer de gateways die u wilt gebruiken (gebruik de CTRL toets om meerdere te selecteren). Nadat u op "save" geklikt heeft zullen de tabs van de door u geselecteerde systemen naar voren komen. Een gateway de-activeren wist de instellingen van die gateway NIET.');

define( '_CFG_GENERAL_BYPASSINTEGRATION_NAME', 'Integratie niet toestaan:');
define( '_CFG_GENERAL_BYPASSINTEGRATION_DESC', 'Selecteer een naam (of een lijst ment namen geschijden door een komma)met integraties die u UIT wilt schakelen. Op dit moment ondersteunen we de regels / componenten: <strong>CB,CBE,CBM,JACL,SMF,UE,UHP2,VM</strong>. Dit is b.v. handig als u CB verwijderd heeft, maar niet de CB tabellen in de database (omdat AEC het dan nog wel ziet als geinstalleerd).');
define( '_CFG_GENERAL_SIMPLEURLS_NAME', 'Simpele URLs:');
define( '_CFG_GENERAL_SIMPLEURLS_DESC', 'Zet het gebruik van Joomla/Mambo SEF Routines uit voor de Urls. Tijdens somminge installaties kan dit lijden tot 40 errors. Probeer deze optie als u problemen heeft met redirects.');
define( '_CFG_GENERAL_EXPIRATION_CUSHION_NAME', 'Verloop versoepeling:');
define( '_CFG_GENERAL_EXPIRATION_CUSHION_DESC', 'Het aantal uren die AEC nodig heeft als voordat na registratie een account vervalt. Neem hier een groot getal omdat het altijd lang kan duren voordat betalingen binnen komen. Gewoonlijk 6 to 8 uur.');
define( '_CFG_GENERAL_HEARTBEAT_CYCLE_NAME', 'Heartbeat Cycle:');
define( '_CFG_GENERAL_HEARTBEAT_CYCLE_DESC', 'Het aantal uur dat AEC nodig heeft om te leren wanneer een login gezien moet worden als een trigger voor het verzenden van een automatische actie als het verzenden van email.');
define( '_CFG_GENERAL_ROOT_GROUP_NAME', 'Root Group:');
define( '_CFG_GENERAL_ROOT_GROUP_DESC', 'Choose the Root Group that the user is displayed when accessing the plans page without any preset variable.');
define( '_CFG_GENERAL_ROOT_GROUP_RW_NAME', 'Root Group ReWrite:');
define( '_CFG_GENERAL_ROOT_GROUP_RW_DESC', 'Choose the Root Group that the user is displayed when accessing the plans page by returning a group number or an array of groups with the ReWriteEngine functionality. This will fall back to the general option (above) if the results are empty.');
define( '_CFG_GENERAL_PLANS_FIRST_NAME', 'Plannen eerst:');
define( '_CFG_GENERAL_PLANS_FIRST_DESC', 'Als u alle 3 de hacks heeft toegepast om een geintregeerde installatie te hebben met directe registratie, dan zal deze switch directe registratie bevorderen. Asl u dit niet wilt moet u deze switch niet inschakelen of alleen de eerste hack toepassen. (wat betekend dat de plannen pas getoond worden als de gebruiker zijn eigen gegevens ingevuld heeft) .');
define( '_CFG_GENERAL_INTEGRATE_REGISTRATION_NAME', 'Integrate Registration');
define( '_CFG_GENERAL_INTEGRATE_REGISTRATION_DESC', 'With this switch, you can make the AEC Mambot/Plugin intercept registration calls and redirect them into the AEC subscription system. Having this option disabled means that the users would freely register and, if a subscription is required, subscribe on their first login. If both this option and "require subscription" are disabled, subscription is completely voluntary.');

define( '_CFG_TAB_CUSTOMIZATION_TITLE', 'Aanpassen');
define( '_CFG_TAB_CUSTOMIZATION_SUBTITLE', 'Aanpassen');

define( '_CFG_CUSTOMIZATION_SUB_CREDIRECT', 'Custom Redirects');
define( '_CFG_CUSTOMIZATION_SUB_PROXY', 'Proxy');
define( '_CFG_CUSTOMIZATION_SUB_BUTTONS_SUB', 'Subscribed Member Buttons');
define( '_CFG_CUSTOMIZATION_SUB_FORMAT_DATE', 'Date Formatting');
define( '_CFG_CUSTOMIZATION_SUB_FORMAT_PRICE', 'Price Formatting');
define( '_CFG_CUSTOMIZATION_SUB_FORMAT_INUM', 'Invoice Number Format');
define( '_CFG_CUSTOMIZATION_SUB_CAPTCHA', 'ReCAPTACHA');

define( '_CFG_GENERAL_CUSTOMINTRO_NAME', 'Aangepaste intropagina link:');
define( '_CFG_GENERAL_CUSTOMINTRO_DESC', 'Geef hier svp de volledige link (inclusief http://) naar uw eigen intropagina. De intropagina moet een link bevatten die lijkt op: http://www.yourdomain.com/index.php?option=com_acctexp&task=subscribe&intro=1 die de intro negeerd, en de gebruiker goed doorstuurd naar de betaalplannen pagina of de registratiepagina. Als u dit niet wilt kunt u dit veld blanco laten.');
define( '_CFG_GENERAL_CUSTOMINTRO_USERID_NAME', 'Pass Userid');
define( '_CFG_GENERAL_CUSTOMINTRO_USERID_DESC', 'Pass Userid via a Joomla notification. This can be helpful for flexible custom signup pages that need to function even if the user is not logged in. You can use Javascript to modify your signup links according to the passed userid.');
define( '_CFG_GENERAL_CUSTOMINTRO_ALWAYS_NAME', 'Always Show Intro');
define( '_CFG_GENERAL_CUSTOMINTRO_ALWAYS_DESC', 'Display the Intro regardless of whether the user is already registered.');
define( '_CFG_GENERAL_CUSTOMTHANKS_NAME', 'Aangepaste bedank pagina:');
define( '_CFG_GENERAL_CUSTOMTHANKS_DESC', 'Geef hier de volledige link (inclusief http://) die naar uw eigen aangepaste bedankt pagina gaat. Laat dit veld blanco als u hier geen gebruik van maakt.');
define( '_CFG_GENERAL_CUSTOMCANCEL_NAME', 'Aangepaste annulerings pagina:');
define( '_CFG_GENERAL_CUSTOMCANCEL_DESC', 'Geef hier de volledige link (inclusief http://) die naar uw eigen aangepaste annulerings pagina gaat. Laat dit veld blanco als u hier geen gebruik van maakt.');
define( '_CFG_GENERAL_TOS_NAME', 'Terms of Service:');
define( '_CFG_GENERAL_TOS_DESC', 'Enter a URL to your Terms of Service. The user will have to select a checkbox when confirming his account. If left blank, nothing will show up.');
define( '_CFG_GENERAL_TOS_IFRAME_NAME', 'ToS Iframe:');
define( '_CFG_GENERAL_TOS_IFRAME_DESC', 'Display the Terms of Service (as specified above) in an iframe on confirmation');
define( '_CFG_GENERAL_CUSTOMNOTALLOWED_NAME', 'Aangepaste NotAllowed link:');
define( '_CFG_GENERAL_CUSTOMNOTALLOWED_DESC', 'Geef hier de volledige link (inclusief http://) die naar uw eigen NotAllowed pagina gaat. Laat dit veld blanco als u hier geen gebruik van maakt.');

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

define( '_CFG_GENERAL_DISPLAY_DATE_FRONTEND_NAME', 'Frontend datum notatie');
define( '_CFG_GENERAL_DISPLAY_DATE_FRONTEND_DESC', 'Specificeer hier hoe de datum in de frontend moet worden weergegeven. Voorbeelden kunt u vinden in <a href="http://www.php.net/manual/en/function.strftime.php">de PHP handleiding</a> voor de juiste syntax.');
define( '_CFG_GENERAL_DISPLAY_DATE_BACKEND_NAME', 'Backend datum notatie');
define( '_CFG_GENERAL_DISPLAY_DATE_BACKEND_DESC', 'Specificeer hier hoe de datum in de backend moet worden weergegeven. Voorbeelden kunt u vinden in <a href="http://www.php.net/manual/en/function.strftime.php">de PHP handleiding</a> voor de juiste syntax.');

define( '_CFG_GENERAL_INVOICENUM_DOFORMAT_NAME', 'Format Invoice Number');
define( '_CFG_GENERAL_INVOICENUM_DOFORMAT_DESC', 'Display a formatted string instead of the original InvoiceNumber to the user. Must provide a formatting rule below.');
define( '_CFG_GENERAL_INVOICENUM_FORMATTING_NAME', 'Formatting');
define( '_CFG_GENERAL_INVOICENUM_FORMATTING_DESC', 'The Formatting - You can use the RewriteEngine as specified below');

define( '_CFG_GENERAL_CUSTOMTEXT_PLANS_NAME', 'Aangepaste tekst voor de plannen pagina');
define( '_CFG_GENERAL_CUSTOMTEXT_PLANS_DESC', 'Deze tekst zal worden weergegeven op de betaalplannen pagina');
define( '_CFG_GENERAL_CUSTOMTEXT_CONFIRM_NAME', 'Aangepaste tekst voor de akkoord pagina.');
define( '_CFG_GENERAL_CUSTOMTEXT_CONFIRM_DESC', 'Deze tekst zal worden weergegeven op de akkoord pagina');
define( '_CFG_GENERAL_CUSTOM_CONFIRM_USERDETAILS_NAME', 'Custom Text Confirm Userdetails');
define( '_CFG_GENERAL_CUSTOM_CONFIRM_USERDETAILS_DESC', 'Customize what the Userdetails field will show on Confirmation');
define( '_CFG_GENERAL_CUSTOMTEXT_CHECKOUT_NAME', 'Aangepaste tekst voor de CheckOut pagina');
define( '_CFG_GENERAL_CUSTOMTEXT_CHECKOUT_DESC', 'Deze tekst zal worden weergegeven op de CheckOut pagina');
define( '_CFG_GENERAL_CUSTOMTEXT_NOTALLOWED_NAME', 'Aangepaste tekst voor de NotAllowed pagina');
define( '_CFG_GENERAL_CUSTOMTEXT_NOTALLOWED_DESC', 'Deze tekst zal worden weergegeven op de NotAllowed pagina');
define( '_CFG_GENERAL_CUSTOMTEXT_PENDING_NAME', 'Aangepaste tekst voor de wachtrij pagina');
define( '_CFG_GENERAL_CUSTOMTEXT_PENDING_DESC', 'Deze tekst zal worden weergegeven op de wachrij pagina');
define( '_CFG_GENERAL_CUSTOMTEXT_EXPIRED_NAME', 'Aangepaste tekst voor de verloop pagina');
define( '_CFG_GENERAL_CUSTOMTEXT_EXPIRED_DESC', 'Deze tekst zal worden weergegeven op de verloop pagina');

define( '_CFG_GENERAL_CUSTOMTEXT_CONFIRM_KEEPORIGINAL_NAME', 'Gebruik de orriginele tekst');
define( '_CFG_GENERAL_CUSTOMTEXT_CONFIRM_KEEPORIGINAL_DESC', 'Selecteer deze optie als u de standaard tekst wilt weergeven.');
define( '_CFG_GENERAL_CUSTOMTEXT_CHECKOUT_KEEPORIGINAL_NAME', 'Gebruik de orriginele tekst');
define( '_CFG_GENERAL_CUSTOMTEXT_CHECKOUT_KEEPORIGINAL_DESC', 'Selecteer deze optie als u de standaard tekst wilt weergeven op de CheckOut pagina.');
define( '_CFG_GENERAL_CUSTOMTEXT_NOTALLOWED_KEEPORIGINAL_NAME', 'Gebruik de orriginele tekst');
define( '_CFG_GENERAL_CUSTOMTEXT_NOTALLOWED_KEEPORIGINAL_DESC', 'Selecteer deze optie als u de standaard tekst wilt weergeven op de NotAllowed pagina.');
define( '_CFG_GENERAL_CUSTOMTEXT_PENDING_KEEPORIGINAL_NAME', 'Gebruik de orriginele tekst');
define( '_CFG_GENERAL_CUSTOMTEXT_PENDING_KEEPORIGINAL_DESC', 'Selecteer deze optie als u de standaard tekst wilt weergeven op de wachtrij pagina.');
define( '_CFG_GENERAL_CUSTOMTEXT_EXPIRED_KEEPORIGINAL_NAME', 'Gebruik de orriginele tekst');
define( '_CFG_GENERAL_CUSTOMTEXT_EXPIRED_KEEPORIGINAL_DESC', 'Selecteer deze optie als u de standaard tekst wilt weergeven op de verlopen account pagina.');

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

define( '_CFG_GENERAL_USE_RECAPTCHA_NAME', 'Use ReCAPTCHA');
define( '_CFG_GENERAL_USE_RECAPTCHA_DESC', 'If you have an account for <a href="http://recaptcha.net/">ReCAPTCHA</a>, you can activate this option. Do NOT forget to put in the keys below.');
define( '_CFG_GENERAL_RECAPTCHA_PRIVATEKEY_NAME', 'Private ReCAPTCHA Key');
define( '_CFG_GENERAL_RECAPTCHA_PRIVATEKEY_DESC', 'Your Private ReCAPTCHA Key.');
define( '_CFG_GENERAL_RECAPTCHA_PUBLICKEY_NAME', 'Public ReCAPTCHA Key');
define( '_CFG_GENERAL_RECAPTCHA_PUBLICKEY_DESC', 'Your Public ReCAPTCHA Key.');

define( '_CFG_GENERAL_TEMP_AUTH_EXP_NAME', 'Logged-out Invoice Access');
define( '_CFG_GENERAL_TEMP_AUTH_EXP_DESC', 'The time (in minutes) that a user is able to access an invoice only by referencing the userid. When that period expires, a password is prompted before allowing access for the same period again.');

define( '_CFG_GENERAL_HEARTBEAT_CYCLE_BACKEND_NAME', 'Heartbeat Cycle Backend:');
define( '_CFG_GENERAL_HEARTBEAT_CYCLE_BACKEND_DESC', 'Aantal uur dat AEC wacht tot deze de backend toegang begrijpt als een heartbeat trigger.');
define( '_CFG_GENERAL_ENABLE_COUPONS_NAME', 'Zet Coupons aan:');
define( '_CFG_GENERAL_ENABLE_COUPONS_DESC', 'Zet het gebruik van coupons aan voor uw gebruikers.');
define( '_CFG_GENERAL_DISPLAYCCINFO_NAME', 'Zet het CC veld aan:');
define( '_CFG_GENERAL_DISPLAYCCINFO_DESC', 'Zet het weergeven van creditkaart iconen aan voor elke betaalmethode.');
define( '_CFG_GENERAL_ADMINACCESS_NAME', 'Administrator Toegang:');
define( '_CFG_GENERAL_ADMINACCESS_DESC', 'Geef toegang tot AEC voor gewone en super administrators i.p.v. voor alleen super administrators.');
define( '_CFG_GENERAL_NOEMAILS_NAME', 'Geen E-mails');
define( '_CFG_GENERAL_NOEMAILS_DESC', 'Zet deze optie aan om AEC geen Systeem E-mails te laten versturen (naar de gebruiker als er b.v. een factuur betaald is) Dit heeft geen effect op het versturen van email in de Micro Integrations.');
define( '_CFG_GENERAL_NOJOOMLAREGEMAILS_NAME', 'Geen Joomla E-mails');
define( '_CFG_GENERAL_NOJOOMLAREGEMAILS_DESC', 'Zet deze optie aan om de joomla registratie e-mails uit te zetten.');
define( '_CFG_GENERAL_DEBUGMODE_NAME', 'Debug Mode');
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
define( '_CFG_GENERAL_PROXY_PORT_DESC', 'Specify the port of the proxy server that you want to connect to.');
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

define( '_CFG_GENERAL_ERROR_NOTIFICATION_LEVEL_NAME', 'Notification Level');
define( '_CFG_GENERAL_ERROR_NOTIFICATION_LEVEL_DESC', 'Select which level of entries to the EventLog is required to make it appear on the central page for your convenience.');
define( '_CFG_GENERAL_EMAIL_NOTIFICATION_LEVEL_NAME', 'Email Notification Level');
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

// Invoice settings
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

// --== BETALINGS PLAN PAGINA ==--
// Additions of variables for free trial periods by Michael Spredemann (scubaguy)

define( '_PAYPLAN_PERUNIT1', 'Dagen');
define( '_PAYPLAN_PERUNIT2', 'Weken');
define( '_PAYPLAN_PERUNIT3', 'Maanden');
define( '_PAYPLAN_PERUNIT4', 'Jaren');

// Algemene parameters

define( '_PAYPLAN_DETAIL_TITLE', 'Plan');
define( '_PAYPLAN_GENERAL_NAME_NAME', 'Naam:');
define( '_PAYPLAN_GENERAL_NAME_DESC', 'Naam of titel voor dit plan. Max.: 40 caracters.');
define( '_PAYPLAN_GENERAL_DESC_NAME', 'Omschrijving:');
define( '_PAYPLAN_GENERAL_DESC_DESC', 'Volledige omschrijving van betaalplannen die u wilt aanbieden aan de gebruiker. Max.: 255 caracters.');
define( '_PAYPLAN_GENERAL_ACTIVE_NAME', 'Gepubliceerd:');
define( '_PAYPLAN_GENERAL_ACTIVE_DESC', 'Een gepubliceerd plan is beschikbaar in de frontend, en een gebruiker kan deze selecteren.');
define( '_PAYPLAN_GENERAL_VISIBLE_NAME', 'Zichtbaar:');
define( '_PAYPLAN_GENERAL_VISIBLE_DESC', 'Een zichtbaar plan is zichtbaar in de frontend. Onzichtbare plannen zijn niet zichtbaar in de frontend en zijn alleen te gebruiken via automatische gebeurtenissen (Zoals terugval of instap plannen).');

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

define( '_PAYPLAN_PARAMS_GID_ENABLED_NAME', 'Zet gebruikersgroepen aan');
define( '_PAYPLAN_PARAMS_GID_ENABLED_DESC', 'Zet deze instelling op JA Als u gebruikers toe wilt wijzen aan de geselecteerde gebruikersgroep.');
define( '_PAYPLAN_PARAMS_GID_NAME', 'Voeg een gebruiker toe aan de groep:');
define( '_PAYPLAN_PARAMS_GID_DESC', 'Gebruikers wordt aan deze gebruikersgroep toegevoegd als deze zich abonneren op dit plan.');
define( '_PAYPLAN_PARAMS_MAKE_ACTIVE_NAME', 'Maak actief:');
define( '_PAYPLAN_PARAMS_MAKE_ACTIVE_DESC', 'Zet deze optie op >NEE< Als u handmatig een gebruiker wilt activeren nadat deze betaald heeft.');
define( '_PAYPLAN_PARAMS_MAKE_PRIMARY_NAME', 'Primary:');
define( '_PAYPLAN_PARAMS_MAKE_PRIMARY_DESC', 'Set this to "yes" to make this the primary subscription plan for the user. The primary subscription is the one which governs overal site expiration.');
define( '_PAYPLAN_PARAMS_UPDATE_EXISTING_NAME', 'Update Existing:');
define( '_PAYPLAN_PARAMS_UPDATE_EXISTING_DESC', 'If not a primary plan, should this plan update other existing non-primary subscriptions of the user? This can be helpful for secondary subscriptions of which the user should have only one at a time.');

define( '_PAYPLAN_TEXT_TITLE', 'Plan Tekst');
define( '_PAYPLAN_GENERAL_EMAIL_DESC_NAME', 'E-mail Omschrijving:');
define( '_PAYPLAN_GENERAL_EMAIL_DESC_DESC', 'Tekst doe teogevoegd moet worden aan de e-mail die verstuurd wordt naar de gebruiker wanneer een plan geactiveerd is voor de gebruiker.');
define( '_PAYPLAN_GENERAL_FALLBACK_NAME', 'Terugval plan:');
define( '_PAYPLAN_GENERAL_FALLBACK_DESC', 'Wanneer een gebruikersaccount vervalt - maak deze dan lid van dit plan');
define( '_PAYPLAN_GENERAL_STANDARD_PARENT_NAME', 'Standard Parent Plan');
define( '_PAYPLAN_GENERAL_STANDARD_PARENT_DESC', 'Currently assigns this plan as the users root membership in case he or she signs up only for a secondary plan.');

define( '_PAYPLAN_GENERAL_PROCESSORS_NAME', 'Betalings Gateways:');
define( '_PAYPLAN_NOPLAN', 'Geen Plan');
define( '_PAYPLAN_NOGW', 'Geen Gateway');
define( '_PAYPLAN_GENERAL_PROCESSORS_DESC', 'Selecteer de betalings gateways die actief moeten zijn voor dit plan. Houdt de Control of Shift toets ingedrukt om meerdere gateways te selecteren. Selecteer ' . _PAYPLAN_NOPLAN . ' en alle overige geselecteerd opties worden genegeerd. Als u alleen ' . _PAYPLAN_NOPLAN . 'hier ziet staan betekend dit dat er geen gateways aanstaan in uw algemene instellingen.');
define( '_PAYPLAN_PARAMS_LIFETIME_NAME', 'Levenslang:');
define( '_PAYPLAN_PARAMS_LIFETIME_DESC', 'Maak dit een plan dat niet vervalt.');

define( '_PAYPLAN_AMOUNT_NOTICE', 'Melding van periodes');
define( '_PAYPLAN_AMOUNT_NOTICE_TEXT', 'Voor Paypal aanmeldingen is er een maximaal bedrag dat je in kan vullen per periode. Als u Paypal registraties gebruikt <strong>limiteer dan dagen tot 90, weken tot 52, maanden tot 24 en jaren tot 5</strong>.');
define( '_PAYPLAN_AMOUNT_EDITABLE_NOTICE', 'Er is een of er zijn meerdere gebruikers voor dit plan, dus het is verstandig de algemene voorwaarden niet te vernieuwen voordat er geen registranten van dit plan meet zijn.');

define( '_PAYPLAN_REGULAR_TITLE', 'Normale aanmelding');
define( '_PAYPLAN_PARAMS_FULL_FREE_NAME', 'Gratis:');
define( '_PAYPLAN_PARAMS_FULL_FREE_DESC', 'Zet deze optie op ja als dit plan gratis is');
define( '_PAYPLAN_PARAMS_FULL_AMOUNT_NAME', 'Reguliere datum:');
define( '_PAYPLAN_PARAMS_FULL_AMOUNT_DESC', 'De prijs van dit abonnement. Als er leden zijn van dit abonnement kan dit veld niet veranderd worden. Als u dit plan wilt aanpassen on-publiceer het dan en maak een nieuwe plan aan.');
define( '_PAYPLAN_PARAMS_FULL_PERIOD_NAME', 'Periode:');
define( '_PAYPLAN_PARAMS_FULL_PERIOD_DESC', 'Dit is de duur van een factuur periode. Dit getal is aangepast door de normale factuur periode (hieronder).  Als er leden zijn van dit abonnement kan dit veld niet veranderd worden. Als u dit plan wilt aanpassen on-publiceer het dan en maak een nieuwe plan aan.');
define( '_PAYPLAN_PARAMS_FULL_PERIODUNIT_NAME', 'Periode unit:');
define( '_PAYPLAN_PARAMS_FULL_PERIODUNIT_DESC', 'Dit zijn de units van de normale factuur periode (hierboven).Als er leden zijn van dit abonnement kan dit veld niet veranderd worden. Als u dit plan wilt aanpassen on-publiceer het dan en maak een nieuwe plan aan.');

define( '_PAYPLAN_TRIAL_TITLE', 'Trial Periode');
define( '_PAYPLAN_TRIAL', '(Optioneel)');
define( '_PAYPLAN_TRIAL_DESC', 'Sla deze sectie over als u geen trail abonnementen / periodes aanbied. <strong>Trials werken alleen automatisch met PayPal aanmeldingen!</strong>');
define( '_PAYPLAN_PARAMS_TRIAL_FREE_NAME', 'Gratis:');
define( '_PAYPLAN_PARAMS_TRIAL_FREE_DESC', 'Zet dit op Ja om deze trail gratis aan te bieden');
define( '_PAYPLAN_PARAMS_TRIAL_AMOUNT_NAME', 'Trial bedrag:');
define( '_PAYPLAN_PARAMS_TRIAL_AMOUNT_DESC', 'Selecteer hier de kosten die direct gefactureerd worden aan de gebruiker voor deze trail periode.');
define( '_PAYPLAN_PARAMS_TRIAL_PERIOD_NAME', 'Trial Periode:');
define( '_PAYPLAN_PARAMS_TRIAL_PERIOD_DESC', 'Dit is de duur van de trail periode. Dit nummer is afgelijd uit de normale duur (hieronder).  Als er leden zijn van dit abonnement kan dit veld niet veranderd worden. Als u dit plan wilt aanpassen on-publiceer het dan en maak een nieuwe plan aan.');
define( '_PAYPLAN_PARAMS_TRIAL_PERIODUNIT_NAME', 'Trial Periode Unit:');
define( '_PAYPLAN_PARAMS_TRIAL_PERIODUNIT_DESC', 'Dit zijn de eenheden van de trail periode. Als er leden zijn van dit abonnement kan dit veld niet veranderd worden. Als u dit plan wilt aanpassen on-publiceer het dan en maak een nieuwe plan aan.');

define( '_PAYPLAN_PARAMS_NOTAUTH_REDIRECT_NAME', 'Denied Access Redirect');
define( '_PAYPLAN_PARAMS_NOTAUTH_REDIRECT_DESC', 'Redirect to a different URL should the user follow a direct link to this item without having the right authorization.');

// Betaalplan relaties

define( '_PAYPLAN_RELATIONS_TITLE', 'Relaties');
define( '_PAYPLAN_PARAMS_SIMILARPLANS_NAME', 'Soortgelijke plannen:');
define( '_PAYPLAN_PARAMS_SIMILARPLANS_DESC', 'Selecteer welke plannen er gelijk zijn aan dit plan. Een gebruiker mag geen trail periode gebruiken wanneer deze een plan wilt kopen dat de gebuiker al eens gebruikt heeft en dit geldt ook voor de soortgelijken plannen.');
define( '_PAYPLAN_PARAMS_EQUALPLANS_NAME', 'Dezelfde plannen:');
define( '_PAYPLAN_PARAMS_EQUALPLANS_DESC', 'Selecteer hier dezelfde plannen. Een gebruiker die overschakeld naar eenzelfde plan zal zijn of haar abonnements periode verlengen i.p.v. cancellen. Trails zien niet toegestaan.');

// Betaalplan beperkingen

define( '_PAYPLAN_RESTRICTIONS_TITLE', 'Restricties');
define( '_PAYPLAN_RESTRICTIONS_MINGID_ENABLED_NAME', 'Zet minimale GID aan:');
define( '_PAYPLAN_RESTRICTIONS_MINGID_ENABLED_DESC', 'Zet deze optie aan als een gebruiker deze alleen mag zien als hij of zij lid is van een bepaalde (minimale) gebruikersgroep.');
define( '_PAYPLAN_RESTRICTIONS_MINGID_NAME', 'Zichtbaarheids groep:');
define( '_PAYPLAN_RESTRICTIONS_MINGID_DESC', 'Het minimale gebruikerslevel dat benodigd is om dit plan te zien tijdens het opzetten van de betaal plan pagina. Nieuwe gebruikers zien altijd de betaalplannen met de laagste GID.');
define( '_PAYPLAN_RESTRICTIONS_FIXGID_ENABLED_NAME', 'Zet vaste / statische GID aan:');
define( '_PAYPLAN_RESTRICTIONS_FIXGID_ENABLED_DESC', 'Zet deze instelling aan als u dit plan wilt weergeven aan 1 gebruikersgroep.');
define( '_PAYPLAN_RESTRICTIONS_FIXGID_NAME', 'Definieer groep:');
define( '_PAYPLAN_RESTRICTIONS_FIXGID_DESC', 'Alleen gebruikers van deze groep zullen het plan te zien krijgen.');
define( '_PAYPLAN_RESTRICTIONS_MAXGID_ENABLED_NAME', 'Zet maximale GID aan:');
define( '_PAYPLAN_RESTRICTIONS_MAXGID_ENABLED_DESC', 'Zet deze installing aan als u dit betaalplan alleen wilt laten zien aan de maximale gebruikers.');
define( '_PAYPLAN_RESTRICTIONS_MAXGID_NAME', 'Maximale groep:');
define( '_PAYPLAN_RESTRICTIONS_MAXGID_DESC', 'Alleen de maximale gebruiker kan dit plan zien..');

define( '_PAYPLAN_RESTRICTIONS_PREVIOUSPLAN_REQ_ENABLED_NAME', 'Verplicht voorgaande betaalplan / abonnement:');
define( '_PAYPLAN_RESTRICTIONS_PREVIOUSPLAN_REQ_ENABLED_DESC', 'Zet de check aan voor een vorig betaalplan. Een vorig betaalplan is verplicht');
define( '_PAYPLAN_RESTRICTIONS_PREVIOUSPLAN_REQ_NAME', 'Plan:');
define( '_PAYPLAN_RESTRICTIONS_PREVIOUSPLAN_REQ_DESC', 'Een gebruiker kan dit plan alleen zien als deze het plan al eens eerder gebruikt heeft, of deze nu gebruikt');
define( '_PAYPLAN_RESTRICTIONS_CURRENTPLAN_REQ_ENABLED_NAME', 'Verplicht Huidig Plan:');
define( '_PAYPLAN_RESTRICTIONS_CURRENTPLAN_REQ_ENABLED_DESC', 'Zorg dat er gecontroleerd wordt op het huidige betaalplan van de gebruiker');
define( '_PAYPLAN_RESTRICTIONS_CURRENTPLAN_REQ_NAME', 'Plan:');
define( '_PAYPLAN_RESTRICTIONS_CURRENTPLAN_REQ_DESC', 'Een gebruiker kan dit plan alleen zien als deze momenteel dit plan gebruikt, of het gebruikt heeft, en het nu verlopen is.');
define( '_PAYPLAN_RESTRICTIONS_OVERALLPLAN_REQ_ENABLED_NAME', 'Verplicht Gebruikt Plan:');
define( '_PAYPLAN_RESTRICTIONS_OVERALLPLAN_REQ_ENABLED_DESC', 'Zorg ervoor dat er gecontroleerd wordt op gebruikte plannen');
define( '_PAYPLAN_RESTRICTIONS_OVERALLPLAN_REQ_NAME', 'Plan:');
define( '_PAYPLAN_RESTRICTIONS_OVERALLPLAN_REQ_DESC', 'Een gebruiker kan dit plan alleen zien als deze het plan al eens eerder gebruikt heeft, ongeacht wanneer');

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

define( '_PAYPLAN_RESTRICTIONS_USED_PLAN_MIN_ENABLED_NAME', 'Minimaal gebruikte plannen:');
define( '_PAYPLAN_RESTRICTIONS_USED_PLAN_MIN_ENABLED_DESC', 'Deze optie zorgt ervoor dat er gecontroleerd wordt hoevaak u een bepaald plan gebruikt heeft.');
define( '_PAYPLAN_RESTRICTIONS_USED_PLAN_MIN_AMOUNT_NAME', 'Aantal gebruikte keren:');
define( '_PAYPLAN_RESTRICTIONS_USED_PLAN_MIN_AMOUNT_DESC', 'Het minimale aantal keer dat de gebruiker een bepaald plan gebruikt moet hebben');
define( '_PAYPLAN_RESTRICTIONS_USED_PLAN_MIN_NAME', 'Plan:');
define( '_PAYPLAN_RESTRICTIONS_USED_PLAN_MIN_DESC', 'Het minimale aantal keer dat de gebruiker een bepaald plan gebruikt moet hebben');
define( '_PAYPLAN_RESTRICTIONS_USED_PLAN_MAX_ENABLED_NAME', 'Maximaal gebruikte keren:');
define( '_PAYPLAN_RESTRICTIONS_USED_PLAN_MAX_ENABLED_DESC', 'Deze optie zorgt ervoor dat er gecontroleerd wordt op het maximaal aantal keren dat u bepaald plan gebruikt heeft, voordat u dit plan kan gebruiken.');
define( '_PAYPLAN_RESTRICTIONS_USED_PLAN_MAX_AMOUNT_NAME', 'Maximaal te gebruiken keren:');
define( '_PAYPLAN_RESTRICTIONS_USED_PLAN_MAX_AMOUNT_DESC', 'Het maximaal aantal keren dat een gebruiker het plan kan gebruiken');
define( '_PAYPLAN_RESTRICTIONS_USED_PLAN_MAX_NAME', 'Plan:');
define( '_PAYPLAN_RESTRICTIONS_USED_PLAN_MAX_DESC', 'Het betalingsplan dat de gebruiker een minimaal aantal keren gebruikt moet hebben');

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

define( '_PAYPLAN_RESTRICTIONS_CUSTOM_RESTRICTIONS_ENABLED_NAME', 'Gebruik verschillende restricties:');
define( '_PAYPLAN_RESTRICTIONS_CUSTOM_RESTRICTIONS_ENABLED_DESC', 'Zet het gebruik aan van de hier beneden weergegeven restricties.');
define( '_PAYPLAN_RESTRICTIONS_CUSTOM_RESTRICTIONS_NAME', 'Verschillende restricties:');
define( '_PAYPLAN_RESTRICTIONS_CUSTOM_RESTRICTIONS_DESC', 'Gebruik RewriteEngine velden om te controleren op speciale regels in dit formulier:<br />[[user_id]] >= 1500<br />[[parametername]] = value<br />(Maak meerdere restricties aan door deze op een nieuwe regel te plaatsen).<br />You can use =, <=, >=, <, >, <> as comparing elements. You MUST use spaces between parameters, values and comparators!');

define( '_PAYPLAN_PROCESSORS_TITLE', 'Processors');
define( '_PAYPLAN_PROCESSORS_TITLE_LONG', 'Payment Processors');

define( '_PAYPLAN_PROCESSORS_ACTIVATE_NAME', 'Active');
define( '_PAYPLAN_PROCESSORS_ACTIVATE_DESC', 'Offer this Payment Processor for this Payment Plan.');
define( '_PAYPLAN_PROCESSORS_OVERWRITE_SETTINGS_NAME', 'Overwrite Global Settings');
define( '_PAYPLAN_PROCESSORS_OVERWRITE_SETTINGS_DESC', 'If you want to, you can check this box and after saving the plan edit every setting from the global configuration to be different for this plan individually.');

define( '_PAYPLAN_MI', 'Micro Integr.');
define( '_PAYPLAN_GENERAL_MICRO_INTEGRATIONS_NAME', 'Micro Integraties:');
define( '_PAYPLAN_GENERAL_MICRO_INTEGRATIONS_DESC', 'Selecteer de Micro Integraties dat u op dit plan wilt gebruiken.');
define( '_PAYPLAN_GENERAL_MICRO_INTEGRATIONS_PLAN_NAME', 'Local Micro Integrations:');
define( '_PAYPLAN_GENERAL_MICRO_INTEGRATIONS_PLAN_DESC', 'Select the Micro Integrations that you want to apply to the user with the plan. Instead of global instances, these MIs will be specific only to this payment plan.');
define( '_PAYPLAN_GENERAL_MICRO_INTEGRATIONS_INHERITED_NAME', 'Inherited:');
define( '_PAYPLAN_GENERAL_MICRO_INTEGRATIONS_INHERITED_DESC', 'Shows which Micro Integrations are inherited from parent groups that this plan is a member of.');

define( '_PAYPLAN_CURRENCY', 'Bedrag');

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

define( '_CURRENCY_AFA', 'Afganistan');
define( '_CURRENCY_ALL', 'Lek');
define( '_CURRENCY_DZD', 'Algareinse Dinar');
define( '_CURRENCY_ADP', 'Andorra Peseta');
define( '_CURRENCY_AON', 'New Kwanza');
define( '_CURRENCY_ARS', 'Argenteinse Peseta');
define( '_CURRENCY_AMD', 'Armeniaase Dram');
define( '_CURRENCY_AWG', 'Urbaanse Gulden');
define( '_CURRENCY_AUD', 'Australische Dollar');
define( '_CURRENCY_AZM', 'Azerbaijaanse Manat ');
define( '_CURRENCY_EUR', 'Euro');
define( '_CURRENCY_BSD', 'Bahamian Dollar');
define( '_CURRENCY_BHD', 'Bahraini Dinar');
define( '_CURRENCY_BDT', 'Taka');
define( '_CURRENCY_BBD', 'Barbados Dollar');
define( '_CURRENCY_BYB', 'Belarussian Ruble');
define( '_CURRENCY_BEF', 'Belgische Frank');
define( '_CURRENCY_BZD', 'Belgische Dollar');
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
define( '_CURRENCY_CAD', 'Canadian Dollar');
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
define( '_CURRENCY_ANG', 'Nederlandse Antille Gulden');
define( '_CURRENCY_NLG', 'Nederlandse Gulden');
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

// --== MICRO INTEGRATIES OVERZICHT ==--
define( '_MI_TITLE', 'Micro Integraties');
define( '_MI_NAME', 'Naam');
define( '_MI_DESC', 'Omschrijving');
define( '_MI_ACTIVE', 'Actief');
define( '_MI_REORDER', 'Volgorde');
define( '_MI_FUNCTION', 'Functie naam');

// --== MICRO INTEGRATIES BEWERKEN ==--
define( '_MI_E_TITLE', 'MI');
define( '_MI_E_TITLE_LONG', 'Micro Integraties');
define( '_MI_E_SETTINGS', 'Instellingen');
define( '_MI_E_NAME_NAME', 'Naam');
define( '_MI_E_NAME_DESC', 'Kies een naam voor deze Micro Integratie');
define( '_MI_E_DESC_NAME', 'Omschrijving');
define( '_MI_E_DESC_DESC', 'Omschrijf hier in het kort de Micro Integratie');
define( '_MI_E_ACTIVE_NAME', 'Actief');
define( '_MI_E_ACTIVE_DESC', 'Zet de integratie op actief');
define( '_MI_E_AUTO_CHECK_NAME', 'Verval opties');
define( '_MI_E_AUTO_CHECK_DESC', 'Als de functie dit toe staat, kunt u de verval opties instellen: Dit zijn de acties die moeten gebeuren als een gebruiker vervalt of verloopt.');
define( '_MI_E_ON_USERCHANGE_NAME', 'Gebruiksaccount update actie');
define( '_MI_E_ON_USERCHANGE_DESC', 'Als de functie dit toe staat, kunt u hier de opties instellen die moeten gebeuren als een account geupdate wordt.');
define( '_MI_E_PRE_EXP_CHECK_NAME', 'Voor-Verval');
define( '_MI_E_PRE_EXP_CHECK_DESC', 'Zet het aantal dagen voor de vervaldatum dat er een actie ondernomen moet worden.');
define( '_MI_E__AEC_GLOBAL_EXP_ALL_NAME', 'Expire all instances');
define( '_MI_E__AEC_GLOBAL_EXP_ALL_DESC', 'Trigger the expiration action even if the user has another payment plan with this MI attached. The standard behavior is to call the expiration action on an MI only when it really is the last MI instance that this user has in all payment plans.');
define( '_MI_E_FUNCTION_NAME', 'Functie naam');
define( '_MI_E_FUNCTION_DESC', 'Kies s.v.p. welke integraties gebruikt moeten worden');
define( '_MI_E_FUNCTION_EXPLANATION', 'Voordat u Mico Integraties kunt gaan installeren moet u aangeven welke installatiebestanden we hiervoor moeten gebruiken. Maak een selectie en sla de instellingen op. Bewerk Micro Integraties daarna opnieuw en u bent in de gelegenheid om parameters in te stellen. LET OP: Een funcite naam kan niet aangepast worden zodra deze is ingesteld.');

// --== REWRITE EXPLANATION ==--
define( '_REWRITE_AREA_USER', 'Gebruikers Account Items');
define( '_REWRITE_KEY_USER_ID', 'Gebruikers Account ID');
define( '_REWRITE_KEY_USER_USERNAME', 'Gebruikersnaam');
define( '_REWRITE_KEY_USER_NAME', 'Naam');
define( '_REWRITE_KEY_USER_FIRST_NAME', 'First Name');
define( '_REWRITE_KEY_USER_FIRST_FIRST_NAME', 'First First Name');
define( '_REWRITE_KEY_USER_LAST_NAME', 'Last Name');
define( '_REWRITE_KEY_USER_EMAIL', 'E-Mail Adres');
define( '_REWRITE_KEY_USER_ACTIVATIONCODE', 'Activatie Code');
define( '_REWRITE_KEY_USER_ACTIVATIONLINK', 'Activatie Link');

define( '_REWRITE_AREA_SUBSCRIPTION', 'Gebruikers Abonnementen Gerelateerd');
define( '_REWRITE_KEY_SUBSCRIPTION_TYPE', 'Betalings Processor');
define( '_REWRITE_KEY_SUBSCRIPTION_STATUS', 'Registratie Status');
define( '_REWRITE_KEY_SUBSCRIPTION_SIGNUP_DATE', 'Datum dat de gebruiker geregistreerd heeft');
define( '_REWRITE_KEY_SUBSCRIPTION_LASTPAY_DATE', 'Laatste betaal datum');
define( '_REWRITE_KEY_SUBSCRIPTION_PLAN', 'Betalings Plan ID');
define( '_REWRITE_KEY_SUBSCRIPTION_PREVIOUS_PLAN', 'Laatste betalings plan ID');
define( '_REWRITE_KEY_SUBSCRIPTION_RECURRING', 'Terugkerend betaling');
define( '_REWRITE_KEY_SUBSCRIPTION_LIFETIME', 'Levenslange aanmelding');
define( '_REWRITE_KEY_SUBSCRIPTION_EXPIRATION_DATE', 'Verval Datum (Frontend Formatting)');
define( '_REWRITE_KEY_SUBSCRIPTION_EXPIRATION_DATE_BACKEND', 'Verval Datum (Backend Formatting)');

define( '_REWRITE_AREA_PLAN', 'Betalingsplan gerelateerd');
define( '_REWRITE_KEY_PLAN_NAME', 'Naam');
define( '_REWRITE_KEY_PLAN_DESC', 'Omschrijving');

define( '_REWRITE_AREA_CMS', 'CMS Gerelateerd');
define( '_REWRITE_KEY_CMS_ABSOLUTE_PATH', 'Absolute pad naar de CMS directory');
define( '_REWRITE_KEY_CMS_LIVE_SITE', 'Uw Website URL');

define( '_REWRITE_AREA_SYSTEM', 'System Related');
define( '_REWRITE_KEY_SYSTEM_TIMESTAMP', 'Timestamp (Frontend Formatting)');
define( '_REWRITE_KEY_SYSTEM_TIMESTAMP_BACKEND', 'Timestamp (Backend Formatting)');
define( '_REWRITE_KEY_SYSTEM_SERVER_TIMESTAMP', 'Server Timestamp (Frontend Formatting)');
define( '_REWRITE_KEY_SYSTEM_SERVER_TIMESTAMP_BACKEND', 'Server Timestamp (Backend Formatting)');

define( '_REWRITE_AREA_INVOICE', 'Factuur Gerelateerd');
define( '_REWRITE_KEY_INVOICE_ID', 'Factuur ID');
define( '_REWRITE_KEY_INVOICE_NUMBER', 'Factuurnummer');
define( '_REWRITE_KEY_INVOICE_NUMBER_FORMAT', 'Factuurnummer (formatted)');
define( '_REWRITE_KEY_INVOICE_CREATED_DATE', 'Datum van registratie');
define( '_REWRITE_KEY_INVOICE_TRANSACTION_DATE', 'Datum van betaling');
define( '_REWRITE_KEY_INVOICE_METHOD', 'Betalings methode');
define( '_REWRITE_KEY_INVOICE_AMOUNT', 'Bedrag betaald');
define( '_REWRITE_KEY_INVOICE_CURRENCY', 'Bedrag');
define( '_REWRITE_KEY_INVOICE_COUPONS', 'Lijst met coupons');

define( '_REWRITE_ENGINE_TITLE', 'Rewrite Engine');
define( '_REWRITE_ENGINE_DESC', 'To create dynamic text, you can add these wiki-style tags in RWengine-enabled fields. Flick through the togglers below to see which tags are available');
define( '_REWRITE_ENGINE_AECJSON_TITLE', 'aecJSON');
define( '_REWRITE_ENGINE_AECJSON_DESC', 'You can also use functions encoded in JSON markup, like this:<br />{aecjson} { "cmd":"date", "vars": [ "Y", { "cmd":"rw_constant", "vars":"invoice_created_date" } ] } {/aecjson}<br />It returns only the Year of a date. Refer to the manual and forums for further instructions!');

// --== COUPONS OVERZICHT ==--
define( '_COUPON_TITLE', 'Coupons');
define( '_COUPON_TITLE_STATIC', 'Statische Coupons');
define( '_COUPON_NAME', 'Naam');
define( '_COUPON_DESC', 'Omschrijving (eerste 50 caracters)');
define( '_COUPON_CODE', 'Coupon Code');
define( '_COUPON_ACTIVE', 'Gepubliceerd');
define( '_COUPON_REORDER', 'Herordenen');
define( '_COUPON_USECOUNT', 'Aantal keer te gebruiken');

// --== COUPON EDIT ==--
define( '_COUPON_DETAIL_TITLE', 'Coupon');
define( '_COUPON_RESTRICTIONS_TITLE', 'Geldig op.');
define( '_COUPON_RESTRICTIONS_TITLE_FULL', 'Beperk gebruik tot');
define( '_COUPON_MI', 'Micro Int.');
define( '_COUPON_MI_FULL', 'Micro Integraties');

define( '_COUPON_GENERAL_NAME_NAME', 'Naam');
define( '_COUPON_GENERAL_NAME_DESC', 'Vul de (internal&amp;external) naam in voor deze coupon');
define( '_COUPON_GENERAL_COUPON_CODE_NAME', 'Coupon Code');
define( '_COUPON_GENERAL_COUPON_CODE_DESC', 'Vul de coupon code in voor deze coupon - De automatisch gegenereerde coupon code is actief zodat de coupon code altijd uniek is in het systeem.');
define( '_COUPON_GENERAL_DESC_NAME', 'Omschrijving');
define( '_COUPON_GENERAL_DESC_DESC', 'Vul de  (interne) omschrijving in voor deze coupon');
define( '_COUPON_GENERAL_ACTIVE_NAME', 'Actief');
define( '_COUPON_GENERAL_ACTIVE_DESC', 'Selecteer wanneerd de coupon gebruikt kan worden');
define( '_COUPON_GENERAL_TYPE_NAME', 'Statisch');
define( '_COUPON_GENERAL_TYPE_DESC', 'Selecteer of u van deze coupon een statische coupon wilt maken. Deze worden opgeslagen in een apparte tabelvoor snellere toegang. Normaliter worden statische coupons door verschillende gebruikers gebruikt terwijl niet-statisch coupons voor een unieke gebruiker zijn.');

define( '_COUPON_GENERAL_MICRO_INTEGRATIONS_NAME', 'Micro Integraties');
define( '_COUPON_GENERAL_MICRO_INTEGRATIONS_DESC', 'Selecteer de Micro Integratie(s) welke u wilt activeren zodra de coupon is gebruikt');

define( '_COUPON_PARAMS_AMOUNT_USE_NAME', 'Gebruikers bedrag');
define( '_COUPON_PARAMS_AMOUNT_USE_DESC', 'Selecteer of u een directe korting wilt toepassen');
define( '_COUPON_PARAMS_AMOUNT_NAME', 'Kortingsbedrag');
define( '_COUPON_PARAMS_AMOUNT_DESC', 'Selecteer het bedrag dat u wilt aftrekken van het vorige bedrag');
define( '_COUPON_PARAMS_AMOUNT_PERCENT_USE_NAME', 'Gebruik percentage');
define( '_COUPON_PARAMS_AMOUNT_PERCENT_USE_DESC', 'Selecteer of u een bepaald percentage korting wilt geven op het totaal bedrag');
define( '_COUPON_PARAMS_AMOUNT_PERCENT_NAME', 'Kortings percentage');
define( '_COUPON_PARAMS_AMOUNT_PERCENT_DESC', 'Selecteer het percentage dat u korting wilt geven op het totaal bedrag');
define( '_COUPON_PARAMS_PERCENT_FIRST_NAME', 'Eerste percentage');
define( '_COUPON_PARAMS_PERCENT_FIRST_DESC', 'Als u percentage en bedrag korting toepast, wilt u dan dat eerst het percentage korting van het totaal bedrag afgaat, en daarna de bedrags korting?');
define( '_COUPON_PARAMS_USEON_TRIAL_NAME', 'Te gebruiken op Trial abonnementen?');
define( '_COUPON_PARAMS_USEON_TRIAL_DESC', 'Mag de korting op een trail abonnement worden toegepast');
define( '_COUPON_PARAMS_USEON_FULL_NAME', 'Korting op actueel bedrag');
define( '_COUPON_PARAMS_USEON_FULL_DESC', 'Wilt u de korting laten toepassen op het huidige bedrag? (Met terugkerende betalingen alleen op de eerstvolgende betaling).');
define( '_COUPON_PARAMS_USEON_FULL_ALL_NAME', 'Every Full?');
define( '_COUPON_PARAMS_USEON_FULL_ALL_DESC', 'Als de gebruiker gebruikt maakt van terugkerende betalingen, wilt u dan de korting op elke betaling toepassen? Als u het alleen op de eerste betaling van toepassing wilt laten zijn selecteerd u hier NEE');

define( '_COUPON_PARAMS_HAS_START_DATE_NAME', 'Gebruik start datum');
define( '_COUPON_PARAMS_HAS_START_DATE_DESC', 'Wilt u dat gebruikers deze coupon kunnen gebruiken alleen v.a. een bepaalde datum?');
define( '_COUPON_PARAMS_START_DATE_NAME', 'Start Datum');
define( '_COUPON_PARAMS_START_DATE_DESC', 'Selecteer de datum vanaf wanneer de coupon gebruikt kan worden.');
define( '_COUPON_PARAMS_HAS_EXPIRATION_NAME', 'Gebruik verval datum?');
define( '_COUPON_PARAMS_HAS_EXPIRATION_DESC', 'Wilt u dat de coupon niet meer gebruikt kan worden na een bepaalde datum?');
define( '_COUPON_PARAMS_EXPIRATION_NAME', 'Verval datum');
define( '_COUPON_PARAMS_EXPIRATION_DESC', 'Selecteer de datum wanneer de coupon niet meer gebruikt kan worden.');
define( '_COUPON_PARAMS_HAS_MAX_REUSE_NAME', 'Hergebruik beperken?');
define( '_COUPON_PARAMS_HAS_MAX_REUSE_DESC', 'Mag de coupon oneinding of slechts een X aantal keer gebruikt worden');
define( '_COUPON_PARAMS_MAX_REUSE_NAME', 'Maximaal aantal keer te gebruiken');
define( '_COUPON_PARAMS_MAX_REUSE_DESC', 'Selecteer het aantal keer dat een coupon gebruikt kan worden');
define( '_COUPON_PARAMS_HAS_MAX_PERUSER_REUSE_NAME', 'Restrict Reuse per User?');
define( '_COUPON_PARAMS_HAS_MAX_PERUSER_REUSE_DESC', 'Do you want to restrict the number of times every user is allowed to use this coupon?');
define( '_COUPON_PARAMS_MAX_PERUSER_REUSE_NAME', 'Max Uses per User');
define( '_COUPON_PARAMS_MAX_PERUSER_REUSE_DESC', 'Choose the number of times this coupon can be used by each user');

define( '_COUPON_PARAMS_USECOUNT_NAME', 'Tellingen');
define( '_COUPON_PARAMS_USECOUNT_DESC', 'Reset het aantal keer dat deze coupon gebruikt is.');

define( '_COUPON_PARAMS_USAGE_PLANS_ENABLED_NAME', 'Selecteer plan');
define( '_COUPON_PARAMS_USAGE_PLANS_ENABLED_DESC', 'Is deze coupon alleen geldig op een bepaald plan?');
define( '_COUPON_PARAMS_USAGE_PLANS_NAME', 'Plannen');
define( '_COUPON_PARAMS_USAGE_PLANS_DESC', 'Kies voor welke plannen de coupon gebruikt kan worden');
define( '_COUPON_PARAMS_USAGE_CART_FULL_NAME', 'Use on Cart');
define( '_COUPON_PARAMS_USAGE_CART_FULL_DESC', 'Allow Application to a full shopping card');
define( '_COUPON_PARAMS_CART_MULTIPLE_ITEMS_NAME', 'Multiple Items');
define( '_COUPON_PARAMS_CART_MULTIPLE_ITEMS_DESC', 'Let the user apply the coupon to multiple items of a shopping cart, if overall restrictions permit it');
define( '_COUPON_PARAMS_CART_MULTIPLE_ITEMS_AMOUNT_NAME', 'Multiple Items Amount');
define( '_COUPON_PARAMS_CART_MULTIPLE_ITEMS_AMOUNT_DESC', 'Set a limit for application to multiple items of one shopping cart');

define( '_COUPON_RESTRICTIONS_MINGID_ENABLED_NAME', 'Zet minimale GID aan:');
define( '_COUPON_RESTRICTIONS_MINGID_ENABLED_DESC', 'Gebruik deze instelling op in te stellen van welke gebruikersgroep de gebruiker lid moet zijn om deze coupon te gebruiken.');
define( '_COUPON_RESTRICTIONS_MINGID_NAME', 'Minimale groep:');
define( '_COUPON_RESTRICTIONS_MINGID_DESC', 'Het minimale gebruikerslevel dat benodigd is om deze coupon te gebruiken.');
define( '_COUPON_RESTRICTIONS_FIXGID_ENABLED_NAME', 'Zet statische GID aan:');
define( '_COUPON_RESTRICTIONS_FIXGID_ENABLED_DESC', 'Zet deze instelling aan als het gebruik van de coupon slechts geldig is op een gebruikersgroep.');
define( '_COUPON_RESTRICTIONS_FIXGID_NAME', 'Selecteer groep:');
define( '_COUPON_RESTRICTIONS_FIXGID_DESC', 'Alleen gebruikers van deze gebruikersgroep mogen de coupon gebruiken');
define( '_COUPON_RESTRICTIONS_MAXGID_ENABLED_NAME', 'Zet maximale GID aan:');
define( '_COUPON_RESTRICTIONS_MAXGID_ENABLED_DESC', 'Zet deze instelling aan als gebruikers boven een maximale gebruikersgroep de coupon niet kunnen gebruiken.');
define( '_COUPON_RESTRICTIONS_MAXGID_NAME', 'Maximale groep:');
define( '_COUPON_RESTRICTIONS_MAXGID_DESC', 'De maximale gebruikersgroep die de coupon kan gebruiken. Gebruikers in hogere gebruikersgroepen kunnen deze dus niet gebruiken.');

define( '_COUPON_RESTRICTIONS_PREVIOUSPLAN_REQ_ENABLED_NAME', 'Verplicht vorige plan:');
define( '_COUPON_RESTRICTIONS_PREVIOUSPLAN_REQ_ENABLED_DESC', 'Zet het checken op een vorig plan aan');
define( '_COUPON_RESTRICTIONS_PREVIOUSPLAN_REQ_NAME', 'Plan:');
define( '_COUPON_RESTRICTIONS_PREVIOUSPLAN_REQ_DESC', 'Een gebruiker kan deze coupon alleen gebruiken als deze hiervoor al geabonneerd is geweest op het, of een plan ');
define( '_COUPON_RESTRICTIONS_CURRENTPLAN_REQ_ENABLED_NAME', 'Verplichte huidige plan:');
define( '_COUPON_RESTRICTIONS_CURRENTPLAN_REQ_ENABLED_DESC', 'Zet controle op het huidige plan aan.');
define( '_COUPON_RESTRICTIONS_CURRENTPLAN_REQ_NAME', 'Plan:');
define( '_COUPON_RESTRICTIONS_CURRENTPLAN_REQ_DESC', 'Een gebruiker kan de coupon alleen gebruiken als deze op het moment van gebruiken geabonneerd is op dit plan. Of als het plan verlopen is.');
define( '_COUPON_RESTRICTIONS_OVERALLPLAN_REQ_ENABLED_NAME', 'Verplicht gebruikt plan:');
define( '_COUPON_RESTRICTIONS_OVERALLPLAN_REQ_ENABLED_DESC', 'Zet de contole aan of de gebruiker ooit al eens een willekeurig betaalplan gehad heeft.');
define( '_COUPON_RESTRICTIONS_OVERALLPLAN_REQ_NAME', 'Plan:');
define( '_COUPON_RESTRICTIONS_OVERALLPLAN_REQ_DESC', 'Een gebruiker kan de coupon alleen gebruiken als deze ooit al eens lid geweest is van het hier geselecteerde plan.');

define( '_COUPON_RESTRICTIONS_USED_PLAN_MIN_ENABLED_NAME', 'Minimaal gebruikte plan:');
define( '_COUPON_RESTRICTIONS_USED_PLAN_MIN_ENABLED_DESC', 'Een gebruiker moet minimaal het hier vernoemde aantal aan abonnementen gehad hebben voordat deze de coupon kan gebruiken.');
define( '_COUPON_RESTRICTIONS_USED_PLAN_MIN_AMOUNT_NAME', 'Aantal plannen:');
define( '_COUPON_RESTRICTIONS_USED_PLAN_MIN_AMOUNT_DESC', 'Het minimale aantal keer dat een gebruiker lid is moeten zijn van een betaalplan');
define( '_COUPON_RESTRICTIONS_USED_PLAN_MIN_NAME', 'Plan:');
define( '_COUPON_RESTRICTIONS_USED_PLAN_MIN_DESC', 'Het betaalplan waarvan de gebruiker al een X aantal keer lid van in moeten zijn.');
define( '_COUPON_RESTRICTIONS_USED_PLAN_MAX_ENABLED_NAME', 'Maximaal gebruikte plan:');
define( '_COUPON_RESTRICTIONS_USED_PLAN_MAX_ENABLED_DESC', 'Zet contole aan op het maximale aantal keer dat een gebruiker lid is geweest van een betaalplan');
define( '_COUPON_RESTRICTIONS_USED_PLAN_MAX_AMOUNT_NAME', 'Aantal plannen:');
define( '_COUPON_RESTRICTIONS_USED_PLAN_MAX_AMOUNT_DESC', 'Het maximaal aantal keer dat een gebruiker geabonneerd geweest mag zijn op dit betaalplan.');
define( '_COUPON_RESTRICTIONS_USED_PLAN_MAX_NAME', 'Plan:');
define( '_COUPON_RESTRICTIONS_USED_PLAN_MAX_DESC', 'Het betaalplan dat de gebruiker niet meer dan een X aantal keer gebruikt mag hebben.');

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

define( '_COUPON_RESTRICTIONS_RESTRICT_COMBINATION_NAME', 'Verbied combinaties:');
define( '_COUPON_RESTRICTIONS_RESTRICT_COMBINATION_DESC', 'Kies ervoor dat uw gebruikers de coupon niet kunnen combineren met de volgende items.');
define( '_COUPON_RESTRICTIONS_BAD_COMBINATIONS_NAME', 'Couponnen:');
define( '_COUPON_RESTRICTIONS_BAD_COMBINATIONS_DESC', 'Selecteer de couponnen die niet gecombineerd kunnen worden met de huidige coupon.');
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

// --== FACTUUR OVERZICHT ==--
define( '_INVOICE_TITLE', 'Facturen');
define( '_INVOICE_SEARCH', 'Zoeken');
define( '_INVOICE_USERID', 'Gebruikersnaam');
define( '_INVOICE_INVOICE_NUMBER', 'Factuur nummer');
define( '_INVOICE_SECONDARY_IDENT', 'Secondary Identification');
define( '_INVOICE_TRANSACTION_DATE', 'Transactie datum');
define( '_INVOICE_CREATED_DATE', 'Aangemaakt op');
define( '_INVOICE_METHOD', 'methode');
define( '_INVOICE_AMOUNT', 'bedrag');
define( '_INVOICE_CURRENCY', 'valuta');
define( '_INVOICE_COUPONS', 'Coupons');

// --== BETALINGS HISTORIE OVERZICHT ==--
define( '_HISTORY_TITLE2', 'Uw huidige historie van transacties');
define( '_HISTORY_SEARCH', 'Zoeken');
define( '_HISTORY_USERID', 'Gebruikersnaam');
define( '_HISTORY_INVOICE_NUMBER', 'Factuurnummer');
define( '_HISTORY_PLAN_NAME', 'Abonnement waarop u geregistreerd bent');
define( '_HISTORY_TRANSACTION_DATE', 'Transactie datum');
define( '_HISTORY_METHOD', 'Factuur methode');
define( '_HISTORY_AMOUNT', 'Factuur bedrag');
define( '_HISTORY_RESPONSE', 'Server terugkoppeling');

// --== ALLE GEBRUIKERS GERELATEERDE PAGINAS ==--
define( '_METHOD', 'Methode');

// --== PENDING PAGE ==--
define( '_PEND_DATE', 'In de wachtrij sinds');
define( '_PEND_TITLE', 'Registraties in de wachtrij');
define( '_PEND_DESC', 'Registraties die het proces niet compleet hebben doorlopen. Deze status is normaal voor een korte tijd dat het systeem wacht op de betaling.');
define( '_ACTIVATE', 'Activeren');
define( '_ACTIVATED', 'Gebruiker geactiveerd.');

// --== EXPORT ==--
define( '_AEC_HEAD_EXPORT', 'Export');
define( '_EXPORT_LOAD', 'Load');
define( '_EXPORT_APPLY', 'Apply');
define( '_EXPORT_GENERAL_SELECTED_EXPORT_NAME', 'Export Preset');
define( '_EXPORT_GENERAL_SELECTED_EXPORT_DESC', 'Select a preset (or an automatically saved previous export) instead of making the selections below. You can also click apply on the upper right and preview the preset.');
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