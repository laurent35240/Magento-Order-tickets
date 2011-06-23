<?php

/*
 * @category   Laurent
 * @package    Laurent_OrderTickets
 * @copyright  Copyright (c) 2011 Laurent Clouet
 * @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 * @author     Laurent Clouet <laurent35240@gmail.com>
 */

/**
 * Description of Cron
 *
 */
class Laurent_OrderTickets_Model_Config_Cron extends Mage_Core_Model_Config_Data
{

    const CRON_STRING_PATH = 'crontab/jobs/send_mail_ordertickets/schedule/cron_expr';
    const CRON_MODEL_PATH = 'crontab/jobs/send_mail_ordertickets/run/model';

    protected function _afterSave()
    {
        //Fetch the cron expression from the backoffice config and save it to cron config
        $cronExprString = $this->getData('groups/ordertickets/fields/cron_expr');

        try {
                Mage::getModel('core/config_data')
                    ->load(self::CRON_STRING_PATH, 'path')
                    ->setValue($cronExprString)
                    ->setPath(self::CRON_STRING_PATH)
                    ->save();
                Mage::getModel('core/config_data')
                    ->load(self::CRON_MODEL_PATH, 'path')
                    ->setValue((string) Mage::getConfig()->getNode(self::CRON_MODEL_PATH))
                    ->setPath(self::CRON_MODEL_PATH)
                    ->save();

            } catch (Exception $e) {
                throw new Exception(Mage::helper('cron')->__('Unable to save Cron expression'));
            }
    }
}

?>
