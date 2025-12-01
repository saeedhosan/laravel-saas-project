<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

/* *
 * Interface LanguageRepository
 */

use App\Models\Language;

interface LanguageRepository extends BaseRepository
{
    /**
     * @return mixed
     */
    public function store(array $input);

    /**
     * @return mixed
     */
    public function update(Language $language, array $input);

    /**
     * @return mixed
     */
    public function destroy(Language $language);

    /**
     * download language
     *
     *
     * @return mixed
     */
    public function download(Language $language);

    /**
     * upload language
     *
     *
     * @return mixed
     */
    public function upload(array $input, Language $language);
}
