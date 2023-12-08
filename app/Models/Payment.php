<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = [
        'id',
    ];

    protected $attibutes = [
        'status' => 'unpaid',
    ];

    // custom method
    public static function getMidtransSnapToken($payment) {
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

        return \Midtrans\Snap::getSnapToken($params);
    }

    // relations 
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}