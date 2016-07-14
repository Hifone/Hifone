<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

if (!function_exists('back_url')) {
    /**
     * Create a new back url.
     *
     * @param string|null $route
     * @param array       $parameters
     * @param int         $status
     * @param array       $headers
     *
     * @return string
     */
    function back_url($route = null, $parameters = [], $status = 302, $headers = [])
    {
        $url = app('url');

        if ($route !== null && $url->previous() === $url->full()) {
            return $url->route($route, $parameters, $status, $headers);
        }

        return $url->previous();
    }
}

if (!function_exists('set_active')) {
    /**
     * Set active class if request is in path.
     *
     * @param string $path
     * @param array  $classes
     * @param string $active
     *
     * @return string
     */
    function set_active($path, array $classes = [], $active = 'active')
    {
        if (Request::is($path)) {
            $classes[] = $active;
        }
        $class = e(implode(' ', $classes));

        return empty($classes) ? '' : "class=\"{$class}\"";
    }
}

if (!function_exists('thread_filter')) {
    /**
     * Create a node url by filter.
     *
     * @param string|null $filter
     *
     * @return string
     */
    function thread_filter($filter)
    {
        $node_id = Request::segment(2);
        $node_append = '';
        if ($node_id) {
            $link = URL::to(is_numeric($node_id) ? 'nodes' : 'go', $node_id).'?filter='.$filter;
        } else {
            $query_append = '';
            $query = Input::except('filter', '_pjax');
            if ($query) {
                $query_append = '&'.http_build_query($query);
            }
            $link = URL::to('thread').'?filter='.$filter.$query_append.$node_append;
        }
        $selected = Input::get('filter') ? (Input::get('filter') == $filter ? ' class="selected"' : '') : '';

        return 'href="'.$link.'"'.$selected;
    }
}

if (!function_exists('cdn')) {
    /**
     * Create a new cdn url.
     *
     * @param string|null $filepath
     *
     * @return string
     */
    function cdn($filepath = '')
    {
        if (Config::get('setting.site_cdn')) {
            return Config::get('setting.site_cdn').$filepath;
        } else {
            return Config::get('app.url').$filepath;
        }
    }
}

if (!function_exists('upload_url')) {
    /**
     * Create a new upload url.
     *
     * @param string|null $filepath
     *
     * @return string
     */
    function upload_url()
    {
        return Config::get('setting.site_domain') ?: Config::get('app.url');
    }
}

if (!function_exists('option_is_selected')) {
    /**
     * Check if option is selected and output selected else output an empty string.
     *
     * @param array $array
     *
     * @return string
     */
    function option_is_selected(array $array)
    {
        $resource = $array[0];
        $haystack = $array[1];
        $currentResource = isset($array[2]) ? $array[2] : '';

        return (old($haystack) == $resource->id) || ($currentResource && $currentResource->$haystack == $resource->id)
            ? 'selected' : '';
    }
}

if (!function_exists('checkbox_is_active')) {
    /**
     * Check if checkbox is selected and output checked else output an empty string.
     *
     * @param string $haystack
     * @param $resource
     *
     * @return string
     */
    function checkbox_is_active($haystack, array $resource)
    {
        return (old($haystack) == '1') || ($resource && $resource->$haystack == 1) ? 'checked' : '';
    }
}

if (!function_exists('admin_link')) {
    function admin_link($title, $path, $id = '')
    {
        return '<a href="'.admin_url($path, $id).'" target="_blank">'.$title.'</a>';
    }
}

if (!function_exists('admin_url')) {
    function admin_url($path, $id = '')
    {
        return env('APP_URL')."/admin/$path".($id ? '/'.$id : '');
    }
}
