<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed name
 *
 * @method static create(array $array)
 * @method static cursor()
 * @method static where(string $string, string $uid)
 * @method static count()
 * @method static offset($start)
 * @method static whereLike(string[] $array, $search)
 * @method static find(mixed $country_code)
 */
class Country extends Model
{
    protected $table = 'countries';

    protected $fillable = ['name', 'iso_code', 'country_code', 'status'];

    /**
     * @var array
     */
    protected $casts = [
        'status' => 'boolean',
    ];

    public function __toString(): string
    {
        return $this->name;
    }

    public static function boot()
    {
        parent::boot();

        // Create uid when creating list.
        static::creating(function ($item) {
            // Create new uid
            $uid = uniqid();
            while (self::where('uid', $uid)->count() > 0) {
                $uid = uniqid();
            }
            $item->uid    = $uid.'-'.uniqid().'_'.uniqid().'_'.uniqid();
            $item->status = true;
        });
    }

    /**
     * get route key by uid
     */
    public function getRouteKeyName(): string
    {
        return 'uid';
    }
}
