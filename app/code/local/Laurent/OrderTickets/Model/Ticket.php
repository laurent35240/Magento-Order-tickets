<?php

/*
 * @category   Laurent
 * @package    Laurent_OrderTickets
 * @copyright  Copyright (c) 2011 Laurent Clouet
 * @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 * @author     Laurent Clouet <laurent35240@gmail.com>
 */

/**
 * Description of Ticket
 *
 */
class Laurent_OrderTickets_Model_Ticket extends Laurent_OrderTickets_Model_Abstract {
    CONST TYPE_REQUEST = 'request';
    CONST TYPE_ANSWER = 'answer';
    
    protected $_chat;
    
    /**
     * Initialize resource model
     */
    protected function _construct()
    {
        $this->_init('ordertickets/ticket');
    }
    
    /**
     * Return the created at in formated date
     * @return string
     */
    public function getCreatedAtFormated(){
        return Mage::helper('core')->formatDate($this->getCreatedAt(), 'medium', true);
    }
    
    /**
     * Tell if the ticket has request type
     * @return boolean
     */
    public function isRequest(){
        return ($this->getType() == self::TYPE_REQUEST);
    }
    
    /**
     * Get chat of the ticket
     * @return Laurent_OrderTickets_Model_Chat
     */
    public function getChat(){
        if(!$this->_chat){
            $this->_chat = Mage::getModel('ordertickets/chat')->load($this->getChatId());
        }
        
        return $this->_chat;
    }
    
}

?>
