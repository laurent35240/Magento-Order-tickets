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

    protected $_destElementId = 'edit_form';
    
    /**
     * Tabs id
     * @return string 
     */
    public function getId() {
        return 'chat_tabs';
    }
    
    /**
     * Tabs title
     * @return string
     */
    public function getTitle(){
        return $this->__('Chat Information');
    }
}
