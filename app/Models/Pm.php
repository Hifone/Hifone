<?php

namespace Hifone\Models;

use AltThree\Validator\ValidatingTrait;
use Hifone\Models\Scopes\ForUser;
use Illuminate\Database\Eloquent\Model;
use Hifone\Models\Pm\Meta;

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
