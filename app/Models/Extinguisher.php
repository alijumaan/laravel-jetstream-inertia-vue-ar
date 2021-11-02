<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Extinguisher extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['type', 'slug', 'notes'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'type'
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function extinguisherBuildings()
    {
        return $this->belongsToMany(Building::class, 'building_extinguishers');
    }

    public function countExtinguisherBuildings()
    {
        return $this->extinguisherBuildings()->where('extinguisher_id', $this->id)->count();
    }
}
