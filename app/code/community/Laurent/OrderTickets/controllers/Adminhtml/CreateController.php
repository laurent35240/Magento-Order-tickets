<?php

/*
 * @category   Laurent
 * @package    Laurent_OrderTickets
 * @copyright  Copyright (c) 2012 Laurent Clouet
 * @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 * @author     Laurent Clouet <laurent35240@gmail.com>
 */

/**
 * Description of CreateController
 *
 */
class Laurent_OrderTickets_Adminhtml_CreateController extends Laurent_OrderTickets_Controller_Adminhtml_Chat {

    /**
     * Create a new Chat Action
     */
    public function indexAction() {
        $this->_baseTitle();
        $this->_title($this->__('Create new order tickets'));
        $this->_initAction();
        $this->renderLayout();
    }

    /**
     * Rendering order grid for creating new ordertickets 
     */
    public function loadOrderGridAction() {
        $this->loadLayout(false);
        $this->renderLayout();
    }

    /**
     * Check if we can create order tickets for required order 
     */
    public function stepTwoAction() {
        $session = $this->_getSession();
        
        try {
            //Checking if we receive an order id
            $orderId = (int) $this->getRequest()->getParam('order_id');
            $this->_checkOrderId($orderId);
            $order = Mage::getModel('sales/order')->load($orderId);
            /* @var $order Mage_Sales_Model_Order */
            
            //Checking if there is already started order chat for this order
            //If chat is found we redirect then to chat edit page
            $orderChat = Mage::getModel('ordertickets/chat');
            /* @var $orderChat Laurent_OrderTickets_Model_Chat */
            $orderChat->loadByOrderId($orderId);
            if($orderChat->getId()){
                $message = $this->__('Tickets already exist for this order. Please add new here.');
                $session->addNotice($message);
                $this->_redirect('*/adminhtml_chat/view', array('chat_id' => $orderChat->getId()));
                return false;
            }
            
            //Displaying form
            Mage::register('chat_order_id', $orderId);
            $this->_baseTitle();
            $this->_title($this->__('Create new order tickets for order #%s', $order->getIncrementId()));
            $this->_initAction();
            $this->renderLayout();
            
        } catch (Mage_Core_Exception $e) {
            $message = $this->__("Error while creating new order tickets: %s", $e->getMessage());       
            $session->addError($message);
            $this->_redirect('*/adminhtml_chat');
        }
    }
    
    /**
     * Processing data to save
     */
    public function saveAction(){
        $session = $this->_getSession();
        
        try {
            $request = $this->getRequest();
            $postData = $request->getPost();
            if (!$postData) {
                $exceptionMsg = $this->__('There is no data to save.');
                throw new Mage_Core_Exception($exceptionMsg);
            }
            
            $chatData = $request->getParam('chat');
            $ticketData = $request->getParam('ticket');
            
            $orderId = (isset($chatData['order_id']) ? $chatData['order_id'] : null);
            $this->_checkOrderId($orderId);
            
            $chat = Mage::getModel('ordertickets/chat');
            /* @var $chat Laurent_OrderTickets_Model_Chat */
            $chat->setData($chatData);
            $chat->save();
            
            $ticketData['chat_id'] = $chat->getId();
            $ticket = Mage::getModel('ordertickets/ticket');
            /* @var $ticket Laurent_OrderTickets_Model_Ticket */
            $ticket->setData($ticketData);
            $ticket->save();
            
            $successMessage = $this->__('Ticket has been correctly saved.');
            $session->addSuccess($successMessage);
            $this->_redirect('*/adminhtml_chat');
            return false;
            
        } catch (Mage_Core_Exception $e) {
            $errorMesage = $this->__("Error while creating new order tickets: %s", $e->getMessage());
            $session->addError($errorMesage);
            $this->_redirect('*/adminhtml_chat');
        }
    }
    
    /**
     * Check if order id is correct and correspond to an order
     * @param int $orderId
     * @return boolean true if it is ok
     * @throws Mage_Core_Exception If order id is incorrect
     */
    protected function _checkOrderId($orderId) {
        if (!$orderId) {
            $message = $this->__('No order selected for creating new order tickets.');
            throw new Mage_Core_Exception($message);
        }


        //Checking if order exists
        $order = Mage::getModel('sales/order');
        /* @var $order Mage_Sales_Model_Order */
        $order->load($orderId);
        if (!$order->getId()) {
            $message = $this->__('Order not found.');
            throw new Mage_Core_Exception($message);
        }
        
        return true;
    }

}

?>
