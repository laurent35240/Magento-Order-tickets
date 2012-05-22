<?php

/*
 * @category   Laurent
 * @package    Laurent_OrderTickets
 * @copyright  Copyright (c) 2011 Laurent Clouet
 * @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 * @author     Laurent Clouet <laurent35240@gmail.com>
 */

/**
 * Description of ChatController
 *
 */
class Laurent_OrderTickets_ChatController extends Mage_Core_Controller_Front_Action {

    /**
     * View order tickets action 
     */
    public function viewAction() {
        if (!$this->_loadValidOrder()) {
            return;
        }

        $this->loadLayout();

        $this->_initLayoutMessages('customer/session');

        $this->getLayout()->getBlock('head')->setTitle($this->__('Order #%s - Messages', Mage::registry('current_order')->getIncrementId()));

        if ($navigationBlock = $this->getLayout()->getBlock('customer_account_navigation')) {
            $navigationBlock->setActive('sales/order/history');
        }

        $this->renderLayout();
    }
    
    /**
     * Check if customer is authenticated 
     */
    public function preDispatch()
    {
        parent::preDispatch();

        if (!Mage::getSingleton('customer/session')->authenticate($this)) {
            $this->setFlag('', 'no-dispatch', true);
        }
    }

    /**
     * Action recording a ticket send through the form
     */
    public function ticketPostAction() {
        $orderId = $this->getRequest()->getPost('order-id');
        $message = $this->getRequest()->getPost('message');
        $errorMessage = $this->__('Error while saving your message. Please try again');

        if (!$orderId) {
            Mage::getSingleton('customer/session')->addError($errorMessage);
            $this->_redirect('sales/order/history');
            return false;
        }
        
        $chat = $this->_loadChat($orderId);

        if (!$chat || !$chat->getId()) {
            Mage::getSingleton('customer/session')->addError($errorMessage);
            $this->_redirect('*/*/view', array('order_id' => $orderId));
            return false;
        }
        
        $chatId = $chat->getId();

        try {
            $ticket = Mage::getModel('ordertickets/ticket');
            $ticket->setChatId($chatId);
            $ticket->setMessage($message);
            $ticket->setType(Laurent_OrderTickets_Model_Ticket::TYPE_REQUEST);
            $ticket->save();
        } catch (Exception $e) {
            Mage::log('Error while saving a ticket: ' . $e->getMessage(), Zend_Log::ERR);
            Mage::getSingleton('customer/session')->addError($errorMessage);
            $this->_redirect('*/*/view', array('order_id' => $orderId));
            return false;
        }
        
        $successMessage = $this->__('Your message was successfully recorded');
        Mage::getSingleton('customer/session')->addSuccess($successMessage);
        
        $this->_redirect('*/*/view', array('order_id' => $orderId));
    }
    
    protected function _loadChat($orderId){
        $chat = Mage::helper('ordertickets')->loadChatFromOrderId($orderId);
        
        if(!$chat || !$chat->getId()){
            $order = Mage::getModel('sales/order')->load($orderId);
            
            try{
                $chat = Mage::getModel('ordertickets/chat');
                $chat->setOrderId($orderId);
                $chat->setStatus(Laurent_OrderTickets_Model_Chat::STATUS_OPEN);
                $chat->setCustomerFirstname($order->getCustomerFirstname());
                $chat->setCustomerLastname($order->getCustomerLastname());
                $chat->setCustomerEmail($order->getCustomerEmail());
                $chat->save();
            }
            catch(Exception $e){
                $errorMessage = $this->__('Error while saving your message. Please try again');
                Mage::log('Error while saving a ticket: ' . $e->getMessage(), Zend_Log::ERR);
                Mage::getSingleton('customer/session')->addError($errorMessage);
                $this->_redirect('*/*/view', array('order_id' => $orderId));
                return false;
            }
        }
        
        return $chat;
    }

    /**
     * Try to load valid order by order_id and register it
     *
     * @param int $orderId
     * @return bool
     */
    protected function _loadValidOrder($orderId = null) {
        if (null === $orderId) {
            $orderId = (int) $this->getRequest()->getParam('order_id');
        }
        if (!$orderId) {
            $this->_forward('noRoute');
            return false;
        }

        $order = Mage::getModel('sales/order')->load($orderId);

        if ($this->_canViewOrder($order)) {
            Mage::register('current_order', $order);
            return true;
        } else {
            $this->_redirect('sales/order/history');
        }
        return false;
    }
    
    /**
     * Check order view availability
     *
     * @param   Mage_Sales_Model_Order $order
     * @return  bool
     */
    protected function _canViewOrder($order)
    {
        $customerId = Mage::getSingleton('customer/session')->getCustomerId();
        $availableStates = Mage::getSingleton('sales/order_config')->getVisibleOnFrontStates();
        if ($order->getId() && $order->getCustomerId() && ($order->getCustomerId() == $customerId)
            && in_array($order->getState(), $availableStates, true)
            ) {
            return true;
        }
        return false;
    }

}
