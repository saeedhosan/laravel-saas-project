<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static where(string $string, string $uid)
 * @method static create(array $array)
 * @method static CurrentMonth()
 * @method static whereLike(string[] $array, mixed $search)
 * @method static offset(mixed $start)
 * @method static count()
 * @method static whereIn(string $string, mixed $ids)
 * @method static insert(array[] $invoices)
 */
class Invoices extends Model
{
    /**
     * Invoice status
     */
    public const STATUS_PAID = 'paid';

    public const STATUS_CANCELLED = 'cancelled';

    public const STATUS_UNPAID = 'unpaid';

    public const STATUS_PENDING = 'pending';

    /**
     * Invoice types
     */
    public const TYPE_SENDERID = 'senderid';

    public const TYPE_KEYWORD = 'keyword';

    public const TYPE_SUBSCRIPTION = 'subscription';

    public const TYPE_NUMBERS = 'number';

    /**
     * fillable value
     *
     * @var string[]
     */
    protected $fillable = [
        'uid',
        'user_id',
        'currency_id',
        'payment_method',
        'amount',
        'type',
        'description',
        'transaction_id',
        'status',
        'created_at',
        'updated_at',
    ];

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
     * get user
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Currency
     */
    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    /**
     * Payment method
     */
    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethods::class, 'payment_method', 'id');
    }

    /**
     * get status
     */
    public function getStatus(): string
    {
        return '<span class="badge rounded-pill badge-light-success text-capitalize mr-1 mb-1">'.__('locale.labels.paid').'</span>';
    }

    public function scopeCurrentMonth($query)
    {
        return $query->where('created_at', '>=', Carbon::now()->firstOfMonth());
    }

    /**
     * get route key by uid
     */
    public function getRouteKeyName(): string
    {
        return 'uid';
    }
}
