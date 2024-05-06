<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 *
 */
class Order extends Model
{
    use HasFactory, HasUlids, SoftDeletes, LogsActivity;

    /**
     * @var string[]
     */
    protected $fillable = [
        'identifier',

        'product_id',
        'customer_id',
        'order_status',
        'payment_type',

        'email',
        'first_name',
        'last_name',

        'address',
        'city',
        'country',
        'state',
        'post_code',
        'phone_number',

        'product_amount',
        'quantity',
        'shipping_amount',

        'total_gross_amount',
        'total_net_amount',
    ];

    /**
     * @var array
     */
    protected $casts = [

    ];

    /**
     * @var array|string[]
     */
    public array $filterable = [
        'identifier' => 'like',
    ];

    /**
     * @var array|\string[][]
     */
    public array $relationable = [
        'product' => ['id', 'name', 'price', 'category_id'],
        'customer' => ['id', 'first_name', 'last_name', 'email'],
    ];

    public function customer(): HasOne
    {
        return $this->hasOne(User::class,'id','customer_id');
    }

    public function product(): HasOne
    {
        return $this->hasOne(Product::class,'id', 'product_id');
    }


    /**
     * @return LogOptions
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('Order')
            ->logOnlyDirty();
    }

    /**
     * @return void
     */
    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($order) {
            $latestOrder = static::withTrashed()->latest()->first();
            $lastCode = $latestOrder ? $latestOrder->identifier : 'Order00';
            $lastCodeNumber = intval(substr($lastCode, 5)); // Changed substr from 1 to 5 to get the numeric part correctly
            $nextCodeNumber = $lastCodeNumber + 1;
            $order->identifier = 'Order' . str_pad($nextCodeNumber, 3, '0', STR_PAD_LEFT); // Changed str_pad from 3 to 2 since the numeric part is only 2 digits
        });
    }
}
