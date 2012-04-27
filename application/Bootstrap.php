<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {
	protected function _initView() {
		// Initialize view
		$view = new Zend_View ();
		$view->doctype ( 'XHTML1_STRICT' );
		$view->headTitle ( 'Osmosys' );
		$view->skin = 'blues';
		
		// Add it to the ViewRenderer
		$viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper ( 'ViewRenderer' );
		$viewRenderer->setView ( $view );
		
		//Set the default timezone for use of Zend_Date
		date_default_timezone_set('Europe/London');
		
		// Return it, so that it can be stored by the bootstrap
		return $view;
	}
	
	protected function _initAutoload() {
		// Add autoloader empty namespace
		$autoLoader = Zend_Loader_Autoloader::getInstance(); 
		$autoLoader->registerNamespace('OSMOSYS_');
		$resourceLoader = new Zend_Loader_Autoloader_Resource(array(
			'basePath' => APPLICATION_PATH, 
			'namespace' => '', 
			'resourceTypes' => array(
				'form' => array(
					'path' => 'forms/',
					'namespace' => 'Form_',
				),
				'model' => array(
					'path' => 'models/',
					'namespace' => 'Model_'
				),
			),
		));
		
		// Return it so that it can be stored by the bootstrap 
		return $autoLoader;
	}
}

?>