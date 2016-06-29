<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Services\Tag;

use Hifone\Models\Tag;

class AddTag
{
    /**
     * @param \Hifone\Models\Tag\TaggableInterface $taggable
     * @param $tags
     *
     * @return void
     */
    public function attach(TaggableInterface $taggable, $tags)
    {
        if (empty($tags)) {
            $taggable->tags()->sync([]);

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

        $this->updatecount($ids);
    }

    protected function updateCount($ids)
    {
        Tag::whereIn('id', $ids)->get()->map(function ($tag) {
            $count = $tag->threads()->count();
            var_dump($count);
            $tag->update(['count' => $count]);
        });
    }

    /**
     * @param $tags
     */
    protected function getTagIDs($tags)
    {
        $existing_tags = Tag::whereIn('name', $tags)->get();

        $new_tags = array_diff($tags, $existing_tags->lists('name')->all());
        $new_ids = $this->multiInsert($new_tags);

        return array_merge($existing_tags->lists('id')->all(), $new_ids);
    }

    /**
     * Insert tags and return theirs ids.
     *
     * @param array $tags
     *
     * @return array Ids of tags
     */
    protected function multiInsert(array $tags)
    {
        $tagsId = [];

        foreach ($tags as $name) {
            $tag = Tag::firstOrCreate(['name' => $name]);
            $tagsId[] = $tag->id;
        }

        return $tagsId;
    }
}
