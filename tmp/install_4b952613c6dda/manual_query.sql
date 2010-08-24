--
-- Database query file
-- For manual installation
--
-- @package     Better Preview
-- @version     1.6.0
--
-- @author      Peter van Westen <peter@nonumber.nl>
-- @link        http://www.nonumber.nl
-- @copyright   Copyright (C) 2010 NoNumber! All Rights Reserved
-- @license     http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
--

--
-- NOTE: The queries assume you are using 'jos_' as the prefix.
--       Please change that if you are using another prefix.
--

--
-- Insert the system plugin record
--
INSERT INTO `jos_plugins` (`id`, `name`, `element`, `folder`, `access`, `ordering`, `published`, `iscore`, `client_id`, `checked_out`, `checked_out_time`, `params`) VALUES
(NULL, 'System - Better Preview', 'betterpreview', 'system', 0, 0, 1, 0, 0, 0, '0000-00-00 00:00:00', '');

--
-- Insert the system plugin record for NoNumber! Elements (if not exists)
--
INSERT IGNORE INTO `jos_plugins` (`id`, `name`, `element`, `folder`, `access`, `ordering`, `published`, `iscore`, `client_id`, `checked_out`, `checked_out_time`, `params`) VALUES
( ( SELECT `id` FROM `jos_plugins` as x WHERE x.`element` = 'nonumberelements' ), 'System - NoNumber! Elements', 'nonumberelements', 'system', 0, 0, 1, 0, 0, 0, 0, '');