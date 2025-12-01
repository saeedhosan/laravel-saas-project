<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static count()
 * @method static cursor()
 * @method static select(string $string)
 * @method static where(string $string, $uid)
 * @method static offset(mixed $start)
 * @method static whereLike(string[] $array, mixed $search)
 * @method static create(array $tags)
 * @method static all()
 * @method static reject()
 * @method chunk(int $length)
 */
class TemplateTags extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'tag',
        'type',
        'required',
    ];

    public function __toString(): string
    {
        return $this->name;
    }

    /**
     * Bootstrap any application services.
     */
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
            $item->uid = $uid;
        });
    }

    /**
     * Find item by uid.
     */
    public static function findByUid($uid): object
    {
        return self::where('uid', $uid)->first();
    }

    /**
     * get all plans
     *
     * @return mixed
     */
    public static function getAll()
    {
        return self::select('*');
    }

    /**
     * default template tags
     *
     * @return string[]
     */
    public function defaultTemplateTags(): array
    {
        return [
            'email',
            'username',
            'company',
            'first_name',
            'last_name',
            'birth_date',
            'anniversary_date',
            'address',
        ];
    }

    /**
     * get route key by uid
     */
    public function getRouteKeyName(): string
    {
        return 'uid';
    }
}
