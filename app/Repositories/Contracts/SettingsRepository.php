<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

/* *
 * Interface SettingsRepository
 */

interface SettingsRepository extends BaseRepository
{
    /**
     * general setting
     *
     *
     * @return mixed
     */
    public function general(array $input);

    /**
     * system email setting
     *
     *
     * @return mixed
     */
    public function systemEmail(array $input);

    /**
     * authentication settings
     *
     *
     * @return mixed
     */
    public function authentication(array $input);

    /**
     * notifications settings
     *
     *
     * @return mixed
     */
    public function notifications(array $input);

    /**
     * localization settings
     *
     *
     * @return mixed
     */
    public function localization(array $input);

    /**
     * pusher settings
     *
     *
     * @return mixed
     */
    public function pusherSettings(array $input);

    /**
     * background job settings
     *
     *
     * @return mixed
     */
    public function backgroundJob(array $input);

    /**
     * license manager settings
     *
     *
     * @return mixed
     */
    public function license(array $input);

    /**
     * upgrade CRM from old one.
     *
     *
     * @return mixed
     */
    public function upgradeApplication(array $input);
}
