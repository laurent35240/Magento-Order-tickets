<?php

/*
 * @category   Laurent
 * @package    Laurent_OrderTickets
 * @copyright  Copyright (c) 2011 Laurent Clouet
 * @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 * @author     Laurent Clouet <laurent35240@gmail.com>
 */

/**
 * Description of Main
 *
 */
class Laurent_OrderTickets_Block_Adminhtml_Chat_View_Tab_Main 
extends Mage_Adminhtml_Block_Widget_Form
implements Mage_Adminhtml_Block_Widget_Tab_Interface {
    
    protected function _prepareForm()
    {
        $chat = Mage::registry('ordertickets_chat');

        $form = new Varien_Data_Form();

        $form->setHtmlIdPrefix('chat_');

        $fieldset = $form->addFieldset('base_fieldset', array('legend'=>$this->__('General Information'),'class'=>'fieldset-wide'));

        $fieldset->addField('id', 'hidden', array(
            'name'  => 'id',
            'value' => $chat->getId(),
        ));
        
        $fieldset->addField('order_increment_id', 'label', array(
            'label'     => $this->__('Order'),
            'name'      => 'order_increment_id',
            'value'     => $chat->getOrder()->getIncrementId(),
        ));
        
        $fieldset->addField('customer_firstname', 'label', array(
            'label'     => $this->__('Customer firstname'),
            'name'      => 'customer_firstname',
            'value'     => $chat->getCustomerFirstname(),
        ));
        
        $fieldset->addField('customer_lastname', 'label', array(
            'label'     => $this->__('Customer lastname'),
            'name'      => 'customer_lastname',
            'value'     => $chat->getCustomerLastname(),
        ));
        
        $fieldset->addField('customer_email', 'label', array(
            'label'     => $this->__('Customer email'),
            'name'      => 'customer_lastname',
            'value'     => $chat->getCustomerEmail(),
        ));
        
        $fieldset->addField('created_at', 'label', array(
            'label'     => $this->__('Created at'),
            'name'      => 'created_at',
            'value'     => Mage::helper('core')->formatDate($chat->getCreatedAt(), 'full', true),
        ));
        
        $fieldset->addField('last_answer_date', 'label', array(
            'label'     => $this->__('Last answer date'),
            'name'      => 'last_answer_date',
            'value'     => Mage::helper('core')->formatDate($chat->getLastAnswerDate(), 'full', true),
        ));

    	$fieldset->addField('status', 'select', array(
            'name'      => 'status',
            'label'     => $this->__('Status'),
            'title'     => $this->__('Status'),
            'required'  => true,
            'options'   => Mage::helper('ordertickets')->getChatStatuses(),
            'value'     => $chat->getStatus(),
        ));

        $this->setForm($form);

        return parent::_prepareForm();
    }

    /**
     * Can sho tab?
     * @return boolean 
     */
    public function canShowTab() {
       return true; 
    }

    /**
     * Tab label
     * @return string
     */
    public function getTabLabel() {
        return $this->__('Details');
    }

    /**
     * Tab title
     * @return string
     */
    public function getTabTitle() {
        return $this->__('Details');
    }

    /**
     * Tab is hidden?
     * @return boolean 
     */
    public function isHidden() {
        return false;
    }
    
}

?>
