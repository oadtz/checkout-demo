<?php
namespace App\Services;

use App\Services\Interfaces\OrderServiceInterface;
use App\Repositories\Interfaces\OrderRepositoryInterface;

class OrderService implements OrderServiceInterface {
    private $checkout, $order;
    protected $paymentData = [];

    public function __construct(
        \Oadtz\Checkout\Interfaces\CheckoutInterface $checkout,
        OrderRepositoryInterface $order
    ) 
    {
        $this->checkout = $checkout;
        $this->order = $order;
    }

    /**
     * @param string $name
     */
    public function setCustomerName (string $name)
    {
        $this->paymentData['customer_name'] = $name;
    }

    /**
     * @param string $name
     */
    public function setCardHolderName (string $name)
    {
        $this->checkout->setCardHolderName ($name);
    }


    /**
     * @param string $ccNo
     */
    public function setCardNumber (string $ccNo)
    {
        $this->checkout->setCardNumber ($ccNo);
    }

    /**
     * @param DateTime $date
     */
    public function setCardExpiryDate (\DateTime $date)
    {
        $this->checkout->setCardExpiryDate ($date);
    }

    /**
     * @param string $cvv
     */
    public function setCardCVV (string $cvv)
    {
        $this->checkout->setCardCVV ($cvv);
    }

    /**
     * @param float $amount
     */
    public function setAmount (float $amount)
    {
        $this->checkout->setAmount ($amount);
        $this->paymentData['amount'] = $amount;
    }

    /**
     * @param string $currency
     */
    public function setCurrency (string $currency)
    {
        $this->checkout->setCurrency ($currency);
        $this->paymentData['currency'] = $currency;
    }

    /**
     * @param array $data
     */
    public function setSupplementData (array $data)
    {
        $this->checkout->setSupplementData ($data);
    }

    /**
     * @return \Oadtz\Checkout\PaymentResult
     */
    public function checkout () 
    {
        try {
            $result = $this->checkout->processPayment();


            $order = $this->order->store(array_merge($this->paymentData, [
                'status'            =>  $result->getSuccess() ? 'SUCCESS' : 'FAILED',
                'payment_gateway'   =>  $result->getPaymentGateway(),
                'response_data'     =>  json_encode($result->getResponseData())
            ]));

            if ($order->status == 'FAILED') {
                $responseData = (array)json_decode($order->response_data);
                $errorMessage = 'Payment failed';

                if (isset($responseData['refusalReason']))
                    $errorMessage = $responseData['refusalReason'];
                else if (isset($responseData['message']))
                    $errorMessage = $responseData['message'];
                    
                throw new \Exception ($errorMessage);
            }

            return $order;
        } catch (\Exception $e) {
            throw $e;
        }
    }

}