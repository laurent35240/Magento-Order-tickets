<?php

/*
 * @category   Laurent
 * @package    Laurent_OrderTickets
 * @copyright  Copyright (c) 2012 Laurent Clouet
 * @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 * @author     Laurent Clouet <laurent35240@gmail.com>
 */

/**
 * Description of Form
 *
 */
class Laurent_OrderTickets_Block_Adminhtml_Chat_Create_Steptwo_Form extends Mage_Adminhtml_Block_Widget_Form {

    protected function _prepareForm() {
        $helper = Mage::helper('ordertickets');
        /* @var $helper Laurent_OrderTickets_Helper_Data */
        $order = $this->getOrder();
        
        $form = new Varien_Data_Form(array(
            'id'        => 'edit_form',
            'action'    => $this->getUrl('*/*/save'),
            'method'    => 'post',
        ));

        $fieldset = $form->addFieldset('create_steptwo_form_fildset', array(
            'legend' => $this->__('Order tickets details'),
        ));

        $fieldset->addField('customer_firstname', 'text', array(
            'label'     => $this->__('Customer firstname'),
            'name'      => 'chat[customer_firstname]',
            'required'  => true,
            'value'     => $order->getCustomerFirstname(),
        ));
        
        $fieldset->addField('customer_lastname', 'text', array(
            'label'     => $this->__('Customer lastname'),
            'name'      => 'chat[customer_lastname]',
            'required'  => true,
            'value'     => $order->getCustomerLastname(),
        ));
        
        $fieldset->addField('customer_email', 'text', array(
            'label'     => $this->__('Customer email'),
            'name'      => 'chat[customer_email]',
            'required'  => true,
            'class'     => 'validate-email',
            'value'     => $order->getCustomerEmail(),
        ));
        
        $fieldset->addField('status', 'select', array(
            'label'     => $this->__('Status'),
            'name'      => 'chat[status]',
            'required'  => true,
            'options'   => $helper->getChatStatuses(),
            'value'     => Laurent_OrderTickets_Model_Chat::STATUS_OPEN,
        ));
        
        $fieldset->addField('ticket_type', 'select', array(
            'label'     => $this->__('Ticket type'),
            'name'      => 'ticket[type]',
            'required'  => true,
            'options'   => $helper->getTicketTypes(),
            'value'     => Laurent_OrderTickets_Model_Ticket::TYPE_REQUEST,
        ));
        
        $fieldset->addField('ticket_message', 'textarea', array(
            'label'     => $this->__('Message'),
            'name'      => 'ticket[message]',
            'required'  => true,
        ));
        
        $fieldset->addField('order_id', 'hidden', array(
            'name'      => 'chat[order_id]',
            'required'  => true,
            'value'     => $order->getId(),
        ));
        
        $form->setUseContainer(true);
        
        $this->setForm($form);

        return parent::_prepareForm();
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
