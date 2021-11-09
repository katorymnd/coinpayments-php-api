**Katorymnd coinpayments  api**

The payment API for cryptocurrency at https://www.coinpayments.net/

This program will help you accept and create transactions, verify payments and also create a payment address.

You will be able to accept cryptocurrency on your website.

**Please follow these steps** 

After you download you need to update the program to suit your preferences.s

Open **coin_config.php** file

*add your keys.*

Open **coin_address.php** file

```PHP
/**
 * LTCT is the test coin 
 * 
 * here you can update to any coin you desire and on load in url address you will get a payment address for your coin
 * 
 * Save the address using session or database. To call it later
 * 
 */
$payment_address->get_address('LTCT');// BTC

// 3Qpxu5A5yHmARyX8kaw66NtHGteubWd7VF    // BTC address
```


Open **coin_transaction.php** file

Add your transaction details

*call your saved coin address here abd save*

Then load the page url address to intiate the process.

Save your details in db or using session

Open **coin_transaction_status.php** file

This file will verify if your payment is completed

Load this page after 24hrs. if every thing is okay, activate your members for any sevice payed.

```PHP 
$katorymnd_mudi->check_payment_status("tansaction id here"); // got from session or db

```

This **coin_transaction_status.php** page will load all your accepted coins from your https://www.coinpayments.net/ account


For any assiance please contact me at https://katorymnd.com/
