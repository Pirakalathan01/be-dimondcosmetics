<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 *
 */
class Product extends Model
{
    use HasFactory, HasUlids, SoftDeletes, LogsActivity;

    /**
     * @var string[]
     */
    protected $fillable = [
        'code',
        'name',
        'category_id',
        'description',
        'directions',
        'price',
        'in_stock',
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
        'name' => 'like',
    ];

    /**
     * @var array|\string[][]
     */
    public array $relationable = [
        'category' => ['id', 'name'],
    ];

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    /**
     * @return LogOptions
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('Product')
            ->logOnlyDirty();
    }

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($product) {
            $latestProduct = static::withTrashed()->latest()->first();
            $lastCode = $latestProduct ? $latestProduct->code : 'P00';
            $lastCodeNumber = intval(substr($lastCode, 1));
            $nextCodeNumber = $lastCodeNumber + 1;
            $product->code = 'P' . str_pad($nextCodeNumber, 3, '0', STR_PAD_LEFT);
        });
    }

}
