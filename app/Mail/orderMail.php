<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class orderMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $order;
    public function __construct($order)
    {
        return $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->view('clien.pages.mail.mailOrder')
                    ->from('taisaokhong81@gmail.com','Hoàng Hải Hữu')
                    ->subject('[HHwatch] Thư xác nhận đơn hàng thành công! ')
                    ->with([
                        'order_code' => $this->order->order_code,
                        'orderDetail' => $this->order->orderDetails,
                        'customer' => $this->order->customer,
                        'total_amount' => $this->order->total_amount,
                        'address' => $this->order->address,
                        'email' => $this->order->customer->email,
                        'phone' => $this->order->phone,
                        'notes' => $this->order->notes,
                        'status' => $this->order->status,
                    ]);
    }
}
