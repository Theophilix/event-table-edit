<?php
/**
 * $Id: default.php 140 2011-01-11 08:11:30Z kapsl $
 * @copyright (C) 2007 - 2011 Manuel Kaspar
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
?>

<form action="<?php echo JRoute::_('index.php?option=com_eventtableedit'); ?>" enctype="multipart/form-data" method="post" name="adminForm" id="adminForm">
	<div class="">
	<fieldset class="adminform">
		<legend><?php echo JText::_('COM_EVENTTABLEEDIT_UPLOAD_FILE') ?></legend>
		
		<p><?php echo JText::sprintf('COM_EVENTTABLEEDIT_CSVIMPORT_DESC', (int) $this->maxFileSize) ?></p>
		
		<ul class="adminformlist">
			<li>
				<label><?php echo JText::_('COM_EVENTTABLEEDIT_CSVFILE'); ?>: </label>
				<input type="file" name="fupload" />
			</li>
			<li>
				<label><?php echo JText::_('COM_EVENTTABLEEDIT_SEPARATOR'); ?>: </label>
				<select name="separator">
					<option selected="selected">;</option>
					<option>,</option>
					<option>:</option>
				</select>
			</li>
			<li>
				<label><?php echo JText::_('COM_EVENTTABLEEDIT_DOUBLEQUOTES'); ?>: </label>
				<select name="doubleqt">
					<option selected="selected" value="1"><?php echo JText::_('JYES'); ?></option>
					<option value="0"><?php echo JText::_('JNO'); ?></option>
				</select>
			</li>
			<li>
				<label><b><?php echo JText::_('COM_EVENTTABLEEDIT_CSVACTIONS'); ?>: </b></label>
				<ul class="etetable-import-actions">
					<li>
						<input type="radio" name="importaction" id="newTable" value="newTable" 
							   onclick="hideSelect();" checked /> <?php echo JText::_('COM_EVENTTABLEEDIT_IMPORT_NEW_TABLE_2'); ?>
					</li>
					<li>
						<input type="radio" name="importaction" id="overwriteTable" value="overwriteTable"
							   onclick="showSelect();" /> <?php echo JText::_('COM_EVENTTABLEEDIT_IMPORT_OVERWRITE_TABLE'); ?>
					</li>
					<li>
						<input type="radio" name="importaction" id="appendTable" value="appendTable"
							   onclick="showSelect();" /> <?php echo JText::_('COM_EVENTTABLEEDIT_IMPORT_APPEND_TABLE'); ?>
					</li>
				</ul>
			</li>
			<li id="tables">
				<label><?php echo JText::_('COM_EVENTTABLEEDIT_IMPORT_TABLES_DESC'); ?>: </label>
				<?php echo $this->tables; ?>
			</li>
		</ul>
	</fieldset>
	</div>
	
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="1" />
	<?php echo JHtml::_('form.token'); ?>
</form>

<script type="text/javascript">
<!--
	function showSelect() {
		document.getElementById('tables').style.display = 'inline';
	}
	function hideSelect() {
		document.getElementById('tables').style.display = 'none';
	}
-->
</script>
