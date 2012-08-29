<?php

class UserController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
	    $auth = Zend_Auth::getInstance();
	    
		if($auth->hasIdentity()) {
			$this->view->identity = $auth->getIdentity();
			$this->view->currentId = $auth->getIdentity()->id;
		}
    }

    public function createAction()
    {
		$userForm = new Form_User();
		if ($this->_request->isPost()) {
			if ($userForm->isValid($_POST)) { 
				$userModel = new Model_User(); 
				$userModel->createUser(
					$userForm->getValue('username'), 
					$userForm->getValue('password'), 
					$userForm->getValue('first_name'), 
					$userForm->getValue('last_name'), 
					$userForm->getValue('role'),
					$userForm->getValue('image')
				);
				return $this->_forward('login'); 
			}
		} 
		$userForm->setAction('/user/create'); 
		$this->view->form = $userForm;
    }

    public function listAction()
    {
	    $currentUsers = Model_User::getUsers(); 
	    if ($currentUsers->count() > 0) {
			$this->view->users = $currentUsers; 
	    } else {
			$this->view->users = null; 
	    }	
    }

    public function updateAction()
    {
		$userForm = new Form_User(); 
		$userForm->setAction('/user/update'); 
		$userForm->removeElement('password'); 
		$userModel = new Model_User();
		if ($this->_request->isPost()) {
			if ($userForm->isValid($_POST)) { 
				$userModel->updateUser(
					$userForm->getValue('id'), 
					$userForm->getValue('username'), 
					$userForm->getValue('first_name'), 
					$userForm->getValue('last_name'), 
					$userForm->getValue('role'),
					$userForm->getValue('image')
				);
				return $this->_forward('list'); } 
		} else {
			$id = $this->_request->getParam('id'); 
			$currentUser = $userModel->find($id)->current(); 
			$userForm->populate($currentUser->toArray());
			
			// create the image preview
			$imagePreview = $userForm->createElement('image', 'image_preview');
			
			// element options
			$imagePreview->setLabel('Preview Image: ');
			$imagePreview->setAttrib('style', 'width:200px;height:auto;');
			
			// add the element to the form
			$imagePreview->setOrder(4);
			$image = '/images/upload/'.$currentUser->image;
			$imagePreview->setImage($image);
			$userForm->addElement($imagePreview);
		}
		$this->view->form = $userForm; 
    }

    public function passwordAction()
    {
        $passwordForm = new Form_User(); 
        $passwordForm->setAction('/user/password'); 
        $passwordForm->removeElement('first_name'); 
        $passwordForm->removeElement('last_name'); 
        $passwordForm->removeElement('username'); 
        $passwordForm->removeElement('role'); 
        $passwordForm->removeElement('image');
        
        $userModel = new Model_User();
		if ($this->_request->isPost()) {
			if ($passwordForm->isValid($_POST)) {
			$userModel->updatePassword( 
					$passwordForm->getValue('id'), 
					$passwordForm->getValue('password')
				);
			return $this->_forward('list'); }
		} else {
			$id = $this->_request->getParam('id');
			$currentUser = $userModel->find($id)->current();
			$passwordForm->populate($currentUser->toArray());
		}
		$this->view->form = $passwordForm;
    }

    public function deleteAction()
    {
    	$id = $this->_request->getParam('id'); 
    	$userModel = new Model_User(); 
    	$userModel->deleteUser($id);
    	return $this->_forward('list');
    }

    public function loginAction()
    {
        $userForm = new Form_User(); 
        $userForm->setAction('/user/login'); 
        $userForm->removeElement('first_name'); 
        $userForm->removeElement('last_name'); 
        $userForm->removeElement('role'); 
        $userForm->removeElement('image');
        
        if ($this->_request->isPost() && $userForm->isValid($_POST)) {
        	$data = $userForm->getValues();
        	//set up the auth adapter
        	// get the default db adapter
        	$db = Zend_Db_Table::getDefaultAdapter();
        	//create the auth adapter
        	$authAdapter = new Zend_Auth_Adapter_DbTable($db, 'users',
        			'username', 'password');
        	//set the username and password 
        	$authAdapter->setIdentity($data['username']); 
        	$authAdapter->setCredential(md5($data['password'])); 
        	//authenticate
        	$result = $authAdapter->authenticate();
        	if ($result->isValid()) {
        		// store the username, first and last names of the user 
        		$auth = Zend_Auth::getInstance();
        		$storage = $auth->getStorage(); 
        		$storage->write($authAdapter->getResultRowObject(
        				array('id','username' , 'first_name' , 'last_name', 'role', 'image'))); 
        		return $this->_forward('index');
        	} else { 
        		$this->view->loginMessage = "Sorry, your username or password was incorrect";
        	}
        }
        
        $this->view->form = $userForm;
    }

    public function logoutAction()
    {
    	$authAdapter = Zend_Auth::getInstance();
    	$authAdapter->clearIdentity();
    }

    public function thumbnailAction()
    {
    	$auth = Zend_Auth::getInstance();
	    
		if($auth->hasIdentity()) {
			$this->view->identity = $auth->getIdentity();
			$this->view->currentId = $auth->getIdentity()->id;
			$this->view->thumbnail = '/images/upload/'.$auth->getIdentity()->image;
		}
    }


}













