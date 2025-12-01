<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Exceptions\GeneralException;
use App\Models\Role;
use App\Repositories\Contracts\RoleRepository;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Throwable;

/**
 * Class EloquentRoleRepository.
 */
class EloquentRoleRepository extends EloquentBaseRepository implements RoleRepository
{
    /**
     * EloquentRoleRepository constructor.
     */
    public function __construct(Role $role)
    {
        parent::__construct($role);
    }

    /**
     * @throws Exception|Throwable
     */
    public function store(array $input): Role
    {
        /** @var Role $role */
        $role = $this->make($input);

        if (! $this->save($role, $input)) {
            throw new GeneralException(__('locale.exceptions.something_went_wrong'));
        }

        return $role;
    }

    /**
     * @throws Exception|Throwable
     * @throws Exception
     */
    public function update(Role $role, array $input): Role
    {
        $role->fill($input);

        if (! $this->save($role, $input)) {
            throw new GeneralException(__('locale.exceptions.something_went_wrong'));
        }

        return $role;
    }

    /**
     * @return bool|null
     *
     * @throws Exception|Throwable
     */
    public function destroy(Role $role)
    {
        $role->permissions()->delete();

        if (! $role->delete()) {
            throw new GeneralException(__('locale.exceptions.something_went_wrong'));
        }

        return true;
    }

    /**
     * Get only roles than current can attribute to the others.
     */
    public function getAllowedRoles()
    {
        $authenticatedUser = auth()->user();

        if (! $authenticatedUser) {
            return [];
        }

        $roles = $this->query()->with('permissions')->get();

        if ($authenticatedUser->is_super_admin) {
            return $roles;
        }

        /** @var Collection $permissions */
        $permissions = $authenticatedUser->getPermissions();

        $roles = $roles->filter(function (Role $role) use ($permissions) {
            foreach ($role->permissions as $permission) {
                if ($permissions->search($permission, true) === false) {
                    return false;
                }
            }

            return true;
        });

        return $roles;
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

    private function save(Role $role, array $input): bool
    {
        if (! $role->save($input)) {
            return false;
        }

        $role->permissions()->delete();

        $permissions = $input['permissions'] ?? [];

        foreach ($permissions as $name) {
            $role->permissions()->create(['name' => $name]);
        }

        return true;
    }
}
