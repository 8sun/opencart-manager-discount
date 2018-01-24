Opencart Manager Discount
========

>*author* Simon Brân

>*version* 1.1 Stable

>*package* opencart_1.5.x_statuses


License
-------
Copyright (c) 2016, 8sun Empire

[The MIT License (MIT)](https://opensource.org/licenses/mit-license.php)

Description
-----------

The package is intended for a work of customers and the managers with statuses of an  order. The package was developed 8 sun Empire Studio and includes additional extension with which a manager can assign discounts to users. 

>Note: For the correct work it is necessary to set the ids (status) of orders in the file: `a_order_update.xml`

```
public $status = array(
    'Closed' => '15',
    'Canceled' => '7',
    'Pending' => '1',
    'Processing' => '2',
);
```

Where the key is the description of the status and the value is *order_status_id*
