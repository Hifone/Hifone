<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Repositories\Contracts;

interface TagRepositoryInterface extends RepositoryInterface
{
    /**
     * @param \Hifone\Models\Tag\TaggableInterface $taggable
     * @param string|array                         $tags
     *
     * @return void
     */
    public function attach(TaggableInterface $taggable, $tags);

    /**
     * @param $tags
     *
     * @return array Ids of tags
     */
    public function getTagIDs($tags);

    /**
     * @param array $tags
     *
     * @return array Ids of tags
     */
    public function multiInsert(array $tags);
}
