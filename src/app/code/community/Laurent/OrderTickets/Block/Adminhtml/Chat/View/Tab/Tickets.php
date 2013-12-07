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
class Laurent_OrderTickets_Block_Adminhtml_Chat_View_Tab_Tickets 
extends Mage_Adminhtml_Block_Template
implements Mage_Adminhtml_Block_Widget_Tab_Interface {
    
    /**
     * Give collection of tickets for currently seen chat
     * @return Mage_Adminhtml_Block_Widget
     */
    public function getTickets(){
        return $this->getChat()->getTickets();
    }
    
    /**
     * Give currently seen chat
     * @return Laurent_OrderTickets_Model_Chat
     */
    public function getChat(){
        return Mage::registry('ordertickets_chat');
    }
    
    public function getPostAnswerUrl(){
        return $this->getUrl('*/*/answerPost');
    }

    /**
     * Can show tab?
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
        return $this->__('Tickets');
    }

    /**
     * Tab title
     * @return string 
     */
    public function getTabTitle() {
        return $this->__('Tickets');
    }

    /**
     * Tab is hidden?
     * @return boolean 
     */
    public function isHidden() {
        return false;
    }
}
