<?php


namespace App\Enums;

enum OrderStatus: string
{
    const Order_Placed = 'Order_Placed';
    const Processing = 'Processing';
    const Shipped = 'Shipped';
    const Delivered = 'Delivered';
    const Cancelled = 'Cancelled';
}
