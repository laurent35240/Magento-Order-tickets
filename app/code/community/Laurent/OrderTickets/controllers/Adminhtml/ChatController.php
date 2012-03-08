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
class Laurent_OrderTickets_Adminhtml_ChatController extends Laurent_OrderTickets_Controller_Adminhtml_Chat {
    
    public function indexAction(){
        $this->_baseTitle();        
        $this->_initAction();
        $this->renderLayout();
    }
    
    /**
     * Viewing an order chat
     */
    public function viewAction(){
        $chatId = $this->getRequest()->getParam('chat_id');
        
        $chat = Mage::getModel('ordertickets/chat')->load($chatId);
        /* @var $chat Laurent_OrderTickets_Model_Chat */
        
        if($chat->getId()){
            Mage::register('ordertickets_chat', $chat);
            
            $this->_baseTitle();
            $this->_title($this->__('Tickets for order %s', $chat->getOrder()->getIncrementId()));
            $this->_initAction();
            $this->renderLayout();
        }
        else{
            Mage::getSingleton('core/session')->addError($this->__('This chat does not exist'));
            $this->_redirect('*/*/index');
        }
        
    }
    
    /**
     * Save Chat
     *
     * @return bool
     */
    public function saveAction()
    {
        if ($chatPost = $this->getRequest()->getPost()) {
            $chatModel = Mage::getModel('ordertickets/chat')->setData($chatPost);

            try {
                $chatModel->save();

                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Chat was succesfully saved'));
                $this->getResponse()->setRedirect($this->getUrl("*/*/"));
                return true;
            }
            catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }

            $this->_redirectReferer();
        }
    }
    
    /**
     * Action for saving an answer ticket
     */
    public function answerPostAction(){
        if($answerPost = $this->getRequest()->getPost('answer')){
            
            if(isset($answerPost['chat_id'])){
                $transaction = Mage::getModel('core/resource_transaction');
                
                $chat = Mage::getModel('ordertickets/chat');
                $chat->setId($answerPost['chat_id']);
                $chat->setStatus($answerPost['status']);
                $chat->setLastAnswerDate(now());
                
                $transaction->addObject($chat);
                
                if(isset($answerPost['message']) && $answerPost['message']){
                    $ticket = Mage::getModel('ordertickets/ticket');
                    $ticket->setChatId($answerPost['chat_id']);
                    $ticket->setMessage($answerPost['message']);
                    $ticket->setType(Laurent_OrderTickets_Model_Ticket::TYPE_ANSWER);

                    $transaction->addObject($ticket);
                }
                
                try{
                    $transaction->save();
                    
                    Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Answer successfully added'));
                    $this->getResponse()->setRedirect($this->getUrl("*/*/"));
                    return true;
                }
                catch(Exception $e){
                    Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                }
                
                $this->_redirectReferer();
            }
        }
    }
    
    public function customerchatsAction(){
        $customerId = (int) $this->getRequest()->getParam('id');
        $customer = Mage::getModel('customer/customer');

        if ($customerId) {
            $customer->load($customerId);
        }

        Mage::register('current_customer', $customer);
        
        $this->getResponse()->setBody($this->getLayout()->createBlock('ordertickets/adminhtml_customer_edit_tab_tickets')->toHtml());
    }
}
