<?php

/*
 * @category   Laurent
 * @package    Laurent_OrderTickets
 * @copyright  Copyright (c) 2011 Laurent Clouet
 * @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 * @author     Laurent Clouet <laurent35240@gmail.com>
 */

/**
 * Description of Data
 *
 */
class Laurent_OrderTickets_Helper_Data extends Mage_Core_Helper_Abstract{
    
    /**
     * Gives chat linked to an order if it exists
     * @param string $orderId
     * @return Laurent_OrderTickets_Model_Chat
     */
    public function loadChatFromOrderId($orderId){
        $chatCollection = Mage::getResourceModel('ordertickets/chat_collection')
                ->addFieldToFilter('order_id', $orderId)
                ->load();
            
        $chat = $chatCollection->getFirstItem();
        
        return $chat;
    }
    
    /**
     * Get associative array of chat statuses
     * @return array status code => status label 
     */
    public function getChatStatuses(){
        return array(
            Laurent_OrderTickets_Model_Chat::STATUS_CLOSED         => $this->__('Closed'),
            Laurent_OrderTickets_Model_Chat::STATUS_OPEN           => $this->__('Open'),
            Laurent_OrderTickets_Model_Chat::STATUS_PENDING_ANSWER => $this->__('Pending answer')
        );
    }

    /**
     * Get associative array of ticket types
     * @return array type code => type label
     */
    public function getTicketTypes() {
        return array(
            Laurent_OrderTickets_Model_Ticket::TYPE_REQUEST => $this->__('Customer request'),
            Laurent_OrderTickets_Model_Ticket::TYPE_ANSWER  => $this->__('Store answer'),
        );
    }
}

?>
