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
            if (!$orderId) {
                $message = $this->__('No order selected for creating new order tickets.');
                throw new Mage_Core_Exception($message);
            }
            
            //Checking if order exists
            $order = Mage::getModel('sales/order');
            /* @var $order Mage_Sales_Model_Order */
            $order->load($orderId);
            if(!$order->getId()){
                $message = $this->__('Order not found.');
                throw new Mage_Core_Exception($message);
            }
            
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
            $postData = $this->getRequest()->getPost();
            if (!$postData) {
                $exceptionMsg = $this->__('There is no data to save.');
                throw new Mage_Core_Exception($exceptionMsg);
            }
        } catch (Mage_Core_Exception $e) {
            $errorMesage = $this->__("Error while creating new order tickets: %s", $e->getMessage());
            $session->addError($errorMesage);
            $this->_redirect('*/adminhtml_chat');
        }
    }

}

?>
