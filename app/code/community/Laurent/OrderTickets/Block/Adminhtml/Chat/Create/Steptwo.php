<?php

/*
 * @category   Laurent
 * @package    Laurent_OrderTickets
 * @copyright  Copyright (c) 2012 Laurent Clouet
 * @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 * @author     Laurent Clouet <laurent35240@gmail.com>
 */

/**
 * Description of Steptwo
 *
 */
class Laurent_OrderTickets_Block_Adminhtml_Chat_Create_Steptwo extends Mage_Adminhtml_Block_Widget_Form_Container {
    
    public function __construct()
    {
        $this->_controller = 'adminhtml_chat_create';
        $this->_blockGroup = 'ordertickets';
        $this->_mode = 'steptwo';
        parent::__construct();
    }
    
    /**
     * Gives header text
     * @return string
     */
    public function getHeaderText() {
        return $this->__('Create new order tickets for order #%s', $this->getOrder()->getIncrementId());
    }
    
    /**
     * Get order selected for this chat creation
     * @return Mage_Sales_Model_Order 
     */
    public function getOrder(){
        $order = Mage::getModel('sales/order');
        /* @var $order Mage_Sales_Model_Order */
        $orderId = Mage::registry('chat_order_id');
        $order->load($orderId);
        
        return $order;
    }
    
}
