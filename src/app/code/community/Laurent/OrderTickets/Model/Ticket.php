<?php

/*
 * @category   Laurent
 * @package    Laurent_OrderTickets
 * @copyright  Copyright (c) 2011 Laurent Clouet
 * @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 * @author     Laurent Clouet <laurent35240@gmail.com>
 */

/**
 * @method string getType()
 * @method string getCreatedAt()
 * @method string getMessage()
 * @method int getChatId()
 * @method Laurent_OrderTickets_Model_Ticket setReportedByCron($reportedByCron)
 *
 */
class Laurent_OrderTickets_Model_Ticket extends Laurent_OrderTickets_Model_Abstract {
    CONST TYPE_REQUEST = 'request';
    CONST TYPE_ANSWER = 'answer';

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'ortickets_ticket';

    /**
     * Initialize resource model
     */
    protected function _construct()
    {
        $this->_init('ordertickets/ticket');
    }
    
    /**
     * Return the created at in formated date
     * @return string
     */
    public function getCreatedAtFormated(){
        /** @var $coreHelper Mage_Core_Helper_Data */
        $coreHelper = Mage::helper('core');
        return $coreHelper->formatDate($this->getCreatedAt(), 'medium', true);
    }
    
    /**
     * Tell if the ticket has request type
     * @return boolean
     */
    public function isRequest(){
        return ($this->getType() == self::TYPE_REQUEST);
    }
    
    /**
     * Get chat of the ticket
     * @return Laurent_OrderTickets_Model_Chat
     */
    public function getChat(){
        if(!$this->hasData('chat')){
            $this->setData('chat', Mage::getModel('ordertickets/chat')->load($this->getChatId()));
        }
        
        return $this->getData('chat');
    }

    /**
     * Reopen chat if a new request was sent
     * @return Laurent_OrderTickets_Model_Ticket
     */
    public function _afterSave(){
        parent::_afterSave();
        $chat = $this->getChat();
        //Putting back open status if a new request was made
        if(
            $this->getType() == self::TYPE_REQUEST
            && $chat->getStatus() == Laurent_OrderTickets_Model_Chat::STATUS_CLOSED
        )
        {
            $chat->setStatus(Laurent_OrderTickets_Model_Chat::STATUS_OPEN);
            $chat->save();
        }
        return $this;
    }
    
}
