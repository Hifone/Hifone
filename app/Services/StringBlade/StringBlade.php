<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Services\StringBlade;

use ArrayAccess;
use Closure;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Renderable;
use View;

class StringBlade extends \Illuminate\View\View implements ArrayAccess, Renderable
{
    /** @var \Illuminate\Config\Repository */
    protected $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function setEngine($compiler)
    {
        $this->engine = $compiler;

        return $this;
    }

    /**
     * Get a evaluated view contents for the given view.
     *
     * @param string $view
     * @param array  $data
     * @param array  $mergeData
     *
     * @return \Illuminate\View\View
     */
    public function make($view, $data = [], $mergeData = [])
    {
        $this->path = $view;
        $this->data = array_merge($mergeData, $this->parseData($data));

        return $this;
    }

    /**
     * Get the string contents of the view.
     *
     * @param \Closure $callback
     *
     * @return string
     */
    public function render(Closure $callback = null)
    {
        $contents = $this->renderContents();

        $response = isset($callback) ? $callback($this, $contents) : null;

        // Once we have the contents of the view, we will flush the sections if we are
        // done rendering all views so that there is nothing left hanging over when
        // anothoer view is rendered in the future by the application developers.
        View::flushSectionsIfDoneRendering();

        return $response ?: $contents;
    }

    /**
     * Get the contents of the view instance.
     *
     * @return string
     */
    protected function renderContents()
    {
        // We will keep track of the amount of views being rendered so we can flush
        // the section after the complete rendering operation is done. This will
        // clear out the sections for any separate views that may be rendered.
        View::incrementRender();

        $contents = $this->getContents();

        // Once we've finished rendering the view, we'll decrement the render count
        // so that each sections get flushed out next time a view is created and
        // no old sections are staying around in the memory of an environment.
        View::decrementRender();

        return $contents;
    }

    /**
     * Parse the given data into a raw array.
     *
     * @param mixed $data
     *
     * @return array
     */
    protected function parseData($data)
    {
        return $data instanceof Arrayable ? $data->toArray() : $data;
    }

    /**
     * Get the data bound to the view instance.
     *
     * @return array
     */
    protected function gatherData()
    {
        $data = array_merge(View::getShared(), $this->data);

        foreach ($data as $key => $value) {
            if ($value instanceof Renderable) {
                $data[$key] = $value->render();
            }
        }

        return $data;
    }

    /**
     * Add a view instance to the view data.
     *
     * @param string $key
     * @param string $view
     * @param array  $data
     *
     * @return \Illuminate\View\View
     */
    public function nest($key, $view, array $data = [])
    {
        return $this->with($key, View::make($view, $data));
    }

    /**
     * Determine if a piece of data is bound.
     *
     * @param string $key
     *
     * @return bool
     */
    public function offsetExists($key)
    {
        return array_key_exists($key, $this->data);
    }

    /**
     * Get a piece of bound data to the view.
     *
     * @param string $key
     *
     * @return mixed
     */
    public function offsetGet($key)
    {
        return $this->data[$key];
    }

    /**
     * Set a piece of data on the view.
     *
     * @param string $key
     * @param mixed  $value
     *
     * @return void
     */
    public function offsetSet($key, $value)
    {
        $this->with($key, $value);
    }

    /**
     * Unset a piece of data from the view.
     *
     * @param string $key
     *
     * @return void
     */
    public function offsetUnset($key)
    {
        unset($this->data[$key]);
    }
}
