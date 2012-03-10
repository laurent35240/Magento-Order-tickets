<?php

/*
 * @category   Laurent
 * @package    Laurent_OrderTickets
 * @copyright  Copyright (c) 2012 Laurent Clouet
 * @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 * @author     Laurent Clouet <laurent35240@gmail.com>
 */

/**
 * Description of Chat
 *
 */
class Laurent_OrderTickets_Controller_Adminhtml_Chat extends Mage_Adminhtml_Controller_Action {

    /**
     * Initialize action
     *
     * @return Mage_Adminhtml_Controller_Action
     */
    protected function _initAction() {
        $this->loadLayout()
                ->_setActiveMenu('sales/ordertickets')
                ->_addBreadcrumb($this->__('Sales'), $this->__('Sales'))
                ->_addBreadcrumb($this->__('Order tickets'), $this->__('Order tickets'));
        return $this;
    }

    /**
     * Set base title for order tickets actions 
     */
    protected function _baseTitle() {
        $this->_title($this->__('Sales'))->_title($this->__('Order tickets'));
    }

}
