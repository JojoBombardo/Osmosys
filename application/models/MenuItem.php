<?php 
require_once 'Zend/Db/Table/Abstract.php';
class Model_MenuItem extends Zend_Db_Table_Abstract {
	protected $_name = 'menu_items';
    protected $_referenceMap = array(
    		'Menu' => array(
    			'columns' => array('menu_id') , 
    			'refTableClass' => 'Model_Menu' , 
    			'refColumns' => array('id') , 
    			'onDelete' => self::CASCADE , 
    			'onUpdate' => self::RESTRICT
    		)
    	);
}
?>