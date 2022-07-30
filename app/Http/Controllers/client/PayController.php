<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PaymentRequest;
// Gửi mail
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;
// Model
use App\Models\Customer;
use App\Models\Order;
use App\Models\DetailOrder;

// Cart
use App\Trait\Cart;
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
        $this->cart = new Cart();
        $this->detailOrder = new DetailOrder();
    }


    public function viewFormcustomer() {
        $data = [
            'title' => 'Thông tin thanh toán',
            'active' => 'cart',
        ];
        return view('page.client.formCustomer', $data);
    }

    public function productPayment (PaymentRequest $request) {
        // dd($request->all());
        try {
            $customer_id = $this->customer->insertOne($request->all());
            if (!empty($customer_id)) {
                $totalPrice = $this->cart->totalPrice();
                $order_id = $this->order->insertOne($request->all(), $customer_id, $totalPrice);
                if (!empty($order_id)) {
                    // Lấy giỏ hàng
                    $allCart = $this->cart->getAllCart();
                    foreach ($allCart as $productItem) {
                        $this->detailOrder->insertOne($productItem, $order_id);
                    }
               
                    $email = $request->all()['email'];
                    $mailable= new SendMail($allCart, $request->all(), $totalPrice);
                    Mail::to($email)->send($mailable);
                    $this->cart->destroyCart();
                    $request->session()->put('msg', 'Cảm ơn bạn đã tin tưởng và mua sản phẩm tại shop chúng tôi');
                }
            }
        } catch (\Throwable $th) {
            dd($th);
        }
        
        return redirect()->route('shopping');
    }
}
