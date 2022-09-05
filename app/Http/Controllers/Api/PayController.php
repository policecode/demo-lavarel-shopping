<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Gửi mail
use App\Mail\SendMail;
use App\Models\Customer;
use App\Models\DetailOrder;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;

class PayController extends Controller
{
    private $customer;
    private $order;
    private $cart;
    private $detailOrder;
    public function __construct()
    {
        $this->customer = new Customer();
        $this->order = new Order();
        $this->detailOrder = new DetailOrder();
    }
    function getPay(Request $request) {
        try {
            $customer_id = $this->customer->insertOne($request->all());
            if (!empty($customer_id)) {
                $totalPrice = $request->totalPrice;
                $order_id = $this->order->insertOne($request->all(), $customer_id, $totalPrice);
                if (!empty($order_id)) {
                    // Lấy giỏ hàng
                    $allCart = $request->cart;
                    foreach ($allCart as $productItem) {
                        $this->detailOrder->insertOne($productItem, $order_id);
                    }
               
                    $email = $request->all()['email'];
                    $mailable= new SendMail($allCart, $request->all(), $totalPrice);
                    Mail::to($email)->send($mailable);
                    $status = 'success';
                }
            }
        } catch (\Throwable $th) {
            $status = 'error';
        }
        
        return response()->json(['status' => $status]);
    }
}
