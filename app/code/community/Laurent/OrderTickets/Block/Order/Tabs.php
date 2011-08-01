<?php

/*
 * @category   Laurent
 * @package    Laurent_OrderTickets
 * @copyright  Copyright (c) 2011 Laurent Clouet
 * @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 * @author     Laurent Clouet <laurent35240@gmail.com>
 */

/**
 * Description of Tabs
 *
 */
class Laurent_OrderTickets_Block_Order_Tabs extends Mage_Core_Block_Template {
    
    CONST ORDER_VIEW_LINK = 'sales/order/view';
    CONST ORDER_CHAT_LINK = 'ordertickets/chat/view';
    
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
     * Gives url link for viewing the current order
     * @return string
     */
    public function getOrderViewLink(){
        return $this->getUrl(self::ORDER_VIEW_LINK, array('order_id' => $this->getOrder()->getId()));
    }
    
    /**
     * Gives url link for viewing tickets chat of current order
     * @return string
     */
    public function getOrderChatLink(){
        return $this->getUrl(self::ORDER_CHAT_LINK, array('order_id' => $this->getOrder()->getId()));
    }
    
    /**
     * Check if we are currenty in sales/order/view page
     * @return boolean
     */
    public function pageIsOrderView(){
        $requestString = $this->getRequest()->getRequestString();
        return (strstr($requestString, self::ORDER_VIEW_LINK) !== false);
    }
    
    
    /**
     * Check if we are currenty in order chat view page
     * @return boolean
     */
    public function pageIsOrderChat(){
        $requestString = $this->getRequest()->getRequestString();
        return (strstr($requestString, self::ORDER_CHAT_LINK) !== false);
    }
}

?>
