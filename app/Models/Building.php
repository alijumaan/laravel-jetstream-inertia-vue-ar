<?php

namespace App\Models;

use App\Helper\SlugHelper;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Building extends Model
{
    use HasFactory, Sluggable, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'number',
        'status',
        'user_id',
        'period_id',
        'notes',
        'checked_at'
    ];

    public const ONE_MONTH = 1;
    public const THREE_MONTHS = 2;
    public const SIX_MONTHS = 3;
    public const YEAR = 4;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'inspector',
        'checked_at_string'
    ];

    public $timestamps = ['checked_at'];

    protected $casts = [
        'checked_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getInspectorAttribute()
    {
        return $this->user->name ?? null;
    }

    public function getCheckedAtStringAttribute()
    {
        return $this->checked_at ? $this->checked_at->diffForHumans() : null;
    }

    public function extinguishers()
    {
        return $this->belongsToMany(Extinguisher::class, 'building_extinguishers', 'building_id', 'extinguisher_id');
    }

    public function periods()
    {
        return $this->belongsTo(Period::class);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = SlugHelper::uniqueSlug($value, 'buildings');
    }
}
