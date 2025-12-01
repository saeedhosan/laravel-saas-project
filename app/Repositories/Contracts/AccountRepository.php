<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use Illuminate\Contracts\Auth\Authenticatable;

/**
 * Interface AccountRepository.
 */
interface AccountRepository extends BaseRepository
{
    /**
     * @return mixed
     */
    public function register(array $input);

    /**
     * @return mixed
     */
    public function findOrCreateSocial($provider, $data);

    public function hasPermission(Authenticatable $user, $name): bool;

    /**
     * @return mixed
     */
    public function update(array $input);

    /**
     * @return mixed
     */
    public function delete();

    /**
     * @return mixed
     */
    public function redirectAfterLogin(Authenticatable $user);

    public function payPayment(array $input);
}
