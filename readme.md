
  

# Demo for oadtz/checkout package

  

A laravel project to implement oadtz/checkout package

https://www.github.com/oadtz/checkout

  

## Configuration

  

(Optional) Open up *.env* file in project's root, then edit the following variables to match with your Adyen & Braintree accounts

  

ADYEN_USERNAME=

ADYEN_PASSWORD=

ADYEN_ENVIRONMENT=test

ADYEN_APPNAME=

ADYEN_MERCHANT_ACCOUNT=

BRAINTREE_ENVIRONMENT=sandbox

BRAINTREE_MERCHANT_ID=

BRAINTREE_PUBLIC_KEY=

BRAINTREE_PRIVATE_KEY=

  

  

## Run

  

  

$ docker-compose up -d

  

  

Navigate browser to:

  

  

http://localhost:8080

  

## Database

To get into MySQL server docker, run this command:

  

    $ docker-compose exec mysql mysql

  

  
  

## Unit test and integration test

  

  

$ docker-compose exec php bash -c 'cd /var/www && vendor/bin/phpunit'