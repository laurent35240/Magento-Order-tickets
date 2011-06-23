<?php

/*
 * @category   Laurent
 * @package    Laurent_OrderTickets
 * @copyright  Copyright (c) 2011 Laurent Clouet
 * @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 * @author     Laurent Clouet <laurent35240@gmail.com>
 */

/**
 * Description of Abstarct
 *
 */
abstract class Laurent_OrderTickets_Model_Abstract extends Mage_Core_Model_Abstract {
    
    /**
     * Set created_at and updated_at vaues
     * @return Laurent_OrderTickets_Model_Abstract 
     */
    protected function _beforeSave() {
        parent::_beforeSave();
        
        if(!$this->getId()){
            $this->setCreatedAt(now());
        }
        
        $this->setUpdatedAt(now());
        
        return $this;
    }
}

?>
