<?php
namespace Hifone\Models\Traits;

use Hifone\Models\Tag;


trait Taggable
{
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    /**
     * Returns all of the tags on this component.
     *
     * @return string
     */
    public function getTagsListAttribute()
    {
        $tags = $this->tags->map(function ($tag) {
            return $tag->name;
        });
        return implode(', ', $tags->toArray());
    }
}