<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;
    private $allCart;
    private $customer;
    private $totalPrice;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($allCart, $customer, $totalPrice)
    {
        $this->allCart = $allCart;
        $this->customer = $customer;
        $this->totalPrice = $totalPrice;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
        ->subject('THông tin mua hàng')
        ->view('mail.sendmail')
        ->with([
            'allCart' => $this->allCart,
            'customer' => $this->customer,
            'totalPrice' => $this->totalPrice
        ]);
    }
}
