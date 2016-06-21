<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Services\Config;

use Hifone\Models\Setting;

class Repository
{
    /**
     * The eloquent model instance.
     *
     * @var \Hifone\Models\Setting
     */
    protected $model;

    /**
     * Is the config state stale?
     *
     * @var bool
     */
    protected $stale = false;

    /**
     * Create a new settings service instance.
     *
     * @param \Hifone\Models\Setting $model
     *
     * @return void
     */
    public function __construct(Setting $model)
    {
        $this->model = $model;
    }

    /**
     * Returns a setting from the database.
     *
     * @return array
     */
    public function all()
    {
        return $this->model->all(['name', 'value'])->pluck('value', 'name')->toArray();
    }

    /**
     * Updates a setting value.
     *
     * @param string      $name
     * @param string|null $value
     *
     * @return void
     */
    public function set($name, $value)
    {
        $this->stale = true;

        if ($value === null) {
            $this->model->where('name', $name)->delete();
        } else {
            $this->model->updateOrCreate(compact('name'), compact('value'));
        }
    }

    /**
     * Deletes a setting.
     *
     * @param string $name
     *
     * @return void
     */
    public function delete($name)
    {
        $this->stale = true;

        $this->model->where('name', $name)->delete();
    }

    /**
     * Is the config state stale?
     *
     * @return bool
     */
    public function stale()
    {
        return $this->stale;
    }
}
