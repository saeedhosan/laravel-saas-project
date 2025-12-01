<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, $uid)
 * @method static create(array $gateway)
 *
 * @property mixed options
 * @property mixed name
 */
class PaymentMethods extends Model
{
    // PaymentMethod type
    public const TYPE_CASH = 'offline_payment';

    public const TYPE_PAYPAL = 'paypal';

    public const TYPE_STRIPE = 'stripe';

    public const TYPE_BRAINTREE = 'braintree';

    public const TYPE_AUTHORIZE_NET = 'authorize_net';

    public const TYPE_2CHECKOUT = '2checkout';

    public const TYPE_PAYSTACK = 'paystack';

    public const TYPE_PAYU = 'payu';

    public const TYPE_SLYDEPAY = 'slydepay';

    public const TYPE_PAYNOW = 'paynow';

    public const TYPE_COINPAYMENTS = 'coinpayments';

    public const TYPE_INSTAMOJO = 'instamojo';

    public const TYPE_PAYUMONEY = 'payumoney';

    public const TYPE_RAZORPAY = 'razorpay';

    public const TYPE_SSLCOMMERZ = 'sslcommerz';

    public const TYPE_AAMARPAY = 'aamarpay';

    public const TYPE_FLUTTERWAVE = 'flutterwave';

    public const TYPE_DIRECTPAYONLINE = 'directpayonline';

    public const TYPE_SMANAGER = 'smanager';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'options', 'status',
    ];

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
     * Get options.
     */
    public function getOptions(): array
    {
        return json_decode($this->options, true);
    }

    /**
     * Get option.
     */
    public function getOption($name): ?string
    {
        $options = $this->getOptions();

        return $options[$name] ?? null;
    }

    /**
     * get route key by uid
     */
    public function getRouteKeyName(): string
    {
        return 'uid';
    }
}
