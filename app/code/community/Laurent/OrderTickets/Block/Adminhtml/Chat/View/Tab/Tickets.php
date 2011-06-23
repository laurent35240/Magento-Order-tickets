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
class Laurent_OrderTickets_Block_Adminhtml_Chat_View_Tab_Tickets extends Mage_Adminhtml_Block_Widget {
    
    public function __construct() {
        parent::__construct();
        $this->setTemplate('ordertickets/chat/view/tab/tickets.phtml');
    }
    
    /**
     * Give collection of tickets for currenty seen chat
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
        return Mage::getUrl('*/*/answerPost');
    }
}

?>
