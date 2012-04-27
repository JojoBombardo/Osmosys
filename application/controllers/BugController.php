<?php

class BugController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function createAction()
    {
        // action body
    }

    public function submitAction()
    {
        $bugReportForm = new Form_BugReportForm(); 
        $bugReportForm->setAction('/bug/submit'); 
        $bugReportForm->setMethod('post');
		if ($this->getRequest()->isPost()) {
			if ($bugReportForm->isValid($_POST)) { 
				$bugModel = new Model_Bug();
				
				// if the form is valid then create the new bug
				$result = $bugModel->createBug(
					$bugReportForm->getValue('author'), 
					$bugReportForm->getValue('email'), 
					$bugReportForm->getValue('date'), 
					$bugReportForm->getValue('url'), 
					$bugReportForm->getValue('description'), 
					$bugReportForm->getValue('priority'), 
					$bugReportForm->getValue('status')
				);
				// if the createBug method returns a result
				// then the bug was successfully created 
				if($result) {
					$this->_forward('confirm'); 
				}
			} 
		}
		$this->view->form = $bugReportForm;
    }

    public function confirmAction()
    {
        // action body
    }

    public function listAction()
    {
    	// get the filter form
    	$listToolsForm = new Form_BugReportListToolsForm(); 
    	$listToolsForm->setAction('/bug/list'); 
    	$listToolsForm->setMethod('post'); 
    	$this->view->listToolsForm = $listToolsForm;
    	
    	// set the sort and filter criteria. you need to update this to use the request, 
    	// as these values can come in from the form post or a url parameter
    	$sort = $this->_request->getParam('sort', null);
    	$filterField = $this->_request->getParam('filter_field', null);
    	$filterValue = $this->_request->getParam('filter');
    	if(!empty($filterField)) {
    		$filter[$filterField] = $filterValue;
    	}else{
    		$filter = null;
    	}
    	
    	// now you need to manually set these controls values 
    	$listToolsForm->getElement('sort')->setValue($sort); 
    	$listToolsForm->getElement('filter_field')->setValue($filterField); 
    	$listToolsForm->getElement('filter')->setValue($filterValue);
    	
    	// fetch the bug paginator adapter
    	$bugModels = new Model_Bug();
    	$adapter = $bugModels->fetchPaginatorAdapter($filter, $sort); 
    	$paginator = new Zend_Paginator($adapter);
    	
    	// show 10 bugs per page
    	$paginator->setItemCountPerPage(10);
    	
    	// get the page number that is passed in the request.
    	//if none is set then default to page 1.
    	$page = $this->_request->getParam('page', 1); 
    	$paginator->setCurrentPageNumber($page);
    	// pass the paginator to the view to render 
    	$this->view->paginator = $paginator;
    }


}









