<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Laravel\Paddle\Events\WebhookReceived;
use Laravel\Paddle\Cashier;
use Laravel\Paddle\Events\TransactionCompleted;

class PaddleEventListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

        /**
     * Handle the incoming Cashier webhook event.
     */
    public function handle(TransactionCompleted $event): void
    {
        logger($event->payload);
        /* $orderId = $event->payload['data']['custom_data']['order_id'] ?? null;

        $order = Order::findOrFail($orderId);

        $order->update(['status' => 'completed']); */
    }

}
