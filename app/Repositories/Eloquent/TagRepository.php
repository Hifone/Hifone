<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Repositories\Eloquent;

use Hifone\Repositories\Contracts\TaggableInterface;
use Hifone\Repositories\Contracts\TagRepositoryInterface;

class TagRepository extends Repository implements TagRepositoryInterface
{
    /**
     * @return \Hifone\Models\Tag
     */
    public function model()
    {
        return 'Hifone\Models\Tag';
    }

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
    }

    /**
     * @param $tags
     */
    public function getTagIDs($tags)
    {
        $existing_tags = $this->model->whereIn('name', $tags)->get();

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
    public function multiInsert(array $tags)
    {
        $tagsId = [];

        foreach ($tags as $name) {
            $tag = $this->model->firstOrCreate(['name' => $name]);
            $tagsId[] = $tag->id;
        }

        return $tagsId;
    }
}
