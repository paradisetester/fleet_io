<?php

namespace App\Traits;
use Cartalyst\Stripe\Stripe;
use App\Models\Payment;

trait StripeTrait {
    public function doStripPayment($request)
    {        
        $stripeSecret = env("STRIPE_SECRET", "");
        $stripe = Stripe::make($stripeSecret);
        try{
            $token = $stripe->tokens()->create([
                'card' => [
                    'number'    => $request->input('card_number'),
                    'exp_month' => $request->input('exp_month'),
                    'cvc'       => $request->input('cvv'),
                    'exp_year'  => $request->input('exp_year'),
                ],
            ]);
            try {
                $charge = $stripe->charges()->create([
                    'receipt_email' => $this->getCurrentUserEmail(),
                    'source' => $token['id'],
                    'currency' => 'USD',
                    'amount'   =>  $request->input('amount')
                ]);
                if($charge){				
                    return [
                        'transaction_id' => $charge['balance_transaction'],
                        'charge' => $charge,
                        'status' => true,
                    ];
                }
            } catch (Exception $e) {
                return [
                    'status' => false,
                    'message' => $e->getMesage()
                ];
            }
            
        }catch(Exception $e){
            return [
                'status' => false,
                'message' => $e->getMesage()
            ];
        }
    }

    public function saveFleetPayment($request, $tenant_id){
        $payment = new Payment();
        $payment->order_number = generateUniqueId('fleet');
        $payment->tenant_id = $tenant_id;
        $payment->plan_id = $request->plan_id;
        $payment->order_total_amount = $request->amount;
        $payment->transaction_id = $request->transaction_id;
        $payment->card_number = $request->card_number;
        $payment->card_expiry_month = $request->exp_month;
        $payment->card_expiry_year = $request->exp_year;
        $payment->order_status = 1;
        $payment->email_address = $request->email;
        $payment->save();
    }
}