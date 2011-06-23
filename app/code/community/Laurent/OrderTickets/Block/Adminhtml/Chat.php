<?php

/*
 * @category   Laurent
 * @package    Laurent_OrderTickets
 * @copyright  Copyright (c) 2011 Laurent Clouet
 * @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 * @author     Laurent Clouet <laurent35240@gmail.com>
 */

/**
 * Description of Chat
 *
 */
class Laurent_OrderTickets_Block_Adminhtml_Chat extends Mage_Adminhtml_Block_Widget_Grid_Container {
    /**
     * Block constructor
     */
    public function __construct()
    {
        $this->_controller = 'adminhtml_chat';
        $this->_headerText = $this->__('Order tickets');
        $this->_blockGroup = 'ordertickets';
        parent::__construct();
        $this->_removeButton('add');
    }
}

?>
