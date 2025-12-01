<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Interface BaseRepository.
 */
interface BaseRepository
{
    /**
     * @return Builder
     */
    public function query();

    /**
     * @param  null  $callback
     */
    public function search($query, $callback = null);

    /**
     * @return Builder
     */
    public function select(array $columns = ['*']);

    /**
     * @return Model
     */
    public function make(array $attributes = []);
}
