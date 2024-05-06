<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Document extends Model
{
    use HasFactory, HasUlids, SoftDeletes, LogsActivity;

    protected $fillable = [
        'documentable_type',
        'documentable_id',
        'filename',
        'type',
        'image_type',
        'user_id'
    ];

    /**
     * @return LogOptions
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('Document')
            ->logOnlyDirty();
    }

    public function documentable(): MorphTo
    {
        return $this->morphTo();
    }
}
