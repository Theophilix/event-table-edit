<?php
/**
 * $Id: view.html.php 140 2011-01-11 08:11:30Z kapsl $.
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
jimport('joomla.application.component.view');

class EventtableeditViewAppointmenttables extends JViewLegacy
{
    protected $items;
    protected $pagination;
    protected $state;

    public function display($tpl = null)
    {
        $this->items = $this->get('Items');
        $this->pagination = $this->get('Pagination');
        $this->state = $this->get('State');

        // Check for errors.
        if (count($errors = $this->get('Errors'))) {
            foreach ($errors as $error) {
                JFactory::getApplication()->enqueueMessage($error, 'error');
            }
            return false;
        }

        $this->document->addStyleSheet($this->baseurl.'/components/com_eventtableedit/template/css/eventtableedit.css');

        // Preprocess the list of items to find ordering divisions.
        foreach ($this->items as &$item) {
            $item->publish_up = true;
            $item->publish_down = true;
        }

        $this->addToolbar();
        parent::display($tpl);
    }

    protected function addToolbar()
    {
        require_once JPATH_COMPONENT.'/helpers/ete.php';
        $canDo = eteHelper::getActions();

        $xml = JFactory::getXML(JPATH_COMPONENT_ADMINISTRATOR.'/eventtableedit.xml');
        $currentversion = (string) $xml->version;
        JToolBarHelper::title(JText::_('Event Table Edit '.$currentversion).' - '.JText::_('COM_EVENTTABLEEDIT_SUBMENU_APPOINTMENTTABLES'), 'etetables');

        if ($canDo->get('core.create')) {
            JToolBarHelper::addNew('appointmenttable.add', 'JTOOLBAR_NEW');
        }

        if ($canDo->get('core.edit')) {
            JToolBarHelper::editList('appointmenttable.edit', 'JTOOLBAR_EDIT');
        }

        if ($canDo->get('core.edit.state')) {
            JToolBarHelper::divider();
            JToolBarHelper::custom('appointmenttables.publish', 'publish.png', 'publish_f2.png', 'JTOOLBAR_PUBLISH', true);
            JToolBarHelper::custom('appointmenttables.unpublish', 'unpublish.png', 'unpublish_f2.png', 'JTOOLBAR_UNPUBLISH', true);
            JToolBarHelper::divider();
            JToolBarHelper::archiveList('appointmenttables.archive', 'JTOOLBAR_ARCHIVE');
            JToolBarHelper::custom('appointmenttables.checkin', 'checkin.png', 'checkin_f2.png', 'JTOOLBAR_CHECKIN', true);
        }

        if (-2 === (int)$this->state->get('filter.published') && $canDo->get('core.delete')) {
            JToolBarHelper::deleteList('', 'appointmenttables.delete', 'JTOOLBAR_EMPTY_TRASH');
            JToolBarHelper::divider();
        } elseif ($canDo->get('core.edit.state')) {
            JToolBarHelper::trash('appointmenttables.trash', 'JTOOLBAR_TRASH');
            JToolBarHelper::divider();
        }

        if ($canDo->get('core.admin')) {
            JToolBarHelper::preferences('com_eventtableedit');
        }
    }
}
