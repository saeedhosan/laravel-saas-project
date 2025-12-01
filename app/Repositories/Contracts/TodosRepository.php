<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\Models\Todos;
use App\Models\User;

/**
 * Interface TodosRepository.
 */
interface TodosRepository extends BaseRepository
{
    /**
     * @return void
     */
    public function store(array $input);

    /**
     * @return void
     */
    public function update(array $input);

    /**
     * @return mixed
     */
    public function destroy(User $user, Todos $task);

    /**
     * @return mixed
     */
    public function batchDestroy(array $ids);

    /**
     * @return mixed
     */
    public function batchEnable(array $ids);

    /**
     * @return mixed
     */
    public function batchDisable(array $ids);
}
