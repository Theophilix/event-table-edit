<?php
/**
 * @version		$Id: $
 * @package		eventtableedit
 * @copyright	Copyright (C) 2007 - 2011 Manuel Kaspar
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access
defined('_JEXEC') or die;
jimport('joomla.application.component.controller');

class EventtableeditControllerXmlimport extends JControllerLegacy {
	protected $app;
	
	protected $id;
	protected $file;
	protected $importaction;
	protected $separator;
	protected $doubleqt;
	protected $checkfun;
	protected $model;
	
	function __construct() {
		parent::__construct();
		$this->app = JFactory::getApplication();
	}
	
	/**
	 * Task that is called when uploading a csv file
	 */
	public function upload() {
		// ACL Check
		$app = JFactory::getApplication();

		$input  =  JFactory::getApplication()->input;
		$postget = $input->getArray($_REQUEST);
			
		// Initialize Variables
		$this->model = $this->getModel('xmlimport');
		$this->file = $input->files->get('fupload');
		$this->checkfun    = @$postget['checkfun']; 
		$info = pathinfo(basename($this->file['name']));
		$ext = strtolower($info['extension']);
		
		if(!$this->file['name']){
			$msg = JTEXT::_('COM_EVENTTABLEEDIT_UPLOAD_XMLFILE_VALID');
			$app->redirect('index.php?option=com_eventtableedit&view=xmlimport',$msg);
			
		}
		if($ext != 'xml'){
			$msg = JTEXT::_('COM_EVENTTABLEEDIT_UPLOAD_XMLFILE_VALID');
			$app->redirect('index.php?option=com_eventtableedit&view=xmlimport',$msg);
				
		}		
			
		$xml = simplexml_load_file($this->file['tmp_name']);
		$xml = json_encode($xml);
		$xml = json_decode($xml, TRUE);
	
		$xml['id'] = 0;
		if(count($xml['rowdata']['linerow']) > 0){
			$xml['temps'] = 0;
		}else{
			$xml['temps'] = 1;	
		}
		$xml['alias']= substr(md5(rand()), 0, 7);
		$xml['checkfun']=$this->checkfun?$this->checkfun:'0';
		$model = $this->getModel('Etetable','EventtableeditModel');
		$tablesave = $model->saveXml($xml);
		if($tablesave > 0){
			$msg = JTEXT::_('COM_EVENTTABLEEDIT_SUCCESSFULLY_TABLES_AND_DATA_CREATED');
			$app->redirect('index.php?option=com_eventtableedit&view=etetables',$msg);
		}
			
		

	
		
		parent::display();
	}
	

	public function cancel() {
		$this->setRedirect(JRoute::_('index.php?option=com_eventtableedit'));
		return false;
	}
	
	
}
