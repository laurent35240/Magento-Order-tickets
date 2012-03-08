<?php

/*
 * @category   Laurent
 * @package    Laurent_OrderTickets
 * @copyright  Copyright (c) 2012 Laurent Clouet
 * @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 * @author     Laurent Clouet <laurent35240@gmail.com>
 */

/**
 * Description of Grid
 *
 */
class Laurent_OrderTickets_Block_Adminhtml_Chat_Create_Order_Grid extends Mage_Adminhtml_Block_Widget_Grid {
    
    public function __construct()
    {
        parent::__construct();
        $this->setId('ordertickets_chat_create_order_grid');
        $this->setUseAjax(true);
        $this->setDefaultSort('entity_id');
    }
    
    /**
     * Preparing colllectio of orders
     * @return Laurent_OrderTickets_Block_Adminhtml_Chat_Create_Order_Grid
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getResourceModel('sales/order_grid_collection');
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }
    
    /**
     * Columns of order Grid
     * @return Laurent_OrderTickets_Block_Adminhtml_Chat_Create_Order_Grid
     */
    protected function _prepareColumns()
    {

        $this->addColumn('real_order_id', array(
            'header'=> Mage::helper('sales')->__('Order #'),
            'width' => '80px',
            'type'  => 'text',
            'index' => 'increment_id',
        ));

        if (!Mage::app()->isSingleStoreMode()) {
            $this->addColumn('store_id', array(
                'header'    => Mage::helper('sales')->__('Purchased From (Store)'),
                'index'     => 'store_id',
                'type'      => 'store',
                'store_view'=> true,
                'display_deleted' => true,
            ));
        }

        $this->addColumn('created_at', array(
            'header' => Mage::helper('sales')->__('Purchased On'),
            'index' => 'created_at',
            'type' => 'datetime',
            'width' => '100px',
        ));

        $this->addColumn('billing_name', array(
            'header' => Mage::helper('sales')->__('Bill to Name'),
            'index' => 'billing_name',
        ));

        $this->addColumn('shipping_name', array(
            'header' => Mage::helper('sales')->__('Ship to Name'),
            'index' => 'shipping_name',
        ));

        $this->addColumn('base_grand_total', array(
            'header' => Mage::helper('sales')->__('G.T. (Base)'),
            'index' => 'base_grand_total',
            'type'  => 'currency',
            'currency' => 'base_currency_code',
        ));

        $this->addColumn('grand_total', array(
            'header' => Mage::helper('sales')->__('G.T. (Purchased)'),
            'index' => 'grand_total',
            'type'  => 'currency',
            'currency' => 'order_currency_code',
        ));

        $this->addColumn('status', array(
            'header' => Mage::helper('sales')->__('Status'),
            'index' => 'status',
            'type'  => 'options',
            'width' => '70px',
            'options' => Mage::getSingleton('sales/order_config')->getStatuses(),
        ));
        
        return parent::_prepareColumns();
    }
    
    /**
     * Url of Grid for reloading it with Ajax
     * @return string
     */
    public function getGridUrl()
    {
        return $this->getUrl('*/*/loadOrderGrid');
    }
    
    /**
     * Url when clicking on a row
     * @param Mage_Sales_Model8order $order order of the row
     * @return string
     */
    public function getRowUrl($order){
        return $this->getUrl('*/*/stepTwo', array('order_id' => $order->getId()));
    }
}
