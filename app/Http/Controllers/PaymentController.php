<?php

namespace App\Http\Controllers;

use Exception;
use Stripe\Charge;
use Stripe\Stripe;

class PaymentController extends Controller
{
    //
    public function index()
    {
        return view('payment/payment',array('publishable_key'=>env('publishable_key')));
    }

    public function insertPayment()
    {

        Stripe::setApiKey(env('secret_key'));

        header('Content-Type: application/json');

        $data = Request()->validate(['stripeToken' => 'required' , 'amount' => 'required' , 'card_holder' => 'required']);

        if (!empty($data['stripeToken']) && !empty($data['amount'])) {
            $token = $data['stripeToken'];
            $amount = (int)$data['amount'];

            $history = new HistoryController;

            $status = 0;
            $message = 'error';

            try {
                // Create a charge using the token and amount
                $charge = Charge::create([
                    'amount' => $amount*100,  // to convert into cents
                    'currency' => 'usd',
                    'source' => $token['id'],
                    'description' => 'Test Charge',
                ]);

                $status = 1;
                $message = $charge['status'];
                $result = response()->json(array('type' => 'success' , 'message' => $message) );
            } 
            catch(Exception $e){
                $status = 0;
                $message = $e->getMessage();
                $result = response()->json(array('type' => 'error' , 'message' => $e->getMessage()) );

            }

        } else {
            $result = response()->json(array('type' => 'error' , 'message' => 'Invalid inputs') );
        }

        $re = $history->insertPaymentData($token['card']['last4'],$token['card']['exp_month'],$token['card']['exp_year'],$token['id'],$data['card_holder'],$amount,$status,$message);

        if(!$re) $result = response()->json(array('type' => 'error' , 'message' => 'DB Insert Error') );
        
        return $result;
    }
}
