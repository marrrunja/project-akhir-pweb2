<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    public function index()
    {
        return view('payment');
    }
    public function payment(Request $request)
    {
        $orderId = 'INV' . '-' . now();
        $params = [
                'transaction_details' => [
                    'order_id' => $orderId,
                    'gross_amount' => $request->totalHarga
                ],
                'item_details' => [
                    [
                        'price' => $request->harga,
                        'quantity' => $request->jumlah,
                        'name' => $orderId
                    ],
                ],
                'customer_details'=> [
                    'first_name' => $request->nama,
                    'email' => $request->email
                ],
                'enable_payments' => ['credit_card', 'bni_va', 'bca_va', 'gopay', 'alfamart', 'indomart']
            ];
            $url = 'https://app.sandbox.midtrans.com/snap/v1/transactions';

            $auth = base64_encode(env('MIDTRANS_SERVER_KEY'));
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => "Basic $auth"
            ])->post($url, $params);
            $response = json_decode($response->body(), true);
           return $response;
    }
}
