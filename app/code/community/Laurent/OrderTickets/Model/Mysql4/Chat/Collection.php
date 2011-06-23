<?php

/*
 * @category   Laurent
 * @package    Laurent_OrderTickets
 * @copyright  Copyright (c) 2011 Laurent Clouet
 * @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 * @author     Laurent Clouet <laurent35240@gmail.com>
 */

/**
 * Description of Collection
 *
 */
class Laurent_OrderTickets_Model_Mysql4_Chat_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract {
    
    protected function _construct()
    {
        $this->_init('ordertickets/chat');
    }
    
   /**
     * Join Order table
     *
     * @return Laurent_OrderTickets_Model_Mysql4_Chat_Collection
     */
    public function joinOrderTable()
    {
        $this->_select->joinLeft(
            array('order_table' => $this->getTable('sales/order')),
            'main_table.order_id=order_table.entity_id',
            array('entity_id', 'increment_id')
        );
        return $this;
    }
}

?>
