<?php
/**
 * Created by PhpStorm.
 * User: stuartmccord
 * Date: 10/01/2016
 * Time: 17:05
 */

namespace Hifone\Services\Tag;

use Hifone\Models\Tag\TaggableInterface;

use Hifone\Models\Tag;


/**
 * Class AddTag
 */
class AddTag
{
    /**
     * @param TaggableInterface $taggable
     * @param $tags
     */
    public function attach(TaggableInterface $taggable, $tags)
    {
        if (empty($tags))
            return;
        if(!is_array($tags)) {
            $tags = str_replace('，', ',', $tags);
            $tags = preg_split('/ ?, ?/', $tags);
        }

        if(count($tags) > 3) {
            $tags = array_slice($tags, 0 , 3);
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
     * @return array
     */
    protected function createNewTags($new_tags)
    {
        $new_ids = [];

        foreach ($new_tags as $key => $tag) {
            $new_ids[] = Tag::firstOrCreate(['name' => $tag]);
        }
        return $new_ids;
    }
}