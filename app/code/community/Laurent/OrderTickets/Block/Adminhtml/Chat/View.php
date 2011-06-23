<?php

/*
 * @category   Laurent
 * @package    Laurent_OrderTickets
 * @copyright  Copyright (c) 2011 Laurent Clouet
 * @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 * @author     Laurent Clouet <laurent35240@gmail.com>
 */

/**
 * Description of View
 *
 */
class Laurent_OrderTickets_Block_Adminhtml_Chat_View extends Mage_Adminhtml_Block_Widget_Form_Container{
    
    public function __construct()
    {
        $this->_objectId = 'chat_id';
        $this->_controller = 'adminhtml_chat';
        $this->_blockGroup = 'ordertickets';
        $this->_mode = 'view';
        parent::__construct();
        $this->_removeButton('delete');

    }
    
    public function getHeaderText(){
        return $this->__('Tickets for order %s', $this->getChat()->getOrder()->getIncrementId());
    }
    
    /**
     * Gives currently seen chat
     * @return Laurent_OrderTickets_Model_Chat
     */
    public function getChat(){
        return Mage::registry('ordertickets_chat');
    }
    
}

?>
