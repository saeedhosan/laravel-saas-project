<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

/* *
 * Interface TemplatesRepository
 */

use App\Models\Templates;

interface TemplatesRepository extends BaseRepository
{
    /**
     * @return mixed
     */
    public function store(array $input);

    /**
     * @return mixed
     */
    public function update(Templates $template, array $input);

    /**
     * @return mixed
     */
    public function destroy(Templates $template);

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
