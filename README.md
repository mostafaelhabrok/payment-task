
# About Task
This task is for testing payment gateway Stripe and get response from.
Also this project store transaction data in database and view history of transactions.

## How to init the project

### first download the code or  clone the project using git


### Open terminal and execute the following: 

#### To install dependencies:

```
composer install 
```

#### To add .env file:

```
composer run-script 'post-root-package-install'
```

### Add database parameters in .env file for examble: 

```
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=payment
DB_USERNAME=root
DB_PASSWORD=root 
```

### Add secret_key and publishable_key (for stripe api to work) in .env file for examble use these test keys:

```
publishable_key="pk_test_51OJzAfIf86mnZ8kEK7V7ifKWJqdQUCu55QUwrmogS5rHUAWWQo7mIMGq2bGYHuTZ2JcWjWmguFjSz2kJwwviCQl400mgCe9dZU"
secret_key="sk_test_51OJzAfIf86mnZ8kE3cDImugwYxHCGG2XY3dKiQ3YADhSJNPe02Yebdcz6kyt7aeOhqIl6YgZWP2yihBpgxY8v8fU00xz317FFa"
```


### To run migrations execute command:

```
php artisan migrate
```


### To generate app key execute command:

```
php artisan key:generate
```


### To start the project execute command:

```
php artisan serve
```


### Now the project is running on localhost:8000 <a target="_blank" href="http://127.0.0.1:8000">Open Here</a>


### Stripe provide some card numbers to test as follows:

#### For Success:

```
Card Number: 4242 4242 4242 4242
```


#### For Card Declined (Insufficient Funds):

```
Card Number: 4000 0000 0000 9995
```


#### For Card Declined (Incorrect CVC):

```
Card Number: 4000 0000 0000 0127
```


#### For Card Declined (Expired Card):

```
Card Number: 4000 0000 0000 0069
```


#### For Card Declined (Processing Error):

```
Card Number: 4000 0000 0000 0119
```


#### For all cards use:
##### Expiry Date: Any future date
##### CVV: Any 3 digits 