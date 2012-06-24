<?php

/*
 * @category   Laurent
 * @package    Laurent_OrderTickets
 * @copyright  Copyright (c) 2011 Laurent Clouet
 * @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 * @author     Laurent Clouet <laurent35240@gmail.com>
 */

/**
 * Class used by cron
 *
 */
class Laurent_OrderTickets_Model_Observer {
    
    /**
     * Task that send by email all last request tickets
     * Email recipients are defined in BO configuration
     * return boolean telling if everything went fine
     */
    public function sendEmailLastRequests(){        
        try{
            /* @var $tickets Laurent_OrderTickets_Model_Mysql4_Ticket_Collection */
            $tickets = Mage::getResourceModel('ordertickets/ticket_collection')
                    ->addFieldToFilter('type', Laurent_OrderTickets_Model_Ticket::TYPE_REQUEST)
                    ->addFieldToFilter('reported_by_cron', false)
                    ->load();

            //Email send only if there is new request
            if($tickets->count() > 0){
                $email = new Zend_Mail('utf-8');
                $email->setFrom(Mage::getStoreConfig('trans_email/ident_general/email'), Mage::getStoreConfig('trans_email/ident_general/name'));

                $recipients = explode(',', Mage::getStoreConfig('sales/ordertickets/cron_recipients'));

                foreach($recipients as $recipient){
                    $email->addTo($recipient);
                }

                $subject = 'Last messages send by customers';

                $body = '';
                foreach($tickets as $ticket){
                    $customerFullname = $ticket->getChat()->getCustomerFirstname() . ' '. $ticket->getChat()->getCustomerLastname() . ' <' . $ticket->getChat()->getCustomerEmail() . '>';
                    $body .= 'Message from '. $customerFullname .' send the ' . Mage::helper('core')->formatDate($ticket->getCreatedAt(), 'full', ' ') ."\n";
                    $body .= 'Order ' . $ticket->getChat()->getOrder()->getIncrementId() . "\n";
                    $body .= $ticket->getMessage() . "\n";
                    $body .= "\n";
                    $body .= "\n";
                }

                $email->setSubject($subject);
                $email->setBodyText($body);
                $email->send();

                //Setting all tickets as send to the cron
                foreach($tickets as $ticket){
                    $ticket->setReportedByCron(true);
                    $ticket->save();
                }
            }
        }
        catch(Exception $e){
            Mage::log('Error while sending last request by email ' . $e->getMessage());
            return false;
        }
        return true;
    }    
}
