<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static where(string $string, string $id)
 */
class ImportJobHistory extends Model
{
    public const STATUS_PROCESSING = 'processing';

    public const STATUS_FINISHED = 'finished';

    public const STATUS_FAILED = 'failed';

    public const STATUS_CANCELLED = 'cancelled';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'type',
        'status',
        'options',
        'import_id',
        'batch_id',
    ];

    public function __toString(): string
    {
        return $this->name;
    }

    /**
     * is processing
     */
    public function isProcessing(): string
    {
        return self::STATUS_PROCESSING;
    }

    /**
     * is finished
     */
    public function isFinished(): string
    {
        return self::STATUS_FINISHED;
    }

    /**
     * is failed
     */
    public function isFailed(): string
    {
        return self::STATUS_FAILED;
    }

    /**
     * is cancelled
     */
    public function isCancelled(): string
    {
        return self::STATUS_CANCELLED;
    }

    /**
     * get single option
     *
     *
     * @return mixed|string
     */
    public function getOption($name): string
    {
        return $this->getOptions()[$name];
    }

    /**
     * Get options.
     */
    public function getOptions(): array
    {
        if (empty($this->options)) {
            return [];
        }

        return json_decode($this->options, true);

    }

    /**
     * get status
     */
    public function getStatus(): string
    {
        $status = $this->status;

        if ($status === self::STATUS_FAILED || $status === self::STATUS_CANCELLED) {
            return '<div class="badge bg-danger text-uppercase me-1 mb-1"><span>'.__('locale.labels.'.$status).'</span></div>';
        }
        if ($status === self::STATUS_PROCESSING) {
            return '<div class="badge bg-primary text-uppercase me-1 mb-1"><span>'.__('locale.labels.processing').'</span></div>';
        }

        return '<div class="badge bg-success text-uppercase me-1 mb-1"><span>'.__('locale.labels.finished').'</span></div>';
    }
}
