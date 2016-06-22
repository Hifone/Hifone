<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Created by PhpStorm.
 * User: stuartmccord
 * Date: 10/01/2016
 * Time: 17:05.
 */
namespace Hifone\Services\Tag;

use Hifone\Models\Tag;
use Hifone\Models\Tag\TaggableInterface;

/**
 * Class AddTag.
 */
class AddTag
{
    /**
     * @param TaggableInterface $taggable
     * @param $tags
     */
    public function attach(TaggableInterface $taggable, $tags)
    {
        if (empty($tags)) {
            return;
        }
        if (!is_array($tags)) {
            $tags = str_replace('，', ',', $tags);
            $tags = preg_split('/ ?, ?/', $tags);
        }

        if (count($tags) > 3) {
            $tags = array_slice($tags, 0, 3);
        }

        $ids = $this->getTagIDs($tags);

        $taggable->tags()->sync($ids);
    }

    /**
     * @param $tags
     */
    protected function getTagIDs($tags)
    {
        $existing_tags = Tag::whereIn('name', $tags)->get();

        $new_tags = array_diff($tags, $existing_tags->lists('name')->all());
        $new_ids = $this->createNewTags($new_tags);

        return array_merge($existing_tags->lists('id')->all(), $new_ids);
    }

    /**
     * @param $new_tags
     *
     * @return array
     */
    protected function createNewTags($new_tags)
    {
        $new_ids = [];

        foreach ($new_tags as $key => $tag) {
            $new_ids[] = Tag::firstOrCreate(['name' => $tag])->id;
        }

        return $new_ids;
    }
}
