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
    
    public function getTickets(){
        $tickets = array();
        $chat = $this->getChat();
        
        if($chat){
            $tickets = Mage::getResourceModel('ordertickets/ticket_collection')
                    ->addFieldToFilter('chat_id', $chat->getId())
                    ->load();
        }
        
        
        return $tickets;
    }
    
    public function getChat(){
        $order = $this->getOrder();
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
        return Mage::getUrl('sales/order/history');
    }
    
    /**
     * Form action url for sending a ticket
     * @return string
     */
    public function getSendTicketPostUrl(){
        return Mage::getUrl('*/*/ticketPost');
    }
    
}

?>
