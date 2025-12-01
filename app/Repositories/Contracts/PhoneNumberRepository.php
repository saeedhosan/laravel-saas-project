<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

/* *
 * Interface PhoneNumberRepository
 */

use App\Models\PhoneNumbers;

interface PhoneNumberRepository extends BaseRepository
{
    /**
     * @return mixed
     */
    public function store(array $input, array $billingCycle);

    /**
     * @return mixed
     */
    public function update(PhoneNumbers $number, array $input, array $billingCycle);

    /**
     * @return mixed
     */
    public function destroy(PhoneNumbers $number);

    /**
     * @return mixed
     */
    public function release(PhoneNumbers $number, string $id);

    /**
     * @return mixed
     */
    public function batchDestroy(array $ids);

    /**
     * @return mixed
     */
    public function batchAvailable(array $ids);

    /**
     * @return mixed
     */
    public function payPayment(PhoneNumbers $number, array $input);
}
