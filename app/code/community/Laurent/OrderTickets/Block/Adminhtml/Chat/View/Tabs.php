<?php

/*
 * @category   Laurent
 * @package    Laurent_OrderTickets
 * @copyright  Copyright (c) 2011 Laurent Clouet
 * @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 * @author     Laurent Clouet <laurent35240@gmail.com>
 */

/**
 * Description of Tabs
 *
 */
class Laurent_OrderTickets_Block_Adminhtml_Chat_View_Tabs extends Mage_Adminhtml_Block_Widget_Tabs{
    
    public function __construct()
    {
        parent::__construct();
        $this->setId('chat_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle($this->__('Chat Information'));
    }
    
    protected function _beforeToHtml()
    {
        $this->addTab('main_section', array(
            'label'     => $this->__('Details'),
            'title'     => $this->__('Details'),
            'content'   => $this->getLayout()->createBlock('ordertickets/adminhtml_chat_view_tab_main')->toHtml(),
            'active'    => true
        ));
        
        $this->addTab('tickets', array(
            'label'     => $this->__('Tickets'),
            'title'     => $this->__('Tickets'),
            'content'   => $this->getLayout()->createBlock('ordertickets/adminhtml_chat_view_tab_tickets')->toHtml(),
        ));
        
        return parent::_beforeToHtml();
    }
}

?>
