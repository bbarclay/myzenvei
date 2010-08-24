<?php
/**
 * @version $Id: german.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Language - Frontend - German Formal
 * @copyright 2006-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

// Dont allow direct linking
( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Restricted access' );

if( defined( '_AEC_LANG' ) ) {
	return;
}

// new 2007.07.10
define( '_AEC_EXPIRE_TODAY',				'Das Konto ist bis heute aktiv' );
define( '_AEC_EXPIRE_FUTURE',				'Das Konto ist aktiv bis' );
define( '_AEC_EXPIRE_PAST',					'Das Konto war aktiv bis' );
define( '_AEC_DAYS_ELAPSED',				'Tag(e) abgelaufen' );
define( '_AEC_EXPIRE_TRIAL_TODAY',			'This trial is active until today' );
define( '_AEC_EXPIRE_TRIAL_FUTURE',			'This trial is active until' );
define( '_AEC_EXPIRE_TRIAL_PAST',			'This trial was valid until' );

// new 0.12.4 (mic)
define( '_AEC_EXPIRE_NOT_SET',				'Nicht definiert' );
define( '_AEC_GEN_ERROR',					'<h1>FEHLER!</h1><p>Leider trat w&auml;hrend der Bearbeitung ein Fehler auf - bitte informieren Sie auch den Administrator. Danke.</p>' );

// payments
define( '_AEC_PAYM_METHOD_FREE',			'Gratis/Frei' );
define( '_AEC_PAYM_METHOD_NONE',			'Kein/Frei' );
define( '_AEC_PAYM_METHOD_TRANSFER',		'&Uuml;berweisung' );

// processor errors
define( '_AEC_MSG_PROC_INVOICE_FAILED_SH',			'FEHLER: Fehlende Rechnungsnummer' );
define( '_AEC_MSG_PROC_INVOICE_FAILED_EV',			'Benachrichtigung f&uuml;r %s zu Rechnungsnummer %s - Re.Nummer existiert nicht:' );
define( '_AEC_MSG_PROC_INVOICE_ACTION_SH',			'Bezahlung' );
define( '_AEC_MSG_PROC_INVOICE_ACTION_EV',			'Meldung zur Zahlungsnachricht:' );
define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_STATUS',	'Rechnungsstatus:' );
define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_FRAUD',	'Betrags&uuml;berpr&uuml;fung fehlerhaft, gezahlt: %s, lt. Rechnung: %s - Zahlung abgebrochen' );
define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_CURR',		'Falsche W&auml;hrung, gezahlt in %s, lt. Rechnung %s, Zahlung abgebrochen' );
define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_VALID',	'G&uuml;ltige Zahlung' );
define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_VALID_APPFAIL',	'Payment valid, Application failed!' );
define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_TRIAL',	'G&uuml;ltige Zahlung - Gratiszeitraum' );
define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_PEND',		'G&uuml;ltige Zahlung - Status Wartend, Grund: %s' );
define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_CANCEL',	'Keine Zahlung - Storno' );
define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_CHARGEBACK',	'Keine Zahlung - R&uuml;ckbuchung' );
define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_CHARGEBACK_SETTLE',	'Keine Zahlung - R&uuml;ckbuchung gekl&auml;rt' );
define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_USTATUS',	', Benutzerstatus wurde auf \'Storno\' gesetzt' );
define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_USTATUS_HOLD',	', Benutzerstatus wurde auf \'Halt\' gesetzt' );
define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_USTATUS_ACTIVE',	', Benutzerstatus wurde auf \'Aktiv\' gesetzt' );
define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_EOT',		'Keine Zahlung - Abo ist abgelaufen' );
define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_DUPLICATE','Keine Zahlung - Duplikat' );
define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_NULL','Keine Zahlung - Null' );
define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_U_ERROR',	'Unbekannter Fehler' );
define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_REFUND',	'No Payment - Subscription Deleted (refund)' );
define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_EXPIRED',	', User has been expired' );

// end mic ########################################################

// --== PAYMENT PLANS PAGE ==--
define( '_PAYPLANS_HEADER',					'Bezahlungspl&auml;ne' );
define( '_NOPLANS_ERROR',					'Es trat ein interner Fehler auf, dadurch sind momentan keine Abonnements vorhanden, bitte den Administrator informieren - danke!');
define( '_NOPLANS_AUTHERROR', 'You are not authorized to access this option. Please contact administrator if you have any further questions.');
define( '_PLANGROUP_BACK', '&lt; Zur&uuml;ck');

// --== ACCOUNT DETAILS PAGE ==--
define( '_CHK_USERNAME_AVAIL',				'Benutzername %s ist verf&uuml;gbar' );
define( '_CHK_USERNAME_NOTAVAIL',			'Leider ist dieser Benutzername %s bereits vergeben!');

// --== MY SUBSCRIPTION PAGE ==--
define( '_MYSUBSCRIPTION_TITLE', 'Meine Mitgliedschaft');
define( '_MEMBER_SINCE', 'Mitglied seit');
define( '_HISTORY_COL1_TITLE',				'Rechnung');
define( '_HISTORY_COL2_TITLE',				'Wert');
define( '_HISTORY_COL3_TITLE',				'Zahlungsdatum');
define( '_HISTORY_COL4_TITLE',				'Methode');
define( '_HISTORY_COL5_TITLE',				'Aktion');
define( '_HISTORY_COL6_TITLE', 				'Plan');
define( '_HISTORY_ACTION_REPEAT', 			'bezahlen');
define( '_HISTORY_ACTION_CANCEL', 			'l&ouml;schen');
define( '_RENEW_LIFETIME', 					'Sie haben ein permanentes Benutzerkonto.');
define( '_RENEW_DAYSLEFT', 					'Tag(e) &uuml;brig');
define( '_RENEW_DAYSLEFT_TRIAL', 'Days left in Trial');
define( '_RENEW_DAYSLEFT_EXCLUDED', 		'Ihr Konto unterliegt keinem Ablauf.');
define( '_RENEW_DAYSLEFT_INFINITE', 		'&#8734');
define( '_RENEW_INFO', 						'Sie verwenden automatisch wiederkehrende Zahlungen.');
define( '_RENEW_OFFLINE', 					'Erneuern');
define( '_RENEW_BUTTON_UPGRADE', 			'Upgraden / Erneuern');
define( '_PAYMENT_PENDING_REASON_ECHECK',	'ECheck noch ausst&auml;ndig (1-4 Arbeitstage)');
define( '_PAYMENT_PENDING_REASON_TRANSFER', 'Zahlungsanweisung wird erwartet');
define( '_YOUR_SUBSCRIPTION', 'Ihre Mitgliedschaft');
define( '_YOUR_FURTHER_SUBSCRIPTIONS', 'Weitere Mitgliedschaften');
define( '_PLAN_PROCESSOR_ACTIONS', 'Hierzu k&ouml;nnen sie folgende Anweisungen ausf&uuml;hren:');
define( '_AEC_SUBDETAILS_TAB_OVERVIEW', '&Uuml;berblick');
define( '_AEC_SUBDETAILS_TAB_INVOICES', 'Rechnungen');
define( '_AEC_SUBDETAILS_TAB_DETAILS', 'Details');

define( '_HISTORY_ACTION_PRINT', 'drucken');
define( '_INVOICEPRINT_DATE', 'Datum');
define( '_INVOICEPRINT_ID', 'ID');
define( '_INVOICEPRINT_REFERENCE_NUMBER', 'Referenz Nummer');
define( '_INVOICEPRINT_ITEM_NAME', 'Artikel');
define( '_INVOICEPRINT_UNIT_PRICE', 'Einzelpreis');
define( '_INVOICEPRINT_QUANTITY', 'Menge');
define( '_INVOICEPRINT_TOTAL', 'Gesamt');
define( '_INVOICEPRINT_GRAND_TOTAL', 'Rechnungsbetrag');

define( '_INVOICEPRINT_ADDRESSFIELD', 'Hier k&ouml;nnen Sie ihre Addresse eingeben - Sie wird dann auf dem Ausdruck erscheinen.');
define( '_INVOICEPRINT_PRINT', 'Drucken');
define( '_INVOICEPRINT_BLOCKNOTICE', 'Dieser Bereich (inklusive Textfeld und Druckbutton) wird nicht mit ausgedruckt.');
define( '_INVOICEPRINT_PRINT_TYPEABOVE', 'Bitte geben Sie im Feld oben ihren Namen und Anschrift ein.');
define( '_INVOICEPRINT_PAIDSTATUS_UNPAID', '<strong>Diese Rechnung wurde noch nicht bezahlt.</strong>');
define( '_INVOICEPRINT_PAIDSTATUS_PAID', 'Diese Rechnung wurde am folgenden Datum bezahlt: %s');

define( '_AEC_YOUSURE', 'Are you sure?');

// --== EXPIRATION PAGE ==--
define( '_EXPIRE_INFO',						'Ihr Konto ist aktiv bis');
define( '_RENEW_BUTTON',					'Erneuern');
define( '_RENEW_BUTTON_CONTINUE', 'Extend Previous Membership');
define( '_ACCT_DATE_FORMAT',				'%m-%d-%Y');
define( '_EXPIRED',							'Ihr Abonnement ist abgelaufen, Ende des letzten Abonnements: ');
define( '_EXPIRED_TRIAL', 					'Ihre Testphase ist ausgelaufen, Ende der Testphase: ');
define( '_ERRTIMESTAMP', 					'Kann Zeitstempel nicht &auml;ndern.');
define( '_EXPIRED_TITLE', 					'Konto abgelaufen!!');
define( '_DEAR', 							'Sehr geehrte(r) %s,');

// --== CONFIRMATION FORM ==--
define( '_CONFIRM_TITLE', 					'Best&auml;tigungsformular');
define( '_CONFIRM_COL1_TITLE', 				'Ihr Konto');
define( '_CONFIRM_COL2_TITLE', 				'Detail');
define( '_CONFIRM_COL3_TITLE',				'Preis');
define( '_CONFIRM_ROW_NAME',				'Name: ');
define( '_CONFIRM_ROW_USERNAME',			'Benutzername: ');
define( '_CONFIRM_ROW_EMAIL',				'Email:');
define( '_CONFIRM_INFO',					'Benutzen Sie bitte den Best&auml;tigungsbutton um Ihre Bestellung abzuschlie&szlig;en.');
define( '_BUTTON_CONFIRM',					'Best&auml;tigen');
define( '_CONFIRM_TOS',						"Ich habe die <a href=\"%s\" target=\"_blank\" title=\"AGBs\">AGBs</a> gelesen und bin einverstanden.");
define( '_CONFIRM_TOS_IFRAME', "Ich habe die Allgemeinen Gesch&auml;ftsbedigungen (s.o.) gelesen und bin einverstanden.");
define( '_CONFIRM_TOS_ERROR',				'Sie m&uuml;ssen unsere AGBs lesen und akzeptieren');
define( '_CONFIRM_COUPON_INFO',				'Falls Sie einen Gutscheincode haben geben Sie ihn bitte auf den nachfolgenden Seiten an, um einen allf&auml;lligen Abzug zu ber&uuml;cksichtigen');
define( '_CONFIRM_COUPON_INFO_BOTH', 'If you have a coupon code, you can enter it here, or on the Checkout Page to get a discount on your payment');
define( '_CONFIRM_FREETRIAL', 'Kostenlose Testphase');

// --== SHOPPING CART FORM ==--
define( '_CART_TITLE', 'Shopping Cart');
define( '_CART_ROW_TOTAL', 'Total');
define( '_CART_INFO', 'Please use the Continue-Button below to complete your purchase.');

// --== EXCEPTION FORM ==--
define( '_EXCEPTION_TITLE', 'Additional Information Required');
define( '_EXCEPTION_TITLE_NOFORM', 'Please note:');
define( '_EXCEPTION_INFO', 'To proceed with your checkout, we need you to provide additional information as specified below:');

// --== PROMPT PASSWORD FORM ==--
define( '_AEC_PROMPT_PASSWORD', 'Aus Sicherheitsgr&uuml;nden m&uuml;ssen Sie ihr Passwort eingeben.');
define( '_AEC_PROMPT_PASSWORD_WRONG', 'Das Passwort stimmt nicht mit dem &uuml;berein, welches wir in unserer Datenbank f&uuml;r dieses Konto registriert haben. Bitte versuchen Sie es noch einmal.');
define( '_AEC_PROMPT_PASSWORD_BUTTON', 'Weiter');

// --== CHECKOUT FORM ==--
define( '_CHECKOUT_TITLE',					'Abschlie&szlig;en');
define( '_CHECKOUT_INFO',					'Die Angaben wurden gespeichert, es ist jetzt erforderlich, dass Sie mit der Bezahlung ihrer getroffenen Auswahl fortfahren - die Rechnungsnummer ist %s.<br />Sollte es im Folgenden Unklarheiten geben, k&ouml;nnen Sie immer zu dieser Seite zur&uuml;ckkehren, indem Sie sich mit ihren Zugangsdaten einw&auml;hlen.');
define( '_CHECKOUT_INFO_REPEAT',			'Willkommen zur&uuml;ck! Die Bezahlung ihrer getroffenen Auswahl ist noch ausst&auml;ndig - die Rechnungsnummer ist %s.<br />Sollte es im Folgenden Unklarheiten geben, k&ouml;nnen Sie immer zu dieser Seite zur&uuml;ckkehren, indem Sie sich mit ihren Zugangsdaten einw&auml;hlen.');
define( '_BUTTON_CHECKOUT',					'Fortfahren');
define( '_BUTTON_APPEND',					'Hinzuf&uuml;gen');
define( '_BUTTON_APPLY', 'Anwenden');
define( '_BUTTON_EDIT', 'Edit');
define( '_BUTTON_SELECT', 'Select');
define( '_CHECKOUT_COUPON_CODE',			'Gutscheincode');
define( '_CHECKOUT_INVOICE_AMOUNT',			'Rechnungsbetrag');
define( '_CHECKOUT_INVOICE_COUPON',			'Gutschein');
define( '_CHECKOUT_INVOICE_COUPON_REMOVE',	'entfernen');
define( '_CHECKOUT_INVOICE_TOTAL_AMOUNT',	'Summe');
define( '_CHECKOUT_COUPON_INFO',			'Falls Sie einen Gutscheincode haben, geben Sie ihn bitte hier an.');
define( '_CHECKOUT_GIFT_HEAD', 'Gift to another user');
define( '_CHECKOUT_GIFT_INFO', 'Enter details for another user of this site to give the item(s) you are about to purchase to that account.');

define( '_AEC_TERMTYPE_TRIAL', 'Initial Billing');
define( '_AEC_TERMTYPE_TERM', 'Regular Billing Term');
define( '_AEC_CHECKOUT_TERM', 'Billing Term');
define( '_AEC_CHECKOUT_NOTAPPLICABLE', 'not applicable');
define( '_AEC_CHECKOUT_FUTURETERM', 'future term');
define( '_AEC_CHECKOUT_COST', 'Cost');
define( '_AEC_CHECKOUT_TAX', 'Tax');
define( '_AEC_CHECKOUT_DISCOUNT', 'Discount');
define( '_AEC_CHECKOUT_TOTAL', 'Total');
define( '_AEC_CHECKOUT_DURATION', 'Duration');

define( '_AEC_CHECKOUT_DUR_LIFETIME', 'Lifetime');

define( '_AEC_CHECKOUT_DUR_DAY', 'Day');
define( '_AEC_CHECKOUT_DUR_DAYS', 'Days');
define( '_AEC_CHECKOUT_DUR_WEEK', 'Week');
define( '_AEC_CHECKOUT_DUR_WEEKS', 'Weeks');
define( '_AEC_CHECKOUT_DUR_MONTH', 'Month');
define( '_AEC_CHECKOUT_DUR_MONTHS', 'Months');
define( '_AEC_CHECKOUT_DUR_YEAR', 'Year');
define( '_AEC_CHECKOUT_DUR_YEARS', 'Years');

// --== ALLOPASS SPECIFIC ==--
define( '_REGTITLE',						'INSCRIPTION');
define( '_ERRORCODE',						'Erreur de code Allopass');
define( '_FTEXTA',							'Le code que vous avez utilis n\'est pas valide! Pour obtenir un code valable, composez le numero de tlphone, indiqu dans une fenetre pop-up, aprs avoir clicker sur le drapeau de votre pays. Votre browser doit accepter les cookies d\'usage.<br /><br />Si vous tes certain, que vous avez le bon code, attendez quelques secondes et ressayez encore une fois!<br><br>Sinon prenez note de la date et heure de cet avertissement d\'erreur et informez le Webmaster de ce problme en indiquant le code utilis.');
define( '_RECODE',							'Saisir de nouveau le code Allopass');

// --== REGISTRATION STEPS ==--
define( '_STEP_DATA',						'Ihre Daten');
define( '_STEP_CONFIRM',					'Best&auml;tigen');
define( '_STEP_PLAN',						'Plan w&auml;hlen');
define( '_STEP_EXPIRED',					'Abgelaufen!');

// --== NOT ALLOWED PAGE ==--
define( '_NOT_ALLOWED_HEADLINE',			'Mitgliedschaft erforderlich!');
define( '_NOT_ALLOWED_FIRSTPAR',			'Die Inhalte auf die Sie zugreifen m&ouml;chten, sind nur f&uuml;r Mitglieder dieser Seite zug&auml;nglich. Falls Sie also bereits registriert sind, benutzen Sie bitte unseren Login um sich einzuw&auml;hlen. Falls Sie sich registrieren m&ouml;chten, erhalten Sie hier einen &Uuml;berblick &uuml;ber die angebotenen Mitgliedschaften,:');
define( '_NOT_ALLOWED_REGISTERLINK',		'Registrierungs&uuml;bersicht');
define( '_NOT_ALLOWED_FIRSTPAR_LOGGED',		'Die Inhalte auf die Sie zugreifen m&ouml;chten, sind nur f&uuml;r Mitglieder dieser Seite zug&auml;nglich. Falls Sie also bereits registriert sind, folgend sie diesem Link um ihr Abonnement zu &auml;ndern: ');
define( '_NOT_ALLOWED_REGISTERLINK_LOGGED', 'Abonnement&uuml;bersicht');
define( '_NOT_ALLOWED_SECONDPAR',			'Um dieser Seite betreten zu k&ouml;nnen, ben&ouml;tigen sie nicht mehr als eine Minute, wir nutzen den Service von:');

// --== CANCELLED PAGE ==--
define( '_CANCEL_TITLE',					'Ergebnis der Registrierung: Abgebrochen!');
define( '_CANCEL_MSG',						'Unsere Datenverarbeitung hat die R&uuml;ckmeldung erhalten, dass Sie sich entschieden haben, die Registrierung abzubrechen. Falls Sie die Registrierung aufgrund von Problemen mit dieser Internetseite abgebrochen haben, benachrichtigen Sie bitte auch den Webseitenadmin davon.');

// --== PENDING PAGE ==--
define( '_PENDING_TITLE',					'Account Schwebend!');
define( '_WARN_PENDING',					'Ihr Konto ist noch immer nicht vollst&auml;ndig. Sollte dies f&uuml;r l&auml;ngere Zeit so bleiben obwohl Ihre Zahlung durchgef&uuml;hrt wurde, kontaktieren sie bitte den Administrator dieser Internetseite.');
define( '_PENDING_OPENINVOICE',				'Es scheint, Sie haben eine unbezahlte Rechnung in unserer Datenbank - Falls mit der Bezahlung etwas schief gelaufen ist, k&ouml;nnen Sie diese gerne erneut in Auftrag geben:');
define( '_GOTO_CHECKOUT',					'Noch einmal zum Bezahlen gehen');
define( '_GOTO_CHECKOUT_CANCEL',			'Sie k&ouml;nnen die Rechnungserstellung auch abbrechen (Sie werden dann zu einer neuen Auswahl umgeleitet):');
define( '_PENDING_NOINVOICE',				'Es scheint, Sie haben die letzte offene Rechnung nicht beglichen. Bitte benutzen Sie diesen Button um erneut zur Auswahl eines Abos zu gelangen:');
define( '_PENDING_NOINVOICE_BUTTON',		'Aboauswahl');
define( '_PENDING_REASON_ECHECK',			'(Desweiteren haben wir jedoch auch die Information, dass Sie sich entschieden haben, mit Echeck (oder ähnliche Methode) zu bezahlen. M&ouml;glicherweise m&uuml;ssen Sie also nur warten bis dieser verarbeitet wurde - dies dauert gew&ouml;hnlich 1-4 Tage.)');
define( '_PENDING_REASON_WAITING_RESPONSE', '(According to our information however, we are just waiting for a response from the payment processor. You will be notified once that has happened. Sorry for the delay.)');
define( '_PENDING_REASON_TRANSFER',			'(Desweiteren haben wir jedoch auch die Information, dass Sie sich entschieden haben, die Rechnung auf herk&ouml;mmlichem Weg zu bezahlen. Die Verarbeitung einer solchen Zahlung kann einige Tage dauern.)');

// --== HOLD PAGE ==--
define( '_HOLD_TITLE', 'Konto in Wartestellung');
define( '_HOLD_EXPLANATION', 'Ihr Benutzerkonto ist momentan in Wartestellung. Mit hoher Wahrscheinlichkeit ist der Grund hierf&uuml;r ein Problem mit Ihrer letzten Zahlung. Wir m&ouml;chten Sie bitten uns per E-Mail zu informieren, falls Sie nicht innerhalb der n&auml;chsten 24 Stunden per E-Mail zu diesem Problem kontaktiert werden.');

// --== THANK YOU PAGE ==--
define( '_THANKYOU_TITLE',					'Vielen Dank!');
define( '_SUB_FEPARTICLE_HEAD',				'Abonnementerneuerung abgeschlossen!');
define( '_SUB_FEPARTICLE_HEAD_RENEW',		'Erneuerung ihres Abonnements abgeschlossen!');
define( '_SUB_FEPARTICLE_LOGIN',			'Sie k&ouml;nnen sich nun einloggen.');
define( '_SUB_FEPARTICLE_THANKS',			'Vielen Dank!' );
define( '_SUB_FEPARTICLE_THANKSRENEW',		'Vielen Dank f&uuml;r ihre Treue!' );
define( '_SUB_FEPARTICLE_PROCESS',			'Wir werden ihren Auftrag nun verarbeiten.' );
define( '_SUB_FEPARTICLE_PROCESSPAY',		'Wir werden nun ihre Bezahlung abwarten.' );
define( '_SUB_FEPARTICLE_ACTMAIL',			'Sobald die Anfrage abgeschlossen ist, erhalten sie ein Email mit dem Aktivierungscode');
define( '_SUB_FEPARTICLE_MAIL',				'Sobald die Anfrage abgeschlossen ist, erhalten Sie von uns ein Email');

// --== CHECKOUT ERROR PAGE ==--
define( '_CHECKOUT_ERROR_TITLE', 'Error while processing the payment!');
define( '_CHECKOUT_ERROR_EXPLANATION', 'An error occured while processing your payment');
define( '_CHECKOUT_ERROR_OPENINVOICE', 'This leaves your invoice uncleared. To retry the payment, you can go to the checkout page once again to try again:');

// --== COUPON INFO ==--
define( '_COUPON_INFO',						'Gutscheine:');
define( '_COUPON_INFO_CONFIRM',				'Falls Sie einen Gutschein f&uuml;r die Bezahlung verwenden m&ouml;chten, geben Sie diesen bitte auf der Rechnungsseite an.');
define( '_COUPON_INFO_CHECKOUT',			'Bitte geben Sie jetzt den Gutschein an und best&auml;tigen durch dr&uuml;cken des Buttons');

// --== COUPON ERROR MESSAGES ==--
define( '_COUPON_WARNING_AMOUNT',			'Die angegebene Gutscheinnummer hat keinen Einflu&szlig; auf die Rechnungssumme.');
define( '_COUPON_ERROR_PRETEXT',			'Wir bedauern sehr:');
define( '_COUPON_ERROR_EXPIRED',			'Dieser Gutschein ist bereits abgelaufen.');
define( '_COUPON_ERROR_NOTSTARTED',			'Die Verwendung dieses Gutscheins ist momentan nicht erlaubt.');
define( '_COUPON_ERROR_NOTFOUND',			'Der Gutscheincode konnte nicht gefunden werden.');
define( '_COUPON_ERROR_MAX_REUSE',			'Dieser Gutschein wurde bereits von anderen Besuchern verwendet und hat das Maximum erreicht.');
define( '_COUPON_ERROR_PERMISSION',			'Sie haben nicht die erforderliche Berechtigung zur Verwendung dieses Gutscheins.');
define( '_COUPON_ERROR_WRONG_USAGE',		'Diese Gutschein kann daf&uuml;r nicht verwendet werden.');
define( '_COUPON_ERROR_WRONG_PLAN',			'Dieser Gutschein gilt nicht f&uuml;r dieses Abonnement.');
define( '_COUPON_ERROR_WRONG_PLAN_PREVIOUS',	'Um diesen Gutschein zu verwenden mu&szlig; ein anderes Abonnement gew&auml;hlt werden.');
define( '_COUPON_ERROR_WRONG_PLANS_OVERALL',	'Sie haben leider nicht das richtige Abonnement in den bisherigen Abos um diesen Gutschein zu verwenden.');
define( '_COUPON_ERROR_TRIAL_ONLY',			'Dieser Gutschein gilt nur f&uuml;r ein Probezeit-/Gratisabo.');
define( '_COUPON_ERROR_COMBINATION', 'Dieser Gutschein kann nicht mit einem der zuvor eingegebenen Gutscheine verwendet werden.');
define( '_COUPON_ERROR_SPONSORSHIP_ENDED', 'Die Patenschaft f&uuml;r diesen Coupon ist entweder abgelaufen oder zur Zeit nicht aktiv.');

// ----======== EMAIL TEXT ========----

define( '_AEC_SEND_SUB',				"Account details for %s at %s" );
define( '_AEC_USEND_MSG',				"Hello %s,\n\nThank you for registering at %s.\n\nYou may now login to %s using the username and password you registered with." );
define( '_AEC_USEND_MSG_ACTIVATE',				"Hello %s,\n\nThank you for registering at %s. Your account is created and must be activated before you can use it.\nTo activate the account click on the following link or copy-paste it in your browser:\n%s\n\nAfter activation you may login to %s using the following username and password:\n\nUsername - %s\nPassword - %s" );
define( '_ACCTEXP_SEND_MSG',				'Abonnement: %s bei %s');
define( '_ACCTEXP_SEND_MSG_RENEW',			'Erneuerung eines Abonnements: %s bei %s');
define( '_ACCTEXP_MAILPARTICLE_GREETING',	"Hallo %s,\n\n");
define( '_ACCTEXP_MAILPARTICLE_THANKSREG',	'Vielen Dank f&uuml;r ihr Abonnement auf %s.');
define( '_ACCTEXP_MAILPARTICLE_THANKSREN',	'Vielen Dank f&uuml;r die Erneuerung ihres Abonnements auf %s.' );
define( '_ACCTEXP_MAILPARTICLE_PAYREC',		'Ihre Bezahlung wurde dankend entgegengenommen.' );
define( '_ACCTEXP_MAILPARTICLE_LOGIN',		'Sie k&ouml;nnen sich nun auf %s mit dem gew&auml;hlten Benutzernamen und Passwort einw&auml;hlen.');
define( '_ACCTEXP_MAILPARTICLE_FOOTER',		"\n\nBitte nicht auf dieses Email antworten, es wurde automatisch generiert und dient nur der Information." );
define( '_ACCTEXP_ASEND_MSG',				"Hallo %s,\n\nein neues Abonnement wurde auf [ %s ] abgeschlossen.\n\nHier die Details:\n\nName.........: %s\nEmail........: %s\nBenutzername : %s\nAbo-ID.......: %s\nAbonnement...: %s\nIP...........: %s\nISP..........: %s\n\nDas ist eine automatische Benachrichtigung, bitte nicht antworten." );
define( '_ACCTEXP_ASEND_MSG_RENEW',			"Hallo %s,\n\neine Aboverl&auml;ngerung auf %s.\n\nHier die Benutzerdetails:\n\nName.........: %s\nEmail........: %s\nBenutzername : %s\nAbo-ID.......: %s\nAbonnement...: %s\nIP...........: %s\nISP..........: %s\n\nDas ist eine automatische Benachrichtigung, bitte nicht antworten." );
define( '_AEC_ASEND_MSG_NEW_REG',			"Hallo %s,\n\nEin neuer Benutzer wurde auf [ %s ] registriert.\n\nHier die Details:\n\nName . . . . : %s\nEmail : %s\nBenutzername  . . . : %s\nIP . . . . . : %s\nISP	 . . . . : %s\n\nDas ist eine automatische Benachrichtigung, bitte nicht antworten." );
define( '_AEC_ASEND_NOTICE',				"AEC %s: %s at %s" );
define( '_AEC_ASEND_NOTICE_MSG',		"According to the E-Mail reporting level you have selected, this is an automatic notification about an EventLog entry.\n\nThe details of this message are:\n\n--- --- --- ---\n\n%s\n\n--- --- --- ---\n\nPlease do not respond to this message as it is automatically generated and is for information purposes only. You can change the level of reported entries in your AEC Settings." );

// ----======== COUNTRY CODES ========----

define( 'COUNTRYCODE_SELECT', 'Select Country' );
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
