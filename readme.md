
# Demo for oadtz/checkout package

A laravel project to implement oadtz/checkout package

  

## Configuration

(Optional) Open up *.env.example* file in project root, then edit the following variables to match with your adyen & braintree account

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

  

Open browser to:

  

http://localhost:8080

  

## Unit test and integration test

  

    $ docker-compose exec php bash -c 'cd /var/www && vendor/bin/phpunit'
