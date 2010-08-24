<?php
/**
 * @version $Id: russian.php
 * @package AEC - Account Control Expiration - Membership Manager
 * @subpackage Language - Frontend - Russian
 * @copyright 2006-2008 Copyright (C) David Deutsch
 * @author David Deutsch <skore@skore.de> & Team AEC - http://www.valanx.org
 * @license GNU/GPL v.2 http://www.gnu.org/licenses/old-licenses/gpl-2.0.html or, at your option, any later version
 */

( defined('_JEXEC') || defined( '_VALID_MOS' ) ) or die( 'Direct Access to this location is not allowed.' );



if( defined( '_AEC_LANG' ) ) {

	return;

}



// new 0.12.4 - mic



define( '_AEC_EXPIRE_TODAY',				'Это аккаунт действителен в течение сегодняшнего дня' );

define( '_AEC_EXPIRE_FUTURE',				'Этот аккаунт действителен до' );


define( '_AEC_EXPIRE_PAST',					'Этот аккаунт был действителен до' );

define( '_AEC_DAYS_ELAPSED',				'дня(дней) истек');

define( '_AEC_EXPIRE_TRIAL_TODAY',			'Тестовый период действует сегодня' );

define( '_AEC_EXPIRE_TRIAL_FUTURE',			'Тестовый период действует до' );

define( '_AEC_EXPIRE_TRIAL_PAST',			'Тестовый период действовал до' );



define( '_AEC_EXPIRE_NOT_SET',				'Не установлен' );

define( '_AEC_GEN_ERROR',					'<h1>Ошибка</h1><p>Мы не можем выполнить Ваш запрос. Пожалуйста, свяжитесь с Администрацией сайта.</p>' );



// payments

define( '_AEC_PAYM_METHOD_FREE',			'Бесплатный' );

define( '_AEC_PAYM_METHOD_NONE',			'Неизвестный' );

define( '_AEC_PAYM_METHOD_TRANSFER',		'Transfer' );



// processor errors

define( '_AEC_MSG_PROC_INVOICE_FAILED_SH',			'Оплата инвойса не произошла' );

define( '_AEC_MSG_PROC_INVOICE_FAILED_EV',			'Processor %s notification for %s has failed - инвойс не существует:' );

define( '_AEC_MSG_PROC_INVOICE_ACTION_SH',			'Оплата по инвойсу' );

define( '_AEC_MSG_PROC_INVOICE_ACTION_EV',			'Платежная система сообщает:' );

define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_STATUS',	'Статус инвойса:' );

define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_FRAUD',	'Подтверждение суммы не прозошло, оплата: %s, инвойса: %s - отказ по оплате' );

define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_CURR',		'Отказ в подтверждении валюты платежа, оплата %s, инвойс: %s - отказ по оплате' );

define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_VALID',	'Платеж прошел, Действие выполнено' );

define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_VALID_APPFAIL',	'Платеж прошел, Application failed!' );

define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_TRIAL',	'Платеж прошел - Тестовый период' );

define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_PEND',		'Проверка статуса платежа, причина: %s' );

define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_CANCEL',	'Платеж не осуществлен - Подписка приостановлена' );

define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_CHARGEBACK',	'No Payment - Chargeback' );

define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_CHARGEBACK_SETTLE',	'No Payment - Chargeback Settlement' );

define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_USTATUS',	', Статус пользователя изменен \'Cancelled\'' );

define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_USTATUS_HOLD',	', Userstatus has been updated to \'Hold\'' );

define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_USTATUS_ACTIVE',	', Userstatus has been updated to \'Active\'' );

define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_EOT',		'Платеж не осуществлен - Подписка приостановлена' );

define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_DUPLICATE','Платеж не осуществлен - Повторите' );

define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_NULL','No Payment - Null' );

define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_U_ERROR',	'Неизвестная ошибка' );

define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_REFUND',	'Платеж не осуществлен - Подписка прекращена (refund)' );

define( '_AEC_MSG_PROC_INVOICE_ACTION_EV_EXPIRED',	', Пользователь удален' );



// end mic ########################################################



// --== PAYMENT PLANS PAGE ==--

define( '_PAYPLANS_HEADER', 'Планы подписки');

define( '_NOPLANS_ERROR', 'No payment plans available. Please contact administrator.');

define( '_NOPLANS_AUTHERROR', 'You are not authorized to access this option. Please contact administrator if you have any further questions.');

define( '_PLANGROUP_BACK', '&lt; Go back');



// --== ACCOUNT DETAILS PAGE ==--

define( '_CHK_USERNAME_AVAIL', "Имя пользователя %s доступно");

define( '_CHK_USERNAME_NOTAVAIL', "Имя пользователя %s уже занято!");



// --== MY SUBSCRIPTION PAGE ==--

define( '_MYSUBSCRIPTION_TITLE', 'Моя подписка');

define( '_MEMBER_SINCE', 'Подписан с');

define( '_HISTORY_COL1_TITLE', 'Инвойс');

define( '_HISTORY_COL2_TITLE', 'Сумма');

define( '_HISTORY_COL3_TITLE', 'Дата оплаты');

define( '_HISTORY_COL4_TITLE', 'Метод оплаты');

define( '_HISTORY_COL5_TITLE', 'Действие');

define( '_HISTORY_COL6_TITLE', 'План');

define( '_HISTORY_ACTION_REPEAT', 'оплатить');

define( '_HISTORY_ACTION_CANCEL', 'отмена');

define( '_RENEW_LIFETIME', 'У Вас неограниченная подписка.');

define( '_RENEW_DAYSLEFT_EXCLUDED', 'У Вас неограниченная подписка.');

define( '_RENEW_DAYSLEFT_INFINITE', '&#8734');

define( '_RENEW_DAYSLEFT', 'Осталось дней');

define( '_RENEW_DAYSLEFT_TRIAL', 'Осталось дней');

define( '_RENEW_INFO', 'You are using recurring payments.');

define( '_RENEW_OFFLINE', 'Обновить');

define( '_RENEW_BUTTON_UPGRADE', 'Обновить');

define( '_PAYMENT_PENDING_REASON_ECHECK', 'echeck uncleared (1-4 рабочих дня)');

define( '_PAYMENT_PENDING_REASON_TRANSFER', 'ожидается оплата');

define( '_YOUR_SUBSCRIPTION', 'Ваша подписка');

define( '_YOUR_FURTHER_SUBSCRIPTIONS', 'Further Memberships');

define( '_PLAN_PROCESSOR_ACTIONS', 'Для этого у Вас есть следующие возможности');

define( '_AEC_SUBDETAILS_TAB_OVERVIEW', 'Обзор');

define( '_AEC_SUBDETAILS_TAB_INVOICES', 'Инвойсы');

define( '_AEC_SUBDETAILS_TAB_DETAILS', 'Детали');


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

define( '_EXPIRE_INFO', 'Ваша подписка действительна до:');

define( '_RENEW_BUTTON', 'Обновить');

define( '_RENEW_BUTTON_CONTINUE', 'Extend Previous Membership');

define( '_ACCT_DATE_FORMAT', '%d-%m-%Y');

define( '_EXPIRED', 'Ваша подписка истекла: ');

define( '_EXPIRED_TRIAL', 'Тестовый период истек: ');

define( '_ERRTIMESTAMP', 'Cannot convert timestamp.');

define( '_EXPIRED_TITLE', 'Подписка истекла!');

define( '_DEAR', 'Уважаемый(ая) %s');



// --== CONFIRMATION FORM ==--

define( '_CONFIRM_TITLE', 'Подтверждение');

define( '_CONFIRM_COL1_TITLE', 'Аккаунт');

define( '_CONFIRM_COL2_TITLE', 'Детали');

define( '_CONFIRM_COL3_TITLE', 'Сумма');

define( '_CONFIRM_ROW_NAME', 'Имя: ');

define( '_CONFIRM_ROW_USERNAME', 'Имя пользователя: ');

define( '_CONFIRM_ROW_EMAIL', 'E-mail:');

define( '_CONFIRM_INFO', 'Для завершения регистрации нажмите кнопку Продолжить');

define( '_BUTTON_CONFIRM', 'Продолжить');

define( '_CONFIRM_TOS', "Я прочитал и согласен <a href=\"%s\" target=\"_BLANK\">с правилами</a>");

define( '_CONFIRM_TOS_IFRAME', "Я прочитал и согласен с условиями");

define( '_CONFIRM_TOS_ERROR', 'Пожалуйста прочтите условия обслуживания');

define( '_CONFIRM_COUPON_INFO', 'Если у Вас есть купон, используйте его при оплате');

define( '_CONFIRM_COUPON_INFO_BOTH', 'Если у Вас есть купон введите его код здесь для получения скидки');

define( '_CONFIRM_FREETRIAL', 'Бесплатный тестовый период');



// --== SHOPPING CART FORM ==--

define( '_CART_TITLE', 'Shopping Cart');

define( '_CART_ROW_TOTAL', 'Total');

define( '_CART_INFO', 'Please use the Continue-Button below to complete your purchase.');



// --== EXCEPTION FORM ==--

define( '_EXCEPTION_TITLE', 'Additional Information Required');

define( '_EXCEPTION_TITLE_NOFORM', 'Please note:');

define( '_EXCEPTION_INFO', 'To proceed with your checkout, we need you to provide additional information as specified below:');



// --== PROMPT PASSWORD FORM ==--

define( '_AEC_PROMPT_PASSWORD', 'В целях безопасности, введите Ваш пароль');

define( '_AEC_PROMPT_PASSWORD_WRONG', 'Пароль неверный. Попробуйте еще раз!');

define( '_AEC_PROMPT_PASSWORD_BUTTON', 'Продолжить');



// --== CHECKOUT FORM ==--

define( '_CHECKOUT_TITLE', 'Оплата');

define( '_CHECKOUT_INFO', 'Данные Вашей регистрации сохранены. На этой странице Вы можете произвести оплату - %s. <br /> В случае сбоя при оплате Вы всегда сможете вернуться на эту страницу, воспользовавшись имеющимися логином и паролем и произвести оплату');

define( '_CHECKOUT_INFO_REPEAT', 'Спасибо, что вернулись. На этой странице Вы можете завершить платеж - %s. <br /> В случае сбоя при оплате Вы всегда сможете вернуться на эту страницу, воспользовавшись имеющимися логином и паролем и произвести оплату');

define( '_BUTTON_CHECKOUT', 'Оплата');

define( '_BUTTON_APPEND', 'Дополнительно');

define( '_BUTTON_APPLY', 'Применить');

define( '_CHECKOUT_COUPON_CODE', 'Код купона');

define( '_CHECKOUT_INVOICE_AMOUNT', 'Сумма инвойса');

define( '_CHECKOUT_INVOICE_COUPON', 'Купон');

define( '_CHECKOUT_INVOICE_COUPON_REMOVE', 'удалить');

define( '_CHECKOUT_INVOICE_TOTAL_AMOUNT', 'Общая сумма');

define( '_CHECKOUT_COUPON_INFO', 'Если у Вас есть купон - введите');

define( '_CHECKOUT_GIFT_HEAD', 'Gift to another user');

define( '_CHECKOUT_GIFT_INFO', 'Enter details for another user of this site to give the item(s) you are about to purchase to that account.');


define( '_AEC_TERMTYPE_TRIAL', 'Первоначальный платеж');

define( '_AEC_TERMTYPE_TERM', 'Платеж');

define( '_AEC_CHECKOUT_TERM', 'Платеж');

define( '_AEC_CHECKOUT_NOTAPPLICABLE', 'не применимо');

define( '_AEC_CHECKOUT_FUTURETERM', 'Условия');

define( '_AEC_CHECKOUT_COST', 'Стоимость');

define( '_AEC_CHECKOUT_TAX', 'Tax');
define( '_AEC_CHECKOUT_DISCOUNT', 'Скидка');

define( '_AEC_CHECKOUT_TOTAL', 'Всего');

define( '_AEC_CHECKOUT_DURATION', 'Продолжительность');



define( '_AEC_CHECKOUT_DUR_LIFETIME', 'Пожизненная');



define( '_AEC_CHECKOUT_DUR_DAY', 'День');

define( '_AEC_CHECKOUT_DUR_DAYS', 'Дней');

define( '_AEC_CHECKOUT_DUR_WEEK', 'Неделя');

define( '_AEC_CHECKOUT_DUR_WEEKS', 'Недель');

define( '_AEC_CHECKOUT_DUR_MONTH', 'Месяц');

define( '_AEC_CHECKOUT_DUR_MONTHS', 'Месяцев');

define( '_AEC_CHECKOUT_DUR_YEAR', 'Год');

define( '_AEC_CHECKOUT_DUR_YEARS', 'Лет');



// --== ALLOPASS SPECIFIC ==--

define( '_REGTITLE','INSCRIPTION');

define( '_ERRORCODE','Erreur de code Allopass');

define( '_FTEXTA','Le code que vous avez utilis n\'est pas valide! Pour obtenir un code valable, composez le numero de tlphone, indiqu dans une fenetre pop-up, aprs avoir clicker sur le drapeau de votre pays. Votre browser doit accepter les cookies d\'usage.<br><br>Si vous tes certain, que vous avez le bon code, attendez quelques secondes et ressayez encore une fois!<br><br>Sinon prenez note de la date et heure de cet avertissement d\'erreur et informez le Webmaster de ce problme en indiquant le code utilis.');

define( '_RECODE','Saisir de nouveau le code Allopass');



// --== REGISTRATION STEPS ==--

define( '_STEP_DATA', 'Ваши данные');

define( '_STEP_CONFIRM', 'Подтвердите');

define( '_STEP_PLAN', 'Выберите план подписки');

define( '_STEP_EXPIRED', 'Истекла!');



// --== NOT ALLOWED PAGE ==--

define( '_NOT_ALLOWED_HEADLINE', 'Необходима подписка!');

define( '_NOT_ALLOWED_FIRSTPAR', 'Страница которую Вы пытаетесь открыть доступна только для зарегистрированных пользователей. Если Вы являетесь зарегистрированным пользователем, Вам необходимо авторизоваться. Используйте эту ссылку если Вы хотите зарегистрироваться: ');

define( '_NOT_ALLOWED_REGISTERLINK', 'Страница регистрации');

define( '_NOT_ALLOWED_FIRSTPAR_LOGGED', 'Эта страница доступна для пользователей, имеющих ПЛАТНУЮ ПОДПИСКУ. Пожалуйста, прейдите по этой ссылке , если Вы хотите измнить свою подписку на ПЛАТНУЮ: ');

define( '_NOT_ALLOWED_REGISTERLINK_LOGGED', 'Страница регистрации');

define( '_NOT_ALLOWED_SECONDPAR', 'Процесс займет не более одной минуты:');



// --== HOLD PAGE ==--

define( '_HOLD_TITLE', 'Account on Hold');

define( '_HOLD_EXPLANATION', 'Your account is currently on hold. The most likely cause for this is that there was a problem with a payment you recently made. If you don\'t receive an email within the next 24 hours, please contact the site administrator.');



// --== CANCELLED PAGE ==--

define( '_CANCEL_TITLE', 'Результат попытки регистрации: Отменена!');

define( '_CANCEL_MSG', 'Наша система получила сообшение, что Вы решили отменить оплату. Если это связано с неполадками в работе нашего сайта, пожалуйста известите нас об этом!');



// --== PENDING PAGE ==--

define( '_PENDING_TITLE', 'Проверка');

define( '_WARN_PENDING', 'Ваш аккаунт  в процессе регистрации или временно приостановлен. Если Ваш платеж прошел и Вы не можете авторизоваться на сайте, пожалуйста, свяжитесь с Администрацией сайта');

define( '_PENDING_OPENINVOICE', 'Вы не подтвердили оплату инвойса - Если что-произошло в процессе осуществления платежа, Вы всегда можете вернуться на страницу Оплаты и повторить попытку:');

define( '_GOTO_CHECKOUT', 'Вернитесь на страницу Оплаты');

define( '_GOTO_CHECKOUT_CANCEL', 'вы можете также отменить оплату (вы будете иметь возможность вернуться на страницу выбор Плана подписки):');

define( '_PENDING_NOINVOICE', 'Вы отменили единственный инвойс, который был Вам выставлен. Пожалуйста, воспользуйтесь этой кнопкой, чтобы вернуться на страницу выбора Плана подписки:');

define( '_PENDING_NOINVOICE_BUTTON', 'Выбор плана подписки');

define( '_PENDING_REASON_ECHECK', '(According to our information however, you decided to pay by echeck (or similar), so you it might be that you just have to wait until this payment is cleared - which usually takes 1-4 days.)');

define( '_PENDING_REASON_WAITING_RESPONSE', '(According to our information however, we are just waiting for a response from the payment processor. You will be notified once that has happened. Sorry for the delay.)');

define( '_PENDING_REASON_TRANSFER', '(According to our information however, you decided to pay by an offline payment means, so you it might be that you just have to wait until this payment is cleared - which can take a couple of days.)');



// --== THANK YOU PAGE ==--

define( '_THANKYOU_TITLE', 'Спасибо!');

define( '_SUB_FEPARTICLE_HEAD', 'Регистрация завершена!');

define( '_SUB_FEPARTICLE_HEAD_RENEW', 'Регистрация обновлена!');

define( '_SUB_FEPARTICLE_LOGIN', 'Вы можете авторизоваться на сайте.');

define( '_SUB_FEPARTICLE_THANKS', 'Спасибо, что зарегистрировались. ');

define( '_SUB_FEPARTICLE_THANKSRENEW', 'Спасибо за то что обновили регистрацию. ');

define( '_SUB_FEPARTICLE_PROCESS', 'Система работает над Вашим запросом. ');

define( '_SUB_FEPARTICLE_PROCESSPAY', 'Система ожидает подтверждения оплаты. ');

define( '_SUB_FEPARTICLE_ACTMAIL', 'После завершения обработки Вашего запроса Вам будет выслан E_mail с линком для активации. ');

define( '_SUB_FEPARTICLE_MAIL', 'Вам будет выслан E-maol после подтверждения активации Вашего аккаунта. ');



// --== CHECKOUT ERROR PAGE ==--

define( '_CHECKOUT_ERROR_TITLE', 'Ощибка при оплате!');

define( '_CHECKOUT_ERROR_EXPLANATION', 'В процессе оплаты возникла ошибка');

define( '_CHECKOUT_ERROR_OPENINVOICE', 'Оплата не подтверждена. Вернитесь для завершения оплаты:');



// --== COUPON INFO ==--

define( '_COUPON_INFO', 'Купоны:');

define( '_COUPON_INFO_CONFIRM', 'Вы сможете использовать свой купон на странице оплаты.');

define( '_COUPON_INFO_CHECKOUT', 'Пожалуйста, введите код купона.');



// --== COUPON ERROR MESSAGES ==--

define( '_COUPON_WARNING_AMOUNT', 'One Coupon that you have added to this invoice does not affect the next payment, so although it seems that it does not affect this invoice, it will affect a subsequent payment.');

define( '_COUPON_ERROR_PRETEXT', 'Сожалеем:');

define( '_COUPON_ERROR_EXPIRED', 'Действие купона истекло.');

define( '_COUPON_ERROR_NOTSTARTED', 'Использование этого купона пока невозможно.');

define( '_COUPON_ERROR_NOTFOUND', 'Код купона не подтвержден.');

define( '_COUPON_ERROR_MAX_REUSE', 'Этот купон уже использован.');

define( '_COUPON_ERROR_PERMISSION', 'Использование купона не разрешено.');

define( '_COUPON_ERROR_WRONG_USAGE', 'Этот купон не подходит.');

define( '_COUPON_ERROR_WRONG_PLAN', 'Этот купон не подходит для Вашего плана подписки.');

define( '_COUPON_ERROR_WRONG_PLAN_PREVIOUS', 'To use this coupon, your last Subscription Plan must be different.');

define( '_COUPON_ERROR_WRONG_PLANS_OVERALL', 'You don\'t have the right Subscription Plans in your usage history to be allowed to use this coupon.');

define( '_COUPON_ERROR_TRIAL_ONLY', 'You may only use this coupon for a Trial Period.');

define( '_COUPON_ERROR_COMBINATION', 'You cannot use this coupon with one of the other coupons.');

define( '_COUPON_ERROR_SPONSORSHIP_ENDED', 'Sponsorship for this Coupon has ended or is currently inactive.');



// ----======== EMAIL TEXT ========----


define( 'SEND_MSG',"Здравствуйте, %s,\n\nБлагодарим вас за регистрацию на %s.\n\nПосле подтверждения оплаты подписки Вы сможете войти в %s, используя имя пользователя и пароль, полученные при регистрации.");

define( '_ACCTEXP_SEND_MSG',"Подписка для%s at %s");

define( '_ACCTEXP_SEND_MSG_RENEW',"Обновление подписки для%s at %s");

define( '_ACCTEXP_MAILPARTICLE_GREETING', "Здравствуйте %s, \n\n");

define( '_ACCTEXP_MAILPARTICLE_THANKSREG', "Сt %s.");

define( '_ACCTEXP_MAILPARTICLE_THANKSREN', "Спасибо за регистрацию на сайте %s.");

define( '_ACCTEXP_MAILPARTICLE_PAYREC', "Ваша оплата получена.");

define( '_ACCTEXP_MAILPARTICLE_LOGIN', "Сейчас Вы можете зайти на сайт %s используя свой логин и пароль.");

define( '_ACCTEXP_MAILPARTICLE_FOOTER',"\n\nПожалуйста, не отвечайте на это письмо");

define( '_ACCTEXP_ASEND_MSG',				"Hello %s,\n\na new user has created a subscription at [ %s ].\n\nHere further details:\n\nName.........: %s\nEmail........: %s\nUsername.....: %s\nSubscr.-ID...: %s\nSubscription.: %s\nIP...........: %s\nISP..........: %s\n\nPlease do not respond to this message as it is automatically generated and is for information purposes only." );

define( '_ACCTEXP_ASEND_MSG_RENEW',			"Hello %s,\n\na user has renewed his subscription at [ %s ].\n\nHere further details:\n\nName.........: %s\nEmail........: %s\nUsername.....: %s\nSubscr.-ID...: %s\nSubscription.: %s\nIP...........: %s\nISP..........: %s\n\nPlease do not respond to this message as it is automatically generated and is for information purposes only." );

define( '_AEC_ASEND_MSG_NEW_REG',			"Hello %s,\n\nThere has been a new registration at [ %s ].\n\nHere further details:\n\nName.....: %s\nEmail.: %s\nUsername....: %s\nIP.......: %s\nISP......: %s\n\nPlease do not respond to this message as it is automatically generated and is for information purposes only." );

define( '_AEC_ASEND_NOTICE',				"AEC %s: %s at %s" );

define( '_AEC_ASEND_NOTICE_MSG',		"According to the E-Mail reporting level you have selected, this is an automatic notification about an EventLog entry.\n\nThe details of this message are:\n\n--- --- --- ---\n\n%s\n\n--- --- --- ---\n\nPlease do not respond to this message as it is automatically generated and is for information purposes only. You can change the level of reported entries in your AEC Settings." );



// ----======== COUNTRY CODES ========----



define( 'COUNTRYCODE_SELECT', 'Выберите страну' );

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