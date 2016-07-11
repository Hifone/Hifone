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

use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\Compilers\CompilerInterface;

class StringBladeCompiler extends BladeCompiler implements CompilerInterface
{
    /** @var \Illuminate\Config\Repository */
    protected $config;

    public function __construct($filesystem, $cache_path, $config, $app)
    {
        // Get Current Blade Instance
        $blade = app('view')->getEngineResolver()->resolve('blade')->getCompiler();

        parent::__construct($filesystem, $cache_path);
        $this->rawTags = $blade->getRawTags();
        $this->contentTags = $blade->getContentTags();
        $this->escapedTags = $blade->getEscapedContentTags();
        $this->extensions = $blade->getExtensions();
        $this->customDirectives = $blade->getCustomDirectives();
        $this->config = $config;
    }

    /**
     * Compile the view at the given path.
     *
     * @param string $path
     *
     * @return void
     */
    public function compile($path)
    {
        $contents = $this->compileString($path);

        if (!is_null($this->cachePath)) {
            $this->files->put($this->getCompiledPath($path), $contents);
        }
    }

    /**
     * Get the path to the compiled version of a view.
     *
     * @param string $path
     *
     * @return string
     */
    public function getCompiledPath($path)
    {
        /*
         * A unique path for the given model instance must be generated
         * so the view has a place to cache. The following generates a
         * path using almost the same logic as Blueprint::createIndexName()
         *
         * e.g db_table_name_id_4
         */
        return $this->cachePath.'/'.md5($path);
    }

    /**
     * Determine if the view at the given path is expired.
     *
     * @param string $path
     *
     * @return bool
     */
    public function isExpired($path)
    {
        if (!$this->config->get('stringblade.cache') or !$this->config->get('stringblade.cache_time') or !is_int($this->config->get('stringblade.cache_time'))) {
            return true;
        }
        $compiled = $this->getCompiledPath($path);

        // If the compiled file doesn't exist we will indicate that the view is expired
        // so that it can be re-compiled. Else, we will verify the last modification
        // of the views is less than the modification times of the compiled views.
        if (!$this->cachePath || !$this->files->exists($compiled)) {
            return true;
        }

        return $this->files->lastModified($compiled) >= strtotime('-'.$this->config->get('stringblade.cache_time').' minutes');
    }
}
