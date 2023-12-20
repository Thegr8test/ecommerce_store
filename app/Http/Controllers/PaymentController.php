<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Token;
use Stripe\Charge;

class PaymentController extends Controller
{
    /**
     * Display the payment form.
     *
     * @return \Illuminate\View\View
     */
    public function showPaymentForm()
    {
        return view('payment.stripe');
    }

    /**
     * Handle the payment submission.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function charge(Request $request)
    {
        // Set your Stripe secret key
        Stripe::setApiKey(config('services.stripe.secret'));

        // Get the Stripe token from the form
        $token = $request->input('stripeToken');

        try {
            // Create a charge using the Stripe token and the desired amount
            Charge::create([
                'amount' => $request->input('amount'), // Amount in cents
                'currency' => 'usd', // Change currency as needed
                'source' => $token,
                'description' => 'Payment for products', // Customize description
            ]);

            // Payment was successful, redirect or display a success message
            return redirect()->route('payment.success')->with('success', 'Payment was successful.');
        } catch (\Exception $e) {
            // Payment failed, handle the error and redirect back with an error message
            return redirect()->route('payment.form')->with('error', 'Payment failed: ' . $e->getMessage());
        }
    }

    /**
     * Display a success message after a successful payment.
     *
     * @return \Illuminate\View\View
     */
    public function paymentSuccess()
    {
        return view('payment.success');
    }
}