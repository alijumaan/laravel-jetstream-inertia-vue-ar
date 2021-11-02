<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    use HasFactory;

    protected $fillable = ['period'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'time_name_arabic'
    ];

    public function buildings()
    {
        return $this->hasMany(Building::class);
    }

    public function getTimeNameArabicAttribute()
    {
        switch ($this->period) {
            case 'monthly':
                return 'شهري';

            case 'every three months':
                return 'كل ثلاث أشهر';

            case 'every six months':
                return 'كل ستة أشهر';

            case 'yearly':
                return 'سنوي';

            default:
                return $this->period;
        }
    }
}
