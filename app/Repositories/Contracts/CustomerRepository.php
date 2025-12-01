<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\Models\User;

/**
 * Interface CustomerRepository.
 */
interface CustomerRepository extends BaseRepository
{
    /**
     * @param  bool  $confirmed
     * @return mixed
     */
    public function store(array $input, $confirmed = false);

    /**
     * @return mixed
     */
    public function update(User $customer, array $input);

    /**
     * @return mixed
     */
    public function updateInformation(User $customer, array $input);

    /**
     * @return mixed
     */
    public function permissions(User $customer, array $input);

    /**
     * @return mixed
     */
    public function destroy(User $customer);

    /**
     * @return mixed
     */
    public function batchEnable(array $ids);

    /**
     * @return mixed
     */
    public function batchDisable(array $ids);

    /**
     * @return mixed
     */
    public function impersonate(User $customer);
}
