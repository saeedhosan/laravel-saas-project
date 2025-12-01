<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static count()
 * @method static create(array $array)
 * @method static find($end_by)
 *
 * @property string user_id
 * @property string todo_id
 * @property Todos todo
 * @property User user
 */
class TodosReceived extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    public static $roles = [
        'user_id' => 'required',
        'todo_id' => 'required',
    ];

    /**
     * Todo status list
     *
     * @var array
     */
    public static $status = [
        'available', 'in_progress', 'review', 'complete',  'pending', 'pause', 'continue',
    ];

    /**
     * Table name
     *
     * @var string table
     */
    protected $table = 'todos_received';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'todo_id',
        'accepted',
    ];

    /**
     * Find item by uid.
     */
    public static function findByUid($uid): object
    {
        return self::where('uid', $uid)->first();
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

    public function systemJobs(): HasMany
    {
        return $this->hasMany(SystemJob::class)->orderBy('created_at', 'desc');
    }

    /**
     * get route key by uid
     */
    public function getRouteKeyName(): string
    {
        return 'uid';
    }

    /**
     * get user
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * get Todos
     *
     * @return Todos
     */
    public function todo(): BelongsTo
    {
        return $this->belongsTo(Todos::class, 'todo_id');
    }
}
