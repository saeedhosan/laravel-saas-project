<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Exceptions\GeneralException;
use App\Models\Templates;
use App\Repositories\Contracts\TemplatesRepository;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Throwable;

class EloquentTemplatesRepository extends EloquentBaseRepository implements TemplatesRepository
{
    /**
     * EloquentTemplatesRepository constructor.
     */
    public function __construct(Templates $template)
    {
        parent::__construct($template);
    }

    /**
     * @return Templates|mixed
     *
     * @throws GeneralException
     */
    public function store(array $input): Templates
    {
        /** @var Templates $template */
        $template = $this->make(Arr::only($input, ['name', 'message']));

        $template->status  = true;
        $template->user_id = auth()->user()->id;

        if (! $this->save($template)) {
            throw new GeneralException(__('locale.exceptions.something_went_wrong'));
        }

        return $template;

    }

    /**
     * @throws Exception|Throwable
     * @throws Exception
     */
    public function update(Templates $template, array $input): Templates
    {
        if (! $template->update($input)) {
            throw new GeneralException(__('locale.exceptions.something_went_wrong'));
        }

        return $template;
    }

    /**
     * @return bool|null
     *
     * @throws Exception|Throwable
     */
    public function destroy(Templates $template)
    {
        if (! $template->delete()) {
            throw new GeneralException(__('locale.exceptions.something_went_wrong'));
        }

        return true;
    }

    /**
     * @return mixed
     *
     * @throws Exception|Throwable
     */
    public function batchDestroy(array $ids): bool
    {
        DB::transaction(function () use ($ids) {
            // This wont call eloquent events, change to destroy if needed
            if ($this->query()->whereIn('uid', $ids)->delete()) {
                return true;
            }

            throw new GeneralException(__('locale.exceptions.something_went_wrong'));
        });

        return true;
    }

    /**
     * @return mixed
     *
     * @throws Exception|Throwable
     */
    public function batchActive(array $ids): bool
    {
        DB::transaction(function () use ($ids) {
            if ($this->query()->whereIn('uid', $ids)
                ->update(['status' => true])
            ) {
                return true;
            }

            throw new GeneralException(__('locale.exceptions.something_went_wrong'));
        });

        return true;
    }

    /**
     * @return mixed
     *
     * @throws Exception|Throwable
     */
    public function batchDisable(array $ids): bool
    {
        DB::transaction(function () use ($ids) {
            if ($this->query()->whereIn('uid', $ids)
                ->update(['status' => false])
            ) {
                return true;
            }

            throw new GeneralException(__('locale.exceptions.something_went_wrong'));
        });

        return true;
    }

    private function save(Templates $template): bool
    {
        if (! $template->save()) {
            return false;
        }

        return true;
    }
}
