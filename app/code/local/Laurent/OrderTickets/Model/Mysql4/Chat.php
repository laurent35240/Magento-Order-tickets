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
class Laurent_OrderTickets_Model_Mysql4_Chat extends Mage_Core_Model_Mysql4_Abstract{
    
    protected function _construct()
    {
        $this->_init('ordertickets/chat', 'id');
    }
    
}

?>
