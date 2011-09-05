Order Tickets, a Magento extension
==================================

This Magento extension add a system of tickets into orders.
It helps then to improve communication between customers and after-sale service.

## Features
 * Customers can add message to their orders
 * Administrators can reply to these message in BO
 * Administrators can change status of a chat
 * Different message can be seen in BO in a global grid, into orders and into
    customer account
 * Email notification send to administrator about new tickets posted by customers

## Installation
1. Install extension through Magento downloader or with pear. Extension can be 
found on [Magento Connect Order Tickets page][1].
2. If you use Magento CE 1.3, move design and skin files from base to default
package
3. Refresh Cache
4. For receiving automatically email about new tickets set correct email 
recipients in BO System > Configuration > Sales > Orders tickets
5. You can also change frequency for receiving this emails by changing cron
expression at the same place.
By default emails are send every day at 2:42 and 14:42  
[More about cron expression][2]

## Compatibiity
This extension is compatible with:

 * Magento CE 1.3, 1.4, 1.5 and 1.6
 * Magento PE 1.8, 1.9, 1.10 and 1.11
 * Magento EE 1.8, 1.9, 1.10 and 1.11

## Bug Reports
If you find a bug, [you can create a ticket][3].

## More informations
Check [Magento Connect Order Tickets page][1] for more details.

## License
Order tickets extension is licensed under AFL 3.0 license.

[1]: http://www.magentocommerce.com/magento-connect/laurent35240/extension/7107/order_tickets
[2]: http://en.wikipedia.org/wiki/Cron#CRON_expression
[3]: https://github.com/laurent35240/Magento-Order-tickets/issues