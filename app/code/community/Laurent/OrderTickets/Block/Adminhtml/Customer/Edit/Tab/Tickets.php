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
class Laurent_OrderTickets_Block_Adminhtml_Customer_Edit_Tab_Tickets 
    extends Mage_Adminhtml_Block_Widget_Grid
    implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
    
    public function __construct()
    {
        parent::__construct();
        $this->setId('customer_tickets_grid');
        $this->setDefaultSort('id', 'desc');
        $this->setUseAjax(true);
    }
    
    protected function _prepareCollection()
    {
        $orderIds = Mage::getResourceModel('sales/order_collection')
                ->addAttributeToFilter('customer_id', Mage::registry('current_customer')->getEntityId())
                ->getAllIds();
        
        $collection = Mage::getResourceModel('ordertickets/chat_collection')
                ->addFieldToFilter('order_id', array('in' => $orderIds))
                ->joinOrderTable();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }
    
    protected function _prepareColumns()
    {
        $this->addColumn('id', array(
            'header'        => $this->__('ID'),
            'align'         =>'left',
            'filter_index'  => 'main_table.id',
            'index'         => 'id',
        ));
        
        $this->addColumn('increment_id', array(
            'header'        => $this->__('Order'),
            'align'         =>'left',
            'filter_index'  => 'order_table.increment_id',
            'index'         => 'increment_id',
        ));
        
        $this->addColumn('created_at', array(
            'header'        => $this->__('Message date'),
            'align'         =>'left',
            'type'          => 'datetime',
            'filter_index'  => 'main_table.created_at',
            'index'         => 'created_at',
        ));
        
        $this->addColumn('last_answer_date', array(
            'header'        => $this->__('Last answer date'),
            'align'         =>'left',
            'type'          => 'datetime',
            'index'         => 'last_answer_date',
        ));
        
        $this->addColumn('status', array(
            'header'        => $this->__('Status'),
            'align'         =>'left',
            'index'         => 'status',
            'type'          => 'options',
            'options'       => Mage::helper('ordertickets')->getChatStatuses(),
        ));
        
        $this->addColumn('action',
            array(
                'header'    => $this->__('Action'),
                'type'      => 'action',
                'getter'     => 'getId',
                'actions'   => array(
                    array(
                        'caption' => $this->__('Details'),
                        'url'     => array('base'=>'*/*/view'),
                        'field'   => 'chat_id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'is_system' => true,
        ));

        return parent::_prepareColumns();
    }
    
    public function getRowUrl($row)
    {
        return $this->getUrl('ordertickets/adminhtml_chat/view', array('chat_id' => $row->getId()));   
    }
    
    public function getGridUrl()
    {
        return $this->getUrl('ordertickets/adminhtml_chat/customerchats', array('_current' => true));
    }
    
    public function getTabLabel(){
        return $this->__('Tickets');
    }
    
    public function getTabTitle(){
        return $this->__('Tickets');
    }
    
    public function canShowTab(){
        return true;
    }
    
    public function isHidden(){
        return false;
    }
}

?>
