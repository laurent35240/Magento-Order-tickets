<?php

/*
 * @category   Laurent
 * @package    Laurent_OrderTickets
 * @copyright  Copyright (c) 2012 Laurent Clouet
 * @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 * @author     Laurent Clouet <laurent35240@gmail.com>
 */

/**
 * Description of Order
 *
 */
class Laurent_OrderTickets_Block_Adminhtml_Chat_Create_Order extends Mage_Adminhtml_Block_Widget{
    
    /**
     * Header text for order grid
     * @return string
     */
    public function getHeaderText(){
        return $this->__('Please select an order');
    }
    
}
