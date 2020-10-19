<?php
/**
 * $Id:$.
 *
 * @copyright (C) 2007 - 2020 Manuel Kaspar and Theophilix
 * @license GNU/GPL, see LICENSE.php in the installation package
 * This file is part of Event Table Edit
 *
 * Event Table Edit is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.

 * Event Table Edit is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.

 * You should have received a copy of the GNU General Public License
 * along with Event Table Edit. If not, see <http://www.gnu.org/licenses/>.
 */

// no direct access
defined('_JEXEC') or die;
$app = JFactory::getApplication();
?>

<legend><?php echo JText::_('COM_EVENTTABLEEDIT_APPEND_TABLE'); ?></legend>

<?php if (!$app->getUserState('com_eventtableedit.csvError', true)) :?>
	<div id="summaryHead"><?php echo JText::_('COM_EVENTTABLEEDIT_IMPORT_REPORT_SUCCESS'); ?></div>
	<p><?php echo JText::_('COM_EVENTTABLEEDIT_IMPORT_REPORT_APPEND'); ?></p>
<?php else: ?>
	<div id="summaryHeadFailed"><?php echo JText::_('COM_EVENTTABLEEDIT_IMPORT_REPORT_FAILED'); ?></div>
	<p><?php echo JText::_('COM_EVENTTABLEEDIT_IMPORT_REPORT_APPEND_FAILED'); ?></p>
<?php endif; ?>