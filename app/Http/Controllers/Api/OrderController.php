<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Responses\JsonResponse;
use App\Http\Responses\JsonException;
use App\Services\Interfaces\OrderServiceInterface;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $order;

    public function __construct (OrderServiceInterface $order) {
        $this->order = $order;
    }

    public function checkout (Request $request) {
        try {
            $this->order->setCustomerName($request->input('customer_name'));
            $this->order->setAmount($request->input('amount'));
            $this->order->setCurrency($request->input('currency'));
            $this->order->setCardHolderName($request->input('card_holder_name'));
            $this->order->setCardNumber($request->input('card_number'));
            $this->order->setCardExpiryDate(new \DateTime($request->input('card_expiry_year') . '-' . $request->get('card_expiry_month') . '-01'));
            $this->order->setCardCVV($request->input('card_cvv'));
            $this->order->setSupplementData([
                'reference' =>  'Sample Checkout App', // For Adyen
                'options'   =>  [
                    'submitForSettlement'   => true // For Braintree
                ]
            ]);

            return new JsonResponse($this->order->checkout());
        } catch (\Exception $e) {
            return  new JsonException($e);
        }
    }
}
