<?php
/**
 * $Id: view.html.php 140 2011-01-11 08:11:30Z kapsl $
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
jimport( 'joomla.application.component.view');
require_once JPATH_COMPONENT.'/views/csvimport/view.html.php';
require_once JPATH_COMPONENT.'/models/csvimport.php';

class EventtableeditViewxmlexport extends JViewLegacy {
	function display($tpl = null) {
		$user = JFactory::getUser();
		$app = JFactory::getApplication();
		
		if (!$user->authorise('core.csv', 'com_eventtableedit')) {
			JError::raiseWarning(403, JText::_('JERROR_ALERTNOAUTHOR'));
			return false;
		}
		$input  =  JFactory::getApplication()->input;
		$layout = $input->get('com_eventtableedit.layout');
		// Switch the differnet datatypes
		
		switch ($layout) {
			case 'summary':
				// Check for errors.
				if (count($errors = $this->get('Errors'))) {
					JError::raiseError(500, implode("\n", $errors));
					return false;
				}
				$postget = $input->getArray($_REQUEST);
				
				$this->assignRef('csvFile',$postget['csvFile']);
				
				$this->addSummaryToolbar();
				break;
			default:
				$importView = new EventtableeditViewCsvimport();
				$tableList = $importView->createTableSelectList();
				
				$this->assignRef('tables', $tableList);
				
				$this->addDefaultToolbar();
		}
		
		$this->document->addStyleSheet($this->baseurl.'/components/com_eventtableedit/template/css/eventtableedit.css');
		
		$this->setLayout($layout);
	    parent::display($tpl);
	}
	
	protected function addDefaultToolbar()	{
		JToolBarHelper::title(JText::_('COM_EVENTTABLEEDIT_MANAGER_XMLEXPORT'), 'export');

		JToolBarHelper::custom('xmlexport.export', 'apply.png', '', 'COM_EVENTTABLEEDIT_EXPORT', false);
	}
	
	/**
	 * The Toolbar for showing the summary of the export
	 */
	protected function addSummaryToolbar()	{
		JToolBarHelper::title(JText::_('COM_EVENTTABLEEDIT_EXPORT_SUMMARY'), 'export');

		JToolBarHelper::custom('xmlexport.cancel', 'apply.png', '', 'COM_EVENTTABLEEDIT_OK', false);
		JToolBarHelper::custom('xmlexport.download', 'apply.png', '', 'COM_EVENTTABLEEDIT_DOWNLOAD_FILE', false);
	}
}
?>
