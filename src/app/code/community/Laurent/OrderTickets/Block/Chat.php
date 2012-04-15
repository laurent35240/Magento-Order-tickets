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
class Laurent_OrderTickets_Block_Chat extends Mage_Core_Block_Template {
    
    /**
     * Retrieve current order model instance
     *
     * @return Mage_Sales_Model_Order
     */
    public function getOrder()
    {
        return Mage::registry('current_order');
    }
    
    /**
     * Retrieve collection of tickets for currently viewed chat
     * @return Laurent_OrderTickets_Model_Mysql4_Ticket_Collection
     */
    public function getTickets(){
        $tickets = array();
        $chat = $this->getChat();
        
        if($chat){
            /* @var $tickets Laurent_OrderTickets_Model_Mysql4_Ticket_Collection */
            $tickets = Mage::getResourceModel('ordertickets/ticket_collection')
                    ->addFieldToFilter('chat_id', $chat->getId())
                    ->load();
        }
        
        return $tickets;
    }
    
    /**
     * Retrieve currently viewed chat
     * @return Laurent_OrderTickets_Model_Chat
     */
    public function getChat(){
        $order = $this->getOrder();
        /* @var $chat Laurent_OrderTickets_Model_Chat */
        $chat = Mage::getModel('ordertickets/chat');
        
        if($order){
            $chat = Mage::helper('ordertickets')->loadChatFromOrderId($order->getId());
        }
        
        return $chat;
    }
    
    /**
     * The url for order history
     * @return string
     */
    public function getBackUrl(){
        return $this->getUrl('sales/order/history');
    }
    
    /**
     * Form action url for sending a ticket
     * @return string
     */
    public function getSendTicketPostUrl(){
        return $this->getUrl('*/*/ticketPost');
    }
    
}
