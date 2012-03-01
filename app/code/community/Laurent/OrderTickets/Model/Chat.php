<?php

/*
 * @category   Laurent
 * @package    Laurent_OrderTickets
 * @copyright  Copyright (c) 2011 Laurent Clouet
 * @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 * @author     Laurent Clouet <laurent35240@gmail.com>
 */

/**
 * Description of Chat
 *
 */
class Laurent_OrderTickets_Model_Chat extends Laurent_OrderTickets_Model_Abstract {
    CONST STATUS_OPEN = 'open';
    CONST STATUS_PENDING_ANSWER = 'pending_answer';
    CONST STATUS_CLOSED = 'closed';
    
    protected $_order;
    protected $_tickets;
    
    /**
     * Initialize resource model
     */
    protected function _construct()
    {
        $this->_init('ordertickets/chat');
    }
    
    /**
     * Gives order linked to the chat
     * @return Mage_Sales_Model_Order
     */
    public function getOrder(){
        if(!$this->_order){
            $this->_order = Mage::getModel('sales/order')->load($this->getOrderId());
        }
        
        return $this->_order;
    }
    
    /**
     * Give collection of tickets for this chat
     * @return Laurent_OrderTickets_Model_Mysql4_Ticket_Collection
     */
    public function getTickets(){
        if(!$this->_tickets){
            $ticketCollection = Mage::getResourceModel('ordertickets/ticket_collection')
                    ->addFieldToFilter('chat_id', $this->getId())
                    ->load();
            
            $this->_tickets = $ticketCollection;
        }
        
        return $this->_tickets;
    }
    
    
    /**
     * Give the status label if it exists
     * Give status code otherwise
     * @return string
     */
    public function getStatusLabel(){
        $allStatuses = Mage::helper('ordertickets')->getChatStatuses();
        
        if(array_key_exists($this->getStatus(), $allStatuses)){
            return $allStatuses[$this->getStatus()];
        }
        else{
            return $this->getStatus();
        }
    }

    /**
     * Try to load a chat by a given order id
     * @param int $orderId
     * @return LaurentOrderTickets_Model_Chat
     */
    public function loadByOrderId($orderId) {
        $orderId = (int) $orderId;
        return $this->load($orderId, 'order_id');
    }
}

?>
