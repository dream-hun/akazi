<?php

namespace App\Models;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Advert extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, HasFactory, Sluggable;

    protected $table = 'adverts';

    public const SECTOR_SELECT = [
        '1' => 'Private Sector',
        '2' => 'Government',
    ];

    protected $dates = [
        'deadline',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'deadline' => 'datetime',  // Casts 'deadline' to Carbon instance
    ];

    public const CONTRACT_TYPE_SELECT = [
        '1' => 'Full Time at Site',
        '2' => 'Full Time Remote',
        '3' => 'Part Time Remote',
    ];

    public const STATUS_SELECT = [
        'draft'         => 'Draft',
        'published'     => 'Published',
        'expired'       => 'Expired',
        're-advertised' => 'Re-Advertised',
    ];

    protected $fillable = [
        'category_id',
        'company_id',
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
        'user_id',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getDeadlineAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDeadlineAttribute($value)
    {
        $this->attributes['deadline'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('d-m-Y') : null;
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }

    public function formattedPublish(): string
    {
        return $this->created_at->diffForHumans();
    }
}
