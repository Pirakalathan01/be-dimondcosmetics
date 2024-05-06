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
class Card extends Model
{
    use HasFactory, HasUlids, LogsActivity;

    /**
     * @var string[]
     */
    protected $fillable = [
        'customer_id',
        'product_id',
    ];

    /**
     * @var array|string[]
     */
    public array $filterable = [
        'customer_id' => '=',
        'product_id' => '=',
    ];

    /**
     * @var array|\string[][]
     */
    public array $relationable = [
        'customer' => ['id', 'first_name'],
        'product' => ['id', 'name', 'price', 'in_stock', 'category_id'],
    ];

    /**
     * @return LogOptions
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('Card')
            ->logOnlyDirty();
    }

    /**
     * @return HasOne
     */
    public function customer(): HasOne
    {
        return $this->hasOne(User::class,'id','customer_id');
    }

    /**
     * @return HasOne
     */
    public function product(): HasOne
    {
        return $this->hasOne(Product::class,'id','product_id');
    }
}
