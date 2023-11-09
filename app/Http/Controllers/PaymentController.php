<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('order.pricing', [
            'title' => 'Pricing'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $duration = $request->input('duration');
        $payment = Payment::create([
            'qty' => $duration,
            'total' => $duration * 50000,
            'status' => 'unpaid',
            'user_id' => auth()->user()->id
        ]);

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $payment->id,
                'gross_amount' => $payment->total,
            ),
            'customer_details' => array(
                'name' => auth()->user()->name,
                'email' => auth()->user()->email,
                'phone' => auth()->user()->phone,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $title = "Checkout";

        return view('order.checkout', compact('title', 'snapToken', 'payment'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        $server_key = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id.$request->status_code.$request->gross_amount.$servey_key);
        if($hashed == $request->signature_key) {
            if($request->transaction_status == 'capture') {
                $payment = Payment::find($request->order_id)->update(['status' => 'paid']);
                
                $subscription = Subscription::firstWhere('user_id', auth()->user()->id);
                $subscription->update([
                    'status' => 'active', 
                    'expired_date' => Carbon::now()->addMonths($payment->qty)
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
