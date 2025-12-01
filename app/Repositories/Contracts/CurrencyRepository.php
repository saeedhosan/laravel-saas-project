<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

/* *
 * Interface CurrencyRepository
 */

use App\Models\Currency;

interface CurrencyRepository extends BaseRepository
{
    /**
     * @return mixed
     */
    public function store(array $input);

    /**
     * @return mixed
     */
    public function update(Currency $currency, array $input);

    /**
     * @return mixed
     */
    public function destroy(Currency $currency);

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
