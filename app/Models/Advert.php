<?php

namespace App\Models;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class Advert extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, Sluggable,SoftDeletes;

    public $table = 'adverts';

    protected $dates = [
        'deadline',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const CONTRACT_TYPE_SELECT = [
        'full-time' => 'Full Time',
        'part-time' => 'Part Time',
    ];

    public const STATUS_SELECT = [
        'draft' => 'Draft',
        'published' => 'Published',
        'expired' => 'Expired',
        're-advertised' => 'Re-Advertised',
    ];

    protected $fillable = [
        'company_id',
        'category_id',
        'title',
        'slug',
        'body',
        'deadline',
        'location',
        'sector',
        'education_level',
        'desired_experience',
        'contract_type',
        'number_of_positions',
        'status',
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function getDeadlineAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format').' '.config('panel.time_format')) : null;
    }

    public function setDeadlineAttribute($value)
    {
        $this->attributes['deadline'] = $value ? Carbon::createFromFormat(config('panel.date_format').' '.config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Return the sluggable configuration array for this model.
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }
    protected static function booted()
    {
        static::addGlobalScope('user_posts', function (Builder $builder) {
            if (Auth::check() && !Auth::user()->isAdmin) {
                // Assuming there's a 'user_id' field in the posts table
                $builder->where('user_id', Auth::id());
            }
            // No filtering for admin, they see all posts
        });
    }
}
