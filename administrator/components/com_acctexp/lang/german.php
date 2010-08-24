<?php
/**
 * @version $Id: german.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Language - Backend - German Formal
 * @copyright 2006-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direkter Zugang zu diesem Ort ist nicht erlaubt.' );

define( '_AEC_LANGUAGE',						'de' );
define( '_COUPON_CODE',							'Gutscheincode' );
define( '_CFG_GENERAL_CUSTOMNOTALLOWED_NAME',	'Link zur Nichterlaubtseite:' );

// hacks/install >> ATTENTION: MUST BE HERE AT THIS POSITION, needed later!
define( '_AEC_SPEC_MENU_ENTRY',					'Mein Abonnement' );

// common
define( '_DESCRIPTION_PAYSIGNET',				'Zahlungen mit allen g&auml;ngigen Kreditkarten und Bank&uuml;berweisung' );
define( '_AEC_CONFIG_SAVED',					'Konfiguration erfolgreich gesichert' );
define( '_AEC_CONFIG_CANCELLED',				'Konfiguration abgebrochen' );
define( '_AEC_TIP_NO_GROUP_PF_PB',				'Weder "Public Frontend" noch "Public Backend" sind w&auml;hlbare Benutzergruppen!' );
define( '_AEC_CGF_LINK_ABO_FRONTEND',			'Direkter Link zum Abo' );
define( '_AEC_CGF_LINK_CART_FRONTEND',			'Direkter Link f&uuml;r das Hinzuf&uuml;gen zum Einkaufswagen' );
define( '_AEC_NOT_SET',							'Nein' );
define( '_AEC_COUPON',							'Gutschein' );
define( '_AEC_CMN_NEW',							'Neu' );
define( '_AEC_CMN_CLICK_TO_EDIT',				'Klicken zum Bearbeiten' );
define( '_AEC_CMN_LIFETIME',					'Lebenslang' );
define( '_AEC_CMN_UNKOWN',						'Unbekannt' );
define( '_AEC_CMN_EDIT_CANCELLED',				'Bearbeitung abgebrochen' );
define( '_AEC_CMN_PUBLISHED',					'Ver&ouml;ffentlicht' );
define( '_AEC_CMN_NOT_PUBLISHED',				'Nicht Ver&ouml;ffentlicht' );
define( '_AEC_CMN_CLICK_TO_CHANGE',				'Auf Icon klicken, um Status zu &auml;ndern' );
define( '_AEC_CMN_NONE_SELECTED',				'&gt;&gt;&nbsp;Keine Auswahl&nbsp;&lt;&lt;' );
define( '_AEC_CMN_MADE_VISIBLE',				'sichtbar gemacht' );
define( '_AEC_CMN_MADE_INVISIBLE',				'unsichtbar gemacht' );
define( '_AEC_CMN_TOPUBLISH',					'zu ver&ouml;ffentlichen' );
define( '_AEC_CMN_TOUNPUBLISH',					'nicht zu ver&ouml;ffentlichen' );
define( '_AEC_CMN_FILE_SAVED',					'Datei gesichert' );
define( '_AEC_CMN_ID',							'ID' );
define( '_AEC_CMN_DATE',						'Datum' );
define( '_AEC_CMN_EVENT',						'Ereignis' );
define( '_AEC_CMN_TAGS',						'Kennzeichen' );
define( '_AEC_CMN_ACTION',						'Aktion' );
define( '_AEC_CMN_PARAMETER',					'Parameter' );
define( '_AEC_CMN_NONE',						'Keine' );
define( '_AEC_CMN_WRITEABLE',					'Beschreibbar' );
define( '_AEC_CMN_UNWRITEABLE',					'Nicht beschreibbar!' );
define( '_AEC_CMN_UNWRITE_AFTER_SAVE',			'Nach dem Sichern als nicht beschreibbar kennzeichnen' );
define( '_AEC_CMN_OVERRIDE_WRITE_PROT',			'Schreibschutz zum Sichern deaktivieren' );
define( '_AEC_CMN_NOT_SET',						'Nicht gesetzt' );
define( '_AEC_CMN_SEARCH',						'Suche' );
define( '_AEC_CMN_APPLY',						'Anwenden' );
define( '_AEC_CMN_STATUS',						'Status' );
define( '_AEC_FEATURE_NOT_ACTIVE',				'Dieses Feature ist noch nicht aktiv' );
define( '_AEC_CMN_YES',							'Ja' );
define( '_AEC_CMN_NO',							'Nein' );
define( '_AEC_CMN_INHERIT',						'Vererben' );
define( '_AEC_CMN_LANG_CONSTANT_IS_MISSING',	'Sprachenkonstante <strong>%s</strong> fehlt' );
define( '_AEC_CMN_VISIBLE',						'Sichtbar' );
define( '_AEC_CMN_INVISIBLE',					'Unsichtbar' );
define( '_AEC_CMN_EXCLUDED',					'Ausgenommen' );
define( '_AEC_CMN_PENDING',						'Schwebend' );
define( '_AEC_CMN_ACTIVE',						'Aktiv' );
define( '_AEC_CMN_TRIAL',						'Testzeit' );
define( '_AEC_CMN_CANCEL',						'Abgebrochen/Storniert' );
define( '_AEC_CMN_HOLD',						'Halt' );
define( '_AEC_CMN_EXPIRED',						'Abgelaufen' );
define( '_AEC_CMN_CLOSED',						'Geschlossen' );

// user(info)
define( '_AEC_USER_USER_INFO',					'Benutzerinfos' );
define( '_AEC_USER_USERID',						'Benutzer-ID' );
define( '_AEC_USER_STATUS',						'Status' );
define( '_AEC_USER_ACTIVE',						'Aktiv' );
define( '_AEC_USER_BLOCKED',					'Geblockt' );
define( '_AEC_USER_ACTIVE_LINK',				'Aktivierungslink' );
define( '_AEC_USER_PROFILE',					'Profil' );
define( '_AEC_USER_PROFILE_LINK',				'Profil ansehen' );
define( '_AEC_USER_USERNAME',					'Benutzername' );
define( '_AEC_USER_NAME',						'Name' );
define( '_AEC_USER_EMAIL',						'Email' );
define( '_AEC_USER_SEND_MAIL',					'Email senden' );
define( '_AEC_USER_TYPE',						'Benutzertyp' );
define( '_AEC_USER_REGISTERED',					'Registriert' );
define( '_AEC_USER_LAST_VISIT',					'Letzter Besuch' );
define( '_AEC_USER_EXPIRATION',					'Ablaufdatum' );
define( '_AEC_USER_CURR_EXPIRE_DATE',			'Aktuelles Ablaufdatum' );
define( '_AEC_USER_LIFETIME',					'Lebenslang' );
define( '_AEC_USER_RESET_EXP_DATE',				'Ablaufdatum &auml;ndern' );
define( '_AEC_USER_RESET_STATUS',				'Status &auml;ndern' );
define( '_AEC_USER_SUBSCRIPTION',				'Abonnement' );
define( '_AEC_USER_PAYMENT_PROC',				'Zahlungsabwicklung' );
define( '_AEC_USER_CURR_SUBSCR_PLAN',			'Aktuelles Abo' );
define( '_AEC_USER_PREV_SUBSCR_PLAN',			'Voriges Abo' );
define( '_AEC_USER_USED_PLANS',					'Bisherige Abos' );
define( '_AEC_USER_NO_PREV_PLANS',				'Bisher keine Abos' );
define( '_AEC_USER_ASSIGN_TO_PLAN',				'Abo zuweisen' );
define( '_AEC_USER_TIME',						'Mal' );
define( '_AEC_USER_TIMES',						'Male' );
define( '_AEC_USER_INVOICES',					'Rechnungen' );
define( '_AEC_USER_NO_INVOICES',				'Keine Rechnungen bisher' );
define( '_AEC_USER_INVOICE_FACTORY',			'Rechnungserstellung' );
define( '_AEC_USER_ALL_SUBSCRIPTIONS',			'Alle Abos dieses Benutzers' );
define( '_AEC_USER_ALL_SUBSCRIPTIONS_NOPE',	'Dies ist das einzige Abo, welches dieser Benutzer derzeit besitzt.' );
define( '_AEC_USER_SUBSCRIPTIONS_ID',			'ID' );
define( '_AEC_USER_SUBSCRIPTIONS_STATUS',		'Status' );
define( '_AEC_USER_SUBSCRIPTIONS_PROCESSOR',	'Bezahldienst' );
define( '_AEC_USER_SUBSCRIPTIONS_SINGUP',		'Registrierung' );
define( '_AEC_USER_SUBSCRIPTIONS_EXPIRATION',	'Ablaufdatum' );
define( '_AEC_USER_SUBSCRIPTIONS_PRIMARY',		'prim&auml;r' );
define( '_AEC_USER_CURR_SUBSCR_PLAN_PRIMARY',	'Prim&auml;r' );
define( '_AEC_USER_COUPONS',					'Gutscheine' );
define( '_HISTORY_COL_COUPON_CODE',				'Gutschein-Code' );
define( '_AEC_USER_NO_COUPONS',					'Keine Gutscheinbenutzung erfasst' );
define( '_AEC_USER_MICRO_INTEGRATION',			'Micro Integration Info' );
define( '_AEC_USER_MICRO_INTEGRATION_USER',		'Frontend' );
define( '_AEC_USER_MICRO_INTEGRATION_ADMIN',	'Backend' );
define( '_AEC_USER_MICRO_INTEGRATION_DB',		'Database Readout' );

// new (additional)
define( '_AEC_MSG_MIS_NOT_DEFINED',				'Es wurden noch keine MicroIntegrationen definiert - siehe Konfiguration' );

// headers
define( '_AEC_HEAD_SETTINGS',					'Einstellungen' );
define( '_AEC_HEAD_HACKS',						'Modifikationen' );
define( '_AEC_HEAD_PLAN_INFO',					'Plan Info' );
define( '_AEC_HEAD_LOG',						'Logdatei' );
define( '_AEC_HEAD_CSS_EDITOR',					'CSS Editor' );
define( '_AEC_HEAD_MICRO_INTEGRATION',			'MicroIntegration' );
define( '_AEC_HEAD_ACTIVE_SUBS',				'Aktive Abonnenten' );
define( '_AEC_HEAD_EXCLUDED_SUBS',				'Ausgenommene Benutzer' );
define( '_AEC_HEAD_EXPIRED_SUBS',				'Abgelaufene Abonnenten' );
define( '_AEC_HEAD_PENDING_SUBS',				'Wartende Abonnenten' );
define( '_AEC_HEAD_CANCELLED_SUBS',				'Stornierte Abonnenten' );
define( '_AEC_HEAD_HOLD_SUBS',					'Angehaltene Abonnenten' );
define( '_AEC_HEAD_CLOSED_SUBS',				'Abgeschlossene Abonnenten' );
define( '_AEC_HEAD_MANUAL_SUBS',				'Manuelle Abonnenten' );
define( '_AEC_HEAD_SUBCRIBER',					'Abonnent' );

// hacks (special)
define( '_AEC_HACK_HACK',						'&Auml;nderung' );
define( '_AEC_HACKS_ISHACKED',					'Ge&auml;ndert' );
define( '_AEC_HACKS_NOTHACKED',					'Noch nicht ge&auml;ndert!' );
define( '_AEC_HACKS_UNDO',						'Originalzustand wiederherstellen' );
define( '_AEC_HACKS_COMMIT',					'Jetzt durchf&uuml;hren' );
define( '_AEC_HACKS_FILE',						'Datei' );
define( '_AEC_HACKS_LOOKS_FOR',					'Diese &Auml;nderung sucht nach' );
define( '_AEC_HACKS_REPLACE_WITH',				'... und ersetzt es mit' );

define( '_AEC_HACKS_NOTICE',					'Wichtiger Hinweis' );
define( '_AEC_HACKS_NOTICE_DESC',				'Aus Sicherheitsgr&uuml;nden und damit AEC funktionieren kann, sind nachfolgende &Auml;nderungen notwendig.<br />Diese k&ouml;nnen entweder automatisch durchgef&uuml;hrt werden (auf den Best&auml;tigungslink klicken) oder manuell (bearbeiten der php.Dateien).<br />Damit die Benutzer zu pers&ouml;nlichen Abo&uuml;bericht kommen, muss auch die Benutzerlink&auml;nderung durchgef&uuml;hrt werden.' );
define( '_AEC_HACKS_NOTICE_DESC2',				'<strong>Alle wichtigen Funktions&auml;nderungen sind mit einem Pfeil und Ausrufzeichen markiert!</strong>' );
define( '_AEC_HACKS_NOTICE_DESC3',				'Die nachfolgenden Anzeigen sind <strong>nicht</strong> lt. der Nummerierung (#1, #3, #6, usw.) erforderlich.<br />Falls keine Nummer dabei steht, sind das wahrscheinlich veraltete (fr&uuml;here) &Auml;nderungen welche korrigiert werden m&uuml;ssen.' );
define( '_AEC_HACKS_NOTICE_JACL',				'JACL Anmerkung' );
define( '_AEC_HACKS_NOTICE_JACL_DESC',			'Falls geplant ist Erweiterungen wie JACL-Plus zu installieren (welche ebenfalls Dateien &auml;ndern), <strong>m&uuml;ssen die AEC-&Auml;nderungen danach durchgef&uuml;hrt werden!</strong>' );

define( '_AEC_HACKS_MENU_ENTRY',				'Men&uuml;eintrag' );
define( '_AEC_HACKS_MENU_ENTRY_DESC',			'F&uuml;gt dem Benutzermen&uuml; den neuen Eintrag <strong>' . _AEC_SPEC_MENU_ENTRY . '</strong> hinzu.<br />Damit kann dieser Benutzer sowohl die bisherigen Abos und Rechnungen, als auch neue/andere Abos bestellen/erneuern.' );
define( '_AEC_HACKS_LEGACY',					'<strong>Das ist eine veraltete Version, bitte l&ouml;schen oder aktualisieren!</strong>' );
define( '_AEC_HACKS_LEGACY_MAMBOT',				'<strong>Dies ist ein Legacy Hack, der durch den Joomla 1.0 Mambot ersetzt wird, bitte l&ouml;schen und stattdessen den "Hacks Mambot" benutzen!</strong>' );
define( '_AEC_HACKS_LEGACY_PLUGIN',				'<strong>Dies ist ein Legacy Hack, der durch das Joomla 1.5 Plugin ersetzt wird, bitte l&ouml;schen und stattdessen das Plugin benutzen!</strong>' );
define( '_AEC_HACKS_LEGACY_PLUGIN_ERROR',		'<strong>Dies ist ein Legacy Hack, der durch das Joomla 1.5 Error Plugin ersetzt wird, bitte l&ouml;schen und stattdessen das AEC Error Plugin benutzen!</strong>' );
define( '_AEC_HACKS_LEGACY_PLUGIN_USER',		'<strong>Dies ist ein Legacy Hack, der durch das Joomla 1.5 User Plugin ersetzt wird, bitte l&ouml;schen und stattdessen das AEC User Plugin benutzen!</strong>' );
define( '_AEC_HACKS_LEGACY_PLUGIN_ACCESS',		'<strong>Dies ist ein Legacy Hack, der durch das Joomla 1.5 Access Plugin ersetzt wird, bitte l&ouml;schen und stattdessen das AEC Access Plugin benutzen!</strong>' );
define( '_AEC_HACKS_NOTAUTH',					'Diese &Auml;nderung korrigiert den Link - falls keine Berechtigung zum Ansehen vorliegt - zur Aboseite.' );
define( '_AEC_HACKS_SUB_REQUIRED',				'&Uuml;berpr&uuml;ft das Vorhandensein eines g&uuml;ltigen Abos zum einloggen<br /><strong>Nicht vergessen in der AEC-Konfiguration die Einstellung [ Ben&ouml;tigt Abo ] zu aktivieren!</strong>' );
define( '_AEC_HACKS_REG2',						'Diese &Auml;nderung leitet den Benutzer zur Abo&uuml;bersicht weiter <strong>nachdem er sich registriert hat</strong>.<br />Falls vor der Registrierung die Aboauswahl zur Auswahl angezeigt werden soll, gen&uuml;gt diese &Auml;nderung (AEC-Konfiguration [ Ben&ouml;tigt Abo ] muss dann aktiviert sein), andernfalls <strong>sind noch 2 weitere &Auml;nderungen durchzuf&uuml;hren!</strong><br />Falls die Aboauswahl <strong>vor</strong> den Benutzerdetails angezeigt werden soll, m&uuml;ssen alle 3 &Auml;nderungen durchgef&uuml;hrt werden.' );
define( '_AEC_HACKS_REG3',						'Leitet den Benutzer direkt zur Abo&uuml;bersicht um falls vorher noch keine Wahl getroffen wurde' );
define( '_AEC_HACKS_REG4',						'&Uml;bermittelt die AEC-Daten aus dem Anmeldeforumlar' );
define( '_AEC_HACKS_REG5',						'Mit diesem Hack k&ouml;nnen sie das "Bezahlpl&auml;ne zuerst"-Feature benutzen. Nicht vergessen in den AEC Einstellungen den Schalter hierf&uuml;r zu setzen!' );
define( '_AEC_HACKS_MI1',						'Einige MicroIntegrationen ben&ouml;tigen Klartextdaten.<br />Diese &Auml;nderung stellt sicher, dass die Integrationen die Benutzerdaten bei &Auml;nderung erhalten.' );
define( '_AEC_HACKS_MI2',						'Einige MicroIntegrationen ben&ouml;tigen Klartextdaten.<br />Diese &Auml;nderung &uuml;bermittelt die Benutzerdaten nach der Registrierung' );
define( '_AEC_HACKS_MI3',						'Einige MicroIntegrationen ben&ouml;tigen Klartextdaten.<br />Diese &Auml;nderung stellt sicher, dass bei Benutzerdaten&auml;nderung durch einen Admin diese weitergeleitet werden.' );
define( '_AEC_HACKS_CB2',						'Leitet den Besucher nach der Registrierung in CB (Community Builder) zur Abonnementauswahl weiter.<br />Nur diese &Auml;nderung bewirkt, da&szlig; ein Abo beim Login ausgew&auml;hlt werden muss, anderenfalls sind noch 2 weitere A&uml;nderungen notwendig.<br /><strong>Soll vor dem Abschluss der Benutzerdetails (zur Registrierung) ein Abo ausgew&auml;hlt werden, sind alle 3 &Auml;nderungen erforderlich!</strong>' );
define( '_AEC_HACKS_CB6',						'Leitet den Besucher zur Aboauwahl weiter wenn keine Auswahl bisher getroffen wurde.' );
define( '_AEC_HACKS_CB_HTML2',					'Leitet die Benutzerdetails intern an AEC weiter.<br /><strong>Um diese &Auml;nderung wirksam werden zu lassen, muss in der AEC-Konfiguarion die Einstellung "Abo Zuerst" aktiviert werden</strong>' );
define( '_AEC_HACKS_UHP2',						'UHP2 Men&uuml;eintrag' );
define( '_AEC_HACKS_UHP2_DESC',					'F&uuml;gt dem UHP2 Men&uuml; den Eintrag <strong>' . _AEC_SPEC_MENU_ENTRY . '</strong> hinzu. Damit k&ouml;nnen diese Benutzer ihre Abos und Rechnungen verwalten' );
define( '_AEC_HACKS_CBM',						'Wenn das Comprofiler Moderator Modul verwendet wird, muss diese &auml;nderung durchgef&uuml;hrt werden um eine Endlosschleife zu vermeiden!' );

define( '_AEC_HACKS_JUSER_HTML1',				'Leitet einen registrierenden Benutzer zu den Bezahlpl&auml;nen weiter nach dem Ausf&uuml;llen des Registrierungsformulars in JUser. Lassen Sie diese Option wie sie ist um Benutzer das Abonnement erst beim n&auml;chsten Login (wenn \'Require Subscription\' aktiv ist), oder komplett freiwillig (ohne notwendige Registrierung) zu erstellen. <strong>Bitte beachten Sie, dass es zwei Modifikationen gibt, die diesem folgen, wenn man es einmal festgelegt hat! Wenn Sie die Pl&auml;ne vor den Benutzerdetails haben m&ouml;chten, braucht man diese ebenfalls.</strong>' );
define( '_AEC_HACKS_JUSER_PHP1',				'Der Benutzer wird zu den Bezahlpl&auml;nen weitergeleitet, wenn er diese Auswahl noch nicht getroffen hat.' );
define( '_AEC_HACKS_JUSER_PHP2',				'Das ist ein bugfix, der es AEC erlaubt, die JUser Funktionen zu laden, ohne dass es auf die POST data reagieren muss.' );

// log
	// settings
define( '_AEC_LOG_SH_SETT_SAVED',				'&Auml;nderung Einstellungen' );
define( '_AEC_LOG_LO_SETT_SAVED',				'AEC Einstellungen wurden gesichert, &Auml;nderungen:' );
	// heartbeat
define( '_AEC_LOG_SH_HEARTBEAT',				'Heartbeat' );
define( '_AEC_LOG_LO_HEARTBEAT',				'Heartbeataktion:' );
define( '_AEC_LOG_AD_HEARTBEAT_DO_NOTHING',		'keine' );
	// install
define( '_AEC_LOG_SH_INST',						'AEC Installation' );
define( '_AEC_LOG_LO_INST',						'AEC Version %s wurde installiert' );

// install texts
define( '_AEC_INST_NOTE_IMPORTANT',				'Wichtiger Hinweis' );
define( '_AEC_INST_NOTE_SECURITY',				'F&uuml;r die Integration mit manchen anderen Komponenten es notwendig einige &Auml;nderungen an deren Dateien zu machen.<br />Mit dieser Version von AEC wird eine Funktion mitgeliefert die exakt diese Aufgabe &uuml;bernimmt, daf&uuml;r bitte auf den nachfolgenden Link klicken' );
define( '_AEC_INST_APPLY_HACKS',				'Um die erforderlichen &Auml;nderungen durchzuf&uuml;hren bitte %s<br />Dieser Link kann auch sp&auml;ter jederzeit aufgerufen werden - siehe AEC Verwaltung' );
define( '_AEC_INST_APPLY_HACKS_LTEXT',			'hier klicken' );
define( '_AEC_INST_NOTE_UPGRADE',				'<strong>Falls ein bestehendes AEC upgedated werden soll, bitte auf alle F&auml;lle das Men&uuml; "Hacks" aufrufen - es gibt immer wieder neue &Auml;nderungen</strong>' );
define( '_AEC_INST_NOTE_HELP',					'Um die wichtigsten Antworten auf Fragen bereit zu haben, kann jederzeit die interne %s aufgerufen werden (Aufruf auch von der AEC-Verwaltung aus). Dort stehen auch weitere Tips zur nachfolgenden Einrichtung von AEC' );
define( '_AEC_INST_NOTE_HELP_LTEXT',			'Hilfe' );
define( '_AEC_INST_HINTS',						'Hinweise' );
define( '_AEC_INST_HINT1',						'Bitte besuchen Sie auch unser <a href="%s" target="_blank">Forum</a>. Neben Diskussionen k&ouml;nnen auch weitere Tips, Anregungen usw. dort nachgelesen werden' );
define( '_AEC_INST_HINT2',						'Auf alle F&auml;lle (und ganz speziell wenn AEC auf einer Liveseite eingesetzt wird), in Ruhe alle Einstellungen durchgehen, einen Testzugang f&uuml;r die diversen Bezahl-Bezahldienste anlegen und diese ausgiebig testen!' );
define( '_AEC_INST_ATTENTION',					'Immer die aktuellsten Programme von und f&uuml;r AEC einsetzen' );
define( '_AEC_INST_ATTENTION1',					'Falls noch &auml;ltere AEC-Loginmodule in Verwendung sind, bitte deinstallieren und gegen die regul&auml;ren austauschen (egal ob Joomla, Mambo, CB, etc.)' );
define( '_AEC_INST_MAIN_COMP_ENTRY',			'AEC Abo Verwaltung' );
define( '_AEC_INST_ERRORS',						'<strong>Achtung</strong><br />leider traten w&auml;hrend der Installation folgende Fehler auf - AEC konnte <strong>nicht</strong>vollst&auml;ndig installiert werden:<br />' );

define( '_AEC_INST_ROOT_GROUP_NAME',			'Stamm' );
define( '_AEC_INST_ROOT_GROUP_DESC',			'Stammgruppe. Dieser Eintrag kann nicht gel&ouml;scht werden, &Auml;nderung ist begrenzt.' );

// help
define( '_AEC_CMN_HELP',						'Hilfe' );
define( '_AEC_HELP_DESC',						'Auf dieser Seite &uuml;berpr&uuml;ft AEC die bestehende Konfiguration und zeigt eventuelle Fehler an welche bereinigt werden sollten' );
define( '_AEC_HELP_GREEN',						'Gr&uuml;n</strong> bedeutet Mitteilungen oder Probleme die bereits gel&ouml;st wurden' );
define( '_AEC_HELP_YELLOW',						'Gelb</strong> weist haupts&auml;chlich auf kosmetische Punkte hin (z.B. Benutzerlink zum Frontent hinzuf&uuml;gen), aber auch Punkte die im Ermessen des Admin liegen' );
define( '_AEC_HELP_RED',						'Rot</strong> weist auf Probleme bez&uuml;glich Sicherheit oder anderer Wichtigkeit hin' );
define( '_AEC_HELP_GEN',						'Hinweis: es wird versucht so viel wie m&ouml;glich zu &uuml;berpr&uuml;fen, dennoch besteht kein Anspruch auf Vollst&auml;ndigkeit!' );
define( '_AEC_HELP_QS_HEADER',					'AEC Schnellstart Handbuch' );
define( '_AEC_HELP_QS_DESC',					'Bevor mit den unten angef&uuml;hrten Aktionen fortgefahren wird, sollte vorher das %s gelesen werden!' );
define( '_AEC_HELP_QS_DESC_LTEXT',				'Schnellstart Handbuch' );
define( '_AEC_HELP_SER_SW_DIAG1',				'Dateirechteproblem' );
define( '_AEC_HELP_SER_SW_DIAG1_DESC',			'AEC hat den Server als Apache Webserver identifiziert. Um &Auml;nderungen an diesen Dateien durchf&uuml;hren zu k&ouml;nnen, m&uuml;ssen diese dem Webserverbenutzer geh&ouml;ren was momentan offensichtlich nicht so ist.' );
define( '_AEC_HELP_SER_SW_DIAG1_DESC2',			'Es wird empfohlen f&uuml;r die Dauer der &Auml;nderungen die Dateirechte auf 0777 zu &auml;ndern. Nach Durchf&uuml;hrung der &Anderung m&uuml;ssen diese Rechte wieder auf den Originalzustand zur&uuml;ckgesetzt werden!<br />Dies gilt auch f&uuml;r die weiter unten erw&auml;hnten Dateirechte.' );
define( '_AEC_HELP_SER_SW_DIAG2',				'CMS Dateirechte' );
define( '_AEC_HELP_SER_SW_DIAG2_DESC',			'AEC hat erkannt, dass dieses CMS nicht die Rechte des Webservers besitzt.' );
define( '_AEC_HELP_SER_SW_DIAG2_DESC2',			'Wenn ein SSH-Zugang zum Server vorhanden ist, in das Verzeichnis "<cmsinstallation/includes>" und geben dann entweder "chown wwwrun joomla.php" (oder "chown wwwrun mambo.php" - falls Mambo verwendet wird) eingeben.' );
define( '_AEC_HELP_SER_SW_DIAG3',				'Veraltete &Auml;nderungen erkannt' );
define( '_AEC_HELP_SER_SW_DIAG3_DESC',			'Es sieht so aus als wenn wenigstens eine &Auml;nderung nicht aktuell ist!<br />Damit AEC ordnungsgem&auml;ss funktionieren kann, m&uuml;ssen fr&uuml;her gemachte, veraltete &Auml;nderungen wieder aus den Dateien entfernt werden. Dazu entweder den Abschnitt mit der neuen (ge&auml;nderten) Funktion &uuml;ber die Hacks-Seite entfernen, oder die ge&auml;nderte Datei mit der Originaldatei &uuml;berschreiben.' );
define( '_AEC_HELP_SER_SW_DIAG4',				'Dateirechte Probleme' );
define( '_AEC_HELP_SER_SW_DIAG4_DESC',			'AEC kann die Schreibrechte der Dateien welche ge&auml;ndert werden m&uuml;ssen nicht erkennen. Entweder ist das hier ein WINDOWS-Server oder der Apacheserver wurde mit der Option "--disable-posix" kompiliert.<br /><strong>Sollten die &Auml;nderungen durchgef&uuml;hrt werden, dann jedoch nicht funktionieren liegt das Problem bei den Dateirechten</strong>' );
define( '_AEC_HELP_SER_SW_DIAG4_DESC2',			'Es wird empfohlen entweder den Server mit der erw&auml;hnten Option zu kompilieren (Apache) oder den Admin zu kontaktieren' );
define( '_AEC_HELP_DIAG_CMN1',					'CMS &Auml;nderungen' );
define( '_AEC_HELP_DIAG_CMN1_DESC',				'Notwendig damit die Benutzer nach dem Login von AEC &uuml;berpr&uuml;ft werden k&ouml;nnen' );
define( '_AEC_HELP_DIAG_CMN1_DESC2',			'Zur Modifikations-Seite gehen und &Auml;nderung durchf&uuml;hren' );
define( '_AEC_HELP_DIAG_CMN2',					'Meine Abos - Men&uuml;eintrag' );
define( '_AEC_HELP_DIAG_CMN2_DESC',				'Ein Link der die Benutzer zu ihren eigenen Abonnements f&uuml;hrt' );
define( '_AEC_HELP_DIAG_CMN2_DESC2',			'Zur Modifikations-Seite gehen und Link erstellen' );
define( '_AEC_HELP_DIAG_CMN3',					'JACL nicht installiert' );
define( '_AEC_HELP_DIAG_CMN3_DESC',				'Sollte geplant sein, JACLPlus (oder &auml;hnliches) zu installieren, muss auf die AEC-&Auml;nderungen R&uuml;cksicht genommen werden! Sollten diese &Auml;nderungen bereits durchgef&uuml;hrt worden sein, kann dies auf der Hacks-Seite ge&auml;ndert werden' );
define( '_AEC_HELP_DIAG_NO_PAY_PLAN',			'Kein aktives Abonnement vorhanden!' );
define( '_AEC_HELP_DIAG_NO_PAY_PLAN_DESC',		'Entweder wurde noch kein Abonnement definiert oder es wurde vergessen ein Vorhandes zu aktivieren - AEC ben&ouml;nigt mindestens ein aktives Abo' );
define( '_AEC_HELP_DIAG_GLOBAL_PLAN',			'Generelles Abonnement' );
define( '_AEC_HELP_DIAG_GLOBAL_PLAN_DESC',		'In der AEC-Konfiguration wurde ein Abo als globales Einstiegsabo definiert welches jeder neue Abonnent automatisch ohne Wahl zugewiesen bekommt.<br />Falls das nicht so sein soll, muss dieses Abo in der Konfiguration deaktiviert werden' );
define( '_AEC_HELP_DIAG_SERVER_NOT_REACHABLE',	'Server nicht erreichbar' );
define( '_AEC_HELP_DIAG_SERVER_NOT_REACHABLE_DESC',	'Es sieht so aus, als ob der Server momentan nicht erreichbar ist!<br />Entweder wurde AEC lokal installiert oder die Verbindung zum Server ist unterbrochen. Um jedoch alle AEC-Funktionen und Zahlungsbenachrichtigungen ausf&uuml;hren zu k&ouml;nnen, muss AEC auf einem erreichbarem Server installiert sein!' );
define( '_AEC_HELP_DIAG_SITE_OFFLINE',			'Webseite ist Offline' );
define( '_AEC_HELP_DIAG_SITE_OFFLINE_DESC',		'Die Webseite ist momentan <strong>OFFLINE</strong> geschaltet. Dies kann einen Einflu&szlig; auf die Zahlungen und Benachrichtigungen dazu haben!' );
define( '_AEC_HELP_DIAG_REG_DISABLED',			'Benutzerregistrierung abgeschaltet' );
define( '_AEC_HELP_DIAG_REG_DISABLED_DESC',		'Die Benutzerregistrierung ist abgeschaltet. Dadurch k&ouml;nnen sich keine neuen Abonnenten einschreiben bzw. Besucher registrieren' );
define( '_AEC_HELP_DIAG_LOGIN_DISABLED',		'Benutzerlogin abgeschaltet' );
define( '_AEC_HELP_DIAG_LOGIN_DISABLED_DESC',	'Der Benutzerlogin im Frontend ist abgeschaltet! Dadurch kann keiner der Abonnenten die Webseite betreten' );
define( '_AEC_HELP_DIAG_PAYPAL_BUSS_ID',		'PayPal &Uuml;berpr&uuml;fung Gesch&auml;fts-ID' );
define( '_AEC_HELP_DIAG_PAYPAL_BUSS_ID_DESC',	'Diese Funktion &uuml;berpr&uuml;ft die vorhandene PayPal-ID auf erweiterte Sicherheit bei Transaktionen' );
define( '_AEC_HELP_DIAG_PAYPAL_BUSS_ID_DESC1',	'Falls PayPal-Zahlungen eintreffen sollten, die Abonnenten jedoch nicht automatisch aktiviert werden, ist diese Einstellung in der AEC-Konfiguration abzuschalten.<br />Ebenfalls deaktivieren, wenn mehrere PayPal-Emailadressen in Verwendung sind!' );

// micro integration
	// general
define( '_AEC_MI_REWRITING_INFO',				'Vorlagen Platzhalter' );
define( '_AEC_MI_SET1_INAME',					'Abonnement auf %s - Benutzer: %s (%s)' );
	// htaccess
define( '_AEC_MI_HTACCESS_INFO_DESC',			'Sch&uuml;tzt ein Verzeichnis mit einer .htaccess Datei und erlaubt den Zugriff nur Benutzern dieses Abos' );
	// email
define( '_AEC_MI_EMAIL_INFO_DESC',				'Sended an eine oder mehrere Adressen den Status des Abos' );
	// idev
define( '_AEC_MI_IDEV_DESC',					'Verbindet den Verkauf mit iDevAffiliate' );
	// mosetstree
define( '_AEC_MI_MOSETSTREE_DESC',				'Beschr&auml;nkt die Anzahl der anzuzeigenden Links die ein Benutzer ver&ouml;ffentlichen kann' );
	// mysql-query
define( '_AEC_MI_MYSQL_DESC',					'Spezifiziert einen My-SQL-String welcher bei Abo-Beginn/Beendigung ausgef&uuml;hrt wird' );
	// remository
define( '_AEC_MI_REMOSITORY_DESC',				'Definiert die max. Dateianzahl die ein Benutzer in reMOSitory downloaden kann' );
	// VirtueMart
define( '_AEC_MI_VIRTUEMART_DESC',				'Definiert die VirtueMart-Benutzergruppe welcher der Benutzer angeh&ouml;hren soll' );

// central
define( '_AEC_CENTR_CENTRAL',					'AEC Zentrale' );
define( '_AEC_CENTR_EXCLUDED',					'Ausgeschlossen' );
define( '_AEC_CENTR_PLANS',						'Abos' );
define( '_AEC_CENTR_PENDING',					'Wartend' );
define( '_AEC_CENTR_ACTIVE',					'Aktiv' );
define( '_AEC_CENTR_EXPIRED',					'Abgelaufen' );
define( '_AEC_CENTR_CANCELLED',					'Stornos' );
define( '_AEC_CENTR_HOLD',						'Gehalten' );
define( '_AEC_CENTR_CLOSED',					'Beendet' );
define( '_AEC_CENTR_PROCESSORS',				'Bezahlpl&auml;ne' );
define( '_AEC_CENTR_SETTINGS',					'Einstellungen' );
define( '_AEC_CENTR_EDIT_CSS',					'CSS Bearbeiten' );
define( '_AEC_CENTR_V_INVOICES',				'Rechnungen' );
define( '_AEC_CENTR_COUPONS',					'Gutscheine' );
define( '_AEC_CENTR_COUPONS_STATIC',			'Feste Gutscheine' );
define( '_AEC_CENTR_VIEW_HISTORY',				'Archiv' );
define( '_AEC_CENTR_HACKS',						'Modifikationen' );
define( '_AEC_CENTR_M_INTEGRATION',				'MicroIntegration' );
define( '_AEC_CENTR_HELP',						'Hilfe' );
define( '_AEC_CENTR_LOG',						'Logdatei' );
define( '_AEC_CENTR_MANUAL',					'Manuell' );
define( '_AEC_CENTR_EXPORT',					'Export' );
define( '_AEC_CENTR_IMPORT',					'Import' );
define( '_AEC_CENTR_GROUPS',					'Gruppen' );
define( '_AEC_CENTR_AREA_MEMBERSHIPS',			'Abonnements' );
define( '_AEC_CENTR_AREA_PAYMENT',				'Bezahlung &amp; zugeh&ouml;rige Funktionen' );
define( '_AEC_CENTR_AREA_SETTINGS',				'Einstellungen, Logbuch &amp; weitere Funktionen' );
define( '_AEC_QUICKSEARCH',						'Schnellsuche' );
define( '_AEC_QUICKSEARCH_DESC',				'Geben sie den Namen, Benutzernamen, Email Addresse, die Benutzer ID oder eine Rechnungsnummer ein um direkt zum Konto eines Benutzers weitergeleitet zu werden. Sollten mehrere Benutzer gefunden werden, so wird unten eine Auswahl angezeigt.' );
define( '_AEC_QUICKSEARCH_MULTIRES',			'Mehrere Benutzer gefunden!' );
define( '_AEC_QUICKSEARCH_MULTIRES_DESC',		'Bitte w&auml;hlen sie einen Benutzer aus:' );
define( '_AEC_QUICKSEARCH_THANKS',				'Danke - Sie haben eine einfache Funktion sehr gl&uuml;cklick gemacht.' );
define( '_AEC_QUICKSEARCH_NOTFOUND',			'Benutzer nicht gefunden' );

define( '_AEC_NOTICES_FOUND',					'Eventlog Eintr&auml;ge' );
define( '_AEC_NOTICES_FOUND_DESC',				'Die folgenden Eintr&auml;ge im Eventlog erfordern Ihre Aufmerksamkeit. Sie k&ouml;nnen Sie als gelesen markieren, wenn Sie m&ouml;chten, dass sie verschwinden. Sie k&ouml; auch die Arten der Eintr&auml;ge &auml;ndern, die hier erscheinen in den Einstellungen.' );
define( '_AEC_NOTICE_MARK_READ',				'als gelesen markieren' );
define( '_AEC_NOTICE_MARK_ALL_READ',			'Alle Eintr&auml;ge als gelesen markieren' );
define( '_AEC_NOTICE_NUMBER_1',					'Event' );
define( '_AEC_NOTICE_NUMBER_2',					'Event' );
define( '_AEC_NOTICE_NUMBER_8',					'Eintrag' );
define( '_AEC_NOTICE_NUMBER_32',				'Warnung' );
define( '_AEC_NOTICE_NUMBER_128',				'Fehler' );
define( '_AEC_NOTICE_NUMBER_512',				'Keine' );

// select lists
define( '_AEC_SEL_EXCLUDED',					'Ausgeschlossen' );
define( '_AEC_SEL_PENDING',						'Wartend' );
define( '_AEC_SEL_TRIAL',						'Probezeit' );
define( '_AEC_SEL_ACTIVE',						'Aktiv' );
define( '_AEC_SEL_EXPIRED',						'Abgelaufen' );
define( '_AEC_SEL_CLOSED',						'Geschlossen' );
define( '_AEC_SEL_CANCELLED',					'Storniert' );
define( '_AEC_SEL_NOT_CONFIGURED',				'Ni. Konfiguriert / Neu' );

// footer
define( '_AEC_FOOT_TX_CHOOSING',				'Danke dass Sie sich f&uuml;r AEC - Account Expiration Control entschieden haben!' );
define( '_AEC_FOOT_TX_GPL',						'Diese Komponente wurde entwickelt und ver&ouml;ffentlicht unter der <a href="http://www.gnu.org/copyleft/gpl.html" target="_blank" title="GNU/GPL">GNU/GPL</a> von David Deutsch und dem Team von <a href="https://valanx.org" target="_blank" title="valanx.org">valanx.org</a>' );
define( '_AEC_FOOT_TX_SUBSCRIBE',				'Weitere Features, professionelles Service, Updates, Handb&uuml;cher und Online Hilfe, einfach auf den Link oben klicken. Es hilft uns vor allem auch bei der weiteren Entwicklung!' );
define( '_AEC_FOOT_CREDIT',						'Bitte auch die %s lesen' );
define( '_AEC_FOOT_CREDIT_LTEXT',				'Credits' );
define( '_AEC_FOOT_VERSION_CHECK',				'Check auf neue Version' );
define( '_AEC_FOOT_MEMBERSHIP',					'Mitglied werden und Zugang zu Dokumentationen und Support bekommen' );

// alerts
define( '_AEC_ALERT_SELECT_FIRST',				'Bitte vorher eine Auswahl treffen!' );
define( '_AEC_ALERT_SELECT_FIRST_TO',			'Bitte vorher eine Auswahl treffen um' );

// messages
define( '_AEC_MSG_NODELETE_SUPERADMIN',			'Superadministratoren k&ouml;nnen nicht gel&ouml;scht werden!' );
define( '_AEC_MSG_NODELETE_YOURSELF',			'Sich selber l&ouml;schen macht auch keinen Sinn - oder?' );
define( '_AEC_MSG_NODELETE_EXCEPT_SUPERADMIN',	'Nur Superadmins k&ouml;nnen diese Aktion ausf&uuml;hren!' );
define( '_AEC_MSG_SUBS_RENEWED',				'Abonnement(s) erneuert' );
define( '_AEC_MSG_SUBS_ACTIVATED',				'Abonnement(s) aktiviert' );
define( '_AEC_MSG_NO_ITEMS_TO_DELETE',			'Kein(e) Datensatz/-s&auml;tze zum L&ouml;schen vorhanden' );
define( '_AEC_MSG_NO_DEL_W_ACTIVE_SUBSCRIBER',	'Abos mit aktiven Abonnenten k&ouml;nnen nicht ge&l&ouml;scht werden!' );
define( '_AEC_MSG_ITEMS_DELETED',				'Datensatz/-s&auml;tze gel&ouml;scht' );
define( '_AEC_MSG_ITEMS_SUCESSFULLY',			'%s Inhalt(e) erfolgreich' );
define( '_AEC_MSG_SUCESSFULLY_SAVED',			'&Auml;nderungen erfolgreich gespeichert' );
define( '_AEC_MSG_ITEMS_SUCC_PUBLISHED',		'Inhalt(e) erfolgreich ver&ouml;ffentlicht' );
define( '_AEC_MSG_ITEMS_SUCC_UNPUBLISHED',		'Inhalt(e) Ver&ouml;ffentlichung erfolgreich zur&uuml;ckgenommen' );
define( '_AEC_MSG_NO_COUPON_CODE',				'Es muss ein Gutscheincode angegeben werden!' );
define( '_AEC_MSG_OP_FAILED',					'Vorgang fehlgeschlagen, konnte %s nicht &ouml;ffnen' );
define( '_AEC_MSG_OP_FAILED_EMPTY',				'Vorgang fehlgeschlagen, kein Inhalt' );
define( '_AEC_MSG_OP_FAILED_NOT_WRITEABLE',		'Vorgang fehlgeschlagen, Datei nicht beschreibbar' );
define( '_AEC_MSG_OP_FAILED_NO_WRITE',			'Vorgang fehlgeschlagen, Datei kann nicht zum Schreiben ge&ouml;ffnet werden' );
define( '_AEC_MSG_INVOICE_CLEARED',				'Rechnung bereinigt' );

// ISO 3166 Two-Character Country Codes
define( '_AEC_LANG_AD', 'Andorra' );
define( '_AEC_LANG_AE', 'Vereinigte Arabische Emirate' );
define( '_AEC_LANG_AF', 'Afghanistan' );
define( '_AEC_LANG_AG', 'Antigua und Barbuda' );
define( '_AEC_LANG_AI', 'Anguilla' );
define( '_AEC_LANG_AL', 'Albanien' );
define( '_AEC_LANG_AM', 'Armenien' );
define( '_AEC_LANG_AN', 'Niederl&auml;ndische Antillen' );
define( '_AEC_LANG_AO', 'Angola' );
define( '_AEC_LANG_AQ', 'Antarktis' );
define( '_AEC_LANG_AR', 'Argentinien' );
define( '_AEC_LANG_AS', 'Amerikanisch-Samoa' );
define( '_AEC_LANG_AT', '&Ouml;sterreich' );
define( '_AEC_LANG_AU', 'Australien' );
define( '_AEC_LANG_AW', 'Aruba' );
define( '_AEC_LANG_AX', '&#65279;land' );
define( '_AEC_LANG_AZ', 'Aserbaidschan' );
define( '_AEC_LANG_BA', 'Bosnien und Herzegowina' );
define( '_AEC_LANG_BB', 'Barbados' );
define( '_AEC_LANG_BD', 'Bangladesch' );
define( '_AEC_LANG_BE', 'Belgien' );
define( '_AEC_LANG_BF', 'Burkina Faso' );
define( '_AEC_LANG_BG', 'Bulgarien' );
define( '_AEC_LANG_BH', 'Bahrain' );
define( '_AEC_LANG_BI', 'Burundi' );
define( '_AEC_LANG_BJ', 'Benin' );
define( '_AEC_LANG_BL', 'Saint-Barth&eacute;lemy' );
define( '_AEC_LANG_BM', 'Bermuda' );
define( '_AEC_LANG_BN', 'Brunei Darussalam' );
define( '_AEC_LANG_BO', 'Bolivien' );
define( '_AEC_LANG_BR', 'Brasilien' );
define( '_AEC_LANG_BS', 'Bahamas' );
define( '_AEC_LANG_BT', 'Bhutan' );
define( '_AEC_LANG_BV', 'Bouvetinsel' );
define( '_AEC_LANG_BW', 'Botswana' );
define( '_AEC_LANG_BY', 'Belarus' );
define( '_AEC_LANG_BZ', 'Belize' );
define( '_AEC_LANG_CA', 'Kanada' );
define( '_AEC_LANG_CC', 'Kokosinseln' );
define( '_AEC_LANG_CD', 'Kongo, Demokratische Republik' );
define( '_AEC_LANG_CF', 'Zentralafrikanische Republik' );
define( '_AEC_LANG_CG', 'Republik Kongo' );
define( '_AEC_LANG_CH', 'Schweiz' );
define( '_AEC_LANG_CI', 'Cote d\'Ivoire' );
define( '_AEC_LANG_CK', 'Cookinseln' );
define( '_AEC_LANG_CL', 'Chile' );
define( '_AEC_LANG_CM', 'Kamerun' );
define( '_AEC_LANG_CN', 'China' );
define( '_AEC_LANG_CO', 'Kolumbien' );
define( '_AEC_LANG_CR', 'Costa Rica' );
define( '_AEC_LANG_CU', 'Kuba' );
define( '_AEC_LANG_CV', 'Kap Verde' );
define( '_AEC_LANG_CX', 'Weihnachtsinsel' );
define( '_AEC_LANG_CY', 'Zypern' );
define( '_AEC_LANG_CZ', 'Tschechische Republik' );
define( '_AEC_LANG_DE', 'Deutschland' );
define( '_AEC_LANG_DJ', 'Dschibuti' );
define( '_AEC_LANG_DK', 'D&auml;nemark' );
define( '_AEC_LANG_DM', 'Dominica' );
define( '_AEC_LANG_DO', 'Dominikanische Republik' );
define( '_AEC_LANG_DZ', 'Algerien' );
define( '_AEC_LANG_EC', 'Ecuador' );
define( '_AEC_LANG_EE', 'Estland' );
define( '_AEC_LANG_EG', '&Auml;gypten' );
define( '_AEC_LANG_EH', 'Westsahara' );
define( '_AEC_LANG_ER', 'Eritrea' );
define( '_AEC_LANG_ES', 'Spanien' );
define( '_AEC_LANG_ET', '&Auml;thiopien' );
define( '_AEC_LANG_FI', 'Finnland' );
define( '_AEC_LANG_FJ', 'Fidschi' );
define( '_AEC_LANG_FK', 'Falklandinseln' );
define( '_AEC_LANG_FM', 'Mikronesien' );
define( '_AEC_LANG_FO', 'F&auml;r&ouml;er' );
define( '_AEC_LANG_FR', 'Frankreich' );
define( '_AEC_LANG_GA', 'Gabun' );
define( '_AEC_LANG_GB', 'Vereinigtes K&ouml;nigreich Gro&szlig;britannien und Nordirland' );
define( '_AEC_LANG_GD', 'Grenada' );
define( '_AEC_LANG_GE', 'Georgien' );
define( '_AEC_LANG_GF', 'Franz&uml;sisch-Guayana' );
define( '_AEC_LANG_GG', 'Guernsey' );
define( '_AEC_LANG_GH', 'Ghana' );
define( '_AEC_LANG_GI', 'Gibraltar' );
define( '_AEC_LANG_GL', 'Gr&ouml;nland' );
define( '_AEC_LANG_GM', 'Gambia' );
define( '_AEC_LANG_GN', 'Guinea' );
define( '_AEC_LANG_GP', 'Guadeloupe' );
define( '_AEC_LANG_GQ', '&Auml;quatorialguinea' );
define( '_AEC_LANG_GR', 'Griechenland' );
define( '_AEC_LANG_GS', 'S&uuml;dgeorgien und die S&uuml;dlichen Sandwichinseln' );
define( '_AEC_LANG_GT', 'Guatemala' );
define( '_AEC_LANG_GU', 'Guam' );
define( '_AEC_LANG_GW', 'Guinea-Bissau' );
define( '_AEC_LANG_GY', 'Guyana' );
define( '_AEC_LANG_HK', 'Hong Kong' );
define( '_AEC_LANG_HM', 'Heard- und McDonald-Inseln' );
define( '_AEC_LANG_HN', 'Honduras' );
define( '_AEC_LANG_HR', 'Kroatien' );
define( '_AEC_LANG_HT', 'Haiti' );
define( '_AEC_LANG_HU', 'Ungarn' );
define( '_AEC_LANG_ID', 'Indonesien' );
define( '_AEC_LANG_IE', 'Irland' );
define( '_AEC_LANG_IL', 'Israel' );
define( '_AEC_LANG_IM', 'Insel Man' );
define( '_AEC_LANG_IN', 'Indien' );
define( '_AEC_LANG_IO', 'Britisches Territorium im Indischen Ozean' );
define( '_AEC_LANG_IQ', 'Irak' );
define( '_AEC_LANG_IR', 'Iran, Islamische Republik' );
define( '_AEC_LANG_IS', 'Island' );
define( '_AEC_LANG_IT', 'Italien' );
define( '_AEC_LANG_JE', 'Jersey' );
define( '_AEC_LANG_JM', 'Jamaika' );
define( '_AEC_LANG_JO', 'Jordanien' );
define( '_AEC_LANG_JP', 'Japan' );
define( '_AEC_LANG_KE', 'Kenia' );
define( '_AEC_LANG_KG', 'Kirgisistan' );
define( '_AEC_LANG_KH', 'Kambodscha' );
define( '_AEC_LANG_KI', 'Kiribati' );
define( '_AEC_LANG_KM', 'Komoren' );
define( '_AEC_LANG_KN', 'St. Kitts und Nevis' );
define( '_AEC_LANG_KP', 'Korea, Demokratische Volksrepublik' );
define( '_AEC_LANG_KR', 'Korea, Republik' );
define( '_AEC_LANG_KW', 'Kuwait' );
define( '_AEC_LANG_KY', 'Kaimaninseln' );
define( '_AEC_LANG_KZ', 'Kasachstan' );
define( '_AEC_LANG_LA', 'Laos, Demokratische Volksrepublik' );
define( '_AEC_LANG_LB', 'Libanon' );
define( '_AEC_LANG_LC', 'St. Lucia' );
define( '_AEC_LANG_LI', 'Liechtenstein' );
define( '_AEC_LANG_LK', 'Sri Lanka' );
define( '_AEC_LANG_LR', 'Liberia' );
define( '_AEC_LANG_LS', 'Lesotho' );
define( '_AEC_LANG_LT', 'Litauen' );
define( '_AEC_LANG_LU', 'Luxemburg' );
define( '_AEC_LANG_LV', 'Lettland' );
define( '_AEC_LANG_LY', 'Libysch-Arabische Dschamahirija' );
define( '_AEC_LANG_MA', 'Marokko' );
define( '_AEC_LANG_MC', 'Monaco' );
define( '_AEC_LANG_MD', 'Moldawien' );
define( '_AEC_LANG_ME', 'Montenegro' );
define( '_AEC_LANG_MF', 'Saint-Martin (franz. Teil)' );
define( '_AEC_LANG_MG', 'Madagaskar' );
define( '_AEC_LANG_MH', 'Marshallinseln' );
define( '_AEC_LANG_MK', 'Mazedonien, ehem. jugoslawische Republik' );
define( '_AEC_LANG_ML', 'Mali' );
define( '_AEC_LANG_MM', 'Myanmar' );
define( '_AEC_LANG_MN', 'Mongolei' );
define( '_AEC_LANG_MO', 'Macao' );
define( '_AEC_LANG_MP', 'N&ouml;rdliche Marianen' );
define( '_AEC_LANG_MQ', 'Martinique' );
define( '_AEC_LANG_MR', 'Mauretanien' );
define( '_AEC_LANG_MS', 'Montserrat' );
define( '_AEC_LANG_MT', 'Malta' );
define( '_AEC_LANG_MU', 'Mauritius' );
define( '_AEC_LANG_MV', 'Maldiven' );
define( '_AEC_LANG_MW', 'Malawi' );
define( '_AEC_LANG_MX', 'Mexiko' );
define( '_AEC_LANG_MY', 'Malaysia' );
define( '_AEC_LANG_MZ', 'Mosambik' );
define( '_AEC_LANG_NA', 'Namibia' );
define( '_AEC_LANG_NC', 'Neukaledonien' );
define( '_AEC_LANG_NE', 'Niger' );
define( '_AEC_LANG_NF', 'Norfolkinsel' );
define( '_AEC_LANG_NG', 'Nigeria' );
define( '_AEC_LANG_NI', 'Nicaragua' );
define( '_AEC_LANG_NL', 'Niederlande' );
define( '_AEC_LANG_NO', 'Norwegen' );
define( '_AEC_LANG_NP', 'Nepal' );
define( '_AEC_LANG_NR', 'Nauru' );
define( '_AEC_LANG_NU', 'Niue' );
define( '_AEC_LANG_NZ', 'Neuseeland' );
define( '_AEC_LANG_OM', 'Oman' );
define( '_AEC_LANG_PA', 'Panama' );
define( '_AEC_LANG_PE', 'Peru' );
define( '_AEC_LANG_PF', 'Franz&ouml;sisch-Polynesien' );
define( '_AEC_LANG_PG', 'Papua-Neuguinea' );
define( '_AEC_LANG_PH', 'Philippinen' );
define( '_AEC_LANG_PK', 'Pakistan' );
define( '_AEC_LANG_PL', 'Polen' );
define( '_AEC_LANG_PM', 'Saint-Pierre und Miquelon' );
define( '_AEC_LANG_PN', 'Pitcairninseln' );
define( '_AEC_LANG_PR', 'Puerto Rico' );
define( '_AEC_LANG_PS', 'Pal&auml;stinensische Autonomiegebiete' );
define( '_AEC_LANG_PT', 'Portugal' );
define( '_AEC_LANG_PW', 'Palau' );
define( '_AEC_LANG_PY', 'Paraguay' );
define( '_AEC_LANG_QA', 'Qatar' );
define( '_AEC_LANG_RE', 'Reunion' );
define( '_AEC_LANG_RO', 'Rum&auml;nien' );
define( '_AEC_LANG_RS', 'Serbien' );
define( '_AEC_LANG_RU', 'Russische F&ouml;deration' );
define( '_AEC_LANG_RW', 'Ruanda' );
define( '_AEC_LANG_SA', 'Saudi-Arabien' );
define( '_AEC_LANG_SB', 'Salomonen' );
define( '_AEC_LANG_SC', 'Seychellen' );
define( '_AEC_LANG_SD', 'Sudan' );
define( '_AEC_LANG_SE', 'Schweden' );
define( '_AEC_LANG_SG', 'Singapur' );
define( '_AEC_LANG_SH', 'St. Helena' );
define( '_AEC_LANG_SI', 'Slowenien' );
define( '_AEC_LANG_SJ', 'Svalbard und Jan Mayen' );
define( '_AEC_LANG_SK', 'Slowakei' );
define( '_AEC_LANG_SL', 'Sierra Leone' );
define( '_AEC_LANG_SM', 'San Marino' );
define( '_AEC_LANG_SN', 'Senegal' );
define( '_AEC_LANG_SO', 'Somalia' );
define( '_AEC_LANG_SR', 'Suriname' );
define( '_AEC_LANG_ST', 'Sao Tome und Principe' );
define( '_AEC_LANG_SV', 'El Salvador' );
define( '_AEC_LANG_SY', 'Syrien, Arabische Republik' );
define( '_AEC_LANG_SZ', 'Swasiland' );
define( '_AEC_LANG_TC', 'Turks- und Caicosinseln' );
define( '_AEC_LANG_TD', 'Tschad' );
define( '_AEC_LANG_TF', 'Franz&ouml;sische S&uuml;d- und Antarktisgebiete' );
define( '_AEC_LANG_TG', 'Togo' );
define( '_AEC_LANG_TH', 'Thailand' );
define( '_AEC_LANG_TJ', 'Tadschikistan' );
define( '_AEC_LANG_TK', 'Tokelau' );
define( '_AEC_LANG_TL', 'Osttimor ' );
define( '_AEC_LANG_TM', 'Turkmenistan' );
define( '_AEC_LANG_TN', 'Tunesien' );
define( '_AEC_LANG_TO', 'Tonga' );
define( '_AEC_LANG_TR', 'T&uuml;rkei' );
define( '_AEC_LANG_TT', 'Trinidad und Tobago' );
define( '_AEC_LANG_TV', 'Tuvalu' );
define( '_AEC_LANG_TW', 'Republik China (Taiwan)' );
define( '_AEC_LANG_TZ', 'Tansania, Vereinigte Republik' );
define( '_AEC_LANG_UA', 'Ukraine' );
define( '_AEC_LANG_UG', 'Uganda' );
define( '_AEC_LANG_UM', 'United States Minor Outlying Islands' );
define( '_AEC_LANG_US', 'Vereinigte Staaten von Amerika' );
define( '_AEC_LANG_UY', 'Uruguay' );
define( '_AEC_LANG_UZ', 'Usbekistan' );
define( '_AEC_LANG_VA', 'Vatikanstadt' );
define( '_AEC_LANG_VC', 'St. Vincent und die Grenadinen' );
define( '_AEC_LANG_VE', 'Venezuela' );
define( '_AEC_LANG_VG', 'Britische Jungferninseln' );
define( '_AEC_LANG_VI', 'Amerikanische Jungferninseln' );
define( '_AEC_LANG_VN', 'Vietnam' );
define( '_AEC_LANG_VU', 'Vanuatu' );
define( '_AEC_LANG_WF', 'Wallis und Futuna' );
define( '_AEC_LANG_WS', 'Samoa' );
define( '_AEC_LANG_YE', 'Jemen' );
define( '_AEC_LANG_YT', 'Mayotte' );
define( '_AEC_LANG_ZA', 'S&uuml;dafrika' );
define( '_AEC_LANG_ZM', 'Sambia' );
define( '_AEC_LANG_ZW', 'Simbabwe' );

// --== COUPON EDIT ==--
define( '_COUPON_DETAIL_TITLE',					'Gutschein' );
define( '_COUPON_RESTRICTIONS_TITLE',			'Einschr.' );
define( '_COUPON_RESTRICTIONS_TITLE_FULL',		'Einschr&auml;nkungen' );
define( '_COUPON_MI',							'Gateway' );
define( '_COUPON_MI_FULL',						'Bezahldienste' );

define( '_COUPON_GENERAL_NAME_NAME',			'Name' );
define( '_COUPON_GENERAL_NAME_DESC',			'Der interne und externe Name f&uuml;r diesen Gutschein' );
define( '_COUPON_GENERAL_COUPON_CODE_NAME',		'Gutscheincode' );
define( '_COUPON_GENERAL_COUPON_CODE_DESC',		'Den Gutscheincode hier eintragen - der angezeigte (zuf&auml;llig generierte) Code wurde vom System erzeugt.<hr /><strong>Hinweis:</strong><br />Der Code muss einmalig sein!' );
define( '_COUPON_GENERAL_DESC_NAME',			'Beschreibung' );
define( '_COUPON_GENERAL_DESC_DESC',			'Die interne Beschreibung f&uuml;r diesen Gutschein' );
define( '_COUPON_GENERAL_ACTIVE_NAME',			'Aktiv' );
define( '_COUPON_GENERAL_ACTIVE_DESC',			'Ist dieser Gutschein aktiv (momentan g&uuml;ltig)' );
define( '_COUPON_GENERAL_TYPE_NAME',			'Gruppe' );
define( '_COUPON_GENERAL_TYPE_DESC',			'Soll dieser Gutschein einmalig oder f&uuml;r eine Gruppe von mehreren Personen gelten (Einzel- oder Gruppengutschein)' );

define( '_COUPON_GENERAL_MICRO_INTEGRATIONS_NAME',	'Bezahldienste' );
define( '_COUPON_GENERAL_MICRO_INTEGRATIONS_DESC',	'Diejenigen Bezahldienste ausw&auml;hlen welche f&uuml;r diesen Gutschein g&uuml;ltig sein sollen' );

define( '_COUPON_PARAMS_AMOUNT_USE_NAME',		'Betrag verwenden' );
define( '_COUPON_PARAMS_AMOUNT_USE_DESC', 		'Soll von der Rechnung direkt ein Betrag abgezogen werden' );
define( '_COUPON_PARAMS_AMOUNT_NAME',			'Betrag' );
define( '_COUPON_PARAMS_AMOUNT_DESC',			'Hier den Betrag angeben welcher direkt von der Rechnung abgezogen werden soll' );
define( '_COUPON_PARAMS_AMOUNT_PERCENT_USE_NAME',	'Prozente' );
define( '_COUPON_PARAMS_AMOUNT_PERCENT_USE_DESC',	'Sollen x Prozente vom Rechnungsbetrag abgezogen werden' );
define( '_COUPON_PARAMS_AMOUNT_PERCENT_NAME',	'Prozent in %' );
define( '_COUPON_PARAMS_AMOUNT_PERCENT_DESC',	'Hier angeben wieviele Prozente vom Betrag abgezogen werden sollen' );
define( '_COUPON_PARAMS_PERCENT_FIRST_NAME',	'Prozente vor Betrag' );
define( '_COUPON_PARAMS_PERCENT_FIRST_DESC',	'Wenn die Kombination von Prozente und Betrag angewendet werden soll, vorher die Prozente abziehen?' );
define( '_COUPON_PARAMS_USEON_TRIAL_NAME',		'Bei Testabo?' );
define( '_COUPON_PARAMS_USEON_TRIAL_DESC',		'Sollen die Benutzer diese Erm&auml;ssigung auch bei einem Testabo ausw&auml;hlen d&uuml;rfen?' );
define( '_COUPON_PARAMS_USEON_FULL_NAME',		'Bei Vollabo?' );
define( '_COUPON_PARAMS_USEON_FULL_DESC',		'Sollen die Benutzer diese Erm&auml;ssigung vom aktuellen Betrag abziehen k&ouml;nnen? (bei wiederholenden Abos wird die Erm&auml;ssigung nur vom ersten Rechnungsbetrag abgezogen!)' );
define( '_COUPON_PARAMS_USEON_FULL_ALL_NAME',	'Jede Rechnung?' );
define( '_COUPON_PARAMS_USEON_FULL_ALL_DESC',	'Falls der Benutzer wiederholende Abos besitzt, soll die Erm&auml;ssigung jedes Mal abgezogen werden? Wenn nur beim ersten Mal, dann Nein)' );

define( '_COUPON_PARAMS_HAS_START_DATE_NAME',	'Beginndatum' );
define( '_COUPON_PARAMS_HAS_START_DATE_DESC',	'Soll der Gutschein f&uuml;r einen bestimmten Zeitraum gelten?' );
define( '_COUPON_PARAMS_START_DATE_NAME',		'Datum' );
define( '_COUPON_PARAMS_START_DATE_DESC',		'Beginndatum der Periode ausw&auml;hlen f&uuml;r den dieser Gutschein g&uuml;ltig sein soll' );
define( '_COUPON_PARAMS_HAS_EXPIRATION_NAME',	'Ablaufdatum' );
define( '_COUPON_PARAMS_HAS_EXPIRATION_DESC',	'Soll dieser Gutschein mit Datum x auslaufen?' );
define( '_COUPON_PARAMS_EXPIRATION_NAME',		'Datum' );
define( '_COUPON_PARAMS_EXPIRATION_DESC',		'Datum ausw&auml;hlen bis wann dieser Gutschein g&uuml;ltig sein soll' );
define( '_COUPON_PARAMS_HAS_MAX_REUSE_NAME',	'Eingeschr&auml;nkt?' );
define( '_COUPON_PARAMS_HAS_MAX_REUSE_DESC',	'Soll dieser max. x verwendet werden d&uuml;rfen?' );
define( '_COUPON_PARAMS_MAX_REUSE_NAME',		'Anzahl' );
define( '_COUPON_PARAMS_MAX_REUSE_DESC',		'Hier die Anzahl eintragen wie oft dieser Gutschein verwendet werden darf' );
define( '_COUPON_PARAMS_HAS_MAX_PERUSER_REUSE_NAME', 'Wiederverwendung pro Benutzer begrenzen?');
define( '_COUPON_PARAMS_HAS_MAX_PERUSER_REUSE_DESC', 'M&ouml;chten Sie die Anzahl der Verwendungen dieses Gutscheins f&uuml;r jeden Benutzer begrenzen?');
define( '_COUPON_PARAMS_MAX_PERUSER_REUSE_NAME', 'Maximale Verwendungen pro Benutzer');
define( '_COUPON_PARAMS_MAX_PERUSER_REUSE_DESC', 'W&auml;hlen Sie die Anzahl der Male, die dieser Gutschein von jedem Benutzer genutzt werden kann');

define( '_COUPON_PARAMS_USECOUNT_NAME',			'Zur&uuml;cksetzen' );
define( '_COUPON_PARAMS_USECOUNT_DESC',			'Hier kann der Z&auml;hler r&uuml;ckgesetzt werden' );

define( '_COUPON_PARAMS_USAGE_PLANS_ENABLED_NAME',	'Abo' );
define( '_COUPON_PARAMS_USAGE_PLANS_ENABLED_DESC',	'Soll dieser Gutschein nur f&uuml;r ein bestimmtes Abo gelten?' );
define( '_COUPON_PARAMS_USAGE_PLANS_NAME',			'Abos' );
define( '_COUPON_PARAMS_USAGE_PLANS_DESC',			'Welche Abos werden angewendet' );
define( '_COUPON_PARAMS_USAGE_CART_FULL_NAME', 'Einkaufswagen');
define( '_COUPON_PARAMS_USAGE_CART_FULL_DESC', 'Anwendung f&uuml;r einen vollen Einkaufswagen erlauben');
define( '_COUPON_PARAMS_CART_MULTIPLE_ITEMS_NAME', 'Verschiedene Posten');
define( '_COUPON_PARAMS_CART_MULTIPLE_ITEMS_DESC', 'L&auml;sst den Benutzer den Gutschein auf verschiedene Posten im Einkaufswagen anwenden, wenn es die allgemeinen Bedingungen erlauben.');
define( '_COUPON_PARAMS_CART_MULTIPLE_ITEMS_AMOUNT_NAME', 'Anzahl der verschiedenen Posten');
define( '_COUPON_PARAMS_CART_MULTIPLE_ITEMS_AMOUNT_DESC', 'Setzen Sie ein Limit f&uuml;r die Anwendung auf verschiedene Posten in einem Einkaufswagen');

define( '_COUPON_RESTRICTIONS_MINGID_ENABLED_NAME', 'Mindest Gruppen ID:' );
define( '_COUPON_RESTRICTIONS_MINGID_ENABLED_DESC', 'Hier die Mindestgruppen ID definieren f&uuml;r welche diesen Gutschein g&uuml;ltig sein soll' );
define( '_COUPON_RESTRICTIONS_MINGID_NAME',			'Sichtbare Gruppe:' );
define( '_COUPON_RESTRICTIONS_MINGID_DESC',			'Die Mindestbenutzerebene welche diesen Gutschein einsetzen kann' );
define( '_COUPON_RESTRICTIONS_FIXGID_ENABLED_NAME', 'Fixe Gruppen ID:' );
define( '_COUPON_RESTRICTIONS_FIXGID_ENABLED_DESC', 'Soll dieser Gutschein nur f&uuml;r eine bestimmte Gruppe gelten' );
define( '_COUPON_RESTRICTIONS_FIXGID_NAME',			'Gruppe:' );
define( '_COUPON_RESTRICTIONS_FIXGID_DESC',			'Nur Benutzer dieser Gruppe k&ouml;nnen diesen Gutschein einsetzen' );
define( '_COUPON_RESTRICTIONS_MAXGID_ENABLED_NAME', 'Maximale Gruppen ID:' );
define( '_COUPON_RESTRICTIONS_MAXGID_ENABLED_DESC', 'Welche maximale Gruppen ID darf f&uuml;r diesen Gutschein verwenden d&uuml;rfen?' );
define( '_COUPON_RESTRICTIONS_MAXGID_NAME',			'Gruppe:' );
define( '_COUPON_RESTRICTIONS_MAXGID_DESC',			'Die am h&ouml;chsten eingestufte Gruppe welche diesen Gutschein einsetzen darf' );

define( '_COUPON_RESTRICTIONS_PREVIOUSPLAN_REQ_ENABLED_NAME',	'Voriges Abo:' );
define( '_COUPON_RESTRICTIONS_PREVIOUSPLAN_REQ_ENABLED_DESC',	'Wird f&uuml;r diesen Gutschein ein bestimmtes Abo <strong>vorher</strong> ben&ouml;tigt' );
define( '_COUPON_RESTRICTIONS_PREVIOUSPLAN_REQ_NAME',			'Abo:' );
define( '_COUPON_RESTRICTIONS_PREVIOUSPLAN_REQ_DESC',			'Benutzer welche dieses Abo schon einmal verwendet hatten sind f&uuml;r diesen Gutschein berechtigt' );
define( '_COUPON_RESTRICTIONS_CURRENTPLAN_REQ_ENABLED_NAME',	'Aktuelles Abo:' );
define( '_COUPON_RESTRICTIONS_CURRENTPLAN_REQ_ENABLED_DESC',	'Aktuelles Abo ist mindestens Voraussetzung' );
define( '_COUPON_RESTRICTIONS_CURRENTPLAN_REQ_NAME',			'Abo:' );
define( '_COUPON_RESTRICTIONS_CURRENTPLAN_REQ_DESC',			'Nur Benutzer welche aktuell im Besitz dieses Abos sind oder es schon mal vorher hatten d&uuml;rfen diesen Gutschein verwenden' );
define( '_COUPON_RESTRICTIONS_OVERALLPLAN_REQ_ENABLED_NAME',	'Erforderlich:' );
define( '_COUPON_RESTRICTIONS_OVERALLPLAN_REQ_ENABLED_DESC',	'Akivieren wenn Abo vorher erforderlich ist' );
define( '_COUPON_RESTRICTIONS_OVERALLPLAN_REQ_NAME',			'Abo:' );
define( '_COUPON_RESTRICTIONS_OVERALLPLAN_REQ_DESC',			'Nur Benutzer welche schon irgendwann vorher dieses Abo verwendet hatten d&uuml;rfen diesen Gutschein verwenden' );

define( '_COUPON_RESTRICTIONS_USED_PLAN_MIN_ENABLED_NAME',		'Mind. Aboanzahl:' );
define( '_COUPON_RESTRICTIONS_USED_PLAN_MIN_ENABLED_DESC',		'Aktivieren wenn Benutzer schon vorher x-mal ein bestimmtes Abo verwendet haben m&uuml;ssen' );
define( '_COUPON_RESTRICTIONS_USED_PLAN_MIN_AMOUNT_NAME',		'Anzahl:' );
define( '_COUPON_RESTRICTIONS_USED_PLAN_MIN_AMOUNT_DESC',		'Die Mindestanzahl der bisherigen Verwendungen des angegebenen Abos' );
define( '_COUPON_RESTRICTIONS_USED_PLAN_MIN_NAME',				'Abo:' );
define( '_COUPON_RESTRICTIONS_USED_PLAN_MIN_DESC',				'Das Abo welches der Benutzer schon vorher x-mal verwendet haben muss' );
define( '_COUPON_RESTRICTIONS_USED_PLAN_MAX_ENABLED_NAME',		'Abo:' );
define( '_COUPON_RESTRICTIONS_USED_PLAN_MAX_ENABLED_DESC',		'Maximumanzahl der bisherigen Verwendungen des angegebenen Abos um diesen Gutschein einsetzen zu d&uuml;rfen' );
define( '_COUPON_RESTRICTIONS_USED_PLAN_MAX_AMOUNT_NAME',		'Anzahl:' );
define( '_COUPON_RESTRICTIONS_USED_PLAN_MAX_AMOUNT_DESC',		'Maximale Anzahl der bisherigen Verwendungen dieses Abos' );
define( '_COUPON_RESTRICTIONS_USED_PLAN_MAX_NAME',				'Abo:' );
define( '_COUPON_RESTRICTIONS_USED_PLAN_MAX_DESC',				'Welches Abo muss vorher verwendet werden' );

define( '_COUPON_RESTRICTIONS_PREVIOUSGROUP_REQ_ENABLED_NAME', 'Erforderliche vorherige Gruppe:');
define( '_COUPON_RESTRICTIONS_PREVIOUSGROUP_REQ_ENABLED_DESC', 'Nur zulassen, wenn der Benutzer direkt zuvor ein Abo aus der gew&auml;hlten Gruppe besessen hat');
define( '_COUPON_RESTRICTIONS_PREVIOUSGROUP_REQ_NAME', 'Gruppe:');
define( '_COUPON_RESTRICTIONS_PREVIOUSGROUP_REQ_DESC', 'Ein Benutzer wird diesen Coupon nur benutzen k&ouml;nnen, wenn er einen Plan aus dieser Gruppe vor dem derzeitigen Plan benutzt hat.');
define( '_COUPON_RESTRICTIONS_CURRENTGROUP_REQ_ENABLED_NAME', 'Erforderliche derzeitige Gruppe:');
define( '_COUPON_RESTRICTIONS_CURRENTGROUP_REQ_ENABLED_DESC', 'Nur zulassen, wenn der Benutzer momentan ein Abo aus der gew&auml;hlten Gruppe besitzt');
define( '_COUPON_RESTRICTIONS_CURRENTGROUP_REQ_NAME', 'Gruppe:');
define( '_COUPON_RESTRICTIONS_CURRENTGROUP_REQ_DESC', 'Ein Benutzer wird diesen Coupon nur benutzen k&ouml;nnen, wenn er derzeit einem Plan aus dieser Gruppe zugeteilt ist oder einer der Pl%auml;ne aus dieser Gruppe gerade abgelaufen ist');
define( '_COUPON_RESTRICTIONS_OVERALLGROUP_REQ_ENABLED_NAME', 'Erforderliche benutzte Gruppe:');
define( '_COUPON_RESTRICTIONS_OVERALLGROUP_REQ_ENABLED_DESC', 'Nur zulassen, wenn der Benutzer schon einmal ein Abo aus der gew&auml;hlten Gruppe besessen hat, oder noch besitzt');
define( '_COUPON_RESTRICTIONS_OVERALLGROUP_REQ_NAME', 'Gruppe:');
define( '_COUPON_RESTRICTIONS_OVERALLGROUP_REQ_DESC', 'Ein Benutzer wird diesen Coupon nur dann benutzen d&uuml;rfen, wenn er den ausgew&auml;hlten Plan in dieser Gruppe einmal benutzt hat, egal wann');

define( '_COUPON_RESTRICTIONS_PREVIOUSGROUP_REQ_ENABLED_EXCLUDED_NAME', 'Ausgeschlossene vorherige Gruppe:');
define( '_COUPON_RESTRICTIONS_PREVIOUSGROUP_REQ_ENABLED_EXCLUDED_DESC', 'Die Benutzung dieses Coupons wird den Benutzern NICHT gestattet, wenn sie einen Plan aus der angegebenen Gruppe als vorherigen Bezahlplan hatten.');
define( '_COUPON_RESTRICTIONS_PREVIOUSGROUP_REQ_EXCLUDED_NAME', 'Gruppe:');
define( '_COUPON_RESTRICTIONS_PREVIOUSGROUP_REQ_EXCLUDED_DESC', 'Die Benutzung dieses Coupons wird den Benutzern NICHT gestattet, wenn sie einen Plan aus der angegebenen Gruppe Gruppe vor dem aktuellen Plan benutzt hatten.');
define( '_COUPON_RESTRICTIONS_CURRENTGROUP_REQ_ENABLED_EXCLUDED_NAME', 'Ausgeschlossener aktueller Plan:');
define( '_COUPON_RESTRICTIONS_CURRENTGROUP_REQ_ENABLED_EXCLUDED_DESC', 'Die Benutzung dieses Coupons wird den Benutzern NICHT gestattet, die einen Plan aus der angegebenen Gruppe Gruppe als ihren aktuellen Bezahlplan hatten.');
define( '_COUPON_RESTRICTIONS_CURRENTGROUP_REQ_EXCLUDED_NAME', 'Gruppe:');
define( '_COUPON_RESTRICTIONS_CURRENTGROUP_REQ_EXCLUDED_DESC', 'Benutzer werden diesen Coupon nicht benutzen d&uuml;rfen, wenn sie einem Plan aus der angegebenen Gruppe Gruppe aktuell zugeschrieben sind oder ein Plan aus dieser Gruppe gerade abgelaufen ist');
define( '_COUPON_RESTRICTIONS_OVERALLGROUP_REQ_ENABLED_EXCLUDED_NAME', 'Ausgeschlossene benutzte Gruppe:');
define( '_COUPON_RESTRICTIONS_OVERALLGROUP_REQ_ENABLED_EXCLUDED_DESC', 'Benutzung dieses Coupon nicht Benutzern gestatten, die einen Plan aus der angegebenen Gruppe Gruppe zuvor benutzt haben');
define( '_COUPON_RESTRICTIONS_OVERALLGROUP_REQ_EXCLUDED_NAME', 'Gruppe:');
define( '_COUPON_RESTRICTIONS_OVERALLGROUP_REQ_EXCLUDED_DESC', 'Ein Benutzer wird diesen Coupon nicht benutzen d&uuml;rfen, wenn er oder sie einen Plan aus der angegebenen Gruppe Gruppe einmal benutzt hat, egal wann.');

define( '_COUPON_RESTRICTIONS_USED_GROUP_MIN_ENABLED_NAME', 'Minimale Benutzung in Gruppe:');
define( '_COUPON_RESTRICTIONS_USED_GROUP_MIN_ENABLED_DESC', 'Einschr&auml;nken ob ein Benutzer diesen Coupon benutzen darf - aufgrund der minimalen Anzahl von Benutzungen eines Bezahplans in einer bestimmten Gruppe');
define( '_COUPON_RESTRICTIONS_USED_GROUP_MIN_AMOUNT_NAME', 'Min. Benutzungen:');
define( '_COUPON_RESTRICTIONS_USED_GROUP_MIN_AMOUNT_DESC', 'Die minimale Anzahl von Benutzungen des Bezahplans.');
define( '_COUPON_RESTRICTIONS_USED_GROUP_MIN_NAME', 'Gruppe:');
define( '_COUPON_RESTRICTIONS_USED_GROUP_MIN_DESC', 'Die Gruppe, aus welcher der Benutzer einen Plan eine bestimmte Anzahl haben muss - mindestens so viele Male wie angegeben');
define( '_COUPON_RESTRICTIONS_USED_GROUP_MAX_ENABLED_NAME', 'Maximale Benutzung in Gruppe:');
define( '_COUPON_RESTRICTIONS_USED_GROUP_MAX_ENABLED_DESC', 'Einschr&auml;nken ob ein Benutzer diesen Coupon benutzen darf - aufgrund der maximalen Anzahl von Benutzungen eines Bezahplans in einer bestimmten Gruppe');
define( '_COUPON_RESTRICTIONS_USED_GROUP_MAX_AMOUNT_NAME', 'Max. Benutzungen:');
define( '_COUPON_RESTRICTIONS_USED_GROUP_MAX_AMOUNT_DESC', 'Die maximale Anzahl von Benutzungen des Bezahplans.');
define( '_COUPON_RESTRICTIONS_USED_GROUP_MAX_NAME', 'Gruppe:');
define( '_COUPON_RESTRICTIONS_USED_GROUP_MAX_DESC', 'Die Gruppe, aus welcher der Benutzer einen Plan eine bestimmte Anzahl haben muss - h&ouml;chstens so viele Male wie angegeben');

define( '_COUPON_RESTRICTIONS_RESTRICT_COMBINATION_NAME', 'Eingeschr&auml;nkte Kombination:');
define( '_COUPON_RESTRICTIONS_RESTRICT_COMBINATION_DESC', 'W&auml;len Sie, dass Ihre Benutzer diesen Gutschein nicht mit einem der folgenden kombinieren k&ouml;nnen');
define( '_COUPON_RESTRICTIONS_BAD_COMBINATIONS_NAME', 'Gutscheine:');
define( '_COUPON_RESTRICTIONS_BAD_COMBINATIONS_DESC', 'Treffen Sie eine Auswahl an Gutscheinen, mit denen dieser Gutschein nicht benutzt werden kann');
define( '_COUPON_RESTRICTIONS_DEPEND_ON_SUBSCR_ID_NAME', 'Abh&auml;ngig von Abonnement');
define( '_COUPON_RESTRICTIONS_DEPEND_ON_SUBSCR_ID_DESC', 'Lassen Sie den Gutschein von einem bestimmten Abo abh&auml;ngig sein, damit er funktioniert.');
define( '_COUPON_RESTRICTIONS_SUBSCR_ID_DEPENDENCY_NAME', 'Abo ID');
define( '_COUPON_RESTRICTIONS_SUBSCR_ID_DEPENDENCY_DESC', 'Die Abo ID des Abonnements, von dem der Gutschein abh&auml;ngen wird.');
define( '_COUPON_RESTRICTIONS_ALLOW_TRIAL_DEPEND_SUBSCR_NAME', 'Probezeit:');
define( '_COUPON_RESTRICTIONS_ALLOW_TRIAL_DEPEND_SUBSCR_DESC', 'Die Nutzung des Gutscheins erlauben, wenn abh&auml;ngig von einem Abo, welches noch in der Probezeit ist.');
define( '_COUPON_RESTRICTIONS_RESTRICT_COMBINATION_CART_NAME', 'Kombinationen im Einkaufswagen untersagen:');
define( '_COUPON_RESTRICTIONS_RESTRICT_COMBINATION_CART_DESC', 'W&auml;len Sie, dass Benutzer diesen Gutschein nicht mit einem der folgenden kombinieren k&ouml;nnen, wenn er auf einen Einkaufswagen angewendet wird.');
define( '_COUPON_RESTRICTIONS_BAD_COMBINATIONS_CART_NAME', 'Gutscheine:');
define( '_COUPON_RESTRICTIONS_BAD_COMBINATIONS_CART_DESC', 'Treffen Sie eine Auswahl der Gutscheine, mit denen dieser Gutschein nicht benutzt werden kann');
define( '_COUPON_RESTRICTIONS_ALLOW_COMBINATION_NAME', 'Kombinationen erlauben:');
define( '_COUPON_RESTRICTIONS_ALLOW_COMBINATION_DESC', 'W&auml;len Sie, dass Ihre Benutzer diesen Gutschein nur mit folgendem kombinieren k&ouml;nnen. W&auml;hlen Sie keinen aus, um Kombinationen nicht zu erlauben.');
define( '_COUPON_RESTRICTIONS_GOOD_COMBINATIONS_NAME', 'Gutscheine:');
define( '_COUPON_RESTRICTIONS_GOOD_COMBINATIONS_DESC', 'Treffen Sie eine Auswahl der Gutscheine, mit denen dieser Gutschein benutzt werden kann');
define( '_COUPON_RESTRICTIONS_ALLOW_COMBINATION_CART_NAME', 'Kombinationen im Einkaufswagen erlauben:');
define( '_COUPON_RESTRICTIONS_ALLOW_COMBINATION_CART_DESC', 'W&auml;len Sie, dass Ihre Benutzer diesen Gutschein nur mit folgendem kombinieren k&ouml;nnen. W&auml;hlen Sie keinen aus, um Kombinationen nicht zu erlauben.');
define( '_COUPON_RESTRICTIONS_GOOD_COMBINATIONS_CART_NAME', 'Gutscheine:');
define( '_COUPON_RESTRICTIONS_GOOD_COMBINATIONS_CART_DESC', 'Treffen Sie eine Auswahl der Gutscheine, mit denen dieser Gutschein benutzt werden kann in einem Einkaufswagen');

// END 0.12.4 (mic) ####################################################

// --== BACKEND TOOLBAR ==--
define( '_EXPIRE_SET',				'Ablaufdatum:' );
define( '_EXPIRE_NOW','Jetzt' );
define( '_EXPIRE_EXCLUDE','Herausnehmen' );
define( '_EXPIRE_INCLUDE','Wiedereinstellen' );
define( '_EXPIRE_CLOSE','Schlie&szlig;en' );
define( '_EXPIRE_HOLD','Halten');
define( '_EXPIRE_01MONTH','in 1 Monat' );
define( '_EXPIRE_03MONTH','in 3 Monaten' );
define( '_EXPIRE_12MONTH','in 12 Monaten' );
define( '_EXPIRE_ADD01MONTH','plus 1 Monat' );
define( '_EXPIRE_ADD03MONTH','plus 3 Monate' );
define( '_EXPIRE_ADD12MONTH','plus 12 Monate' );
define( '_CONFIGURE','Konfigurieren' );
define( '_REMOVE','Ausschliessen' );
define( '_CNAME','Name' );
define( '_USERLOGIN','Login' );
define( '_EXPIRATION','Auslauf' );
define( '_USERS','Benutzer' );
define( '_DISPLAY','Anzeigen' );
define( '_NOTSET','Ausgenommen' );
define( '_SAVE','Speichern' );
define( '_CANCEL','Abbrechen' );
define( '_EXP_ASC',					'Auslauf A-Z' );
define( '_EXP_DESC',				'Auslauf Z-A' );
define( '_NAME_ASC',				'Name A-Z' );
define( '_NAME_DESC',				'Name Z-A' );
define( '_LASTNAME_ASC','Nachname A-Z');
define( '_LASTNAME_DESC','Nachname Z-A');
define( '_LOGIN_ASC',				'Login A-Z' );
define( '_LOGIN_DESC',				'Login Z-A' );
define( '_SIGNUP_ASC',				'Abschlussdatum A-Z' );
define( '_SIGNUP_DESC',				'Abschlussdatum Z-A' );
define( '_LASTPAY_ASC',				'Letzte Zahlung A-Z' );
define( '_LASTPAY_DESC',			'Letzte Zahlung Z-A' );
define( '_PLAN_ASC',				'Abos A-Z' );
define( '_PLAN_DESC',				'Abos Z-A' );
define( '_STATUS_ASC',				'Status A-Z' );
define( '_STATUS_DESC',				'Status Z-A' );
define( '_TYPE_ASC',				'Abo Typ Type A-Z' );
define( '_TYPE_DESC',				'Abo Typ Type Z-A' );
define( '_ORDERING_ASC','Ordnung A-Z');
define( '_ORDERING_DESC','Ordnung Z-A');
define( '_ID_ASC','ID A-Z');
define( '_ID_DESC','ID Z-A');
define( '_CLASSNAME_ASC','Funktionalit&auml;t A-Z');
define( '_CLASSNAME_DESC','Funktionalit&auml;t Z-A');
define( '_ORDER_BY','Sortieren nach:' );
define( '_SAVED', 'Gespeichert.' );
define( '_CANCELED', 'Abgebrochen.' );
define( '_CONFIGURED',				'Eintrag konfiguriert.' );
define( '_REMOVED',					'Eintrag aus Liste gel&ouml;scht.' );
define( '_EOT_TITLE', 'Geschlossene Abonnements' );
define( '_EOT_DESC', 'Diese Liste enth&auml;lt keine manuellen Abonnements, nur solche, die durch Online-Zahlung abgeschlossen wurden. Das L&ouml;schen eines Eintrages l&ouml;scht den betreffenden Benutzer aus der Datenbank und seine Eintr&auml;ge im Zahlungsverlauf.' );
define( '_EOT_DATE', 'Ende des Zeitraums' );
define( '_EOT_CAUSE', 'Grund' );
define( '_EOT_CAUSE_FAIL', 'Zahlung fehlgeschlagen' );
define( '_EOT_CAUSE_BUYER', 'Vom Benutzer abgebrochen' );
define( '_EOT_CAUSE_FORCED', 'Vom Administrator abgebrochen' );
define( '_REMOVE_CLOSED', 'Benutzer l&ouml;schen' );
define( '_FORCE_CLOSE', 'Schlie&szlig;en erzwingen' );
define( '_PUBLISH_PAYPLAN', 'Ver&ouml;ffentlichen' );
define( '_UNPUBLISH_PAYPLAN', 'nicht ver&ouml;ffentlichen' );
define( '_NEW_PAYPLAN', 'Neu' );
define( '_COPY_PAYPLAN', 'Kopieren');
define( '_APPLY_PAYPLAN', 'Anwenden');
define( '_EDIT_PAYPLAN', 'Bearbeiten' );
define( '_REMOVE_PAYPLAN', 'L&ouml;schen' );
define( '_SAVE_PAYPLAN', 'Speichern' );
define( '_CANCEL_PAYPLAN', 'Abbrechen' );
define( '_PAYPLANS_TITLE', 			'Abonnement Verwaltung' );
define( '_PAYPLANS_MAINDESC',		'Ver&ouml;ffentlichte Abos werden den Benutzern angezeigt' );
define( '_PAYPLAN_GROUP', 'Gruppe');
define( '_PAYPLAN_NOGROUP', 'Keine Gruppe');
define( '_PAYPLAN_NAME', 'Name' );
define( '_PAYPLAN_DESC', 'Beschreibung (ersten 50 Zeichen)' );
define( '_PAYPLAN_ACTIVE', 'Aktiv' );
define( '_PAYPLAN_VISIBLE', 'Sichtbar' );
define( '_PAYPLAN_A3', 'Rate' );
define( '_PAYPLAN_P3', 'Zeitraum' );
define( '_PAYPLAN_T3', 'Einheit des Zeitraumes' );
define( '_PAYPLAN_USERCOUNT', 'Abonnenten' );
define( '_PAYPLAN_EXPIREDCOUNT', 'abgelaufen' );
define( '_PAYPLAN_TOTALCOUNT', 'Total' );
define( '_PAYPLAN_REORDER', 'Neuordnen' );
define( '_PAYPLAN_DETAIL', 'Einstellungen' );
define( '_ALTERNATIVE_PAYMENT',		'Bank&uuml;berweisung' );
define( '_SUBSCR_DATE', 'Anmeldedatum' );
define( '_ACTIVE_TITLE', 'Aktive Abonnements' );
define( '_ACTIVE_DESC', 'Diese Liste enth&auml;lt keine manuellen Abonnements, nur solche, die durch ein Zahlungsgateway abgeschlossen wurden.' );
define( '_LASTPAY_DATE', 'Datum der letzten Zahlung' );
define( '_USERPLAN', 'Plan' );
define( '_CANCELLED_TITLE', 'Abgebrochene Abonnements' );
define( '_CANCELLED_DESC', 'Diese Liste enth&auml;lt keine manuellen Abonnements, nur solche, die durch ein Zahlungsgateway abgeschlossen wurden. Es sind die Abonnements, die von den Benutzern abgebrochen wurden, aber noch nicht ausgelaufen sind.' );
define( '_CANCEL_DATE', 'Datum des Abbruches' );
define( '_MANUAL_DESC', 'Wird ein Eintrag gel&ouml;scht, wird der Benutzer vollst&auml;ndig aus der Datenbank gel&ouml;scht.' );
define( '_REPEND_ACTIVE',			'Wiederaufgenommen' );
define( '_FILTER_PLAN',				'- Plan ausw&auml;hlen -' );
define( '_BIND_USER',				'Zuweisen zu:' );
define( '_PLAN_FILTER',				'Abofilter:' );
define( '_CENTRAL_PAGE',			'Zentrale' );

// --== USER FORM ==--
define( '_HISTORY_COL_INVOICE', 'Rechnung');
define( '_HISTORY_COL_AMOUNT', 'Betrag');
define( '_HISTORY_COL_DATE', 'Bezahlt');
define( '_HISTORY_COL_METHOD', 'Methode');
define( '_HISTORY_COL_ACTION', 'Aktion');
define( '_HISTORY_COL_PLAN', 'Abo');
define( '_USERINVOICE_ACTION_REPEAT',	'Wiederholung' );
define( '_USERINVOICE_ACTION_CANCEL',	'l&ouml;schen' );
define( '_USERINVOICE_ACTION_CLEAR',	'als&nbsp;bezahlt&nbsp;markieren' );
define( '_USERINVOICE_ACTION_CLEAR_APPLY',	'als&nbsp;bezahlt&nbsp;markieren&nbsp;&amp;&nbsp;Abo&nbsp;anwenden' );

// --== BACKEND SETTINGS ==--

// TAB 1 - Global AEC Settings
define( '_CFG_TAB1_TITLE',				'Konfigurationsoptionen' );
define( '_CFG_TAB1_SUBTITLE', 'Optionen f&uuml;r die Interaktion mit dem Benutzer' );

define( '_CFG_GENERAL_SUB_ACCESS', 'Zugriff');
define( '_CFG_GENERAL_SUB_SYSTEM', 'System');
define( '_CFG_GENERAL_SUB_EMAIL', 'Email');
define( '_CFG_GENERAL_SUB_DEBUG', 'Debug');
define( '_CFG_GENERAL_SUB_REGFLOW', 'Registrationsablauf');
define( '_CFG_GENERAL_SUB_PLANS', 'Abonnements');
define( '_CFG_GENERAL_SUB_CONFIRMATION', 'Best&auml;tigungsseite');
define( '_CFG_GENERAL_SUB_CHECKOUT', 'Bezahlseite');
define( '_CFG_GENERAL_SUB_PROCESSORS', 'Bezahldienste');
define( '_CFG_GENERAL_SUB_SECURITY', 'Sicherheit');

define( '_CFG_GENERAL_ALERTLEVEL2_NAME',			'Alarmebene 2:' );
define( '_CFG_GENERAL_ALERTLEVEL2_DESC',			'In Tagen. Dies ist die erste Grenze, die beginnt den Benutzer auf den Auslauf seines Abonnements hinzuweisen.' );
define( '_CFG_GENERAL_ALERTLEVEL1_NAME',			'Alarmebene 1:' );
define( '_CFG_GENERAL_ALERTLEVEL1_DESC',			'In Tagen. Dies ist die letzte Grenze, die beginnt den Benutzer auf den Auslauf seines Abonnements hinzuweisen.' );
define( '_CFG_GENERAL_ENTRY_PLAN_NAME',			'Einstiegsplan:' );
define( '_CFG_GENERAL_ENTRY_PLAN_DESC',			'Jeder Benutzer wird - wenn bisher kein Abonnement besteht - ohne Bezahlung diesem Plan zugewiesen' );
define( '_CFG_GENERAL_REQUIRE_SUBSCRIPTION_NAME',			'Erfordert Abonnement:' );
define( '_CFG_GENERAL_REQUIRE_SUBSCRIPTION_DESC',			'Wenn aktiviert, <strong>muss</strong> der Benutzer ein g&uuml;ltiges Abonnement besitzen. Nicht aktiviert, Benutzer k&ouml;nnen ohne Abo einloggen.' );

define( '_CFG_GENERAL_GWLIST_NAME',			'Gateway Erkl&auml;rungen:' );
define( '_CFG_GENERAL_GWLIST_DESC',			'Hier Bezahlm&ouml;glichkeiten markieren welche auf der Nichterlaubt-Seite angezeigt werden sollen (diese Liste sehen die Benutzer, wenn sie versuchen eine Seite anzusehen, f&uuml;r die sie keine Berechtigung haben).<br /><strong>Hinweis: es werden nur die oben, zur Zeit Aktiven angezeigt</strong>' );
define( '_CFG_GENERAL_GWLIST_ENABLED_NAME',			'Aktivierte Zahlungsgateways:' );
define( '_CFG_GENERAL_GWLIST_ENABLED_DESC',			'Alle Bezahldienste markieren, welche aktiv sein sollen (STRG-Taste dr&uuml;cken f&uuml;r mehrere).<br /><strong>Um die ge&auml;nderten Einstellungen anzuzeigen, den Button Speichern anklicken</strong><br />Deaktivieren eines Bezahldienste l&ouml;scht nicht die bisherigen Einstellungen.' );

define( '_CFG_GENERAL_BYPASSINTEGRATION_NAME',			'Komponenten abschalten:' );
define( '_CFG_GENERAL_BYPASSINTEGRATION_DESC',			'Alle zu deaktivierenden Zusatzkomponenten angeben (mit Komma trennen!). Zur Zeit werden unterst&uuml;tzt: <strong>CB,CBE,CBM,JACL,SMF,UE,UHP2,VM</strong>.<br />Sollte z.B. CB (CommunityBuilder) deinstalliert werden aber dessen Datenbanktabellen noch vorhanden sein, jedoch hier <strong>kein</strong> Eintrag vermerkt sein, wird AEC dann weiterhin CB als installiert ansehen!.' );

define( '_CFG_GENERAL_SIMPLEURLS_NAME',			'Einfache URLs:' );
define( '_CFG_GENERAL_SIMPLEURLS_DESC',			'SEF-URLs der jeweiligen Komponenten abschalten. Falls bei der Verwendung von SEF-URLs Fehler auftauchen (FEHLER 404) wurde in der SEF-Konfiguration ein Fehler gemacht - das Abschalten dieser Option hier kann diese Fehler beseitigen.' );
define( '_CFG_GENERAL_EXPIRATION_CUSHION_NAME',			'Ablaufschonfrist:' );
define( '_CFG_GENERAL_EXPIRATION_CUSHION_DESC',			'Anzahl der Stunden welche AEC als Polster nimmt bevor der Account abgeschalten wird. Es sollte bedacht werden, dass der Zahlungseingang etliche Stunden dauern kann (t.w. bis zu 14 Stunden!)' );
define( '_CFG_GENERAL_HEARTBEAT_CYCLE_NAME',			'Cronjob Zyklus:' );
define( '_CFG_GENERAL_HEARTBEAT_CYCLE_DESC',			'Anzahl der Stunden die AEC als Trigger nimmt um anstehende, wiederkehrende Aktionen (wie z.B. Emailversand) auszuf&uuml;hren.' );
define( '_CFG_GENERAL_ROOT_GROUP_NAME', 'Stammgruppe:');
define( '_CFG_GENERAL_ROOT_GROUP_DESC', 'W&auml;hlen Sie die Stammgruppe, die dem Benutzer angezeigt wird, wenn er auf die Seite mit den Pl&auml;nen ohne eine voreingestellte Variable zugreift.');
define( '_CFG_GENERAL_ROOT_GROUP_RW_NAME', 'dynamische Stammgruppe:');
define( '_CFG_GENERAL_ROOT_GROUP_RW_DESC', 'Hier k&ouml;nnen Sie dynamischen Code mit der RewriteEngine angeben, welcher die Stammgruppe bestimmt, die dem Benutzer angezeigt wird, wenn er auf die Seite mit den Pl&auml;nen zugreift. Falls der dynamische Code kein Ergebnis zur&uuml;ckgibt wird die obige Variable verwendet.');
define( '_CFG_GENERAL_PLANS_FIRST_NAME',			'Plan Zuerst:' );
define( '_CFG_GENERAL_PLANS_FIRST_DESC',			'Wenn alle Zusatzkomponenten mit einer Aboaktion verbunden sind, zeigt diese Option die Bezahlpl&auml;ne zuerst. Falls das nicht gew&uuml;nscht ist oder nur die erste Integrationsm&ouml;glichkeit zur Auswahl stehen soll, dann hier nicht aktivieren - die Aboauswahl kommt dann <strong>nach</strong> der Anmeldung/Registrierung.' );
define( '_CFG_GENERAL_INTEGRATE_REGISTRATION_NAME', 'Registrierung integrieren');
define( '_CFG_GENERAL_INTEGRATE_REGISTRATION_DESC', 'Mit diesem Schalter leiten Sie einen Registrierungsaufruf zum AEC Abosystem weiter. Wenn diese Option ausgeschaltet ist, w&uuml;rden sich die Benutzer frei registrieren und, wenn ein Abo erforderlich ist, sich bei ihrem ersten Einloggen f&uuml;r ein Abo entscheiden. Wenn Beides, diese Option und "Erfordert Abo", deaktiviert sind, ist das Abonnement freigestellt.');

define( '_CFG_TAB_CUSTOMIZATION_TITLE',	'Anpassen' );
define( '_CFG_TAB_CUSTOMIZATION_SUBTITLE', 'Anpassungen');

define( '_CFG_CUSTOMIZATION_SUB_CREDIRECT', 'eigene Weiterleitung');
define( '_CFG_CUSTOMIZATION_SUB_PROXY', 'Proxy');
define( '_CFG_CUSTOMIZATION_SUB_BUTTONS_SUB', 'Mitgliedschafts Buttons');
define( '_CFG_CUSTOMIZATION_SUB_FORMAT_DATE', 'Format - Datum');
define( '_CFG_CUSTOMIZATION_SUB_FORMAT_PRICE', 'Format - Preis');
define( '_CFG_CUSTOMIZATION_SUB_FORMAT_INUM', 'Format - Rechnungsnummer');
define( '_CFG_CUSTOMIZATION_SUB_CAPTCHA', 'ReCAPTACHA');

define( '_CFG_GENERAL_CUSTOMINTRO_NAME',			'Individuelle Einstiegsseite:' );
define( '_CFG_GENERAL_CUSTOMINTRO_DESC',			'Hier den kompletten Link (inkl. http://) angeben, der zur Einstiegsseite f&uuml;hren soll. Diese Seite sollte einen Link wie z.B. http://www.yourdomain.com/index.php?option=com_acctexp&amp;task=subscribe&amp;intro=1 beinhalten, welcher die Einf&uuml;hrung &uuml;bergeht und den Benutzer direkt zur Aboseite oder Registrierungsseite f&uuml;hrt.<br />Wenn diese Option nicht gew&uuml;nscht wird, dann dieses Feld leer lassen.' );
define( '_CFG_GENERAL_CUSTOMINTRO_USERID_NAME', 'Benutzer ID weiterleiten');
define( '_CFG_GENERAL_CUSTOMINTRO_USERID_DESC', 'Die Benutzer ID in einer Joomla-Systembenachrichtigung anzeigen. Das kann bei selbst erstellten Bezahlplan-Seiten hilfreich sein, wenn der Benutzer nicht eingeloggt ist, aber trotzdem eine Mitgliedschaft kaufen m&ouml;chte. Mit Javascript kann der Wert aus der Systembenachrichtigung in die Formulare kopiert werden.');
define( '_CFG_GENERAL_CUSTOMINTRO_ALWAYS_NAME', 'Intro immer zeigen');
define( '_CFG_GENERAL_CUSTOMINTRO_ALWAYS_DESC', 'Intro anzeigen, egal, ob der Benutzer bereits registriert ist.');
define( '_CFG_GENERAL_CUSTOMTHANKS_NAME',			'Link zu individueller Dankeseite:' );
define( '_CFG_GENERAL_CUSTOMTHANKS_DESC',			'Kompletten Link (inkl. http://) angeben welchen die Besucher zur Dankeseite f&uuml;hrt. Wenn nicht gew&uuml;nscht dann leer lassen.' );
define( '_CFG_GENERAL_CUSTOMCANCEL_NAME',			'Link zu individueller Abbruchseite:' );
define( '_CFG_GENERAL_CUSTOMCANCEL_DESC',			'Kompletten Link (inkl. http://) angeben welchen die Besucher - wenn Abbruch - zu dieser  Seite f&uuml;hrt. Wenn nicht gew&uuml;nscht dann leer lassen.' );
define( '_CFG_GENERAL_TOS_NAME',			'Link zu den AGBs:' );
define( '_CFG_GENERAL_TOS_DESC',			'Hier den Link zu den AGBS angeben. Die Benutzer m&uuml;ssen dann dort zum Einverst&auml;ndnis eine Checkbox aktivieren. Leer lassen wenn nicht gew&uuml;nscht' );
define( '_CFG_GENERAL_TOS_IFRAME_NAME', 'AGB Iframe:');
define( '_CFG_GENERAL_TOS_IFRAME_DESC', 'Die Nutzungsbedingungen anzeigen (wie oben angegeben) in einem iframe auf der Best&auml;tigungsseite');
define( '_CFG_GENERAL_CUSTOMNOTALLOWED_DESC',	'Hier den kompletten Link (inkl. http://) angeben welche die Besucher zur Nichterlaubtseite f&uuml;hrt. Leer lassen wenn nicht gew&uuml;nscht.' );

define( '_CFG_CUSTOMIZATION_INVOICE_PRINTOUT', 'Invoice Printout');
define( '_CFG_CUSTOMIZATION_INVOICE_PRINTOUT_DETAILS', 'Invoice Printout Details');

define( '_CFG_TAB_CUSTOMINVOICE_TITLE', 'Invoice Customization');
define( '_CFG_TAB_CUSTOMINVOICE_SUBTITLE', 'Invoice Customization');
define( '_CFG_TAB_CUSTOMPAGES_TITLE', 'Page Customization');
define( '_CFG_TAB_CUSTOMPAGES_SUBTITLE', 'Page Customization');
define( '_CFG_TAB_EXPERT_TITLE', 'Expert');
define( '_CFG_TAB_EXPERT_SUBTITLE', 'Expert Settings');

define( '_AEC_CUSTOM_INVOICE_PAGE_TITLE', 'Rechnung');
define( '_AEC_CUSTOM_INVOICE_HEADER', 'Rechnung');
define( '_AEC_CUSTOM_INVOICE_BEFORE_CONTENT', 'Rechnung &uuml;ber:');
define( '_AEC_CUSTOM_INVOICE_AFTER_CONTENT', 'Vielen Dank, dass Sie sich f&uuml;r uns entschieden haben!');
define( '_AEC_CUSTOM_INVOICE_FOOTER', ' - Hier weitere Informationen einf&uuml;gen - ');

define( '_CFG_GENERAL_INVOICE_PAGE_TITLE', 'Rechnung');
define( '_CFG_GENERAL_INVOICE_PAGE_TITLE_NAME', 'Seiten Titel');
define( '_CFG_GENERAL_INVOICE_PAGE_TITLE_DESC', 'Seitentitel des Rechnungsausdruckes');
define( '_CFG_GENERAL_INVOICE_HEADER_NAME', 'Text Kopfzeile');
define( '_CFG_GENERAL_INVOICE_HEADER_DESC', 'Kopfzeilen Text f&uuml;r den Rechnungsausdruck');
define( '_CFG_GENERAL_INVOICE_AFTER_HEADER_NAME', 'Text nach Kopfzeile');
define( '_CFG_GENERAL_INVOICE_AFTER_HEADER_DESC', 'Text nach Kopfzeile f&uuml;r den Rechnungsausdruck');
define( '_CFG_GENERAL_INVOICE_ADDRESS_NAME', 'Text im Adress-Feld');
define( '_CFG_GENERAL_INVOICE_ADDRESS_DESC', 'Text im Adress-Feld des Ausdrucks');
define( '_CFG_GENERAL_INVOICE_ADDRESS_ALLOW_EDIT_NAME', 'Benutzer darf Addresse bearbeiten');
define( '_CFG_GENERAL_INVOICE_ADDRESS_ALLOW_EDIT_DESC', 'Mit dieser Option kann der Benutzer die Rechnungsanschrift auf der Ausdrucksseite eintragen oder korrigieren.');
define( '_CFG_GENERAL_INVOICE_BEFORE_CONTENT_NAME', 'Text vor Inhalt');
define( '_CFG_GENERAL_INVOICE_BEFORE_CONTENT_DESC', 'Text vor Inhalt f&uuml;r den Rechnungsausdruck');
define( '_CFG_GENERAL_INVOICE_AFTER_CONTENT_NAME', 'Text nach Inhalt');
define( '_CFG_GENERAL_INVOICE_AFTER_CONTENT_DESC', 'Text nach Inhalt f&uuml;r den Rechnungsausdruck');
define( '_CFG_GENERAL_INVOICE_BEFORE_FOOTER_NAME', 'Text vor Fu&szlig;zeile');
define( '_CFG_GENERAL_INVOICE_BEFORE_FOOTER_DESC', 'Text vor Fu&szlig;zeile f&uuml;r den Rechnungsausdruck');
define( '_CFG_GENERAL_INVOICE_FOOTER_NAME', 'Fu&szlig;zeile');
define( '_CFG_GENERAL_INVOICE_FOOTER_DESC', 'Text vor Fu&szlig;zeile f&uuml;r den Rechnungsausdruck');
define( '_CFG_GENERAL_INVOICE_AFTER_FOOTER_NAME', 'Text nach Fu&szlig;zeile');
define( '_CFG_GENERAL_INVOICE_AFTER_FOOTER_DESC', 'Text nach Fu&szlig;zeile f&uuml;r den Rechnungsausdruck');

define( '_CFG_GENERAL_CHECKOUT_DISPLAY_DESCRIPTIONS_NAME', 'Beschreibungen anzeigen:');
define( '_CFG_GENERAL_CHECKOUT_DISPLAY_DESCRIPTIONS_DESC', 'Wenn Sie mehrere Pl&auml;ne an der Kasse haben, oder die Best&auml;tigung &uuml;bersprungen haben, k&ouml;nnte es hilfreich sein, die Planbeschreibung erneut anzuzeigen. Dieser Schalter tut das.');
define( '_CFG_GENERAL_CHECKOUT_AS_GIFT_NAME', 'Kauf als Geschenk:');
define( '_CFG_GENERAL_CHECKOUT_AS_GIFT_DESC', 'Mit dieser Option k&ouml;nnen Benutzer den Kauf einer Mitgliedschaft an einen anderen Benutzer verschenken.');
define( '_CFG_GENERAL_CHECKOUT_AS_GIFT_ACCESS_NAME', 'Geschenk Einschr&auml;nkung:');
define( '_CFG_GENERAL_CHECKOUT_AS_GIFT_ACCESS_DESC', 'Welche Benutzergruppe ist mindestens zur Benutzung der Geschenkoption erforderlich?');
define( '_CFG_GENERAL_CONFIRM_AS_GIFT_NAME', 'Geschenkoption Best&auml;tigen-Seite:');
define( '_CFG_GENERAL_CONFIRM_AS_GIFT_DESC', 'Die Angabe eines Geschenk-empf&auml;ngers auch auf der Best&auml;tigen-Seite anbieten.');

define( '_CFG_GENERAL_DISPLAY_DATE_FRONTEND_NAME',	'Frontend Datumsformat' );
define( '_CFG_GENERAL_DISPLAY_DATE_FRONTEND_DESC',	'Hier angeben wie die Datumsangaben den Besuchern gegen&uuml;ber erfolgen sollen. Mehr dazu im <a href="http://www.php.net/manual/de/function.strftime.php" target="_blank" title="PHP Handbuch">PHP Handbuch</a>' );
define( '_CFG_GENERAL_DISPLAY_DATE_BACKEND_NAME',	'Backend Datumsformat' );
define( '_CFG_GENERAL_DISPLAY_DATE_BACKEND_DESC',	'Hier angeben wie die Datumsangaben im Backend erfolgen sollen. Mehr dazu im <a href="http://www.php.net/manual/de/function.strftime.php" target="_blank" title="PHP Handbuch">PHP Handbuch</a>' );

define( '_CFG_GENERAL_INVOICENUM_DOFORMAT_NAME', 'Rechnungsnummer formatieren');
define( '_CFG_GENERAL_INVOICENUM_DOFORMAT_DESC', 'Anstatt der System-Rechnungsnummer eine eigene Formatierung (im n&auml;chsten Feld) angeben.');
define( '_CFG_GENERAL_INVOICENUM_FORMATTING_NAME', 'Formatierung');
define( '_CFG_GENERAL_INVOICENUM_FORMATTING_DESC', 'Ihre eigene Formatierung - Hier kann die ReWrite Engine benutzt werden.');

define( '_CFG_GENERAL_CUSTOMTEXT_PLANS_NAME',		'Text Abo&uuml;bersicht' );
define( '_CFG_GENERAL_CUSTOMTEXT_PLANS_DESC',		'Individueller Text zur &Uuml;bersicht der Abonnements' );
define( '_CFG_GENERAL_CUSTOMTEXT_CONFIRM_NAME',		'Text Best&auml;tigungsseite' );
define( '_CFG_GENERAL_CUSTOMTEXT_CONFIRM_DESC',		'Individueller Text der Best&auml;tigungsseite' );
define( '_CFG_GENERAL_CUSTOM_CONFIRM_USERDETAILS_NAME', 'Eigener Text Benutzerdetails');
define( '_CFG_GENERAL_CUSTOM_CONFIRM_USERDETAILS_DESC', 'Anstatt der Standard-Benutzerdetails, diesen Text anzeigen');
define( '_CFG_GENERAL_CUSTOMTEXT_CHECKOUT_NAME',	'Text Checkout Seite' );
define( '_CFG_GENERAL_CUSTOMTEXT_CHECKOUT_DESC',	'Individueller Text der Checkoutseite' );
define( '_CFG_GENERAL_CUSTOMTEXT_NOTALLOWED_NAME',	'Text Nichterlaubt Seite' );
define( '_CFG_GENERAL_CUSTOMTEXT_NOTALLOWED_DESC',	'Individueller Text der Nichterlaubtseite' );
define( '_CFG_GENERAL_CUSTOMTEXT_PENDING_NAME',		'Text Warteseite' );
define( '_CFG_GENERAL_CUSTOMTEXT_PENDING_DESC',		'Individueller Text der Warteseite' );
define( '_CFG_GENERAL_CUSTOMTEXT_EXPIRED_NAME',		'Text Abgelaufenseite' );
define( '_CFG_GENERAL_CUSTOMTEXT_EXPIRED_DESC',		'Individueller Text der Abgelaufenseite' );

define( '_CFG_GENERAL_CUSTOMTEXT_CONFIRM_KEEPORIGINAL_NAME',	'Behalte Originaltext' );
define( '_CFG_GENERAL_CUSTOMTEXT_CONFIRM_KEEPORIGINAL_DESC',	'Diese Option aktivieren, wenn der Originaltext auf der Best&auml;tigungseite angezeigt werden soll (anstatt des Individuellen)' );
define( '_CFG_GENERAL_CUSTOMTEXT_CHECKOUT_KEEPORIGINAL_NAME',	'Behalte Originaltext' );
define( '_CFG_GENERAL_CUSTOMTEXT_CHECKOUT_KEEPORIGINAL_DESC',	'Diese Option aktivieren, wenn der Originaltext auf der Checkoutseite angezeigt werden soll (anstatt des Individuellen)' );
define( '_CFG_GENERAL_CUSTOMTEXT_NOTALLOWED_KEEPORIGINAL_NAME', 'Behalte Originaltext' );
define( '_CFG_GENERAL_CUSTOMTEXT_NOTALLOWED_KEEPORIGINAL_DESC', 'Diese Option aktivieren, wenn der Originaltext auf der Nichterlaubtseite angezeigt werden soll (anstatt des Individuellen)' );
define( '_CFG_GENERAL_CUSTOMTEXT_PENDING_KEEPORIGINAL_NAME',	'Behalte Originaltext' );
define( '_CFG_GENERAL_CUSTOMTEXT_PENDING_KEEPORIGINAL_DESC',	'Diese Option aktivieren, wenn der Originaltext auf der Warteseite angezeigt werden soll (anstatt des Individuellen)' );
define( '_CFG_GENERAL_CUSTOMTEXT_EXPIRED_KEEPORIGINAL_NAME',	'Behalte Originaltext' );
define( '_CFG_GENERAL_CUSTOMTEXT_EXPIRED_KEEPORIGINAL_DESC',	'Diese Option aktivieren, wenn der Originaltext auf der Abgelaufenseite angezeigt werden soll (anstatt des Individuellen)' );

define( '_CFG_GENERAL_CUSTOMTEXT_THANKS_KEEPORIGINAL_NAME', 'Behalte Originaltext');
define( '_CFG_GENERAL_CUSTOMTEXT_THANKS_KEEPORIGINAL_DESC', 'Diese Option aktivieren, wenn der Originaltext auf der Danke-Seite angezeigt werden soll');
define( '_CFG_GENERAL_CUSTOMTEXT_THANKS_NAME', 'eigener Text auf der Danke-Seite');
define( '_CFG_GENERAL_CUSTOMTEXT_THANKS_DESC', 'Text, der auf der Danke-Seite angezeigt wird');
define( '_CFG_GENERAL_CUSTOMTEXT_CANCEL_KEEPORIGINAL_NAME', 'Behalte Originaltext');
define( '_CFG_GENERAL_CUSTOMTEXT_CANCEL_KEEPORIGINAL_DESC', 'Diese Option aktivieren, wenn der Originaltext auf der Abbrechen-Seite angezeigt werden soll');
define( '_CFG_GENERAL_CUSTOMTEXT_CANCEL_NAME', 'eigener Text Abbruch-Seite');
define( '_CFG_GENERAL_CUSTOMTEXT_CANCEL_DESC', 'Text, der auf der Abbrechen-Seite angezeigt wird');

define( '_CFG_GENERAL_CUSTOMTEXT_HOLD_KEEPORIGINAL_NAME', 'Behalte Originaltext');
define( '_CFG_GENERAL_CUSTOMTEXT_HOLD_KEEPORIGINAL_DESC', 'Diese Option aktivieren, wenn der Originaltext auf der Warten-Seite angezeigt werden soll');
define( '_CFG_GENERAL_CUSTOMTEXT_HOLD_NAME', 'eigener Text Warten-Seite');
define( '_CFG_GENERAL_CUSTOMTEXT_HOLD_DESC', 'Text, der auf der Warten-Seite angezeigt wird');

define( '_CFG_GENERAL_CUSTOMTEXT_EXCEPTION_KEEPORIGINAL_NAME', 'Behalte Originaltext');
define( '_CFG_GENERAL_CUSTOMTEXT_EXCEPTION_KEEPORIGINAL_DESC', 'Diese Option aktivieren, wenn der Originaltext auf der Ausnahme-Seite angezeigt werden soll');
define( '_CFG_GENERAL_CUSTOMTEXT_EXCEPTION_NAME', 'eigener Text Ausnahme-Seite');
define( '_CFG_GENERAL_CUSTOMTEXT_EXCEPTION_DESC', 'Text, der auf der Ausnahme-Seite angezeigt wird (normalerweise aufgerufen, wenn ein Benutzer angeben muss, welchen Bezahldienst er f&uuml;r einen Einkaufswagen nutzen m&ouml;chte oder auf welches Item der Gutschein angewendet werden soll).');

define( '_CFG_GENERAL_USE_RECAPTCHA_NAME', 'ReCAPTCHA benutzen');
define( '_CFG_GENERAL_USE_RECAPTCHA_DESC', 'Wenn Sie einen Account haben f&uuml;r <a href="http://recaptcha.net/">ReCAPTCHA</a>, k&ouml;nnen Sie diese Option aktivieren. Vergessen Sie NICHT, ihren Benutzerschl&uuml;ssel einzutragen.');
define( '_CFG_GENERAL_RECAPTCHA_PRIVATEKEY_NAME', 'Private ReCAPTCHA Key');
define( '_CFG_GENERAL_RECAPTCHA_PRIVATEKEY_DESC', 'Ihr Private ReCAPTCHA Key.');
define( '_CFG_GENERAL_RECAPTCHA_PUBLICKEY_NAME', 'Public ReCAPTCHA Key');
define( '_CFG_GENERAL_RECAPTCHA_PUBLICKEY_DESC', 'Ihr Public ReCAPTCHA Key.');

define( '_CFG_GENERAL_TEMP_AUTH_EXP_NAME', 'Rechnungszugriff ohne Login');
define( '_CFG_GENERAL_TEMP_AUTH_EXP_DESC', 'Die Zeit (in Minuten), in der ein Benutzer auf eine Rechnung zugreifen kann, nur indem er sich auf die User ID bezieht. Wenn diese Zeitspanne ausl&auml;ft, wird ein Passwort verlangt, bevor man wieder Zugriff in dieser Zeitspanne bekommt.');

define( '_CFG_GENERAL_HEARTBEAT_CYCLE_BACKEND_NAME',			'Heartbeat Zyklus Backend:' );
define( '_CFG_GENERAL_HEARTBEAT_CYCLE_BACKEND_DESC',			'Heartbeat - Herzklopfen: h&auml;lt verschiedene Funktionen am Leben. Hier die Anzahl der Stunden angeben welche AEC als Abhorchrythmus nehmen soll um dann die weitere Funktionen auszuf&uuml;hren' );
define( '_CFG_GENERAL_ENABLE_COUPONS_NAME',				'Gutscheine Aktiviert:' );
define( '_CFG_GENERAL_ENABLE_COUPONS_DESC',				'Sollen Gutscheine akzeptiert werden' );
define( '_CFG_GENERAL_DISPLAYCCINFO_NAME',				'Zeige Kreditkartenicons:' );
define( '_CFG_GENERAL_DISPLAYCCINFO_DESC',				'Sollen die Icons f&uuml;r jedes Gateway angezeigt werden' );
define( '_CFG_GENERAL_ADMINACCESS_NAME', 'Administrator Zugriff:');
define( '_CFG_GENERAL_ADMINACCESS_DESC', 'Hiermit d&uuml;rfen nicht nur Super Administratoren, sondern auch normale Administratoren auf das AEC Backend zugreifen.');
define( '_CFG_GENERAL_NOEMAILS_NAME', 'Keine Emails');
define( '_CFG_GENERAL_NOEMAILS_DESC', 'Mit dieser Einstellung versendet die AEC keine System-Emails mehr (bei Bezahlung einer Rechnung etc.), andere Emails, z.B. von MicroIntegrationen sind hiervon nicht betroffen.');
define( '_CFG_GENERAL_NOJOOMLAREGEMAILS_NAME', 'Keine Joomla Emails');
define( '_CFG_GENERAL_NOJOOMLAREGEMAILS_DESC', 'Mit dieser Einstellung verhindern Sie das versenden von Joomla Registrations-Best&auml;tigungsmails.');
define( '_CFG_GENERAL_DEBUGMODE_NAME', 'Debug Mode');
define( '_CFG_GENERAL_DEBUGMODE_DESC', 'Aktiviert die Anzeige von Debug Informationen.');
define( '_CFG_GENERAL_OVERRIDE_REQSSL_NAME', 'SSL Zwang abschalten');
define( '_CFG_GENERAL_OVERRIDE_REQSSL_DESC', 'Einige Bezahldienste ben&ouml;tigen eine SSL gesicherte Verbindung zum Benutzer - beispielsweise, wenn sensible Informationen (wie Kreditkarten-Daten) im Frontend gefordert sind. Mit dieser Option kann dies (zu Testzwecken) abgeschaltet werden.');
define( '_CFG_GENERAL_ALTSSLURL_NAME', 'Alternative SSL Url');
define( '_CFG_GENERAL_ALTSSLURL_DESC', 'Benutzen Sie diese URL statt der normalen Joomla URL wenn SSL verwendet wird.');
define( '_CFG_GENERAL_OVERRIDEJ15_NAME', 'Joomla 1.5 Modus deaktivieren');
define( '_CFG_GENERAL_OVERRIDEJ15_DESC', 'Manche Addons tricksen 1.0 Joomla aus, indem es denkt, es w&auml;re in Wirklichkeit 1.5 (Sie wissen, wer Sie sind! Unterbinden Sie das!) - dem folgt AEC und scheitert. This makes a permanent switch forcing 1.0 mode.');
define( '_CFG_GENERAL_SSL_SIGNUP_NAME', 'SSL Anmeldung');
define( '_CFG_GENERAL_SSL_SIGNUP_DESC', 'SSL Verschl&uuml;sselung auf allen Links, die damit zu tun haben, dass der Benutzer sich innerhalb AEC anmeldet.');
define( '_CFG_GENERAL_SSL_PROFILE_NAME', 'SSL im Profil');
define( '_CFG_GENERAL_SSL_PROFILE_DESC', 'SSL Verschl&uuml;sselung auf allen Links benutzen, die damit zu tun haben, dass der Benutzer auf das Profil zugreift ("Meine Mitgliedschaft").');
define( '_CFG_GENERAL_SSL_VERIFYPEER_NAME', 'SSL Peer Verification');
define( '_CFG_GENERAL_SSL_VERIFYPEER_DESC', 'When using cURL, make it verify the peer\'s certificate. Alternate certificates to verify against can be specified with the options below');
define( '_CFG_GENERAL_SSL_VERIFYHOST_NAME', 'SSL Host Verification');
define( '_CFG_GENERAL_SSL_VERIFYHOST_DESC', 'Defines what kind of verification against the peer\'s certificate you want.');
define( '_CFG_GENERAL_SSL_CAINFO_NAME', 'Zertifikat Datei');
define( '_CFG_GENERAL_SSL_CAINFO_DESC', 'Datei, welche Zertifikate enth&auml;lt um einen Peer zu verifizieren. Nur in Verbindung mit Peer Verification zu verwenden.');
define( '_CFG_GENERAL_SSL_CAPATH_NAME', 'Zertifikate Ordner');
define( '_CFG_GENERAL_SSL_CAPATH_DESC', 'Verzeichnis, welches Zertifikate enth&auml;lt um einen Peer zu verifizieren. Nur in Verbindung mit Peer Verification zu verwenden.');
define( '_CFG_GENERAL_USE_PROXY_NAME', 'Benutze Proxy');
define( '_CFG_GENERAL_USE_PROXY_DESC', 'Benutzen Sie einen Proxy Server f&uuml;r alle ausgehenden Anfragen.');
define( '_CFG_GENERAL_PROXY_NAME', 'Proxy Adresse');
define( '_CFG_GENERAL_PROXY_DESC', 'Spezifizieren Sie den Proxy Server, mit dem Sie verbinden wollen.');
define( '_CFG_GENERAL_PROXY_PORT_NAME', 'Proxy Port');
define( '_CFG_GENERAL_PROXY_PORT_DESC', 'Spezifizieren Sie den Port des Proxy Servers, mit dem Sie verbinden wollen.');
define( '_CFG_GENERAL_PROXY_USERNAME_NAME', 'Proxy Benutzername');
define( '_CFG_GENERAL_PROXY_USERNAME_DESC', 'Falls Sie f&uuml;r ihren Proxy einen eigenen Benutzernamen ben&ouml;tigen, diesen bitte hier angeben.');
define( '_CFG_GENERAL_PROXY_PASSWORD_NAME', 'Proxy Passwort');
define( '_CFG_GENERAL_PROXY_PASSWORD_DESC', 'Das Passwort f&uuml;r ihren Proxy Benutzer.');
define( '_CFG_GENERAL_GETHOSTBYADDR_NAME', 'Log Host with IP');
define( '_CFG_GENERAL_GETHOSTBYADDR_DESC', 'On logging Events that store an IP address, this option will also store the internet host name as well. In some hosting situations, this can take over a minute and thus should be disabled.');
define( '_CFG_GENERAL_RENEW_BUTTON_NEVER_NAME', 'kein Erneuern-Schalter');
define( '_CFG_GENERAL_RENEW_BUTTON_NEVER_DESC', 'W&auml;hlen Sie "ja", um niemals den Erneuern/Upgrade-Schalter auf der Meine-Abos-Seite zu zeigen.');
define( '_CFG_GENERAL_RENEW_BUTTON_NOLIFETIMERECURRING_NAME', 'Eingeschr&auml;nkter Erneuern-Schalter');
define( '_CFG_GENERAL_RENEW_BUTTON_NOLIFETIMERECURRING_DESC', 'Der Erneuern-Schalter wird nur gezeigt, wenn es in einem "Nur ein Abo pro Benutzer gleichzeitig" Aufbau (wiederkehrende Zahlungen oder lebensl&auml;nglich lassen den Schalter verschwinden) Sinn macht.');
define( '_CFG_GENERAL_CONTINUE_BUTTON_NAME', 'Verl&auml;ngern-Schalter');
define( '_CFG_GENERAL_CONTINUE_BUTTON_DESC', 'Wenn der Benutzer zuvor bereits eine Mitgliedschaft hatte, wird dieser Schalter auf dem Ablaufdatums-Bildschirm angezeigt und direkt zu dem vorherigen Plan verlinken, so dass der Benutzer seine Mitgliedschaft schneller verl&auml;ngern kann, so wie sie zuvor war');

define( '_CFG_GENERAL_ERROR_NOTIFICATION_LEVEL_NAME', 'Schweregrad Backend Benachrichtigung');
define( '_CFG_GENERAL_ERROR_NOTIFICATION_LEVEL_DESC', 'W&auml;hlen Sie, welcher Schweregrad eines Eintrags in das EventLog erforderlich ist, damit er auf der auf der AEC Seite erscheint.');
define( '_CFG_GENERAL_EMAIL_NOTIFICATION_LEVEL_NAME', 'Schweregrad Email Benachrichtigung');
define( '_CFG_GENERAL_EMAIL_NOTIFICATION_LEVEL_DESC', 'W&auml;hlen Sie, welcher Schweregrad eines Eintrags in das EventLog erforderlich ist, damit er als E-Mail an den Administrator geschickt wird.');

define( '_CFG_GENERAL_SKIP_CONFIRMATION_NAME', 'Best&auml;tigungs-Seite &uuml;berspringen');
define( '_CFG_GENERAL_SKIP_CONFIRMATION_DESC', 'Die Best&auml;tigungs-Seite &uuml;berspringen (welche dem Benutzer erm&ouml;glicht, seine Angaben zu &uuml;berpr&uuml;fen).');
define( '_CFG_GENERAL_SHOW_FIXEDDECISION_NAME', 'Feste Entscheidungen anzeigen');
define( '_CFG_GENERAL_SHOW_FIXEDDECISION_DESC', 'AEC &uuml;berspringt normalerweise die Seite mit den Bezahlpl&uuml;nen, wenn es keine Entscheidung gibt, die getroffen werden muss (ein Bezahlplan mit nur einem Bezahldienst). Mit dieser Option, k&ouml;nnen Sie es dazu zwingen, die Seite anzuzeigen.');
define( '_CFG_GENERAL_CONFIRMATION_COUPONS_NAME', 'Gutscheine auf Best&auml;tigungs-Seite');
define( '_CFG_GENERAL_CONFIRMATION_COUPONS_DESC', 'Die Angabe von Gutschein-Codes auf der Best&auml;tigungs-Seite erlauben');
define( '_CFG_GENERAL_BREAKON_MI_ERROR_NAME', 'Bei MI Fehler abbrechen');
define( '_CFG_GENERAL_BREAKON_MI_ERROR_DESC', 'Die Anwendung eines Abos abbrechen, wenn eine der MIs einen Fehler meldet');

define( '_CFG_GENERAL_ENABLE_SHOPPINGCART_NAME', 'Freigabe Einkaufswagen');
define( '_CFG_GENERAL_ENABLE_SHOPPINGCART_DESC', 'Eink&auml;ufe &uuml;ber Einkaufswagen verwalten. Nur f&uuml;r angemeldete Benutzer zug&uuml;nglich.');
define( '_CFG_GENERAL_CUSTOMLINK_CONTINUESHOPPING_NAME', 'eigener Einkauf-fortf&uuml;hren-Link');
define( '_CFG_GENERAL_CUSTOMLINK_CONTINUESHOPPING_DESC', 'Vom Einkauf-fortf&uuml;hren-Link nicht zur Standard-Seite, sondern zu dieser weiterleiten.');
define( '_CFG_GENERAL_ADDITEM_STAYONPAGE_NAME', 'Auf der Seite bleiben');
define( '_CFG_GENERAL_ADDITEM_STAYONPAGE_DESC', 'Anstatt zum Einkaufswagen zu leiten, nachdem ein Item ausgew&auml;hlt wurde, auf derselben Seite bleiben.');

define( '_CFG_GENERAL_CURL_DEFAULT_NAME', 'cURL benutzen');
define( '_CFG_GENERAL_CURL_DEFAULT_DESC', 'cURL benutzen statt fsockopen als Standard (wird auf das andere zur&uuml;ckgreifen, wenn die erste W%auml;hl scheitert)');
define( '_CFG_GENERAL_AMOUNT_CURRENCY_SYMBOL_NAME', 'W&auml;hrungssymbol');
define( '_CFG_GENERAL_AMOUNT_CURRENCY_SYMBOL_DESC', 'Ein W&auml;hrungssymbol anzeigen (wenn eines existiert) statt der ISO Abk&uuml;rzung');
define( '_CFG_GENERAL_AMOUNT_CURRENCY_SYMBOLFIRST_NAME', 'W&auml;hrung zuerst');
define( '_CFG_GENERAL_AMOUNT_CURRENCY_SYMBOLFIRST_DESC', 'W&auml;hrung vor der Summe anzeigen');
define( '_CFG_GENERAL_AMOUNT_USE_COMMA_NAME', 'Komma benutzen');
define( '_CFG_GENERAL_AMOUNT_USE_COMMA_DESC', 'Komma statt eines Punktes in Summen benutzen');
define( '_CFG_GENERAL_ALLOW_FRONTEND_HEARTBEAT_NAME', 'eigene Frontend Heartbeats erlauben');
define( '_CFG_GENERAL_ALLOW_FRONTEND_HEARTBEAT_DESC', 'Trigger a custom heartbeat from the frontend (via the link index.php?option=com_acctexp&task=heartbeat) - for example with a Cronjob');
define( '_CFG_GENERAL_DISABLE_REGULAR_HEARTBEAT_NAME', 'Disable Automatic Heartbeat');
define( '_CFG_GENERAL_DISABLE_REGULAR_HEARTBEAT_DESC', 'If you only want to trigger custom heartbeats, you can disable the automatic ones here.');
define( '_CFG_GENERAL_CUSTOM_HEARTBEAT_SECUREHASH_NAME', 'Custom Frontend Heartbeat Securehash');
define( '_CFG_GENERAL_CUSTOM_HEARTBEAT_SECUREHASH_DESC', 'A code that has to be passed on custom Frontend Heartbeat (with the option &hash=YOURHASHCODE) - if one is set, but not passed, the AEC will not trigger the heartbeat.');
define( '_CFG_GENERAL_QUICKSEARCH_TOP_NAME', 'Quicksearch oben');
define( '_CFG_GENERAL_QUICKSEARCH_TOP_DESC', 'F&uuml; alle quicksearch junkies - Mit dieser Option wird das Eingabefeld oben &uuml;ber den AEC Icons angezeigt - f&uuml;r noch schnelleres Suchen!');

define( '_CFG_GENERAL_SUB_UNINSTALL', 'Deinstallieren');
define( '_CFG_GENERAL_DELETE_TABLES_NAME', 'Datenbanktabellen l&ouml;schen');
define( '_CFG_GENERAL_DELETE_TABLES_DESC', 'Datenbanktabellen bei Deinstallation entfernen?');
define( '_CFG_GENERAL_DELETE_TABLES_SURE_NAME', 'sicher?');
define( '_CFG_GENERAL_DELETE_TABLES_SURE_DESC', 'Sicherheits-Schalter - wenn beide Schalter aktiviert sind, werden bei der Deinstallation alle Daten der AEC unwiederbringlich gel&ouml;scht!');
define( '_CFG_GENERAL_STANDARD_CURRENCY_NAME', 'Standard W&auml;hrung');
define( '_CFG_GENERAL_STANDARD_CURRENCY_DESC', 'Falls der AEC die Angabe der W&auml;hrung fehlt, welche soll dann benutzt werden? (Wenn beispielsweise ein Bezahplan kostenlos ist - 0 Euro - wird kein Bezahldienst, welche gew&ouml;hnlich die W&auml;hrungsangabe speichern abgefragt. Hier wird dann diese Angabe verwendet.)');

define( '_CFG_GENERAL_CONFIRMATION_CHANGEUSERNAME_NAME', 'Option: Benutzerdaten &auml;ndern');
define( '_CFG_GENERAL_CONFIRMATION_CHANGEUSERNAME_DESC', 'Dem Benutzer auf der Best&auml;tigungs-Seite anbieten, die Benutzerdaten noch einmal zu &auml;ndern (falls dem Benutzer ein Fehler unterlaufen ist)');
define( '_CFG_GENERAL_CONFIRMATION_CHANGEUSAGE_NAME', 'Option: Abo-Auswahl &auml;ndern');
define( '_CFG_GENERAL_CONFIRMATION_CHANGEUSAGE_DESC', 'Dem Benutzer auf der Best&auml;tigungs-Seite anbieten, die Abo-Auswahl noch einmal zu &auml;ndern (falls dem Benutzer ein Fehler unterlaufen ist)');

define( '_CFG_GENERAL_MANAGERACCESS_NAME', 'Manager Zugriff:');
define( '_CFG_GENERAL_MANAGERACCESS_DESC', 'Hiermit d&uuml;rfen nicht nur Administratoren, sondern auch Manager auf das AEC Backend zugreifen.');
define( '_CFG_GENERAL_PER_PLAN_MIS_NAME', 'Pro Plan MIs:');
define( '_CFG_GENERAL_PER_PLAN_MIS_DESC', 'Mit dieser Einstellung k&ouml;nnen in Bezahlpl&auml;nen MIs erstellt werden, welche dann nur innerhalb des Planes g&uuml;ltig sind und auch nur dort bearbeitet werden k&ouml;nnen.');
define( '_CFG_GENERAL_INTRO_EXPIRED_NAME', 'Intro f&uuml;r Abgelaufene');
define( '_CFG_GENERAL_INTRO_EXPIRED_DESC', 'Auch wenn ein Intro eingestellt ist, &uuml;berspringt AEC f&uuml;r Benutzer, deren Mitgliedschaft ausgelaufen ist und welche eine neue kaufen m&ouml;chten, dieses Intro und geht direkt zu den Bezahlpl&auml;nen weiter. Mit dieser Einstellung kann dieses Verhalten umgestellt werden.');

define( '_CFG_GENERAL_INVOICE_CUSHION_NAME', 'Invoice Cushion');
define( '_CFG_GENERAL_INVOICE_CUSHION_DESC', 'The cushion period in which AEC does not accept new notifications for an invoice that was already paid.');

//Invoice settings
define( '_CFG_GENERAL_SENDINVOICE_NAME', 'eine Rechnungs-Email senden');
define( '_CFG_GENERAL_SENDINVOICE_DESC', 'eine Rechnungs/Bestellungs-Email senden (aus steuerlichen Gr&uuml;nden)');
define( '_CFG_GENERAL_INVOICETMPL_NAME', 'Rechnungsvorlage');
define( '_CFG_GENERAL_INVOICETMPL_DESC', 'Vorlage f&uuml;r Rechnungen/Bestellungen');

// --== Processors PAGE ==--

define( '_PROCESSORS_TITLE', 'Bezahldienste');
define( '_PROCESSOR_NAME', 'Name');
define( '_PROCESSOR_DESC', 'Beschreibung (erste 50 Zeichen)');
define( '_PROCESSOR_ACTIVE', 'ver&ouml;ffentlicht');
define( '_PROCESSOR_VISIBLE', 'sichtbar');
define( '_PROCESSOR_REORDER', 'neu ordnen');
define( '_PROCESSOR_INFO', 'Information');

define( '_PUBLISH_PROCESSOR', 'ver&ouml;ffentlichen');
define( '_UNPUBLISH_PROCESSOR', 'nicht ver&ouml;ffentlichen');
define( '_NEW_PROCESSOR', 'Neu');
define( '_COPY_PROCESSOR', 'Kopieren');
define( '_APPLY_PROCESSOR', 'Anwenden');
define( '_EDIT_PROCESSOR', 'Bearbeiten');
define( '_REMOVE_PROCESSOR', 'L&ouml;schen');
define( '_SAVE_PROCESSOR', 'Speichern');
define( '_CANCEL_PROCESSOR', 'Abbrechen');

define( '_PP_GENERAL_PROCESSOR_NAME', 'Bezahldienst');
define( '_PP_GENERAL_PROCESSOR_DESC', 'W&auml;hlen Sie, welchen Bezahldienst Sie benutzen wollen.');
define( '_PP_GENERAL_ACTIVE_NAME', 'Aktiv');
define( '_PP_GENERAL_ACTIVE_DESC', 'W&auml;hlen Sie, ob dieser Bezahldienst momentan aktiv ist (aud somit seine Funktion ausf&uuml;hren kann und Ihren Benutzern zur Verf&uuml;gung steht)');
define( '_PP_GENERAL_PLEASE_NOTE', 'Achtung');
define( '_PP_GENERAL_EXPERIMENTAL', 'This payment processor is still not 100% complete - it has either been added to the codebase very recently (and is thus not fully tested) or was partly abandoned due to a customer suddenly not being interested in having us finish it anymore. If you want to use it, we would be very thankful for any kind of helping hand you can give us - either with further information on the integration, with bugreports or fixes, or with sponsorship.');

// --== PAYMENT PLAN PAGE ==--
// Additions of variables for free trial periods by Michael Spredemann (scubaguy)

define( '_PAYPLAN_PERUNIT1',							'Tage' );
define( '_PAYPLAN_PERUNIT2',							'Wochen' );
define( '_PAYPLAN_PERUNIT3',							'Monate' );
define( '_PAYPLAN_PERUNIT4',							'Jahre' );

// General Params

define( '_PAYPLAN_DETAIL_TITLE',						'Abo' );
define( '_PAYPLAN_GENERAL_NAME_NAME',					'Name:' );
define( '_PAYPLAN_GENERAL_NAME_DESC',					'Name oder Titel f&uuml;r dieses Abonnement (max. 40 Zeichen)' );
define( '_PAYPLAN_GENERAL_DESC_NAME',					'Beschreibung:' );
define( '_PAYPLAN_GENERAL_DESC_DESC',					'Volltext (max. 255 Zeichen) zu diesem Abonnement wie er den Benutzern angezeigt werden soll' );
define( '_PAYPLAN_GENERAL_ACTIVE_NAME',					'Ver&ouml;ffentlicht:' );
define( '_PAYPLAN_GENERAL_ACTIVE_DESC',					'Ein ver&ouml;ffentlichtes Abo wird den Besuchern im Frontend angezeigt' );
define( '_PAYPLAN_GENERAL_VISIBLE_NAME',				'Sichtbar:' );
define( '_PAYPLAN_GENERAL_VISIBLE_DESC',				'Sichtbare Abos werden im Frontend angezeigt. Unsichtbare werden nicht angezeigt und sind nur verf&uuml;gbar als Ersatz bei Problemen' );

define( '_PAYPLAN_GENERAL_CUSTOMAMOUNTFORMAT_NAME', 'Preis Formatieren:');
define( '_PAYPLAN_GENERAL_CUSTOMAMOUNTFORMAT_DESC', 'Bitte benutzen Sie einen "aecJSON string" wie den, der bereits ausgef&uuml;llt worden ist, um zu modifizieren, wie die Kosten dieses Plans angezeigt werden.');
define( '_PAYPLAN_GENERAL_CUSTOMTHANKS_NAME', 'Kunden-Danke-Seitenlink:');
define( '_PAYPLAN_GENERAL_CUSTOMTHANKS_DESC', 'Liefern Sie einen kompletten Link (inklusive http://), der zu ihrer Kunden-Danke-Seite f&uuml;hrt. Lassen Sie das Feld frei, wenn Sie dies gar nicht m&ouml;chten.');
define( '_PAYPLAN_GENERAL_CUSTOMTEXT_THANKS_KEEPORIGINAL_NAME', 'Originaltext behalten');
define( '_PAYPLAN_GENERAL_CUSTOMTEXT_THANKS_KEEPORIGINAL_DESC', 'W&auml;hlen Sie diese Option, wenn Sie den Originaltext auf der Danke-Seite behalten wollen.');
define( '_PAYPLAN_GENERAL_CUSTOMTEXT_THANKS_NAME', 'eigener Text Danke-Seite');
define( '_PAYPLAN_GENERAL_CUSTOMTEXT_THANKS_DESC', 'Text, der auf der Danke-Seite angezeigt wird');

define( '_PAYPLAN_PARAMS_OVERRIDE_ACTIVATION_NAME', 'Aktivierung au&szlig;er Kraft setzen');
define( '_PAYPLAN_PARAMS_OVERRIDE_ACTIVATION_DESC', 'Auflage an den Benutzer, den Account zu aktivieren (via E-mail-Aktivierungscode), au&szlig;er Kraft setzen, wenn dieser Bezahlplan mit einer Registrierung benutzt wird.');
define( '_PAYPLAN_PARAMS_OVERRIDE_REGMAIL_NAME', 'Registrierungs-E-mail au&szlig;er Kraft setzen');
define( '_PAYPLAN_PARAMS_OVERRIDE_REGMAIL_DESC', 'Keine Registrierungs-E-mail senden (macht Sinn f&uuml;r bezahlte Pl&auml;ne, die keine Aktivierung brauchen und eine E-mail gesendet w&uuml;rde, wenn die Bezahlung ankommt - mit der E-mail MI).');

define( '_PAYPLAN_PARAMS_GID_ENABLED_NAME',				'Benutzergruppe' );
define( '_PAYPLAN_PARAMS_GID_ENABLED_DESC',				'Auf JA setzen, wenn der Benutzer zu dieser Benutzergruppe geh&ouml;ren soll' );
define( '_PAYPLAN_PARAMS_GID_NAME',						'Zur Gruppe dazu:' );
define( '_PAYPLAN_PARAMS_GID_DESC',						'Benutzer werden dieser Gruppe hinzugef&uuml;gt, wenn das Abo gew&auml;hlt wird' );
define( '_PAYPLAN_PARAMS_MAKE_ACTIVE_NAME', 			'Benutzer Aktivieren:');
define( '_PAYPLAN_PARAMS_MAKE_ACTIVE_DESC',				'Auf >Nein< setzen, falls der Benutzer von Hand in die aktive Gruppe verschoben werden soll.');
define( '_PAYPLAN_PARAMS_MAKE_PRIMARY_NAME', 'prim&auml;r:');
define( '_PAYPLAN_PARAMS_MAKE_PRIMARY_DESC', 'Setzen Sie dies auf "ja", um dieses zum prim&auml;ren Abo f&uuml;r den Benutzer zu machen. Das prim&auml;re Abo ist das, welches die Zugriff zur Seite selbst steuert und bei Ablauf verhindert, dass der Benutzer sich einloggt (falls das so eingestellt ist).');
define( '_PAYPLAN_PARAMS_UPDATE_EXISTING_NAME', 'Update existiert:');
define( '_PAYPLAN_PARAMS_UPDATE_EXISTING_DESC', 'Falls es kein prim&auml;res Abo ist, sollen andere existierende Abos mit diesem erneuert werden? Dies kann hilfreich sein, falls Benutzer von einer bestimmten Art Abo immer nur eine Instanz besitzen d&uuml;rfen.');

define( '_PAYPLAN_TEXT_TITLE',							'Abotext' );
define( '_PAYPLAN_GENERAL_EMAIL_DESC_NAME',				'Emailtext:' );
define( '_PAYPLAN_GENERAL_EMAIL_DESC_DESC',				'Text welcher im Email an den Benutzer angezeigt wird wenn das Abo best&auml;tigt wurde' );
define( '_PAYPLAN_GENERAL_FALLBACK_NAME',				'Abo Ersatz:' );
define( '_PAYPLAN_GENERAL_FALLBACK_DESC',				'Wenn ein Abo endet, aktiviere dieses Abo f&uuml;r diesen Benutzer' );
define( '_PAYPLAN_GENERAL_STANDARD_PARENT_NAME', '&Uuml;bergeordnetes Abo');
define( '_PAYPLAN_GENERAL_STANDARD_PARENT_DESC', 'Falls dieses Abo nicht prim&auml;r ist und der Benutzer noch kein prim&auml;res Abo besitzt, wird das ausgew&auml;hlte angewendet.');

define( '_PAYPLAN_GENERAL_PROCESSORS_NAME',				'Bezahldienste:' );
define( '_PAYPLAN_NOPLAN',								'Kein Abo' );
define( '_PAYPLAN_NOGW',								'Kein Bezahldienst' );
define( '_PAYPLAN_GENERAL_PROCESSORS_DESC',				'Diejenigen Bezahldienste ausw&auml;hlen welche f&uuml;r dieses Abonnement g&uuml;ltig sein sollen (STRG oder HOCHSTELLTASTE um mehrere auszuw&auml;hlen.<hr />Wird ' . _PAYPLAN_NOPLAN . ' gew&auml;hlt, werden alle anderen Optionen ignoriert.<br />Ist hier nur ' . _PAYPLAN_NOPLAN . ' sichtbar, heisst das, dass noch keine Bezahldienste ausgew&auml;hlt/konfiguriert wurden' );
define( '_PAYPLAN_PARAMS_LIFETIME_NAME',				'Immerw&auml;hrend:' );
define( '_PAYPLAN_PARAMS_LIFETIME_DESC',				'Bedeuted ein Abo OHNE Ablaufzeit' );

define( '_PAYPLAN_AMOUNT_NOTICE',						'Anmerkung' );
define( '_PAYPLAN_AMOUNT_NOTICE_TEXT',					'F&uuml;r PayPal gilt, dass f&uuml;r jede Periode ein maximales Limit existiert! Werden also Abos mit PayPal m&ouml;glich, <strong>m&uuml;ssen Tage mit 90, Wochen mit 52, Monate mit 24 und Jahre mit 5 limitiert werden</strong>' );
define( '_PAYPLAN_AMOUNT_EDITABLE_NOTICE',				'Momentan ist 1 oder mehrere Benutzer f&uuml;r dieses Abo eingeschrieben, es ist daher nicht vern&uuml;nftig die Konditionen daf&uuml;r zu &auml;ndern!' );

define( '_PAYPLAN_REGULAR_TITLE',						'Normales Abo' );
define( '_PAYPLAN_PARAMS_FULL_FREE_NAME',				'Frei:' );
define( '_PAYPLAN_PARAMS_FULL_FREE_DESC',				'Ja, wenn das ein Gratisabo sein soll' );
define( '_PAYPLAN_PARAMS_FULL_AMOUNT_NAME',				'Normalpreis:' );
define( '_PAYPLAN_PARAMS_FULL_AMOUNT_DESC',				'Der Betrag f&uuml;r dieses Abo. Sind daf&uuml;r bereits Abonnenten eingetragen, kann dieses Feld nicht ge&auml;ndert werden. Soll dennoch eine &Auml;nderung durchgef&uuml;hrt werden, dann Ver&ouml;ffentlichung zur&uuml;ckziehen und ein neues Abo erstellen' );
define( '_PAYPLAN_PARAMS_FULL_PERIOD_NAME',				'Periode:' );
define( '_PAYPLAN_PARAMS_FULL_PERIOD_DESC',				'Die L&auml;nge der Rechnungsperiode (siehe unten). Die Anzahl wird mit dem Zyklus (siehe unten) modifiziert. Sind daf&uuml;r bereits Abonnenten eingetragen, kann dieses Feld nicht ge&auml;ndert werden. Soll dennoch eine &Auml;nderung durchgef&uuml;hrt werden, dann Ver&ouml;ffentlichung zur&uuml;ckziehen und ein neues Abo erstellen' );
define( '_PAYPLAN_PARAMS_FULL_PERIODUNIT_NAME',			'Zyklus:' );
define( '_PAYPLAN_PARAMS_FULL_PERIODUNIT_DESC',			'Anzahl der Zykluseinheiten. Sind daf&uuml;r bereits Abonnenten eingetragen, kann dieses Feld nicht ge&auml;ndert werden. Soll dennoch eine &Auml;nderung durchgef&uuml;hrt werden, dann Ver&ouml;ffentlichung zur&uuml;ckziehen und ein neues Abo erstellen' );

define( '_PAYPLAN_TRIAL_TITLE',							'Testperiode' );
define( '_PAYPLAN_TRIAL',								'(Optional)' );
define( '_PAYPLAN_TRIAL_DESC',							'Dieser Bereich kann &uuml;bergangen werden wenn es keine Testperiode geben soll.<hr /><strong>Testperioden sind nur mit dem automatischen PayPal System m&ouml;glich!</strong>' );
define( '_PAYPLAN_PARAMS_TRIAL_FREE_NAME',				'Gratis:' );
define( '_PAYPLAN_PARAMS_TRIAL_FREE_DESC',				'Ja, wenn dieses Abo Gratis sein soll' );
define( '_PAYPLAN_PARAMS_TRIAL_AMOUNT_NAME',			'Testpreis:' );
define( '_PAYPLAN_PARAMS_TRIAL_AMOUNT_DESC',			'Preis f&uuml;r die Testperiode' );
define( '_PAYPLAN_PARAMS_TRIAL_PERIOD_NAME',			'Testperiode:' );
define( '_PAYPLAN_PARAMS_TRIAL_PERIOD_DESC',			'L&auml;nge der Testperiode.  Die Anzahl wird mit dem Zyklus (siehe unten) modifiziert. Sind daf&uuml;r bereits Abonnenten eingetragen, kann dieses Feld nicht ge&auml;ndert werden. Soll dennoch eine &Auml;nderung durchgef&uuml;hrt werden, dann Ver&ouml;ffentlichung zur&uuml;ckziehen und ein neues Abo erstellen' );
define( '_PAYPLAN_PARAMS_TRIAL_PERIODUNIT_NAME',		'Testperiodenzyklus:' );
define( '_PAYPLAN_PARAMS_TRIAL_PERIODUNIT_DESC',		'Anzahl der Zykluseinheiten. Sind daf&uuml;r bereits Abonnenten eingetragen, kann dieses Feld nicht ge&auml;ndert werden. Soll dennoch eine &Auml;nderung durchgef&uuml;hrt werden, dann Ver&ouml;ffentlichung zur&uuml;ckziehen und ein neues Abo erstellen' );

define( '_PAYPLAN_PARAMS_NOTAUTH_REDIRECT_NAME', 'Denied Access Redirect');
define( '_PAYPLAN_PARAMS_NOTAUTH_REDIRECT_DESC', 'Redirect to a different URL should the user follow a direct link to this item without having the right authorization.');

// Payplan Relations
define( '_PAYPLAN_RELATIONS_TITLE',						'Beziehungen' );
define( '_PAYPLAN_PARAMS_SIMILARPLANS_NAME',			'&Auml;hnliche Abos:' );
define( '_PAYPLAN_PARAMS_SIMILARPLANS_DESC',			'Abos welche dem hier &Auml;hnlich sind ausw&auml;hlen. Einem Benutzer ist es nicht erlaubt ein Testabo auszuw&auml;hlen, wenn ein &auml;hnliches Abos schon vorher bezogen wurde' );
define( '_PAYPLAN_PARAMS_EQUALPLANS_NAME',				'Gleiche Abos:' );
define( '_PAYPLAN_PARAMS_EQUALPLANS_DESC',				'Abos welche dem hier Gleich sind ausw&auml;hlen. Ein Benutzer welcher zwischen solchen Abos wechselt, verl&auml;ngert damit sein Abo anstatt es zu erneuern.<hr />Test-/Gratisabos sind dann nicht erlaubt' );

// Payplan Restrictions
define( '_PAYPLAN_RESTRICTIONS_TITLE',					'Einschr&auml;nkungen' );
define( '_PAYPLAN_RESTRICTIONS_MINGID_ENABLED_NAME',	'Mindest Gruppen ID:' );
define( '_PAYPLAN_RESTRICTIONS_MINGID_ENABLED_DESC',	'Aktivieren wenn dieses Abo nur <strong>AB</strong> einer bestimmten Benutzergruppe angezeigt werden soll' );
define( '_PAYPLAN_RESTRICTIONS_MINGID_NAME',			'Sichtbare Gruppe:' );
define( '_PAYPLAN_RESTRICTIONS_MINGID_DESC',			'Die Benutzerebenen ID <strong>AB</strong> welcher dieses Abo gesehen werden kann. Neue Benutzer werden nur die Abos mit der geringsten Gruppen ID sehen' );
define( '_PAYPLAN_RESTRICTIONS_FIXGID_ENABLED_NAME',	'Fixe Gruppen ID:' );
define( '_PAYPLAN_RESTRICTIONS_FIXGID_ENABLED_DESC',	'Aktivieren wenn <strong>NUR</strong> eine bestimmte Benutzergruppe dieses Abo sehen soll' );
define( '_PAYPLAN_RESTRICTIONS_FIXGID_NAME',			'Gruppe:' );
define( '_PAYPLAN_RESTRICTIONS_FIXGID_DESC',			'Nur Benutzer aus dieser Gruppe sehen dieses Abo' );
define( '_PAYPLAN_RESTRICTIONS_MAXGID_ENABLED_NAME',	'Maximum Gruppen ID:' );
define( '_PAYPLAN_RESTRICTIONS_MAXGID_ENABLED_DESC',	'Aktivieren wenn dieses Abo <strong>BIS</strong> zu einer maximalen Gruppen ID sichtbar sein soll' );
define( '_PAYPLAN_RESTRICTIONS_MAXGID_NAME',			'Maximum Gruppe:' );
define( '_PAYPLAN_RESTRICTIONS_MAXGID_DESC',			'Die Benutzerebenen ID <strong>BIS</strong> zu welcher dieses Abo sichtbar ist' );

define( '_PAYPLAN_RESTRICTIONS_PREVIOUSPLAN_REQ_ENABLED_NAME',	'Erfordert Abo davor:' );
define( '_PAYPLAN_RESTRICTIONS_PREVIOUSPLAN_REQ_ENABLED_DESC',	'Aktivieren, wenn ein Abo vorher erforderlich ist' );
define( '_PAYPLAN_RESTRICTIONS_PREVIOUSPLAN_REQ_NAME',			'Abo:' );
define( '_PAYPLAN_RESTRICTIONS_PREVIOUSPLAN_REQ_DESC',			'Die Benutzer werden dieses Abo nur dann sehen, wenn <strong>vorher</strong> das gew&auml;hlte Abo verwendet wurde/wird' );
define( '_PAYPLAN_RESTRICTIONS_CURRENTPLAN_REQ_ENABLED_NAME',	'Erforderliches Abo:' );
define( '_PAYPLAN_RESTRICTIONS_CURRENTPLAN_REQ_ENABLED_DESC',	'Aktivieren f&uuml;r momentan aktuelles Abo' );
define( '_PAYPLAN_RESTRICTIONS_CURRENTPLAN_REQ_NAME',			'Abo:' );
define( '_PAYPLAN_RESTRICTIONS_CURRENTPLAN_REQ_DESC',			'Nur sichtbar, wenn der Benutzer momentan dieses Abo aktiv innehat oder vorher es abonniert hatte' );
define( '_PAYPLAN_RESTRICTIONS_OVERALLPLAN_REQ_ENABLED_NAME',	'Erforderliches Abo:' );
define( '_PAYPLAN_RESTRICTIONS_OVERALLPLAN_REQ_ENABLED_DESC',	'Aktivieren f&uuml;r generelles Abo' );
define( '_PAYPLAN_RESTRICTIONS_OVERALLPLAN_REQ_NAME',			'Abo:' );
define( '_PAYPLAN_RESTRICTIONS_OVERALLPLAN_REQ_DESC',			'Nur sichtbar, wenn der Benutzer dieses Abo bereits gew&auml;hlt hatte' );

define( '_PAYPLAN_RESTRICTIONS_PREVIOUSPLAN_REQ_ENABLED_EXCLUDED_NAME', 'Ausgeschlossener vorheriger Plan:');
define( '_PAYPLAN_RESTRICTIONS_PREVIOUSPLAN_REQ_ENABLED_EXCLUDED_DESC', 'Diesen Plan Benutzern NICHT anzeigen, wenn diese den ausgew&auml;hlten Plan als vorherigen Bezahlplan hatten.');
define( '_PAYPLAN_RESTRICTIONS_PREVIOUSPLAN_REQ_EXCLUDED_NAME', 'Plan:');
define( '_PAYPLAN_RESTRICTIONS_PREVIOUSPLAN_REQ_EXCLUDED_DESC', 'Ein Benutzer wird diesen Plan nicht sehen, wenn er oder sie den ausgew&auml;hlten Plan vor dem derzeitigen Plan benutzt hat.');
define( '_PAYPLAN_RESTRICTIONS_CURRENTPLAN_REQ_ENABLED_EXCLUDED_NAME', 'derzeitiger Plan ausgeschlossen:');
define( '_PAYPLAN_RESTRICTIONS_CURRENTPLAN_REQ_ENABLED_EXCLUDED_DESC', 'Diesen Plan Benutzern NICHT zeigen, die den ausgew&auml;hlten Plan als ihren derzeitigen Bezahlplan haben.');
define( '_PAYPLAN_RESTRICTIONS_CURRENTPLAN_REQ_EXCLUDED_NAME', 'Plan:');
define( '_PAYPLAN_RESTRICTIONS_CURRENTPLAN_REQ_EXCLUDED_DESC', 'Ein Benutzer wird diesen Plan nicht sehen, wenn er derzeit dem ausgew&auml;hlten Plan zugeordnet ist oder dieser Plan gerade f&uuml;r ihn abgelaufen ist');
define( '_PAYPLAN_RESTRICTIONS_OVERALLPLAN_REQ_ENABLED_EXCLUDED_NAME', 'ausgeschlossener benutzter Plan:');
define( '_PAYPLAN_RESTRICTIONS_OVERALLPLAN_REQ_ENABLED_EXCLUDED_DESC', 'Diesen Plan einem Benutzer NICHT anzeigen, der den ausgew&auml;hlten Plan zuvor bereits genutzt hat');
define( '_PAYPLAN_RESTRICTIONS_OVERALLPLAN_REQ_EXCLUDED_NAME', 'Plan:');
define( '_PAYPLAN_RESTRICTIONS_OVERALLPLAN_REQ_EXCLUDED_DESC', 'Ein Benutzer wird diesen Plan nicht sehen, wenn er ihn einmal benutzt hat, egal wann');

define( '_PAYPLAN_RESTRICTIONS_USED_PLAN_MIN_ENABLED_NAME',		'Mindest Abo:' );
define( '_PAYPLAN_RESTRICTIONS_USED_PLAN_MIN_ENABLED_DESC',		'Aktivieren wenn <strong>mindestens x Mal</strong> ein spezielles Abo <strong>vorher</strong> abonniert war' );
define( '_PAYPLAN_RESTRICTIONS_USED_PLAN_MIN_AMOUNT_NAME',		'Anzahl:' );
define( '_PAYPLAN_RESTRICTIONS_USED_PLAN_MIN_AMOUNT_DESC',		'Die Mindestanzahl an Abozeitr&auml;men um dieses Abo abonnieren zu k&ouml;nnen' );
define( '_PAYPLAN_RESTRICTIONS_USED_PLAN_MIN_NAME',				'Mindest Abo:' );
define( '_PAYPLAN_RESTRICTIONS_USED_PLAN_MIN_DESC',				'Das Abo, das der Benutzer <strong>vorher abonniert haben musste</strong> um dieses Abo w&auml;hlen zu k&ouml;nnen' );
define( '_PAYPLAN_RESTRICTIONS_USED_PLAN_MAX_ENABLED_NAME',		'Maximal verwendet:' );
define( '_PAYPLAN_RESTRICTIONS_USED_PLAN_MAX_ENABLED_DESC',		'Aktivieren, wenn Benutzer eine maximale Anzahl an einem speziellen Abo vorher hatten mussten um <strong>dieses</strong> Abo zu sehen' );
define( '_PAYPLAN_RESTRICTIONS_USED_PLAN_MAX_AMOUNT_NAME',		'Anzahl:' );
define( '_PAYPLAN_RESTRICTIONS_USED_PLAN_MAX_AMOUNT_DESC',		'Maximale Anzahl an Benutzern, die dieses Abo verwendet d&uuml;rfen' );
define( '_PAYPLAN_RESTRICTIONS_USED_PLAN_MAX_NAME',				'Abo:' );
define( '_PAYPLAN_RESTRICTIONS_USED_PLAN_MAX_DESC',				'Das Abo, welches maximal verwendet werden darf' );

define( '_PAYPLAN_RESTRICTIONS_PREVIOUSGROUP_REQ_ENABLED_NAME', 'Erforderliche vorherige Gruppe:');
define( '_PAYPLAN_RESTRICTIONS_PREVIOUSGROUP_REQ_ENABLED_DESC', 'Nur zulassen, wenn der Benutzer direkt zuvor ein Abo aus der gew&auml;hlten Gruppe besessen hat');
define( '_PAYPLAN_RESTRICTIONS_PREVIOUSGROUP_REQ_NAME', 'Gruppe:');
define( '_PAYPLAN_RESTRICTIONS_PREVIOUSGROUP_REQ_DESC', 'Ein Benutzer wird diesen Plan nur sehen, wenn er einen Plan aus dieser Gruppe vor dem derzeitigen Plan benutzt hat.');
define( '_PAYPLAN_RESTRICTIONS_CURRENTGROUP_REQ_ENABLED_NAME', 'Erforderliche derzeitige Gruppe:');
define( '_PAYPLAN_RESTRICTIONS_CURRENTGROUP_REQ_ENABLED_DESC', 'Nur zulassen, wenn der Benutzer momentan ein Abo aus der gew&auml;hlten Gruppe besitzt');
define( '_PAYPLAN_RESTRICTIONS_CURRENTGROUP_REQ_NAME', 'Gruppe:');
define( '_PAYPLAN_RESTRICTIONS_CURRENTGROUP_REQ_DESC', 'Ein Benutzer wird diesen Plan nur sehen, wenn er derzeit einem Plan aus dieser Gruppe zugeteilt ist oder einer der Pl%auml;ne aus dieser Gruppe gerade abgelaufen ist');
define( '_PAYPLAN_RESTRICTIONS_OVERALLGROUP_REQ_ENABLED_NAME', 'Erforderliche benutzte Gruppe:');
define( '_PAYPLAN_RESTRICTIONS_OVERALLGROUP_REQ_ENABLED_DESC', 'Nur zulassen, wenn der Benutzer schon einmal ein Abo aus der gew&auml;hlten Gruppe besessen hat, oder noch besitzt');
define( '_PAYPLAN_RESTRICTIONS_OVERALLGROUP_REQ_NAME', 'Gruppe:');
define( '_PAYPLAN_RESTRICTIONS_OVERALLGROUP_REQ_DESC', 'Ein Benutzer wird diesen Plan nur sehen, wenn er den ausgew&auml;hlten Plan in dieser Gruppe einmal benutzt hat, egal wann');

define( '_PAYPLAN_RESTRICTIONS_PREVIOUSGROUP_REQ_ENABLED_EXCLUDED_NAME', 'Ausgeschlossene vorherige Gruppe:');
define( '_PAYPLAN_RESTRICTIONS_PREVIOUSGROUP_REQ_ENABLED_EXCLUDED_DESC', 'Dieser Plan wird Benutzern NICHT angezeigt, wenn sie einen Plan aus der angegebenen Gruppe als vorherigen Bezahlplan hatten.');
define( '_PAYPLAN_RESTRICTIONS_PREVIOUSGROUP_REQ_EXCLUDED_NAME', 'Gruppe:');
define( '_PAYPLAN_RESTRICTIONS_PREVIOUSGROUP_REQ_EXCLUDED_DESC', 'Ein Benutzer wird diesen Plan nicht sehen, wenn er einen Plan aus der angegebenen Gruppe Gruppe vor dem aktuellen Plan benutzt hat.');
define( '_PAYPLAN_RESTRICTIONS_CURRENTGROUP_REQ_ENABLED_EXCLUDED_NAME', 'Ausgeschlossener aktueller Plan:');
define( '_PAYPLAN_RESTRICTIONS_CURRENTGROUP_REQ_ENABLED_EXCLUDED_DESC', 'Diesen Plan Benutzern NICHT zeigen, die einen Plan aus der angegebenen Gruppe Gruppe als ihren aktuellen Bezahlplan haben.');
define( '_PAYPLAN_RESTRICTIONS_CURRENTGROUP_REQ_EXCLUDED_NAME', 'Gruppe:');
define( '_PAYPLAN_RESTRICTIONS_CURRENTGROUP_REQ_EXCLUDED_DESC', 'Ein Benutzer wird diesen Plan nicht sehen, wenn er einem Plan aus der angegebenen Gruppe Gruppe aktuell zugeschrieben ist oder ein Plan aus dieser Gruppe gerade abgelaufen ist');
define( '_PAYPLAN_RESTRICTIONS_OVERALLGROUP_REQ_ENABLED_EXCLUDED_NAME', 'Ausgeschlossene benutzte Gruppe:');
define( '_PAYPLAN_RESTRICTIONS_OVERALLGROUP_REQ_ENABLED_EXCLUDED_DESC', 'Diesen Plan Benutzern NICHT anzeigen, die einen Plan aus der angegebenen Gruppe Gruppe zuvor benutzt haben');
define( '_PAYPLAN_RESTRICTIONS_OVERALLGROUP_REQ_EXCLUDED_NAME', 'Gruppe:');
define( '_PAYPLAN_RESTRICTIONS_OVERALLGROUP_REQ_EXCLUDED_DESC', 'Ein Benutzer wird diesen Plan nicht sehen, wenn er einen Plan aus der angegebenen Gruppe Gruppe einmal benutzt hat, egal wann.');

define( '_PAYPLAN_RESTRICTIONS_USED_GROUP_MIN_ENABLED_NAME', 'Minimale Benutzung in Gruppe:');
define( '_PAYPLAN_RESTRICTIONS_USED_GROUP_MIN_ENABLED_DESC', 'Einschr&auml;nken ob ein Benutzer diesen Plan kaufen kann - aufgrund der minimalen Anzahl von Benutzungen eines Bezahplans in einer bestimmten Gruppe');
define( '_PAYPLAN_RESTRICTIONS_USED_GROUP_MIN_AMOUNT_NAME', 'Min. Benutzungen:');
define( '_PAYPLAN_RESTRICTIONS_USED_GROUP_MIN_AMOUNT_DESC', 'Die minimale Anzahl von Benutzungen des Bezahplans.');
define( '_PAYPLAN_RESTRICTIONS_USED_GROUP_MIN_NAME', 'Gruppe:');
define( '_PAYPLAN_RESTRICTIONS_USED_GROUP_MIN_DESC', 'Die Gruppe, aus welcher der Benutzer einen Plan eine bestimmte Anzahl haben muss - mindestens so viele Male wie angegeben');
define( '_PAYPLAN_RESTRICTIONS_USED_GROUP_MAX_ENABLED_NAME', 'Maximale Benutzung in Gruppe:');
define( '_PAYPLAN_RESTRICTIONS_USED_GROUP_MAX_ENABLED_DESC', 'Einschr&auml;nken ob ein Benutzer diesen Plan kaufen kann - aufgrund der maximalen Anzahl von Benutzungen eines Bezahplans in einer bestimmten Gruppe');
define( '_PAYPLAN_RESTRICTIONS_USED_GROUP_MAX_AMOUNT_NAME', 'Max. Benutzungen:');
define( '_PAYPLAN_RESTRICTIONS_USED_GROUP_MAX_AMOUNT_DESC', 'Die maximale Anzahl von Benutzungen des Bezahplans.');
define( '_PAYPLAN_RESTRICTIONS_USED_GROUP_MAX_NAME', 'Gruppe:');
define( '_PAYPLAN_RESTRICTIONS_USED_GROUP_MAX_DESC', 'Die Gruppe, aus welcher der Benutzer einen Plan eine bestimmte Anzahl haben muss - h&ouml;chstens so viele Male wie angegeben');

define( '_PAYPLAN_RESTRICTIONS_CUSTOM_RESTRICTIONS_ENABLED_NAME', 'eigene Einschr&auml;nkungen benutzen:');
define( '_PAYPLAN_RESTRICTIONS_CUSTOM_RESTRICTIONS_ENABLED_DESC', 'Eigene Einschr&auml;nkungen wie unten angegeben benutzen.');
define( '_PAYPLAN_RESTRICTIONS_CUSTOM_RESTRICTIONS_NAME', 'Eigene Einschr&auml;nkungen:');
define( '_PAYPLAN_RESTRICTIONS_CUSTOM_RESTRICTIONS_DESC', 'RewriteEngine benutzen um eine eigene Regeln zur Anzeige zu stellen:<br />[[user_id]] >= 1500<br />[[parametername]] = value<br />(Jede Regel in eine neue Zeile schreiben).<br />Es k&ouml;nnen =, <=, >=, <, >, <> als untergeordnete Eintr&auml;ge aus dieser genutzt werden. Zwischen Variablen, Werten und Vergleichszeichen muss eine Leerstelle stehen!');

define( '_PAYPLAN_PROCESSORS_TITLE', 'Bezahldienste');
define( '_PAYPLAN_PROCESSORS_TITLE_LONG', 'Zugewiesene Bezahldienste');

define( '_PAYPLAN_PROCESSORS_ACTIVATE_NAME', 'Aktiv');
define( '_PAYPLAN_PROCESSORS_ACTIVATE_DESC', 'Diesen Bezahldienst f&uuml;r diesen Bezahlplan anbieten.');
define( '_PAYPLAN_PROCESSORS_OVERWRITE_SETTINGS_NAME', 'Globale Einstellungen &uuml;berschreiben');
define( '_PAYPLAN_PROCESSORS_OVERWRITE_SETTINGS_DESC', 'Wenn Sie wollen, k&ouml;nnen Sie die Einstellungen dieses Bezahldienst speziell f&uuml;r diesen Bezahlplan ab&auml;ndern.');

define( '_PAYPLAN_MI',											'Komponenten' );
define( '_PAYPLAN_GENERAL_MICRO_INTEGRATIONS_NAME',				'Komponentenname:' );
define( '_PAYPLAN_GENERAL_MICRO_INTEGRATIONS_DESC',				'Komponente(n) ausw&auml;hlen welche Benutzern mit diesem Abo zugewiesen werden sollen' );
define( '_PAYPLAN_GENERAL_MICRO_INTEGRATIONS_PLAN_NAME', 'Lokale MicroIntegrationen:');
define( '_PAYPLAN_GENERAL_MICRO_INTEGRATIONS_PLAN_DESC', 'Hiermit k&ouml;nnen MI Instanzen nur f&uuml;r dieses Abo eingestellt werden.');
define( '_PAYPLAN_GENERAL_MICRO_INTEGRATIONS_INHERITED_NAME', 'Vererbt:');
define( '_PAYPLAN_GENERAL_MICRO_INTEGRATIONS_INHERITED_DESC', 'Zeigt an, welche MIs der Bezahlplan von den Gruppen geerbt hat, welchen .');

define( '_PAYPLAN_CURRENCY',					'W&auml;hrung' );

// --== Group PAGE ==--

define( '_ITEMGROUPS_TITLE', 'Gruppen');
define( '_ITEMGROUP_NAME', 'Name');
define( '_ITEMGROUP_DESC', 'Beschreibung (erste 50 Zeichen)');
define( '_ITEMGROUP_ACTIVE', 'ver&ouml;ffentlicht');
define( '_ITEMGROUP_VISIBLE', 'sichtbar');
define( '_ITEMGROUP_REORDER', 'Neuordnen');

define( '_PUBLISH_ITEMGROUP', 'ver&ouml;ffentlichen');
define( '_UNPUBLISH_ITEMGROUP', 'nicht ver&ouml;ffentlichen');
define( '_NEW_ITEMGROUP', 'neu');
define( '_COPY_ITEMGROUP', 'kopieren');
define( '_APPLY_ITEMGROUP', 'anwenden');
define( '_EDIT_ITEMGROUP', 'bearbeiten');
define( '_REMOVE_ITEMGROUP', 'l&ouml;schen');
define( '_SAVE_ITEMGROUP', 'speichern');
define( '_CANCEL_ITEMGROUP', 'Abbruch');

define( '_ITEMGROUP_DETAIL_TITLE', 'Gruppe');
define( '_AEC_HEAD_ITEMGROUP_INFO', 'Gruppe' );
define( '_ITEMGROUP_GENERAL_NAME_NAME', 'Name:');
define( '_ITEMGROUP_GENERAL_NAME_DESC', 'Name oder Titel f&uuml;r diese Gruppe. Max.: 40 Zeichen.');
define( '_ITEMGROUP_GENERAL_DESC_NAME', 'Beschreibung:');
define( '_ITEMGROUP_GENERAL_DESC_DESC', 'Komplette Beschreibung der Gruppe. Max.: 255 Zeichen.');
define( '_ITEMGROUP_GENERAL_ACTIVE_NAME', 'ver&ouml;ffentlicht:');
define( '_ITEMGROUP_GENERAL_ACTIVE_DESC', 'Eine ver&ouml;ffentlichte Gruppe wird f&uuml;r den Benutzer verf&uuml;gbar sein im Frontend.');
define( '_ITEMGROUP_GENERAL_VISIBLE_NAME', 'sichtbar:');
define( '_ITEMGROUP_GENERAL_VISIBLE_DESC', 'Sichtbare Gruppen werden im Frontend gezeigt.');
define( '_ITEMGROUP_GENERAL_COLOR_NAME', 'Farbe:');
define( '_ITEMGROUP_GENERAL_COLOR_DESC', 'Die Farbmarkierung dieser Gruppe.');
define( '_ITEMGROUP_GENERAL_ICON_NAME', 'Zeichen:');
define( '_ITEMGROUP_GENERAL_ICON_DESC', 'Das Zeichen dieser Gruppe.');

define( '_ITEMGROUP_GENERAL_REVEAL_CHILD_ITEMS_NAME', 'Untergeordnete Elemente anzeigen');
define( '_ITEMGROUP_GENERAL_REVEAL_CHILD_ITEMS_DESC', 'Wenn Sie dieses Bedienungsfeld auf "ja" setzen, wird das AEC keinen Gruppenbutton zeigen (der den Benutzer zu den Inhalten der Gruppe leitet), sondern die Inhalte der Gruppe in einer direkt anzeigen.');
define( '_ITEMGROUP_GENERAL_SYMLINK_NAME', 'Gruppe Symbolische Verkn&uuml;pfung');
define( '_ITEMGROUP_GENERAL_SYMLINK_DESC', 'Einen Link hier einzugeben, wird einen Benutzer zu diesem Link weiterleiten, wenn diese Gruppe auf der Auswahlseite der Pl&auml;ne ausgew&auml;hlt wird. Hebt jede Verlinkung zu Inhalten dieser Gruppe auf!');

define( '_ITEMGROUP_GENERAL_NOTAUTH_REDIRECT_NAME', 'Denied Access Redirect');
define( '_ITEMGROUP_GENERAL_NOTAUTH_REDIRECT_DESC', 'Redirect to a different URL should the user follow a direct link to this item without having the right authorization.');
define( '_ITEMGROUP_GENERAL_MICRO_INTEGRATIONS_NAME', 'Micro Integrations');
define( '_ITEMGROUP_GENERAL_MICRO_INTEGRATIONS_DESC', 'Select which Micro Integrations you want to be attached to all child elements of this group.');

// Group Restrictions

define( '_ITEMGROUP_RESTRICTIONS_TITLE', 'Einschr&auml;nkungen');

define( '_ITEMGROUP_RESTRICTIONS_MINGID_ENABLED_NAME', 'Min GID Einschr&auml;nken:');
define( '_ITEMGROUP_RESTRICTIONS_MINGID_ENABLED_DESC', 'Aktivieren, dass dem Benutzer der Zugriff auf dieses Abo nur mit der eingestellen Benutzergruppe oder dar&uuml;ber gestattet wird.');
define( '_ITEMGROUP_RESTRICTIONS_MINGID_NAME', 'Sichtbarkeit Gruppe:');
define( '_ITEMGROUP_RESTRICTIONS_MINGID_DESC', 'Dem Benutzer den Zugriff auf dieses Abo nur mit hier der eingestellen Benutzergruppe, oder einer dar&uuml;ber gestatten.');
define( '_ITEMGROUP_RESTRICTIONS_FIXGID_ENABLED_NAME', 'Fixe GID Einschr&auml;nken:');
define( '_ITEMGROUP_RESTRICTIONS_FIXGID_ENABLED_DESC', 'Aktivieren, dass dem Benutzer der Zugriff auf dieses Abo nur mit der eingestellen Benutzergruppe gestattet wird.');
define( '_ITEMGROUP_RESTRICTIONS_FIXGID_NAME', 'Fixe GID:');
define( '_ITEMGROUP_RESTRICTIONS_FIXGID_DESC', 'Nur Benutzer mit dieser Benutzergruppe k&ouml;nnen diese Gruppe ansehen.');
define( '_ITEMGROUP_RESTRICTIONS_MAXGID_ENABLED_NAME', 'Max GID Einschr&auml;nken:');
define( '_ITEMGROUP_RESTRICTIONS_MAXGID_ENABLED_DESC', 'GebAktivieren, dass dem Benutzer der Zugriff auf dieses Abo nur mit der eingestellen Benutzergruppe oder darunter gestattet wird.');
define( '_ITEMGROUP_RESTRICTIONS_MAXGID_NAME', 'Maximale Gruppe:');
define( '_ITEMGROUP_RESTRICTIONS_MAXGID_DESC', 'Dem Benutzer den Zugriff auf dieses Abo nur mit der eingestellen Benutzergruppe oder einer darunter gestatten.');

define( '_ITEMGROUP_RESTRICTIONS_PREVIOUSPLAN_REQ_ENABLED_NAME', 'Erforderlicher vorheriger Plan:');
define( '_ITEMGROUP_RESTRICTIONS_PREVIOUSPLAN_REQ_ENABLED_DESC', 'Die zuvorige Benutzung eines anderen Plans zur Bedingung machen, um auf diese Gruppe zuzugreifen');
define( '_ITEMGROUP_RESTRICTIONS_PREVIOUSPLAN_REQ_NAME', 'Plan:');
define( '_ITEMGROUP_RESTRICTIONS_PREVIOUSPLAN_REQ_DESC', 'Ein Benutzer wird diese Gruppe nur sehen, wenn er den ausgew&auml;hlten Plan vor dem aktuellen Plan benutzt hat');
define( '_ITEMGROUP_RESTRICTIONS_CURRENTPLAN_REQ_ENABLED_NAME', 'erforderlicher aktueller Plan:');
define( '_ITEMGROUP_RESTRICTIONS_CURRENTPLAN_REQ_ENABLED_DESC', 'Die momentane Benutzung eines anderen Plans zur Bedingung machen, um auf diese Gruppe zuzugreifen');
define( '_ITEMGROUP_RESTRICTIONS_CURRENTPLAN_REQ_NAME', 'Plan:');
define( '_ITEMGROUP_RESTRICTIONS_CURRENTPLAN_REQ_DESC', 'Ein Benutzer wird diese Gruppe nur sehen, wenn er aktuell dem ausgew&auml;hlten Plan zugeordnet wird oder dieser gerade abgelaufen ist.');
define( '_ITEMGROUP_RESTRICTIONS_OVERALLPLAN_REQ_ENABLED_NAME', 'Erforderlicher benutzter Plan:');
define( '_ITEMGROUP_RESTRICTIONS_OVERALLPLAN_REQ_ENABLED_DESC', 'Generell die Benutzung eines anderen Plans zur Bedingung machen, um auf diese Gruppe zuzugreifen, egal wann');
define( '_ITEMGROUP_RESTRICTIONS_OVERALLPLAN_REQ_NAME', 'Plan:');
define( '_ITEMGROUP_RESTRICTIONS_OVERALLPLAN_REQ_DESC', 'Ein Benutzer wird diese Gruppe nur sehen, wenn er den ausgew&auml;hlten Plan einmal benutzt hat, egal wann.');

define( '_ITEMGROUP_RESTRICTIONS_PREVIOUSPLAN_REQ_ENABLED_EXCLUDED_NAME', 'Ausgeschlossener vorheriger Plan:');
define( '_ITEMGROUP_RESTRICTIONS_PREVIOUSPLAN_REQ_ENABLED_EXCLUDED_DESC', 'Diese Gruppe Benutzern NICHT anzeigen, wenn diese den ausgew&auml;hlten Plan als vorherigen Bezahlplan hatten.');
define( '_ITEMGROUP_RESTRICTIONS_PREVIOUSPLAN_REQ_EXCLUDED_NAME', 'Plan:');
define( '_ITEMGROUP_RESTRICTIONS_PREVIOUSPLAN_REQ_EXCLUDED_DESC', 'Ein Benutzer wird diese Gruppe nicht sehen, wenn er oder sie den ausgew&auml;hlten Plan vor dem derzeitigen Plan benutzt hat.');
define( '_ITEMGROUP_RESTRICTIONS_CURRENTPLAN_REQ_ENABLED_EXCLUDED_NAME', 'derzeitiger Plan ausgeschlossen:');
define( '_ITEMGROUP_RESTRICTIONS_CURRENTPLAN_REQ_ENABLED_EXCLUDED_DESC', 'Diese Gruppe Benutzern NICHT zeigen, die den ausgew&auml;hlten Plan als ihren derzeitigen Bezahlplan haben.');
define( '_ITEMGROUP_RESTRICTIONS_CURRENTPLAN_REQ_EXCLUDED_NAME', 'Plan:');
define( '_ITEMGROUP_RESTRICTIONS_CURRENTPLAN_REQ_EXCLUDED_DESC', 'Ein Benutzer wird diese Gruppe nicht sehen, wenn er derzeit dem ausgew&auml;hlten Plan zugeordnet ist oder dieser Plan gerade f&uuml;r ihn abgelaufen ist');
define( '_ITEMGROUP_RESTRICTIONS_OVERALLPLAN_REQ_ENABLED_EXCLUDED_NAME', 'ausgeschlossener benutzter Plan:');
define( '_ITEMGROUP_RESTRICTIONS_OVERALLPLAN_REQ_ENABLED_EXCLUDED_DESC', 'Diese Gruppe einem Benutzer NICHT anzeigen, der den ausgew&auml;hlten Plan zuvor bereits genutzt hat');
define( '_ITEMGROUP_RESTRICTIONS_OVERALLPLAN_REQ_EXCLUDED_NAME', 'Plan:');
define( '_ITEMGROUP_RESTRICTIONS_OVERALLPLAN_REQ_EXCLUDED_DESC', 'Ein Benutzer wird diese Gruppe nicht sehen, wenn er den gew&auml;hlten Plan schon einmal benutzt hat, egal wann oder wie oft.');

define( '_ITEMGROUP_RESTRICTIONS_USED_PLAN_MIN_ENABLED_NAME',		'Mindest Abo:' );
define( '_ITEMGROUP_RESTRICTIONS_USED_PLAN_MIN_ENABLED_DESC',		'Zugriff nur gestatten, wenn der Benutzer ein anderes Abo <strong>mindestens x Mal vorher</strong> abonniert haben muss' );
define( '_ITEMGROUP_RESTRICTIONS_USED_PLAN_MIN_AMOUNT_NAME',		'Anzahl:' );
define( '_ITEMGROUP_RESTRICTIONS_USED_PLAN_MIN_AMOUNT_DESC',		'Die Mindestanzahl an Benutzungen des Abos um diesen Plan abonnieren zu k&ouml;nnen' );
define( '_ITEMGROUP_RESTRICTIONS_USED_PLAN_MIN_NAME',				'Mindest Abo:' );
define( '_ITEMGROUP_RESTRICTIONS_USED_PLAN_MIN_DESC',				'Das Abo, das der Benutzer <strong>vorher abonniert haben musste</strong> um dieses Abo w&auml;hlen zu k&ouml;nnen' );
define( '_ITEMGROUP_RESTRICTIONS_USED_PLAN_MAX_ENABLED_NAME',		'Maximal verwendet:' );
define( '_ITEMGROUP_RESTRICTIONS_USED_PLAN_MAX_ENABLED_DESC',		'Zugriff nur gestatten, wenn der Benutzer ein anderes Abo <strong>h&ouml;chstens x Mal vorher</strong> abonniert haben muss' );
define( '_ITEMGROUP_RESTRICTIONS_USED_PLAN_MAX_AMOUNT_NAME',		'Anzahl:' );
define( '_ITEMGROUP_RESTRICTIONS_USED_PLAN_MAX_AMOUNT_DESC',		'Maximale Anzahl an Benutzungen des Abos um diesen Plan abonnieren zu k&ouml;nnen' );
define( '_ITEMGROUP_RESTRICTIONS_USED_PLAN_MAX_NAME',				'Abo:' );
define( '_ITEMGROUP_RESTRICTIONS_USED_PLAN_MAX_DESC',				'Das Abo, welches maximal verwendet werden darf' );

define( '_ITEMGROUP_RESTRICTIONS_PREVIOUSGROUP_REQ_ENABLED_NAME', 'Erforderliche vorherige Gruppe:');
define( '_ITEMGROUP_RESTRICTIONS_PREVIOUSGROUP_REQ_ENABLED_DESC', 'Nur zulassen, wenn der Benutzer direkt zuvor ein Abo aus der gew&auml;hlten Gruppe besessen hat');
define( '_ITEMGROUP_RESTRICTIONS_PREVIOUSGROUP_REQ_NAME', 'Gruppe:');
define( '_ITEMGROUP_RESTRICTIONS_PREVIOUSGROUP_REQ_DESC', 'Ein Benutzer wird diese Gruppe nur sehen, wenn er einen Plan aus dieser Gruppe vor dem derzeitigen Plan benutzt hat.');
define( '_ITEMGROUP_RESTRICTIONS_CURRENTGROUP_REQ_ENABLED_NAME', 'Erforderliche derzeitige Gruppe:');
define( '_ITEMGROUP_RESTRICTIONS_CURRENTGROUP_REQ_ENABLED_DESC', 'Nur zulassen, wenn der Benutzer momentan ein Abo aus der gew&auml;hlten Gruppe besitzt');
define( '_ITEMGROUP_RESTRICTIONS_CURRENTGROUP_REQ_NAME', 'Gruppe:');
define( '_ITEMGROUP_RESTRICTIONS_CURRENTGROUP_REQ_DESC', 'Ein Benutzer wird diese Gruppe nur sehen, wenn er derzeit einem Plan aus dieser Gruppe zugeteilt ist oder einer der Pl%auml;ne aus dieser Gruppe gerade abgelaufen ist');
define( '_ITEMGROUP_RESTRICTIONS_OVERALLGROUP_REQ_ENABLED_NAME', 'Erforderliche benutzte Gruppe:');
define( '_ITEMGROUP_RESTRICTIONS_OVERALLGROUP_REQ_ENABLED_DESC', 'Nur zulassen, wenn der Benutzer schon einmal ein Abo aus der gew&auml;hlten Gruppe besessen hat, oder noch besitzt');
define( '_ITEMGROUP_RESTRICTIONS_OVERALLGROUP_REQ_NAME', 'Gruppe:');
define( '_ITEMGROUP_RESTRICTIONS_OVERALLGROUP_REQ_DESC', 'Ein Benutzer wird diese Gruppe nur sehen, wenn er den ausgew&auml;hlten Plan in dieser Gruppe einmal benutzt hat, egal wann');

define( '_ITEMGROUP_RESTRICTIONS_PREVIOUSGROUP_REQ_ENABLED_EXCLUDED_NAME', 'Ausgeschlossene vorherige Gruppe:');
define( '_ITEMGROUP_RESTRICTIONS_PREVIOUSGROUP_REQ_ENABLED_EXCLUDED_DESC', 'Diese Gruppe wird Benutzern NICHT angezeigt, wenn sie einen Plan aus der angegebenen Gruppe als vorherigen Bezahlplan hatten.');
define( '_ITEMGROUP_RESTRICTIONS_PREVIOUSGROUP_REQ_EXCLUDED_NAME', 'Gruppe:');
define( '_ITEMGROUP_RESTRICTIONS_PREVIOUSGROUP_REQ_EXCLUDED_DESC', 'Ein Benutzer wird diese Gruppe nicht sehen, wenn er einen Plan aus der angegebenen Gruppe vor dem aktuellen Plan benutzt hat.');
define( '_ITEMGROUP_RESTRICTIONS_CURRENTGROUP_REQ_ENABLED_EXCLUDED_NAME', 'Ausgeschlossener aktueller Plan:');
define( '_ITEMGROUP_RESTRICTIONS_CURRENTGROUP_REQ_ENABLED_EXCLUDED_DESC', 'Diese Gruppe Benutzern NICHT zeigen, die einen Plan aus der angegebenen Gruppe als ihren aktuellen Bezahlplan haben.');
define( '_ITEMGROUP_RESTRICTIONS_CURRENTGROUP_REQ_EXCLUDED_NAME', 'Gruppe:');
define( '_ITEMGROUP_RESTRICTIONS_CURRENTGROUP_REQ_EXCLUDED_DESC', 'Ein Benutzer wird diese Gruppe nicht sehen, wenn er einem Plan aus der angegebenen Gruppe aktuell zugeschrieben ist oder ein Plan aus dieser Gruppe gerade abgelaufen ist');
define( '_ITEMGROUP_RESTRICTIONS_OVERALLGROUP_REQ_ENABLED_EXCLUDED_NAME', 'Ausgeschlossene benutzte Gruppe:');
define( '_ITEMGROUP_RESTRICTIONS_OVERALLGROUP_REQ_ENABLED_EXCLUDED_DESC', 'Diese Gruppe Benutzern NICHT anzeigen, die einen Plan aus der angegebenen Gruppe zuvor benutzt haben');
define( '_ITEMGROUP_RESTRICTIONS_OVERALLGROUP_REQ_EXCLUDED_NAME', 'Gruppe:');
define( '_ITEMGROUP_RESTRICTIONS_OVERALLGROUP_REQ_EXCLUDED_DESC', 'Ein Benutzer wird diese Gruppe nicht sehen, wenn er einen Plan aus der angegebenen Gruppe einmal benutzt hat, egal wann.');

define( '_ITEMGROUP_RESTRICTIONS_USED_GROUP_MIN_ENABLED_NAME', 'Minimale Benutzung in Gruppe:');
define( '_ITEMGROUP_RESTRICTIONS_USED_GROUP_MIN_ENABLED_DESC', 'Einschr&auml;nken ob ein Benutzer untergeordnete Eintr&auml;ge aus dieser Gruppe kaufen kann - aufgrund der minimalen Anzahl von Benutzungen eines Bezahplans in einer bestimmten Gruppe');
define( '_ITEMGROUP_RESTRICTIONS_USED_GROUP_MIN_AMOUNT_NAME', 'Min. Benutzungen:');
define( '_ITEMGROUP_RESTRICTIONS_USED_GROUP_MIN_AMOUNT_DESC', 'Die minimale Anzahl von Benutzungen des Bezahplans.');
define( '_ITEMGROUP_RESTRICTIONS_USED_GROUP_MIN_NAME', 'Gruppe:');
define( '_ITEMGROUP_RESTRICTIONS_USED_GROUP_MIN_DESC', 'Die Gruppe, aus welcher der Benutzer einen Plan eine bestimmte Anzahl haben muss - mindestens so viele Male wie angegeben');
define( '_ITEMGROUP_RESTRICTIONS_USED_GROUP_MAX_ENABLED_NAME', 'Maximale Benutzung in Gruppe:');
define( '_ITEMGROUP_RESTRICTIONS_USED_GROUP_MAX_ENABLED_DESC', 'Einschr&auml;nken ob ein Benutzer untergeordnete Eintr&auml;ge aus dieser Gruppe kaufen kann - aufgrund der maximalen Anzahl von Benutzungen eines Bezahplans in einer bestimmten Gruppe');
define( '_ITEMGROUP_RESTRICTIONS_USED_GROUP_MAX_AMOUNT_NAME', 'Max. Benutzungen:');
define( '_ITEMGROUP_RESTRICTIONS_USED_GROUP_MAX_AMOUNT_DESC', 'Die maximale Anzahl von Benutzungen des Bezahplans.');
define( '_ITEMGROUP_RESTRICTIONS_USED_GROUP_MAX_NAME', 'Gruppe:');
define( '_ITEMGROUP_RESTRICTIONS_USED_GROUP_MAX_DESC', 'Die Gruppe, aus welcher der Benutzer einen Plan eine bestimmte Anzahl haben muss - h&ouml;chstens so viele Male wie angegeben');

define( '_ITEMGROUP_RESTRICTIONS_CUSTOM_RESTRICTIONS_ENABLED_NAME', 'eigene Einschr&auml;nkungen benutzen:');
define( '_ITEMGROUP_RESTRICTIONS_CUSTOM_RESTRICTIONS_ENABLED_DESC', 'Eigene Einschr&auml;nkungen wie unten angegeben benutzen.');
define( '_ITEMGROUP_RESTRICTIONS_CUSTOM_RESTRICTIONS_NAME', 'Eigene Einschr&auml;nkungen:');
define( '_ITEMGROUP_RESTRICTIONS_CUSTOM_RESTRICTIONS_DESC', 'RewriteEngine benutzen um eine eigene Regeln zur Anzeige zu stellen:<br />[[user_id]] >= 1500<br />[[parametername]] = value<br />(Jede Regel in eine neue Zeile schreiben).<br />Es k&ouml;nnen =, <=, >=, <, >, <> als untergeordnete Eintr&auml;ge aus dieser genutzt werden. Zwischen Variablen, Werten und Vergleichszeichen muss eine Leerstelle stehen!');

// Group Relations

define( '_ITEMGROUP_RELATIONS_TITLE', 'Beziehungen');
define( '_ITEMGROUP_PARAMS_SIMILARITEMGROUPS_NAME', '&Auml;hnliche Gruppen:');
define( '_ITEMGROUP_PARAMS_SIMILARITEMGROUPS_DESC', 'W&auml;hlen Sie aus, welche Gruppen dieser &auml;hnlich sind. Es ist einem Benutzer nicht erlaubt, eine Probezeit zu nutzen, wenn er einen Plan kauft, den er zuvor bereits erworben hat und das gilt ebenfalls f&uuml;r &auml;hnliche Pl&auml;ne (oder Pl&auml;ne aus &auml;hnlichen Gruppen).');
define( '_ITEMGROUP_PARAMS_EQUALITEMGROUPS_NAME', 'Gleichwertige Gruppen:');
define( '_ITEMGROUP_PARAMS_EQUALITEMGROUPS_DESC', 'W&auml;hlen Sie aus, welche Gruppen dieser Gruppe gleichwertig sind. Ein Benutzer, der zwischen gleichwertigen Pl&auml;nen wechselt (oder Pl&auml;nen in gleichwertigen Gruppen) wird seine Zeitspanne verl&auml;ngert bekommen, anstatt sie vom aktuellen Datum neu zu berechnen. Probezeiten sind au&szlig;erdem nicht erlaubt (siehe &auml;hnliche Gruppen Info).');

// Currencies

define( '_CURRENCY_AFA', 'Afghani' );
define( '_CURRENCY_ALL', 'Albanische Lek' );
define( '_CURRENCY_DZD', 'Algerische Dinar' );
define( '_CURRENCY_AON', 'Angola Kwanza' );
define( '_CURRENCY_ARS', 'Argentinische Peso' );
define( '_CURRENCY_AMD', 'Armenische Dram' );
define( '_CURRENCY_AWG', 'Aruban Guilder' );
define( '_CURRENCY_AUD', 'Australische Dollar' );
define( '_CURRENCY_AZM', 'Azerbaijanian Manat ' );
define( '_CURRENCY_EUR', 'Euro' );
define( '_CURRENCY_BSD', 'Bahamian Dollar' );
define( '_CURRENCY_BHD', 'Bahraini Dinar' );
define( '_CURRENCY_BDT', 'Bangladesh Taka' );
define( '_CURRENCY_BBD', 'Barbados Dollar' );
define( '_CURRENCY_BYB', 'Wei&szlig;russischer Rubel' );
define( '_CURRENCY_BZD', 'Belize Dollar' );
define( '_CURRENCY_BMD', 'Bermudian Dollar' );
define( '_CURRENCY_BOB', 'Bolivianische Boliviano' );
define( '_CURRENCY_BAD', 'Bosnische Dinar' );
define( '_CURRENCY_BWP', 'Botsuana Pula' );
define( '_CURRENCY_BRL', 'Real' );
define( '_CURRENCY_BND', 'Brunei Dollar' );
define( '_CURRENCY_BGN', 'Bulgarische Lev' );
define( '_CURRENCY_XOF', 'CFA Franc BCEAO' );
define( '_CURRENCY_BIF', 'Burundi Franc' );
define( '_CURRENCY_KHR', 'Kambodschanischer Riel' );
define( '_CURRENCY_XAF', 'CFA Franc BEAC' );
define( '_CURRENCY_CAD', 'Kanadische Dollar' );
define( '_CURRENCY_CVE', 'Cape Verde Escudo' );
define( '_CURRENCY_KYD', 'Cayman Islands Dollar' );
define( '_CURRENCY_CLP', 'Chilenische Peso' );
define( '_CURRENCY_CNY', 'Yuan Renminbi' );
define( '_CURRENCY_COP', 'Kolumbianische Peso' );
define( '_CURRENCY_KMF', 'Comoro Franc' );
define( '_CURRENCY_BAM', 'Convertible Marks' );
define( '_CURRENCY_CRC', 'Costa Rican Colon' );
define( '_CURRENCY_HRK', 'Kroatische Kuna' );
define( '_CURRENCY_CUP', 'Kubanische Peso' );
define( '_CURRENCY_CYP', 'Zypriotische Pfund' );
define( '_CURRENCY_CZK', 'Tschechische Krone' );
define( '_CURRENCY_DKK', 'D&auml;nische Krone' );
define( '_CURRENCY_DJF', 'Djibouti Franc' );
define( '_CURRENCY_XCD', 'East Caribbean Dollar' );
define( '_CURRENCY_DOP', 'Dominican Peso' );
define( '_CURRENCY_TPE', 'Timor Escudo' );
define( '_CURRENCY_ECS', 'Ecuador Sucre' );
define( '_CURRENCY_EGP', '&Auml;gyptische Pfund' );
define( '_CURRENCY_SVC', 'El Salvador Colon' );
define( '_CURRENCY_EEK', 'Estnische Krone' );
define( '_CURRENCY_ETB', '&Auml;thiopische Birr' );
define( '_CURRENCY_FKP', 'Falkland Islands Pfund' );
define( '_CURRENCY_FJD', 'Fiji Dollar' );
define( '_CURRENCY_XPF', 'CFP Franc' );
define( '_CURRENCY_FRF', 'Franc' );
define( '_CURRENCY_CDF', 'Kongo Franc' );
define( '_CURRENCY_GMD', 'Dalasi' );
define( '_CURRENCY_GHC', 'Cedi' );
define( '_CURRENCY_GIP', 'Gibraltar Pfund' );
define( '_CURRENCY_GTQ', 'Guatemala Quetzal' );
define( '_CURRENCY_GNF', 'Guinea Franc' );
define( '_CURRENCY_GWP', 'Guinea - Bissau Peso' );
define( '_CURRENCY_GYD', 'Guyana Dollar' );
define( '_CURRENCY_HTG', 'Gourde' );
define( '_CURRENCY_XAU', 'Gold' );
define( '_CURRENCY_HNL', 'Hondurianischer Lempira' );
define( '_CURRENCY_HKD', 'Hong Kong Dollar' );
define( '_CURRENCY_HUF', 'Ungarische Forint' );
define( '_CURRENCY_ISK', 'Isl&auml;ndische Krona' );
define( '_CURRENCY_INR', 'Indische Rupee' );
define( '_CURRENCY_IDR', 'Indonesische Rupiah' );
define( '_CURRENCY_IRR', 'Iranian Rial' );
define( '_CURRENCY_IQD', 'Iraqi Dinar' );
define( '_CURRENCY_ILS', 'Israelischer Shekel' );
define( '_CURRENCY_JMD', 'Jamaikanische Dollar' );
define( '_CURRENCY_JPY', 'Japanische Yen' );
define( '_CURRENCY_JOD', 'Jordanian Dinar' );
define( '_CURRENCY_KZT', 'Kasachstan Tenge' );
define( '_CURRENCY_KES', 'Kenyan Shilling' );
define( '_CURRENCY_KRW', 'S&uuml;dkoreanischer Won' );
define( '_CURRENCY_KPW', 'Nordkoreanischer Won' );
define( '_CURRENCY_KWD', 'Kuwaiti Dinar' );
define( '_CURRENCY_KGS', 'Kirgisischer Som' );
define( '_CURRENCY_LAK', 'Laotische Kip' );
define( '_CURRENCY_GEL', 'Georgischer Lari' );
define( '_CURRENCY_LVL', 'Lettische Lats' );
define( '_CURRENCY_LBP', 'Libanesisches Pfund' );
define( '_CURRENCY_LSL', 'Lesothischer Loti' );
define( '_CURRENCY_LRD', 'Liberian Dollar' );
define( '_CURRENCY_LYD', 'Libyan Dinar' );
define( '_CURRENCY_LTL', 'Litauische Litas' );
define( '_CURRENCY_AOR', 'Kwanza Reajustado' );
define( '_CURRENCY_MOP', 'Macao Pataca' );
define( '_CURRENCY_MKD', 'Denar' );
define( '_CURRENCY_MGF', 'Malagasy Franc' );
define( '_CURRENCY_MWK', 'Malawischer Kwacha' );
define( '_CURRENCY_MYR', 'Malaysian Ringitt' );
define( '_CURRENCY_MVR', 'Malediven Rupie (Rufiyaa)' );
define( '_CURRENCY_MTL', 'Maltesische Lira' );
define( '_CURRENCY_MRO', 'Mauretanischer Ouguiya' );
define( '_CURRENCY_TMM', 'Turkmenischer Manat' );
define( '_CURRENCY_FIM', 'Finnische Mark' );
define( '_CURRENCY_MUR', 'Mauritius Rupee' );
define( '_CURRENCY_MXN', 'Mexico Peso' );
define( '_CURRENCY_MXV', 'Mexican Unidad de Inversion' );
define( '_CURRENCY_MNT', 'Mongolia Tugrik' );
define( '_CURRENCY_MAD', 'Marokanische Dirham' );
define( '_CURRENCY_MDL', 'Moldauischer Leu' );
define( '_CURRENCY_MZM', 'Mosambik Metical' );
define( '_CURRENCY_MMK', 'Myanmar Kyat' );
define( '_CURRENCY_ERN', 'Eretrianischer Nakfa' );
define( '_CURRENCY_NAD', 'Namibischer Dollar' );
define( '_CURRENCY_NPR', 'Nepalesische Rupee' );
define( '_CURRENCY_ANG', 'Niederl&auml;ndische Antillen Gulden' );
define( '_CURRENCY_NZD', 'Neeseeland Dollar' );
define( '_CURRENCY_NIO', 'Cordoba Oro' );
define( '_CURRENCY_NGN', 'Nigerianische Naira' );
define( '_CURRENCY_BTN', 'Bhutan Ngultrum' );
define( '_CURRENCY_NOK', 'Norwegische Kronen' );
define( '_CURRENCY_OMR', 'Rial Omani' );
define( '_CURRENCY_PKR', 'Pakistan Rupee' );
define( '_CURRENCY_PAB', 'Balboa' );
define( '_CURRENCY_PGK', 'Neu Guinea Kina' );
define( '_CURRENCY_PYG', 'Guarani' );
define( '_CURRENCY_PEN', 'Peruanischer Nuevo Sol' );
define( '_CURRENCY_XPD', 'Palladium' );
define( '_CURRENCY_PHP', 'Philippine Peso' );
define( '_CURRENCY_XPT', 'Platin' );
define( '_CURRENCY_PLN', 'Polnische Zloty' );
define( '_CURRENCY_QAR', 'Qatari Rial' );
define( '_CURRENCY_RON', 'Neuer Rum&auml;nischer Leu' );
define( '_CURRENCY_ROL', 'Rum&auml;nischer Leu' );
define( '_CURRENCY_RSD', 'Serbian dinar');
define( '_CURRENCY_RUB', 'Russische Rubel' );
define( '_CURRENCY_RWF', 'Ruanda Franc' );
define( '_CURRENCY_WST', 'Samoa Tala' );
define( '_CURRENCY_STD', 'Dobra' );
define( '_CURRENCY_SAR', 'Saudi Riyal' );
define( '_CURRENCY_SCR', 'Seychelles Rupee' );
define( '_CURRENCY_SLL', 'Sierra Leone Leone' );
define( '_CURRENCY_SGD', 'Singapore Dollar' );
define( '_CURRENCY_SKK', 'Slovakische Krone' );
define( '_CURRENCY_SBD', 'Solomon Islands Dollar' );
define( '_CURRENCY_SOS', 'Somalia Shilling' );
define( '_CURRENCY_ZAL', 'Rand (Financial)' );
define( '_CURRENCY_ZAR', 'Rand (S&uuml;dafrika)' );
define( '_CURRENCY_XAG', 'Silver' );
define( '_CURRENCY_LKR', 'Sri Lanka Rupee' );
define( '_CURRENCY_SHP', 'St.Helena Pound' );
define( '_CURRENCY_SDP', 'Sudanese Pound' );
define( '_CURRENCY_SDD', 'Sudanese Dinar' );
define( '_CURRENCY_SRG', 'Suriname Guilder' );
define( '_CURRENCY_SZL', 'Swaziland Lilangeni' );
define( '_CURRENCY_SEK', 'Schwedische Kronen' );
define( '_CURRENCY_CHF', 'Schweizer Franken' );
define( '_CURRENCY_SYP', 'Syrian Pound' );
define( '_CURRENCY_TWD', 'Taiwan Dollar' );
define( '_CURRENCY_TJR', 'Tajik Ruble' );
define( '_CURRENCY_TZS', 'Tanzanian Shilling' );
define( '_CURRENCY_THB', 'Thail&auml;ndische Baht' );
define( '_CURRENCY_TOP', 'Tonga Pa\'anga (Dollar)' );
define( '_CURRENCY_TTD', 'Trinidad &amp; Tobago Dollar' );
define( '_CURRENCY_TND', 'Tunisische Dinar' );
define( '_CURRENCY_TRY', 'T&uuml;rkische Lira' );
define( '_CURRENCY_UGX', 'Uganda Shilling' );
define( '_CURRENCY_UAH', 'Ukrainische Hrywnja' );
define( '_CURRENCY_ECV', 'Unidad de Valor Constante' );
define( '_CURRENCY_CLF', 'Chile Unidades de fomento' );
define( '_CURRENCY_AED', 'Vereinigte Arab. Emirate Dirham' );
define( '_CURRENCY_GBP', 'Englische Pfund' );
define( '_CURRENCY_USD', 'US Dollar' );
define( '_CURRENCY_UYU', 'Uruguayan Peso' );
define( '_CURRENCY_UZS', 'Uzbekistan Sum' );
define( '_CURRENCY_VUV', 'Vanuatu Vatu' );
define( '_CURRENCY_VEB', 'Venezuela Bolivar' );
define( '_CURRENCY_VND', 'Viet Nam Dong' );
define( '_CURRENCY_YER', 'Yemeni Rial' );
define( '_CURRENCY_ZRN', 'New Zaire' );
define( '_CURRENCY_ZMK', 'Sambischer Kwacha' );
define( '_CURRENCY_ZWD', 'Zimbabwe Dollar' );
define( '_CURRENCY_USN', 'US Dollar (N&auml;chster Tag)' );
define( '_CURRENCY_USS', 'US Dollar (Gleicher Tag)' );

// --== MICRO INTEGRATION OVERVIEW ==--
define( '_MI_TITLE',						'MicroIntegrationen' );
define( '_MI_NAME',							'Name' );
define( '_MI_DESC',							'Beschreibung' );
define( '_MI_ACTIVE',						'Aktiv' );
define( '_MI_REORDER',						'Reihenfolge' );
define( '_MI_FUNCTION',						'Funktionsname' );

// --== MICRO INTEGRATION EDIT ==--
define( '_MI_E_TITLE',						'MicroIntegration' );
define( '_MI_E_TITLE_LONG',					'Micro Integration' );
define( '_MI_E_SETTINGS',					'Einstellungen' );
define( '_MI_E_NAME_NAME',					'Name' );
define( '_MI_E_NAME_DESC',					'Name f&uuml;r diese MicroIntegration' );
define( '_MI_E_DESC_NAME',					'Beschreibung' );
define( '_MI_E_DESC_DESC',					'Kurzbeschreibung' );
define( '_MI_E_ACTIVE_NAME',				'Aktiv' );
define( '_MI_E_ACTIVE_DESC',				'Als aktiv markieren' );
define( '_MI_E_AUTO_CHECK_NAME',			'Aktion bei Ablauf' );
define( '_MI_E_AUTO_CHECK_DESC',			'Falls diese Komponente es erlaubt k&ouml;nnen Aktionen definiert werden wenn ein Abo ausl&auml;ft' );
define( '_MI_E_ON_USERCHANGE_NAME',		'Benutzeraktion' );
define( '_MI_E_ON_USERCHANGE_DESC',		'Falls von der Komponente unterst&uuml;tzt k&ouml;nnen Aktionen definiert werden wenn ein Benutzerabo ausl&auml;ft' );
define( '_MI_E_PRE_EXP_CHECK_NAME',				'Tage vor Ablauf' );
define( '_MI_E_PRE_EXP_CHECK_DESC',				'Anzahl der Tage vor dem Ablauf, ab wann die Aktionen gelten sollen' );
define( '_MI_E__AEC_GLOBAL_EXP_ALL_NAME', 'Alle Instanzen ablaufen lassen');
define( '_MI_E__AEC_GLOBAL_EXP_ALL_DESC', 'Die "Ablauf" Aktion ausf&uuml;hren, auch wenn der Benutzer noch einen anderen aktiven Bezahplan mit der selben MI hat. F&uuml;r gew&ouml;hnlich f&uuml;hrt die AEC solche Aktionen nur aus, wenn eine MI auch wirklich die letzte Instanz ist, die ein Benutzer durch Bezahlpl&auml;ne besitzt.');
define( '_MI_E_FUNCTION_NAME',				'Funktionsname' );
define( '_MI_E_FUNCTION_DESC',				'Welche der Systeme sollen verwendet werden' );
define( '_MI_E_FUNCTION_EXPLANATION',		'Bevor die MicroIntegration definiert wird, muss bestimmt werden, welche der MicroIntegrationen g&uuml;ltig/aktiv sind. Wahl treffen und speichern. Dann nochmals bearbeiten, die Einstellungen sind erst dann sichtbar. HINWEIS: einmal definiert lassen sich die Einstellungen nicht r&uuml;ckg&auml;ngig machen' );

// --== REWRITE EXPLANATION ==--
define( '_REWRITE_AREA_USER',				'Benutzeraccount bezogen' );
define( '_REWRITE_KEY_USER_ID',				'Benutzer ID' );
define( '_REWRITE_KEY_USER_USERNAME',		'Benutzername' );
define( '_REWRITE_KEY_USER_NAME',			'Name' );
define( '_REWRITE_KEY_USER_FIRST_NAME', 'Vorname');
define( '_REWRITE_KEY_USER_FIRST_FIRST_NAME', 'Erster Vorname');
define( '_REWRITE_KEY_USER_LAST_NAME', 'Nachname');
define( '_REWRITE_KEY_USER_EMAIL',			'Emailadresse' );
define( '_REWRITE_KEY_USER_ACTIVATIONCODE', 'Aktivierungs Code');
define( '_REWRITE_KEY_USER_ACTIVATIONLINK', 'Aktivierungs Link');

define( '_REWRITE_AREA_EXPIRATION',			'Benutzer ablaufbezogen' );
define( '_REWRITE_KEY_EXPIRATION_DATE',		'Ablaufdatum' );

define( '_REWRITE_AREA_SUBSCRIPTION',		'Benutzer abobezogen' );
define( '_REWRITE_KEY_SUBSCRIPTION_TYPE',	'Gateway' );
define( '_REWRITE_KEY_SUBSCRIPTION_STATUS', 'Abonnentenstatus' );
define( '_REWRITE_KEY_SUBSCRIPTION_SIGNUP_DATE',	'Datum Aboabschluss' );
define( '_REWRITE_KEY_SUBSCRIPTION_LASTPAY_DATE',	'Letztes Zahlungsdatum' );
define( '_REWRITE_KEY_SUBSCRIPTION_PLAN',			'Aktuelle Abo ID' );
define( '_REWRITE_KEY_SUBSCRIPTION_PREVIOUS_PLAN',	'Vorige Abo ID' );
define( '_REWRITE_KEY_SUBSCRIPTION_RECURRING',		'Wiederkehrende Zahlung' );
define( '_REWRITE_KEY_SUBSCRIPTION_LIFETIME',		'Immerw&auml;hrendes Abo' );
define( '_REWRITE_KEY_SUBSCRIPTION_EXPIRATION_DATE', 'Ablaufdatum (Frontend Formatting)');
define( '_REWRITE_KEY_SUBSCRIPTION_EXPIRATION_DATE_BACKEND', 'Ablaufdatum (Backend Formatting)');

define( '_REWRITE_AREA_PLAN', 				'Abo Bezogen' );
define( '_REWRITE_KEY_PLAN_NAME',			'Name' );
define( '_REWRITE_KEY_PLAN_DESC',			'Beschreibung' );

define( '_REWRITE_AREA_CMS',				'CMS Bezogen' );
define( '_REWRITE_KEY_CMS_ABSOLUTE_PATH',	'Absoluter Pfad zum CMS-Hauptverzeichnis (z.B. ../www/html/...' );
define( '_REWRITE_KEY_CMS_LIVE_SITE',		'Relativer Pfad zur Webseite (z.B. http://www.meineseite.com)' );

define( '_REWRITE_AREA_SYSTEM', 'Systembezogen');
define( '_REWRITE_KEY_SYSTEM_TIMESTAMP', 'Zeitstempel (Frontend Formatting)');
define( '_REWRITE_KEY_SYSTEM_TIMESTAMP_BACKEND', 'Zeitstempel (Backend Formatting)');
define( '_REWRITE_KEY_SYSTEM_SERVER_TIMESTAMP', 'Server Zeitstempel (Frontend Formatting)');
define( '_REWRITE_KEY_SYSTEM_SERVER_TIMESTAMP_BACKEND', 'Server Zeitstempel (Backend Formatting)');

define( '_REWRITE_AREA_INVOICE', 'Rechnungsbezogen');
define( '_REWRITE_KEY_INVOICE_ID', 'Rechnungs ID');
define( '_REWRITE_KEY_INVOICE_NUMBER', 'Rechnungs Nummer');
define( '_REWRITE_KEY_INVOICE_NUMBER_FORMAT', 'Rechnungs Nummer (formattierd)');
define( '_REWRITE_KEY_INVOICE_CREATED_DATE', 'Datum der Erstellung');
define( '_REWRITE_KEY_INVOICE_TRANSACTION_DATE', 'Datum der Bezahlung');
define( '_REWRITE_KEY_INVOICE_METHOD', 'Bezahlungsmethode');
define( '_REWRITE_KEY_INVOICE_AMOUNT', 'Betrag');
define( '_REWRITE_KEY_INVOICE_CURRENCY', 'W&auml;hrung');
define( '_REWRITE_KEY_INVOICE_COUPONS', 'Gutschein Liste');

define( '_REWRITE_ENGINE_TITLE', 'Rewrite Engine');
define( '_REWRITE_ENGINE_DESC', 'Um dynamischen Text einzuf&uuml;gen, k&oouml;nnen diese RWengine felder im Wiki-stil benutzt werden. Mit einem Klick durch die &Uuml;berschriften werden die verschiedenen Optionen angezeigt.');
define( '_REWRITE_ENGINE_AECJSON_TITLE', 'aecJSON');
define( '_REWRITE_ENGINE_AECJSON_DESC', 'Es kann auf Funktionalit&auml;t verwendet werden die im JSON markup geschrieben ist, das sieht so aus:<br />{aecjson} { "cmd":"date", "vars": [ "Y", { "cmd":"rw_constant", "vars":"invoice_created_date" } ] } {/aecjson}<br />Dieser Befehl gibt das aktuelle Jahr als Zahl wieder. Bitte im Handbuch und auf unserer Internetseite nach einer genaueren Erkl&auml;rung schauen!');

// --== COUPONS OVERVIEW ==--
define( '_COUPON_TITLE',					'Gutscheine' );
define( '_COUPON_TITLE_STATIC',				'Gruppengutscheine' );
define( '_COUPON_NAME',						'Name' );
define( '_COUPON_DESC',						'Beschreibung (erste 50 Zeichen)' );
define( '_COUPON_ACTIVE',					'Ver&ouml;ffentlicht' );
define( '_COUPON_REORDER',					'Ordnen' );
define( '_COUPON_USECOUNT',					'Angewendet' );

// --== INVOICE OVERVIEW ==--
define( '_INVOICE_TITLE',					'Rechnungen' );
define( '_INVOICE_SEARCH',					'Suche' );
define( '_INVOICE_USERID',					'Benutzername' );
define( '_INVOICE_INVOICE_NUMBER',			'Rechnungsnummer' );
define( '_INVOICE_SECONDARY_IDENT', 'Secondary Identification');
define( '_INVOICE_TRANSACTION_DATE',		'Durchf&uuml;hrungsdatum' );
define( '_INVOICE_METHOD',					'Art' );
define( '_INVOICE_AMOUNT',					'Betrag' );
define( '_INVOICE_CURRENCY',				'W&auml;hrung' );
define( '_INVOICE_COUPONS', 'Coupons');

// --== PAYMENT HISTORY OVERVIEW ==--
define( '_HISTORY_TITLE2',					'Aktuelle Transaktionsgeschichte' );
define( '_HISTORY_SEARCH',					'Suche' );
define( '_HISTORY_USERID',					'Benutzername' );
define( '_HISTORY_INVOICE_NUMBER',			'Rechnungsnummer' );
define( '_HISTORY_PLAN_NAME',				'Abonnement' );
define( '_HISTORY_TRANSACTION_DATE',		'Durchf&uuml;hrungsdatum' );
define( '_INVOICE_CREATED_DATE',			'Erstellt' );
define( '_HISTORY_METHOD',					'Rechnungsart' );
define( '_HISTORY_AMOUNT',					'Rechnungsbetrag' );
define( '_HISTORY_RESPONSE',				'Serverantwort' );

// --== ALL USER RELATED PAGES ==--
define( '_METHOD',							'Methode' );

// --== PENDING PAGE ==--
define( '_PEND_DATE',						'schwebend seit' );
define( '_PEND_TITLE',						'Schwebende Abonnements' );
define( '_PEND_DESC',						'Abonnements, die nicht abgeschlossen wurden. Dies ist normal, falls das System auf die Zahlungbenachrichtigung des Bezahldienste wartet.' );
define( '_ACTIVATED',						'Benutzer aktiviert.' );
define( '_ACTIVATE',						'Aktivieren' );

// --== EXPORT ==--
define( '_AEC_HEAD_EXPORT', 'Exportieren');
define( '_EXPORT_LOAD', 'Laden');
define( '_EXPORT_APPLY', 'Anwenden');
define( '_EXPORT_GENERAL_SELECTED_EXPORT_NAME', 'Exportierung Voreinstellung');
define( '_EXPORT_GENERAL_SELECTED_EXPORT_DESC', 'W&auml;hlen Sie eine Voreinstellung (oder eine automatisch gespeicherte vorherige Exportierung), anstatt die Auswahlen unten zu treffen. Sie k&ouml;nnen auch Anwenden oben rechts anklicken und eine Vorschau zu den Voreinstellungen ansehen.');
define( '_EXPORT_GENERAL_DELETE_NAME', 'L&ouml;schen');
define( '_EXPORT_GENERAL_DELETE_DESC', 'Diese Voreinstellung l&ouml;schen (nach Anwendung)');
define( '_EXPORT_PARAMS_PLANID_NAME', 'Bezahlplan');
define( '_EXPORT_PARAMS_PLANID_DESC', 'Abonnements mit diesem Bezahlplan herausfiltern');
define( '_EXPORT_PARAMS_STATUS_NAME', 'Status');
define( '_EXPORT_PARAMS_STATUS_DESC', 'Nur Abonnements mit diesem Status exportieren');
define( '_EXPORT_PARAMS_ORDERBY_NAME', 'Ordnen');
define( '_EXPORT_PARAMS_ORDERBY_DESC', 'Ordnen nach einem der folgenden Kriterien');
define( '_EXPORT_PARAMS_REWRITE_RULE_NAME', 'Felder');
define( '_EXPORT_PARAMS_REWRITE_RULE_DESC', 'Die ReWrite Engine Felder (durch semicolon getrennt) eintragen, welche exportiert werden sollen.');
define( '_EXPORT_PARAMS_SAVE_NAME', 'Speichern als neu?');
define( '_EXPORT_PARAMS_SAVE_DESC', 'Dieses Feld anklicken, um Ihre Einstellungen als neue Voreinstellung zu speichern');
define( '_EXPORT_PARAMS_SAVE_NAME_NAME', 'Name speichern');
define( '_EXPORT_PARAMS_SAVE_NAME_DESC', 'Neue Voreinstellung unter diesem Namen speichern');
define( '_EXPORT_PARAMS_EXPORT_METHOD_NAME', 'Exportiersmethode');
define( '_EXPORT_PARAMS_EXPORT_METHOD_DESC', 'Der Dateityp, in den Sie exportieren wollen');

// --== READOUT ==--
define( '_AEC_READOUT', 'AEC Readout');
define( '_READOUT_GENERAL_SHOW_SETTINGS_NAME', 'Einstellungen');
define( '_READOUT_GENERAL_SHOW_SETTINGS_DESC', 'AEC Systemeinstellungen im Readout anzeigen');
define( '_READOUT_GENERAL_SHOW_EXTSETTINGS_NAME', 'erweiterte Einstellungen');
define( '_READOUT_GENERAL_SHOW_EXTSETTINGS_DESC', 'erweierte AEC Systemeinstellungen im Readout anzeigen');
define( '_READOUT_GENERAL_SHOW_PROCESSORS_NAME', 'Bezahldiensteinstellungen');
define( '_READOUT_GENERAL_SHOW_PROCESSORS_DESC', 'Bezahldiensteinstellungen im Readout anzeigen');
define( '_READOUT_GENERAL_SHOW_PLANS_NAME', 'Pl&auml;ne');
define( '_READOUT_GENERAL_SHOW_PLANS_DESC', 'Pl&auml;ne im Readout anzeigen');
define( '_READOUT_GENERAL_SHOW_MI_RELATIONS_NAME', 'Plan -> MI Beziehung');
define( '_READOUT_GENERAL_SHOW_MI_RELATIONS_DESC', 'Die Beziehung Plan -> MI im Readout anzeigen');
define( '_READOUT_GENERAL_SHOW_MIS_NAME', 'MicroIntegrationen');
define( '_READOUT_GENERAL_SHOW_MIS_DESC', 'MicroIntegrationen und ihre Einstellungen im Readout anzeigen');
define( '_READOUT_GENERAL_STORE_SETTINGS_NAME', 'Einstellungen behalten');
define( '_READOUT_GENERAL_STORE_SETTINGS_DESC', 'Diese Einstellungen f&uuml;r dieses Administratorkonto merken');
define( '_READOUT_GENERAL_TRUNCATION_LENGTH_NAME', 'Feldinhalte k&uuml;rzen');
define( '_READOUT_GENERAL_TRUNCATION_LENGTH_DESC', 'Feldinhalte auf diese L&auml;nge k&uuml;rzen, wo angemessen');
define( '_READOUT_GENERAL_USE_ORDERING_NAME', 'Ordnung benutzen');
define( '_READOUT_GENERAL_USE_ORDERING_DESC', 'Anstatt Eintr&auml;ge in ihrer Datenbankordnung zu zeigen, werden sie nach ihrer (ebenfalls in der Datenbank gespeicherten) Ordnungsnummer gezeigt (falls anwendbar)');
define( '_READOUT_GENERAL_COLUMN_HEADERS_NAME', 'Spalten-K&ouml;pfe anzeigen');
define( '_READOUT_GENERAL_COLUMN_HEADERS_DESC', 'Alle X Zeilen die Spalten-K&ouml;pfe erneut anzeigen (zur &Uuml;bersichtlichkeit)');
define( '_READOUT_GENERAL_NOFORMAT_NEWLINES_NAME', 'Format: keine Zeilenumbr&uuml;che');
define( '_READOUT_GENERAL_NOFORMAT_NEWLINES_DESC', 'Verschiedene Eintr&auml;ge f&uuml;r eine Tabellenzelle werden normalerweise in seperaten Zeilen angezeigt. Mit dieser Option werden die Eintr&auml;ge nur in einem einzigen Textblock angezeigt.');
define( '_READOUT_GENERAL_EXPORT_CSV_NAME', 'Exportieren als .csv');
define( '_READOUT_GENERAL_EXPORT_CSV_DESC', 'Als .csv Datei exportieren welche in einem Programm zur Tabellenkalkulation benutzt werden kann.');

?>
