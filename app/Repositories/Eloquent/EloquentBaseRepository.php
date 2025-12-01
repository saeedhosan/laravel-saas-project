<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class EloquentBaseRepository implements BaseRepository
{
    protected $model;

    /**
     * BaseRepository constructor.
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function query(): Builder
    {
        return $this->model->newQuery();
    }

    /**
     * @param  null  $callback
     * @return mixed
     */
    public function search($query, $callback = null)
    {
        return $this->model->search($query, $callback);
    }

    public function select(array $columns = ['*']): Builder
    {
        return $this->query()->select($columns);
    }

    public function make(array $attributes = []): Model
    {
        return $this->query()->make($attributes);
    }
}
