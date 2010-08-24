--
-- Database query file
-- For uninstallation
--
--

DELETE FROM `#__plugins` WHERE folder = 'content' AND element = 'contenttrail';
DELETE FROM `#__modules` WHERE module = 'mod_contenttrail';
DELETE FROM `#__modules_menu` WHERE moduleid NOT IN (SELECT id from `#__modules`);