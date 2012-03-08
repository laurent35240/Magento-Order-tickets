<?php

/*
 * @category   Laurent
 * @package    Laurent_OrderTickets
 * @copyright  Copyright (c) 2011 Laurent Clouet
 * @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 * @author     Laurent Clouet <laurent35240@gmail.com>
 */

/**
 * Description of Tickets
 *
 */
class Laurent_OrderTickets_Block_Adminhtml_Order_View_Tab_Tickets
    extends Mage_Adminhtml_Block_Template
    implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
    protected $_chat = null;


    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('ordertickets/order/view/tab/tickets.phtml');
    }
    
    public function getTabLabel() {
        return $this->__('Order tickets');
    }
    
    public function getTabTitle() {
        return $this->__('Order tickets');
    }
    
    public function canShowTab() {
        return true;
    }
    
    public function isHidden() {
        return false;
    }
    
    public function getOrder(){
        return Mage::registry('current_order');
    }
    
    /**
     * Tells if there is an existing chat associated to order seen
     * @return boolean 
     */
    public function hasChat(){
        return !is_null($this->getChat());
    }
    
    /**
     * Get associated chat to an order if it exists
     * @return null|Laurent_OrderTickets_Model_Chat 
     */
    public function getChat(){
        if(!$this->_chat){
            $chat = Mage::helper('ordertickets')->loadChatFromOrderId($this->getOrder()->getId());
            
            if($chat && $chat->getId()){
                $this->_chat = $chat;
            }
        }
        
        return $this->_chat;
    }
    
    /**
     * Get url for viewing chat linked to the order
     * @return string
     */
    public function getChatViewUrl(){
        if(!$this->hasChat()){
            return '';
        }
        
        return $this->getUrl('ordertickets/adminhtml_chat/view', array('chat_id' => $this->getChat()->getId()));
    }
}
