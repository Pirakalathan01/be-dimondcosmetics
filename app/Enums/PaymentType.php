<?php


namespace App\Enums;

enum PaymentType: string
{
    const card = 'card';
    const cash = 'cash';
    const bank_transfer = 'bank_transfer';
    const cash_on_delivery = 'cash_on_delivery';
}
