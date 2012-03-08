<?php

/*
 * @category   Laurent
 * @package    Laurent_OrderTickets
 * @copyright  Copyright (c) 2012 Laurent Clouet
 * @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 * @author     Laurent Clouet <laurent35240@gmail.com>
 */

/**
 * Description of New
 *
 */
class Laurent_OrderTickets_Block_Adminhtml_Chat_Create extends Mage_Adminhtml_Block_Widget_Form_Container{
    
    public function __construct()
    {
        $this->_controller = 'adminhtml_chat';
        $this->_blockGroup = 'ordertickets';
        $this->_mode = 'create';
        parent::__construct();
        
        $this->_removeButton('save');
        $this->_removeButton('reset');
    }
    
    /**
     * Page title
     * @return string
     */
    public function getHeaderText(){
        return $this->__('Create new order tickets');
    }
    
    /**
     * Url to go back to grid of order tickets
     * @return string
     */
    public function getBackUrl() {
        return $this->getUrl('*/adminhtml_chat/');
    }
    
}
