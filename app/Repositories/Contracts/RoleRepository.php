<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\Models\Role;
use Illuminate\Support\Collection;

/**
 * Interface RoleRepository.
 */
interface RoleRepository extends BaseRepository
{
    /**
     * @return mixed|Role
     */
    public function store(array $input);

    /**
     * @return mixed|Role
     */
    public function update(Role $role, array $input);

    /**
     * @return mixed
     */
    public function destroy(Role $role);

    /**
     * @return Collection
     */
    public function getAllowedRoles();

    /**
     * @return mixed
     */
    public function batchDestroy(array $ids);

    /**
     * @return mixed
     */
    public function batchActive(array $ids);

    /**
     * @return mixed
     */
    public function batchDisable(array $ids);
}
