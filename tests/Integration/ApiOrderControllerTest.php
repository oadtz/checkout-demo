<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiPaymentControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp ()
    {
        parent::setUp ();

        $this->paymentData = [
            'customer_name'         =>  'Jason Bourne',
            'amount'                =>  '100',
            'currency'              =>  'USD',
            'card_holder_name'      =>  'Jason Bourne',
            'card_expiry_month'      =>  '10',
            'card_expiry_year'      =>  '2020',
            'card_cvv'              =>  '737'
        ];
    }

    public function tearDown ()
    {
        unset ($this->paymentData);
    }
    
    /**
     * @dataProvider validCards
     */
    public function testCheckoutWithValidCards($card, $currency, $cvv)
    {
        $response = $this->post('api/checkout', array_merge($this->paymentData, [
            'card_number'          =>   $card,
            'currency'             =>   $currency,
            'card_cvv'                  =>   $cvv
        ]));

        $response->assertStatus(200);
    }
    
    /**
     * @dataProvider invalidCards
     */
    public function testCheckoutWithInValidCards($card, $currency, $cvv)
    {
        $response = $this->post('api/checkout', array_merge($this->paymentData, [
            'card_number'          =>   $card,
            'currency'             =>   $currency,
            'card_cvv'             =>   $cvv
        ]));

        $response->assertStatus(500);
    }
    public function validCards ()
    {
        return [
            ['5100290029002909', 'USD', '737'], // Master
            ['5555555555554444', 'THB', '737'], // Master at Braintree
            ['370000000000002', 'USD', '7373'] // AMEX
        ];
    }

    public function invalidCards ()
    {
        return [
            ['5105105105105101', 'USD', '7372'], 
            ['400011111111111', 'THB', '737'], 
            ['370000000000002', 'HKG', '7373'] 
        ];
    }

}
