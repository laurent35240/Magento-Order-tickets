<?php

/*
 * @category   Laurent
 * @package    Laurent_OrderTickets
 * @copyright  Copyright (c) 2011 Laurent Clouet
 * @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 * @author     Laurent Clouet <laurent35240@gmail.com>
 */

/**
 * Description of Grid
 *
 */
class Laurent_OrderTickets_Block_Adminhtml_Chat_Grid extends Mage_Adminhtml_Block_Widget_Grid {
    
    public function __construct()
    {
        parent::__construct();
        $this->setSaveParametersInSession(true);
        $this->setDefaultSort('id');
        $this->setDefaultDir('desc');
    }
    
    protected function _prepareCollection()
    {
        $chatCollection = Mage::getResourceModel('ordertickets/chat_collection')
                ->joinOrderTable();

        $this->setCollection($chatCollection);
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
        
        $this->addColumn('customer_firstname', array(
            'header'        => $this->__('Firstname'),
            'align'         =>'left',
            'index'         => 'customer_firstname',
        ));
        
        $this->addColumn('customer_lastname', array(
            'header'        => $this->__('Lastname'),
            'align'         =>'left',
            'index'         => 'customer_lastname',
        ));
        
        $this->addColumn('customer_email', array(
            'header'        => $this->__('Email'),
            'align'         =>'left',
            'index'         => 'customer_email',
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
            'filter_index'  => 'main_table.status',
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
        return $this->getUrl('*/*/view', array('chat_id' => $row->getId()));   
    }
}

?>
