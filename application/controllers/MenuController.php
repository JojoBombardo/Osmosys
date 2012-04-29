<?php

class MenuController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $mdlMenu = new Model_Menu();
		$this->view->menus = $mdlMenu->getMenus();
    }

    public function createAction()
    {
    	$frmMenu = new Form_Menu(); 
    	if($this->getRequest()->isPost()) { 
    		if($frmMenu->isValid($_POST)) {
				$menuName = $frmMenu->getValue('name'); 
				$mdlMenu = new Model_Menu();
				$result = $mdlMenu->createMenu($menuName); 
				if($result) {
					// redirect to the index action
					$this->_redirect('/menu/index'); 
				}
			} 
    	}
		$frmMenu->setAction('/menu/create');
		$this->view->form = $frmMenu;
    }

    public function editAction()
    {
        $id = $this->_request->getParam('id');
        $mdlMenu = new Model_Menu();
        $frmMenu = new Form_Menu();
        // if this is a postback, then process the form if valid
        if ($this->getRequest()->isPost()) {
            if ($frmMenu->isValid($_POST)) {
                $menuName = $frmMenu->getValue('name');
                $mdlMenu = new Model_Menu();
                $result = $mdlMenu->updateMenu($id, $menuName);
                if ($result) {
                    // redirect to the index action
                    return $this->_forward('index');
                }
            }
        } else {
            // fetch the current menu from the db
            $currentMenu = $mdlMenu->find($id)->current();
            // populate the form
            $frmMenu->getElement('id')->setValue($currentMenu->id);
            $frmMenu->getElement('name')->setValue($currentMenu->name);
        }
        $frmMenu->setAction('/menu/edit');
        // pass the form to the view to render
        $this->view->form = $frmMenu;
    }

    public function deleteAction()
    {
        $id = $this->_request->getParam('id'); 
        $mdlMenu = new Model_Menu(); 
        $mdlMenu->deleteMenu($id); 
        $this->_forward('index');
    }
	
    

}







