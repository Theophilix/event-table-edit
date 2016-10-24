<?php
/**
 * $Id: eventtableedit.php 140 2011-01-11 08:11:30Z kapsl $
 * @copyright (C) 2007 - 2016 Manuel Kaspar and Matthias Gruhn
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
defined( '_JEXEC' ) or die;
if(!defined('DS')) define('DS', DIRECTORY_SEPARATOR);
// Access check.
if (!JFactory::getUser()->authorise('core.manage', 'com_eventtableedit')) {
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

// Include dependancies
jimport('joomla.application.component.controller');
$input  =  JFactory::getApplication()->input;
		
$controller	= JControllerLegacy::getInstance('eventtableedit');
$controller->execute($input->get('task'));
$controller->redirect();
?>
