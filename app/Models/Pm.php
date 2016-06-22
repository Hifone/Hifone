<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Models;

use Hifone\Models\Pm\Meta;
use Hifone\Models\Scopes\ForUser;
use Illuminate\Database\Eloquent\Model;

class Pm extends Model
{
    use ForUser;

    const INBOX = 1;
    const OUTBOX = 2;

    protected $fillable = ['root_id', 'user_id', 'author_id', 'meta_id', 'folder'];

    public function meta()
    {
        return $this->belongsTo(Meta::class);
    }
}
