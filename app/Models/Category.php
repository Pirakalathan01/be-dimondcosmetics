<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 *
 */
class Category extends Model
{
    use HasFactory, HasUlids, SoftDeletes, LogsActivity;

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'name',
        'description',
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
        'products' => ['id', 'category_id', 'name'],
    ];

    /**
     * @return HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class,'category_id','id');
    }

    /**
     * @return LogOptions
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('Category')
            ->logOnlyDirty();
    }
}
