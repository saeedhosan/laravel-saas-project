<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

/* *
 * Interface CountryRepository
 */

use App\Models\Country;

interface CountriesRepository extends BaseRepository
{
    /**
     * @return mixed
     */
    public function store(array $input);

    /**
     * @return mixed
     */
    public function destroy(Country $country);
}
