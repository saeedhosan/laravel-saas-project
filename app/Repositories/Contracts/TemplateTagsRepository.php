<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

/* *
 * Interface TemplateTagsRepository
 */

use App\Models\TemplateTags;

interface TemplateTagsRepository extends BaseRepository
{
    /**
     * @return mixed
     */
    public function store(array $input);

    /**
     * @return mixed
     */
    public function update(TemplateTags $tags, array $input);

    /**
     * @return mixed
     */
    public function destroy(TemplateTags $tags);

    /**
     * @return mixed
     */
    public function batchDestroy(array $ids);

    /**
     * @return mixed
     */
    public function batchRequired(array $ids);

    /**
     * @return mixed
     */
    public function batchOptional(array $ids);
}
