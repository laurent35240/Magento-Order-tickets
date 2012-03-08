<?php

/*
 * @category   Laurent
 * @package    Laurent_OrderTickets
 * @copyright  Copyright (c) 2011 Laurent Clouet
 * @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 * @author     Laurent Clouet <laurent35240@gmail.com>
 */

$installer = $this;

$installer->startSetup();

$installer->run("
   -- DROP TABLE IF EXISTS {$this->getTable('ordertickets_chat')};
        
   CREATE TABLE `{$this->getTable('ordertickets_chat')}` (
  `id` INT(10) unsigned NOT NULL auto_increment,
   `order_id` INT(10) unsigned NOT NULL,
   `status` VARCHAR(255) NOT NULL,
   `customer_firstname` VARCHAR(255) NULL,
   `customer_lastname` VARCHAR(255) NULL,
   `customer_email` VARCHAR(255) NULL,
  `created_at` datetime NOT NULL default '0000-00-00 00:00:00',
   `updated_at` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`),
  KEY `FK_ordertickets_chat_order` (`order_id`),
  CONSTRAINT `FK_ordertickets_chat_order` FOREIGN KEY (`order_id`) REFERENCES {$this->getTable('sales/order')} (`entity_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8; 

   
  -- DROP TABLE IF EXISTS {$this->getTable('ordertickets_ticket')};
  
  CREATE TABLE `{$this->getTable('ordertickets_ticket')}` (
  `id` INT(10) unsigned NOT NULL auto_increment,
   `chat_id` INT(10) unsigned NOT NULL,
   `message` TEXT NOT NULL,
   `type` VARCHAR(255) NOT NULL,
   `reported_by_cron` TINYINT(1) unsigned NOT NULL default '0',
  `created_at` datetime NOT NULL default '0000-00-00 00:00:00',
   `updated_at` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`),
  KEY `FK_ordertickets_ticket_chat` (`chat_id`),
  CONSTRAINT `FK_ordertickets_ticket_chat` FOREIGN KEY (`chat_id`) REFERENCES {$this->getTable('ordertickets_chat')} (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8; 
");

$installer->endSetup();
