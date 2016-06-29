Opencart Manager Discount
========

>*author* Simon Bran

>*version* 1.0 Stable

>*package* opencart_1.5.x_statuses


License
-------
Copyright (c) 2016, 8sun Empire

[The MIT License (MIT)](https://opensource.org/licenses/mit-license.php)

Description
-----------

The given package is intended for work of the customer and the manager with statuses of the order. 
The package is developed 8 sun Empire Studio 
and includes additional extension about purpose of the discount by the manager.

>Note: For correct work it is necessary to set the id statuses of orders in the file: `a_order_update.xml`

```
public $status = array(
    'Closed' => '15',
    'Canceled' => '7',
    'Pending' => '1',
    'Processing' => '2',
);
```

Where a key is description of the status and a value is *order_status_id*